<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class campana extends CI_model {
	function __construct()
    {
        parent::__construct();
    }

    function campanas($id,$anio){
    	$res=$this->db->query("execute [campanaslist] ".$id.",".$anio);
   		return $res->result_array();
    }

    function campanasadd($campana,$id_empresa,$anio,$activo,$id_pais,$grupo,$motivo,$materiales,$digita){
    	$res=$this->db->query("execute [campanasadd] '".$campana."', ".$id_empresa.", '".$anio."', ".$activo.",".$id_pais.",".$grupo.",".$motivo.",".$materiales.",".$digita);
   		return $res->row_array();
    }

    function campana($id){
    	$res=$this->db->query("execute [campana] ".$id);
   		return $res->row_array();
    }

    function campanamax($empresa){
    	$res=$this->db->query("execute [campanamax] ".$empresa);
   		return $res->row_array();
    }

    function campanasedit($id_campana,$campana,$anio,$activo,$powerbi,$id_pais,$grupo,$motivo,$materiales,$digita){
    	$res=$this->db->query("execute [campanasedit]  ".$id_campana.",'".$campana."', '".$anio."', ".$activo.", '".$powerbi."', ".$id_pais.",".$grupo.",".$motivo.",".$materiales.",".$digita);
   		return $res->num_rows();
    }

    function campanaclientes($id_campana,$id_region,$id_ciudad,$imp,$id_cliente,$fecha_programada,$fecha_real,$motivo){
      $res=$this->db->query("execute [campana_clientesinforme] ".$id_campana.",'".$id_region."','".$id_ciudad."','".$imp."','".$id_cliente."','".$fecha_programada."','".$fecha_real."','".$motivo."'");
      return $res->result_array();
    }

    function campanaclientesdetalle($id_unico){
      $res=$this->db->query("execute [campana_clientesinformedetalle] ".$id_unico);
      return $res->result_array();
    }

    function campanaclientesfotos($id_unico){
      $res=$this->db->query("execute campana_clientesinformefotos ".$id_unico);
      return $res->result_array();
    }

    function campanainfomaterial($id_campana,$id_region,$id_ciudad,$id_cliente,$fecha_programada,$fecha_real){
      $res=$this->db->query("execute [campana_infomaterial] ".$id_campana.",'".$id_region."','".$id_ciudad."','".$id_cliente."','".$fecha_programada."','".$fecha_real."'");
      return $res->result_array();
    }

    function campanaclientesinfo($id_unico){
      $res=$this->db->query("execute [campana_clientesinfo] ".$id_unico);
      return $res->row_array();
    } 

    function campanasucursales($id_empresa){
      $res=$this->db->query("execute [campana_sucursales_fecha] ".$id_empresa);
      return $res->result_array();
    }

    function campanainformegaleria($id_campana,$inicio,$fin,$page){
      $res=$this->db->query("execute [campana_informegaleria] ".$id_campana.",".$inicio.",".$fin.",".$page);
      return $res->result_array();
    }

    function materiales_excel($id_campana){
      $res=$this->db->query("execute [materiales_excel] ".$id_campana);
      return $res->result_array();
    }

    function campana_excel($id_campana){
      $res=$this->db->query("execute [campana_excel] ".$id_campana);
      return $res->result_array();
    }

    function campana_materiales_excel($id_campana){
      $res=$this->db->query("execute [campana_materiales_excel] ".$id_campana);
      return $res->result_array();
    }

    function anioCampanas($id_empresa){
      $res=$this->db->query("execute [listar_anio_campana] ".$id_empresa);
      return $res->result_array();
    }

    function listarCampanaFiltrada($anio,$mes,$empresa){
      $res=$this->db->query("execute [listar_campana_filtrada] ".$anio.",".$mes.",".$empresa);
      return $res->result_array();
    }

    function listarmotivos($id_campana){
      $res=$this->db->query("execute [listar_motivos] ".$id_campana);
      return $res->result_array();
    }








    //ELIMINAR
  

  

    // function campanapdv($id_campana){
    //   $res=$this->db->query("execute [campana_pdv] ".$id_campana);
    //   return $res->row_array();
    // }

    // function campanaregionmaterial($id_campana){
    //   $res=$this->db->query("execute [campana_regionmaterial] ".$id_campana);
    //   return $res->result_array();
    // }

    // function campanaregionpdv($id_campana){
    //   $res=$this->db->query("execute [campana_regionpdv] ".$id_campana);
    //   return $res->result_array();
    // }

    // function campanaciudades($id_campana){
    //   $res=$this->db->query("execute [campana_ciudades] ".$id_campana);
    //   return $res->result_array();
    // }

    // function campanaregiones($id_campana){
    //   $res=$this->db->query("execute [campana_regiones] ".$id_campana);
    //   return $res->result_array();
    // }

    // function campanamotivos($id_campana){
    //   $res=$this->db->query("execute [campanas_motivos] ".$id_campana);
    //   return $res->result_array();
    // }

    // function campanainfomotivos($id_campana){
    //   $res=$this->db->query("execute [campana_infomotivos] ".$id_campana);
    //   return $res->result_array();
    // }

    // function campanaclienterep($id_campana){
    //   $res=$this->db->query("execute [campana_clienterep] ".$id_campana);
    //   return $res->result_array();
    // }


}

?>