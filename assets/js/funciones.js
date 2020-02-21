
function valida_form(form){
	var valida=false;
	switch(form){
		case 'login':
			var vacios=0;
			// if(document.getElementById("lb_empresa").value==""){
			// 	vacios+=1;
			// 	alert('Debe seleccionar el cliente poder recuperar su contraseña.');
			// 	document.getElementById("lb_empresa").focus();
			// } else 
			if(document.getElementById("txt_nombreusuario").value==""){
				vacios+=1;
				alert('Debe ingresar su usuario para poder recuperar su contraseña.');
				document.getElementById("txt_nombreusuario").focus();
			} else if(document.getElementById("txt_correo").value==""){
				vacios+=1;
				alert('Debe ingresar su correo para poder recuperar su contraseña.');
				document.getElementById("txt_correo").focus();
			} else if(!validarEmail(document.getElementById("txt_correo").value)){
				vacios+=1;
				alert('El correo escrito es incorrecto.');
				document.getElementById("txt_correo").focus();
			}
			if(vacios==0){
				valida=true;
			}
			break;
		case 'e_add':
			var vacios=0;
			var allowedExtensions = /(.jpg|.jpeg|.png|.gif)$/i;
			if(document.getElementById("txt_empresaadd").value==""){
				vacios+=1;
				alert('Debe ingresar el nombre del cliente.');
				document.getElementById("txt_empresaadd").focus();
			} else if(document.getElementById("chck_color").checked==true && (document.getElementById("txt_coloresadd1").value=="" && document.getElementById("txt_coloresadd2").value=="" && document.getElementById("txt_coloresadd3").value=="")){
				vacios+=1;
				alert('Debe seleccionar el color principal para de los dashboard. En caso contrario, desmarque la casilla Habilitar Colores');
				document.getElementById("txt_coloresadd1").focus();
			} else if(document.getElementById("chck_logo").checked==true && (document.getElementById("txt_logoadd").value=="")){ 
				vacios+=1;
				alert('Debe seleccionar una imagen. En caso contrario, desmarque la casilla Habilitar Imagen Logo');
				document.getElementById("txt_logoadd").focus();
			} else if(document.getElementById("chck_logo").checked==true && (document.getElementById("txt_logoadd").value!="") && (!allowedExtensions.exec(document.getElementById("txt_logoadd").value))){
				vacios+=1;
				alert("La imagen ingresada debe tener una extensión .jpg, .png, .jpeg.");
				document.getElementById("txt_logoadd").focus();
			} else if(document.getElementById("chck_fondo").checked==true && (document.getElementById("txt_fondoadd").value=="")){
				vacios+=1;
				alert('Debe seleccionar una foto. En caso contrario, desmarque la casilla Habilitar Imagen Fondo');
				document.getElementById("txt_fondoadd").focus();
			} else if(document.getElementById("chck_fondo").checked==true && (document.getElementById("txt_fondoadd").value!="") && (!allowedExtensions.exec(document.getElementById("txt_fondoadd").value))){
				vacios+=1;
				alert('Debe seleccionar una foto. En caso contrario, desmarque la casilla Habilitar Imagen Fondo');
				document.getElementById("txt_fondoadd").focus();
			} else {
				var ev=0;
				var txt=0;
				$("#modaladd input[name='checkbusadd[]']").each(function(){
					if(!$(this).is(':checked')){
						$(this).parent().attr("style","color:red");
						ev+=1;
					} else {
						$(this).parent().removeAttr("style");
						if($(this).parent().parent().find("input[name='txt_posicionadd[]']").val()==""){
							$(this).parent().parent().find("input[name='txt_posicionadd[]']").focus();
							txt+=1;
						}
					}
				});
				if($("#modaladd input[name='checkbusadd[]']").length==ev){
					vacios+=1;
					alert('Debe seleccionar por lo menos 3 búsquedas.');
				} else if(($("#modaladd input[name='checkbusadd[]']").length-1)==ev){
					vacios+=1;
					alert('Debe seleccionar por lo menos 3 búsquedas.');
				}  else if(($("#modaladd input[name='checkbusadd[]']").length-2)==ev){
					vacios+=1;
					alert('Debe seleccionar por lo menos 3 búsquedas.');
				} else {
					$("#modaladd input[name='checkbusadd[]']").parent().removeAttr("style");
					if(txt>0){
						vacios+=1;
						alert('Debe ingresar orden de la búsqueda.');	
					}
				}
			}			
			if(vacios==0){
				valida=true;
			}
			break;
		case 'e_edit':
			var vacios=0;
			var allowedExtensions = /(.jpg|.jpeg|.png|.gif)$/i;
			if(document.getElementById("txt_empresaedit").value==""){
				vacios+=1;
				alert('Debe ingresar el nombre del cliente.');
				document.getElementById("txt_empresaedit").focus();
			} else if(document.getElementById("chck_color1").checked==true && (document.getElementById("txt_coloresedit1").value=="" && document.getElementById("txt_coloresedit2").value=="" && document.getElementById("txt_coloresedit3").value=="")){
				vacios+=1;
				alert('Debe seleccionar colores. En caso contrario, desmarque la casilla Habilitar Colores');
				document.getElementById("txt_coloresedit1").focus();
			} else if(document.getElementById("chck_logo1").checked==true && (document.getElementById("txt_logo").value=="")){ 
				vacios+=1;
				alert('Debe seleccionar una imagen. En caso contrario, desmarque la casilla Habilitar Imagen Logo');
				document.getElementById("txt_logoedit").focus();
			} else if(document.getElementById("chck_logo1").checked==true && (document.getElementById("txt_logo").value=="logo_undefined") && (!allowedExtensions.exec(document.getElementById("txt_logoedit").value))){
				vacios+=1;
				alert("La imagen ingresada debe tener una extensión .jpg, .png, .jpeg.");
				document.getElementById("txt_logoedit").focus();
			} else if(document.getElementById("chck_fondo1").checked==true && (document.getElementById("txt_fondo").value=="")){
				vacios+=1;
				alert('Debe seleccionar una foto. En caso contrario, desmarque la casilla Habilitar Imagen Fondo');
				document.getElementById("txt_fondoedit").focus();
			} else if(document.getElementById("chck_fondo1").checked==true && (document.getElementById("txt_fondo").value=="fondo_undefined") && (!allowedExtensions.exec(document.getElementById("txt_fondoedit").value))){
				vacios+=1;
				alert('Debe seleccionar una foto. En caso contrario, desmarque la casilla Habilitar Imagen Fondo');
				document.getElementById("txt_fondoedit").focus();
			} else {
				var ev=0;
				var txt=0;
				$("#modaledit input[name='checkbusedit[]']").each(function(){
					if(!$(this).is(':checked')){
						$(this).parent().attr("style","color:red");
						ev+=1;
					} else {
						$(this).parent().removeAttr("style");
						if($(this).parent().parent().find("input[name='txt_posicionedit[]']").val()==""){
							$(this).parent().parent().find("input[name='txt_posicionedit[]']").focus();
							txt+=1;
						}
					}
				});
				if($("#modaledit input[name='checkbusedit[]']").length==ev){
					vacios+=1;
					alert('Debe seleccionar por lo menos 3 búsquedas.');
				} else if(($("#modaledit input[name='checkbusedit[]']").length-1)==ev){
					vacios+=1;
					alert('Debe seleccionar por lo menos 3 búsquedas.');
				}  else if(($("#modaledit input[name='checkbusedit[]']").length-2)==ev){
					vacios+=1;
					alert('Debe seleccionar por lo menos 3 búsquedas.');
				} else {
					$("#modaledit input[name='checkbusedit[]']").parent().removeAttr("style");
					if(txt>0){
						vacios+=1;
						alert('Debe ingresar orden de la búsqueda.');	
					}
				}
			}
			if(vacios==0){
				valida=true;
			}
			break;
		case 'u_add':
			var vacios=0;
			if(document.getElementById("txt_usuarioadd").value==""){
				vacios+=1;
				alert('El campo Usuario no puede quedar en blanco.');
				document.getElementById("txt_usuarioadd").focus();
			} else if(document.getElementById("txt_passwordadd").value==""){
				vacios+=1;
				alert('El campo Password no puede quedar en blanco.');
				document.getElementById("txt_passwordadd").focus();
			} else if(document.getElementById("txt_nombreusuarioadd").value==""){
				vacios+=1;
				alert('El campo Nombre no puede quedar en blanco.');
				document.getElementById("txt_nombreusuarioadd").focus();
			} else if(document.getElementById("txt_emailadd").value==""){
				vacios+=1;
				alert('El campo Correo no puede quedar en blanco.');
				document.getElementById("txt_emailadd").focus();
			} else if(!validarEmail(document.getElementById("txt_emailadd").value)){
				vacios+=1;
				alert('El correo escrito es incorrecto.');
				document.getElementById("txt_emailadd").focus();
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
			} else if(document.getElementById("txt_nombreusuarioedit").value==""){
				vacios+=1;
				alert('El campo Nombre no puede quedar en blanco.');
				document.getElementById("txt_nombreusuarioedit").focus();
			} else if(document.getElementById("txt_emailedit").value==""){
				vacios+=1;
				alert('El campo Correo no puede quedar en blanco.');
				document.getElementById("txt_emailedit").focus();
			} else if(!validarEmail(document.getElementById("txt_emailedit").value)){
				vacios+=1;
				alert('El correo escrito es incorrecto.');
				document.getElementById("txt_emailedit").focus();
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
					if(document.getElementById("chck_view1"+i).checked==false){
						check+=1;
					}
					if(document.getElementById("chck_add1"+i).checked==false){
						check+=1;
					}
					if(document.getElementById("chck_edit1"+i).checked==false){
						check+=1;
					}
					if(document.getElementById("chck_delete1"+i).checked==false){
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
			} else {
				var id=document.getElementById("lb_motivo").value;
				$.ajax({
					url:"http://masterplan.grupoprogestion.com/masterplan/clientes/motivo",
					type: "POST",
					data: "id="+id,
					dataType:"json",
					success: function(data){
						if(data.exitoso=0){
							if(document.getElementById("txt_Comentario").value==""){
								vacios+=1;
								alert('El campo Observacion no puede quedar en blanco.');
								document.getElementById("txt_Comentario").focus();
							}
						}
					}
				});
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
			} else if($("#txt_gerente_zonal").length>0){
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
			var vacios=0;
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
			} else if($("#txt_tipo_acuerdo_i").length>0){
				if(document.getElementById("txt_tipo_acuerdo_i").value==""){
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
				} 
			}
			if(vacios==0){
				valida=true;
			}
			break;
		case 'mg_add':
			var vacios=0;
			if(document.getElementById("txt_grupomotivoadd").value==""){
				vacios+=1;
				alert('El campo Grupo Motivo no puede quedar en blanco.');
				document.getElementById("txt_grupomotivoadd").focus();
			}			
			if(vacios==0){
				valida=true;
			}
			break;
		case 'mg_edit':
			var vacios=0;
			if(document.getElementById("txt_grupomotivoedit").value==""){
				vacios+=1;
				alert('El campo Grupo Motivo no puede quedar en blanco.');
				document.getElementById("txt_grupomotivoedit").focus();
			}			
			if(vacios==0){
				valida=true;
			}
			break;
		case 'm_add':
			var vacios=0;
			if(document.getElementById("txt_motivoadd").value==""){
				vacios+=1;
				alert('El campo Motivo no puede quedar en blanco.');
				document.getElementById("txt_motivoadd").focus();
			}else if(document.getElementById("txt_aliasadd").value==""){
				vacios+=1;
				alert('El campo Alias no puede quedar en blanco.');
				document.getElementById("txt_aliasadd").focus();
			}else if(document.body.contains(document.getElementById("txt_codigoadd"))){
				if(document.getElementById("txt_codigoadd").value==""){
					vacios+=1;
					alert('El campo Código Motivo no puede quedar en blanco.');
					document.getElementById("txt_codigoadd").focus();
				}
				if(document.getElementById("txt_responsableadd").value==""){
					vacios+=1;
					alert('El campo Responsable no puede quedar en blanco.');
					document.getElementById("txt_responsableadd").focus();
				}
			}else if(document.getElementById("rad_mot_implementaadd2").checked==false && 
				document.getElementById("rad_mot_implementaadd1").checked==false){
				vacios+=1;
				alert('El campo No Implementa no puede quedar en blanco.');
				document.getElementById("rad_mot_implementaadd1").focus();
			}else if(document.getElementById("rad_mot_exitosoadd2").checked==false && 
				document.getElementById("rad_mot_exitosoadd1").checked==false){
				vacios+=1;
				alert('El campo Exitoso no puede quedar en blanco.');
				document.getElementById("rad_mot_exitosoadd1").focus();
			}else if(document.getElementById("rad_mot_clienteadd2").checked==false && 
				document.getElementById("rad_mot_clienteadd1").checked==false){
				vacios+=1;
				alert('El campo En Cliente no puede quedar en blanco.');
				document.getElementById("rad_mot_clienteadd1").focus();
			}else if(document.getElementById("rad_mot_materialadd2").checked==false && 
				document.getElementById("rad_mot_materialadd1").checked==false){
				vacios+=1;
				alert('El campo En Material no puede quedar en blanco.');
				document.getElementById("rad_mot_materialadd1").focus();
			}else if(document.getElementById("rad_mot_activoadd2").checked==false && 
				document.getElementById("rad_mot_activoadd1").checked==false){
				vacios+=1;
				alert('El campo Activo no puede quedar en blanco.');
				document.getElementById("rad_mot_activoadd1").focus();
			}
			if(vacios==0){
				valida=true;
			}
			break;
		case 'm_edit':
			var vacios=0;
			if(document.getElementById("txt_motivoedit").value==""){
				vacios+=1;
				alert('El campo Motivo no puede quedar en blanco.');
				document.getElementById("txt_motivoedit").focus();
			}else if(document.getElementById("txt_aliasedit").value==""){
				vacios+=1;
				alert('El campo Alias no puede quedar en blanco.');
				document.getElementById("txt_aliasedit").focus();
			}else if(document.body.contains(document.getElementById("txt_codigoedit"))){
				if(document.getElementById("txt_codigoedit").value==""){
					vacios+=1;
					alert('El campo Código Motivo no puede quedar en blanco.');
					document.getElementById("txt_codigoedit").focus();
				}
				if(document.getElementById("txt_responsableedit").value==""){
					vacios+=1;
					alert('El campo Responsable no puede quedar en blanco.');
					document.getElementById("txt_responsableedit").focus();
				}
			}else if(document.getElementById("rad_mot_implementaedit2").checked==false && 
				document.getElementById("rad_mot_implementaedit1").checked==false){
				vacios+=1;
				alert('El campo No Implementa no puede quedar en blanco.');
				document.getElementById("rad_mot_implementaedit1").focus();
			}else if(document.getElementById("rad_mot_exitosoedit2").checked==false && 
				document.getElementById("rad_mot_exitosoedit1").checked==false){
				vacios+=1;
				alert('El campo Exitoso no puede quedar en blanco.');
				document.getElementById("rad_mot_exitosoedit1").focus();
			}else if(document.getElementById("rad_mot_clienteedit2").checked==false && 
				document.getElementById("rad_mot_clienteedit1").checked==false){
				vacios+=1;
				alert('El campo En Cliente no puede quedar en blanco.');
				document.getElementById("rad_mot_clienteedit1").focus();
			}else if(document.getElementById("rad_mot_materialedit2").checked==false && 
				document.getElementById("rad_mot_materialedit1").checked==false){
				vacios+=1;
				alert('El campo En Material no puede quedar en blanco.');
				document.getElementById("rad_mot_materialedit1").focus();
			}else if(document.getElementById("rad_mot_activoedit2").checked==false && 
				document.getElementById("rad_mot_activoedit1").checked==false){
				vacios+=1;
				alert('El campo Activo no puede quedar en blanco.');
				document.getElementById("rad_mot_activoeit1").focus();
			}
			if(vacios==0){
				valida=true;
			}
			break;
		case 'car_add':
			vacios=0;
			if(document.getElementById("txt_carpetaadd").value==""){
				vacios+=1;
				alert('El campo Nombre Carpeta no puede quedar en blanco.');
				document.getElementById("txt_carpetaadd").focus();
			} else if($("#lbl_perfilcaradd").val()==""){
				vacios+=1;
				alert('El campo Perfiles no puede quedar en blanco.');
				document.getElementById("lbl_perfilcaradd").focus();
			}
			if(vacios==0){
				valida=true;
			}		
			break;
		case 'car_edit':
			vacios=0;
			if(document.getElementById("txt_carpetaedit").value==""){
				vacios+=1;
				alert('El campo Nombre Carpeta no puede quedar en blanco.');
				document.getElementById("txt_carpetaedit").focus();
			} else if($("#lbl_perfilcaredit").val()==""){
				vacios+=1;
				alert('El campo Perfiles no puede quedar en blanco.');
				document.getElementById("lbl_perfilcaredit").focus();
			}
			if(vacios==0){
				valida=true;
			}		
			break;
		case 'doc_add':
			vacios=0;
			if(document.getElementById("txt_archivoadd").value==""){
				vacios+=1;
				alert('El campo Nombre Documento no puede quedar en blanco.');
				document.getElementById("txt_archivoadd").focus();
			} else if(document.getElementById("lbl_tipodocadd").value==""){
				vacios+=1;
				alert('El campo Tipo Documento no puede quedar en blanco.');
				document.getElementById("lbl_tipodocadd").focus();
			} else if(document.getElementById("lbl_tipodocadd").value=="1"){
				if(document.getElementById("txt_doc").value==""){
					vacios+=1;
					alert('El campo Documento no puede quedar en blanco.');
					document.getElementById("txt_doc").focus();
				}
			} else if(document.getElementById("lbl_tipodocadd").value=="2"){
				if(document.getElementById("txt_urldocadd").value==""){
					vacios+=1;
					alert('El campo Documento no puede quedar en blanco.');
					document.getElementById("txt_urldocadd").focus();
				}
			}
			if(vacios==0){
				valida=true;
			}		
			break;
		case 'doc_edit':
			vacios=0;
			if(document.getElementById("txt_archivoadd").value==""){
				vacios+=1;
				alert('El campo Nombre Documento no puede quedar en blanco.');
				document.getElementById("txt_archivoadd").focus();
			} else if(document.getElementById("lbl_tipodocadd").value==""){
				vacios+=1;
				alert('El campo Tipo Documento no puede quedar en blanco.');
				document.getElementById("lbl_tipodocadd").focus();
			} else if(document.getElementById("lbl_tipodocadd").value=="1"){
				if(document.getElementById("txt_documentoadd").value==""){
					vacios+=1;
					alert('El campo Documento no puede quedar en blanco.');
					document.getElementById("txt_doc").focus();
				}
			} else if(document.getElementById("lbl_tipodocadd").value=="2"){
				if(document.getElementById("txt_urldocadd").value==""){
					vacios+=1;
					alert('El campo Documento no puede quedar en blanco.');
					document.getElementById("txt_urldocadd").focus();
				}
			}
			if(vacios==0){
				valida=true;
			}		
			break;
		case 'tt_add':
			vacios=0;
			if(document.getElementById("txt_tareaadd").value==""){
				vacios+=1;
				alert('El campo Tarea no puede quedar en blanco.');
				document.getElementById("txt_tareaadd").focus();
			} else if(document.getElementById("rad_tarea_comadd2").checked==false && 
				document.getElementById("rad_tarea_comadd1").checked==false){
				vacios+=1;
				alert('El campo Es Comercial no puede quedar en blanco.');
				document.getElementById("rad_tarea_activoadd1").focus();
			} else if(document.getElementById("rad_tarea_activoadd2").checked==false && 
				document.getElementById("rad_tarea_activoadd1").checked==false){
				vacios+=1;
				alert('El campo Activo no puede quedar en blanco.');
				document.getElementById("rad_tarea_activoadd1").focus();
			}
			if(vacios==0){
				valida=true;
			}
			break;
		case 'tt_edit':
			vacios=0;
			if(document.getElementById("txt_tareaedit").value==""){
				vacios+=1;
				alert('El campo Tarea no puede quedar en blanco.');
				document.getElementById("txt_tareaedit").focus();
			} else if(document.getElementById("rad_tarea_comedit2").checked==false && 
				document.getElementById("rad_tarea_comedit1").checked==false){
				vacios+=1;
				alert('El campo Es Comercial no puede quedar en blanco.');
				document.getElementById("rad_tarea_activoedit1").focus();
			} else if(document.getElementById("rad_tarea_activoedit2").checked==false && 
				document.getElementById("rad_tarea_activoedit1").checked==false){
				vacios+=1;
				alert('El campo Activo no puede quedar en blanco.');
				document.getElementById("rad_tarea_activoedit1").focus();
			}
			if(vacios==0){
				valida=true;
			}
			break;
		case 'sol_add':
			vacios=0;
			if(document.getElementById("lblanio").value==""){
				vacios+=1;
				alert('El campo Años no puede quedar en blanco.');
				document.getElementById("lblanio").focus();
			} else if(document.getElementById("lblmes").value==""){
				vacios+=1;
				alert('El campo Meses no puede quedar en blanco.');
				document.getElementById("lblmes").focus();
			} else if(document.getElementById("lblcampana").value==""){
				vacios+=1;
				alert('El campo Campaña no puede quedar en blanco.');
				document.getElementById("lblcampana").focus();
			} else if(document.getElementById("lblregion").value==""){
				vacios+=1;
				alert('El campo Region no puede quedar en blanco.');
				document.getElementById("lblregion").focus();
			} else if(document.getElementById("lblciudad").value==""){
				vacios+=1;
				alert('El campo Ciudad no puede quedar en blanco.');
				document.getElementById("lblciudad").focus();
			} else if(document.getElementById("lbl_cadenaadd").value==""){
				vacios+=1;
				alert('El campo Cadena no puede quedar en blanco.');
				document.getElementById("lbl_cadenaadd").focus();
			} else if(document.getElementById("lbl_localadd1").value=="" && document.getElementById("nombrelocal").value=="" 
					&& document.getElementById("direccionlocal").value==""){
				vacios+=1;
				alert('El Local no puede quedar en blanco.');
				document.getElementById("lbl_localadd1").focus();
			} else if(document.getElementById("txt_asuntoadd").value==""){
				vacios+=1;
				alert('El campo Asunto no puede quedar en blanco.');
				document.getElementById("txt_asuntoadd").focus();
			} else if(document.getElementById("txt_comentarioadd").value==""){
				vacios+=1;
				alert('El campo Comentario no puede quedar en blanco.');
				document.getElementById("txt_comentarioadd").focus();
			} else if(document.getElementById("duplicados").value!=""){
				var arc=document.getElementById("duplicados").value;
				var ev=0;
				for(var i=0; i<arc; i++){
					if(document.getElementById("txt_archivosolicadd"+i).value==""){
						$("#txt_archivosolicadd"+i).parent().find("label").attr("class","btn btn-danger ");
						$("#txt_archivosolicadd"+i).parent().find("label i").attr("class","fa fa-times");
						ev+=1;
					} else {
						$("#txt_archivosolicadd"+i).parent().find("label").attr("class","btn btn-success");
						$("#txt_archivosolicadd"+i).parent().find("label i").attr("class","fa fa-check");
					}
					if(document.getElementById("txt_nomsoliadd"+i).value==""){
						document.getElementById("txt_nomsoliadd"+i).focus();
						ev+=1;
					} 
				}
				if(ev>0){
					vacios+=1;
					alert('Debe seleccionar por lo menos un archivo.');
				}
			} else {
				var ev=0;
				$("#modalsol input[name='checksolttadd[]']").each(function(){
					if(!$(this).is(':checked')){
						$(this).parent().attr("style","color:red");
						ev+=1;
					} else {
						$(this).parent().removeAttr("style");
					}
				});
				if($("#modalsol input[name='checksolttadd[]']").length==ev){
					vacios+=1;
					alert('Debe seleccionar por lo menos un tipo de tarea.');
				}
			}
			if(vacios==0){
				valida=true;
			}
			break;
		case 'solres_add':
			vacios=0;			
			if(document.getElementById("rad_res1").checked==false && document.getElementById("rad_res2").checked==false){
				vacios+=1;
				alert('Debe calificar la respuesta.');
				document.getElementById("rad_res1").focus();
			} else if(document.getElementById("rad_res2").checked==true &&  document.getElementById("txt_resadd").value==""){
				vacios+=1;
				alert('Selecciona la opción NO, por lo que debe argumentar su respuesta.');
				document.getElementById("txt_resadd").focus();
			} else
			if(vacios==0){
				valida=true;
			}
			break;
	}
	return valida;
}


function limpiar(form){
	switch(form){
		case 'login':
			document.getElementById("txt_nombreusuario").value="";
			document.getElementById("txt_correo").value="";
			break;
		case 'sol_add':
			$('#lblanio').val('').trigger('change');
			$('#lblmes').val('').trigger('change');
			$('#lblcampana').val('').trigger('change');
			$('#lblregion').val('').trigger('change');
			$('#lblciudad').val('').trigger('change');
			$('#lbl_cadenaadd').val('').trigger('change');
			$('#lbl_localadd').val('').trigger('change');
			$("#inputlocales").css("display","none");		
			$("#lbl_localadd").select2().next().show();
			document.getElementById("nombrelocal").value="";
			document.getElementById("direccionlocal").value="";
			document.getElementById("txt_asuntoadd").value="";
			document.getElementById("txt_comentarioadd").value="";
			document.getElementById("duplicados").value="1";
			var duplic='<div  class="col-md-12 row form-group file" >'+
		   '<div class="col-md-2">'+
		    '<label for="txt_archivosolicadd0" class="btn btn-theme "><i class="fa fa-upload"></i></label>'+
		    '<input type="file" style="display:none;" name="txt_archivosolicadd0" id="txt_archivosolicadd0" onchange="file(0)">'+
		    '</div>'+
		    '<div class="col-md-10">'+
		    '<input placeholder="Nombre Archivo" style="font-size: 0.7rem;" type="text" class="form-control" name="txt_nomsoliadd0" id="txt_nomsoliadd0">'+
		    '</div>'+
		    '</div>';
			$("#duplicar").html(duplic);
			$("#eliminar").hide();
			$("#modalsol input[name='checksolttadd[]']").each(function(){
				$(this).prop("checked",false);
			});
			break;
		case 'tt_add':
			document.getElementById("txt_tareaadd").value="";
			document.getElementById("rad_tarea_comadd2").checked=false;
			document.getElementById("rad_tarea_comadd1").checked=false;
			document.getElementById("rad_tarea_activoadd2").checked=false;
			document.getElementById("rad_tarea_activoadd1").checked=false;
			break;
		case 'm_add':
			document.getElementById("txt_motivoadd").value="";
			document.getElementById("txt_aliasadd").value="";
			if(document.body.contains(document.getElementById("txt_codigoadd"))){
				document.getElementById("txt_codigoadd").value="";
				document.getElementById("txt_responsableadd").value="";
			}
			document.getElementById("rad_mot_implementaadd2").checked=false; 
			document.getElementById("rad_mot_implementaadd1").checked=false;
			document.getElementById("rad_mot_exitosoadd2").checked=false; 
			document.getElementById("rad_mot_exitosoadd1").checked=false;
			document.getElementById("rad_mot_clienteadd2").checked=false;
			document.getElementById("rad_mot_clienteadd1").checked=false;
			document.getElementById("rad_mot_materialadd2").checked=false; 
			document.getElementById("rad_mot_materialadd1").checked=false;
			document.getElementById("rad_mot_activoadd2").checked=false; 
			document.getElementById("rad_mot_activoadd1").checked=false;
			break;
		case 'doc_add':
			document.getElementById("txt_archivoadd").value="";
			document.getElementById("lbl_tipodocadd").value="";
			document.getElementById("txt_urldocadd").value="";
			document.getElementById("txt_doc").value="";
			break;
		case 'car_add':
			document.getElementById("txt_carpetaadd").value="";	
			document.getElementById("lbl_perfilcaradd").value="";
			$('#lbl_perfilcaradd').multiSelect('deselect_all');	
			break;
		case 'mg_add':
			document.getElementById("txt_grupomotivoadd").value="";		
			break;
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
			if($("#txt_gerente_zonal").length>0){				
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
			}
			break;
		case 'e_add':
			document.getElementById("txt_empresaadd").value="";
			document.getElementById("txt_coloresadd1").value="#f57c00";
			$("#ttab1").removeAttr('style');
			$("#ttab1 th").removeAttr('style');
			document.getElementById("txt_coloresadd2").value="#E64A19";
			myChart1.data.datasets[0].backgroundColor="#E64A19";
			myChart1.update();
			document.getElementById("txt_coloresadd3").value="#F5BCA9";
			myChart1.data.datasets[1].backgroundColor="#F5BCA9";
			myChart1.update();
			$('#colores').hide();
			document.getElementById("txt_fondoadd").value="";
			$('#fondo').hide();
			document.getElementById("txt_logoadd").value="";
			$('#logo').hide();
			$('.dropify').val('').trigger('change');
			$('#chck_color').prop('checked',false);
			$('#chck_logo').prop('checked',false);
			$('#chck_fondo').prop('checked',false);
			var d=0;
			$("#modaladd input[name='checkbusadd[]']").each(function(){
				$(this).prop("checked", false);
				$("#posicionadd"+d).html('');
				d+=1;
			});
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
			document.getElementById("txt_nombreusuarioadd").value="";
			document.getElementById("txt_emailadd").value="";
			break;
		case 'p_add':
			document.getElementById("txt_perfiladd").value="";
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
		dataType:"json",
		success: function(data){
			var d=0;
			$("#modaledit input[name='checkbusedit[]']").each(function(){
				$(this).prop("checked", false);
				$("#posicionedit"+d).html('');
				d+=1;
			});
			document.getElementById("txt_empresaedit").value=data[0].empresa;
			if(data[0].activar_colores===1){
				document.getElementById("chck_color1").checked=true;
				if(data[0].color_principal!==null){
					document.getElementById("txt_coloresedit1").value=data[0].color_principal;
					$("#ttab2").css("border","2px solid "+data[0].color_principal);
					$("#ttab2 th").css("background-color",data[0].color_principal);
				}  else {
					$("#ttab2").removeAttr("style");
					$("#ttab2 th").removeAttr("style");
				}
				if(data[0].color_grafico_1!==null){
					document.getElementById("txt_coloresedit2").value=data[0].color_grafico_1;
					myChart2.data.datasets[0].backgroundColor=data[0].color_grafico_1;
				}  else {
					myChart2.data.datasets[0].backgroundColor="#E64A19";
				}	
				myChart2.update();			
				if(data[0].color_grafico_2!==null){
					document.getElementById("txt_coloresedit3").value=data[0].color_grafico_2;
					myChart2.data.datasets[1].backgroundColor=data[0].color_grafico_2;					
				} else {
					myChart2.data.datasets[1].backgroundColor="#F5BCA9";
				}
				myChart2.update();			
				$('#colores1').show();
			} else{
				document.getElementById("chck_color1").checked=false;
				$("#ttab2").removeAttr("style");
				$("#ttab2 th").removeAttr("style");
				document.getElementById("txt_coloresedit1").value="#f57c00";
				document.getElementById("txt_coloresedit2").value="#E64A19";
				document.getElementById("txt_coloresedit3").value="#F5BCA9";
				myChart2.data.datasets[0].backgroundColor="#E64A19";
				myChart2.data.datasets[1].backgroundColor="#F5BCA9";
				myChart2.update();
				$('#colores1').hide();
			}
			var logo=$('#txt_logoedit').dropify();
			logo=logo.data('dropify');
			logo.resetPreview();
			logo.clearElement();
			if(data[0].activar_logo===1){
				document.getElementById("chck_logo1").checked=true;
				document.getElementById("txt_logo").value=data[0].imagen_logo;			
				if(data[0].imagen_logo!==null){
					logo.settings.defaultFile = 'http://masterplan.grupoprogestion.com/masterplan/archivos/logos/'+data[0].imagen_logo;				
				} else{
					logo.settings.defaultFile = '';
				}
				$('#logo1').show();
			} else {
				document.getElementById("chck_logo1").checked=false;
				logo.settings.defaultFile = '';
				document.getElementById("txt_logo").value="";
				$('#logo1').hide();
			}
			logo.destroy();
			logo.init();
			var fondo=$('#txt_fondoedit').dropify();
			fondo=fondo.data('dropify');	
			fondo.resetPreview();
			fondo.clearElement();
			if(data[0].activar_fondo===1){
				document.getElementById("chck_fondo1").checked=true;
				document.getElementById("txt_fondo").value=data[0].imagen_fondo;		
				if(data.imagen_fondo!==null){				
					fondo.settings.defaultFile = 'http://masterplan.grupoprogestion.com/masterplan/archivos/fondos/'+data[0].imagen_fondo;				
				} else{
					fondo.settings.defaultFile = '';
				}
				$('#fondo1').show();
			} else {
				document.getElementById("chck_fondo1").checked=false;
				fondo.settings.defaultFile = '';
				document.getElementById("txt_fondo").value="";
				$('#fondo1').hide();
			}
			fondo.destroy();
			fondo.init();
			var div=0;
			$("#modaledit input[name='checkbusedit[]']").each(function(){
				for(var i=0; i< data.length; i++){
					if($(this).val()==data[i].nombre_filtro){
						$(this).prop("checked", true);
						var orden="<div class='form-group'>";
						orden+="<input  type='number' name='txt_posicionedit[]' id='txt_posicionedit"+div+"' ";
						orden+=" class='form-control texto' value='"+data[i].orden_filtro+"' placeholder='Posición búsqueda' ></div>";
						$(this).parent().parent().find("div").html(orden);
					}
				}
				div+=1;
			});
			$(".dropify-message span").removeAttr("class").html('<div class="ecom-widget-sales"><div class="ecom-sales-icon text-center"><i class="mdi mdi-image-area"></i></div></div>');
			$(".dropify-message p").html('<h6 class="text-theme"><small style="font-size:70%;">Extensiones: jpg, png, jpeg<small></h6>');
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


function motivos(id){
	$.ajax({
		url:"http://masterplan.grupoprogestion.com/masterplan/empresas/grupomotivos",
		type: "POST",
		data: "id="+id,
		success: function(data){
			window.location.href='http://masterplan.grupoprogestion.com/masterplan/grupos_motivos/motivos';
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

function tareas(id){
	$.ajax({
		url:"http://masterplan.grupoprogestion.com/masterplan/empresas/campanas",
		type: "POST",
		data: "id="+id,
		success: function(data){
			window.location.href='http://masterplan.grupoprogestion.com/masterplan/tareas/tarea';
		}
	});
}

function solicitudes(id){
	$.ajax({
		url:"http://masterplan.grupoprogestion.com/masterplan/empresas/acciones",
		type: "POST",
		data: "id="+id,
		success: function(data){
			window.location.href='http://masterplan.grupoprogestion.com/masterplan/solicitudes_ot';
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
			document.getElementById("txt_nombreusuarioedit").value=data.nombre;
			document.getElementById("txt_emailedit").value=data.email;
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

function solicitud(id){
	$.ajax({
		url:"http://masterplan.grupoprogestion.com/masterplan/solicitudes_ot/solicitud",
		type: "POST",
		data: "id="+id,
		dataType:"json",
		success: function(data){
			$("#modaldetsol .modal-title").html(data.titulo);		
			$("#modaldetsol .modal-body").html(data.cuerpo);
		}
	});
}

function editar(){
	$("#respuesta").hide(500);
	$("#editarrespuesta").show(500);
}

function back(){
	$("#editarrespuesta").hide(500);
	$("#respuesta").show(500);
}

function solicitudcoordinador(id){
	$.ajax({
		url:"http://masterplan.grupoprogestion.com/masterplan/solicitudes_ot/solicitudcoordinador",
		type: "POST",
		data: "id="+id,
		dataType:"json",
		success: function(data){
			$("#modaldetsol1 .modal-title").html(data.titulo);
			$("#modaldetsol1 .modal-body").html(data.cuerpo);
		}
	});
}

function file(id){
	if($("#txt_archivosolicadd"+id).val()==""){
		$("#txt_archivosolicadd"+id).parent().find("label").attr("class","btn btn-danger ");
		$("#txt_archivosolicadd"+id).parent().find("label i").attr("class","fa fa-times");
	} else {
		$("#txt_archivosolicadd"+id).parent().find("label").attr("class","btn btn-success ");
		$("#txt_archivosolicadd"+id).parent().find("label i").attr("class","fa fa-check");
		if($("#txt_filesubmit"+id).val()!=""){
			$("#txt_filesubmit"+id).val($("#txt_solicitudidadd").val());
		}	
	}
}

function agregararchcoor(){
	var d=parseInt($("#duplicados").val());
	if(d>0){
		var duplic='<div  class="col-md-12 row form-group file" style="padding-right:0px;"><div class="col-md-2" style="margin-top:0.3rem;">';
			duplic+='<label for="txt_archivosolicadd'+d+'" class="btn btn-theme "><i class="fa fa-upload"></i></label>';
			duplic+='<input type="file" style="display:none;" name="txt_archivosolicadd'+d+'" id="txt_archivosolicadd'+d+'" onchange="file('+d+')">';
			duplic+='</div>'; 
			duplic+='<div class="col-md-10 " style="padding-left:20px !important; padding-left:0px;"><input placeholder="Nombre Archivo" style="font-size: 0.7rem;" type="text" class="form-control" name="txt_nomsoliadd'+d+'" id="txt_nomsoliadd'+d+'">';
			duplic+='</div></div>';
		$("#duplicar").append(duplic);
		$("#eliminar").show();
		d+=1;
		$("#duplicados").val(d);
	}	
}


function agregararch(){
	var d=parseInt($("#duplicados").val());
	if(d>0){
		var duplic='<div  class="col-md-12 row form-group file" >'+
		   '<div class="col-md-2">'+
		    '<label for="txt_archivosolicadd'+d+'" class="btn btn-theme "><i class="fa fa-upload"></i></label>'+
		    '<input type="file" style="display:none;" name="txt_archivosolicadd'+d+'" id="txt_archivosolicadd'+d+'" onchange="file('+d+')">'+
		    '</div>'+
		    '<div class="col-md-10">'+
		    '<input placeholder="Nombre Archivo" style="font-size: 0.7rem;" type="text" class="form-control" name="txt_nomsoliadd'+d+'" id="txt_nomsoliadd'+d+'">'+
		    '</div>'+
		    '</div>';
		$("#duplicar").append(duplic);
		$("#eliminar").show();
		d+=1;
		$("#duplicados").val(d);
	}	
}


function eliminararch(){
	var d=parseInt($("#duplicados").val());
	if(d>0){
		$("#duplicar .file:last").remove();
		d-=1;
		// if($("#txt_filesubmit"+d).length>0){
		// 	$("#eliminar").hide();
		// } else {
			if(d==1){
				$("#eliminar").hide();
			}
		// }
		$("#duplicados").val(d);
	}
}

function addrespuesta(){
	var vacios=0;
	$("#btnguardar").prop('disabled', true);
	var archivos=parseInt(document.getElementById("duplicados").value);
	if(document.getElementById("lbl_estado").value==""){
		vacios+=1;
		document.getElementById("lbl_estado").focus();
	} else {
		if(document.getElementById("lbl_estado").value==2){
			var av=0;			
			for(var i=0; i<archivos; i++){
				if($("#txt_filesubmit"+i).length>0){
					if(document.getElementById("txt_filesubmit"+i).value==""){
						av+=1;
						document.getElementById("txt_filesubmit"+i).focus();
					}
				} else{ 
					if(document.getElementById("txt_archivosolicadd"+i).value==""){
						av+=1;
						document.getElementById("txt_archivosolicadd"+i).focus();
					}
					if(document.getElementById("txt_nomsoliadd"+i).value==""){
						av+=1;
						document.getElementById("txt_nomsoliadd"+i).focus();
					}
				}
			}
			if(archivos==av){
				vacios+=1;
			}
		} else if(document.getElementById("lbl_estado").value==3){
			if(document.getElementById("txt_fechaestimada").value==""){
				vacios+=1;
				document.getElementById("txt_fechaestimada").focus();
			}
			
		} else if(document.getElementById("lbl_estado").value==4 || document.getElementById("lbl_estado").value==5){
			if(document.getElementById("txt_resadd").value==""){
				vacios+=1;
				document.getElementById("txt_resadd").focus();
			}
			
		}
	}
	if(vacios==0){
		var data=new FormData();
		data.append('lbl_estado',document.getElementById("lbl_estado").value);
		data.append('txt_solicitudidadd',document.getElementById("txt_solicitudidadd").value);
		data.append('txt_fechaestimada',document.getElementById("txt_fechaestimada").value);
		data.append('txt_resadd',document.getElementById("txt_resadd").value);
		data.append('totalarchivo',archivos);
		for(var i=0; i<archivos; i++){
			if(document.getElementById("txt_nomsoliadd"+i).value!=""){
				if($("#txt_filesubmit"+i).length>0){
					data.append('txt_filesubmit'+i,$("#txt_filesubmit"+i).val());
					if($("#txt_archivosolicadd"+i).val()!=""){
						data.append('txt_archivosolicadd'+i,$("#txt_archivosolicadd"+i)[0].files[0]);
					}
				} else {
					data.append('txt_archivosolicadd'+i,$("#txt_archivosolicadd"+i)[0].files[0]);
				}
			}
			data.append('txt_nomsoliadd'+i,document.getElementById("txt_nomsoliadd"+i).value);
		}	
		$.ajax({
			url:"http://masterplan.grupoprogestion.com/masterplan/solicitudes_ot/addrespcoordinador",
			type: "POST",
			data: data,
			contentType:false,
			processData:false,
			success: function(data){
				alert(data);
				$("#btnguardar").prop('disabled', false);
				filtrar();
			}
		});
	} else {
		alert("Existen campos vacíos en el formulario, por favor revise e intente nuevamente");
	}
}

function enviarmensaje(){
	var msje=document.getElementById("txt_mensajechat").value;
	var id=document.getElementById("txt_idsolicitudchat").value;
	if(msje!=""){
		$.ajax({
			url:"http://masterplan.grupoprogestion.com/masterplan/solicitudes_ot/addmensaje",
			type: "POST",
			data: "mensaje="+msje+"&id="+id,
			success: function(data){
				$("#chatsol").html(data);
				document.getElementById("txt_mensajechat").value="";
			}
		});
	}
}

function chat(id){
	$.ajax({
		url:"http://masterplan.grupoprogestion.com/masterplan/solicitudes_ot/mensajes",
		type: "POST",
		data: "id="+id,
		success: function(data){
			document.getElementById("txt_idsolicitudchat").value=id;
			$("#chatsol").html(data);
		}
	});
}

function mensajesvisto(id){
	var id=document.getElementById("txt_idsolicitudchat").value;
	$.ajax({
		url:"http://http://masterplan.grupoprogestion.com/masterplan/solicitudes_ot/addvisto",
		type: "POST",
		data: "id="+id,
		success: function(data){
			$("#chatsol").html(data);
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

function galeria_anios(id){
	// alert(id);
	$.ajax({
		url:"http://masterplan.grupoprogestion.com/masterplan/campanas/anios",
		type: "POST",
		data: "anio="+id,
		success: function(data){
			window.location.href='http://masterplan.grupoprogestion.com/masterplan/galerias/campanas';
		}
	});
}

function cadena(id){
	$.ajax({
		url:"http://masterplan.grupoprogestion.com/masterplan/empresas/cadena",
		type: "POST",
		data: "id="+id,
		success: function(data){
			window.location.href='http://masterplan.grupoprogestion.com/masterplan/galerias/cadenas';
		}
	});
}

function fotos(id){
	$.ajax({
		url:"http://masterplan.grupoprogestion.com/masterplan/empresas/galeria",
		type: "POST",
		data: "id="+id,
		success: function(data){
			window.location.href='http://masterplan.grupoprogestion.com/masterplan/galerias/fotos';
		}
	})
}

function biblio(id){
	$.ajax({
		url:"http://masterplan.grupoprogestion.com/masterplan/empresas/acciones",
		type: "POST",
		data: "id="+id,
		success: function(data){
			window.location.href='http://masterplan.grupoprogestion.com/masterplan/informes/biblioteca';
		}
	});
}

function carpeta(id){
	$.ajax({
		url:"http://masterplan.grupoprogestion.com/masterplan/informes/carpeta",
		type: "POST",
		data: "id="+id,
		dataType:"json",
		success: function(data){
			document.getElementById("txt_carpetaedit").value=data[0].nombre_carpeta;
			
			$('#lbl_perfilcaredit').multiSelect('deselect_all');
			var perfiles=new Array();
			for (var i = 0; i < data.length; i++) {
				perfiles[i]=data[i].id_perfil;
			}
			$('#lbl_perfilcaredit').multiSelect('select', perfiles);
			document.getElementById("txt_carpetaid").value=id;
		}
	});
}

function tarea(id){
	$.ajax({
		url:"http://masterplan.grupoprogestion.com/masterplan/tareas/tareaview",
		type: "POST",
		data: "id="+id,
		dataType:"json",
		success: function(data){
			document.getElementById("txt_tareaedit").value=data.tipotarea;	
			if(data.es_comercial==1){
				document.getElementById("rad_tarea_comedit1").checked=true;
				document.getElementById("rad_tarea_comedit2").checked=false;
			} else {
				document.getElementById("rad_tarea_comedit1").checked=false;
				document.getElementById("rad_tarea_comedit2").checked=true;
			}
			if(data.activo==1){
				document.getElementById("rad_tarea_activoedit1").checked=true;
				document.getElementById("rad_tarea_activoedit2").checked=false;
			} else {
				document.getElementById("rad_tarea_activoedit1").checked=false;
				document.getElementById("rad_tarea_activoedit2").checked=true;
			}
			document.getElementById("txt_tareaid").value=id;		
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
			$("#modaleditp input[name='txt_modulos[]']").each(function(){
				for (var i = 0; i < data.length; i++) {
					if($(this).val()==data[i].level){
						if(data[i].permiso>0){
							if(data[i].permiso==8){
								$(this).parent().parent().find("[id*=chck_view1]").prop("checked",true);
								$(this).parent().parent().find("[id*=chck_add1]").prop("checked",false);
								$(this).parent().parent().find("[id*=chck_edit1]").prop("checked",false);
								$(this).parent().parent().find("[id*=chck_delete1]").prop("checked",false);
							} else if(data[i].permiso>8){
								var p=data[i].permiso-8;
								$(this).parent().parent().find("[id*=chck_view1]").prop("checked",true);
								if(p==7){									
									$(this).parent().parent().find("[id*=chck_add1]").prop("checked",true);
									$(this).parent().parent().find("[id*=chck_edit1]").prop("checked",true);
									$(this).parent().parent().find("[id*=chck_delete1]").prop("checked",true);
								} else if(p==6){
									$(this).parent().parent().find("[id*=chck_add1]").prop("checked",false);
									$(this).parent().parent().find("[id*=chck_edit1]").prop("checked",true);
									$(this).parent().parent().find("[id*=chck_delete1]").prop("checked",true);
								} else if(p==5){
									$(this).parent().parent().find("[id*=chck_add1]").prop("checked",true);
									$(this).parent().parent().find("[id*=chck_edit1]").prop("checked",true);
									$(this).parent().parent().find("[id*=chck_delete1]").prop("checked",false);
								} else if(p==4){
									$(this).parent().parent().find("[id*=chck_add1]").prop("checked",false);
									$(this).parent().parent().find("[id*=chck_edit1]").prop("checked",true);
									$(this).parent().parent().find("[id*=chck_delete1]").prop("checked",false);
								} else if(p==3){
									$(this).parent().parent().find("[id*=chck_add1]").prop("checked",true);
									$(this).parent().parent().find("[id*=chck_edit1]").prop("checked",false);
									$(this).parent().parent().find("[id*=chck_delete1]").prop("checked",true);
								} else if(p==2){
									$(this).parent().parent().find("[id*=chck_add1]").prop("checked",false);
									$(this).parent().parent().find("[id*=chck_edit1]").prop("checked",false);
									$(this).parent().parent().find("[id*=chck_delete1]").prop("checked",true);
								} else if(p==1){
									$(this).parent().parent().find("[id*=chck_add1]").prop("checked",true);
									$(this).parent().parent().find("[id*=chck_edit1]").prop("checked",false);
									$(this).parent().parent().find("[id*=chck_delete1]").prop("checked",false);
								}								
							} else if(data[i].permiso<8){
								if(p==7){									
									$(this).parent().parent().find("[id*=chck_add1]").prop("checked",true);
									$(this).parent().parent().find("[id*=chck_edit1]").prop("checked",true);
									$(this).parent().parent().find("[id*=chck_delete1]").prop("checked",true);
								} else if(p==6){
									$(this).parent().parent().find("[id*=chck_add1]").prop("checked",false);
									$(this).parent().parent().find("[id*=chck_edit1]").prop("checked",true);
									$(this).parent().parent().find("[id*=chck_delete1]").prop("checked",true);
								} else if(p==5){
									$(this).parent().parent().find("[id*=chck_add1]").prop("checked",true);
									$(this).parent().parent().find("[id*=chck_edit1]").prop("checked",true);
									$(this).parent().parent().find("[id*=chck_delete1]").prop("checked",false);
								} else if(p==4){
									$(this).parent().parent().find("[id*=chck_add1]").prop("checked",false);
									$(this).parent().parent().find("[id*=chck_edit1]").prop("checked",true);
									$(this).parent().parent().find("[id*=chck_delete1]").prop("checked",false);
								} else if(p==3){
									$(this).parent().parent().find("[id*=chck_add1]").prop("checked",true);
									$(this).parent().parent().find("[id*=chck_edit1]").prop("checked",false);
									$(this).parent().parent().find("[id*=chck_delete1]").prop("checked",true);
								} else if(p==2){
									$(this).parent().parent().find("[id*=chck_add1]").prop("checked",false);
									$(this).parent().parent().find("[id*=chck_edit1]").prop("checked",false);
									$(this).parent().parent().find("[id*=chck_delete1]").prop("checked",true);
								} else if(p==1){
									$(this).parent().parent().find("[id*=chck_add1]").prop("checked",true);
									$(this).parent().parent().find("[id*=chck_edit1]").prop("checked",false);
									$(this).parent().parent().find("[id*=chck_delete1]").prop("checked",false);
								}
							}
						} else {
							$(this).parent().parent().find("[id*=chck_view1]").prop("checked",false);
							$(this).parent().parent().find("[id*=chck_add1]").prop("checked",false);
							$(this).parent().parent().find("[id*=chck_edit1]").prop("checked",false);
							$(this).parent().parent().find("[id*=chck_delete1]").prop("checked",false);
						}
					}
				}
			});			
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

function grupo(id){
	$.ajax({
		url:"http://masterplan.grupoprogestion.com/masterplan/grupos_motivos/grupomotivo",
		type: "POST",
		data: "id="+id,
		dataType:"json",
		success: function(data){
			document.getElementById("txt_grupomotivoedit").value=data.grupo_motivos;
			document.getElementById("txt_grupomotivoid").value=id;
		}
	});
}

function motivo(id){
	$.ajax({
		url:"http://masterplan.grupoprogestion.com/masterplan/grupos_motivos/motivo",
		type: "POST",
		data: "id="+id,
		dataType:"json",
		success: function(data){
			document.getElementById("txt_motivoedit").value=data.motivo;
			document.getElementById("txt_aliasedit").value=data.alias;
			if(document.body.contains(document.getElementById("txt_codigoedit"))){
				document.getElementById("txt_codigoedit").value=data.cod_motivo;
				document.getElementById("txt_responsableedit").value=data.responsable;
			}
			if(data.no_implementa==1){
				document.getElementById("rad_mot_implementaedit1").checked=true;
				document.getElementById("rad_mot_implementaedit2").checked=false;
			} else {
				document.getElementById("rad_mot_implementaedit1").checked=false;
				document.getElementById("rad_mot_implementaedit2").checked=true;
			}
			if(data.exitoso==1){
				document.getElementById("rad_mot_exitosoedit1").checked=true;
				document.getElementById("rad_mot_exitosoedit2").checked=false;
			} else {
				document.getElementById("rad_mot_exitosoedit1").checked=false;
				document.getElementById("rad_mot_exitosoedit2").checked=true;
			}	
			if(data.en_cliente==1){
				document.getElementById("rad_mot_clienteedit1").checked=true;
				document.getElementById("rad_mot_clienteedit2").checked=false;
			} else {
				document.getElementById("rad_mot_clienteedit1").checked=false;
				document.getElementById("rad_mot_clienteedit2").checked=true;
			}
			if(data.en_material==1){
				document.getElementById("rad_mot_materialedit1").checked=true;
				document.getElementById("rad_mot_materialedit2").checked=false;
			} else {
				document.getElementById("rad_mot_materialedit1").checked=false;
				document.getElementById("rad_mot_materialedit2").checked=true;
			}
			if(data.activo==1){
				document.getElementById("rad_mot_activoedit1").checked=true;
				document.getElementById("rad_mot_activoedit2").checked=false;
			} else {
				document.getElementById("rad_mot_activoedit1").checked=false;
				document.getElementById("rad_mot_activoedit2").checked=true;
			}		
			document.getElementById("txt_motivoid").value=id;
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
			var porc= isNaN(((data.q_implementados/data.q_puntos)*100)) ? 0 : ((data.q_implementados/data.q_puntos)*100).toFixed(2);
			var info="<strong>"+porc+"%</strong>";
			info+="<small class='pull-right'>Porcentaje Implementado</small>";
			info+="<div class='progress xs'><div class='progress-bar bg-theme' style='width:"+porc+"%;' role='progessbar' aria-valuenow='"+data.porcentaje+"' aria-valuemin='0' aria-valuemax='100'></div></div>";
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
	var checkbox1 = document.getElementById("chck_master1");
    var checkbox2 = document.getElementById("chck_master2");
    if(checkbox1.checked==true || checkbox2.checked==true){
		if(document.getElementById("ex_master").value!=""){
			var allowedExtensions = /(.xlsx|.xls)$/i;
	    	if(allowedExtensions.exec(document.getElementById("ex_master").value)){
				document.getElementById("form1").submit();
			} else {
				document.getElementById("ex_master").value="";
			    alert("El archivo ingresado tiene una extensión no permitida, inténtelo nuevamente.");
			}
		}
	} else {
		alert("Debe seleccionar una de las opciones. (INGRESAR MASTER o EDITAR MASTER)");
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


function validarEmail(valor) {
	re=/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/i;
	if(!re.exec(valor)){
		return false;
	}else{ 
		return true;
	}
}








