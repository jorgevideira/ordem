

<div class="main-wrapper main-wrapper-1">



    <?php $this->load->view('restrita/layout/navbar'); ?>



    <?php $this->load->view('restrita/layout/sidebar'); ?>



    <!-- Main Content -->
    <div class="main-content">



        <section class="section">
            <div class="section-body">

                <div class="row ">


                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="card-statistic-4">
                                <div class="align-items-center justify-content-between">
                                    <div class="row ">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                            <div class="card-content">
                                                <h5 class="font-15">Anúncios não auditados</h5>
                                                <h2 class="mb-3 font-24 badge badge-danger"><?php echo $anuncios_nao_auditados; ?></h2>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                            <div class="banner-img">
                                                <img style="height: 140px !important" src="<?php echo base_url('public/restrita/assets/img/banner/anuncios_nao_auditados.svg'); ?>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="card-statistic-4">
                                <div class="align-items-center justify-content-between">
                                    <div class="row ">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                            <div class="card-content">
                                                <h5 class="font-15"> Anúncios publicados</h5>
                                                <h2 class="mb-3 font-24 badge badge-primary"><?php echo $anuncios_publicados; ?></h2>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                            <div class="banner-img">
                                                <img src="<?php echo base_url('public/restrita/assets/img/banner/2.png'); ?>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="card-statistic-4">
                                <div class="align-items-center justify-content-between">
                                    <div class="row ">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                            <div class="card-content">
                                                <h5 class="font-15">Total de anunciantes</h5>
                                                <h2 class="mb-3 font-24 badge badge-dark"><?php echo $total_anunciantes; ?></h2>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                            <div class="banner-img">
                                                <img style="height: 140px !important" src="<?php echo base_url('public/restrita/assets/img/banner/total_anunciantes.svg'); ?>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="card-statistic-4">
                                <div class="align-items-center justify-content-between">
                                    <div class="row ">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                            <div class="card-content">
                                                <h5 class="font-15">Contas bloqueadas</h5>
                                                <h2 class="mb-3 font-24 badge badge-warning"><?php echo $contas_bloqueadas; ?></h2>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                            <div class="banner-img">
                                                <img style="height: 140px !important" src="<?php echo base_url('public/restrita/assets/img/banner/contas_bloqueadas.svg'); ?>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">


                    <div class="col-12 col-sm-12 col-lg-12">

                        <div class="card card-danger">
                            <div class="card-header">
                                <h4>Anunciantes</h4>
                                <div class="card-header-action">
                                    <a href="<?php echo base_url('restrita/usuarios'); ?>" class="btn btn-danger btn-icon icon-right">Ver todos <i
                                            class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="owl-carousel owl-theme" id="users-carousel">


                                    <?php foreach ($anunciantes as $anunciante): ?>


                                        <?php if (!$this->ion_auth->is_admin($anunciante->id)): ?>

                                            <div>

                                                <div class="user-item">
                                                    <img alt="image" style="width: 200px" src="<?php echo base_url('uploads/usuarios/small/' . $anunciante->user_foto); ?>" class="img-fluid mx-auto">
                                                    <div class="user-details">
                                                        <div class="user-name"><?php echo $anunciante->first_name . ' ' . $anunciante->last_name; ?></div>
                                                        <div class="text-job text-muted">Anunciante</div>
                                                        <div class="user-cta">
                                                            <button class="btn <?php echo ($anunciante->active == 1 ? 'btn-primary' : 'btn-danger'); ?> follow-btn"><?php echo ($anunciante->active == 1 ? 'Ativo' : 'Bloqueado'); ?></button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        <?php endif; ?>


                                    <?php endforeach; ?>


                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </section>


        <?php $this->load->view('restrita/layout/sidebar_configuracoes'); ?>


    </div>

