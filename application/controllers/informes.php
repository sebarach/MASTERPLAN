<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class informes extends CI_Controller {
	 public function __construct()
    {
                parent::__construct();
                // Your own constructor code
               $this->load->library('upload');
    }
	public function informe(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					$this->load->model("campana");
					$this->load->model("empresa");
					$anio=(isset($_POST["anio"])) ? (!empty($_POST["anio"])) ? $_POST["anio"] : date("Y") : date("Y");
					$buscasan=1;		
					$data['opcion']=$buscasan;	
					$data["anio"]=$anio;
					$data["nombre"]=$_SESSION["nombre"];		
					$data["cc"]=$this->campana->campanapdv(base64_decode($_SESSION["campana"]));					
					$data["cim"]=$this->campana->campanalocales(base64_decode($_SESSION["campana"]),0,0,0,0,0,0,0,0,0,0,$buscasan);			
					$data["empresa"]=$this->empresa->empresa(base64_decode($_SESSION["empresa"]));					
					$data["cf"]=$this->campana->campanafecha(base64_decode($_SESSION["campana"]),0,0,0,0,0,0,0,0,0,0);
					if(count($data["cim"])>0){
						$tempoCantidad = $data["cim"][0]["total"];
						$data['cantidad'] = ceil(($tempoCantidad+1)/20);
					} else {
						$tempoCantidad = 0;
						$data['cantidad'] = 0;
					}							
					$this->load->view('contenido_dashboard');
					$this->load->view('layout/menu',$data);
					$this->load->view('informes/informe',$data);
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
	public function detalle($id_unico){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				$this->load->model("campana");
				$this->load->model("empresa");
				$data["cliente"]=$this->campana->campanaclientesinfo(base64_decode($id_unico));
				$data["mat"]=$this->campana->campanaclientesdetalle(base64_decode($id_unico));
				$data["fotos"]=$this->campana->campanaclientesfotos(base64_decode($id_unico));
				$data["empresa"]=$this->empresa->empresa(base64_decode($_SESSION["empresa"]));	
				$this->load->view('contenido');
				$this->load->view('informes/det_implementacion',$data);
			} else {
				redirect(base_url("login"));
			}
		} else {
			redirect(base_url("login"));
		}
	}
	public function motivos(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					$this->load->model("campana");
					echo json_encode($this->campana->listarmotivos(base64_decode($_SESSION["campana"])));
				}
			}
		}
	}
	public function ciudades(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					$this->load->model("solicitud_ot");
					if(isset($_POST["region"])){
						$region=$_POST["region"];
					} else {
						$region=0;	
					}
					echo json_encode($this->solicitud_ot->comunas(base64_decode($_SESSION["empresa"]),base64_decode($_SESSION["campana"]),$region,0,0,0,0,0,0,0,0));
				}
			}
		}
	}
	public function detalleinfo($id_unico){
		if(isset($_SESSION["sesion"])){
			$this->load->model("campana");
			$data["cliente"]=$this->campana->campanaclientesinfo(base64_decode($id_unico));
			$data["mat"]=$this->campana->campanaclientesdetalle(base64_decode($id_unico));
			$data["fotos"]=$this->campana->campanaclientesfotos(base64_decode($id_unico));
			$this->load->view('contenido');
			$this->load->view('informes/det_impl_info',$data);
		} else {
			redirect(base_url("login"));
		}
	}
	public function campanas(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				$this->load->model("empresa");
				$this->load->model("campana");
				if(isset($_POST["campana"])){
					if(!empty($_POST["campana"])){
						$campana=$_POST["campana"];
					} else {
						$campana=0;
						}
				} else {
					$campana=0;
				}
				$data["campana"]=$campana;
				$data["anio"]=base64_decode($_SESSION["anio"]);
				$data["empresa"]=$this->empresa->empresa(base64_decode($_SESSION["empresa"]));
				$data["nombre"]=$_SESSION["nombre"];
				$data["campanas"]=$this->campana->campanas(base64_decode($_SESSION["empresa"]),base64_decode($_SESSION["anio"]));
				$this->load->view('contenido');
				$this->load->view('layout/menu_default',$data);
				$this->load->view('informes/campana',$data);
			} else {
				redirect(base_url("home"));
			}
		} else {
			redirect(base_url("login"));
		}
	}
	public function reporte(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					$this->load->model("campana");
					$this->load->model("solicitud_ot");
					$data["nombre"]=$_SESSION["nombre"];
					$region=(isset($_POST["region"])) ? (!empty($_POST["region"])) ? $_POST["region"] : 0 : 0; 
					$ciudad=(isset($_POST["ciudad"])) ? (!empty($_POST["ciudad"])) ?str_replace('_',' ', $_POST["ciudad"]) : 0 : 0;
					$sucursal=(isset($_POST["sucursal"])) ? (!empty($_POST["sucursal"])) ? $_POST["sucursal"] : 0 : 0;
					$fecha_programada=(isset($_POST["fecha_programada"])) ?  (!empty($_POST["fecha_programada"])) ? date("Ymd",strtotime($_POST["fecha_programada"])) : 0 : 0;
					$fecha_real=(isset($_POST["fecha_real"])) ? (!empty($_POST["fecha_real"])) ? date("Ymd",strtotime($_POST["fecha_real"])) : 0 : 0;
					$motivo=(isset($_POST["motivo"])) ? (!empty($_POST["motivo"])) ? $_POST["motivo"] : "0" : "0";
					$buscasan = (isset($_POST['opcion'])) ? (is_numeric($_POST['opcion'])) ?  $_POST['opcion'] : 1 : 1;
					$data["cc"]=$this->campana->campanapdv(base64_decode($_SESSION["campana"]));					
					$data["motivos"]=$this->campana->listarmotivos(base64_decode($_SESSION["campana"]));	
					$data["cim"]=$this->campana->campanalocales(base64_decode($_SESSION["campana"]),$region,$ciudad,0,$sucursal,0,0,0,$fecha_programada,$fecha_real,$motivo,$buscasan);				
					$data['opcion']=$buscasan;	
					$data['motivo']=$motivo;
					$data['ciudad']=$ciudad;
					$data['sucursal']=$sucursal;
					$data['fechaprog']=$fecha_programada;
					$data['fechareal']=$fecha_real;
					$data['region']=$region;
					if(count($data["cim"])>0){
						$tempoCantidad = $data["cim"][0]["total"];
						$data['cantidad'] = ceil(($tempoCantidad+1)/20);
					} else {
						$tempoCantidad = 0;
						$data['cantidad'] = 0;
					}
					$this->load->view('contenido');
					$this->load->view('layout/menu_informe',$data);
					$this->load->view('informes/reporte',$data);
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
	public function id_cliente(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				$this->load->model("campana");
				$id_campana=(isset($_POST["id_campana"])) ? (empty($_POST["id_campana"])) ? 0 : $_POST["id_campana"] : 0;
				$region=(isset($_POST["region"])) ? (empty($_POST["region"])) ? 0 : $_POST["region"] : 0;
				$ciudad=(isset($_POST["ciudad"])) ? (empty($_POST["ciudad"])) ? 0 : $_POST["ciudad"] : 0;
				$sucursal=0;
				$fechaprog=(isset($_POST["fechaprog"])) ? (empty($_POST["fechaprog"])) ? 0 : $_POST["fechaprog"] : 0;
				$fechareal=(isset($_POST["fechareal"])) ? (empty($_POST["fechareal"])) ? 0 : $_POST["fechareal"] : 0;
				echo json_encode($this->campana->locales(base64_decode($_SESSION["empresa"]),$id_campana,$region,$ciudad,$sucursal,$fechaprog,$fechareal,0,0,0,0));
			} else {
				redirect(base_url("empresas"));	
			}
		} else {
			redirect(base_url("login"));
		}
	}
	public function canal(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("campana");
			$id_empresa=(isset($_POST["id_empresa"])) ? $_POST["id_empresa"] : base64_decode($_SESSION["empresa"]);
			$id_campana=(isset($_POST["id_campana"])) ? (empty($_POST["id_campana"])) ? 0 : $_POST["id_campana"] : 0;
			$region=(isset($_POST["region"])) ? (empty($_POST["region"])) ? 0 : $_POST["region"] : 0;
			$cadena=(isset($_POST["cadena"])) ? (empty($_POST["cadena"])) ? 0 : $_POST["cadena"] : 0;
			$canal= 0;
			$imp=(isset($_POST["imp"])) ? (empty($_POST["imp"])) ? 0 : $_POST["imp"] : 0;
			$cli=(isset($_POST["cli"])) ? (empty($_POST["imp"])) ? 0 : $_POST["cli"] : 0;
			$ciudad=(isset($_POST["ciudad"])) ? (empty($_POST["ciudad"])) ? 0 : $_POST["ciudad"] : 0;
			$sucursal=(isset($_POST["sucursal"])) ? (empty($_POST["sucursal"])) ? 0 : $_POST["sucursal"] : 0;
			$fechaprog=(isset($_POST["fechaprog"])) ? (empty($_POST["fechaprog"])) ? 0 : $_POST["fechaprog"] : 0;
			$fechareal=(isset($_POST["fechareal"])) ? (empty($_POST["fechareal"])) ? 0 : $_POST["fechareal"] : 0;
			echo json_encode($this->campana->canales($id_empresa,$id_campana,$region,$ciudad,$sucursal,$fechaprog,$fechareal,$cadena,$canal,$imp,$cli));
		} else {
			redirect(base_url("login"));
		}
	}
	public function implementador(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("campana");
			$id_empresa=(isset($_POST["id_empresa"])) ? $_POST["id_empresa"] : base64_decode($_SESSION["empresa"]);
			$id_campana=(isset($_POST["id_campana"])) ? (empty($_POST["id_campana"])) ? 0 : $_POST["id_campana"] : 0;
			$region=(isset($_POST["region"])) ? (empty($_POST["region"])) ? 0 : $_POST["region"] : 0;
			$cadena=(isset($_POST["cadena"])) ? (empty($_POST["cadena"])) ? 0 : $_POST["cadena"] : 0;
			$canal=(isset($_POST["canal"])) ? (empty($_POST["canal"])) ? 0 : $_POST["canal"] : 0;
			$imp=0;
			$cli=(isset($_POST["cli"])) ? (empty($_POST["imp"])) ? 0 : $_POST["cli"] : 0;
			$ciudad=(isset($_POST["ciudad"])) ? (empty($_POST["ciudad"])) ? 0 : $_POST["ciudad"] : 0;
			$sucursal=(isset($_POST["sucursal"])) ? (empty($_POST["sucursal"])) ? 0 : $_POST["sucursal"] : 0;
			$fechaprog=(isset($_POST["fechaprog"])) ? (empty($_POST["fechaprog"])) ? 0 : $_POST["fechaprog"] : 0;
			$fechareal=(isset($_POST["fechareal"])) ? (empty($_POST["fechareal"])) ? 0 : $_POST["fechareal"] : 0;
			echo json_encode($this->campana->implementador($id_empresa,$id_campana,$region,$ciudad,$sucursal,$fechaprog,$fechareal,$cadena,$canal,$imp,$cli));
		} else {
			redirect(base_url("login"));
		}
	}
	public function clientes(){
		if(isset($_SESSION["sesion"])){
			$this->load->model("campana");
			$id_empresa=(isset($_POST["id_empresa"])) ? $_POST["id_empresa"] : base64_decode($_SESSION["empresa"]);
			$id_campana=(isset($_POST["id_campana"])) ? (empty($_POST["id_campana"])) ? 0 : $_POST["id_campana"] : 0;
			$region=(isset($_POST["region"])) ? (empty($_POST["region"])) ? 0 : $_POST["region"] : 0;
			$cadena=(isset($_POST["cadena"])) ? (empty($_POST["cadena"])) ? 0 : $_POST["cadena"] : 0;
			$canal=(isset($_POST["canal"])) ? (empty($_POST["canal"])) ? 0 : $_POST["canal"] : 0;
			$imp=(isset($_POST["imp"])) ? (empty($_POST["imp"])) ? 0 : $_POST["imp"] : 0;
			$cli=0;
			$ciudad=(isset($_POST["ciudad"])) ? (empty($_POST["ciudad"])) ? 0 : $_POST["ciudad"] : 0;
			$sucursal=(isset($_POST["sucursal"])) ? (empty($_POST["sucursal"])) ? 0 : $_POST["sucursal"] : 0;
			$fechaprog=(isset($_POST["fechaprog"])) ? (empty($_POST["fechaprog"])) ? 0 : $_POST["fechaprog"] : 0;
			$fechareal=(isset($_POST["fechareal"])) ? (empty($_POST["fechareal"])) ? 0 : $_POST["fechareal"] : 0;
			echo json_encode($this->campana->clientescam($id_empresa,$id_campana,$region,$ciudad,$sucursal,$fechaprog,$fechareal,$cadena,$canal,$imp,$cli));
		} else {
			redirect(base_url("login"));
		}
	}
	public function filtroinfo(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					$this->load->model("campana");
					if(isset($_POST["region"]) || $_POST["region"]!=""){
						$region=$_POST["region"];
					} else {
						$region="0";
					}
					if(isset($_POST["ciudad"]) || $_POST["ciudad"]!=""){
						$ciudad=str_replace('_',' ', $_POST["ciudad"]);
					} else {
						$ciudad="0";
					}
					if(isset($_POST["sucursal"]) || $_POST["sucursal"]!=""){
						$sucursal=$_POST["sucursal"];
					} else {
						$sucursal="0";
					}
					if(isset($_POST["fecha_programada"]) || $_POST["fecha_programada"]!=""){
						$fecha_programada=$_POST["fecha_programada"];
					} else {
						$fecha_programada="01-01-1900";
					}
					if(isset($_POST["fecha_real"]) || $_POST["fecha_real"]!=""){
						$fecha_real=$_POST["fecha_real"];
					} else {
						$fecha_real="01-01-1900";
					}
					if(isset($_POST["motivo"]) || $_POST["motivo"]!=""){
						$motivo=$_POST["motivo"];
					} else {
						$motivo="0";
					}
					$data["cc"]=$this->campana->campanaclientes(base64_decode($_SESSION["campana"]),$region,$ciudad,"0",$sucursal,$fecha_programada,$fecha_real,$motivo);
					echo json_encode($data);
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
	public function galeria(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
						$this->load->model("campana");
					if(isset($_GET['opcion'])){
						if(is_numeric($_GET['opcion'])){
							$buscasan = $_GET['opcion'];
						}else{
							$buscasan=1;
						}
					}else{
						$buscasan=1;
					}
					if(isset($_POST["lbl_region_i"])){
						if(!empty($_POST["lbl_region_i"])){
							$region=$_POST["lbl_region_i"];
							$data["nombre_region"]=$this->campana->nombreregion($region)["region"];
						} else {
							$region="0";
						}
					} else {
						$region="0";
					}
					if(isset($_POST["lbl_ciudad_i"])){
						if(!empty($_POST["lbl_ciudad_i"])){
							$ciudad=$_POST["lbl_ciudad_i"];
						} else {
							$ciudad="0";
						}
					} else {
						$ciudad="0";
					}
					if(isset($_POST["lbl_sucursal_i"])){
						if(!empty($_POST["lbl_sucursal_i"])){
							$id_cliente=$_POST["lbl_sucursal_i"];
						} else {
							$id_cliente="0";
						}
					} else {
						$id_cliente="0";
					}
					$data["nombre"]=$_SESSION["nombre"];
					$data["campana"]=$this->campana->campana(base64_decode($_SESSION["campana"]));
					$data["fotos"]=$this->campana->campanainformegaleria(base64_decode($_SESSION["campana"]),1,17,$buscasan,$region,$ciudad,$id_cliente);
					$data["region"]=$region;
					$data["ciudad"]=$ciudad;
					$data["sucursal"]=$id_cliente;
					$data['opcion']=$buscasan;	
					if(count($data["fotos"])>0){
						$tempoCantidad = $data["fotos"][0]["cantidad"];
						$data['cantidad'] = ceil(($tempoCantidad+1)/16);
					} else {
						$tempoCantidad = 0;
						$data['cantidad'] = 0;
					}			
					$this->load->view('contenido');
					$this->load->view('layout/menu_informe',$data);
					$this->load->view('informes/galeria',$data);
				} else {
					if($_SESSION["perfil"]==1){
						redirect(base_url("informes/campanas"));
					} else {
						redirect(base_url("campanas"));
					}
				}
			} else {
				if($_SESSION["perfil"]==1){
					redirect(base_url("home"));	
				} else {
					redirect(base_url("empresas"));	
				}		
			}
		} else {
			redirect(base_url("login"));
		}
	}
	public function filtro(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					$this->load->model("listar");
					$this->load->model("campana");
					if(isset($_POST["reg"])){
						if(!empty($_POST["reg"])){
							$reg=$_POST["reg"];
						} else {
							$reg=0;
						}
					} else {
						$reg=0;
					}
					if(isset($_POST["ciu"])){
						if(!empty($_POST["ciu"])){
							$ciu=str_replace('_', ' ', $_POST["ciu"]);
						} else {
							$ciu=0;
						}						
					} else {
						$ciu=0;
					}
					if(isset($_POST["cad"])){
						if(!empty($_POST["cad"])){
							$cad=str_replace('_', ' ', $_POST["cad"]);
						} else {
							$cad=0;
						}
					} else {
						$cad=0;
					}
					if(isset($_POST["pdv"])){
						if(!empty($_POST["pdv"])){
							$pdv=$_POST["pdv"];
						} else {
							$pdv=0;
						}
					} else {
						$pdv=0;
					}
					if(isset($_POST["can"])){
						if(!empty($_POST["can"])){
							$can=str_replace('_', ' ', $_POST["can"]);
						} else {
							$can=0;
						}
					} else {
						$can=0;
					}
					if(isset($_POST["imp"])){
						if(!empty($_POST["imp"])){
							$imp=str_replace('_', ' ', $_POST["imp"]);
						} else {
							$imp=0;
						}
					} else {
						$imp=0;
					}
					if(isset($_POST["cli"])){
						if(!empty($_POST["cli"])){
							$cli=str_replace('_', ' ', $_POST["cli"]);
						} else {
							$cli=0;
						}
					} else {
						$cli=0;
					}
					if(isset($_POST["fep"])){
						if(!empty($_POST["fep"])){
							$fep=date("Ymd",strtotime($_POST["fep"]));
						} else {
							$fep=0;
						}
					} else {
						$fep=0;
					}
					if(isset($_POST["fei"])){
						if(!empty($_POST["fei"])){
							$fei=date("Ymd",strtotime($_POST["fei"]));
						} else {
							$fei=0;
						}
					} else {
						$fei=0;
					}
					if(isset($_POST["motivo"])){
						if(!empty($_POST["motivo"])){
							$motivo=$_POST["motivo"];
						} else {
							$motivo="0";
						}
					} else {
						$motivo="0";
					}
					if(isset($_POST['opcion'])){
						if(is_numeric($_POST['opcion'])){
							$buscasan = $_POST['opcion'];
						}else{
							$buscasan=1;
						}
					}else{
						$buscasan=1;
					}
					$data["cim"]=$this->campana->campanalocales(base64_decode($_SESSION["campana"]),$reg,$ciu,$cad,$pdv,$can,$imp,$cli,$fep,$fei,$motivo,$buscasan);					
					$data["cf"]=$this->campana->campanafecha(base64_decode($_SESSION["campana"]),$reg,$ciu,$cad,$pdv,$can,$imp,$cli,$fep,$fei,$motivo);
					if(count($data["cim"])>0){
						$tempoCantidad = $data["cim"][0]["total"];
						$data['cantidad'] = ceil(($tempoCantidad+1)/20);
					} else {
						$tempoCantidad = 0;
						$data['cantidad'] = 0;
					}
					echo json_encode($data);
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
	public function powerpointcam($id_campana){
		$this->load->library('Ppt_stuff');
	   	$this->load->model("campana");
		$campana=$this->campana->campana(base64_decode($id_campana));
		$arrayfotos=$this->campana->campanappt(base64_decode($id_campana));
	   	$this->ppt_stuff->make_ppt($campana,$arrayfotos);	
	}
	public function excelagro($id_campana){
		$id=base64_encode($id_campana);
		$this->excel($id);
	}
	public function excelcam($id_campana){
		$this->load->model("campana");
		$campana=$this->campana->campana(base64_decode($id_campana));
		if($campana["id_empresa"]==9){
			$this->excelpg($id_campana);
		} else {
			$this->excel($id_campana);
		}			
	}
	private function getNameFromNumber($num){
		$numeric = $num % 26;
		$letter = chr(65 + $numeric);
		$num2 = intval($num / 26);
		if ($num2 > 0) {
			return $this->getNameFromNumber($num2 - 1) . $letter;
		} else {
			return $letter;
		}
	} 
	private function excelpg($id_cam){
		$this->load->model("campana");
		$this->load->library('phpexcel');
		$id_campana=base64_decode($id_cam);
		$excel = new PHPExcel();
		$excel->setActiveSheetIndex(0);
		$cam=$this->campana->campana($id_campana);
		$mat=$this->campana->campana_excelpg($id_campana);
		$style=array('font'=>array('bold'=>true,'color'=>array('rgb' => 'ffffff'),'size'=>10),'fill'=>array('type'=>PHPExcel_Style_Fill::FILL_SOLID, 'startcolor'=>array('rgb' => '3366FF')));
		$row=4;
		foreach ($mat[1] as $m) {	
			$ti=$mat[0];
			$x=0;
			for ($i=0; $i < count($ti) ; $i++) { 
				if(($timestamp = strtotime($m[$ti[$i]])) === false){
					$excel->getActiveSheet()->setCellValueByColumnAndRow($x,$row,$m[$ti[$i]]);
				} else {
					$excel->getActiveSheet()->setCellValueByColumnAndRow($x,$row,date('d-m-Y',$timestamp));
					$excel->getActiveSheet()->getStyleByColumnAndRow($x,$row)->getNumberFormat()->setFormatCode('dd-mm-yyyy');
				}					
				$x+=1;
			}
			$row+=1;
		}
		$c=array("ID LOCAL","CHANNEL","CLIENTE","CADENA","TIPO LOCAL","NOMBRE LOCAL","DIRECCION","COMUNA","CIUDAD","REGION","GZO","JEFE DE VENTAS ZONAL","AGENCIA REPONE","AGENCIA DE IMPLEMENTACIÓN","GESTOR DE IMPLEMENTACIÓN","PLAN CUMBRE","CARGA");
		for ($i=0; $i < count($c); $i++) { 
			$excel->getActiveSheet()->setCellValueByColumnAndRow($i,3,$c[$i]);
			$excel->getActiveSheet()->getStyleByColumnAndRow($i,3)->applyFromArray($style);
		}
		$x=1;
		for ($i=17; $i < count($mat[0]); $i++) { 
			if(stristr($mat[0][$i], 'acuerdo') ===false && stristr($mat[0][$i], 'implementado') ===false){
				$excel->getActiveSheet()->setCellValueByColumnAndRow($i,3,"=SUBTOTAL(3,".$this->getNameFromNumber($i)."4:".$this->getNameFromNumber($i)."".$row.")");
			} else {
				$excel->getActiveSheet()->setCellValueByColumnAndRow($i,3,"=SUBTOTAL(9,".$this->getNameFromNumber($i)."4:".$this->getNameFromNumber($i)."".$row.")");
			}			
			$excel->getActiveSheet()->getStyleByColumnAndRow($i,3)->applyFromArray($style);
			if($mat[0][$i]=="suma_acuerdo" || $mat[0][$i]=="suma_implementado"){
				$excel->getActiveSheet()->setCellValueByColumnAndRow($i,2,"Total");
			} else {
				switch ($x) {
					case 1:
						$excel->getActiveSheet()->setCellValueByColumnAndRow($i,1,str_replace(array('_','acuerdo'),' ',$mat[0][$i]));
						$excel->setActiveSheetIndex(0)->mergeCells(''.$this->getNameFromNumber($i).'1:'.$this->getNameFromNumber($i+7).'1');
						$excel->getActiveSheet()->getStyleByColumnAndRow($i,1)->applyFromArray($style);
						$excel->getActiveSheet()->getStyleByColumnAndRow($i,1)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$excel->getActiveSheet()->setCellValueByColumnAndRow($i,2,"Acuerdo");
						break;
					case 2:
						$excel->getActiveSheet()->setCellValueByColumnAndRow($i,2,"Status");
						break;
					case 3:
						$excel->getActiveSheet()->setCellValueByColumnAndRow($i,2,"Motivo");
						break;
					case 4:
						$excel->getActiveSheet()->setCellValueByColumnAndRow($i,2,"Fecha Programada");
						break;
					case 5:
						$excel->getActiveSheet()->setCellValueByColumnAndRow($i,2,"Fecha de instalacion");
						break;
					case 6:
						$excel->getActiveSheet()->setCellValueByColumnAndRow($i,2,"Tipo de Acuerdo");
						break;
					case 7:
						$excel->getActiveSheet()->setCellValueByColumnAndRow($i,2,"Inicio de Acuerdo");
						break;
					case 8:
						$excel->getActiveSheet()->setCellValueByColumnAndRow($i,2,"Finalizacion de Acuerdo");
						$x=0;
						break;
				}
				$x+=1;
			}			
			$excel->getActiveSheet()->getStyleByColumnAndRow($i,2)->applyFromArray($style);
		}
		$excel->getActiveSheet()->setTitle("Calendario");
		ob_end_clean();
		ob_start();
		$excel_writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
		header('Content-Disposition: attachment;filename="'.$cam["campana"].'.xlsx"');
		header('Cache-Control: max-age=0');		
		$excel_writer->save('php://output');
	}

	private function excel($id_cam){
		$this->load->model("campana");
		$this->load->library('phpexcel');
		$array=array("\n","\r","\n\r","\t","\0","\x0B");
		$id_campana=base64_decode($id_cam);
		$excel = new PHPExcel();
		$excel->setActiveSheetIndex(0);
		$mat=$this->campana->campana_excel($id_campana);
		$c=$mat[0];
		$x=0;
		for ($i=0; $i < count($c); $i++) { 
			$excel->getActiveSheet()->setCellValueByColumnAndRow($x,1,strtoupper($c[$i]));
			$excel->getActiveSheet()->getStyleByColumnAndRow($x,1)->getFont()->setBold(true);
			$x+=1;
		}		
		$cam=$this->campana->campana($id_campana);
		$row=2;
		foreach ($mat[1] as $m) {
			$c=$mat[0];
			$x=0;
			for ($i=0; $i < count($c); $i++) {
				if(stristr(strtoupper($c[$i]), 'fecha') === false){
					$excel->getActiveSheet()->setCellValueByColumnAndRow($x,$row,str_replace($array, " ",$m[$c[$i]]));
				} else {
					$excel->getActiveSheet()->setCellValueByColumnAndRow($x,$row,date('d-m-Y',strtotime($m[$c[$i]])));
					$excel->getActiveSheet()->getStyleByColumnAndRow($x,$row)->getNumberFormat()->setFormatCode('dd-mm-yyyy');
				}					
				$x+=1;
				$excel->getActiveSheet()->getStyleByColumnAndRow($x,$row)->getAlignment()->setWrapText(false);
			}
			$row+=1;
		}
		ob_end_clean();
		ob_start();
		$excel_writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
		header('Content-Disposition: attachment;filename="'.$cam["campana"].'.xlsx"');
		header('Cache-Control: max-age=0');		
		$excel_writer->save('php://output');
	}
	public function biblioteca(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					$this->load->model("campana");
					$this->load->model("perfil");
					$this->load->model("empresa");
					$this->load->model("listar");
					$data["carpetas"]=$this->campana->carpetas(base64_decode($_SESSION["campana"]),0);
					$data["campana"]=$this->campana->campana(base64_decode($_SESSION["campana"]));
					$data["perfiles"]=$this->perfil->perfiles();
					$data["empresa"]=$this->empresa->empresa(base64_decode($_SESSION["empresa"]))[0]["empresa"];
					$data["permisos"]=$this->listar->permisos($_SESSION["usuario"],'campanas');
					$data["nombre"]=$_SESSION["nombre"];
					$this->load->view('contenido');
					$this->load->view('layout/menu_informe',$data);
					$this->load->view('biblioteca/carpeta',$data);
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
	public function addcarpeta(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					$vacios=0;
					$this->load->model("campana");
					if((!isset($_POST["txt_carpetaadd"])) || $_POST["txt_carpetaadd"]==""){
						$vacios+=1;
					} 
					if((!isset($_POST["lbl_perfilcaradd"])) || count($_POST["lbl_perfilcaradd"])==0){
						$vacios+=1;
					}
					if($vacios!=0){
						$data["mensaje"]="Carpeta no pudo ser agregada, intente nuevamente";
					} else {
						$carpeta=$_POST["txt_carpetaadd"];
						$id_campana=base64_decode($_SESSION["campana"]);
						$id_usuario=$_SESSION["usuario"];
						$id_perfil="";
						foreach ($_POST["lbl_perfilcaradd"] as $p) {
							$id_perfil.=$p.",";
						}						
						$ubicacion="archivos/documentos/".$id_campana."/".$_POST["txt_carpetaadd"];
						$add=$this->campana->carpetasadd($carpeta,$id_usuario,$id_campana,$id_perfil);
						if(isset($add)){
							if (!file_exists($ubicacion)) {
								mkdir($ubicacion, 0777, true);
							}
							$data["mensaje"]=$add["mensaje"];
						} else {
							$data["mensaje"]="Carpeta agregada con exito.";
						}						
					}
					$this->load->view('contenido');
					$this->load->view('alertas/alertas',$data);
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
	public function editcarpeta(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					$vacios=0;
					$this->load->model("campana");
					if((!isset($_POST["txt_carpetaedit"])) || $_POST["txt_carpetaedit"]==""){
						$vacios+=1;
					} 
					if((!isset($_POST["lbl_perfilcaredit"])) || count($_POST["lbl_perfilcaredit"])==0){
						$vacios+=1;
					}
					if((!isset($_POST["txt_carpetaid"])) || $_POST["txt_carpetaid"]==""){
						$vacios+=1;
					}
					if($vacios!=0){
						$data["mensaje"]="Carpeta no pudo ser modificada, intente nuevamente";
					} else {
						$id=base64_decode($_POST["txt_carpetaid"]);
						$carpeta=$_POST["txt_carpetaedit"];
						$id_campana=base64_decode($_SESSION["campana"]);
						$id_perfil="";
						foreach ($_POST["lbl_perfilcaredit"] as $p) {
							$id_perfil.=$p.",";
						}
						$newubicacion="archivos/documentos/".$id_campana."/".$_POST["txt_carpetaedit"];
						$add=$this->campana->carpetasedit($carpeta,$id_perfil,$id_campana,$id);
						if(isset($add)){
							if($add["respuesta"]==1){
								$ubicacion="archivos/documentos/".$id_campana."/".$add["mensaje"];
								if (file_exists($ubicacion)) {
									rename($ubicacion, $newubicacion);
								}
								$data["mensaje"]="Carpeta modificada con exito.";
							} else {
								$data["mensaje"]=$add["mensaje"];
							}
						} else {
							$data["mensaje"]="Carpeta modificada con exito.";
						}						
					}
					$this->load->view('contenido');
					$this->load->view('alertas/alertas',$data);
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
	public function deletecarpeta(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					$vacios=0;
					$this->load->model("campana");
					if((!isset($_POST["txt_carpetadelid"])) || $_POST["txt_carpetadelid"]==""){
						$vacios+=1;
					} 
					if($vacios!=0){
						$data["mensaje"]="Carpeta no pudo ser eliminada, intente nuevamente";
					} else {
						$id=base64_decode($_POST["txt_carpetadelid"]);
						$id_campana=base64_decode($_SESSION["campana"]);
						$add=$this->campana->carpetasdelete($id);
						if(isset($add)){
							$ubicacion="archivos/documentos/".$id_campana."/".$add["nombre"];
							if (file_exists($ubicacion)) {
								array_map('unlink', glob("$ubicacion/*.*"));
								rmdir($ubicacion);
							}
							$data["mensaje"]=$add["mensaje"];
						} else {
							$data["mensaje"]="Carpeta eliminada con exito.";
						}						
					}
					$this->load->view('contenido');
					$this->load->view('alertas/alertas',$data);
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
	public function carpeta(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					$this->load->model("campana");
					$id=base64_decode($_POST["id"]);
					echo json_encode($this->campana->carpeta($id));
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
	public function galeriacli(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					$this->load->model("campana");
					$this->load->model("empresa");
					$this->load->model("solicitud_ot");
					if(isset($_GET['opcion'])){
						if(is_numeric($_GET['opcion'])){
							$page = $_GET['opcion'];
						}else{
							$page=1;
						}
					}else{
						$page=1;
					}
					if(isset($_POST["reg"])){
						if(!empty($_POST["reg"])){
							$reg=$_POST["reg"];
							$data["nom_region"]=$this->campana->nombreregion($reg)["region"];
						} else {
							$reg=0;
						}
					} else {
						$reg=0;
					}
					if(isset($_POST["ciu"])){
						if(!empty($_POST["ciu"])){
							$ciu=str_replace('_', ' ', $_POST["ciu"]);
						} else {
							$ciu=0;
						}						
					} else {
						$ciu=0;
					}
					if(isset($_POST["cad"])){
						if(!empty($_POST["cad"])){
							$cad=str_replace('_', ' ', $_POST["cad"]);
						} else {
							$cad=0;
						}
					} else {
						$cad=0;
					}
					if(isset($_POST["pdv"])){
						if(!empty($_POST["pdv"])){
							$pdv=$_POST["pdv"];
						} else {
							$pdv=0;
						}
					} else {
						$pdv=0;
					}
					if(isset($_POST["can"])){
						if(!empty($_POST["can"])){
							$can=str_replace('_', ' ', $_POST["can"]);
						} else {
							$can=0;
						}
					} else {
						$can=0;
					}
					if(isset($_POST["imp"])){
						if(!empty($_POST["imp"])){
							$imp=str_replace('_', ' ', $_POST["imp"]);
						} else {
							$imp=0;
						}
					} else {
						$imp=0;
					}
					if(isset($_POST["cli"])){
						if(!empty($_POST["cli"])){
							$cli=str_replace('_', ' ', $_POST["cli"]);
						} else {
							$cli=0;
						}
					} else {
						$cli=0;
					}
					if(isset($_POST["fep"])){
						if(!empty($_POST["fep"])){
							$fep=date("Ymd",strtotime($_POST["fep"]));
						} else {
							$fep=0;
						}
					} else {
						$fep=0;
					}
					if(isset($_POST["fei"])){
						if(!empty($_POST["fei"])){
							$fei=date("Ymd",strtotime($_POST["fei"]));
						} else {
							$fei=0;
						}
					} else {
						$fei=0;
					}
					$data["reg"]=$reg;
					$data["ciu"]=$ciu;
					$data["pdv"]=$pdv;
					$data["imp"]=$imp;
					$data["cad"]=$cad;
					$data["cli"]=$cli;
					$data["can"]=$can;
					$data["fep"]=$fep;
					$data["fei"]=$fei;
					$data["opcion"]=$page;
					$data["nombre"]=$_SESSION["nombre"];
					$data["campana"]=$this->campana->campana(base64_decode($_SESSION["campana"]));
					$data["empresa"]=$this->empresa->empresa(base64_decode($_SESSION["empresa"]));
					//$data["fotos"]=$this->campana->campanainformegaleria(base64_decode($_SESSION["campana"]),1,17,$buscasan,$region,$ciudad,$id_cliente);	
					$data["fotos"]=$this->campana->galeriafiltros(base64_decode($_SESSION["campana"]),$page,$reg,$ciu,$cad,$pdv,$can,$imp,$cli,$fep,$fei);
					if(count($data["fotos"])>0){
						$tempoCantidad = $data["fotos"][0]["cantidad"];
						$data['cantidad'] = ceil(($tempoCantidad+1)/16);
					} else {
						$tempoCantidad = 0;
						$data['cantidad'] = 0;
					}
					$this->load->view('contenido');
					$this->load->view('layout/menu',$data);
					$this->load->view('biblioteca/galeriacli',$data);
				} else {
					redirect(base_url("informes/campanas"));
				}
			} else {
				if($_SESSION["perfil"]==1){
					redirect(base_url("home"));	
				} else {
					redirect(base_url("empresas"));	
				}		
			}
		} else {
			redirect(base_url("login"));
		}
	}
		public function galeriafiltros(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					
					$this->load->model("campana");
					$this->load->model("empresa");
					$this->load->model("solicitud_ot");
					
					if(isset($_GET['opcion'])){
						if(is_numeric($_GET['opcion'])){
							$page = $_GET['opcion'];
						}else{
							$page=1;
						}
					}else{
						$page=1;
					}

					if(isset($_POST["reg"])){
						if(!empty($_POST["reg"])){
							$reg=$_POST["reg"];
						} else {
							$reg=0;
						}
					} else {
						$reg=0;
					}
					if(isset($_POST["ciu"])){
						if(!empty($_POST["ciu"])){
							$ciu=str_replace('_', ' ', $_POST["ciu"]);
						} else {
							$ciu=0;
						}						
					} else {
						$ciu=0;
					}
					if(isset($_POST["cad"])){
						if(!empty($_POST["cad"])){
							$cad=str_replace('_', ' ', $_POST["cad"]);
						} else {
							$cad=0;
						}
					} else {
						$cad=0;
					}
					if(isset($_POST["pdv"])){
						if(!empty($_POST["pdv"])){
							$pdv=$_POST["pdv"];
						} else {
							$pdv=0;
						}
					} else {
						$pdv=0;
					}
					if(isset($_POST["can"])){
						if(!empty($_POST["can"])){
							$can=str_replace('_', ' ', $_POST["can"]);
						} else {
							$can=0;
						}
					} else {
						$can=0;
					}
					if(isset($_POST["imp"])){
						if(!empty($_POST["imp"])){
							$imp=str_replace('_', ' ', $_POST["imp"]);
						} else {
							$imp=0;
						}
					} else {
						$imp=0;
					}
					if(isset($_POST["cli"])){
						if(!empty($_POST["cli"])){
							$cli=str_replace('_', ' ', $_POST["cli"]);
						} else {
							$cli=0;
						}
					} else {
						$cli=0;
					}
					if(isset($_POST["fep"])){
						if(!empty($_POST["fep"])){
							$fep=date("Ymd",strtotime($_POST["fep"]));
						} else {
							$fep=0;
						}
					} else {
						$fep=0;
					}
					if(isset($_POST["fei"])){
						if(!empty($_POST["fei"])){
							$fei=date("Ymd",strtotime($_POST["fei"]));
						} else {
							$fei=0;
						}
					} else {
						$fei=0;
					}
					$data["reg"]=$reg;
					$data["ciu"]=$ciu;
					$data["pdv"]=$pdv;
					$data["imp"]=$imp;
					$data["cad"]=$cad;
					$data["cli"]=$cli;
					$data["can"]=$can;
					$data["fep"]=$fep;
					$data["fei"]=$fei;
					$data["opcion"]=$page;
					var_dump($data);

					$data["nombre"]=$_SESSION["nombre"];
					$data["campana"]=$this->campana->campana(base64_decode($_SESSION["campana"]));
					$data["empresa"]=$this->empresa->empresa(base64_decode($_SESSION["empresa"]));
					$data["fotos"]=$this->campana->galeriafiltros(base64_decode($_SESSION["campana"]),$page,$reg,$ciu,$cad,$pdv,$can,$imp,$cli,$fep,$fei);	
					if(count($data["fotos"])>0){
						$Cantidad = $data["fotos"][0]["cantidad"];
						$data['cantidad'] = ceil(($Cantidad+1)/16);
					} else {
						$Cantidad = 0;
						$data['cantidad'] = 0;
					}
					$this->load->view('contenido');
					$this->load->view('layout/menu',$data);
					$this->load->view('biblioteca/galeriacli',$data);
				} else {
					redirect(base_url("informes/campanas"));
				}
			} else {
				if($_SESSION["perfil"]==1){
					redirect(base_url("home"));	
				} else {
					redirect(base_url("empresas"));	
				}		
			}
		} else {
			redirect(base_url("login"));
		}
	}
	function bibliotecacli(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					$this->load->model("campana");
					$this->load->model("empresa");
					$data["carpetas"]=$this->campana->carpetas(base64_decode($_SESSION["campana"]),$_SESSION["usuario"]);
					$data["campana"]=$this->campana->campana(base64_decode($_SESSION["campana"]));
					$data["empresa"]=$this->empresa->empresa(base64_decode($_SESSION["empresa"]));
					$data["nombre"]=$_SESSION["nombre"];
					$this->load->view('contenido');
					$this->load->view('layout/menu',$data);
					$this->load->view('biblioteca/carpetacli',$data);
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
	function bibliotecadef(){
		if(isset($_SESSION["sesion"])){
			$_SESSION["campana"]=$_POST["id_campana"];
			$this->load->model("campana");
			$data["carpetas"]=$this->campana->carpetas(base64_decode($_SESSION["campana"]),$_SESSION["usuario"]);
			$data["campana"]=$this->campana->campana(base64_decode($_SESSION["campana"]));					
			$data["nombre"]=$_SESSION["nombre"];
			$this->load->view('contenido');
			$this->load->view('layout/menu_default',$data);
			$this->load->view('biblioteca/carpetadefault',$data);
		} else {
			redirect(base_url("login"));
		}
	}
	public function subirDoc(){	
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					$this->load->model("campana");
					$vacios=0;
					if(!isset($_POST["id_carpetajs"]) || $_POST["id_carpetajs"]==""){
						$vacios+=1;
					}
					if(!isset($_POST["txt_archivoadd"]) || $_POST["txt_archivoadd"]==""){
						$vacios+=1;
					}
					if(!isset($_POST["lbl_tipodocadd"]) || $_POST["lbl_tipodocadd"]==""){
						$vacios+=1;
					} else if($_POST["lbl_tipodocadd"]=="2"){
						if(!isset($_POST["txt_urldocadd"]) || $_POST["txt_urldocadd"]==""){
							$vacios+=1;
						}
					} else if($_POST["lbl_tipodocadd"]=="1"){
						if(!isset($_FILES["txt_doc"]) || $_FILES["txt_doc"]["size"]=0){
							$vacios+=1;
						}
					}	
					if($vacios!=0){
						$data["mensaje"]="Documento no pudo ser agregado, intente nuevamente";
					} else {
						if($_POST["lbl_tipodocadd"]=="2"){
							$nombreD=$_POST["txt_urldocadd"];
							$tipoDoc="url";
							$nombre=$_POST["txt_urldocadd"];
						} else if($_POST["lbl_tipodocadd"]=="1"){
							$nombreD=explode('.', $_FILES["txt_doc"]["name"]);
							$tipoDoc=$nombreD[1];
							$nombre=base64_encode($_POST["txt_archivoadd"]).".".$tipoDoc;
						}						
						$nombreDoc=$_POST["txt_archivoadd"];
						$id_carpeta=base64_decode($_POST["id_carpetajs"]);
						$usuario=$_SESSION["usuario"];	
						$add=$this->campana->guardarDocumento($nombreDoc,$tipoDoc,$id_carpeta,$usuario,$nombre);
						if(isset($add)){
							if($_POST["lbl_tipodocadd"]=="1"){
								if($add["carpeta"]!="0"){
									$this->documento($nombreDoc,$add["carpeta"]);
								}
							}
							$data["mensaje"]=$add["mensaje"];
						} else {
							$data["mensaje"]="Documento no pudo ser agregado, intente nuevamente";
						}
					}
					// // var_dump();				
					$this->load->view('contenido');
					$this->load->view('alertas/alertas',$data);
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
	public function documento($filename,$carpeta)
	{
		$archivo="txt_doc";
		$config['upload_path'] = "archivos/documentos/".base64_decode($_SESSION["campana"])."/".$carpeta;
		$config['file_name'] = $filename;
		$config['allowed_types'] = "*";
		$config['overwrite'] = TRUE;
		$this->upload->initialize($config);
		if (!$this->upload->do_upload($archivo)) {
					//*** ocurrio un error
			$dat['uploadError'] = $this->upload->display_errors();
			echo $this->upload->display_errors();
			return;
		}
		$data = $this->upload->data();
		$nom=$data['file_name'];
		return $nom;
	}
	
	public function obtenerDocumentos(){
		$this->load->model("campana");
		$carpeta=base64_decode($_POST["carp"]);
		$documentos=$this->campana->listarDocumentos($carpeta);
		foreach ($documentos as $doc) { 
			echo "<div class='col-md-3'  title='".$doc["Nombre_Documento"]."'>
					<div class='card card-accent-right-theme'>
						<div class='card-body p-3 clearfix'>";
			if($doc["Tipo_Documento"]=="xls" || $doc["Tipo_Documento"]=="xlsx" || $doc["Tipo_Documento"]=="csv"){
				echo "<i class='fa fa-file-excel-o p-3 font-2xl mr-3 float-left text-theme'></i>";
			} else if($doc["Tipo_Documento"]=="pptx" || $doc["Tipo_Documento"]=="ppt"){
				echo "<i class='fa fa-file-powerpoint-o p-3 font-2xl mr-3 float-left text-theme'></i>";
			} else if($doc["Tipo_Documento"]=="pdf" ){
				echo "<i class='fa fa-file-pdf-o p-3 font-2xl mr-3 float-left text-theme'></i>";
			} else if($doc["Tipo_Documento"]=="url"){
				echo "<i class='fa fa-unlink p-3 font-2xl mr-3 float-left text-theme'></i>";
			} else if($doc["Tipo_Documento"]=="docx" || $doc["Tipo_Documento"]=="doc"){
				echo "<i class='fa fa-file-word-o p-3 font-2xl mr-3 float-left text-theme'></i>";
			} else if($doc["Tipo_Documento"]=="png" || $doc["Tipo_Documento"]=="jpg" || $doc["Tipo_Documento"]=="jpeg" || $doc["Tipo_Documento"]=="gif" || $doc["Tipo_Documento"]=="bmp"){
				echo "<i class='fa fa-file-image-o p-3 font-2xl mr-3 float-left text-theme'></i>";
			} else if($doc["Tipo_Documento"]=="zip" || $doc["Tipo_Documento"]=="rar" ){
				echo "<i class='fa fa-file-zip-o p-3 font-2xl mr-3 float-left text-theme'></i>";
			} else if($doc["Tipo_Documento"]=="avi" || $doc["Tipo_Documento"]=="mpeg" || $doc["Tipo_Documento"]=="ogv" || $doc["Tipo_Documento"]=="mp4"){
				echo "<i class='fa fa-file-video-o p-3 font-2xl mr-3 float-left text-theme'></i>";
			} else if($doc["Tipo_Documento"]=="txt" ){
				echo "<i class='fa fa-file-text-o p-3 font-2xl mr-3 float-left text-theme'></i>";
			}  else {
				echo "<i class='fa fa-file-o p-3 font-2xl mr-3 float-left text-theme'></i>";
			}
			if(strlen($doc["Nombre_Documento"])<25){
				echo "<small class='text-theme mb-0 mt-2'>".$doc["Nombre_Documento"]."</small><br>";
			} else {
				echo "<small class='text-theme mb-0 mt-2'>".substr($doc["Nombre_Documento"],0,25).". . .</small><br>";
			}
			if($doc["Tipo_Documento"]=="url"){
				$href=$doc["documento"];
			} else {
				$href=base_url("archivos/documentos/".base64_decode($_SESSION["campana"])."/".$doc["nombre_carpeta"]."/".$doc["documento"]);
			}
			echo 	"		<div class='btn-group card-body'>
					<a href='".$href."' target='_blank' class='btn btn-sm btn-outline-theme' title='Descargar'><i class='fa fa-download'></i></a>";
			if($_SESSION["perfil"]==3 || $_SESSION["perfil"]==-1){
				echo "<form method='post' action='".base_url("informes/deletedocumento")."' onsubmit='return validadoc(\"".$doc["Nombre_Documento"]."\")' >
						<button type='submit' class='btn btn-sm btn-outline-theme' title='Eliminar'  ><i class='fa fa-times'></i></button>
						<input type='hidden' name='txt_docdelid' id='txt_docdelid' value='".base64_encode($doc["id_documento"])."'>
					</form>
					<button type='button' class='btn btn-sm btn-outline-theme' title='Editar' onclick='editar(\"".base64_encode($doc["id_documento"])."\")' ><i class='fa fa-pencil'></i></button>";
			}								
			echo	"	</div>
						</div>
					</div>
				</div>";
			
		} 
	}
	public function document(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				$this->load->model("campana");
				$id=base64_decode($_POST["id"]);
				echo json_encode($this->campana->documento($id));
			} else {
				redirect(base_url("empresas"));
			}
		} else {
			redirect(base_url("login"));
		}
	}
	public function deletedocumento(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					$vacios=0;
					$this->load->model("campana");
					if((!isset($_POST["txt_docdelid"])) || $_POST["txt_docdelid"]==""){
						$vacios+=1;
					} 
					if($vacios!=0){
						$data["mensaje"]="Documento no pudo ser eliminado, intente nuevamente";
					} else {
						$id=base64_decode($_POST["txt_docdelid"]);
						$id_campana=base64_decode($_SESSION["campana"]);
						$add=$this->campana->documentosdelete($id);
						if(isset($add)){
							if($add["tipo"]!="url"){
								$ubicacion="archivos/documentos/".$id_campana."/".$add["link"];
								unlink($ubicacion);
							}						
							$data["mensaje"]=$add["mensaje"];
						} else {
							$data["mensaje"]="Documento eliminado con exito.";
						}						
					}
					$this->load->view('contenido');
					$this->load->view('alertas/alertas',$data);
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
	public function editDoc(){	
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					$this->load->model("campana");
					$vacios=0;
					if(!isset($_POST["id_carpetajs"]) || $_POST["id_carpetajs"]==""){
						$vacios+=1;
					}
					if(!isset($_POST["txt_archivoadd"]) || $_POST["txt_archivoadd"]==""){
						$vacios+=1;
					}
					if(!isset($_POST["lbl_tipodocadd"]) || $_POST["lbl_tipodocadd"]==""){
						$vacios+=1;
					} else if($_POST["lbl_tipodocadd"]=="2"){
						if(!isset($_POST["txt_urldocadd"]) || $_POST["txt_urldocadd"]==""){
							$vacios+=1;
						}
					} else if($_POST["lbl_tipodocadd"]=="1"){
						if(isset($_POST["txt_documentoadd"]) || $_POST["txt_documentoadd"]=="docu_undefined"){
							if(!isset($_FILES["txt_doc"]) || $_FILES["txt_doc"]["size"]<=0){
								$vacios+=1;
							}
						} 
					}
					if(!isset($_POST["txt_documentoid"]) || $_POST["txt_documentoid"]==""){
						$vacios+=1;
					}
					if($vacios!=0){
						$data["mensaje"]="Documento no pudo ser modificado, intente nuevamente";
					} else {
						$nombreDoc=$_POST["txt_archivoadd"];
						$usuario=$_SESSION["usuario"];
						$carpeta=base64_decode($_POST["id_carpetajs"]);
						if($_POST["lbl_tipodocadd"]=="2"){
							$nombreD=$_POST["txt_urldocadd"];
							$tipoDoc="url";
							$nombre=$_POST["txt_archivoadd"];
						} else if($_POST["lbl_tipodocadd"]=="1"){
							if($_POST["txt_documentoadd"]=="docu_undefined"){
								if(isset($_FILES["txt_doc"]) && $_FILES["txt_doc"]["size"]>0){
									$nombreD=explode('.', $_FILES["txt_doc"]["name"]);	
								} else {
									$nombreD="";
								}
							} else {
								$nombreD=explode('.',$_POST["txt_documentoadd"]);
							}
							$tipoDoc=$nombreD[1];
							$nombre=base64_encode($_POST["txt_archivoadd"]).".".$tipoDoc;
						}						
						$id=base64_decode($_POST["txt_documentoid"]);
						$add=$this->campana->editarDocumento($nombreDoc,$tipoDoc,$usuario,$nombre,$id);
						if(isset($add)){
							if($_POST["lbl_tipodocadd"]=="1" &&  $_FILES["txt_doc"]["size"]>0){
								$this->documento($nombreDoc,$add["carpeta"]);
							}							
							$data["mensaje"]=$add["mensaje"];
						} else {
							$data["mensaje"]="Documento no pudo ser modificado, intente nuevamente";
						}
					}				
					$this->load->view('contenido');
					$this->load->view('alertas/alertas',$data);
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
	public function fotografias($id_unico){
		$this->load->model("campana");
		$data["mat"]=$this->campana->campanaclientesdetalle($id_unico);
		$data["fotos"]=$this->campana->campanaclientesfotos($id_unico);
		$this->load->view('contenido');
		$this->load->view('informes/imp_powerbi',$data);
	}
}
?>