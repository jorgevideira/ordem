<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Detalhes extends CI_Controller {

    public function index($anuncio_codigo = null) {


        if (!$anuncio_codigo || !$anuncio = $this->anuncios_model->get_by_id(array('anuncio_codigo' => $anuncio_codigo))) {
            redirect('/');
        } else {

            /*
             * Anúncio existe....
             */


            /*
             * Jogamos na sessão o objeto $anuncio que está sendo detalhado para compormos a pesquisa por Estado, Cidade, Bairro, Categoria principal
             */
            $this->session->set_userdata('anuncio_detalhado', $anuncio);




            $data = array(
                'titulo' => 'Detalhes do anúncio ' . $anuncio->anuncio_titulo,
                'anuncio' => $anuncio,
                'anuncio_user' => $anuncio,
                'anuncios_fotos' => $this->core_model->get_all('anuncios_fotos', array('foto_anuncio_id' => $anuncio->anuncio_id)),
                'todos_anuncios_anunciante' => $this->anuncios_model->get_all($anuncio->anuncio_user_id), //Recuperando todos anúncios do dono do anúncio que está sendo detalhado
                'anuncio_perguntas' => $this->anuncios_model->get_perguntas_anuncio_historico(array('anuncios_perguntas_historico.anuncio_id' => $anuncio->anuncio_id)),
            );


            /*
             * Jogamos na sessão a URL do anúncio que está sendo detalhado para usarmos no redirect quando alguém for fazer uma pergunta e não estiver logado
             */
            $this->session->set_userdata('url_anterior', current_url());


//            echo '<pre>';
//            print_r($this->session->userdata());
//            exit();



            $this->load->view('web/layout/header', $data);
            $this->load->view('web/detalhes/index');
            $this->load->view('web/layout/footer');
        }
    }

    public function perguntar($anuncio_id = null) {


        $anuncio_id = (int) $anuncio_id;

        /*
         * Só permitiremos que sejam feitas perguntas se estiver logado
         */
        if (!$this->ion_auth->logged_in()) {

            /*
             * Recuperamos o que veio no POST no name pergunta antes de ser feito o login,
             * E setamos na sessão para quando o visitante realizar o login redirecionarmos para o formulário da pergunta, carregando no input 
             * a pergunta anterior
             */
            $pergunta = $this->input->post('pergunta');
            $this->session->set_userdata('pergunta', $pergunta);

            redirect('login');
        }

        /*
         * Maravilha.... anunciante/visitante está logado... damos sequência
         */

        if (!$anuncio_id || !$anuncio = $this->anuncios_model->get_by_id(array('anuncio_id' => $anuncio_id))) {
            redirect($this->session->userdata('url_anterior'));
        } else {

            /*
             * Maravilha.... anúncio existe
             */


            /*
             * Não permitiremos que o dono do anúncio faça perguntas para ele mesmo
             */
            if ($anuncio->anuncio_user_id == $this->session->userdata('user_id')) {
                $this->session->set_flashdata('erro_pergunta', 'Você não pode fazer uma pergunta para o seu anúncio');
                redirect($this->session->userdata('url_anterior') . '#pergunta');
            }


            /*
             * Chegou a hora de validar o formulário
             */


            $this->form_validation->set_rules('pergunta', 'Pergunta', 'trim|required|min_length[4]|max_length[200]');

            if ($this->form_validation->run()) {

                $data = elements(
                        array(
                            'pergunta'
                        ), $this->input->post()
                );

                $data['anuncio_id'] = $anuncio->anuncio_id;
                $data['anuncio_user_id'] = $anuncio->id;
                $data['anunciante_pergunta_id '] = $this->session->userdata('user_id');

                $data = html_escape($data);

                /*
                 * Inserimos na tabela principal
                 */
                $this->core_model->insert('anuncios_perguntas', $data);


                /*
                 * Inserimos na tabela de histórico
                 */
                $this->core_model->insert('anuncios_perguntas_historico', $data);


                /*
                 * Removemos da sessão a pergunta anterior (antes do login), pois não precisamos mais dela
                 */
                $this->session->unset_userdata('pergunta');


                $this->session->set_flashdata('sucesso_pergunta', 'Sua pergunta foi enviada para o anunciante. Você será notificado por e-mail quando ela for respondida');
                redirect($this->session->userdata('url_anterior') . '#pergunta');
            } else {


                /*
                 * Erros de validação
                 */

                $this->session->set_flashdata('erro_pergunta', validation_errors());
                redirect($this->session->userdata('url_anterior') . '#pergunta');
            }
        }
    }

}
