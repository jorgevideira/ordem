<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Clientes extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        
        if (!$this->ion_auth->logged_in()){
            $this->session->set_flashdata('info','Sua sessão expirou!');
               redirect('login');
        }
    }
    
    public function index () {
        
      $data = array(
            
            'titulo' =>'Clientes cadastrados',
        
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'
            ),
            
            'clientes' => $this->core_model->get_all('clientes'),
        ); 
      
//        echo '<pre>';
//        print_r($data['clientes']);
//        exit();
      
        $this->load->view('layout/header', $data);
        $this->load->view('clientes/index');
        $this->load->view('layout/footer');
        
    }
    
    public function edit ($cliente_id = NULL) {
        
        if(!$cliente_id || !$this->core_model->get_by_id ('clientes', array('cliente_id' => $cliente_id))){
            
            $this->session->set_flashdata('error','Cliente não encontrado');
            redirect('clientes');
        
    }else{
        
//            [cliente_tipo] => 1
//            [cliente_nome] => Jorge
//            [cliente_sobrenome] => Borges
//            [cliente_data_nascimento] => 0000-00-00
//            [cliente_cpf_cnpj] => 
//            [cliente_rg_ie] => 493427624
//            [cliente_email] => jorgevideiraribeirao@gmail.com
//            [cliente_telefone] => 16994627437
//            [cliente_celular] => 16994627437
//            [cliente_cep] => 14150100
//            [cliente_endereco] => João Gomes Rocha
//            [cliente_numero_endereco] => 39
//            [cliente_bairro] => Jd Irajá
//            [cliente_complemento] => Casa
//            [cliente_cidade] => Ribeirão Preto
//            [cliente_estado] => SP
//            [cliente_ativo] => 0
//            [cliente_obs] =>
        
            $this->form_validation->set_rules('cliente_nome', '', 'trim|required|min_length[4]|max_length[45]');
            $this->form_validation->set_rules('cliente_sobrenome', '', 'trim|required|min_length[4]|max_length[150]');
            $this->form_validation->set_rules('cliente_data_nascimento', '', 'required');
            $this->form_validation->set_rules('cliente_cpf_cnpj', '', 'trim|required|min_length[4]|max_length[45]');
            $this->form_validation->set_rules('cliente_rg_ie', '', 'trim|required|max_length[20]');
            $this->form_validation->set_rules('cliente_email', '', 'trim|required|valid_email|max_length[50]');
            $this->form_validation->set_rules('cliente_telefone', '', 'trim|max_length[15]');
            $this->form_validation->set_rules('cliente_celular', '', 'trim|max_length[15]');
            $this->form_validation->set_rules('cliente_cep', '', 'trim|required|exact_length[9]');
            $this->form_validation->set_rules('cliente_endereco', '', 'trim|required|max_length[155]');
            $this->form_validation->set_rules('cliente_numero_endereco', '', 'trim|max_length[20]');
            $this->form_validation->set_rules('cliente_bairro', '', 'trim|required|max_length[45]');
            $this->form_validation->set_rules('cliente_complemento', '', 'trim|max_length[145]');
            $this->form_validation->set_rules('cliente_cidade', '', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('cliente_estado', '', 'trim|required|exact_length[2]');
            $this->form_validation->set_rules('cliente_obs', '', 'max_length[500]');
         
           if($this->form_validation->run()){
               
//                echo '<pre>';
//                print_r($this->input->post());
//                exit();
               
           }else{
               
               //erro de validação
               
               $data = array(
            
            'titulo' =>'Atualizar cliente',
        
            'scripts' => array(
                'vendor/mask/jquery.mask.min.js',
                'vendor/mask/app.js',
            ),
            
            'cliente' => $this->core_model->get_by_id('clientes', array('cliente_id' => $cliente_id)),
        ); 
      
//        echo '<pre>';
//        print_r($data['cliente']);
//        exit();
      
        $this->load->view('layout/header', $data);
        $this->load->view('clientes/edit');
        $this->load->view('layout/footer');
               
               
           }
            
         }
    }
}