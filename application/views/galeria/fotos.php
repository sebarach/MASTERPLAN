<link href="<?php echo base_url("assets/css/viewer.css"); ?>" rel="stylesheet" />
<script src="<?php echo base_url("assets/js/viewer.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/main.js"); ?>"></script>
<body class="app sidebar-fixed aside-menu-off-canvas aside-menu-hidden header-fixed  pace-done">
	<div class="app-body">
		<main class="main" style="height: 100%; ">
			<div class="breadcrumb">
				<li class="breadcrumb-item ">
			        <a href="<?php echo base_url("home"); ?>"><?php echo $empresa[0]["empresa"]; ?></a>
			    </li>
			   	<li class='breadcrumb-item'>
			   		<a href='<?php echo base_url("home/galeria"); ?>'>Galería</a>
			   	</li>
			   	<li class='breadcrumb-item'>
			   		 <a href="<?php echo base_url("galerias/campanas"); ?>"><?php echo $campana["campana"]; ?></a>
			   	</li>
			   	<li class='breadcrumb-item'>
			   		 <a href="<?php echo base_url("galerias/cadenas"); ?>"><?php echo $cadena; ?></a>
			   	</li>
			   	<li class='breadcrumb-item'>
			   		 <a href="">Fotos</a>
			   	</li>
			</div>
			<div class="container-fluid">
				<div class="animated fadeIn">
					<div class="row">
						<div class="col-md-12">
							<ul class="docs-pictures">
								<div class='row'>
									<?php
									$cf=1;
										foreach ($fotos as $f) {
											// foreach ($fotos as $fi) {
											// 	// if($f["nombre"]==$fi["nombre"]){
													// echo $f["nombre"]." - ".$cf."<br>";
													echo "<div class='col-md-2'>
														<div class='card border-primary'>
															<div class='card-body'>
																<a>
																	<img class='card-img-top' width='400' height='150' src='".$f["url_foto"]."'>
																</a>
																<p class='card-text address'>".$f["nombre"]."</p>
															</div>
														</div>
													</div>";
												// 	$cf+=1;
												// } else {
												// 	$cf=1;
												// }
											// }		
										}
									?>
								</div>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</main>
	</div>
</body>
<style type="text/css">
	.main {
		margin-left: 0px !important;
	}

	.point{
		cursor: pointer;
	}

	.row-margin-up{
		/*margin-top: 0 !important;*/
		margin: auto !important; -ms-flex-wrap:wrap;flex-wrap:wrap; display:-webkit-box; display:-ms-flexbox;display:flex; -webkit-box-pack:justify; -ms-flex-pack:justify;
	}

	.ecom-widget-sales .ecom-sales-icon {
		color: #f57c00 !important; 
	}

	.ecom-widget-sales:hover, .ecom-widget-sales:focus, .ecom-widget-sales:active{
		background-color: #f57c00;
	}

	.ecom-widget-sales:hover div , .ecom-widget-sales:focus div, .ecom-widget-sales:active div {
		color: white; 
	}

	.ecom-widget-sales:hover i, .ecom-widget-sales:focus i, .ecom-widget-sales:active i{
		color: white; 
	}

	.col-md-2 a{
		text-decoration: none;
	}

	.ecom-sales-icon{
		line-height: 0.9 !important;
	}

	.h6{
		font-size: 85%;
	}

	@media only screen and (min-width: 1100px){
		.cd-horizontal-timeline {
		    margin: 2em auto;
		}

	}

	.cd-horizontal-timeline .events-content li > * {
		max-width: 100% !important;
	}

	p{
		margin-bottom: 0.16rem;
		margin-top: 0.16rem;
	}

	ul{
		padding-left: 15px;
	}

	
</style>