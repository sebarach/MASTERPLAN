
<div class="app-body">
	<div class="sidebar sidebar-colored" id="sidebar">
		<nav class="sidebar-nav" id="sidebar-nav-scroller">
			<ul class="nav">
				<?php 
					for($i=0; $i<count($modulos); $i++) {
						if($modulos[$i]=="Empresas"){
							echo "<li class='nav-item nav-dropdown'><a class='nav-link' href='".base_url("empresas")."'><i class='fa fa-building-o'></i>Clientes</a></li>";
						} else if($modulos[$i]=="Clientes"){
							echo "<li class='nav-item nav-dropdown'><a class='nav-link' href='".base_url("clientes")."'><i class='fa fa-cubes'></i>Formularios</a></li>";
						} else if($modulos[$i]=="Motivos_Grupos"){
							echo "<li class='nav-item nav-dropdown'><a class='nav-link' href='".base_url("grupos_motivos")."'><i class='fa  fa-tags'></i>Grupos Motivos</a></li>";							
						} else if($modulos[$i]=="Regiones"){
							echo "<li class='nav-item nav-dropdown'><a class='nav-link' href='".base_url("regiones")."'><i class='fa fa-map-marker'></i>". $modulos[$i]."</a></li>";							
						} else if($modulos[$i]=="Usuarios"){
							echo "<li class='nav-item nav-dropdown'><a class='nav-link' href='".base_url("usuarios")."'><i class='fa fa-users'></i>". $modulos[$i]."</a></li>";							
						} else if($modulos[$i]=="UserLevels"){
							echo "<li class='nav-item nav-dropdown'><a class='nav-link' href='".base_url("perfiles")."'><i class='fa fa-gears'></i>Perfiles</a></li>";							
						}
					}
				?>
			</ul>
		</nav>
	</div>
</div>