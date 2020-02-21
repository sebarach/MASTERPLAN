<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class galerias extends CI_Controller {

	public function campanas(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				$this->load->model("empresa");
				$this->load->model("campana");
				$data["anio"]=base64_decode($_SESSION["anio"]);
				$data["empresa"]=$this->empresa->empresa(base64_decode($_SESSION["empresa"]));
				$data["nombre"]=$_SESSION["nombre"];
				$data["campanas"]=$this->campana->campanas(base64_decode($_SESSION["empresa"]),base64_decode($_SESSION["anio"]));
				$this->load->view('contenido');
				$this->load->view('layout/menu_default',$data);
				$this->load->view('galeria/campana',$data);
			} else {
				redirect(base_url("home"));
			}
		} else {
			redirect(base_url("login"));
		}
	}

	public function cadenas(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					$this->load->model("campana");
					$this->load->model("empresa");
					$data["empresa"]=$this->empresa->empresa(base64_decode($_SESSION["empresa"]));
					$data["nombre"]=$_SESSION["nombre"];
					$data["campana"]=$this->campana->campana(base64_decode($_SESSION["campana"]));
					$data["cadenas"]=$this->campana->campana_cadenas(base64_decode($_SESSION["empresa"]),base64_decode($_SESSION["campana"]),0,0,0,0,0,0,0,0,0);
					$this->load->view('contenido');
					$this->load->view('layout/menu_default',$data);
					$this->load->view('galeria/cadena',$data);
				} else {
					redirect(base_url("galerias/campanas"));
				}
			} else {
				redirect(base_url("home"));
			}
		} else {
			redirect(base_url("login"));
		}
	}


	public function fotos(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					if(isset($_SESSION["cadena"])){
						$this->load->model("campana");
						$this->load->model("empresa");
						$data["empresa"]=$this->empresa->empresa(base64_decode($_SESSION["empresa"]));
						$data["nombre"]=$_SESSION["nombre"];
						$data["campana"]=$this->campana->campana(base64_decode($_SESSION["campana"]));
						$data["fotos"]=$this->campana->campanafotos(base64_decode($_SESSION["campana"]),base64_decode($_SESSION["cadena"]));
						$data["cadena"]=base64_decode($_SESSION["cadena"]);
						$this->load->view('contenido');
						$this->load->view('layout/menu_default',$data);
						$this->load->view('galeria/fotos',$data);
					} else {
						redirect(base_url("galerias/cadenas"));
					}
				} else {
					redirect(base_url("galerias/campanas"));
				}
			} else {
				redirect(base_url("home"));
			}
		} else {
			redirect(base_url("login"));
		}
	}

}
?>