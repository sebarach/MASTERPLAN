<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class clientesinfo extends CI_Controller {

	public function index(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					if(isset($_SESSION["accion"])){
						$this->load->model("campana");
						$this->load->model("listar");
						$this->load->model("empresa");
						$this->load->model("accion");
						$this->load->model("clienteinfo");
						$data["empresa"]=$this->empresa->empresa(base64_decode($_SESSION["empresa"]))["empresa"];
						$data["campana"]=$this->campana->campana(base64_decode($_SESSION["campana"]));
						$data["accion"]=$this->accion->accion(base64_decode($_SESSION["accion"]));
						$data["clientes"]=$this->clienteinfo->clientes(base64_decode($_SESSION["campana"]),base64_decode($_SESSION["accion"]));
						$data["clientesinfo"]=$this->clienteinfo->clientesinfo(base64_decode($_SESSION["campana"]),base64_decode($_SESSION["accion"]));
						$data["region"]=$this->listar->regiones(base64_decode($_SESSION["campana"]));
						$data["permisos"]=$this->listar->permisos($_SESSION["usuario"],'clientes_informacion');
						$data["modulos"]=$_SESSION["modulos"];
						$data["nombre"]=$_SESSION["nombre"];
						$this->load->view('contenido');
						$this->load->view('cabeceras/cabecera_master',$data);
						$this->load->view('layout/menu_master',$data);
						$this->load->view('clientes_info/clienteinfo',$data);
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


	public function master(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					if(isset($_SESSION["accion"])){
						$this->load->library('phpexcel');
						$this->load->model("campana");
						$excel = new PHPExcel();
						$excel->setActiveSheetIndex(0);
						if(base64_decode($_SESSION["empresa"])==9){
							$c=array("ID_Campana","ID_Accion","ID_Cliente","Canal","Ejecutivo","ID_Original","Nombre_Fantasia","Direccion","Ciudad","Region","Tipo_Local","Fecha_Programada","Cliente","Cadena","Jefe","Gerente_Zonal","Agencia_Repone","Agencia_Implementa","Gestor","Plan_Cumbre");
						} else {
							$c=array("ID_Campana","ID_Accion","ID_Cliente","Canal","Ejecutivo","ID_Original","Nombre_Fantasia","Direccion","Ciudad","Region","Nota_Entrega","Fecha_Programada","Cliente","Cadena","Jefe");
						}
						for ($i=0; $i < count($c); $i++) { 
							$excel->getActiveSheet()->setCellValueByColumnAndRow($i,1,$c[$i]);
							$excel->getActiveSheet()->getStyleByColumnAndRow($i,1)->getFont()->setBold(true);
						}
						$excel->getActiveSheet()->setCellValueByColumnAndRow(0,2,base64_decode($_SESSION["campana"]));
						$excel->getActiveSheet()->setCellValueByColumnAndRow(1,2,base64_decode($_SESSION["accion"]));
						$excel->getActiveSheet()->getStyle('L')->getNumberFormat()->setFormatCode('dd-mm-yyyy');
						$excel->getActiveSheet()->setTitle("Hoja1");
						$excel->createSheet();
						$excel->setActiveSheetIndex(1);
						if(base64_decode($_SESSION["empresa"])==9){
							$c=array("ID_Campana","ID_Accion","ID_Cliente","Fecha_Programada","Medicion","Acuerdo","Implementado","ID_Motivo","Clasificacion","Tipo_Acuerdo","Fecha_Inicio_Acuerdo","Fecha_Fin_Acuerdo","Costo");
						} else {
							$c=array("ID_Campana","ID_Accion","ID_Cliente","Fecha_Programada","Medicion","Acuerdo","Implementado","ID_Motivo");
						}
						for ($i=0; $i < count($c); $i++) { 
							$excel->getActiveSheet()->setCellValueByColumnAndRow($i,1,$c[$i]);
							$excel->getActiveSheet()->getStyleByColumnAndRow($i,1)->getFont()->setBold(true);
						}
						$excel->getActiveSheet()->setCellValueByColumnAndRow(0,2,base64_decode($_SESSION["campana"]));
						$excel->getActiveSheet()->setCellValueByColumnAndRow(1,2,base64_decode($_SESSION["accion"]));
						$excel->getActiveSheet()->getStyle('D')->getNumberFormat()->setFormatCode('dd-mm-yyyy');
						$excel->getActiveSheet()->setTitle("Hoja2");
						ob_end_clean();
						$excel_writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
						header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
						header('Content-Disposition: attachment;filename="'.base64_decode($_SESSION["campana"]).'-'.base64_decode($_SESSION["accion"]).'.xls"');
						header('Cache-Control: max-age=0');		
						$excel_writer->save('php://output');
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

	public function eliminarcliente(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					if(isset($_SESSION["accion"])){
						$this->load->model("clienteinfo");
						$data["titulo"]="Eliminar Sucursal";
						if((!isset($_POST["id"])) || $_POST["id"]==""){
							$data["mensaje"]="Sucursal no pudo ser eliminada, intente nuevamente";
						} else {
							$id=base64_decode($_POST["id"]);
							$add=$this->clienteinfo->clientespdvdelete($id);
							if(isset($add["mensaje"])){
								$data["mensaje"]=$add["mensaje"];
							} else {
								$data["mensaje"]="Sucursal eliminada con éxito";
							}
						}
						echo json_encode($data);
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

	public function eliminarclienteinfo(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					if(isset($_SESSION["accion"])){
						$this->load->model("clienteinfo");
						$data["titulo"]="Eliminar Material";
						if((!isset($_POST["id"])) || $_POST["id"]==""){
							$data["mensaje"]="Material no pudo ser eliminado, intente nuevamente";
						} else {
							$id=base64_decode($_POST["id"]);
							$add=$this->clienteinfo->clientesinfomatdelete($id);
							if(isset($add["mensaje"])){
								$data["mensaje"]=$add["mensaje"];
							} else {
								$data["mensaje"]="Material eliminado con éxito";
							}
						}
						echo json_encode($data);
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

	public function agregarclientes(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					if(isset($_SESSION["accion"])){
						$this->load->model("clienteinfo");
						$vacios=0;
						if((!isset($_POST["txt_id_cliente"])) || $_POST["txt_id_cliente"]==""){
							$vacios+=1;
						}
						if((!isset($_POST["txt_nombre_fantasia"])) || $_POST["txt_nombre_fantasia"]==""){
							$vacios+=1;
						}
						if((!isset($_POST["txt_direccion"])) || $_POST["txt_direccion"]==""){
							$vacios+=1;
						}  
						if((!isset($_POST["txt_fecha_programada"])) || $_POST["txt_fecha_programada"]==""){
							$vacios+=1;
						} 
						if((!isset($_POST["txt_ciudad"])) || $_POST["txt_ciudad"]==""){
							$vacios+=1;
						} 
						if((!isset($_POST["lbl_region"])) || $_POST["lbl_region"]==""){
							$vacios+=1;
						} 
						if((!isset($_POST["txt_canal"])) || $_POST["txt_canal"]==""){
							$vacios+=1;
						} 
						if((!isset($_POST["txt_cadena"])) || $_POST["txt_cadena"]==""){
							$vacios+=1;
						}
						if((!isset($_POST["txt_cliente"])) || $_POST["txt_cliente"]==""){
							$vacios+=1;
						}  
						if((!isset($_POST["txt_ejecutivo"])) || $_POST["txt_ejecutivo"]==""){
							$vacios+=1;
						} 
						if((!isset($_POST["txt_jefe"])) || $_POST["txt_jefe"]==""){
							$vacios+=1;
						} 
						if((!isset($_POST["txt_id_original"])) || $_POST["txt_id_original"]==""){
							$vacios+=1;
						} 
						if((!isset($_POST["txt_tipo_local"])) || $_POST["txt_tipo_local"]==""){
							$vacios+=1;
						}
						if(base64_decode($_SESSION["empresa"])==9){ 
							if((!isset($_POST["txt_gerente_zonal"])) || $_POST["txt_gerente_zonal"]==""){
								$vacios+=1;
							}
							if((!isset($_POST["txt_gestor"])) || $_POST["txt_gestor"]==""){
								$vacios+=1;
							}
							if((!isset($_POST["txt_agencia_repone"])) || $_POST["txt_agencia_repone"]==""){
								$vacios+=1;
							}
							if((!isset($_POST["txt_agencia_implementa"])) || $_POST["txt_agencia_implementa"]==""){
								$vacios+=1;
							}
							if((!isset($_POST["txt_plan_cumbre"])) || $_POST["txt_plan_cumbre"]==""){
								$vacios+=1;
							}
						}
						if($vacios!=0){
							$data["mensaje"]="Los datos ingresados están incompletos, intente nuevamente";
						} else {
							$data["id_campana"]=base64_decode($_SESSION["campana"]);
							$data["id_accion"]=base64_decode($_SESSION["accion"]);
							$data["id_cliente"]=$_POST["txt_id_cliente"];
							$data["canal"]=$_POST["txt_canal"];
							$data["ejecutivo"]=$_POST["txt_ejecutivo"];
							$data["id_original"]=$_POST["txt_id_original"];
							$data["nombre_fantasia"]=$_POST["txt_nombre_fantasia"];
							$data["direccion"]=$_POST["txt_direccion"];
							$data["ciudad"]=$_POST["txt_ciudad"];
							$data["region"]=$_POST["lbl_region"];
							$data["nota_entrega"]=$_POST["txt_tipo_local"];
							$data["fecha_programada"]=$_POST["txt_fecha_programada"];
							$data["cliente"]=$_POST["txt_cliente"];
							$data["cadena"]=$_POST["txt_cadena"];
							$data["jefe"]=$_POST["txt_jefe"];
							if(base64_decode($_SESSION["empresa"])==9){
								$data["gerente_zonal"]=$_POST["txt_gerente_zonal"];
								$data["agencia_repone"]=$_POST["txt_agencia_repone"];
								$data["agencia_implementa"]=$_POST["txt_agencia_implementa"];
								$data["gestor"]=$_POST["txt_gestor"];
								$data["instalacion"]=$_POST["txt_plan_cumbre"];
							}
							if((isset($_POST["txt_id_unico"])) && $_POST["txt_id_unico"]!=""){
								$data["titulo"]="Editar Sucursal";
								$data["id_unico"]=base64_decode($_POST["txt_id_unico"]);
								$add=$this->clienteinfo->clientespdvedit($data);
								if(isset($add["mensaje"])){
									$data["mensaje"]=$add["mensaje"];
								} else {
									$data["mensaje"]="Sucursal editada con éxito";
								}
							} else {
								$data["titulo"]="Agregar Sucursal";
								$add=$this->clienteinfo->clientespdvadd($data);
								if(isset($add["mensaje"])){
									$data["mensaje"]=$add["mensaje"];
								} else {
									$data["mensaje"]="Sucursal agregada con éxito";
								}
							}							
						}
						echo json_encode($data);
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

	public function agregarclienteinfo(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					if(isset($_SESSION["accion"])){
						$this->load->model("clienteinfo");
						$vacios=0;
						if((!isset($_POST["txt_id_cliente_i"])) || $_POST["txt_id_cliente_i"]==""){
							$vacios+=1;
						}
						if((!isset($_POST["txt_fecha_programada_i"])) || $_POST["txt_fecha_programada_i"]==""){
							$vacios+=1;
						}
						if((!isset($_POST["txt_medicion_i"])) || $_POST["txt_medicion_i"]==""){
							$vacios+=1;
						}
						if((!isset($_POST["txt_acuerdo_i"])) || $_POST["txt_acuerdo_i"]==""){
							$vacios+=1;
						}
						if(base64_decode($_SESSION["empresa"])==9){
							if((!isset($_POST["txt_clasificacion_i"])) || $_POST["txt_clasificacion_i"]==""){
								$vacios+=1;
							}
							if((!isset($_POST["txt_tipo_acuerdo_i"])) || $_POST["txt_tipo_acuerdo_i"]==""){
								$vacios+=1;
							}
							if((!isset($_POST["txt_fecha_inicio_i"])) || $_POST["txt_fecha_inicio_i"]==""){
								$vacios+=1;
							}
							if((!isset($_POST["txt_fecha_fin_i"])) || $_POST["txt_fecha_fin_i"]==""){
								$vacios+=1;
							}
							if((!isset($_POST["txt_costo_i"])) || $_POST["txt_costo_i"]==""){
								$vacios+=1;
							}
						}
						if($vacios!=0){
							$data["mensaje"]="Los datos ingresados están incompletos, intente nuevamente";
						} else {
							$data["id_campana"]=base64_decode($_SESSION["campana"]);
							$data["id_accion"]=base64_decode($_SESSION["accion"]);
							$data["id_cliente"]=$_POST["txt_id_cliente_i"];
							$data["medicion"]=$_POST["txt_medicion_i"];
							$data["acuerdo"]=$_POST["txt_acuerdo_i"];
							$data["implementado"]="0";
							$data["id_motivo"]="99";
							$data["fecha_programada"]=$_POST["txt_fecha_programada_i"];
							if(base64_decode($_SESSION["empresa"])==9){
								$data["clasificacion"]=$_POST["txt_clasificacion_i"];
								$data["tipo_acuerdo"]=$_POST["txt_tipo_acuerdo_i"];
								$data["fecha_inicio_acuerdo"]=$_POST["txt_fecha_inicio_i"];
								$data["fecha_fin_acuerdo"]=$_POST["txt_fecha_fin_i"];
								$data["instalacion"]=$_POST["txt_costo_i"];
							}
							if((isset($_POST["txt_id_info"])) && $_POST["txt_id_info"]!="" && $_POST["txt_id_info"]>0){
								$data["titulo"]="Editar Material";
								$data["id_info"]=base64_decode($_POST["txt_id_info"]);
								$add=$this->clienteinfo->clientesinfomatedit($data);
								if(isset($add["mensaje"])){
									$data["mensaje"]=$add["mensaje"];
								} else {
									$data["mensaje"]="Material editado con éxito";
								}
							} else {
								$data["titulo"]="Agregar Material";
								$add=$this->clienteinfo->clientesinfomatadd($data);
								if(isset($add["mensaje"])){
									$data["mensaje"]=$add["mensaje"];
								} else {
									$data["mensaje"]="Material agregado con éxito";
								}
							}														
						}
						echo json_encode($data);
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


	public function leermaster(){
		if(isset($_SESSION["sesion"])){
			if(isset($_SESSION["empresa"])){
				if(isset($_SESSION["campana"])){
					if(isset($_SESSION["accion"])){
						$vacios=0;
						if((!isset($_POST["chck_master"])) || $_POST["chck_master"]==""){
							$vacios+=1;
						}
						if($vacios!=0){
							$_SESSION["mensaje"]="Debe seleccionar una opción INGRESAR MASTER o EDITAR MASTER";
						} else {
							if($_POST["chck_master"]==2){
								$_SESSION["mensaje"]=$this->addmaster();
							} else if($_POST["chck_master"]==4){
								$_SESSION["mensaje"]=$this->editmaster();
							}
						}
						redirect(base_url("clientesinfo"));
					} else {
						redirect(base_url("acciones"));
					}
				} else {
					redirect(base_url("empresas"));
				}
			} else {
				redirect(base_url("empresas"));
			}
		} else {
			redirect(base_url("login"));
		}
	}


	function addmaster(){
		$this->load->library('phpexcel');
		if(isset($_FILES['ex_master'])){
			$arc=explode('.', strtolower($_FILES['ex_master']['name']));
			$ex= end($arc);
			if($ex=="xls" || $ex=="xlsx"){
				$excel = $this->limpiaEspacio($_FILES['ex_master']['name']);
				$contar=rand(1, 1000000);
				move_uploaded_file($_FILES['ex_master']['tmp_name'],'archivos/master/'.$contar.$excel);
				$tipo = PHPExcel_IOFactory::identify("archivos/master/".$contar.$excel);
				$reader = PHPExcel_IOFactory::createReader($tipo);
				$file= $reader->load("archivos/master/".$contar.$excel);
				if($file->getSheetCount()<2){
					$mensaje="El archivo excel subido no corresponde, debido a que sólo contiene una hoja. Seleccione el archivo correcto.";
				} else if($file->getSheetCount()>2){ 
					$mensaje="El archivo excel subido no corresponde, debido a que contiene más de dos hojas. Seleccione el archivo correcto.";
				} else {
					//Validar Hoja1
					$file->setActiveSheetIndex(0);
					$erroresh1=array();
					$e=0; $column=0;
					$letras1=PHPExcel_Cell::stringFromColumnIndex(PHPExcel_Cell::columnIndexFromString($file->setActiveSheetIndex(0)->getHighestColumn()));
					for ($i=1; $i <= $file->setActiveSheetIndex(0)->getHighestRow(); $i++) {
						for ($col='A'; $col != $letras1; $col++){
							if($i!=1){
								if($file->getActiveSheet()->getCell(''.$col.$i)->getCalculatedValue()===NULL){
									if($this->checkrow($file,0,$i)){
										$column=1;
										break;
									} else {
										$erroresh1[$e]=$col.$i;
										$e+=1;
									}	
								} else {
									if($col=='A'){
										if($file->getActiveSheet()->getCell(''.$col.$i)->getCalculatedValue()!=base64_decode($_SESSION["campana"])){
											$erroresh1[$e]=$col.$i;
											$e+=1;
										}
									}
									if($col=='B'){
										if($file->getActiveSheet()->getCell(''.$col.$i)->getCalculatedValue()!=base64_decode($_SESSION["accion"])){
											$erroresh1[$e]=$col.$i;
											$e+=1;
										}
									}
									if($col=='J'){
										if(!is_numeric($file->getActiveSheet()->getCell(''.$col.$i)->getCalculatedValue())){
											$erroresh1[$e]=$col.$i;
											$e+=1;
										}
									}
									if($col=='L'){
										if(!PHPExcel_Shared_Date::isDateTime($file->getActiveSheet()->getCell(''.$col.$i))){
											$erroresh1[$e]=$col.$i;
											$e+=1;
										}
									}
									if(base64_decode($_SESSION["empresa"])==9){
										if($col=='T'){
											if(!is_numeric($file->getActiveSheet()->getCell(''.$col.$i)->getCalculatedValue())){
												$erroresh1[$e]=$col.$i;
												$e+=1;
											}
										}
									}
								}
								if($column==1){
									break;
								}
							}
						}
					}

					//Validar Hoja2
					$file->setActiveSheetIndex(1);
					$erroresh2=array();
					$e=0; $column=0;
					$letras2=PHPExcel_Cell::stringFromColumnIndex(PHPExcel_Cell::columnIndexFromString($file->setActiveSheetIndex(1)->getHighestColumn()));
					for ($i=1; $i <= $file->setActiveSheetIndex(1)->getHighestRow(); $i++) {
						for ($col='A'; $col != $letras2; $col++) {
							if($i!=1){
								if($file->getActiveSheet()->getCell(''.$col.$i)->getCalculatedValue()===NULL){
									if($this->checkrow($file,1,$i)){
										$column=1;
										break;
									} else {
										$erroresh2[$e]=$col.$i;
										$e+=1;
									}	
								} else {
									if($col=='A'){
										if($file->getActiveSheet()->getCell(''.$col.$i)->getCalculatedValue()!=base64_decode($_SESSION["campana"])){
											$erroresh2[$e]=$col.$i;
											$e+=1;
										}
									}
									if($col=='B'){
										if($file->getActiveSheet()->getCell(''.$col.$i)->getCalculatedValue()!=base64_decode($_SESSION["accion"])){
											$erroresh2[$e]=$col.$i;
											$e+=1;
										}
									}
									if($col=='D'){
										if(!PHPExcel_Shared_Date::isDateTime($file->getActiveSheet()->getCell(''.$col.$i))){
											$erroresh2[$e]=$col.$i;
											$e+=1;
										}
									}
									if($col=='F'){
										if(!is_numeric($file->getActiveSheet()->getCell(''.$col.$i)->getCalculatedValue())){
											$erroresh2[$e]=$col.$i;
											$e+=1;
										}
									}
									if($col=='G'){
										if(!is_numeric($file->getActiveSheet()->getCell(''.$col.$i)->getCalculatedValue())){
											$erroresh2[$e]=$col.$i;
											$e+=1;
										}
									}
									if($col=='H'){
										if(!is_numeric($file->getActiveSheet()->getCell(''.$col.$i)->getCalculatedValue())){
											$erroresh2[$e]=$col.$i;
											$e+=1;
										}
									}												
									if(base64_decode($_SESSION["empresa"])==9){
										if($col=='K'){
											if(!PHPExcel_Shared_Date::isDateTime($file->getActiveSheet()->getCell(''.$col.$i))){
												$erroresh2[$e]=$col.$i;
												$e+=1;
											}
										}
										if($col=='L'){
											if(!PHPExcel_Shared_Date::isDateTime($file->getActiveSheet()->getCell(''.$col.$i))){
												$erroresh2[$e]=$col.$i;
												$e+=1;
											}
										}
										if($col=='M'){
											if(!is_numeric($file->getActiveSheet()->getCell(''.$col.$i)->getCalculatedValue())){
												$erroresh2[$e]=$col.$i;
												$e+=1;
											}
										}
									}
								}
								if($column==1){
									break;
								}
							}
						}
					}
					$h1=""; $h2="";
					if(count($erroresh1)>0){
						for ($i=0; $i < count($erroresh1); $i++) { 
							$h1.=$erroresh1[$i].",";
						}
						$h1="Errores Hoja1:".substr($h1,0,-1)."<br>";
					}
					if(count($erroresh2)>0){
						for ($i=0; $i < count($erroresh2); $i++) { 
							$h2.=$erroresh2[$i].",";
						}
						$h2="Errores Hoja2:".substr($h2,0,-1)."<br>";
					} 
					$this->load->model("clienteinfo");
					if($h1=="" && $h2==""){
						$m=0;
						// $this->clienteinfo->clientesdelete(base64_decode($_SESSION["campana"]),base64_decode($_SESSION["accion"]));
						for ($i=1; $i <= $file->setActiveSheetIndex(0)->getHighestRow(); $i++) {
							if($i!=1){
								$data=array();
								for ($col='A'; $col != PHPExcel_Cell::stringFromColumnIndex(PHPExcel_Cell::columnIndexFromString($file->setActiveSheetIndex(0)->getHighestColumn())); $col++) {
									if($file->getActiveSheet()->getCell(''.$col.$i)->getCalculatedValue()!==NULL){
										if($col=="K"){
											$id="nota_entrega";
										} else if($col=="T"){
											$id="instalacion";
										} else {
											$id=strtolower($file->getActiveSheet()->getCell(''.$col.'1')->getCalculatedValue());
										}
										if(PHPExcel_Shared_Date::isDateTime($file->getActiveSheet()->getCell(''.$col.$i))) {
											$timestamp = PHPExcel_Shared_Date::ExcelToPHP($file->getActiveSheet()->getCell(''.$col.$i)->getValue());
											$data[$id]= date("Ymd",$timestamp);
										} else {
											$data[$id]=$file->getActiveSheet()->getCell(''.$col.$i)->getCalculatedValue();
										}										 				
									} else {
										$m=1;
										 break;
									}
								}
								if(count($data)>0){
									$this->clienteinfo->clientesadd($data);
								}										 		
								if($m==1){
									break;
								}
							}							 	
						}
						$m=0;
						for ($i=1; $i <= $file->setActiveSheetIndex(1)->getHighestRow(); $i++) {
							if($i!=1){
								$data=array();
								for ($col='A'; $col != PHPExcel_Cell::stringFromColumnIndex(PHPExcel_Cell::columnIndexFromString($file->setActiveSheetIndex(1)->getHighestColumn())); $col++) {
									if($file->getActiveSheet()->getCell(''.$col.$i)->getCalculatedValue()!==NULL){	
										if($col=="M"){
										 	$id="instalacion";
										}  else {
										 	$id=strtolower($file->getActiveSheet()->getCell(''.$col.'1')->getCalculatedValue());
										}
										if(PHPExcel_Shared_Date::isDateTime($file->getActiveSheet()->getCell(''.$col.$i))) {
										 	$timestamp = PHPExcel_Shared_Date::ExcelToPHP($file->getActiveSheet()->getCell(''.$col.$i)->getValue());
										 	$data[$id]= date("Ymd",$timestamp);
										} else {
											$data[$id]=$file->getActiveSheet()->getCell(''.$col.$i)->getCalculatedValue();
										}
									} else {
										$m=1;
										break;
									}
								}
								if(count($data)>0){
									$this->clienteinfo->clientesinfoadd($data);
								}										 		
								if($m==1){
									break;
								}
							}									 	
						}	
						$add=$this->clienteinfo->validarmasterplanadd();
						if($add["respuesta"]==1){
							$mensaje="Carga de Master exitosa.";
							$carpeta="archivos/fotos/".base64_decode($_SESSION["accion"]);
							if (!file_exists($carpeta)) {
								mkdir($carpeta, 0777, true);
							}
						} else {
							$mensaje=$add["mensaje"];
						}
					} else {
						$mensaje=$h1.$h2;
					}
					unlink("archivos/master/".$contar.$excel);
				}
			} else {
				$mensaje="La extensión del archivo no es válida, las extensiones permitidas son .xls y .xlsx";
				unlink("archivos/master/".$contar.$excel);
			}
		} else {
			$mensaje="No existe un archivo adjunto, por favor intenta nuevamente";
		}
		return $mensaje;
	}


	function editmaster(){
		$this->load->library('phpexcel');
		if(isset($_FILES['ex_master'])){
			$arc=explode('.', strtolower($_FILES['ex_master']['name']));
			$ex= end($arc);
			if($ex=="xls" || $ex=="xlsx"){
				$excel = $this->limpiaEspacio($_FILES['ex_master']['name']);
				$contar=rand(1, 1000000);
				move_uploaded_file($_FILES['ex_master']['tmp_name'],'archivos/master/'.$contar.$excel);
				$tipo = PHPExcel_IOFactory::identify("archivos/master/".$contar.$excel);
				$reader = PHPExcel_IOFactory::createReader($tipo);
				$file= $reader->load("archivos/master/".$contar.$excel);
				if($file->getSheetCount()<2){
					$mensaje="El archivo excel subido no corresponde, debido a que sólo contiene una hoja. Seleccione el archivo correcto.";
				} else if($file->getSheetCount()>2){ 
					$mensaje="El archivo excel subido no corresponde, debido a que contiene más de dos hojas. Seleccione el archivo correcto.";
				} else {
					//Validar Hoja1
					$file->setActiveSheetIndex(0);
					$erroresh1=array();
					$e=0; $column=0;
					$letras1=PHPExcel_Cell::stringFromColumnIndex(PHPExcel_Cell::columnIndexFromString($file->setActiveSheetIndex(0)->getHighestColumn()));
					for ($i=1; $i <= $file->setActiveSheetIndex(0)->getHighestRow(); $i++) {
						for ($col='A'; $col != $letras1; $col++){
							if($i!=1){
								if($file->getActiveSheet()->getCell(''.$col.$i)->getCalculatedValue()===NULL){
									if($this->checkrow($file,0,$i)){
										$column=1;
										break;
									} else {
										$erroresh1[$e]=$col.$i;
										$e+=1;
									}	
								} else {
									if($col=='A'){
										if($file->getActiveSheet()->getCell(''.$col.$i)->getCalculatedValue()!=base64_decode($_SESSION["campana"])){
											$erroresh1[$e]=$col.$i;
											$e+=1;
										}
									}
									if($col=='B'){
										if($file->getActiveSheet()->getCell(''.$col.$i)->getCalculatedValue()!=base64_decode($_SESSION["accion"])){
											$erroresh1[$e]=$col.$i;
											$e+=1;
										}
									}
									if($col=='J'){
										if(!is_numeric($file->getActiveSheet()->getCell(''.$col.$i)->getCalculatedValue())){
											$erroresh1[$e]=$col.$i;
											$e+=1;
										}
									}
									if($col=='L'){
										if(!PHPExcel_Shared_Date::isDateTime($file->getActiveSheet()->getCell(''.$col.$i))){
											$erroresh1[$e]=$col.$i;
											$e+=1;
										}
									}
									if(base64_decode($_SESSION["empresa"])==9){
										if($col=='T'){
											if(!is_numeric($file->getActiveSheet()->getCell(''.$col.$i)->getCalculatedValue())){
												$erroresh1[$e]=$col.$i;
												$e+=1;
											}
										}
									}
								}
								if($column==1){
									break;
								}
							}
						}
					}

					//Validar Hoja2
					$file->setActiveSheetIndex(1);
					$erroresh2=array();
					$e=0; $column=0;
					$letras2=PHPExcel_Cell::stringFromColumnIndex(PHPExcel_Cell::columnIndexFromString($file->setActiveSheetIndex(1)->getHighestColumn()));
					for ($i=1; $i <= $file->setActiveSheetIndex(1)->getHighestRow(); $i++) {
						for ($col='A'; $col != $letras2; $col++) {
							if($i!=1){
								if($file->getActiveSheet()->getCell(''.$col.$i)->getCalculatedValue()===NULL){
									if($this->checkrow($file,1,$i)){
										$column=1;
										break;
									} else {
										$erroresh2[$e]=$col.$i;
										$e+=1;
									}	
								} else {
									if($col=='A'){
										if($file->getActiveSheet()->getCell(''.$col.$i)->getCalculatedValue()!=base64_decode($_SESSION["campana"])){
											$erroresh2[$e]=$col.$i;
											$e+=1;
										}
									}
									if($col=='B'){
										if($file->getActiveSheet()->getCell(''.$col.$i)->getCalculatedValue()!=base64_decode($_SESSION["accion"])){
											$erroresh2[$e]=$col.$i;
											$e+=1;
										}
									}
									if($col=='D'){
										if(!PHPExcel_Shared_Date::isDateTime($file->getActiveSheet()->getCell(''.$col.$i))){
											$erroresh2[$e]=$col.$i;
											$e+=1;
										}
									}
									if($col=='F'){
										if(!is_numeric($file->getActiveSheet()->getCell(''.$col.$i)->getCalculatedValue())){
											$erroresh2[$e]=$col.$i;
											$e+=1;
										}
									}
									if($col=='G'){
										if(!is_numeric($file->getActiveSheet()->getCell(''.$col.$i)->getCalculatedValue())){
											$erroresh2[$e]=$col.$i;
											$e+=1;
										}
									}
									if($col=='H'){
										if(!is_numeric($file->getActiveSheet()->getCell(''.$col.$i)->getCalculatedValue())){
											$erroresh2[$e]=$col.$i;
											$e+=1;
										}
									}												
									if(base64_decode($_SESSION["empresa"])==9){
										if($col=='K'){
											if(!PHPExcel_Shared_Date::isDateTime($file->getActiveSheet()->getCell(''.$col.$i))){
												$erroresh2[$e]=$col.$i;
												$e+=1;
											}
										}
										if($col=='L'){
											if(!PHPExcel_Shared_Date::isDateTime($file->getActiveSheet()->getCell(''.$col.$i))){
												$erroresh2[$e]=$col.$i;
												$e+=1;
											}
										}
										if($col=='M'){
											if(!is_numeric($file->getActiveSheet()->getCell(''.$col.$i)->getCalculatedValue())){
												$erroresh2[$e]=$col.$i;
												$e+=1;
											}
										}
									}
								}
								if($column==1){
									break;
								}
							}
						}
					}
					$h1=""; $h2="";
					if(count($erroresh1)>0){
						for ($i=0; $i < count($erroresh1); $i++) { 
							$h1.=$erroresh1[$i].",";
						}
						$h1="Errores Hoja1:".substr($h1,0,-1)."<br>";
					}
					if(count($erroresh2)>0){
						for ($i=0; $i < count($erroresh2); $i++) { 
							$h2.=$erroresh2[$i].",";
						}
						$h2="Errores Hoja2:".substr($h2,0,-1)."<br>";
					} 
					$this->load->model("clienteinfo");
					if($h1=="" && $h2==""){
						$m=0;
						// $this->clienteinfo->clientesdelete(base64_decode($_SESSION["campana"]),base64_decode($_SESSION["accion"]));
						for ($i=1; $i <= $file->setActiveSheetIndex(0)->getHighestRow(); $i++) {
							if($i!=1){
								$data=array();
								for ($col='A'; $col != PHPExcel_Cell::stringFromColumnIndex(PHPExcel_Cell::columnIndexFromString($file->setActiveSheetIndex(0)->getHighestColumn())); $col++) {
									if($file->getActiveSheet()->getCell(''.$col.$i)->getCalculatedValue()!==NULL){
										if($col=="K"){
											$id="nota_entrega";
										} else if($col=="T"){
											$id="instalacion";
										} else {
											$id=strtolower($file->getActiveSheet()->getCell(''.$col.'1')->getCalculatedValue());
										}
										if(PHPExcel_Shared_Date::isDateTime($file->getActiveSheet()->getCell(''.$col.$i))) {
											$timestamp = PHPExcel_Shared_Date::ExcelToPHP($file->getActiveSheet()->getCell(''.$col.$i)->getValue());
											$data[$id]= date("Ymd",$timestamp);
										} else {
											$data[$id]=$file->getActiveSheet()->getCell(''.$col.$i)->getCalculatedValue();
										}										 				
									} else {
										$m=1;
										 break;
									}
								}
								if(count($data)>0){
									$this->clienteinfo->clientesadd($data);
								}										 		
								if($m==1){
									break;
								}
							}							 	
						}
						$m=0;
						for ($i=1; $i <= $file->setActiveSheetIndex(1)->getHighestRow(); $i++) {
							if($i!=1){
								$data=array();
								for ($col='A'; $col != PHPExcel_Cell::stringFromColumnIndex(PHPExcel_Cell::columnIndexFromString($file->setActiveSheetIndex(1)->getHighestColumn())); $col++) {
									if($file->getActiveSheet()->getCell(''.$col.$i)->getCalculatedValue()!==NULL){	
										if($col=="M"){
										 	$id="instalacion";
										}  else {
										 	$id=strtolower($file->getActiveSheet()->getCell(''.$col.'1')->getCalculatedValue());
										}
										if(PHPExcel_Shared_Date::isDateTime($file->getActiveSheet()->getCell(''.$col.$i))) {
										 	$timestamp = PHPExcel_Shared_Date::ExcelToPHP($file->getActiveSheet()->getCell(''.$col.$i)->getValue());
										 	$data[$id]= date("Ymd",$timestamp);
										} else {
											$data[$id]=$file->getActiveSheet()->getCell(''.$col.$i)->getCalculatedValue();
										}
									} else {
										$m=1;
										break;
									}
								}
								if(count($data)>0){
									$this->clienteinfo->clientesinfoadd($data);
								}										 		
								if($m==1){
									break;
								}
							}									 	
						}	
						$add=$this->clienteinfo->validarmasterplanedit();
						if($add["respuesta"]==1){
							$mensaje="Carga de Master exitosa.";
							$carpeta="archivos/fotos/".base64_decode($_SESSION["accion"]);
							if (!file_exists($carpeta)) {
								mkdir($carpeta, 0777, true);
							}
						} else {
							$mensaje=$add["mensaje"];
						}
					} else {
						$mensaje=$h1.$h2;
					}
					unlink("archivos/master/".$contar.$excel);
				}
			} else {
				$mensaje="La extensión del archivo no es válida, las extensiones permitidas son .xls y .xlsx";
				unlink("archivos/master/".$contar.$excel);
			}
		} else {
			$mensaje="No existe un archivo adjunto, por favor intenta nuevamente";
		}
		return $mensaje;
	}
	

	function limpiaEspacio($var){
  		$nuevo3 = preg_replace("/[' ']/", "",$var);
  		return $nuevo3;
 	}


 	function checkrow($file,$sheet,$row){
		$cont=0;
		$file->setActiveSheetIndex($sheet);	
		for ($col='A'; $col != PHPExcel_Cell::stringFromColumnIndex(PHPExcel_Cell::columnIndexFromString($file->setActiveSheetIndex($sheet)->getHighestColumn())); $col++){
			if($file->getActiveSheet()->getCell(''.$col.$row)->getCalculatedValue()===NULL){
				$cont+=1;
			}
		}
		if($cont==PHPExcel_Cell::columnIndexFromString($file->setActiveSheetIndex($sheet)->getHighestColumn())){
			return true;
		} else {
			return false;
		}
	}



}
?>