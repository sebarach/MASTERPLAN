<main class="main sidebar-fixed sidebar-compact aside-menu-off-canvas aside-menu-hidden header-fixed" style="height: 100%;">
	<ol class="breadcrumb " id="breadcrumb">
		<li class="breadcrumb-item ">
	        <a href="<?php echo base_url("empresas"); ?>"><?php echo $empresa; ?></a>
	    </li>
	    <li class="breadcrumb-item active">
	        <a href="">Campañas</a>
	    </li>
	</ol>
	<div class="container-fluid">
		<div class="animated fadeIn">
			<h3>Campañas</h3>
			<div class="row">
				<div class="col-md-12">
					<div class="card card-accent-theme">
						<?php
							$perm=$permisos["permisos"]-8;
							if($perm>=1){
								if($perm!=2 || $perm!=4){
									echo "<div class='card-header'><button type='button' data-toggle='modal' data-target='#modal9' onclick='limpiar(\"c_add\")' class='btn btn-sm btn-theme'><i class='mdi mdi-plus'></i>Agregar</button></div>";
								}								
							}
						?>
						<div class="card-body">
							<div class="table-responsive">
								<table class="display table table-hover table-striped" id="tabla2" >
									<thead>
										<tr>
											<th style="width:300px !important;"></th>
											<th class="text-theme">ID Campaña</th>
											<th class="text-theme">Campaña</th>
											<th class="text-theme">Año</th>
											<th class="text-theme">Fecha Inicio</th>
											<th class="text-theme">Fecha Termino</th>
											<th class="text-theme">Fecha Termino Real</th>
											<th class="text-theme">País</th>
											<th class="text-theme">Fecha Creación</th>
											<th class="text-theme">Estado</th>
										</tr>
									</thead>
									<tbody>
										<?php
											foreach ($campanas as $c) {
												echo "<tr>";
												echo "<td style='text-align:center;'><div class='btn-group-vertical btn-group-sm'>";
												if($perm>=4){
													if($perm!=2 || $perm!=1){
														echo "<div class='btn-group'><button type='button' class='btn btn-sm btn-outline-theme' onclick='campana(\"".base64_encode($c["id_campana"])."\")' data-toggle='modal' data-target='#modal10' style='margin-top:0;' title='Editar'><i class='fa  fa-pencil'></i></button>";
													}
												}
												for($i=0; $i<count($modulos); $i++) {
													if($modulos[$i]=="Acciones"){
														echo "<button type='button' class='btn btn-outline-theme btn-sm' onclick='acciones(\"".base64_encode($c["id_campana"])."\")' title='Acciones'><i class='mdi mdi-chemical-weapon'></i></button></div>";
													}
													if($modulos[$i]=="Informes"){
														echo "<div class='btn-group'><button type='button' class='btn btn-outline-theme btn-sm' onclick='informes(\"".base64_encode($c["id_campana"])."\")' title='Reportes'><i class='fa  fa-dashboard '></i></a>";
													}												
												}
												echo "<button type='button' class='btn btn-outline-theme btn-sm' data-toggle='modal' data-target='#modal11' onclick='info(\"".base64_encode($c["id_campana"])."\")' title='Información'><i class='mdi mdi-chart-areaspline'></i></button></div>";
												echo "</div></td>";
												echo "<td>".$c["id_campana"]."</td>";
												echo "<td>".$c["campana"]."</td>";
												echo "<td>".$c["anio"]."</td>";
												echo "<td>".$c["fecha_inicio"]."</td>";
												echo "<td>".$c["fecha_termino"]."</td>";
												echo "<td>".$c["fecha_termino_real"]."</td>";
												echo "<td>".$c["pais"]."</td>";
												echo "<td>".$c["fecha_registro"]."</td>";
												if($c["activo"]==1){
													echo "<td class='status'><span class='badge badge-boxed badge-success' >".strtoupper($c["estado"])."</span></td>";
												} else {
													echo "<td class='status'><span class='badge badge-boxed badge-danger' >".strtoupper($c["estado"])."</span></td>";
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
	</div>
</main>
<div class="modal fade" id="modal9"  role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        	<form method="post" action="<?php echo base_url("campanas/agregar"); ?>" onsubmit=" return valida_form('c_add');">
	            <div class="modal-header">
	                <h6 class="modal-title">Agregar Campaña</h6>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">×</span>
	               </button>
	            </div>
	            <div class="modal-body">
	            	<div class="row">
	            		<div class="col-md-6">
	            			<div class="form-group">
	            				<label>Campaña</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_campanaadd" name="txt_campanaadd">
	            				</div>
	            			</div>
	            		</div>
	            		<div class="col-md-6">
	            			<div class="form-group">
	            				<label>Año</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_anioadd" name="txt_anioadd">
	            				</div>
	            			</div>
	            		</div>
	            	</div>
	            	<div class="row">
	            		<div class="col-md-6">
	            			<div class="form-group">
	            				<label>País</label>
	            				<select class="form-control" data-plugin="select2" style=" width: 100%;"  id="lbl_paisadd" name="lbl_paisadd">
	            					<option value="">Seleccione Pais</option>
	            					<?php
	            						foreach ($paises as $c) {
	            							echo "<option value='".$c["id_pais"]."'>".$c["pais"]."</option>";
	            						}
	            					?>
								</select>
	            			</div>
	            		</div>
	            		<div class="col-md-6">
	            			<div class="form-group row">
	            				<label class="col-md-12">Activo</label>
	            				<div class="col-md-12 custom-controls-stacked d-block my-3">
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_cam_activoadd1" name="rad_cam_activoadd" value="1">
		            					<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">SI</span>
	                                </label>
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_cam_activoadd2" name="rad_cam_activoadd" value="0">
	            						<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">NO</span>
	            					</label>
	            				</div>
	            			</div>
	            		</div>
	            	</div>
	            	<div class="row">
	            		<div class="col-md-6">
	            			<div class="form-group">
	            				<label>Grupo Motivos</label>
	            				<select class="form-control" data-plugin="select2" style=" width: 100%;" id="lbl_grupomotivosadd" name="lbl_grupomotivosadd" >
	            					<option value="">Seleccione Grupo Motivos</option>
	            					<?php
	            					   foreach ($grupomotivos as $g) {
	            					   	 echo "<option value='".$g["id_grupo_motivos"]."'>".$g["grupo_motivos"]."</option>";
	            					   }
	            					?>
	            				</select>
	            			</div>
	            		</div>
	            		<div class="col-md-6">
	            			<div class="form-group row">
	            				<label class="col-md-12">Motivos Donde</label>
	            				<div class="col-md-7 custom-controls-stacked d-block my-3">
	            					<?php
	            						for ($i=0; $i < count($dondemotivos) ; $i++) { 
	            							echo "<label class='custom-control custom-radio'><input type='radio' class='custom-control-input' id='rad_acc_motivosadd".($i+1)."' name='rad_acc_motivosadd' value='".$dondemotivos[$i]["id_motivos_donde"]."' ><span class='custom-control-indicator' ></span><span class='custom-control-description' >".$dondemotivos[$i]["motivos_donde"]."</span></label>";
	            						}
	            					?>
	            				</div>
	            			</div>
	            		</div>
	            	</div>
	            	<div class="row">
	            		<div class="col-md-6">
	            			<div class="form-group row">
	            				<label class="col-md-12">Posee Materiales</label>
	            				<div class="col-md-12 custom-controls-stacked d-block my-3">
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_acc_materialesadd1" name="rad_acc_materialesadd" value="1">
		            					<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">SI</span>
	                                </label>
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_acc_materialesadd2" name="rad_acc_materialesadd" value="0">
	            						<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">NO</span>
	            					</label>
	            				</div>
	            			</div>
	            		</div>
	            		<div class="col-md-6">
	            			<div class="form-group row">
	            				<label class="col-md-12">Activo Digita</label>
	            				<div class="col-md-12 custom-controls-stacked d-block my-3">
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_acc_digitaadd1" name="rad_acc_digitaadd" value="1">
		            					<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">SI</span>
	                                </label>
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_acc_digitaadd2" name="rad_acc_digitaadd" value="0">
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
<div class="modal fade" id="modal10"  role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        	<form method="post" action="<?php echo base_url("campanas/editar"); ?>" onsubmit=" return valida_form('c_edit');">
	            <div class="modal-header">
	                <h6 class="modal-title">Editar Campaña</h6>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">×</span>
	               </button>
	            </div>
	            <div class="modal-body">
	            	<div class="row">
	            		<div class="col-md-6">
	            			<div class="form-group">
	            				<label>Campaña</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_campanaedit" name="txt_campanaedit">
	            				</div>
	            			</div>
	            		</div>
	            		<div class="col-md-6">
	            			<div class="form-group">
	            				<label>Año</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_anioedit" name="txt_anioedit">
	            				</div>
	            			</div>
	            		</div>
	            	</div>
	            	<div class="row">
	            		<div class="col-md-6">
	            			<div class="form-group">
	            				<label>País</label>
	            				<select class="form-control" data-plugin="select2" style=" width: 100%;"  id="lbl_paisedit" name="lbl_paisedit">
	            					<?php
	            						foreach ($paises as $c) {
	            							echo "<option value='".$c["id_pais"]."'>".$c["pais"]."</option>";
	            						}
	            					?>
								</select>
	            			</div>
	            		</div>
	            		<div class="col-md-6">
	            			<div class="form-group row">
	            				<label class="col-md-12">Activo</label>
	            				<div class="col-md-12 custom-controls-stacked d-block my-3">
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_cam_activoedit1" name="rad_cam_activoedit" value="1">
		            					<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">SI</span>
	                                </label>
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_cam_activoedit2" name="rad_cam_activoedit" value="0">
	            						<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">NO</span>
	            					</label>
	            				</div>
	            			</div>
	            		</div>
	            	</div>
	            	<div class="row">
	            		<div class="col-md-6">
	            			<div class="form-group">
	            				<label>Grupo Motivos</label>
	            				<select class="form-control" data-plugin="select2" style=" width: 100%;" id="lbl_grupomotivosedit" name="lbl_grupomotivosedit" >
	            					<?php
	            					   foreach ($grupomotivos as $g) {
	            					   	 echo "<option value='".$g["id_grupo_motivos"]."'>".$g["grupo_motivos"]."</option>";
	            					   }
	            					?>
	            				</select>
	            			</div>
	            		</div>
	            		<div class="col-md-6">
	            			<div class="form-group row">
	            				<label class="col-md-12">Motivos Donde</label>
	            				<div class="col-md-7 custom-controls-stacked d-block my-3">
	            					<?php
	            						for ($i=0; $i < count($dondemotivos) ; $i++) { 
	            							echo "<label class='custom-control custom-radio'><input type='radio' class='custom-control-input' id='rad_acc_motivosedit".($i+1)."' name='rad_acc_motivosedit' value='".$dondemotivos[$i]["id_motivos_donde"]."' ><span class='custom-control-indicator' ></span><span class='custom-control-description' >".$dondemotivos[$i]["motivos_donde"]."</span></label>";
	            						}
	            					?>
	            				</div>
	            			</div>
	            		</div>
	            	</div>
	            	<div class="row">
	            		<div class="col-md-6">
	            			<div class="form-group row">
	            				<label class="col-md-12">Posee Materiales</label>
	            				<div class="col-md-12 custom-controls-stacked d-block my-3">
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_acc_materialesedit1" name="rad_acc_materialesedit" value="1">
		            					<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">SI</span>
	                                </label>
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_acc_materialesedit2" name="rad_acc_materialesedit" value="0">
	            						<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">NO</span>
	            					</label>
	            				</div>
	            			</div>
	            		</div>
	            		<div class="col-md-6">
	            			<div class="form-group row">
	            				<label class="col-md-12">Activo Digita</label>
	            				<div class="col-md-12 custom-controls-stacked d-block my-3">
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_acc_digitaedit1" name="rad_acc_digitaedit" value="1">
		            					<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">SI</span>
	                                </label>
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_acc_digitaedit2" name="rad_acc_digitaedit" value="0">
	            						<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">NO</span>
	            					</label>
	            				</div>
	            			</div>
	            		</div>
	            	</div>
	            		<?php 
	            			for($i=0; $i<count($modulos); $i++) {
								if($modulos[$i]=="UserLevels"){
									echo "<div class='col-md-12'>";
									echo "<div class='form-group'>";
									echo "<label>Link Power BI</label>";
									echo "<div class='input-group'>";
									echo "<span class='input-group-addon bg-theme'><i class='fa fa-asterisk'></i></span>";
									echo "<input type='text' class='form-control' id='txt_linkpbiedit' name='txt_linkpbiedit' >";
									echo "</div>";
									echo "</div>";
									echo "</div>";
								}
							}
						?>
	            	
	            	<input type="hidden" class="form-control" id="txt_campanaid" name="txt_campanaid">
	            </div>
	            <div class="modal-footer">                
	                <button type="submit" class="btn btn-theme"><i class='fa fa-save'></i>Guardar</button>
	            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal11" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
	            <h6 class="modal-title"></h6>
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                <span aria-hidden="true">×</span>
	            </button>
	        </div>
	        <div class="modal-body">
	        	<div class="row">
	        		<div class="col-md-12">
	        			<div class="card">
	        				<div class="card-body">
	        					<div class="category-progress">
	        						<div class="row">
	        							<div class="col-md-12 porcentaje">
	        								<div class="category-progress"></div>
	        							</div>
	        						</div>
	        					</div>
	        				</div>
	        			</div>
	        		</div>
	        	</div>
	        	<div class="row row-margin-up-analytics">
	        		<div class="col-md-6">
	        			<div class="card">
	        				<div class="card-body">
	        					<div class="analytics-list">
	        						<div class="clearfix puntos"></div>
	        					</div>
	        				</div>
	        			</div>
	        		</div>
	        		<div class="col-md-6">
	        			<div class="card">
	        				<div class="card-body">
		        				<div class="analytics-list">
		        					<div class="clearfix implement"></div>
		        				</div>
		        			</div>
	        			</div>
	        		</div>
	        	</div>
	        	<div class="row row-margin-up-analytics">
	        		<div class="col-md-6">
	        			<div class="card">
	        				<div class="card-body">
	        					<div class="analytics-list">
	        						<div class="clearfix pendiente"></div>
	        					</div>
	        				</div>
	        			</div>
	        		</div>
	        		<div class="col-md-6">
	        			<div class="card">
	        				<div class="card-body">
		        				<div class="analytics-list">
		        					<div class="clearfix acciones"></div>
		        				</div>
		        			</div>
	        			</div>
	        		</div>
	        	</div>
	        </div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function () {
		$('#tabla2').DataTable({
		       
		 });
	});

	$('#txt_anioadd').validCampoFranz('0123456789'); 

	$('#txt_anioedit').validCampoFranz('0123456789'); 

	$('#lbl_paisadd').select2();

	$('#lbl_grupomotivosadd').select2();


	function informes(id){
	$.ajax({
		url:"http://masterplan.grupoprogestion.com/masterplan/empresas/informes",
		type: "POST",
		data: "id="+id,
		success: function(data){
			window.location.href='http://masterplan.grupoprogestion.com/masterplan/informes/reporte';
		}
	});
}
	
</script>
<style type="text/css">
	th,td{
		font-size: 90% !important;
	}
</style>