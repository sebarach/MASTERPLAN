<body class="app sidebar-fixed aside-menu-off-canvas aside-menu-hidden header-fixed  pace-done">
	<div class="app-body">
		<main class="main sidebar-fixed sidebar-compact aside-menu-off-canvas aside-menu-hidden header-fixed" style="height: 100%;">
			<ol class="breadcrumb " id="breadcrumb">
			   	<li class="breadcrumb-item active">
			        <a href="">Grupos Motivos</a>
			    </li>
			</ol>
			<div class="container-fluid">
				<div class="animated fadeIn">
					<h3>Grupos Motivos</h3>
					<div class="row">
						<div class="col-md-8">
							<div class="card card-accent-theme">
								<?php
									$perm=$permisos["permisos"]-8;
									if($perm>=1){
										if($perm!=2 || $perm!=4){
											echo "<div class='card-header'><button type='button' data-toggle='modal' data-target='#modal11' onclick='limpiar(\"mg_add\")' class='btn btn-sm btn-theme'><i class='mdi mdi-plus'></i>Agregar</button></div>";
										}								
									}
								?>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="display table table-hover table-striped" id="tabla6">
										<thead>
											<tr>
												<th style="width:150px !important;"></th>
												<th class="text-theme">ID Grupo Motivo</th>
												<th class="text-theme">Grupo Motivo</th>
											</tr>
										</thead>
										<tbody>
											<?php
												foreach ($grupos as $g) {
													echo "<tr>";
													echo "<td style='text-align:center;'><div class='btn-group-vertical'>";
													if($perm>=4){
														if($perm!=2 || $perm!=1){
															echo "<button type='button' class='btn btn-sm btn-outline-theme' onclick='grupo(\"".base64_encode($g["id_grupo_motivos"])."\")' data-toggle='modal' data-target='#modal14' style='margin-top:0;' title='Editar'><i class='fa  fa-pencil'></i></button>";
														}
													}
													for($i=0; $i<count($modulos); $i++) {
														if($modulos[$i]=="Motivos"){
															echo "<button type='button' class='btn btn-outline-theme btn-sm' onclick='motivos(\"".base64_encode($g["id_grupo_motivos"])."\")' title='Motivos'><i class='fa fa-archive'></i></button>";
														}
													}
													echo "</div></td>";
													echo "<td>".$g["id_grupo_motivos"]."</td>";
													echo "<td>".$g["grupo_motivos"]."</td>";
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
	</div>
</body>
<div class="modal fade" id="modal11"  role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        	<form method="post" action="<?php echo base_url("grupos_motivos/agregar"); ?>" onsubmit="return valida_form('mg_add');">
	            <div class="modal-header">
	                <h6 class="modal-title">Agregar Grupo Motivo</h6>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">×</span>
	               </button>
	            </div>
	            <div class="modal-body">
	            	<div class="row">
	            		<div class="col-md-12">
	            			<div class="form-group">
	            				<label>Grupo Motivo</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_grupomotivoadd" name="txt_grupomotivoadd">
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        	<form method="post" action="<?php echo base_url("grupos_motivos/editar"); ?>" onsubmit="return valida_form('mg_edit');">
	            <div class="modal-header">
	                <h6 class="modal-title">Editar Grupo Motivo</h6>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">×</span>
	               </button>
	            </div>
	            <div class="modal-body">
	            	<div class="row">
	            		<div class="col-md-12">
	            			<div class="form-group">
	            				<label>Grupo Motivo</label>
	            				<div class="input-group">
									<span class="input-group-addon bg-theme">
										<i class="fa fa-asterisk"></i>
									</span>
									<input type="text" class="form-control" id="txt_grupomotivoedit" name="txt_grupomotivoedit">
									<input type="hidden" class="form-control" id="txt_grupomotivoid" name="txt_grupomotivoid">
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