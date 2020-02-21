<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class acciones extends CI_Controller {

	public function index(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					$this->load->model("campana");
					$this->load->model("listar");
					$this->load->model("empresa");
					$this->load->model("accion");
					$this->load->model("grupo_motivos");
					$data["empresa"]=$this->empresa->empresa(base64_decode($_SESSION["empresa"]))[0]["empresa"];
					$data["campana"]=$this->campana->campana(base64_decode($_SESSION["campana"]));
					$data["permisos"]=$this->listar->permisos($_SESSION["usuario"],'acciones');
					$data["acciones"]=$this->accion->acciones(base64_decode($_SESSION["campana"]));
					$data["modulos"]=$_SESSION["modulos"];
					$data["nombre"]=$_SESSION["nombre"];
					$this->load->view('contenido');
					$this->load->view('cabeceras/cabecera_master',$data);
					$this->load->view('acciones/accion',$data);
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


	public function accion(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					$this->load->model("accion");
					$id=base64_decode($_POST["id"]);
					echo json_encode($this->accion->accion($id));
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

}

?>