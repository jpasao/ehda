<div class="content-inner" id="ImageList">
    <div class="container-fluid">
        <!-- Begin Page Header-->
        <div class="row">
            <div class="page-header">
                <div class="d-flex align-items-center">
                    <h2 class="page-header-title">Lista de imágenes</h2>
                    <div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo URL; ?>admin/index"><i class="ti ti-home"></i></a></li>
                            <li class="breadcrumb-item active">Imágenes</li>
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
                        <div class="table-responsive">
                            <table id="list" class="display table mb-0 dataTable no-footer">
                                <thead>
                                    <tr>
                                        <th>Imagen</th>
                                        <th>Nombre</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($images as $image) { 
                                        $idImage = htmlspecialchars($image->id, ENT_QUOTES, 'UTF-8');
                                        $imageName = isset($image->name) ? htmlspecialchars($image->name, ENT_QUOTES, 'UTF-8') : '';   
                                        $imageFile = isset($image->filename) ? IMG_URL . htmlspecialchars($image->filename, ENT_QUOTES, 'UTF-8') : '#';
                                    ?>
                                        <tr>
                                            <td>
                                                <a  href="#"
                                                    class="btn imageOpener"
                                                    data-toggle="modal" 
                                                    data-target="#modalImg"
                                                    data-name="<?php echo $imageName; ?>"
                                                    data-filename="<?php echo $imageFile; ?>">
                                                    <img src="<?php echo $imageFile; ?>" class="imgTable">
                                                </button>
                                            </td>
                                            <td><?php echo $imageName; ?></td>
                                            <td class="td-actions actionColumn">
                                                <a href="<?php echo URL . PAGE_IMAGE_SAVE . $idImage; ?>"><i class="la la-edit edit"></i></a>
                                                <a id="<?php echo $idImage; ?>" 
                                                   data-api="<?php echo URL . API_IMAGE_DEL; ?>"
                                                   data-toggle="modal"
                                                   data-name="<?php echo $imageName; ?>"
                                                   data-target="#delModal"
                                                   href="#"
                                                   class="deleteElement"><i class="la la-close delete"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>                
        </div>
        <!-- End Row -->
    </div>
    <!-- End Container -->
    <a href="#" class="go-top"><i class="la la-arrow-up"></i></a>
    <!-- Image modal -->
    <div id="modalImg" class="modal fade" aria-hidden="true" style="display: none;" tabindex="-1" aria-labelledby="modalImg">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">                    
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">close</span>
                    </button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <img class="imgModal img-fluid" alt="" >
                </div>
                <div class="modal-footer">
                    <h4 class="modal-title"></h4>
                </div>
            </div>
        </div>
    </div>    
    <!-- End image modal -->
    <!-- Delete Modal -->
    <div id="delModal" class="modal modal-top" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Atención</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Se va a borrar la imagen <span id="elementId"></span></p>
                    <p>¿Está de acuerdo?</p>
                </div>
                <div class="modal-footer">
                    <a href="#" id="delButton" class="btn btn-gradient-05 btn-square">Aceptar</a>
                    <button type="button" class="btn btn-shadow btn-square" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete Modal -->    
</div>
<!-- End Content -->