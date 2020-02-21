<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class grupo_motivos extends CI_model {
	function __construct()
    {
        parent::__construct();
    }


    function gruposmotivoslist(){
    	$res=$this->db->query("execute [gruposmotivoslist] ");
   		return $res->result_array();
    }

    function motivosdondelist(){
    	$res=$this->db->query("execute [motivosdondelist] ");
   		return $res->result_array();
    }

    function gruposmotivosadd($grupomotivo){
        $res=$this->db->query("execute [gruposmotivosadd] '".$grupomotivo."'");
        return $res->row_array();
    }

    function grupomotivos($id){
        $res=$this->db->query("execute [grupomotivos] ".$id);
        return $res->row_array();
    }

    function gruposmotivosedit($grupomotivos,$id){
        $res=$this->db->query("execute [gruposmotivosedit]  ".$id.",'".$grupomotivos."'");
        return $res->row_array();
    }

    function motivoslist($id){
        $res=$this->db->query("execute [motivoslist] ".$id);
        return $res->result_array();
    }

    function motivosadd($data){
        if(isset($data["cod_motivo"])){
            $res=$this->db->query("execute [motivosadd] '".$data["motivo"]."','".$data["alias"]."',".$data["implementa"].",".$data["exitoso"].",".$data["cliente"].",".$data["material"].",".$data["activo"].",".$data["cod_motivo"].",'".$data["responsable"]."',".$data["id_grupo_motivos"]." ");
            return $res->row_array();
        } else {
            $res=$this->db->query("execute [motivosadd] '".$data["motivo"]."','".$data["alias"]."',".$data["implementa"].",".$data["exitoso"].",".$data["cliente"].",".$data["material"].",".$data["activo"].",null,null,".$data["id_grupo_motivos"]." ");
            return $res->row_array();
        }
    }

    function motivosedit($data){
        if(isset($data["cod_motivo"])){
            $res=$this->db->query("execute [motivosedit] '".$data["motivo"]."','".$data["alias"]."',".$data["implementa"].",".$data["exitoso"].",".$data["cliente"].",".$data["material"].",".$data["activo"].",".$data["cod_motivo"].",'".$data["responsable"]."',".$data["id_grupo_motivos"].",".$data["id"]);
            return $res->row_array();
        } else {
            $res=$this->db->query("execute [motivosedit] '".$data["motivo"]."','".$data["alias"]."',".$data["implementa"].",".$data["exitoso"].",".$data["cliente"].",".$data["material"].",".$data["activo"].",null,null,".$data["id_grupo_motivos"].",".$data["id"]);
            return $res->row_array();
        }
    }

    function motivos($id){
        $res=$this->db->query("execute [motivo] ".$id);
        return $res->row_array();
    }

}

?>