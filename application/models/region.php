<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class region extends CI_model {
	function __construct()
    {
        parent::__construct();
    }

    function regiones(){
    	$res=$this->db->query("execute [regioneslist] ");
   		return $res->result_array();
    }


    function regionadd($region,$pais,$orden){
    	$res=$this->db->query("execute [regionesadd] '".$region."', ".$pais." , ".$orden);
   		return $res->row_array();
    }

    function region($id_region){
    	$res=$this->db->query("execute [region] ".$id_region);
   		return $res->row_array();
    }

    function regionedit($region,$pais,$orden,$id_region){
    	$res=$this->db->query("execute [regionesedit] '".$region."', ".$pais." , ".$orden.",".$id_region);
   		return $res->row_array();
    }

    function comunas($id){
      $res=$this->db->query("execute [comunaslist] ".$id);
      return $res->row_array();
    }

}

?>