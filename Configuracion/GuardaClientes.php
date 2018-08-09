<link href="../css/Estilo.css" rel="stylesheet" type="text/css"/>

<?php
	date_default_timezone_set('America/Mexico_City');
	include('../ScreenCatalogo_Seguridad.php');
	include('../Conexion_Abrir.php');
	$txtNombre   = strtoupper($_POST['txtNombre']);
	$txtApellidos= strtoupper($_POST['txtApellidos']);
	$txtRut		 = strtoupper($_POST['txtRut']);
	$txtDireccion= strtoupper($_POST['txtDireccion']);
	$plan 		 = strtoupper($_POST['plan']);
	$txtTelefono = $_POST['txtTelefono'];
	$Fecha_Plan	 = date("Y-m-d H:i:s");
	$mensaje     = "";
	if($txtNombre==""){
		$mensaje = '<br/><div class="error-box round">'."Campo Obligatorio: Nombre</div>";
	}elseif($txtApellidos==""){
		$mensaje = '<br/><div class="error-box round">'."Campo Obligatorio: Apellidos</div>";
	}elseif($txtRut==""){
		$mensaje = '<br/><div class="error-box round">'."Campo Obligatorio: Rut</div>";
	}elseif($txtDireccion==""){
		$mensaje = '<br/><div class="error-box round">'."Campo Obligatorio: Direccion</div>";
	}elseif($plan==0){
		$mensaje = '<br/><div class="error-box round">'."Campo Obligatorio: Plan</div>";
	}elseif($txtTelefono==""){
		$mensaje = '<br/><div class="error-box round">'."Campo Obligatorio: Telefono</div>";
	}else{
		$sqlx = "SELECT ID FROM clientes WHERE RUT='".$txtRut."'";
		$rsx  = mysql_query($sqlx,$conexion);
		if(mysql_num_rows($rsx)!=0){
			$mensaje = '<br/><div class="error-box round">'."Error: Rut En uso</div>";
		}else{
			
			$sqls 	= "INSERT INTO plan_clientes(NOMBRE_PLAN,FECHA_ACTIVACION,TELEFONO) VALUES ('".$plan."','".$Fecha_Plan."','".$txtTelefono."')";
			mysql_query($sqls,$conexion);
			$IdPlan = mysql_insert_id();
			
			$sql 	= "INSERT INTO clientes (NOMBRE,APELLIDOS,RUT,DIRECCION,TELEFONO,FECHA_REGISTRO,ID_PLAN) VALUES ('".$txtNombre."','".$txtApellidos."','".$txtRut."','".$txtDireccion."',";
			$sql 	= $sql."'".$txtTelefono."','".$Fecha_Plan."','".$IdPlan."')";
			mysql_query($sql,$conexion);
			$mensaje = '<br/><div class="information-box round">'."Registros Guardados Correctamente</div>";
		}
	}
	echo $mensaje;

?>