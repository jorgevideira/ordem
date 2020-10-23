<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Pagar extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        
        if (!$this->ion_auth->logged_in()){
            $this->session->set_flashdata('info','Sua sessão expirou!');
               redirect('login');
        }
    }
    
    public function index () {
        
      $data = array(
            
            'titulo' =>'Contas a pagar cadastradas',
        
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'
            ),
            
            'contas_pagar' => $this->financeiro_model->get_all_pagar(),
        ); 
      

        $this->load->view('layout/header', $data);
        $this->load->view('pagar/index');
        $this->load->view('layout/footer');
        
    }
}