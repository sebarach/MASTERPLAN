<body class="app sidebar-fixed aside-menu-off-canvas aside-menu-hidden header-fixed  pace-done">
	<div class="app-body">
		<main class="main" style="height: 100%; ">
			<ol class="breadcrumb " id="breadcrumb">
				<li class="breadcrumb-item">
			        <a href="<?php echo base_url("home");?>">Inicio</a>
			    </li> 
			    <li class="breadcrumb-item active">
			        <a href="">Biblioteca</a>
			    </li> 
			</ol>
			<div class="container-fluid ">
				<div class="animated fadeIn">
					<h4 style="padding-bottom: 0.5rem;" ><?php echo $campana["campana"];?></h4>
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<?php
								 	$con=0;
								 	$div=0;
									foreach ($carpetas as $c) {
										echo "<div class='col-md-3'>
											<div class='card stats-widget-2'>
												<div class='widget-body clearfix'>
													<div class='widget-text ecom-widget-sales'>
														<h5 >".$c["nombre_carpeta"]."</h5>
														<ul>
															<li><small>Creador: ".$c["usuario"]."</small></li>
															<li><small>Fecha Creación: ".date("d-m-Y",strtotime($c["fecha_registro"]))."</small></li>	
														</ul>					
													</div>
													<div class='btn-group card-body'>
														<button type='button' class='btn btn-sm btn-outline-theme' data-toggle='modal' data-target='#modal11' onclick='verDocumentos(\"".base64_encode($c["id_carpeta"])."\")'  title='Documentos'><i class='fa fa-folder'></i></button>
													</div>
													<span class='pull-right watermark'>
														<i class='fa fa-folder-open'></i>
													</span>
												</div>
											</div>
										</div>";
										// if($con==0){
										// 	echo "<div class='col-md-12 collapse' id='collapse".$div."'>
										// 			holi
										// 		</div>";
										// 	$div+=4;
										// 	$con+=1;
										// } else if($con==4){
										// 	$con=0;
										// } else {
										// 	$con+=1;
										// }
										
									}
								?>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
		<div class="modal fade" id="modal11"  role="dialog"  aria-hidden="true">
		    <div class="modal-dialog modal-lg" role="document">
		        <div class="modal-content">
		        	<div class="modal-header">
			            <h6 class="modal-title">Documentos</h6>
			            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                <span aria-hidden="true">×</span>
			           </button>
			       </div>
			       <div class="modal-body">
			       		<div class="row" id="documentosResp">
			       			
			       		</div>
			       </div>
			    </div>
			</div>
		</div>
	</div>
</body>
<style type="text/css">
	.main {
		margin-left: 0px !important;
	}

	.stats-widget-2 .widget-body{
		padding-right: 1rem;
		padding-left: 1rem;
		padding-bottom: 0rem;
		padding-top: 0.9rem;
	}

	.widget-body{
		color:#f57c00 !important;
	}

	.widget-body span{
		font-size: 3.5rem;
	}

	.widget-body h5{
		font-size: 1rem;
	    font-weight: 600;
	    margin: 0;
	}

	.ecom-widget-sales ul li {
    	margin-bottom: 0px; 
    }

	small{
		font-size: 0.7rem;
	}

	.card-body{
		padding: 0.4rem;
	}

	.btn-outline-theme:hover {
	    background: #f57c00;
	    color: white !important;
	}

 	.fstElement { font-size: 0.9em; }
	.fstResultItem { font-size: 0.9em; }
	.fstToggleBtn { min-width: 16.5em; }

	.submitBtn { display: none; }

	.fstMultipleMode { display: block; }
	.fstMultipleMode .fstControls { width: 100%; }

	@media (min-width: 992px){
		.modal-lg {
		    max-width: 1300px;
		}
	}

	.font-2xl {
	    font-size: 3.5rem !important;
	}
</style>
<script type="text/javascript">
	function verDocumentos(carpeta){
		var carp=carpeta;
		$.ajax({
            url: "<?php echo base_url("informes/obtenerDocumentos"); ?>",
            type: "POST",
            data: "carp="+carp,
            success: function(data) {   
            	$("#modal11").find("#documentosResp").html(data);          
            }
        });
		
	}
</script>