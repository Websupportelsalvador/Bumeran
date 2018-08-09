<?php
	$FECHAINICIAL	= $_POST['FECHAINICIAL'];
	$FECHAFINAL		= $_POST['FECHAFINAL'];
	$EJECUTIVO		= $_POST['EJECUTIVO'];
	date_default_timezone_set('America/Mexico_City');
	include('../ScreenCatalogo_Seguridad.php');
	include('../Conexion_Abrir.php');
	include('../DataExtra.php');
	
	
	$filtro   = "FECHA between '".$FECHAINICIAL." 00:00:00' and '".$FECHAFINAL." 23:59:59'";
	
	
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
<h4>REPORTE DE LLAMADAS POR EJECUTIVO</h4>

<br/>
<div style="OVERFLOW:auto;WIDTH:1100px;HEIGHT:500px">
<table id="table" border=0 cellpadding="0" cellspacing="0">
<thead>
<tr>
<th>Ejecutivo</th>
<th>Cliente</th>
<th>Rut</th>
<th>Movil</th>
<th>Plan</th>
<th>Tipificacion</th>
<th>Observaciones</th>
<th>Datos Cierre</th>
<th>Fecha/Hora Llamada</th>
<tr>
</thead>
<tbody id="tbody">
<?PHP

$contador = 0;
$sql      = "SELECT * FROM log_llamadas WHERE ID_EJECUTIVO='".$EJECUTIVO."' AND ".$filtro." order by fecha asc";
$rs       = mysql_query($sql,$conexion);
if(mysql_num_rows($rs)!=0){
	while($rows = mysql_fetch_assoc($rs)){
		$idPlan		 = ObtieneNombreCliente($rows['ID_CLIENTE'],"ID_PLAN",$conexion);
		$contador	 = $contador + 1;
		$body		 = "odd";	
		if($contador%2){$body="even";}
		echo '<tr class="'.$body.'">';
		echo '<td>'.ObtieneNombreEjecutivo($EJECUTIVO,"NOMBRE",$conexion).' '.ObtieneNombreEjecutivo($EJECUTIVO,"APELLIDOS",$conexion).'</td>';
		echo '<td>'.ObtieneNombreCliente($rows['ID_CLIENTE'],"NOMBRE",$conexion).'</td>';
		echo '<td>'.$rows['RUT'].'</td>';
		echo '<td>'.ObtieneNombreCliente($rows['ID_CLIENTE'],"TELEFONO",$conexion).'</td>';		
		echo '<td>'.ObtienePlan($idPlan,$conexion).'</td>';
		echo '<td>'.ObtieneTipificacion($rows['ID_TIPIFICACION'],$conexion).'</td>';
		echo '<td>'.$rows['OBSERVACIONES'].'</td>';
		echo '<td>'.$rows['DATOSCIERRE'].'</td>';
		echo '<td>'.$rows['FECHA'].'</td>';
		echo '</tr>';
		
	}

}else{
	echo "<tr><td colspan='8'><center><img src='../imagenes/error.png'/> No Hay Registros</center></td></tr>";
}

?>
</tbody>
</table>
</div>
</center>
</body>
</html>
