<link href="css/Estilo.css" rel="stylesheet" type="text/css"/>	
<?php
	include('ScreenCatalogo_Seguridad.php');
	include('Conexion_Abrir.php');
	include('DataExtra.php');
	$estatus = PermisosUsuario($_SESSION['USERCORE'],1,$conexion);
	if($estatus==0){
		echo '<br/><div class="error-box round">Error: No Tiene Permisos de Acceso. Contacte el Administrador</div>';
		exit;
	}
	$Update	 = 0;
	if(isset($_GET['Update'])){
		$Update = $_GET['Update'];
	}
	if($Update!=0){
		//$update = "UPDATE CLIENTES SET VISIBLE=0 WHERE ID='".$Update."'";
		//mysql_query($update,$conexion);
	}
	$idUpdate = 0;
	/* SCRIPT MISMO USUARIO Y PASS EL SISTEMA TE PIDE ACTUALIZAR TU PASSWORD*/
	$sqx 	 = "SELECT * FROM usuarios where ID='".$_SESSION['USERCORE']."' limit 1";
	$rst 	 = mysql_query($sqx,$conexion); 
	$rowt	 = mysql_fetch_assoc($rst);
	$user	 = $rowt['USUARIO'];
	$pass	 = $rowt['PASSWORD'];
	
	if($user==$pass){
		header('Location:EditarPassword.php');
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
<link rel="shortcut icon" href="imagenes/logo.ico" />
<link rel="stylesheet" href="css/tablasmostrar.css">
<script src="js/jquery-1.9.0.min.js" type="text/javascript"></script>
<script src="js/ajax.js" type="text/javascript"></script>
<title>SISTEMA</title>
<style>
	fieldset{-webkit-border-radius:10px;-moz-border-radius:10px;border-radius:10px;}
	fieldset legend { background: #666; color:#fff; padding: 6px;  font-weight: bold; }
</style>
<script>
function ValidarRequeridos(){
	divResultado = document.getElementById('resultado');
	var txtObservacion 		= document.Contenido.txtObservacion.value;
	var txtRut				= document.Contenido.txtRut.value;
	var txtDatos 			= document.Contenido.txtDatos.value;
	var Tipificacion 		= document.Contenido.Tipificacion.value;
	var txtId          		= document.Contenido.txtId.value;
	ajax = newAjax();	
	ajax.open("POST", "Configuracion/GuardaLlamada.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("txtId="+txtId+"&txtObservacion="+txtObservacion+"&txtRut="+txtRut+"&txtDatos="+txtDatos+"&Tipificacion="+Tipificacion);
	
}
function TraeDatosCliente(id,rfc,direc,idnum){
	var Nombre 		= document.getElementById('txtNombre');
	var Rut			= document.getElementById('txtRut');
	var Direccion 	= document.getElementById('txtDireccion');
	var Id          = document.getElementById('txtId');
	Nombre.value	= id;
	Rut.value    	= rfc;
	Direccion.value = direc;
	Id.value        = idnum;
}
function refresh(id){
	window.location="Contenido.php?Update="+id;
	}
</script>
</head>
<body style="background-image: url(imagenes/Fondo.jpg);" onload="document.getElementById('loader').style.display='none';">
<div id="loader" style="position:absolute; width:100%; height:100%; background-color:#ffffff; z-index:1005; text-align:center; padding-top:100px; font-size:20px; font-family:Arial; color:#000000;">
Cargando la Página...<br/><br/>
<img height="75" width="75" src="imagenes/loading.gif" />
</div>
<center>
<form name="Contenido" id="Contenido" method="post" action="" onsubmit="ValidarRequeridos(); return false">
<!-- tabla login --->
<table width='70%' border='0' class='ventanas' cellspacing='0' cellpadding='0'>
<tr>
	<td  colspan=2 class='tabla_ventanas' height='10' align='center'>Información</td>
</tr>
<tr><td  colspan=2><div id="resultado"></div></td></tr>
<tr>
<td>
&nbsp;
<fieldset>
<legend><strong>Datos del Contacto</strong></legend>
<center>
<table border=0>
<tr>
<td colspan=2><input type="hidden" name="txtId" id="txtId"/></td>
</tr>
<tr>
<td>Nombre: </td><td><input type="text" disabled name="txtNombre" id="txtNombre" class="CajaTexto" size="40" x-webkit-speech="true"/></td>
</tr>
<tr>
<td>Rut: </td><td><input type="text" disabled name="txtRut" id="txtRut" class="CajaTexto" size="40" x-webkit-speech="true"/></td>
</tr>
<tr>
<td>Direccion: </td><td><textarea disabled name="txtDireccion" id="txtDireccion" class="CajaTexto" rows="3" cols="30"></textarea></td>
</tr>
</table>
</center>

</fieldset>
</td>
<td>

<table id="table" border=0 cellpadding="0" cellspacing="0">
<thead>
<tr>
<th>Cliente</th>
<th>Movil</th>
<th>Plan</th>
<th>Fecha Activacion</th>
<th>Llamar</th>
<tr>
</thead>
<tbody id="tbody">
<?PHP
$contador = 0;
$sql      = "SELECT C.ID AS ID,C.NOMBRE AS NOMBRECLIENTE, C.APELLIDOS AS APELLIDOSCLIENTE, C.RUT AS RUT, C.TELEFONO AS TELEFONOCLIENTE, P.NOMBRE_PLAN AS NOMBRE_PLAN";
$sql      = $sql.", P.FECHA_ACTIVACION AS FECHA_ACTIVACION,C.DIRECCION as DIRECCION FROM clientes AS C INNER JOIN plan_clientes AS P ON C.ID_PLAN = P.ID  WHERE VISIBLE=0 ORDER BY RAND() 
LIMIT 1";
$rs       = mysql_query($sql,$conexion);
if(mysql_num_rows($rs)!=0){
	while($rows = mysql_fetch_assoc($rs)){
	   /*GENERAMOS EL UPDATE PARA QUE NADIEN MAS USE ESE CLIENTE*/
	   $update = "UPDATE CLIENTES SET VISIBLE=1 WHERE ID='".$rows['ID']."'";
	   mysql_query($update,$conexion);
		$contador	 = $contador + 1;
		$body		 = "odd";	
		if($contador%2){$body="even";}
		$idUpdate = $rows['ID'];
		echo '<tr class="'.$body.'">';
		echo '<td>'.$rows['NOMBRECLIENTE'].' '.$rows['APELLIDOSCLIENTE'].'</td>';
		echo '<td>'.$rows['TELEFONOCLIENTE'].'</td>';
		echo '<td>'.$rows['NOMBRE_PLAN'].'</td>';
		echo '<td>'.$rows['FECHA_ACTIVACION'].'</td>';
		echo '<td>';
?>		
		<img src="imagenes/phone-icon.png" style="cursor:pointer;" onclick="TraeDatosCliente('<?php echo $rows['NOMBRECLIENTE'].' '.$rows['APELLIDOSCLIENTE'];?>','<?php echo $rows['RUT']; ?>','<?php echo $rows['DIRECCION']; ?>','<?php echo $rows['ID']; ?>')" title= "LLAMAR A <?php echo $rows['TELEFONOCLIENTE']; ?>" width="25px" height="20px"/>
<?php
		echo '</td>';
		echo '</tr>';
		
	}

}

?>
</tbody>
</table>
<br/><br/><br/><br/><br/>
</td>
</tr>
<tr><td colspan="2"><hr/></td></tr>
<tr>
<td>


<fieldset>
<legend><strong>Respuesta Cliente</strong></legend>
<center>
<table>
<tr>
<td>Tipificacion: </td><td>
<select name="Tipificacion">
<?php
	$sqlx = "SELECT * FROM tipificacion Order by DESCRIPCION";
	$rsx  = mysql_query($sqlx,$conexion);
	if(mysql_num_rows($rsx)!=0){
		while($row = mysql_fetch_assoc($rsx)){
			echo "<option value='".$row['ID']."'>".$row['DESCRIPCION']."</option>";
		
		}
	}
?>
</select>
</td>
</tr>
<tr>
<td>Observaciones: </td><td><textarea name="txtObservacion" class="CajaTexto" rows="3" cols="30"></textarea></td>
</tr>
</table>
</center>
</fieldset>


</td>
<td>

<table>
<tr>
<td colspan="2"><h3>Datos de Cierre: </h3></td>
</tr>
<tr>
<td colspan="2"><textarea name="txtDatos" class="CajaTexto" rows="3" cols="80"></textarea></td>
</tr>
</table>
</td>
</tr>
<tr>
<td colspan=2 align='center'><hr/></td>
</tr>
<tr>
<td height='50' colspan=2 align='center'><button class="clean-gray"> Guardar </button> <button class="clean-gray" onclick="refresh(<?php echo $idUpdate; ?>);"> Siguiente </button> </td>
</tr>
</table>
</form>
</center>
</body>
</html>
