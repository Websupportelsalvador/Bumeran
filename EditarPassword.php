<script src="js/ajax.js" type="text/javascript"></script>
<script LANGUAGE="JavaScript">
function ValidarRequeridos(){
	
	divResultado 		= document.getElementById('resultado');
	var txtRut 			= document.clientes.txtRut.value;
	var txtPass1 		= document.clientes.txtPass1.value;
	var txtConfirma 	= document.clientes.txtConfirma.value;
	ajax = newAjax();	
	
	ajax.open("POST", "Configuracion/GuardarCambioPassword.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("txtPass1="+txtPass1+"&txtConfirma="+txtConfirma+"&txtRut="+txtRut);
	
}
</script>
<?php
	include('DibujaVentana.php');
	include('Conexion_Abrir.php');
	include('ScreenCatalogo_Seguridad.php');
	Cabecera("Cambiar mi Password");
	$sql 		= "SELECT * FROM usuarios WHERE ID='".$_SESSION['USERCORE']."' limit 1";
	$rs  		= mysql_query($sql,$conexion);
	$row 		= mysql_fetch_assoc($rs);
	
	$boton		= "salvar";
	$javascript = "";
	echo '<div id="resultado"></div>';
	echo '<form name="clientes" id="clientes" method="post" action="" onsubmit="ValidarRequeridos(); return false">';
	echo '<center>';
	echo '<table>';
	echo '<tr>';
	echo '	<td align="left"><strong>Usuario:</strong></td>';
	echo '	<td><input type="text" name="txtRut" disabled value="'.$row['RUT'].'" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	
	echo '<tr>';
	echo '	<td><strong>Password:</strong></td>';
	echo '	<td><input type="password" name="txtPass1" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	
	echo '<tr>';
	echo '	<td><strong>Confirmar:</strong></td>';
	echo '	<td><input type="password" name="txtConfirma" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	
	echo '</table>';
	echo '</center>';
	Pie($boton,$javascript);
	echo '</form>';
?>

