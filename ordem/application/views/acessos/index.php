

  <?php $this->load->view('layout/sidebar') ?>
 
   

      <!-- Main Content -->
      <div id="content">

  <?php $this->load->view('layout/navbar') ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

    <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url('acessos'); ?>">Acessos</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>
  </ol>
    </nav>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">

            <div class="card-body">
                
                <form class="user" method="POST" name="form_edit">
                    
            
        <fieldset class="mt-4 border p-2">
                        
                        <legend class="font-small"><i class="fas fa-product-hunt">&nbsp;Acessos</i> </legend>
                        
                
                <div class="col-md-3 mb-3">
                    <label> Usuário </label>
                    <select class="custom-select" name="user_id">
                       <?php foreach ($Usuarios as $username): ?>
                        <option value="<?php echo $username->usuario_id ?>"</option>
                        <?php endforeach;?>
                    </select>

                    

                    <div class="col-sm-6 mb-1 mb-sm-0">
                                    <label class="small my-0">Escolha o cliente <span class="text-danger">*</span></label>
                                    <select class="custom-select contas_receber" name="ordem_servico_cliente_id" required="">
                                        <?php foreach ($clientes as $cliente): ?>
                                            <option value="<?php echo $cliente->cliente_id; ?>" <?php echo ($cliente->cliente_id == $ordem_servico->ordem_servico_cliente_id ? 'selected' : '') ?> ><?php echo $cliente->cliente_nome . ' ' . $cliente->cliente_sobrenome . ' | CPF ou CNPJ: ' . $cliente->cliente_cpf_cnpj; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php echo form_error('ordem_servico_cliente_id', '<div class="text-danger small">', '</div>') ?>
                    </div>
                
                </div>
                

                
               
                
            </div> 
                        
            

            <button type="submit" class="btn btn-primary btn-sm mt-4">Salvar</button> 
            <a title="Voltar" href="<?php echo base_url('/'); ?>" class="btn btn-success btn-sm ml-2 mt-4">Voltar</a>
          </form>

           </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

     

