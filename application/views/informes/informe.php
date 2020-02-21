<?php
	if($empresa[0]["activar_colores"]==1){ 
		$principal=$empresa[0]["color_principal"]; 
		$dashboard1=$empresa[0]["color_grafico_1"];
		$dashboard2=$empresa[0]["color_grafico_2"];
	} else { 
		$principal="#f57c00"; 
		$dashboard1="#E64A19";
		$dashboard2="#F5BCA9";
	}

?>
<body class="app sidebar-fixed aside-menu-off-canvas aside-menu-hidden header-fixed  pace-done">
	<div class="app-body">
		<main class="main" >
			<div class="container-fluid" >
				<div class="animated fadeIn">
				<?php if(isset($cc[0]["campana"])){ ?>
					<div class="row">
						<div class="col-md-12">
							<ul class="nav nav-tabs custom-tab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="tab" role="tab" href="#uno">SUCURSALES VISITADAS</a>
								</li>
								<li class="nav-item">
									<a class="nav-link "  data-toggle="tab" role="tab" href="#dos">MATERIALES IMPLEMENTADOS</a>
								</li>
								<li class="nav-item ">
									<a class="nav-link"  data-toggle="tab" role="tab" href="#tres">DETALLE IMPLEMENTACIÓN</a>
								</li>
								<li class="nav-item">
									<button onclick="buscar();" class="nav-link btn btn-sm btn-theme"><i class="fa fa-search"></i></button>
								</li>
								<li class="nav-item">
									<button onclick="clearinfo();" class="nav-link btn btn-sm btn-theme"><i class="fa fa-refresh"></i></button>
								</li>
								<li class="nav-item">
									<a href="<?php echo base_url("informes/excelcam/".base64_encode($cc[0]["id_campana"])); ?>" class="nav-link btn btn-sm btn-theme"><i class="fa fa-download"></i></a>
								</li>
							</ul>
							<div class="row card-body" style="padding-bottom: 0px; padding-left: 0.2rem;">
								<div class="col-md-3">
									<div class="card" >
										<div class="ecom-widget-chart-full">
											<div class="chart-full-header">
												<div class="header-text">
													<div class="heading"><?php echo strtoupper($cc[0]["campana"]);?></div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row col-md-9">
								<?php
									foreach($empresa as $e) { 
										echo $e["filtro"];
									}
								?>
								</div>								
							</div>
							<div class="tab-content" >
								<div class="tab-pane active" id="uno" >
									<div class="row">
										<div class="col-md-3">
											<div class="row">
												<div class="col-md-9">
													<div class="text-center">
														<div class="card border-primary mb-3 text-center">
															<div class="card-body" >
																<div class="text-muted text-uppercase font-xs">PDV IMPLEMENTADOS</div>
																<div class="h4 text-theme mb-0 font-weight-bold"><?php echo $cc[0]["pdv_imp"]; ?></div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-12">
													<div class="dataTables_scroll">
														<div class="dataTables_scrollHead">
															<div class="dataTables_scrollHeadInner">
																<table class="display table dataTable color-bordered-table primary-bordered-table">
																	<thead>
																		<tr>
																			<th>REGI&Oacute;N</th>
																			<th>PDV</th>
																			<th>VISITADO</th>
																			<th>%</th>
																		</tr>
																	</thead>
																</table>
															</div>
														</div>
														<div class="dataTables_scrollBody" style="max-height: 240px; ">
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
										</div>
										<div class="col-md-9">
											<div class="row">
												<div class="col-md-4">
													<div id="prog1" class="dataTables_scroll" style="margin-bottom: 1rem;">
														<div class="dataTables_scrollHead">
															<div class="dataTables_scrollHeadInner">
																<table class="display table dataTable color-bordered-table primary-bordered-table">
																	<thead>
																		<tr>
																			<th>D&Iacute;A</th>
																			<th>PROGRAMADO</th>
																			<th>VISITADO</th>
																		</tr>
																	</thead>
																</table>
															</div>
														</div>
														<div class="dataTables_scrollBody" style="max-height: 100px; ">
															<table class="display table dataTable color-bordered-table primary-bordered-table">
																<tbody>
																	<?php
																		$tsv=0;
																		$tv=0;
																		foreach($cf as $c){
																			echo "<tr>";
																			echo "<td class='bg-theme'>".date("d-m-Y",strtotime($c["fecha"]))."</td>";
																			echo "<td>".$c["programado"]."</td>";
																			$tsv+=$c["programado"];
																			echo "<td>".$c["visitado"]."</td>";
																			$tv+=$c["visitado"];
																			echo "</tr>";
																		}
																	?>
																</tbody>
															</table>
														</div>
														<div class="dataTables_scrollFoot" >
															<div class="dataTables_scrollFootInner">
																<table class="display table dataTable color-bordered-table primary-bordered-table" style="width: 100%;">
																	<tfoot>
																		<tr class="bg-theme">
																			<th>TOTAL</th>
																			<th><?php echo $tsv;  ?></th>
																			<th><?php echo $tv;  ?></th>
																		</tr>
																	</tfoot>
																</table>
															</div>
														</div>
													</div>
												</div>
											 	<div class="col-md-4">
											 		<div class="card">
											 			<div class="card-body">
											 				<div class="col-sm-12 col-xs-6  padl0">
																<div class="text-uppercase  font-xs text-theme">IMPLEMENTACIONES</div>
															</div>
															<div  class="row text-center">
																<div class="col-sm-12 col-xs-6">	
																	<span id="dona1" class="donut" data-peity='{ "fill": ["<?php echo $dashboard1;?>", "#D3CDCD"]}'><?php echo $cim[0]["visitado"]; ?>/<?php echo $cim[0]["pdv"]; ?></span>	
									                            </div>
									                            <div class="col-sm-12 col-xs-6" >
									                            	<small class="text-theme">PDV: <?php echo $cim[0]["visitado"]; ?></small> 
									                            </div>
															</div>	
											 			</div>
											 		</div>
											 	</div>
											 	<div class="col-md-4">
													<div class="card" >
														<div class="card-body" >
															<div class="col-sm-12 col-xs-6  padl0">
																<div class="text-uppercase  font-xs text-theme">CUMPLIMIENTO %</div>
															</div>
															<div  class="row text-center">
																<div class="col-sm-12 col-xs-6" >
																	<span id="dona2" class="donut" data-peity='{ "fill": ["<?php echo $dashboard1;?>", "#D3CDCD"]}'><?php echo $cim[0]["visitado"]; ?>/<?php echo $cim[0]["pdv"]; ?></span>
																</div>
																<div class="col-sm-12 col-xs-6" >
																	<small class="text-theme">PDV: <?php if ($cim[0]["visitado"]==0) { echo "0"; } else {echo round(($cim[0]["visitado"]/$cim[0]["pdv"])*100,2);} ?>%</small>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="card">
														<div class="card-body" style="padding:0.8rem;">
															<div class="text-center">
																<canvas id="chart2" height="60"></canvas>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="dos" >
									<div class="row">
										<div class="col-md-3">
											<div class="row">
												<div class="col-md-9">
													<div class="text-center">
														<div class="card border-primary mb-3 text-center">
															<div class="card-body" >
																<div class="text-muted text-uppercase font-xs">MATERIALES IMPLEMENTADOS</div>
																<div class="h4 text-theme mb-0 font-weight-bold"><?php echo $cc[0]["imp_total"]; ?></div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-12">
													<div class="dataTables_scroll">
														<div class="dataTables_scrollHead">
															<div class="dataTables_scrollHeadInner">
																<table class="display table dataTable color-bordered-table primary-bordered-table">
																	<thead>
																		<tr>
																			<th>REGI&Oacute;N</th>
																			<th>TOTAL MAT</th>
																			<th>IMP</th>
																			<th>% MAT</th>
																		</tr>
																	</thead>
																</table>
															</div>
														</div>
														<div class="dataTables_scrollBody" style="max-height: 240px; ">
															<table class="display table dataTable color-bordered-table primary-bordered-table">
																<tbody>
																	<?php
																	$tsv=0;
																	$tv=0;
																	for($i=0;$i<count($cc);$i++){
																		echo "<tr  >";
																		echo "<td >".$cc[$i]["region"]." </td>";
																		echo "<td >".$cc[$i]["acuerdo"]." </td>";
																		$tsv+=$cc[$i]["acuerdo"];
																		echo "<td >".$cc[$i]["imp"]." </td>";
																		$tv+=$cc[$i]["imp"];
																		if($cc[$i]["imp"]!=0 && !is_null($cc[$i]["imp"])){
																			echo "<td >".round((($cc[$i]["imp"]/$cc[$i]["acuerdo"])*100),2)."%</td>";
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
										<div class="col-md-9">
											<div class="row">
												<div class="col-md-4">
													<div id="prog2" class="dataTables_scroll" style="margin-bottom: 1rem;">
														<div class="dataTables_scrollHead">
															<div class="dataTables_scrollHeadInner">
																<table class="display table dataTable color-bordered-table primary-bordered-table">
																	<thead>
																		<tr>
																			<th>D&Iacute;A</th>
																			<th>PROGRAMADO</th>
																			<th>VISITADO</th>
																		</tr>
																	</thead>
																</table>
															</div>
														</div>
														<div class="dataTables_scrollBody" style="max-height: 100px; ">
															<table class="display table dataTable color-bordered-table primary-bordered-table">
																<tbody>
																	<?php
																		$tsv=0;
																		$tv=0;
																		foreach($cf as $c){
																			echo "<tr>";
																			echo "<td class='bg-theme'>".date("d-m-Y",strtotime($c["fecha"]))."</td>";
																			echo "<td>".$c["acuerdo"]."</td>";
																			$tsv+=$c["acuerdo"];
																			echo "<td>".$c["implementado"]."</td>";
																			$tv+=$c["implementado"];
																			echo "</tr>";
																		}
																	?>
																</tbody>
															</table>
														</div>
														<div class="dataTables_scrollFoot" >
															<div class="dataTables_scrollFootInner">
																<table class="display table dataTable color-bordered-table primary-bordered-table" style="width: 100%;">
																	<tfoot>
																		<tr class="bg-theme">
																			<th>TOTAL</th>
																			<th><?php echo $tsv;  ?></th>
																			<th><?php echo $tv;  ?></th>
																		</tr>
																	</tfoot>
																</table>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="card" >
														<div class="card-body" >
															<div class="col-sm-12 col-xs-6  padl0">
																<div class="text-uppercase  font-xs text-theme">IMPLEMENTACIONES</div>
															</div>
															<div class="row text-center">
																<div class="col-sm-12 col-xs-6" >	
																	<span id="dona3" class="donut" data-peity='{ "fill": ["<?php echo $dashboard1;?>", "#D3CDCD"]}'><?php echo $cim[0]["mat_imp"]; ?>/<?php echo $cim[0]["mat_ac"]; ?></span>	
									                            </div>
									                            <div class="col-sm-12 col-xs-6" >
									                            	<small class="text-theme">MAT: <?php echo $cim[0]["mat_imp"]; ?></small> 
									                            </div>
															</div>														
														</div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="card" >
														<div class="card-body" >
															<div class="col-sm-12 col-xs-6  padl0">
																<div class="text-uppercase  font-xs text-theme">CUMPLIMIENTO %</div>
															</div>
															<div class="row text-center">
																<div class="col-sm-12 col-xs-6" >
																	<span id="dona4" class="donut" data-peity='{ "fill": ["<?php echo $dashboard1;?>", "#D3CDCD"]}'><?php echo $cim[0]["mat_imp"]; ?>/<?php echo $cim[0]["mat_ac"]; ?></span>
																</div>
																<div class="col-sm-12 col-xs-6" >
																	<small class="text-theme">MAT: <?php if($cim[0]["mat_imp"]==0){ echo "0"; } else {echo round(($cim[0]["mat_imp"]/$cim[0]["mat_ac"])*100,2);} ?>%</small>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="card">
														<div class="card-body" style="padding:0.8rem;">
															<div class="text-center">
																<canvas id="chart3" height="60"></canvas>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="tres">
									<div class="row">
										<div class="col-md-2">
											<div class="row">
												<div class="col-md-6  padr0">
													<div class="text-center">
														<div class="card border-primary mb-3 text-center">
															<div class="card-body">
																<div class="text-muted text-uppercase font-xs" >PDV VISITADOS</div>
																<div class="h4 text-theme mb-0 font-weight-bold"><?php echo $cc[0]["pdv_imp"]; ?></div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-6  padr0">
													<div class="text-center">
														<div class="card border-primary mb-3 text-center">
															<div class="card-body">
																<div class="text-muted text-uppercase font-xs" >PDV A VISITAR</div>
																<div class="h4 text-theme mb-0 font-weight-bold"><?php echo $cc[0]["pdv_total"]; ?></div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-12 padr0">
													<div class="card border-primary mb-3">
														<div class="card-body">
															<select style="width: 100%;" class="form-control" id="lbl_motivo_i"  >
																<option value="">Motivo</option>
															</select>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-10 padr0">
											<div class="dataTables_scroll" id="detalle">
												<div class="dataTables_scrollHead">
													<div class="dataTables_scrollHeadInner">
														<table class="display table dataTable color-bordered-table primary-bordered-table" >
															<thead>
																<tr >
																	<th>PDV</th>
																	<th>REGI&Oacute;N</th>
																	<th>CIUDAD</th>
																	<th>DIRECCI&Oacute;N</th>
																	<th>FECHA<br>PROGRAMADA</th>
																	<th>FECHA<br>IMPLEMENTACI&Oacute;N</th>
																	<th>IMPLEMENTADOR</th>							
																	<th>AC</th>
																	<th>IMP</th>
																	<th>%</th>
																	<th>MOTIVO</th>
																	<th>REVISAR<br>IMPLEMENTACI&Oacute;N</th>
																</tr>
															</thead>
														</table>
													</div>
												</div>
												<div class="dataTables_scrollBody" style="max-height: 290px; ">
													<table class="display table dataTable color-bordered-table primary-bordered-table" style="width: 100%;">
														<tbody>
															<?php
																$tsuv=0;
																$tvu=0;
																foreach ($cim as $c) {
																echo "<tr>";
																echo "<td>".$c["id_cliente"]."</td>";
																echo "<td>".$c["region"]."</td>";
																echo "<td>".$c["ciudad"]."</td>";
																echo" <td>".$c["direccion"]."</td>";
																echo" <td>".date("d-m-Y",strtotime($c["fecha_programada"]))."</td>";
																if(is_null($c["fecha_real"])){
																	$fecha="";
																} else {
																	$fecha=date("d-m-Y",strtotime($c["fecha_real"]));
																}
																echo "<td>".$fecha."</td>";
																echo "<td>".$c["implementador"]."</td>";
																echo "<td>".$c["acuerdo"]."</td>";
																$tsuv+=$c["acuerdo"];
																echo "<td>".$c["imp"]."</td>";
																$tvu+=$c["imp"];
																if($c["imp"]==0){
																	echo "<td>0%</td>";
																} else {
																	echo "<td>".round((($c["imp"]/$c["acuerdo"])*100),2)."%</td>";
																}
																echo "<td>".$c["motivo"]."</td>
																	 <td><button class='btn btn-theme btn-sm' onclick=\"window.open('".base_url("informes/detalle/".base64_encode($c["id_unico"]))."', 'popup', 'width=screen.width,height=screen.height'); return false;\"><i class='fa fa-info'></i></button></td>
																	</tr>";
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
																	<th></th>
																	<th></th>
																	<th></th>
																	<th></th>
																	<th></th>
																	<th></th>										
																	<th ><?php echo $tsuv; ?></th>
																	<th ><?php echo $tvu; ?></th>
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
										<div class="col-md-12">
											<div class="float-right card-body" >
												<div class="row">
													<?php	if(isset($opcion) && count($cc)>0){                
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
									                <input type="hidden" name="opcion" id="opcion" value="<?php echo $opcion; ?>">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } else { ?>
					<div class="row">
						<div class="row card-body" >
							<div class="col-md-12">
								<h3  class="text-theme" >Esta campaña no tiene locales asignados. Favor comunicarse con el coordinador designado.</h3>
							</div>
						</div>
					</div>
				<?php } ?>
				</div>
			</div>
		</main>
	</div>
</body>
<script src="<?php echo base_url("assets/js/libs/charts-peity/jquery.peity.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/libs/chart.js/dist/Chart.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo  site_url(); ?>assets/js/moment.min.js"></script>
<script src="<?php echo base_url("assets/js/moment-with-locales.min.js")?>"></script>
<script type="text/javascript" src="<?php echo  site_url(); ?>assets/js/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo  site_url(); ?>assets/css/daterangepicker.css" />
<style type="text/css">


 	.table th, .table td{
 		padding:0.5rem;
 		text-align: center;
 		font-size: 0.5rem;
		white-space: pre-wrap;
		word-wrap: break-word;
		max-width: 3.5rem;
 		width: 3.5rem;
 		vertical-align: middle;
 	}

 	table.dataTable {
 		border-collapse: collapse !important;
 		margin-bottom: 0px;
 	}

	.border-primary {
	    border-color: <?php echo $principal; ?> !important;
	}

	.select2-container--default .select2-results__option--highlighted[aria-selected] {
    	background-color:  <?php echo $principal;?>;
    }

	.padr0{
		padding-right: 2px !important;
	}

	.padl0{
		padding-left: 2px !important;
	}

	.nav-link{
		font-size: 0.8rem;
	}

	.card-body{
		padding:0.7rem;
	}

	.card{
		margin-bottom: 0.5rem;
	}

	.custom-tab .nav-link.active{
 		border-bottom: 5px solid <?php echo $principal; ?>;
 		font-weight: 600;
 	}

 	.custom-tab .nav-link{
 		font-weight: 600;
 	}

 	.custom-tab{
 		background-color: transparent;
 		width: 100%;
 	}

 	.tab-pane{
 		height: 100%;
 	}

 	.main {
		margin-left: 0px !important;
		<?php if($empresa[0]["activar_fondo"]==1){ 
			echo "background-size: 100% 100%;
	    		background-repeat: no-repeat; 
	    		background-image: url(".base_url("archivos/fondos/").$empresa["imagen_fondo"].");";
		}?>
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

	.ecom-widget-chart-full .chart-full-header .heading {
 		font-size: 0.85rem !important;
 	}

 	.ecom-widget-chart-full .chart-full-header{
 		padding:7px 30px !important;
 	}

 	.ecom-widget-chart-full{
 		margin-top: 0 !important;
 		background-color: <?php echo $principal; ?>;
 	}

 	.form-control{
 		font-size: 0.7rem !important;
 	}

 	.dataTables_scrollBody{
		position: relative;
	    overflow: auto;
	    max-height: 200px;
	    width: 100%;
	}

	ul{
		margin-bottom: 0.3rem;
	}

	.tab-content .tab-pane {
	    padding: 0.4rem;
	}

	.page-link {
		cursor: pointer;
	}

	.font-xs{
		font-size: 0.7rem !important;
	}

	.btn-theme {
	    -webkit-box-shadow: 0px 5px 25px -3px <?php echo $principal;?>;
	    -moz-box-shadow: 0px 5px 25px -3px <?php echo $principal;?>;
	    box-shadow: 0px 5px 25px -3px <?php echo $principal;?>;
	    background: <?php echo $principal;?>;
	}

	.btn-outline-theme {
	    -webkit-box-shadow: 0px 5px 25px -3px <?php echo $principal;?>;
	    -moz-box-shadow: 0px 5px 25px -3px <?php echo $principal;?>;
	    box-shadow: 0px 5px 25px -3px <?php echo $principal;?>;
	    color: <?php echo $principal;?>;
	    background: #fff;
	    border: 1px solid <?php echo $principal;?>;
	}

	.btn-outline-theme:hover {
	    background: <?php echo $principal;?> !important;
	}

	.btn-theme:hover {
	    background: <?php echo $principal;?> !important;
	}

	.btn-sm, .btn-group-sm > .btn {
	    padding: 0.25rem 0.45rem;
	    font-size: 0.75rem;
	    line-height: 1.5;
	    color: white !important;
	    margin-top:0.4rem !important;
	    margin-left: 0.5rem !important;
	}

	.select {
		font-size: 0.7rem;
		max-height: 30px !important;
		min-height: 30px !important;
	}

	.select2-container--default .select2-selection--single{
		max-height: 30px !important;
		min-height: 30px !important;
		padding: 2px;
		font-size: 0.7rem!important;
	}

	.select2-results__options{
		font-size: 0.7rem!important;
	}

 	

</style>
<script type="text/javascript">

	$(document).ready(function() {
		if($(window).width()<991){
	        $("#chart2").attr('height','150');
	        $("#chart3").attr('height','150');
	    } else {
	       	$("#chart2").attr('height','60');
	       	$("#chart3").attr('height','60');
	    }

		var ctx = document.getElementById("chart2").getContext('2d');
		var myChart1 = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: [<?php for ($i=0; $i < count($cc); $i++) { 
					echo "'".$cc[$i]["region"]."',";			
				} ?>],
				datasets: [{
					label: 'PROGRAMADO',
					data: [<?php for ($i=0; $i < count($cc); $i++) { 
						echo "".$cc[$i]["pdv"].",";				
					} ?>],
					backgroundColor: "<?php echo $dashboard1;?>"
				},{
					label: 'VISITADO',
					data: [<?php for ($i=0; $i < count($cc); $i++) { 
						echo "".$cc[$i]["visitado"].",";				
					} ?>],
					backgroundColor: "<?php echo $dashboard2; ?>"
				}]
			}
		});

		var ctx = document.getElementById("chart3").getContext('2d');
		var myChart2 = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: [<?php for ($i=0; $i < count($cc); $i++) { 
					echo "'".$cc[$i]["region"]."',";			
				} ?>],
				datasets: [{
					label: 'PROGRAMADO',
					data: [<?php for ($i=0; $i < count($cc); $i++) { 
						echo "".$cc[$i]["acuerdo"].",";				
					} ?>],
					backgroundColor: "<?php echo $dashboard1;?>"
				},{
					label: 'IMPLEMENTADO',
					data: [<?php for ($i=0; $i < count($cc); $i++) { 
						echo "".$cc[$i]["imp"].",";				
					} ?>],
					backgroundColor: "<?php echo $dashboard2; ?>"
				}]
			}
		});


		$.ajax({
			url:"<?php echo base_url("informes/motivos"); ?>",
			type:'POST',
			dataType:'json'
		}).done(function(respuesta){          
			$(respuesta).each(function(i, v){ // indice, valor
                $("#lbl_motivo_i").append('<option value="' + v.ID_Motivo + '">' + v.motivo + '</option>');
            })
			$("#lbl_motivo_i").select2();
			
		});


		<?php
			
		$ajax_data="";
		foreach($empresa as $d) { 
			$ajax_data.=$d["ajax_filtro"];
				
		}

			foreach($empresa as $e) { 
			   if($e["url_filtro"]==''){
			   	echo '$("#'.$e["nombre_filtro"].'").daterangepicker({
						"singleDatePicker": true,
						"applyButtonClasses": "btn-warning",
						"autoUpdateInput": false,
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
					}, function(chosen_date){
						$("#'.$e["nombre_filtro"].'").val(chosen_date.format("DD-MM-YYYY"));
					});
					';
			   } else {
			   		
			   		echo '$("#'.$e["nombre_filtro"].'").select2({
			   				ajax:{	
			   					'.$e["url_filtro"].'
					   			dataType:"json",
					   			type: "POST",
					   			data: function (term, page) {
									return "id_campana='.base64_decode($_SESSION["campana"]).'"'.$ajax_data.';
								},
								delay: 350,
								processResults: function (data) {
								return {
									results: $.map(data, function(obj) {
										'.$e["value_filtro"].'
									})
								};
							},
							cache: true
						}
			   		});';
			   }
			}
		?>


	    
	});


	var imp1;
	var cum1;
	var imp2;
	var cum2;

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

	

	$('select').select2();

	function clearinfo(){
		<?php
			foreach($empresa as $e) { 
				echo $e["clear_filtro"];
			}
		?>
		$("#lbl_motivo_i").val('').trigger('change');
		buscar();
	}

	function pagination(num){
		$("#opcion").val(num);
		buscar();
	}	

	function buscar(){
		<?php
			$data="";
			foreach($empresa as $e) { 
				echo $e["variable_filtro"];
				$data.=$e["data_filtro"];
			}
		?>

		var pagina=parseInt($("#opcion").val());
		var motivo="0";		
		if($("#lbl_motivo_i").val()==""){
			motivo="0";
		} else {
			motivo=$("#lbl_motivo_i").val();
		}

		$.ajax({
			url:"<?php echo base_url("informes/filtro"); ?>",
			data:"motivo="+motivo+"&opcion="+pagina<?php echo $data; ?>,
			dataType:"json",
			type:"POST",
			success: function(data){
				var prog1='';
				var prog2='';
				var pv=0;
				var psv=0;
				var mv=0;
				var msv=0;
				for(i in data.cf){
					prog1+='<tr>';
					prog1+='<td class="bg-theme">'+moment(data.cf[i].fecha).format('DD-MM-YYYY')+'</td>';
					prog1+='<td >'+data.cf[i].programado+'</td>';
					psv+=data.cf[i].programado;
					prog1+='<td >'+data.cf[i].visitado+'</td>';
					pv+=data.cf[i].visitado;
					prog1+='</tr>';
					prog2+='<tr>';
					prog2+='<td class="bg-theme">'+moment(data.cf[i].fecha).format('DD-MM-YYYY')+'</td>';
					prog2+='<td >'+data.cf[i].acuerdo+'</td>';
					msv+=data.cf[i].acuerdo;
					prog2+='<td >'+data.cf[i].implementado+'</td>';
					mv+=data.cf[i].implementado;
					prog2+='</tr>';
				}
				$("#prog1 table tbody").html(prog1);
				$("#prog2 table tbody").html(prog2);
				$("#prog1 table tfoot tr").html("<th>TOTAL</th><th>"+psv+"</th><th>"+pv+"</th>");
				$("#prog2 table tfoot tr").html("<th>TOTAL</th><th>"+msv+"</th><th>"+mv+"</th>");
				imp1.text(pv+"/"+psv).change();
				$("#dona1").parent().parent().find("small").html("PDV: "+pv);
				var p=isNaN(((pv/psv)*100)) ? 0 : Math.round(((pv/psv)*100));
				cum1.text(pv+"/"+psv).change();
				$("#dona2").parent().parent().find("small").html("PDV: "+p+"%");
				imp2.text(mv+"/"+msv).change();
				$("#dona3").parent().parent().find("small").html("MAT: "+msv);
				var p=isNaN(((mv/msv)*100)) ? 0 : Math.round(((mv/msv)*100));
				cum2.text(mv+"/"+msv).change();
				$("#dona4").parent().parent().find("small").html("MAT: "+p+"%");
				var detalle='';
				mv=0;
				msv=0;
				for(i in data.cim){
					detalle+='<tr>';
					detalle+='<td>'+data.cim[i].id_cliente+'</td>';
					detalle+='<td>'+data.cim[i].region+'</td>';
					detalle+='<td>'+data.cim[i].ciudad+'</td>';
					detalle+='<td>'+data.cim[i].direccion+'</td>';
					detalle+='<td>'+moment(data.cim[i].fecha_programada).format('DD-MM-YYYY')+'</td>';
					if(data.cim[i].fecha_real===null){
						detalle+='<td></td>';
					} else {
						detalle+='<td>'+moment(data.cim[i].fecha_real).format('DD-MM-YYYY')+'</td>';
					}
					if(data.cim[i].implementador===null){
						detalle+='<td></td>';
					} else {
						detalle+='<td>'+data.cim[i].implementador+'</td>';
					}					
					detalle+='<td>'+data.cim[i].acuerdo+'</td>';
					msv+=data.cim[i].acuerdo;
					detalle+='<td>'+data.cim[i].imp+'</td>';
					mv+=data.cim[i].imp;
					if(data.cim[i].imp===null && data.cim[i].imp==0){
						detalle+='<td></td>';
					} else {
						detalle+='<td>'+((data.cim[i].imp/data.cim[i].acuerdo)*100).toFixed(2)+'%</td>';
					}
					if(data.cim[i].motivo===null){
						detalle+='<td></td>';
					} else {
						detalle+='<td>'+data.cim[i].motivo+'</td>';
					}
					detalle+='<td><button class="btn btn-theme btn-sm" onclick="window.open(\'<?php echo base_url("informes/detalle/"); ?>'+btoa(data.cim[i].id_unico)+'\',\'popup\',\'width=screen.width,height=screen.height\'); return false; " ><i class="fa fa-info"></i></button></td>';
					detalle+='</tr>';
				}
				$("#detalle table tbody").html(detalle);
				$("#detalle table tfoot tr").html("<th>TOTAL</th><th></th><th></th><th></th><th></th><th></th><th></th><th>"+msv+"</th><th>"+mv+"</th><th>"+((mv/msv)*100).toFixed(2)+"</th><th></th><th></th>");
				var cantidad = data.cantidad;
				var page='';
				if(pagina!=1){
					page+="<li class='page-item'><a class='page-link text-theme' onclick='pagination("+(pagina-1)+")' > Anterior</a></li>";
				}
				if((pagina-2)>0){
					page+="<li class='page-item'><a class='page-link text-theme' onclick='pagination("+(pagina-2)+")' > "+(pagina-2)+"</a></li>";
				}
				if((pagina-1)>0){
					page+="<li class='page-item'><a class='page-link text-theme' onclick='pagination("+(pagina-1)+")' > "+(pagina-1)+"</a></li>";
				}
				page+="<li class='page-item active'><a class='page-link text-white'    >"+pagina+"</a></li>";
				if((pagina+1)<=cantidad){
					page+="<li class='page-item'><a class='page-link text-theme' onclick='pagination("+(pagina+1)+")'  >"+(pagina+1)+"</a></li>";
				}
				if((pagina+2)<=cantidad){
					page+="<li class='page-item'><a class='page-link text-theme' onclick='pagination("+(pagina+2)+")' >Siguiente </a></li>";
				}
				$("#opcion").val(pagina);
				$(".pagination").html(page);
			}

		});
	}
</script>
