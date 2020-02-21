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
			$this->load->model('solicitud_ot');
			switch ($_SESSION["perfil"]) {
				case 0:
					redirect(base_url("home/default"));
					break;
				case 1:
					redirect(base_url("home/clientes"));
					break;
				case 5:
					redirect(base_url("home/default"));
					break;
				case 6:
					redirect(base_url("home/clientes"));
					break;					
				default:
					redirect(base_url("empresas"));
				break;
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
						$_SESSION["id_empresa"]=$log[0]["id_empresa"];
						$data["modulos"]=$modulos;
						$data["nombre"]=$log[0]["usuario"];
						switch ($_SESSION["perfil"]) {
							case 0:
								redirect(base_url("home/default"));
								break;
							case 1:								
								redirect(base_url("home/clientes"));
								break;
							case 5:
								redirect(base_url("home/default"));
								break;
							case 6:
								redirect(base_url("home/clientes"));
								break;								
							default:
								redirect(base_url("empresas"));
							break;
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


	public function reportes(){
		if(isset($_SESSION["sesion"])){
			$data["modulos"]=$_SESSION["modulos"];
			$data["nombre"]=$_SESSION["nombre"];
			$this->load->model("usuario");
			$this->load->model("listar");
			$this->load->model("empresa");
			$this->load->view('contenido');
			$this->load->view('layout/menu_default',$data);
			$data["anios"]=$this->listar->anios($_SESSION["usuario"],$this->usuario->usuario($_SESSION["usuario"])["id_empresa"]);
			$data["empresa"]=$this->empresa->empresa($this->usuario->usuario($_SESSION["usuario"])["id_empresa"]);
			$this->load->view('informes/menu',$data);
		} else {
			redirect(base_url("login"));
		}
	}


	public function galeria(){
		if(isset($_SESSION["sesion"])){
			$data["modulos"]=$_SESSION["modulos"];
			$data["nombre"]=$_SESSION["nombre"];
			$this->load->model("usuario");
			$this->load->model("listar");
			$this->load->model("empresa");
			$this->load->view('contenido');
			$this->load->view('layout/menu_default',$data);
			$data["anios"]=$this->listar->anios($_SESSION["usuario"],$this->usuario->usuario($_SESSION["usuario"])["id_empresa"]);
			$data["empresa"]=$this->empresa->empresa($this->usuario->usuario($_SESSION["usuario"])["id_empresa"]);
			$this->load->view('galeria/menu',$data);
		} else {
			redirect(base_url("login"));
		}
	}


	public function default(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("usuario");
			$data["modulos"]=$_SESSION["modulos"];
			$data["nombre"]=$_SESSION["nombre"];
			$data["campanas"]=$this->usuario->campanas($_SESSION["usuario"],0);
			$this->load->view('contenido');
			$this->load->view('layout/menu_default',$data);
			$this->load->view('clientes/home',$data);
		}  else {
			redirect(base_url("login"));
		}
	}

	public function clientes(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("listar");
			$this->load->model("empresa");
			$this->load->model("usuario");
			$data["modulos"]=$_SESSION["modulos"];
			$data["nombre"]=$_SESSION["nombre"];
			$data["empresa"]=$this->empresa->empresa($this->usuario->usuario($_SESSION["usuario"])["id_empresa"]);
			$_SESSION["empresa"]=base64_encode($data["empresa"][0]["id_empresa"]);
			$this->load->view('contenido');
			$this->load->view('layout/menu_default',$data);
			$this->load->view('informes/inicio',$data);
		}  else {
			redirect(base_url("login"));
		}
	}

	public function interno(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("listar");
			$this->load->model("empresa");
			$this->load->model("usuario");
			$data["empresa"]=$this->empresa->empresa($this->usuario->usuario($_SESSION["usuario"])["id_empresa"]);
			$_SESSION["empresa"]=base64_encode($data["empresa"][0]["id_empresa"]);
			redirect(base_url("solicitudes_ot/sot"));
		}  else {
			redirect(base_url("login"));
		}
	}


	public function recovery(){
		$vacios=0;
		if((!isset($_POST["txt_nombreusuario"])) || $_POST["txt_nombreusuario"]==""){
			$vacios+=1;
		}
		if((!isset($_POST["txt_correo"])) || $_POST["txt_correo"]==""){
			$vacios+=1;
		}
		// if((!isset($_POST["lb_empresa"])) || $_POST["lb_empresa"]==""){
		// 	$vacios+=1;
		// }
		if($vacios!=0){
			$data["mensaje"]="Los campos usuario y correo se encuentran vacíos, por favor intente nuevamente";
		} else {
			$this->load->model("usuario");
			$usuario=$_POST["txt_nombreusuario"];
			$correo=$_POST["txt_correo"];
			$c=$this->usuario->clave($usuario);
			$this->send('Recuperar Contraseña - Master Plan',$correo,'usuarios/correorecuperarclave',$c);
			$data["mensaje"]="La contraseña ha sido enviada al correo ingresado.";
		}
		$this->load->view('contenido');
		$this->load->view('alertas/alertas',$data);
	}


	function send($asunto,$correo,$vista,$contenido){
        // Load PHPMailer library
        $this->load->library('phpmailer_library');
        
        // PHPMailer object
        $mail = $this->phpmailer_library->load();
        
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = 'smtp.tie.cl';
        $mail->SMTPAuth = true;
        $mail->Username = 'no-contestar@audisischile.com';
        $mail->Password = 'Audisis2015';
        $mail->Port     = 25;
        $mail->setFrom('no-contestar@audisischile.com', 'No Contestar');
        
        // Add a recipient
        $mail->addAddress($correo);
        
        // Email subject
        $mail->Subject = $asunto;
        
        // Set email format to HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        // Email body content
        $data["data"]=$contenido;
        $mail->Body = $this->load->view($vista,$data,true);
        
        // Send email
        if(!$mail->send()){
            return false;
        }else{
            return true;
        }
    }




}
?>