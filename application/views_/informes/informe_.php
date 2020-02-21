<script src="<?php echo base_url("assets/js/libs/charts-peity/jquery.peity.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/libs/chart.js/dist/Chart.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/fastselect.standalone.js"); ?>"></script> 
<link rel="stylesheet" href="<?php echo base_url("assets/css/fastselect.min.css")?>"> 
<style type="text/css">
	.breadcrumb{
		background: white;
	}

	.summary-widgets small{
		font-size: 0.6rem !important;
	}

	.summary-widgets .number{
		font-size: 2.4rem !important;
	}

	.ecom-widget-sales ul li small{
		font-size: 0.75rem !important;
	}

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

	.tab td, .tab1 td, .tab2 td, .height td{
		cursor: pointer;
	}

	table th {
		 text-align: center;
	}

	table td {
		text-align: center;
	}

	.main {
		margin-left: 0px !important;
	}

	.height{
		max-height: 190px !important;
	}

	.tabheight{
		max-height: 220px !important;
	}


	.ecom-widget-sales-dark .ecom-sales-icon {
		font-size: 1.5rem !important;
	}

	.fstElement { font-size: 0.7em; }
	.fstToggleBtn { min-width: 16.5em; }

	.submitBtn { display: none; }

	.fstMultipleMode { display: block; }
	.fstMultipleMode .fstControls { width: 100%; }

	.dataTables_scroll
	{
	    overflow:auto;
	}

	table.dataTable{
		border-collapse: collapse !important;
	}

	.primary-bordered-table td, .primary-bordered-table th{
		white-space: pre-wrap;
	}
 

 	.ecom-widget-sales ul li span {
 		color: #6a7073 !important;
 	}

 	.ih-item.square{
 		width: 270px !important;
 	}

 	.products-widget .header {
 		padding: 10px !important;
 	}

	
</style>
<body class="app sidebar-fixed aside-menu-off-canvas aside-menu-hidden header-fixed  pace-done">
	<div class="app-body">
		<main class="main" style="height: 100%; ">
			<div class="breadcrumb">
				<li class="breadcrumb-item ">
			        <a href="">Dashboard</a>
			    </li>
			</div>
			<div class="container-fluid">
				<div class="animated fadeIn">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="ecom-widget-chart-full">
									<div class="chart-full-header">
										<div class="header-text">
											<div class="heading"><?php echo strtoupper($campana["campana"]);?></div>
										</div>
										<small class="text-white">DASHBOARD EJECUTIVO</small>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
						foreach($cc as $c){
							$region[]=$c["region"]."/".$c["id_region"];
							$ciudad[]=$c["ciudad"];
							$imp[]=$c["implementador"];
						}
					?>
					<div class="row">
						<div class="col-md-3">
							<div class="card">
								<div class="clearfix">
									<select class="form-control"  id="lbl_region" name="lbl_region" multiple placeholder="REGIONES" onchange="filtroinfo()">
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
							</div>
						</div>
						<div class="col-md-3">
							<div class="card">
								<div class="clearfix">
									<select  class="form-control"  id="lbl_ciudad" name="lbl_ciudad" multiple placeholder="CIUDADES" onchange="filtroinfo()">
										<?php
											for($i=0;$i<count($cc);$i++){
												if(isset(array_unique($ciudad)[$i])){
													echo "<option value='".str_replace(" ","0",array_unique($ciudad)[$i])."'>".array_unique($ciudad)[$i]."</option>";					
												}
											}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card">
								<div class="clearfix">
									<select  class="form-control"  id="lbl_sucursal" name="lbl_sucursal"  multiple placeholder="SUCURSALES" onchange="filtroinfo()">
										<?php
											foreach ($cc as $c) {
												echo "<option value='".$c["id_cliente"]."'>".$c["id_cliente"]."</option>";		
											}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card">
								<div class="clearfix">
									<select class="form-control"  id="lbl_implementador" name="lbl_implementador" multiple placeholder="IMPLEMENTADOR" onchange="filtroinfo()">
										<?php
											for($i=0;$i<count($cc);$i++){
												if(isset(array_unique($imp)[$i])){
													echo "<option value='".str_replace(" ","0",array_unique($imp)[$i])."'>".array_unique($imp)[$i]."</option>";
												}
											}
										?>
									</select>
								</div>
							</div>
						</div>
					</div>
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
					<div class="row">
						<div class="col-md-2 padr0 " >
							<div class="row">
								<div class="col-md-12">
									<div class="card card-accent-left-primary" style="margin-bottom: 0.4rem;">
										<div class="card-body p-3 clearfix">									
											<div class="h4 text-theme mb-0 font-weight-bold"><?php echo $total; ?></div>
											<div class="text-muted text-uppercase  font-xs">PDV VISITADOS</div>
										</div>
									</div>
								</div>
								<div class="col-md-12 ">
									<div class="card card-accent-left-primary" style="margin-bottom: 0.4rem;">
										<div class="card-body p-3 clearfix">									
											<div class="h4 text-theme mb-0 font-weight-bold"><?php echo count($cc); ?></div>
											<div class="text-muted text-uppercase font-xs">PDV A VISITAR</div>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="card card-accent-left-primary" >
										<div class="card-body p-3 clearfix">									
											<div class="text-theme mb-0 font-xs font-weight-bold"><?php echo $campana["fecha_inicio"]; ?></div>
											<div class="text-muted text-uppercase font-xs">INICIO CAMPAÑA</div><br>
											<div class="text-theme mb-0 font-xs font-weight-bold"><?php echo $campana["fecha_termino"]; ?></div>
											<div class="text-muted text-uppercase font-xs">FIN CAMPAÑA</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4" >
							<div class="row">
								<div class="col-md-6 padl6 padr0" >
									<table class="table color-bordered-table primary-bordered-table tab" id="t1" width="100%" >
										<thead>
											<tr style="font-size: 0.6rem;" >
												<th>DÍA</th>
												<th>ACORDADOS</th>
											</tr>
										</thead>
										<tbody>
											<?php
											foreach($cc as $fp){
												$sum=0;
												foreach ($cc as $fpi) { 
													if($fp["fecha_programada"]==$fpi["fecha_programada"]){
														$sum+=1;
													}
												}
												$fecha_programada[]=$fp["fecha_programada"];
												$suma_programada[]=$sum;
											}
											$total=0;
											for($i=0;$i<count($cc);$i++){
												if(isset(array_unique($fecha_programada)[$i])){
													echo "<tr style='font-size: 0.6rem;' >";
													echo "<td class='bg-theme'>".date("d-m-Y",strtotime(array_unique($fecha_programada)[$i]))."</td>";
													echo "<td >".array_unique($suma_programada)[$i]."</td>";
													$total+=array_unique($suma_programada)[$i];
													echo "</tr>";
												}
											}
											?>
										</tbody>
										<tfoot>
											<tr style="font-size: 0.6rem;" class="bg-theme">
												<th >TOTAL</th>
												<th ><?php echo $total; ?></th>
											</tr>
										</tfoot>
									</table>
								</div>
								<div class="col-md-6 padl0 padr0" >
									<table  class="table color-bordered-table primary-bordered-table tab" id="t2" width="100%">
										<thead>
											<tr style="font-size: 0.6rem;">
												<th>DÍA</th>
												<th>VISITADOS</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$total=0;
											for($i=0;$i<count($cc);$i++){
												if(isset(array_unique($fecha_real)[$i])){
													echo "<tr style='font-size: 0.6rem;' >";
													echo "<td class='bg-theme'>".date("d-m-Y",strtotime(array_unique($fecha_real)[$i]))."</td>";
													$c=explode("/",array_unique($suma_real)[$i]);
													echo "<td >".$c[1]."</td>";
													$total+=$c[1];
													echo "</tr>";

												}
											}
											?>
										</tbody>
										<tfoot>
											<tr class="bg-theme" style="font-size: 0.6rem;">
												<th >TOTAL</th>
												<th><?php $txv=$total; echo $total; ?></th>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
						<div class="col-md-6 " >
							<div class="row">
								<div class="col-md-6 padr0">
									<div class="card ecom-widget-sales">
										<div class="card-body">
											<h6 >Cantidad de Implementados</h6>
											<div class="card-body row text-center">
												<div class="col-sm-6 col-xs-6 " >
						                            <span class="donut" data-peity='{ "fill": ["#E64A19", "#F4D9CE"]}'><?php echo $total; ?>/<?php echo count($cc); ?></span>
						                            <small class="text-theme">PDV: <?php echo $total; ?></small>
												</div>
						                        <div class="col-sm-6 col-xs-6">
						                            <span class="donut" data-peity='{ "fill": ["#F77743", "#F4D9CE"]}'><?php echo $timp; ?>/<?php echo $tac; ?></span>
						                            <small class="text-theme">MAT: <?php echo $timp; ?></small>
						                        </div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 " >
									<div class="card ecom-widget-sales">
										<div class="card-body">
											<h6 >Porcentaje de Cumplimiento</h6>
											<div class="card-body row text-center">
					                            <div class="col-sm-6 col-xs-6 ">
					                                <span class="donut" data-peity='{ "fill": ["#E64A19", "#F4D9CE"]}'><?php echo $total; ?>/<?php echo count($cc); ?></span>
					                                <small class="text-theme">PDV: <?php echo round(($total/count($cc))*100,2); ?>%</small>
					                            </div>
					                            <div class="col-sm-6 col-xs-6 ">
					                               	<span class="donut" data-peity='{ "fill": ["#F77743", "#F4D9CE"]}'><?php echo $timp; ?>/<?php echo $tac; ?></span>
					                                <small class="text-theme">MAT:  <?php  if($timp!=0){ echo round(($timp/$tac)*100,2); } else { echo "0"; } ?>% </small>                           
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 padl0">
							<table class="table color-bordered-table primary-bordered-table tab1" id="t3" width="100%">
								<thead>
									<tr style="font-size: 0.7rem;">
										<th>REGIÓN</th>
										<th>PDV</th>
										<th>VISITADO</th>
										<th>%</th>
									</tr>
								</thead>
								<tbody>
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
										$regiones[]=$r["region"]."/".$r["id_region"];
										$suma_regiones[]=$r["region"]."/".$sum;
										$suma_regionvs[]=$r["region"]."/".$sumv;
									}
									$tsv=0;
									$tv=0;
									for($i=0;$i<count($cc);$i++){
										if(isset(array_unique($regiones)[$i])){
											echo "<tr style='font-size: 0.7rem;' >";
											$re=explode("/",array_unique($regiones)[$i]);
											echo "<td class='bg-theme'>".$re[0]." <input type='hidden' value='".$re[1]."' class='form-control' ></td>";
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
									<tr style="font-size: 0.7rem;" class="bg-theme">
										<th>TOTAL</th>
										<th ><?php echo $tsv; ?></th>
										<th ><?php echo $tv; ?></th>
										<th ><?php echo round(($tv/$tsv)*100,2); ?>%</th>
									</tr>
								</tfoot>
							</table>											
						</div>
						<div class="col-md-8">
							<div class="card">
								<div class="card-body">
									<div class="text-center">
										<canvas id="chart2" height="80"></canvas>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 padl0 padr0">
							<table class="table color-bordered-table primary-bordered-table tab1" id="t4" width="100%">
								<thead>
									<tr style="font-size: 0.64rem;">
										<th>SUCURSAL</th>
										<th>REGIÓN</th>
										<th>CIUDAD</th>
										<th>DIRECCIÓN</th>
										<th>FECHA PROGRAMADA</th>
										<th>FECHA IMPLEMENTACIÓN</th>
										<th>IMPLEMENTADOR</th>										
										<th>AC</th>
										<th>IMP</th>
										<th>%</th>
										<th>MOTIVO</th>
										<th>REVISAR IMPLEMENTACIÓN</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$tsv=0;
									$tv=0;
										foreach($cc as $c){
											echo "<tr style='font-size:0.64rem;'>";
											echo "<td >".$c["id_cliente"]."</td>";
											echo "<td>".$c["region"]."</td>";
											echo "<td>".$c["ciudad"]."</td>";
											echo "<td>".$c["direccion"]."</td>";
											echo "<td>".date("d-m-Y",strtotime($c["fecha_programada"]))."</td>";
											if(is_null($c["fecha_real"])){
												$fecha="";
											} else {
												$fecha=date("d-m-Y",strtotime($c["fecha_real"]));
											}
											echo "<td>".$fecha."</td>";
											echo "<td>".$c["implementador"]."</td>";
											echo "<td>".$c["acuerdo"]."</td>";
											$tsv+=$c["acuerdo"];
											echo "<td>".$c["imp"]."</td>";
											$tv+=$c["imp"];
											if($c["imp"]==0){
												echo "<td>0%</td>";
											} else {
												echo "<td>".round((($c["imp"]/$c["acuerdo"])*100),2)."%</td>";
											}	
											echo "<td>".$c["id_motivo"]."</td>";
											echo "<td><button class='btn btn-theme btn-sm' onclick=\"window.open('".base_url("informes/detalle/".base64_encode($c["id_unico"]))."', 'popup', 'width=screen.width,height=screen.height'); return false;\"><i class='fa fa-info'></i>VER</button></td>";									
											echo "</tr>";
										}
									?>
								</tbody>
								<tfoot>
									<tr style="font-size: 0.7rem;" class="bg-theme">
										<th>TOTAL</th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th ><?php echo $tsv; ?></th>
										<th ><?php echo $tv; ?></th>
										<th ><?php if($tv!=0){ echo round(($tv/$tsv)*100,2); } else { echo "0"; }?>%</th>
										<th></th>
										<th></th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</main>
	</div>
</body>
<script type="text/javascript">

	$(document).ready(function() {


	    var t1= $('#t1').DataTable( {
	        scrollY: "190px",
	        scrollX: true,
	        scrollCollapse: true,
	        paging: false,
	        searching: false,
	        ordering: false,
	        info: false,
	        autoWidth:false,
	        fixedHeader: true
	    } );

		$('#t1 tbody').on('click','tr',function(){
			if($(this).hasClass('selected')){
				$(this).removeClass('selected');
			} else {
				t1.$('tr.selected').removeClass('selected');
				$(this).addClass('selected');
				filtroinfo();
			}
		});

		var t11= $('#t2').DataTable( {
	        scrollY: "190px",
	        scrollX: true,
	        scrollCollapse: true,
	        paging: false,
	        searching: false,
	        ordering: false,
	        info: false,
	        autoWidth:false,
	        fixedHeader: true
	    } );

		$('#t2 tbody').on('click','tr',function(){
			if($(this).hasClass('selected')){
				$(this).removeClass('selected');
			} else {
				t11.$('tr.selected').removeClass('selected');
				$(this).addClass('selected');
				// filtroinfo();

			}
		});

		var t2=$('#t3').DataTable( {
	        scrollY: "170px",
	        scrollX: true,
	        scrollCollapse: true,
	        paging: false,
	        searching: false,
	        ordering: false,
	        info: false,
	        autoWidth:false,
	        fixedHeader: true
	    } );

	    $('#t3 tbody').on('click','tr',function(){
			if($(this).hasClass('selected')){
				$(this).removeClass('selected');
			} else {
				t2.$('tr.selected').removeClass('selected');
				$(this).addClass('selected');
				// filtroinfo();
			}
		});

	    var t21=$('#t4').DataTable( {
	        scrollY: "300px",
	        scrollX: true,
	        scrollCollapse: true,
	        paging: false,
	        searching: false,
	        ordering: false,
	        info: false,
	        autoWidth:false,
	        fixedHeader: true
	    } );

	    $('#t4 tbody tr').on('click','td',function(){
	    	var col=$("#t4 tr:last td").length;
	    	var colclick=parseInt($(this).parent().children().index($(this)))+1;
	    	
	    	if(col!=colclick){
				if($(this).parent().hasClass('selected')){
					$(this).parent().find('td:last').find("button").removeClass('btn-outline-theme').addClass("btn-theme");
					$(this).parent().removeClass('selected');
					
				} else {
					t21.$('tr.selected').find('td:last').find("button").removeClass('btn-outline-theme').addClass("btn-theme");
					t21.$('tr.selected').removeClass('selected');
					$(this).parent().find('td:last').find("button").removeClass('btn-theme').addClass("btn-outline-theme");
					$(this).parent().addClass('selected');					
					// filtroinfo();
				}
			} else {
				$(this).parent().removeClass('selected');
			}
		});
	    
		$(".dataTables_scrollHeadInner table").attr('style','margin-left: 0px;');

	    $(".dataTables_scrollHeadInner").attr('style','box-sizing: content-box; padding-right: 0px;');

	    $(".dataTables_scrollFootInner table").attr('style','margin-left: 0px;');

	    $(".dataTables_scrollFootInner").attr('style','padding-right: 0px;');
	    

	} );

	$("span.donut").peity("donut", {
	    width: 100,
	    height: 100
	});

	var ctx = document.getElementById("chart2").getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: [<?php for ($i=0; $i < count($cc); $i++) { 
				if(isset(array_unique($regiones)[$i])){
					$re=explode("/",array_unique($regiones)[$i]);
					echo "'".$re[0]."',";
				}				
			} ?>],
			datasets: [{
				label: 'PROGRAMADO',
				data: [<?php for ($i=0; $i < count($cc); $i++) { 
					if(isset(array_unique($suma_regiones)[$i])){
						$c=explode("/",array_unique($suma_regiones)[$i]);
						echo "".$c[1].",";
					}				
				} ?>],
				backgroundColor: "#FE642E"
			},{
				label: 'VISITADOS',
				data: [<?php for ($i=0; $i < count($cc); $i++) { 
					if(isset(array_unique($suma_regionvs)[$i])){
						$c=explode("/",array_unique($suma_regionvs)[$i]);
						echo "".$c[1].",";
					}				
				} ?>],
				backgroundColor: "#F5BCA9"
			}]
		}
	});



	

	$('#lbl_sucursal').fastselect();

	$('#lbl_ciudad').fastselect();

	$('#lbl_region').fastselect();

	$('#lbl_implementador').fastselect();


function filtroinfo(){
	var region="0";
	var sucursal="0";
	var ciudad="0";
	var implementador="0";
	var fecha_programada="01-01-1900";
	var fecha_real="01-01-1900";

	if($("#lbl_region").val()==""){
		region="0";
	} else {
		region=$("#lbl_region").val();
	}
	if($("#lbl_sucursal").val()==""){
		sucursal="0";
	} else {
		sucursal=$("#lbl_sucursal").val();
	}
	if($("#lbl_ciudad").val()==""){
		ciudad="0";
	} else {
		ciudad=$("#lbl_ciudad").val();
	}
	if($("#lbl_implementador").val()==""){
		implementador="0";
	} else {
		implementador=$("#lbl_implementador").val();
	}

	$('#t1 tbody tr').each(function(){
		if($(this).hasClass('selected')){
			fecha_programada=$(this).find("td:eq(0)").text();
		} else {
			fecha_programada="01-01-1900";
		}
	});
	$('#t2 tbody tr').each(function(){
		if($(this).hasClass('selected')){
			fecha_real=$(this).find("td:eq(0)").text();
		} else {
			fecha_real="01-01-1900";
		}
	});
	$('#t3 tbody tr').each(function(){
		if($(this).hasClass('selected')){
			region=$(this).find("td:eq(0)").find("input").val();
		} else {
			region="0";
		}
	});
	$('#t4 tbody tr').each(function(){
		if($(this).hasClass('selected')){
			sucursal=$(this).find("td:eq(0)").text();
		} else {
			sucursal="0";
		}
	});

	var data = "region="+region+"&ciudad="+ciudad+"&sucursal="+sucursal+"&imp="+implementador+"&fecha_programada="+fecha_programada+"&fecha_real="+fecha_real;
	$.ajax({
		url:"http://masterplan.grupoprogestion.cominformes/filtro",
		type: "POST",
		data: data,
		dataType:"json",
		success: function (data) {
			// var sucursal="";
			// for (var i = 0; i < data['id_cliente'].length; i++) {
			// 	sucursal+="<option value='"+data['id_cliente'][i]+"'>"+data['id_cliente'][i]+"</option>";
			// }
			// $("#lbl_sucursal").html(sucursal);
			// var ciudad="";
			// for (var i = 0; i < 1000; i++) {
			// 	if(data['ciudad'][i]!==undefined){
			// 		var ciu=data['ciudad'][i].split("/");
			// 		ciudad+="<option value='"+ciu[1]+"'>"+ciu[0]+"</option>";
			// 	}				
			// }
			// $("#lbl_ciudad").html(ciudad);
		}
	});
}


   
</script>
