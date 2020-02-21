<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class regiones extends CI_Controller {


	public function index(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("listar");
			$this->load->model("region");
			$data["modulos"]=$_SESSION["modulos"];
			$data["nombre"]=$_SESSION["nombre"];
			$data["regiones"]=$this->region->regiones();
			$data["paises"]=$this->listar->paises();
			$data["permisos"]=$this->listar->permisos($_SESSION["usuario"],'regiones');
			$this->load->view('contenido');
			$this->load->view('cabeceras/cabecera_master',$data);
			$this->load->view('layout/menu_master',$data);
			$this->load->view('regiones/region',$data);
		} else {
			redirect(base_url("login"));
		}
	}


	public function agregar(){
		if(isset($_SESSION["sesion"])){
			$vacios=0;
			$this->load->model("region");
			if((!isset($_POST["txt_regionadd"])) || $_POST["txt_regionadd"]==""){
				$vacios+=1;
			}
			if((!isset($_POST["lbl_paisadd"])) || $_POST["lbl_paisadd"]==""){
				$vacios+=1;
			}
			if((!isset($_POST["txt_ordenadd"])) || $_POST["txt_ordenadd"]==""){
				$vacios+=1;
			}
			if($vacios!=0){
				$data["mensaje"]="Region no pudo ser agregada, intente nuevamente";
			} else {
				$region=$_POST["txt_regionadd"];
				$pais=$_POST["lbl_paisadd"];
				$orden=$_POST["txt_ordenadd"];
				$add=$this->region->regionadd($region,$pais,$orden);
				if(isset($add["mensaje"])){
					$data["mensaje"]=$add["mensaje"];
				} else {
					$data["mensaje"]="Region agregada con éxito";
				}
			}
			$this->load->view('contenido');
			$this->load->view('alertas/alertas',$data);
		} else {
			redirect(base_url("login"));
		}
	}


	public function region(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("region");
			$id=base64_decode($_POST["id"]);
			echo json_encode($this->region->region($id));
		} else {
			redirect(base_url("login"));
		}
	}

	public function editar(){
		if(isset($_SESSION["sesion"])){
			$vacios=0;
			$this->load->model("region");
			if((!isset($_POST["txt_regionedit"])) || $_POST["txt_regionedit"]==""){
				$vacios+=1;
			}
			if((!isset($_POST["lbl_paisedit"])) || $_POST["lbl_paisedit"]==""){
				$vacios+=1;
			}
			if((!isset($_POST["txt_ordenedit"])) || $_POST["txt_ordenedit"]==""){
				$vacios+=1;
			}
			if((!isset($_POST["txt_regionid"])) || $_POST["txt_regionid"]==""){
				$vacios+=1;
			}
			if($vacios!=0){
				$data["mensaje"]="Region no pudo ser modificada, intente nuevamente";
			} else {
				$id=base64_decode($_POST["txt_regionid"]);
				$region=$_POST["txt_regionedit"];
				$pais=$_POST["lbl_paisedit"];
				$orden=$_POST["txt_ordenedit"];
				$add=$this->region->regionedit($region,$pais,$orden,$id);
				if(isset($add["mensaje"])){
					$data["mensaje"]=$add["mensaje"];
				} else {
					$data["mensaje"]="Region modificada con éxito";
				}
			}
			$this->load->view('contenido');
			$this->load->view('alertas/alertas',$data);
		} else {
			redirect(base_url("login"));
		}
	}


	public function comunas(){

	}

	public function ciudades(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					if(isset($_SESSION["accion"])){
						$this->load->model("region");
						$id=$_POST["id"];
						echo json_encode($this->region->comunas($id));
					} else {
						redirect(base_url("accciones"));
					}
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