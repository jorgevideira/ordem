<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Fornecedores extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        
        if (!$this->ion_auth->logged_in()){
            $this->session->set_flashdata('info','Sua sessão expirou!');
               redirect('login');
        }
    }
    
    public function index () {
        
      $data = array(
            
            'titulo' =>'Fornecedores cadastrados',
        
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'
            ),
            
            'fornecedores' => $this->core_model->get_all('fornecedores'),
        ); 
      
//        echo '<pre>';
//        print_r($data['fornecedores']);
//        exit();
      
        $this->load->view('layout/header', $data);
        $this->load->view('fornecedores/index');
        $this->load->view('layout/footer');
        
    }
    
    public function add() {
        
            $this->form_validation->set_rules('fornecedor_razao', '', 'trim|required|min_length[4]|max_length[200]|is_unique[fornecedores.fornecedor_razao]');          
            $this->form_validation->set_rules('fornecedor_nome_fantasia', '', 'trim|required|max_length[145]|is_unique[fornecedores.fornecedor_nome_fantasia]'); 
            $this->form_validation->set_rules('fornecedor_cnpj', '', 'trim|required|exact_length[18]|is_unique[fornecedores.fornecedor_cnpj]|callback_valida_cnpj');
            $this->form_validation->set_rules('fornecedor_ie', '', 'trim|required|max_length[20]|is_unique[fornecedores.fornecedor_ie]');  
            $this->form_validation->set_rules('fornecedor_email', '', 'trim|valid_email|max_length[50]|is_unique[fornecedores.fornecedor_email]');
            $this->form_validation->set_rules('fornecedor_telefone', '', 'trim|required|max_length[15]|is_unique[fornecedores.fornecedor_telefone]');  
            $this->form_validation->set_rules('fornecedor_celular', '', 'trim|required|max_length[15]|is_unique[fornecedores.fornecedor_celular]'); 
            
            $this->form_validation->set_rules('fornecedor_cep', '', 'trim|required|exact_length[9]');
            $this->form_validation->set_rules('fornecedor_endereco', '', 'trim|required|max_length[155]');
            $this->form_validation->set_rules('fornecedor_numero_endereco', '', 'trim|max_length[20]');
            $this->form_validation->set_rules('fornecedor_bairro', '', 'trim|required|max_length[45]');
            $this->form_validation->set_rules('fornecedor_complemento', '', 'trim|max_length[145]');
            $this->form_validation->set_rules('fornecedor_cidade', '', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('fornecedor_estado', '', 'trim|required|exact_length[2]');
            $this->form_validation->set_rules('fornecedor_obs', '', 'max_length[500]');  
          
          
            if($this->form_validation->run()){
                
               $data = elements(
                array(
                    'fornecedor_razao',
                    'fornecedor_nome_fantasia',
                    'fornecedor_cnpj',
                    'fornecedor_ie',
                    'fornecedor_email',
                    'fornecedor_telefone',
                    'fornecedor_celular',
                    'fornecedor_endereco',
                    'fornecedor_numero_endereco',
                    'fornecedor_complemento',
                    'fornecedor_bairro',
                    'fornecedor_cidade',
                    'fornecedor_estado',
                    'fornecedor_cep',
                    'fornecedor_ativo',
                    'fornecedor_obs',
                    
                ), $this->input->post()
        );
        

//        COLOCAR UF EM LETRA MAIUSCULA
        $data['fornecedor_estado'] = strtoupper($this->input->post('fornecedor_estado'));
        
        $data = html_escape($data);
        
        $this->core_model->insert('fornecedores', $data );
        redirect('fornecedores');
                
            }else{
                
                //ERRO DE VALIDAÇÃO
                $data = array(
            
                'titulo' =>'Cadastrar fornecedor',
                'scripts' => array(
                    'vendor/mask/jquery.mask.min.js',
                    'vendor/mask/app.js',
        ),  
        
        );
        
//        echo '<pre>';
//        print_r($data['fornecedor']);
//        exit();
        

        $this->load->view('layout/header', $data);
        $this->load->view('fornecedores/add');
        $this->load->view('layout/footer');
          
            }
        
    }
    
    public function del($fornecedor_id = NULL) {
        
        if (!$this->ion_auth->is_admin()){
         $this->session->set_flashdata('info', 'Você não tem permissão para excluir fornecedores');
         redirect('fornecedores');
     }
        
        if (!$fornecedor_id || !$this->core_model->get_by_id('fornecedores', array('fornecedor_id' => $fornecedor_id))){
            $this->session->set_flashdata('error', 'Fornecedor não encontrado');
             redirect('fornecedores');
        }else{
            $this->core_model->delete('fornecedores', array('fornecedor_id' => $fornecedor_id));
            redirect('fornecedores');
        }
    }
    
    public function edit($fornecedor_id = NULL) {
        
      if(!$fornecedor_id || !$this->core_model->get_by_id('fornecedores', array('fornecedor_id' => $fornecedor_id))){
          $this->session->set_flashdata('error', 'Fornecedor não encontrado');
          redirect('fornecedores');
          
      }else{
          
            $this->form_validation->set_rules('fornecedor_razao', '', 'trim|required|min_length[4]|max_length[200]|callback_check_razao_social');
            
            $this->form_validation->set_rules('fornecedor_nome_fantasia', '', 'trim|required|max_length[145]|callback_check_nome_fantasia'); 
            $this->form_validation->set_rules('fornecedor_cnpj', '', 'trim|required|exact_length[18]|callback_valida_cnpj');
            $this->form_validation->set_rules('fornecedor_ie', '', 'trim|required|max_length[20]|callback_check_fornecedor_ie');  
            $this->form_validation->set_rules('fornecedor_email', '', 'trim|valid_email|max_length[50]|callback_check_fornecedor_email');
            $this->form_validation->set_rules('fornecedor_telefone', '', 'trim|required|max_length[15]|callback_check_fornecedor_telefone');  
            $this->form_validation->set_rules('fornecedor_celular', '', 'trim|required|max_length[15]|callback_check_fornecedor_celular'); 
            
            $this->form_validation->set_rules('fornecedor_cep', '', 'trim|required|exact_length[9]');
            $this->form_validation->set_rules('fornecedor_endereco', '', 'trim|required|max_length[155]');
            $this->form_validation->set_rules('fornecedor_numero_endereco', '', 'trim|max_length[20]');
            $this->form_validation->set_rules('fornecedor_bairro', '', 'trim|required|max_length[45]');
            $this->form_validation->set_rules('fornecedor_complemento', '', 'trim|max_length[145]');
            $this->form_validation->set_rules('fornecedor_cidade', '', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('fornecedor_estado', '', 'trim|required|exact_length[2]');
            $this->form_validation->set_rules('fornecedor_obs', '', 'max_length[500]');  
          
          
            if($this->form_validation->run()){
                
                $fornecedor_ativo = $this->input->post('fornecedor_ativo');
                
                if ($this->db->table_exists('produtos')){
                    
                    if(fornecedor_ativo == 0 && $this->core_model->get_by_id('produtos', array('produto_fornecedor_id' => $fornecedor_id, 'produto_ativo' =>1))){
                        $this->session->set_flashdata('info', 'Este fornecedor não pode ser desativado, pois ela está sendo utilizado em Produtos');
                        redirect('fornecedores');
                    }
                    
                }
                
               $data = elements(
                array(
                    'fornecedor_razao',
                    'fornecedor_nome_fantasia',
                    'fornecedor_cnpj',
                    'fornecedor_ie',
                    'fornecedor_email',
                    'fornecedor_telefone',
                    'fornecedor_celular',
                    'fornecedor_endereco',
                    'fornecedor_numero_endereco',
                    'fornecedor_complemento',
                    'fornecedor_bairro',
                    'fornecedor_cidade',
                    'fornecedor_estado',
                    'fornecedor_cep',
                    'fornecedor_ativo',
                    'fornecedor_obs',
                    
                ), $this->input->post()
        );
        

//        COLOCAR UF EM LETRA MAIUSCULA
        $data['fornecedor_estado'] = strtoupper($this->input->post('fornecedor_estado'));
        
        $data = html_escape($data);
        
        $this->core_model->update('fornecedores', $data, array('fornecedor_id' => $fornecedor_id));
        redirect('fornecedores');
                
            }else{
                
                //ERRO DE VALIDAÇÃO
                $data = array(
            
                'titulo' =>'Atualizar fornecedor',
                'scripts' => array(
                    'vendor/mask/jquery.mask.min.js',
                    'vendor/mask/app.js',
        ),  
            'fornecedor' => $this->core_model->get_by_id('fornecedores', array('fornecedor_id' => $fornecedor_id)),
        );
        
//        echo '<pre>';
//        print_r($data['fornecedor']);
//        exit();
        
        /*
    [fornecedor_id] => 1
    [fornecedor_data_cadastro] => 2020-10-18 01:18:20
    [fornecedor_razao] => Jorge Jpm LTDA
    [fornecedor_nome_fantasia] => JPM
    [fornecedor_cnpj] => 89.192.588/0001-36
    [fornecedor_ie] => 807.432.358.505
    [fornecedor_telefone] => 1639643475
    [fornecedor_celular] => 16994627438
    [fornecedor_email] => jpm@gmail.com
    [fornecedor_contato] => Ciclano
    [fornecedor_cep] => 14150260
    [fornecedor_endereco] => rua dos sistemas
    [fornecedor_numero_endereco] => 1500
    [fornecedor_bairro] => Apple
    [fornecedor_complemento] => torre 2
    [fornecedor_cidade] => New York
    [fornecedor_estado] => SP
    [fornecedor_ativo] => 1
    [fornecedor_obs] => 
    [fornecedor_data_alteracao] => 2020-10-18 01:18:20
         */
        
        $this->load->view('layout/header', $data);
        $this->load->view('fornecedores/edit');
        $this->load->view('layout/footer');
          
            }

      }  
        
    }
    
    public function check_razao_social($fornecedor_razao) {
        
     $fornecedor_id = $this->input->post ('fornecedor_id');
     
     if($this->core_model->get_by_id('fornecedores', array('fornecedor_razao' => $fornecedor_razao,  'fornecedor_id !=' => $fornecedor_id))){
         $this->form_validation->set_message('check_razao_social', 'Esta razão social já existe');
         return FALSE; 
         
     }else{
         return TRUE;
     }
        
    }
    
    public function check_nome_fantasia($fornecedor_nome_fantasia) {
        
     $fornecedor_id = $this->input->post ('fornecedor_id');
     
     if($this->core_model->get_by_id('fornecedores', array('fornecedor_nome_fantasia' => $fornecedor_nome_fantasia,  'fornecedor_id !=' => $fornecedor_id))){
         $this->form_validation->set_message('check_nome_fantasia', 'Este nome fantasia já cadastrado');
         return FALSE; 
         
     }else{
         return TRUE;
     }
        
    }
    
    public function check_fornecedor_ie($fornecedor_ie) {
        
     $fornecedor_id = $this->input->post ('fornecedor_id');
     if($this->core_model->get_by_id('fornecedores', array('fornecedor_ie' => $fornecedor_ie,  'fornecedor_id !=' => $fornecedor_id))){
         $this->form_validation->set_message('check_fornecedor_ie', 'Inscrição estadual já cadastrada');
         return FALSE; 
         
     }else{
         return TRUE;
     }
        
    }
    
    public function check_fornecedor_email($fornecedor_email) {
        
     $fornecedor_id = $this->input->post ('fornecedor_id');
     
     if($this->core_model->get_by_id('fornecedores', array('fornecedor_email' => $fornecedor_email,  'fornecedor_id !=' => $fornecedor_id))){
         $this->form_validation->set_message('check_fornecedor_email', 'Email já cadastrado');
         return FALSE; 
         
     }else{
         return TRUE;
     }
        
    }
    
    public function check_fornecedor_telefone($fornecedor_telefone) {
        
     $fornecedor_id = $this->input->post ('fornecedor_id');
     
     if($this->core_model->get_by_id('fornecedores', array('fornecedor_telefone' => $fornecedor_telefone,  'fornecedor_id !=' => $fornecedor_id))){
         $this->form_validation->set_message('check_fornecedor_telefone', 'Telefone já cadastrado');
         return FALSE; 
         
     }else{
         return TRUE;
     }
        
    }
    
    public function check_fornecedor_celular($fornecedor_celular) {
        
     $fornecedor_id = $this->input->post ('fornecedor_id');
     
     if($this->core_model->get_by_id('fornecedores', array('fornecedor_celular' => $fornecedor_celular,  'fornecedor_id !=' => $fornecedor_id))){
         $this->form_validation->set_message('check_fornecedor_celular', 'Celular já cadastrado');
         return FALSE; 
         
     }else{
         return TRUE;
     }
        
    }
    
    public function valida_cnpj($cnpj) {

        // Verifica se um número foi informado
        if (empty($cnpj)) {
            $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
            return false;
        }

        if ($this->input->post('fornecedor_id')) {

            $fornecedor_id = $this->input->post('fornecedor_id');

            if ($this->core_model->get_by_id('fornecedores', array('fornecedor_id !=' => $fornecedor_id, 'fornecedor_cnpj' => $cnpj))) {
                $this->form_validation->set_message('valida_cnpj', 'Esse CNPJ já existe');
                return FALSE;
            }
        }

        // Elimina possivel mascara
        $cnpj = preg_replace("/[^0-9]/", "", $cnpj);
        $cnpj = str_pad($cnpj, 14, '0', STR_PAD_LEFT);


        // Verifica se o numero de digitos informados é igual a 11 
        if (strlen($cnpj) != 14) {
            $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
            return false;
        }

        // Verifica se nenhuma das sequências invalidas abaixo 
        // foi digitada. Caso afirmativo, retorna falso
        else if ($cnpj == '00000000000000' ||
                $cnpj == '11111111111111' ||
                $cnpj == '22222222222222' ||
                $cnpj == '33333333333333' ||
                $cnpj == '44444444444444' ||
                $cnpj == '55555555555555' ||
                $cnpj == '66666666666666' ||
                $cnpj == '77777777777777' ||
                $cnpj == '88888888888888' ||
                $cnpj == '99999999999999') {
            $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
            return false;

            // Calcula os digitos verificadores para verificar se o
            // CPF é válido
        } else {

            $j = 5;
            $k = 6;
            $soma1 = "";
            $soma2 = "";

            for ($i = 0; $i < 13; $i++) {

                $j = $j == 1 ? 9 : $j;
                $k = $k == 1 ? 9 : $k;

                //$soma2 += ($cnpj{$i} * $k);

                //$soma2 = intval($soma2) + ($cnpj{$i} * $k); //Para PHP com versão < 7.4
                $soma2 = intval($soma2) + ($cnpj[$i] * $k); //Para PHP com versão > 7.4

                if ($i < 12) {
                    //$soma1 = intval($soma1) + ($cnpj{$i} * $j); //Para PHP com versão < 7.4
                    $soma1 = intval($soma1) + ($cnpj[$i] * $j); //Para PHP com versão > 7.4
                }

                $k--;
                $j--;
            }

            $digito1 = $soma1 % 11 < 2 ? 0 : 11 - $soma1 % 11;
            $digito2 = $soma2 % 11 < 2 ? 0 : 11 - $soma2 % 11;

            if (!($cnpj[12] == $digito1) and ( $cnpj[13] == $digito2)) {
                $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
                return false;
            } else {
                return true;
            }
        }
    }
}