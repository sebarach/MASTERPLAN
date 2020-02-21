<body class="app sidebar-fixed aside-menu-off-canvas aside-menu-hidden header-fixed  pace-done">
	<div class="app-body">
		<main class="main" style="height: 100%;">
		    <ol class="breadcrumb" id="breadcrumb">
			    <li class="breadcrumb-item ">
			        <a href="<?php echo base_url("tareas");?>"><?php echo $empresa; ?></a>
			    </li>
			    <li class="breadcrumb-item ">
			        <a href="">Tareas</a>
			    </li>
			</ol>
			<div class="container-fluid">
		        <div class="animated fadeIn">
		        	<h3>Tareas</h3>
		        	<div class="row">
		            	<div class="col-md-9">
		            		<div class="card card-accent-theme">
		                    	<?php
									$perm=$permisos["permisos"]-8;
									if($perm>=1){
										if($perm!=2 || $perm!=4){
											echo "<div class='card-header'><button type='button' data-toggle='modal' data-target='#modal29' onclick='limpiar(\"tt_add\")' class='btn btn-sm btn-theme'><i class='mdi mdi-plus'></i>Agregar</button></div>";
										}	
									}
								?>
								<div class="card-body">
									<div class="table-responsive">
										<table class="display table table-hover table-striped" id="tabla2" >
											<thead>
												<tr>
													<th style="width:150px !important;"></th>
													<th class="text-theme">ID Tarea</th>
													<th class="text-theme">Tarea</th>
													<th class="text-theme">Es Comercial</th>
													<th class="text-theme">Estado</th>
												</tr>
											</thead>
											<tbody>
												<?php
													foreach ($tareas as $t) {
														echo "<tr>";
														echo "<td style='text-align:center;' ><button class='btn btn-sm btn-outline-theme' type='button' data-toggle='modal' data-target='#modal30' onclick='tarea(\"".base64_encode($t["id_tipotarea"])."\")'><i class='fa fa-pencil'></i></button></td>";
														echo "<td>".$t["id_tipotarea"]."</td>";
														echo "<td>".$t["tipotarea"]."</td>";
														echo "<td style='text-align:center;'>".$t["es_comercial"]."</td>";
														echo "<td style='text-align:center;' class='status' >".$t["estado"]."</td>";
														echo "</tr>";
													}
												?>
											</tbody>
										</table>
									</div>
								</div>
							</div>	
		            	</div>
		            </div>
		        </div>
		    </div>
		</main>
	</div>
</body>
<div class="modal fade" id="modal29"  role="dialog"  aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form method="post" action="<?php echo base_url("tareas/agregartarea"); ?>" onsubmit="return valida_form('tt_add');">
				<div class="modal-header">
	                <h6 class="modal-title">Agregar Tarea</h6>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">×</span>
	               </button>
	            </div>
	            <div class="modal-body">
	            	<div class="row">
	            		<div class="col-md-12">
	            			<div class="form-group">
	            				<label>Tarea</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_tareaadd" name="txt_tareaadd">
	            				</div>
	            			</div>
	            		</div>
	            		<div class="col-md-6">
	            			<div class="form-group row">
	            				<label class="col-md-12">Es Comercial</label>
	            				<div class="col-md-12 custom-controls-stacked d-block my-3">
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_tarea_comadd1" name="rad_tarea_comadd" value="1">
		            					<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">SI</span>
	                                </label>
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_tarea_comadd2" name="rad_tarea_comadd" value="0">
	            						<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">NO</span>
	            					</label>
	            				</div>
	            			</div>
	            		</div>
	            		<div class="col-md-6">
	            			<div class="form-group row">
	            				<label class="col-md-12">Activo</label>
	            				<div class="col-md-12 custom-controls-stacked d-block my-3">
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_tarea_activoadd1" name="rad_tarea_activoadd" value="1">
		            					<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">SI</span>
	                                </label>
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_tarea_activoadd2" name="rad_tarea_activoadd" value="0">
	            						<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">NO</span>
	            					</label>
	            				</div>
	            			</div>
	            		</div>
	            	</div>
	            </div>
	            <div class="modal-footer">                
	                <button type="submit" class="btn btn-theme"><i class='fa fa-save'></i>Guardar</button>
	            </div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="modal30"  role="dialog"  aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form method="post" action="<?php echo base_url("tareas/editartarea"); ?>" onsubmit="return valida_form('tt_edit');">
				<div class="modal-header">
	                <h6 class="modal-title">Editar Tarea</h6>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">×</span>
	               </button>
	            </div>
	            <div class="modal-body">
	            	<div class="row">
	            		<div class="col-md-12">
	            			<div class="form-group">
	            				<label>Tarea</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_tareaedit" name="txt_tareaedit">
	            				</div>
	            			</div>
	            			<input type="hidden" class="form-control" id="txt_tareaid" name="txt_tareaid">
	            		</div>
	            		<div class="col-md-6">
	            			<div class="form-group row">
	            				<label class="col-md-12">Es Comercial</label>
	            				<div class="col-md-12 custom-controls-stacked d-block my-3">
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_tarea_comedit1" name="rad_tarea_comedit" value="1">
		            					<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">SI</span>
	                                </label>
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_tarea_comedit2" name="rad_tarea_comedit" value="0">
	            						<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">NO</span>
	            					</label>
	            				</div>
	            			</div>
	            		</div>
	            		<div class="col-md-6">
	            			<div class="form-group row">
	            				<label class="col-md-12">Activo</label>
	            				<div class="col-md-12 custom-controls-stacked d-block my-3">
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_tarea_activoedit1" name="rad_tarea_activoedit" value="1">
		            					<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">SI</span>
	                                </label>
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_tarea_activoedit2" name="rad_tarea_activoedit" value="0">
	            						<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">NO</span>
	            					</label>
	            				</div>
	            			</div>
	            		</div>
	            	</div>
	            </div>
	            <div class="modal-footer">                
	                <button type="submit" class="btn btn-theme"><i class='fa fa-save'></i>Guardar</button>
	            </div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function () {
		$('#tabla2').DataTable({
		       
		 });
	});
</script>