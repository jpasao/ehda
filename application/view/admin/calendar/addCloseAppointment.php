<div class="content-inner" id="calendar">
    <div class="container-fluid">
        <!-- Begin Page Header-->
        <div class="row">
            <div class="page-header">
                <div class="d-flex align-items-center">
                    <h2 class="page-header-title">Añadir cita cercana</h2>
                    <div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo URL . PAGE_ADMIN_HOME; ?>"><i class="ti ti-home"></i></a></li>
                            <li class="breadcrumb-item active">Cita cercana</li>
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
                        <form class="needs-validation" novalidate action="<?php echo URL . API_CLOSEDATE_SAVE; ?>" method="POST">
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Fecha</label>
                                <div class="col-lg-3">
                                    <input type="text" 
                                            class="form-control" 
                                            id="closedatetime" 
                                            placeholder="Selecciona fecha y hora"
                                            required
                                            autocomplete="off">
                                    <div class="invalid-feedback">
                                        Es necesario indicar la fecha
                                    </div>                                         
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" readonly id="closeDate" name="closeDate" />
                                </div>
                                <div class="col-lg-1">
                                    <input type="text" class="form-control" readonly id="closeTime" name="closeTime" />
                                </div>                                
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Nombre</label>
                                <div class="col-lg-7">
                                    <input type="text" 
                                            class="form-control" 
                                            id="name"
                                            name="name" 
                                            placeholder="Nombre del paciente"
                                            required                                           
                                            autocomplete="off">
                                    <div class="invalid-feedback">
                                        Es necesario indicar el nombre del paciente
                                    </div>                                                                         
                                </div>
                            </div>                               
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Horas</label>
                                <div class="col-lg-7">
                                    <input type="number" 
                                            class="form-control" 
                                            id="duration" 
                                            name="duration"
                                            placeholder="Cantidad de horas"
                                            required
                                            min="1"
                                            value="1"                                            
                                            autocomplete="off">
                                    <div class="invalid-feedback">
                                        Es necesario indicar el tiempo de la cita
                                    </div>                                                                         
                                </div>
                            </div>                             
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Email</label>
                                <div class="col-lg-7">
                                    <input type="text" 
                                            class="form-control" 
                                            id="email" 
                                            name="email"
                                            placeholder="Email del paciente"
                                            required
                                            autocomplete="off">
                                    <div class="invalid-feedback">
                                        Es necesario indicar el email
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