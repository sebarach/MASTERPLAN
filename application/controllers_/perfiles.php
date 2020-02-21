<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class perfiles extends CI_Controller {

	public function index(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("perfil");
			$this->load->model("listar");
			$data["perfiles"]=$this->perfil->perfiles();
			$data["permisos"]=$this->listar->permisos($_SESSION["usuario"],'userlevels');
			$data["levels"]=array('Empresas','Clientes','Campanas','Acciones','Informes','Motivos_Grupos','Motivos','Regiones','Usuarios','UserLevels','Clientes_Informacion');
			$data["modulos"]=$_SESSION["modulos"];
			$data["nombre"]=$_SESSION["nombre"];
			$this->load->view('contenido');
			$this->load->view('cabeceras/cabecera_master',$data);
			$this->load->view('layout/menu_master',$data);
			$this->load->view('perfiles/perfil',$data);
		} else {
			redirect(base_url("login"));
		}
	}


	public function perfil(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("perfil");
			$id=base64_decode($_POST["id"]);
			echo json_encode($this->perfil->perfil($id));
		} else {
			redirect(base_url("login"));
		}
	}

	public function agregar(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("perfil");
			$vacios=0;
			if((!isset($_POST["txt_perfiladd"])) || $_POST["txt_perfiladd"]==""){
				$vacios+=1;				
			} 
			if((!isset($_POST["txt_modulos"])) || $_POST["txt_modulos"]==""){
				$vacios+=1;
			}
			if($vacios!=0){
				$data["mensaje"]="Perfil no pudo ser agregado, intente nuevamente";
			} else {
				$perfil=$_POST["txt_perfiladd"];
				$permisos=array(array(),array());
				for ($i=0; $i < count($_POST["txt_modulos"]); $i++) { 
					$suma=0;
					if(isset($_POST["chck_view".$i])){
						$suma+=$_POST["chck_view".$i];
					} else {
						$suma+=0;
					}
					if(isset($_POST["chck_add".$i])){
						$suma+=$_POST["chck_add".$i];
					} else {
						$suma+=0;
					}
					if(isset($_POST["chck_edit".$i])){
						$suma+=$_POST["chck_edit".$i];
					} else {
						$suma+=0;
					}
					if(isset($_POST["chck_delete".$i])){
						$suma+=$_POST["chck_delete".$i];
					} else {
						$suma+=0;
					}
					$permisos[0][$i]=base64_decode($_POST["txt_modulos"][$i]);
					$permisos[1][$i]=$suma;
				}
				$add=$this->perfil->perfilesadd($perfil);
				$add2=$this->perfil->permisosadd($permisos,$perfil);
				if(isset($add["mensaje"])){
					$data["mensaje"]=$add["mensaje"];
				} else if(isset($add2[0])){						
					$data["mensaje"]=$add2[0];					
				} else {
					$data["mensaje"]="Perfil agregado con éxito";
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
			$this->load->model("perfil");
			$vacios=0;
			if((!isset($_POST["txt_perfilid"])) || $_POST["txt_perfilid"]==""){
				$vacios+=1;
			} 
			if((!isset($_POST["txt_perfiledit"])) || $_POST["txt_perfiledit"]==""){
				$vacios+=1;
			}
			if((!isset($_POST["txt_modulos"])) || $_POST["txt_modulos"]==""){
				$vacios+=1;
			}
			if($vacios!=0){
				$data["mensaje"]="Perfil no pudo ser agregado, intente nuevamente";
			} else {
				$id=base64_decode($_POST["txt_perfilid"]);
				$perfil=$_POST["txt_perfiledit"];
				$permisos=array(array(),array());
				for ($i=0; $i < count($_POST["txt_modulos"]); $i++) { 
					$suma=0;
					if(isset($_POST["chck_view".$i])){
						$suma+=$_POST["chck_view".$i];
					} else {
						$suma+=0;
					}
					if(isset($_POST["chck_add".$i])){
						$suma+=$_POST["chck_add".$i];
					} else {
						$suma+=0;
					}
					if(isset($_POST["chck_edit".$i])){
						$suma+=$_POST["chck_edit".$i];
					} else {
						$suma+=0;
					}
					if(isset($_POST["chck_delete".$i])){
						$suma+=$_POST["chck_delete".$i];
					} else {
						$suma+=0;
					}
					$permisos[0][$i]=base64_decode($_POST["txt_modulos"][$i]);
					$permisos[1][$i]=$suma;
				}
				$add=$this->perfil->perfilesedit($perfil,$id);
				$add2=$this->perfil->permisosadd($permisos,$perfil);
				if(isset($add["mensaje"])){
					$data["mensaje"]=$add["mensaje"];
				} else if(isset($add2[0])){						
					$data["mensaje"]=$add2[0];					
				} else {
					$data["mensaje"]="Perfil modificado con éxito";
				}
			}
			$this->load->view('contenido');
			$this->load->view('alertas/alertas',$data);
		} else {
			redirect(base_url("login"));
		}
	}
}

?>