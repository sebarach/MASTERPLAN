<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cliente extends CI_model {
	function __construct()
    {
        parent::__construct();
    }
  
   	
	function campanas($usuario){
   		$res=$this->db->query("execute [Listar_Campanas_Activas] ".$usuario."");
   		return $res->result_array();
   }

	function accion($campana){
   		$res=$this->db->query("execute [Listar_Accion_Campana] ".$campana." ");
   		return $res->result_array();
   	}
	
	function cliente_buscar($accion,$campana,$usuario){
   		$res=$this->db->query("execute [Listar_cliente_buscar] ".$accion.",".$campana.",".$usuario);
   		return $res->result_array();
   	}
    
	function cliente_detalle($unico){
   		$res=$this->db->query("execute [Listar_cliente_buscar_detalle] ".$unico);
   		return $res->row_array();
   	}
	
	function motivos_cliente($unico){
   		$res=$this->db->query("execute [Listar_Motivos_Cliente] ".$unico);
   		return $res->result_array();
   	}

   function motivos_materiales($unico){
         $res=$this->db->query("execute [Listar_Motivos_material] ".$unico);
         return $res->result_array();
      }
	
	function cliente_implementacion_insertar($unico,$fecha_real,$motivo,$Implementador,$ImplementadorRut,$NombreRecepcion,$RutRecepcion,$CargoRecepcion,$comentario,$id_usuario){
   		//$query = "[Guardar_Cliente_Implementacion] ".$unico.",'".$fecha_real."',".$motivo.",'".$Implementador."','".$ImplementadorRut."','".$foto1."','".$foto2."','".$foto3."','".$foto4."','".$foto5."','".$foto6."','".$foto7."','".$foto8."','".$NombreRecepcion."','".$RutRecepcion."','".$CargoRecepcion."'";
		$res=$this->db->query("[Guardar_Cliente_Implementacion] ".$unico.",'".$fecha_real."',".$motivo.",'".$Implementador."','".$ImplementadorRut."','".$NombreRecepcion."','".$RutRecepcion."','".$CargoRecepcion."','".$comentario."', ".$id_usuario);
		$resultado = $res->row_array();
		return $resultado;
   	}

    function cliente_unico($unico){
       $res=$this->db->query("select ID_Cliente from Clientes with(nolock) where id_unico = ".$unico);
       return $res->row_array();
    }

    function listar_cliente_producto($unico){
       $res=$this->db->query(" Listar_Cliente_Productos ".$unico);
       $resultado = $res->result_array();
       return $resultado;
    }
    function listar_campana($unico){
       $res=$this->db->query("Listar_Campana ".$unico);
       $resultado = $res->row_array();
       return $resultado;
    }

   function Guardar_cliente_foto($id_campana,$id_accion,$id_cliente,$nombre,$foto){
      $res=$this->db->query("execute Guardar_Cliente_Foto ".$id_campana.",".$id_accion.",'".$id_cliente."','".$nombre."','".$foto."'");
      $resultado = $res->row_array();
      return $resultado;
   }

   function Editar_cliente_foto($id_campana,$id_accion,$id_cliente,$nombre,$foto,$id){
      $res=$this->db->query("execute Editar_Cliente_Foto ".$id_campana.",".$id_accion.",'".$id_cliente."','".$nombre."','".$foto."',".$id);
      $resultado = $res->row_array();
      return $resultado;
   }

   function Eliminar_cliente_foto($id){
      $res=$this->db->query("execute Eliminar_Cliente_Foto ".$id);
      $resultado = $res->result_array();
      return $resultado;
   }

   function fotos($unico){
      $res=$this->db->query("execute fotos_clientes ".$unico);
      $resultado = $res->result_array();
      return $resultado;
   }
	
	function Guardar_cliente_producto($unico,$motivo,$implementado,$id_usuario){
   	$res=$this->db->query("Guardar_Cliente_Productos ".$unico.",".$motivo.",".$implementado.",".$id_usuario);
   	$resultado = $res->row_array();
		return $resultado;
   }

   function foto($id){
      $res=$this->db->query("execute foto_material ".$id);
      $resultado = $res->row_array();
      return $resultado;
   }

  function validarfoto($id){
      $res=$this->db->query("execute validarfoto ".$id);
      $resultado = $res->row_array();
      return $resultado;
   }

}

?>