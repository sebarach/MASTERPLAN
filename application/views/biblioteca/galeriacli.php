<link href="<?php echo base_url("assets/css/viewer.css"); ?>" rel="stylesheet" />
<script src="<?php echo base_url("assets/js/viewer.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/main.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/libs/sliderrange/dist/jquery-asRange.min.js"); ?>"></script>

<script src="<?php echo base_url("assets/js/moment-with-locales.min.js")?>"></script>
<script type="text/javascript" src="<?php echo  site_url(); ?>assets/js/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo  site_url(); ?>assets/css/daterangepicker.css" />


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
<div class="app-body">
	<main class="main" style="height: 100%; ">
		<div class="breadcrumb">
		</div>
		<div class="container-fluid ">
			<div class="animated fadeIn">
				<div class="row card-body" style="padding: 0.5rem;">
					<div class="col-md-12" style="margin-bottom: 0.4rem;">
						<h5 ><?php echo $campana["campana"];
						?></h5>
					</div>
					<form id="formfoto" method="POST" action="<?php echo site_url(); ?>informes/galeriacli" class="col-md-10 row">
						<?php
							foreach($empresa as $e) { 
								switch ($e["nombre_filtro"]) {
								 	case 'fep':
								 		echo '<div class="col-md-2" style="margin-top: 0.25rem;"><input type="text" class="form-control blanco select" id="fep" name="fep" placeholder="Fecha Programada" readonly ></div>';
								 		break;
								 	
								 	case 'fei':
								 		echo '<div class="col-md-2" style="margin-top: 0.25rem;"><input type="text" class="form-control blanco select" id="fei" name="fei" placeholder="Fecha Imp" readonly ></div>';
								 		break;
								 	case 'reg'; 
								 		$option=($reg==0) ? '<option value="" >Región</option>' : '<option value="'.$reg.'" >'.$nom_region.'</option>';
										echo'<div class="col-md-2" style="margin-top: 0.25rem;" ><select class="form-control select" name="reg" id="reg">'.$option.'
										</select></div>';
										break;
									case 'ciu':
										$option=($ciu=='0') ? '<option value="" >Ciudad</option>' : '<option value="'.$ciu.'" >'.str_replace('_',' ',$ciu).'</option>';
										echo'<div class="col-md-2" style="margin-top: 0.25rem;" ><select class="form-control select" name="ciu" id="ciu">'.$option.'
										</select></div>';
										break;
									case 'cad':  
										$option=($cad=='0') ? '<option value="" >Cadena</option>' : '<option value="'.$cad.'" >'.str_replace('_',' ',$cad).'</option>';
										echo'<div class="col-md-2" style="margin-top: 0.25rem;" ><select class="form-control select" name="cad" id="cad">'.$option.'
										</select></div>';
										break;
									case 'pdv':
										$option=($pdv=='0') ? '<option value="" >PDV</option>' : '<option value="'.$pdv.'" >'.str_replace('_',' ',$pdv).'</option>';
										echo '<div class="col-md-2" style="margin-top: 0.25rem;" ><select class="form-control select" name="pdv" id="pdv">'.$option.'
										</select></div>';
										break;
									case 'can': 
										$option=($can=='0') ? '<option value="" >Canal</option>' : '<option value="'.$can.'" >'.str_replace('_',' ',$can).'</option>';
										echo '<div class="col-md-2" style="margin-top: 0.25rem;" ><select class="form-control select" name="can" id="can">'.$option.'
										</select></div>';
										break;
									case 'imp':
										$option=($imp=='0') ? '<option value="" >Implementador</option>' : '<option value="'.$imp.'" >'.str_replace('_',' ',$imp).'</option>';
										echo '<div class="col-md-2" style="margin-top: 0.25rem;" ><select class="form-control select" name="imp" id="imp">'.$option.'
										</select></div>';
										break;
									case 'cli':
										$option=($cli=='0') ? '<option value="" >Cadena</option>' : '<option value="'.$cli.'" >'.str_replace('_',' ',$cli).'</option>'; 
										echo '<div class="col-md-2" style="margin-top: 0.25rem;" ><select class="form-control select" name="cli" id="cli">'.$option.'
										</select></div>';
										break;
								 } 
		
	 
		
	
							}
						?>
							
					</form>	
					<div class="col-md-1" style="margin-top: 0.25rem;">
						<div class="btn-group btn-group-sm">
							<button onclick="buscar();" class="nav-link btn btn-sm btn-theme"><i class="fa fa-search"></i></button>&nbsp;&nbsp;<a href="<?php echo site_url(); ?>informes/galeriacli" class="nav-link btn btn-sm btn-theme"><i class="fa fa-refresh"></i></a>;
							
						</div>
								
					</div> 					
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
										echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/galeriafiltros?opcion=".($opcion-1)."' > Anterior</a></li>";
									}
									if(($opcion-2)>0){
										echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/galeriafiltros?opcion=".($opcion-2)."' >".($opcion-2)."</a></li>";
									}
									if(($opcion-1)>0){
										echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/galeriafiltros?opcion=".($opcion-1)."' >".($opcion-1)."</a></li>";
									}   

									echo "<li class='page-item active'><a class='page-link text-theme'  href=''  ><span class='badge badge-theme hertbit'>$opcion</span></a></li>";
									if(($opcion+1)<=$cantidad){
										echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/galeriafiltros?opcion=".($opcion+1)."' >".($opcion+1)."</a></li>";
									}
									if(($opcion+2)<=$cantidad){
										echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/galeriafiltros?opcion=".($opcion+1)."'>Siguiente </a></li>
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
					<ul class="docs-pictures" style="padding-left:0.2rem;">
						<div class="row">
							<?php $contador=0;
							foreach ($fotos as $f) {
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
										echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/galeriafiltros?opcion=".($opcion-1)."' > Anterior</a></li>";
									}
									if(($opcion-2)>0){
										echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/galeriafiltros?opcion=".($opcion-2)."' >".($opcion-2)."</a></li>";
									}
									if(($opcion-1)>0){
										echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/galeriafiltros?opcion=".($opcion-1)."' >".($opcion-1)."</a></li>";
									}   

									echo "<li class='page-item active'><a class='page-link text-theme'  href=''  ><span class='badge badge-theme hertbit'>$opcion</span></a></li>";
									if(($opcion+1)<=$cantidad){
										echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/galeriafiltros?opcion=".($opcion+1)."' >".($opcion+1)."</a></li>";
									}

									if(($opcion+2)<=$cantidad){
										echo "<li class='page-item'><a class='page-link bg-theme text-white' href='".site_url()."informes/galeriafiltros?opcion=".($opcion+1)."'>Siguiente </a></li>
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
<script type="text/javascript">

	$(document).ready(function() {

		<?php
			
		$ajax_data="";
		foreach($empresa as $d) { 
			$ajax_data.=$d["ajax_filtro"];
				
		}

			foreach($empresa as $e) { 
			   if($e["url_filtro"]==''){
			   	if($e["nombre_filtro"]=="fei"){
			   		if($fei==0){
			   			$date='"autoUpdateInput": false,';
			   		} else {
			   			$date='"startDate": "'.date("d-m-Y",strtotime($fei)).'", "autoUpdateInput": true,'; 
			   		}
			   	}
			   	if($e["nombre_filtro"]=="fep"){
			   		if($fep==0){
			   			$date='"autoUpdateInput": false,';
			   		} else {
			   			$date='"startDate": "'.date("d-m-Y",strtotime($fep)).'", "autoUpdateInput": true,'; 
			   		}
			   	}
			   	echo '$("#'.$e["nombre_filtro"].'").daterangepicker({
						"singleDatePicker": true,
						"applyButtonClasses": "btn-warning",'.
						$date
						.'	"locale": {
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
			   		if($e["nombre_filtro"]=="reg"){
				   		if($reg==0){
				   			$id='var id=0;';
				   		} else {
				   			$id='var id='.$reg.';';
				   		}
				   	}
				   if($e["nombre_filtro"]=="ciu"){
				   		if($ciu=='0'){
				   			$id='var id=0;';
				   		} else {
				   			$id='var id="'.$ciu.'";';
				   		}
				   	}
				   	if($e["nombre_filtro"]=="pdv"){
				   		if($pdv=='0'){
				   			$id='var id=0;';
				   		} else {
				   			$id='var id="'.$pdv.'";';
				   		}
				   	}
				   	if($e["nombre_filtro"]=="imp"){
				   		if($imp=='0'){
				   			$id='var id=0;';
				   		} else {
				   			$id='var id="'.$imp.'";';
				   		}
				   	}
				   	if($e["nombre_filtro"]=="cad"){
				   		if($cad=='0'){
				   			$id='var id=0;';
				   		} else {
				   			$id='var id="'.$cad.'";';
				   		}
				   	}
				   	if($e["nombre_filtro"]=="cli"){
				   		if($cli==0){
				   			$id='var id=0;';
				   		} else {
				   			$id='var id="'.$cli.'";';
				   		}
				   	}
				   	if($e["nombre_filtro"]=="can"){
				   		if($can=='0'){
				   			$id='var id=0;';
				   		} else {
				   			$id='var id="'.$can.'";';
				   		}
				   	}			   		
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
										'.$id.'
										'.$e["valuegaleria_filtro"].'
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

	function clearinfo(){
		<?php
			foreach($empresa as $e) { 
				echo $e["clear_filtro"];
			}
		?>
	}


	function buscar(){
		$("#formfoto").submit();
	}



</script>
<style type="text/css">
	.main {
		margin-left: 0px !important;
	}

	.breadcrumb{
		background: white;
		margin: 0;
		padding:0.15rem 0.3rem;
	}

	.bg-theme{
		background-color:  <?php echo $principal;?> !important;
	}

	.text-theme{
		color:  <?php echo $principal;?> !important;
	}

	.badge-theme{
		background: <?php echo $principal;?> !important;
	}

	.page-item.active .page-link{
		background-color: white;
		border-color: <?php echo $principal;?>;
	}

	.card-accent-primary {
	    border-top-color: <?php echo $principal;?>;
	}

	.btn-theme {
	    -webkit-box-shadow: 0px 5px 25px -3px <?php echo $principal;?>;
	    -moz-box-shadow: 0px 5px 25px -3px <?php echo $principal;?>;
	    box-shadow: 0px 5px 25px -3px <?php echo $principal;?>;
	    background: <?php echo $principal;?>;
	}

	.btn-theme:hover {
	    background: <?php echo $principal;?> !important;
	}

	.select2-container--default .select2-results__option--highlighted[aria-selected] {
    	background-color:  <?php echo $principal;?>;
    }
	.form-control{
	 		font-size: 0.7rem !important;
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