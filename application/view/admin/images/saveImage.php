<?php 
    $idValue = 0;
    $nameValue = '';
    $filenameValue = '';
    
    if ($image != null) {
        $idValue = htmlspecialchars($image->id, ENT_QUOTES, 'UTF-8'); 
        $nameValue = htmlspecialchars($image->name, ENT_QUOTES, 'UTF-8'); 
        $filenameValue = IMG_URL . htmlspecialchars($image->filename, ENT_QUOTES, 'UTF-8'); 
    }
?>
<div class="content-inner" id="ImageAdd">
    <div class="container-fluid">
        <!-- Begin Page Header-->
        <div class="row">
            <div class="page-header">
                <div class="d-flex align-items-center">
                    <h2 class="page-header-title"><?php echo $literal; ?> imagen</h2>
                    <div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo URL . PAGE_ADMIN_HOME; ?>"><i class="ti ti-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo URL . PAGE_IMAGE_LIST; ?>">Imágenes</a></li>
                            <li class="breadcrumb-item active"><?php echo $literal; ?> imagen</li>
                        </ul>
                    </div>	                            
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <!-- Begin Row -->
        <div class="row flex-row">
            <div class="col-xl-12 col-12">
                <div class="widget has-shadow">
                    <div class="widget-body">
                        <form class="needs-validation" novalidate action="<?php echo URL . API_IMAGE_SAVE; ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Nombre</label>
                                <div class="col-lg-7">
                                    <input type="hidden" name="id" value="<?php echo $idValue; ?>" />                        
                                    <input type="text" 
                                            name="name" 
                                            class="form-control" 
                                            placeholder="Nombre para la imagen" 
                                            required
                                            value="<?php echo $nameValue; ?>">
                                    <div class="invalid-feedback">
                                        Es necesario indicar el nombre de la imagen
                                    </div> 
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Nombre del archivo</label>
                                <div class="col-lg-7">
                                <input type="text" 
                                            name="filenamevalue" 
                                            class="form-control"                                              
                                            disabled
                                            value="<?php echo $filenameValue; ?>">                                        
                                </div>                              
                            </div>                             
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Imagen</label>
                                <div class="col-lg-7">
                                    <input type="file"                                             
                                            name="filename" 
                                            class="form-control"    
                                            lang="es">                                         
                                </div>                              
                            </div>  
                            <div class="text-right">
                                <button class="btn btn-lg btn-gradient-05 btn-square" type="submit" name="save">Guardar</button>
                            </div>                                                       
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
    </div>
    <!-- End Container -->
    <a href="#" class="go-top"><i class="la la-arrow-up"></i></a>
</div>
<!-- End Content -->