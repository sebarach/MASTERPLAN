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

    function campanasinterno($usuario){
      $res=$this->db->query("execute [campanasinternolist] ".$usuario);
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
      $res=$this->db->query("execute [campana_clientesinforme] ".$id_campana.",".$id_region.",'".$id_ciudad."','".$imp."','".$id_cliente."','".$fecha_programada."','".$fecha_real."',".$motivo."");
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

    function campanainformegaleria($id_campana,$inicio,$fin,$page,$region,$ciudad,$id_cliente){
      $res=$this->db->query("execute [campana_informegaleria] ".$id_campana.",".$inicio.",".$fin.",".$page.",".$region.",'".$ciudad."','".$id_cliente."'");
      return $res->result_array();
    }

    function galeriafiltros($id_campana,$page,$reg,$ciu,$cad,$pdv,$can,$imp,$cli,$fep,$fei){
      $res=$this->db->query("execute [galeria_filtros] ".$id_campana.",".$page.",".$reg.",'".$ciu."','".$cad."','".$pdv."','".$can."','".$imp."','".$cli."','".$fep."','".$fei."'");
      return $res->result_array();
    }

    function materiales_excel($id_campana){
      $res=$this->db->query("execute [materiales_excel] ".$id_campana);
      return $res->result_array();
    }

    function campana_excel($id_campana){
      $res=$this->db->query("execute [campana_excel] ".$id_campana);
      $arrayexcel=array( 0 => $res->list_fields(), 1 => $res->result_array());
      return $arrayexcel;
    }

    function campana_excelpg($id_campana){
      $res=$this->db->query("execute [campana_excelpg] ".$id_campana);
      $arrayexcel=array( 0 => $res->list_fields(), 1 => $res->result_array());
      return $arrayexcel;
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

    function campana_cadenas($id_empresa,$id_campana,$region,$ciudad,$sucursal,$fechaprog,$fechareal,$cadena,$canal,$imp,$cli){
        $res=$this->db->query("execute [campana_cadenas] ".$id_empresa.",".$id_campana.",".$region.",'".$ciudad."','".$sucursal."','".$fechaprog."','".$fechareal."','".$cadena."','".$canal."','".$imp."','".$cli."'");
      return $res->result_array();
    }

    function campanafiltro($id_campana,$region,$ciudad,$id_cliente){
      $res=$this->db->query("execute [campana_infogaleria] ".$id_campana.",".$region.",'".$ciudad."','".$id_cliente."'");
      return $res->result_array();
    }

    function campanafotos($id_campana,$cadena){
      $res=$this->db->query("execute [campana_cadenas_fotos] ".$id_campana.",'".$cadena."'");
      return $res->result_array();
    }

    function carpetas($id_campana,$id_usuario){
      $res=$this->db->query("execute [carpetaslist] ".$id_campana.",".$id_usuario);
      return $res->result_array();
    }

    function carpetasadd($carpeta,$id_usuario,$id_campana,$id_perfil){
      $res=$this->db->query("execute [carpetasadd] '".$carpeta."',".$id_usuario.",".$id_campana.",'".$id_perfil."'");
      return $res->row_array();
    }

    function carpeta($id_carpeta){
      $res=$this->db->query("execute [carpetas] ".$id_carpeta."");
      return $res->result_array();
    }

    function carpetasedit($carpeta,$id_perfil,$id_campana,$id){
      $res=$this->db->query("execute [carpetasedit] '".$carpeta."','".$id_perfil."',".$id_campana.",".$id);
      return $res->row_array();
    }

    function carpetasdelete($id){
      $res=$this->db->query("execute [carpetasdelete] ".$id);
      return $res->row_array();
    }

    function guardarDocumento($nombre,$tipo_doc,$id_carpeta,$id_usuario,$doc){
      $res=$this->db->query("execute [guardardoc] '".$nombre."','".$tipo_doc."',".$id_carpeta.",".$id_usuario.",'".$doc."'");
      return $res->row_array();
    }

    function listarDocumentos($carpeta){
      $res=$this->db->query("execute [documentoslist] ".$carpeta);
      return $res->result_array();
    }

    function documentosdelete($id){
      $res=$this->db->query("execute [documentosdelete] ".$id);
      return $res->row_array();
    }

    function documento($id){
      $res=$this->db->query("execute [documentos] ".$id."");
      return $res->row_array();
    }

    function editarDocumento($nombreDoc,$tipoDoc,$usuario,$doc,$id){
      $res=$this->db->query("execute [editardoc] '".$nombreDoc."','".$tipoDoc."',".$usuario.",'".$doc."',".$id);
      return $res->row_array();
    }

    function campanapdv($id_campana){
      $res=$this->db->query("execute [campana_pdv] ".$id_campana);
      return $res->result_array();
    }

    function campanafecha($id_campana,$region,$ciudad,$cadena,$id_cliente,$canal,$imp,$cliente,$fecha_programada,$fecha_real,$motivo){
      $res=$this->db->query("execute [campana_fecha] ".$id_campana.",".$region.",'".$ciudad."','".$cadena."','".$id_cliente."','".$canal."','".$imp."','".$cliente."','".$fecha_programada."','".$fecha_real."',".$motivo);
      return $res->result_array();
    }

    function campanalocales($id_campana,$region,$ciudad,$cadena,$id_cliente,$canal,$imp,$cliente,$fecha_programada,$fecha_real,$motivo,$page){
      $res=$this->db->query("execute [campana_informepdv] ".$id_campana.",".$region.",'".$ciudad."','".$cadena."','".$id_cliente."','".$canal."','".$imp."','".$cliente."','".$fecha_programada."','".$fecha_real."',".$motivo.",".$page);
      return $res->result_array();
    }

    function campanappt($id_campana){
      $res=$this->db->query("execute [galeriappt] ".$id_campana);
      return $res->result_array();
    }

    function ciudades($id_campana,$region){
      $res=$this->db->query("select ciudad from clientes with (nolock) where id_campana=".$id_campana." and region=".$region." group by ciudad");
      return $res->result_array();
    }

    function clientes($id_campana,$region){
      $res=$this->db->query("select id_cliente from clientes with (nolock) where id_campana=".$id_campana." and region=".$region);
      return $res->result_array();
    }

    function locales($id_empresa,$id_campana,$region,$ciudad,$sucursal,$fechaprog,$fechareal,$cadena,$canal,$imp,$cli){
      $res=$this->db->query("execute listar_locales ".$id_empresa.",".$id_campana.",".$region.",'".$ciudad."','".$sucursal."','".$fechaprog."','".$fechareal."','".$cadena."','".$canal."','".$imp."','".$cli."'");
         return $res->result_array();
    }

    function canales($id_empresa,$id_campana,$region,$ciudad,$sucursal,$fechaprog,$fechareal,$cadena,$canal,$imp,$cli){
         $res=$this->db->query("execute listar_canales ".$id_empresa.",".$id_campana.",".$region.",'".$ciudad."','".$sucursal."','".$fechaprog."','".$fechareal."','".$cadena."','".$canal."','".$imp."','".$cli."'");
         return $res->result_array();
    }

    function implementador($id_empresa,$id_campana,$region,$ciudad,$sucursal,$fechaprog,$fechareal,$cadena,$canal,$imp,$cli){
         $res=$this->db->query("execute listar_implementador ".$id_empresa.",".$id_campana.",".$region.",'".$ciudad."','".$sucursal."','".$fechaprog."','".$fechareal."','".$cadena."','".$canal."','".$imp."','".$cli."'");
         return $res->result_array();
    }

    function clientescam($id_empresa,$id_campana,$region,$ciudad,$sucursal,$fechaprog,$fechareal,$cadena,$canal,$imp,$cli){
         $res=$this->db->query("execute listar_clientescam ".$id_empresa.",".$id_campana.",".$region.",'".$ciudad."','".$sucursal."','".$fechaprog."','".$fechareal."','".$cadena."','".$canal."','".$imp."','".$cli."'");
         return $res->result_array();
    }

    function nombreregion($region){
      $res=$this->db->query("select region from regiones where id_region=".$region);
      return $res->row_array();
    }
}

?>