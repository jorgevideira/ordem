<header id="header-wrap">

    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-5 col-xs-12">

                    <?php $sistema = info_header_footer(); ?>

                    <ul class="list-inline">
                        <li><i class="lni-phone"></i> <?php echo $sistema->sistema_telefone_fixo; ?></li>
                        <li><i class="lni-envelope"></i> <?php echo $sistema->sistema_email; ?></li>
                    </ul>

                </div>
                <div class="col-lg-5 col-md-7 col-xs-12">

                    <div class="header-top-right float-right">

                        <?php $logado = $this->ion_auth->logged_in(); ?>

                        <?php if (!$logado): ?>

                            <a href="<?php echo base_url('login'); ?>" class="header-top-button"><i class="lni-lock"></i> Entrar</a> 

                        <?php else: ?>


                            <?php $anunciante = $this->ion_auth->user()->row(); ?>

                            <a title="Olá <?php echo $anunciante->first_name ?>, gerencie a sua conta" href="<?php echo base_url('conta'); ?>" class="header-top-button"><img class="rounded-circle" width="30" src="<?php echo base_url('uploads/usuarios/small/' . $anunciante->user_foto); ?>"> Minha conta</a> |

                            <a href="<?php echo base_url('login/logout'); ?>" class="header-top-button"><i class="lni lni-exit"></i> Sair</a>

                        <?php endif; ?>


                    </div>
                </div>
            </div>
        </div>
    </div>


    <nav class="navbar navbar-expand-lg bg-white fixed-top scrolling-navbar">
        <div class="container">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    <span class="lni-menu"></span>
                    <span class="lni-menu"></span>
                    <span class="lni-menu"></span>
                </button>
                <a href="<?php echo base_url('/'); ?>" class="navbar-brand"><img src="<?php echo base_url('public/web/assets/img/logo.png'); ?>" alt=""></a>
            </div>
            <div class="collapse navbar-collapse" id="main-navbar">
                <ul class="navbar-nav mr-auto w-100 justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('/'); ?>">
                            Home
                        </a>
                    </li>


                    <?php $categorias = categorias_filhas_navbar(); ?>

                    <?php foreach ($categorias as $categoria): ?>

                        <li class="nav-item">
                            <a title="<?php echo $categoria->categoria_nome; ?>" class="nav-link" href="<?php echo base_url('busca/categoria/' . $categoria->categoria_meta_link); ?>">
                                <?php echo word_limiter($categoria->categoria_nome, 1); ?>
                            </a>
                        </li>

                    <?php endforeach; ?>

                </ul>
                <div class="post-btn">
                    <a class="btn btn-common" href="<?php echo base_url('conta'); ?>"><i class="lni-pencil-alt"></i> Anunciar</a>
                </div>
            </div>
        </div>

        <ul class="mobile-menu">
            <li>
                <a href="<?php echo base_url('/'); ?>">
                    Home
                </a>
            </li>

            <?php $categorias = categorias_filhas_navbar(); ?>

            <?php foreach ($categorias as $categoria): ?>

                <li>
                    <a title="<?php echo $categoria->categoria_nome; ?>" class="nav-link" href="<?php echo base_url('busca/categoria/' . $categoria->categoria_meta_link); ?>">
                        <?php echo $categoria->categoria_nome; ?>
                    </a>
                </li>

            <?php endforeach; ?>

            <li>

                <?php if (!$logado): ?>

                    <a href="<?php echo base_url('login'); ?>" class="header-top-button"><i class="lni-lock"></i> Entrar</a> 

                <?php else: ?>


                    <?php $anunciante = $this->ion_auth->user()->row(); ?>

                    <a title="Olá <?php echo $anunciante->first_name ?>, gerencie a sua conta" href="<?php echo base_url('conta'); ?>" class="header-top-button"><img class="rounded-circle" width="30" src="<?php echo base_url('uploads/usuarios/small/' . $anunciante->user_foto); ?>"> Minha conta</a>
                    <a href="<?php echo base_url('login/logout'); ?>" class="header-top-button"><i class="lni lni-exit"></i> Sair</a>

                <?php endif; ?>

            </li>
        </ul>

    </nav>


    <div id="hero-area">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 text-center">
                    <div class="contents-ctg">
                        <div class="search-bar">
                            <div class="search-inner ui-widget">
                                <form class="search-form" method="post" action="<?php echo base_url('busca'); ?>">
                                    <div class="form-group inputwithicon" style="width: 70%">
                                        <input type="text" id="busca" name="busca" class="form-control" placeholder="Qual produto está procurando?">
                                    </div>

                                    <button class="btn btn-common" type="submit"><i class="lni-search"></i> Pesquisar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>