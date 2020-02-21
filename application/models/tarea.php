<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tarea extends CI_model {
	function __construct()
    {
        parent::__construct();
    }

    function tareas($id_empresa){
    	$res=$this->db->query("execute [tareaslist] ".$id_empresa);
   		return $res->result_array();
    }

    function tareasadd($tarea,$comercial,$activo,$id_empresa){
    	$res=$this->db->query("execute [tareasadd] '".$tarea."',".$comercial.",".$activo.",".$id_empresa);
   		return $res->row_array();
    }

    function tarea($id_tarea){
    	$res=$this->db->query("execute [tarea] ".$id_tarea);
   		return $res->row_array();
    }


    function tareasedit($tarea,$comercial,$activo,$id){
    	$res=$this->db->query("execute [tareasedit] '".$tarea."',".$comercial.",".$activo.",".$id);
   		return $res->row_array();
    }

    function empresas($id_empresa){
    	$res=$this->db->query("execute [empresastarea] ".$id_empresa);
   		return $res->result_array();
    }
}
?>