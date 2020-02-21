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

   	function empresa($id){
   		$res=$this->db->query("execute [empresa] ".$id);
   		return $res->row_array();
   	}

   	function empresasadd($empresa,$imagen_logo,$imagen_fondo,$color_1,$color_2,$color_3){
   		$res=$this->db->query("execute [empresasadd] '".$empresa."','".$imagen_logo."','".$imagen_fondo."','".$color_1."','".$color_2."','".$color_3."'");
   		return $res->row_array();
   	}

   	function empresasedit($empresa,$imagen_logo,$imagen_fondo,$color_1,$color_2,$color_3,$id){
   		$res=$this->db->query("execute [empresasedit] '".$empresa."','".$imagen_logo."','".$imagen_fondo."','".$color_1."','".$color_2."','".$color_3."',".$id);
   		return $res->num_rows();
   	}


}

?>