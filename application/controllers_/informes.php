<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class informes extends CI_Controller {

	public function informe(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					$this->load->model("campana");
					$this->load->model("empresa");
					$data["cc"]=$this->campana->campanaclientes(base64_decode($_SESSION["campana"]),"0,","0,","0,","0,","01-01-1900","01-01-1900","0,");
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
					if(!is_null($this->empresa->empresa(base64_decode($_SESSION["empresa"]))["color_principal"])){
						$data["empresa"]=$this->empresa->empresa(base64_decode($_SESSION["empresa"]));		
					}					
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
				$data["empresa"]=$this->empresa->empresa(base64_decode($_SESSION["empresa"]))["empresa"];
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
					$data["cc"]=$this->campana->campanaclientes(base64_decode($_SESSION["campana"]),"0,","0,","0,","0,","01-01-1900","01-01-1900","0,");
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
						$region="0,";
					}
					if(isset($_POST["ciudad"]) || $_POST["ciudad"]!=""){
						$ciudad=$_POST["ciudad"].",";
					} else {
						$ciudad="0,";
					}
					if(isset($_POST["sucursal"]) || $_POST["sucursal"]!=""){
						$sucursal=$_POST["sucursal"].",";
					} else {
						$sucursal="0,";
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

	public function fotografia(){
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
						$motivo=$_POST["motivo"].",";
					} else {
						$motivo="0,";
					}
					if(isset($_POST["region"]) || $_POST["region"]!=""){
						$region=$_POST["region"].",";
					} else {
						$region="0,";
					}
					if(isset($_POST["ciudad"]) || $_POST["ciudad"]!=""){
						$ciudad=$_POST["ciudad"].",";
					} else {
						$ciudad="0,";
					}
					if(isset($_POST["imp"]) || $_POST["imp"]!=""){
						$imp=$_POST["imp"].",";
					} else {
						$imp="0,";
					}
					if(isset($_POST["sucursal"]) || $_POST["sucursal"]!=""){
						$sucursal=$_POST["sucursal"].",";
					} else {
						$sucursal="0,";
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
		$this->load->library('PHPPowerPoint');
	}


	public function excelcam(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					if(base64_decode($_SESSION["empresa"])==9){
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


	function getNameFromNumber($num){
		$numeric = $num % 26;
		$letter = chr(65 + $numeric);
		$num2 = intval($num / 26);
		if ($num2 > 0) {
			return $this->getNameFromNumber($num2 - 1) . $letter;
		} else {
			return $letter;
		}
	} 

	function excelpg($id_cam){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					$this->load->model("campana");
					$this->load->model("clienteinfo");
					$this->load->library('phpexcel');
					$id_campana=base64_decode($id_cam);
					$excel = new PHPExcel();
					$excel->setActiveSheetIndex(0);
					$cam=$this->campana->campana($id_campana);
					$cli=$this->clienteinfo->clientes($id_campana,0);
					$inf=$this->clienteinfo->clientesinfo($id_campana,0);
					$mat=$this->campana->materiales_excel($id_campana);
					$excel->getActiveSheet()->setCellValueByColumnAndRow(3,4,$cam["campana"]);
					$excel->getActiveSheet()->setCellValueByColumnAndRow(0,4,"Start of Execution");
					$excel->getActiveSheet()->setCellValueByColumnAndRow(0,5,"Ultima Medicion");
					$c=array("ID LOCAL","CHANNEL","CLIENTE","CADENA","TIPO LOCAL","NOMBRE LOCAL","DIRECCION","COMUNA","CIUDAD","REGION","GZO","JEFE DE VENTAS ZONAL","AGENCIA REPONE","AGENCIA DE IMPLEMENTACIÓN","GESTOR DE IMPLEMENTACIÓN","PLAN CUMBRE","CARGA");
					for ($i=0; $i < count($c); $i++) { 
						$excel->getActiveSheet()->setCellValueByColumnAndRow($i,8,$c[$i]);
						$excel->getActiveSheet()->getStyleByColumnAndRow($i,8)->getFont()->setBold(true);
						$excel->getActiveSheet()->getStyleByColumnAndRow($i,8)->getFont()->setSize(10);
						$excel->getActiveSheet()->getStyleByColumnAndRow($i,8)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3366FF');
						$excel->getActiveSheet()->getStyleByColumnAndRow($i,8)->getFont()->getColor()->setRGB('ffffff');
					}
					for ($i=0; $i < count($cli); $i++) { 
						$excel->getActiveSheet()->setCellValueByColumnAndRow(0,$i+9,$cli[$i]["id_cliente"]);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(1,$i+9,$cli[$i]["canal"]);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(2,$i+9,$cli[$i]["cliente"]);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(3,$i+9,$cli[$i]["cadena"]);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(4,$i+9,$cli[$i]["nota_entrega"]);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(5,$i+9,$cli[$i]["nombre_fantasia"]);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(6,$i+9,$cli[$i]["direccion"]);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(7,$i+9,$cli[$i]["ciudad"]);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(8,$i+9,$cli[$i]["ciudad"]);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(9,$i+9,$cli[$i]["id_region"]);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(10,$i+9,$cli[$i]["gerente_zonal"]);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(11,$i+9,$cli[$i]["jefe"]);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(12,$i+9,$cli[$i]["agencia_repone"]);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(13,$i+9,$cli[$i]["agencia_implementa"]);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(14,$i+9,$cli[$i]["gestor"]);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(15,$i+9,$cli[$i]["instalacion"]);
					}
					$x=0;
					$m=0;
					for ($i=0; $i < count($mat); $i++) { 
						$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$m,6,$mat[$i]["medicion"]);
						$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$m,6)->getFont()->setBold(true);
						$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$m,6)->getFont()->setSize(11);
						$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$m,6)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3366FF');
						$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$m,6)->getFont()->getColor()->setRGB('ffffff');
						$excel->getActiveSheet()->mergeCells(''.$this->getNameFromNumber(count($c)+$m).'6:'.$this->getNameFromNumber(count($c)+$m+7).'6');
									

						$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$x,7,"Acuerdo");
						$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,7)->getFont()->setSize(10);
						$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,7)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3366FF');
						$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,7)->getFont()->getColor()->setRGB('ffffff');
						$x+=1;
						$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$x,7,"Status");
						$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,7)->getFont()->setSize(10);
						$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,7)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3366FF');
						$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,7)->getFont()->getColor()->setRGB('ffffff');
						$x+=1;
						$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$x,7,"Motivo");
						$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,7)->getFont()->setSize(10);
						$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,7)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3366FF');
						$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,7)->getFont()->getColor()->setRGB('ffffff');
						$x+=1;
						$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$x,7,"Fecha Programada");
						$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,7)->getFont()->setSize(10);
						$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,7)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3366FF');
						$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,7)->getFont()->getColor()->setRGB('ffffff');
						$x+=1;
						$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$x,7,"Fecha de Instalación");
						$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,7)->getFont()->setSize(10);
						$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,7)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3366FF');
						$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,7)->getFont()->getColor()->setRGB('ffffff');
						$x+=1;
						$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$x,7,"Tipo de Acuerdo");
						$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,7)->getFont()->setSize(10);
						$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,7)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3366FF');
						$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,7)->getFont()->getColor()->setRGB('ffffff');
						$x+=1;
						$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$x,7,"Inicio de Acuerdo");
						$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,7)->getFont()->setSize(10);
						$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,7)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3366FF');
						$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,7)->getFont()->getColor()->setRGB('ffffff');
						$x+=1;
						$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$x,7,"Finalización de Acuerdo");
						$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,7)->getFont()->setSize(10);
						$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,7)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3366FF');
						$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,7)->getFont()->getColor()->setRGB('ffffff');
						$x+=1;
						$m=$x;
					}
					ob_end_clean();
					ob_start();
					$excel_writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
					header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
					header('Content-Disposition: attachment;filename="'.$cam["campana"].'.xls"');
					header('Cache-Control: max-age=0');		
					$excel_writer->save('php://output');
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


	function excel($id_cam){
		$this->load->model("campana");
		$this->load->model("clienteinfo");
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
		$cli=$this->clienteinfo->clientes($id_campana,0);
		$inf=$this->clienteinfo->clientesinfo($id_campana,0);
		for ($i=0; $i < count($mat); $i++) { 
			$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$x,1,"Acuerdo_".$mat[$i]["medicion"]);
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,1)->getFont()->setBold(true);
			$x+=1;
			$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$x,1,"Implementado_".$mat[$i]["medicion"]);
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,1)->getFont()->setBold(true);
			$x+=1;
			$excel->getActiveSheet()->setCellValueByColumnAndRow(count($c)+$x,1,"Motivo_".$mat[$i]["medicion"]);
			$excel->getActiveSheet()->getStyleByColumnAndRow(count($c)+$x,1)->getFont()->setBold(true);
			$x+=1;
		}
		for ($i=0; $i < count($cli); $i++) { 
			$excel->getActiveSheet()->setCellValueByColumnAndRow(0,$i+2,$cam["campana"]);
			$excel->getActiveSheet()->setCellValueByColumnAndRow(1,$i+2,$cli[$i]["id_original"]);
			$excel->getActiveSheet()->setCellValueByColumnAndRow(2,$i+2,$cli[$i]["id_cliente"]);
			$excel->getActiveSheet()->setCellValueByColumnAndRow(3,$i+2,$cli[$i]["canal"]);
			$excel->getActiveSheet()->setCellValueByColumnAndRow(4,$i+2,$cli[$i]["jefe"]);
			$excel->getActiveSheet()->setCellValueByColumnAndRow(5,$i+2,$cli[$i]["ejecutivo"]);
			$excel->getActiveSheet()->setCellValueByColumnAndRow(6,$i+2,$cli[$i]["nombre_fantasia"]);
			$excel->getActiveSheet()->setCellValueByColumnAndRow(7,$i+2,$cli[$i]["direccion"]);
			$excel->getActiveSheet()->setCellValueByColumnAndRow(8,$i+2,$cli[$i]["ciudad"]);
			$excel->getActiveSheet()->setCellValueByColumnAndRow(9,$i+2,$cli[$i]["region"]);
			$excel->getActiveSheet()->setCellValueByColumnAndRow(10,$i+2,PHPExcel_Shared_Date::PHPToExcel($cli[$i]["fecha_programada"]));
			$excel->getActiveSheet()->getStyleByColumnAndRow(10, $i+2)->getNumberFormat()->setFormatCode('dd-mm-yyyy');
			if(is_null($cli[$i]["fecha_real"])){
				$excel->getActiveSheet()->setCellValueByColumnAndRow(11,$i+2,"");
			} else {
				$excel->getActiveSheet()->setCellValueByColumnAndRow(11,$i+2,PHPExcel_Shared_Date::PHPToExcel($cli[$i]["fecha_real"]));
				$excel->getActiveSheet()->getStyleByColumnAndRow(11, $i+2)->getNumberFormat()->setFormatCode('dd-mm-yyyy');
			}
			$excel->getActiveSheet()->setCellValueByColumnAndRow(12,$i+2,$cli[$i]["implementador"]);
			$excel->getActiveSheet()->setCellValueByColumnAndRow(13,$i+2,$cli[$i]["implementador_rut"]);
			$excel->getActiveSheet()->setCellValueByColumnAndRow(14,$i+2,$cli[$i]["cliente"]);
			$excel->getActiveSheet()->setCellValueByColumnAndRow(15,$i+2,$cli[$i]["cadena"]);
			$excel->getActiveSheet()->setCellValueByColumnAndRow(16,$i+2,$cli[$i]["motivo"]);
			$excel->getActiveSheet()->setCellValueByColumnAndRow(17,$i+2,$cli[$i]["quien_nombre"]);
			$excel->getActiveSheet()->setCellValueByColumnAndRow(18,$i+2,$cli[$i]["quien_rut"]);
			$excel->getActiveSheet()->setCellValueByColumnAndRow(19,$i+2,$cli[$i]["quien_cargo"]);
			$excel->getActiveSheet()->setCellValueByColumnAndRow(20,$i+2,$cli[$i]["update_comentario"]);
			$mf=21;
			$x=0;
			for ($j=0; $j < count($inf) ; $j++) { 
				if($cli[$i]["id_cliente"]==$inf[$j]["id_cliente"]){
								// for ($h=0; $h < count($mat); $h++) { 
								// 	if($inf[$j]["medicion"]==$mat[$h]["medicion"]){
								// 		$acuerdo=$inf[$j]["acuerdo"]." - ".$inf[$j]["id_cliente"];
								// 		$imp=$inf[$j]["implementado"]." - ".$inf[$j]["medicion"];
								// 		$motivo=$inf[$j]["motivo"];
								// 	} else {
								// 		$acuerdo="";
								// 		$imp="";
								// 		$motivo="";
								// 	}
								// 	$excel->getActiveSheet()->setCellValueByColumnAndRow($mf+$x,$i+2,$acuerdo);
								// 	$x+=1;
								// 	$excel->getActiveSheet()->setCellValueByColumnAndRow($mf+$x,$i+2,$imp);
								// 	$x+=1;
								// 	$excel->getActiveSheet()->setCellValueByColumnAndRow($mf+$x,$i+2,$motivo);
								// 	$x+=1;								
								// }	
				}						
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

	


}

?>
