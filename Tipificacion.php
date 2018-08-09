<script src="js/ajax.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/tablasmostrar.css">
<link href="css/Estilo.css" rel="stylesheet" type="text/css"/>
<script LANGUAGE="JavaScript">
function ValidarRequeridos(){
	
	divResultado 		= document.getElementById('resultado');
	var txtNombre 		= document.clientes.txtNombre.value;
	ajax = newAjax();	
	
	ajax.open("POST", "Configuracion/GuardaTipificacion.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("txtNombre="+txtNombre);
	
}
</script>
<?php
	include('DibujaVentana.php');
	include('ScreenCatalogo_Seguridad.php');
	include('Conexion_Abrir.php');
	include('DataExtra.php');
	$estatus = PermisosUsuario($_SESSION['USERCORE'],8,$conexion);
	if($estatus==0){
		echo '<br/><div class="error-box round">Error: No Tiene Permisos de Acceso. Contacte el Administrador</div>';
		exit;
	}
	Cabecera("Nuevo Tipificacion");
	$boton		= "Guardar";
	$javascript = "";
	echo '<form name="clientes" id="clientes" method="post" action="" onsubmit="ValidarRequeridos(); return false">';
	echo '<center>';
	echo '<table>';
	echo '<tr><td colspan=2><div id="resultado"></div></td></tr>';
	echo '<tr>';
	echo '	<td><strong>Nombre:</strong></td>';
	echo '	<td><input type="text" name="txtNombre" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	echo '</table>';
	echo '</center>';
	Pie($boton,$javascript);
	echo '</form>';
?>
<center>
<br/>
<div style="OVERFLOW:auto;WIDTH:800px;HEIGHT:100px">
<table id="table" border=0 cellpadding="0" cellspacing="0">
<thead>
<tr>
<th>ID</th>
<th>DESCRIPCION</th>
<tr>
</thead>
<tbody id="tbody">
<?php
	$contador = 0;
$sql      = "SELECT * FROM tipificacion Order by DESCRIPCION";
$rs       = mysql_query($sql,$conexion);
if(mysql_num_rows($rs)!=0){
	while($rows = mysql_fetch_assoc($rs)){
	   
		$contador	 = $contador + 1;
		$body		 = "odd";	
		if($contador%2){$body="even";}
		echo '<tr class="'.$body.'">';
		echo '<td>'.$contador.'</td>';
		echo '<td>'.$rows['DESCRIPCION'].'</td>';
		echo '</tr>';
	}
}

?>
</tbody>
</table>
</div>
</center>