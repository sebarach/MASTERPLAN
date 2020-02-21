<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {

	public function index(){
		if(isset($_SESSION["sesion"])){
			$data["modulos"]=$_SESSION["modulos"];
			$data["nombre"]=$_SESSION["nombre"];
			$this->load->model("usuario");
			$this->load->model("listar");
			$this->load->model("empresa");
			$this->load->view('contenido');
			$this->load->view('cabeceras/cabecera_master',$data);
			if($_SESSION["perfil"]==1){
				$data["anios"]=$this->listar->anios($_SESSION["usuario"],$this->usuario->usuario($_SESSION["usuario"])["id_empresa"]);
				$data["empresa"]=$this->empresa->empresa($this->usuario->usuario($_SESSION["usuario"])["id_empresa"])["empresa"];
				$this->load->view('informes/menu',$data);
			} else {
				$this->load->view('layout/menu_master',$data);
				if($_SESSION["perfil"]==0){
						//$data["campanas"]=$this->usuario->campanas($_SESSION["usuario"],0);
					//$this->load->view('clientes/home',$data);
					redirect(base_url("clientes"));
				}
			}
		} else {
			$this->load->model("listar");
			$this->load->model("empresa");
			$this->load->model("usuario");
			$this->load->view('contenido');
			if(isset($_POST["txt_username"]) && isset($_POST["txt_password"])){
				$usuario=$_POST["txt_username"];
				$clave=$_POST["txt_password"];
				if (($usuario=="" && $clave=="") || ($usuario=="" || $clave=="")) {
					$data["tipo"]=1;
					$this->load->view('alertas/alerta_login',$data);
				} else {
					$log=$this->listar->login($usuario,$clave);
					if($log[0]["exito"]=="0"){
						$data["tipo"]=2;
						$this->load->view('alertas/alerta_login',$data);
					} else if($log[0]["exito"]=="1"){					
						$modulos=array();
						for ($i=0; $i < count($log); $i++) { 
							$modulos[$i]=$log[$i]["level"];
						}						
						$_SESSION["sesion"]=true;
						$_SESSION["modulos"]=$modulos;
						$_SESSION["usuario"]=$log[0]["id_usuario"];
						$_SESSION["nombre"]=$log[0]["usuario"];
						$_SESSION["perfil"]=$log[0]["id_perfil"];
						$data["modulos"]=$modulos;
						$data["nombre"]=$log[0]["usuario"];
						$this->load->view('cabeceras/cabecera_master',$data);
						if($_SESSION["perfil"]==1){
							$data["anios"]=$this->listar->anios($log[0]["id_usuario"],$log[0]["id_empresa"]);
							$data["empresa"]=$this->empresa->empresa($this->usuario->usuario($_SESSION["usuario"])["id_empresa"])["empresa"];
							$_SESSION["empresa"]=base64_encode($this->usuario->usuario($_SESSION["usuario"])["id_empresa"]);
							$this->load->view('informes/menu',$data);
						} else {
							$this->load->view('layout/menu_master',$data);
							if($_SESSION["perfil"]==0){
								//$data["campanas"]=$this->usuario->campanas($_SESSION["usuario"],0);
								//$this->load->view('clientes/home',$data);
								redirect(base_url("clientes"));
							}
						}						
					} else if($log[0]["exito"]=="2"){
						$data["tipo"]=3;
						$this->load->view('alertas/alerta_login',$data);
					} 

				}
			} else {
				$data["tipo"]=1;
				$this->load->view('alertas/alerta_login',$data);
			}
		}
	}

}
?>