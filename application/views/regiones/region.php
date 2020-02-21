<body class="app sidebar-fixed aside-menu-off-canvas aside-menu-hidden header-fixed  pace-done">
	<div class="app-body">
		<main class="main  sidebar-fixed sidebar-compact aside-menu-off-canvas aside-menu-hidden header-fixed" style="height: 100%;">
			<ol class="breadcrumb " id="breadcrumb">
				<li class="breadcrumb-item ">
			        <a href="">Regiones</a>
			    </li>
			</ol>
			<div class="container-fluid">
				<div class="animated fadeIn">
					<h3>Regiones</h3>
					<div class="row">
						<div class="col-md-12">
							<div class="card card-accent-theme">
								<?php $perm=$permisos["permisos"]-8;
									if($perm>=1){
										if($perm!=2 || $perm!=4){ 
											echo "<div class='card-header'><button type='button' data-toggle='modal' data-target='#modal1' onclick='limpiar(\"r_add\")' class='btn btn-sm btn-theme'><i class='mdi mdi-plus'></i>Agregar</button></div>";
										}
									}
								?>
								<div class="card-body">
									<div class="row">
										<div class="col-md-9">
											<div class="table-responsive">
												<table class="table table-striped table-hover" id="tabla8" >
													<thead>
														<th ></th>
														<th class='text-theme' >ID Región</th>
														<th class='text-theme' >Región</th>
														<th class='text-theme' >Pais</th>
														<th class='text-theme' >Orden</th>
													</thead>
													<tbody>
														<?php
															foreach ($regiones as $c) {
																echo "<tr>
																	<td style='text-align:center;'><div class='btn-group-vertical'>";
																	if($perm>=4){
																		if($perm!=2 || $perm!=1){
																			echo "<button type='button' class='btn btn-sm btn-outline-theme' onclick='region(\"".base64_encode($c["id_region"])."\")' data-toggle='modal' data-target='#modal2' style='margin-top:0;' title='Editar'><i class='fa fa-pencil'></i></button>";
																			// echo "<button type='button' class='btn btn-sm btn-outline-theme' onclick='comunas(\"".base64_encode($c["id_region"])."\")' data-toggle='modal' data-target='#modal2' style='margin-top:0;' title='Ciudades'><i class='fa fa-compass'></i></button>";
																		}
																	}
																echo "</div></td>
																	<td>".$c["id_region"]."</td>
																	<td>".$c["region"]."</td>
																	<td>".$c["pais"]."</td>
																	<td>".$c["orden"]."</td>
																</tr>";
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
			</div>
		</main>
	</div>
</body>
<div class="modal fade" id="modal1"  role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        	<form method="post" action="<?php echo base_url("regiones/agregar"); ?>" onsubmit=" return valida_form('r_add');">
	            <div class="modal-header">
	                <h6 class="modal-title">Agregar Región</h6>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">×</span>
	               </button>
	            </div>
	            <div class="modal-body">
	            	<div class="row">
	            		<div class="col-md-12">
	            			<div class="form-group">
	            				<label>Región</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_regionadd" name="txt_regionadd">
	            				</div>
	            			</div>
	            			<div class="form-group">
	            				<label>Pais</label>
	            				<select class="form-control" data-plugin="select2" style=" width: 100%;" id="lbl_paisadd" name="lbl_paisadd">
	            					<option value="">Seleccione Pais</option>
	            					<?php
	            					   foreach ($paises as $g) {
	            					   	 echo "<option value='".$g["id_pais"]."'>".$g["pais"]."</option>";
	            					   }
	            					?>
	            				</select>
	            			</div>
	            			<div class="form-group">
	            				<label>Orden</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_ordenadd" name="txt_ordenadd">
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
<div class="modal fade" id="modal2"  role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        	<form method="post" action="<?php echo base_url("regiones/editar"); ?>" onsubmit=" return valida_form('r_edit');">
	            <div class="modal-header ">
	                <h6 class="modal-title">Editar Región</h6>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">×</span>
	               </button>
	            </div>
	            <div class="modal-body">
	            	<div class="row">
	            		<div class="col-md-12">
	            			<div class="form-group">
	            				<label>Región</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_regionedit" name="txt_regionedit">
	            				</div>
	            			</div>
	            			<div class="form-group">
	            				<label>Pais</label>
	            				<select class="form-control" data-plugin="select2" style=" width: 100%;" id="lbl_paisedit" name="lbl_paisedit">
	            					<option value="">Seleccione Pais</option>
	            					<?php
	            					   foreach ($paises as $g) {
	            					   	 echo "<option value='".$g["id_pais"]."'>".$g["pais"]."</option>";
	            					   }
	            					?>
	            				</select>
	            			</div>
	            			<div class="form-group">
	            				<label>Orden</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_ordenedit" name="txt_ordenedit">
	            				</div>
	            			</div>
	            		</div>
	            		<input type="hidden" class="form-control" id="txt_regionid" name="txt_regionid">
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
		$('#tabla8').DataTable({
		    "ordering": false
		 });
	});

	$('#lbl_paisadd').select2();
	
</script>
<style type="text/css">
	td,th {
		font-size: 88%;
	}

	.btn-sm {
	    font-size: 0.79rem;
	}
</style>