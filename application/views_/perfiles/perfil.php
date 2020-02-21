<main class="main sidebar-fixed sidebar-compact aside-menu-off-canvas aside-menu-hidden header-fixed" style="height: 100%;">
	<ol class="breadcrumb " id="breadcrumb">
	    <li class="breadcrumb-item active">
	        <a href="">Perfiles</a>
	    </li>
	</ol>
	<div class="container-fluid">
		<div class="animated fadeIn">
			<h3>Perfiles</h3>
			<div class="row">
				<div class="col-md-9">
					<div class="card card-accent-theme">
						<?php
							$perm=$permisos["permisos"]-8;
							if($perm>=1){
								if($perm!=2 || $perm!=4){
									echo "<div class='card-header'><button type='button' data-toggle='modal' data-target='#modal7' onclick='limpiar(\"p_add\")' class='btn btn-sm btn-theme'><i class='mdi mdi-plus'></i>Agregar</button></div>";
								}								
							}
						?>
						<div class="card-body">
							<div class="table-responsive">
								<table class="display table table-hover table-striped" id="tabla4" >
									<thead>
										<tr>
											<th></th>
											<th class="text-theme">ID Perfil</th>
											<th class="text-theme">Perfil</th>
										</tr>
									</thead>
									<tbody>
										<?php
											foreach ($perfiles as $p) {
												echo "<tr>";
												echo "<td style='text-align:center;'><div class='btn-group-vertical'>";
												if($perm>=4){
													if($perm!=2 || $perm!=1){
														echo "<button type='button' class='btn btn-sm btn-outline-theme' onclick='perfil(\"".base64_encode($p["userlevelid"])."\")' title='Editar' data-toggle='modal' data-target='#modal8' style='margin-top:0;'><i class='fa  fa-pencil'></i></button>";
													}
												}
												echo "</div></td>";
												echo "<td>".$p["userlevelid"]."</td>";
												echo "<td>".$p["userlevelname"]."</td>";
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
<div class="modal fade" id="modal7" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        	<form method="post" action="<?php echo base_url("perfiles/agregar"); ?>" onsubmit=" return valida_form('p_add');">
	            <div class="modal-header">
	                <h6 class="modal-title">Agregar Perfil</h6>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
	                    <span aria-hidden="true">×</span>
	               </button>
	            </div>
	            <div class="modal-body">
	            	<div class="row">
	            		<div class="col-md-12">
	            			<div class="form-group">
	            				<label>Perfil</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_perfiladd" name="txt_perfiladd">
	            				</div>
	            			</div>
	            		</div>
	            		<div class="col-md-12">
	     					<div class="form-group">
	     						<label>Permisos</label>
	     						<div class="sales-list table-responsive">
	     							<table class='table table-striped'>
		     							<thead>
		     								<tr class="text-theme">
		     									<th >Módulos</th>
		     									<th>Listar</th>
		     									<th>Agregar</th>
		     									<th>Editar</th>
		     									<th>Eliminar</th>		     									
		     								</tr>
		     							</thead>
		     							<tbody>
		     								<?php

		     									for ($i=0; $i < count($levels) ; $i++) { 
		     										echo "<tr>";
		     										echo "<td>";
		     											if($levels[$i]=='Campanas'){
		     												echo "Campañas";
		     											} else if($levels[$i]=='UserLevels'){
		     												echo "Perfiles";
		     											} else if($levels[$i]=='Clientes_Informacion'){
		     												echo "Clientes Informacion";
		     											} else if($levels[$i]=='Motivos_Grupos'){
		     												echo "Motivos Grupos";
		     											} else {
		     												echo $levels[$i];
		     											}
		     										echo "<input type='hidden' name='txt_modulos[]' value='".base64_encode($levels[$i])."' ></td>";
		     										echo "<td style='text-align:center;'><input type='checkbox'  name='chck_view".$i."'  value='8' ></td>";
		     										echo "<td style='text-align:center;'><input type='checkbox'  name='chck_add".$i."'  value='1' ></td>";
		     										echo "<td style='text-align:center;'><input type='checkbox'  name='chck_edit".$i."'  value='4' ></td>";
		     										echo "<td style='text-align:center;'><input type='checkbox'  name='chck_delete".$i."'  value='2' ></td>";
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
	            <div class="modal-footer">                
	                <button type="submit" class="btn btn-theme"><i class='fa fa-save'></i>Guardar</button>
	            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal8" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        	<form method="post" action="<?php echo base_url("perfiles/editar"); ?>" onsubmit=" return valida_form('p_edit');">
	            <div class="modal-header">
	                <h6 class="modal-title">Editar Perfil</h6>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">×</span>
	               </button>
	            </div>
	            <div class="modal-body">
	            	<div class="row">
	            		<div class="col-md-12">
	            			<div class="form-group">
	            				<label>Perfil</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_perfiledit" name="txt_perfiledit">
	            				</div>
	            			</div>
	            		</div>
	            		<div class="col-md-12">
	     					<div class="form-group">
	     						<label>Permisos</label>
	     						<div class="sales-list table-responsive">
	     							<table class='table table-striped'>
		     							<thead>
		     								<tr class="text-theme">
		     									<th >Módulos</th>
		     									<th>Listar</th>
		     									<th>Agregar</th>
		     									<th>Editar</th>
		     									<th>Eliminar</th>		     									
		     								</tr>
		     							</thead>
		     							<tbody>
		     								<?php

		     									for ($i=0; $i < count($levels) ; $i++) { 
		     										echo "<tr>";
		     										echo "<td>";
		     											if($levels[$i]=='Campanas'){
		     												echo "Campañas";
		     											} else if($levels[$i]=='UserLevels'){
		     												echo "Perfiles";
		     											} else if($levels[$i]=='Clientes_Informacion'){
		     												echo "Clientes Informacion";
		     											} else if($levels[$i]=='Motivos_Grupos'){
		     												echo "Motivos Grupos";
		     											} else {
		     												echo $levels[$i];
		     											}
		     										echo "<input type='hidden' name='txt_modulos[]' value='".base64_encode($levels[$i])."' ></td>";
		     										echo "<td style='text-align:center;'><input type='checkbox'  name='chck_view".$i."' id='chck_view".$i."' value='8' ></td>";
		     										echo "<td style='text-align:center;'><input type='checkbox'  name='chck_add".$i."' id='chck_add".$i."' value='1' ></td>";
		     										echo "<td style='text-align:center;'><input type='checkbox'  name='chck_edit".$i."' id='chck_edit".$i."' value='4'></td>";
		     										echo "<td style='text-align:center;'><input type='checkbox'   name='chck_delete".$i."' id='chck_delete".$i."' value='2' ></td>";
		     										echo "</tr>";
		     									}
		     						
		     								?>
		     							</tbody>
		     						</table>
		     						<input type="hidden" id="txt_perfilid" name="txt_perfilid" >
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
		$('#tabla4').DataTable({
		       
		 });
	});

	
</script>