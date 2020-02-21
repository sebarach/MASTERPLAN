<script src="<?php echo base_url("assets/js/libs/multiselect/js/jquery.multi-select.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/jquery.quicksearch.js"); ?>"></script>
<body class="app sidebar-fixed aside-menu-off-canvas aside-menu-hidden header-fixed  pace-done">
	<div class="app-body">
		<main class="main" style="height: 100%; ">
			<ol class="breadcrumb " id="breadcrumb">
				<li class="breadcrumb-item ">
			        <a href="<?php echo base_url("empresas"); ?>"><?php echo $empresa; ?></a>
			    </li>
			    <li class="breadcrumb-item ">
			        <a href="<?php echo base_url("campanas"); ?>"><?php echo $campana["campana"]; ?></a>
			    </li>
			   	<li class="breadcrumb-item active">
			        <a href="">Biblioteca</a>
			    </li>
			</ol>
			<div class="container-fluid ">
				<div class="animated fadeIn">
					<h4 style="padding-bottom: 0.5rem;" ><?php echo $campana["campana"];?></h4>
					<div class="row" id="listcarpetas">
						<div class="col-md-12">
							<?php
								$perm=$permisos["permisos"]-8;
								if($perm>=1){
									if($perm!=2 || $perm!=4){

							?>
								<div class="row">
									<div class="col-md-3">
										<button id="btnCrearCarpeta" type='button' data-toggle='modal' data-target='#modal9' onclick='limpiar("car_add")' class='btn btn-sm btn-theme'><i class='mdi mdi-folder-plus'></i>Crear Carpeta</button>

									</div>
								</div>
								<br>
							<?php
									}
								}				
							?>
							
							<div class="row" id="carpetas">
								<?php
								 	$con=0;
								 	$div=0;
									foreach ($carpetas as $c) {
										echo "<div class='col-md-3'>
											<div class='card stats-widget-2'>
												<div class='widget-body clearfix'>
													<div class='widget-text ecom-widget-sales'>
														<h5 >".$c["nombre_carpeta"]."</h5>
														<ul>
															<li><small>Creador: ".$c["usuario"]."</small></li>
															<li><small>Fecha Creación: ".date("d-m-Y",strtotime($c["fecha_registro"]))."</small></li>	
														</ul>					
													</div>
													<div class='btn-group card-body'>
														<button type='button' class='btn btn-sm btn-outline-theme' 
														onclick='carpeta(\"".base64_encode($c["id_carpeta"])."\")' data-toggle='modal' data-target='#modal10'  title='Editar'><i class='fa fa-pencil'></i></button>
														<form method='post' action='".base_url("informes/deletecarpeta")."' onsubmit='return valida(\"".$c["nombre_carpeta"]."\")' >
																<button type='submit' class='btn btn-sm btn-outline-theme' title='Eliminar'><i class='fa fa-times'></i></button>
																<input type='hidden' name='txt_carpetadelid' id='txt_carpetadelid' value='".base64_encode($c["id_carpeta"])."'>
														</form>
														<button type='button' class='btn btn-sm btn-outline-theme' data-toggle='modal' data-target='#modal11' onclick='verDocumentos(\"".base64_encode($c["id_carpeta"])."\")'  title='Documentos'><i class='fa fa-folder'></i></button>
													</div>
													<span class='pull-right watermark'>
														<i class='fa fa-folder-open'></i>
													</span>
												</div>
											</div>
										</div>";										
									}
								?>
								
							</div>

						</div>
					</div>
				</div>
			</div>
		</main>
		<div class="modal fade" id="modal9"  role="dialog"  aria-hidden="true">
		    <div class="modal-dialog" role="document">
		        <div class="modal-content">
		        	<form method="post" action="<?php echo base_url("informes/addcarpeta"); ?>" onsubmit=" return valida_form('car_add');">
		        		<div class="modal-header">
			                <h6 class="modal-title">Agregar Carpeta</h6>
			                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                    <span aria-hidden="true">×</span>
			               </button>
			            </div>
			            <div class="modal-body">
			            	<div class="row">
			            		<div class="col-md-12">
			            			<div class="form-group">
			            				<label>Nombre Carpeta</label>
			            				<div class="input-group">
											<span class="input-group-addon bg-theme">
												<i class="fa fa-asterisk"></i>
											</span>
											<input type="text" class="form-control" id="txt_carpetaadd" name="txt_carpetaadd">
			            				</div>
			            			</div>
			            		</div>
			            		<div class="col-md-12">
			            			<div class="form-group">
			            				<label>Perfiles</label>
			            				<select class="form-control" style="width: 100%;" id="lbl_perfilcaradd" name="lbl_perfilcaradd[]" multiple>
			            					<?php
			            						foreach ($perfiles as $p) {
			            							echo "<option value='".$p["userlevelid"]."'>".$p["userlevelname"]."</option>";
			            						}
			            					?>
			            				</select>
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
		    <div class="modal-dialog" role="document">
		        <div class="modal-content">
		        	<form method="post" action="<?php echo base_url("informes/editcarpeta"); ?>" onsubmit=" return valida_form('car_edit');">
		        		<div class="modal-header">
			                <h6 class="modal-title">Editar Carpeta</h6>
			                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                    <span aria-hidden="true">×</span>
			               </button>
			            </div>
			            <div class="modal-body">
			            	<div class="row">
			            		<div class="col-md-12">
			            			<div class="form-group">
			            				<label>Nombre Carpeta</label>
			            				<div class="input-group">
											<span class="input-group-addon bg-theme">
												<i class="fa fa-asterisk"></i>
											</span>
											<input type="text" class="form-control" id="txt_carpetaedit" name="txt_carpetaedit">
			            				</div>
			            			</div>
			            		</div>
			            		<div class="col-md-12">
			            			<div class="form-group">
			            				<label>Perfiles</label>
			            				<select class="form-control" style="width: 100%;" id="lbl_perfilcaredit" name="lbl_perfilcaredit[]" multiple>
			            					<?php
			            						foreach ($perfiles as $p) {
			            							echo "<option value='".$p["userlevelid"]."'>".$p["userlevelname"]."</option>";
			            						}
			            					?>
			            				</select>
			            			</div>
			            			<input type="hidden" class="form-control" id="txt_carpetaid" name="txt_carpetaid">
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
		<div class="modal fade" id="modal11"  role="dialog"  aria-hidden="true">
		    <div class="modal-dialog modal-lg" role="document">
		        <div class="modal-content">
		        	<div class="modal-header">
			            <h6 class="modal-title">Documentos</h6>
			            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                <span aria-hidden="true">×</span>
			           </button>
			       </div>
			       <div class="modal-body">
			       		<div class="row">
			       			<div class="col-md-2">
			       				<button type="button"  class="btn btn-sm btn-theme" onclick='add();' ><i class="fa  fa-plus"></i>Agregar Documento</button>
			       			</div>
			       		</div>
			       		<br>
			       		<form id="form23" method="post" style="display: none;" enctype="multipart/form-data" action="<?php echo base_url("informes/subirDoc"); ?>" onsubmit=" return valida_form('doc_add');">
			       			<div class="row">			       			
				       			<div class="col-md-3">
				       				<div class="form-group">
			            				<label>Nombre Documento</label>
										<input type="text" class="form-control" id="txt_archivoadd" name="txt_archivoadd">		
			            			</div>
				       			</div>
				       			<div class="col-md-3">
				       				<div class="form-group">
			            				<label>Tipo Documento</label>
			            				<select class="form-control" id="lbl_tipodocadd" name="lbl_tipodocadd" onchange="tipodoc();">
			            					<option value="">Seleccione</option>
			            					<option value="1">Archivo</option>
			            					<option value="2">Enlace Externo</option>
			            				</select>
			            			</div>
				       			</div>
				       			<div class="col-md-3">
				       				<div class="form-group">
				       					<label>Documento</label>
			            				<input type="file" id="txt_doc" name="txt_doc" onchange="docu();" >
			            				<input type="text" style="display: none;" class="form-control" id="txt_urldocadd" name="txt_urldocadd" placeholder="https://www.youtube.com">
			            				<input type='hidden' value='' id='id_carpetajs' name='id_carpetajs'>
			            				<input type='hidden' value='' id='txt_documentoadd' name='txt_documentoadd'>
			            				<input type='hidden' value='' id='txt_documentoid' name='txt_documentoid'>
			            			</div>
				       			</div>	
				       			<div class="col-md-3">
				       				<div class="form-group">
				       					<br>
				       					<button type="submit" class="btn btn-sm btn-theme"><i class='fa fa-upload'></i>Subir Archivo</button>
				       				</div>				       				
				       			</div>			       		
			       			</div>
			       		</form>			       		
			       		<div class="row" id="documentosResp">
			       			
			       		</div>
			       </div>
		        </div>
		    </div>
		</div>
	</div>
</body>
<style type="text/css">
	.main {
		margin-left: 0px !important;
	}

	.stats-widget-2 .widget-body{
		padding-right: 1rem;
		padding-left: 1rem;
		padding-bottom: 0.2rem;
		padding-top: 0.9rem;
	}

	.widget-body{
		color:#f57c00 !important;
	}

	.widget-body span{
		font-size: 3.5rem;
	}

	.widget-body h5{
		font-size: 1rem;
	    font-weight: 600;
	    margin: 0;
	}

	.ecom-widget-sales ul li {
    	margin-bottom: 0px; 
    }

	small{
		font-size: 0.7rem;
	}

	.card-body{
		padding: 0.4rem;
	}

	.btn-outline-theme:hover {
	    background: #f57c00;
	    color: white !important;
	}

 	.fstElement { font-size: 0.9em; }
	.fstResultItem { font-size: 0.9em; }
	.fstToggleBtn { min-width: 16.5em; }

	.submitBtn { display: none; }

	.fstMultipleMode { display: block; }
	.fstMultipleMode .fstControls { width: 100%; }

	@media (min-width: 992px){
		.modal-lg {
		    max-width: 1300px;
		}
	}

	.font-2xl {
	    font-size: 3.5rem !important;
	}
</style>
<script type="text/javascript">
	$("#lbl_perfilcaradd").multiSelect();
	$("#lbl_perfilcaredit").multiSelect();


	function valida(nombre){
		if(confirm("¿Estas seguro de eliminar la carpeta "+nombre+"?")){
			return true;
		} else {
			return false;
		}
	}

	function validadoc(nombre){
		if(confirm("¿Estas seguro de eliminar el documento "+nombre+"?")){
			return true;
		} else {
			return false;
		}
	}


	function add(){
		if($("#form23").is(":visible")){
			$("#form23").hide("slow");
		} else {
			$("#form23").show("slow");
		}
		limpiar("doc_add");
	}

	function verDocumentos(carpeta){
		var carp=carpeta;
		$("#id_carpetajs").val(carp);
		$("#form23").hide();
		$.ajax({
            url: "<?php echo base_url("informes/obtenerDocumentos"); ?>",
            type: "POST",
            data: "carp="+carp,
            success: function(data) {   
            	$("#modal11").find("#documentosResp").html(data);          
            }
        });
		
	}

	function tipodoc(){
		if($("#lbl_tipodocadd").val()==2){
			$("#txt_urldocadd").show();
			$("#txt_doc").hide();
		} else {
			$("#txt_urldocadd").hide();
			$("#txt_doc").show();
		}
		
	}

	function editar(id){
		$.ajax({
			url:"<?php echo base_url("informes/document"); ?>",
			type: "POST",
			data: "id="+id,
			dataType:"json",
			success: function(data){
				document.getElementById("txt_archivoadd").value=data.nombre_documento;
				if(data.tipo_documento=="url"){
					document.getElementById("lbl_tipodocadd").value="2";
					document.getElementById("txt_urldocadd").value=data.documento;
				} else {
					document.getElementById("lbl_tipodocadd").value="1";
					document.getElementById("txt_documentoadd").value=data.documento;
				}
				document.getElementById("txt_documentoid").value=id;
				$("#form23").attr('action','<?php echo base_url("informes/editDoc"); ?>');
				$("#form23").attr('onsubmit','return valida_form("doc_edit");');
				$("#form23").show("slow");
			}
		});
	}

	function docu(){
		if(document.getElementById("txt_doc").value!=""){
			document.getElementById("txt_documentoadd").value="docu_undefined";
		}
	}

</script>