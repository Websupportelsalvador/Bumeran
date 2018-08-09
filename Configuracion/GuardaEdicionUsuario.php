<link href="../css/Estilo.css" rel="stylesheet" type="text/css"/>
<?php
	include('../ScreenCatalogo_Seguridad.php');
	include('../Conexion_Abrir.php');
	$txtNombre   = strtoupper(trim($_POST['txtNombre']));
	$txtApellidos= strtoupper(trim($_POST['txtApellidos']));
	$txtRut		 = strtoupper(trim($_POST['txtRut']));
	$txtDireccion= strtoupper(trim($_POST['txtDireccion']));
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
			
			$sql = "UPDATE usuarios SET NOMBRE='".$txtNombre."', APELLIDOS='".$txtApellidos."', ";
			$sql = $sql."DIRECCION='".$txtDireccion."' WHERE ID='".$_SESSION['USERCORE']."' ";
			mysql_query($sql,$conexion);
			$mensaje = '<br/><div class="information-box round">'."Registros Guardados Correctamente</div>";		
	}
	echo $mensaje;
	


?>