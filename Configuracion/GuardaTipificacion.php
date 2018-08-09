<link href="../css/Estilo.css" rel="stylesheet" type="text/css"/>
<?php
	include('../ScreenCatalogo_Seguridad.php');
	include('../Conexion_Abrir.php');
	$Descripcion = $_POST['txtNombre'];
	$mensaje     = "";
	if($Descripcion==""){
		$mensaje = '<br/><div class="error-box round">'."Campo Obligatorio: Descripcion</div>";
	}else{
		$sqlx = "SELECT ID FROM tipificacion WHERE DESCRIPCION LIKE '%".$Descripcion."%'";
		$rsx  = mysql_query($sqlx,$conexion);
		if(mysql_num_rows($rsx)!=0){
			$mensaje = '<br/><div class="error-box round">Existe un Campo Similar a '.$Descripcion.'</div>';
		}else{
			$sql = "INSERT INTO tipificacion (DESCRIPCION) VALUES ('".$Descripcion."')";
			mysql_query($sql,$conexion);
			$mensaje = '<br/><div class="information-box round">'."Registros Guardados Correctamente</div>";
		}
	}
	echo $mensaje;

?>