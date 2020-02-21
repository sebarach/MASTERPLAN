<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tareas extends CI_Controller {

	public function index(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("listar");
			$this->load->model("tarea");
			$this->load->model("empresa");
			$data["modulos"]=$_SESSION["modulos"];
			$data["nombre"]=$_SESSION["nombre"];
			if(isset($_POST["id_empresa"])){
				if(!empty($_POST["id_empresa"])){
					$empresa=$_POST["id_empresa"];
				} else {
					$empresa=0;
				}
			} else {
				$empresa=0;
			}
			$data["empresa"]=$empresa;
			$data["emp"]=$this->empresa->empresas();
			$data["empresas"]=$this->tarea->empresas($empresa);
			$data["permisos"]=$this->listar->permisos($_SESSION["usuario"],'tipos_tareas');
			$this->load->view('contenido');
			$this->load->view('cabeceras/cabecera_master',$data);
			$this->load->view('tareas/tipotareas',$data);
		} else {
			redirect(base_url("login"));
		}
	}

	public function tarea(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				$this->load->model("empresa");
				$this->load->model("listar");
				$this->load->model("tarea");
				$data["modulos"]=$_SESSION["modulos"];
				$data["nombre"]=$_SESSION["nombre"];
				$data["empresa"]=$this->empresa->empresa(base64_decode($_SESSION["empresa"]))[0]["empresa"];
				$data["tareas"]=$this->tarea->tareas(base64_decode($_SESSION["empresa"]));
				$data["permisos"]=$this->listar->permisos($_SESSION["usuario"],'tipos_tareas');
				$this->load->view('contenido');
				$this->load->view('cabeceras/cabecera_master',$data);
				$this->load->view('tareas/tarea',$data);
			} else {
				redirect(base_url("empresas"));
			}
		} else {
			redirect(base_url("login"));
		}
	}


	public function agregartarea(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				$vacios=0;
				if((!isset($_POST["txt_tareaadd"])) || $_POST["txt_tareaadd"]==""){
					$vacios+=1;
				}
				if((!isset($_POST["rad_tarea_comadd"])) || $_POST["rad_tarea_comadd"]==""){
					$vacios+=1;
				}
				if((!isset($_POST["rad_tarea_activoadd"])) || $_POST["rad_tarea_activoadd"]==""){
					$vacios+=1;
				}
				if($vacios!=0){
					$data["mensaje"]="Tarea no pudo ser agregada, intente nuevamente";
				} else {
					$this->load->model("tarea");
					$tarea=$_POST["txt_tareaadd"];
					$comercial=$_POST["rad_tarea_comadd"];
					$activo=$_POST["rad_tarea_activoadd"];
					$id_empresa=base64_decode($_SESSION["empresa"]);
					$add=$this->tarea->tareasadd($tarea,$comercial,$activo,$id_empresa);
					if(isset($add["mensaje"])){
						$data["mensaje"]=$add["mensaje"];
					} else {
						$data["mensaje"]="Tarea no pudo ser agregada, intente nuevamente";
					}
					$this->load->view('contenido');
					$this->load->view('alertas/alertas',$data);
				}
			} else {
				redirect(base_url("empresas"));
			}
		} else {
			redirect(base_url("login"));
		}
	}

	public function tareaview(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				$this->load->model("tarea");
				$id=base64_decode($_POST["id"]);
				echo json_encode($this->tarea->tarea($id));
			} else {
				redirect(base_url("empresas"));
			}
		} else {
			redirect(base_url("login"));
		}
	}

	public function editartarea(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				$vacios=0;
				if((!isset($_POST["txt_tareaid"])) || $_POST["txt_tareaid"]==""){
					$vacios+=1;
				}
				if((!isset($_POST["txt_tareaedit"])) || $_POST["txt_tareaedit"]==""){
					$vacios+=1;
				}
				if((!isset($_POST["rad_tarea_comedit"])) || $_POST["rad_tarea_comedit"]==""){
					$vacios+=1;
				}
				if((!isset($_POST["rad_tarea_activoedit"])) || $_POST["rad_tarea_activoedit"]==""){
					$vacios+=1;
				}
				if($vacios!=0){
					$data["mensaje"]="Tarea no pudo ser modificada, intente nuevamente";
				} else {
					$this->load->model("tarea");
					$id=base64_decode($_POST["txt_tareaid"]);
					$tarea=$_POST["txt_tareaedit"];
					$comercial=$_POST["rad_tarea_comedit"];
					$activo=$_POST["rad_tarea_activoedit"];
					$add=$this->tarea->tareasedit($tarea,$comercial,$activo,$id);
					if(isset($add["mensaje"])){
						$data["mensaje"]=$add["mensaje"];
					} else {
						$data["mensaje"]="Tarea no pudo ser modificada, intente nuevamente";
					}
					$this->load->view('contenido');
					$this->load->view('alertas/alertas',$data);
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