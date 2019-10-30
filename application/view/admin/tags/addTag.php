<?php 
    $idValue = 0;
    $nameValue = '';
    if ($tag != null) {
        $idValue = htmlspecialchars($tag->id, ENT_QUOTES, 'UTF-8'); 
        $nameValue = htmlspecialchars($tag->name, ENT_QUOTES, 'UTF-8'); 
    }
?>
<div class="content-inner" id="TagAdd">
    <div class="container-fluid">
        <!-- Begin Page Header-->
        <div class="row">
            <div class="page-header">
                <div class="d-flex align-items-center">
                    <h2 class="page-header-title"><?php echo $literal; ?> etiqueta</h2>
                    <div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo URL; ?>admin/index"><i class="ti ti-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo URL . PAGE_TAG_LIST; ?>">Etiquetas</a></li>
                            <li class="breadcrumb-item active">Nueva etiqueta</li>
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
                        <form class="needs-validation" novalidate action="<?php echo URL . API_TAG_SAVE; ?>" method="POST">
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Nombre</label>
                                <div class="col-lg-5">
                                    <input type="hidden" 
                                           name="id" 
                                           value="<?php echo $idValue; ?>" />
                                    <input type="text" 
                                           name="name" 
                                           class="form-control" 
                                           placeholder="Nombre de la etiqueta" 
                                           required
                                           value="<?php echo $nameValue; ?>">
                                    <div class="invalid-feedback">
                                        Es necesario indicar el nombre
                                    </div>                                    
                                </div>
                            </div> 
                            <div class="text-right">
                                <button class="btn btn-lg btn-gradient-05 btn-square" type="submit" name="save">Guardar</button>
                                <button class="btn btn-shadow btn-square" type="reset">Limpiar</button>
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