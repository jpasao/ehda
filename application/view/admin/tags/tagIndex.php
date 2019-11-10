<div class="content-inner" id="TagList">
    <div class="container-fluid">
        <!-- Begin Page Header-->
        <div class="row">
            <div class="page-header">
                <div class="d-flex align-items-center">
                    <h2 class="page-header-title">Lista de etiquetas</h2>
                    <div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo URL; ?>admin/index"><i class="ti ti-home"></i></a></li>
                            <li class="breadcrumb-item active">Etiquetas</li>
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
                                        <th>Nombre</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tags as $tag) { 
                                        $idTag = htmlspecialchars($tag->id, ENT_QUOTES, 'UTF-8');
                                        $tagName = isset($tag->name) ? htmlspecialchars($tag->name, ENT_QUOTES, 'UTF-8') : '';   
                                    ?>
                                        <tr>
                                            <td><?php echo $tagName; ?></td>
                                            <td class="td-actions actionColumn">
                                                <a href="<?php echo URL . PAGE_TAG_SAVE . $idTag; ?>"><i class="la la-edit edit"></i></a>
                                                <a id="<?php echo $idTag; ?>" 
                                                   data-api="<?php echo URL . API_TAG_DEL; ?>" 
                                                   data-toggle="modal"
                                                   data-name="<?php echo $tagName; ?>" 
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
</div>
<!-- End Content -->
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
                <p>Se va a borrar el registro <span id="elementId"></span></p>
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