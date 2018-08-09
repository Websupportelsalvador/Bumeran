<link href="../css/Estilo.css" rel="stylesheet" type="text/css"/>
<?php
	include('../ScreenCatalogo_Seguridad.php');
	include('../Conexion_Abrir.php');
	$txtNombre   = strtoupper(trim($_POST['txtNombre']));
	$txtApellidos= strtoupper(trim($_POST['txtApellidos']));
	$txtRut		 = strtoupper(trim($_POST['txtRut']));
	$txtDireccion= strtoupper(trim($_POST['txtDireccion']));
	$TipoUsuario = strtoupper(trim($_POST['TipoUsuario']));
	$mensaje     = "";
	if($txtNombre==""){
		$mensaje = '<br/><div class="error-box round">'."Campo Obligatorio: Nombre</div>";
	}elseif($txtApellidos==""){
		$mensaje = '<br/><div class="error-box round">'."Campo Obligatorio: Apellidos</div>";
	}elseif($txtRut==""){
		$mensaje = '<br/><div class="error-box round">'."Campo Obligatorio: Rut</div>";
	}elseif($txtDireccion==""){
		$mensaje = '<br/><div class="error-box round">'."Campo Obligatorio: Direccion</div>";
	}else{
		
		$sqlx = "SELECT ID FROM usuarios WHERE RUT='".$txtRut."'";
		$rsx  = mysql_query($sqlx,$conexion);
		if(mysql_num_rows($rsx)!=0){
			$mensaje = '<br/><div class="error-box round">'."Error: Rut En uso</div>";
		}else{
			$sql = "INSERT INTO usuarios(NOMBRE,APELLIDOS,RUT,DIRECCION,USUARIO,PASSWORD,TIPO_USUARIO) VALUES ('".$txtNombre."','".$txtApellidos."','".$txtRut."',";
			$sql = $sql."'".$txtDireccion."','".$txtRut."','".$txtRut."','".$TipoUsuario."')";
			mysql_query($sql,$conexion);
			$mensaje = '<br/><div class="information-box round">'."Registros Guardados Correctamente</div>";
		}
		
	}
	echo $mensaje;
	


?>