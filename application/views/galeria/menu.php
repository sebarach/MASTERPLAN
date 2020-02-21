<body class="app sidebar-fixed aside-menu-off-canvas aside-menu-hidden header-fixed  pace-done">
	<div class="app-body">
		<main class="main" style="height: 100%; ">
			<div class="breadcrumb">
				<li class="breadcrumb-item ">
			        <a href="<?php echo base_url("home"); ?>"><?php echo $empresa[0]["empresa"]; ?></a>
			    </li>
			   <li class='breadcrumb-item'>
			   		<a href=''>Galería</a>
			   	</li>
			</div>
			<div class="container-fluid">
				<div class="animated fadeIn">
					<div class="row " >
						<div class="col-md-12 col-lg-12">
							<div class="row row-margin-up">
								<?php
									foreach ($anios as $a) {
										echo "<div class='col-md-2' >
											<a onclick='galeria_anios(\"".base64_encode($a["anio"])."\")' class='point'  >
												<div class='card ecom-widget-sales'>
													<div class='card-body'>
														<div class='ecom-sales-icon text-center'>
															<i class='mdi  mdi-folder-multiple-image'></i>
														</div>
														<h4 class='text-center text-theme'>".$a["anio"]."</h4>
													</div>
												</div>
											</a>
										</div>
										";
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

	.ecom-widget-sales:hover h4, .ecom-widget-sales:focus h4, .ecom-widget-sales:active h4{
		color: white; 
	}

	.ecom-widget-sales:hover i, .ecom-widget-sales:focus i, .ecom-widget-sales:active i{
		color: white; 
	}

	.col-md-2 a{
		text-decoration: none;
	}

	.ecom-sales-icon{
		line-height: 1.2 !important;
	}



</style>