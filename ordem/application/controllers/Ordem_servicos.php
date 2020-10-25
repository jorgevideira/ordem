<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Ordem_servicos extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        
        if (!$this->ion_auth->logged_in()){
            $this->session->set_flashdata('info','Sua sessão expirou!');
               redirect('login');
        }
        
        $this->load->model('ordem_servicos_model');
    }
    
    public function index () {
        
      $data = array(
            
            'titulo' =>'Ordens de serviços cadastradas',
        
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'
            ),
            
            'ordens_servicos' => $this->ordem_servicos_model->get_all(),
        ); 
      
//        echo '<pre>';
//        print_r($data['ordens_servicos']);
//        exit();
    

        $this->load->view('layout/header', $data);
        $this->load->view('Ordem_servicos/index');
        $this->load->view('layout/footer');
        
    }
    
    public function edit($ordem_servico_id = NULL) {
        
        if(!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id))){
          $this->session->set_flashdata('error', 'Ordem de serviço não encontrado');
          redirect('os');
          
        }else{
            
            // validações form_validation
            
            $this->form_validation->set_rules('ordem_servico_cliente_id', '', 'required');
            $this->form_validation->set_rules('ordem_servico_forma_pagamento_id', '', 'required');
            $this->form_validation->set_rules('ordem_servico_equipamento', 'Marca', 'trim|required|max_length[80]');
            $this->form_validation->set_rules('ordem_servico_marca_equipamento', 'Marca', 'trim|required|max_length[80]');
            $this->form_validation->set_rules('ordem_servico_modelo_equipamento', 'Modelo', 'trim|required|max_length[80]');
            $this->form_validation->set_rules('ordem_servico_acessorios', 'Acessórios', 'trim|required|max_length[300]');
            $this->form_validation->set_rules('ordem_servico_defeito', 'Defeito', 'trim|required|max_length[700]');

            
            if($this->form_validation->run()){
               
             $ordem_servico_valor_total = str_replace('R$', "", trim($this->input->post('ordem_servico_valor_total')));
             
             $data = elements(
                     array(
                         'ordem_servico_valor_desconto',
                         'ordem_servico_valor_total',
                         'ordem_servico_cliente_id',
                         'ordem_servico_forma_pagamento_id',
                         'ordem_servico_status',
                         'ordem_servico_equipamento',
                         'ordem_servico_marca_equipamento',
                         'ordem_servico_modelo_equipamento',
                         'ordem_servico_defeito',
                         'ordem_servico_acessorios',
                         'ordem_servico_obs',
                         
                     ), $this->input->post()
  
                     );
             
             $data['ordem_servico_valor_total'] = trim(preg_replace('/\$/', '', $ordem_servico_valor_total));
             
             $data = html_escape($data);
             
             $this ->core_model->update('ordens_servicos', $data, array('ordem_servico_id' => $ordem_servico_id));
             
             //editando os serrviços antigos da orden editada
             $this->ordem_servicos_model->delete_old_services($ordem_servico_id);
             
             $servico_id = $this->input->post('servico_id');
             $servico_quantidade = $this->input->post('servico_quantidade');
             $servico_desconto = str_replace('%','',$this->input->post('servico_id'));
             
             $servico_preco = str_replace('R$','',$this->input->post('$servico_preco'));
             $servico_item_total = str_replace('R$','',$this->input->post('$servico_item_total'));
             
             $qty_service = count($servico_id);
             
             $ordem_servico_id = $this->input->post('$ordem_servico_id');
             
             for($i = 0; $i < $qty_servico; $i++){
                 
                 $data = array(
                     
                     'ordem_ts_id_ordem_servico ' => $ordem_servico_id,
                     'ordem_ts_id_servico' => $servico_id[$i],
                     'ordem_ts_quantidade' => $servico_quantidade[$i],
                     'ordem_ts_valor_unitario' => $servico_preco[$i],
                     'ordem_ts_valor_desconto' => $servico_desconto[$i],
                     'ordem_ts_valor_total' => $servico_item_total[$i],
                     
                 );
               
                 $data = html_escape($data);
                 
                 $this->core_model->insert('ordem_tem_servicos', $data);
             }
             
             // criar recurso PDF
             
             redirect('os');
                
            }else{
               // ERRO DE VALIDAÇÃO 
             
                $data = array(
            
            'titulo' =>'Atualizar ordem de serviço',
        
            'styles' => array(
                'vendor/select2/select2.min.css',
                'vendor/autocomplete/jquery-ui.css',
                'vendor/autocomplete/estilo.css',
            ),
            'scripts' => array(
                'vendor/autocomplete/jquery-migrate.js',
                'vendor/calcx/jquery-calx-sample-2.2.8.min.js',
                'vendor/calcx/os.js',
                'vendor/select2/select2.min.js',
                'vendor/select2/app.js',
                'vendor/sweetalert2/sweetalert2.js',
                'vendor/autocomplete/jquery-ui.js',
            ),
            
            'clientes' => $this->core_model->get_all('clientes', array('cliente_ativo' => 1)),   
            'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos', array('forma_pagamento_ativa' => 1)),
            'os_tem_servicos' => $this->ordem_servicos_model->get_all_servicos_by_ordem($ordem_servico_id),   
                        
        );
            
            $ordem_servico = $data['ordem_servico'] = $this->ordem_servicos_model->get_by_id($ordem_servico_id);  
            
//        echo '<pre>';
//        print_r($ordem_servico);
//        exit();
                
        $this->load->view('layout/header', $data);
        $this->load->view('Ordem_servicos/edit');
        $this->load->view('layout/footer'); 
            }
                  
        
        }
    }

}

