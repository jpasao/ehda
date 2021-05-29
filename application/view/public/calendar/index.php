		<div id="appointmentCal"></div>
		<div id="modal-form" class="modal fade">	
			<div class="modal-dialog">
				<div class="modal-content">				
					<form id="citeForm">				
						<div class="modal-header">
							 <span id="modalTitle"></span>
							 <i class="fa fa-question text-secondary" data-toggle="tooltip" data-placement="right" title="Los datos de este formulario no aparecerán en público"></i>
						</div>				
						<div class="modal-body">	
							<div class="container-fluid">
								<div class="row">
									<div class="col-12">										
										<div id="validation" class="alert alert-danger" role="alert"></div>											
									</div>
								</div>
								<div class="row">
									<div class="col-12">										
										<div id="nameGroup" class="form-group">
											<label class="form-control-label" for="name">Nombre: </label>
											<input type="text" class="form-control" id="name" placeholder="Nombre" required>
										</div>	
									</div>
								</div>								
								<div class="row">
									<div class="col-6">
										<div id="hourGroup" class="form-group">
											<label class="form-control-label" for="hour">Hora preferida: </label>
											<input type="time" class="form-control time" id="hour" min="10:00" max="19:00" required pattern="[0-9]{2}:[0-9]{2}"> 
											<span class="validity"></span>
										</div>										
									</div>
									<div class="col-6">
										<div id="durationGroup" class="form-group">
											<label class="form-control-label" for="duration">Duración (horas): </label>
											<input type="number" class="form-control time" id="duration" required min="1" max="3" step="1" value="1"> 
											<span class="validity"></span>
										</div>	
									</div>
								</div>
								<div class="row">
									<div class="col-12">										
										<div id="contactInfoGroup" class="form-group">
											<label class="form-control-label" for="contactInfo">Información de contacto: </label>
											<textarea class="form-control" rows="3" id="contactInfo" placeholder="Incluya número de teléfono, ID de skype o correo electrónico" required></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12">										
										<div id="contactEmailGroup" class="form-group">
                                            <input class="form-check-input" type="checkbox" value="" id="copyInCalendar">
                                            <label class="form-check-label" for="copyInCalendar">Quiero recibir una copia en mi calendario</label>
										</div>
									</div>
								</div>   
								<div class="row" id="emailField" style="display:none">
									<div class="col-12">										
										<div id="emailGroup" class="form-group">
											<label class="form-control-label" for="email">Email: </label>
											<input type="text" class="form-control" id="email" placeholder="Dirección de correo">
										</div>	
									</div>
								</div>                                                             								
							</div>
						</div>				
						<div class="modal-footer">
							<button type="button" class="btn btn-default form-btn" data-dismiss="modal">Cerrar</button>
							<button id="submit" 
									type="button" 
									class="btn btn-primary form-btn disabled" 
									data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Guardando...">								
								Guardar
							</button>								
						</div>				
					</form>				
				</div>
			</div>
		</div>		