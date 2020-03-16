<?php 
    $idValue = 0;
    $titleValue = '';
    $bodyValue = '';
    
    if ($post != null) {
        $idValue = htmlspecialchars($post->id, ENT_QUOTES, 'UTF-8'); 
        $titleValue = htmlspecialchars($post->title, ENT_QUOTES, 'UTF-8'); 
        $bodyValue = htmlspecialchars($post->body, ENT_QUOTES, 'UTF-8'); 
    }
?>
<div class="content-inner" id="PostAdd">
    <div class="container-fluid">
        <!-- Begin Page Header-->
        <div class="row">
            <div class="page-header">
                <div class="d-flex align-items-center">
                    <h2 class="page-header-title"><?php echo $literal; ?> entrada</h2>
                    <div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo URL . PAGE_ADMIN_HOME; ?>"><i class="ti ti-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo URL . PAGE_POST_LIST; ?>">Entradas</a></li>
                            <li class="breadcrumb-item active"><?php echo $literal; ?> entrada</li>
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
                        <form class="needs-validation" novalidate action="<?php echo URL . API_POST_SAVE; ?>" method="POST" id="frm">
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Título</label>
                                <div class="col-lg-7">
                                    <input type="hidden" name="id" value="<?php echo $idValue; ?>" />                        
                                    <input type="text" 
                                            name="title" 
                                            class="form-control" 
                                            placeholder="Título de la entrada" 
                                            required
                                            value="<?php echo $titleValue; ?>">
                                    <div class="invalid-feedback">
                                        Es necesario indicar el título de la entrada
                                    </div> 
                                </div>                                
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Contenido</label>
                                <div class="col-lg-7">
                                    <textarea id="bodyTag" name="bodyTag" style="width: 400px; height: 200px;"><?php echo $bodyValue; ?></textarea>
                                </div>
                            </div> 
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Etiquetas</label>
                                <div class="col-lg-7">
                                    <select name="tags[]" data-live-search="true" data-size="10" multiple>
                                        <?php 
                                            $selected = '';                                           
                                            foreach($tags as $tag)
                                            {          
                                                $matchTag = array_search($tag->id, array_column($selectedTags, 'idtag'));                                               
                                                $selected = $matchTag === false ? '' : 'selected';
                                                echo '<option ' . $selected . ' value="' . $tag->id . '">' . $tag->name . '</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Imagen</label>
                                <div class="col-lg-4">
                                    <select name="image[]" id="imageSelect" data-live-search="true" data-size="10" class="show-tick" title="Seleccione...">
                                        <?php
                                            $existImage;
                                            $matchImage = '';
                                            foreach($images as $image)
                                            {       
                                                $existImage = isset($image->filename);
                                                if ($existImage) {  
                                                    $selected = '';  
                                                    if ($image->id == $selectedImage->idimage){
                                                        $selected = 'selected';
                                                        $matchImage = IMG_URL . $image->filename;
                                                    }     
                                                    echo '<option ' . $selected . ' value="' . $image->id . '" data-image="' . IMG_URL . $image->filename . '">' . $image->name . '</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-3 text-right">
                                    <img id="imagePreview" src="<?php echo $matchImage; ?>" height="100px" />
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