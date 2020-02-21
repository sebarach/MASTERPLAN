<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class usuarios extends CI_Controller {

	public function index(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("usuario");
			$this->load->model("empresa");
			$this->load->model("perfil");
			$this->load->model("listar");
			$this->load->model("campana");
			if(isset($_POST["lbl_empresa"])){
				$data["usuarios"]=$this->usuario->usuarios($_POST["lbl_empresa"]);
			} else {
				$data["usuarios"]=$this->usuario->usuarios(0);	
			}	
			$data["campanas"]=$this->campana->campanas(0,0);	
			$data["empresas"]=$this->empresa->empresas();
			$data["perfiles"]=$this->perfil->perfiles();
			$data["permisos"]=$this->listar->permisos($_SESSION["usuario"],'usuarios');
			$data["modulos"]=$_SESSION["modulos"];
			$data["nombre"]=$_SESSION["nombre"];
			$this->load->view('contenido');
			$this->load->view('cabeceras/cabecera_master',$data);
			$this->load->view('layout/menu_master',$data);
			$this->load->view('usuarios/usuario',$data);
		} else {
			redirect(base_url("login"));
		}
	}

	public function usuario(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("usuario");
			$id=base64_decode($_POST["id"]);
			echo json_encode($this->usuario->usuario($id));
		} else {
			redirect(base_url("login"));
		}
	}

	public function campanas(){
		if(isset($_SESSION["sesion"])){
			if (isset($_POST["mstl_anio"])) {
				$this->load->model("campana");			
				$this->load->model("usuario");
				$anio=$_POST["mstl_anio"];
				if (isset($_POST["mstl_mes"])) {
					$mes=$_POST["mstl_mes"];
				}else{
					$mes=00;
				}				
				$id=base64_decode($_SESSION["usuarioid"]);
				$data["usuario"]=$this->usuario->usuario($id);
				$data["anio"]=$this->campana->anioCampanas($data["usuario"]["id_empresa"]);
				if($data["usuario"]["id_perfil"]==5){	
					$data["campanas"]=$this->campana->listarCampanaFiltrada(intval($anio),intval($mes),$data["usuario"]["id_empresa"]);
					$data["campanassel"]=$this->usuario->campanassucursal($id);
				} else {
					$data["campanassel"]=$this->usuario->campanas($id);
					$data["campanas"]=$this->campana->campanas($data["usuario"]["id_empresa"],0);
				}					
				$data["modulos"]=$_SESSION["modulos"];
				$data["nombre"]=$_SESSION["nombre"];
				$this->load->view('contenido');
				$this->load->view('cabeceras/cabecera_master',$data);
				$this->load->view('layout/menu_master',$data);
				$this->load->view('usuarios/campana',$data);
			}else{
				$this->load->model("campana");			
				$this->load->model("usuario");
				$this->load->model("campana");
				$id=base64_decode($_SESSION["usuarioid"]);
				$data["usuario"]=$this->usuario->usuario($id);
				$data["anio"]=$this->campana->anioCampanas($data["usuario"]["id_empresa"]);
				if($data["usuario"]["id_perfil"]==5){	
					$data["campanas"]=$this->campana->campanasucursales($data["usuario"]["id_empresa"]);//este carga p&g
				} else {
					$data["campanassel"]=$this->usuario->campanas($id,0);
					$data["campanas"]=$this->campana->campanas($data["usuario"]["id_empresa"],0);
				}					
				$data["modulos"]=$_SESSION["modulos"];
				$data["nombre"]=$_SESSION["nombre"];
				$this->load->view('contenido');
				$this->load->view('cabeceras/cabecera_master',$data);
				$this->load->view('layout/menu_master',$data);
				$this->load->view('usuarios/campana',$data);
			}
			
		} else {
			redirect(base_url("login"));
		}
	}

	public function camp_usuarios(){
		if(isset($_SESSION["sesion"])){
			$id=$_POST["id"];
			$_SESSION["usuarioid"]=$id;
		} else {
			redirect(base_url("login"));
		}
	}

	public function camp_sucursal(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("usuario");
			echo json_encode(array('arr1'=>$this->usuario->sucursales($_POST["id"]),'arr2'=>$this->usuario->sucursal(base64_decode($_POST["id_usuario"]))));			
		} else {
			redirect(base_url("login"));
		}
	}

	public function validausuario(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("usuario");
			$usuario="";
			if((isset($_POST["txt_nombreadd"])) || $_POST["txt_nombreadd"]!=""){
				switch (count($nombre)) {
					case 1:
						for ($i=0; $i < count($nombre); $i++) {
						}
						break;
					case 2:
						
						break;
					case 3:
						
						break;
					case 4:
						
						break;
				}
				$nombre=explode(" ",$_POST["txt_nombreadd"]);
				for ($i=0; $i < count($nombre); $i++) { 
					if($i==0){
						$usuario.=substr($nombre[0], 0, $c);
					} else {
						$usuario.=$nombre[$i];
					}					
					if($i<count($nombre)){
						$c++;
					}
				}
			}
			echo $usuario; 
		} else {
			redirect(base_url("login"));
		}
	}

	public function agregar(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("usuario");
			$vacios=0;
			if((!isset($_POST["txt_usuarioadd"])) || $_POST["txt_usuarioadd"]==""){
			 	$vacios+=1;
			}
			if((!isset($_POST["txt_passwordadd"])) || $_POST["txt_passwordadd"]==""){
			 	$vacios+=1;
			}
			if((!isset($_POST["lbl_perfiladd"])) || $_POST["lbl_perfiladd"]==""){
			 	$vacios+=1;
			}
			if((!isset($_POST["lbl_empresaadd"])) || $_POST["lbl_empresaadd"]==""){
			 	$vacios+=1;
			}
			if((!isset($_POST["rad_emp_activoadd"])) || $_POST["rad_emp_activoadd"]==""){
			 	$vacios+=1;
			}
			if($vacios!=0){
				$data["mensaje"]="Usuario no pudo ser agregado, intente nuevamente";
			} else {
				$usuario=$_POST["txt_usuarioadd"];
				$password=$_POST["txt_passwordadd"];
				$id_perfil=$_POST["lbl_perfiladd"];
				$empresa=$_POST["lbl_empresaadd"];
				$activo=$_POST["rad_emp_activoadd"];
				$add=$this->usuario->usuariosadd($usuario,$password,$id_perfil,$empresa,$activo);
				if(isset($add["mensaje"])){
					$data["mensaje"]=$add["mensaje"];
				} else {
					$data["mensaje"]="Usuario agregado con éxito";
				}
			}
			$this->load->view('contenido');
			$this->load->view('alertas/alertas',$data);
		} else {
			redirect(base_url("login"));
		}
	}


	public function agregarcampana(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("usuario");
			$vacios=0;
			if((!isset($_POST["txt_usuariocampid"])) || $_POST["txt_usuariocampid"]==""){
			 	$vacios+=1;
			}
			if((!isset($_POST["lbl_campanas"])) || $_POST["lbl_campanas"]==""){
			 	$vacios+=1;
			}
			if($vacios!=0){
				$data["mensaje"]="Las campañas seleccionadas no pudieron asignadas, intente nuevamente";
			} else {
				$this->usuario->usuarioscampanasdelete($_POST["txt_usuariocampid"]);
				foreach ($_POST["lbl_campanas"] as $c) {
					$usuario=$_POST["txt_usuariocampid"];
					$campana=$c;
					$add=$this->usuario->usuarioscampanasadd($usuario,$campana);
				}
				$data["mensaje"]=$add["mensaje"];
				$data["camp"]=1;
			}
			$this->load->view('contenido');
			$this->load->view('alertas/alerta_cam',$data);
		} else {
			redirect(base_url("login"));
		}
	}


	public function editar(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("usuario");
			$vacios=0;
			if((!isset($_POST["txt_usuarioid"])) || $_POST["txt_usuarioid"]==""){
			 	$vacios+=1;
			}
			if((!isset($_POST["txt_usuarioedit"])) || $_POST["txt_usuarioedit"]==""){
			 	$vacios+=1;
			}
			if((!isset($_POST["txt_passwordedit"])) || $_POST["txt_passwordedit"]==""){
			 	$vacios+=1;
			}
			if((!isset($_POST["lbl_perfiledit"])) || $_POST["lbl_perfiledit"]==""){
			 	$vacios+=1;
			}
			if((!isset($_POST["lbl_empresaedit"])) || $_POST["lbl_empresaedit"]==""){
			 	$vacios+=1;
			}
			if((!isset($_POST["rad_emp_activoedit"])) || $_POST["rad_emp_activoedit"]==""){
			 	$vacios+=1;
			}
			if($vacios!=0){
				$data["mensaje"]="Usuario no pudo ser modificado, intente nuevamente";
			} else {
				$id=base64_decode($_POST["txt_usuarioid"]);
				$usuario=$_POST["txt_usuarioedit"];
				$password=$_POST["txt_passwordedit"];
				$id_perfil=$_POST["lbl_perfiledit"];
				$empresa=$_POST["lbl_empresaedit"];
				$activo=$_POST["rad_emp_activoedit"];
				$this->usuario->usuariosedit($id,$usuario,$password,$id_perfil,$empresa,$activo);
				$data["mensaje"]="Usuario modificado con éxito";
			}
			$this->load->view('contenido');
			$this->load->view('alertas/alertas',$data);
		} else {
			redirect(base_url("login"));
		}
	}

	public function agregarsucursal(){	
		$this->load->model("usuario");
		$id_usuario=$_POST["txt_usuariocampid"];
		$id_campana=$_POST["lbl_campanas"];
		for ($i=0; $i < sizeof($id_campana); $i++) { 
			$campana[$i]=explode(",",$id_campana[$i]);
		}
		for ($i=0; $i < sizeof($id_campana); $i++) { 
			$this->usuario->deletecampanauser($id_usuario,$campana[$i][0]);
		}		
		for ($j=0; $j < sizeof($campana); $j++) {
			$this->usuario->addcampanauser($id_usuario,$campana[$j][0],$campana[$j][1]);
		}
	}
}

?>