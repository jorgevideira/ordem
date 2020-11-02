<?php

/*
 * Controller responsável por gerenciar categorias filhas
 */

defined('BASEPATH') OR exit('Ação não permitida');

class Categorias extends CI_Controller {

    public function __construct() {
        parent::__construct();


        /*
         * Definir se há sessão válida
         */
        if (!$this->ion_auth->logged_in()) {
            redirect('restrita/login');
        }

        /*
         * Definir se é admin
         * Se não for, será redirecionado para a a parte pública
         */
        if (!$this->ion_auth->is_admin()) {
            redirect('/');
        }


        $this->load->model('categorias_model');
    }

    public function index() {


        $data = array(
            'titulo' => 'Categorias cadastradas',
            'styles' => array(
                'assets/bundles/datatables/datatables.min.css',
                'assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'assets/bundles/datatables/datatables.min.js',
                'assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
                'assets/bundles/jquery-ui/jquery-ui.min.js',
                'assets/js/page/datatables.js'
            ),
            'categorias' => $this->categorias_model->get_all_categorias(),
        );

//        echo '<pre>';
//        print_r($data['masters']);
//        exit();

        $this->load->view('restrita/layout/header', $data);
        $this->load->view('restrita/categorias/index');
        $this->load->view('restrita/layout/footer');
    }

    public function core($categoria_id = null) {


        $categoria_id = (int) $categoria_id;


        if (!$categoria_id) {

            /*
             * Cadatrando nova categoria
             */


            $this->form_validation->set_rules('categoria_nome', 'Nome da categoria', 'trim|required|min_length[3]|max_length[100]|callback_valida_nome_categoria');
            $this->form_validation->set_rules('categoria_pai_id', 'Categoria pai', 'trim|required');


            if ($this->form_validation->run()) {

                /*
                 * Formulário validado.... salvamos no banco de dados
                 */


                $data = elements(
                        array(
                            'categoria_nome',
                            'categoria_pai_id',
                            'categoria_ativa',
                        ), $this->input->post()
                );

                /*
                 * Definindo o meta link da categoria
                 */

                $data['categoria_meta_link'] = url_amigavel($data['categoria_nome']);


                $data = html_escape($data);


                $this->core_model->insert('categorias', $data);
                redirect('restrita/' . $this->router->fetch_class());
            } else {

                /*
                 * Erros de validação
                 */

                $data = array(
                    'titulo' => 'Cadastrar categoria',
                    'styles' => array(
                        'assets/bundles/select2/dist/css/select2.min.css',
                    ),
                    'scripts' => array(
                        'assets/bundles/select2/dist/js/select2.full.min.js',
                    ),
                    'masters' => $this->core_model->get_all('categorias_pai', array('categoria_pai_ativa' => 1))
                );

//                    echo '<pre>';
//                    print_r($data['categoria']);
//                    exit();

                $this->load->view('restrita/layout/header', $data);
                $this->load->view('restrita/categorias/core');
                $this->load->view('restrita/layout/footer');
            }
        } else {

            /*
             * Categoria foi informada, contudo, devemos garantir a sua existência na base de dados
             */

            if (!$categoria = $this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id))) {
                $this->session->set_flashdata('erro', 'Categoria não foi encontrada');
                redirect('restrita/' . $this->router->fetch_class());
            } else {


                /*
                 * Maravilha.... categoria foi encontrada.... passamos para as validações
                 */

                $this->form_validation->set_rules('categoria_nome', 'Nome da categoria', 'trim|required|min_length[3]|max_length[100]|callback_valida_nome_categoria');
                $this->form_validation->set_rules('categoria_pai_id', 'Categoria pai', 'trim|required');


                if ($this->form_validation->run()) {

                    /*
                     * Formulário validado.... salvamos no banco de dados
                     */


                    $data = elements(
                            array(
                                'categoria_nome',
                                'categoria_pai_id',
                                'categoria_ativa',
                            ), $this->input->post()
                    );

                    /*
                     * Definindo o meta link da categoria
                     */

                    $data['categoria_meta_link'] = url_amigavel($data['categoria_nome']);


                    $data = html_escape($data);


                    $this->core_model->update('categorias', $data, array('categoria_id' => $categoria->categoria_id));
                    redirect('restrita/' . $this->router->fetch_class());
                } else {

                    /*
                     * Erros de validação
                     */

                    $data = array(
                        'titulo' => 'Editar categoria',
                        'styles' => array(
                            'assets/bundles/select2/dist/css/select2.min.css',
                        ),
                        'scripts' => array(
                            'assets/bundles/select2/dist/js/select2.full.min.js',
                        ),
                        'categoria' => $categoria,
                        'masters' => $this->core_model->get_all('categorias_pai', array('categoria_pai_ativa' => 1))
                    );

//                    echo '<pre>';
//                    print_r($data['categoria']);
//                    exit();

                    $this->load->view('restrita/layout/header', $data);
                    $this->load->view('restrita/categorias/core');
                    $this->load->view('restrita/layout/footer');
                }
            }
        }
    }

    public function valida_nome_categoria($categoria_nome) {


        $categoria_id = $this->input->post('categoria_id');


        if (!$categoria_id) {

            /*
             * cadastro...
             */

            if ($this->core_model->get_by_id('categorias', array('categoria_nome' => $categoria_nome))) {

                $this->form_validation->set_message('valida_nome_categoria', 'Essa categoria já existe');
                return false;
            } else {

                return true;
            }
        } else {

            /*
             * Editando...
             */


            if ($this->core_model->get_by_id('categorias', array('categoria_nome' => $categoria_nome, 'categoria_id !=' => $categoria_id))) {

                $this->form_validation->set_message('valida_nome_categoria', 'Essa categoria já existe');
                return false;
            } else {

                return true;
            }
        }
    }

    public function delete($categoria_id = null) {


        $categoria_id = (int) $categoria_id;


        if (!$categoria_id || !$categoria = $this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id))) {
            $this->session->set_flashdata('erro', 'Categoria não foi encontrada');
            redirect('restrita/' . $this->router->fetch_class());
        }


        if ($categoria->categoria_ativa == 1) {
            $this->session->set_flashdata('erro', 'Não é permitido excluir uma Categoria que esteja ativa');
            redirect('restrita/' . $this->router->fetch_class());
        }


        $this->core_model->delete('categorias', array('categoria_id' => $categoria->categoria_id));
        redirect('restrita/' . $this->router->fetch_class());
    }

}
