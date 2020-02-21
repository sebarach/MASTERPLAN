
<script src="<?php echo base_url("assets/js/libs/bootstrap-maxlength/src/bootstrap-maxlength.js");?>"></script>
<body class="app sidebar-fixed aside-menu-off-canvas aside-menu-hidden header-fixed  pace-done">
	<div class="app-body">
		<main class="main" style="height: 100%; ">
			<ol class="breadcrumb " id="breadcrumb">
			   	<li class="breadcrumb-item active">
			        <a href="">SOT</a>
			    </li>
			</ol>
			<div class="container-fluid ">
				<div class="animated fadeIn" style="margin-bottom: 0.7rem;">
					<div class="row">
						<div class="col-md-12">
							<div class="row">
		            			<div class="col-md-4">
		            				<form class="form-group" id="form1" method="POST" action="<?php echo base_url("solicitudes_ot"); ?>">
		            					<select class="form-control" name="id_empresa" id="id_empresa" onchange="filtrar()">
		            						<?php
		            							if($empresa==0){
		            								echo "<option value='0'>Seleccionar Cliente</option>";
		            							}
		            							foreach ($emp as $e) {
		            								if($empresa==$e["id_empresa"]){
		            									$selected="selected";
		            								} else {
		            									$selected="";
		            								}
		            								echo "<option value='".$e["id_empresa"]."'  ".$selected.">".$e["empresa"]."&nbsp;&nbsp; N° Sol: ".$e["solicitudes"]."</option>";
		            							}
		            						?>
		            					</select>
		            				</form>
		            			</div>
		            			<div class="col-md-1">
		            				<a href="<?php echo base_url("solicitudes_ot"); ?>" class="btn btn-sm btn-theme"><i class="fa fa-refresh"></i></a>
		            			</div>
		            		</div>
						</div>
					</div>
				</div>
				<div class="animated fadeIn" <?php if($empresa==0){ echo "style='display: none;'"; }?> >
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-5">
									<div class="card card-accent-primary mb-3">
										<div class="card-body">
											<div class="header">
												<div class="heading">
													<div class="row">
														<div class="col-md-7 ">
															<small class="text-theme">CANT. SOLICITUDES POR ESTADO</small>
														</div>
														<div class="col-md-3 pad05">
															<select id="mesest" class="form-control select" >
																<?php

																	for ($i=1; $i < 13 ; $i++) { 
																		if(date("n")==$i){
																			$select="selected";
																		} else {
																			$select="";
																		}
																		setlocale(LC_ALL,"spanish");
																		$dateObj= DateTime::createFromFormat('!m', $i);
																		$month = strtoupper(strftime('%B', $dateObj->getTimestamp()));
																		echo "<option value='".$i."' ".$select." >".$month."</option>";
																	}
																?>
															</select>
														</div>
														<div class="col-md-2 pad05">
															<select id="anioest" class="form-control select" >
																<?php
																	for ($i=2019; $i < date("Y")+1 ; $i++) {
																		if(date("Y")==$i){
																			$select="selected";
																		} else {
																			$select="";
																		}
																		echo "<option value='".$i."' ".$select." >".$i."</option>";
																	}
																?>
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="text-center">
												<canvas id="chart2" height="98"></canvas>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-5">
									<div class="card card-accent-primary mb-3">
										<div class="card-body">
											<div class="header">
												<div class="heading">
													<div class="row">
														<div class="col-md-7 ">
															<small class="text-theme">CANT. SOLICITUDES POR SEMAFORO</small>
														</div>
														<div class="col-md-3 pad05">
															<select id="mes" class="form-control select" >
																<?php
																	for ($i=1; $i < 13 ; $i++) { 
																		if(date("n")==$i){
																			$select="selected";
																		} else {
																			$select="";
																		}
																		setlocale(LC_ALL, "spanish");
																		$dateObj= DateTime::createFromFormat('!m', $i);
																		$month = strtoupper(strftime('%B', $dateObj->getTimestamp()));
																		echo "<option value='".$i."' ".$select." >".$month."</option>";
																	}
																?>
															</select>
														</div>
														<div class="col-md-2 pad05">
															<select id="anio" class="form-control select" >
																<?php
																	for ($i=2019; $i < date("Y")+1 ; $i++) {
																		if(date("Y")==$i){
																			$select="selected";
																		} else {
																			$select="";
																		}
																		echo "<option value='".$i."' ".$select." >".$i."</option>";
																	}
																?>
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="text-center">
												<canvas id="chart3" height="98"></canvas>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="card  history-transaction card-accent-primary mb-3">
										<div class="card-body pad05" >
											<div class="header">
												<div class="heading">
													<small class="text-theme">SIMBOLOGÍA SEMAFORO</small>
												</div>
											</div>
											<div class="transaction-list">
												<div class="details">
													<i class="fa fa-circle text-success"></i>
													<div class="heading">
														&nbsp;0 a 48 horas
													</div>
												</div>
											</div>
											<div class="transaction-list">
												<a>
													<div class="details">
														<i class="fa fa-circle  text-warning"></i>
														<div class="heading">
															&nbsp;48 a 96 horas
														</div>
													</div>
												</a>
											</div>
											<div class="transaction-list">
												<a>
													<div class="details">
														<i class="fa fa-circle  text-danger"></i>
														<div class="heading">
															&nbsp;96 o más horas
														</div>
													</div>
												</a>
											</div>
											<div class="transaction-list">
												<a>
													<div class="details">
														<i class="fa fa-circle  text-info"></i>
														<div class="heading">
															&nbsp;Solicitud en Pausa
														</div>
													</div>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<form id="formsol" method="post" action="<?php echo site_url(); ?>solicitudes_ot" class="row col-md-12" style='padding-left: 9px;'>
								<input type="hidden" id="id_empresa" name="id_empresa" class="form-control" value="<?php echo $empresa;?>">
								<div class="col-md-1 col-b">
									<select class="form-control" name="aniosot" id="aniosot" style="width: 100%;">
										<?php
										if($anio==0){
											echo '<option value="">Años</option>';
										}
										foreach ($anios as $a) {
											echo "<option value='".$a["anio"]."'>".$a["anio"]."</option>";
										}
										?>
									</select>
								</div>

								<div class="col-md-1 col-b">
									<select class="form-control" name="messot" id="messot" style="width: 100%;">
										<?php
										if($mes_numero==0){
											echo '<option  value="">Meses</option>';
										} else {
											setlocale(LC_ALL, "spanish");
											$dateObj= DateTime::createFromFormat('!m', $mes_numero);
											$month = ucwords(strftime('%B', $dateObj->getTimestamp()));
											echo '<option  value="'.$mes_numero.'">'.$month.'</option>';
										}?>
										
									</select>
								</div>
								<div class="col-md-1 col-b">
									<select class="form-control"  id="campanasot" name="campanasot" style="width: 100%;">
										<?php
										if($campana==0){
											echo '<option value="">Campañas</option>';
										}else if($campana==-1){
											echo '<option value="-1">SIN CAMPAÑA</option>';
										} else {
											echo '<option  value="'.$campana.'">'.$nom_campana.'</option>';
										}
										?>
										
									</select>
								</div>

								<div class="col-md-1 col-b">
									<select class="form-control select" id="estado" name="estado" style="width: 100%;">
										<?php
										if($estado==0){
											echo '<option value="">Estados</option>';
										} else {
											echo '<option value="'.$estado.'">'.$nom_estado.'</option>';
										}?>
									</select>
								</div>

								<div class="col-md-1 col-b">
									<select class="form-control select" id="region" name="region"  style="width: 100%;">
										<?php
										if($region==0){
											echo '<option value="">Región</option>';
										} else {
											echo '<option value="'.$region.'">'.$nom_region.'</option>';
										}?>
										</select>
									</div>									
									<div class="col-md-1 col-b">
										<select class="form-control select" id="comuna" name="comuna" style="width: 100%;">
											<?php
											if($ciudad=='0'){
												echo '<option value="">Ciudad</option>';
											} else {
												echo '<option value="'.$ciudad.'">'.str_replace('_',' ',$ciudad).'</option>';
											}?>
										</select>
									</div>
									<div class="col-md-1 col-b" >
										<select class="form-control select" id="cadena" name="cadena" style="width: 100%;">
										<?php
											if($cadena=='0'){
												echo '<option value="">Cadena</option>';
											} else {
												echo '<option value="'.$cadena.'">'.str_replace('_',' ',$cadena).'</option>';
											}?>												
										</select>
									</div> 

									<div class="col-md-1 col-b" >
										<select class="form-control select" id="local" name="local" style="width: 100%;">
										<?php
											if($sucursal=='0'){
												echo '<option value="">Local</option>';
											} else {
												echo '<option value="'.$sucursal.'">'.$sucursal.'</option>';
											}
											?>												
										</select>
									</div>
								</form>
								<form action="<?php echo base_url("solicitudes_ot"); ?>" method="post" id="formrefresh">
									<input type="hidden" id="id_empresa" name="id_empresa" class="form-control" value="<?php echo $empresa;?>">
											
								</form>
								<div class="col-md-12" style="margin-top: 0.25rem; " >
										<button onclick="buscar()" class="btn btn-sm btn-theme"><i class="fa fa-search"></i></button>
										
										<button type="button" onclick="refresh()" class="btn btn-sm btn-theme"><i class="fa fa-refresh"></i></button>
										<button type="button" class="btn btn-sm btn-success" data-toggle='modal' data-target='#modalreporte'  class="btn btn-sm btn-success"><i class="fa fa-download"></i></button>
										<input type="hidden" name="opcion" id="opcion" value="<?php echo $opcion; ?>"> 
								</div>
						</div>
						<div class="col-md-12">
							<div class="float-right card-body" style="padding: 0.15rem;">
								<div class="row">
									<?php	if(isset($opcion) && count($solicitudes)>0){                
										echo "<div class='col-md-6'>
										<nav >
										<ul class='pagination'>";
										if($opcion!=1){
											echo "<li class='page-item'><a class='page-link text-theme' onclick='pagination(".($opcion-1).")'  > Anterior</a></li>";
										}
										if(($opcion-2)>0){
											echo "<li class='page-item'><a class='page-link text-theme' onclick='pagination(".($opcion-2).")'   >".($opcion-2)."</a></li>";
										}
										if(($opcion-1)>0){
											echo "<li class='page-item'><a class='page-link text-theme' onclick='pagination(".($opcion-1).")'   >".($opcion-1)."</a></li>";
										}   
										echo "<li class='page-item active'><a class='page-link text-white'  href=''  >$opcion</a></li>";
										if(($opcion+1)<=$cantidad){
											echo "<li class='page-item'><a class='page-link text-theme' onclick='pagination(".($opcion+1).")'   >".($opcion+1)."</a></li>";
										}
										if(($opcion+2)<=$cantidad){
											echo "<li class='page-item'><a class='page-link text-theme' onclick='pagination(".($opcion+2).")'  >Siguiente </a></li>";
										}
										echo" </ul>
										</nav></div>";
									} ?> 
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<table class="table table-stripped" style="font-size: 0.65rem;">
								<thead>
									<tr >
										<th></th>
										<th>Semaforo</th> 
										<th>Folio OT</th>										
										<th>Estado</th>	
										<th>Solicitante</th>
										<th >Fecha Creación</th>
										<th>Cadena</th>
										<th>Local</th>
										<th style="width: 140px;">Campaña</th>
										<th  style="width: 190px;" >Tipo Tarea</th>
										<th style="width: 90px;">Asunto</th>									
										<th>Fecha Cierre Real</th>
										<th>Fecha Cierre</th>
									</tr>
								</thead>
								<tbody>
									<?php 	
										foreach ($solicitudes as $s) {
											echo "<tr  style=\"font-size: 0.55rem !important;\">";
											echo "<td ><div class='btn-group btn-group-sm'>
												<button class='btn btn-sm btn-outline-theme' title='Ver Detalle' onclick='solicitudcoordinador(\"".base64_encode($s["id_solicitud"])."\")' data-toggle='modal' data-target='#modaldetsol1' ><i class='fa fa-eye'></i></button>
												<button class='btn btn-sm btn-outline-theme' data-toggle='modal' data-target='#modalchatsol' title='Mensajeria' onclick='chat(\"".base64_encode($s["id_solicitud"])."\")'><i class='fa fa-comments-o'></i></button>
											</div></td>";											
											echo "<td><div class='h1'><i class=\"fa fa-circle ".$s["semaforo"]."\"></i></div></td>";
											echo "<td>".$s["id_solicitud"]."</td>";
											echo "<td>".$s["estado"]."</td>";
											echo "<td>".$s["usuario"]."</td>";
											echo "<td>".str_replace(' ','<br>',date("d-m-Y H:i",strtotime($s["fecha_registro"])))."</td>";
											echo "<td>".$s["cadena"]."</td>";
											echo "<td>".$s["local"]."</td>";
											echo "<td>".$s["campana"]."</td>";
											echo "<td>".$s["tipotarea"]."</td>";
											echo "<td>".$s["asunto"]."</td>";
											if(is_null($s["fecha_estimada"])){
												echo "<td></td>";
											} else {
												echo "<td>".date("d-m-Y",strtotime($s["fecha_estimada"]))."</td>";
											}
											if(is_null($s["fecha_cierre"])){
												echo "<td></td>";
											} else {
												echo "<td>".date("d-m-Y",strtotime($s["fecha_cierre"]))."</td>";
											}
											echo "</tr>";
										}
									?>
								</tbody>
							</table>
						</div>
						<div class="col-md-12">
							<div class="float-right card-body" style="padding: 0.15rem;">
								<div class="row">
									<?php	if(isset($opcion) && count($solicitudes)>0){                
										echo "<div class='col-md-6'>
										<nav >
										<ul class='pagination'>";
										if($opcion!=1){
											echo "<li class='page-item'><a class='page-link text-theme' onclick='pagination(".($opcion-1).")'  > Anterior</a></li>";
										}
										if(($opcion-2)>0){
											echo "<li class='page-item'><a class='page-link text-theme' onclick='pagination(".($opcion-2).")'   >".($opcion-2)."</a></li>";
										}
										if(($opcion-1)>0){
											echo "<li class='page-item'><a class='page-link text-theme' onclick='pagination(".($opcion-1).")'   >".($opcion-1)."</a></li>";
										}   
										echo "<li class='page-item active'><a class='page-link text-white'  href=''  >$opcion</a></li>";
										if(($opcion+1)<=$cantidad){
											echo "<li class='page-item'><a class='page-link text-theme' onclick='pagination(".($opcion+1).")'   >".($opcion+1)."</a></li>";
										}
										if(($opcion+2)<=$cantidad){
											echo "<li class='page-item'><a class='page-link text-theme' onclick='pagination(".($opcion+2).")'  >Siguiente </a></li>";
										}
										echo" </ul>
										</nav></div>";
									} ?> 
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
	</div>

<div class="modal fade" id="modaldetsol1"  role="dialog"  aria-hidden="true">
	 <div class="modal-dialog modal-lg" role="document">
	 	<div class="modal-content">
	 		<div class="modal-header">
		 		<h6 class="modal-title"></h6>
		 		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		 			<span aria-hidden="true">×</span>
		 		</button>
		 	</div>
		 	<div class="modal-body">

		 	</div>
		 	<div class="modal-footer">  
		 		<div class="text-right">  
		 			<button class="btn  btn-theme " id="btnguardar" onclick="addrespuesta()"><i class="fa fa-save"></i>Guardar Respuesta</button>
		 		</div>
		 	</div>
	 	</div>
	 </div>
</div>
<div class="modal fade" id="modalreporte"  role="dialog"  aria-hidden="true">
	 <div class="modal-dialog" role="document">
	 	<form id="formrep" method="post" class="modal-content">
	 		<div class="modal-header">
		 		<h6 class="modal-title">Solicitudes</h6>
		 		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		 			<span aria-hidden="true">×</span>
		 		</button>
		 	</div>
		 	<div class="modal-body">
		 		<div class="row">
		 			<div class="col-md-12">
		 				<input type="text" id="fecha" name="fecha" class="form-control" readonly style="background-color:white;">
		 			</div>
		 			<input type="hidden" id="id_empresa" name="id_empresa" class="form-control" value="<?php echo $empresa;?>" >
		 		</div>
		 	</div>
		 	<div class="modal-footer">    
		 		 <button type="button" onclick="download();" class="btn  btn-theme"><i class="fa fa-download"></i>Descargar</button>           
		 	</div>
	 	</form>
	 </div>
</div>
<div class="modal fade" id="modalchatsol"  role="dialog"  aria-hidden="true">
	 <div class="modal-dialog modal-lg" role="document">
	 	<div class="modal-content">
	 		<div class="modal-header">
	 				<h6 class="modal-title">Mensajer&iacute;a</h6>		 		
		 		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		 			<span aria-hidden="true">×</span>
		 		</button>
		 	</div>
		 	<div class="modal-body modal-space card">
		 		<div class="card-body message-content">
		 			<div class="chat" id="chatsol">		 					
		 			</div>
		 		</div>
		 		<div class="card-footer">
		 			<div class="form-row">
		 				<div class="col-md-11 mb-3">
		 					<textarea class="form-control" name="txt_mensajechat" id="txt_mensajechat" data-plugin="maxlength" data-placement="bottom-right-inside" maxlength="2000"  placeholder="Escribir Mensaje"></textarea>
		 				</div>
		 				<div class="col-md-1 mb-3">
		 					<button type="button" onclick="enviarmensaje();" class="btn btn-lg btn-theme"><i class="fa fa-paper-plane"></i></button>
		 					<input type="hidden" name="txt_idsolicitudchat" id="txt_idsolicitudchat" >
		 				</div>
		 			</div>  
		 		</div>
		 	</div>
	 	</div>
	 </div>
</div>
</body>
<script src="<?php echo base_url("assets/js/libs/chart.js/dist/Chart.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/moment-with-locales.min.js");?>"></script>
<script type="text/javascript" src="<?php echo  site_url(); ?>assets/js/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo  site_url(); ?>assets/css/daterangepicker.css" />
<script type="text/javascript">
	$(document).ready(function() {


		$("#id_empresa").select2();

	<?php if($empresa!=0){  ?>

		var myChart1;
		var myChart2;

		$.ajax({
			url:"<?php echo site_url(); ?>solicitudes_ot/solicitud_estado",
			type: "POST",
			data: "anio="+$("#anioest").val()+"&mes="+$("#mesest").val()+"&empresa="+$("#id_empresa").val(),
			dataType:"json",
			success:function(data){
				var title = [];
			    var count = [];
			    for(var i in data) {
			        title.push(data[i].estado);
			        count.push(data[i].solicitudes);
			    }
				var ctx = document.getElementById("chart2").getContext('2d');
				myChart1 = new Chart(ctx, {
					type: 'bar',
					data: {
						labels: title,
						datasets: [{
							label: 'CANT. SOLICITUDES',
							data: count,
							backgroundColor: "<?php echo "#E64A19";?>"
						}]
					}
				});
			}
		});

		$.ajax({
			url:"<?php echo site_url(); ?>/solicitudes_ot/solicitud_semaforo",
			dataType:"json",
			type: "POST",
			data: "anio="+$("#anio").val()+"&mes="+$("#mes").val()+"&empresa="+$("#id_empresa").val(),
			success:function(data){
				var title = [];
			    var count = [];
			    var color = [];
			    for(var i in data) {
			        title.push(data[i].semaforo);
			        count.push(data[i].solicitudes);
			        color.push(data[i].color_semaforo);
			    }
				var ctx = document.getElementById("chart3").getContext('2d');
				myChart2 = new Chart(ctx, {
					type: 'doughnut',
					data: {
						labels: title,
						datasets: [{
							label: 'CANT. SOLICITUDES',
							data: count,
							backgroundColor: color
						}]
					},
					options:{
						responsive:true,
						legend: {
							position:'right'
						}
					}
				});
			}
		}); 

		$('#fecha').daterangepicker({
			"autoUpdateInput": false,
		    "applyButtonClasses": "btn-warning",
			    "locale": {
			        "format": "DD-MM-YYYY",
			        "separator": " - ",
			        "applyLabel": "Seleccionar",
			        "cancelLabel": "Cancelar",
			        "fromLabel": "From",
			        "toLabel": "To",
			        "customRangeLabel": "Custom",
			        "weekLabel": "W",
			        "daysOfWeek": [  "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sá" ],
			        "monthNames": [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
			        "firstDay": 1
			    }
		}, function(start, end, label) {
			$('#fecha').val(start.format('DD-MM-YYYY')+"  -  "+end.format('DD-MM-YYYY'));
		});

		$("#aniosot").select2();

		<?php
				if($anio!=0){
					echo "$('#aniosot').val(".$anio.").change();";
				}
		?>


		$("#messot").select2({
			ajax:{
				url:"<?php echo base_url("solicitudes_ot/meses"); ?>",
				type: "POST",
				data: function (term, page) {
		            return 'anio='+ $("#aniosot").val()+"&id_empresa="+$("#id_empresa").val();
		        },
				dataType:"json",
				delay: 350,
				processResults: function (data) {
					return {
						results: $.map(data, function(obj) {

							return { id: obj.mes_numero, text: obj.mes_nombre };
						})
					};
				},
				cache: true
			}
		});


		

		$("#estado").select2({ 
			ajax:{
				url:"<?php echo base_url("solicitudes_ot/estados"); ?>",
				type: "POST",
				dataType:"json",
				delay: 350,
				processResults: function (data) {
					return {
						results: $.map(data, function(obj) {
							var id=<?php echo $estado; ?>;
							if(id!=obj.id_estado){
								return { id: obj.id_estado, text: obj.estado };
							}							
						})
					};
				},
				cache: true
			}
		});

		

		$("#campanasot").select2({
			ajax:{
				url:"<?php echo base_url("solicitudes_ot/campanas"); ?>",
				type: "POST",
				data: function (term, page) {
		            return "anio="+$("#aniosot").val()+"&mes_numero="+$("#messot").val()+"&id_empresa="+$("#id_empresa").val();
		        },
				dataType:"json",
				delay: 350,
				processResults: function (data) {
					return {
						results: $.map(data, function(obj) {
							var id=<?php echo $campana; ?>;
							if(id!=obj.id_campana){
								return { id: obj.id_campana, text: obj.campana };
							}
						})
					};
				},
				cache: true
			}
		});

		

		$("#region").select2({ 
			ajax:{
				url:"<?php echo base_url("solicitudes_ot/regiones"); ?>",
				type: "POST",
				dataType:"json",
				data: function (term, page) {
		            return "id_campana="+$("#campanasot").val()+"&id_empresa="+$("#id_empresa").val();
		        },
				delay: 350,
				processResults: function (data) {
					return {
						results: $.map(data, function(obj) {
							var id=<?php echo $region; ?>;
							if(id!=obj.id_region){
								return { id: obj.id_region, text: obj.region };
							}
						})
					};
				},
				cache: true
			}
		});


		



		$("#comuna").select2({
			ajax:{
				url:"<?php echo base_url("solicitudes_ot/comunas"); ?>",
				type: "POST",
				data: function (term, page) {
		            return "id_campana="+$("#campanasot").val()+"&region="+$("#region").val()+"&id_empresa="+$("#id_empresa").val();
		        },
				dataType:"json",
				delay: 350,
				processResults: function (data) {
					return {
						results: $.map(data, function(obj) {
							return { id: obj.ciudad, text: obj.ciudad };
						})
					};
				},
				cache: true
			}
		});


		

		$("#cadena").select2({ 
			ajax:{
				url:"<?php echo base_url("solicitudes_ot/cadenassolicitud"); ?>",
				type: "POST",
				dataType:"json",
				data: function (term, page) {
		            return "id_campana="+$("#campanasot").val()+"&region="+$("#region").val()+"&id_empresa="+$("#id_empresa").val();
		        },
				delay: 350,
				processResults: function (data) {
					return {
						results: $.map(data, function(obj) {
							var id=<?php echo $cadena; ?>;
							if(id!=obj.id_cadena){
								return { id: obj.id_cadena, text: obj.cadena };
							}
						})
					};
				},
				cache: true
			}
		});


		

		$("#local").select2({ 
			ajax:{
				url:"<?php echo base_url("solicitudes_ot/locales"); ?>",
				type: "POST",
				data: function (term, page) {
		            return "id_campana="+$("#campanasot").val()+"&region="+$("#region").val()+"&cadena="+$("#cadena").val()+"&ciudad="+$("#comuna").val()+"&id_empresa="+$("#id_empresa").val();
		        },
				dataType:"json",
				delay: 350,
				processResults: function (data) {
					return {
						results: $.map(data, function(obj) {
							var id=<?php echo $sucursal; ?>;
							if(id!=obj.id_cliente){
								return { id: obj.id_cliente, text: obj.local };
							}
						})
					};
				},
				cache: true
			}
		});

			
	<?php }?>

	});


<?php if($empresa!=0){  ?>


	$("#mesest").change(function(){
		$.ajax({
			url:"<?php echo site_url(); ?>/solicitudes_ot/solicitud_estado",
			type: "POST",
			data: "anio="+$("#anioest").val()+"&mes="+$("#mesest").val()+"&empresa="+$("#id_empresa").val(),
			dataType:"json",
			success:function(data){
				var title = [];
				var count = [];
				for(var i in data) {
					title.push(data[i].estado);
					count.push(data[i].solicitudes);
				}
				var ctx = document.getElementById("chart2").getContext('2d');
				myChart1 = new Chart(ctx, {
					type: 'bar',
					data: {
						labels: title,
						datasets: [{
							label: 'CANT. SOLICITUDES',
							data: count,
							backgroundColor: "<?php echo "#E64A19";?>"
						}]
					}
				});
			}
		});

		
	});

	$("#anioest").change(function(){
		$.ajax({
			url:"<?php echo site_url(); ?>/solicitudes_ot/solicitud_estado",
			type: "POST",
			data: "anio="+$("#anioest").val()+"&mes="+$("#mesest").val()+"&empresa="+$("#id_empresa").val(),
			dataType:"json",
			success:function(data){
				var title = [];
				var count = [];
				for(var i in data) {
					title.push(data[i].estado);
					count.push(data[i].solicitudes);
				}
				var ctx = document.getElementById("chart2").getContext('2d');
				myChart1 = new Chart(ctx, {
					type: 'bar',
					data: {
						labels: title,
						datasets: [{
							label: 'CANT. SOLICITUDES',
							data: count,
							backgroundColor: "<?php echo "#E64A19";?>"
						}]
					}
				});
			}
		});
	});

	$("#mes").change(function(){
		$.ajax({
			url:"<?php echo site_url(); ?>/solicitudes_ot/solicitud_semaforo",
			dataType:"json",
			type: "POST",
			data: "anio="+$("#anio").val()+"&mes="+$("#mes").val()+"&empresa="+$("#id_empresa").val(),
			success:function(data){
				var title = [];
				var count = [];
				var color = [];
				for(var i in data) {
					title.push(data[i].semaforo);
					count.push(data[i].solicitudes);
					color.push(data[i].color_semaforo);
				}
				var ctx = document.getElementById("chart3").getContext('2d');
				myChart2 = new Chart(ctx, {
					type: 'doughnut',
					data: {
						labels: title,
						datasets: [{
							label: 'CANT. SOLICITUDES',
							data: count,
							backgroundColor: color
						}]
					},
					options:{
						responsive:true,
						legend: {
							position:'right'
						}
					}
				});
			}
		}); 
	});

	$("#anio").change(function(){
		$.ajax({
			url:"<?php echo site_url(); ?>/solicitudes_ot/solicitud_semaforo",
			dataType:"json",
			type: "POST",
			data: "anio="+$("#anio").val()+"&mes="+$("#mes").val()+"&empresa="+$("#id_empresa").val(),
			success:function(data){
				var title = [];
				var count = [];
				var color = [];
				for(var i in data) {
					title.push(data[i].semaforo);
					count.push(data[i].solicitudes);
					color.push(data[i].color_semaforo);
				}
				var ctx = document.getElementById("chart3").getContext('2d');
				myChart2 = new Chart(ctx, {
					type: 'doughnut',
					data: {
						labels: title,
						datasets: [{
							label: 'CANT. SOLICITUDES',
							data: count,
							backgroundColor: color
						}]
					},
					options:{
						responsive:true,
						legend: {
							position:'right'
						}
					}
				});
			}
		}); 
	});
<?php }?>


	function download(){
		$("#formrep").attr('action',"<?php echo base_url("solicitudes_ot/excel"); ?>");	
		$("#formrep").submit();	
	}

	function buscar(){
		$("#formsol").attr('action',"<?php echo base_url("solicitudes_ot"); ?>");
		$("#formsol").submit();
	}

	function pagination(num){
		$("#opcion").val(num);
		$("#formsol").attr('action',"<?php echo base_url("solicitudes_ot"); ?>");
		$("#formsol").submit();
	}

	function filtrar(){
		$("#form1").submit();
	}

	function refresh(){
		$("#formrefresh").submit();
	}
	

</script>
<style type="text/css">
	.modal-space {
     	padding: 0px; 
	}

	.breadcrumb {
	    margin: 0 0 0.5rem 0;
	}

	.card-body{
		padding: 0.9rem;
	}

	.h1{
		margin-bottom: 0px;
		font-size:2.8rem;
	}

	.pad05{
		padding: 0.3rem;
	}

	.history-transaction .transaction-list .details .heading {
	    font-size: 0.72rem;
	    text-transform: uppercase;
	}

	.padtable td, .padtable th{
		padding: 0.2rem;
		
	}

	.table th, .table td{
		font-size: 0.75rem;
	}

	.table th {
		color: #f57c00;
	}

	.bg-primary {
	    background-color:  #f57c00 !important;
	}

	.btn-theme {
	    -webkit-box-shadow: 0px 5px 25px -3px #f57c00;
	    -moz-box-shadow: 0px 5px 25px -3px #f57c00;
	    box-shadow: 0px 5px 25px -3px #f57c00;
	    background: #f57c00;
	}

	.btn-outline-theme {
	    -webkit-box-shadow: 0px 5px 25px -3px #f57c00;
	    -moz-box-shadow: 0px 5px 25px -3px #f57c00;
	    box-shadow: 0px 5px 25px -3px #f57c00;
	    color: #f57c00;
	    background: #fff;
	    border: 1px solid #f57c00;
	}

	.btn-outline-theme:hover {
	    background: #f57c00 !important;
	}

	.btn-theme:hover {
	    background: #f57c00 !important;
	}

	.card{
		margin-bottom: 0.6rem;
	}

	.bg-theme {
	    background:  #f57c00;
	}

	.header{
		margin-bottom: 0.5rem;
	}

	small{
		font-size: 94%;
		font-weight: 600;
	}

	.dropify-wrapper{
		height: 120px;
	}

	.ecom-widget-sales .ecom-sales-icon {
	    font-size: 4rem;
	    color: #ffbb76;
	}

	.ecom-widget-sales ul li span{
		color:#f57c00 !important;
		display:block;
	    width:100%;
	    word-wrap:break-word;
	    margin-bottom: 0.3rem;
	    font-size: 0.75rem;
	}

	.ecom-widget-sales ul li {
	    font-size: 1rem;
	}

	.pad06{
		padding-right: 10px;
    	padding-left: 10px;
	}

	.abc-radio label::before {
		background-color:#c2c4c6;
	}

	.card-accent-primary {
	    border-top-width: 3px;
	    border-top-color: #f57c00;
	}


	.abc-radio-primary input[type="radio"]:checked + label::before {
	    border-color: #f57c00;
	}

	.abc-radio-primary input[type="radio"]:checked + label::after {
	    background-color: #f57c00;
	}

	.card-title {
	     margin-bottom: 0.05rem;
	     color: #536c79; 
	}

	.form-group {
	    margin-bottom: 0.35rem;
	}

	.table th, .table td {
	    padding: 0.52rem;
	    vertical-align: top;
	    border-top: 2px solid #c2cfd6;
	}

	.select {
		font-size: 0.8rem;
		max-height: 30px !important;
		min-height: 30px !important;
	}

	.select2-selection__rendered{
		font-size: 0.8rem !important;
	}

	.select2-container--default .select2-selection--single{
		max-height: 30px !important;
		min-height: 30px !important;
		padding: 2px;
		font-size: 0.8rem!important;
	}

	.select2-results__options{
		font-size: 0.8rem!important;
	}

	ul{
		margin-bottom: 0.4rem;
	}

	.btn-sm, .btn-group-sm > .btn {
	    font-size: 0.8rem;
	}

	.form-control {
		font-size: 0.8rem !important;
	}

	.message-content{
		position: relative;
	    overflow: auto;
	    max-height: 370px;
	    margin-top: 0px;
	}
	.col-b{
		padding-right: 6px;
		padding-left: 6px;
		flex: 0 0 12%;
		max-width: 12%;
	}

	.col-ba{
		padding-right: 6px;
		padding-left: 6px;
		flex: 0 0 14%;
		max-width: 14%;
	}

	.list-group-item {
		padding: 0.5rem 0.8rem;
	}

	.ecom-widget-sales ul li {

	    font-size: 0.75rem !important;

	}

	@media (min-width: 992px){
		.modal-lg {
		    max-width: 1250px;
		}
	}
</style>
