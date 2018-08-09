<link href="../css/Estilo.css" rel="stylesheet" type="text/css"/>
<?php
	include('../ScreenCatalogo_Seguridad.php');
	include('../Conexion_Abrir.php');
	$txtNombre  = strtoupper(trim($_POST['txtNombre']));
	$txtCosto	= strtoupper(trim($_POST['txtCosto']));
	$mensaje    = "";
	if($txtNombre==""){
		$mensaje = '<br/><div class="error-box round">'."Campo Obligatorio: Nombre</div>";
	}elseif($txtCosto==""){
		$mensaje = '<br/><div class="error-box round">'."Campo Obligatorio: Costo</div>";
	}elseif(is_numeric($txtCosto)){
		$sql     = "SELECT  ID FROM planes WHERE DESCRIPCION LIKE '%".$txtNombre."%'";
		$rs      = mysql_query($sql,$conexion);
		if(mysql_num_rows($rs)!=0){
			$mensaje = '<br/><div class="error-box round">Existe un Registro similar</div>';
		}else{
			$sql 	 = "INSERT INTO planes(DESCRIPCION,COSTO) VALUES ('".$txtNombre."','".$txtCosto."')";
			mysql_query($sql,$conexion);
			$mensaje = '<br/><div class="information-box round">'."Registros Guardados Correctamente</div>";
		}
	}else{
		$mensaje = '<br/><div class="error-box round">'."Campo Costo debe de ser Numerico</div>";
	}
	echo $mensaje;
?>