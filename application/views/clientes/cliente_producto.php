<body class="app sidebar-fixed aside-menu-off-canvas aside-menu-hidden header-fixed  pace-done">
	<div class="app-body">
		<main class="main" style="height: 100%;">
			<ol class="breadcrumb " id="breadcrumb">
				<li class="breadcrumb-item">
			        <a href="<?php echo base_url("home");?>">Inicio</a>
			    </li> 
			    <li class="breadcrumb-item">
			        <a href="<?php echo base_url("clientes");?>">Reportar</a>
			    </li> 
			    <li class="breadcrumb-item active">
			        <a href="">Reportar Materiales</a>
			    </li> 
			</ol>
			<div class="container-fluid">
				<div class="animated fadeIn">
					<h4>Reportar Materiales</h4>
					<div class='row'>
						<div class='col-md-12'>
							<div class='card ecom-widget-sales'>
								<div class='card-body'>
									<ul>
										<li>Campaña <span><?php echo $campana["campana"];?></span></li>
										<li>Acci&oacute;n <span><?php echo $campana["Accion"];?></span></li>
										<li>Sucursal <span><?php echo $campana["Cliente"];?></span></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<?php 
					if(isset($productos)){
						if(count($productos)>0){ ?>
						<div class="row">
							<form id="form_prod" action="<?php echo base_url(); ?>clientes/send_products" method="post" style="width: 100%;">
								<div class="col-md-10">
									<div class="card">
										<div class="card-body">
											<div class="table-responsive">
												<table class="table table-hover">
													<tbody>
														<?php
															for($i=0;$i<count($productos);$i++){
																$m=$productos[$i];
																echo "<tr>";
																echo "<th class='text-theme' colspan='2'>Material</th>";
																echo "<td colspan='2'>".$m['Medicion']." <input type='hidden' id='hd_id_info_".$i."' name='hd_id_info_".$i."' value='".base64_encode($m['Id_info'])."' ></td>";
																echo "</tr>";
																echo "<tr>";
																echo "<th class='text-theme'>Acuerdo</th>";
																echo "<td>".$m['Acuerdo']."<input type='hidden' id='hd_id_acordado_".$i."' name='hd_id_acordado_".$i."' value='".$m['Acuerdo']."'></td>";
																echo "<th class='text-theme' >Impl.</th>";
																echo "<td><input class='form-control' type='number' onchange='implemntados(".$i.")'  id='txt_implementado_".$i."' name='txt_implementado_".$i."' pattern='[0-9]' onfocus='num(".$i.")' value='".$m['Implementado']."' ></td>";
																echo "</tr>";
																echo "<tr class='border-tr'>";
																echo "<th class='text-theme' colspan='2'>Motivo</th>";
																echo "<td colspan='2'><select class='form-control' id='id_motivo_".$i."'  name='id_motivo_".$i."' ><option value='0'>Seleccionar</option>";
																	foreach($motivos as $s) {
																		if($s['ID_Motivo'] == $m['ID_Motivo']){
																			echo "<option value='".$s['ID_Motivo']."' selected>".$s['Motivo']."</option>";
																		}else{
																			echo "<option value='".$s['ID_Motivo']."'>".$s['Motivo']."</option>";
																		}
																	}
																echo "</select></td>";
																echo "</tr>";
															}
														?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<input type="hidden" id="txt_contmat" name="txt_contmat"  value="<?php echo count($productos); ?>">
								</div>
							</form>
						</div>
					<?php }
					} ?>
					<div class="row">
						<div class="col-md-12">
							<div class="card text-theme">
								<div class="card-header">
									<strong>Fotos</strong>
								</div>
								<div class="card-body text-theme">
									<div class="row duplicar" >
										<?php
											if(isset($fotos)){
												$fot=count($fotos);
											} else {
												$fot=0;
												//info_cliente_Santander_2019[motivo]="Visitado Existoso"
											}
											if($fot>0){
												for ($i=0; $i < count($fotos); $i++) { 
													echo "<div class='col-md-6' id='div_".$i."'>
														<div class='form-group'>
															<label>Foto &nbsp;</label>
															<div class='row form-group' style='margin-bottom: 0em;'>
																<div class='col-lg-12 col-md-4'>
                                                                    <button class='btn btn-outline-theme foto' data-toggle='modal' data-target='#modalfoto' onclick='ver_foto(\"".base64_encode($fotos[$i]["id_foto"])."\")' ><i class='fa fa-picture-o'></i></button>
                                                                    <input type='hidden'   value='".$fotos[$i]["id_foto"]."' name='fl_id_foto_".$i."' id='fl_id_foto_".$i."' >
                                                                    <button class='btn btn-outline-theme pull-right'  onclick='eliminar(\"".base64_encode($fotos[$i]["id_foto"])."\")' ><i class='fa fa-times'></i></button>
                                                                </div>
                                                            </div>
                                                           	<div class='input-group'>
																<label for='fl_foto_".$i."' class='btn btn-outline-theme' ><i class='fa fa-camera'></i></label>
																<input type='file' name='fl_foto_".$i."' id='fl_foto_".$i."' style='display:none;' onchange='foto(".$i.")' disabled>&nbsp;
																<input type='text' class='form-control tam-width' id='fl_archivo_".$i."' name='fl_archivo_".$i."' placeholder='Ingrese Nombre Fotografía' disabled value='".$fotos[$i]["nombre_foto"]."'>&nbsp;
																<button id='fl_btn_".$i."' class='btn btn-outline-theme' style='display:none;' onclick='subir_foto(".$i.")'><i class='fa fa-thumbs-o-up'></i></button>
																<button id='fl_btnmod_".$i."' class='btn btn-outline-theme' onclick='modificar(".$i.")'><i class='fa fa-pencil'></i></button>
																<input type='hidden' value='1' name='fl_validator_".$i."' id='fl_validator_".$i."' >
															</div>
															<div class='form-group' style='margin-top: 0.5em;'>
																<div class='progress'>
																	<div class='progress-bar progress-bar-stripped' role='progressbar' aria-valuemin='0' aria-valuenow='0' aria-valuemax='100' style='width:0%;'></div>
																</div>
															</div>
														</div>
													</div>";
												}
											} else {
										?>
											<div class="col-md-6" id="div_0">
												<div class="form-group">
													<label >Foto &nbsp;</label>
													<div class="input-group">
														<label for="fl_foto_0" class='btn btn-outline-theme' data-toggle='tooltip' data-placement='top' title='Extensiones Permitidas: .png, .jpg, .jpeg'><i class="fa  fa-camera"></i></label>
														<input type="file" name="fl_foto_0" id="fl_foto_0" style='display:none;' onchange="foto(0)">&nbsp;
														<input type='hidden'   value='' name='fl_id_foto_0' id='fl_id_foto_0' >
														<input type="text" class="form-control" name="fl_archivo_0" id="fl_archivo_0" placeholder="Ingrese Nombre Fotografia" style="display: none;" >&nbsp;
														<button id='fl_btn_0' class='btn btn-outline-theme' style="display:none;" onclick='subir_foto(0)'><i class="fa  fa-thumbs-o-up"></i></button>
														<button id='fl_btnmod_0' class='btn btn-outline-theme' style="display:none;" onclick='modificar(0)'><i class="fa  fa-pencil"></i></button>
														<input type='hidden' value='0' name='fl_validator_0' id='fl_validator_0' >
													</div>											
													<div class="form-group" style="margin-top: 0.5em;">
														<div class="progress">
															<div class="progress-bar progress-bar-stripped" role="progressbar" aria-valuemin="0" aria-valuenow="0" aria-valuemax="100" style="width:0%"></div>
														</div>
													</div>	
												</div>										
											</div>
										<?php
											}
										?>
									</div>
								</div>
								<div class="card-footer">
									<input type="hidden" name="txt_cont" id="txt_cont" value="<?php if($fot>0){ echo count($fotos);} else { echo "1"; } ?>">
									<button class="btn btn-sm btn-theme" id="dupl"><i  class="fa fa-plus"></i></button>
									<button class="btn btn-sm btn-theme" id="dism" style="display: none;"><i  class="fa fa-minus"></i></button>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="card">
								<div class="card-header">
									<button class="btn btn-outline-theme" id="btn_send"><i class="fa fa-send"></i> Hecho </button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
	</div>
	<div class="modal fade" id="modalfoto"  role="dialog"  aria-hidden="true" style="display: none;">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header ">
	                <h6 class="modal-title"></h6>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
	                    <span aria-hidden="true">×</span>
	               </button>
	            </div>
	            <div class="modal-body">
	            	<div class="row">
	            		<div class="col-md-12">
	            			<img style="width:100%" >
	            		</div>
	            	</div>
	            </div>
			</div>
		</div>
	</div>
</body>
<script>
	$("#dupl").click(function(){
		// $("#div_0").clone(true,true).appendTo(".duplicar");
		var dup=$("#txt_cont").val();
		if(dup>0){
			$("#div_0").clone(true,true).attr('id','div_'+dup).insertAfter($('[id^=div_]:last'));
			$("#div_"+dup).find(".foto").remove();
			$("#div_"+dup).find(".pull-right").remove();
			$("#div_"+dup).find("#fl_id_foto_0").attr('id','fl_id_foto_'+dup).attr('name','fl_id_foto_'+dup).val("");
			$("#div_"+dup).find("#fl_foto_0").attr('id','fl_foto_'+dup).attr('name','fl_foto_'+dup).attr('onchange','foto('+dup+')').prop("disabled",false).val("");
			$("#div_"+dup).find("#fl_archivo_0").attr('id','fl_archivo_'+dup).attr('name','fl_archivo_'+dup).val("").prop("disabled",false).hide();
			$("#div_"+dup).find("#fl_btn_0").attr('id','fl_btn_'+dup).attr('onclick','subir_foto('+dup+')').hide();
			$("#div_"+dup).find("#fl_btnmod_0").attr('id','fl_btnmod_'+dup).attr('onclick','modificar('+dup+')').hide();
			$("#div_"+dup).find("#fl_validator_0").attr('id','fl_validator_'+dup).attr('name','fl_validator_'+dup).val("0");
			$("#fl_foto_"+dup).parent().find("label").attr("class","btn btn-outline-theme").attr('for','fl_foto_'+dup).attr('class','btn btn-outline-theme');	
			$("#div_"+dup).find(".progress-bar").attr('aria-valuenow','0').attr('style','width:0%');
			$("#fl_foto_"+dup).prop('disabled',false);			
			dup++;
			$("#txt_cont").val(dup);
			$("#dism").show();
		}
	});

	$("#dism").click(function(){
		var dup=parseInt($("#txt_cont").val());
		var d=dup-1;
		$(".duplicar").find("#div_"+d).remove();
		$("#txt_cont").val(d);
		<?php 
			if(isset($fotos)){
				$fot=count($fotos);
			} else {
				$fot=0;
			}
			if($fot>0){ 
				echo "var total=".count($fotos).";";
		?>
			if(parseInt($("#txt_cont").val())==total){
				$("#dism").hide();
				$("#txt_cont").val(total);
			}
		<?php 
			} else { 
		?>
			if(parseInt($("#txt_cont").val())==1){
				$("#dism").hide();
				$("#txt_cont").val("1");
			}
		<?php 
			} 
		?>
	});

	$("#btn_send").click(function () {
		var exit=0;		
		var vacios=0;
		var dat=0;
		var val=0;
		<?php 
			if(isset($productos)){ 
				if(count($productos)>0){
		?>
		var exitoso=new Array();
			<?php foreach($motivos as $s) {
				if($s["exitoso"]==1){
					echo "exitoso.push(".$s["ID_Motivo"].");";
				}
		}?>
		var e=0;
		var total=parseInt(document.getElementById("txt_contmat").value); 
		for (var i = 0; i < total; i++) {
			if(document.getElementById("id_motivo_"+i).value=="0"){
				vacios+=1;
				$("#id_motivo_"+i).attr('style','border-color:#FF0004; outline:0; -webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(255, 71, 74, 1)');
			} else {
				
				$("#id_motivo_"+i).removeAttr('style');
				var motivo=parseInt(document.getElementById("id_motivo_"+i).value);
				for(var j = 0; j < exitoso.length; j++){
					if(exitoso[j]==motivo){
						var imp=parseInt(document.getElementById("txt_implementado_"+i).value);
						if(imp<=0){
							exit+=1;
							$("#txt_implementado_"+i).attr('style','border-color:#FF0004; outline:0; -webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(255, 71, 74, 1)');
						} else {
							e+=1;
							$("#txt_implementado_"+i).removeAttr('style');
						}
					} else {
						e+=1;
					}
				}				
			}
		}
		<?php 
				} else { 
		?>
		var e=1;
		<?php
				}
			} else {		
		?>
		var e=1;
		<?php 
			} 
		?>
		if(vacios>0){
			alert("Hay datos incompletos en el formulario de materiales, revise e intentelo nuevamente");
		} else if(exit>0){
			alert("Cuando el motivo es Exitoso, la cantidad de implementados debe ser igual o mayor a lo acordado");
		} else if(e>0){
			var tf=parseInt($("#txt_cont").val());
			for (var i = 0; i < tf; i++) {
				if($("#fl_id_foto_"+i).length==0){
					if($("#fl_foto_"+i).val()==""){
						dat+=1;
						$("#fl_foto_"+i).parent().find("label").attr("class","btn btn-outline-danger");
						$("#fl_archivo_"+i).attr('style','display:none;');
					} else {
						foto(i);
					}
				}
				if($("#fl_archivo_"+i).val()==""){
					dat+=1;
					if($("#fl_archivo_"+i).css('display') != 'none'){
						$("#fl_archivo_"+i).attr('style','border-color:#FF0004; outline:0; -webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(255, 71, 74, 1)');
					}
					
				} else {
					$("#fl_archivo_"+i).removeAttr('style');
				}
				if($("#fl_validator_"+i).val()=="" || $("#fl_validator_"+i).val()=="0"){
					val+=1;
					if($("#fl_btn_"+i).css('display') != 'none'){
						$("#fl_btn_"+i).attr("class","btn btn-outline-danger");
					}
				} else {
					$("#fl_btn_"+i).attr("class","btn btn-outline-theme");					
				}
			}
			if(dat>0){
				alert("Hay datos incompletos en el formulario de fotos");
			} else if(val>0){
				alert("Para que la foto sea registrada, debe presionar el botón enviar");
			} else{
			<?php if(isset($productos)){ 
					if(count($productos)>0){
			?>
				$("#form_prod").submit();
			<?php 	} else { ?>
				window.location.href='<?php echo base_url(); ?>clientes/fotos';
			<?php 	}
				} else {
			?>
				window.location.href='<?php echo base_url(); ?>clientes/fotos';
			<?php
				} ?>
			}
		}
	});

	

	function num(it){
		$('#txt_implementado_'+it).validCampoFranz('0123456789'); 
	}

	function implemntados(unico){
		var implementado = $("#txt_implementado_" + unico).val();
		var acordado = $("#hd_id_acordado_" + unico).val();		
		var exitoso=0;
		if (implementado > 0){
			<?php
				if(isset($motivos)){
					foreach($motivos as $s) {
						if($s["exitoso"]==1){
							echo "exitoso=".$s["ID_Motivo"].";";
						}
					}

				}
			?>
			$("#id_motivo_" + unico).val(exitoso);
		} else {
			$("#id_motivo_" + unico).val("0");
		}
	}


	function foto(it) {
		var archivo=$("#fl_foto_"+it).val();
		var ext=(archivo.substring(archivo.lastIndexOf("."))).toLowerCase();
		if(archivo != ""){
			if(ext==".png" || ext==".jpg" || ext==".jpeg" || ext==".pdf"){
				$("#fl_foto_"+it).parent().find("label").attr("class","btn btn-outline-success");
				$("#fl_archivo_"+it).show();
				$("#fl_btn_"+it).show();
			} else {
				alert("El archivo ingresado tiene una extensión no permitida, inténtelo nuevamente");
				$("#fl_foto_"+it).parent().find("label").attr("class","btn btn-outline-danger");
				$("#fl_archivo_"+it).hide();
				$("#fl_btn_"+it).hide();
			}
		}
	}

	function modificar(it){
		$("#fl_btn_" + it).show( "slow");
		$("#fl_btnmod_" + it).hide( "slow");
		$("#fl_archivo_"+it).prop( "disabled", false);
		$("#fl_foto_"+it).parent().find("label").attr("class","btn btn-outline-theme");
		$("#fl_foto_"+it).prop( "disabled", false);
		$("#div_"+it).find(".progress-bar").attr('aria-valuenow','0').attr('style','width:0%');	
		$("#fl_validator_"+it).val("0");

	}

	function subir_foto(it){
		var archivo=$("#fl_foto_"+it).val();
		var ext=(archivo.substring(archivo.lastIndexOf("."))).toLowerCase();
		nombre=$("#fl_archivo_"+it).val();
		var valido=true;
		if($("#fl_id_foto_"+it).length>0){
			if(nombre==""){
				valido=false;
				alert("Antes de enviar la información, debe ingresar un nombre para la fotografía");
			} else {
				if(archivo != ""){
					if(ext==".png" || ext==".jpg" || ext==".jpeg" || ext==".pdf"){
						valido=true;
					} else {
						valido=false;
						alert("Antes de enviar la información, debe adjuntar un archivo con las extensiones .png, .jpg y .jpeg");
					}
				}
			}
		} else {			
			if(archivo != ""){
				if(ext==".png" || ext==".jpg" || ext==".jpeg" || ext==".pdf"){
					if(nombre==""){
						valido=false;
						alert("Antes de enviar la información, debe ingresar un nombre para la fotografía");
					} else {
						valido=true;
					}					
				} else {
					valido=false;
					alert("Antes de enviar la información, debe adjuntar un archivo con las extensiones .png, .jpg y .jpeg");
				}				
			} else {
				 valido=false;
				alert("Antes de enviar la información, debe adjuntar un archivo con las extensiones .png, .jpg y .jpeg");
			}
		}

		if(valido==true){
			var data=new FormData();
			data.append('id_campana','<?php echo base64_encode($campana["id_campana"]); ?>');
			data.append('id_accion','<?php echo base64_encode($campana["id_accion"]); ?>');
			data.append('id_cliente','<?php echo base64_encode($campana["Cliente"]); ?>');
			data.append('nombre',$("#fl_archivo_"+it).val());
			if(archivo != ""){
				data.append('file',$('#fl_foto_' + it)[0].files[0]);
			}
			if($("#fl_id_foto_"+it).length>0){
				if($("#fl_id_foto_"+it).val()!=""){
					data.append('id',$("#fl_id_foto_"+it).val());
				}
			}			
			$("#fl_btn_"+it).prop('disabled',true);
			$("#dupl").prop('disabled',true);
			$.ajax({
				url:"<?php echo site_url(); ?>clientes/addFoto",
				type:'POST',
				contentType:false,
				processData:false,
				data:data,
				xhr:function(){
					var xhr = new window.XMLHttpRequest();
					xhr.addEventListener("progress", function(evt){
						if (evt.lengthComputable) {
							var percentComplete = evt.loaded / evt.total;
							var percent=percentComplete*100;
							var style='width:'+percent+'%';
							//Do something with download progress
							$("#div_"+it).find(".progress-bar").attr('aria-valuenow',percent).attr('style',style);
						}
					}, false);
					return xhr;
				},
				success: function(data){
					var d=data.split("-");
					if(d[0]=='OK'){
						$("#fl_validator_"+it).val("1");
						$("#fl_btn_" + it).hide( "slow");
						$("#fl_btnmod_" + it).show( "slow");
						$("#dupl").prop('disabled',false);
						$("#fl_btn_"+it).prop('disabled',false);
						$("#fl_archivo_"+it).prop( "disabled", true);
						$("#fl_id_foto_"+it).val(d[1]);
						$("#fl_foto_"+it).prop( "disabled", true);
					} else {
						alert('Favor completar los datos');
						$("#fl_btnmod_" + it).blur();
					}
				}
			});	
		}
	}	

	function ver_foto(id) {
		$.ajax({
			url: "<?php echo site_url(); ?>clientes/product",
			type:"POST",
			data:"id="+id,
			dataType:"json",
			success: function(data){
				$("#modalfoto").find("h6").text(data.nombre_foto);
				$("#modalfoto").find("img").attr("src","<?php echo base_url("archivos/fotos/"); ?>"+data.id_accion+"/"+data.foto+"");
				// $("#modalfoto").modal('show');
			}
		});
	}

	function eliminar(id) {
		if(confirm("¿Estás seguro de eliminar la fotografía?")){
			$.ajax({
				url: "<?php echo site_url(); ?>clientes/deleteFoto",
				type:"POST",
				data:"id="+id,
				dataType:"json",
				success: function(data){					
					var fotos="";
					if(data.length>0){
						$("#txt_cont").val(data.length);
						for (var i=0; i < data.length; i++) { 
							fotos+="<div class='col-md-6' id='div_"+i+"'>";
							fotos+="<div class='form-group'>";
							fotos+="<label>Foto &nbsp;</label>";
							fotos+="<div class='row form-group' style='margin-bottom: 0em;'>";
							fotos+="<div class='col-lg-12 col-md-4'>";
	                        fotos+="<button class='btn btn-outline-theme foto' data-toggle='modal' data-target='#modalfoto' onclick='ver_foto(\""+btoa(data[i].id_foto)+"\")' ><i class='fa fa-picture-o'></i></button>";
	                        fotos+="<input type='hidden'   value='"+data[i].id_foto+"' name='fl_id_foto_"+i+"' id='fl_id_foto_"+i+"' >";
	                        fotos+="<button class='btn btn-outline-theme pull-right'  onclick='eliminar(\""+btoa(data[i].id_foto)+"\")' ><i class='fa fa fa-times'></i></button>";
	                        fotos+="</div>";
	                        fotos+="</div>";
	                        fotos+="<div class='input-group'>";
	                        fotos+="<label for='fl_foto_"+i+"' class='btn btn-outline-theme' ><i class='fa fa-camera'></i></label>";
							fotos+="<input type='file' name='fl_foto_"+i+"' id='fl_foto_"+i+"' style='display:none;' onchange='foto("+i+")' disabled>&nbsp;";
							fotos+="<input type='text' class='form-control tam-width' id='fl_archivo_"+i+"' name='fl_archivo_"+i+"' placeholder='Ingrese Nombre Fotografía' disabled value='"+data[i].nombre_foto+"'>&nbsp;";
							fotos+="<button id='fl_btn_"+i+"' class='btn btn-outline-theme' style='display:none;' onclick='subir_foto("+i+")'><i class='fa fa-thumbs-o-up'></i></button>";
							fotos+="<button id='fl_btnmod_"+i+"' class='btn btn-outline-theme' onclick='modificar("+i+")'><i class='fa fa-pencil'></i></button>";
							fotos+="<input type='hidden' value='1' name='fl_validator_"+i+"' id='fl_validator_"+i+"' >";
							fotos+="</div>";
							fotos+="<div class='form-group' style='margin-top: 0.5em;'>";
							fotos+="<div class='progress'>";
							fotos+="<div class='progress-bar progress-bar-stripped' role='progressbar' aria-valuemin='0' aria-valuenow='0' aria-valuemax='100' style='width:0%;'></div>";
							fotos+="</div>";
							fotos+="</div>";
							fotos+="</div>";
							fotos+="</div>";
						}
					} else {
						$("#txt_cont").val("1");
						fotos+="<div class='col-md-6' id='div_0'>";
						fotos+="<div class='form-group'>";
						fotos+="<label >Foto &nbsp;</label>";
						fotos+="<div class='input-group'>";
						fotos+="<label for='fl_foto_0' class='btn btn-outline-theme' data-toggle='tooltip' data-placement='top' title='Extensiones Permitidas: .png, .jpg, .jpeg'><i class='fa  fa-camera'></i></label>";
						fotos+="<input type='file' name='fl_foto_0' id='fl_foto_0' style='display:none;' onchange='foto(0)'>&nbsp;";
						fotos+="<input type='hidden'   value='' name='fl_id_foto_0' id='fl_id_foto_0' >";
						fotos+="<input type='text' class='form-control' name='fl_archivo_0' id='fl_archivo_0' placeholder='Ingrese Nombre Fotografia' style='display: none;' >&nbsp;";
						fotos+="<button id='fl_btn_0' class='btn btn-outline-theme' style='display:none;' onclick='subir_foto(0)'><i class='fa  fa-thumbs-o-up'></i></button>";
						fotos+="<button id='fl_btnmod_0' class='btn btn-outline-theme' style='display:none;' onclick='modificar(0)'><i class='fa  fa-pencil'></i></button>";
						fotos+="<input type='hidden' value='0' name='fl_validator_0' id='fl_validator_0' >";
						fotos+="</div>";											
						fotos+="<div class='form-group' style='margin-top: 0.5em;'>";
						fotos+="<div class='progress'>";
						fotos+="<div class='progress-bar progress-bar-stripped' role='progressbar' aria-valuemin='0' aria-valuenow='0' aria-valuemax='100' style='width:0%'></div>";
						fotos+="</div>";
						fotos+="</div>";	
						fotos+="</div>";										
						fotos+="</div>";
					}
					$(".duplicar").html(fotos);
				}
			});
		}
	}

</script>
<style type="text/css">
	.main {
		margin-left: 0px !important;
	}

	.text-theme{
		color:#f57c00 !important;
	}

	.ecom-widget-sales ul li span{
		color:#f57c00 !important;
		display:block;
	    width:60%;
	    word-wrap:break-word;
	}

	@media (max-width: 576px) { .ecom-widget-sales ul li span{  width:100%; } }

	.table .size{
		width:100%;
	    word-wrap:break-word;
	    font-size: 70%;
	}

	.table th, .table td{
		vertical-align: initial;
		padding: 0.6rem;
		border-top:none;
	}

	.border-tr{
		border-bottom-style:solid;
		border-bottom-width:thick;
		border-bottom-color:#c2cfd6;
	}

</style>