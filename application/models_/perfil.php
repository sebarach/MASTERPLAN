<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class perfil extends CI_model {
	function __construct()
    {
        parent::__construct();
    }

    function perfiles(){
    	$res=$this->db->query("execute [perfileslist] ");
   		return $res->result_array();
    }


    function perfil($id){
    	$res=$this->db->query("execute [perfil] ".$id);
   		return $res->result_array();
    }

    function perfilesadd($perfil){
    	$res=$this->db->query("execute [perfilesadd] '".$perfil."'");
   		return $res->row_array();	
    }

    function perfilesedit($perfil,$id){
    	$res=$this->db->query("execute [perfilesedit] '".$perfil."', ".$id);
   		return $res->num_rows();	
    }

    function permisosadd($permisos,$perfil){
    	$insert=array();
    	for ($i=0; $i < count($permisos[0]) ; $i++) { 
    		$res=$this->db->query("execute [permisosadd] '".$perfil."', '".$permisos[0][$i]."', ".$permisos[1][$i]);
    		$add=$res->row_array();
   			if(isset($add)){
   				$insert[$i]=$add["mensaje"];
   			} else {
   				$insert[$i]=null;
   			}
    	}
    	return $insert;
    }

}

?>