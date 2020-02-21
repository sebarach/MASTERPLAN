
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
				</div>
			</div>
		</section>
	</body>
