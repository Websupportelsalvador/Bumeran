<script src="js/ajax.js" type="text/javascript"></script>
<script LANGUAGE="JavaScript">
function ValidarRequeridos(){
	
	divResultado 		= document.getElementById('resultado');
	var txtNombre 		= document.clientes.txtNombre.value;
	var txtApellidos	= document.clientes.txtApellidos.value;
	var txtRut 			= document.clientes.txtRut.value;
	var txtDireccion 	= document.clientes.txtDireccion.value;
	ajax = newAjax();	
	
	ajax.open("POST", "Configuracion/GuardaEdicionUsuario.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("txtNombre="+txtNombre+"&txtApellidos="+txtApellidos+"&txtRut="+txtRut+"&txtDireccion="+txtDireccion);
	
}
</script>
<?php
	include('DibujaVentana.php');
	include('Conexion_Abrir.php');
	include('ScreenCatalogo_Seguridad.php');
	Cabecera("Editar Mis Datos");
	$sql 		= "SELECT * FROM usuarios WHERE ID='".$_SESSION['USERCORE']."' limit 1";
	$rs  		= mysql_query($sql,$conexion);
	$row 		= mysql_fetch_assoc($rs);
	$tipoUser   = $row['TIPO_USUARIO'];
	if($tipoUser==1){
		$tipoUser = "Administrador";
	}
	if($tipoUser==2){
		$tipoUser = "Ejecutivo";
	}
	$boton		= "salvar";
	$javascript = "";
	echo '<div id="resultado"></div>';
	echo '<form name="clientes" id="clientes" method="post" action="" onsubmit="ValidarRequeridos(); return false">';
	echo '<center>';
	echo '<table>';
	echo '<tr>';
	echo '	<td><strong>Nombre:</strong></td>';
	echo '	<td><input type="text" name="txtNombre" value="'.$row['NOMBRE'].'" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	echo '<tr>';
	echo '	<td><strong>Apellidos:</strong></td>';
	echo '	<td><input type="text" name="txtApellidos" value="'.$row['APELLIDOS'].'" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	
	echo '<tr>';
	echo '	<td align="left"><strong>Rut:</strong></td>';
	echo '	<td><input type="text" name="txtRut" disabled value="'.$row['RUT'].'" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	
	echo '<tr>';
	echo '	<td><strong>Direccion:</strong></td>';
	echo '	<td><input type="text" name="txtDireccion" value="'.$row['DIRECCION'].'" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	
	echo '<tr>';
	echo '	<td><strong>Tipo Usuario:</strong></td>';
	echo '	<td><input type="text" name="TipoUsuario" disabled value="'.$tipoUser.'" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	
	echo '</table>';
	echo '</center>';
	Pie($boton,$javascript);
	echo '</form>';
?>

