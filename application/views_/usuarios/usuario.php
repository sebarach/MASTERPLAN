<main class="main sidebar-fixed sidebar-compact aside-menu-off-canvas aside-menu-hidden header-fixed" style="height: 100%;">
	<ol class="breadcrumb " id="breadcrumb">
	    <li class="breadcrumb-item active">
	        <a href="">Usuarios</a>
	    </li>
	</ol>
	<div class="container-fluid">
		<div class="animated fadeIn">
			<h3>Usuarios</h3>
			<div class="row">
				<div class="col-md-7">
					<div class="card">
						<div class="card-header">
							<form method="POST" action="<?php echo base_url("usuarios"); ?>" id="f_empresa" >
								<select class="form-control" data-plugin="select2" id="lbl_empresa" name="lbl_empresa" onchange="usuarios()">
									<option value="0">Seleccione Empresa</option>
									<?php
										foreach ($empresas as $e) {
											echo "<option value='".$e["id_empresa"]."'>".$e["empresa"]."</option>";
										}
									?>
								</select>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card card-accent-theme">
						<?php
							$perm=$permisos["permisos"]-8;
							if($perm>=1){
								if($perm!=2 || $perm!=4){
									echo "<div class='card-header'><button type='button' data-toggle='modal' data-target='#modal4' onclick='limpiar(\"u_add\")' class='btn btn-sm btn-theme'><i class='mdi mdi-plus'></i>Agregar</button></div>";
								}								
							}
						?>
						<div class="card-body">
							<div class="table-responsive">
								<table class="display table table-hover table-striped" id="tabla3" >
									<thead>
										<tr>
											<th></th>
											<th class='text-theme'>Usuario</th>
											<th class='text-theme'>Password</th>
											<th class='text-theme'>Perfil</th>
											<th class='text-theme'>Empresa</th>
											<th class='text-theme'>Estado</th>
										</tr>
									</thead>
									<tbody>
										<?php
											foreach ($usuarios as $u) {
												echo "<tr>";
												echo "<td style='text-align:center;' ><div class='btn-group-vertical'>";
												if($perm>=4){
													if($perm!=2 || $perm!=1){
														echo "<button type='button' class='btn btn-outline-theme btn-sm' data-toggle='modal' data-target='#modal5' title='Editar' onclick='usuario(\"".base64_encode($u["id_usuario"])."\")'><i class='fa fa-pencil'  ></i></button>";
														echo "<button type='button' class='btn btn-outline-theme btn-sm'  title='Campañas' onclick='camp_usuarios(\"".base64_encode($u["id_usuario"])."\")'><i class='mdi mdi-google-circles-group'></i></button>";
													}
												}
												
												echo "</div></td>";
												echo "<td>".$u["usuario"]."</td>";
												echo "<td>".$u["password"]."</td>";
												echo "<td>".$u["userlevelname"]."</td>";
												echo "<td>".$u["empresa"]."</td>";
												$badge="badge-danger";
												if($u["activo"]==1){
													$badge="badge-success";
												} 
												echo "<td class='status'><span class='badge badge-boxed ".$badge."' >".strtoupper($u["estado"])."</span></td>";												
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
<div class="modal fade" id="modal4"  role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        	<form method="post" action="<?php echo base_url("usuarios/agregar"); ?>" onsubmit=" return valida_form('u_add');">
	            <div class="modal-header ">
	                <h6 class="modal-title">Agregar Usuario</h6>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
	                    <span aria-hidden="true">×</span>
	               </button>
	            </div>
	            <div class="modal-body">
	            	<div class="row">
	            		<div class="col-md-6">
	            			<div class="form-group">
	            				<label>Usuario</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_usuarioadd" name="txt_usuarioadd" autocomplete="off">
	            				</div>
	            			</div>
	            		</div>
	            		<div class="col-md-6">
	            			<div class="form-group">
	            				<label>Password</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="password" class="form-control" id="txt_passwordadd" name="txt_passwordadd" autocomplete="off">
	            				</div>
	            			</div>
	            		</div>
	            	</div>
	            	<div class="row">	            		
	            		<div class="col-md-6">
	            			<div class="form-group">
	            				<label>Perfil</label>
	            				<select class="form-control" data-plugin="select2" style=" width: 100%;" id="lbl_perfiladd" name="lbl_perfiladd" >
	            					<option value="">Seleccione Perfil</option>
	            					<?php
										foreach ($perfiles as $p) {
											echo "<option value='".$p["userlevelid"]."'>".$p["userlevelname"]."</option>";
										}
									?>
	            				</select>
	            			</div>
	            		</div>
	            		<div class="col-md-6">
	            			<div class="form-group">
	            				<label>Empresa</label>
	            				<select class="form-control" data-plugin="select2" style=" width: 100%;" id="lbl_empresaadd" name="lbl_empresaadd"  >
									<option value="">Seleccione Empresa</option>
									<?php
										foreach ($empresas as $e) {
											echo "<option value='".$e["id_empresa"]."'>".$e["empresa"]."</option>";
										}
									?>
								</select>
	            			</div>
	            		</div>
	            		<div class="col-md-12">
	            			<div class="form-group row">
	            				<label class="col-md-12">Activo</label>
	            				<div class="col-md-12 custom-controls-stacked d-block my-3">
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_emp_activoadd1" name="rad_emp_activoadd" value="1">
		            					<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">SI</span>
	                                </label>
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_emp_activoadd2" name="rad_emp_activoadd" value="0">
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
<div class="modal fade" id="modal5"  role="dialog"  aria-hidden="true">
	<div class="modal-dialog" role="document">
        <div class="modal-content">
        	<form method="post" action="<?php echo base_url("usuarios/editar"); ?>" onsubmit=" return valida_form('u_edit');">
        		<div class="modal-header ">
	                <h6 class="modal-title">Editar Usuario</h6>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
	                    <span aria-hidden="true">×</span>
	               </button>
	            </div>
	            <div class="modal-body">
	            	<div class="row">
	            		<div class="col-md-6">
	            			<div class="form-group">
	            				<label>Usuario</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_usuarioedit" name="txt_usuarioedit">
	            				</div>
	            			</div>
	            		</div>
	            		<div class="col-md-6">
	            			<div class="form-group">
	            				<label>Password</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_passwordedit" name="txt_passwordedit">
	            				</div>
	            			</div>
	            		</div>
	            	</div>
	            	<div class="row">
	            		<div class="col-md-6">
	            			<div class="form-group">
	            				<label>Empresa</label>
	            				<select class="form-control" data-plugin="select2" style=" width: 100%;" id="lbl_empresaedit" name="lbl_empresaedit"  >
									<?php
										foreach ($empresas as $e) {
											echo "<option value='".$e["id_empresa"]."'>".$e["empresa"]."</option>";
										}
									?>
								</select>
	            			</div>
	            		</div>
	            		<div class="col-md-6">
	            			<div class="form-group">
	            				<label>Perfil</label>
	            				<select class="form-control" data-plugin="select2" style=" width: 100%;" id="lbl_perfiledit" name="lbl_perfiledit" >
	            					<?php
										foreach ($perfiles as $p) {
											echo "<option value='".$p["userlevelid"]."'>".$p["userlevelname"]."</option>";
										}
									?>
	            				</select>
	            			</div>
	            		</div>
	            		<div class="col-md-12">
	            			<div class="form-group row">
	            				<label class="col-md-12">Activo</label>
	            				<div class="col-md-12 custom-controls-stacked d-block my-3">
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_emp_activoedit1" name="rad_emp_activoedit" value="1">
		            					<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">SI</span>
	                                </label>
	            					<label class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="rad_emp_activoedit2" name="rad_emp_activoedit" value="0">
	            						<span class="custom-control-indicator"></span>
	                                    <span class="custom-control-description">NO</span>
	            					</label>
	            				</div>
	            			</div>
	            		</div>
	            	</div>
	            </div>
	            <input type='hidden' id="txt_usuarioid" name="txt_usuarioid">
	            <div class="modal-footer">                
	                <button type="submit" class="btn btn-theme"><i class='fa fa-save'></i>Guardar</button>
	            </div>
        	</form>
        </div>
    </div>
</div>

<script type="text/javascript">
	$(function () {
		$('#tabla3').DataTable({
		     "ordering": false
		});
	});

	$('#lbl_empresa').select2();

	$('#lbl_empresaadd').select2();

	$('#lbl_perfiladd').select2();

	
				
</script>
<style type="text/css">
	.ms-container{
		width: 100%;
	}

	td,th {
		font-size: 88%;
	}

	/*.ms-container .ms-list{ height: 110px !important; }*/

	.select2-container .select2-selection--multiple{
		max-height: 110px;
	}

	@media (min-width: 576px){ .modal-dialog { max-width: 700px; }  }

	@media (min-width: 992px) { .modal-lg { max-width: 1000px; } }
}

</style>