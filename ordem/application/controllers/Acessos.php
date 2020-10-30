<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Acessos extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        
        if (!$this->ion_auth->logged_in()){
            $this->session->set_flashdata('info','Sua sessão expirou!');
               redirect('login');
        }
        
    }
    
    public function index () {

        $this->load->model('core_model');
        $this->load->model('ordem_servicos_model');
        $this->input->post();
        
      $data = array(
        
            
            'titulo' =>'Acessos cadastrados',
        
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'
            ),
            

        ); 
      
      
        $this->load->view('layout/header', $data);
        $this->load->view('acessos/index');
        $this->load->view('layout/footer');
        
//        echo '<pre>';
//        print_r($data['produtos']);
//        exit();
        
    }
    
}