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
			   		 <a href="">Campañas <?php echo $anio; ?></a>
			   	</li>
			</div>
			<div class="container-fluid">
				<div class="animated fadeIn">
					<div class="row">
						<div class="col-md-12">
							<div class='row row-margin-up'>
								<?php
									foreach ($campanas as $c) {
										echo "<div class=' col-md-2'>
											<a class='point' onclick='cadena(\"".base64_encode($c["id_campana"])."\")' data-toggle='tooltip' data-placement='bottom' title='".$c["campana"]."'>
											<div class='card ecom-widget-sales'>
												<div class='card-body'>
													<div class='ecom-sales-icon text-center'>
													<i class='mdi  mdi-folder-multiple-image'></i>
													</div>";
													if(strlen($c["campana"])>33){
														echo "<div class='h6 text-center text-theme'>".substr($c["campana"],0,33)." . . .</div>";
													} else {
														echo "<div class='h6 text-center text-theme'>".$c["campana"]."<br><br></div>";
													}														
											echo	"</div>
												</div>
											</a>
										</div>";
									}
								?>
							</div>
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
		font-size: 73.5%;
	}

	@media only screen and (min-width: 1100px){
		.cd-horizontal-timeline {
		    margin: 2em auto;
		}

	}

	.cd-horizontal-timeline .events-content li > * {
		max-width: 100% !important;
	}

	
</style>