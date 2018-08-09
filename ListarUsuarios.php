<link href="css/Estilo.css" rel="stylesheet" type="text/css"/>	
<?php
	include('ScreenCatalogo_Seguridad.php');
	include('Conexion_Abrir.php');
	include('DataExtra.php');
	$estatus = PermisosUsuario($_SESSION['USERCORE'],10,$conexion);
	$permiso = PermisosUsuario($_SESSION['USERCORE'],11,$conexion);
	$password= PermisosUsuario($_SESSION['USERCORE'],12,$conexion);
	if($estatus==0){
		echo '<br/><div class="error-box round">Error: No Tiene Permisos de Acceso. Contacte el Administrador</div>';
		exit;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<meta content="IE=edge,requiresActiveX=true" http-equiv="X-UA-Compatible" />
<link rel="stylesheet" href="css/tablasmostrar.css">
<link rel="stylesheet" type="text/css" href="calendario/tcal.css" />
<script type="text/javascript" src="calendario/tcal.js"></script>
<title>SISTEMA</title>
<script>
function Permisos(id){
	window.location="ListarPermisos.php?a="+id;
}
</script>
</head>
<body style="background-image: url(imagenes/Fondo.jpg);" onload="document.getElementById('loader').style.display='none';">
<div id="loader" style="position:absolute; width:100%; height:100%; background-color:#ffffff; z-index:1005; text-align:center; padding-top:100px; font-size:20px; font-family:Arial; color:#000000;">
Cargando la Página...<br/><br/>
<img height="75" width="75" src="imagenes/loading.gif" />
</div>
<center>
<br/>
<br/>
<div style="OVERFLOW:auto;WIDTH:800px;HEIGHT:500px">
<table id="table" border=0 cellpadding="0" cellspacing="0">
<thead>
<tr>
<th></th>
<th>ID</th>
<th>NOMBRE</th>
<th>RUT</th>
<th>USUARIO</th>
<th>TIPO USUARIO</th>

<tr>
</thead>
<tbody id="tbody">
<?php
$contador = 0;
$sql      = "SELECT * FROM usuarios";
$rs       = mysql_query($sql,$conexion);
if(mysql_num_rows($rs)!=0){
	while($rows = mysql_fetch_assoc($rs)){
		$tipo        = "Administrador";
		$contador	 = $contador + 1;
		$body		 = "odd";	
		if($contador%2){$body="even";}
		if($rows['TIPO_USUARIO']==2){$tipo="Ejecutivo";}
		echo '<tr class="'.$body.'">';
		echo '<td>';
		if($password==1){
		echo '<img src="imagenes/MINILLAVE.jpg"  title="Cambiar Password"> ';
		}
		if($permiso==1){
		echo '<img src="imagenes/MINISELECT.jpg" onclick="Permisos('.$rows['ID'].');" title="Asignar Permisos"/>';
		}
		echo '</td>';
		echo '<td>'.$rows['ID'].'</td>';
		echo '<td>'.$rows['NOMBRE'].' '.$rows['APELLIDOS'].'</td>';		
		echo '<td>'.$rows['RUT'].'</td>';
		echo '<td>'.$rows['USUARIO'].'</td>';
		echo '<td>'.$tipo.'</td>';
		echo '</tr>';
		
	}

}else{
	echo "<tr><td colspan='8'><center><img src='imagenes/error.png'/> No Hay Registros</center></td></tr>";
}

?>
</tbody>
</table>
</div>
</center>
</body>
</html>
