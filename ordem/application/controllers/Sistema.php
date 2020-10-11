<?php

defined('BASEPATH') OR exit ('Ação não permitida');

class Sistema extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        
       // if (!$this->ion_auth->logged_in()){
       //         redirect('login');
       //     }
        
    }
    
}