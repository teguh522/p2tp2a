<div id="wrapper">

    <nav class="navbar top-navbar">
        <div class="container-fluid">

            <div class="navbar-left">
                <div class="navbar-btn">
                    <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
                </div>
            </div>

            <div class="navbar-right">
                <div id="navbar-menu">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo base_url() ?>auth/logout" class="icon-menu"><i class="icon-power"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="progress-container">
            <div class="progress-bar" id="myBar"></div>
        </div>
    </nav>


    <div id="left-sidebar" class="sidebar">
        <div class="navbar-brand">
            <a href="<?php echo base_url() ?>dashboard"><span>P2TP2A Kab. Cirebon</span></a>
            <button type="button" class="btn-toggle-offcanvas btn btn-sm float-right"><i class="lnr lnr-menu icon-close"></i></button>
        </div>
        <div class="sidebar-scroll">
            <div class="user-account">
                <div class="user_div">
                    <img src="
                 <?php if (isset($data)) {
                        echo base_url('upload/foto/' . $data->foto);
                    } else {
                        echo base_url('upload/foto/user.png');
                    }
                    ?>" class="user-photo" alt="User Profile Picture">
                </div>
                <div class="dropdown">
                    <span>Selamat Datang,</span>
                    <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown">
                        <strong>
                            <?php
                            if (isset($data)) {
                                echo $data->nama;
                            } else if ($this->session->userdata('level') == 'user') {
                                echo "-";
                            } else {
                                echo "Administrator";
                            } ?>
                        </strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right account vivify flipInY">
                        <li><a href="<?php echo base_url('auth/update_password') ?>"><i class="icon-user"></i>Setting</a></li>
                    </ul>
                </div>
            </div>
            <nav id="left-sidebar-nav" class="sidebar-nav">
                <ul id="main-menu" class="metismenu">
                    <li class="header">Main</li>
                    <?php if ($this->session->userdata('level') == 'user') { ?>
                        <li><a href="<?php echo base_url() ?>pengaduan"><i class="icon-notebook"></i><span>Pengaduan</span></a></li>
                    <?php } else { ?>
                        <li><a href="<?php echo base_url() ?>admin"><i class="icon-home"></i><span>Dashboard</span></a></li>
                        <li><a href="<?php echo base_url() ?>admin/pengaduan"><i class="icon-notebook"></i><span>Pengaduan</span></a></li>
                        <li><a href="<?php echo base_url() ?>admin/table"><i class="icon-list"></i><span>Tabel Rekap</span></a></li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </div>
    <div class="overlay"></div>