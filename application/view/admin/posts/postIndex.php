<div class="content-inner" id="PostList">
    <div class="container-fluid">
        <!-- Begin Page Header-->
        <div class="row">
            <div class="page-header">
                <div class="d-flex align-items-center">
                    <h2 class="page-header-title">Lista de entradas</h2>
                    <div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo URL . PAGE_ADMIN_HOME; ?>"><i class="ti ti-home"></i></a></li>
                            <li class="breadcrumb-item active">Entradas</li>
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
                                        <th>Título</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>  
                                <tbody>
                                    <?php foreach ($posts as $post) {
                                        $idPost = htmlspecialchars($post->id, ENT_QUOTES, 'UTF-8');
                                        $postTitle = isset($post->title) ? htmlspecialchars($post->title, ENT_QUOTES, 'UTF-8') : '';                                                                                                                 
                                    ?>
                                        <tr>
                                            <td><?php echo $postTitle; ?></td>
                                            <td class="td-actions actionColumn">
                                                <a href="<?php echo URL . PAGE_POST_SAVE . $idPost; ?>"><i class="la la-edit edit"></i></a>
                                                <a id="<?php echo $idPost; ?>"
                                                   data-api="<?php echo URL . API_POST_DEL; ?>"
                                                   data-toggle="modal"
                                                   data-name="<?php echo $postTitle; ?>"
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