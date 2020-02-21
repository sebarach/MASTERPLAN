<div class="modal fade" tabindex="-1" role="dialog" id="Modal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header"></div>
			<div class="modal-body">
				<p class="text-theme" ><?php echo $mensaje; ?></p>
			</div>
			<div class="modal-footer">
				<button type="button"  class="btn btn-theme"  onclick="<?php echo "window.location.href='".base_url("clientes")."'"; ?>" ><i class='fa fa-hand-o-left'></i>Volver </button>
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