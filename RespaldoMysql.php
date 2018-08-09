<script>
function acepta(){
	excel.submit();
}
</script>
<form name="excel" action="AccionesAdmin.php">
<?php
	date_default_timezone_set('America/Mexico_City');
	include('DibujaVentana.php');
	include('ScreenCatalogo_Seguridad.php');
	include('Conexion_Abrir.php');
	include('DataExtra.php');
	$respaldo= PermisosUsuario($_SESSION['USERCORE'],16,$conexion);
	if($respaldo==0){
		echo '<br/><div class="error-box round">Error: No Tiene Permisos de Acceso. Contacte el Administrador</div>';
		exit;
	}
	Cabecera("BACKUP BASE DE DATOS");
	$boton		= "Aceptar";
	$javascript = "acepta();";

	$archivo="Backup/Respaldo.sql";
	$sistema="show variables where variable_name= 'basedir'";
	$rs_sistema=mysql_query($sistema);
	$DirBase=mysql_result($rs_sistema,0,"value");
	$primero=substr($DirBase,0,1);
	if ($primero=="/") {
		$DirBase="mysqldump";
	} else {
		$DirBase=$DirBase."\bin\mysqldump";
	}
	
	$executa = "$DirBase -h $Servidor -u $Usuario --password=$Password --opt --ignore-table=$BaseDeDatos.tabbackup $BaseDeDatos > $archivo";
	
	system($executa, $resultado);
	/*RENOMBRAMOS ARCHIVO*/
	$nuevo = "Backup/Respaldo_".date("Y-m-d").".sql";;
	rename($archivo, $nuevo);
	echo '<center><table>';
	echo '<tr>';
	echo '<td>';
	echo '<div class="information-box round">Base de Datos Respaldado Correctamente</div>';
	echo '</td>'; 
	echo '</tr>';
	echo '</table></center>';
	Pie($boton,$javascript);
?>
</form>