<?php

/*
 * Controller responsável pela Login na área restrita
 */

defined('BASEPATH') OR exit('Ação não permitida');

class Login extends CI_Controller {

    public function index() {

        $data = array(
            'titulo' => 'Login na área restrita',
        );

        $this->load->view('restrita/layout/header');
        $this->load->view('restrita/login/index');
        $this->load->view('restrita/layout/footer');
    }

    public function auth() {

        /*
         * [email] => lucio@gmail.com
          [password] => 1234566
          [remember] => on
         */


        $identity = $this->input->post('email');
        $password = $this->input->post('password');
        $remember = ($this->input->post('remember' ? TRUE : FALSE));


        if ($this->ion_auth->login($identity, $password, $remember)) {

            /*
             * Só permitiremos que um administrador faça login na área restrita
             */
            if ($this->ion_auth->is_admin()) {
                redirect('restrita');
            } else {
                redirect('/');
            }
        } else {

            /*
             * Erro de login
             */
            $this->session->set_flashdata('erro', 'Verifique suas ceredenciais de acesso');
            redirect('restrita/' . $this->router->fetch_class());
        }
    }

    public function logout() {

        $this->ion_auth->logout();
        redirect('restrita/' . $this->router->fetch_class());
    }

}
