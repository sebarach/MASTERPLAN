<link href="<?php echo base_url("assets/css/viewer.css"); ?>" rel="stylesheet" />
<script src="<?php echo base_url("assets/js/viewer.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/main.js"); ?>"></script>


<body class="app sidebar-fixed aside-menu-off-canvas aside-menu-hidden header-fixed  pace-done"> 
	<div class="app-body">
		<main class="main" style="height: 100%; ">
			<div class="breadcrumb">
			</div>
			<div class="container-fluid ">
				<div class="animated fadeIn">
					<div class="row card-body" style="padding: 0.5rem;">
						<div class="col-md-12" style="margin-bottom: 0.4rem;">
							<h5 ><?php echo $campana["campana"];?></h5>
						</div>
						<div class="col-md-12">
							<form id="formfoto" method="POST" action="<?php echo site_url(); ?>informes/galeria">
								<div class="row">	
									<div class="col-md-2">
										<div class="card" style="margin-bottom: 0.4rem;">
											<div class="clearfix">
												<select class="form-control"  id="lbl_region_i" name="lbl_region_i" onchange="buscar()" >
												<?php
													if($region!=0){
														echo '<option value="'.$region.'" >'.$nombre_region.'</option>';
													} else {
														echo '<option value="" >Región</option>';
													} 
												?>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="card" style="margin-bottom: 0.4rem;">
											<div class="clearfix">
												<select  class="form-control"  id="lbl_ciudad_i" name="lbl_ciudad_i" onchange="buscar()">
												<?php
													if($ciudad!="0"){
														echo '<option value="'.$ciudad.'" >'.str_replace('_',' ',$ciudad).'</option>';
													} else {
														echo '<option value="" >Ciudad</option>';
													} 
												?>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="card" style="margin-bottom: 0.4rem;">
											<div class="clearfix">
												<select  class="form-control"  id="lbl_sucursal_i" name="lbl_sucursal_i" onchange="buscar()">
													<?php
												 	if($sucursal!="0"){
														echo '<option value="'.$sucursal.'" >'.$sucursal.'</option>';
													} else {
														echo '<option value="" >Sucursal</option>';
													}
												?>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-1">
										<a href="<?php echo base_url("informes/galeria"); ?>" class="btn btn-theme pull-left"><i class="fa fa-refresh"></i></a>
									</div>
									<?php if(count($fotos)>0) { ?>
									<div class="col-md-5">
										<a href="<?php echo base_url("informes/powerpointcam/".base64_encode($campana["id_campana"])); ?>" class="btn btn-theme pull-right"><i class="fa fa-download"></i></a>									
									</div>
									<?php } ?>
								</div>
							</form>												
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="float-right">
								<div class="row">
									<?php	if(isset($opcion) && count($fotos)>0){                
				             	echo "<div class='col-md-6'>
				                    <nav aria-label='Page navigation example pull-right'>
				                        <ul class='pagination'>";
				                        if($opcion!=1){
				                        	echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/galeria?opcion=".($opcion-1)."' > Anterior</a></li>";
				                    	}
				                    	if(($opcion-2)>0){
				                      		echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/galeria?opcion=".($opcion-2)."' >".($opcion-2)."</a></li>";
				                    	}
				                    	if(($opcion-1)>0){
					                        echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/galeria?opcion=".($opcion-1)."' >".($opcion-1)."</a></li>";
				                    	}   
										echo "<li class='page-item active'><a class='page-link text-theme'  href=''  ><span class='badge badge-theme hertbit'>$opcion</span></a></li>";
				                    	// if(($opcion)<=$opcion){
					                    //     echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/galeria?opcion=".($opcion+1)."' >".($opcion+1)."</a></li>";
				                    	// }
					                    if(($opcion+1)<=$cantidad){
						                    echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/galeria?opcion=".($opcion+1)."' >".($opcion+1)."</a></li>";
					                    }
					                    // if(($opcion+3)<=$cantidad){
					                    //     echo "<li class='page-item'><a class='page-link bg-theme text-white'>...</a></li>";
					                    //    	echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/galeria?opcion=$cantidad'>$cantidad</a></li>";
					                    // }
					                  	if(($opcion+2)<=$cantidad){
					                      	echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/galeria?opcion=".($opcion+1)."'>Siguiente </a></li>";
					                        
					                    }
					                   echo" </ul>
					                    </nav>";
					                } ?> 
				                </div> 
							</div>	
						</div> 
					</div>
					<div class="col-md-12">
						<ul class="docs-pictures" style="padding-left:0.2rem;">
								<div class="row">
									<?php $contador=0;
										foreach ($fotos as $f) {
											// echo "<a class=''style='margin-left:0.8rem;'><img src='".$f["url_foto"]."' width='400' height='160' alt='".$f["nombre"]."'></a>";
											echo "<div class='col-md-2'>";
											echo "<div class='card card-accent-primary mb-3'>";
											echo "<img src='".$f["url_foto"]."' width='400' height='160' class='card-img-top'>";
											echo "<div class='card-body' style='padding:0.7rem;'>";
												echo "<p class='card-text address'>".$f["nombre"]."</p>";
											echo "</div>";
											echo "</div>";
											echo "</div>";
											echo "<input type='hidden' id='txt_foto".$contador."' name='txt_foto".$contador."' value='".$f["url_foto"]."'>";
											echo "<input type='hidden' id='nombre".$contador."' name='nombre".$contador."' value='".$f["nombre"]."'>";
												$contador++;
										}
										echo "<input type='hidden' id='contador' name='contador' value='".$contador."'>";
									?>
								</div>
						</ul>
					</div>
						<div class="col-md-12">
							<div class="float-right">
								<div class="row">
									<?php	if(isset($opcion) && count($fotos)>0){                
				             	echo "<div class='col-md-6'>
				                    <nav aria-label='Page navigation example pull-right'>
				                        <ul class='pagination'>";
				                        if($opcion!=1){
				                        	echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/galeria?opcion=".($opcion-1)."' > Anterior</a></li>";
				                    	}
				                    	if(($opcion-2)>0){
				                      		echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/galeria?opcion=".($opcion-2)."' >".($opcion-2)."</a></li>";
				                    	}
				                    	if(($opcion-1)>0){
					                        echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/galeria?opcion=".($opcion-1)."' >".($opcion-1)."</a></li>";
				                    	}   
										echo "<li class='page-item active'><a class='page-link text-theme'  href=''  ><span class='badge badge-theme hertbit'>$opcion</span></a></li>";
				                    	// if(($opcion)<=$opcion){
					                    //     echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/galeria?opcion=".($opcion+1)."' >".($opcion+1)."</a></li>";
				                    	// }
					                    if(($opcion+1)<=$cantidad){
						                    echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/galeria?opcion=".($opcion+1)."' >".($opcion+1)."</a></li>";
					                    }
					                    // if(($opcion+3)<=$cantidad){
					                    //     echo "<li class='page-item'><a class='page-link bg-theme text-white'>...</a></li>";
					                    //    	echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/galeria?opcion=$cantidad'>$cantidad</a></li>";
					                    // }
					                  	if(($opcion+2)<=$cantidad){
					                      	echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/galeria?opcion=".($opcion+1)."'>Siguiente </a></li>";
					                        
					                    }
					                   echo" </ul>
					                    </nav>";
					                } ?> 
				                </div>
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
		padding:0.15rem 0.3rem;
	}

	.page-item.active .page-link{
		background-color: white;
	}
</style>

<script type="text/javascript">

	$(document).ready(function() {
		

		$('#lbl_sucursal_i').select2({
			ajax:{
				url:"<?php echo base_url("informes/id_cliente"); ?>",
				dataType:"json",
				type: "POST",
				data: function (term, page) {
		            return "id_campana=<?php echo base64_decode($_SESSION["campana"]); ?>&region="+$("#lbl_region_i").val()+"&ciudad="+$("#lbl_ciudad_i").val()+"&sucursal="+$("#lbl_sucursal_i").val();
		        },
				delay: 350,
				processResults: function (data) {
					return {
						results: $.map(data, function(obj) {
							var id='<?php echo $sucursal; ?>';
							if(id!=obj.id_cliente){
								return { id: obj.id_cliente, text: obj.id_cliente };
							}
						})
					};
				},
				cache: true
			}
		});

		$('#lbl_ciudad_i').select2({
			ajax:{
				url:"<?php echo base_url("solicitudes_ot/comunas"); ?>",
				dataType:"json",
				type: "POST",
				delay: 350,
				data: function (term, page) {
		            return "id_campana=<?php echo base64_decode($_SESSION["campana"]); ?>&region="+$("#lbl_region_i").val()+"&ciudad="+$("#lbl_ciudad_i").val()+"&sucursal="+$("#lbl_sucursal_i").val();
		        },
				processResults: function (data) {
					return {
						results: $.map(data, function(obj) {
							var id='<?php echo $ciudad; ?>';
							if(id!=obj.id_ciudad){
								return { id: obj.id_ciudad, text: obj.ciudad };
							}
						})
					};
				},
				cache: true
			}
		});

		$('#lbl_region_i').select2({
			ajax:{
				url:"<?php echo base_url("solicitudes_ot/regiones"); ?>",
				dataType:"json",
				type: "POST",
				delay: 350,
				data: function (term, page) {
		            return "id_campana=<?php echo base64_decode($_SESSION["campana"]); ?>&region="+$("#lbl_region_i").val()+"&ciudad="+$("#lbl_ciudad_i").val()+"&sucursal="+$("#lbl_sucursal_i").val();
		        },
				processResults: function (data) {
					return {
						results: $.map(data, function(obj) {
							var id=<?php echo $region; ?>;
							if(id!=obj.id_region){
								return { id: obj.id_region, text: obj.region };
							}
						})
					};
				},
				cache: true
			}
		});
	});


	function buscar(){
		$("#formfoto").submit();
	}
	
</script>