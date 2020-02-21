
function valida_form(form){
	var valida=false;
	switch(form){
		case 'e_add':
			if(document.getElementById("txt_empresaadd").value==""){
				alert('Debe ingresar el nombre de la empresa.');
				document.getElementById("txt_empresaadd").focus();
			} else {
				valida=true;
			}
			break;
		case 'e_edit':
			if(document.getElementById("txt_empresaedit").value==""){
				alert('Debe ingresar el nombre de la empresa.');
				document.getElementById("txt_empresaedit").focus();
			} else {
				valida=true;
			}
			break;
		case 'u_add':
			var vacios=0;
			if(document.getElementById("txt_usuarioadd").value==""){
				vacios+=1;
				alert('El campo Usuario no puede quedar en blanco.');
				document.getElementById("txt_usuarioadd").focus();
			}	else if(document.getElementById("txt_passwordadd").value==""){
				vacios+=1;
				alert('El campo Password no puede quedar en blanco.');
				document.getElementById("txt_passwordadd").focus();
			} else if(document.getElementById("lbl_perfiladd").value==""){
				vacios+=1;
				alert('El campo Perfil no puede quedar en blanco.');
				document.getElementById("lbl_perfiladd").focus();
			} else if(document.getElementById("lbl_empresaadd").value==""){
				vacios+=1;
				alert('El campo Empresa no puede quedar en blanco.');
				document.getElementById("lbl_empresaadd").focus();
			} else if(document.getElementById("rad_emp_activoadd2").checked==false && 
				document.getElementById("rad_emp_activoadd1").checked==false){
				vacios+=1;
				alert('El campo Activo no puede quedar en blanco.');
				document.getElementById("rad_emp_activoadd1").focus();
			}
			if(vacios==0){
				valida=true;
			}
			break;
		case 'u_edit':
			var vacios=0;
			if(document.getElementById("txt_usuarioedit").value==""){
				vacios+=1;
				alert('El campo Usuario no puede quedar en blanco.');
				document.getElementById("txt_usuarioedit").focus();
			}else if(document.getElementById("txt_passwordedit").value==""){
				vacios+=1;
				alert('El campo Password no puede quedar en blanco.');
				document.getElementById("txt_passwordedit").focus();
			} else if(document.getElementById("lbl_perfiledit").value==""){
				vacios+=1;
				alert('El campo Perfil no puede quedar en blanco.');
				document.getElementById("lbl_perfiledit").focus();
			}else if(document.getElementById("lbl_empresaedit").value==""){
				vacios+=1;
				alert('El campo Empresa no puede quedar en blanco.');
				document.getElementById("lbl_empresaedit").focus();
			} else if(document.getElementById("rad_emp_activoedit2").checked==false && 
				document.getElementById("rad_emp_activoedit1").checked==false){
				vacios+=1;
				alert('El campo Activo no puede quedar en blanco.');
				document.getElementById("rad_emp_activoeddit1").focus();
			} 
			if(vacios==0){
				valida=true;
			}
			break;
		case 'p_add':
		var vacios=0;
		var check=0;
			if(document.getElementById("txt_perfiladd").value==""){
				vacios+=1;
				alert('El campo Perfil no puede quedar en blanco.');
				document.getElementById("txt_perfiladd").focus();
			} else {
				for (var i = 0; i < 11; i++) {
					if(document.getElementById("chck_view"+i).checked==false){
						check+=1;
					}
					if(document.getElementById("chck_add"+i).checked==false){
						check+=1;
					}
					if(document.getElementById("chck_edit"+i).checked==false){
						check+=1;
					}
					if(document.getElementById("chck_delete"+i).checked==false){
						check+=1;
					}
				}
				var total=(4*11);
				if(check==total){
					vacios+=1;
					alert('El Perfil debe contar por lo menos con un permiso.');
				} else {
					vacios=0;
				}
			}
			if(vacios==0){
				valida=true;
			}
			break;
		case 'p_edit':
		var vacios=0;
		var check=0;
			if(document.getElementById("txt_perfiledit").value==""){
				vacios+=1;
				alert('El campo Perfil no puede quedar en blanco.');
				document.getElementById("txt_perfiledit").focus();
			} else {
				for (var i = 0; i < 11; i++) {
					if(document.getElementById("chck_view"+i).checked==false){
						check+=1;
					}
					if(document.getElementById("chck_add"+i).checked==false){
						check+=1;
					}
					if(document.getElementById("chck_edit"+i).checked==false){
						check+=1;
					}
					if(document.getElementById("chck_delete"+i).checked==false){
						check+=1;
					}
				}
				var total=(4*11);
				if(check==total){
					vacios+=1;
					alert('El Perfil debe contar por lo menos con un permiso.');
				} else {
					vacios=0;
				}
			}
			if(vacios==0){
				valida=true;
			}
			break;
		case 'c_add':
			var vacios=0;
			if(document.getElementById("txt_campanaadd").value==""){
				vacios+=1;
				alert('El campo Campaña no puede quedar en blanco.');
				document.getElementById("txt_campanaadd").focus();
			} else if(document.getElementById("txt_anioadd").value=="" || document.getElementById("txt_anioadd").value<=0){
				vacios+=1;
				alert('El campo Año no puede quedar en blanco.');
				document.getElementById("txt_anioadd").focus();
			} else if(document.getElementById("lbl_paisadd").value==""){
				vacios+=1;
				alert('El campo Pais no puede quedar en blanco.');
				document.getElementById("lbl_paisadd").focus();
			} else if(document.getElementById("rad_cam_activoadd2").checked==false && 
				document.getElementById("rad_cam_activoadd1").checked==false){
				vacios+=1;
				alert('El campo Activo no puede quedar en blanco.');
				document.getElementById("rad_cam_activoadd1").focus();
			} else if(document.getElementById("lbl_grupomotivosadd").value=="") {
				vacios+=1;
				alert('El campo Grupo Motivos no puede quedar en blanco.');
				document.getElementById("lbl_grupomotivosadd").focus();
			} else if(document.getElementById("rad_acc_motivosadd2").checked==false && 
				document.getElementById("rad_acc_motivosadd1").checked==false && 
				document.getElementById("rad_acc_motivosadd3").checked==false){
				vacios+=1;
				alert('El campo Motivos Donde no puede quedar en blanco.');
				document.getElementById("rad_acc_motivosadd1").focus();
			} else if(document.getElementById("rad_acc_materialesadd2").checked==false && 
				document.getElementById("rad_acc_materialesadd1").checked==false){
				vacios+=1;
				alert('El campo Posee Materiales no puede quedar en blanco.');
				document.getElementById("rad_acc_materialesadd1").focus();
			} else if(document.getElementById("rad_acc_digitaadd2").checked==false && 
				document.getElementById("rad_acc_digitaadd1").checked==false){
				vacios+=1;
				alert('El campo Activo Digita no puede quedar en blanco.');
				document.getElementById("rad_acc_digitaadd1").focus();
			}
			if(vacios==0){
				valida=true;
			}
			break;
		case 'c_edit':
			var vacios=0;
			if(document.getElementById("txt_campanaedit").value==""){
				vacios+=1;
				alert('El campo Campaña no puede quedar en blanco.');
				document.getElementById("txt_campanaedit").focus();
			} else if(document.getElementById("txt_anioedit").value=="" || document.getElementById("txt_anioedit").value<=0){
				vacios+=1;
				alert('El campo Año no puede quedar en blanco.');
				document.getElementById("txt_anioedit").focus();
			} else if(document.getElementById("lbl_paisedit").value==""){
				vacios+=1;
				alert('El campo Pais no puede quedar en blanco.');
				document.getElementById("lbl_paisedit").focus();
			} else if(document.getElementById("rad_cam_activoedit2").checked==false && 
				document.getElementById("rad_cam_activoedit1").checked==false){
				vacios+=1;
				alert('El campo Activo no puede quedar en blanco.');
				document.getElementById("rad_cam_activoedit1").focus();
			} else if(document.getElementById("lbl_grupomotivosedit").value=="") {
				vacios+=1;
				alert('El campo Grupo Motivos no puede quedar en blanco.');
				document.getElementById("lbl_grupomotivosedit").focus();
			} else if(document.getElementById("rad_acc_motivosedit2").checked==false && 
				document.getElementById("rad_acc_motivosedit1").checked==false && 
				document.getElementById("rad_acc_motivosedit3").checked==false){
				vacios+=1;
				alert('El campo Motivos Donde no puede quedar en blanco.');
				document.getElementById("rad_acc_motivosedit1").focus();
			} else if(document.getElementById("rad_acc_materialesedit2").checked==false && 
				document.getElementById("rad_acc_materialesedit1").checked==false){
				vacios+=1;
				alert('El campo Posee Materiales no puede quedar en blanco.');
				document.getElementById("rad_acc_digitaedit1").focus();
			} else if(document.getElementById("rad_acc_digitaedit2").checked==false && 
				document.getElementById("rad_acc_digitaedit1").checked==false){
				vacios+=1;
				alert('El campo Activo Digita no puede quedar en blanco.');
				document.getElementById("rad_acc_digitaedit1").focus();
			}
			if(vacios==0){
				valida=true;
			}
			break;
		case 'cl_edit':
			var vacios=0;
			if(document.getElementById("txt_fechareal").value==""){
				vacios+=1;
				alert('El campo Fecha Implementación no puede quedar en blanco.');
				document.getElementById("txt_fechareal").focus();
			} else if(document.getElementById("txt_Nombreimplementador").value==""){
				vacios+=1;
				alert('El campo Nombre Del Implementador no puede quedar en blanco.');
				document.getElementById("txt_Nombreimplementador").focus();
			} else if(document.getElementById("txt_rutimplementador").value==""){
				vacios+=1;
				alert('El campo Rut Del Implementador no puede quedar en blanco.');
				document.getElementById("txt_rutimplementador").focus();
			} else if(document.getElementById("lb_motivo").value=="0"){
				vacios+=1;
				alert('El campo Motivo no puede quedar en blanco.');
				document.getElementById("lb_motivo").focus();
			} else if(document.getElementById("txt_NombreRecepcion").value==""){
				vacios+=1;
				alert('El campo Nombre de quien recepciona no puede quedar en blanco.');
				document.getElementById("txt_NombreRecepcion").focus();
			} else if(document.getElementById("txt_RutRecepcion").value==""){
				vacios+=1;
				alert('El campo Rut de quien recepciona no puede quedar en blanco.');
				document.getElementById("txt_RutRecepcion").focus();
			} else if(document.getElementById("txt_CargoRecepcion").value==""){
				vacios+=1;
				alert('El campo Cargo de quien recepciona no puede quedar en blanco.');
				document.getElementById("txt_CargoRecepcion").focus();
			} else if(document.getElementById("txt_Comentario").value==""){
				vacios+=1;
				alert('El campo Observacion no puede quedar en blanco.');
				document.getElementById("txt_Comentario").focus();
			}
			if(vacios==0){
				valida=true;
			}	
			break;
		case 'r_add':
			var vacios=0;
			if(document.getElementById("txt_regionadd").value==""){
				vacios+=1;
				alert('El campo Region no puede quedar en blanco.');
				document.getElementById("txt_regionadd").focus();
			} else if(document.getElementById("lbl_paisadd").value==""){
				vacios+=1;
				alert('El campo Pais no puede quedar en blanco.');
				document.getElementById("lbl_paisadd").focus();
			} else if(document.getElementById("txt_ordenadd").value==""){
				vacios+=1;
				alert('El campo Orden no puede quedar en blanco.');
				document.getElementById("txt_ordenadd").focus();
			}
			if(vacios==0){
				valida=true;
			}
			break;
		case 'r_edit':
			var vacios=0;
			if(document.getElementById("txt_regionedit").value==""){
				vacios+=1;
				alert('El campo Region no puede quedar en blanco.');
				document.getElementById("txt_regionedit").focus();
			} else if(document.getElementById("lbl_paisedit").value==""){
				vacios+=1;
				alert('El campo Pais no puede quedar en blanco.');
				document.getElementById("lbl_paisedit").focus();
			} else if(document.getElementById("txt_ordenedit").value==""){
				vacios+=1;
				alert('El campo Orden no puede quedar en blanco.');
				document.getElementById("txt_ordenedit").focus();
			}
			if(vacios==0){
				valida=true;
			}
			break;
		case 'cliente_add':
			var vacios=0;
			if(document.getElementById("txt_id_cliente").value==""){
				vacios+=1;
				alert('El campo ID Cliente no puede quedar en blanco.');
				document.getElementById("txt_id_cliente").focus();
			} else if(document.getElementById("txt_nombre_fantasia").value==""){
				vacios+=1;
				alert('El campo Nombre Fantasia no puede quedar en blanco.');
				document.getElementById("txt_nombre_fantasia").focus();
			} else if(document.getElementById("txt_direccion").value==""){
				vacios+=1;
				alert('El campo Dirección no puede quedar en blanco.');
				document.getElementById("txt_direccion").focus();
			} else if(document.getElementById("txt_fecha_programada").value==""){
				vacios+=1;
				alert('El campo Fecha Programada no puede quedar en blanco.');
				document.getElementById("txt_fecha_programada").focus();
			} else if(document.getElementById("txt_ciudad").value==""){
				vacios+=1;
				alert('El campo Ciudad no puede quedar en blanco.');
				document.getElementById("txt_ciudad").focus();
			} else if(document.getElementById("lbl_region").value==""){
				vacios+=1;
				alert('El campo Región no puede quedar en blanco.');
				document.getElementById("lbl_region").focus();
			} else if(document.getElementById("txt_canal").value==""){
				vacios+=1;
				alert('El campo Canal no puede quedar en blanco.');
				document.getElementById("txt_canal").focus();
			} else if(document.getElementById("txt_cadena").value==""){
				vacios+=1;
				alert('El campo Cadena no puede quedar en blanco.');
				document.getElementById("txt_cadena").focus();
			} else if(document.getElementById("txt_cliente").value==""){
				vacios+=1;
				alert('El campo Cliente no puede quedar en blanco.');
				document.getElementById("txt_cliente").focus();
			} else if(document.getElementById("txt_ejecutivo").value==""){
				vacios+=1;
				alert('El campo Ejecutivo no puede quedar en blanco.');
				document.getElementById("txt_ejecutivo").focus();
			} else if(document.getElementById("txt_jefe").value==""){
				vacios+=1;
				alert('El campo Jefe no puede quedar en blanco.');
				document.getElementById("txt_jefe").focus();
			} else if(document.getElementById("txt_id_original").value==""){
				vacios+=1;
				alert('El campo ID Original no puede quedar en blanco.');
				document.getElementById("txt_id_original").focus();
			} else if(document.getElementById("txt_tipo_local").value==""){
				vacios+=1;
				alert('El campo Tipo Local no puede quedar en blanco.');
				document.getElementById("txt_tipo_local").focus();
			} else if($("#txt_tipo_local").length>0){
				 if(document.getElementById("txt_gerente_zonal").value==""){
					vacios+=1;
					alert('El campo Gerente Zonal no puede quedar en blanco.');
					document.getElementById("txt_gerente_zonal").focus();
				} else if(document.getElementById("txt_gestor").value==""){
					vacios+=1;
					alert('El campo Gestor no puede quedar en blanco.');
					document.getElementById("txt_gestor").focus();
				} else if(document.getElementById("txt_agencia_repone").value==""){
					vacios+=1;
					alert('El campo Agencia Repone no puede quedar en blanco.');
					document.getElementById("txt_agencia_repone").focus();
				} else if(document.getElementById("txt_agencia_implementa").value==""){
					vacios+=1;
					alert('El campo Agencia Implementa no puede quedar en blanco.');
					document.getElementById("txt_agencia_implementa").focus();
				} else if(document.getElementById("txt_plan_cumbre").value==""){
					vacios+=1;
					alert('El campo Plan Cumbre no puede quedar en blanco.');
					document.getElementById("txt_plan_cumbre").focus();
				}
			}
			if(vacios==0){
				valida=true;
			}
			break;
		case 'clienteinfo_add':
			if(document.getElementById("txt_id_cliente_i").value==""){
				vacios+=1;
				alert('El campo ID Cliente no puede quedar en blanco.');
				document.getElementById("txt_id_cliente_i").focus();
			} else if(document.getElementById("txt_fecha_programada_i").value==""){
				vacios+=1;
				alert('El campo Fecha Programada no puede quedar en blanco.');
				document.getElementById("txt_fecha_programada_i").focus();
			} else if(document.getElementById("txt_medicion_i").value==""){
				vacios+=1;
				alert('El campo Medición no puede quedar en blanco.');
				document.getElementById("txt_medicion_i").focus();
			} else if(document.getElementById("txt_acuerdo_i").value==""){
				vacios+=1;
				alert('El campo Acuerdo no puede quedar en blanco.');
				document.getElementById("txt_acuerdo_i").focus();
			} else if($("#txt_clasificacion_i").length>0){
				if(document.getElementById("txt_clasificacion_i").value==""){
					vacios+=1;
					alert('El campo Clasificación no puede quedar en blanco.');
					document.getElementById("txt_clasificacion_i").focus();
				} else if(document.getElementById("txt_tipo_acuerdo_i").value==""){
					vacios+=1;
					alert('El campo Tipo Acuerdo no puede quedar en blanco.');
					document.getElementById("txt_tipo_acuerdo_i").focus();
				} else if(document.getElementById("txt_fecha_inicio_i").value==""){
					vacios+=1;
					alert('El campo Fecha Inicio Acuerdo no puede quedar en blanco.');
					document.getElementById("txt_fecha_inicio_i").focus();
				} else if(document.getElementById("txt_fecha_fin_i").value==""){
					vacios+=1;
					alert('El campo Fecha Fin Acuerdo no puede quedar en blanco.');
					document.getElementById("txt_fecha_fin_i").focus();
				} else if(document.getElementById("txt_costo_i").value==""){
					vacios+=1;
					alert('El campo Costo no puede quedar en blanco.');
					document.getElementById("txt_costo_i").focus();
				}
			}
			if(vacios==0){
				valida=true;
			}
			break;
	}
	return valida;
}


function limpiar(form){
	switch(form){
		case 'cliente_add':
			document.getElementById("txt_id_cliente").value="";
			document.getElementById("txt_nombre_fantasia").value="";
			document.getElementById("txt_direccion").value="";
			document.getElementById("txt_fecha_programada").value="";
			document.getElementById("txt_ciudad").value="";
			document.getElementById("lbl_region").value="";
			$('#lbl_region').val('13').trigger('change');
			document.getElementById("txt_canal").value="";
			document.getElementById("txt_cadena").value="";
			document.getElementById("txt_cliente").value="";
			document.getElementById("txt_ejecutivo").value="";
			document.getElementById("txt_jefe").value="";
			document.getElementById("txt_id_original").value="";
			document.getElementById("txt_gerente_zonal").value="";
			document.getElementById("txt_id_unico").value="0";
			document.getElementById("txt_tipo_local").value="";
			if($("#txt_tipo_local").length>0){				
				document.getElementById("txt_gestor").value="";
				document.getElementById("txt_agencia_repone").value="";
				document.getElementById("txt_agencia_implementa").value="";
				document.getElementById("txt_plan_cumbre").value="";
			}
			break;
		case 'clienteinfo_add':
			document.getElementById("txt_id_cliente_i").value="";
			document.getElementById("txt_fecha_programada_i").value="";
			document.getElementById("txt_medicion_i").value="";
			document.getElementById("txt_acuerdo_i").value="";
			document.getElementById("txt_id_info").value="0";
			if($("#txt_clasificacion_i").length>0){
				document.getElementById("txt_clasificacion_i").value="";
				document.getElementById("txt_tipo_acuerdo_i").value="";
				document.getElementById("txt_fecha_inicio_i").value="";
				document.getElementById("txt_fecha_fin_i").value="";
				document.getElementById("txt_costo_i").value="";
			}
			break;
		case 'e_add':
			document.getElementById("txt_empresaadd").value="";
			break;
		case 'u_add':
			document.getElementById("txt_usuarioadd").value="";
			document.getElementById("txt_passwordadd").value="";
			document.getElementById("lbl_perfiladd").value="";
			$('#lbl_perfiladd').val('').trigger('change');
			document.getElementById("lbl_empresaadd").value="";
			$('#lbl_empresaadd').val('').trigger('change');
			document.getElementById("rad_emp_activoadd1").checked=false;
			document.getElementById("rad_emp_activoadd2").checked=false;
			$('#lbl_campanaadd').multiSelect('deselect_all');
			document.getElementById("txt_nombreadd").value="";
			document.getElementById("txt_rutadd").value="";
			document.getElementById("txt_correoadd").value="";
			break;
		case 'p_add':
			for (var i = 0; i < 11; i++) {
				document.getElementById("chck_view"+i).checked=false;
				document.getElementById("chck_add"+i).checked=false;
				document.getElementById("chck_edit"+i).checked=false;
				document.getElementById("chck_delete"+i).checked=false;
			}
			break;
		case 'c_add':
			document.getElementById("txt_campanaadd").value="";
			document.getElementById("txt_anioadd").value=(new Date).getFullYear();
			document.getElementById("rad_cam_activoadd1").checked=false;
			document.getElementById("rad_cam_activoadd2").checked=false;
			$('#lbl_paisadd').val('').trigger('change');
			break;
		case 'a_add':
			document.getElementById("txt_accionadd").value="";
			document.getElementById("lbl_grupomotivosadd").value="";
			$('#lbl_grupomotivosadd').val('').trigger('change');
			for (var i = 1; i < 3; i++) {
				document.getElementById("rad_acc_activoadd"+i).checked=false;
				document.getElementById("rad_acc_materialesadd"+i).checked=false;
				document.getElementById("rad_acc_digitaadd"+i).checked=false;
			}
			for (var i = 1; i < 4; i++) {
				document.getElementById("rad_acc_motivosadd"+i).checked=false;
			}
			for (var i = 1; i < 5; i++) {
				document.getElementById("rad_acc_etiqueta"+i+"add1").checked=false;
				document.getElementById("rad_acc_etiqueta"+i+"add2").checked=false;
				document.getElementById("rad_acc_etiqueta"+i+"add3").checked=false;
				document.getElementById("txt_etiqueta"+i+"add").value="";
				etiquetaadd(btoa(i));
			}
			break;
		case 'r_add':
			document.getElementById("txt_regionadd").value="";
			$('#lbl_paisadd').val('').trigger('change');
			document.getElementById("txt_ordenadd").value="";
			break;
	}
}

function empresa(id){
	$.ajax({
		url:"http://masterplan.grupoprogestion.com/masterplan/empresas/empresa",
		type: "POST",
		data: "id="+id,
		success: function(data){
			document.getElementById("txt_empresaedit").value=data;
			document.getElementById("txt_empresaid").value=id;

		}
	});
}

function campanas(id){
	$.ajax({
		url:"http://masterplan.grupoprogestion.com/masterplan/empresas/campanas",
		type: "POST",
		data: "id="+id,
		success: function(data){
			window.location.href='http://masterplan.grupoprogestion.com/masterplan/campanas';
		}
	});
}

function acciones(id){
	$.ajax({
		url:"http://masterplan.grupoprogestion.com/masterplan/empresas/acciones",
		type: "POST",
		data: "id="+id,
		success: function(data){
			window.location.href='http://masterplan.grupoprogestion.com/masterplan/acciones';
		}
	});
}

function clientes(id){
	$.ajax({
		url:"http://masterplan.grupoprogestion.com/masterplan/empresas/clientes",
		type: "POST",
		data: "id="+id,
		success: function(data){
			window.location.href='http://masterplan.grupoprogestion.com/masterplan/clientesinfo';
		}
	});
}

function usuarios(){
	document.getElementById("f_empresa").submit();
}


function usuario(id){
	$.ajax({
		url:"http://masterplan.grupoprogestion.com/masterplan/usuarios/usuario",
		type: "POST",
		data: "id="+id,
		dataType:"json",
		success: function(data){
			document.getElementById("txt_usuarioedit").value=data.usuario;
			document.getElementById("txt_passwordedit").value=data.password;
			document.getElementById("lbl_perfiledit").value=data.id_perfil;
			document.getElementById("lbl_empresaedit").value=data.id_empresa;
			document.getElementById("txt_usuarioid").value=id;
			if(data.activo==1){
				document.getElementById("rad_emp_activoedit1").checked=true;
				document.getElementById("rad_emp_activoedit2").checked=false;
			} else {
				document.getElementById("rad_emp_activoedit1").checked=false;
				document.getElementById("rad_emp_activoedit2").checked=true;
			}
			$('#lbl_empresaedit').select2();
			$('#lbl_perfiledit').select2();		
			
		}
	});
}



function camp_anios(id){
	// alert(id);
	$.ajax({
		url:"http://masterplan.grupoprogestion.com/masterplan/campanas/anios",
		type: "POST",
		data: "anio="+id,
		success: function(data){
			window.location.href='http://masterplan.grupoprogestion.com/masterplan/informes/campanas';
		}
	});
}

function camp_empresas(){
	var id=document.getElementById("lbl_empresaadd").value;
	if(id!=""){
		if(id=="0"){
			$("#lbl_campanaadd").html("<option value='0'>Seleccione</option>");
		} else {
			$.ajax({
				url:"http://masterplan.grupoprogestion.com/masterplan/usuarios/campanas",
				type: "POST",
				data: "id="+id,
				success: function(data){
					$("#lbl_campanaadd").html(data);
					$('#lbl_campanaadd').multiSelect('refresh');
				}
			});
		}
	}
		
}

function camp_usuarios(camp){
	$.ajax({
		url:"http://masterplan.grupoprogestion.com/masterplan/usuarios/camp_usuarios",
		type: "POST",
		data: "id="+camp,
		success: function(data){
			window.location.href='http://masterplan.grupoprogestion.com/masterplan/usuarios/campanas';
		}
	});
	
}


function camp_sucursal(usuario){
	var camp=$('#lbl_campanas').val();
	$.ajax({
		url:"http://masterplan.grupoprogestion.com/masterplan/usuarios/camp_sucursal",
		type: "POST",
		data: "id="+camp+"&id_usuario="+usuario,
		dataType:"json",
		success: function(data){
			$('#lbl_pdv').html("");
			$('#lbl_pdv').multiSelect({
				selectableHeader: '<input type=\"text\" class=\"search-input form-control\" autocomplete=\"off\" placeholder=\"Sucursales\">',
				selectionHeader: '<input type=\"text\" class=\"search-input form-control\" autocomplete=\"off\" placeholder=\"Sucursales seleccionadas\">',
				afterInit: function(ms){
					var that = this,
					$selectableSearch = that.$selectableUl.prev(),
					$selectionSearch = that.$selectionUl.prev(),
					selectableSearchString = '#'+that.$container.attr("id")+' .ms-elem-selectable:not(.ms-selected)',
					selectionSearchString = '#'+that.$container.attr("id")+' .ms-elem-selection.ms-selected';

					that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
					.on('keydown', function(e){
						if (e.which === 40){
							that.$selectableUl.focus();
							return false;
						}
					});

					that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
					.on('keydown', function(e){
						if (e.which == 40){
							that.$selectionUl.focus();
							return false;	
						}
					});
				},
				afterSelect: function(){
					this.qs1.cache();
					this.qs2.cache();
				},
				afterDeselect: function(){
					this.qs1.cache();
					this.qs2.cache();
				}
			});
			$('#lbl_pdv').multiSelect('refresh');
			for (var i = 0; i < data['arr1'].length; i++) {
				$('#lbl_pdv').multiSelect('addOption', { value: data['arr1'][i].id_cliente, text: data['arr1'][i].sucursal  } );
			}
			for (var i = 0; i < data['arr2'].length; i++) {
				$('#lbl_pdv').multiSelect('select', data['arr2'][i].id_cliente );
			}
		}
	});
}


function perfil(id){
	$.ajax({
		url:"http://masterplan.grupoprogestion.com/masterplan/perfiles/perfil",
		type: "POST",
		data: "id="+id,
		dataType:"json",
		success: function(data){
			document.getElementById("txt_perfiledit").value=data[0].userlevelname;
			document.getElementById("txt_perfilid").value=id;
			var tm = document.getElementsByName("txt_modulos[]");
			for (var i = 0; i < data.length; i++) {
				for (var j = 0; j < 11; j++) {
				    if(data[i].level==atob(tm[j].value)){
				       	if(data[i].permiso==0){
				    		document.getElementById("chck_view"+j).checked=false;
				    		document.getElementById("chck_add"+j).checked=false;
				    		document.getElementById("chck_edit"+j).checked=false;
				    		document.getElementById("chck_delete"+j).checked=false;
				    	} else if(data[i].permiso>=8){
				    		document.getElementById("chck_view"+j).checked=true;
				    		var p=data[i].permiso-8;
				    		if(p==7){
				    			document.getElementById("chck_add"+j).checked=true;
						    	document.getElementById("chck_edit"+j).checked=true;
						    	document.getElementById("chck_delete"+j).checked=true;
				    		} else if(p==6){
				    			document.getElementById("chck_add"+j).checked=false;
						    	document.getElementById("chck_edit"+j).checked=true;
						    	document.getElementById("chck_delete"+j).checked=true;
				    		} else if(p==5){
				    			document.getElementById("chck_add"+j).checked=true;
						    	document.getElementById("chck_edit"+j).checked=false;
						    	document.getElementById("chck_delete"+j).checked=true;
				    		} else if(p==4){
				    			document.getElementById("chck_add"+j).checked=false;
						    	document.getElementById("chck_edit"+j).checked=true;
						    	document.getElementById("chck_delete"+j).checked=false;
				    		} else if(p==3){
				    			document.getElementById("chck_add"+j).checked=true;
						    	document.getElementById("chck_edit"+j).checked=false;
						    	document.getElementById("chck_delete"+j).checked=true;
				    		} else if(p==2){
				    			document.getElementById("chck_add"+j).checked=false;
						    	document.getElementById("chck_edit"+j).checked=false;
						    	document.getElementById("chck_delete"+j).checked=true;
				    		} else if(p==1){
				    			document.getElementById("chck_add"+j).checked=true;
						    	document.getElementById("chck_edit"+j).checked=false;
						    	document.getElementById("chck_delete"+j).checked=false;
				    		} else {
				    			document.getElementById("chck_add"+j).checked=false;
						    	document.getElementById("chck_edit"+j).checked=false;
						    	document.getElementById("chck_delete"+j).checked=false;
				    		}
				    	} else {
				    		var p=data[i].permiso;
				    		document.getElementById("chck_view"+j).checked=false;
				    		if(p==7){
				    			document.getElementById("chck_add"+j).checked=true;
						    	document.getElementById("chck_edit"+j).checked=true;
						    	document.getElementById("chck_delete"+j).checked=true;
				    		} else if(p==6){
				    			document.getElementById("chck_add"+j).checked=false;
						    	document.getElementById("chck_edit"+j).checked=true;
						    	document.getElementById("chck_delete"+j).checked=true;
				    		} else if(p==5){
				    			document.getElementById("chck_add"+j).checked=true;
						    	document.getElementById("chck_edit"+j).checked=false;
						    	document.getElementById("chck_delete"+j).checked=true;
				    		} else if(p==4){
				    			document.getElementById("chck_add"+j).checked=false;
						    	document.getElementById("chck_edit"+j).checked=true;
						    	document.getElementById("chck_delete"+j).checked=false;
				    		} else if(p==3){
				    			document.getElementById("chck_add"+j).checked=true;
						    	document.getElementById("chck_edit"+j).checked=false;
						    	document.getElementById("chck_delete"+j).checked=true;
				    		} else if(p==2){
				    			document.getElementById("chck_add"+j).checked=false;
						    	document.getElementById("chck_edit"+j).checked=false;
						    	document.getElementById("chck_delete"+j).checked=true;
				    		} else if(p==1){
				    			document.getElementById("chck_add"+j).checked=true;
						    	document.getElementById("chck_edit"+j).checked=false;
						    	document.getElementById("chck_delete"+j).checked=false;
				    		} else {
				    			document.getElementById("chck_add"+j).checked=false;
						    	document.getElementById("chck_edit"+j).checked=false;
						    	document.getElementById("chck_delete"+j).checked=false;
				    		}

				    	}
				    }
				}
			}
			
		}
	});
}


function campana(id){
	$.ajax({
		url:"http://masterplan.grupoprogestion.com/masterplan/campanas/campana",
		type: "POST",
		data: "id="+id,
		dataType:"json",
		success: function(data){
			document.getElementById("txt_campanaid").value=id;
			document.getElementById("txt_campanaedit").value=data.campana;
			document.getElementById("txt_anioedit").value=data.anio;
			if(data.activo==1){
				document.getElementById("rad_cam_activoedit1").checked=true;
				document.getElementById("rad_cam_activoedit2").checked=false;
			} else {
				document.getElementById("rad_cam_activoedit1").checked=false;
				document.getElementById("rad_cam_activoedit2").checked=true;
			}
			document.getElementById("lbl_paisedit").value=data.id_pais;
			document.getElementById("lbl_grupomotivosedit").value=data.id_grupo_motivos;
			if(data.id_motivos_donde==1){
				document.getElementById("rad_acc_motivosedit1").checked=true;
				document.getElementById("rad_acc_motivosedit2").checked=false;
				document.getElementById("rad_acc_motivosedit3").checked=false;
			} else if(data.id_motivos_donde==2){
				document.getElementById("rad_acc_motivosedit1").checked=false;
				document.getElementById("rad_acc_motivosedit2").checked=true;
				document.getElementById("rad_acc_motivosedit3").checked=false;
			} else if(data.id_motivos_donde==3){
				document.getElementById("rad_acc_motivosedit1").checked=false;
				document.getElementById("rad_acc_motivosedit2").checked=false;
				document.getElementById("rad_acc_motivosedit3").checked=true;
			}
			if(data.posee_materiales==1){
				document.getElementById("rad_acc_materialesedit1").checked=true;
				document.getElementById("rad_acc_materialesedit2").checked=false;
			} else if(data.posee_materiales==2){
				document.getElementById("rad_acc_materialesedit1").checked=false;
				document.getElementById("rad_acc_materialesedit2").checked=true;
			}
			if(data.activo_digita==1){
				document.getElementById("rad_acc_digitaedit1").checked=true;
				document.getElementById("rad_acc_digitaedit2").checked=false;
			} else if(data.activo_digita==2){
				document.getElementById("rad_acc_digitaedit1").checked=false;
				document.getElementById("rad_acc_digitaedit2").checked=true;
			}
			$('#lbl_paisedit').select2();
			$('#lbl_grupomotivosedit').select2();
			if(document.body.contains(document.getElementById("txt_linkpbiedit"))){
				document.getElementById("txt_linkpbiedit").value=data.powerbi;
			}
		}
	});
}


function format(input)
{
	var num = input;
	if(!isNaN(num)){
		num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
		num = num.split('').reverse().join('').replace(/^[\.]/,'');
		return num;
	} 

	return "";
}


function info(id){
	$.ajax({
		url:"http://masterplan.grupoprogestion.com/masterplan/campanas/campana",
		type: "POST",
		data: "id="+id,
		dataType:"json",
		success: function(data){
			$("#modal11 .modal-header .modal-title").html("Información - Campaña "+data.campana);
			var porc= isNaN(((data.q_implementados/data.q_puntos)*100)) ? 0 : ((data.q_implementados/data.q_puntos)*100).toFixed(2);
			var info="<strong>"+porc+"%</strong>";
			info+="<small class='pull-right'>Porcentaje Implementado</small>";
			info+="<div class='progress xs'><div class='progress-bar bg-theme' style='width:"+porc+"%;' role='progessbar' aria-valuenow='"+porc+"' aria-valuemin='0' aria-valuemax='100'></div></div>";
			$("#modal11 .porcentaje .category-progress").html(info);
			var puntos="<div class='float-right'><div class='h1 text-theme'><span class='mdi mdi-chart-bubble'></span></div></div><div class='float-left'><div class='h4 text-theme'>"+format(data.q_puntos)+"</div><small class='h6'>Puntos</small></div>";
			var implement="<div class='float-right'><div class='h1 text-theme'><span class='mdi mdi-chart-bubble'></span></div></div><div class='float-left'><div class='h4 text-theme'>"+format(data.q_implementados)+"</div><small class='h6' >Implementados</small></div>";
			var pendiente="<div class='float-right'><div class='h1 text-theme'><span class='mdi mdi-chart-bubble'></span></div></div><div class='float-left'><div class='h4 text-theme'>"+format(data.q_pendiente)+"</div><small class='h6' >Por Implementar</small></div>";
			var acciones="<div class='float-right'><div class='h1 text-theme'><span class='mdi mdi-chart-bubble'></span></div></div><div class='float-left'><div class='h4 text-theme'>"+data.q_acciones+"</div><small class='h6' >Acciones</small></div>";
			$("#modal11 .puntos").html(puntos);
			$("#modal11 .implement").html(implement);
			$("#modal11 .pendiente").html(pendiente);
			$("#modal11 .acciones").html(acciones);
		}
	});
}


function infoaccion(id){
	$.ajax({
		url:"http://masterplan.grupoprogestion.com/masterplan/acciones/accion",
		type: "POST",
		data: "id="+id,
		dataType:"json",
		success: function(data) {
			$("#modal14 .modal-header .modal-title").html("Información - Accion "+data.accion);
			var fecha="<td class='document'><div class='heading'>"+data.fecha_inicio+"</div><small class='text-theme'>Fecha Inicio</small></td>";
			fecha+="<td class='document'><div class='heading'>"+data.fecha_termino+"</div><small class='text-theme'>Fecha Termino</small></td>";
			fecha+="<td class='document'><div class='heading'>"+data.fecha_termino_real+"</div><small class='text-theme'>Fecha Termino Real</small></td>";
			$("#modal14 .fecha").html(fecha);
			var info="<strong>"+data.porcentaje+"%</strong>";
			info+="<small class='pull-right'>Porcentaje Implementado</small>";
			info+="<div class='progress xs'><div class='progress-bar bg-theme' style='width:"+data.porcentaje+"%;' role='progessbar' aria-valuenow='"+data.porcentaje+"' aria-valuemin='0' aria-valuemax='100'></div></div>";
			$("#modal14 .category-progress").html(info);
			var puntos="<div class='time h4 text-theme'>"+data.q_puntos+"</div><small>Puntos</small>";
			var implement="<div class='time h4 text-theme'>"+data.q_implementados+"</div><small>Implementados</small>";
			var pendiente="<div class='time h4 text-theme'>"+(data.q_puntos-data.q_implementados)+"</div><small style='font-size:75% !important;'>Por Implementar</small>";
			$("#modal14 .puntos").html(puntos);
			$("#modal14 .implement").html(implement);
			$("#modal14 .pendiente").html(pendiente);

		}
	});
}


function region(id){
	$.ajax({
		url:"http://masterplan.grupoprogestion.com/masterplan/regiones/region",
		type: "POST",
		data: "id="+id,
		dataType:"json",
		success: function (data) {
			document.getElementById("txt_regionedit").value=data.region;
			document.getElementById("txt_ordenedit").value=data.orden;
			document.getElementById("txt_regionid").value=id;
			document.getElementById("lbl_paisedit").value=data.id_pais;
			$('#lbl_paisedit').select2();
		}
	});
}


function master(){
	if(document.getElementById("ex_master").value!=""){
		var ext=(document.getElementById("ex_master").value.substring(document.getElementById("ex_master").value.lastIndexOf("."))).toLowerCase();
		if(ext==".xls" || ext==".xlsx"){
			document.getElementById("form1").submit();
		} else {
			document.getElementById("ex_master").value="";
		    alert("El archivo ingresado tiene una extensión no permitida, inténtelo nuevamente.");
		}
	}
}


function ciudad(index) {
	var id = document.getElementById("lbl_region"+index).value;
	$.ajax({
		url:"http://masterplan.grupoprogestion.com/masterplan/regiones/ciudades",
		type: "POST",
		data: "id="+id,
		dataType:"json",
		success: function (data) {
			var ciudad="";
			$('#txt_ciudad'+index).html(ciudad);
			$('#txt_ciudad'+index).select2();
		}
	});
}



function email(ema) {
 	if(document.getElementById(ema).value!=""){
 		var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	    var email=document.getElementById(ema).value;
	    if ( !expr.test(email) ){
	        alert("El email ingresado es incorrecto.");
	        document.getElementById(ema).value="";
	    }
 	}    	
}

function revisarDigito(dvr){	
	dv = dvr + ""	
	if ( dv != '0' && dv != '1' && dv != '2' && dv != '3' && dv != '4' && dv != '5' 
		&& dv != '6' && dv != '7' && dv != '8' && dv != '9' && dv != 'k'  && dv != 'K')	{		
		alert("Debe ingresar un digito verificador valido");				
		return false;	
	}	
	return true;
}

function revisarDigito2( crut ){	
	largo = crut.length;	
	if ( largo < 2 ){		
		alert("Debe ingresar el rut completo");		
		return false;	
	}	
	if ( largo > 2 )		
		rut = crut.substring(0, largo - 1);	
	else		
		rut = crut.charAt(0);	
	dv = crut.charAt(largo-1);	
	revisarDigito( dv );	

	if ( rut == null || dv == null )
		return 0	

	var dvr = '0'	
	suma = 0	
	mul  = 2	

	for (i= rut.length -1 ; i >= 0; i--){	
		suma = suma + rut.charAt(i) * mul		
		if (mul == 7)			
			mul = 2		
		else    			
			mul++	
	}	
	res = suma % 11	
	if (res==1)		
		dvr = 'k'	
	else if (res==0)		
		dvr = '0'	
	else{		
		dvi = 11-res		
		dvr = dvi + ""	
	}

	if ( dvr != dv.toLowerCase() ){		
		alert("EL rut es incorrecto");		
		return false	
	}

	return true
}

function validar_rut(texto){	
	var tmpstr = "";	
	for ( i=0; i < texto.length ; i++ )		
		if ( texto.charAt(i) != ' ' && texto.charAt(i) != '.' && texto.charAt(i) != '-' )
			tmpstr = tmpstr + texto.charAt(i);	
	texto = tmpstr;	
	largo = texto.length;	

	if ( largo < 2 ){		
		alert("Debe ingresar el rut completo");				
		return false;	
	}	

	for (i=0; i < largo ; i++ ){			
		if ( texto.charAt(i) !="0" && texto.charAt(i) != "1" && texto.charAt(i) !="2" && texto.charAt(i) != "3" && texto.charAt(i) != "4" && texto.charAt(i) !="5" && texto.charAt(i) != "6" && texto.charAt(i) != "7" && texto.charAt(i) !="8" && texto.charAt(i) != "9" && texto.charAt(i) !="k" && texto.charAt(i) != "K" )
 		{			
			alert("El valor ingresado no corresponde a un R.U.T valido");						
			return false;		
		}	
	}	

	var invertido = "";	
	for ( i=(largo-1),j=0; i>=0; i--,j++ )		
		invertido = invertido + texto.charAt(i);	
	var dtexto = "";	
	dtexto = dtexto + invertido.charAt(0);	
	dtexto = dtexto + '-';	
	cnt = 0;	

	for ( i=1,j=2; i<largo; i++,j++ ){		
		//alert("i=[" + i + "] j=[" + j +"]" );		
		if ( cnt == 3 ){			
			dtexto = dtexto + '.';			
			j++;			
			dtexto = dtexto + invertido.charAt(i);			
			cnt = 1;		
		}		
		else{				
			dtexto = dtexto + invertido.charAt(i);			
			cnt++;		
		}	
	}	

	invertido = "";	
	for ( i=(dtexto.length-1),j=0; i>=0; i--,j++ )		
		invertido = invertido + dtexto.charAt(i);		

	if ( revisarDigito2(texto) )		
		return true;	

	return false;
}


function limpselect(id){
	var op=btoa(id);
	if(op==1){
		document.getElementById("lbl_sucursal").value='';
	} else if(op==2){
	} else if(op==3){
	}
}








