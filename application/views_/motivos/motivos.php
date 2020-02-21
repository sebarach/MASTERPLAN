<main class="main sidebar-fixed sidebar-compact aside-menu-off-canvas aside-menu-hidden header-fixed" style="height: 100%;">
	<ol class="breadcrumb " id="breadcrumb">
	   	<li class="breadcrumb-item">
	        <a href="<?php echo base_url("grupos_motivos"); ?>"><?php echo $grupo["grupo_motivos"]; ?></a>
	    </li>
	    <li class="breadcrumb-item active">
	        <a href="">Motivos</a>
	    </li>
	</ol>
	<div class="container-fluid">
		<div class="animated fadeIn">
			<h3>Motivos</h3>
			<div class="row">
				<div class="col-md-12">
					<?php
						$perm=$permisos["permisos"]-8;
						if($perm>=1){
							if($perm!=2 || $perm!=4){
								echo "<div class='card-header'><button type='button' data-toggle='modal' data-target='#modal12' onclick='limpiar(\"m_add\")' class='btn btn-sm btn-theme'><i class='mdi mdi-plus'></i>Agregar</button></div>";
							}								
						}
					?>
					<div class="card-body">
						<div class="table-responsive">
							<table class="display table table-hover table-striped" id="tabla6">
								<thead>
									<tr>
										<th style="width:100px !important;"></th>
										<th class="text-theme">ID Motivo</th>
										<th class="text-theme">Motivo</th>
										<th class="text-theme">Alias</th>
										<?php
											if($grupo["id_grupo_motivos"]==9){
												echo "<th class='text-theme'>C&oacute;digo Motivo</th>";
												echo "<th class='text-theme'>Responsable</th>";								
											}
										?>
										<th class="text-theme">Exitoso</th>
										<th class="text-theme">En Cliente</th>
										<th class="text-theme">En Material</th>
										<th class="text-theme">Estado</th>
									</tr>
								</thead>
								<tbody>
									<?php
										foreach($motivos as $m){
											echo "<tr>";
											echo "<td style='text-align:center;'><div class='btn-group-vertical'>";
											if($perm>=4){
												if($perm!=2 || $perm!=1){
													echo "<button type='button' class='btn btn-sm btn-outline-theme' onclick='motivo(\"".base64_encode($m["id_motivo"])."\")' data-toggle='modal' data-target='#modal14' style='margin-top:0;' title='Editar'><i class='fa  fa-pencil'></i></button>";
												}
											}
											echo "</div></td>";
											echo "<td>".$m["id_motivo"]."</td>";
											echo "<td>".$m["motivo"]."</td>";
											echo "<td>".$m["alias"]."</td>";
											if($grupo["id_grupo_motivos"]==9){
												echo "<td>".$m["cod_motivo"]."</td>";
												echo "<td>".$m["responsable"]."</td>";
											}
											if($m["exitoso"]==1){
												echo "<td style='text-align:center;' class='status'><h4 class='text-success' ><i class='fa fa-check'></i></h4></td>";
											} else {
												echo "<td style='text-align:center;' class='status'><h4 class='text-danger' ><i class='fa fa-remove'></i></h4></td>";
											}
											if($m["en_cliente"]==1){
												echo "<td style='text-align:center;' class='status'><h4 class='text-success' ><i class='fa fa-check'></i></h4></td>";
											} else {
												echo "<td style='text-align:center;' class='status'><h4 class='text-danger' ><i class='fa fa-remove'></i></h4></td>";
											}
											if($m["en_material"]==1){
												echo "<td style='text-align:center;' class='status'><h4 class='text-success' ><i class='fa fa-check'></i></h4></td>";
											} else {
												echo "<td style='text-align:center;' class='status'><h4 class='text-danger' ><i class='fa fa-remove'></i></h4></td>";
											}
											if($m["activo"]==1){
												echo "<td style='text-align:center;' class='status'><span class='badge badge-boxed badge-success' >ACTIVO</span></td>";
											} else {
												echo "<td style='text-align:center;' class='status'><span class='badge badge-boxed badge-danger' >INACTIVO</span></td>";
											}
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
</main>
<div class="modal fade" id="modal12"  role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        	<form method="post" action="<?php echo base_url("grupos_motivos/agregarmotivo"); ?>" onsubmit="return valida_form('m_add');">
	            <div class="modal-header">
	                <h6 class="modal-title">Agregar Motivo</h6>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">×</span>
	               </button>
	            </div>
	            <div class="modal-body">
	            	<div class="row">
	            		<div class="col-md-6">
	            			<div class="form-group">
	            				<label>Motivo</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_motivoadd" name="txt_motivoadd">
	            				</div>
	            			</div>
	            		</div>	            		
	            		<div class="col-md-6">
	            			<div class="form-group">
	            				<label>Alias</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_aliasadd" name="txt_aliasadd">
	            				</div>
	            			</div>
	            		</div>	            		
	            	</div>
	            	<?php
	            		if($grupo["id_grupo_motivos"]==9){
	            			echo "<div class='row'>
	            				<div class='col-md-6'>
	            					<div class='form-group'>
	            						<label>C&oacute;digo Motivo</label>
	            						<div class='input-group'>
	            							<span class='input-group-addon bg-theme'>
	            								<i class='fa fa-asterisk'></i>
	            							</span>
	            							<input type='text' class='form-control' id='txt_codigoadd' name='txt_codigoadd'>
	            						</div>
	            					</div>
	            				</div>
	            				<div class='col-md-6'>
	            					<div class='form-group'>
	            						<label>Responsable</label>
	            						<div class='input-group'>
	            							<span class='input-group-addon bg-theme'>
	            								<i class='fa fa-asterisk'></i>
	            							</span>
	            							<input type='text' class='form-control' id='txt_responsableadd' name='txt_responsableadd'>
	            						</div>
	            					</div>
	            				</div>
	            			</div>";
	            		}
	            	?>
	            	<div class="row">
	            		<div class="col-md-6">
	            			<div class="form-group row">
	            				<label class="col-md-12">No Implementa</label>
	            				<div class="col-md-12 custom-controls-stacked d-block my-3">
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_mot_implementaadd1" name="rad_mot_implementaadd" value="1">
		            					<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">SI</span>
	                                </label>
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_mot_implementaadd2" name="rad_mot_implementaadd" value="0">
	            						<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">NO</span>
	            					</label>
	            				</div>
	            			</div>
	            		</div>
	            		<div class="col-md-6">
	            			<div class="form-group row">
	            				<label class="col-md-12">Exitoso</label>
	            				<div class="col-md-12 custom-controls-stacked d-block my-3">
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_mot_exitosoadd1" name="rad_mot_exitosoadd" value="1">
		            					<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">SI</span>
	                                </label>
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_mot_exitosoadd2" name="rad_mot_exitosoadd" value="0">
	            						<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">NO</span>
	            					</label>
	            				</div>
	            			</div>
	            		</div>	            		
	            	</div>
	            	<div class="row">
	            		<div class="col-md-6">
	            			<div class="form-group row">
	            				<label class="col-md-12">En Cliente</label>
	            				<div class="col-md-12 custom-controls-stacked d-block my-3">
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_mot_clienteadd1" name="rad_mot_clienteadd" value="1">
		            					<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">SI</span>
	                                </label>
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_mot_clienteadd2" name="rad_mot_clienteadd" value="0">
	            						<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">NO</span>
	            					</label>
	            				</div>
	            			</div>
	            		</div>	            		
	            		<div class="col-md-6">
	            			<div class="form-group row">
	            				<label class="col-md-12">En Material</label>
	            				<div class="col-md-12 custom-controls-stacked d-block my-3">
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_mot_materialadd1" name="rad_mot_materialadd" value="1">
		            					<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">SI</span>
	                                </label>
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_mot_materialadd2" name="rad_mot_materialadd" value="0">
	            						<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">NO</span>
	            					</label>
	            				</div>
	            			</div>
	            		</div>	            		
	            	</div>
	            	<div class="row">
	            		<div class="col-md-6">
	            			<div class="form-group row">
	            				<label class="col-md-12">Activo</label>
	            				<div class="col-md-12 custom-controls-stacked d-block my-3">
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_mot_activoadd1" name="rad_mot_activoadd" value="1">
		            					<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">SI</span>
	                                </label>
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_mot_activoadd2" name="rad_mot_activoadd" value="0">
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
<div class="modal fade" id="modal14"  role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        	<form method="post" action="<?php echo base_url("grupos_motivos/editarmotivo"); ?>" onsubmit="return valida_form('m_edit');">
	            <div class="modal-header">
	                <h6 class="modal-title">Editar Motivo</h6>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">×</span>
	               </button>
	            </div>
	            <div class="modal-body">
	            	<div class="row">
	            		<div class="col-md-6">
	            			<div class="form-group">
	            				<label>Motivo</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_motivoedit" name="txt_motivoedit">
	            				</div>
	            			</div>
	            		</div>	            		
	            		<div class="col-md-6">
	            			<div class="form-group">
	            				<label>Alias</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_aliasedit" name="txt_aliasedit">
	            				</div>
	            			</div>
	            		</div>	            		
	            	</div>
	            	<?php
	            		if($grupo["id_grupo_motivos"]==9){
	            			echo "<div class='row'>
	            				<div class='col-md-6'>
	            					<div class='form-group'>
	            						<label>C&oacute;digo Motivo</label>
	            						<div class='input-group'>
	            							<span class='input-group-addon bg-theme'>
	            								<i class='fa fa-asterisk'></i>
	            							</span>
	            							<input type='text' class='form-control' id='txt_codigoedit' name='txt_codigoedit'>
	            						</div>
	            					</div>
	            				</div>
	            				<div class='col-md-6'>
	            					<div class='form-group'>
	            						<label>Responsable</label>
	            						<div class='input-group'>
	            							<span class='input-group-addon bg-theme'>
	            								<i class='fa fa-asterisk'></i>
	            							</span>
	            							<input type='text' class='form-control' id='txt_responsableedit' name='txt_responsableedit'>
	            						</div>
	            					</div>
	            				</div>
	            			</div>";
	            		}
	            	?>
	            	<div class="row">
	            		<div class="col-md-6">
	            			<div class="form-group row">
	            				<label class="col-md-12">No Implementa</label>
	            				<div class="col-md-12 custom-controls-stacked d-block my-3">
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_mot_implementaedit1" name="rad_mot_implementaedit" value="1">
		            					<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">SI</span>
	                                </label>
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_mot_implementaedit2" name="rad_mot_implementaedit" value="0">
	            						<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">NO</span>
	            					</label>
	            				</div>
	            			</div>
	            		</div>
	            		<div class="col-md-6">
	            			<div class="form-group row">
	            				<label class="col-md-12">Exitoso</label>
	            				<div class="col-md-12 custom-controls-stacked d-block my-3">
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_mot_exitosoedit1" name="rad_mot_exitosoedit" value="1">
		            					<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">SI</span>
	                                </label>
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_mot_exitosoedit2" name="rad_mot_exitosoedit" value="0">
	            						<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">NO</span>
	            					</label>
	            				</div>
	            			</div>
	            		</div>	            		
	            	</div>
	            	<div class="row">
	            		<div class="col-md-6">
	            			<div class="form-group row">
	            				<label class="col-md-12">En Cliente</label>
	            				<div class="col-md-12 custom-controls-stacked d-block my-3">
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_mot_clienteedit1" name="rad_mot_clienteedit" value="1">
		            					<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">SI</span>
	                                </label>
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_mot_clienteedit2" name="rad_mot_clienteedit" value="0">
	            						<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">NO</span>
	            					</label>
	            				</div>
	            			</div>
	            		</div>	            		
	            		<div class="col-md-6">
	            			<div class="form-group row">
	            				<label class="col-md-12">En Material</label>
	            				<div class="col-md-12 custom-controls-stacked d-block my-3">
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_mot_materialedit1" name="rad_mot_materialedit" value="1">
		            					<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">SI</span>
	                                </label>
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_mot_materialedit2" name="rad_mot_materialedit" value="0">
	            						<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">NO</span>
	            					</label>
	            				</div>
	            			</div>
	            		</div>	            		
	            	</div>
	            	<div class="row">
	            		<div class="col-md-6">
	            			<div class="form-group row">
	            				<label class="col-md-12">Activo</label>
	            				<div class="col-md-12 custom-controls-stacked d-block my-3">
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_mot_activoedit1" name="rad_mot_activoedit" value="1">
		            					<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">SI</span>
	                                </label>
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_mot_activoedit2" name="rad_mot_activoedit" value="0">
	            						<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">NO</span>
	            					</label>
	            					<input type="hidden" class="form-control" id="txt_motivoid" name="txt_motivoid">
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
		$('#tabla6').DataTable({
		       
		 });
	});
</script>
<style type="text/css">
	th,td{
		font-size: 90% !important;
	}
</style>