<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class empresa extends CI_model {
	function __construct()
    {
        parent::__construct();
    }

   	function empresas(){
   		$res=$this->db->query("execute [empresaslist]");
   		return $res->result_array();
   	}

    function empresasinterno($id_usuario){
      $res=$this->db->query("execute [empresasinternolist] ".$id_usuario);
      return $res->result_array();
    }

   	function empresa($id){
   		$res=$this->db->query("execute [empresa] ".$id);
   		return $res->result_array();
   	}

   	function empresasadd($empresa,$activa_color,$activa_fondo,$activa_logo,$imagen_logo,$imagen_fondo,$color_1,$color_2,$color_3,$filtros){
   		$res=$this->db->query("execute [empresasadd] '".$empresa."',".$activa_color.",".$activa_fondo.",".$activa_logo.",'".$imagen_logo."','".$imagen_fondo."','".$color_1."','".$color_2."','".$color_3."','".$filtros."'");
   		return $res->row_array();
   	}

   	function empresasedit($empresa,$activa_color,$activa_fondo,$activa_logo,$imagen_logo,$imagen_fondo,$color_1,$color_2,$color_3,$filtros,$id){
   		$res=$this->db->query("execute [empresasedit] '".$empresa."',".$activa_color.",".$activa_fondo.",".$activa_logo.",'".$imagen_logo."','".$imagen_fondo."','".$color_1."','".$color_2."','".$color_3."','".$filtros."',".$id);
   		return $res->num_rows();
   	}


    function listarempresas(){
      $res=$this->db->query("select id_empresa, empresa from empresas");
      return $res->result_array();
    }


}

?>