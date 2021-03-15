<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand">Kapuas Mas Mandiri</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
    <!-- Navbar-->
    <ul class="navbar-nav d-none d-md-inline-block ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?php echo base_url('login/logout') ?>">Logout</a>
            </div>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <a class="nav-link 
                            <?php if ($this->uri->segment(2) == '') {
                                echo 'active';
                            }
                            ?>" href="<?php echo base_url('admin') ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link collapse <?php
                                                    if ($this->uri->segment(2) == 'pengirim' || $this->uri->segment(2) == 'penerima' || $this->uri->segment(2) == 'orderbill') {
                                                        echo 'active';
                                                    }
                                                    ?>" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-database"></i></div>
                        Data
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="<?php echo base_url('admin/orderbill') ?>">Data Order Bill</a>
                            <a class="nav-link" href="<?php echo base_url('admin/pengirim') ?>">Data Pengirim</a>
                            <a class="nav-link" href="<?php echo base_url('admin/penerima') ?>">Data Penerima</a>
                        </nav>
                        <!-- </div> -->
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Masuk sebagai:</div>
                    <?php
                    echo $this->session->userdata('nama');
                    ?>
                </div>
                <div class="navbar-nav container sb-sidenav-footer">
                    <a href="<?php echo base_url('admin/logout') ?>" class="btn btn-danger">Logout</a>
                </div>
        </nav>
    </div>