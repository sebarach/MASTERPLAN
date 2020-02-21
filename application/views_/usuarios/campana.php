<?php
	if($usuario["id_perfil"]==5){
?>
<style type="text/css">
	  #loader {
	  position: absolute;
	  left: 50%;
	  top: 72.5%;
	  z-index: 1;
	  width: 150px;
	  height: 150px;
	  margin: -75px 0 0 -75px;
	  border: 16px solid #f3f3f3;
	  border-radius: 50%;
	  border-top: 16px solid #f03434;
	  width: 120px;
	  height: 120px;
	  -webkit-animation: spin 2s linear infinite;
	  animation: spin 2s linear infinite;
	}

	@-webkit-keyframes spin {
	  0% { -webkit-transform: rotate(0deg); }
	  100% { -webkit-transform: rotate(360deg); }
	}

	@keyframes spin {
	  0% { transform: rotate(0deg); }
	  100% { transform: rotate(360deg); }
	}

</style>
<script src="<?php echo base_url("assets/js/jquery-ui.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/jquery.tree-multiselect.js"); ?>"></script>
<link rel="stylesheet" href="<?php echo base_url("assets/css/jquery.tree-multiselect.css")?>">
<?php 
	} else {
?>
<script src="<?php echo base_url("assets/js/libs/multiselect/js/jquery.multi-select.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/jquery.quicksearch.js"); ?>"></script>
<?php 
	} 
?>
<main class="main sidebar-fixed sidebar-compact aside-menu-off-canvas aside-menu-hidden header-fixed" style="height: 100%;">
	<ol class="breadcrumb " id="breadcrumb">
	    <li class="breadcrumb-item ">
	        <a href="<?php echo base_url("usuarios"); ?>"><?php echo $usuario["usuario"]; ?></a>
	    </li>
	    <li class="breadcrumb-item active">
	        <a href="">Campañas</a>
	    </li>
	</ol>
	<div class="container-fluid">
		<div class="animated fadeIn">
			<h4>Campañas del año <?php setlocale(LC_ALL,"es_ES"); if(isset($campanas[0]["anio"])){echo $campanas[0]["anio"];}else{echo date("Y");}?>, mes de <?php if(isset($campanas[0]["mes"])){echo $campanas[0]["mes"];}else{echo strftime("%B");}?></h4>
			<?php
				if($usuario["id_perfil"]==5){
					$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
					$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
			?>
			<hr>
			<form method="POST" action="campanas" style=" width: 100%;">
				<div class="row">
					<div class="col-md-3">
						<div class="input-group">
							<span class='input-group-addon'><i class='mdi mdi-calendar-text'></i></span>
				                <select class='form-control select3' id='mstl_anio' name='mstl_anio' data-plugin='select3' >
				                        <option value=''>Buscar por Año</option>
				                        <?php foreach ($anio as $a) { 
				                            echo "  <option value='".$a['anio']."'>".$a['anio']."</option>";}?>
				                </select> 
						</div>
					</div>
					<div class="col-md-3">
						<div class="input-group">
							<span class='input-group-addon'><i class='mdi mdi-calendar-text'></i></span>
			                <select class='form-control select3' id='mstl_mes' name='mstl_mes' data-plugin='select3' >
			                        <option value=''>Buscar por Mes</option>
			                       	<option value='1'>Enero</option>
			                       	<option value='2'>Febrero</option>
			                       	<option value='3'>Marzo</option>
			                       	<option value='4'>Abril</option>
			                       	<option value='5'>Mayo</option>
			                       	<option value='6'>Junio</option>
			                       	<option value='7'>Julio</option>
			                       	<option value='8'>Agosto</option>
			                       	<option value='9'>Septiembre</option>
			                       	<option value='10'>Octubre</option>
			                       	<option value='11'>Noviembre</option>
			                       	<option value='12'>Diciembre</option>
			                </select>
						</div>
					</div>
					<div class="col-md-6">
						<button  type="submit" class="btn btn-outline-theme btn-sm" onclick="return Filtrar()"><i id="refsh" class='mdi mdi-search-web'></i>Buscar</button>
						<button  type="button" class="btn btn-outline-theme btn-sm" onclick="refrescar()"><i id="refsh" class='mdi mdi-filter-remove-outline'></i>Limpiar Búsqueda</button> 
						<a href="<?php echo base_url("usuarios"); ?>" class="btn btn-outline-theme btn-sm" ><i class='fa fa-mail-reply-all'></i>Volver</a>
						<button type="button" class="btn btn-theme btn-sm" onclick="agregarSuc();"><i class='fa fa-save'></i>Guardar</button>
					</div>
				</div>
            </form> 
                <hr>
				<form method="post" id="form6" style=" width: 100%;">
					<div class="row">
						<div class="col-md-12" id="campanias">
							<div id="loader" style="display: none;"></div>
							<div class="card-body sales-list">
								<input type="hidden" name="txt_usuariocampid"  value="<?php echo $usuario["id_usuario"]; ?>">
								<select class="form-group" id="lbl_campanas" style=" width: 100%;" name="lbl_campanas[]" multiple="multiple" >
									<?php
										foreach ($campanas as $c) {										
											foreach ($campanassel as $a){
												if($c["campana"]==$a["campana"]){
													if($c["id_cliente"]==$a["id_cliente"]){
														$selected="selected='selected'";
														break;
													} else {
														$selected="";
													}
												}
											}
											echo "<option value='".$c["id_campana"].",".$c["id_cliente"]."' data-section='".$c["campana"]."/".$c["region"]."/".$c["id_cliente"]."' ".$selected."  >".$c["id_cliente"]."</option>";									
										}
									?>
								</select>
							</div>
						</div>
					</div>
				</form>
			<?php
				} else {
			?>
				<form action="<?php echo base_url(); ?>usuarios/agregarcampana" method="post" id="form6" style=" width: 100%;">
					<div class="row">
						<div class="col-md-10">
							<input type="hidden" name="txt_usuariocampid"  value="<?php echo $usuario["id_usuario"]; ?>">
							<select class="form-group" id="lbl_campanas" style=" width: 100%;" name="lbl_campanas[]" multiple="multiple" >
								<?php
									foreach ($campanas as $c) {
										if($c["activo"]==1){
											foreach ($campanassel as $a){
												if($c["id_campana"]==$a["id_campana"]){
													$selected="selected";
													break;
												} else {
													$selected="";
												}
											}
											echo "<option value='".$c["id_campana"]."' ".$selected." >".$c["campana"]."</option>";
										}										
									}
								?>
							</select>
						</div>
						<div class="col-md-12">
							<div class='card-body'>
								<button type="submit" class="btn btn-theme btn-sm "><i class='fa fa-save'></i>Guardar</button>
							</div>
						</div>
					</div>
				</form>
			<?php 
				} 
			?>
		</div>
	</div>
</main>
<style type="text/css">
	.ms-container{
		width: 100%;
	}

	.title{
		font-size: 1rem !important;
		text-align: left;
		font-weight: normal;
		line-height:1.5;
	}

	div.tree-multiselect div.title {
		background: #f57c00;
	}
</style>
<script src="<?php echo  site_url(); ?>assets/js/libs/Alertify/js/alertify.js"></script>
<script type="text/javascript">


	$('.select2').select2({});
    $('.select3').select2({});

	<?php
		if($usuario["id_perfil"]==5){
	?>
		var params = { sortable: true, searchable: true, startCollapsed: true };
		$("#lbl_campanas").treeMultiselect(params);
	<?php 
		} else {
	?>
	$('#lbl_campanas').multiSelect({
		selectableHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='Campañas'>",
		selectionHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='Campañas Asignadas'>",
		afterInit: function(ms){
			var that = this,
			$selectableSearch = that.$selectableUl.prev(),
			$selectionSearch = that.$selectionUl.prev(),
			selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
			selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

			that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
			.on('keydown', function(e){
				if (e.which === 40){
					that.$selectableUl.focus();
					return false;
				}
			});

			that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
			.on('keydown', function(e){
				if (e.which == 40){
					that.$selectionUl.focus();
					return false;
				}
			});
		},
		afterSelect: function(){
			this.qs1.cache();
			this.qs2.cache();
		},
		afterDeselect: function(){
			this.qs1.cache();
			this.qs2.cache();
		}
	});
	<?php 
		} 
	?>

	function Filtrar(){
		var val=0;
		if ($("#mstl_anio").val()=='') {
			alertify.alert("Debe seleccionar el año");
			val=1;
			return false;
		}
		if (val==0) {
			$("#loader").removeAttr("style","table-loading-overlay");
	        var mstl_anio =$("#mstl_anio").val(); 
	        var mstl_mes =$("#mstl_mes").val(); 

	        // $.ajax({
	        //     url: "filtrar",
	        //     type: "POST",
	        //     data: 'mstl_anio='+mstl_anio+"&mstl_mes="+mstl_mes,
	        //     success: function(data){
	        //         $("#loader").attr("style","display:none;");
	        //         $("#campanias").html('');
	        //         $("#campanias").html(data);
	        //     }
	        // });
		}
        
    }

    function refrescar(){
        $("#refsh").attr('class','fa-spin fa fa-refresh');
        setTimeout(function(){
            window.location = "campanas";
        }, 1000); 
    }

    function agregarSuc(){
    	
    	$.ajax({
            url: "agregarsucursal",
            type: "POST",
            data: $('#form6').serialize(),
            success: function(data){
                alertify.alert("Se han asignado las campañas correctamente");
                setTimeout(function(){
                	window.location = "campanas";
		        }, 1000); 
            }
        });
    }

</script>