<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class campanas extends CI_Controller {

	public function index(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				$this->load->model("campana");
				$this->load->model("listar");
				$this->load->model("empresa");
				$this->load->model("grupo_motivos");
				$data["empresa"]=$this->empresa->empresa(base64_decode($_SESSION["empresa"]))["empresa"];
				$data["campanas"]=$this->campana->campanas(base64_decode($_SESSION["empresa"]),0);
				$data["paises"]=$this->listar->paises();
				$data["grupomotivos"]=$this->grupo_motivos->gruposmotivoslist();
				$data["dondemotivos"]=$this->grupo_motivos->motivosdondelist();
				$data["permisos"]=$this->listar->permisos($_SESSION["usuario"],'campanas');
				$data["modulos"]=$_SESSION["modulos"];
				$data["nombre"]=$_SESSION["nombre"];
				$this->load->view('contenido');
				$this->load->view('cabeceras/cabecera_master',$data);
				$this->load->view('layout/menu_master',$data);
				$this->load->view('campanas/campana',$data);
			} else {
				redirect(base_url("empresas"));
			}
		} else {
			redirect(base_url("login"));
		}
	}

	public function agregar(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				$vacios=0;
				$this->load->model("campana");
				if((!isset($_POST["txt_campanaadd"])) || $_POST["txt_campanaadd"]==""){
					$vacios+=1;
				} 
				if((!isset($_POST["txt_anioadd"])) || $_POST["txt_anioadd"]==""){
					$vacios+=1;
				}
				if((!isset($_POST["rad_cam_activoadd"])) || $_POST["rad_cam_activoadd"]==""){
				 	$vacios+=1;
				}
				if((!isset($_POST["lbl_paisadd"])) || $_POST["lbl_paisadd"]==""){
				 	$vacios+=1;
				}
				if((!isset($_POST["lbl_grupomotivosadd"])) || $_POST["lbl_grupomotivosadd"]==""){
					$vacios+=1;
				}
				if((!isset($_POST["rad_acc_motivosadd"])) || $_POST["rad_acc_motivosadd"]==""){
					$vacios+=1;
				}
				if((!isset($_POST["rad_acc_materialesadd"])) || $_POST["rad_acc_materialesadd"]==""){
					$vacios+=1;
				}
				if((!isset($_POST["rad_acc_digitaadd"])) || $_POST["rad_acc_digitaadd"]==""){
					$vacios+=1;
				}
				if($vacios!=0){
					$data["mensaje"]="Campaña no pudo ser agregada, intente nuevamente";
				} else {
					$campana=$_POST["txt_campanaadd"];
					$anio=$_POST["txt_anioadd"];
					$activo=$_POST["rad_cam_activoadd"];
					$id_empresa=base64_decode($_SESSION["empresa"]);
					$pais=$_POST["lbl_paisadd"];
					$grupo=$_POST["lbl_grupomotivosadd"];
					$motivo=$_POST["rad_acc_motivosadd"];
					$materiales=$_POST["rad_acc_materialesadd"];
					$digita=$_POST["rad_acc_digitaadd"];
					$add=$this->campana->campanasadd($campana,$id_empresa,$anio,$activo,$pais,$grupo,$motivo,$materiales,$digita);
					if(isset($add["mensaje"])){
						$data["mensaje"]=$add["mensaje"];
					} else {
						$data["mensaje"]="Campaña agregada con éxito";
						$max=$this->campana->campanamax($id_empresa);
						$mensaje="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>";
						$mensaje.="<html xmlns='http://www.w3.org/1999/xhtml'>";
						$mensaje.="<head><meta http-equiv='Content-Type' content='text/html; charset=UTF-8' /><title>Masterplan - Nueva Campaña</title>";
						$mensaje.="<meta name='viewport' content='width=device-width, initial-scale=1.0'/><link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet'></head>";
						$mensaje.="<body style='background-color: rgb(240,240,240); margin: 10px'>";
						$mensaje.="<table>";
						$mensaje.="<tr><td style='padding:2.5px 1.3em; background-color: #0B30FC; color: white;' colspan='2'><h2 style='font-family: 'Calibri', sans-serif; padding-left: .5em; ' >Nueva Campaña - Masterplan</h2></td></tr>";
						$mensaje.="<tr><td style='padding: 1em 1.3em; text-align:center;'></td></tr>";
						$mensaje.="<tr><td colspan='2' style='padding: 0.1em 1em;  font-size: 18px; ' >Atención!!!!!, Se ha creado una nueva campaña.</td><td></td></tr><tr><td style='padding: 0.1em 1em;'><span></span></td><td></td></tr>";
						$mensaje.="<tr><td style='padding: 0.1em 1em; font-size: 16px; '>ID Campaña: ".$max["id_campana"]."</td></tr>";
						$mensaje.="<tr><td style='padding: 0.1em 1em; font-size: 16px; '>Campaña: ".$max["campana"]."</td><td></td></tr>";
						$mensaje.="<tr><td style='padding: 0.1em 1em; font-size: 16px; '>Empresa (Cliente) : ".$max["empresa"]."</td><td></td></tr>";
						$mensaje.="<tr><td style='padding: 0.1em 1em;'><span></span></td><td></td></tr><tr><td style='padding: 0.1em 1em;'><span></span></td><td></td></tr>";
						$mensaje.="<tr><td style='padding: 0.1em 1em;' colspan='2'><img src='https://pbs.twimg.com/media/DDKjnhfWsAAi36N.jpg' style='width:50%;' ></td><td></td></tr>";
						$mensaje.="<tr><td style='padding: 0.1em 1em;'><span></span></td><td></td></tr>";
						$mensaje.="<tr><td style='padding: 0.1em 1em;'><span></span></td><td></td></tr>";
						$mensaje.="<tr><td style='padding: 0.1em 1em; font-size: 16px;'>Atentamente,</td><td></td></tr>";
						$mensaje.="<tr><td style='padding: 0.1em 1em; font-size: 16px;'>Masterplan </td><td></td></tr>";
						$mensaje.="<tr><td style='padding: 1em; font-size: 18px; text-align: center;'></td><td></td></tr>";
						$mensaje.="</table></body></html>";
						// $this->correo("diego.luengo@audisischile.com,cristopher.ojeda@audisischile.com,mario.bustos@audisischile.com,renato.llanos@grupoprogestion.com,mariajose.perez@audisischile.com",$mensaje,"Masterplan - Nueva Campaña");
					}
				}
				$this->load->view('contenido');
				$this->load->view('alertas/alertas',$data);
			} else {
				redirect(base_url("empresas"));
			}
		} else {
			redirect(base_url("login"));
		}		

	}


	public function campana(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				$this->load->model("campana");
				$id=base64_decode($_POST["id"]);
				echo json_encode($this->campana->campana($id));
			} else {
				redirect(base_url("empresas"));
			}
		} else {
			redirect(base_url("login"));
		}
	}

	public function editar(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				$vacios=0;
				$this->load->model("campana");
				if((!isset($_POST["txt_campanaid"])) || $_POST["txt_campanaid"]==""){
					$vacios+=1;
				}
				if((!isset($_POST["txt_campanaedit"])) || $_POST["txt_campanaedit"]==""){
					$vacios+=1;
				}
				if((!isset($_POST["txt_anioedit"])) || $_POST["txt_anioedit"]==""){
					$vacios+=1;
				}
				if((!isset($_POST["rad_cam_activoedit"])) || $_POST["rad_cam_activoedit"]==""){
					$vacios+=1;
				}
				if((!isset($_POST["lbl_paisedit"])) || $_POST["lbl_paisedit"]==""){
					$vacios+=1;
				}
				if((!isset($_POST["lbl_grupomotivosedit"])) || $_POST["lbl_grupomotivosedit"]==""){
					$vacios+=1;
				}
				if((!isset($_POST["rad_acc_motivosedit"])) || $_POST["rad_acc_motivosedit"]==""){
					$vacios+=1;
				}
				if((!isset($_POST["rad_acc_materialesedit"])) || $_POST["rad_acc_materialesedit"]==""){
					$vacios+=1;
				}
				if((!isset($_POST["rad_acc_digitaedit"])) || $_POST["rad_acc_digitaedit"]==""){
					$vacios+=1;
				}
				if((!isset($_POST["txt_linkpbiedit"])) || $_POST["txt_linkpbiedit"]==""){
					$powerbi=0;
				} else {
					$powerbi=$_POST["txt_linkpbiedit"];
				}
				if($vacios!=0){
					$data["mensaje"]="Campaña no pudo ser modificada, intente nuevamente";
				} else {
					$id_campana=base64_decode($_POST["txt_campanaid"]);
					$campana=$_POST["txt_campanaedit"];
					$anio=$_POST["txt_anioedit"];
					$activo=$_POST["rad_cam_activoedit"];
					$pais=$_POST["lbl_paisedit"];
					$grupo=$_POST["lbl_grupomotivosedit"];
					$motivo=$_POST["rad_acc_motivosedit"];
					$materiales=$_POST["rad_acc_materialesedit"];
					$digita=$_POST["rad_acc_digitaedit"];
					$this->campana->campanasedit($id_campana,$campana,$anio,$activo,$powerbi,$pais,$grupo,$motivo,$materiales,$digita);
					$data["mensaje"]="Campaña modificada con éxito";
				}
				$this->load->view('contenido');
				$this->load->view('alertas/alertas',$data);
			} else {
				redirect(base_url("empresas"));
			}
		} else {
			redirect(base_url("login"));
		}
	}

	public function anios(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				$id=$_POST["anio"];
				$_SESSION["anio"]=$id;
			} else {
				redirect(base_url("home"));
			}
		} else {
			redirect(base_url("login"));
		}
	}


	function correo($email,$mensaje,$titulo){
		$cabeceras = 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		//$enviado = mail($email,$titulo,$mensaje,$cabeceras);
		$enviado = 0;
		return $enviado;
	}

}

?>