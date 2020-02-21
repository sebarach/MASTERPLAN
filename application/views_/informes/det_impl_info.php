<link href="<?php echo base_url("assets/css/viewer.css"); ?>" rel="stylesheet" />
<script src="<?php echo base_url("assets/js/viewer.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/main.js"); ?>"></script>
<body class="app sidebar-fixed aside-menu-off-canvas aside-menu-hidden header-fixed  pace-done">
	<div class="app-body">
		<main class="main" style="height: 100%; ">
			<div class="container-fluid">
				<div class="animated fadeIn">
					<?php if(isset($mat[0]["medicion"])){ ?>
						<div class="row">
							<div class="col-md-12">	
								<div class="card">
									<div class="card-body">						
										<h4 class="card-title">Detalle Implementación </h4>
										<div class="row">
											<div class="col-md-3">
												<div class="card-body ecom-widget-sales">
													<ul>
														<li>Sucursal<span><?php echo $mat[0]["id_cliente"]." - ".$cliente["Nombre_Fantasia"];?></span></li>
														<li>Dirección <span><?php echo $cliente["direccion"];?></span></li>
														<li>Implementador<span><?php echo $cliente["Implementador"];?></span></li>
														<li>Recepciona<span><?php echo $cliente["Quien_Nombre"];?></span></li>
														<li>Motivo<span><?php echo $cliente["Motivo"];?></span></li>
														<li>Observación<span><?php echo $cliente["Update_Comentario"];?></span></li>
													</ul>
												</div>
											</div>
											<div class="col-md-9">
												<table class="table color-bordered-table primary-bordered-table tab1" id="t5" width="100%">
											<thead>
												<tr style="font-size: 0.77rem;">
													<th>MATERIAL</th>
													<th>FECHA PROGRAMADA</th>
													<th>FECHA REAL</th>									
													<th>AC</th>
													<th>IMP</th>
													<th>%</th>
													<th>MOTIVO</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$tsv=0;
													$tv=0;
													foreach ($mat as $m) {
														echo "<tr style=\"font-size: 0.77rem;\">";
														echo "<td>".$m["medicion"]."</td>";
														echo "<td>".date("d-m-Y",strtotime($m["fecha_programada"]))."</td>";
														if(is_null($m["fecha_real"])){
															$fecha="";
														} else {
															$fecha=date("d-m-Y",strtotime($m["fecha_real"]));
														}
														echo "<td>".$fecha."</td>";
														echo "<td>".$m["acuerdo"]."</td>";
														$tsv+=$m["acuerdo"];
														echo "<td>".$m["implementado"]."</td>";
														$tv+=$m["implementado"];
														if($m["implementado"]==0){
															echo "<td>0%</td>";
														} else {
															echo "<td>".round((($m["implementado"]/$m["acuerdo"])*100),2)."%</td>";
														}
														echo "<td>".$m["motivo"]."</td>";
														echo "</tr>";
													}
												?>
											</tbody>
											<tfoot>
												<tr style="font-size: 0.77rem;" class="bg-theme">
													<th>TOTAL</th>
													<th></th>
													<th></th>
													<th ><?php echo $tsv; ?></th>
													<th ><?php echo $tv; ?></th>
													<th ><?php if($tv!=0){ echo round(($tv/$tsv)*100,2); } else { echo "0"; }?>%</th>
													<th></th>
												</tr>
											</tfoot>
										</table>
											</div>
										</div>
									</div>
									<div class="card-body">						
										<?php if(isset($fotos)){?>
											<h5 class="text-theme">Fotos</h5>
											<ul class="docs-pictures">
												<div class="row">
													<?php
														foreach ($fotos as $f) {
															echo "<div class='col-md-3'>";
															echo "<div class='card'>
																<img src='".$f["url_foto"]."' class='card-img-top'>
															</div>";
															echo "</div>";
														}
													?>
												</div>
											</ul>
										<?php } ?>
									</div>
								</div>	
							</div>
						</div>
					<?php } else {?>
						<div class="row">
							<div class="col-md-12">	
								<div class="card">
									<div class="card-body">						
										<h3 class="text-theme">No existe implementación para la sucursal <?php echo $mat[0]["id_cliente"]?>.</h3>
									</div>
								</div>
							</div>
						</div>
					<?php }?>
				</div>
			</div>
		</main>
	</div>
</body>
<style type="text/css">
	.main {
		margin-left: 0px !important;
	}

	.header-fixed .app-body {
		margin-top: 0px;
	}

	table th {
		 text-align: center;
	}

	table td {
		text-align: center;
	}

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

	.card{
		color: #678898;
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

	#t5 tr:hover,  #t5 tr:focus {
		background-color: #f57c00;
		color: #fff;
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
</style>
<script type="text/javascript">
	  var t22=$('#t5').DataTable( {
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

		$(".dataTables_scrollHeadInner table").attr('style','margin-left: 0px;');

	    $(".dataTables_scrollHeadInner").attr('style','box-sizing: content-box; padding-right: 0px;');

	    $(".dataTables_scrollFootInner table").attr('style','margin-left: 0px;');

	    $(".dataTables_scrollFootInner").attr('style','padding-right: 0px;');
</script>