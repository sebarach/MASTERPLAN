<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class accion extends CI_model {
	function __construct()
    {
        parent::__construct();
    }


    function acciones($id){
    	$res=$this->db->query("execute [accioneslist] ".$id);
   		return $res->result_array();
    }


    function accionesadd($campana,$accion,$activo,$grupo,$motivo,$materiales,$digita,$usaetiqueta1,$etiqueta1,$usaetiqueta2,$etiqueta2,$usaetiqueta3,$etiqueta3,$usaetiqueta4,$etiqueta4){
    	$res=$this->db->query("execute [accionesadd] ".$campana.",'".$accion."',".$activo.",".$grupo.",".$motivo.",".$materiales.",".$digita.",".$usaetiqueta1.",'".$etiqueta1."',".$usaetiqueta2.",'".$etiqueta2."',".$usaetiqueta3.",'".$etiqueta3."',".$usaetiqueta4.",'".$etiqueta4."'");
   		return $res->row_array();
    }

    function accion($id){
    	$res=$this->db->query("execute [accion] ".$id);
   		return $res->row_array();
    }

    function accionesedit($id,$accion,$activo,$grupo,$motivo,$materiales,$digita,$usaetiqueta1,$etiqueta1,$usaetiqueta2,$etiqueta2,$usaetiqueta3,$etiqueta3,$usaetiqueta4,$etiqueta4){
    	$res=$this->db->query("execute [accionesedit] ".$id.",'".$accion."',".$activo.",".$grupo.",".$motivo.",".$materiales.",".$digita.",".$usaetiqueta1.",'".$etiqueta1."',".$usaetiqueta2.",'".$etiqueta2."',".$usaetiqueta3.",'".$etiqueta3."',".$usaetiqueta4.",'".$etiqueta4."' ");
    	return $res->num_rows();
    }

}

?>