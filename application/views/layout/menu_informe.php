<body class="app sidebar-fixed sidebar-compact aside-menu-off-canvas aside-menu-hidden header-fixed ">
	<header class="app-header navbar">
		
        <a class="navbar-brand logo1" href="<?php echo base_url("home");  ?>" style="padding:0.6rem;">
            <strong>
                <img  src="<?php echo base_url("assets/css/logo.jpg");?>">
            </strong>
        </a>
        <a class="navbar-brand logo2" style="padding:0.6rem;">
                 <strong>
                    <img   src="<?php echo base_url("assets/css/disecom-icon.png");?>">
                </strong> 
            </a>
        <ul class="nav navbar-nav ">
        	<li class="nav-item ">
        		<a class="text-theme h5" href="<?php  echo base_url("informes/reporte");  ?>" data-toggle="tooltip" data-placement="bottom" title="Informes" >
                     <i class="fa fa-dashboard"></i>
                </a>
        	</li>
        	<li class="nav-item ">
        		<a class="text-theme h5" href="<?php echo base_url("informes/galeria"); ?>" data-toggle="tooltip" data-placement="bottom" title="Galeria Fotografica">
                    <i class="fa fa-camera"></i>
                </a>
        	</li>
            <li class="nav-item ">
                <a class="text-theme h5" href="<?php echo base_url("informes/biblioteca"); ?>" data-toggle="tooltip" data-placement="bottom" title="Biblioteca">
                    <i class="fa fa-book"></i>
                </a>
            </li>
        	<li class="nav-item ">
        		<a class="text-theme h5" href="<?php  echo base_url("campanas");   ?>" data-toggle="tooltip" data-placement="bottom" title="Volver">
                    <i class="fa  fa-mail-reply"></i>
                </a>
        	</li>
          <?php
                if($_SESSION["perfil"]==0 || $_SESSION["perfil"]==4){
                    $manual=base_url("archivos/manuales/Manual_Gestor_Masterplan.pdf");
                    $nombrem="Manual_Gestor_Masterplan.pdf";
                } else if($_SESSION["perfil"]==1 && $_SESSION["id_empresa"]==9){
                    $manual=base_url("archivos/manuales/Manual_Cliente_Masterplan_P&G.pdf");
                    $nombrem="Manual_Cliente_Masterplan_P&G.pdf";
                } else if($_SESSION["perfil"]==1){
                    $manual=base_url("archivos/manuales/Manual_Cliente_Masterplan.pdf");
                    $nombrem="Manual_Cliente_Masterplan.pdf";
                }  else {
                    $manual=base_url("archivos/manuales/Manual_Progestion_Masterplan.pdf");
                    $nombrem="Manual_Progestion_Masterplan.pdf";
                }
            ?>
            <li class="nav-item ">
                <a class="text-theme h4" href="<?php  echo $manual; ?>" download="<?php  echo $nombrem; ?>" data-toggle="tooltip" data-placement="bottom" title="Manual" >
                     <i class="fa fa-address-book"></i>
                </a>
            </li>
        	<li class="nav-item dropdown">
                <a class="text-theme h4"  href="#" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"  >
                    <i class="fa fa-id-badge"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right user-menu animated flipInY">
                    <div class="wrap">
                        <div class="dw-user-box">
                            <div class="u-img">
                                 <i class="fa fa-user-circle-o"></i>
                            </div>
                            <div class="u-text">
                                <h6><?php echo strtoupper($nombre); ?></h6>
                                <a href="<?php echo base_url("login");  ?>" class="btn btn-sm btn-theme" data-toggle="tooltip" data-placement="bottom" title="Salir"><i class="fa fa-sign-out"></i></a>
                            </div>
                        </div>

                    </div>
                    <!-- end wrap -->
                </div>
            </li>
        </ul>
	</header>
</body>
<style type="text/css">
	.text-theme{
		color: #f57c00 !important;
	}
    
    @media (max-width: 991px){
        .breadcrumb{
            margin: 0 0 3.5rem 0;
        }

        .navbar .navbar-brand {
            margin-top: -25px;  
            /*top:62% !important;      */
        }

        .logo1 strong img{
            width:60% !important ;
            margin-left: -140px;
        }

        .logo2 strong img{
            width:45% !important ;
            margin-left: 140px;
        }

        .app-body {
            margin-top: 120px !important;
        }
    }


    .logo1 strong img{
        width:100% ;
    }

    .logo2 strong img{
        width:58% ;
    }

    .dw-user-box .u-img i {
        font-size: 4rem;
        padding-top: 0.2rem;
        padding-bottom: 0.2rem;
        color: #f57c00;
    }
</style>
