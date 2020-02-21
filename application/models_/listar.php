<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class listar extends CI_model {
	function __construct()
    {
        parent::__construct();
    }

   	function login($usuario,$clave){
   		$res=$this->db->query("execute [LogIn_Usuario] '".$usuario."', '".$clave."'");
   		return $res->result_array();
   	}

   	function permisos($id_usuario,$tablename){
   		$res=$this->db->query("execute [permisos] ".$id_usuario.", '".$tablename."'");
   		return $res->row_array();
   	}

    function paises(){
      $res=$this->db->query("execute [paiseslist] ");
      return $res->result_array();
    }

    function anios($id_usuario,$id_empresa){
      $res=$this->db->query("execute [campanas_anios] ".$id_usuario.",".$id_empresa);
      return $res->result_array();
    }

    function regiones($id_campana){
      $res=$this->db->query("execute [regionescampanaslist] ".$id_campana);
      return $res->result_array();
    }

}

?>