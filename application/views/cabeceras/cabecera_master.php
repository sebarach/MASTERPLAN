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
            <?php 
                for($i=0; $i<count($modulos); $i++) {
                    if($modulos[$i]=="Empresas"){
                        echo '<li class="nav-item">
                            <a class="text-theme h5"  href='.base_url("empresas").' data-toggle="tooltip" data-placement="bottom" title="Clientes" >
                                <span class="">
                                    <i class="fa fa-building-o"></i>
                                </span>
                            </a>
                        </li>';
                    } else if($modulos[$i]=="Clientes"){
                        echo '<li class="nav-item">
                            <a class="text-theme h5"  href='.base_url("clientes").' data-toggle="tooltip" data-placement="bottom" title="Formularios" >
                                <span class="">
                                    <i class="fa fa-cubes"></i>
                                </span>
                            </a>
                        </li>';
                    }  else if($modulos[$i]=="Solicitud_ot"){
                        if($_SESSION["perfil"]==2){
                            $url=base_url("home/interno");
                        } else {
                            $url=base_url("solicitudes_ot");
                        }
                        echo '<li class="nav-item">
                            <a class="text-theme h4"  href='.$url.' data-toggle="tooltip" data-placement="bottom" title="SOT" >
                                <span class="">
                                    <i class="mdi mdi-comment"></i>
                                </span>
                               
                            </a>
                        </li>';
                    } else if($modulos[$i]=="Motivos_Grupos"){
                        echo '<li class="nav-item">
                            <a class="text-theme h5"  href='.base_url("grupos_motivos").' data-toggle="tooltip" data-placement="bottom" title="Grupos Motivos" >
                                <span class="">
                                    <i class="fa  fa-tags"></i>
                                </span>
                            </a>
                        </li>';                         
                    } else if($modulos[$i]=="Tipos_Tareas"){
                        echo '<li class="nav-item">
                            <a class="text-theme h5"  href='.base_url("tareas").' data-toggle="tooltip" data-placement="bottom" title="Grupos Tareas" >
                                <span class="">
                                    <i class="fa fa-clipboard"></i>
                                </span>
                            </a>
                        </li>';                         
                    } else if($modulos[$i]=="Usuarios"){
                        echo '<li class="nav-item">
                            <a class="text-theme h5"  href='.base_url("usuarios").' data-toggle="tooltip" data-placement="bottom" title="Usuarios" >
                                <span class="">
                                    <i class="fa fa-users"></i>
                                </span>
                            </a>
                        </li>';                       
                    } else if($modulos[$i]=="Regiones"){
                        echo '<li class="nav-item">
                            <a class="text-theme h5"  href='.base_url("regiones").' data-toggle="tooltip" data-placement="bottom" title="Regiones" >
                                <span class="">
                                    <i class="fa fa-map-marker"></i>
                                </span>
                            </a>
                        </li>';                            
                    } else if($modulos[$i]=="UserLevels"){
                        echo '<li class="nav-item">
                            <a class="text-theme h5"  href='.base_url("perfiles").' data-toggle="tooltip" data-placement="bottom" title="Perfiles" >
                                <span class="">
                                    <i class="fa fa-gears"></i>
                                </span>
                            </a>
                        </li>';                          
                    }

                }

            ?>
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