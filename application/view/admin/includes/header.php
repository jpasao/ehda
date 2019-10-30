<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>El Hilo de Ariadna - Gestión de contenidos</title>
        <meta name="description" content="El Hilo de Ariadna. Gestión de contenidos">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Google Fonts -->
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
        <script>
          WebFont.load({
            google: {"families":["Montserrat:400,500,600,700","Noto+Sans:400,700"]},
            active: function() { sessionStorage.fonts = true; }
          });
        </script>
        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo URL; ?>assets/admin/img/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo URL; ?>assets/admin/img/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo URL; ?>assets/admin/img/favicon-16x16.png">
        <!-- Stylesheet -->
        <link rel="stylesheet" href="<?php echo URL; ?>assets/admin/vendors/css/base/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo URL; ?>assets/admin/vendors/css/base/elisyam-1.5.min.css">
        <link rel="stylesheet" href="<?php echo URL; ?>assets/admin/vendors/css/datatables.min.css">
        <link rel="stylesheet" href="<?php echo URL; ?>assets/css/custom.css">
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
                            <input type="search" placeholder="Escribe algo..." class="form-control">
                        </form>
                    </div>
                    <!-- End Search Box-->
                    <!-- Begin Topbar -->
                    <div class="navbar-holder d-flex align-items-center align-middle justify-content-between">
                        <!-- Begin Logo -->
                        <div class="navbar-header">
                            <a href="<?php echo URL; ?>admin/index" class="navbar-brand">
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
                            <!-- <li class="nav-item d-flex align-items-center"><a id="search" href="#"><i class="la la-search"></i></a></li> -->
                            <!-- End Search -->
                            <!-- User -->
                            <li class="nav-item dropdown">
                                <button rel="nofollow" id="logout" class="dropdown-item logout text-center">
                                    <i class="ti-power-off" title="Cerrar sesión <?php echo $userName; ?>"></i>
                                </button>
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
                        <span class="heading">Secciones</span>
                        <ul class="list-unstyled" id="sections">
                            <li>
                                <a href="#dropdown-posts" aria-expanded="false" data-toggle="collapse" id="sectionPosts">
                                    <i class="la la-align-left"></i><span>Entradas</span>
                                </a>
                                <ul id="dropdown-posts" class="collapse list-unstyled pt-0">
                                    <li><a href="<?php echo URL; ?>admin/posts" id="subSectionPostList">Listado</a></li>
                                    <li><a href="<?php echo URL; ?>admin/nuevoPost" id="subSectionPostAdd">Añadir entrada</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#dropdown-tags" aria-expanded="false" data-toggle="collapse" id="sectionTags">
                                    <i class="la la-tag"></i><span>Etiquetas</span>
                                </a>
                                <ul id="dropdown-tags" class="collapse list-unstyled pt-0">
                                    <li><a href="<?php echo URL . PAGE_TAG_LIST; ?>" id="subSectionTagList">Listado</a></li>
                                    <li><a href="<?php echo URL . PAGE_TAG_SAVE . NEWNODE; ?>" id="subSectionTagAdd">Guardar etiqueta</a></li>
                                </ul>
                            </li>                            
                            <li>
                                <a href="#dropdown-images" aria-expanded="false" data-toggle="collapse" id="sectionImages">
                                    <i class="la la-image"></i><span>Imágenes</span>
                                </a>                                
                                <ul id="dropdown-images" class="collapse list-unstyled pt-0">
                                    <li><a href="<?php echo URL; ?>admin/imagenes"  id="subSectionImageList">Listado</a></li>
                                    <li><a href="<?php echo URL; ?>admin/nuevaImagen" id="subSectionImageAdd">Añadir imagen</a></li>
                                </ul>                                
                            </li>
                            <li>
                                <a href="#dropdown-calendar" aria-expanded="false" data-toggle="collapse" id="sectionCalendar">
                                    <i class="la la-calendar"></i><span>Calendario</span>
                                </a>
                                <ul id="dropdown-calendar" class="collapse list-unstyled pt-0">
                                    <li><a href="<?php echo URL; ?>admin/diasLibresCalendario"  id="subSectionCalendar">Añadir días ocupados</a></li>                                    
                                </ul>                                
                            </li>
                        </ul>                        
                        <ul class="list-unstyled">
                            <li><a href="<?php echo URL; ?>"><i class="la la-angle-left"></i><span>Volver a la aplicación</span></a></li>
                        </ul>
                        <!-- End Main Navigation -->
                    </nav>
                    <!-- End Side Navbar -->
                </div>
                <!-- End Left Sidebar -->