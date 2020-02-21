

<script src="<?php echo base_url("assets/js/libs/chart.js/dist/Chart.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/moment-with-locales.min.js")?>"></script>
<link rel="stylesheet" href="<?php echo base_url("assets/css/libs/charts-morris-chart/morris.css"); ?>">
<script type="text/javascript" src="<?php echo  site_url(); ?>assets/js/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo  site_url(); ?>assets/css/daterangepicker.css" />
<body class="app sidebar-fixed aside-menu-off-canvas aside-menu-hidden header-fixed  pace-done">
	<div class="app-body">
		<main class="main" style="height: 100%; ">
			<div class="breadcrumb">
			</div>
			<div class="container-fluid ">
			<?php if(isset($cc[0]["campana"])){ ?>
				<div class="animated fadeIn">					
					<div class="row card-body" style="padding: 0.5rem;">
						<div class="col-md-12">
							<h5 ><?php echo $cc[0]["campana"]; ?></h5>
						</div>
						<div class="col-md-12">
							<form id="form1" method="post" action="<?php  echo base_url("informes/reporte"); ?>" class="row">
								<div class="col-md-2">
									<select class="form-control" id="region" name="region" >
									<?php
										if($region==0){
											echo '<option value="" >Región</option>';
										} else {
											echo '<option value="'.$region.'" >'.$cim[0]["region"].'</option>';
										}	
									?>
									</select>
								</div>
								<div class="col-md-2">
									<select class="form-control" id="ciudad" name="ciudad" >
										<?php
											if($ciudad=='0'){
												echo '<option value="" >Ciudad</option>';
											} else {
												echo '<option value="'.$ciudad.'" >'.$ciudad.'</option>';
											}
										?>
									</select>
								</div>
								<div class="col-md-2">
									<select class="form-control" id="sucursal" name="sucursal">
										 <?php
										 	if($sucursal=='0'){
												echo '<option value="" >Sucursal</option>';
											} else {
												echo '<option value="'.$sucursal.'" >'.$sucursal.'</option>';
											}
										?>
									</select>
								</div>
								<div class="col-md-2">
									<input type="text" class="form-control blanco"  name="fecha_programada" id="fecha_programada" placeholder="Fecha Programada" readonly >
								</div>
								<div class="col-md-2">
									<input type="text" class="form-control blanco"  name="fecha_real" id="fecha_real" placeholder="Fecha Real"  readonly>
									<input type="hidden" id="opcion" name="opcion" value="<?php echo $opcion; ?>" >
									<input type="hidden" id="motivo" name="motivo" value="<?php echo $motivo; ?>" >
								</div>
								<div class="col-md-2">		
									<button onclick="enviar();" title='Buscar' class="btn btn-sm btn-theme"><i class="fa fa-search"></i></button>				
									<button onclick="clearinfo();" title='Limpiar Búsqueda' class="btn btn-sm btn-theme"><i class="fa fa-refresh"></i></button>
									<a href="<?php echo base_url("informes/excelcam/".base64_encode($cc[0]["id_campana"])); ?>" class="btn btn-sm btn-success"><i class="fa fa-download"></i></a>
								</div>
							</form>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3 padr0">
							<div class="row">
								<div class="col-md-12">
									<div class="card" style="margin-bottom: 0.8rem;">
										<div class="card-body" style="padding:0.7rem;">
											<div class="category-progress">
												<strong class="text-theme">
													<?php if($cc[0]["pdv_imp"]!=0 && !is_null($cc[0]["pdv_imp"])){ echo round(($cc[0]["pdv_imp"]/$cc[0]["pdv_total"])*100,2); } else { echo "0"; }?>%</strong>
												<small class="pull-right" style="font-weight: 650;">IMPLEMENTACI&Oacute;N</small>
												<div class="progress xs">
													<div class="progress-bar progress-bar-striped" role="progressbar" style="width: <?php if($cc[0]["pdv_imp"]!=0 && !is_null($cc[0]["pdv_imp"])){ echo round(($cc[0]["pdv_imp"]/$cc[0]["pdv_total"])*100,2); } else { echo "0"; }?>%;" aria-valuenow="<?php if($cc[0]["pdv_imp"]!=0 && !is_null($cc[0]["pdv_imp"])){ echo round(($cc[0]["pdv_imp"]/$cc[0]["pdv_total"])*100,2); } else { echo "0"; }?>" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="summary-widgets card border-primary  text-center mb-3">
										<div class="card-body" style="padding:0.6rem;">
											<div class="number text-theme"><?php echo $cc[0]["pdv_imp"]; ?></div>
											<small style="font-weight: 650;">Implementados</small>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="summary-widgets card border-primary  text-center mb-3">
										<div class="card-body" style="padding:0.6rem;">
											<div class="number text-theme"><?php echo $cc[0]["pdv_total"]; ?></div>
											<small style="font-weight: 650;">Total Puntos</small>
										</div>
									</div>
								</div>
								<div class="col-md-12 ">
									<div class="card border-primary mb-3">		
									<div class="card-body">								
										<select style="width: 100%;" class="form-control" id="lb_motivo" name="lb_motivo" >
											<option value="">Motivo</option>
											<?php 
												foreach($motivos as $mo){ ?>

													<option value="<?php echo $mo["ID_Motivo"] ?>" ><?php echo $mo["motivo"]; ?></option>
											<?php } ?>
										</select>
									</div>									
									</div>
								</div>
								<div class="col-md-12">
									<div class=' card ecom-widget-sales card-body'>
										<ul>
											<li>Fecha Inicio <span><?php echo $cc[0]["fecha_inicio"];?></span></li>
											<li>Fecha Término <span><?php echo $cc[0]["fecha_termino"];?></span></li>
											<li>Fecha Término Real <span><?php echo $cc[0]["fecha_termino_real"];?></span></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-12">
									<div class="card card-body dash">
										<div class="text-center">
											<canvas id="morris-donut-chart" ></canvas>
										</div>
									</div>									
								</div>
								<div class="col-md-12 ">
									<div class="dataTables_scroll">
										<div class="dataTables_scrollHead">
											<div class="dataTables_scrollHeadInner">
												<table class="display table dataTable color-bordered-table primary-bordered-table">
													<thead>
														<tr >
															<th>SUCURSAL</th>
															<th>CIUDAD</th>
															<th>REGIÓN</th>
															<th>FECHA PROGRAMADA</th>
															<th>FECHA REAL</th>
															<th>AC</th>
															<th>IMP</th>
															<th>%</th>
														</tr>
													</thead>
												</table>
											</div>
										</div>
										<div class="dataTables_scrollBody" style="max-height: 185px; ">
											<table class="display table dataTable color-bordered-table primary-bordered-table" style="width: 100%;">
												<tbody>
													<?php
													$tsv=0;
													$tv=0;
													foreach($cim as $c){
														echo "<tr  onclick=\"window.open('".base_url("informes/detalleinfo/".base64_encode($c["id_unico"]))."', 'popup', 'width=screen.width,height=screen.height'); return false;\">";
														echo "<td>".$c["id_cliente"]." - ".$c["nombre_fantasia"]."</td>";
														echo "<td>".$c["ciudad"]."</td>";
														echo "<td>".$c["region"]."</td>";
														echo "<td>".date("d-m-Y",strtotime($c["fecha_programada"]))."</td>";
														if(is_null($c["fecha_real"])){
															echo "<td></td>";
														} else {
															echo "<td>".date("d-m-Y",strtotime($c["fecha_real"]))."</td>";
														}
														echo "<td>".$c["acuerdo"]."</td>";
														$tsv+=$c["acuerdo"];
														echo "<td>".$c["imp"]."</td>";
														$tv+=$c["imp"];
														if($c["imp"]==0){
															echo "<td>0%</td>";
														} else {
															echo "<td>".round((($c["imp"]/$c["acuerdo"])*100),2)."%</td>";
														}
														echo "</tr>";
													}
													?>
												</tbody>
											</table>
										</div>
										<div class="dataTables_scrollFoot">
											<div class="dataTables_scrollFootInner">
												<table class="display table dataTable color-bordered-table primary-bordered-table" style="width: 100%;">
													<tfoot>
														<tr   class="bg-theme">
															<th>TOTAL</th>
															<th></th>
															<th></th>
															<th></th>
															<th></th>
															<th ><?php echo $tsv; ?></th>
															<th ><?php echo $tv; ?></th>
															<th ><?php if($tv!=0){ echo round(($tv/$tsv)*100,2); } else { echo "0"; }?>%</th>
														</tr>
													</tfoot>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="float-right">
										<div class="row">
											<?php	if(isset($opcion) && count($cc)>0){                
								             	echo "<div class='col-md-6'>
								                    <nav aria-label='Page navigation example pull-right'>
								                        <ul class='pagination'>";
								                        if($opcion!=1){
								                        	echo "<li class='page-item'><a class='page-link text-theme' onclick='page(".($opcion-1).")'  > Anterior</a></li>";
								                    	}
								                    	if(($opcion-2)>0){
								                      		echo "<li class='page-item'><a class='page-link text-theme' onclick='page(".($opcion-2).")'  >".($opcion-2)."</a></li>";
								                    	}
								                    	if(($opcion-1)>0){
									                        echo "<li class='page-item'><a class='page-link text-theme' onclick='page(".($opcion-1).")'  >".($opcion-1)."</a></li>";
								                    	}   
														echo "<li class='page-item active'><a class='page-link text-white'  href=''  >$opcion</a></li>";
									                    if(($opcion+1)<=$cantidad){
										                    echo "<li class='page-item'><a class='page-link text-theme' onclick='page(".($opcion+1).")'  >".($opcion+1)."</a></li>";
									                    }
									                  	if(($opcion+2)<=$cantidad){
									                      	echo "<li class='page-item'><a class='page-link text-theme' onclick='page(".($opcion+1).")' >Siguiente </a></li>";
									                        
									                    }
									                   echo" </ul>
									                    </nav></div>";
									                } ?> 
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-12 card-body padl0" style="padding-bottom: 0.5rem; padding-top: 0.7rem">
											<h6 class="text-theme text-center">Sucursales Visitadas</h6>
											<div class="dataTables_wrapper">
												<div class="dataTables_scroll">
													<div class="dataTables_scrollHead" style="overflow: hidden; position: relative; border: 0px; width: 100%;">
														<div class="dataTables_scrollHeadInner" >
															<table class="display table dataTable color-bordered-table primary-bordered-table">
																<thead>
																	<tr >
																		<th>REGIÓN</th>
																		<th>TOTAL</th>
																		<th>VISITADO</th>
																		<th>%</th>
																	</tr>
																</thead>
															</table>
														</div>
													</div>
													<div class="dataTables_scrollBody" style="max-height: 110px;">
														<table class="display table dataTable color-bordered-table primary-bordered-table">
															<tbody>
																<?php
																$tsv=0;
																$tv=0;
																for($i=0;$i<count($cc);$i++){
																	echo "<tr  >";
																	echo "<td >".$cc[$i]["region"]." </td>";
																	echo "<td >".$cc[$i]["pdv"]." </td>";
																	$tsv+=$cc[$i]["pdv"];
																	echo "<td >".$cc[$i]["visitado"]." </td>";
																	$tv+=$cc[$i]["visitado"];
																	if($cc[$i]["visitado"]!=0 && !is_null($cc[$i]["visitado"])){
																		echo "<td >".round((($cc[$i]["visitado"]/$cc[$i]["pdv"])*100),2)."%</td>";
																	} else {
																		echo "<td>0%</td>";
																	}
																	echo "</tr>";
																}
																?>
															</tbody>
														</table>
													</div>
													<div class="dataTables_scrollFoot">
														<div class="dataTables_scrollFootInner">
															<table class="display table dataTable color-bordered-table primary-bordered-table" style="width: 100%;">
																<tfoot>
																	<tr  class="bg-theme">
																		<th>TOTAL</th>
																		<th ><?php echo $tsv; ?></th>
																		<th ><?php echo $tv; ?></th>
																		<th ><?php if($tv!=0){ echo round(($tv/$tsv)*100,2); } else { echo "0"; }?>%</th>
																	</tr>
																</tfoot>
															</table>
														</div>
													</div>
												</div>
											</div>
											
										</div>
										<div class="col-md-12 card-body padl0" style="padding-bottom: 0.5rem; padding-top: 0.7rem;" >
											<h6 class="text-theme text-center">Materiales Implementados</h6>
											<div class="dataTables_scroll">
												<div class="dataTables_scrollHead">
													<div class="dataTables_scrollHeadInner">
														<table class="display table dataTable color-bordered-table primary-bordered-table">
															<thead>
																<tr >
																	<th>REGIÓN</th>
																	<th>AC</th>
																	<th>IMP</th>
																	<th>%</th>
																</tr>
															</thead>
														</table>
													</div>
												</div>
												<div class="dataTables_scrollBody" style="max-height: 110px;">
														<table class="display table dataTable color-bordered-table primary-bordered-table">
															<tbody>
																<?php
																	$tsv=0;
																	$tv=0;
																	foreach ($cc as $c) {
																		echo "<tr  >";
																		echo "<td>".$c["region"]."</td>";
																		echo "<td>".$c["acuerdo"]."</td>";
																		$tsv+=$c["acuerdo"];
																		echo "<td>".$c["imp"]."</td>";
																		$tv+=$c["imp"];
																		if($c["imp"]!=0 && !is_null($c["imp"])){
																			echo "<td >".round((($c["imp"]/$c["acuerdo"])*100),2)."%</td>";
																		} else {
																			echo "<td>0%</td>";
																		}
																		echo "</tr>";
																	}
																?>
															</tbody>
														</table>
												</div>
												<div class="dataTables_scrollFoot">
														<div class="dataTables_scrollFootInner">
															<table class="display table dataTable color-bordered-table primary-bordered-table" style="width: 100%;">
																<tfoot>
																	<tr  class="bg-theme">
																		<th>TOTAL</th>
																		<th ><?php echo $tsv; ?></th>
																		<th ><?php echo $tv; ?></th>
																		<th ><?php if($tv!=0){ echo round(($tv/$tsv)*100,2); } else { echo "0"; }?>%</th>
																	</tr>
																</tfoot>
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
				</div>
			<?php } else {?>
				<div class="animated fadeIn">					
					<div class="row card-body" >
						<div class="col-md-12">
							<h1  class="text-theme" >Esta campaña no tiene locales asignados.</h1>
						</div>
					</div>
				</div>
			<?php } ?>
			</div>
		</main>
	</div>
</body>
<script type="text/javascript">

	var myChart;




	$(document).ready(function() {

		if($(window).width()<991){
            $("#morris-donut-chart").attr('height','150');
        } else {
        	$("#morris-donut-chart").attr('height','60');
        }

		var ctx = document.getElementById("morris-donut-chart").getContext('2d');
		myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: [<?php for ($i=0; $i < count($cc); $i++) { 
						echo "'".$cc[$i]["region"]."',";				
				} ?>],
				datasets: [{
					label: '% CUMPLIMIENTO',
					data: [<?php for ($i=0; $i < count($cc); $i++) { 
							echo "".round((($cc[$i]["visitado"]/$cc[$i]["pdv"])*100),2).",";				
					} ?>],
					backgroundColor: "#FC9934"
				}]
			},
			options:{
				legend:{
					labels:{
						fontSize:10
					}				
				},
				scales:{
					yAxes: [{
			            ticks: {
					        // min: 0,
					        // max: this.max,// Your absolute max value
					        callback: function (value) {
					          return value+'%'; // convert it to percentage
					        }
					   	}
			        }]
				}
			}
		});

		$('#fecha_programada').daterangepicker({
		    "singleDatePicker": true,
		    <?php 
			    if($fechaprog!=0){
	    			echo '"startDate": "'.date("d-m-Y",strtotime($fechaprog)).'", "autoUpdateInput": true,'; 
	    		} else {
	    			echo '"autoUpdateInput": false,';
	    		}
    		?>
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
		},  function(chosen_date) {
		  	$('#fecha_programada').val(chosen_date.format('DD-MM-YYYY'));		  
		});

		$('#fecha_real').daterangepicker({
		    "singleDatePicker": true,
		    "applyButtonClasses": "btn-warning",
		    <?php 
			    if($fechareal!=0){
	    			echo '"startDate": "'.date("d-m-Y",strtotime($fechareal)).'", "autoUpdateInput": true,'; 
	    		} else {
	    			echo '"autoUpdateInput": false,';
	    		}
    		?>
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
		}, function(chosen_date) {
		  	$('#fecha_real').val(chosen_date.format('DD-MM-YYYY'));
		});


		$("#region").select2({ 
			ajax:{
				url:"<?php echo base_url("solicitudes_ot/regiones"); ?>",
				type: "POST",
				data: function (term, page) {
		            return "id_campana=<?php echo base64_decode($_SESSION["campana"]); ?>&region="+$("#region").val()+"&ciudad="+$("#ciudad").val()+"&sucursal="+$("#sucursal").val()+"&fechaprog="+$("#fecha_programada").val()+"&fechareal="+$("#fecha_real").val();
		        },
				dataType:"json",
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


		$("#ciudad").select2({ 
			ajax:{
				url:"<?php echo base_url("solicitudes_ot/comunas"); ?>",
				type: "POST",
				data: function (term, page) {
		            return "id_campana=<?php echo base64_decode($_SESSION["campana"]); ?>&region="+$("#region").val()+"&ciudad="+$("#ciudad").val()+"&sucursal="+$("#sucursal").val()+"&fechaprog="+$("#fecha_programada").val()+"&fechareal="+$("#fecha_real").val();
		        },
				dataType:"json",
				delay: 350,
				processResults: function (data) {
					return {
						results: $.map(data, function(obj) {
							var id='<?php echo $ciudad; ?>';
							if(id!=obj.id_ciudad){
								return { id: obj.id_ciudad, text: obj.ciudad };
							}
						})
					};
				},
				cache: true
			}
		});


		$("#sucursal").select2({ 
			ajax:{
				url:"<?php echo base_url("informes/id_cliente"); ?>",
				type: "POST",
				data: function (term, page) {
		            return "id_campana=<?php echo base64_decode($_SESSION["campana"]); ?>&region="+$("#region").val()+"&ciudad="+$("#ciudad").val()+"&sucursal="+$("#sucursal").val()+"&fechaprog="+$("#fecha_programada").val()+"&fechareal="+$("#fecha_real").val();
		        },
				dataType:"json",
				delay: 350,
				processResults: function (data) {
					return {
						results: $.map(data, function(obj) {
							var id='<?php echo $sucursal; ?>';
							if(id!=obj.id_cliente){
								return { id: obj.id_cliente, text: obj.id_cliente };
							}
						})
					};
				},
				cache: true
			}
		});

		$("#lb_motivo").select2();
		var idmotivo='<?php echo $motivo; ?>';
		if(idmotivo>0){
			$('#lb_motivo').val(idmotivo).trigger('change');
		}
		
	});

	$("#lb_motivo").change(function(){
		$("#motivo").val($("#lb_motivo").val());
	});



	function enviar(){
		$('#form1').submit();
	}

	function clearinfo(){
		$("#region").val('').trigger('change');
		$("#sucursal").val('');
		$("#ciudad").val('').trigger('change');
		$("#fecha_programada").val("").trigger('change');
		$("#fecha_real").val("").trigger('change');
		$('#opcion').val("1");
	}

	function page(num){
		$('#opcion').val(num);
		$('#form1').submit();
	}





</script>


<style type="text/css">
	.main {
		margin-left: 0px !important;
	}

	.breadcrumb{
		background: white;
		margin: 0;
		padding:0.15rem 0.3rem;
	}
	
	.ecom-widget-sales ul li span{
		color:#f57c00 !important;
		display:block;
	    width:100%;
	    word-wrap:break-word;
	    font-size: 0.8rem;
	}

	.ecom-widget-sales ul li{
		font-size: 0.8rem;
	}

	.summary-widgets small {
		font-size: 0.67rem;
		text-transform: uppercase;
	}

	.summary-widgets .number {
		font-size: 2.6rem;
	}

	.dash{
		margin-bottom: 0.5rem; padding-top: 0.75rem; padding-bottom: 0.75rem;
	}

	@media (max-width: 576px) { .ecom-widget-sales ul li span{  width:100%; } }

	::-webkit-scrollbar {
	    width: 5px  !important;
	}
	::-webkit-scrollbar-track {
	    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
	    border-radius: 10px;
	}
	::-webkit-scrollbar-thumb {
	    border-radius: 10px;
	    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5);
	}

	.dataTables_scrollBody{
		position: relative;
	    overflow: auto;
	    max-height: 200px;
	    width: 100%;
	}

	.padl6{
		padding-left: 6px !important;
	}

	.padl0{
		padding-left: 0px !important;
	}

	.padr0{
		padding-right: 0px !important;
	}

	.table tr:hover, .table tr:focus {
		background-color: #f57c00;
		color: #fff;
		cursor:pointer;
	}

	.table th, .table td{
 		padding:0.5rem;
 		text-align: center;
 		font-size: 0.55rem;
		white-space: pre-wrap;
		word-wrap: break-word;
		max-width: 3.3rem;
 		width: 3.3rem;
 		vertical-align: middle;
 	}

 	table.dataTable {
 		border-collapse: collapse !important;
 	}

 	.select2-container--default .select2-selection--single{
 		min-height: 32px;
 	}

 	.form-control{
 		font-size: 0.8rem;
 	}
 	
 	input[type=text]{
 		min-height: 37px;
 	}

 	.ic__month-select{
 		min-height: 1.8rem;
 		font-size: 0.8rem !important;
 	}

 	.ic__year-select{
 		min-height: 1.8rem;
 		font-size: 0.8rem !important;
 	}


 	.form-control {
		font-size: 0.7rem !important;
		max-height: 32px !important;
		min-height: 32px !important;
	}

	.select2-selection__rendered{
		font-size: 0.7rem !important;
	}

	.select2-container--default .select2-selection--single{
		max-height: 32px !important;
		min-height: 32px !important;
		padding: 2px;
		font-size: 0.7rem!important;
	}

	.page-link {
	    position: relative;
	    display: block;
	    padding: 0.5rem 0.7rem;
	    margin-left: -1px;
	    line-height: 1.1;
	    color: #f57c00;
	    background-color: #fff;
	    border: 1px solid #ddd;
	}


	ul{
		margin-bottom: 0.4rem !important;
	}




</style>