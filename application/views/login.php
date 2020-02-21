
	<body>
		<section class="container-pages">
			<div class="card pages-card col-lg-4 col-md-6 col-sm-6">
				<div class="card-body ">
					<div class="h4 text-center text-theme"><img width="90%" src="<?php echo base_url("assets/css/logo.jpg");?>"></div>
					<div class="small h6 text-center text-dark">Iniciar Sesi&oacute;n</div>
					<form method="post" action="<?php echo base_url("home"); ?>" >
						<div class="form-group">
							<div class="input-group">
								<div class="input-group">
	                                 <span class="input-group-addon text-theme"><i class="fa fa-user"></i> 
	                                </span>
	                                <input type="text" id="txt_username" name="txt_username" class="form-control" placeholder="Nombre de Usuario">
	                            </div>
							</div>
						</div>
						<div class="form-group">
	                        <div class="input-group">
	                            <span class="input-group-addon text-theme"><i class="fa fa-asterisk"></i></span>
	                           	<input type="password" id="txt_password" name="txt_password" class="form-control" placeholder="Contraseña">
	                       	</div>
	                    </div>
	                   	<div class="form-group form-actions">
	                        <button type="submit" class="btn  btn-theme login-btn ">   Iniciar Sesi&oacute;n   </button>
	                    </div>
					</form>
					<div class="text-center">
						<small class="text-theme"><a  data-toggle='modal' data-target='#modalpass' onclick="limpiar('login');" >Recuperar Contraseña</a></small>
					</div>
				</div>
			</div>
		</section>
		<div id="mybutton">
			<div class="btn-group dropup ">
				<a class="navbar-brand logo2" style="padding:0.6rem;">
	                 <strong>
	                    <img  width="40%" class="pull-right"  src="<?php echo base_url("assets/css/disecom-icon.png");?>">
	                </strong> 
	            </a>
			</div>			
		</div>
	</body>
	<div class="modal fade" id="modalpass"  role="dialog"  aria-hidden="true">
		<div class="modal-dialog" role="document">
			 <form class="modal-content "  method="post" action="<?php echo base_url("home/recovery"); ?>" onsubmit="return valida_form('login');">
			 	<div class="modal-header bg-primary">
	                <h6 class="modal-title text-white">Recuperar Contraseña</h6>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">×</span>
	               </button>
	            </div>
	            <div class="modal-body">
	            	<div class="row">
	            		<div class="col-md-12">
	            			<p>Para recuperar contraseña debe ingresar cliente, usuario y correo corporativo.</p>
	            		</div>
	            		<div class="col-md-12">
	            			<div class="form-group">
	            				<div class="input-group">
		                            <span class="input-group-addon text-theme"><i class="fa fa-user-circle"></i></span>
		                           	<input type="text" id="txt_nombreusuario" name="txt_nombreusuario" class="form-control" placeholder="Usuario">
		                       	</div>
	            			</div>
	            		</div>
	            		<div class="col-md-12">
	            			<div class="form-group">
	            				<div class="input-group">
		                            <span class="input-group-addon text-theme"><i class="fa fa-envelope"></i></span>
		                           	<input type="text" id="txt_correo" name="txt_correo" class="form-control" placeholder="Correo">
		                       	</div>
	            			</div>
	            		</div>
	            	</div>
	            </div>
	            <div class="modal-footer">
	            	<button type="submit" class="btn btn-theme">Enviar Correo</button>
	            </div>
			 </form>
		</div>
	</div>
<style type="text/css">
    @media (max-width: 991px){
   

        .logo2 strong img{
            width:45% !important ;
            margin-left: 140px;
        }

    }



    .logo2 strong img{
        width:20% ;
    }

    
    small {
    	font-weight: 600;
    	text-transform: uppercase;
    	cursor: pointer;
    }
</style>
 <script src="<?php echo base_url("assets/js/select2.full.min.js");?>"></script>
<link rel="stylesheet" href="<?php echo base_url("assets/css/select2.min.css")?>">
<script type="text/javascript">
	// $(document).ready(function() {
	// 	$("#lb_empresa").hide();
	// 	$("#lb_empresa").select2({
	// 		ajax:{
	// 			url:"<?php echo base_url("empresas/listempresas"); ?>",
	// 			dataType:"json",
	// 			delay: 350,
	// 			processResults: function (data) {
	// 				return {
	// 					results: $.map(data, function(obj) {
	// 						return { id: obj.id_empresa, text: obj.empresa };
	// 					})
	// 				};
	// 			},
	// 			cache: true
	// 		}
	// 	});
	// });
</script>
