<?php

use Sabberworm\CSS\Value\Size;

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

        $this->load->view('layout/header', $data);
        $this->load->view('Ordem_servicos/index');
        $this->load->view('layout/footer');
        
    }
    
    public function add(){

        
            //validação campos
            $this->form_validation->set_rules('ordem_servico_cliente_id','','required');
            $this->form_validation->set_rules('ordem_servico_equipamento','equipamento','trim|required|min_length[2]|max_length[80]');
 
            $this->form_validation->set_rules('ordem_servico_marca_equipamento','marca','trim|required|min_length[2]|max_length[80]');
 
            $this->form_validation->set_rules('ordem_servico_modelo_equipamento','modelo','trim|required|min_length[3]|max_length[80]');
 
            $this->form_validation->set_rules('ordem_servico_acessorios','acessórios','trim|required|max_length[300]');
 
            $this->form_validation->set_rules('ordem_servico_defeito','defeito','trim|required|min_length[2]|max_length[700]');
 
 
            if($this->form_validation->run()){

 
                $ordem_servico_valor_total = str_replace('R$', '', trim($this->input->post('ordem_servico_valor_total')));
 
                $data = elements([
                    'ordem_servico_cliente_id',                    
                    'ordem_servico_equipamento',
                    'ordem_servico_marca_equipamento',
                    'ordem_servico_modelo_equipamento',
                    'ordem_servico_acessorios',
                    'ordem_servico_defeito',
                    'ordem_servico_valor_desconto',
                    'ordem_servico_valor_total',
                    'ordem_servico_status',
                    'ordem_servico_obs',
                ], $this->input->post());
 
                $data['ordem_servico_valor_total'] = trim(preg_replace('/\$/','', $ordem_servico_valor_total));
 
                $data = html_escape($data);
 
                $this->core_model->insert('ordens_servicos', $data,TRUE);

                //RECUPERAR ID

                $id_ordem_servico = $this->session->userdata('last_id');
 
 
                $servico_id = $this->input->post('servico_id');
                $servico_quantidade = $this->input->post('servico_quantidade');
                $servico_desconto = str_replace('%','', $this->input->post('servico_desconto'));
                
                
                $servico_preco = str_replace('R$','', $this->input->post('servico_preco'));
                $servico_item_total = str_replace('R$','', $this->input->post('servico_item_total'));
                
                $servico_preco = str_replace(',', '', $servico_preco);
                $servico_item_total = str_replace(',','', $servico_item_total);
 
                $qty_servico = count($servico_id);
 
                $ordem_servico_id = $this->input->post('ordem_servico_id');
 
                for($i = 0; $i < $qty_servico; $i++){
 
                    $data = [
                        'ordem_ts_id_ordem_servico' => $id_ordem_servico,
                        'ordem_ts_id_servico' => $servico_id[$i],
                        'ordem_ts_quantidade' => $servico_quantidade[$i],
                        'ordem_ts_valor_unitario' => $servico_preco[$i],
                        'ordem_ts_valor_desconto' => $servico_desconto[$i],
                        'ordem_ts_valor_total' => $servico_item_total[$i],
                    ];
 
                    $data = html_escape($data);
 
                    $this->core_model->insert('ordem_tem_servicos', $data);
 
                }

                // criar recurso pdf
                redirect('os/imprimir/' .$id_ordem_servico);
               
 
            }else{
 
                $data = [
                    'titulo' => 'Cadastrar ordem de serviço',
    
                    'styles' => ['vendor/select2/select2.min.css',
                                 'vendor/autocomplete/jquery-ui.css',
                                 'vendor/autocomplete/estilo.css'],
        
                    'scripts' => ['vendor/autocomplete/jquery-migrate.js', // 1°
                                  'vendor/calcx/jquery-calx-sample-2.2.8.min.js',
                                  'vendor/calcx/os.js', 
                                  'vendor/select2/select2.min.js',
                                  'vendor/select2/app.js',
                                  'vendor/sweetalert2/sweetalert2.js',
                                  'vendor/autocomplete/jquery-ui.js'], // ultimo na sequencia
        
                   'clientes' => $this->core_model->get_all('clientes', ['cliente_ativo' => 1]),

                ];
    

                $this->load->view('layout/header', $data);
                $this->load->view('ordem_servicos/add');
                $this->load->view('layout/footer');
            }
 

    }


   public function edit($ordem_servico_id = null){
 
        if(!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', ['ordem_servico_id' => $ordem_servico_id])){
            $this->session->set_flashdata('error', 'Ordem de serviço não localizada !!!');
            redirect('os');
 
        }else{
            //validação campos
            $this->form_validation->set_rules('ordem_servico_cliente_id','','required');

            $ordem_servico_status = $this->input->post('ordem_servico_status');

            if($ordem_servico_status == 1){

                $this->form_validation->set_rules('ordem_servico_forma_pagamento_id','','required');

            }

            $this->form_validation->set_rules('ordem_servico_equipamento','equipamento','trim|required|min_length[2]|max_length[80]');
 
            $this->form_validation->set_rules('ordem_servico_marca_equipamento','marca','trim|required|min_length[2]|max_length[80]');
 
            $this->form_validation->set_rules('ordem_servico_modelo_equipamento','modelo','trim|required|min_length[3]|max_length[80]');
 
            $this->form_validation->set_rules('ordem_servico_acessorios','acessórios','trim|required|max_length[300]');
 
            $this->form_validation->set_rules('ordem_servico_defeito','defeito','trim|required|min_length[2]|max_length[700]');
 
 
            if($this->form_validation->run()){

 
                $ordem_servico_valor_total = str_replace('R$', '', trim($this->input->post('ordem_servico_valor_total')));
 
                $data = elements([
                    'ordem_servico_forma_pagamento_id',
                    'ordem_servico_cliente_id',                    
                    'ordem_servico_equipamento',
                    'ordem_servico_marca_equipamento',
                    'ordem_servico_modelo_equipamento',
                    'ordem_servico_acessorios',
                    'ordem_servico_defeito',
                    'ordem_servico_valor_desconto',
                    'ordem_servico_valor_total',
                    'ordem_servico_status',
                    'ordem_servico_obs',
                ], $this->input->post());

                if($ordem_servico_status == 0){

                    unset($data['ordem_servico_forma_pagamento_id']);
    
                }
 
                $data['ordem_servico_valor_total'] = trim(preg_replace('/\$/','', $ordem_servico_valor_total));
 
                $data = html_escape($data);
 
                $this->core_model->update('ordens_servicos', $data, ['ordem_servico_id' => $ordem_servico_id]);
 
                //deletando de ordem tem serviços os serviços antigos da ordem editada
                $this->ordem_servicos_model->delete_old_servicos($ordem_servico_id);
 
                $servico_id = $this->input->post('servico_id');
                $servico_quantidade = $this->input->post('servico_quantidade');
                $servico_desconto = str_replace('%','', $this->input->post('servico_desconto'));
                
                
                $servico_preco = str_replace('R$','', $this->input->post('servico_preco'));
                $servico_item_total = str_replace('R$','', $this->input->post('servico_item_total'));
                
                $servico_preco = str_replace(',', '', $servico_preco);
                $servico_item_total = str_replace(',','', $servico_item_total);
 
                $qty_servico = count($servico_id);
 
                $ordem_servico_id = $this->input->post('ordem_servico_id');
 
                for($i = 0; $i < $qty_servico; $i++){
 
                    $data = [
                        'ordem_ts_id_ordem_servico' => $ordem_servico_id,
                        'ordem_ts_id_servico' => $servico_id[$i],
                        'ordem_ts_quantidade' => $servico_quantidade[$i],
                        'ordem_ts_valor_unitario' => $servico_preco[$i],
                        'ordem_ts_valor_desconto' => $servico_desconto[$i],
                        'ordem_ts_valor_total' => $servico_item_total[$i],
                    ];
 
                    $data = html_escape($data);
 
                    $this->core_model->insert('ordem_tem_servicos', $data);
 
                }

                // criar recurso pdf
                redirect('os/imprimir/' .$ordem_servico_id);
               
 
            }else{
 
                $data = [
                    'titulo' => 'Atualizar ordem de serviço',
    
                    'styles' => ['vendor/select2/select2.min.css',
                                 'vendor/autocomplete/jquery-ui.css',
                                 'vendor/autocomplete/estilo.css'],
        
                    'scripts' => ['vendor/autocomplete/jquery-migrate.js', // 1°
                                  'vendor/calcx/jquery-calx-sample-2.2.8.min.js',
                                  'vendor/calcx/os.js', 
                                  'vendor/select2/select2.min.js',
                                  'vendor/select2/app.js',
                                  'vendor/sweetalert2/sweetalert2.js',
                                  'vendor/autocomplete/jquery-ui.js'], // ultimo na sequencia
        
                   'clientes' => $this->core_model->get_all('clientes', ['cliente_ativo' => 1]),
    
                   'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos', ['forma_pagamento_ativa' => 1]),
    
                   'os_tem_servicos' => $this->ordem_servicos_model->get_all_servicos_by_ordem($ordem_servico_id)
                ];
    
                $ordem_servico = $data['ordem_servico'] = $this->ordem_servicos_model->get_by_id($ordem_servico_id);

                $this->load->view('layout/header', $data);
                $this->load->view('ordem_servicos/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function del ($ordem_servico_id = NULL){

        if(!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id))){
            $this->session->set_flashdata('error', 'Ordem de serviço não encontrado');
            redirect('os');
            
          }

        if($this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id, 'ordem_servico_status'=> 0))){
            $this->session->set_flashdata('error', 'Não é possivel excluir uma ordem de serviço em aberto');
            redirect('os');
            
          }

        $this->core_model->delete('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id ));
        redirect('os');  

    }


    
    public function imprimir($ordem_servico_id = NULL){
        
        if(!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id))){
          $this->session->set_flashdata('error', 'Ordem de serviço não encontrado');
          redirect('os');
          
        }else{
        
          $data = array (
              
              'titulo' => 'Escolha uma opção',
              
              'ordem_servico' => $this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id)),
              
              
          );  
            
            
        
        $this->load->view('layout/header', $data);
        $this->load->view('Ordem_servicos/imprimir');
        $this->load->view('layout/footer');  
            
        }
        
        
    }
    
    public function pdf ($ordem_servico_id = NULL) {
        
        if(!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id))){
          $this->session->set_flashdata('error', 'Ordem de serviço não encontrado');
          redirect('os');
          
        }else{
            
           $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));
                   
//           echo '<pre>';
//           print_r($empresa);
//           exit();
           
           $ordem_servico = $this->ordem_servicos_model->get_by_id($ordem_servico_id);
           
//           echo '<pre>';
//           print_r($ordem_servico);
//           exit();
           
           $file_name = 'O.S&nbsp;'.$ordem_servico->ordem_servico_id;
           
           // inicio do HTML
           
           $html = '<html>';
           
           $html .= '<head>';
           
           $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Impressão de ordem de serviço</title>';
           
           
           $html .= '</head>';
           
           $html .= '<body style="font-size: 14px">';
           
           
           $html .= '<h4 align="center">   
                   '.$empresa->sistema_razao_social.'<br/>
                   '.'CNPJ: '.$empresa->sistema_cnpj.'<br/>
                   '.$empresa->sistema_endereco.',&nbsp;'.$empresa->sistema_numero.'<br/>
                   '.$empresa->sistema_cep.',&nbsp;'.$empresa->sistema_cidade.' - '.$empresa->sistema_estado.'<br/>
                   '.$empresa->sistema_email.',&nbsp;'.$empresa->sistema_telefone_fixo.'<br/>   
                   </h4>';
           
           $html .='<hr>';
           
           // dados do cliente
           
           $html .= '<p align="right" style="font-size: 12px" >O.S N°&nbsp;'.$ordem_servico->ordem_servico_id.'</p>';
           
           $html .= '<p>'
                   
                   
                   .'<strong>Cliente: </strong>'.$ordem_servico->cliente_nome_completo.'<br/>'
                   .'<strong>CPF / CNPJ: </strong>'.$ordem_servico->cliente_cpf_cnpj.'<br/>'
                   .'<strong>Celular: </strong>'.$ordem_servico->cliente_celular.'<br/>'
                   .'<strong>Data de emissão: </strong>'.formata_data_banco_com_hora($ordem_servico->ordem_servico_data_emissao).'<br/>'
                   .'<strong>Forma de pagamento: </strong>'.($ordem_servico->ordem_servico_status == 1 ? $ordem_servico->forma_pagamento : 'Em aberto' ).'<br/>'
                   .'</p>';
           
           
           $html .='<hr>';
           
           //DADOS DA ORDEM
           
           $html .='<table  width="100%" border: solid #ddd 1px>';
           
           $html .='<tr>';
           
           $html .='<th>Serviço</th>';
           $html .='<th>Quantidade</th>';
           $html .='<th>Valor unitário</th>';
           $html .='<th>Desconto</th>';
           $html .='<th>Valor Total</th>';
             
           $html .='</tr>';
                      
           $ordem_servico_id = $ordem_servico->ordem_servico_id;
           
           $servicos_ordem = $this->ordem_servicos_model->get_all_servicos($ordem_servico_id);
           
//           echo '<pre>';
//           print_r($servicos_ordem);
//           exit();
           
           $valor_final_os = $this->ordem_servicos_model->get_valor_final_os($ordem_servico_id);
           
//           echo '<pre>';
//           print_r($valor_final_os);
//           exit();
           
            foreach ($servicos_ordem as $servico):
                
                $html .= '<tr>';
                $html .= '<td>'.$servico->servico_nome.'</td>';
                $html .= '<td>'.$servico->ordem_ts_quantidade.'</td>';
                $html .= '<td>'.'R$&nbsp;' .$servico->ordem_ts_valor_unitario.'</td>';
                $html .= '<td>'. '%&nbsp;' .$servico->ordem_ts_valor_desconto.'</td>';
                $html .= '<td>'.'R$&nbsp;' .$servico->ordem_ts_valor_total.'</td>';
                $html .= '</tr>';
                
            endforeach;
            
            $html .='<th colspan="3">';
            
            $html .='<td style="border-top: solid #ddd 1px"><strong>Valor final</strong></td>';
            $html .='<td style="border-top: solid #ddd 1px">'.'R$&nbsp;' .$valor_final_os->os_valor_total.'</td>';
            
            $html .='</th>';
            
           $html .='</table>';
           

           $html .= '</body>';

           
           $html .= '</html>';
           
           
//           echo '<pre>';
//           print_r($html);
//           exit();
//           
           //false abre o PDF no navegador
           // true faz o download
            $this->pdf->createPDF($html, $file_name, false, 'A4');  
            
            
            //2 via
 
        }
        
    }

}

