<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class empresas extends CI_Controller {


	function __construct()
    {
        parent::__construct();
		 $this->load->library('upload');
		 //$this->load->library('imagify');
    }

	public function index(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("empresa");
			$this->load->model("listar");
			$data["empresas"]=$this->empresa->empresas();
			$data["permisos"]=$this->listar->permisos($_SESSION["usuario"],'empresas');
			$data["modulos"]=$_SESSION["modulos"];
			$data["nombre"]=$_SESSION["nombre"];
			$this->load->view('contenido');
			$this->load->view('cabeceras/cabecera_master',$data);
			$this->load->view('layout/menu_master',$data);
			$this->load->view('empresas/empresa',$data);
		} else {
			redirect(base_url("login"));
		}
	}

	public function empresa(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("empresa");
			$id=base64_decode($_POST["id"]);
			echo json_encode($this->empresa->empresa($id));
		} else {
			redirect(base_url("login"));
		}
	}

	public function agregar(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("empresa");
			$vacios=0;
			if((!isset($_POST["txt_empresaadd"])) || $_POST["txt_empresaadd"]==""){
				$vacios+=1;
			} 
			if((!isset($_POST["txt_coloresadd1"])) || $_POST["txt_coloresadd1"]==""){
				$vacios+=1;
			} 
			if((!isset($_POST["txt_coloresadd2"])) || $_POST["txt_coloresadd2"]==""){
				$vacios+=1;
			} 
			if((!isset($_POST["txt_coloresadd3"])) || $_POST["txt_coloresadd3"]==""){
				$vacios+=1;
			} 
			if(!isset($_FILES["txt_logoadd"])){
				$vacios+=1;
			} 
			if(!isset($_FILES["txt_fondoadd"])){
				$vacios+=1;
			} 
			if($vacios!=0){
				$data["mensaje"]="Empresa no pudo ser agregada, intente nuevamente";
			} else {
				$empresa=$_POST["txt_empresaadd"];
				$color_1=$_POST["txt_coloresadd1"];
				$color_2=$_POST["txt_coloresadd2"];
				$color_3=$_POST["txt_coloresadd3"];
				$imagen_logo=$this->logo(str_replace(" ", "_", $_POST["txt_empresaadd"]),1);
				$imagen_fondo=$this->fondo(str_replace(" ", "_", $_POST["txt_empresaadd"]),1);
				$add=$this->empresa->empresasadd($empresa,$imagen_logo,$imagen_fondo,$color_1,$color_2,$color_3);
				if(isset($add["mensaje"])){
					$data["mensaje"]=$add["mensaje"];
				} else {
					$data["mensaje"]="Empresa agregada con éxito";
				}
			}
			$this->load->view('contenido');
			$this->load->view('alertas/alertas',$data);
		} else {
			redirect(base_url("login"));
		}
	}

	public function editar(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("empresa");	
			$vacios=0;
			if((!isset($_POST["txt_empresaedit"])) || $_POST["txt_empresaedit"]==""){
				$vacios+=1;
			} 
			if((!isset($_POST["txt_coloresedit1"])) || $_POST["txt_coloresedit1"]==""){
				$vacios+=1;
			} 
			if((!isset($_POST["txt_coloresedit2"])) || $_POST["txt_coloresedit2"]==""){
				$vacios+=1;
			} 
			if((!isset($_POST["txt_coloresedit3"])) || $_POST["txt_coloresedit3"]==""){
				$vacios+=1;
			} 
			if((!isset($_POST["txt_logo"])) || $_POST["txt_logo"]==""){
				$vacios+=1;
			} else {
				if($_POST["txt_logo"]=="t6t6"){
					if(!isset($_FILES["txt_logoedit"])){
						$vacios+=1;
					} 
				}
			}
			if((!isset($_POST["txt_fondo"])) || $_POST["txt_fondo"]==""){
				$vacios+=1;
			} else {
				if($_POST["txt_fondo"]=="t6t6"){
					if(!isset($_FILES["txt_fondoedit"])){
						$vacios+=1;
					} 
				}
			}	
			if((!isset($_POST["txt_empresaid"])) || $_POST["txt_empresaid"]==""){
				$vacios+=1;
			} 
			if($vacios!=0){
				$data["mensaje"]="Empresa no pudo ser modificada, intente nuevamente";
			} else {
				$id=base64_decode($_POST["txt_empresaid"]);
				$empresa=$_POST["txt_empresaedit"];
				$color_1=$_POST["txt_coloresedit1"];
				$color_2=$_POST["txt_coloresedit2"];
				$color_3=$_POST["txt_coloresedit3"];
				if($_POST["txt_logo"]=="t6t6"){
					$imagen_logo=$this->logo(str_replace(" ", "_", $_POST["txt_empresaedit"]),2);
				} else {
					$imagen_logo=$_POST["txt_logo"];
				}
				if($_POST["txt_fondo"]=="t6t6"){
					$imagen_fondo=$this->fondo(str_replace(" ", "_", $_POST["txt_empresaedit"]),2);
				} else {
					$imagen_fondo=$_POST["txt_fondo"];
				}
				$this->empresa->empresasedit($empresa,$imagen_logo,$imagen_fondo,$color_1,$color_2,$color_3,$id);
				$data["mensaje"]="Empresa modificada con éxito";
			}
			$this->load->view('contenido');
			$this->load->view('alertas/alertas',$data);
		} else {
			redirect(base_url("login"));
		}
	}

	public function fondo($filename,$accion)
	{
			//$config = null;
		if($accion==1){
			$foto1 ='txt_fondoadd';
		} else {
			$foto1 ='txt_fondoedit';
		}
		
		// $config['upload_path'] = "archivos/fotos/".$accion;
		$config['upload_path'] = "archivos/fondos/";
		$config['file_name'] =$filename;
		$config['allowed_types'] = "jpeg|jpg|png";
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
		$config['source_image'] = 'archivos/fondos/'.$data["file_name"];  
		$config['create_thumb'] = FALSE;  
		$config['maintain_ratio'] = FALSE;  
		$config['quality'] = '100%';  
		// $config['width'] = 1366;  
		// $config['height'] = 800;  
		$config['new_image'] = 'archivos/fondos/'.$data["file_name"];  
		$this->load->library('image_lib', $config); 
		$this->image_lib->clear();
		$this->image_lib->initialize($config);
		$this->image_lib->resize();  


		$nombre= $data['file_name'];
		return $nombre;
	}

	public function logo($filename,$accion)
	{
			//$config = null;
		if($accion==1){
			$foto1 ='txt_logoadd';
		} else {
			$foto1 ='txt_logoedit';
		}
		// $config['upload_path'] = "archivos/fotos/".$accion;
		$config['upload_path'] = "archivos/logos/";
		$config['file_name'] =$filename;
		$config['allowed_types'] = "jpeg|jpg|png";
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
		$config['source_image'] = 'archivos/logos/'.$data["file_name"];  
		$config['create_thumb'] = FALSE;  
		$config['maintain_ratio'] = FALSE;  
		$config['quality'] = '100%';  
		// $config['width'] = 170;  
		// $config['height'] = 57;  
		$config['new_image'] = 'archivos/logos/'.$data["file_name"];  
		$this->load->library('image_lib', $config); 
		$this->image_lib->clear();
		$this->image_lib->initialize($config);
		$this->image_lib->resize();  


		$nombre= $data['file_name'];
		return $nombre;
	}

	public function campanas(){
		if(isset($_SESSION["sesion"])){
			$id=$_POST["id"];
			$_SESSION["empresa"]=$id;
		} else {
			redirect(base_url("login"));
		}
	}

	public function acciones(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				$id=$_POST["id"];
				$_SESSION["campana"]=$id;
			} else {
				redirect(base_url("empresas"));
			}
		} else {
			redirect(base_url("login"));
		}
	}

	public function informes(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				$id=$_POST["id"];
				$_SESSION["campana"]=$id;
			} else {
				redirect(base_url("empresas"));
			}
		} else {
			redirect(base_url("login"));
		}
	}

	public function clientes(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					$id=$_POST["id"];
					$_SESSION["accion"]=$id;
				} else {
					redirect(base_url("campanas"));
				}
			} else {
				redirect(base_url("empresas"));
			}
		} else {
			redirect(base_url("login"));
		}
	}


	public function grupomotivos(){
		if(isset($_SESSION["sesion"])){
			$id=$_POST["id"];
			$_SESSION["grupomotivos"]=$id;
		} else {
			redirect(base_url("login"));
		}
	}


}

?>