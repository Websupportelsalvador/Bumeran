<script>
function Delete(){
	eliminar.submit();
}
</script>
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
	Cabecera("LISTAR EXCEL A ELIMINAR");
	$boton		= "Eliminar";
	$javascript = "Delete();";
	$directorio = opendir("Archivos/"); //ruta actual
	echo '<form name="eliminar" method="post" action="EliminarExcel.php">';
	echo "<center><table border=0>";
	echo "<tr><td><small><font color='red'>Advertencia: Una Vez Eliminado los Archivos no Podra Recuperarlo</font></small></td></tr>";
	while ($archivo = readdir($directorio)){
		//verificamos si es o no un directorio
		if (is_dir($archivo)){
			//de ser un directorio no lo mostramos
		}else{
			echo "<tr>";
			echo "<td>";
			echo "<img src='imagenes/warning.png'> <strong>".$archivo."</strong> ";
			echo "</td>";
			echo "</tr>";
		}
	}
	echo "</table></center>";		
	Pie($boton,$javascript);
	echo "</form>";
?>