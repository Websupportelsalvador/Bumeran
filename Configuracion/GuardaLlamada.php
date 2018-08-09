<link href="../css/Estilo.css" rel="stylesheet" type="text/css"/>
<?php
	include('../ScreenCatalogo_Seguridad.php');
	include('../Conexion_Abrir.php');
	date_default_timezone_set('America/Mexico_City');
	$fecha			= date("Y-m-d H:i:s");
	$txtRut			= $_POST['txtRut'];
	$txtObservacion	= $_POST['txtObservacion'];
	$txtDatos		= $_POST['txtDatos'];
	$Tipificacion	= $_POST['Tipificacion'];
	$txtId			= $_POST['txtId'];
	$idEjecutivo    = $_SESSION['USERCORE'];
	$mensaje        = "";
	if($txtId==""){
		$mensaje = '<br/><div class="error-box round">'."Campos Vacios</div>";
	}elseif($txtRut==""){
		$mensaje = '<br/><div class="error-box round">'."Campo Obligatorio: Rut</div>";
	}elseif($txtDatos==""){
		$mensaje = '<br/><div class="error-box round">'."Campo Obligatorio: Datos de Cierre</div>";
	}elseif($Tipificacion==""){
		$mensaje = '<br/><div class="error-box round">'."Campo Obligatorio: Tipificacion</div>";
	}else{
	
	/*insertamos log de llamadas*/
	$sqlx = "SELECT ID FROM log_llamadas WHERE RUT='".$txtRut."' LIMIT 1";
	$rsx  = mysql_query($sqlx,$conexion);
	if(mysql_num_rows($rsx)!=0){
		$mensaje = '<br/><div class="error-box round">'."Error: Ya Existe un Registro con la misma Informacion</div>";
	}else{
		$sql = "INSERT INTO log_llamadas (FECHA,RUT,OBSERVACIONES,DATOSCIERRE,ID_TIPIFICACION,ID_CLIENTE,";
		$sql = $sql."ID_EJECUTIVO) VALUES ('".$fecha."','".$txtRut."','".$txtObservacion."',";
		$sql = $sql."'".$txtDatos."','".$Tipificacion."','".$txtId."','".$idEjecutivo."')";
		mysql_query($sql,$conexion);
		$mensaje = '<br/><div class="information-box round">'."Registros Guardados Correctamente</div>";
	}
	}
	echo $mensaje;
	
?>