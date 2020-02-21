<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class solicitudes_ot extends CI_Controller {

	 public function __construct()
    {
                parent::__construct();
                // Your own constructor code
               $this->load->library('upload');
    }


	public function index(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("empresa");
			$this->load->model("campana");	
			$this->load->model("usuario");
			$this->load->model("listar");;
			$this->load->model("solicitud_ot");
			$this->load->model("tarea");
			if(isset($_POST["id_empresa"])){
				if(!empty($_POST["id_empresa"])){
					$empresa=$_POST["id_empresa"];
					$data["anios"]=$this->solicitud_ot->anios($empresa);
					if(isset($_POST['aniosot'])){
						if(!empty($_POST['aniosot'])){
							$anio=$_POST['aniosot'];				
						} else {
							$anio=0;
						}
					} else {
						$anio=0;
					}

					if(isset($_POST['messot'])){
						if(!empty($_POST['messot'])){
							$mes_numero=$_POST['messot'];					
						} else {
							$mes_numero=0;
						}
					} else {
						$mes_numero=0;
					}

					if(isset($_POST['campanasot'])){
						if(!empty($_POST['campanasot'])){
							$campana=$_POST['campanasot'];
							$data["nom_campana"]=$this->campana->campana($campana)["campana"];
						} else {
							$campana=0;
						}
					} else {
						$campana=0;
					}

					if(isset($_POST["estado"])){
						if(!empty($_POST["estado"])){
							$estado=$_POST["estado"];
							$data["nom_estado"]=$this->solicitud_ot->estado($estado)["estado"];
						} else {
							$estado=0;
						}
					} else {
						$estado=0;
					}

					if(isset($_POST["region"])){
						if(!empty($_POST["region"])){
							$region=$_POST["region"];
							$data["nom_region"]=$this->campana->nombreregion($region)["region"];
						} else {
							$region=0;
						}
					} else {
						$region=0;
					}

					if(isset($_POST["comuna"])){
						if(!empty($_POST["comuna"])){
							$ciudad=$_POST["comuna"];
						} else {
							$ciudad=0;
						}
					} else {
						$ciudad=0;
					}

					if(isset($_POST["cadena"])){
						if(!empty($_POST["cadena"])){
							$cadena=$_POST["cadena"];
						} else {
							$cadena=0;
						}
					} else {
						$cadena=0;
					}

					if(isset($_POST["local"])){
						if(!empty($_POST["local"])){
							$sucursal=$_POST["local"];
						} else {
							$sucursal=0;
						}
					} else {
						$sucursal=0;
					}

					if(isset($_POST["opcion"])){
						if(is_numeric($_POST["opcion"])){
							$opcion = $_POST["opcion"];
						}else{
							$opcion=1;
						}
					}else{
						$opcion=1;
					}



					$data["solicitudes"]=$this->solicitud_ot->solicitudes($empresa,$campana,$_SESSION["usuario"],$estado,$region,str_replace('_', ' ', $ciudad),str_replace('_', ' ', $cadena),$sucursal,$mes_numero,$anio,$opcion);

					if(count($data["solicitudes"])>0){
						$tempoCantidad = $data["solicitudes"][0]["total"];
						$data['cantidad'] = ceil(($tempoCantidad+1)/20);
					} else {
						$tempoCantidad = 0;
						$data['cantidad'] = 0;
					}
					$data['anio']=$anio;
					$data['mes_numero']=$mes_numero;
					$data['estado']=$estado;
					$data['cadena']=$cadena;
					$data['ciudad']=$ciudad;
					$data['sucursal']=$sucursal;
					$data['region']=$region;
					$data['campana']=$campana;
					$data['opcion']=$opcion;
				} else {
					$empresa=0;
				}
			} else {
				$empresa=0;
			} 
			$data["empresa"]=$empresa;
			$data["emp"]=$this->empresa->empresas();
			$data["modulos"]=$_SESSION["modulos"];
			$data["nombre"]=$_SESSION["nombre"];
			$data["permisos"]=$this->listar->permisos($_SESSION["usuario"],'Solicitud_ot');
			$this->load->view('contenido');
			$this->load->view('cabeceras/cabecera_master',$data);
			$this->load->view('ot/solicitud_ot',$data);

		} else {
			redirect(base_url("login"));
		}
	}

	public function sot(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
			$data["modulos"]=$_SESSION["modulos"];
			$data["nombre"]=$_SESSION["nombre"];
			$this->load->model("usuario");
			$this->load->model("listar");;
			$this->load->model("solicitud_ot");
			$this->load->model("empresa");
			$this->load->model("campana");	
			$data["empresa"]=$this->empresa->empresa(base64_decode($_SESSION["empresa"]));
			$data["anios"]=$this->solicitud_ot->anios(base64_decode($_SESSION["empresa"]));
			if(isset($_POST['aniosot'])){
				if(!empty($_POST['aniosot'])){
					$anio=$_POST['aniosot'];				
				} else {
					$anio=0;
				}
			} else {
				$anio=0;
			}

			if(isset($_POST['messot'])){
				if(!empty($_POST['messot'])){
					$mes_numero=$_POST['messot'];					
				} else {
					$mes_numero=0;
				}
			} else {
				$mes_numero=0;
			}

			if(isset($_POST['campanasot'])){
				if(!empty($_POST['campanasot'])){
					$campana=$_POST['campanasot'];
					$data["nom_campana"]=$this->campana->campana($campana)["campana"];
				} else {
					$campana=0;
				}
			} else {
				$campana=0;
			}

			if(isset($_POST["estado"])){
				if(!empty($_POST["estado"])){
					$estado=$_POST["estado"];
					$data["nom_estado"]=$this->solicitud_ot->estado($estado)["estado"];
				} else {
					$estado=0;
				}
			} else {
				$estado=0;
			}

			if(isset($_POST["region"])){
				if(!empty($_POST["region"])){
					$region=$_POST["region"];
					$data["nom_region"]=$this->campana->nombreregion($region)["region"];
				} else {
					$region=0;
				}
			} else {
				$region=0;
			}

			if(isset($_POST["comuna"])){
				if(!empty($_POST["comuna"])){
					$ciudad=$_POST["comuna"];
				} else {
					$ciudad=0;
				}
			} else {
				$ciudad=0;
			}

			if(isset($_POST["cadena"])){
				if(!empty($_POST["cadena"])){
					$cadena=$_POST["cadena"];
				} else {
					$cadena=0;
				}
			} else {
				$cadena=0;
			}

			if(isset($_POST["local"])){
				if(!empty($_POST["local"])){
					$sucursal=$_POST["local"];
				} else {
					$sucursal=0;
				}
			} else {
				$sucursal=0;
			}

			if(isset($_POST["opcion"])){
				if(is_numeric($_POST["opcion"])){
					$opcion = $_POST["opcion"];
				}else{
					$opcion=1;
				}
			}else{
				$opcion=1;
			}

			$data["solicitudes"]=$this->solicitud_ot->solicitudes(base64_decode($_SESSION["empresa"]),$campana,$_SESSION["usuario"],$estado,$region,str_replace('_', ' ', $ciudad),str_replace('_', ' ', $cadena),$sucursal,$mes_numero,$anio,$opcion);

			if(count($data["solicitudes"])>0){
				$tempoCantidad = $data["solicitudes"][0]["total"];
				$data['cantidad'] = ceil(($tempoCantidad+1)/20);
			} else {
				$tempoCantidad = 0;
				$data['cantidad'] = 0;
			}

			$data['anio']=$anio;
			$data['mes_numero']=$mes_numero;
			$data['estado']=$estado;
			$data['cadena']=$cadena;
			$data['ciudad']=$ciudad;
			$data['sucursal']=$sucursal;
			$data['region']=$region;
			$data['campana']=$campana;
			$data['opcion']=$opcion;
			$data["nombre"]=$_SESSION["nombre"];
			$this->load->view('contenido');
			$this->load->view('layout/menu_default',$data);
			$this->load->view('ot/solicitud_cli',$data);

			}else{
				redirect(base_url("empresas"));				
			}
		}else{
			redirect(base_url("login"));
		}

	}



	public function excel(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("solicitud_ot");
			$this->load->library('phpexcel');
			$empresa= (isset($_POST["id_empresa"])) ? $_POST["id_empresa"] : base64_decode($_SESSION["empresa"]); 
			$fechas=explode(" - ",$_POST["fecha"]);
			$excel = new PHPExcel();
			$excel->setActiveSheetIndex(0);
			$solicitudes=$this->solicitud_ot->excel($empresa,date("Ymd",strtotime($fechas[0])),date("Ymd",strtotime($fechas[1])),$_SESSION["usuario"]);
			$c=$solicitudes[0];
			$x=0;
			for ($i=0; $i < count($c); $i++) { 
				$excel->getActiveSheet()->setCellValueByColumnAndRow($x,1,strtoupper($c[$i]));
				$excel->getActiveSheet()->getStyleByColumnAndRow($x,1)->getFont()->setBold(true);
				$x+=1;
			}
			$row=2;
			foreach ($solicitudes[1] as $m) {
				$c=$solicitudes[0];
				$x=0;
				for ($i=0; $i < count($c); $i++) {
					if(($timestamp = strtotime($m[$c[$i]])) === false){
						$excel->getActiveSheet()->setCellValueByColumnAndRow($x,$row,$m[$c[$i]]);
					} else {
						$excel->getActiveSheet()->setCellValueByColumnAndRow($x,$row,date('d-m-Y H:i',$timestamp));
						$excel->getActiveSheet()->getStyleByColumnAndRow($x,$row)->getNumberFormat()->setFormatCode('dd-mm-yyyy hh:mm');
					}				
					$x+=1;
				}
				$row+=1;
			}
			$excel_writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
			header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
			header('Content-Disposition: attachment;filename="OT - '.date("d-m-Y").'.xlsx"');
			header('Cache-Control: max-age=0');		
			ob_start();
			$excel_writer->save('php://output');

		} else {
			redirect(base_url("login"));
		}
	}


	public function tareas(){
		$this->load->model("tarea");
		$id=$_POST["id"];
		$tareas="<label class=\"col-md-12\">Tipo Tarea</label>";
		$tar=$this->tarea->tareas(base64_decode($id));
		for($i=0; $i<count($tar); $i++) {
			$t=$tar[$i];
			if($t["activo"]==1){
				$tareas.='<div class="col-md-4">'.
					'<label class="custom-control custom-checkbox">'.
							'<input type="checkbox" class="custom-control-input" name="checksolttadd[]" id="checksolttadd'.$i.'"  value="'.$t["id_tipotarea"].'"  >'.
							'<span class="custom-control-indicator"></span>'.
							'<span class="custom-control-description"><small style="font-size:0.6rem;" >'.$t["tipotarea"].'</small></span>'.
						'</label>'.
				"</div>";
			}	
			
		}
		echo $tareas;
	}


	public function id_cliente(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					$this->load->model("solicitud_ot");
					$cadena=$_POST["id"];
					echo json_encode($this->solicitud_ot->clientes(base64_decode($_SESSION["campana"]),$cadena));
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

	public function campanas(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("solicitud_ot");
			$anio=(isset($_POST["anio"])) ? (empty($_POST["anio"])) ? 0 : $_POST["anio"] : 0 ;
			$mes_numero=(isset($_POST["mes_numero"])) ? (empty($_POST["mes_numero"])) ? 0 : $_POST["mes_numero"] : 0 ;
			$id_empresa=(isset($_POST["id_empresa"])) ? $_POST["id_empresa"] : base64_decode($_SESSION["empresa"]) ;
			echo json_encode($this->solicitud_ot->campanas($id_empresa,$anio,$mes_numero));

			
		} 					
	} 	

	public function estados(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("solicitud_ot");
			echo json_encode($this->solicitud_ot->estados(0));
		}
	}

	public function cadenas(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("solicitud_ot");
			$id_empresa=(isset($_POST["id_empresa"])) ? $_POST["id_empresa"] : base64_decode($_SESSION["empresa"]);
			$id_campana=(isset($_POST["id_campana"])) ? (empty($_POST["id_campana"])) ? 0 : $_POST["id_campana"] : 0;
			$region=(isset($_POST["region"])) ? (empty($_POST["region"])) ? 0 : $_POST["region"] : 0;
			$cadena=0;
			$canal=(isset($_POST["canal"])) ? (empty($_POST["canal"])) ? 0 : $_POST["canal"] : 0;
			$imp=(isset($_POST["imp"])) ? (empty($_POST["imp"])) ? 0 : $_POST["imp"] : 0;
			$cli=(isset($_POST["cli"])) ? (empty($_POST["imp"])) ? 0 : $_POST["cli"] : 0;
			$ciudad=(isset($_POST["ciudad"])) ? (empty($_POST["ciudad"])) ? 0 : $_POST["ciudad"] : 0;
			$sucursal=(isset($_POST["sucursal"])) ? (empty($_POST["sucursal"])) ? 0 : $_POST["sucursal"] : 0;
			$fechaprog=(isset($_POST["fechaprog"])) ? (empty($_POST["fechaprog"])) ? 0 : $_POST["fechaprog"] : 0;
			$fechareal=(isset($_POST["fechareal"])) ? (empty($_POST["fechareal"])) ? 0 : $_POST["fechareal"] : 0;
			echo json_encode($this->solicitud_ot->cadenas($id_empresa,$id_campana,$region,$ciudad,$sucursal,$fechaprog,$fechareal,$cadena,$canal,$imp,$cli));
		} else {
			redirect(base_url("login"));
		}
	}

	public function cadenassolicitud(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("solicitud_ot");
			$id_empresa=(isset($_POST["id_empresa"])) ? $_POST["id_empresa"] : base64_decode($_SESSION["empresa"]);
			$id_campana=(isset($_POST["id_campana"])) ? (empty($_POST["id_campana"])) ? 0 : $_POST["id_campana"] : 0;
			$region=(isset($_POST["region"])) ? (empty($_POST["region"])) ? 0 : $_POST["region"] : 0;
			$cadena=0;
			$canal=(isset($_POST["canal"])) ? (empty($_POST["canal"])) ? 0 : $_POST["canal"] : 0;
			$imp=(isset($_POST["imp"])) ? (empty($_POST["imp"])) ? 0 : $_POST["imp"] : 0;
			$cli=(isset($_POST["cli"])) ? (empty($_POST["imp"])) ? 0 : $_POST["cli"] : 0;
			$ciudad=(isset($_POST["ciudad"])) ? (empty($_POST["ciudad"])) ? 0 : $_POST["ciudad"] : 0;
			$sucursal=(isset($_POST["sucursal"])) ? (empty($_POST["sucursal"])) ? 0 : $_POST["sucursal"] : 0;
			$fechaprog=(isset($_POST["fechaprog"])) ? (empty($_POST["fechaprog"])) ? 0 : $_POST["fechaprog"] : 0;
			$fechareal=(isset($_POST["fechareal"])) ? (empty($_POST["fechareal"])) ? 0 : $_POST["fechareal"] : 0;
			echo json_encode($this->solicitud_ot->cadenassolicitud($id_empresa,$id_campana,$region,$ciudad,$sucursal,$fechaprog,$fechareal,$cadena,$canal,$imp,$cli));
		} else {
			redirect(base_url("login"));
		}
	}

	public function regiones(){
		if(isset($_SESSION["sesion"])){		
			$this->load->model("solicitud_ot");
			$id_empresa=(isset($_POST["id_empresa"])) ? $_POST["id_empresa"] : base64_decode($_SESSION["empresa"]);
			$id_campana=(isset($_POST["id_campana"])) ? (empty($_POST["id_campana"])) ? 0 : $_POST["id_campana"] : 0;
			$region=0;
			$cadena=(isset($_POST["cadena"])) ? (empty($_POST["cadena"])) ? 0 : $_POST["cadena"] : 0;
			$canal=(isset($_POST["canal"])) ? (empty($_POST["canal"])) ? 0 : $_POST["canal"] : 0;
			$imp=(isset($_POST["imp"])) ? (empty($_POST["imp"])) ? 0 : $_POST["imp"] : 0;
			$cli=(isset($_POST["cli"])) ? (empty($_POST["imp"])) ? 0 : $_POST["cli"] : 0;
			$ciudad=(isset($_POST["ciudad"])) ? (empty($_POST["ciudad"])) ? 0 : $_POST["ciudad"] : 0;
			$sucursal=(isset($_POST["sucursal"])) ? (empty($_POST["sucursal"])) ? 0 : $_POST["sucursal"] : 0;
			$fechaprog=(isset($_POST["fechaprog"])) ? (empty($_POST["fechaprog"])) ? 0 : $_POST["fechaprog"] : 0;
			$fechareal=(isset($_POST["fechareal"])) ? (empty($_POST["fechareal"])) ? 0 : $_POST["fechareal"] : 0;
			echo json_encode($this->solicitud_ot->regiones($id_empresa,$id_campana,$region,$ciudad,$sucursal,$fechaprog,$fechareal,$cadena,$canal,$imp,$cli));
		} 
	}

	public function comunas(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("solicitud_ot");
			$id_empresa=(isset($_POST["id_empresa"])) ? $_POST["id_empresa"] : base64_decode($_SESSION["empresa"]);
			$id_campana=(isset($_POST["id_campana"])) ? (empty($_POST["id_campana"])) ? 0 : $_POST["id_campana"] : 0;
			$region=(isset($_POST["region"])) ? (empty($_POST["region"])) ? 0 : $_POST["region"] : 0;
			$cadena=(isset($_POST["cadena"])) ? (empty($_POST["cadena"])) ? 0 : $_POST["cadena"] : 0;
			$canal=(isset($_POST["canal"])) ? (empty($_POST["canal"])) ? 0 : $_POST["canal"] : 0;
			$imp=(isset($_POST["imp"])) ? (empty($_POST["imp"])) ? 0 : $_POST["imp"] : 0;
			$cli=(isset($_POST["cli"])) ? (empty($_POST["imp"])) ? 0 : $_POST["cli"] : 0;
			$ciudad=0;
			$sucursal=(isset($_POST["sucursal"])) ? (empty($_POST["sucursal"])) ? 0 : $_POST["sucursal"] : 0;
			$fechaprog=(isset($_POST["fechaprog"])) ? (empty($_POST["fechaprog"])) ? 0 : $_POST["fechaprog"] : 0;
			$fechareal=(isset($_POST["fechareal"])) ? (empty($_POST["fechareal"])) ? 0 : $_POST["fechareal"] : 0;
			echo json_encode($this->solicitud_ot->comunas($id_empresa,$id_campana,$region,$ciudad,$sucursal,$fechaprog,$fechareal,$cadena,$canal,$imp,$cli));			
		}
	}

	public function locales(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("solicitud_ot");
			$id_empresa=(isset($_POST["id_empresa"])) ? $_POST["id_empresa"] : base64_decode($_SESSION["empresa"]);
			$id_campana=(isset($_POST["id_campana"])) ? (empty($_POST["id_campana"])) ? 0 : $_POST["id_campana"] : 0;
			$region=(isset($_POST["region"])) ? (empty($_POST["region"])) ? 0 : $_POST["region"] : 0;
			$cadena=(isset($_POST["cadena"])) ? (empty($_POST["cadena"])) ? 0 : $_POST["cadena"] : 0;
			$canal=(isset($_POST["canal"])) ? (empty($_POST["canal"])) ? 0 : $_POST["canal"] : 0;
			$imp=(isset($_POST["imp"])) ? (empty($_POST["imp"])) ? 0 : $_POST["imp"] : 0;
			$cli=(isset($_POST["cli"])) ? (empty($_POST["imp"])) ? 0 : $_POST["cli"] : 0;
			$ciudad=(isset($_POST["ciudad"])) ? (empty($_POST["ciudad"])) ? 0 : $_POST["ciudad"] : 0;
			$sucursal=0;
			$fechaprog=(isset($_POST["fechaprog"])) ? (empty($_POST["fechaprog"])) ? 0 : $_POST["fechaprog"] : 0;
			$fechareal=(isset($_POST["fechareal"])) ? (empty($_POST["fechareal"])) ? 0 : $_POST["fechareal"] : 0;
				echo json_encode($this->solicitud_ot->locales($id_empresa,$id_campana,$region,$ciudad,$sucursal,$fechaprog,$fechareal,$cadena,$canal,$imp,$cli));	
		} else {
			redirect(base_url("login"));
		}	
	}

	public function anios(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				$this->load->model("solicitud_ot");
				echo json_encode($this->solicitud_ot->anios(base64_decode($_SESSION["empresa"])));
 			}	
		} 		
	}

	public function meses(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("solicitud_ot");
			$id_empresa=(isset($_POST["id_empresa"])) ? $_POST["id_empresa"] : base64_decode($_SESSION["empresa"]) ;
			$anio=$_POST["anio"];
			echo json_encode($this->solicitud_ot->meses($id_empresa,$anio));	
		} 		
	}	
	
	public function ciudades(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("solicitud_ot");
			$id_campana=$_POST["id_campana"];
			$id_region=$_POST["id_region"];
			echo json_encode($this->solicitud_ot->ciudades($id_campana,$id_region));			
		}
	}		
	
	public function agregar(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				$this->load->model("solicitud_ot");
				$vacios=0;				
				if((!isset($_POST["lblcampana"])) || $_POST["lblcampana"]==""){

					$vacios+=1;
				}
				if((!isset($_POST["lblregion"])) || $_POST["lblregion"]==""){

					$vacios+=1;
				}
				if((!isset($_POST["lblciudad"])) || $_POST["lblciudad"]==""){
					
					$vacios+=1;
				}
				if((!isset($_POST["lbl_cadenaadd"])) || $_POST["lbl_cadenaadd"]==""){						
					$vacios+=1;
				}
				if( (!isset($_POST["lbl_localadd1"])) || $_POST["lbl_localadd1"]=="") {
					if(((!isset($_POST["nombrelocal"])) || $_POST["nombrelocal"]=="") && 
						((!isset($_POST["direccionlocal"])) || $_POST["direccionlocal"]=="")  ){
						
						$vacios+=1;
				}

			}
			if((!isset($_POST["txt_asuntoadd"])) || $_POST["txt_asuntoadd"]==""){

				$vacios+=1;
			} 
			if((!isset($_POST["checksolttadd"])) || count($_POST["checksolttadd"])==0){

				$vacios+=1;
			} 
			if((!isset($_POST["txt_comentarioadd"])) || $_POST["txt_comentarioadd"]==""){

				$vacios+=1;
			}
			if((!isset($_POST["duplicados"])) || $_POST["duplicados"]==""){

				$vacios+=1;
			} else {
				for ($i=0; $i < $_POST["duplicados"] ; $i++) { 
					if(!isset($_FILES["txt_archivosolicadd".$i]) && strlen($_FILES["txt_archivosolicadd".$i]["name"])==0){
						$vacios+=1;

					}
					if((!isset($_POST["txt_nomsoliadd".$i])) || $_POST["txt_nomsoliadd".$i]==""){
						$vacios+=1;

					}
				}						
			}
			if($vacios!=0){
				$data["mensaje"]="OT no pudo ser ingresada, intente nuevamente";
			} else {
				$id_campana=$_POST["lblcampana"];
				$region=$_POST["lblregion"];
				$ciudad=$_POST["lblciudad"];
				$cadena=$_POST["lbl_cadenaadd"];
				$id_cliente=isset($_POST["lbl_localadd1"]) ? $_POST["lbl_localadd1"] : null;
				$nombrelocal=$_POST["nombrelocal"];
				$direccionlocal=$_POST["direccionlocal"];
				$asunto=$_POST["txt_asuntoadd"];
				$comentario=$_POST["txt_comentarioadd"];
				$id_empresa=base64_decode($_SESSION["empresa"]);
				$solicitante=$_SESSION["usuario"];						
				$tipos="";
				foreach ($_POST["checksolttadd"] as $tt) {
					$tipos.=$tt.",";
				}
				$archivo="";
				$nombres="";
				for ($i=0; $i < $_POST["duplicados"] ; $i++) { 
					if(isset($_FILES["txt_archivosolicadd".$i]) && strlen($_FILES["txt_archivosolicadd".$i]["name"])>0){
						$ar=explode('.', strtolower($_FILES["txt_archivosolicadd".$i]["name"]));
						$ext= end($ar);
						$nom=$i.$id_empresa.$solicitante.$id_campana.date("dmYHisu").".".$ext;
						$archivo.=$this->archivo("txt_archivosolicadd".$i,$nom)."&&";
						$nombres.=$_POST["txt_nomsoliadd".$i]."&&";
					}
				}

				$add=$this->solicitud_ot->ingresar_ot($id_empresa,$id_cliente,$asunto,$comentario,$id_campana,$solicitante,$tipos,$nombrelocal,$direccionlocal,$archivo,$nombres,$region,$ciudad,$cadena);
				if(isset($add["mensaje"])){
					$coordinadores=$this->solicitud_ot->coordinadores();
					foreach ($coordinadores as $c) {
						$this->send($add["asunto"],$c["email"],$add["pagina"],$add["solicitud"]);
					}
					$this->send($add["asunto"],$this->solicitud_ot->correo($_SESSION["usuario"])["email"],$add["pagina"],$add["solicitud"]);
					$data["mensaje"]=$add["mensaje"];
				} else {
					$data["mensaje"]="OT no pudo ser ingresada";
				}
			}
			$this->load->view('contenido');
			$this->load->view('alertas/alertas',$data);
		} else {
			redirect(base_url("home"));				
			}
		} else {
			redirect(base_url("login"));
		}
	}




	public function solicitudcoordinador(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("solicitud_ot");
			$id=base64_decode($_POST["id"]);
			$solicitud=$this->solicitud_ot->solicitud($id);
			$estados=$this->solicitud_ot->solicitudestados($id);
			$body='<div class="row">';

			$body.='<div class="col-md-3 pad06">';
				$body.='<div class="card ecom-widget-sales border">';
				$body.='<div class="card-body"><ul class="list-group">';
					$body.='<li class="list-group-item ">Cadena <span>'.$solicitud[0]["cadena"].'</span></li>';
					$body.='<li class="list-group-item ">Local<span>'.$solicitud[0]["local"].'</span></li>';
					$body.='<li class="list-group-item ">Dirección Local<span>'.$solicitud[0]["direccion"].', '.$solicitud[0]["ciudad"].'</span></li>';
					$body.='<li class="list-group-item ">Campaña <span>'.$solicitud[0]["campana"].'</span></li>';
					$body.='<li class="list-group-item">Solicitante <span>'.$solicitud[0]["nom_solicitante"].'</span></li>';
					$body.='<li class="list-group-item">Fecha Creación <span>'.$solicitud[0]["fecha_registro"].'</span></li>';	
					$body.='<li class="list-group-item">Responsable <span>'.$solicitud[0]["usuario"].'</span></li>';		
					$body.='</ul></div>';
			$body.='</div></div>';		
			$body.='<div class="col-md-3 pad06">';
					$body.='<div class="card ecom-widget-sales border">';
					$body.='<div class="card-body"><ul class="list-group">';
						$body.='<li class="list-group-item">Asunto <span>'.$solicitud[0]["asunto"].'</span></li>';
						$body.='<li class="list-group-item">Comentario <span>'.$solicitud[0]["comentario"].'</span></li>';					
						$body.='<li class="list-group-item">Estado <span><div class="row">';
						$body.='<div class="col-md-12 pad06"><select class="form-control select" id="lbl_estado" name="lbl_estado">';
						$selected="";
						$listestados=$this->solicitud_ot->estados($id);
						$primero=$listestados[0]["primerestado"];
						$ultimo=$listestados[0]["ultimoestado"];
						foreach($listestados as $e){
							if($ultimo==3){
								if($e["id_estado"]==$ultimo){
									$body.='<option value="'.$e["id_estado"].'" >'.$e["estado"].'</option>';
								}
							} else {
								if($primero==5 || $primero==4){
									if($e["id_estado"]!=1){
										if($solicitud[0]["id_estado"]==$e["id_estado"]){
											$selected="selected";
										} else {
											$selected="";
										}
										$body.='<option value="'.$e["id_estado"].'" '.$selected.'>'.$e["estado"].'</option>';
									}
								} else if($primero==1){
									if($solicitud[0]["id_estado"]==$e["id_estado"]){
										$selected="selected";
									} else {
										$selected="";
									}
									$body.='<option value="'.$e["id_estado"].'" '.$selected.'>'.$e["estado"].'777</option>';

								}
							}
						}
						$body.='</select></div>';
						$body.='</div></span></li>';
						$body.='<li class="list-group-item">Fecha Cierre Real <span>
							<div class="row"><div class="col-md-12 pad06">
								<input type="text" name="txt_fechaestimada" id="txt_fechaestimada" placeholder="Fecha Estimada" readonly style="background-color:white;" class="form-control select">
							</div></div>
							</span></li>';
						
						$body.='<li class="list-group-item">Tipo Tarea <span>'.$solicitud[0]["tipo_tarea"].'</span></li>';
						$body.='</ul></div>';
					$body.='</div>';
			$body.='</div>';
			$body.='<div class="col-md-6 pad06"><div class="row">';
				$body.='<div class="col-md-12 ">';
					$body.='<div class="card ecom-widget-sales border">';
					$body.='<div class="card-body"><ul class="list-group">';
						$body.='<li class="list-group-item">Archivos Solicitante<span><div class="row" style="margin-top:0.5rem;">';
								foreach($solicitud as $s){
									if($s["ext"]=="jpeg" || $s["ext"]=="jpg" || $s["ext"]=="png"){
										$body.='<a href="'.$s["archivo_adjunto"].'" target="_blank" class="col-md-3" style="margin-bottom:0.3rem;" >
											<div class="card" style="margin-bottom:0.2rem;"><img class="card-img-top" src="'.$s["archivo_adjunto"].'"></div><small>'.$s["nombre_archivo"].'</small></a>';
									} else if($s["ext"]=="pdf"){ 
										$body.='<a href="'.$s["archivo_adjunto"].'" target="_blank" class="col-md-3"  style="margin-bottom:0.3rem;">
											<div class="card" style="margin-bottom:0.2rem;"><div class="card-body" style="padding: 0.5rem">
											<h1 class="h1 text-center text-theme" style="font-size: 3.6rem;"><i class="mdi mdi-file-pdf-box"></i></h1>
										</div></div><small>'.$s["nombre_archivo"].'</small></a>';
									} else if($s["ext"]=="doc" || $s["ext"]=="docx"){ 
										$body.='<a href="'.$s["archivo_adjunto"].'" target="_blank" class="col-md-3" style="margin-bottom:0.3rem;" >
											<div class="card" style="margin-bottom:0.2rem;"><div class="card-body" style="padding: 0.5rem">
											<h1 class="h1 text-center text-theme" style="font-size: 3.6rem;"><i class="mdi mdi-file-word-box"></i></h1>
										</div></div><small>'.$s["nombre_archivo"].'</small></a>';
									} else if($s["ext"]=="xls" || $s["ext"]=="xlsx"){ 
										$body.='<a href="'.$s["archivo_adjunto"].'" target="_blank" class="col-md-3" style="margin-bottom:0.3rem;" >
											<div class="card" style="margin-bottom:0.2rem;"><div class="card-body" style="padding: 0.5rem">
											<h1 class="h1 text-center text-theme" style="font-size: 3.6rem;" ><i class="mdi mdi-file-excel-box"  ></i></h1>
										</div></div><small>'.$s["nombre_archivo"].'</small></a>';
									}  else if($s["ext"]=="ppt" || $s["ext"]=="pptx"){ 
										$body.='<a href="'.$s["archivo_adjunto"].'" target="_blank" class="col-md-3" style="margin-bottom:0.3rem;" >
											<div class="card" style="margin-bottom:0.2rem;"><div class="card-body" style="padding: 0.5rem">
											<h1 class="h1 text-center text-theme" ><i class="mdi mdi-file-powerpoint-box"></i></h1>
										</div></div><small>'.$s["nombre_archivo"].'</small></a>';
									} else { 
										$body.='<a href="'.$s["archivo_adjunto"].'" target="_blank" class="col-md-3" style="margin-bottom:0.3rem;">
											<div class="card" style="margin-bottom:0.2rem;"><div class="card-body" style="padding: 0.5rem">
											<h1 class="h1 text-center text-theme" style="font-size: 3.6rem;"><i class="mdi mdi-file-document-box"></i></h1>
										</div></div><small>'.$s["nombre_archivo"].'</small></a>';
									} 
									
								}
							$body.='</div></span></li>';
					$body.='</ul></div>';
					$body.='</div>';
				$body.='</div>';
				$body.='<div class="col-md-12 ">';
					$body.='<div class="card ecom-widget-sales border">';
					$body.='<div class="card-body"><ul class="list-group">';
					$body.='<li class="list-group-item">Historial de Cambios<span><div class="table-responsive" style="margin-top:0.5rem; margin-bottom: 0.2rem">';
						$body.='<table class="table" style="text-align:center;"><thead><tr ><th>Usuario</th><th>Estado</th><th>Comentario</th><th>Fecha</th></tr></thead><tbody style="color: #536c79; font-weight: 400;">';
							foreach ($estados as $e) {
								$body.='<tr><td style="font-size: 0.71rem;">'.$e["nombre"].'</td>
									<td style="font-size: 0.71rem;">'.$e["estado"].'</td>
									<td style="font-size: 0.71rem;">'.$e["comentario"].'</td>
									<td style="font-size: 0.71rem;">'.date("d-m-Y H:i",strtotime($e["fecha_registro"])).'</td></tr>';
							}
						$body.='</tbody></table>';
					$body.='</div></span></li>';
					$body.='</ul></div>';
					$body.='</div>';
				$body.='</div>';

			$body.='</div></div>';	

			$body.='<div class="col-md-12 pad06">';
				$body.='<div class="card ecom-widget-sales border-primary " style="border-width: 3.5px;">
						<h5 style=" padding: 0.5rem 0.8rem; font-size:0.92rem; margin-bottom: 0.3rem;"  >Respuesta OT N° '.$id.'</h5>
				<div class="row" style="padding-left:0.8rem; padding-right:0.8rem">';
				$body.='<div class="col-md-4 ">';
					$body.=	'<div Class="card ecom-widget-sales">';
						$body.=	'<div class="card-body"><ul class="list-group">';
						$body.='<li class="list-group-item"> Respuesta Coordinador <span><div class="row">';
							$body.='<div class="col-md-12 form-group " >';
							$body.='<textarea class="form-control" style="font-size: 0.7rem;" rows="5" name="txt_resadd" id="txt_resadd" placeholder="Respuesta" data-plugin="maxlength" data-placement="bottom-right-inside" maxlength="2000" ></textarea>';
							$body.='</div>';
						$body.='</div></span></li>';	
						$body.='</ul></div>';
					$body.='</div>';
				$body.='</div>';
				$body.='<div class="col-md-4">';
					$body.=	'<div Class="card ecom-widget-sales">';
						$body.=	'<div class="card-body"><ul class="list-group">';
						$body.='<li class="list-group-item"> Adjuntar Archivos <span><div class="row">';
						$body.='<div class="col-md-12 row form-group" style="margin-top:0.3rem;"  id="duplicar">';
							$body.='<div  class="col-md-12 row form-group file" style="padding-right:0px;">';
								$body.=	'<div class="col-md-2 " style="margin-top:0.3rem;">';
								$body.=	'<label for="txt_archivosolicadd0" class="btn btn-theme "><i class="fa fa-upload"></i></label>';
								$body.='<input type="file" style="display:none;" name="txt_archivosolicadd0" id="txt_archivosolicadd0" onchange="file(0)">';
								$body.='</div>'; 
								$body.=	'<div class="col-md-10 " style="padding-left:20px !important; padding-left:0px;"><input placeholder="Nombre Archivo" style="font-size: 0.7rem;" type="text" class="form-control" name="txt_nomsoliadd0" id="txt_nomsoliadd0"></div>';
							$body.='</div>';
						$body.='</div>';						
						$body.='<div class="col-md-12 row form-group" style="margin-top:0.3rem;">';
						$body.='<input type="hidden" name="duplicados" id="duplicados" value="1">';
						$body.='<div class=" col-md-12 btn-group">';
						$body.='<button class="btn btn-sm btn-outline-theme" id="agregar" onclick="agregararchcoor()"><i class="fa fa-plus"></i>Agregar</button>&nbsp;&nbsp;
							<button class="btn btn-sm btn-outline-theme" style="display:none;" id="eliminar" onclick="eliminararch()"><i class="fa fa-times"></i>Quitar</button>';
						$body.='</div>';
						$body.='</div>';
						$body.='<input type="hidden"  name="txt_solicitudidadd" id="txt_solicitudidadd" value="'.$id.'">';
						$body.='</div></span></li>';
						$body.='</ul></div>';
					$body.='</div>';
				$body.='</div>';
				$body.='<div class="col-md-4">';
					$body.=	'<div Class="card ecom-widget-sales">';
						$body.=	'<div class="card-body"><ul class="list-group">';
						$body.='<li class="list-group-item"> Archivos Coordinador <span><div class="row">';
						$archivos=$this->solicitud_ot->archivoscoordinador($id,$_SESSION["usuario"]);
						foreach ($archivos as $s) {
							if($s["ext"]=="jpeg" || $s["ext"]=="jpg" || $s["ext"]=="png"){
									$body.='<a href="'.$s["archivo_adjunto"].'" target="_blank" class="col-md-4 pad06" style="margin-bottom:0.3rem;">
										<div class="card" style="margin-bottom:0.2rem;"><img class="card-img-top" src="'.$s["archivo_adjunto"].'"></div><small>'.$s["nombre_archivo"].'</small></a>';
								} else if($s["ext"]=="pdf"){ 
									$body.='<a href="'.$s["archivo_adjunto"].'" target="_blank" class="col-md-4 pad06" style="margin-bottom:0.3rem;">
										<div class="card" style="margin-bottom:0.2rem;"><div class="card-body" style="padding: 0.5rem">
										<h1 class="h1 text-center text-theme" style="font-size: 2.6rem;"><i class="mdi mdi-file-pdf-box"></i></h1>
									</div></div><small>'.$s["nombre_archivo"].'</small></a>';
								} else if($s["ext"]=="doc" || $s["ext"]=="docx"){ 
									$body.='<a href="'.$s["archivo_adjunto"].'" target="_blank" class="col-md-4 pad06" style="margin-bottom:0.3rem;">
										<div class="card" style="margin-bottom:0.2rem;"><div class="card-body" style="padding: 0.5rem">
										<h1 class="h1 text-center text-theme" style="font-size: 2.6rem;"><i class="mdi mdi-file-word-box"></i></h1>
									</div></div><small>'.$s["nombre_archivo"].'</small></a>';
								} else if($s["ext"]=="xls" || $s["ext"]=="xlsx"){ 
									$body.='<a href="'.$s["archivo_adjunto"].'" target="_blank" class="col-md-4 pad06" style="margin-bottom:0.3rem;">
										<div class="card" style="margin-bottom:0.2rem;"><div class="card-body" style="padding: 0.5rem">
										<h1 class="h1 text-center text-theme" style="font-size: 2.6rem;"><i class="mdi mdi-file-excel-box"></i></h1>
									</div></div><small>'.$s["nombre_archivo"].'</small></a>';
								}  else if($s["ext"]=="ppt" || $s["ext"]=="pptx"){ 
									$body.='<a href="'.$s["archivo_adjunto"].'" target="_blank" class="col-md-4 pad06" style="margin-bottom:0.3rem;">
										<div class="card" style="margin-bottom:0.2rem;"><div class="card-body" style="padding: 0.5rem">
										<h1 class="h1 text-center text-theme" style="font-size: 2.6rem;"><i class="mdi mdi-file-powerpoint-box"></i></h1>
									</div></div><small>'.$s["nombre_archivo"].'</small></a>';
								} else { 
									$body.='<a href="'.$s["archivo_adjunto"].'" target="_blank" class="col-md-4 pad06" style="margin-bottom:0.3rem;">
										<div class="card" style="margin-bottom:0.2rem;"><div class="card-body" style="padding: 0.5rem">
										<h1 class="h1 text-center text-theme" style="font-size:2.6rem;"><i class="mdi mdi-file-document-box"></i></h1>
									</div></div><small>'.$s["nombre_archivo"].'</small></a>';
								} 
						}
						$body.='</div></span></li>';
						$body.='</ul></div>';
					$body.='</div>';
				$body.='</div>';
				$body.='</div></div>';
			$body.='</div>';

			$body.='</div>';
				

				$body.='<script>';	
					$body.='$(document).ready(function() {	';									
						$body.='$("#txt_fechaestimada").daterangepicker({';
							$body.='"singleDatePicker": true,';
								if($solicitud[0]["fecha_estimada"]!=="POR DEFINIR"){
									$body.='"startDate": "'.$solicitud[0]["fecha_estimada"].'", "autoUpdateInput": true,'; 
								} else {
									$body.='"autoUpdateInput": false,';
								}
							$body.='"applyButtonClasses": "btn-warning",';
			   				$body.=' "locale": {';
			        			$body.='"format": "DD-MM-YYYY",';
			        			$body.='"separator": " - ",';
								$body.='"applyLabel": "Seleccionar",';
								$body.='"cancelLabel": "Cancelar",';
								$body.='"fromLabel": "From",';
								$body.='"toLabel": "To",';
								$body.='"customRangeLabel": "Custom",';
								$body.='"weekLabel": "W",';
								$body.='"daysOfWeek": ["Do","Lu","Ma","Mi","Ju","Vi","Sá"],';
								$body.='"monthNames": [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],';
								$body.='"firstDay": 1';
								$body.='}';
							$body.='},function(chosen_date) { ';
								$body.='var x=new Date(); ';
      							$body.='var fecha = chosen_date.format("DD-MM-YYYY").split("-"); ';
      							$body.='x.setFullYear(fecha[2],fecha[1]-1,fecha[0]); ';
      							$body.='var today = new Date(); '; 
								$body.='if (x >= today) {';
									$body.='$("#txt_fechaestimada").val(chosen_date.format("DD-MM-YYYY")); ';
								$body.='} else {';
									$body.='alert("La fecha estimada debe ser posterior al día de hoy."); ';
									$body.='$("#txt_fechaestimada").val(""); }';
		        				$body.='});';
		        			$body.='});';
						$body.='</script>';
					$body.='</div>';
				$body.='</div>';
			$body.='</div>';		
			$title=$solicitud[0]["titulo"].'&nbsp;&nbsp;&nbsp;&nbsp;<div class="btn-group"><a href="'.base_url().'solicitudes_ot/export/'.base64_encode($id).'" class="btn btn-sm btn-theme " title="Exportar A PDF"><i class="fa fa-file-pdf-o"></i></a></div>';
			echo json_encode(array("titulo"=>$title,"cuerpo"=>$body));
		} else {
			redirect(base_url("login"));
		}
	}

	public function solicitud(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("solicitud_ot");
			$this->load->model("tarea");
			$id=base64_decode($_POST["id"]);
			$solicitud=$this->solicitud_ot->solicitud($id);
			$estados=$this->solicitud_ot->solicitudestados($id);
			$body='<div class="row">';
				$body.='<div class="col-md-3 pad06">';
					$body.='<div class="card ecom-widget-sales border">';
					$body.='<div class="card-body"><ul class="list-group">';				
						$body.='<li class="list-group-item ">Cadena <span>'.$solicitud[0]["cadena"].'</span></li>';	
						$body.='<li class="list-group-item ">Local<span>'.$solicitud[0]["local"].'</span></li>';
						$body.='<li class="list-group-item ">Dirección Local<span>'.$solicitud[0]["direccion"].', '.$solicitud[0]["ciudad"].'</span></li>';
						$body.='<li class="list-group-item ">Campaña <span>'.$solicitud[0]["campana"].'</span></li>';
						$body.='<li class="list-group-item">Fecha Creación <span>'.$solicitud[0]["fecha_registro"].'</span></li>';
						$body.='<li class="list-group-item">Solicitante <span>'.$solicitud[0]["nom_solicitante"].'</span></li>';
						$body.='<li class="list-group-item">Responsable <span>'.$solicitud[0]["usuario"].'</span></li>';
					$body.='</ul></div>';
					$body.='</div>';
				$body.='</div>';				
				$body.='<div class="col-md-3 pad06">';
					$body.='<div class="card ecom-widget-sales border">';
						$body.='<div class="card-body"><ul class="list-group">';
							$body.='<li class="list-group-item">Asunto <span>'.$solicitud[0]["asunto"].'</span></li>';
							$body.='<li class="list-group-item">Comentario <span>'.$solicitud[0]["comentario"].'</span></li>';					
							$body.='<li class="list-group-item ">Estado <span>'.$solicitud[0]["estado"].'</span></li>';
							$body.='<li class="list-group-item">Fecha Cierre Real <span>'.$solicitud[0]["fecha_estimada"].'</span></li>';
							
							$body.='<li class="list-group-item">Tipo Tarea <span>'.$solicitud[0]["tipo_tarea"].'</span></li>';
							$body.='</ul></div>';
					$body.='</div>';
				$body.='</div>';
				$body.='<div class="col-md-6 pad06"><div class="row">';
					$body.='<div class="col-md-12 ">';
					$body.='<div class="card ecom-widget-sales border">';
					$body.='<div class="card-body"><ul class="list-group">';
						$body.='<li class="list-group-item">Archivos Solicitante<span><div class="row" style="margin-top:0.5rem;">';
								foreach($solicitud as $s){
									if($s["ext"]=="jpeg" || $s["ext"]=="jpg" || $s["ext"]=="png"){
										$body.='<a href="'.$s["archivo_adjunto"].'" target="_blank" class="col-md-3" style="margin-bottom:0.3rem;">
											<div class="card" style="margin-bottom:0.2rem;"><img class="card-img-top" src="'.$s["archivo_adjunto"].'"></div><small>'.$s["nombre_archivo"].'</small></a>';
									} else if($s["ext"]=="pdf"){ 
										$body.='<a href="'.$s["archivo_adjunto"].'" target="_blank" class="col-md-3" style="margin-bottom:0.3rem;">
											<div class="card" style="margin-bottom:0.2rem;"><div class="card-body" style="padding: 0.5rem">
											<h1 class="h1 text-center text-theme" style="font-size: 3.6rem;"><i class="mdi mdi-file-pdf-box"></i></h1>
										</div></div><small>'.$s["nombre_archivo"].'</small></a>';
									} else if($s["ext"]=="doc" || $s["ext"]=="docx"){ 
										$body.='<a href="'.$s["archivo_adjunto"].'" target="_blank" class="col-md-3" style="margin-bottom:0.3rem;">
											<div class="card" style="margin-bottom:0.2rem;"><div class="card-body" style="padding: 0.5rem">
											<h1 class="h1 text-center text-theme" style="font-size: 3.6rem;"><i class="mdi mdi-file-word-box"></i></h1>
										</div></div><small>'.$s["nombre_archivo"].'</small></a>';
									} else if($s["ext"]=="xls" || $s["ext"]=="xlsx"){ 
										$body.='<a href="'.$s["archivo_adjunto"].'" target="_blank" class="col-md-3" style="margin-bottom:0.3rem;" >
											<div class="card" style="margin-bottom:0.2rem;"><div class="card-body" style="padding: 0.5rem">
											<h1 class="h1 text-center text-theme" style="font-size: 3.6rem;"><i class="mdi mdi-file-excel-box"></i></h1>
										</div></div><small>'.$s["nombre_archivo"].'</small></a>';
									} else if($s["ext"]=="ppt" || $s["ext"]=="pptx"){ 
										$body.='<a href="'.$s["archivo_adjunto"].'" target="_blank" class="col-md-3" style="margin-bottom:0.3rem;">
											<div class="card" style="margin-bottom:0.2rem;"><div class="card-body" style="padding: 0.5rem">
											<h1 class="h1 text-center text-theme" style="font-size: 3.6rem;"><i class="mdi mdi-file-powerpoint-box"></i></h1>
										</div></div><small>'.$s["nombre_archivo"].'</small></a>';
									} else { 
										$body.='<a href="'.$s["archivo_adjunto"].'" target="_blank" class="col-md-3" style="margin-bottom:0.3rem;">
											<div class="card"  style="margin-bottom:0.2rem;"><div class="card-body" style="padding: 0.5rem">
											<h1 class="h1 text-center text-theme" style="font-size: 3.6rem;"><i class="mdi mdi-file-document-box"></i></h1>
										</div></div><small>'.$s["nombre_archivo"].'</small></a>';
									} 
									
								}
							$body.='</div></span></li>';
					$body.='</ul></div>';
					$body.='</div>';
					$body.='</div>';
					$body.='<div class="col-md-12 ">';
						$body.='<div class="card ecom-widget-sales border">';
						$body.='<div class="card-body"><ul class="list-group">';
						$body.='<li class="list-group-item">Historial de Cambios<span><div class="table-responsive" style="margin-top:0.5rem; margin-bottom: 0.2rem">';
							$body.='<table class="table" style="text-align:center;"><thead><tr ><th>Usuario</th><th>Estado</th><th>Comentario</th><th>Fecha</th></tr></thead><tbody style="color: #536c79; font-weight: 400;">';
								foreach ($estados as $e) {
									$body.='<tr><td style="font-size: 0.71rem;">'.$e["nombre"].'</td>
										<td style="font-size: 0.71rem;">'.$e["estado"].'</td>
										<td style="font-size: 0.71rem;">'.$e["comentario"].'</td>
										<td style="font-size: 0.71rem;">'.date("d-m-Y H:i",strtotime($e["fecha_registro"])).'</td></tr>';
								}
							$body.='</tbody></table>';
						$body.='</div></span></li>';
						$body.='</ul></div>';
						$body.='</div>';
					$body.='</div>';
				$body.='</div></div>';

				$body.='<div class="col-md-12 pad06">';
					$body.='<div class="card ecom-widget-sales border-primary " style="border-width: 3.5px;">
						<h5 style=" padding: 0.5rem 0.8rem; font-size:0.92rem; margin-bottom: 0.3rem;"  >Respuesta OT N° '.$id.'</h5>
						<div class="row" style="padding-left:0.8rem; padding-right:0.8rem">';
						$body.='<div class="col-md-5">';
						$body.=	'<div class="card ecom-widget-sales">';
							$body.=	'<div class="card-body"><ul class="list-group">';
							if(is_null($solicitud[0]["respuesta_coordinador"])){
								$body.='<li class="list-group-item">Respuesta Coordinador <span>PENDIENTE POR RESPONDER</span></li>';
							} else {
								$body.='<li class="list-group-item">Respuesta Coordinador <span>'.$solicitud[0]["respuesta_coordinador"].'</span></li>';
							}	
							$body.='</ul></div>';
						$body.='</div>';
						$body.='</div>';
						$body.='<div class="col-md-7">';
						$body.=	'<div Class="card ecom-widget-sales">';
							$body.='<div class="card-body"><ul class="list-group">';
								$body.='<li class="list-group-item">Archivos Coordinador <span><div class="row" style="margin-top:0.5rem;">';
								$archivos=$this->solicitud_ot->archivoscoordinador($id,$solicitud[0]["receptor"]);
								foreach ($archivos as $s) {
									if($s["ext"]=="jpeg" || $s["ext"]=="jpg" || $s["ext"]=="png"){
											$body.='<a href="'.$s["archivo_adjunto"].'" target="_blank" class="col-md-3" style="margin-bottom:0.3rem;">
												<div class="card" style="margin-bottom:0.2rem;"><img class="card-img-top" src="'.$s["archivo_adjunto"].'"></div><small>'.$s["nombre_archivo"].'</small></a>';
										} else if($s["ext"]=="pdf"){ 
											$body.='<a href="'.$s["archivo_adjunto"].'" target="_blank" class="col-md-3" style="margin-bottom:0.3rem;">
												<div class="card" style="margin-bottom:0.2rem;"><div class="card-body" style="padding: 0.5rem">
												<h1 class="h1 text-center text-theme" style="font-size: 3.6rem;"><i class="mdi mdi-file-pdf-box"></i></h1>
											</div></div><small>'.$s["nombre_archivo"].'</small></a>';
										} else if($s["ext"]=="doc" || $s["ext"]=="docx"){ 
											$body.='<a href="'.$s["archivo_adjunto"].'" target="_blank" class="col-md-3" style="margin-bottom:0.3rem;">
												<div class="card" style="margin-bottom:0.2rem;"><div class="card-body" style="padding: 0.5rem">
												<h1 class="h1 text-center text-theme" style="font-size: 3.6rem;"><i class="mdi mdi-file-word-box"></i></h1>
											</div></div><small>'.$s["nombre_archivo"].'</small></a>';
										} else if($s["ext"]=="xls" || $s["ext"]=="xlsx"){ 
											$body.='<a href="'.$s["archivo_adjunto"].'" target="_blank" class="col-md-3" style="margin-bottom:0.3rem;">
												<div class="card" style="margin-bottom:0.2rem;"><div class="card-body" style="padding: 0.5rem">
												<h1 class="h1 text-center text-theme" style="font-size: 3.6rem;"><i class="mdi mdi-file-excel-box"></i></h1>
											</div></div><small>'.$s["nombre_archivo"].'</small></a>';
										} else if($s["ext"]=="ppt" || $s["ext"]=="pptx"){ 
											$body.='<a href="'.$s["archivo_adjunto"].'" target="_blank" class="col-md-3" style="margin-bottom:0.3rem;">
												<div class="card" style="margin-bottom:0.2rem;"><div class="card-body" style="padding: 0.5rem">
												<h1 class="h1 text-center text-theme" style="font-size: 3.6rem;"><i class="mdi mdi-file-powerpoint-box"></i></h1>
											</div></div><small>'.$s["nombre_archivo"].'</small></a>';
										} else { 
											$body.='<a href="'.$s["archivo_adjunto"].'" target="_blank" class="col-md-3" style="margin-bottom:0.3rem;">
												<div class="card" style="margin-bottom:0.2rem;"><div class="card-body" style="padding: 0.5rem">
												<h1 class="h1 text-center text-theme" style="font-size: 3.6rem;"><i class="mdi mdi-file-document-box"></i></h1>
											</div></div><small>'.$s["nombre_archivo"].'</small></a>';
										} 
								}
								$body.='</div></span></li>';
							$body.='</ul></div>';
						$body.='</div>';
						$body.='</div>';
					$body.='</div>';
				$body.='</div>';

					$body.='</div></div>';
				$body.='</div>';
			$body.='</div>';
			$title=$solicitud[0]["titulo"].'&nbsp;&nbsp;&nbsp;&nbsp;<div class="btn-group"><a href="'.base_url().'solicitudes_ot/export/'.base64_encode($id).'" class="btn btn-sm btn-theme " title="Exportar A PDF"><i class="fa fa-file-pdf-o"></i></a></div>';
			echo json_encode(array("titulo"=>$title,"cuerpo"=>$body));
		} else {
			redirect(base_url("login"));
		}
	}


	public function export($id){
		$this->load->library('pdfhtml');
		$this->load->model("solicitud_ot");
		$filename = "DETALLE OT N° ".base64_decode($id);
		$data["solicitud"]=$this->solicitud_ot->solicitud(base64_decode($id));
	  	$this->pdfhtml->load_view('ot/pdf',$data);
	  	$this->pdfhtml->render();
	  	$this->pdfhtml->setPaper('letter', 'portrait');
	  	$this->pdfhtml->stream($filename.".pdf");
	}

	public function addrespsolicitante(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					$this->load->model("solicitud_ot");
					$vacios=0;
					if((!isset($_POST["txt_solicitudidadd"])) || $_POST["txt_solicitudidadd"]==""){
						$vacios+=1;
					}
					if((!isset($_POST["rad_res"])) || $_POST["rad_res"]==""){
						$vacios+=1;
					} else if($_POST["rad_res"]=="1"){
						if((!isset($_POST["txt_resadd"])) || $_POST["txt_resadd"]==""){
							$vacios+=1;
						}
					}
					if($vacios!=0){
						$data["mensaje"]="Respuesta no pudo ser guardada, intente nuevamente";
					} else {
						$id_solicitud=$_POST["txt_solicitudidadd"];
						$evaluacion=$_POST["rad_res"];
						$usuario=$_SESSION["usuario"];
						if((!isset($_POST["txt_resadd"])) || $_POST["txt_resadd"]==""){
							$respuesta="";
						} else {
							$respuesta=$_POST["txt_resadd"];
						}
						if(isset($_POST["txt_filesubmit0"])){
							if($_POST["txt_filesubmit0"]==$_POST["txt_solicitudidadd"]){
								if(isset($_FILES["txt_archivosolicadd0"]) && strlen($_FILES["txt_archivosolicadd0"]["name"])>0){
									$ar=explode('.', strtolower($_FILES["txt_archivosolicadd0"]["name"]));
									$ext= end($ar);
									$nom=$_POST["txt_solicitudidadd"].date("dmYHisu").".".$ext;
									$archivo=$this->archivo("txt_archivosolicadd0",$nom);
								} else {
									$archivo=$_POST["txt_filesubmit0"];
								}
							} else {
								$archivo=$_POST["txt_filesubmit0"];
							}
							$accion=2;
						} else {
							if(isset($_FILES["txt_archivosolicadd0"]) && strlen($_FILES["txt_archivosolicadd0"]["name"])>0){
								$ar=explode('.', strtolower($_FILES["txt_archivosolicadd0"]["name"]));
								$ext= end($ar);
								$nom=$_POST["txt_solicitudidadd"].date("dmYHisu").".".$ext;
								$archivo=$this->archivo("txt_archivosolicadd0",$nom);
							} else {
								$archivo="";
							}
							$accion=1;
						}
						$add=$this->solicitud_ot->respuesta_solicitante($id_solicitud,$evaluacion,$usuario,$respuesta,$archivo,$accion);
						if(isset($add["mensaje"])){
							//Enviar Correo a Solicitante
							$this->send($add["asunto"],$this->solicitud_ot->correo($_SESSION["usuario"])["email"],$add["pagina"],$add["solicitud"]);
							//Enviar Correo a Coordinador
							$this->send($add["asunto"],$add["coordinador"],$add["pagina"],$add["solicitud"]);
							$data["mensaje"]=$add["mensaje"];
						} else {
							$data["mensaje"]="Respuesta no pudo ser guardada, intente nuevamente";
						}
					}
					$this->load->view('contenido');
					$this->load->view('alertas/alertas',$data);
				} else {
					redirect(base_url("informes/campanas"));
				}
			} else {
				redirect(base_url("home"));				
			}
		} else {
			redirect(base_url("login"));
		}

	}

	public function addrespcoordinador(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("solicitud_ot");
			$vacios=0;
			if((!isset($_POST["txt_solicitudidadd"])) || $_POST["txt_solicitudidadd"]==""){
				$vacios+=1;
			}
			if((!isset($_POST["lbl_estado"])) || $_POST["lbl_estado"]==""){
				$vacios+=1;
			} else {
				if($_POST["lbl_estado"]==2){
					if((!isset($_POST["totalarchivo"])) || $_POST["totalarchivo"]==""){
						$vacios+=1;
					} else {
						for ($i=0; $i < $_POST["totalarchivo"] ; $i++) { 
							if(!isset($_POST["txt_filesubmit".$i])){
								if(!isset($_FILES["txt_archivosolicadd".$i])){
									$vacios+=1;
								}
								if((!isset($_POST["txt_nomsoliadd".$i])) || $_POST["txt_nomsoliadd".$i]==""){
									$vacios+=1;
								}
							}
						}
					}
				} else if($_POST["lbl_estado"]==3){
					if((!isset($_POST["txt_fechaestimada"])) || $_POST["txt_fechaestimada"]==""){
						$vacios+=1;
					}
				} else if($_POST["lbl_estado"]==4 || $_POST["lbl_estado"]==5){
					if((!isset($_POST["txt_resadd"])) || $_POST["txt_resadd"]==""){
						$vacios+=1;
					}
				}

			}

			if($vacios!=0){
				$data["mensaje"]="Respuesta no pudo ser guardada, intente nuevamente";
			} else {
				$rep=array("'","\"");
				$id_solicitud=$_POST["txt_solicitudidadd"];
				$estado=$_POST["lbl_estado"];
				$fechaestimada=($_POST["txt_fechaestimada"]!="") ? "'".date("Ymd",strtotime($_POST["txt_fechaestimada"]))."'" : "NULL";
				$respuesta=($_POST["txt_resadd"]!="") ? "'".str_replace($rep,"",$_POST["txt_resadd"])."'" : "NULL";
				$usuario=$_SESSION["usuario"];
				for ($i=0; $i < $_POST["totalarchivo"] ; $i++) { 
					if(isset($_POST["txt_nomsoliadd".$i]) || $_POST["txt_nomsoliadd".$i]!=""){
						if(isset($_POST["txt_filesubmit".$i])){
							if($_POST["txt_filesubmit".$i]==$_POST["txt_solicitudidadd"]){
								if(isset($_FILES["txt_archivosolicadd".$i]) && strlen($_FILES["txt_archivosolicadd".$i]["name"])>0){
									$ar=explode('.', strtolower($_FILES["txt_archivosolicadd".$i]["name"]));
									$ext= end($ar);
									$nom=$_POST["txt_solicitudidadd"].date("dmYHisu").$i.".".$ext;
									$archivo=$this->archivo("txt_archivosolicadd".$i,$nom);
								} else {
									$archivo=$_POST["txt_filesubmit".$i];
								}
							} else {
								$archivo=$_POST["txt_filesubmit".$i];
							}
							$accion=2;
						} else {
							if(isset($_FILES["txt_archivosolicadd".$i]) && strlen($_FILES["txt_archivosolicadd".$i]["name"])>0){
								$ar=explode('.', strtolower($_FILES["txt_archivosolicadd".$i]["name"]));
								$ext= end($ar);
								$nom=$_POST["txt_solicitudidadd"].date("dmYHisu").$i.".".$ext;
								$archivo=$this->archivo("txt_archivosolicadd".$i,$nom);
							} else {
								$archivo="";
							}
							$accion=1;
						}
						$nombre=str_replace($rep,"",$_POST["txt_nomsoliadd".$i]);
						$this->solicitud_ot->respuesta_archivo($id_solicitud,$usuario,$archivo,$nombre,$accion,($i+1));
					}					
				}
				$add=$this->solicitud_ot->respuesta_coordinador($id_solicitud,$estado,$fechaestimada,$usuario,$respuesta);
				if(isset($add["mensaje"])){
							//Enviar Correo a Coordinador
					$this->send($add["asunto"],$this->solicitud_ot->correo($_SESSION["usuario"])["email"],$add["pagina"],$add["solicitud"]);
							//Enviar Correo a Solicitante
					$this->send($add["asunto"],$add["solicitante"],$add["pagina"],$add["solicitud"]);
					$data["mensaje"]=$add["mensaje"];
				} else {
					$data["mensaje"]="Respuesta no pudo ser guardada, intente nuevamente";
				}
			}
			echo $data["mensaje"];
		} else {
			redirect(base_url("login"));
		}
	}


	public function solicitud_estado(){
		if(isset($_SESSION["sesion"])){
				$this->load->model("solicitud_ot");
				$empresa=(isset($_POST["empresa"])) ? $_POST["empresa"] : base64_decode($_SESSION["empresa"]);
				$anio=$_POST["anio"];
				$mes=$_POST["mes"];
				echo json_encode($this->solicitud_ot->solicitudes_estado($empresa,$_SESSION["usuario"],$mes,$anio));
		}
	}

	public function solicitud_semaforo(){
		if(isset($_SESSION["sesion"])){
				$this->load->model("solicitud_ot");
				$empresa=(isset($_POST["empresa"])) ? $_POST["empresa"] : base64_decode($_SESSION["empresa"]);
				$anio=$_POST["anio"];
				$mes=$_POST["mes"];
				echo json_encode($this->solicitud_ot->solicitudes_semaforo($empresa,$_SESSION["usuario"],$mes,$anio));
		}
	}

	public function addmensaje(){
		if(isset($_SESSION["sesion"])){
					$this->load->model("solicitud_ot");
					$mensaje=$_POST["mensaje"];
					$id_solicitud=base64_decode($_POST["id"]);
					$mensaje=$this->solicitud_ot->addmensaje($id_solicitud,$_SESSION["usuario"],$mensaje);
					$this->sendmensaje($_SESSION["usuario"],$id_solicitud);
					$chat="<ul>";
					foreach ($mensaje as $m) {
						if($m["emisor"]==$_SESSION["usuario"]){
							$class="you";
						} else {
							$class="other";
						}
						$chat.="<li class='".$class."'>
							<div class='date'>".$m["hora"]."</div>
							<div class='message'><p>".$m["mensaje"]."</p></div>
						</li>";
					}
					$chat.="</ul>";
					echo $chat;
		}
	}


	public function mensajes(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("solicitud_ot");
			$id_solicitud=base64_decode($_POST["id"]);
			$mensaje=$this->solicitud_ot->mensajes($id_solicitud);
			$chat="<ul id='chatList'>";
			foreach ($mensaje as $m) {
				if($m["emisor"]==$_SESSION["usuario"]){
					$class="you";
				} else {
					$class="other";
				}
				$chat.="<li class='".$class."'>
				<div class='date'>".$m["hora"]."   </div>
				<div class='message'><p>".$m["mensaje"]."</p></div>
				</li>";
			}
			$chat.="</ul>";
			echo $chat;
		}

	}


	function findNameFromIDEst($array,$ID) {
	     return array_values(array_filter($array, function($arrayValue) use($ID) { return $arrayValue['id_estado'] == $ID; } ));
	}

	function findNameFromIDReg($array,$ID) {
	     return array_values(array_filter($array, function($arrayValue) use($ID) { return $arrayValue['id_region'] == $ID; } ));
	}


	function archivo($name,$filename){

		$uploadfile=$name;

		$config['upload_path'] = "archivos/solicitudes/";
		$config['file_name'] =$filename;
		$config['allowed_types'] = "*";
		$config['overwrite'] = TRUE;
		$config['encrypt_name'] = TRUE;
		$file=explode(".", $filename);
		
		$this->upload->initialize($config);

		if (!$this->upload->do_upload($uploadfile)) {
		// 			//*** ocurrio un error
			$data['uploadError'] = $this->upload->display_errors();
			echo $this->upload->display_errors();
			return;
		}

		$data = $this->upload->data();

		if(end($file)=="jpg" || end($file)=="jpeg" || end($file)=="png"){
			
			$tamano = $data['file_size'];
			$ancho = $data['image_width'];
			$alto = $data['image_height'];
			if($tamano >= 20000 || $ancho >= 9500 || $alto >= 9500){
				$var = "2";
				return $var;
			}
			$config['image_library'] = 'gd2';  
			$config['source_image'] = 'archivos/solicitudes/'.$data["file_name"];  
			$config['create_thumb'] = FALSE;  
			$config['maintain_ratio'] = FALSE;  
			$config['quality'] = '60%';  
			$config['width'] = 800;  
			$config['height'] = 600;  
			$config['new_image'] = 'archivos/solicitudes/'.$data["file_name"];  
			$this->load->library('image_lib', $config); 
			$this->image_lib->clear();
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
		}
		return $data['file_name'];
	}



	function send($asunto,$correo,$vista,$id){
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
        $data["data"]=$this->solicitud_ot->solicitud($id);
        $mail->Body = $this->load->view($vista,$data,true);
        
        // Send email
        if(!$mail->send()){
            return false;
        }else{
            return true;
        }
    }


    function sendmensaje($usuario,$id){
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


        $data["data"]=$this->solicitud_ot->solicitudmensaje($id,$usuario);
        // Add a recipient
        $mail->addAddress($correo);
        
        // Email subject
        $mail->Subject = 'Nuevo Mensaje OT N° '.$id;
       

        // Set email format to HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        // Email body content
        $mail->Body = $this->load->view('ot/correorespusuario',$data,true);
        
        // Send email
        if(!$mail->send()){
            return false;
        }else{
            return true;
        }
    }

}

?>