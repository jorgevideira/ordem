<?php

defined('BASEPATH') OR exit ('Ação não permitida');

class Sistema extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        
       if (!$this->ion_auth->logged_in()){
           $this->session->set_flashdata('info','Sua sessão expirou!');
                redirect('login');
            }
            
            if(!$this->ion_auth->is_admin()){
            $this->session->set_flashdata('info','Você não tem permissão para acessar o menu Sistema');
               redirect('/');
        }
        
    }
   
    public function index() {
        
        $data = array(
            'titulo' => 'Editar informações do sistema',
            
            'scripts' => array(
                'vendor/mask/jquery.mask.min.js',
                'vendor/mask/app.js',
            ),
            
            'sistema' => $this->core_model->get_by_id('sistema', array('sistema_id' => 1)),
        );
        
//        echo '<pre>';
//        print_r($data['sistema']);
//        exit();
        
        /*
         *  
    [sistema_id] => 1
    [sistema_razao_social] => System ordem inc
    [sistema_nome_fantasia] => sistema ordem now
    [sistema_cnpj] => 58.859.086/0001-92
    [sistema_ie] => 
    [sistema_telefone_fixo] => 
    [sistema_telefone_movel] => 
    [sistema_email] => sistema@ordem.com.br
    [sistema_site_url] => http://localhost/ordem/usuarios
    [sistema_cep] => 80429-000
    [sistema_endereco] => Rua das laranjeiras
    [sistema_numero] => 1500
    [sistema_cidade] => Limoeiro
    [sistema_estado] => SP
    [sistema_txt_ordem_servico] => 
    [sistema_data_alteracao] => 2020-10-11 02:45:45
         */
        
        $this->form_validation->set_rules('sistema_razao_social','Razão social','required|min_length[5]|max_length[145]');
        $this->form_validation->set_rules('sistema_nome_fantasia','Nome Fantasia','required|min_length[1]|max_length[145]');
        $this->form_validation->set_rules('sistema_cnpj','CNPJ','required|exact_length[18]');
        $this->form_validation->set_rules('sistema_ie','Inscrição Estadual','required|min_length[1]|max_length[25]');
        $this->form_validation->set_rules('sistema_telefone_fixo','Telefone fixo','max_length[25]');
        $this->form_validation->set_rules('sistema_telefone_movel','Celular','required|min_length[1]|max_length[25]');
        $this->form_validation->set_rules('sistema_email','E-mail','required|valid_email|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('sistema_site_url','Telefone fixo','max_length[100]');
        $this->form_validation->set_rules('sistema_cep','CEP','required|exact_length[9]');
        $this->form_validation->set_rules('sistema_endereco','Endereço','required|min_length[1]|max_length[145]');
        $this->form_validation->set_rules('sistema_bairro','Bairro','max_length[25]');
        $this->form_validation->set_rules('sistema_numero','Número','max_length[25]');
        $this->form_validation->set_rules('sistema_complemento','Complemento','max_length[25]');
        $this->form_validation->set_rules('sistema_cidade','Cidade','required|min_length[1]|max_length[45]');
        $this->form_validation->set_rules('sistema_estado','UF','required|exact_length[2]');
        $this->form_validation->set_rules('sistema_txt_ordem_servico','Texto da ordem de serviço e venda','max_length[500]');
        
        
        
        
//          echo '<pre>';
//        print_r($data['sistema']);
//        exit();
        
        if ($this->form_validation->run()){
            
//                echo '<pre>';
//                print_r($this->input->post());
//                exit();
            
            /* 
   *[sistema_razao_social] => System ordem inc
    [sistema_nome_fantasia] => sistema ordem now
    [sistema_cnpj] => 58.859.086/0001-92
    [sistema_ie] => 1245
    [sistema_telefone_fixo] => 
    [sistema_telefone_movel] => 12456
    [sistema_email] => sistema@ordem.com.br
    [sistema_site_url] => http://localhost/ordem/usuarios
    [sistema_endereco] => Rua das laranjeiras
    [sistema_bairro] => Jd.Iraja
    [sistema_numero] => 1500
    [sistema_complemento] => casa
    [sistema_cidade] => Limoeiro
    [sistema_estado] => SP
    [sistema_cep] => 80429-000
    [sistema_txt_ordem_servico] => 
             */
            
            $data = elements(
                    array(
                        'sistema_razao_social',
                        'sistema_nome_fantasia',
                        'sistema_cnpj',
                        'sistema_ie',
                        'sistema_telefone_fixo',
                        'sistema_telefone_movel',
                        'sistema_email',
                        'sistema_site_url',
                        'sistema_cep',
                        'sistema_endereco',
                        'sistema_bairro',
                        'sistema_numero',
                        'sistema_complemento',
                        'sistema_cidade',
                        'sistema_estado',
                        'sistema_txt_ordem_servico',

                    ), $this->input->post()
                    );
            
                    $data = html_escape($data);
                    $this->core_model->update('sistema', $data, array('sistema_id' => 1));
                    redirect('sistema');
            
        }else{
            //erro de validação
        $this->load->view('layout/header', $data);
        $this->load->view('sistema/index');
        $this->load->view('layout/footer');            
            
        }
        

    }
    
}