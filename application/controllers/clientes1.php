<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class clientes extends CI_Controller {
	
	function __construct()
    {
        parent::__construct();
		 $this->load->library('upload');
		 //$this->load->library('imagify');
    }


	 function index(){ 

		if(isset($_SESSION["sesion"])){
			$data["modulos"]=$_SESSION["modulos"];
			$data["nombre"]=$_SESSION["nombre"];
			$this->load->model("cliente");
			$this->load->model("listar");
			$data["permisos"]=$this->listar->permisos($_SESSION["usuario"],'clientes');
			$data["campanas_cliente"]=$this->cliente->campanas($_SESSION["usuario"]);
			$this->load->view('contenido_gestor');
			$this->load->view('cabeceras/cabecera_master',$data);
			$this->load->view('layout/menu_master',$data);	
			$this->load->view('clientes/cliente_grid.php',$data);	
		} else {
			Redirect(base_url("login"), false);
		}
	}
	
	 function accion(){ 
	    $id_campana = $_POST["cam"];
		$this->load->model("cliente");
		$accion = array();
		$accion=$this->cliente->accion($id_campana);
		echo "<div class='form-group'><label for='lb_accion' class=''>Seleccionar Acción</label><select class='form-control' id='lb_accion' onchange='cliente();' > ";
		echo "<option value='0'>Seleccionar</option>";
		foreach($accion as $m){
			echo  "<option value='".$m['ID_Accion']."'>".$m['Accion']."</option>";
		}
		echo  "</select></div>";
	 }
	 
	 function cliente_buscar(){ 
	    $id_accion = $_POST["acc"];
	    $_SESSION["accion"]=$_POST["acc"];
		$id_campana =$_POST["cam"];
		$this->load->model("cliente");
		$cliente = array();
		$cliente=$this->cliente->cliente_buscar($id_accion,$id_campana,$_SESSION["usuario"]);
		echo "<div class='form-group'><label for='lb_cliente' >Seleccionar Sucursal</label><select class='form-control' id='lb_cliente' onchange='cliente_detalle();'> ";
		echo "<option value='0'>Seleccionar</option>";
		foreach($cliente as $m){
			echo  "<option value='".$m['unico']."'>".$m['Cliente']."</option>";
		}
		echo  "</select></div>
		<script>
			$('#lb_cliente').select2();	
		</script>";
	 }
	 
	 function cliente(){ 
	    $id_unico = $_POST["uni"];
		$this->load->model("cliente");
	    $cliente_detalle = array();
		$motivos_cliente = array();
		$cliente_detalle=$this->cliente->cliente_detalle($id_unico);
		$motivos_cliente=$this->cliente->motivos_cliente($id_unico);
		
		echo "<div class='row'>
			<div class='col-md-9'>
				<div class='card ecom-widget-sales'>
					<div class='card-body'>
						<ul>
							<li>Nombre Fantasia <span>".$cliente_detalle['Nombre_Fantasia']."</span></li>
							<li>Dirección <span>".$cliente_detalle['Direccion']."</span></li>
							<li>Ciudad <span>".$cliente_detalle['Ciudad']."</span></li>
							<li>Región <span>".$cliente_detalle['Region']."</span></li>
							<li>Fecha Programada <span>".$cliente_detalle['Fecha_Programada']."</span></li>
						</ul>
					</div>
				</div>
			</div>
		</div>";

		

		echo "<div class='row'>
			<div class='col-md-12'>
				<div class='card'>
					<div class='card-body text-theme'>
						<div class='row'>
							<div class='col-sm-3'>
								<div class='form-group' >
									<label  for='inputtxt_NombreRecepcion'>Fecha Implementaci&oacute;n</label>
									<input class='form-control c-datepicker-btn' type='text' id='txt_fechareal' name='txt_fechareal' style='background:white;' value='".$cliente_detalle['Fecha_Real']."' readonly>
								</div>
							</div>
							<div class='col-sm-3'>
								<input type='hidden' id='hd_idunico' name='hd_idunico' value='".base64_encode($cliente_detalle['id_unico'])."'>
								<div class='form-group'>
									<label  for='inputtxt_NombreRecepcion'>Implementador</label>
									<input class='form-control' type='text' id='txt_Nombreimplementador' name='txt_Nombreimplementador' value='".$cliente_detalle['Implementador']."' requerid>
								</div>
							</div>
							<div class='col-sm-3'>
								<div class='form-group'>
									<label  for='inputtxt_NombreRecepcion'>Rut Implementador</label>
									<input class='form-control' type='text' id='txt_rutimplementador' name='txt_rutimplementador'  placeholder='11111111-1' value='".$cliente_detalle['Implementador_Rut']."' requerid>
								</div>
							</div>
							<div class='col-sm-3'>
								<div class='form-group'>
									<label  for='inputlb_motivo'>Motivo</label>
									<select id='lb_motivo' name='lb_motivo' class='form-control'>
										<option value='0'>Seleccionar</option>";
									foreach($motivos_cliente as $m){
										if($m['ID_Motivo'] == $cliente_detalle['ID_Motivo']){
											echo "<option value='".$m['ID_Motivo']."' selected>".$m['Motivo']."</option>";
										}else{
											echo "<option value='".$m['ID_Motivo']."'>".$m['Motivo']."</option>";
										}
									}
									echo "</select>
								</div>
							</div>
							<div class='col-sm-3'>
								<div class='form-group'>
									<label  for='inputtxt_NombreRecepcion'>Nombre Qui&eacute;n Recepciona</label>
									<input class='form-control' type='text' id='txt_NombreRecepcion' name='txt_NombreRecepcion' value='".$cliente_detalle['Quien_Nombre']."' requerid>
								</div>
							</div>
							<div class='col-sm-3'>
								<div class='form-group'>
									<label  for='inputtxt_RutRecepcion'>Rut Qui&eacute;n Recepciona</label>
									<input class='form-control' maxlength='11' type='text' id='txt_RutRecepcion' name='txt_RutRecepcion'   value='".str_replace(".","",$cliente_detalle['Quien_Rut'])."'  placeholder='11111111-1' requerid>
								</div>
							</div>
							<div class='col-sm-3'>
								<div class='form-group'>
									<label  for='inputtxt_CargoRecepcion'>Cargo Qui&eacute;n Recepciona</label>
									<input class='form-control' type='text' id='txt_CargoRecepcion' name='txt_CargoRecepcion' value='".$cliente_detalle['Quien_Cargo']."' requerid>
								</div>
							</div>
							<div class='col-sm-10'>
								<div class='form-group'>
									<label >Observaci&oacute;n</label> 
									<textarea class='form-control' id='txt_Comentario' name='txt_Comentario'>".$cliente_detalle['comentario']."</textarea>
								</div>
							</div>
						</div>
					</div>
					<script>
						$('#txt_rutimplementador').validCampoFranz('0123456789k-'); 
	
						$('#txt_RutRecepcion').validCampoFranz('0123456789k-'); 
						
						$('#txt_rutimplementador').blur(function(){
							var rut=$('#txt_rutimplementador').val();
							if(rut!=''){
								if(!validar_rut(rut)){
									$('#txt_rutimplementador').val('');
								}
							}
						});
						
						$('#txt_RutRecepcion').blur(function(){
							var rut=$('#txt_RutRecepcion').val();
							if(rut!=''){
								if(!validar_rut(rut)){
									$('#txt_RutRecepcion').val('');
								}
							}
						});
						var picker = new MaterialDatetimePicker({})
					      .on('submit', function(d) {
					        $('#txt_fechareal').val(d.format('DD/MM/YYYY')); 
					      });

					    var el = document.querySelector('.c-datepicker-btn');
					    el.addEventListener('click', function() {
					      picker.open();
					    }, false);

						
						
					</script>
					<div class='card-footer'>
						<button type='submit' class='btn btn-outline-theme pull-right'><i class='mdi  mdi-send'></i>Siguiente</button>
					</div>
				</div>
			</div>
		</div>";		
	 }
	  
	 function cliente_implementacion(){ 
		if(isset($_SESSION["sesion"])){
			$this->load->model("cliente");
			$id_unico = base64_decode($_POST["hd_idunico"]);
			$cliente_name = $this->cliente->cliente_unico($id_unico);
			$fecha_real = $_POST["txt_fechareal"];
			$lb_motivo = $_POST["lb_motivo"];
			$Implementador = $_POST["txt_Nombreimplementador"];
			$ImplementadorRut = $_POST["txt_rutimplementador"];
			$NombreRecepcion = $_POST["txt_NombreRecepcion"];
			$RutRecepcion = $_POST["txt_RutRecepcion"];
			$CargoRecepcion = $_POST["txt_CargoRecepcion"];
			$comentario=str_replace("'","",$_POST["txt_Comentario"]);
			$id_usuario=$_SESSION["usuario"];
			if($fecha_real != '' || $NombreRecepcion != '' || $ImplementadorRut != ''){
				$this->load->model("cliente");
				$resp = $this->cliente->cliente_implementacion_insertar($id_unico,$fecha_real,$lb_motivo,$Implementador,$ImplementadorRut,$NombreRecepcion,$RutRecepcion,$CargoRecepcion,$comentario,$id_usuario);
				if($resp["mensaje"] == "OK"){
					$data["mensaje"]="Datos Guardados Correctamente";
					//$data["GetBack"]=1;
					foreach ($this->cliente->motivos_cliente($id_unico) as $mo) {
						if($mo["ID_Motivo"]==$lb_motivo){
							if($mo["exitoso"]==1){
								$data['productos'] = $this->cliente->listar_cliente_producto($id_unico);
								$data['motivos'] =  $this->cliente->motivos_materiales($id_unico);
							}
						}
					}					
					$data['campana'] = $this->cliente->listar_campana($id_unico);
					$data["fotos"]=	$this->cliente->fotos($id_unico);
					$data["nombre"]=$_SESSION["nombre"];
					$this->load->view('contenido_gestor');
					$this->load->view('cabeceras/cabecera_master',$data);
					$this->load->view('clientes/cliente_producto',$data);
				}else{
					$data["mensaje"]="hubo un problema al guardar los datos";
					$this->load->view('contenido_gestor');
					$this->load->view('alertas/alertas',$data);
				}
			}else{
				$data["mensaje"]="hubo un problema al guardar los datos";
				$this->load->view('contenido_gestor');
				$this->load->view('alertas/alertas',$data);
			}
		 }else{
			 redirect(base_url("login"));
		 }
	}
	
	
	public function subir_Foto($filename)
	{
			//$config = null;
		$foto1 ='file';
		$config['upload_path'] = "archivos/fotos/".$_SESSION["accion"];
		// $config['upload_path'] = "archivos/fotos/";
		$config['file_name'] =$filename;
		$config['allowed_types'] = "jpeg|jpg|png|pdf";
			//$config['max_size'] = "2097152";
		$config['max_width'] = "9500";
		$config['max_height'] = "9500";
		$config['overwrite'] = TRUE;

		$this->upload->initialize($config);

		if (!$this->upload->do_upload($foto1)) {
					//*** ocurrio un error
			$data['uploadError'] = $this->upload->display_errors();
			echo $this->upload->display_errors();
			return;
		}
		$data = $this->upload->data();
		$tamano = $data['file_size'];
		$ancho = $data['image_width'];
		$alto = $data['image_height'];
		if($tamano >= 20000 || $ancho >= 9500 || $alto >= 9500){
			$var = "2";
			return $var;
		}
		$config['image_library'] = 'gd2';  
		$config['source_image'] = 'archivos/fotos/'.$_SESSION["accion"].'/'.$data["file_name"];  
		$config['create_thumb'] = FALSE;  
		$config['maintain_ratio'] = FALSE;  
		$config['quality'] = '60%';  
		$config['width'] = 800;  
		$config['height'] = 600;  
		$config['new_image'] = 'archivos/fotos/'.$_SESSION["accion"].'/'.$data["file_name"];  
		$this->load->library('image_lib', $config); 
		$this->image_lib->clear();
		$this->image_lib->initialize($config);
		$this->image_lib->resize();  


		$nombre= $data['file_name'];
		return $nombre;
	}

	public function addFoto(){
		$this->load->model("cliente");
		$vacios=0;
		if((!isset($_POST["id_campana"])) || $_POST["id_campana"]==""){
			$vacios+=1;
		}
		if((!isset($_POST["id_accion"])) || $_POST["id_accion"]==""){
			$vacios+=1;
		}
		if((!isset($_POST["id_cliente"])) || $_POST["id_cliente"]==""){
			$vacios+=1;
		}
		if((!isset($_POST["nombre"])) || $_POST["nombre"]==""){
			$vacios+=1;
		}
		if(!isset($_POST["id"])){
			if(!isset($_FILES["file"])){
				$vacios+=1;
			}
		} 
		if($vacios!=0){
			echo "ERROR";
		} else {
			$id_campana=base64_decode($_POST["id_campana"]);
			$id_accion=base64_decode($_POST["id_accion"]);
			$id_cliente=base64_decode($_POST["id_cliente"]);
			$nombre=str_replace("'","",$_POST["nombre"]);	
			$foto="";					
			if(isset($_POST["id"])){
				$id=$_POST["id"];
				$nom_foto=$this->cliente->foto($id)["foto"];
				if(isset($_FILES["file"])){
					$foto=$this->subir_Foto($nom_foto);
				}  			
				$resp = $this->cliente->Editar_cliente_foto($id_campana,$id_accion,$id_cliente,$nombre,$foto,$id);
			} else {
				$nom_foto=date("dmYHis").$id_campana.$id_accion.$id_cliente.'_'.$_POST["nombre"];
				$foto=$this->subir_Foto($nom_foto);
				$resp = $this->cliente->Guardar_cliente_foto($id_campana,$id_accion,$id_cliente,$nombre,$foto);
			}
			if($resp['mensaje']=="OK"){
				echo "OK-".$resp["id_foto"];
			} else {
				echo "ERROR";
			}

		}
	}

	public function send_products(){
		$this->load->model("cliente");
		$vacios=0;
		if(!isset($_POST["txt_contmat"])){
			$vacios+=1;
		} else {
			$cont=$_POST["txt_contmat"];
			for($i=0;$i<$cont;$i++){
				if((!isset($_POST["hd_id_info_".$i])) || $_POST["hd_id_info_".$i]==""){
					$vacios+=1;
				}
				if((!isset($_POST["txt_implementado_".$i])) || $_POST["txt_implementado_".$i]==""){
					$vacios+=1;
				}
				if((!isset($_POST["id_motivo_".$i])) || $_POST["id_motivo_".$i]=="" || $_POST["id_motivo_".$i]=="0"){
					$vacios+=1;
				}
			}
		}
		if($vacios!=0){
			$data["mensaje"]="Los elementos no pudieron ser ingresados, intente nuevamente";
		} else {
			$cont=$_POST["txt_contmat"];
			for($i=0;$i<$cont;$i++){
				$unico=base64_decode($_POST["hd_id_info_".$i]);
				$implementado=$_POST["txt_implementado_".$i];
				$motivo=$_POST["id_motivo_".$i];
				$id_usuario=$_SESSION["usuario"];
				$resp = $this->cliente->Guardar_cliente_producto($unico,$motivo,$implementado,$id_usuario);
				if($resp["mensaje"]=="OK"){
					$data["mensaje"]="Los elementos fueron ingresados exitosamente";
				} else {
					$data["mensaje"]="Los elementos fueron ingresados exitosamente";
				}
			}
		}
		$this->load->view('contenido_gestor');
		$this->load->view('alertas/alertas_imp',$data);
	}

	public function product(){
		$this->load->model("cliente");
		$id=base64_decode($_POST["id"]);
		echo json_encode($this->cliente->foto($id));
	}

	public function deleteFoto(){
		$this->load->model("cliente");
		$id=base64_decode($_POST["id"]);
		if($this->cliente->validarfoto($id)["mensaje"]=='OK'){
			unlink("archivos/fotos/".$this->cliente->validarfoto($id)["foto"]);
		}
		echo json_encode($this->cliente->Eliminar_cliente_foto($id));
	}

	public function fotos(){
		$data["mensaje"]="Los elementos fueron ingresados exitosamente";
		$this->load->view('contenido_gestor');
		$this->load->view('alertas/alertas_imp',$data);
	}


		
	/*public function subir_Foto2($filename)
		{
			//$config = null;
			$foto2 ='txt_Foto2';
			$config['upload_path'] = "assets/images/";
			$config['file_name'] =$filename;
			$config['allowed_types'] = "jpeg|jpg|png|doc|docx|pdf";
			//$config['max_size'] = "2097152";
			$config['max_width'] = "9500";
			$config['max_height'] = "9500";
			$config['overwrite'] = TRUE;
			
			$this->upload->initialize($config);
			
			//$data = $this->load->library('upload', $config);
			
			
				if (!$this->upload->do_upload($foto2)) {
					//*** ocurrio un error
					$data['uploadError'] = $this->upload->display_errors();
					echo $this->upload->display_errors();
					return;
				}
			$data = $this->upload->data();

			$tamano = $data['file_size'];
			$ancho = $data['image_width'];
			$alto = $data['image_height'];
			       if($tamano >= 20000 || $ancho >= 9500 || $alto >= 9500){
					   $var = "2";
					   return $var;
				   }
			 $config['image_library'] = 'gd2';  
                     $config['source_image'] = 'assets/images/'.$data["file_name"];  
                     $config['create_thumb'] = FALSE;  
                     $config['maintain_ratio'] = FALSE;  
                     $config['quality'] = '60%';  
                     $config['width'] = 800;  
                     $config['height'] = 600;  
                     $config['new_image'] = 'assets/images/'.$data["file_name"];  
                     $this->load->library('image_lib', $config); 
					 $this->image_lib->clear();
					 $this->image_lib->initialize($config);
                     $this->image_lib->resize();  
			$nombre= $data['file_name'];
			return $nombre;
		}
	
	    	public function subir_Foto3($filename)
		{
			//$config = null;
			$foto3 ='txt_Foto3';
			$config['upload_path'] = "assets/images/";
			$config['file_name'] =$filename;
			$config['allowed_types'] = "jpeg|jpg|png|doc|docx|pdf";
			//$config['max_size'] = "2097152";
			$config['max_width'] = "9500";
			$config['max_height'] = "9500";
			$config['overwrite'] = TRUE;
			
			$this->upload->initialize($config);
			
			//$data = $this->load->library('upload', $config);

				if (!$this->upload->do_upload($foto3)) {
					//*** ocurrio un error
					$data['uploadError'] = $this->upload->display_errors();
					echo $this->upload->display_errors();
					return;
				}
			$data = $this->upload->data();
			$tamano = $data['file_size'];
			$ancho = $data['image_width'];
			$alto = $data['image_height'];
			       if($tamano >= 20000 || $ancho >= 9500 || $alto >= 9500){
					   $var = "2";
					   return $var;
				   }
			 $config['image_library'] = 'gd2';  
                     $config['source_image'] = 'assets/images/'.$data["file_name"];  
                     $config['create_thumb'] = FALSE;  
                     $config['maintain_ratio'] = FALSE;  
                     $config['quality'] = '60%';  
                     $config['width'] = 800;  
                     $config['height'] = 600;  
                     $config['new_image'] = 'assets/images/'.$data["file_name"];  
                     $this->load->library('image_lib', $config); 
					 $this->image_lib->clear();
					 $this->image_lib->initialize($config);					 
                     $this->image_lib->resize();  
			$nombre= $data['file_name'];
			return $nombre;
		}

	
		public function subir_Foto4($filename)
		{
			//$config = null;
			$foto4 ='txt_Foto4';
			$config['upload_path'] = "assets/images/";
			$config['file_name'] =$filename;
			$config['allowed_types'] = "jpeg|jpg|png|doc|docx|pdf";
			//$config['max_size'] = "2097152";
			$config['max_width'] = "9500";
			$config['max_height'] = "9500";
			$config['overwrite'] = TRUE;
			
			$this->upload->initialize($config);
			
			//$data = $this->load->library('upload', $config);

				if (!$this->upload->do_upload($foto4)) {
					//*** ocurrio un error
					$data['uploadError'] = $this->upload->display_errors();
					echo $this->upload->display_errors();
					return;
				}
			$data = $this->upload->data();
			$tamano = $data['file_size'];
			$ancho = $data['image_width'];
			$alto = $data['image_height'];
			       if($tamano >= 20000 || $ancho >= 9500 || $alto >= 9500){
					   $var = "2";
					   return $var;
				   }
			 $config['image_library'] = 'gd2';  
                     $config['source_image'] = 'assets/images/'.$data["file_name"];  
                     $config['create_thumb'] = FALSE;  
                     $config['maintain_ratio'] = FALSE;  
                     $config['quality'] = '60%';  
                     $config['width'] = 800;  
                     $config['height'] = 600;  
                     $config['new_image'] = 'assets/images/'.$data["file_name"];  
                     $this->load->library('image_lib', $config); 
					 $this->image_lib->clear();
					 $this->image_lib->initialize($config);
                     $this->image_lib->resize(); 
			$nombre= $data['file_name'];
			return $nombre;
		}

			public function subir_Foto5($filename)
		{
			//$config = null;
			$foto5 ='txt_Foto5';
			$config['upload_path'] = "assets/images/";
			$config['file_name'] =$filename;
			$config['allowed_types'] = "jpeg|jpg|png|doc|docx|pdf";
			//$config['max_size'] = "2097152";
			$config['max_width'] = "9500";
			$config['max_height'] = "9500";
			$config['overwrite'] = TRUE;
			
			$this->upload->initialize($config);
			
			//$data = $this->load->library('upload', $config);

				if (!$this->upload->do_upload($foto5)) {
					//*** ocurrio un error
					$data['uploadError'] = $this->upload->display_errors();
					echo $this->upload->display_errors();
					return;
				}
			$data = $this->upload->data();
			$tamano = $data['file_size'];
			$ancho = $data['image_width'];
			$alto = $data['image_height'];
			       if($tamano >= 20000 || $ancho >= 9500 || $alto >= 9500){
					   $var = "2";
					   return $var;
				   }
			 $config['image_library'] = 'gd2';  
                     $config['source_image'] = 'assets/images/'.$data["file_name"];  
                     $config['create_thumb'] = FALSE;  
                     $config['maintain_ratio'] = FALSE;  
                     $config['quality'] = '60%';  
                     $config['width'] = 800;  
                     $config['height'] = 600;  
                     $config['new_image'] = 'assets/images/'.$data["file_name"];  
                     $this->load->library('image_lib', $config);
					 $this->image_lib->clear();
					 $this->image_lib->initialize($config);					 
                     $this->image_lib->resize();  
			$nombre= $data['file_name'];
			return $nombre;
		}
		
			public function subir_Foto6($filename)
		{
			//$config = null;
			$foto6 ='txt_Foto6';
			$config['upload_path'] = "assets/images/";
			$config['file_name'] =$filename;
			$config['allowed_types'] = "jpeg|jpg|png|doc|docx|pdf";
			//$config['max_size'] = "2097152";
			$config['max_width'] = "9500";
			$config['max_height'] = "9500";
			$config['overwrite'] = TRUE;
			
			$this->upload->initialize($config);
			
			//$data = $this->load->library('upload', $config);

				if (!$this->upload->do_upload($foto6)) {
					//*** ocurrio un error
					$data['uploadError'] = $this->upload->display_errors();
					echo $this->upload->display_errors();
					return;
				}
			$data = $this->upload->data();
			$tamano = $data['file_size'];
			$ancho = $data['image_width'];
			$alto = $data['image_height'];
			       if($tamano >= 20000 || $ancho >= 9500 || $alto >= 9500){
					   $var = "2";
					   return $var;
				   }
			 $config['image_library'] = 'gd2';  
                     $config['source_image'] = 'assets/images/'.$data["file_name"];  
                     $config['create_thumb'] = FALSE;  
                     $config['maintain_ratio'] = FALSE;  
                     $config['quality'] = '60%';  
                     $config['width'] = 800;  
                     $config['height'] = 600;  
                     $config['new_image'] = 'assets/images/'.$data["file_name"];  
                     $this->load->library('image_lib', $config); 
					 $this->image_lib->clear();
					 $this->image_lib->initialize($config);
                     $this->image_lib->resize();  
			$nombre= $data['file_name'];
			return $nombre;
		}
		
		
			public function subir_Foto7($filename)
		{
			//$config = null;
			$foto7 ='txt_Foto7';
			$config['upload_path'] = "assets/images/";
			$config['file_name'] =$filename;
			$config['allowed_types'] = "jpeg|jpg|png|doc|docx|pdf";
			//$config['max_size'] = "2097152";
			$config['max_width'] = "9500";
			$config['max_height'] = "9500";
			$config['overwrite'] = TRUE;
			
			$this->upload->initialize($config);
			
			//$data = $this->load->library('upload', $config);

				if (!$this->upload->do_upload($foto7)) {
					//*** ocurrio un error
					$data['uploadError'] = $this->upload->display_errors();
					echo $this->upload->display_errors();
					return;
				}
			$data = $this->upload->data();
			$tamano = $data['file_size'];
			$ancho = $data['image_width'];
			$alto = $data['image_height'];
			       if($tamano >= 20000 || $ancho >= 9500 || $alto >= 9500){
					   $var = "2";
					   return $var;
				   }
			 $config['image_library'] = 'gd2';  
                     $config['source_image'] = 'assets/images/'.$data["file_name"];  
                     $config['create_thumb'] = FALSE;  
                     $config['maintain_ratio'] = FALSE;  
                     $config['quality'] = '60%';  
                     $config['width'] = 800;  
                     $config['height'] = 600;  
                     $config['new_image'] = 'assets/images/'.$data["file_name"];  
                     $this->load->library('image_lib', $config); 
					 $this->image_lib->clear();
					 $this->image_lib->initialize($config);
                     $this->image_lib->resize();  
			$nombre= $data['file_name'];
			return $nombre;
		}

			public function subir_Foto8($filename)
		{
			//$config = null;
			$foto8 ='txt_Foto8';
			$config['upload_path'] = "assets/images/";
			$config['file_name'] =$filename;
			$config['allowed_types'] = "jpeg|jpg|png|doc|docx|pdf";
			//$config['max_size'] = "2097152";
			$config['max_width'] = "9500";
			$config['max_height'] = "9500";
			$config['overwrite'] = TRUE;
			
			$this->upload->initialize($config);
			
			//$data = $this->load->library('upload', $config);

				if (!$this->upload->do_upload($foto8)) {
					//*** ocurrio un error
					$data['uploadError'] = $this->upload->display_errors();
					echo $this->upload->display_errors();
					return;
				}
			$data = $this->upload->data();
			$tamano = $data['file_size'];
			$ancho = $data['image_width'];
			$alto = $data['image_height'];
			       if($tamano >= 20000 || $ancho >= 9500 || $alto >= 9500){
					   $var = "2";
					   return $var;
				   }
			 $config['image_library'] = 'gd2';  
                     $config['source_image'] = 'assets/images/'.$data["file_name"];  
                     $config['create_thumb'] = FALSE;  
                     $config['maintain_ratio'] = FALSE;  
                     $config['quality'] = '60%';  
                     $config['width'] = 800;  
                     $config['height'] = 600;  
                     $config['new_image'] = 'assets/images/'.$data["file_name"];  
                     $this->load->library('image_lib', $config); 
					 $this->image_lib->clear();
					 $this->image_lib->initialize($config);
                     $this->image_lib->resize();  
			$nombre= $data['file_name'];
			return $nombre;
		}*/

      

	/* public function optimizar($archivo)
    {
        //$path = FCPATH.'public/';
		
        $options = array('resize'=>array("width"=>300));
        $handle = $this->imagify->optimize($archivo, $options);
        if (true === $handle->success)
        {
            $image_data = file_get_contents($handle->image);
            file_put_contents($archivo, $image_data);
            echo '<h1>Imagen optimizada!</h1>';
        } else
        {
            echo '<h1>Error: ' . $handle->message . '</h1>';
        }
    } 
	public function optimizar($archivo){
		
        $config['allowed_types']        = 'gif|jpg|png';
		$config['source_image']         = './assets/images/'.$archivo;
        //$config['max_size']             = 100;
		$this->load->library('upload', $config);
		 if(!$this->upload->do_upload('image_file'))  
                {  
                     echo $this->upload->display_errors();  
                }  
                else  
                {  
                     $data = $this->upload->data();  
                     $config['image_library']  = 'gd2';  
                     $config['upload_path']    = './assets/images/';
                     $config['create_thumb'] = FALSE;  
                     $config['maintain_ratio'] = FALSE;  
                     $config['quality'] = '60%';  
                     $config['width'] = 800;  
                     $config['height'] = 600;  
                     $config['new_image'] = './assets/images/';  
                     $this->load->library('image_lib', $config);  
                     $this->image_lib->resize();  
					 return true;
                     //echo '<img src="'.base_url().'upload/'.$data["file_name"].'" width="300" height="225" class="img-thumbnail" />';  
                }  
		

	}*/
}
?>