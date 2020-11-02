<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Busca extends CI_Controller {

    public function index() {

        $busca = $this->input->post('busca');


        if (!$busca) {
            redirect('/');
        } else {

            /*
             * Foi digitado alguma coisa no input 'name'.... damos sequência
             */


            if (!$anuncios = $this->anuncios_model->get_all_by_busca($busca)) {

                redirect('/');
            } else {

                /*
                 * Maravilha.... foi encontrado pelo menos um anúncio de acordo com o termo digitado
                 */


                $data = array(
                    'titulo' => 'Busca pelo produto ' . $busca,
                    'informacao_busca' => 'Termo digitado ' . $busca,
                );


                foreach ($anuncios as $anuncio) {

                    $data['categoria_pai_nome'] = $anuncio->categoria_pai_nome;
                    $data['categoria_pai_meta_link'] = $anuncio->categoria_pai_meta_link;
                    $data['categoria_nome'] = $anuncio->categoria_nome;
                    $data['categoria_meta_link'] = $anuncio->categoria_meta_link;

                    break;
                }


                $data['anuncios'] = $anuncios;

                $this->load->view('web/layout/header', $data);
                $this->load->view('web/home/index');
                $this->load->view('web/layout/footer');
            }
        }
    }

    public function estado($anuncio_estado = null) {


        if (!$anuncio_estado) {
            redirect('/');
        } else {

            /*
             * Recuperamos da sessão o anúncio que foi detalhado no controller 'Detalhes'
             */
            $anuncio = $this->session->userdata('anuncio_detalhado');

            $data = array(
                'titulo' => 'Busca pelo estado ' . $anuncio_estado,
                'anuncios' => $this->anuncios_model->get_all_by(array('anuncio_estado' => $anuncio_estado, 'anuncio_categoria_pai_id' => $anuncio->anuncio_categoria_pai_id, 'anuncio_categoria_id' => $anuncio->anuncio_categoria_id)),
            );

            foreach ($data['anuncios'] as $anuncio) {

                $data['categoria_pai_nome'] = $anuncio->categoria_pai_nome;
                $data['categoria_pai_meta_link'] = $anuncio->categoria_pai_meta_link;
                $data['categoria_nome'] = $anuncio->categoria_nome;
                $data['categoria_meta_link'] = $anuncio->categoria_meta_link;

                break;
            }

            $data['informacao_busca'] = 'encontrados em ' . $anuncio_estado;


//            echo '<pre>';
//            print_r($data['anuncios']);
//            exit();


            $this->load->view('web/layout/header', $data);
            $this->load->view('web/home/index');
            $this->load->view('web/layout/footer');
        }
    }

    public function cidade($anuncio_cidade_metalink = null) {


        if (!$anuncio_cidade_metalink) {
            redirect('/');
        } else {

            /*
             * Recuperamos da sessão o anúncio que foi detalhado no controller 'Detalhes'
             */
            $anuncio = $this->session->userdata('anuncio_detalhado');

            $data = array(
                'titulo' => 'Busca pela cidade ' . $anuncio->anuncio_cidade,
                'anuncios' => $this->anuncios_model->get_all_by(array('anuncio_cidade_metalink' => $anuncio_cidade_metalink, 'anuncio_categoria_pai_id' => $anuncio->anuncio_categoria_pai_id, 'anuncio_categoria_id' => $anuncio->anuncio_categoria_id)),
            );

            foreach ($data['anuncios'] as $anuncio) {

                $data['categoria_pai_nome'] = $anuncio->categoria_pai_nome;
                $data['categoria_pai_meta_link'] = $anuncio->categoria_pai_meta_link;
                $data['categoria_nome'] = $anuncio->categoria_nome;
                $data['categoria_meta_link'] = $anuncio->categoria_meta_link;
                $data['anuncio_estado'] = $anuncio->anuncio_estado;

                break;
            }

            $data['informacao_busca'] = 'encontrados na cidade de ' . $anuncio->anuncio_cidade;


//            echo '<pre>';
//            print_r($data['anuncios']);
//            exit();


            $this->load->view('web/layout/header', $data);
            $this->load->view('web/home/index');
            $this->load->view('web/layout/footer');
        }
    }

    public function bairro($anuncio_bairro_metalink = null) {


        if (!$anuncio_bairro_metalink) {
            redirect('/');
        } else {

            /*
             * Recuperamos da sessão o anúncio que foi detalhado no controller 'Detalhes'
             */
            $anuncio = $this->session->userdata('anuncio_detalhado');

            $data = array(
                'titulo' => 'Busca pelo bairro ' . $anuncio->anuncio_bairro . ', na cidade de ' . $anuncio->anuncio_cidade . ', no estado de - ' . $anuncio->anuncio_estado,
                /*
                 * Aqui definimos que devem ser retornados anúncios que sejam do bairro pesquisado no breadcrumb,
                 * mas que sejam da mesma cidade e estado, posi existem bairros com o mesmo nome, porém cidades distintas
                 */
                'anuncios' => $this->anuncios_model->get_all_by(array('anuncio_bairro_metalink' => $anuncio_bairro_metalink, 'anuncio_cidade' => $anuncio->anuncio_cidade, 'anuncio_estado' => $anuncio->anuncio_estado, 'anuncio_categoria_pai_id' => $anuncio->anuncio_categoria_pai_id, 'anuncio_categoria_id' => $anuncio->anuncio_categoria_id)),
            );

            foreach ($data['anuncios'] as $anuncio) {

                $data['categoria_pai_nome'] = $anuncio->categoria_pai_nome;
                $data['categoria_pai_meta_link'] = $anuncio->categoria_pai_meta_link;
                $data['categoria_nome'] = $anuncio->categoria_nome;
                $data['categoria_meta_link'] = $anuncio->categoria_meta_link;
                $data['anuncio_estado'] = $anuncio->anuncio_estado;
                $data['anuncio_cidade'] = $anuncio->anuncio_cidade;

                break;
            }

            $data['informacao_busca'] = 'encontrados no bairro ' . $anuncio->anuncio_bairro;



            $this->load->view('web/layout/header', $data);
            $this->load->view('web/home/index');
            $this->load->view('web/layout/footer');
        }
    }

    public function master($categoria_pai_meta_link = null) {


        if (!$categoria_pai_meta_link) {
            redirect('/');
        } else {

            $data = array(
                'anuncios' => $this->anuncios_model->get_all_by(array('categoria_pai_meta_link' => $categoria_pai_meta_link)),
            );


            foreach ($data['anuncios'] as $anuncio) {

                $data['titulo'] = 'Busca pela categoria princial ' . $anuncio->categoria_pai_nome;

                $data['informacao_busca'] = 'Exibindo anúncios da categoria principal ' . $anuncio->categoria_pai_nome;

                break;
            }




            $this->load->view('web/layout/header', $data);
            $this->load->view('web/home/index');
            $this->load->view('web/layout/footer');
        }
    }
    
    
    

    public function categoria($categoria_meta_link = null) {


        if (!$categoria_meta_link) {
            redirect('/');
        } else {


            $data = array(
                'anuncios' => $this->anuncios_model->get_all_by(array('categoria_meta_link' => $categoria_meta_link)),
            );


            foreach ($data['anuncios'] as $anuncio) {

                $data['titulo'] = 'Busca pela categoria secundária ' . $anuncio->categoria_nome;
                $data['categoria_pai_nome'] = $anuncio->categoria_pai_nome;
                $data['categoria_pai_meta_link'] = $anuncio->categoria_pai_meta_link;



                $data['informacao_busca'] = 'Exibindo anúncios da categoria principal ' . $anuncio->categoria_pai_nome;

                break;
            }

            $data['informacao_busca'] = 'Exibindo anúncios da categoria secundária ' . $anuncio->categoria_nome;

            $this->load->view('web/layout/header', $data);
            $this->load->view('web/home/index');
            $this->load->view('web/layout/footer');
        }
    }

    public function busca_ajax() {


        if (!$this->input->is_ajax_request()) {
            exit('Ação não permitida');
        }

        $busca = $this->input->post('busca');


        if (!$busca) {
            redirect('/');
        } else {


            $anuncios = $this->anuncios_model->get_all_by_busca($busca);


            $data['response'] = 'false';


            if ($anuncios) {


                $data['response'] = 'true';
                $data['message'] = array();


                foreach ($anuncios as $anuncio) {

                    $data['message'][] = array(
                        'value' => $anuncio->anuncio_titulo,
                    );
                }
            }
            echo json_encode($data);
        }
    }

}
