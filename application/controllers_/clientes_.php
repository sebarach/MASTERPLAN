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
			$this->load->view('contenido');
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
		$id_campana =$_POST["cam"];
		$this->load->model("cliente");
		$cliente = array();
		$cliente=$this->cliente->cliente_buscar($id_accion,$id_campana);
		echo "<div class='form-group'><label for='lb_cliente' >Seleccionar Sucursal</label><select class='form-control' id='lb_cliente' onchange='cliente_detalle();'> ";
		echo "<option value='0'>Seleccionar</option>";
		foreach($cliente as $m){
			echo  "<option value='".$m['unico']."'>".$m['Cliente']."</option>";
		}
		echo  "</select></div>";
	 }
	 
	 function cliente(){ 
	    $id_unico = $_POST["uni"];
		$this->load->model("cliente");
	    $cliente_detalle = array();
		$motivos_cliente = array();
		$cliente_detalle=$this->cliente->cliente_detalle($id_unico);
		$motivos_cliente=$this->cliente->motivos_cliente($id_unico);
		
		echo "
			<div class='table-responsive'>
				<table class='table'>
					<tbody>
						<tr>
							<td class='document'>
								<a>
									<div class='heading'>".$cliente_detalle['ID_Cliente']."</div>
									<p class='description text-theme'>Sucursal</p>
								</a>
							</td>
							<td class='document'>
								<a>
									<div class='heading'>".$cliente_detalle['Nombre_Fantasia']."</div>
									<p class='description text-theme'>Nombre Fantasía</p>
								</a>
								<input class='form-control ' type='hidden' id='txt_Nombre_Fantasia' name='txt_Nombre_Fantasia' value='".$cliente_detalle['Nombre_Fantasia']."' readonly>
								<input type='hidden' id='hd_idunico' name='hd_idunico' value='".$cliente_detalle['id_unico']."'>
							</td>
							<td class='document'>
								<a>
									<div class='heading'>".$cliente_detalle['Direccion']."</div>
									<p class='description text-theme'>Dirección</p>
								</a>
								<input class='form-control' type='hidden' id='txt_Direccion' name='txt_Direccion' value='".$cliente_detalle['Direccion']."'  readonly>
							</td>
							<td class='document'>
								<a>
									<div class='heading'>".$cliente_detalle['Ciudad']."</div>
									<p class='description text-theme'>Ciudad</p>
								</a>
								<input class='form-control' type='hidden' id='txt_Ciudad' name='txt_Ciudad' value='".$cliente_detalle['Ciudad']."' readonly>
							</td>
							<td class='document'>
								<a>
									<div class='heading'>".$cliente_detalle['Region']."</div>
									<p class='description text-theme'>Región</p>
								</a>
								<input class='form-control' type='hidden' id='txt_Region' name='txt_Region' value='".$cliente_detalle['Region']."' readonly>
							</td>
							<td class='document'>
								<a>
									<div class='heading'>".$cliente_detalle['Fecha_Programada']."</div>
									<p class='description text-theme'>Fecha Programada</p>
								</a>
								<input class='form-control' type='hidden' id='txt_Fecha_Programada' name='txt_Fecha_Programada' value='".$cliente_detalle['Fecha_Programada']."' readonly>
							</td>
						</tr>
					</tbody>
				</table>
			</div>";

		echo "<div class='row'>
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
					<label  for='inputtxt_NombreRecepcion'>Nombre Quien Recepciona</label>
					<input class='form-control' type='text' id='txt_NombreRecepcion' name='txt_NombreRecepcion' value='".$cliente_detalle['Quien_Nombre']."' requerid>
				</div>
			</div>
			<div class='col-sm-3'>
				<div class='form-group'>
					<label  for='inputtxt_RutRecepcion'>Rut Quien Recepciona</label>
					<input class='form-control' maxlength='11' type='text' id='txt_RutRecepcion' name='txt_RutRecepcion'   value='".$cliente_detalle['Quien_Rut']."' requerid>
				</div>
			</div>
			<div class='col-sm-3'>
				<div class='form-group'>
					<label  for='inputtxt_CargoRecepcion'>Cargo Quien Recepciona</label>
					<input class='form-control' type='text' id='txt_CargoRecepcion' name='txt_CargoRecepcion' value='".$cliente_detalle['Quien_Cargo']."' requerid>
				</div>
			</div>
		</div>";
		echo "<div class='row'>
			<div class='col-sm-9'>
				<div class='form-group'>
					<label>Observacion</label> 
					<textarea class='form-control' id='txt_Comentario' name='txt_Comentario'>".$cliente_detalle['comentario']."</textarea>
				</div>
			</div>
		</div>";
		echo "<div class='row'>
			<div class='col-sm-2'>
				<div class='card'>
					<div class='card-body'>
						<button type='submit' class='btn btn-outline-theme pull-right'><i class='mdi  mdi-send'></i>Siguiente</button>
					</div>
				</div>
			</div>
		</div>";
		
	 }
	  
	 function cliente_implementacion(){ 
		if(isset($_SESSION["sesion"])){
			$this->load->model("cliente");
			$id_unico = $_POST["hd_idunico"];
			$cliente_name = $this->cliente->cliente_unico($id_unico);
			$fecha_real = date("d-m-Y");
			$lb_motivo = $_POST["lb_motivo"];
			$Implementador = $this->cliente->implementador($_SESSION["usuario"])["nombre"];
			$ImplementadorRut = $this->cliente->implementador($_SESSION["usuario"])["rut"];
			$NombreRecepcion = $_POST["txt_NombreRecepcion"];
			$RutRecepcion = $_POST["txt_RutRecepcion"];
			$CargoRecepcion = $_POST["txt_CargoRecepcion"];
			$comentario=$_POST["txt_Comentario"];
			if($fecha_real != '' || $NombreRecepcion != '' || $ImplementadorRut != ''){
				$this->load->model("cliente");
				$resp = $this->cliente->cliente_implementacion_insertar($id_unico,$fecha_real,$lb_motivo,$Implementador,$ImplementadorRut,$NombreRecepcion,$RutRecepcion,$CargoRecepcion,$comentario);
				if($resp["mensaje"] == "OK"){
					$data["mensaje"]="Datos Guardados Correctamente";
					//$data["GetBack"]=1;
					$data['productos'] = $this->cliente->listar_cliente_producto($id_unico);
					$data['campana'] = $this->cliente->listar_campana($id_unico);
					$data['motivos'] =  $this->cliente->motivos_materiales($id_unico);
					$data["nombre"]=$_SESSION["nombre"];
					$this->load->view('contenido');
					$this->load->view('cabeceras/cabecera_master',$data);
					$this->load->view('clientes/cliente_producto',$data);
				}else{
					$data["mensaje"]="hubo un problema al guardar los datos";
					$this->load->view('contenido');
					$this->load->view('alertas/alertas',$data);
				}
			}else{
				$data["mensaje"]="hubo un problema al guardar los datos";
				$this->load->view('contenido');
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
		// $config['upload_path'] = "archivos/fotos/".$accion;
		$config['upload_path'] = "archivos/fotos/";
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

	public function send_products()
	{
		$this->load->model("cliente");
		$vacios=0;
		if((!isset($_POST["id"])) || $_POST["id"]==""){
			$vacios+=1;
		}
		if((!isset($_POST["implementado"])) || $_POST["implementado"]==""){
			$vacios+=1;
		}
		if((!isset($_POST["motivo"])) || $_POST["motivo"]==""){
			$vacios+=1;
		}
		if(!isset($_FILES["file"])){
			$vacios+=1;
		}
		if($vacios!=0){
			echo "ERROR";
		} else {
			$unico=$_POST["id"];
			$implementado=$_POST["implementado"];
			$motivo=$_POST["motivo"];
			$implementador=$_SESSION["usuario"];
			$foto=$this->subir_Foto($_POST["id"]);
			$resp = $this->cliente->Guardar_cliente_producto($unico,$motivo,$implementado,$foto);		
			if($resp['mensaje']=="OK"){
				echo "OK";
			} else {
				echo "ERROR";
			}
		}
	}

	public function product(){
		$this->load->model("cliente");
		$id=base64_decode($_POST["id"]);
		echo json_encode($this->cliente->foto($id));
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