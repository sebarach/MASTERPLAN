<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>DETALLE OT N° <?php echo $solicitud[0]["id_solicitud"];?></title>
      <style>
        .app{
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        html, body {
            height: 100%;
        }
        body {
            -moz-osx-font-smoothing: grayscale;
            -webkit-font-smoothing: antialiased;
            font-family: "Josefin Sans", sans-serif;
            background: #F8FBFF;
            color: #678898;
            margin: 0;
            font-size: 0.7rem;
            font-weight: 400;
            line-height: 1.5;
            text-align: left;
            background-color: #F8FBFF;
        }

        .app-body {
            display: flex;
            flex-direction: row;
            flex-grow: 1;
            overflow-x: hidden;
            margin-top: 60px;
        }

        .container-fluid {
          width: 100%;
          padding-right: 15px;
          padding-left: 15px;
          margin-right: auto;
          margin-left: auto;
        }
        .fadeIn {
            -webkit-animation-name: fadeIn;
            animation-name: fadeIn;
        }

        .animated {
            -webkit-animation-duration: 1s;
            animation-duration: 1s;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
        }

        div {
            display: block;
        }

        .text-theme {
            color: #f57c00;
        }

        h4 {
          color: #536c79;
          font-weight: 800;
          text-transform: uppercase;
          font-size: 1.8rem;
          font-family: inherit;
          line-height: 1.2;
          margin-bottom: 0.8rem;
        }

        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            -ms-overflow-style: -ms-autohiding-scrollbar;
        }

        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
        }

        table {
            border-collapse: collapse;
            display: table;
            border-spacing: 2px;
            border-color: grey;
        }

        .color-bordered-table.primary-bordered-table {
            border: 2px solid #f57c00;
        }

        tbody {
            display: table-row-group;
            vertical-align: middle;
            border-color: inherit;
        }

        th {
            font-weight: bold;
            text-align: -internal-center;
            vertical-align: text-top;
        }

        td, th {
            display: table-cell;
            vertical-align: text-top;
        }

        .table th, .table td {
            padding: 0.65rem;
            vertical-align: top;
            border-top: 1px solid #c2cfd6;
        }

        .color-bordered-table.primary-bordered-table tbody th {
            background-color: #f57c00;
            color: #fff;
        }

        .table tbody th {
            vertical-align: bottom;
            border-bottom: 2px solid #c2cfd6;
        }

        tr {
            display: table-row;
            vertical-align: baseline;
            border-color: inherit;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .col-1, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-10, .col-11, .col-12, .col, .col-auto, .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm, .col-sm-auto, .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12, .col-md, .col-md-auto, .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg, .col-lg-auto, .col-xl-1, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl, .col-xl-auto {
            position: relative;
            width: 100%;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }

        .col-md-9 {
            flex: 0 0 85%;
            max-width: 85%;
        }

      .col-md-6 {
          flex: 0 0 50%;
          max-width: 50%;
      }

      .app-header.navbar {
          position: fixed;
          flex-direction: row;
          height: 60px;
          padding: 0;
          margin: 0;
          background-color: #fff;
          -webkit-box-shadow: 0px 0px 20px -4px #678898;
          -moz-box-shadow: 0px 0px 20px -4px #678898;
          box-shadow: 0px 0px 20px -4px #678898;
      }

      .app-header {
          position: fixed;
          z-index: 1020;
          width: 100%;
      }
      .app-header, .app-footer, .sidebar, .main, .aside-menu {
          transition: margin-left 0.25s, margin-right 0.25s, width 0.25s, flex 0.25s;
          -webkit-transition: margin-left 0.25s, margin-right 0.25s, width 0.25s, flex 0.25s;
      }
      .app-header {
          flex: 0 0 60px;
          -webkit-flex: 0 0 60px;
      }
      .navbar {
          position: relative;
          display: flex;
          flex-wrap: wrap;
          align-items: center;
          justify-content: space-between;
          padding: 0.5rem 1rem;
      }

      .app-header.navbar .navbar-brand {
          display: inline-block;
          width: 250px;
          height: 60px;
          padding: 15px 1rem;
          margin-right: 0;
          text-align: center;
          background-color: white;
          color: #f57c00;
          font-size: 1.6rem;
          font-family: "Josefin Sans", sans-serif;
      }

      .navbar-brand {
        color: #29363d;
        border: none !important;
      }

      .navbar-brand {
          display: inline-block;
          padding-top: 0.3125rem;
          padding-bottom: 0.3125rem;
          margin-right: 1rem;
          font-size: 1.25rem;
          line-height: inherit;
          white-space: nowrap;
      }
      </style>
  </head>
  <body >
     <!-- <div class="col-md-12 app-header navbar">
      <a class="navbar-brand " >
        <strong>
          <img  src="<?php echo "data:image/jpeg;base64,".base64_encode(file_get_contents(base_url("assets/css/logo.jpg")));?>" style="width:85%;" >
        </strong>
      </a>
      <a class="navbar-brand" >
        <strong>
          <img   src="<?php echo "data:image/jpeg;base64,".base64_encode(file_get_contents(base_url("assets/css/disecom-icon.png")));?>" style="width:60%; " >
        </strong>
      </a>
    </div> -->
  <div class="app-body">
      <div class="container-fluid">
        <div class="animated fadeIn">
          <div class="row">
            <div class="col-md-12">
              <h4>Detalle ot n° <?php echo $solicitud[0]["id_solicitud"];?></h4>
            </div>
          </div>
          <div class="row">
              <div class="col-md-9">
                <div class="table-responsive">
                  <table class="table color-bordered-table primary-bordered-table">
                    <tbody>
                      <tr><th >CLIENTE</th><td><?php echo $solicitud[0]["empresa"];?></td></tr>
                      <tr><th >CAMPAÑA</th><td><?php echo $solicitud[0]["campana"];?></td></tr>
                      <tr><th >ESTADO OT</th><td><?php echo $solicitud[0]["estado"];?></td></tr>                      
                      <tr><th >SOLICITANTE</th><td><?php echo $solicitud[0]["nom_solicitante"].$solicitud[0]["correo_solicitante"];?></td></tr>
                      <tr><th >FECHA REGISTRO</th><td><?php echo $solicitud[0]["fecha_registro"];?></td></tr>
                      <tr><th >CADENA</th><td><?php echo $solicitud[0]["cadena"];?></td></tr>
                      <tr><th >LOCAL</th><td><?php echo $solicitud[0]["local"];?></td></tr>
                      <tr><th >DIRECCIÓN LOCAL</th><td><?php echo $solicitud[0]["direccion"].', '.$solicitud[0]["ciudad"]; ?></td></tr>
                      <tr><th style="vertical-align: text-top;">TIPO TAREA</th><td><?php echo $solicitud[0]["tipo_tarea"]; ?></td></tr>
                      <tr><th >RESPONSABLE</th><td><?php echo $solicitud[0]["usuario"].$solicitud[0]["correo_usuario"];?></td></tr>
                      <tr><th >ASUNTO</th><td><?php echo $solicitud[0]["asunto"];?></td></tr>
                      <tr><th >COMENTARIO</th><td><?php echo $solicitud[0]["comentario"];?></td></tr>
                      <tr><th >FECHA CIERRE REAL</th><td><?php echo $solicitud[0]["fecha_estimada"];?></td></tr>
                      <tr><th >FECHA CIERRE</th><td><?php echo $solicitud[0]["fecha_cierre"];?></td></tr>
                     

                      <!-- <tr><th style="vertical-align: text-top;" >ARCHIVO ADJUNTO</th><td><?php echo $solicitud[0]["adjunto"];?></td></tr> -->
                    </tbody>
                  </table>
                </div> 
              </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
