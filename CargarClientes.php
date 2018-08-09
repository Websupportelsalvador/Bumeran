<link href="css/Estilo.css" rel="stylesheet" type="text/css"/>
<?php
	include('DibujaVentana.php');
	include('ScreenCatalogo_Seguridad.php');
	include('Conexion_Abrir.php');
	include('DataExtra.php');
	$estatus = PermisosUsuario($_SESSION['USERCORE'],4,$conexion);
	if($estatus==0){
		echo '<br/><div class="error-box round">Error: No Tiene Permisos de Acceso. Contacte el Administrador</div>';
		exit;
	}
	Cabecera("Carga Masiva de Clientes");
	$boton		= "Subir";
	$javascript = "CargaExcel();";
	echo '<form name="clientes" method="post" action="Configuracion/SubeExcelClientes.php" enctype="multipart/form-data">';
	echo '<center>';
	echo '<table>';
	echo '<tr>';
	echo '<td colspan="2"><font color="red">* Seleccione la lista de clientes, el Archivo debe ser con extension .xlsx o xls</font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '	<td><strong>Archivo:</strong></td>';
	echo '	<td><input type="file" name="archivo" class="CajaTexto"/></td>';
	echo '</tr>';	
	echo '</table>';
	echo '</center>';
	Pie($boton,$javascript);
	echo '</form>';

?>