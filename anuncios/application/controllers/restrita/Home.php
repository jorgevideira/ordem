<?php

/*
 * Controller responsável pela Home da área restrita do projeto
 */

defined('BASEPATH') OR exit('Ação não permitida');

class Home extends CI_Controller {

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

        $data = array(
            'titulo' => 'Área restrita',
            'styles' => array(
                'assets/bundles/owlcarousel2/dist/assets/owl.carousel.min.css',
                'assets/bundles/owlcarousel2/dist/assets/owl.theme.default.min.css',
            ),
            'scripts' => array(
                'assets/bundles/owlcarousel2/dist/owl.carousel.min.js',
                'assets/js/page/widget-data.js',
            ),
            'anuncios_nao_auditados' => $this->core_model->count_all_results('anuncios', array('anuncio_publicado' => 0)),
            'anuncios_publicados' => $this->core_model->count_all_results('anuncios', array('anuncio_publicado' => 1)),
            'total_anunciantes' => $this->core_model->count_all_results('users_groups', array('group_id' => 2)),
            'contas_bloqueadas' => $this->core_model->count_all_results('users', array('active' => 0)),
            'anunciantes' => $this->ion_auth->users()->result(),
        );


//        echo '<pre>';
//        print_r($data['anunciantes']);
//        exit();

        $this->load->view('restrita/layout/header', $data);
        $this->load->view('restrita/home/index');
        $this->load->view('restrita/layout/footer');
    }

}
