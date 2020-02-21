<body class="app sidebar-fixed sidebar-compact aside-menu-off-canvas aside-menu-hidden header-fixed ">
	<header class="app-header navbar">
		<div class="hamburger hamburger--arrowalt-r navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto">
            <div class="hamburger-box">
                <div class="hamburger-inner"></div>
            </div>
        </div>
        <a class="navbar-brand" href="<?php echo base_url("home");  ?>">
            <strong><img width="100%" src="<?php echo base_url("assets/css/logo.jpg");?>"></strong>
        </a>
        <ul class="nav navbar-nav ">
        	<li class="nav-item ">
        		<a class="text-theme" href>
                    <span class="hidden-xs"><?php echo strtoupper($nombre)."&nbsp;&nbsp;"; ?></span>
                </a>
        	</li>
        	<li class="nav-item">
        		<a class="text-theme h4"  href="<?php echo base_url("login");  ?>" data-toggle="tooltip" data-placement="bottom" title="Salir" >
                    <span class="">
                        <i class="fa fa-sign-out"></i>
                    </span>
                </a>
        	</li>
        </ul>
	</header>
</body>
<style type="text/css">
    @media (max-width: 991px){
        .navbar .navbar-nav{
            top:62% !important;
        }
    }
</style>