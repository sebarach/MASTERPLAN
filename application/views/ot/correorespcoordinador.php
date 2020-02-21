<!DOCTYPE html>
<html>
	<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1 user-scalable=no">
	</head>
	<body  style="height: 100%; -webkit-font-smoothing: antialiased; font-family: 'Josefin Sans', sans-serif;  margin: 0; font-size: 0.7rem; font-weight: 400; line-height: 1.5; text-align: left; ">
		<div style="display: flex; flex-wrap: wrap; position: relative;  width: 100%;  min-height: 1px; padding-right: 15px; padding-left: 15px;">
			<div style="flex: 1 1 auto; padding: 1.25rem !important; background-color: #f57c00; ">
				<h3 style='color:white; font-weight: 800;'>Respuesta Coordinador OT N° <?php echo $data[0]["id_solicitud"]; ?></h3>
			</div>
			
		</div>
		<table style=" display: flex;  flex-wrap: wrap;  margin-right: -15px; margin-left: -15px;">
			<tr style=" position: relative;  width: 100%; min-height: 1px; padding-right: 15px; padding-left: 15px; display: flex;  flex-direction: column; min-width: 0;  word-wrap: break-word;  background-clip: border-box; flex: 1 1 auto;  padding: 0.6rem;">
				<td style="display: block; margin-block-start: 1em;  color:#678898;  margin-block-end: 1em;  margin-inline-start: 0px;  margin-inline-end: 0px;">
					Estimado(a), el coordinador designado ha respondido a su orden de trabajo. A continuación, se detalla la información:
				</td>
			</tr>
			<tr style="position: relative;  width: 100%; min-height: 1px; padding-right: 15px; padding-left: 15px; display: flex;  flex-direction: column; min-width: 0;  word-wrap: break-word;  background-clip: border-box; flex: 1 1 auto;  padding: 0.6rem;">
				<td style="margin-bottom: 0.6rem;">
					<ul style="display: block;  list-style-type: none; margin-block-start: 1em; margin-block-end: 1em;  margin-inline-start: 0px; margin-inline-end: 0px; padding-inline-start: 40px;">
						<li style="text-align: -webkit-match-parent; display: list-item; margin-bottom: 5px; font-size: 0.75rem; color:#678898;">Coordinador Responsable: 
							<span style="float: right; font-weight: 600; color: #f57c00 !important; display: block;  width: 100%; word-wrap: break-word; margin-bottom: 0.3rem; font-size: 0.75rem;"><?php echo $data[0]["usuario"];?></span>
						</li>
						<li style="text-align: -webkit-match-parent; display: list-item; margin-bottom: 5px; font-size: 0.75rem; color:#678898;">Campaña: 
							<span style="float: right; font-weight: 600; color: #f57c00 !important; display: block;  width: 100%; word-wrap: break-word; margin-bottom: 0.3rem; font-size: 0.75rem;"><?php echo $data[0]["campana"];?></span>
						</li>
						<li style="text-align: -webkit-match-parent; display: list-item; margin-bottom: 5px; font-size: 0.75rem; color:#678898;">Cadena: 
							<span style="float: right; font-weight: 600; color: #f57c00 !important; display: block;  width: 100%; word-wrap: break-word; margin-bottom: 0.3rem; font-size: 0.75rem;"><?php echo $data[0]["cadena"];?></span>
						</li>
						<li style="text-align: -webkit-match-parent; display: list-item; margin-bottom: 5px; font-size: 0.75rem; color:#678898;">Local: 
							<span style="float: right; font-weight: 600; color: #f57c00 !important; display: block;  width: 100%; word-wrap: break-word; margin-bottom: 0.3rem; font-size: 0.75rem;"><?php echo $data[0]["local"];?></span>
						</li>
						<li style="text-align: -webkit-match-parent; display: list-item; margin-bottom: 5px; font-size: 0.75rem; color:#678898;">Estado: 
							<span style="float: right; font-weight: 600; color: #f57c00 !important; display: block;  width: 100%; word-wrap: break-word; margin-bottom: 0.3rem; font-size: 0.75rem;"><?php echo $data[0]["estado"];?></span>
						</li>
						<li style="text-align: -webkit-match-parent; display: list-item; margin-bottom: 5px; font-size: 0.75rem; color:#678898;">Fecha Estimada: 
							<span style="float: right; font-weight: 600; color: #f57c00 !important; display: block;  width: 100%; word-wrap: break-word; margin-bottom: 0.3rem; font-size: 0.75rem;"><?php echo $data[0]["fecha_estimada"];?></span>
						</li>
						<li style="text-align: -webkit-match-parent; display: list-item; margin-bottom: 5px; font-size: 0.75rem; color:#678898;">Respuesta: 
							<span style="float: right; font-weight: 600; color: #f57c00 !important; display: block;  width: 100%; word-wrap: break-word; margin-bottom: 0.3rem; font-size: 0.75rem;"><?php echo $data[0]["respuesta_coordinador"];?></span>
						</li>
						</ul>
					</td>
			</tr>
			<tr style="position: relative;  width: 100%; min-height: 1px; padding-right: 15px; padding-left: 15px; display: flex;  flex-direction: column; min-width: 0;  word-wrap: break-word;  background-clip: border-box; flex: 1 1 auto;  padding: 0.6rem; margin-bottom: 0.7rem;">
				<td style="display: block; margin-block-start: 1em;  color:#678898;  margin-block-end: 1em;  margin-inline-start: 0px;  margin-inline-end: 0px;">
					Para revisar en detalle la orden, debe ingresar a <a href="<?php echo site_url(); ?>"><?php echo site_url(); ?>
				</td>
			</tr>
			<tr style="position: relative;  width: 100%; min-height: 1px; padding-right: 15px; padding-left: 15px; display: flex;  flex-direction: column; min-width: 0;  word-wrap: break-word;  background-clip: border-box; flex: 1 1 auto;  padding: 0.6rem;">
				<td style="display: block; margin-block-start: 1em;  color:#678898;  margin-block-end: 1em;  margin-inline-start: 0px;  margin-inline-end: 0px;">
					Atentamente,<br>Plataforma Master Plan
				</td>
			</tr>
		</table>
		
	</body>
</html>
		