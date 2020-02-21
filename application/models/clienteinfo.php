<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class clienteinfo extends CI_model {
	function __construct()
    {
        parent::__construct();
    }

    function clientes($id_campana,$id_accion){
    	$res=$this->db->query("execute [clienteslist] ".$id_campana.",".$id_accion);
   		return $res->result_array();
    }

    function clientesinfo($id_campana,$id_accion){
    	$res=$this->db->query("execute [clientesinfolist] ".$id_campana.",".$id_accion);
   		return $res->result_array();
    }

    
    function clientesdelete($id_campana,$id_accion){
        $res=$this->db->query("execute [clientesdelete] ".$id_campana.",".$id_accion);
    }

    function clientesadd($data){
        if(isset($data["gerente_zonal"])){
            $res=$this->db->query("execute [clientesadd] ".$data["id_campana"].",".$data["id_accion"].",'".$data["id_cliente"]."','".$data["canal"]."','".$data["ejecutivo"]."','".$data["id_original"]."','".$data["nombre_fantasia"]."','".$data["direccion"]."','".$data["ciudad"]."',".$data["region"].",'".$data["nota_entrega"]."','".$data["fecha_programada"]."','".$data["cliente"]."','".$data["cadena"]."','".$data["jefe"]."','".$data["gerente_zonal"]."','".$data["agencia_repone"]."','".$data["agencia_implementa"]."','".$data["gestor"]."',".$data["instalacion"]);
            return $res->result_array();
        } else {
           $res=$this->db->query("execute [clientesadd] ".$data["id_campana"].",".$data["id_accion"].",'".$data["id_cliente"]."','".$data["canal"]."','".$data["ejecutivo"]."','".$data["id_original"]."','".$data["nombre_fantasia"]."','".$data["direccion"]."','".$data["ciudad"]."',".$data["region"].",'".$data["nota_entrega"]."','".$data["fecha_programada"]."','".$data["cliente"]."','".$data["cadena"]."','".$data["jefe"]."',null,null,null,null,null");
            return $res->result_array();
        }
    }

    function clientesinfoadd($data){
        if(isset($data["tipo_acuerdo"])){
            $res=$this->db->query("execute [clientesinfoadd] ".$data["id_campana"].",".$data["id_accion"].",'".$data["id_cliente"]."','".$data["medicion"]."',".$data["acuerdo"].",".$data["implementado"].",".$data["id_motivo"].",'".$data["fecha_programada"]."',null,'".$data["tipo_acuerdo"]."','".$data["fecha_inicio_acuerdo"]."','".$data["fecha_fin_acuerdo"]."',null");
            return $res->result_array();
        } else {
            $res=$this->db->query("execute [clientesinfoadd] ".$data["id_campana"].",".$data["id_accion"].",'".$data["id_cliente"]."','".$data["medicion"]."',".$data["acuerdo"].",".$data["implementado"].",".$data["id_motivo"].", '".$data["fecha_programada"]."',null,null,null,null,null");
            return $res->result_array();
        }
    }

    function validarmasterplanadd(){
        $res=$this->db->query("execute [validarmasterplanadd] ");
        return $res->row_array();
    }

    function validarmasterplanedit(){
        $res=$this->db->query("execute [validarmasterplanedit] ");
        return $res->row_array();
    }

    function clientespdvdelete($id_unico){
        $res=$this->db->query("execute [clientespdvdelete] ".$id_unico);
        return $res->row_array();
    }

    function clientespdvadd($data){
        if(isset($data["gerente_zonal"])){
            $res=$this->db->query("execute [clientespdvadd] ".$data["id_campana"].",".$data["id_accion"].",'".$data["id_cliente"]."','".$data["canal"]."','".$data["ejecutivo"]."','".$data["id_original"]."','".$data["nombre_fantasia"]."','".$data["direccion"]."','".$data["ciudad"]."',".$data["region"].",'".$data["nota_entrega"]."','".$data["fecha_programada"]."','".$data["cliente"]."','".$data["cadena"]."','".$data["jefe"]."','".$data["gerente_zonal"]."','".$data["agencia_repone"]."','".$data["agencia_implementa"]."','".$data["gestor"]."',".$data["instalacion"]);
            return $res->row_array();
        } else {
           $res=$this->db->query("execute [clientespdvadd] ".$data["id_campana"].",".$data["id_accion"].",'".$data["id_cliente"]."','".$data["canal"]."','".$data["ejecutivo"]."','".$data["id_original"]."','".$data["nombre_fantasia"]."','".$data["direccion"]."','".$data["ciudad"]."',".$data["region"].",'".$data["nota_entrega"]."','".$data["fecha_programada"]."','".$data["cliente"]."','".$data["cadena"]."','".$data["jefe"]."',null,null,null,null,null");
            return $res->row_array();
        }
    }

    function clientespdvedit($data){
        if(isset($data["gerente_zonal"])){
            $res=$this->db->query("execute [clientespdvedit] ".$data["id_unico"].",".$data["id_campana"].",".$data["id_accion"].",'".$data["id_cliente"]."','".$data["canal"]."','".$data["ejecutivo"]."','".$data["id_original"]."','".$data["nombre_fantasia"]."','".$data["direccion"]."','".$data["ciudad"]."',".$data["region"].",'".$data["nota_entrega"]."','".$data["fecha_programada"]."','".$data["cliente"]."','".$data["cadena"]."','".$data["jefe"]."','".$data["gerente_zonal"]."','".$data["agencia_repone"]."','".$data["agencia_implementa"]."','".$data["gestor"]."',".$data["instalacion"]);
            return $res->row_array();
        } else {
           $res=$this->db->query("execute [clientespdvedit] ".$data["id_unico"].",".$data["id_campana"].",".$data["id_accion"].",'".$data["id_cliente"]."','".$data["canal"]."','".$data["ejecutivo"]."','".$data["id_original"]."','".$data["nombre_fantasia"]."','".$data["direccion"]."','".$data["ciudad"]."',".$data["region"].",'".$data["nota_entrega"]."','".$data["fecha_programada"]."','".$data["cliente"]."','".$data["cadena"]."','".$data["jefe"]."',null,null,null,null,null");
            return $res->row_array();
        }
    }

     function clientesinfomatdelete($id_info){
        $res=$this->db->query("execute [clientesinfomatdelete] ".$id_info);
        return $res->row_array();
    }

    function clientesinfomatadd($data){
        if(isset($data["clasificacion"])){
            $res=$this->db->query("execute [clientesinfomatadd] ".$data["id_campana"].",".$data["id_accion"].",'".$data["id_cliente"]."','".$data["medicion"]."',".$data["acuerdo"].",".$data["implementado"].",".$data["id_motivo"].",'".$data["fecha_programada"]."','".$data["clasificacion"]."','".$data["tipo_acuerdo"]."','".$data["fecha_inicio_acuerdo"]."','".$data["fecha_fin_acuerdo"]."',0");
            return $res->result_array();
        } else {
            $res=$this->db->query("execute [clientesinfomatadd] ".$data["id_campana"].",".$data["id_accion"].",'".$data["id_cliente"]."','".$data["medicion"]."',".$data["acuerdo"].",".$data["implementado"].",".$data["id_motivo"].", '".$data["fecha_programada"]."',null,null,null,null,null");
            return $res->result_array();
        }
    }

    function clientesinfomatedit($data){
        if(isset($data["tipo_acuerdo"])){
            $res=$this->db->query("execute [clientesinfomatedit] ".$data["id_info"].",".$data["id_campana"].",".$data["id_accion"].",'".$data["id_cliente"]."','".$data["medicion"]."',".$data["acuerdo"].",".$data["implementado"].",".$data["id_motivo"].",'".$data["fecha_programada"]."','0','".$data["tipo_acuerdo"]."','".$data["fecha_inicio_acuerdo"]."','".$data["fecha_fin_acuerdo"]."',0");
            return $res->row_array();
        } else {
            $res=$this->db->query("execute [clientesinfomatedit] ".$data["id_info"].",".$data["id_campana"].",".$data["id_accion"].",'".$data["id_cliente"]."','".$data["medicion"]."',".$data["acuerdo"].",".$data["implementado"].",".$data["id_motivo"].", '".$data["fecha_programada"]."',null,null,null,null,null");
            return $res->row_array();
        }
    }


}

?>
