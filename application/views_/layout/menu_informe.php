<body class="app sidebar-fixed sidebar-compact aside-menu-off-canvas aside-menu-hidden header-fixed ">
	<header class="app-header navbar">
		
        <a class="navbar-brand" >
            <strong><img width="100%" src="<?php echo base_url("assets/css/logo.jpg");?>"></strong>
        </a>
        <ul class="nav navbar-nav ">
        	<li class="nav-item ">
        		<a class="text-theme" href="#">
                    <span class="hidden-xs"><?php echo strtoupper($nombre)."&nbsp;&nbsp;"; ?></span>
                </a>
        	</li>
        	<li class="nav-item ">
        		<a class="text-theme h5" href="<?php if($_SESSION["perfil"]==1){ echo base_url("informes/informes"); } else { echo base_url("informes/reporte"); } ?>" data-toggle="tooltip" data-placement="bottom" title="Informes" >
                     <i class="fa fa-dashboard"></i>
                </a>
        	</li>
        	<li class="nav-item ">
        		<a class="text-theme h5" href="<?php echo base_url("informes/fotografia"); ?>" data-toggle="tooltip" data-placement="bottom" title="Galeria Fotografica">
                    <i class="fa fa-camera"></i>
                </a>
        	</li>
        	<li class="nav-item ">
        		<a class="text-theme h5" href="<?php if($_SESSION["perfil"]==1){ echo base_url("informes/campanas"); } else { echo base_url("campanas"); }   ?>" data-toggle="tooltip" data-placement="bottom" title="Volver">
                    <i class="fa  fa-mail-reply"></i>
                </a>
        	</li>
        	<li class="nav-item">
        		<a class="text-theme h5"  href="<?php echo base_url("login");  ?>" data-toggle="tooltip" data-placement="bottom" title="Salir" >
                    <i class="fa fa-sign-out"></i>
                </a>
        	</li>
        </ul>
	</header>
</body>
<style type="text/css">
	.text-theme{
		color: #f57c00 !important;
	}
</style>
