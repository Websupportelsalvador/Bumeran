<script>
function acepta(){
	excel.submit();
}
</script>
<form name="excel" action="AccionesAdmin.php">
<?php
	include('DibujaVentana.php');
	include('ScreenCatalogo_Seguridad.php');
	include('Conexion_Abrir.php');
	include('DataExtra.php');	
	$estatus   = PermisosUsuario($_SESSION['USERCORE'],14,$conexion);	
	if($estatus==0){
		echo '<br/><div class="error-box round">Error: No Tiene Permisos de Acceso. Contacte el Administrador</div>';
		exit;
	}
	Cabecera("ARCHIVOS DE EXCEL ELIMINADOS");
	$boton		= "Aceptar";
	$javascript = "acepta();";
	$directorio = opendir("Archivos/"); //ruta actual
	while ($archivo = readdir($directorio)){
		//verificamos si es o no un directorio
		if (is_dir($archivo)){
			//de ser un directorio no lo mostramos
		}else{
			unlink("Archivos/".$archivo);
			
		}
	}
	echo '<center><table>';
	echo '<tr>';
	echo '<td>';
	echo '<div class="information-box round">Archivos de Excel Eliminados con Exito</div>';
	echo '</td>'; 
	echo '</tr>';
	echo '</table></center>';
	Pie($boton,$javascript);	
?>
</form>