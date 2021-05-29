<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<div id="preloader">
    <div id="status">
        <img src="<?php echo URL; ?>assets/img/loading.gif" alt="Cargando..." />
    </div>
</div>
<header id="home">
		<div class="main-navigation-1">
			<div class="container">
				<div class="row">
					<!-- logo-area-->
					<div class="col-xl-2 col-lg-3 col-md-3">
						<div class="logo-area">
							<a href="index.html"><img src="<?php echo URL; ?>assets/img/logo.png" alt="Logo EHDA"></a>
						</div>
					</div>
					<!-- mainmenu-area-->
					<div class="col-xl-10 col-lg-9 col-md-9">
						<div class="main-menu f-right">
							<nav id="mobile-menu">
								<ul>
									<li>
										<a class="current" href="<?php echo URL . HOME; ?>" id="inicio">Inicio</a>
									</li>
									<li>
										<a href="<?php echo URL . APPOINTMENT; ?>" id="citas">Citas</a>
									</li>
									<li>
										<a href="<?php echo URL . PRICES; ?>" id="precios">Precios</a>
									</li>
                                    <li>
										<a href="<?php echo URL . POSTS; ?>" id="articulos">Artículos</a>
									</li>
                                    <li>
										<a href="<?php echo URL . CONTACT; ?>" id="contacto">Contacto</a>
									</li>				
								</ul>
							</nav>
						</div>
						<!-- mobile menu-->
						<div class="mobile-menu"></div>
						<!--Search-->
						<div class="search-box-area">
							<div id="search" class="fade">
								<a href="#" class="close-btn" id="close-search">
									<em class="fa fa-times"></em>
								</a>
								<input placeholder="¿qué buscas?" id="searchbox" type="search" />
							</div>
							<div class="search-icon-area">
								<a href='#search'>
									<i class="fa fa-search"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>