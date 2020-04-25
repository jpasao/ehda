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
                            <a href="<?php echo URL . PAGE_ADMIN_HOME; ?>" class="navbar-brand">
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
                                    <li><a href="<?php echo URL . PAGE_POST_LIST; ?>" id="subSectionPostList">Listado</a></li>
                                    <li><a href="<?php echo URL . PAGE_POST_SAVE . NEWNODE; ?>" id="subSectionPostAdd">Añadir entrada</a></li>
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
                                    <li><a href="<?php echo URL . PAGE_IMAGE_LIST; ?>"  id="subSectionImageList">Listado</a></li>
                                    <li><a href="<?php echo URL . PAGE_IMAGE_SAVE . NEWNODE; ?>" id="subSectionImageAdd">Guardar imagen</a></li>
                                </ul>                                
                            </li>
                            <li>
                                <a href="#dropdown-calendar" aria-expanded="false" data-toggle="collapse" id="sectionCalendar">
                                    <i class="la la-calendar"></i><span>Calendario</span>
                                </a>
                                <ul id="dropdown-calendar" class="collapse list-unstyled pt-0">
                                    <li><a href="<?php echo URL . PAGE_SPAREDATE_SAVE; ?>" id="subSectionCalendar">Añadir días ocupados</a></li>                                    
                                </ul>                                
                            </li>
                        </ul>                        
                        <ul class="list-unstyled">
                            <li><a href="<?php echo URL . APPOINTMENT; ?>" target="_blank"><i class="la la-angle-left"></i><span>Volver a la aplicación</span><i class="la la-external-link super"></i></a></li>
                        </ul>
                        <!-- End Main Navigation -->
                    </nav>
                    <!-- End Side Navbar -->
                </div>
                <!-- End Left Sidebar -->