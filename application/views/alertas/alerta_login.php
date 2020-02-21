<?php

switch ($tipo) {
	case 1:
		$mensaje="El o los campos Nombre de Usuario y Contraseña no deben estar vacíos, intente nuevamente";
		break;
	case 2:
		$mensaje="Nombre de Usuario y/o Contraseña incorrectos, intente nuevamente.";
		break;
	case 3:
		$mensaje="El Nombre de Usuario ingresado desactivado, cont&aacute;ctese con el administrador";
		break;
}
?>
<div class="modal fade" tabindex="-1" role="dialog" id="Modal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content ">
			<div class="modal-header"></div>
			<div class="modal-body">
				<p class="text-theme"><?php echo $mensaje; ?></p>
			</div>
			<div class="modal-footer">
				<a  class="btn btn-theme" href="<?php echo base_url("login"); ?>" >VOLVER AL INICIO</a>
			</div>	
		</div>
	</div>
</div>

<script>
    $("#Modal").on("show", function() {    
        $("#Modal a.btn").on("click", function(e) { 
            $("#Modal").modal('hide');     
        });
    });
    $("#Modal").on("hide", function() {    
        $("#Modal a.btn").off("click");
    });
    
    $("#Modal").on("hidden", function() {  
        $("#Modal").remove();
    });
    
    $("#Modal").modal({                    
      "backdrop"  : "static",
      "keyboard"  : true,
      "show"      : true                     
    });


</script>