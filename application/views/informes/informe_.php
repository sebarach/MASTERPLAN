<script src="<?php echo base_url("assets/js/libs/charts-peity/jquery.peity.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/libs/chart.js/dist/Chart.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/fastselect.standalone.js"); ?>"></script> 
<link rel="stylesheet" href="<?php echo base_url("assets/css/fastselect.min.css")?>"> 
<style type="text/css">
	.breadcrumb{
		background: white;
		margin: 0;
		padding:0.15rem 0.3rem;
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

	.select2-container--default .select2-selection--single{
 		min-height: 34px !important;
 	}

 	.form-control{
 		font-size: 0.7rem !important;
 	}

	.fstElement { font-size: 0.5em; }
	.fstResultItem { font-size: 1em; }
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
		margin-top: 0px !important;
		border-spacing: 0;
	}

	.primary-bordered-table td, .primary-bordered-table th{
		white-space: pre-wrap;
		word-wrap: break-word;
 		max-width: 3.75rem;
 		vertical-align: middle;
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

 	.ecom-widget-chart-full .chart-full-header .heading {
 		font-size: 0.8rem !important;
 	}

 	.ecom-widget-chart-full .chart-full-header{
 		padding:8px 30px !important;
 	}

 	.ecom-widget-chart-full{
 		margin-top: 0 !important;
 		background-color: <?php if(isset($empresa)){ echo $empresa["color_principal"]; } else { echo "#f57c00"; }?>;
 	}


 	.table th, .table td{
 		padding:0.7rem;
 	}

 	.table tbody tr{
 		background-color: white;
 	}

 	.tab-content .tab-pane{
 		padding: 0;
 	}

 	.custom-tab .nav-link.active{
 		border-bottom: 5px solid <?php if(isset($empresa)){ echo $empresa["color_principal"]; } else { echo "#f57c00"; }?>;
 	}

 	.border-primary {
	    border-color: <?php if(isset($empresa)){ echo $empresa["color_principal"]; } else { echo "#f57c00"; }?> !important;
	}

	.color-bordered-table.primary-bordered-table {
	    border: 2px solid <?php if(isset($empresa)){ echo $empresa["color_principal"]; } else { echo "#f57c00"; }?>;
	}

	.bg-theme{
		background-color: <?php if(isset($empresa)){ echo $empresa["color_principal"]; } else { echo "#f57c00"; }?> !important;
	}

	.color-bordered-table.primary-bordered-table thead th{
		background-color: <?php if(isset($empresa)){ echo $empresa["color_principal"]; } else { echo "#f57c00"; }?>;
	}

	table.dataTable tbody>tr.selected, table.dataTable tbody>tr>.selected {
	    background-color: <?php if(isset($empresa)){ echo $empresa["color_principal"]; } else { echo "#f57c00"; }?> !important;
	}


	.select2-container--default .select2-results__option--highlighted[aria-selected] {
    	background-color: <?php if(isset($empresa)){ echo $empresa["color_principal"]; } else { echo "#f57c00"; }?>;
    }

    .btn-theme {
	    -webkit-box-shadow: 0px 5px 25px -3px <?php if(isset($empresa)){ echo $empresa["color_principal"]; } else { echo "#f57c00"; }?>;
	    -moz-box-shadow: 0px 5px 25px -3px <?php if(isset($empresa)){ echo $empresa["color_principal"]; } else { echo "#f57c00"; }?>;
	    box-shadow: 0px 5px 25px -3px <?php if(isset($empresa)){ echo $empresa["color_principal"]; } else { echo "#f57c00"; }?>;
	    background: <?php if(isset($empresa)){ echo $empresa["color_principal"]; } else { echo "#f57c00"; }?>;
	}

	.btn-outline-theme {
	    -webkit-box-shadow: 0px 5px 25px -3px <?php if(isset($empresa)){ echo $empresa["color_principal"]; } else { echo "#f57c00"; }?>;
	    -moz-box-shadow: 0px 5px 25px -3px <?php if(isset($empresa)){ echo $empresa["color_principal"]; } else { echo "#f57c00"; }?>;
	    box-shadow: 0px 5px 25px -3px <?php if(isset($empresa)){ echo $empresa["color_principal"]; } else { echo "#f57c00"; }?>;
	    color: <?php if(isset($empresa)){ echo $empresa["color_principal"]; } else { echo "#f57c00"; }?>;
	    background: #fff;
	    border: 1px solid <?php if(isset($empresa)){ echo $empresa["color_principal"]; } else { echo "#f57c00"; }?>;
	}

	.btn-outline-theme:hover {
	    background: <?php if(isset($empresa)){ echo $empresa["color_principal"]; } else { echo "#dc6f00"; }?> !important;
	}

	.btn-theme:hover {
	    background: <?php if(isset($empresa)){ echo $empresa["color_principal"]; } else { echo "#dc6f00"; }?> !important;
	}

	<?php if(isset($empresa)){ 
		echo ".tab-content{
			background-size: 100% 100%;
    		background-repeat: no-repeat; 
    		background-image: url(".base_url("archivos/fondos/").$empresa["imagen_fondo"].");
    		margin-top: 0; 
    		width:100%; 
		}";
	}?>


	
</style>
<body class="app sidebar-fixed aside-menu-off-canvas aside-menu-hidden header-fixed  pace-done">
	<div class="app-body">
		<main class="main" >
			<div class="breadcrumb">
			</div> 
			<div class="container-fluid" style="padding: 0;">
				<div class="animated fadeIn">
					<ul class="nav nav-tabs custom-tab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" style="font-size: 0.8rem;" data-toggle="tab" role="tab" href="#uno">SUCURSALES VISITADAS</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" style="font-size: 0.8rem;" data-toggle="tab" role="tab" href="#dos">MATERIALES IMPLEMENTADOS</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" style="font-size: 0.8rem;" data-toggle="tab" role="tab" href="#tres">DETALLE IMPLEMENTACIÓN</a>
							</li>
					</ul>
					<div class="tab-content" >						
							<?php
								foreach($cc as $c){
									$region[]=$c["region"]."/".$c["id_region"];
									$ciudad[]=$c["ciudad"];
									$imp[]=$c["implementador"];
								}
							?> 
						<div class="row card-body" style="padding:0.7rem;">
							<div class="col-md-3">
								<div class="card" style="margin-bottom: 0.5rem;">
									<div class="ecom-widget-chart-full">
										<div class="chart-full-header">
											<div class="header-text">
												<div class="heading"><?php echo strtoupper($campana["campana"]);?></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="card" style="margin-bottom: 0.8rem;">
									<div class="clearfix">
										<select class="form-control"  id="lbl_region_i" name="lbl_region_i" onchange="buscar()">
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
								</div>
							</div>
							<div class="col-md-2">
								<div class="card" style="margin-bottom: 0.8rem;">
									<div class="clearfix">
										<select  class="form-control"  id="lbl_ciudad_i" name="lbl_ciudad_i" onchange="buscar()">
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
								</div>
							</div>
							<div class="col-md-2">
								<div class="card" style="margin-bottom: 0.8rem;">
									<div class="clearfix">
										<select  class="form-control"  id="lbl_sucursal_i" name="lbl_sucursal_i" onchange="buscar()">
											<option value="">Sucursal</option>
											<?php
											foreach ($cc as $c) {
												echo "<option value='".$c["id_cliente"]."'>".$c["id_cliente"]."</option>";		
											}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="card" style="margin-bottom: 0.8rem;">
									<div class="clearfix">
										<select class="form-control"  id="lbl_implementador_i" name="lbl_implementador_i" onchange="buscar()">
											<option value="">Implementador</option>
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
							<div class="col-md-1">
								<!-- <button onclick="clearinfo();" class="btn btn-theme"><i class="fa fa-spin fa-refresh"></i></button> -->
								<a href="<?php echo base_url("informes/excelcam"); ?>" class="btn btn-theme"><i class="fa fa-download"></i></a>
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
								$totalv=0;
								for($i=0;$i<count($cc);$i++){
									if(isset(array_unique($fecha_real)[$i])){
										$c=explode("/",array_unique($suma_real)[$i]);
										$totalv+=$c[1];
									}
								}
							?>
							<div class="tab-pane active" id="uno" style="height: 100%;">								
								<div class="row card-body" style="padding:0.6rem;">
									<div class="col-md-3 ">
										<div class="row">
											<div class="col-md-9" style="margin:auto;">
												<div class="text-center">
													<div class="card border-primary mb-3 text-center">
														<div class="card-body" style="padding:0.6rem;">
															<div class="text-muted text-uppercase font-xs">PDV IMPLEMENTADOS</div>
															<div class="h4 text-theme mb-0 font-weight-bold"><?php echo $totalv; ?></div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-12 padl6">
												<table class="table color-bordered-table primary-bordered-table tab1" id="t3" width="100%">
													<thead>
														<tr style="font-size: 0.6rem;">
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
																echo "<tr style='font-size: 0.6rem;' >";
																$re=explode("/",array_unique($regiones)[$i]);
																echo "<td class='bg-theme'>".$re[0]." <input type='hidden' value='".$re[1]."' class='form-control' ></td>";
																$c=explode("/",array_unique($suma_regiones)[$i]);
																echo "<td >".$c[1]."</td>";
																$tsv+=$c[1];
																$ci=explode("/",array_unique($suma_regionvs)[$i]);
																echo "<td >".$ci[1]."</td>";
																$tv+=$ci[1];
																if($ci[1]==0){
																	echo "<td >0%</td>";
																} else {
																	echo "<td >".round((($ci[1]/$c[1])*100),2)."%</td>";
																}																
																echo "</tr>";

															}
														}
														?>
													</tbody>
													<tfoot>
														<tr style="font-size: 0.6rem;" class="bg-theme">
															<th>TOTAL</th>
															<th ><?php echo $tsv; ?></th>
															<th ><?php echo $tv; ?></th>
															<th ><?php
																if($tv==0){
																	echo 0;
																} else {
																	echo round(($tv/$tsv)*100,2);
																} ?>%</th>
														</tr>
													</tfoot>
												</table>
											</div>
										</div>																					
									</div>
									<div class="col-md-9">
										<div class="row">
											<div class="col-md-4 padl0 padr0" >
												<table class="table color-bordered-table primary-bordered-table tab" id="t1" width="100%" >
													<thead>
														<tr style="font-size: 0.6rem;" >
															<th>DÍA</th>
															<th>PROGRAMADO</th>
															<th>VISITADO</th>
														</tr>
													</thead>
													<tbody>
														<?php
															$contador=0;
															$contReal=0;
															$fecha_programada=array();
															$fecha_real=array();
															$fProgDia=array();
															$real=array();
															$count=array();
															foreach ($cc as $fp) {
																$fecp=new DateTime($fp["fecha_programada"]);
																$fecha_programada[]=$fecp->format("d-m-Y");
																if (!is_null($fp["fecha_real"])) {
																	$fecr=new DateTime($fp["fecha_real"]);
																	$fecha_real[]=$fecr->format("d-m-Y");

																}

															}
															// var_dump($cc);
															$fechaP=array_count_values($fecha_programada);
															$fechaR=array_count_values($fecha_real);
															$fProgDia=array_unique($fecha_programada);
															$fRealDia=array_unique($fecha_real);
															foreach ($fechaR as $fr) {
																$fRe[]=$fr;
															}
															foreach ($fechaP as $fp) {
																$fProg[]=$fp;
															}
															if (count($fRe)>count($fProg)) {
																for ($i=0; $i < count($fRe); $i++) { 
																	$fProg[]="";
																}
															}
															foreach ($fProgDia as $fpa) {
																$diaProg[]=$fpa;
															}
															foreach ($fRealDia as $fra) {
																$diaReal[]=$fra;
															}
															for ($i=0; $i < sizeof($fRe); $i++) { 
																echo "<tr style='font-size: 0.6rem;'>";	
																echo "<td  class='bg-theme'>".date("d-m-Y", strtotime($diaReal[$i]))."</td>";
																echo "<td>".$fProg[$i]."</td>";
																echo "<td>".$fRe[$i]."</td>";
																echo "</tr>";
															}

														?>
													</tbody>
													<tfoot>
														<tr style="font-size: 0.6rem;" class="bg-theme">
															<th>TOTAL</th>
															<th ><?php echo $tsv; ?></th>
															<th ><?php echo $tv; ?></th>
														</tr>
													</tfoot>
												</table>
											</div>
											<div class="col-md-4">
												<div class="card" style="margin-bottom: 1.1rem;">
													<div class="card-body" style="padding:0.7rem;">
														<div class="col-sm-12 col-xs-6">
															<div class="text-uppercase  font-xs text-theme">IMPLEMENTACIONES</div>
														</div>
														<div  class="row text-center">
															<div class="col-sm-12 col-xs-6" style="padding-top:0.5rem;">	
																<span id="dona1" class="donut" data-peity='{ "fill": ["<?php if(isset($empresa)){ echo $empresa["color_grafico_1"]; } else { echo "#E64A19"; }?>", "#D3CDCD"]}'><?php echo $totalv; ?>/<?php echo count($cc); ?></span>	
								                            </div>
								                            <div class="col-sm-12 col-xs-6" style="padding-top:0;">
								                            	<small class="text-theme">PDV: <?php echo $totalv; ?></small> 
								                            </div>
														</div>														
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="card" style="margin-bottom: 1.1rem;">
													<div class="card-body" style="padding:0.7rem;">
														<div class="col-sm-12 col-xs-6">
															<div class="text-uppercase  font-xs text-theme">CUMPLIMIENTO %</div>
														</div>
														<div  class="row text-center">
															<div class="col-sm-12 col-xs-6" style="padding-top:0.5rem;">
																<span id="dona2" class="donut" data-peity='{ "fill": ["<?php if(isset($empresa)){ echo $empresa["color_grafico_1"]; } else { echo "#E64A19"; }?>", "#D3CDCD"]}'><?php echo $totalv; ?>/<?php echo count($cc); ?></span>
															</div>
															<div class="col-sm-12 col-xs-6" style="padding-top:0;">
																<small class="text-theme">PDV: <?php echo round(($totalv/count($cc))*100,2); ?>%</small>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="card">
													<div class="card-body" style="padding:0.6rem;">
														<div class="text-center">
															<canvas id="chart2" height="58"></canvas>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane" id="dos" style="height: 100%;">
								<?php
								
									// $tac=0;
									// $timp=0;
									// foreach($cc as $fr){
									// 	$sum=0;
									// 	foreach ($cc as $fri) { 
									// 		if($fr["fecha_real"]==$fri["fecha_real"]){
									// 			$sum+=1;
									// 		}
									// 	}
									// 	$fecha_real[]=$fr["fecha_real"];
									// 	$suma_real[]=$fr["fecha_real"]."/".$sum;
									// 	$tac+=$fr["acuerdo"];
									// 	$timp+=$fr["imp"];
									// }
									// $totalv=0;
									// var_dump(count($cc));

									// for($i=0;$i<count($cc);$i++){
									// 	if(isset(array_unique($fecha_real)[$i])){
									// 		$c=explode("/",array_unique($suma_real)[$i]);

									// 			$totalv+=$c[1];
											
									// 	}
									// }
									// var_dump($totalv);
								?>
								<div class="row card-body" style="padding:0.6rem;">										
									<div class="col-md-3">
										<div class="row">
											<div class="col-md-9" style="margin:auto;">
												<div class="text-center">
													<div class="card border-primary mb-3 text-center">
														<div class="card-body" style="padding:0.6rem;">
															<div class="text-muted text-uppercase font-xs" >MATERIALES IMPLEMENTADOS</div>
															<div class="h4 text-theme mb-0 font-weight-bold"><?php echo $timp; ?></div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-12 padl6">
												<table class="table color-bordered-table primary-bordered-table tab1" id="t2" width="100%">
													<thead>
														<tr style="font-size: 0.6rem;">
															<th>REGIÓN</th>
															<th>TOTAL MAT</th>
															<th>IMP</th>
															<th>% MAT</th>
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
																		$sumv+=$ri["imp"];
																	}
																	$sum+=$ri["acuerdo"];
																}
															}
															$regiones[]=$r["region"]."/".$r["id_region"];
															$suma_regionesm[]=$r["region"]."/".$sum;
															$suma_regionvsm[]=$r["region"]."/".$sumv;
														}
														$tsv=0;
														$tv=0;
														for($i=0;$i<count($cc);$i++){
															if(isset(array_unique($regiones)[$i])){
																echo "<tr style='font-size: 0.6rem;' >";
																$re=explode("/",array_unique($regiones)[$i]);
																echo "<td class='bg-theme'>".$re[0]." <input type='hidden' value='".$re[1]."' class='form-control' ></td>";
																$c=explode("/",array_unique($suma_regionesm)[$i]);
																echo "<td >".$c[1]."</td>";
																$tsv+=$c[1];
																$ci=explode("/",array_unique($suma_regionvsm)[$i]);
																echo "<td >".$ci[1]."</td>";
																$tv+=$ci[1];
																if($ci[1]==0){
																	echo "<td >0%</td>";
																} else {
																	echo "<td >".round((($ci[1]/$c[1])*100),2)."%</td>";
																}																
																echo "</tr>";

															}
														}
														?>
													</tbody>
													<tfoot>
														<tr style="font-size: 0.6rem;" class="bg-theme">
															<th>TOTAL</th>
															<th ><?php echo $tsv; ?></th>
															<th ><?php echo $tv; ?></th>
															<th ><?php
																if($tv==0){
																	echo 0;
																} else {
																	echo round(($tv/$tsv)*100,2);
																} ?>%</th>
														</tr>
													</tfoot>
												</table>
											</div>
										</div>
									</div>
									<div class="col-md-9">
										<div class="row">
											<div class="col-md-4 padl0 padr0" >
												<table class="table color-bordered-table primary-bordered-table tab" id="t5" width="100%" >
													<thead>
														<tr style="font-size: 0.6rem;" >
															<th>DÍA</th>
															<th>PROGRAMADO</th>
															<th>IMPLEMENTADO</th>
														</tr>
													</thead>
													<tbody>
														<?php
														foreach($cc as $fp){
															$sum=0;
															$sumi=0;
															foreach ($cc as $fpi) { 
																if($fp["fecha_programada"]==$fpi["fecha_programada"]){
																	$sum+=$fpi["acuerdo"];
																	$sumi+=$fpi["imp"];
																}
															}
															$fecha_programadam[]=$fp["fecha_programada"]."/".$sum."/".$sumi;
														}										
														$total=0;
														$totali=0;
														for($i=0;$i<count($cc);$i++){
															if(isset(array_unique($fecha_programadam)[$i])){
																$f=explode('/',array_unique($fecha_programadam)[$i]);
																echo "<tr style='font-size: 0.6rem;' >";
																echo "<td class='bg-theme'>".date("d-m-Y",strtotime($f[0]))."</td>";
																echo "<td >".$f[1]."</td>";	
																$total+=$f[1];
																echo "<td >".$f[2]."</td>";										
																$totali+=$f[2];
																echo "</tr>";
															}
														}
														// foreach ($cc as $fr) {
														// 	$acuerdo[]=$fr["acuerdo"];
														// 	if (!is_null($fr["imp"])) {
														// 		$implementado[]=$fr["imp"];
														// 	}
														// 	$fechaP[]=$fr["fecha_programada"];
															
														// }
														// $imp=array_sum($implementado);
														// $acc=array_sum($acuerdo);
														// for ($i=0; $i < sizeof($acuerdo); $i++) { 
														// 	echo "<tr style='font-size: 0.6rem;'>";	
														// 	echo "<td  class='bg-theme'>".date("d-m-Y", strtotime($fechaP[$i]))."</td>";
														// 	echo "<td>".$acuerdo[$i]."</td>";
														// 	echo "<td>".$implementado[$i]."</td>";
														// 	echo "</tr>";
														// }
														// var_dump(sizeof($acuerdo));
														?>
													</tbody>
													<tfoot>
														<tr style="font-size: 0.6rem;" class="bg-theme">
															<th>TOTAL</th>
															<th><?php echo $total; ?></th>
															<th><?php echo $totali; ?></th>
														</tr>
													</tfoot>
												</table>
											</div>
											<div class="col-md-4">
												<div class="card" style="margin-bottom: 1.1rem;">
													<div class="card-body" style="padding:0.7rem;">
														<div class="col-sm-12 col-xs-6">
															<div class="text-uppercase  font-xs text-theme">IMPLEMENTACIONES</div>
														</div>
														<div class="row text-center">
															<div class="col-sm-12 col-xs-6" style="padding-top:0.5rem;">	
																<span id="dona3" class="donut" data-peity='{ "fill": ["<?php if(isset($empresa)){ echo $empresa["color_grafico_1"]; } else { echo "#E64A19"; }?>", "#D3CDCD"]}'><?php echo $timp; ?>/<?php echo $tac; ?></span>	
								                            </div>
								                            <div class="col-sm-12 col-xs-6" style="padding-top:0;">
								                            	<small class="text-theme">MAT: <?php echo $timp; ?></small> 
								                            </div>
														</div>														
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="card" style="margin-bottom: 1.1rem;">
													<div class="card-body" style="padding:0.7rem;">
														<div class="col-sm-12 col-xs-6">
															<div class="text-uppercase  font-xs text-theme">CUMPLIMIENTO %</div>
														</div>
														<div class="row text-center">
															<div class="col-sm-12 col-xs-6" style="padding-top:0.5rem;">
																<span id="dona4" class="donut" data-peity='{ "fill": ["<?php if(isset($empresa)){ echo $empresa["color_grafico_1"]; } else { echo "#E64A19"; }?>", "#D3CDCD"]}'><?php echo $timp; ?>/<?php echo $tac; ?></span>
															</div>
															<div class="col-sm-12 col-xs-6" style="padding-top:0;">
																<small class="text-theme">MAT: <?php echo round(($timp/$tac)*100,2); ?>%</small>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="card">
													<div class="card-body" style="padding:0.6rem;">
														<div class="text-center">
															<canvas id="chart3" height="58"></canvas>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane" id="tres" style="height: 100%;">
								<div class="row card-body" style="padding:0.8rem;">
									<div class="col-md-2">
										<div class="row">
											<div class="col-md-6 padr0">
												<div class="text-center">
													<div class="card border-primary mb-3 text-center">
														<div class="card-body" style="padding:0.7rem;">
															<div class="text-muted text-uppercase font-xs" >PDV VISITADOS</div>
															<div class="h4 text-theme mb-0 font-weight-bold"><?php echo $totalv; ?></div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-6 padl6 padr0">
												<div class="text-center">
													<div class="card border-primary mb-3 text-center">
														<div class="card-body" style="padding:0.7rem;">
															<div class="text-muted text-uppercase font-xs" >PDV A VISITAR</div>
															<div class="h4 text-theme mb-0 font-weight-bold"><?php echo count($cc); ?></div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-12 padr0">
												<div class="card border-primary mb-3">
													<div class="card-body">
														<select style="width: 100%;" class="form-control" id="lbl_motivo_i" name="lbl_motivo_i" onchange="buscar();">
															<option value="">Motivo</option>
															<?php 
															foreach($motivos as $mo){ ?>
																<option value="<?php echo $mo["ID_Motivo"] ?>"><?php echo $mo["motivo"]; ?></option>
															<?php } ?>
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-10 padl0  padr0">
										<table class="table color-bordered-table primary-bordered-table order-column" id="t4" width="100%">
											<thead>
												<tr style="font-size: 0.6rem;">
													<th>SUCURSAL</th>
													<th>REGIÓN</th>
													<th>CIUDAD</th>
													<th>DIRECCIÓN</th>
													<th>FECHA<br>PROGRAMADA</th>
													<th>FECHA<br>IMPLEMENTACIÓN</th>
													<th>IMPLEMENTADOR</th>										
													<th>AC</th>
													<th>IMP</th>
													<th>%</th>
													<th>MOTIVO</th>
													<th>REVISAR<br>IMPLEMENTACIÓN</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$tsv=0;
												$tv=0;
													foreach($cc as $c){
														echo "<tr style='font-size:0.6rem;'>";
														echo "<td >".$c["id_cliente"]."</td>";
														echo "<td>".$c["region"]."</td>";
														echo "<td>".$c["ciudad"]."</td>";
														echo "<td>".$c["direccion"]."</td>";
														// echo "<td>55555555</td>";
														echo "<td>".date("d-m-Y",strtotime($c["fecha_programada"]))."</td>";
														if(is_null($c["fecha_real"])){
															$fecha="";
														} else {
															$fecha=date("d-m-Y",strtotime($c["fecha_real"]));
														}
														echo "<td>".$fecha."</td>";
														echo "<td>".str_replace(" ","<br>",$c["implementador"])."</td>";
														echo "<td>".$c["acuerdo"]."</td>";
														$tsv+=$c["acuerdo"];
														echo "<td>".$c["imp"]."</td>";
														$tv+=$c["imp"];
														if($c["imp"]==0){
															echo "<td>0%</td>";
														} else {
															echo "<td>".round((($c["imp"]/$c["acuerdo"])*100))."%</td>";
														}	
														echo "<td>".$c["id_motivo"]."</td>";
														echo "<td><button class='btn btn-theme btn-sm' onclick=\"window.open('".base_url("informes/detalle/".base64_encode($c["id_unico"]))."', 'popup', 'width=screen.width,height=screen.height'); return false;\"><i class='fa fa-info'></i></button></td>";									
														echo "</tr>";
													}
												?>
											</tbody>
											<tfoot>
												<tr style="font-size: 0.6rem;" class="bg-theme">
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
				</div>
			
			</div>
		</main>
	</div>
</body>
<script type="text/javascript">


	var imp1;
	var cum1;
	var imp2;
	var cum2;

	$(document).ready(function() {


	    var t1= $('#t1').DataTable( {
	        scrollY: "90px",
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
				//filtroinfo();
			}
		});

		var t12= $('#t5').DataTable( {
	        scrollY: "90px",
	        scrollX: true,
	        scrollCollapse: true,
	        paging: false,
	        searching: false,
	        ordering: false,
	        info: false,
	        autoWidth:false,
	        fixedHeader: true
	    } );

		$('#t5 tbody').on('click','tr',function(){
			if($(this).hasClass('selected')){
				$(this).removeClass('selected');
			} else {
				t12.$('tr.selected').removeClass('selected');
				$(this).addClass('selected');
				//filtroinfo();
			}
		});


		var t11= $('#t2').DataTable( {
	        scrollY: "220px",
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
	        scrollY: "220px",
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
	        scrollY: "310px",
	        scrollX: true,
	        scrollCollapse: true,
	        paging: false,
	        searching: false,
	        ordering: false,
	        info: false,
	        autoWidth:false,
	        fixedHeader: true
	    } );

	    $('#t4 tbody').on('click','tr',function(){
	    	if($(this).hasClass('selected')){
				$(this).removeClass('selected');
				$(this).find('td:last').find("button").removeClass('btn-outline-theme').addClass("btn-theme");
			} else {
				t21.$('tr.selected').find('td:last').find("button").removeClass('btn-outline-theme').addClass("btn-theme");
				t21.$('tr.selected').removeClass('selected');
				$(this).find('td:last').find("button").removeClass('btn-theme').addClass("btn-outline-theme");
				$(this).addClass('selected');
				// filtroinfo();

			}	
		});
	    
		$(".dataTables_scrollHeadInner table").attr('style','margin-left: 0px;');

	    $(".dataTables_scrollHeadInner").attr('style','box-sizing: content-box; padding-right: 0px;');

	    $(".dataTables_scrollFootInner table").attr('style','margin-left: 0px;');

	    $(".dataTables_scrollFootInner").attr('style','padding-right: 0px;');
	    

	} );

	var ctx = document.getElementById("chart2").getContext('2d');
	var myChart1 = new Chart(ctx, {
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
				backgroundColor: "<?php if(isset($empresa)){ echo $empresa["color_grafico_1"]; } else { echo "#FE642E"; }?>"
			},{
				label: 'VISITADO',
				data: [<?php for ($i=0; $i < count($cc); $i++) { 
					if(isset(array_unique($suma_regionvs)[$i])){
						$c=explode("/",array_unique($suma_regionvs)[$i]);
						echo "".$c[1].",";
					}				
				} ?>],
				backgroundColor: "<?php if(isset($empresa)){ echo $empresa["color_grafico_2"]; } else { echo "#F5BCA9"; }?>"
			}]
		}
	});

	var ctx = document.getElementById("chart3").getContext('2d');
	var myChart2 = new Chart(ctx, {
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
					if(isset(array_unique($suma_regionesm)[$i])){
						$c=explode("/",array_unique($suma_regionesm)[$i]);
						echo "".$c[1].",";
					}				
				} ?>],
				backgroundColor: "<?php if(isset($empresa)){ echo $empresa["color_grafico_1"]; } else { echo "#FE642E"; }?>"
			},{
				label: 'IMPLEMENTADO',
				data: [<?php for ($i=0; $i < count($cc); $i++) { 
					if(isset(array_unique($suma_regionvsm)[$i])){
						$c=explode("/",array_unique($suma_regionvsm)[$i]);
						echo "".$c[1].",";
					}				
				} ?>],
				backgroundColor: "<?php if(isset($empresa)){ echo $empresa["color_grafico_2"]; } else { echo "#F5BCA9"; }?>"
			}]
		}
	});

	imp1=$("#dona1").peity("donut", {
	    width: 80,
	    height: 80
	});

	cum1=$("#dona2").peity("donut", {
	    width: 80,
	    height: 80
	});

	imp2=$("#dona3").peity("donut", {
	    width: 80,
	    height: 80
	});

	cum2=$("#dona4").peity("donut", {
	    width: 80,
	    height: 80
	});


	

	$('#lbl_sucursal_i').select2();

	$('#lbl_ciudad_i').select2();

	$('#lbl_region_i').select2();

	$('#lbl_implementador_i').select2();

	$('#lbl_motivo_i').select2();

	function clearinfo(){
		$("#lbl_region_i").val('').trigger('change');
		$("#lbl_sucursal_i").val('').trigger('change');
		$("#lbl_ciudad_i").val('').trigger('change');
		$("#lbl_implementador_i").val('').trigger('change');
		$("#lbl_motivo_i").val('').trigger('change');
		buscar();
	}

	function buscar(){
		var region="0";
		var sucursal="0";
		var ciudad="0";
		var implementador="0";
		var motivo="0";
		
		if($("#lbl_motivo_i").val()==""){
			motivo="0";
		} else {
			motivo=$("#lbl_motivo_i").val();
		}
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
		if($("#lbl_implementador_i").val()==""){
			implementador="0";
		} else {
			implementador=$("#lbl_implementador_i").val();
		}

		var data = "region="+region+"&ciudad="+ciudad+"&sucursal="+sucursal+"&imp="+implementador+"&motivo="+motivo;
		$.ajax({
			url:"http://masterplan.grupoprogestion.com/masterplan/informes/filtro",
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
				var mot="";
				var sumv=0;

				var c=new Array();
				var s=new Array();
				var ra=new Array();
				var ri=new Array();
				var ram=new Array();
				var rim=new Array();
				for(i in data.cc){					
					c[i]=data.cc[i].ciudad;
					s[i]=data.cc[i].id_cliente;
					if(data.cc[i].fecha_real!==null){
						sumv+=parseInt(1);
					}
					var snv=0;
					var sv=0;
					var mnv=0;
					var mv=0;
					for(j in data.cc){
						if(data.cc[i].region==data.cc[j].region){
							if(data.cc[j].fecha_real!==null){
								sv+=parseInt(1);
								mv+=parseInt(data.cc[j].imp);
							}
							snv+=parseInt(1);
							mnv+=parseInt(data.cc[j].acuerdo);
						}
					}
					ra[i]=data.cc[i].region+"/"+snv;
					ri[i]=data.cc[i].region+"/"+sv;
					ram[i]=data.cc[i].region+"/"+mnv;
					rim[i]=data.cc[i].region+"/"+mv;
				}

				var filteredR = c.filter(function(item, pos){
					return c.indexOf(item)== pos; 
				});
				var filteredRA = s.filter(function(item, pos){
					return s.indexOf(item)== pos; 
				});
				var filteredSNV = ra.filter(function(item, pos){
					return ra.indexOf(item)== pos; 
				});
				var filteredSV = ri.filter(function(item, pos){
					return ri.indexOf(item)== pos; 
				});
				var filteredMNV = ram.filter(function(item, pos){
					return ram.indexOf(item)== pos; 
				});
				var filteredMV = rim.filter(function(item, pos){
					return rim.indexOf(item)== pos; 
				});
				// myChart1.data.datasets.pop();
				// myChart1.data.datasets.pop();
				// myChart1.data.labels.pop();
				// myChart1.update();

				// for (var i = 0; i < filteredSNV.length; i++) {
				// 	var d=filteredSNV[i].split("/");
				// 	var dm=filteredSV[i].split("/");
				// }
				// myChart1.data.labels.push(JSON.stringify(lab));
				// myChart1.data.datasets.push();
				// myChart1.data.datasets.push();
				// myChart1.update();
				// myChart2.data.datasets.pop();
				// myChart2.data.datasets.pop();
				// myChart2.data.labels.pop();
				// myChart2.update();
				// for (var i = 0; i < filteredMNV.length; i++) {
				// 	var d=filteredMNV[i].split("/");
				// 	var dm=filteredMV[i].split("/");
				// 	myChart2.data.labels.push(d[0]);
				// 	myChart2.data.datasets[0].data.push(d[1]);
				// 	myChart2.data.datasets[1].data.push(dm[1]);
				// 	myChart2.update();
				// }
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
					if(region!="0" || sucursal!="0" || ciudad!="0" || implementador!="0" || motivo!="0"){
						if(data.cc[i].fecha_real!==null){
							suc+="<tr style='font-size: 0.65rem;'  role='row' class='odd'>";
							suc+="<td>"+data.cc[i].id_cliente+" - "+data.cc[i].nombre_fantasia+"</td>";
							suc+="<td>"+data.cc[i].region+"</td>";
							suc+="<td>"+data.cc[i].ciudad+"</td>";
							suc+="<td>"+data.cc[i].direccion+"</td>";
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
							if (data.cc[i].implementador==null) {
								suc+="<td> </td>";
							} else {
								suc+="<td>"+data.cc[i].implementador+"</td>";
							}
							suc+="<td>"+data.cc[i].acuerdo+"</td>";
							acsuc+=parseInt(data.cc[i].acuerdo);
							suc+="<td>"+data.cc[i].imp+"</td>";
							impsuc+=parseInt(data.cc[i].imp);
							por=isNaN(((data.cc[i].imp/data.cc[i].acuerdo)*100)) ? 0 : Math.round(((data.cc[i].imp/data.cc[i].acuerdo)*100));
							suc+="<td>"+por+"%</td>";
							suc+="<td>"+data.cc[i].id_motivo+"</td>";
							suc+="<td><button class='btn btn-theme btn-sm' onclick='window.open(\"<?php echo base_url("informes/detalle/"); ?>"+btoa(data.cc[i].id_unico)+"\",\"popup\",\"width=screen.width,height=screen.height\"); return false;'><i class='fa fa-info'></i></button></td>";			
							suc+="</tr>";
						} 
					} else {
						suc+="<tr style='font-size: 0.65rem;'  role='row' class='odd'>";
						suc+="<td>"+data.cc[i].id_cliente+" - "+data.cc[i].nombre_fantasia+"</td>";
						suc+="<td>"+data.cc[i].region+"</td>";
						suc+="<td>"+data.cc[i].ciudad+"</td>";
						suc+="<td>"+data.cc[i].direccion+"</td>";
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
						if (data.cc[i].implementador==null) {
							suc+="<td> </td>";
						} else {
							suc+="<td>"+data.cc[i].implementador+"</td>";
						}
						suc+="<td>"+data.cc[i].acuerdo+"</td>";
						acsuc+=parseInt(data.cc[i].acuerdo);
						suc+="<td>"+data.cc[i].imp+"</td>";
						impsuc+=parseInt(data.cc[i].imp);
						por=isNaN(((data.cc[i].imp/data.cc[i].acuerdo)*100)) ? 0 : Math.round(((data.cc[i].imp/data.cc[i].acuerdo)*100));
						suc+="<td>"+por+"%</td>";
						suc+="<td>"+data.cc[i].id_motivo+"</td>";
						suc+="<td><button class='btn btn-theme btn-sm' onclick='window.open(\"<?php echo base_url("informes/detalle/"); ?>"+btoa(data.cc[i].id_unico)+"\",\"popup\",\"width=screen.width,height=screen.height\"); return false;'><i class='fa fa-info'></i></button></td>";			
						suc+="</tr>";
					}
				}
				$("#t4 tbody").html(suc);
				$("#t4_wrapper .dataTables_scrollFoot tfoot tr").each(function(){
					$(this).find("th").eq(7).html(acsuc);
					$(this).find("th").eq(8).html(impsuc);
					var por=isNaN(((impsuc/acsuc)*100)) ? 0 : Math.round(((impsuc/acsuc)*100));
					$(this).find("th").eq(9).html(por+"%");
				});
				imp1.text(sumv+"/"+data.cc.length).change();
				$("#dona1").parent().parent().find("small").html("PDV: "+sumv);
				var p=isNaN(((sumv/data.cc.length)*100)) ? 0 : Math.round(((sumv/data.cc.length)*100));
				cum1.text(sumv+"/"+data.cc.length).change();
				$("#dona2").parent().parent().find("small").html("PDV: "+p+"%");
				imp2.text(impsuc+"/"+acsuc).change();
				$("#dona3").parent().parent().find("small").html("MAT: "+impsuc);
				var p=isNaN(((impsuc/acsuc)*100)) ? 0 : Math.round(((impsuc/acsuc)*100));
				cum2.text(impsuc+"/"+acsuc).change();
				$("#dona4").parent().parent().find("small").html("MAT: "+p+"%");
			}
		});
	}


   
</script>
