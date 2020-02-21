<script src="<?php echo base_url("assets/js/libs/chart.js/dist/Chart.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/moment-with-locales.min.js")?>"></script>
<script src="<?php echo base_url("assets/js/ion.calendar.min.js")?>"></script>
<link rel="stylesheet" href="<?php echo base_url("assets/css/libs/charts-morris-chart/morris.css"); ?>">
<link rel="stylesheet" href="<?php echo base_url("assets/css/ion.calendar.css")?>">
<style type="text/css">
	.main {
		margin-left: 0px !important;
	}

	.breadcrumb{
		background: white;
		margin: 0;
		padding:0.15rem 0.3rem;
	}

	.primary-bordered-table td, .primary-bordered-table th{
		white-space: pre-wrap;
		word-wrap: break-word;
 		max-width: 3.75rem;
 		vertical-align: middle;
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
		margin-bottom: 0.5rem; padding-top: 0.8rem; padding-bottom: 0.8rem;
	}

	table.dataTable{
		border-collapse: collapse !important;
	}

	@media (max-width: 576px) { .ecom-widget-sales ul li span{  width:100%; } }

	::-webkit-scrollbar {
	    width: 5px;
	}
	::-webkit-scrollbar-track {
	    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
	    border-radius: 10px;
	}
	::-webkit-scrollbar-thumb {
	    border-radius: 10px;
	    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5);
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

	#t33 tr:hover,  #t33 tr:focus {
		background-color: #f57c00;
		color: #fff;
		cursor:pointer;
	}

	.table th, .table td{
 		padding:0.5rem;
 		text-align: center;
 	}

 	.select2-container--default .select2-selection--single{
 		min-height: 37px;
 	}

 	.form-control{
 		font-size: 0.8rem;
 	}
 	
 	input[type=text]{
 		min-height: 37px;
 	}

</style>
<body class="app sidebar-fixed aside-menu-off-canvas aside-menu-hidden header-fixed  pace-done">
	<div class="app-body">
		<main class="main" style="height: 100%; ">
			<div class="breadcrumb">
			</div>
			<div class="container-fluid ">
				<div class="animated fadeIn">					
					<div class="row card-body">
						<div class="col-md-12">
							<h5 ><?php echo $campana["campana"];?></h5>
						</div>
						<?php
						foreach($cc as $c){
							$region[]=$c["region"]."/".$c["id_region"];
							$ciudad[]=$c["ciudad"];
							$imp[]=$c["implementador"];
						}
						?>
						<div class="col-md-2">
							<select class="form-control" id="lbl_region_i" name="lbl_region_i" onchange="buscar()">
								<option value="">Región</option>
								<?php
								for($i=0;$i<count($cc);$i++){
									if(isset(array_unique($region)[$i])){
										$c=explode("/",array_unique($region)[$i]);
										echo "<option value='".$c[1]."'>".$c[0]."</option>";

									}
								}
								?>
							</select>
						</div>
						<div class="col-md-2">
							<select class="form-control" id="lbl_ciudad_i" name="lbl_ciudad_i" onchange="buscar()">
								<option value="">Ciudad</option>
								<?php
								for($i=0;$i<count($cc);$i++){
									if(isset(array_unique($ciudad)[$i])){
										echo "<option value='".str_replace(" ","0",array_unique($ciudad)[$i])."'>".array_unique($ciudad)[$i]."</option>";					
									}
								}
								?>
							</select>
						</div>
						<div class="col-md-2">
							<select class="form-control" id="lbl_sucursal_i" name="lbl_sucursal_i" onchange="buscar()">
								<option value="">Sucursal</option>
								<?php
								foreach ($cc as $c) {
									echo "<option value='".$c["id_cliente"]."'>".$c["id_cliente"]."</option>";		
								}
								?>
							</select>
						</div>
						<div class="col-md-2">
							<input type="text" class="form-control blanco"  name="txt_fecha_prog_i" id="txt_fecha_prog_i" placeholder="Fecha Programada" readonly>
						</div>
						<div class="col-md-2">
							<input type="text" class="form-control blanco"  name="txt_fecha_real_i" id="txt_fecha_real_i" placeholder="Fecha Real"  readonly>
						</div>
						<div class="col-md-2">											
							<button onclick="clearinfo();" class="btn btn-theme"><i class="fa fa-spin fa-refresh"></i></button>
							<a href="<?php echo base_url("informes/excelcam"); ?>" class="btn btn-success"><i class="fa fa-download"></i></a>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3 padr0">
							<div class="row">
								<div class="col-md-12">
									<div class="card" style="margin-bottom: 0.8rem;">
										<div class="card-body" style="padding:0.7rem;">
											<?php
												$tac=0;
												$timp=0;
												foreach($cc as $fr){
													$sum=0;
													foreach ($cc as $fri) { 
														if($fr["fecha_real"]==$fri["fecha_real"]){
															$sum+=1;
														}
													}
													$fecha_real[]=$fr["fecha_real"];
													$suma_real[]=$fr["fecha_real"]."/".$sum;
													$tac+=$fr["acuerdo"];
													$timp+=$fr["imp"];
												}
												$total=0;
												for($i=0;$i<count($cc);$i++){
													if(isset(array_unique($fecha_real)[$i])){
														$c=explode("/",array_unique($suma_real)[$i]);
														$total+=$c[1];
													}
												}
											?>
											<div class="category-progress">
												<strong class="text-theme">
													<?php if($total!=0){ echo round(($total/count($cc))*100,2); } else { echo "0"; }?>%</strong>
												<small class="pull-right" style="font-weight: 650;">IMPLEMENTACI&Oacute;N</small>
												<div class="progress xs">
													<div class="progress-bar progress-bar-striped" role="progressbar" style="width: <?php if($total!=0){ echo round(($total/count($cc))*100,2); } else { echo "0"; } ?>%;" aria-valuenow="<?php if($total!=0){ echo round(($total/count($cc))*100,2); } else { echo "0"; } ?>" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="summary-widgets card border-primary  text-center mb-3">
										<div class="card-body" style="padding:0.6rem;">
											<div class="number text-theme"><?php echo $total; ?></div>
											<small style="font-weight: 650;">Implementados</small>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="summary-widgets card border-primary  text-center mb-3">
										<div class="card-body" style="padding:0.6rem;">
											<div class="number text-theme"><?php echo count($cc); ?></div>
											<small style="font-weight: 650;">Total Puntos</small>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class=' card ecom-widget-sales card-body'>
										<ul>
											<!-- <li>Acci&oacute;n <span><?php echo $campana["accion"];?></span></li> -->
											<li>Fecha Inicio <span><?php echo $campana["fecha_inicio"];?></span></li>
											<li>Fecha Término <span><?php echo $campana["fecha_termino"];?></span></li>
											<li>Fecha Término Real <span><?php echo $campana["fecha_termino_real"];?></span></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-12">
									<!-- <h6 class="text-theme">Cumplimiento</h6> -->
									<div class="card card-body dash">
										<div class="text-center">
											<canvas id="morris-donut-chart" height="60"></canvas>
										</div>
									</div>									
								</div>
								<div class="col-md-12 padr0 padl0">
									<table class="table color-bordered-table primary-bordered-table" id="t33" width="100%">
										<thead>
											<tr style="font-size: 0.6rem;">
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
										<tbody>
											<?php
											$tsv=0;
											$tv=0;
											foreach($cc as $c){
												echo "<tr style=\"font-size: 0.6rem;\" onclick=\"window.open('".base_url("informes/detalleinfo/".base64_encode($c["id_unico"]))."', 'popup', 'width=screen.width,height=screen.height'); return false;\">";
												echo "<td>".$c["id_cliente"]." - ".$c["nombre_fantasia"]."</td>";
												echo "<td>".$c["ciudad"]."</td>";
												echo "<td>".$c["region"]."</td>";
												echo "<td>".date("d-m-Y",strtotime($c["fecha_programada"]))."</td>";
												if(is_null($c["fecha_real"])){
													$fecha="";
												} else {
													$fecha=date("d-m-Y",strtotime($c["fecha_real"]));
												}
												echo "<td>".$fecha."</td>";
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
										<tfoot>
											<tr style="font-size: 0.6rem;"  class="bg-theme">
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
						<div class="col-md-3">
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-12 padl6">
											<?php 
											foreach($cc as $r){
												$sum=0;
												$sumv=0;
												foreach ($cc as $ri) { 
													if($r["region"]==$ri["region"]){
														if(!is_null($ri["fecha_real"])){
															$sumv+=1;
														}
														$sum+=1;
													}
												}
												$regiones[]=$r["region"];
												$suma_regiones[]=$r["region"]."/".$sum;
												$suma_regionvs[]=$r["region"]."/".$sumv;
											}
											?>
											<table class="table color-bordered-table primary-bordered-table" id="t31" width="100%">
												<thead>
													<tr style="font-size: 0.5rem;">
														<th>REGIÓN</th>
														<th>TOTAL</th>
														<th>IMP</th>
														<th>%</th>
													</tr>
												</thead>
												<tbody>
													<?php
														$tsv=0;
														$tv=0;
														for($i=0;$i<count($cc);$i++){
															if(isset(array_unique($regiones)[$i])){
																echo "<tr style='font-size: 0.5rem;' >";
																echo "<td >".array_unique($regiones)[$i]." </td>";
																$c=explode("/",array_unique($suma_regiones)[$i]);
																echo "<td >".$c[1]."</td>";
																$tsv+=$c[1];
																$ci=explode("/",array_unique($suma_regionvs)[$i]);
																echo "<td >".$ci[1]."</td>";
																$tv+=$ci[1];
																echo "<td >".round((($ci[1]/$c[1])*100),2)."%</td>";
																echo "</tr>";

															}
														}
													?>
												</tbody>
												<tfoot>
													<tr style="font-size: 0.5rem;" class="bg-theme">
														<th>TOTAL</th>
														<th ><?php echo $tsv; ?></th>
														<th ><?php echo $tv; ?></th>
														<th ><?php if($tv!=0){ echo round(($tv/$tsv)*100,2); } else { echo "0"; }?>%</th>
													</tr>
												</tfoot>
											</table>
										</div>
										<div class="col-md-12 padl6">
											<table class="table color-bordered-table primary-bordered-table" id="t32" width="100%">
												<thead>
													<tr style="font-size: 0.5rem;">
														<th>MATERIAL</th>
														<th>AC</th>
														<th>IMP</th>
														<th>%</th>
													</tr>
												</thead>
												<tbody>
													<?php
														$tsv=0;
														$tv=0;
														foreach ($cim as $c) {
															echo "<tr style='font-size: 0.5rem;' >";
															echo "<td>".$c["medicion"]."</td>";
															echo "<td>".$c["ac"]."</td>";
															$tsv+=$c["ac"];
															echo "<td>".$c["imp"]."</td>";
															$tv+=$c["imp"];
															if($c["imp"]==0){
																echo "<td>0%</td>";
															} else {
																echo "<td>".round((($c["imp"]/$c["ac"])*100),2)."%</td>";
															}
															echo "</tr>";
														}
													?>
												</tbody>
												<tfoot>
													<tr style="font-size: 0.5rem;" class="bg-theme">
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
		</main>
	</div>
</body>
<script type="text/javascript">

	var myChart;

	$(document).ready(function() {

	var ctx = document.getElementById("morris-donut-chart").getContext('2d');
	myChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: [<?php for ($i=0; $i < count($cc); $i++) { 
				if(isset(array_unique($regiones)[$i])){
					$re=explode("/",array_unique($regiones)[$i]);
					echo "'".$re[0]."',";
				}				
			} ?>],
			datasets: [{
				label: '% CUMPLIMIENTO',
				data: [<?php for ($i=0; $i < count($cc); $i++) { 
					if(isset(array_unique($suma_regiones)[$i])){
						$c=explode("/",array_unique($suma_regiones)[$i]);
						$ci=explode("/",array_unique($suma_regionvs)[$i]);
						echo "".round((($ci[1]/$c[1])*100),2).",";
					}				
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
				          return value ; // convert it to percentage
				        }
				   	}
		        }]
			}
		}
	});


	    var t1= $('#t31').DataTable( {
	        scrollY: "100px",
	        scrollX: true,
	        scrollCollapse: true,
	        paging: false,
	        searching: false,
	        ordering: false,
	        info: false,
	        autoWidth:false,
	        fixedHeader: true
	    } );


	    var t2= $('#t32').DataTable( {
	        scrollY: "100px",
	        scrollX: true,
	        scrollCollapse: true,
	        paging: false,
	        searching: false,
	        ordering: false,
	        info: false,
	        autoWidth:false,
	        fixedHeader: true
	    } );

	    var t3= $('#t33').DataTable( {
	        scrollY: "180px",
	        scrollX: true,
	        scrollCollapse: true,
	        paging: false,
	        searching: false,
	        ordering: false,
	        info: false,
	        autoWidth:false,
	        fixedHeader: true
	    } );

	    $(".dataTables_scrollHeadInner table").attr('style','margin-left: 0px;');

	    $(".dataTables_scrollHeadInner").attr('style','box-sizing: content-box; padding-right: 0px;');

	    $(".dataTables_scrollFootInner table").attr('style','margin-left: 0px;');

	    $(".dataTables_scrollFootInner").attr('style','padding-right: 0px;');

	});


	$('#lbl_region_i').select2();

	$('#lbl_sucursal_i').select2();

	$('#lbl_ciudad_i').select2();

	$('#txt_fecha_prog_i').ionDatePicker({
		lang:"es",
		sundayFirst:false,
		format:"DD-MM-YYYY",
		years:"2",
		onReady: function(){
			buscar();
		}
	});

	$('#txt_fecha_real_i').ionDatePicker({
		lang:"es",
		sundayFirst:false,
		format:"DD-MM-YYYY",
		years:"2",
		onReady: function(){
			buscar();
		}
	});

	function clearinfo(){
		$("#lbl_region_i").val('').trigger('change');
		$("#lbl_sucursal_i").val('').trigger('change');
		$("#lbl_ciudad_i").val('').trigger('change');
		$("#txt_fecha_prog_i").val("").trigger('change');
		$("#txt_fecha_real_i").val("").trigger('change');
		buscar();
	}

	function buscar(){
		var region="0";
		var sucursal="0";
		var ciudad="0";
		var fecha_programada="01-01-1900";
		var fecha_real="01-01-1900";

		if($("#lbl_region_i").val()==""){
			region="0";
		} else {
			region=$("#lbl_region_i").val();
		}
		if($("#lbl_sucursal_i").val()==""){
			sucursal="0";
		} else {
			sucursal=$("#lbl_sucursal_i").val();
		}
		if($("#lbl_ciudad_i").val()==""){
			ciudad="0";
		} else {
			ciudad=$("#lbl_ciudad_i").val();
		}
		if($("#txt_fecha_prog_i").val()==""){
			fecha_programada="01-01-1900";
		} else {
			fecha_programada=$("#txt_fecha_prog_i").val();
		}
		if($("#txt_fecha_real_i").val()==""){
			fecha_real="01-01-1900";
		} else {
			fecha_real=$("#txt_fecha_real_i").val();
		}

		var data = "region="+region+"&ciudad="+ciudad+"&sucursal="+sucursal+"&fecha_programada="+fecha_programada+"&fecha_real="+fecha_real;
		// if(region!="0" || sucursal!="0" || ciudad!="0" || fecha_programada!="01-01-1900" || fecha_real!="01-01-1900"){
			$.ajax({
				url:"http://masterplan.grupoprogestion.com/masterplan/informes/filtroinfo",
				type: "POST",
				data: data,
				dataType:"json",
				success: function (data) {
					var mat="";
					var acmat=0;
					var impmat=0;
					var por=0;
					var suc="";
					var acsuc=0;
					var impsuc=0;
					var reg="";
					var acreg=0;
					var impreg=0;
					
					var c=new Array();
					var s=new Array();
					for(i in data.cc){					
						c[i]=data.cc[i].ciudad;
						s[i]=data.cc[i].id_cliente;
					}
					var filteredR = c.filter(function(item, pos){
					  return c.indexOf(item)== pos; 
					});
					var filteredRA = s.filter(function(item, pos){
					  return s.indexOf(item)== pos; 
					});
					$('#lbl_ciudad_i').select2('destroy');
					$('#lbl_sucursal_i').select2('destroy');
					var ciudades="<option value=''>Ciudad</option>";
					var sucursales="<option value=''>Sucursal</option>";
					for(i=0;i<filteredR.length;i++){
						ciudades+="<option value='"+filteredR[i].replace(" ","0")+"'>"+filteredR[i]+"</option>"; 
					}
					for(i=0;i<filteredRA.length;i++){
						sucursales+="<option value='"+filteredRA[i]+"'>"+filteredRA[i]+"</option>";			
					}
					$('#lbl_ciudad_i').html(ciudades).select2();
					$('#lbl_sucursal_i').html(sucursales).select2();
					for(i in data.cc){
						if(region!="0" || sucursal!="0" || ciudad!="0" || fecha_programada!="01-01-1900" 
							|| fecha_real!="01-01-1900"){
							if(data.cc[i].fecha_real!==null){
								suc+="<tr style='font-size: 0.65rem;' onclick='window.open(\"<?php echo base_url("informes/detalleinfo/"); ?>"+btoa(data.cc[i].id_unico)+"\",\"popup\",\"width=screen.width,height=screen.height\"); return false;' role='row' class='odd'>";
								suc+="<td>"+data.cc[i].id_cliente+" - "+data.cc[i].nombre_fantasia+"</td>";
								suc+="<td>"+data.cc[i].ciudad+"</td>";
								suc+="<td>"+data.cc[i].region+"</td>";
								var fecha=new Date(data.cc[i].fecha_programada);
								var dd;
								var mm;
								if(fecha.getDate()<10){
								    dd='0'+fecha.getDate();
								} else {
									dd=fecha.getDate();
								}
								if((fecha.getMonth()+1)<10){
								    mm='0'+(fecha.getMonth()+1);
								} else {
									mm=fecha.getMonth()+1;
								}
								suc+="<td>"+dd+"-"+mm+"-"+fecha.getFullYear()+"</td>";
								if(data.cc[i].fecha_real!==null){
									fecha=new Date(data.cc[i].fecha_real);
									if(fecha.getDate()<10){
									    dd='0'+fecha.getDate();
									} else {
										dd=fecha.getDate();
									}
									if((fecha.getMonth()+1)<10){
										mm='0'+(fecha.getMonth()+1);
									} else {
										mm=fecha.getMonth()+1;
									}
									suc+="<td>"+dd+"-"+mm+"-"+fecha.getFullYear()+"</td>";
								} else {
									suc+="<td> </td>";
								}
								suc+="<td>"+data.cc[i].acuerdo+"</td>";
								acsuc+=parseInt(data.cc[i].acuerdo);
								suc+="<td>"+data.cc[i].imp+"</td>";
								impsuc+=parseInt(data.cc[i].imp);
								por=isNaN(((data.cc[i].imp/data.cc[i].acuerdo)*100)) ? 0 : Math.round(((data.cc[i].imp/data.cc[i].acuerdo)*100));
								suc+="<td>"+por+"%</td>";					
								suc+="</tr>";
							}

						} else {
							suc+="<tr style='font-size: 0.65rem;' onclick='window.open(\"<?php echo base_url("informes/detalleinfo/"); ?>"+btoa(data.cc[i].id_unico)+"\",\"popup\",\"width=screen.width,height=screen.height\"); return false;' role='row' class='odd'>";
							suc+="<td>"+data.cc[i].id_cliente+" - "+data.cc[i].nombre_fantasia+"</td>";
							suc+="<td>"+data.cc[i].ciudad+"</td>";
							suc+="<td>"+data.cc[i].region+"</td>";
							var fecha=new Date(data.cc[i].fecha_programada);
							var dd;
							var mm;
							if(fecha.getDate()<10){
							    dd='0'+fecha.getDate();
							} else {
								dd=fecha.getDate();
							}
							if((fecha.getMonth()+1)<10){
							    mm='0'+(fecha.getMonth()+1);
							} else {
								mm=fecha.getMonth()+1;
							}
							suc+="<td>"+dd+"-"+mm+"-"+fecha.getFullYear()+"</td>";
							if(data.cc[i].fecha_real!==null){
								fecha=new Date(data.cc[i].fecha_real);
								if(fecha.getDate()<10){
								    dd='0'+fecha.getDate();
								} else {
									dd=fecha.getDate();
								}
								if((fecha.getMonth()+1)<10){
									mm='0'+(fecha.getMonth()+1);
								} else {
									mm=fecha.getMonth()+1;
								}
								suc+="<td>"+dd+"-"+mm+"-"+fecha.getFullYear()+"</td>";
							} else {
								suc+="<td> </td>";
							}
							suc+="<td>"+data.cc[i].acuerdo+"</td>";
							acsuc+=parseInt(data.cc[i].acuerdo);
							suc+="<td>"+data.cc[i].imp+"</td>";
							impsuc+=parseInt(data.cc[i].imp);
							por=isNaN(((data.cc[i].imp/data.cc[i].acuerdo)*100)) ? 0 : Math.round(((data.cc[i].imp/data.cc[i].acuerdo)*100));
							suc+="<td>"+por+"%</td>";					
							suc+="</tr>";
						}
					}
					$("#t33 tbody").html(suc);
					$("#t33_wrapper .dataTables_scrollFoot tfoot tr").each(function(){
						$(this).find("th").eq(5).html(acsuc);
						$(this).find("th").eq(6).html(impsuc);
						var por=isNaN(((impsuc/acsuc)*100)) ? 0 : Math.round(((impsuc/acsuc)*100));
						$(this).find("th").eq(7).html(por+"%");
					});
				}
			});
		// }
	}

</script>
