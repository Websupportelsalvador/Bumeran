<link href="css/Estilo.css" rel="stylesheet" type="text/css"/>	
<script>
function EliminaExcel(){
	window.location="ListaExcelEliminar.php";
}
function VaciaTablas(){
	window.location="ListarTablasMysql.php";
}
function Respaldo(){
	window.location="RespaldoMysql.php";
}
</script>
<?php
	include('DibujaVentana.php');
	include('ScreenCatalogo_Seguridad.php');
	include('Conexion_Abrir.php');
	include('DataExtra.php');
	$estatus = PermisosUsuario($_SESSION['USERCORE'],13,$conexion);
	$excel   = PermisosUsuario($_SESSION['USERCORE'],14,$conexion);
	$mysql   = PermisosUsuario($_SESSION['USERCORE'],15,$conexion);
	$respaldo= PermisosUsuario($_SESSION['USERCORE'],16,$conexion);
	if($estatus==0){
		echo '<br/><div class="error-box round">Error: No Tiene Permisos de Acceso. Contacte el Administrador</div>';
		exit;
	}
	Cabecera("Tablas");
	$boton		= "Imprimir";
	$javascript = "print()";
	echo '<center><table>';
	echo '<tr>';
	echo '<td>';
	if($excel==1){
		echo '<img src="imagenes/MINISELECT.jpg" style="cursor:pointer" onclick="EliminaExcel();" title="Eliminar Archivos Excel del Servidor">';
	}
	echo '</td><td>Eliminar Archivos de Excel</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>';
	if ($mysql==1){
		echo '<img src="imagenes/MINISELECT.jpg" style="cursor:pointer" onclick="VaciaTablas();" title="Vaciar Tablas de Mysql">';
	}
	echo '</td><td>Vaciar Tablas Mysql</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>';
	if($respaldo==1){
		echo '<img src="imagenes/MINISELECT.jpg" style="cursor:pointer" onclick="Respaldo();">';
	}	
	echo '</td><td>Respaldar Base de Datos Mysql</td>';
	echo '</tr>';
	echo '</table>';
	Pie($boton,$javascript);
?>