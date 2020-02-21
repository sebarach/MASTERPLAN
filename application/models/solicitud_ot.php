<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class solicitud_ot extends CI_model {
    function __construct()
    {
        parent::__construct();
    }
    function solicitudes($id_empresa,$id_campana,$id_usuario,$id_estado,$region,$ciudad,$cadena,$id_cliente,$mes,$anio,$page){
        $res=$this->db->query("execute [solicitudeslist] ".$id_empresa.",".$id_campana.",".$id_usuario.",".$id_estado.",".$region.",'".$ciudad."','".$cadena."','".$id_cliente."',".$mes.",".$anio.",".$page);
        return $res->result_array();
    }
    function clientes($id_campana,$cadena){
        $res=$this->db->query("select id_cliente from clientes where id_campana=".$id_campana." and cadena='".str_replace("_", " ", $cadena)."'");
        return $res->result_array();
    }
    function ingresar_ot($id_empresa,$id_cliente,$asunto,$comentario,$id_campana,$solicitante,$tipos,$nombrelocal,$direccionlocal,$archivo,$nombres,$region,$ciudad,$cadena){
        $res=$this->db->query("execute [ingresar_ot] '".$id_empresa."','".$id_cliente."','".$asunto."','".$comentario."',".$id_campana.",".$solicitante.",'".$tipos."','".$nombrelocal."','".$direccionlocal."','".$archivo."','".$nombres."',".$region.",'".$ciudad."','".$cadena."'");
        return $res->row_array();
    }
    function solicitud($id_solicitud){
        $res=$this->db->query("execute [solicitud] ".$id_solicitud);
        return $res->result_array();
    }
    function respuesta_solicitante($id_solicitud,$evaluacion,$id_usuario,$respuesta,$archivo,$accion){
        $res=$this->db->query("execute [resp_solicitante] ".$id_solicitud.",".$evaluacion.",".$id_usuario.",'".$respuesta."','".$archivo."',".$accion);
        return $res->row_array();
    }
    function respuesta_archivo($id_solicitud,$usuario,$archivo,$nombre,$accion,$i){
        $res=$this->db->query("execute [resp_archivo] ".$id_solicitud.",".$usuario.",'".$archivo."','".$nombre."',".$accion.",".$i."");
        return $res->row_array();
    }
    function respuesta_coordinador($id_solicitud,$estado,$fechaestimada,$usuario,$respuesta){
        $res=$this->db->query("execute [resp_coordinador] ".$id_solicitud.",".$estado.",".$fechaestimada.",".$usuario.",".$respuesta."");
        // echo "execute [resp_coordinador] ".$id_solicitud.",".$estado.",'".$fechaestimada."',".$usuario.",'".$respuesta."'";
        return $res->row_array();
    }
    function estados($id_solicitud){
        $res=$this->db->query("execute [estadoslist] ".$id_solicitud);
        return $res->result_array();
    }
    function archivoscoordinador($id_solicitud,$id_usuario){
        $res=$this->db->query("execute [archivoscoordinador] ".$id_solicitud.",".$id_usuario);
        return $res->result_array();
    }
    function solicitudes_estado($id_empresa,$id_usuario,$mes,$anio){
        $res=$this->db->query("execute [solicitudes_estado] ".$id_empresa.",".$id_usuario.",".$mes.",".$anio);
        return $res->result_array();
    }
    function solicitudes_semaforo($id_empresa,$id_usuario,$mes,$anio){
        $res=$this->db->query("execute [solicitudes_semaforo] ".$id_empresa.",".$id_usuario.",".$mes.",".$anio);
        return $res->result_array();
    }
    function cadenas($id_empresa,$id_campana,$region,$ciudad,$sucursal,$fechaprog,$fechareal,$cadena,$canal,$imp,$cli){
        $res=$this->db->query("execute [campana_cadenas] ".$id_empresa.",".$id_campana.",".$region.",'".$ciudad."','".$sucursal."','".$fechaprog."','".$fechareal."','".$cadena."','".$canal."','".$imp."','".$cli."'");
        return $res->result_array();
    }
    function cadenassolicitud($id_empresa,$id_campana,$region,$ciudad,$sucursal,$fechaprog,$fechareal,$cadena,$canal,$imp,$cli){
        $res=$this->db->query("execute [campana_cadenassolicitud] ".$id_empresa.",".$id_campana.",".$region.",'".$ciudad."','".$sucursal."','".$fechaprog."','".$fechareal."','".$cadena."','".$canal."','".$imp."','".$cli."'");
        return $res->result_array();
    }
    function regiones($id_empresa,$id_campana,$region,$ciudad,$sucursal,$fechaprog,$fechareal,$cadena,$canal,$imp,$cli){
         $res=$this->db->query("execute listar_regiones ".$id_empresa.",".$id_campana.",".$region.",'".$ciudad."','".$sucursal."','".$fechaprog."','".$fechareal."','".$cadena."','".$canal."','".$imp."','".$cli."'");
         return $res->result_array();
    }
    function comunas($id_empresa,$id_campana,$region,$ciudad,$sucursal,$fechaprog,$fechareal,$cadena,$canal,$imp,$cli){
        $res=$this->db->query("execute listar_ciudades ".$id_empresa.",".$id_campana.",".$region.",'".$ciudad."','".$sucursal."','".$fechaprog."','".$fechareal."','".$cadena."','".$canal."','".$imp."','".$cli."'");
         return $res->result_array();
    }
    function locales($id_empresa,$id_campana,$region,$ciudad,$sucursal,$fechaprog,$fechareal,$cadena,$canal,$imp,$cli){
        $res=$this->db->query("execute listar_locales ".$id_empresa.",".$id_campana.",".$region.",'".$ciudad."','".$sucursal."','".$fechaprog."','".$fechareal."','".$cadena."','".$canal."','".$imp."','".$cli."'");
         return $res->result_array();
    }
    function excel($id_empresa,$fechainicio,$fechafin,$usuario){
        $res=$this->db->query("execute [solicitudes_excel] ".$id_empresa.",'".$fechainicio."', '".$fechafin."',".$usuario);
        $arrayexcel=array( 0 => $res->list_fields(), 1 => $res->result_array());
      return $arrayexcel;
    }
    function addmensaje($id_solicitud,$id_usuario,$mensaje){
        $res=$this->db->query("execute [mensajesadd] ".$id_solicitud.",".$id_usuario.",'".$mensaje."'");
        return $res->result_array();
    }
    function mensajes($id_solicitud){
         $res=$this->db->query("execute [mensajeslist] ".$id_solicitud);
        return $res->result_array();
    }
    function correo($id_usuario){
        $res=$this->db->query("execute [correo] ".$id_usuario);
        return $res->row_array();
    }
    function coordinadores(){
        $res=$this->db->query("execute [coordinadores] ");
        return $res->result_array();
    }
    function anios($id_empresa){
        $res=$this->db->query("execute [filtros_anio]".$id_empresa);
        return $res->result_array();
    }
    function meses($id_empresa,$anio){
        $res=$this->db->query("execute [filtros_mes] ".$id_empresa.",".$anio);
        return $res->result_array();
    }
    function campanas($id_empresa,$anio,$mes_numero){
        $res=$this->db->query("execute [filtros_campana]".$id_empresa.",".$anio.",'".$mes_numero."'");
        return $res->result_array();
    }
    function ciudades($id_campana,$id_region){
        $res=$this->db->query("execute [filtros_ciudad]".$id_campana.",".$id_region);
        return $res->result_array();
    }
    function archivosadjuntos($id_solicitud,$id_usuario,$fecha_registro,$archivo){
        $res=$this->db->query("execute [archivosadd]".$id_solicitud.",".$id_usuario.",".$fecha_registro.",".$archivo);
        return $res->result_array();
    }

    function estado($id){
        $res=$this->db->query("select estado from estados where id_estado=".$id);
        return $res->row_array();
    }

    function solicitudmensaje($id,$usuario){
        $res=$this->db->query("execute [solicitudmensaje] ".$id_solicitud.",".$usuario);
        return $res->row_array();
    }

    function solicitudestados($id_solicitud){
        $res=$this->db->query("execute [solicitud_cambios_estados] ".$id_solicitud);
        return $res->result_array();
    }
}
?>