<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class grupos_motivos extends CI_Controller {

	public function index(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("listar");
			$this->load->model("grupo_motivos");

			$data["permisos"]=$this->listar->permisos($_SESSION["usuario"],'motivos_grupos');
			$data["modulos"]=$_SESSION["modulos"];
			$data["nombre"]=$_SESSION["nombre"];
			$data["grupos"]=$this->grupo_motivos->gruposmotivoslist();

			$this->load->view('contenido');
			$this->load->view('cabeceras/cabecera_master',$data);
			$this->load->view('motivos/grupo_motivos',$data);
		} else {
			redirect(base_url("login"));
		}
	}

	public function agregar(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("grupo_motivos");
			$vacios=0;
			if((!isset($_POST["txt_grupomotivoadd"])) || $_POST["txt_grupomotivoadd"]==""){
				$vacios+=1;
			} 
			if($vacios!=0){
				$data["mensaje"]="Grupo Motivos no pudo ser agregado, intente nuevamente";
			} else {
				$grupomotivos=$_POST["txt_grupomotivoadd"];
				$add=$this->grupo_motivos->gruposmotivosadd($grupomotivos);
				if(isset($add["mensaje"])){
					$data["mensaje"]=$add["mensaje"];
				} else {
					$data["mensaje"]="Grupo Motivos agregado con éxito";
				}
			}
			$this->load->view('contenido');
			$this->load->view('alertas/alertas',$data);
		} else {
			redirect(base_url("login"));
		}	
	}

	public function grupomotivo(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("grupo_motivos");
			$id=base64_decode($_POST["id"]);
			echo json_encode($this->grupo_motivos->grupomotivos($id));
		} else {
			redirect(base_url("login"));
		}
	}

	public function editar(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("grupo_motivos");
			$vacios=0;
			if((!isset($_POST["txt_grupomotivoid"])) || $_POST["txt_grupomotivoid"]==""){
				$vacios+=1;
			} 
			if((!isset($_POST["txt_grupomotivoedit"])) || $_POST["txt_grupomotivoedit"]==""){
				$vacios+=1;
			} 
			if($vacios!=0){
				$data["mensaje"]="Grupo Motivos no pudo ser modificado, intente nuevamente";
			} else {
				$grupomotivos=$_POST["txt_grupomotivoedit"];
				$id=base64_decode($_POST["txt_grupomotivoid"]);
				$add=$this->grupo_motivos->gruposmotivosedit($grupomotivos,$id);
				if(isset($add["mensaje"])){
					$data["mensaje"]=$add["mensaje"];
				} else {
					$data["mensaje"]="Grupo Motivos modificado con éxito";
				}
			}
			$this->load->view('contenido');
			$this->load->view('alertas/alertas',$data);
		} else {
			redirect(base_url("login"));
		}
	}

	public function motivos(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["grupomotivos"])){
				$this->load->model("listar");
				$this->load->model("grupo_motivos");

				$data["permisos"]=$this->listar->permisos($_SESSION["usuario"],'motivos');
				$data["modulos"]=$_SESSION["modulos"];
				$data["nombre"]=$_SESSION["nombre"];
				$data["grupo"]=$this->grupo_motivos->grupomotivos(base64_decode($_SESSION["grupomotivos"]));
				$data["motivos"]=$this->grupo_motivos->motivoslist(base64_decode($_SESSION["grupomotivos"]));

				$this->load->view('contenido');
				$this->load->view('cabeceras/cabecera_master',$data);				
				$this->load->view('motivos/motivos',$data);

			} else {
				redirect(base_url("grupos_motivos"));
			}
		} else {
			redirect(base_url("login"));
		}
	}

	public function agregarmotivo(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["grupomotivos"])){
				$this->load->model("grupo_motivos");
				$vacios=0;
				if((!isset($_POST["txt_motivoadd"])) || $_POST["txt_motivoadd"]==""){
					$vacios+=1;
				} 
				if((!isset($_POST["txt_aliasadd"])) || $_POST["txt_aliasadd"]==""){
					$vacios+=1;
				}
				if((!isset($_POST["rad_mot_implementaadd"])) || $_POST["rad_mot_implementaadd"]==""){
					$vacios+=1;
				}
				if((!isset($_POST["rad_mot_exitosoadd"])) || $_POST["rad_mot_exitosoadd"]==""){
					$vacios+=1;
				}
				if((!isset($_POST["rad_mot_clienteadd"])) || $_POST["rad_mot_clienteadd"]==""){
					$vacios+=1;
				}
				if((!isset($_POST["rad_mot_materialadd"])) || $_POST["rad_mot_materialadd"]==""){
					$vacios+=1;
				}
				if((!isset($_POST["rad_mot_activoadd"])) || $_POST["rad_mot_activoadd"]==""){
					$vacios+=1;
				}
				if(base64_decode($_SESSION["grupomotivos"])==9){
					if((!isset($_POST["txt_codigoadd"])) || $_POST["txt_codigoadd"]==""){
						$vacios+=1;
					} 
					if((!isset($_POST["txt_responsableadd"])) || $_POST["txt_responsableadd"]==""){
						$vacios+=1;
					}
				}
				if($vacios!=0){
					$data["mensaje"]="Motivo no pudo ser agregado, intente nuevamente";
				} else {
					$data["id_grupo_motivos"]=base64_decode($_SESSION["grupomotivos"]);
					$data["motivo"]=$_POST["txt_motivoadd"];
					$data["alias"]=$_POST["txt_aliasadd"];
					$data["implementa"]=$_POST["rad_mot_implementaadd"];
					$data["exitoso"]=$_POST["rad_mot_exitosoadd"];
					$data["cliente"]=$_POST["rad_mot_clienteadd"];
					$data["material"]=$_POST["rad_mot_materialadd"];
					$data["activo"]=$_POST["rad_mot_activoadd"];
					if(base64_decode($_SESSION["grupomotivos"])==9){
						$data["cod_motivo"]=$_POST["txt_codigoadd"];
						$data["responsable"]=$_POST["txt_responsableadd"];
					}
					$add=$this->grupo_motivos->motivosadd($data);
					if(isset($add["mensaje"])){
						$data["mensaje"]=$add["mensaje"];
					} else {
						$data["mensaje"]="Motivo agregado con éxito";
					}	
				}
				$this->load->view('contenido');
				$this->load->view('alertas/alertas',$data);
			} else {
				redirect(base_url("grupos_motivos"));
			}
		} else {
			redirect(base_url("login"));
		}
	}

	public function motivo(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["grupomotivos"])){
				$this->load->model("grupo_motivos");
				$id=base64_decode($_POST["id"]);
				echo json_encode($this->grupo_motivos->motivos($id));
			} else {
				redirect(base_url("grupos_motivos"));
			}
		} else {
			redirect(base_url("login"));
		}
	}

	public function editarmotivo(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["grupomotivos"])){
				$this->load->model("grupo_motivos");
				$vacios=0;
				if((!isset($_POST["txt_motivoid"])) || $_POST["txt_motivoid"]==""){
					$vacios+=1;
				} 
				if((!isset($_POST["txt_motivoedit"])) || $_POST["txt_motivoedit"]==""){
					$vacios+=1;
				} 
				if((!isset($_POST["txt_aliasedit"])) || $_POST["txt_aliasedit"]==""){
					$vacios+=1;
				}
				if((!isset($_POST["rad_mot_implementaedit"])) || $_POST["rad_mot_implementaedit"]==""){
					$vacios+=1;
				}
				if((!isset($_POST["rad_mot_exitosoedit"])) || $_POST["rad_mot_exitosoedit"]==""){
					$vacios+=1;
				}
				if((!isset($_POST["rad_mot_clienteedit"])) || $_POST["rad_mot_clienteedit"]==""){
					$vacios+=1;
				}
				if((!isset($_POST["rad_mot_materialedit"])) || $_POST["rad_mot_materialedit"]==""){
					$vacios+=1;
				}
				if((!isset($_POST["rad_mot_activoedit"])) || $_POST["rad_mot_activoedit"]==""){
					$vacios+=1;
				}
				if(base64_decode($_SESSION["grupomotivos"])==9){
					if((!isset($_POST["txt_codigoedit"])) || $_POST["txt_codigoedit"]==""){
						$vacios+=1;
					} 
					if((!isset($_POST["txt_responsableedit"])) || $_POST["txt_responsableedit"]==""){
						$vacios+=1;
					}
				}
				if($vacios!=0){
					$data["mensaje"]="Motivo no pudo ser agregado, intente nuevamente";
				} else {
					$data["id_grupo_motivos"]=base64_decode($_SESSION["grupomotivos"]);
					$data["motivo"]=$_POST["txt_motivoedit"];
					$data["alias"]=$_POST["txt_aliasedit"];
					$data["implementa"]=$_POST["rad_mot_implementaedit"];
					$data["exitoso"]=$_POST["rad_mot_exitosoedit"];
					$data["cliente"]=$_POST["rad_mot_clienteedit"];
					$data["material"]=$_POST["rad_mot_materialedit"];
					$data["activo"]=$_POST["rad_mot_activoedit"];
					if(base64_decode($_SESSION["grupomotivos"])==9){
						$data["cod_motivo"]=$_POST["txt_codigoedit"];
						$data["responsable"]=$_POST["txt_responsableedit"];
					}
					$data["id"]=base64_decode($_POST["txt_motivoid"]);
					$add=$this->grupo_motivos->motivosedit($data);
					if(isset($add["mensaje"])){
						$data["mensaje"]=$add["mensaje"];
					} else {
						$data["mensaje"]="Motivo modificado con éxito";
					}	
				}
				$this->load->view('contenido');
				$this->load->view('alertas/alertas',$data);
			} else {
				redirect(base_url("grupos_motivos"));
			}
		} else {
			redirect(base_url("login"));
		}
	}

}

?>