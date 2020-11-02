<?php

/*
 * Controller responsável por gerenciar categorias filhas
 */

defined('BASEPATH') OR exit('Ação não permitida');

class Sistema extends CI_Controller {

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
    }

    public function index() {


        $this->form_validation->set_rules('sistema_razao_social', 'Razão social', 'trim|required|min_length[5]|max_length[130]');
        $this->form_validation->set_rules('sistema_nome_fantasia', 'Nome fantasia', 'trim|required|min_length[5]|max_length[130]');
        $this->form_validation->set_rules('sistema_cnpj', 'CNPJ', 'trim|required|exact_length[18]');
        $this->form_validation->set_rules('sistema_ie', 'Inscrição estadual', 'trim|required|min_length[5]|max_length[25]');
        $this->form_validation->set_rules('sistema_telefone_fixo', 'Telefone fixo', 'trim|required|exact_length[14]');
        $this->form_validation->set_rules('sistema_telefone_movel', 'Celular', 'trim|required|min_length[14]|max_length[15]');
        $this->form_validation->set_rules('sistema_email', 'E-mail', 'trim|required|min_length[5]|max_length[90]|valid_email');
        $this->form_validation->set_rules('sistema_site_titulo', 'Título do website', 'trim|required|min_length[5]|max_length[200]');
        $this->form_validation->set_rules('sistema_cep', 'CEP', 'trim|required|exact_length[9]');
        $this->form_validation->set_rules('sistema_endereco', 'Endereço', 'trim|required|min_length[5]|max_length[140]');
        $this->form_validation->set_rules('sistema_numero', 'Número', 'trim|max_length[20]');
        $this->form_validation->set_rules('sistema_bairro', 'Bairro', 'trim|required|min_length[3]|max_length[90]');
        $this->form_validation->set_rules('sistema_cidade', 'Cidade', 'trim|required|min_length[3]|max_length[90]');
        $this->form_validation->set_rules('sistema_estado', 'Estado', 'trim|required|exact_length[2]');


        if ($this->form_validation->run()) {


            $data = elements(
                    array(
                        'sistema_razao_social',
                        'sistema_nome_fantasia',
                        'sistema_cnpj',
                        'sistema_ie',
                        'sistema_telefone_fixo',
                        'sistema_telefone_movel',
                        'sistema_email',
                        'sistema_site_titulo',
                        'sistema_cep',
                        'sistema_endereco',
                        'sistema_numero',
                        'sistema_bairro',
                        'sistema_cidade',
                        'sistema_estado',
                    ), $this->input->post()
            );


            $data = html_escape($data);

            $this->core_model->update('sistema', $data, array('sistema_id' => 1));
            redirect('restrita/' . $this->router->fetch_class());
        } else {

            /*
             * Erros de validação
             */

            $data = array(
                'titulo' => 'Gerenciar as informações do website',
                'scripts' => array(
                    'assets/mask/jquery.mask.min.js',
                    'assets/mask/custom.js',
                ),
                'sistema' => $this->core_model->get_by_id('sistema', array('sistema_id' => 1)),
            );

            $this->load->view('restrita/layout/header', $data);
            $this->load->view('restrita/sistema/index');
            $this->load->view('restrita/layout/footer');
        }
    }

}
