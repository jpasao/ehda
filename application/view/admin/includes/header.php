<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>El Hilo de Ariadna - Gestión de entradas</title>
        <meta name="description" content="El Hilo de Ariadna. Gestión de contenidos">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Google Fonts -->
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
        <script>
          WebFont.load({
            google: {"families":["Montserrat:400,500,600,700","Noto+Sans:400,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>
        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo URL; ?>assets/admin/img/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo URL; ?>assets/admin/img/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo URL; ?>assets/admin/img/favicon-16x16.png">
        <!-- Stylesheet -->
        <link rel="stylesheet" href="<?php echo URL; ?>assets/admin/vendors/css/base/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo URL; ?>assets/admin/vendors/css/base/elisyam-1.5.min.css">
        <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    </head>
    <body id="page-top">
        <!-- Begin Preloader -->
        <div id="preloader">
            <div class="canvas">
                <img src="<?php echo URL; ?>assets/admin/img/logo.png" alt="logo" class="loader-logo">
                <div class="spinner"></div>   
            </div>
        </div>
        <!-- End Preloader -->
        <div class="page">
            <!-- Begin Header -->
            <header class="header">
                <nav class="navbar fixed-top">         
                    <!-- Begin Search Box-->
                    <div class="search-box">
                        <button class="dismiss"><i class="ion-close-round"></i></button>
                        <form id="searchForm" action="#" role="search">
                            <input type="search" placeholder="Search something ..." class="form-control">
                        </form>
                    </div>
                    <!-- End Search Box-->
                    <!-- Begin Topbar -->
                    <div class="navbar-holder d-flex align-items-center align-middle justify-content-between">
                        <!-- Begin Logo -->
                        <div class="navbar-header">
                            <a href="db-default.html" class="navbar-brand">
                                <div class="brand-image brand-big">
                                    <img src="<?php echo URL; ?>assets/admin/img/logo-big.png" alt="logo" class="logo-big">
                                </div>
                                <div class="brand-image brand-small">
                                    <img src="<?php echo URL; ?>assets/admin/img/logo.png" alt="logo" class="logo-small">
                                </div>
                            </a>
                            <!-- Toggle Button -->
                            <a id="toggle-btn" href="#" class="menu-btn active">
                                <span></span>
                                <span></span>
                                <span></span>
                            </a>
                            <!-- End Toggle -->
                        </div>
                        <!-- End Logo -->
                        <!-- Begin Navbar Menu -->
                        <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center pull-right">
                            <!-- Search -->
                            <li class="nav-item d-flex align-items-center"><a id="search" href="#"><i class="la la-search"></i></a></li>
                            <!-- End Search -->
                            <!-- User -->
                            <li class="nav-item dropdown"><a id="user" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><img src="<?php echo URL; ?>assets/admin/img/avatar/avatar-01.jpg" alt="..." class="avatar rounded-circle"></a>
                                <ul aria-labelledby="user" class="user-size dropdown-menu">
                                    <li class="welcome">
                                        <a href="#" class="edit-profil"><i class="la la-gear"></i></a>
                                        <img src="<?php echo URL; ?>assets/admin/img/avatar/avatar-01.jpg" alt="..." class="rounded-circle">
                                    </li>
                                    <li>
                                        <a href="pages-profile.html" class="dropdown-item"> 
                                            Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="app-mail.html" class="dropdown-item"> 
                                            Messages
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="dropdown-item no-padding-bottom"> 
                                            Settings
                                        </a>
                                    </li>
                                    <li class="separator"></li>
                                    <li>
                                        <a href="pages-faq.html" class="dropdown-item no-padding-top"> 
                                            Faq
                                        </a>
                                    </li>
                                    <li><a rel="nofollow" href="pages-login.html" class="dropdown-item logout text-center"><i class="ti-power-off"></i></a></li>
                                </ul>
                            </li>
                            <!-- End User -->
                        </ul>
                        <!-- End Navbar Menu -->
                    </div>
                    <!-- End Topbar -->
                </nav>
            </header>
            <!-- End Header -->
            <!-- Begin Page Content -->
            <div class="page-content d-flex align-items-stretch">
                <div class="default-sidebar">
                    <!-- Begin Side Navbar -->
                    <nav class="side-navbar box-scroll sidebar-scroll">
                        <!-- Begin Main Navigation -->
                        <ul class="list-unstyled">
                            <li><a href="javascript:void(0);"><i class="la la-at"></i><span>Simple Link</span></a></li>
                            <li><a href="#dropdown" aria-expanded="false" data-toggle="collapse"><i class="la la-puzzle-piece"></i><span>Dropdown</span></a>
                                <ul id="dropdown" class="collapse list-unstyled pt-0">
                                    <li><a href="javascript:void(0);">Link</a></li>
                                </ul>
                            </li>
                        </ul>
                        <span class="heading">Title</span>
                        <ul class="list-unstyled">
                            <li class="active"><a href="#dropdown-db" aria-expanded="true" data-toggle="collapse"><i class="la la-columns"></i><span>Active</span></a>
                                <ul id="dropdown-db" class="collapse list-unstyled show pt-0">
                                    <li><a class="active" href="javascript:void(0);">Active</a></li>
                                    <li><a href="javascript:void(0);">Link</a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="list-unstyled">
                            <li><a href="db-all.html"><i class="la la-angle-left"></i><span>Back To Elisyam</span></a></li>
                        </ul>
                        <!-- End Main Navigation -->
                    </nav>
                    <!-- End Side Navbar -->
                </div>
                <!-- End Left Sidebar -->