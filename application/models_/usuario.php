<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class usuario extends CI_model {
	function __construct()
    {
        parent::__construct();
    }

    function usuarios($id){
    	$res=$this->db->query("execute [usuarioslist] ".$id);
   		return $res->result_array();
    }

  	function usuario($id){
   	 	$res=$this->db->query("execute [usuario] ".$id);
   		return $res->row_array();
    }

    function campanas($usuario){  
    	$res=$this->db->query("execute [campana_usuario] ".$usuario);
   		return $res->result_array();
    }

    function usuariosadd($usuario,$password,$id_perfil,$empresa,$activo){
    	$res=$this->db->query("execute [usuariosadd] '".$usuario."','".$password."',".$id_perfil.",".$empresa.",".$activo."");
   		return $res->row_array();
    }

    function usuariosedit($id,$usuario,$password,$id_perfil,$empresa,$activo){
    	$res=$this->db->query("execute [usuariosedit] ".$id.",'".$usuario."','".$password."',".$id_perfil.",".$empresa.",".$activo."");
   		return $res->num_rows();
    }

    function sucursales($campanas){
      $res=$this->db->query("execute [sucursales] '".$campanas."'");
      return $res->result_array();
    }

    function sucursal($id_usuario){
      $res=$this->db->query("execute [sucursal_usuario] ".$id_usuario."");
      return $res->result_array();
    }

    function usuarioscampanasadd($id_usuario,$campana){
      $res=$this->db->query("execute [campana_usuarioadd] ".$id_usuario.",".$campana);
      return $res->row_array();
    }

    function usuarioscampanasdelete($id_usuario){
      $res=$this->db->query("execute [campana_usuariodelete] ".$id_usuario);
      return $res->row_array();
    }

    function campanassucursal($id_usuario){
      $res=$this->db->query("execute [listar_campana_sucursal] ".$id_usuario);
      return $res->result_array();
    }

    function deletecampanauser($user,$campana){
      $res=$this->db->query("execute [usuario_campana_delete] ".$user.",".$campana);
      return $res->row_array();
    }

    function addcampanauser($user,$campana,$cliente){
      $res=$this->db->query("execute [usuario_campana_add] ".$user.",".$campana.",'".$cliente."'");
      return $res->row_array();
    }

}

?>