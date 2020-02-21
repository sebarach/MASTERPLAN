<link rel="stylesheet" href="<?php echo base_url("assets/css/ion.calendar.css")?>">
<script src="<?php echo base_url("assets/js/moment-with-locales.min.js")?>"></script>
<script src="<?php echo base_url("assets/js/ion.calendar.min.js")?>"></script>
<script src="<?php echo base_url("assets/js/libs/dropify/dist/js/dropify.min.js"); ?>"></script>
<main class="main  sidebar-fixed sidebar-compact aside-menu-off-canvas aside-menu-hidden header-fixed" style="height: 100%;">
	<ol class="breadcrumb " id="breadcrumb">
		<li class="breadcrumb-item ">
	        <a href="<?php echo base_url("empresas"); ?>"><?php echo $empresa; ?></a>
	    </li>
	    <li class="breadcrumb-item ">
	        <a href="<?php echo base_url("campanas"); ?>"><?php echo $campana["campana"]; ?></a>
	    </li>
	   	<li class="breadcrumb-item">
	        <a href="<?php echo base_url("acciones"); ?>"><?php echo $accion["accion"]; ?></a>
	    </li>
	    <li class="breadcrumb-item active">
	        <a href="">Master</a>
	    </li>
	</ol>
	<div class="container-fluid">
		<div class="animated fadeIn">
			<h3>Master</h3>
			<?php $perm=$permisos["permisos"]-8;
				if($perm>=1){
					if($perm!=2 || $perm!=4){ ?>
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-body">
										<form id="form1" method="POST" action="<?php echo site_url(); ?>clientesinfo/leermaster" enctype="multipart/form-data" >
											<div class="row">
												<div class="col-md-4">
													<h6 class="text-theme">Descargar Master&nbsp;</h6>
													<a href="<?php echo base_url("clientesinfo/master");?>" >
														<div class="dropify-wrapper">
															<div class="dropify-message">
																<div class="ecom-widget-sales">
																	<div class="ecom-sales-icon text-center">
																		<i class="mdi mdi-download"></i>
																	</div>	
																</div>								
															</div>
														</div>
													</a>												
												</div>
												<div class="col-md-3">
													<h6 class="text-theme">Opciones&nbsp;</h6>
													<label class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" name="chck_master" id="chck_master1" onclick="check()" value="2">
														<span class="custom-control-indicator"></span>
														<span class="custom-control-description">INGRESAR MASTER</span>
													</label>
													<label class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" name="chck_master" id="chck_master2" onclick="check()" value="4">
														<span class="custom-control-indicator"></span>
														<span class="custom-control-description">EDITAR MASTER</span>
													</label>
													<a href="" class="btn btn-theme"><i class="fa fa-download"></i><small>DESCARGAR MACRO MASTER</small></a>
												</div>
												<div class="col-md-4">
													<h6 class="text-theme">Subir Master&nbsp;<small>Extensiones Permitidas: .xls, .xlsx</small></h6>												
												    <input type='file' id="ex_master"  name="ex_master" class="dropify" data-default-file="" onchange="master();">
												    
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
			<?php
					}
				}
			?>
			<div class="row">
				<div class="col-md-12">
					<div class="card card-accent-theme">
						<div class="card-body">
							<ul class="nav nav-tabs custom-tab" role="tablist">
                                <li class="nav-item">
                                	<a class="nav-link active" data-toggle="tab" href="#home3" role="tab" aria-controls="home"><i class="mdi mdi-chart-gantt"></i> Sucursales</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile"><i class="mdi mdi-coins"></i> Materiales</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                            	<div class="tab-pane active" id="home3" role="tabpanel">
                            	 	<div class="table-responsive">
                            	 		<?php if($perm>=1){
												if($perm!=2 || $perm!=4){ ?>
	                            	 		<div class="card-body">
		                            	 		<div class="clearfix">
		                            	 			<div class="float-left">
		                            	 				<button type='button' class='btn btn-theme btn-sm' id="addC" onclick="limpiar('cliente_add')"><i class='fa fa-plus'></i>Agregar</button>
		                            	 				<button type='button'  class='btn btn-theme btn-sm' id="delC"><i class='fa fa-remove'></i>Eliminar</button>
		                            	 				<button type='button'  class='btn btn-theme btn-sm ' id="editC" ><i class='fa fa-pencil'></i>Editar</button>                            	 				
		                            	 			</div>
		                            	 		</div>
		                            	 	</div>
	                            	 	<?php }
	                            	 	}
	                            	 	?>
										<table class="display table table-hover table-striped" id="tabla6">
											<thead>
												<tr>
													<th class="text-theme">ID Unico</th>
													<th class="text-theme">ID Campaña</th>
													<th class="text-theme">ID Accion</th>
													<th class="text-theme" >ID Cliente</th>								
													<th class="text-theme">Nombre Fantasia</th>						
													<th class="text-theme">Dirección</th>
													<th class="text-theme">Ciudad</th>
													<th class="text-theme">Región</th>
													<th class="text-theme">Fecha Programada</th>						
													<th class="text-theme">Canal</th>	
													<th class="text-theme">Cadena</th>
													<th class="text-theme">Cliente</th>								
													<th class="text-theme">Ejecutivo</th>
													<th class="text-theme">Jefe</th>
													<th class="text-theme">ID Original</th>		
													<?php 
														if(base64_decode($_SESSION["empresa"])==9){
															echo "<th class='text-theme'>Tipo Local</th>";
															echo "<th class='text-theme'>Gerente Zonal</th>";
															echo "<th class='text-theme'>Gestor</th>";
															echo "<th class='text-theme'>Agencia Repone</th>";
															echo "<th class='text-theme'>Agencia Implementa</th>";
															echo "<th class='text-theme'>Plan Cumbre</th>";
														} else {
															echo "<th class='text-theme'>Nota Entrega</th>";
														}
													?>		
												</tr>
											</thead>
											<tbody>
												<?php
													foreach ($clientes as $c) {
														echo "<tr>";
														echo "<td>".$c["id_unico"]."</td>";
														echo "<td>".$c["id_campana"]."</td>";
														echo "<td>".$c["id_accion"]."</td>";
														echo "<td>".$c["id_cliente"]."</td>";							
														echo "<td>".$c["nombre_fantasia"]."</td>";					
														echo "<td>".$c["direccion"]."</td>";
														echo "<td>".$c["ciudad"]."</td>";
														echo "<td>".$c["region"]."<input type='hidden' value='".$c["id_region"]."'></td>";
														echo "<td>".$c["fecha_programada"]."</td>";
														echo "<td>".$c["canal"]."</td>";	
														echo "<td>".$c["cadena"]."</td>";
														echo "<td>".$c["cliente"]."</td>";							
														echo "<td>".$c["ejecutivo"]."</td>";
														echo "<td>".$c["jefe"]."</td>";
														echo "<td>".$c["id_original"]."</td>";
														echo "<td>".$c["nota_entrega"]."</td>";
														if(base64_decode($_SESSION["empresa"])==9){
															echo "<td>".$c["gerente_zonal"]."</td>";
															echo "<td>".$c["gestor"]."</td>";
															echo "<td>".$c["agencia_repone"]."</td>";
															echo "<td>".$c["agencia_implementa"]."</td>";
															echo "<td>".$c["instalacion"]."</td>";
														}
														echo "</tr>";
													}
												?>
											</tbody>
										</table>								
									</div>
                            	</div>
                            	<div class="tab-pane" id="profile3" role="tabpanel">
                            		<?php if($perm>=1){
												if($perm!=2 || $perm!=4){ ?>
	                            	 		<div class="card-body">
		                            	 		<div class="clearfix">
		                            	 			<div class="float-left">
		                            	 				<button type='button' class='btn btn-theme btn-sm' id="addCI" onclick="limpiar('clienteinfo_add')"><i class='fa fa-plus'></i>Agregar</button>
		                            	 				<button type='button'  class='btn btn-theme btn-sm' id="delCI"><i class='fa fa-remove'></i>Eliminar</button>
		                            	 				<button type='button'  class='btn btn-theme btn-sm ' id="editCI" ><i class='fa fa-pencil'></i>Editar</button>                            	 				
		                            	 			</div>
		                            	 		</div>
		                            	 	</div>
	                            	 	<?php }
	                            	 	}
	                            	 	?>
                            		<table class="display table table-hover table-striped" id="tabla7">
                            			<thead>
                            				<th class="text-theme">ID Info</th>
                            				<th class="text-theme">ID Campaña</th>
                            				<th class="text-theme">ID Accion</th>
                            				<th class="text-theme">ID Cliente</th>
                            				<th class="text-theme">Fecha Programada</th>
                            				<th class="text-theme">Material</th>
                            				<th class="text-theme">Acuerdo</th>
                            				<th class="text-theme">Implementado</th>
                            				<th class="text-theme">ID Motivo</th>
                            				<?php
                            					if(base64_decode($_SESSION["empresa"])==9){
                            						echo "<th class='text-theme'>Tipo Elemento</th>";
                            						echo "<th class='text-theme'>Tipo Acuerdo</th>";
                            						echo "<th class='text-theme'>Fecha Inicio Acuerdo</th>";
                            						echo "<th class='text-theme'>Fecha Fin Acuerdo</th>";
                            						echo "<th class='text-theme'>Costo</th>";
                            					}
                            				?>
                            			</thead>
                            			<tbody>
                            				<?php
                            				foreach ($clientesinfo as $c) {
                            					echo "<tr>";
                            					echo "<td>".$c["id_info"]."</td>";
                            					echo "<td>".$c["id_campana"]."</td>";
                            					echo "<td>".$c["id_accion"]."</td>";
                            					echo "<td>".$c["id_cliente"]."</td>";
                            					echo "<td>".$c["fecha_programada"]."</td>";
                            					echo "<td>".$c["medicion"]."</td>";
                            					echo "<td>".$c["acuerdo"]."</td>";
                            					echo "<td>".$c["implementado"]."</td>";
                            					echo "<td>".$c["motivo"]."</td>";
                            					if(base64_decode($_SESSION["empresa"])==9){
                            						echo "<td>".$c["clasificacion"]."</td>";
                            						echo "<td>".$c["tipo_acuerdo"]."</td>";
                            						echo "<td>".$c["fecha_inicio_acuerdo"]."</td>";
                            						echo "<td>".$c["fecha_fin_acuerdo"]."</td>";
                            						echo "<td>".$c["instalacion"]."</td>";
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
	</div>
</main>
<?php
	if (isset($_SESSION["mensaje"])) {
	    if (strlen($_SESSION["mensaje"])>1) {
?>
	<div class="modal fade" id="modal1" tabindex="-1" role="dialog"  aria-hidden="true">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content ">
	        	<div class="modal-header">
	        		
	        	</div>
	        	<div class="modal-body">
	        		<label class="text-theme"><?php echo $_SESSION["mensaje"]; ?></label>
	        	</div>
	        	<div class="modal-footer">
	        		<button type="button" class="btn btn-theme" data-dismiss="modal"><i class="mdi mdi-thumb-up-outline"></i>Aceptar</button>
	        	</div>
	        </div>
	    </div>
	</div>
<?php
	    }
	    $_SESSION["mensaje"]="";
	}        	
?>
<div class="modal fade" id="modalcliente" tabindex="-1" role="dialog"  aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg" role="document">
		<form method="post" id="formcli" action="<?php echo base_url("clientesinfo/agregarclientes"); ?>" onsubmit="return valida_form('cliente_add');">
			<div class="modal-content ">
				<div class="modal-header">
					<h6 class="modal-title"></h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">×</span>
	               </button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
	            				<label>ID Cliente</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_id_cliente" name="txt_id_cliente">
	            				</div>
	            			</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
	            				<label>Nombre Fantasia</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_nombre_fantasia" name="txt_nombre_fantasia">
	            				</div>
	            			</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
	            				<label>Dirección</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_direccion" name="txt_direccion">
	            				</div>
	            			</div>
						</div>
					</div>	
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
	            				<label>Fecha Programada</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control blanco fecha" id="txt_fecha_programada" name="txt_fecha_programada" readonly placeholder="dd-mm-aaaa">
	            				</div>
	            			</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
	            				<label>Ciudad</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_ciudad" name="txt_ciudad">
	            				</div>
	            			</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
	            				<label>Región</label>
	            				<select class="form-control dataplugin" style="width:100%;"  id="lbl_region" name="lbl_region" placeholder="Region">
	            					<?php foreach($region as $r){ 
	            						echo "<option value=\"".$r["id_region"]."\">".$r["region"]."</option>"; 
	            					}?>
	            				</select>
	            			</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
	            				<label>Canal</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_canal" name="txt_canal">
	            				</div>
	            			</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
	            				<label>Cadena</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_cadena" name="txt_cadena">
	            				</div>
	            			</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
	            				<label>Cliente</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_cliente" name="txt_cliente">
	            				</div>
	            			</div>
						</div>
					</div>	
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
	            				<label>Ejecutivo</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_ejecutivo" name="txt_ejecutivo">
	            				</div>
	            			</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
	            				<label>Jefe</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_jefe" name="txt_jefe">
	            				</div>
	            			</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
	            				<label>ID Original</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_id_original" name="txt_id_original">
	            				</div>
	            			</div>
	            			<input type="hidden" class="form-control" id="txt_id_unico" name="txt_id_unico">
						</div>
					</div>	
					<?php if(base64_decode($_SESSION["empresa"])==9){ ?>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
	            				<label>Tipo Local</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_tipo_local" name="txt_tipo_local">
	            				</div>
	            			</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
	            				<label>Gerente Zonal</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_gerente_zonal" name="txt_gerente_zonal">
	            				</div>
	            			</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
	            				<label>Gestor</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_gestor" name="txt_gestor">
	            				</div>
	            			</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
	            				<label>Agencia Repone</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_agencia_repone" name="txt_agencia_repone">
	            				</div>
	            			</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
	            				<label>Agencia Implementa</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_agencia_implementa" name="txt_agencia_implementa">
	            				</div>
	            			</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
	            				<label>Plan Cumbre</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_plan_cumbre" name="txt_plan_cumbre">
	            				</div>
	            			</div>
						</div>
					</div>
					<?php } else { ?>		
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
	            				<label>Nota Entrega</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_tipo_local" name="txt_tipo_local">
	            				</div>
	            			</div>
						</div>
					</div>
					<?php }  ?>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-theme" ><i class="fa fa-save"></i>Guardar</button>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="modal fade" id="modalclienteinfo" tabindex="-1" role="dialog"  aria-hidden="true" style="display: none;">
	<div class="modal-dialog" role="document">
		<form method="post" id="formcliinfo" action="<?php echo base_url("clientesinfo/agregarclienteinfo"); ?>" onsubmit=" return valida_form('clienteinfo_add');">
			<div class="modal-content ">
				<div class="modal-header">
					<h6 class="modal-title"></h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">×</span>
	               </button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
	            				<label>ID Cliente</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_id_cliente_i" name="txt_id_cliente_i">
	            				</div>
	            			</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
	            				<label>Fecha Programada</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control blanco fecha" id="txt_fecha_programada_i" name="txt_fecha_programada_i" readonly placeholder="dd-mm-aaaa">
	            				</div>
	            			</div>
						</div>
					</div>	
					<div class="row">						
						<div class="col-md-6">
							<div class="form-group">
	            				<label>Material</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_medicion_i" name="txt_medicion_i">
	            				</div>
	            			</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
	            				<label>Acuerdo (cantidad)</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control num" id="txt_acuerdo_i" name="txt_acuerdo_i">
	            				</div>
	            			</div>
	            			<input type="hidden" class="form-control" id="txt_id_info" name="txt_id_info">
						</div>
					</div>	
					<?php if(base64_decode($_SESSION["empresa"])==9){ ?>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
	            				<label>Tipo Elemento</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_clasificacion_i" name="txt_clasificacion_i">
	            				</div>
	            			</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
	            				<label>Tipo Acuerdo</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_tipo_acuerdo_i" name="txt_tipo_acuerdo_i">
	            				</div>
	            			</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
	            				<label>Fecha Inicio Acuerdo</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control blanco fecha" id="txt_fecha_inicio_i" name="txt_fecha_inicio_i" readonly placeholder="dd-mm-aaaa">
	            				</div>
	            			</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
	            				<label>Fecha Fin Acuerdo</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control blanco fecha" id="txt_fecha_fin_i" name="txt_fecha_fin_i" readonly placeholder="dd-mm-aaaa">
	            				</div>
	            			</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
	            				<label>Costo</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control num" id="txt_costo_i" name="txt_costo_i">
	            				</div>
	            			</div>
						</div>
					</div>
					<?php } ?>		
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-theme btn-sm" ><i class="fa fa-save"></i>Guardar</button>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="modal fade" id="modalalertas" tabindex="-1" role="dialog"  aria-hidden="true" style="display: none;">
	<div class="modal-dialog" role="document">
		<div class="modal-content bg-theme">
			<div class="modal-header">
				<h6 class="modal-title text-white"></h6>
			</div>
			<div class="modal-body">
				
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function () {
		$(".dropify-message span").removeAttr("class").html('<div class="ecom-widget-sales"><div class="ecom-sales-icon text-center"><i class="mdi mdi-upload"></i></div></div>');

		//SUCURSALES
		var t=$('#tabla6').DataTable({
			scrollY: "400px",
	        scrollX: true,
	        scrollCollapse: true,
			autoWidth:false,
	        fixedHeader: true,
	        order : [[1,'asc']]
		});


		$('#tabla6').on( 'click', 'tr', function () {
	        if ( $(this).hasClass('selected') ) {
	            $(this).removeClass('selected');
	        } else {
	            t.$('tr.selected').removeClass('selected');
	            $(this).addClass('selected');
	        }
	    });

	    $('#addC').on( 'click', function () {
	    	$("#modalcliente .modal-header .modal-title").html("Agregar Sucursal");
	        $(".dataplugin").select2();
	        $(".fecha").ionDatePicker({
				lang:"es",
				sundayFirst:false,
				format:"DD-MM-YYYY",
				years:"2"
				// ,
				// onReady: function(){
				// 	validarfecha(dup);
				// }
			});	
			$('#modalcliente').modal('show');        
	    });

	    $('#editC').click(function(){
	    	var cont=0;
	    	var row;
			$('#tabla6 tbody tr').each( function(){
				if ( $(this).hasClass('selected') ) {
			        cont+=1;
			        row=$(this);
			    }
			});
			if(cont>0){
		    	$("#modalcliente .modal-header .modal-title").html("Editar Sucursal");
		    	$("#txt_id_unico").val(btoa(row.find("td:eq(0)").text()));
		    	$("#txt_id_cliente").val(row.find("td:eq(3)").text());
		    	$("#txt_nombre_fantasia").val(row.find("td:eq(4)").text());
		    	$("#txt_direccion").val(row.find("td:eq(5)").text());
		    	$("#txt_ciudad").val(row.find("td:eq(6)").text());
		    	$('#lbl_region').val(row.find("td:eq(7)").find("input").val()).trigger('change');
		    	$("#txt_fecha_programada").val(row.find("td:eq(8)").text());
		    	$("#txt_canal").val(row.find("td:eq(9)").text());
		    	$("#txt_cadena").val(row.find("td:eq(10)").text());
		    	$("#txt_cliente").val(row.find("td:eq(11)").text());
		    	$("#txt_ejecutivo").val(row.find("td:eq(12)").text());
		    	$("#txt_jefe").val(row.find("td:eq(13)").text());
		    	$("#txt_id_original").val(row.find("td:eq(14)").text());
		    	if($("#txt_tipo_local").length>0){
		    		$("#txt_tipo_local").val(row.find("td:eq(15)").text());
		    		$("#txt_gerente_zonal").val(row.find("td:eq(16)").text());
		    		$("#txt_gestor").val(row.find("td:eq(17)").text());
		    		$("#txt_agencia_repone").val(row.find("td:eq(18)").text());
		    		$("#txt_agencia_implementa").val(row.find("td:eq(19)").text());
		    		$("#txt_plan_cumbre").val(row.find("td:eq(20)").text());
		    	}
		    	$(".dataplugin").select2();
		        $(".fecha").ionDatePicker({
					lang:"es",
					sundayFirst:false,
					format:"DD-MM-YYYY",
					years:"2"
					// ,
					// onReady: function(){
					// 	validarfecha(dup);
					// }
				});
				$('#modalcliente').modal('show');	
			} else {
				alert("Debe seleccionar una sucursal(fila) para editar");
			} 
	    });	

	    $("#formcli").submit(function (event) {
	    	event.preventDefault();
	    	$.ajax({
	    		url:"<?php echo base_url("clientesinfo/agregarclientes"); ?>",
	    		type: "POST",
	    		data: $("#formcli").serialize(),
	    		dataType:"json",
	    		success: function(data){
	    			$("#modalalertas .modal-header .modal-title").html(data.titulo);
	    			$("#modalalertas .modal-body ").html("<label class='text-white'>"+data.mensaje+"</label>");
	    			$("#modalalertas").modal("show");
	    			setTimeout(function () {
	    				window.location.href="<?php echo base_url("clientesinfo"); ?>";
	    			},1100);
	    		}
	    	});
	    });	

		$('#delC').click(  function () {
			var cont=0;
			var row;
			$('#tabla6 tbody tr').each( function(){
				if ( $(this).hasClass('selected') ) {
			        cont+=1;
			        row=$(this);
			    }
			});
			if(cont>0){
				if(confirm("¿Estas seguro de eliminar la sucursal del listado?")){
					$.ajax({
						url:"<?php echo base_url("clientesinfo/eliminarcliente"); ?>",
						type: "POST",
						data: "id="+btoa(row.find("td:eq(0)").text()),
						dataType:"json",
						success: function(data){
							$("#modalalertas .modal-header .modal-title").html(data.titulo);
							$("#modalalertas .modal-body ").html("<label class='text-white'>"+data.mensaje+"</label>");
							$("#modalalertas").modal("show");
							setTimeout(function () {
								window.location.href="<?php echo base_url("clientesinfo"); ?>";
							},1100);
						}
					});
					t.row('.selected').remove().draw( false );
					if(counter<=1){
						counter=1;
					} else {
						counter-=1;
					}					
				}
			} else {
				alert("Debe seleccionar una sucursal(fila) para eliminar");
			}					    
		});

		//MATERIALES
		var t2=$('#tabla7').DataTable({
			scrollY: "400px",
	        scrollX: true,
	        scrollCollapse: true,
			autoWidth:false,
	        fixedHeader: true,
	        order : [[1,'asc']]
		});

		$('#tabla7').on( 'click', 'tr', function () {
	        if ( $(this).hasClass('selected') ) {
	            $(this).removeClass('selected');
	        } else {
	            t2.$('tr.selected').removeClass('selected');
	            $(this).addClass('selected');
	        }
	    });

	    $('#delCI').click(  function () {
			var cont=0;
			var row;
			$('#tabla7 tbody tr').each( function(){
				if ( $(this).hasClass('selected') ) {
			        cont+=1;
			        row=$(this);
			    }
			});
			if(cont>0){
				if(confirm("¿Estas seguro de eliminar el material del listado?")){
					$.ajax({
						url:"<?php echo base_url("clientesinfo/eliminarclienteinfo"); ?>",
						type: "POST",
						data: "id="+btoa(row.find("td:eq(0)").text()),
						dataType:"json",
						success: function(data){
							$("#modalalertas .modal-header .modal-title").html(data.titulo);
							$("#modalalertas .modal-body ").html("<label class='text-white' >"+data.mensaje+"</label>");
							$("#modalalertas").modal("show");
							setTimeout(function () {
								window.location.href="<?php echo base_url("clientesinfo"); ?>";
							},1100);
						}
					});
					t2.row('.selected').remove().draw( false );
					if(counter<=1){
						counter=1;
					} else {
						counter-=1;
					}					
				}
			} else {
				alert("Debe seleccionar un material(fila) para eliminar");
			}					    
		});

		$('#addCI').on( 'click', function () {
	    	$("#modalclienteinfo .modal-header .modal-title").html("Agregar Material");
	        $('.num').validCampoFranz('0123456789');
	        $(".fecha").ionDatePicker({
				lang:"es",
				sundayFirst:false,
				format:"DD-MM-YYYY",
				years:"2"
				// ,
				// onReady: function(){
				// 	validarfecha(dup);
				// }
			});	
			$('#modalclienteinfo').modal('show');        
	    });

		$('#editCI').click(function(){
	    	var cont=0;
	    	var row;
			$('#tabla7 tbody tr').each( function(){
				if ( $(this).hasClass('selected') ) {
			        cont+=1;
			        row=$(this);
			    }
			});
			if(cont>0){
		    	$("#modalclienteinfo .modal-header .modal-title").html("Editar Material");
		    	$("#txt_id_info").val(btoa(row.find("td:eq(0)").text()));
		    	$("#txt_id_cliente_i").val(row.find("td:eq(3)").text());
		    	$("#txt_fecha_programada_i").val(row.find("td:eq(4)").text());
		    	$("#txt_medicion_i").val(row.find("td:eq(5)").text());
		    	$("#txt_acuerdo_i").val(row.find("td:eq(6)").text());
		    	if($("#txt_clasificacion_i").length>0){
		    		$("#txt_clasificacion_i").val(row.find("td:eq(9)").text());
		    		$("#txt_tipo_acuerdo_i").val(row.find("td:eq(10)").text());
		    		$("#txt_fecha_inicio_i").val(row.find("td:eq(11)").text());
		    		$("#txt_fecha_fin_i").val(row.find("td:eq(12)").text());
		    		$("#txt_costo_i").val(row.find("td:eq(13)").text());
		    	}
		    	$('.num').validCampoFranz('0123456789');
		        $(".fecha").ionDatePicker({
					lang:"es",
					sundayFirst:false,
					format:"DD-MM-YYYY",
					years:"2"
					// ,
					// onReady: function(){
					// 	validarfecha(dup);
					// }
				});
				$('#modalclienteinfo').modal('show');	
			} else {
				alert("Debe seleccionar un material(fila) para editar");
			} 
	    });


	    $("#formcliinfo").submit(function (event) {
	    	event.preventDefault();
	    	$.ajax({
	    		url:"<?php echo base_url("clientesinfo/agregarclienteinfo"); ?>",
	    		type: "POST",
	    		data: $("#formcliinfo").serialize(),
	    		dataType:"json",
	    		success: function(data){
	    			$("#modalalertas .modal-header .modal-title").html(data.titulo);
	    			$("#modalalertas .modal-body ").html("<label class='text-white' >"+data.mensaje+"</label>");
	    			$("#modalalertas").modal("show");
	    			setTimeout(function () {
	    				window.location.href="<?php echo base_url("clientesinfo"); ?>";
	    			},1100);
	    		}
	    	});
	    });	
		

	});

	$('.dropify').dropify();

	$("#modal1").modal({                    
      "backdrop"  : "static",
      "keyboard"  : true,
      "show"      : true                     
    });


    function check(){
    	var checkbox1 = document.getElementById("chck_master1");
     	var checkbox2 = document.getElementById("chck_master2"); 
    	checkbox1.onclick = function(){ 
    		if(checkbox1.checked != false){ 
    			checkbox2.checked =null; 
    		}
     	} 
    	checkbox2.onclick = function(){ 
    		if(checkbox2.checked != false){ 
    			checkbox1.checked=null;
     		}
     	} 
    }
</script>

<style type="text/css">
	th,td{
		font-size: 85% !important;
	}

	.tab-content{
		color: #536c79;
	}

	.dropify-wrapper{
		height: 130px;
	}

	select {
    	min-height: 20px; 
	}

	@media (min-width: 992px){
		.modal-lg{
			max-width: 900px;
		}
	}

	small{
		font-size: 70%;
	}

	.custom-control-description{
		font-size: 90%;
	}

	
</style>