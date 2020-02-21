<script src="<?php echo base_url("assets/js/polyfill.js"); ?>"></script> 
<script src="<?php echo base_url("assets/js/moment.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/rome.standalone.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/material-datetime-picker.js"); ?>" charset="utf-8"></script>
<link rel="stylesheet" href="<?php echo base_url("assets/css/material-datetime-picker.css"); ?>"> 
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"  rel="stylesheet">
<main class="main sidebar-fixed sidebar-compact aside-menu-off-canvas aside-menu-hidden header-fixed" style="height: 100%;">
	<ol class="breadcrumb " id="breadcrumb">
		<li class="breadcrumb-item">
	        <a href="<?php echo base_url("home");?>">Inicio</a>
	    </li> 
	    <li class="breadcrumb-item active">
	        <a href="">Reportar</a>
	    </li> 
	</ol>
	<div class="container-fluid">
		<div class="animated fadeIn">
			<h4>Reportar Implementación</h4>
			<div class="row">
				<div class="col-md-12">
					<div class="card card-accent-theme">
						<div class="card-body">
							<form method="post" action="<?php echo base_url("clientes/cliente_implementacion"); ?>" onsubmit=" return valida_form('cl_edit');" enctype="multipart/form-data">
								<div class="products-widget">							
									<div class="row ">
										<div class="col-md-4">
											<div class="form-group ">
												<label class="">Seleccionar Campaña</label>
												<select class="form-control" onchange="accion();" id="lb_campana">
													<option value="0">Seleccionar</option>
													<?Php 
														foreach($campanas_cliente as $m){
															echo "<option value='".$m['ID_Campana']."'>".$m['campana']."</option>";
														}
													?>
												</select>
											</div>
										</div>
										<div class="col-md-4" id="accion">
										</div>
										<div class="col-md-4" id="cliente">
										</div>
									</div>	
								</div>
								<div class="products-widget" id="cliente_detalle">
											
								</div>								
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<style type="text/css">
	.text-theme{
		color:#f57c00 !important;
	}

	.ecom-widget-sales ul li span{
		color:#f57c00 !important;
		display:block;
	    width:60%;
	    word-wrap:break-word;
	}

	@media (max-width: 576px) { .ecom-widget-sales ul li span{  width:100%; } }
</style>

<script >

	

	

	function accion(){
		var e=$("#lb_campana").val();
		$.ajax({
				url: "<?php echo site_url(); ?>clientes/accion",
			type:"POST",
			data:"cam="+e,
			success: function(data){
				 $("#accion").html(data);
			}
		});
	}


	function cliente(){
		var params = {
        cam: $("#lb_campana").val(),
        acc: $("#lb_accion").val()
         };

		$.ajax({
			url: "<?php echo site_url(); ?>clientes/cliente_buscar",
			type:"POST",
			data:params,
			success: function(data){
				 
				 $("#cliente").html(data);
				 
			}
		});
	}
	

	
	function cliente_detalle(){
		var params = {
        uni: $("#lb_cliente").val()
		 
         };
		$.ajax({
			url: "<?php echo site_url(); ?>clientes/cliente",
			type:"POST",
			data:params,
			success: function(data){
				$("#cliente_detalle" ).slideUp( 300 ).delay( 800 ).fadeIn( 400 );
				$("#cliente_detalle").html(data);
			}
		});
	}
	
	function modificar(id){
		
		switch(id){
			case 1:
				 $( "#txt_Foto1" ).show( "slow" );
				 $( "#btn_Foto1" ).hide( "slow" );		
				break;
			
			case 2:
				 $( "#txt_Foto2" ).show( "slow" );
				 $( "#btn_Foto2" ).hide( "slow" );	
				 break;
		
			case 3:
				 $( "#txt_Foto3" ).show( "slow" );
				 $( "#btn_Foto3" ).hide( "slow" );	
				 break;	
			
			case 4:
				 $( "#txt_Foto4" ).show( "slow" );
				 $( "#btn_Foto4" ).hide( "slow" );	
				 break;
				 
			case 5:
				 $( "#txt_Foto5" ).show( "slow" );
				 $( "#btn_Foto5" ).hide( "slow" );	
				 break;
				 
			case 6:
				 $( "#txt_Foto6" ).show( "slow" );
				 $( "#btn_Foto6" ).hide( "slow" );	
				 break;
				 
			case 7:
				 $( "#txt_Foto7" ).show( "slow" );
				 $( "#btn_Foto7" ).hide( "slow" );	
				 break;
				 
			case 8:
				 $( "#txt_Foto8" ).show( "slow" );
				 $( "#btn_Foto8" ).hide( "slow" );	
				 break;
		}
	}
	
	

</script>