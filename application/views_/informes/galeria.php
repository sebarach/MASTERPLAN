<link href="<?php echo base_url("assets/css/viewer.css"); ?>" rel="stylesheet" />
<script src="<?php echo base_url("assets/js/viewer.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/main.js"); ?>"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/pptxgenjs@2.5.0/dist/pptxgen.bundle.js"></script>

<!-- Individual files: Add only what's needed to avoid clobbering loaded libraries -->
<script src="https://cdn.jsdelivr.net/gh/gitbrent/pptxgenjs@2.5.0/libs/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/pptxgenjs@2.5.0/libs/jszip.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/pptxgenjs@2.5.0/dist/pptxgen.min.js"></script>
<body class="app sidebar-fixed aside-menu-off-canvas aside-menu-hidden header-fixed  pace-done">
	<div class="app-body">
		<main class="main" style="height: 100%; ">
			<div class="breadcrumb">
				<li class="breadcrumb-item ">
			        <!-- <a href="">Dashboard</a> -->
			    </li>
			</div>
			<div class="container-fluid ">
				<div class="animated fadeIn">
					<div class="row">
						<div class="col-md-12">
							<div class="ecom-widget-chart-full">
								<div class="chart-full-header">
									<div class="header-text">
										<div class="heading"><?php echo $campana["campana"];?></div>
									</div>
									<small class="text-white">GALER&Iacute;A FOTOGR&Aacute;FICA</small>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-md-3">
											
										</div>
										<div class="col-md-3">
											
										</div>
										<div class="col-md-3">
											
										</div>
										<div class="col-md-2">
											<button onclick="clearinfo();" class="btn btn-theme"><i class="fa fa-spin fa-refresh"></i></button>
											<button onclick="generarPpt();" class="btn btn-warning"><i class="fa fa-download"></i></button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="float-right">
								<div class="row">
									<?php	if(isset($opcion)){                
				                    echo "<div class='col-md-6'>
				                    <nav aria-label='Page navigation example pull-right'>
				                        <ul class='pagination'>";
				                         if($opcion!=1){
				                        echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/fotografia?opcion=".($opcion-1)."' > Anterior</a></li>";
				                    }
				                    if(($opcion-2)>0){
				                      
				                        echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/fotografia?opcion=".($opcion-2)."' >".($opcion-2)."</a></li>";
				                    }
				                    if(($opcion-1)>0){
				                        
				                        echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/fotografia?opcion=".($opcion-1)."' >".($opcion-1)."</a></li>";
				                    }   

				                    echo "<li class='page-item active'><a class='page-link text-red' style='border-color: #f57c00; background-color: #fff; color: #f57c00; href=''  ><span class='badge badge-theme hertbit'>$opcion</span></a></li>";

				                    if(($opcion+1)<=$opcion){
				                        
				                        echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/fotografia?opcion=".($opcion+1)."' >".($opcion+1)."</a></li>";
				                    }
				                    if(($opcion+2)<=$cantidad){
				                       
				                        echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/fotografia?opcion=".($opcion+2)."' >".($opcion+2)."</a></li>";
				                    }
				                    if(($opcion+3)<=$cantidad){
				                         echo "<li class='page-item'><a class='page-link bg-theme text-white'>...</a></li>";
				                       
				                        echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/fotografia?opcion=$cantidad'>$cantidad</a></li>";
				                    }
				                    if($opcion!=$cantidad){
				                      
				                        echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/fotografia?opcion=".($opcion+1)."'>Siguiente </a></li>
				                        </ul>
				                    </nav>";
				                    }
				                }   
				                    echo"                    
				                   
				                    
				                </div>"; ?>
							</div>	
						</div> 
					</div>
					<div class="col-md-12">
						<ul class="docs-pictures">
							<div class="row">
								<?php $contador=0;
									foreach ($fotos as $f) {
										if(!is_null($f["url_foto"])){
											echo "<div class='col-md-3'>";
											echo "<div class='card card-accent-primary mb-3'>";
											echo "<img src='".$f["url_foto"]."' class='card-img-top'>";
											echo "<div class='card-body'>";
											echo "<p class='card-text address'>".$f["nombre"]."</p>";
											echo "</div>";
											echo "</div>";
											echo "</div>";
											echo "<input type='hidden' id='txt_foto".$contador."' name='txt_foto".$contador."' value='".$f["url_foto"]."'>";
											echo "<input type='hidden' id='nombre".$contador."' name='nombre".$contador."' value='".$f["nombre"]."'>";
											$contador++;

										}
									}
									echo "<input type='hidden' id='contador' name='contador' value='".$contador."'>";
								?>
							</div>
						</ul>
					</div>
						<div class="col-md-12">
							<div class="float-right">
								<div class="row">
									<?php	if(isset($opcion)){                
				                    echo "<div class='col-md-6'>
				                    <nav aria-label='Page navigation example pull-right'>
				                        <ul class='pagination'>";
				                         if($opcion!=1){
				                        echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/fotografia?opcion=".($opcion-1)."' > Anterior</a></li>";
				                    }
				                    if(($opcion-2)>0){
				                      
				                        echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/fotografia?opcion=".($opcion-2)."' >".($opcion-2)."</a></li>";
				                    }
				                    if(($opcion-1)>0){
				                        
				                        echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/fotografia?opcion=".($opcion-1)."' >".($opcion-1)."</a></li>";
				                    }   

				                    echo "<li class='page-item active'><a class='page-link text-red' style='border-color: #f57c00; background-color: #fff; color: #f57c00; href=''  ><span class='badge badge-theme hertbit'>$opcion</span></a></li>";

				                    if(($opcion+1)<=$opcion){
				                        
				                        echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/fotografia?opcion=".($opcion+1)."' >".($opcion+1)."</a></li>";
				                    }
				                    if(($opcion+2)<=$cantidad){
				                       
				                        echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/fotografia?opcion=".($opcion+2)."' >".($opcion+2)."</a></li>";
				                    }
				                    if(($opcion+3)<=$cantidad){
				                         echo "<li class='page-item'><a class='page-link bg-theme text-white'>...</a></li>";
				                       
				                        echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/fotografia?opcion=$cantidad'>$cantidad</a></li>";
				                    }
				                    if($opcion!=$cantidad){
				                      
				                        echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/fotografia?opcion=".($opcion+1)."'>Siguiente </a></li>
				                        </ul>
				                    </nav>";
				                    }
				                }   
				                    echo"                    
				                   
				                    
				                </div>"; ?>
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

	.breadcrumb{
		background: white;
		margin: 0;
	}
</style>

<script type="text/javascript">
	function generarPpt(){
		var contador=$("#contador").val();
		var count=0;
		var pptx = new PptxGenJS();
		for (var i = 0; i < contador; i++) {
			var slide = pptx.addNewSlide();
			slide.addText($("#nombre"+count).val(), { x:1.5, y:1.5, fontSize:18, color:'363636' });
			slide.addImage({ path: $("#txt_foto"+count).val(), x:2, y:2, w:6, h:4 });
			count++;
		}
		pptx.save('Galeria Fotografica <?php echo $campana["campana"];?>');
	}
</script>