<?php
    $errorMessage = (isset($_SESSION['adminerror'])) ? 
        'Dile que ocurrió el siguiente error: ' . $_SESSION['adminerror'] : 
        '';
    unset($_SESSION['adminerror']);
?>
<body class="bg-error-01">
        <!-- Begin Preloader -->
        <div id="preloader">
            <div class="canvas">
                <img src="<?php echo URL; ?>assets/admin/img/logo.png" alt="logo" class="loader-logo">
                <div class="spinner"></div>   
            </div>
        </div>
        <!-- End Preloader -->
        <!-- Begin Container -->
        <div class="container-fluid h-100 error-01">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12">
                    <!-- Begin Container -->
                    <div class="error-container mx-auto text-center">
                        <h1>404</h1>
                        <h2>Ehm... esto es embarazoso</h2>
                        <p>Es hora de que llames a tu marido.</p>
                        <h4><?php echo $errorMessage; ?></h4>
                        <a href="<?php echo URL . PAGE_ADMIN_HOME; ?>" class="btn btn-gradient-05 btn-square">
                            Volver
                        </a>
                    </div> 
                    <!-- End Container -->
                </div>
                <!-- End Col -->
            </div> 
            <!-- End Row -->