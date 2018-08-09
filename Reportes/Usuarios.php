<?php
	$tipo	= $_POST['Tipo'];
	include('../ScreenCatalogo_Seguridad.php');
	include('../Conexion_Abrir.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<meta content="IE=edge,requiresActiveX=true" http-equiv="X-UA-Compatible" />
<link rel="stylesheet" href="../css/tablasmostrar.css">
<title>SISTEMA</title>
</head>
<body style="background-image: url(../imagenes/Fondo.jpg);" onload="document.getElementById('loader').style.display='none';">
<div id="loader" style="position:absolute; width:100%; height:100%; background-color:#ffffff; z-index:1005; text-align:center; padding-top:100px; font-size:20px; font-family:Arial; color:#000000;">
Cargando la Página...<br/><br/>
<img height="75" width="75" src="../imagenes/loading.gif" />
</div>
<center>
<h4>REPORTE DE USUARIOS</h4>

<br/>
<div style="OVERFLOW:auto;WIDTH:1100px;HEIGHT:500px">
<table id="table" border=0 cellpadding="0" cellspacing="0">
<thead>
<tr>
<th>Nombre</th>
<th>Rut</th>
<th>Direccion</th>
<th>Usuario</th>
<th>Tipo Usuario</th>
<tr>
</thead>
<tbody id="tbody">
<?PHP

$contador = 0;
$sql      = "SELECT * FROM usuarios WHERE TIPO_USUARIO='".$tipo."' order by NOMBRE asc";
$rs       = mysql_query($sql,$conexion);
if(mysql_num_rows($rs)!=0){
	while($rows = mysql_fetch_assoc($rs)){
		$contador	 = $contador + 1;
		$body		 = "odd";	
		if($tipo==1){
			$tipo = "Administrador";
		}
		if($tipo==2){
			$tipo="Ejecutivo";
		}
		if($contador%2){$body="even";}
		echo '<tr class="'.$body.'">';
		echo '<td>'.$rows['NOMBRE'].' '.$rows['APELLIDOS'].'</td>';
		echo '<td>'.$rows['RUT'].'</td>';
		echo '<td>'.$rows['DIRECCION'].'</td>';
		echo '<td>'.$rows['USUARIO'].'</td>';
		echo '<td>'.$tipo.'</td>';
		echo '</tr>';
		
	}

}else{
	echo "<tr><td colspan='5'><center><img src='../imagenes/error.png'/> No Hay Registros</center></td></tr>";
}

?>
</tbody>
</table>
</div>
</center>
</body>
</html>
