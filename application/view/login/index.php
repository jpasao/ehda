<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>El Hilo de Ariadna - Login</title>
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
    <body class="bg-white">
        <!-- Begin Preloader -->
        <div id="preloader">
            <div class="canvas">
                <img src="<?php echo URL; ?>assets/admin/img/logo.png" alt="logo" class="loader-logo">
                <div class="spinner"></div>   
            </div>
        </div>
        <!-- End Preloader -->
        <!-- Begin Container -->
        <div class="container-fluid no-padding h-100">
            <div class="row flex-row h-100 bg-white">
                <!-- Begin Left Content -->
                <div class="col-xl-8 col-lg-6 col-md-5 no-padding">
                    <div class="elisyam-bg background-01">
                        <div class="elisyam-overlay overlay-01"></div>
                        <div class="authentication-col-content mx-auto">
                            <h1 class="gradient-text-01">
                                El Hilo de Ariadna
                            </h1>
                            <span class="description">
                                Gestión de contenidos. Sigue el hilo.
                            </span>
                        </div>
                    </div>
                </div>
                <!-- End Left Content -->
                <!-- Begin Right Content -->
                <div class="col-xl-4 col-lg-6 col-md-7 my-auto no-padding">
                    <!-- Begin Form -->
                    <div class="authentication-form mx-auto">
                        <div class="logo-centered">
                            <a href="db-default.html">
                                <img src="<?php echo URL; ?>assets/admin/img/logo.png" alt="logo">
                            </a>
                        </div>
                        <h3>Inicia sesión<nav></nav></h3>
                   
                        <div class="group material-input">
                            <input type="text" required id="user">
                            <label>Usuario</label>
                            <div class="invalid-feedback" id="userErr">
                                El usuario es obligatorio
                            </div>                                 
                        </div>
                        <div class="group material-input">
                            <input type="password" required id="pass">
                            <label>Contraseña</label>
                            <div class="invalid-feedback" id="passErr">
                                La contraseña es obligatoria
                            </div>                                
                        </div>
                     
                        <div class="sign-btn text-center">
                            <button class="btn btn-lg btn-gradient-05" id="submit">
                                Acceder
                            </button>
                        </div>                        
                        <div class="mt-5">
                            <div class="alert alert-primary alert-dissmissible fade hide" role="alert" id="errorMsg">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                <span></span>
                            </div>
                        </div>                        
                    </div>
                    <!-- End Form -->                                           
                </div>
                <!-- End Right Content -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Container -->  
        <script type="text/javascript" >
	    	var url = "<?php echo URL; ?>";
    	</script>           
        <!-- Begin Vendor Js -->
        <script src="<?php echo URL; ?>assets/admin/vendors/js/base/jquery.min.js"></script>        
        <script src="<?php echo URL; ?>assets/admin/vendors/js/base/core.min.js"></script>
        <!-- End Vendor Js -->
        <!-- Begin Page Vendor Js -->
        <script src="<?php echo URL; ?>assets/admin/vendors/js/nicescroll/nicescroll.min.js"></script>
        <script src="<?php echo URL; ?>assets/admin/vendors/js/app/app.min.js"></script>
        <!-- End Page Vendor Js -->
        <script src="<?php echo URL; ?>assets/js/app/config.js" type="text/javascript"></script>
        <script src="<?php echo URL; ?>assets/js/app/apiCall.js" type="text/javascript"></script>
        <script src="<?php echo URL; ?>assets/js/app/loginFunctions.js" type="text/javascript"></script>
        <script src="<?php echo URL; ?>assets/js/app/utils.js" type="text/javascript"></script>
    </body>
</html>