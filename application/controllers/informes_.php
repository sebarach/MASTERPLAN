<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class informes extends CI_Controller {

	public function informe(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					$this->load->model("campana");
					$this->load->model("empresa");
					$data["cc"]=$this->campana->campanaclientes(base64_decode($_SESSION["campana"]),"0","0","0","0","01-01-1900","01-01-1900","0");
					// $data["cci"]=$this->campana->campanaclientesinfo(base64_decode($_SESSION["campana"]));
					// $data["cp"]=$this->campana->campanapdv(base64_decode($_SESSION["campana"]));
					// $data["crm"]=$this->campana->campanaregionmaterial(base64_decode($_SESSION["campana"]));
					// $data["crp"]=$this->campana->campanaregionpdv(base64_decode($_SESSION["campana"]));
					// $data["cs"]=$this->campana->campanasucursales(base64_decode($_SESSION["campana"]));
					// $data["ccd"]=$this->campana->campanaciudades(base64_decode($_SESSION["campana"]));
					// $data["cr"]=$this->campana->campanaregiones(base64_decode($_SESSION["campana"]));
					// $data["mc"]=$this->campana->campanamotivos(base64_decode($_SESSION["campana"]));
					// $data["mic"]=$this->campana->campanainfomotivos(base64_decode($_SESSION["campana"]));
					// $data["ccr"]=$this->campana->campanaclienterep(base64_decode($_SESSION["campana"]));

					$data["nombre"]=$_SESSION["nombre"];		
					$data["motivos"]=$this->campana->listarmotivos(base64_decode($_SESSION["campana"]));
					$data["campana"]=$this->campana->campana(base64_decode($_SESSION["campana"]));	
					$data["empresa"]=$this->empresa->empresa(base64_decode($_SESSION["empresa"]));							
					$this->load->view('contenido');
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
				$data["anio"]=base64_decode($_SESSION["anio"]);
				$data["empresa"]=$this->empresa->empresa(base64_decode($_SESSION["empresa"]));
				$data["nombre"]=$_SESSION["nombre"];
				$data["campanas"]=$this->campana->campanas(base64_decode($_SESSION["empresa"]),base64_decode($_SESSION["anio"]));
				$this->load->view('contenido');
				$this->load->view('cabeceras/cabecera_master',$data);
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
					$data["nombre"]=$_SESSION["nombre"];
					$data["cc"]=$this->campana->campanaclientes(base64_decode($_SESSION["campana"]),"0","0","0","0","01-01-1900","01-01-1900","0");
					$data["campana"]=$this->campana->campana(base64_decode($_SESSION["campana"]));	
					$data["cim"]=$this->campana->campanainfomaterial(base64_decode($_SESSION["campana"]),"0,","0,","0,","01-01-1900","01-01-1900");
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

	public function filtroinfo(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					$this->load->model("campana");
					if(isset($_POST["region"]) || $_POST["region"]!=""){
						$region=$_POST["region"].",";
					} else {
						$region="0";
					}
					if(isset($_POST["ciudad"]) || $_POST["ciudad"]!=""){
						$ciudad=str_replace('0',' ', $_POST["ciudad"]);
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
					$data["cc"]=$this->campana->campanaclientes(base64_decode($_SESSION["campana"]),$region,$ciudad,"0,",$sucursal,$fecha_programada,$fecha_real,"0,");
					$data["cim"]=$this->campana->campanainfomaterial(base64_decode($_SESSION["campana"]),$region,$ciudad,$sucursal,$fecha_programada,$fecha_real);
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
					if(isset($_GET['opcion'])){
						if(is_numeric($_GET['opcion'])){
							$buscasan = $_GET['opcion'];
							}else{
								$buscasan=1;
							}
						}else{
							$buscasan=1;
						}
					$data["nombre"]=$_SESSION["nombre"];
					$this->load->model("campana");
					$data["campana"]=$this->campana->campana(base64_decode($_SESSION["campana"]));
					$data["fotos"]=$this->campana->campanainformegaleria(base64_decode($_SESSION["campana"]),1,17,$buscasan);
					$data['opcion']=$buscasan;	
					$tempoCantidad = sizeof($data["fotos"]);
					$data['cantidad'] = ceil(($tempoCantidad+1)/16);
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
					// echo "r".$_POST["region"];
					// echo "c".$_POST["ciudad"];
					// echo "s".$_POST["sucursal"];
					// echo "i".$_POST["imp"];
					if(isset($_POST["motivo"]) || $_POST["motivo"]!=""){
						$motivo=$_POST["motivo"];
					} else {
						$motivo="0";
					}
					if(isset($_POST["region"]) || $_POST["region"]!=""){
						$region=$_POST["region"];
					} else {
						$region="0";
					}
					if(isset($_POST["ciudad"]) || $_POST["ciudad"]!=""){
						$ciudad=str_replace('0',' ', $_POST["ciudad"]);
					} else {
						$ciudad="0";
					}
					if(isset($_POST["imp"]) || $_POST["imp"]!=""){
						$imp=$_POST["imp"];
					} else {
						$imp="0";
					}
					if(isset($_POST["sucursal"]) || $_POST["sucursal"]!=""){
						$sucursal=$_POST["sucursal"];
					} else {
						$sucursal="0";
					}
					$fecha_programada="01-01-1900";
					$fecha_real="01-01-1900";
					$data["cc"]=$this->campana->campanaclientes(base64_decode($_SESSION["campana"]),$region,$ciudad,$imp,$sucursal,$fecha_programada,$fecha_real,$motivo);
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

	public function powerpointcam(){
		$this->load->library('Ppt_stuff');
	   	$this->load->model("campana");
		$campana=$this->campana->campana(base64_decode($_SESSION["campana"]));
		$arrayfotos=array();
		$f=1;
		while($f<100){
			$arr=$this->campana->campanainformegaleria(base64_decode($_SESSION["campana"]),1,17,$f);
			if(count($arr)>0){
				$arrayfotos[]=$arr;
			} else {
				break;
			}
			$f+=1;			
		}
	   $this->ppt_stuff->make_ppt($campana,$arrayfotos);

	}


	public function excelcam(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					if(base64_decode($_SESSION["empresa"])==9 && $_SESSION["perfil"]==1){
						$this->excelpg($_SESSION["campana"]);
					} else {
						$this->excel($_SESSION["campana"]);
					}
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
					redirect(base_url("campanas"));
				}				
			}
		} else {
			redirect(base_url("login"));
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
		$mat=$this->campana->materiales_excel($id_campana);
		$c=array("ID LOCAL","CHANNEL","CLIENTE","CADENA","TIPO LOCAL","NOMBRE LOCAL","DIRECCION","COMUNA","CIUDAD","REGION","GZO","JEFE DE VENTAS ZONAL","AGENCIA REPONE","AGENCIA DE IMPLEMENTACIÓN","GESTOR DE IMPLEMENTACIÓN","PLAN CUMBRE","CARGA");
		for ($i=0; $i < count($c); $i++) { 
			$excel->getActiveSheet()->setCellValueByColumnAndRow($i,3,$c[$i]);
			$excel->getActiveSheet()->getStyleByColumnAndRow($i,3)->getFont()->setBold(true);
			$excel->getActiveSheet()->getStyleByColumnAndRow($i,3)->getFont()->setSize(10);
			$excel->getActiveSheet()->getStyleByColumnAndRow($i,3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3366FF');
			$excel->getActiveSheet()->getStyleByColumnAndRow($i,3)->getFont()->getColor()->setRGB('ffffff');
		}
		for ($i=0; $i < count($mat); $i++) { 
			$materiales[]=$mat[$i]["medicion"];
			$clientes[]=$mat[$i]["id_cliente"]."//".$mat[$i]["canal"]."//".$mat[$i]["cliente"]."//".$mat[$i]["cadena"]."//".$mat[$i]["nota_entrega"]."//".$mat[$i]["nombre_fantasia"]."//".$mat[$i]["direccion"]."//".$mat[$i]["ciudad"]."//".$mat[$i]["id_region"]."//".$mat[$i]["gerente_zonal"]."//".$mat[$i]["jefe"]."//".$mat[$i]["agencia_repone"]."//".$mat[$i]["agencia_implementa"]."//".$mat[$i]["gestor"]."//".$mat[$i]["instalacion"];
		}
		for ($i=0; $i < count($mat); $i++) { 
			if(isset(array_unique($materiales)[$i])){
				$mate[]=array_unique($materiales)[$i];
			}
		}
		$x=0;
		$d=0;
		$m=0;
		$ca=0;
		$cs=0;
		for ($i=0; $i < count($mat); $i++) { 
			if(isset(array_unique($clientes)[$i])){
				$cli=explode("//",array_unique($clientes)[$i]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(0,$x+4,$cli[0]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(1,$x+4,$cli[1]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(2,$x+4,$cli[2]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(3,$x+4,$cli[3]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(4,$x+4,$cli[4]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(5,$x+4,$cli[5]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(6,$x+4,$cli[6]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(7,$x+4,$cli[7]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(8,$x+4,$cli[7]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(9,$x+4,$cli[8]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(10,$x+4,$cli[9]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(11,$x+4,$cli[10]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(12,$x+4,$cli[11]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(13,$x+4,$cli[12]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(14,$x+4,$cli[13]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(15,$x+4,$cli[14]);
				$mp=17;
				for ($j=0; $j < count($mat); $j++) { 
					if($cli[0]===$mat[$j]["id_cliente"]){
						for ($h=0; $h < count($mate); $h++) {
							if($mate[$h]===$mat[$j]["medicion"]){
								$d=0;
								$excel->getActiveSheet()->setCellValueByColumnAndRow($mp+($h*8)+$d,$x+4,$mat[$j]["acuerdo"]);
								$ca+=$mat[$j]["acuerdo"];
								$d+=1;
								$excel->getActiveSheet()->setCellValueByColumnAndRow($mp+($h*8)+$d,$x+4,$mat[$j]["implementado"]);
								$cs+=$mat[$j]["implementado"];
								$d+=1;
								$excel->getActiveSheet()->setCellValueByColumnAndRow($mp+($h*8)+$d,$x+4,$mat[$j]["cod_motivo"]);
								$d+=1;	
								$excel->getActiveSheet()->setCellValueByColumnAndRow($mp+($h*8)+$d,$x+4,date("d-m-Y",strtotime($mat[$j]["fecha_programada"])));
								$excel->getActiveSheet()->getStyleByColumnAndRow($mp+($h*8)+$d,$x+4)->getNumberFormat()->setFormatCode('dd-mm-yyyy');
								$d+=1;
								if(!is_null($mat[$j]["fecha_real"])){
									$excel->getActiveSheet()->setCellValueByColumnAndRow($mp+($h*8)+$d,$x+4,date("d-m-Y",strtotime($mat[$j]["fecha_real"])));
									$excel->getActiveSheet()->getStyleByColumnAndRow($mp+($h*8)+$d,$x+4)->getNumberFormat()->setFormatCode('dd-mm-yyyy');
								} else {
									$excel->getActiveSheet()->setCellValueByColumnAndRow($mp+($h*8)+$d,$x+4,"");
								}											
								$d+=1;
								$excel->getActiveSheet()->setCellValueByColumnAndRow($mp+($h*8)+$d,$x+4,$mat[$j]["tipo_acuerdo"]);
								$d+=1;
								$excel->getActiveSheet()->setCellValueByColumnAndRow($mp+($h*8)+$d,$x+4,date("d-m-Y",strtotime($mat[$j]["fecha_inicio_acuerdo"])));
								$excel->getActiveSheet()->getStyleByColumnAndRow($mp+($h*8)+$d,$x+4)->getNumberFormat()->setFormatCode('dd-mm-yyyy');
								$d+=1;
								$excel->getActiveSheet()->setCellValueByColumnAndRow($mp+($h*8)+$d,$x+4,date("d-m-Y",strtotime($mat[$j]["fecha_fin_acuerdo"])));
								$excel->getActiveSheet()->getStyleByColumnAndRow($mp+($h*8)+$d,$x+4)->getNumberFormat()->setFormatCode('dd-mm-yyyy');
								$d+=1;				
							}
						}
					}
				}
				$excel->getActiveSheet()->setCellValueByColumnAndRow($mp+(count($mate)*8),$x+4,$ca);
				$excel->getActiveSheet()->setCellValueByColumnAndRow($mp+(count($mate)*8)+1,$x+4,$cs);		
				$ca=0;
				$cs=0;
				$x+=1;
			}
		}
		$x=0;
		$m=0;
		$mp=17;
		$total=count(array_unique($clientes));
		for ($i=0; $i < count($mate); $i++) { 
			$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$m,1,$mate[$i]);
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$m,1)->getFont()->setBold(true);
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$m,1)->getFont()->setSize(11);
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$m,1)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3366FF');
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$m,1)->getFont()->getColor()->setRGB('ffffff');
			$excel->getActiveSheet()->mergeCells(''.$this->getNameFromNumber(count($c)+$m).'1:'.$this->getNameFromNumber(count($c)+$m+7).'1');
			$excel->getActiveSheet()->getStyle(''.$this->getNameFromNumber(count($c)+$m).'1:'.$this->getNameFromNumber(count($c)+$m+7).'1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


			$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$x,2,"Acuerdo");
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,2)->getFont()->setSize(10);
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3366FF');
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,2)->getFont()->getColor()->setRGB('ffffff');
			$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$x,3,"=SUBTOTAL(9,".$this->getNameFromNumber(count($c)+$x)."4:".$this->getNameFromNumber(count($c)+$x)."".count(array_unique($clientes)).")");
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFont()->setSize(10);
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3366FF');
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFont()->setBold(true);
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFont()->getColor()->setRGB('ffffff');
			$x+=1;
			$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$x,2,"Status");
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,2)->getFont()->setSize(10);
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3366FF');
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,2)->getFont()->getColor()->setRGB('ffffff');
			$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$x,3,"=SUBTOTAL(9,".$this->getNameFromNumber(count($c)+$x)."4:".$this->getNameFromNumber(count($c)+$x)."".count(array_unique($clientes)).")");
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFont()->setSize(10);
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3366FF');
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFont()->setBold(true);
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFont()->getColor()->setRGB('ffffff');
			$x+=1;
			$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$x,2,"Motivo");
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,2)->getFont()->setSize(10);
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3366FF');
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,2)->getFont()->getColor()->setRGB('ffffff');
			$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$x,3,"=SUBTOTAL(3,".$this->getNameFromNumber(count($c)+$x)."4:".$this->getNameFromNumber(count($c)+$x)."".count(array_unique($clientes)).")");
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFont()->setSize(10);
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3366FF');
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFont()->setBold(true);
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFont()->getColor()->setRGB('ffffff');
			$x+=1;
			$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$x,2,"Fecha Programada");
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,2)->getFont()->setSize(10);
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3366FF');
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,2)->getFont()->getColor()->setRGB('ffffff');
			$excel->setActiveSheetIndex(0)->getColumnDimension(''.$this->getNameFromNumber(count($c)+$x).'')->setWidth(12);
			$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$x,3,"=SUBTOTAL(3,".$this->getNameFromNumber(count($c)+$x)."4:".$this->getNameFromNumber(count($c)+$x)."".count(array_unique($clientes)).")");
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFont()->setSize(10);
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3366FF');
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFont()->setBold(true);
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFont()->getColor()->setRGB('ffffff');
			$x+=1;
			$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$x,2,"Fecha de Instalación");
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,2)->getFont()->setSize(10);
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3366FF');
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,2)->getFont()->getColor()->setRGB('ffffff');
			$excel->setActiveSheetIndex(0)->getColumnDimension(''.$this->getNameFromNumber(count($c)+$x).'')->setWidth(12);
			$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$x,3,"=SUBTOTAL(3,".$this->getNameFromNumber(count($c)+$x)."4:".$this->getNameFromNumber(count($c)+$x)."".count(array_unique($clientes)).")");
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFont()->setSize(10);
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3366FF');
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFont()->setBold(true);
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFont()->getColor()->setRGB('ffffff');
			$x+=1;
			$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$x,2,"Tipo de Acuerdo");
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,2)->getFont()->setSize(10);
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3366FF');
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,2)->getFont()->getColor()->setRGB('ffffff');
			$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$x,3,"=SUBTOTAL(3,".$this->getNameFromNumber(count($c)+$x)."4:".$this->getNameFromNumber(count($c)+$x)."".count(array_unique($clientes)).")");
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFont()->setSize(10);
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3366FF');
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFont()->setBold(true);
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFont()->getColor()->setRGB('ffffff');
			$x+=1;
			$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$x,2,"Inicio de Acuerdo");
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,2)->getFont()->setSize(10);
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3366FF');
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,2)->getFont()->getColor()->setRGB('ffffff');
			$excel->setActiveSheetIndex(0)->getColumnDimension(''.$this->getNameFromNumber(count($c)+$x).'')->setWidth(12);
			$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$x,3,"=SUBTOTAL(3,".$this->getNameFromNumber(count($c)+$x)."4:".$this->getNameFromNumber(count($c)+$x)."".count(array_unique($clientes)).")");
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFont()->setSize(10);
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3366FF');
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFont()->setBold(true);
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFont()->getColor()->setRGB('ffffff');
			$x+=1;
			$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$x,2,"Finalización de Acuerdo");
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,2)->getFont()->setSize(10);
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3366FF');
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,2)->getFont()->getColor()->setRGB('ffffff');
			$excel->setActiveSheetIndex(0)->getColumnDimension(''.$this->getNameFromNumber(count($c)+$x).'')->setWidth(12);
			$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$x,3,"=SUBTOTAL(3,".$this->getNameFromNumber(count($c)+$x)."4:".$this->getNameFromNumber(count($c)+$x)."".count(array_unique($clientes)).")");
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFont()->setSize(10);
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3366FF');
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFont()->setBold(true);
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFont()->getColor()->setRGB('ffffff');
			$x+=1;
			$m=$x;
		}
		$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$x,2,"Total");
		$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,2)->getFont()->setSize(10);
		$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3366FF');
		$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,2)->getFont()->getColor()->setRGB('ffffff');
		$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$x,3,"=SUBTOTAL(9,".$this->getNameFromNumber(count($c)+$x)."4:".$this->getNameFromNumber(count($c)+$x)."".count(array_unique($clientes)).")");
		$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFont()->setSize(10);
		$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3366FF');
		$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFont()->setBold(true);
		$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFont()->getColor()->setRGB('ffffff');
		$x+=1;
		$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$x,2,"Total");
		$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,2)->getFont()->setSize(10);
		$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3366FF');
		$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,2)->getFont()->getColor()->setRGB('ffffff');
		$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$x,3,"=SUBTOTAL(9,".$this->getNameFromNumber(count($c)+$x)."4:".$this->getNameFromNumber(count($c)+$x)."".count(array_unique($clientes)).")");
		$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFont()->setSize(10);
		$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3366FF');
		$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFont()->setBold(true);
		$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,3)->getFont()->getColor()->setRGB('ffffff');
		$excel->getActiveSheet()->getStyle(''.$this->getNameFromNumber(count($c)).'2:'.$this->getNameFromNumber(count($c)+$x).'2')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->setTitle("Calendario");
		ob_end_clean();
		ob_start();
		$excel_writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
		header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
		header('Content-Disposition: attachment;filename="'.$cam["campana"].'.xls"');
		header('Cache-Control: max-age=0');		
		$excel_writer->save('php://output');


	}


	private function excel($id_cam){
		$this->load->model("campana");
		$this->load->library('phpexcel');
		$id_campana=base64_decode($id_cam);
		$excel = new PHPExcel();
		$excel->setActiveSheetIndex(0);
		$c=array("BBDD","ID_Original","ID_Cliente","Canal","Jefe","Ejecutivo","Nombre Fantasia","Direccion","Ciudad","Region","Fecha Programada","Fecha Real","Implementador","Implementador Rut","Cliente","Cadena","Motivo","Quien Nombre","Quien Rut","Quien Cargo","Comentario");
		for ($i=0; $i < count($c); $i++) { 
			$excel->getActiveSheet()->setCellValueByColumnAndRow($i,1,$c[$i]);
			$excel->getActiveSheet()->getStyleByColumnAndRow($i,1)->getFont()->setBold(true);
		}
		$x=0;
		$mat=$this->campana->materiales_excel($id_campana);
		$cam=$this->campana->campana($id_campana);
		for ($i=0; $i < count($mat); $i++) { 
			$materiales[]=$mat[$i]["medicion"];
			$clientes[]=$mat[$i]["id_original"]."//".$mat[$i]["id_cliente"]."//".$mat[$i]["canal"]."//".$mat[$i]["jefe"]."//".$mat[$i]["ejecutivo"]."//".$mat[$i]["nombre_fantasia"]."//".$mat[$i]["direccion"]."//".$mat[$i]["ciudad"]."//".$mat[$i]["region"]."//".$mat[$i]["fecha_programada"]."//".$mat[$i]["fecha_real"]."//".$mat[$i]["implementador"]."//".$mat[$i]["implementador_rut"]."//".$mat[$i]["cliente"]."//".$mat[$i]["cadena"]."//".$mat[$i]["motivo"]."//".$mat[$i]["quien_nombre"]."//".$mat[$i]["quien_rut"]."//".$mat[$i]["quien_cargo"]."//".$mat[$i]["update_comentario"];
		}
		for ($i=0; $i < count($mat); $i++) {
			if(isset(array_unique($materiales)[$i])){
				$mate[]=array_unique($materiales)[$i];
			}			
		}
		for($i=0; $i < count($mate); $i++) {
			$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$x,1,"Acuerdo_".$mate[$i]);
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,1)->getFont()->setBold(true);
			$x+=1;
			$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$x,1,"Implementado_".$mate[$i]);
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,1)->getFont()->setBold(true);
			$x+=1;
			$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$x,1,"Motivo_".$mate[$i]);
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,1)->getFont()->setBold(true);
			$x+=1;
		}
		$x=0;
		for ($i=0; $i < count($mat); $i++) { 
			if(isset(array_unique($clientes)[$i])){
				$cli=explode("//",array_unique($clientes)[$i]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(0,$x+2,$cam["campana"]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(1,$x+2,$cli[0]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(2,$x+2,$cli[1]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(3,$x+2,$cli[2]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(4,$x+2,$cli[3]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(5,$x+2,$cli[4]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(6,$x+2,$cli[5]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(7,$x+2,$cli[6]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(8,$x+2,$cli[7]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(9,$x+2,$cli[8]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(10,$x+2,date("d-m-Y",strtotime($cli[9])));
				$excel->getActiveSheet()->getStyleByColumnAndRow(10, $x+2)->getNumberFormat()->setFormatCode('dd-mm-yyyy');
				if(is_null($cli[10])){
					$excel->getActiveSheet()->setCellValueByColumnAndRow(11,$x+2,"");
				} else {
					$excel->getActiveSheet()->setCellValueByColumnAndRow(11,$x+2,date("d-m-Y",strtotime($cli[10])));
					$excel->getActiveSheet()->getStyleByColumnAndRow(11, $x+2)->getNumberFormat()->setFormatCode('dd-mm-yyyy');
				}
				$excel->getActiveSheet()->setCellValueByColumnAndRow(12,$x+2,$cli[11]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(13,$x+2,$cli[12]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(14,$x+2,$cli[13]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(15,$x+2,$cli[14]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(16,$x+2,$cli[15]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(17,$x+2,$cli[16]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(18,$x+2,$cli[17]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(19,$x+2,$cli[18]);
				$excel->getActiveSheet()->setCellValueByColumnAndRow(20,$x+2,$cli[19]);
				$d=0;
				$f=21;
				$m=0;
				for ($j=0; $j < count($mat); $j++) { 
					if($cli[1]===$mat[$j]["id_cliente"]){
						for ($h=0; $h < count($mate); $h++) {
							if($mate[$h]===$mat[$j]["medicion"]){
								$d=0;
								$excel->getActiveSheet()->setCellValueByColumnAndRow($f+($h*3)+$d,$x+2,$mat[$j]["acuerdo"]);
								$d+=1;
								$excel->getActiveSheet()->setCellValueByColumnAndRow($f+($h*3)+$d,$x+2,$mat[$j]["implementado"]);
								$d+=1;
								$excel->getActiveSheet()->setCellValueByColumnAndRow($f+($h*3)+$d,$x+2,$mat[$j]["id_motivo"]);
								$d+=1;	
								$m=$f+($h*3)+$d;	
							}
						}
					}
				}	
				$excel->getActiveSheet()->getStyle(''.$this->getNameFromNumber(0).($x+2).':'.$this->getNameFromNumber($m).($x+2))->getAlignment()->setWrapText(false);			
				$x+=1;
			}

		}
		$excel->setActiveSheetIndex(0)->getColumnDimension('K')->setWidth(12);
		$excel->setActiveSheetIndex(0)->getColumnDimension('L')->setWidth(12);
		ob_end_clean();
		ob_start();
		$excel_writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
		header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
		header('Content-Disposition: attachment;filename="'.$cam["campana"].'.xls"');
		header('Cache-Control: max-age=0');		
		$excel_writer->save('php://output');
	}


	public function biblioteca(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					$this->load->model("campana");
					$this->load->model("perfil");
					$data["carpetas"]=$this->campana->carpetas(base64_decode($_SESSION["campana"]));
					$data["campana"]=$this->campana->campana(base64_decode($_SESSION["campana"]));
					$data["perfiles"]=$this->perfil->perfiles();
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
					if(isset($_GET['opcion'])){
						if(is_numeric($_GET['opcion'])){
							$buscasan = $_GET['opcion'];
							}else{
								$buscasan=1;
							}
						}else{
							$buscasan=1;
						}
					$data["nombre"]=$_SESSION["nombre"];
					$this->load->model("campana");
					$this->load->model("empresa");
					$data["campana"]=$this->campana->campana(base64_decode($_SESSION["campana"]));
					$data["empresa"]=$this->empresa->empresa(base64_decode($_SESSION["empresa"]));
					$data["fotos"]=$this->campana->campanainformegaleria(base64_decode($_SESSION["campana"]),1,17,$buscasan);
					$data['opcion']=$buscasan;	
					$tempoCantidad = sizeof($data["fotos"]);
					$data['cantidad'] = ceil(($tempoCantidad+1)/16);
					$this->load->view('contenido');
					$this->load->view('layout/menu',$data);
					$this->load->view('biblioteca/galeriacli',$data);
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

	function bibliotecacli(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					$this->load->model("campana");
					$this->load->model("empresa");
					$data["carpetas"]=$this->campana->carpetas(base64_decode($_SESSION["campana"]));
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
						if(!isset($_POST["txt_doc"]) || $_POST["txt_doc"]==""){
							$vacios+=1;
						}
					}
					if($vacios!=0){
						$data["mensaje"]="Documento no pudo ser agregado, intente nuevamente";
					} else {
						if($_POST["lbl_tipodocadd"]=="2"){
							$nombreD=$_POST["txt_urldocadd"];
							$tipoDoc="url";
						} else if($_POST["lbl_tipodocadd"]=="1"){
							$nombreD=explode('.', $_FILES["txt_doc"]["name"]);
							$tipoDoc=$nombreD[1];
						}						
						$nombreDoc=$_POST["txt_archivoadd"];
						$id_carpeta=base64_decode($_POST["id_carpetajs"]);
						$usuario=$_SESSION["usuario"];
						$add=$this->campana->guardarDocumento($nombreDoc,$tipoDoc,$id_carpeta,$usuario,$nombreD);
						if(isset($add)){
							if($_POST["lbl_tipodocadd"]=="1"){
								$this->documento($nombreDoc,$add["carpeta"]);
							}
							$data["mensaje"]=$add["mensaje"];
						} else {
							$data["mensaje"]="Documento no pudo ser agregado, intente nuevamente";
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
			if($doc["Tipo_Documento"]=="xls" || $doc["Tipo_Documento"]=="xlsx"){
				echo "<i class='fa fa-file-excel-o p-3 font-2xl mr-3 float-left text-theme'></i>";
			} else if($doc["Tipo_Documento"]=="pptx" || $doc["Tipo_Documento"]=="ppt"){
				echo "<i class='fa fa-file-powerpoint-o p-3 font-2xl mr-3 float-left text-theme'></i>";
			} else if($doc["Tipo_Documento"]=="pdf" ){
				echo "<i class='fa fa-file-pdf-o p-3 font-2xl mr-3 float-left text-theme'></i>";
			} else if($doc["Tipo_Documento"]=="url"){
				echo "<i class='fa fa-unlink p-3 font-2xl mr-3 float-left text-theme'></i>";
			} else if($doc["Tipo_Documento"]=="docx" || $doc["Tipo_Documento"]=="doc"){
				echo "<i class='fa fa-file-word-o p-3 font-2xl mr-3 float-left text-theme'></i>";
			} else if($doc["Tipo_Documento"]=="png" || $doc["Tipo_Documento"]=="jpg" || $doc["Tipo_Documento"]=="png"){
				echo "<i class='fa fa-file-image-o p-3 font-2xl mr-3 float-left text-theme'></i>";
			} else {
				echo "<i class='fa fa-file-o p-3 font-2xl mr-3 float-left text-theme'></i>";
			}
			if(strlen($doc["Nombre_Documento"])<25){
				echo "<small class='font-xs text-theme mb-0 mt-2'>".$doc["Nombre_Documento"]."</small><br>";
			} else {
				echo "<small class='font-xs text-theme mb-0 mt-2'>".substr($doc["Nombre_Documento"],0,25).". . .</small><br>";
			}
			if($doc["Tipo_Documento"]=="url"){
				$href=$doc["documento"];
			} else {
				$href=base_url("archivos/documentos/".base64_decode($_SESSION["campana"])."/".base64_decode($_POST["carp"])."/".$doc["documento"]);
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
						if(!isset($_FILES["txt_doc"])){
							$vacios+=1;
						}
					}
					if(!isset($_POST["txt_documentoid"]) || $_POST["txt_documentoid"]==""){
						$vacios+=1;
					}
					if($vacios!=0){
						$data["mensaje"]="Documento no pudo ser modificado, intente nuevamente";
					} else {
						if($_POST["lbl_tipodocadd"]=="2"){
							$nombreD=$_POST["txt_urldocadd"];
							$tipoDoc="url";
						} else if($_POST["lbl_tipodocadd"]=="1"){
							if($_FILES["txt_doc"]["size"]>0){
								$nombreD=explode('.', $_FILES["txt_doc"]["name"]);
								$tipoDoc=$nombreD[1];
							} else {
								$nombreD="";
								$tipoDoc="";
							}							
						}						
						$nombreDoc=$_POST["txt_archivoadd"];
						$usuario=$_SESSION["usuario"];
						$id=base64_decode($_POST["txt_documentoid"]);
						$add=$this->campana->editarDocumento($nombreDoc,$tipoDoc,$usuario,$nombreD,$id);
						if(isset($add)){
							if($_POST["lbl_tipodocadd"]=="1" && $_FILES["txt_doc"]["size"]>0){
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

}

?>
