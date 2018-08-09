<script src="js/ajax.js" type="text/javascript"></script>
<link href="css/Estilo.css" rel="stylesheet" type="text/css"/>
<script LANGUAGE="JavaScript">
function ValidarRequeridos(){
	
	divResultado 		= document.getElementById('resultado');
	var txtNombre 		= document.clientes.txtNombre.value;
	var txtApellidos	= document.clientes.txtApellidos.value;
	var txtRut 			= document.clientes.txtRut.value;
	var txtDireccion 	= document.clientes.txtDireccion.value;
	var TipoUsuario     = document.clientes.TipoUsuario.value;
	ajax = newAjax();	
	
	ajax.open("POST", "Configuracion/GuardaUsuario.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("txtNombre="+txtNombre+"&txtApellidos="+txtApellidos+"&txtRut="+txtRut+"&txtDireccion="+txtDireccion+"&TipoUsuario="+TipoUsuario);
	
}
</script>
<?php
	include('DibujaVentana.php');
	include('ScreenCatalogo_Seguridad.php');
	include('Conexion_Abrir.php');
	include('DataExtra.php');
	$estatus = PermisosUsuario($_SESSION['USERCORE'],2,$conexion);
	if($estatus==0){
		echo '<br/><div class="error-box round">Error: No Tiene Permisos de Acceso. Contacte el Administrador</div>';
		exit;
	}
	Cabecera("Nuevo Ejecutivo / Nuevo Usuario");
	$boton		= "salvar";
	$javascript = "";
	echo '<div id="resultado"></div>';
	echo '<form name="clientes" id="clientes" method="post" action="" onsubmit="ValidarRequeridos(); return false">';
	echo '<center>';
	echo '<table>';
	echo '<tr>';
	echo '	<td><strong>Nombre:</strong></td>';
	echo '	<td><input type="text" name="txtNombre" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	echo '<tr>';
	echo '	<td><strong>Apellidos:</strong></td>';
	echo '	<td><input type="text" name="txtApellidos" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	echo '<tr>';
	echo '	<td align="left"><strong>Rut:</strong></td>';
	echo '	<td><input type="text" name="txtRut" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	echo '<tr>';
	echo '	<td><strong>Direccion:</strong></td>';
	echo '	<td><input type="text" name="txtDireccion" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	echo '<tr>';
	echo '	<td><strong>Tipo Usuario:</strong></td>';
	echo '	<td>';
	echo '<select name="TipoUsuario">';
	echo '<option value="1">Administrador</option>';
	echo '<option value="2">Ejecutivo</option>';
	echo '</select>';
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo '</center>';
	Pie($boton,$javascript);
	echo '</form>';
?>

