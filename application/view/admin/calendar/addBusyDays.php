<div class="content-inner" id="calendar">
    <div class="container-fluid">
        <!-- Begin Page Header-->
        <div class="row">
            <div class="page-header">
                <div class="d-flex align-items-center">
                    <h2 class="page-header-title">Añadir días ocupados</h2>
                    <div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo URL . PAGE_ADMIN_HOME; ?>"><i class="ti ti-home"></i></a></li>
                            <li class="breadcrumb-item active">Días ocupados</li>
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
                        <form class="needs-validation" novalidate action="<?php echo URL . API_SPAREDATE_SAVE; ?>" method="POST">
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Rango de días</label>
                                <div class="col-lg-4">
                                    <input type="text" 
                                            class="form-control" 
                                            id="datetime" 
                                            placeholder="Selecciona rango de fecha y hora"
                                            required
                                            autocomplete="off">
                                    <div class="invalid-feedback">
                                        Es necesario indicar las fechas
                                    </div>                                                                         
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Desde</label>
                                <div class="col-lg-2">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly id="fromDate" name="fromDate">
                                    </div>                                  
                                </div>
                                <div class="col-lg-2">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly id="fromTime" name="fromTime">
                                    </div>                                  
                                </div>                                
                            </div> 
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Hasta</label>
                                <div class="col-lg-2">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly id="toDate" name="toDate">
                                    </div>                                  
                                </div>
                                <div class="col-lg-2">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly id="toTime" name="toTime">
                                    </div>                                  
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