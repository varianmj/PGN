<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PGN - <?php echo getLevel() == 'admin' ? 'Administrator' : 'Member' ?></title>

    <!-- Favicons -->
    <!-- <link rel="icon" type="image/png" href="<?php echo base_url('assets/admin/img/logo.png') ?>"> -->

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/css/bootstrap-icons.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/css/sweetalert2.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/css/boxicons.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/css/remixicon.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/css/datatables.bootstrap5.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/css/simple-datatables.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/css/fileinput.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/css/select2.min.css') ?>">

    <!-- Main CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/css/style.css') ?>">

    <script type="text/javascript" src="<?php echo base_url('assets/admin/js/jquery.min.js') ?>"></script>
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="<?php echo base_url('admin') ?>" class="logo d-flex align-items-center">
                <span class="d-none d-lg-block">PGN</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-original-title="Keluar">
                    <a class="nav-link nav-icon" href="<?php echo base_url(getLevel().'/logout') ?>">
                        <i class="bi bi-power"></i>
                    </a>
                </li>

                <li class="nav-item dropdown pe-3">
                    <?php $nama = getLevel() == 'admin' ? $_SESSION['admin']['user_fullname'] : "admin" ?>
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="<?php echo base_url('assets/admin/img/' . (!empty($_SESSION['admin']['user_image_url']) ? $_SESSION['admin']['user_image_url'] : 'profile-placeholder.jpg')); ?>"
                            alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $nama ?></span>
                    </a><!-- End Profile Image Icon -->
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?php echo $nama ?></h6>
                            <span><?php echo getLevel() == 'admin' ? 'Administrator' : 'Admin' ?></span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center"
                                href="<?php echo base_url(getLevel().'/profil') ?>">
                                <i class="bi bi-person"></i>
                                <span>Profil Saya</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center"
                                href="<?php echo base_url(getLevel().'/logout') ?>">
                                <i class="bi bi-box-arrow-right"></i></i>
                                <span>Keluar</span>
                            </a>
                        </li>
                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->
            </ul>
        </nav><!-- End Icons Navigation -->
    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link <?php echo $this->uri->segment(2) == 'dashboard' ? '' : 'collapsed' ?>"
                    href="<?php echo base_url(getLevel().'/dashboard') ?>">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <?php if ($_SESSION['admin']['user_role'] == 'Superadmin'): ?>

            <li class="nav-heading mt-4">Master</li>

            <li class="nav-item">
                <a class="nav-link <?php echo $this->uri->segment(2) == 'master' ? '' : 'collapsed' ?>"
                    data-bs-target="#master" data-bs-toggle="collapse" href="#"
                    aria-expanded="<?php echo $this->uri->segment(2) == 'master' ? 'true' : 'false' ?>">
                    <i class="bi bi-database-fill"></i><span>Data Master</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="master"
                    class="nav-content collapse <?php echo $this->uri->segment(2) == 'master' ? 'show' : '' ?>"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="<?php echo base_url('admin/master/user') ?>"
                            <?php echo $this->uri->uri_string() == getLevel().'/master/user' ? 'class="active"' : '' ?>>
                            <i class="bi bi-circle"></i><span>Pelanggan</span>
                        </a>
                    </li>
					<li>
                        <a href="<?php echo base_url('admin/master/pemakaian') ?>"
                            <?php echo $this->uri->uri_string() == getLevel().'/master/pemakaian' ? 'class="active"' : '' ?>>
                            <i class="bi bi-circle"></i><span>Pemakaian</span>
                        </a>
                    </li>
                </ul>
            </li>

            <?php else: ?>
			<li class="nav-item">
                <a class="nav-link <?php echo $this->uri->segment(2) == 'master' ? '' : 'collapsed' ?>"
                    data-bs-target="#master" data-bs-toggle="collapse" href="#"
                    aria-expanded="<?php echo $this->uri->segment(2) == 'master' ? 'true' : 'false' ?>">
                    <i class="bi bi-database-fill"></i><span>Data Master</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="master"
                    class="nav-content collapse <?php echo $this->uri->segment(2) == 'master' ? 'show' : '' ?>"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="<?php echo base_url('admin/master/pemakaian') ?>"
                            <?php echo $this->uri->uri_string() == getLevel().'/master/pemakaian' ? 'class="active"' : '' ?>>
                            <i class="bi bi-circle"></i><span>Pemakaian</span>
                        </a>
                    </li>
                </ul>
            </li>
            <?php endif ?>
        </ul>
    </aside>

    <!-- ======= Content ======= -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1><?php echo getLevel() == 'admin' ? 'Administrator' : '' ?></h1>
            <?php if (isset($breadcrumbs) && !empty($breadcrumbs)): ?>
            <nav aria-label="breadcrumb">
                <?php echo $breadcrumbs ?>
            </nav>
            <?php endif ?>
        </div><!-- End Page Title -->

        <section class="main-section">
