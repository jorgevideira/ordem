

  <?php $this->load->view('layout/sidebar') ?>

   

      <!-- Main Content -->
      <div id="content">

  <?php $this->load->view('layout/navbar') ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

    <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url('os'); ?>">Ordem de serviços</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>
  </ol>
    </nav>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">

            <div class="card-body">
                
                <div class="row"> 
                    
                    <div class="col-md-4">
  
                  <a href="<?php echo base_url('os/pdf'); ?>" class="btn btn-dark btn-icon-split btn-lg">
                    <span class="icon text-white-50">
                      <i class="fas fa-print"></i>
                    </span>
                    <span class="text">Imprimir Ordem de Serviço</span>
                  </a>
     
                   </div>
                    
                    
                    <div class="col-md-4">
  
                  <a href="<?php echo base_url('os/add'); ?>" class="btn btn-success btn-icon-split btn-lg">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Nova Ordem de Serviço</span>
                  </a>
     
                   </div>
                    
                    <div class="col-md-4">
  
                  <a href="<?php echo base_url('os'); ?>" class="btn btn-info btn-icon-split btn-lg">
                    <span class="icon text-white-50">
                      <i class="fas fa-list-ol"></i>
                    </span>
                    <span class="text">Listar Ordem de Serviço</span>
                  </a>
     
                   </div>


           </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

     

