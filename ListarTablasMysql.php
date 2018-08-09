<script>
function Delete(){
	mysql.submit();
}
</script>
<?php
	include('DibujaVentana.php');
	include('ScreenCatalogo_Seguridad.php');
	include('Conexion_Abrir.php');
	include('DataExtra.php');	
	$estatus   = PermisosUsuario($_SESSION['USERCORE'],15,$conexion);	
	if($estatus==0){
		echo '<br/><div class="error-box round">Error: No Tiene Permisos de Acceso. Contacte el Administrador</div>';
		exit;
	}
	Cabecera("LISTAR TABLAS MYSQL");
	$boton		= "Eliminar";
	$javascript = "Delete();";
	echo '<form name="mysql" method="post" action="VaciaTablas.php">';
	echo "<center><table border=0>";
	echo "<tr><td>";
	echo "<center><font color='red' size='1'>Advertencia: Una Vez Eliminado Los registros de las Tablas No Podra Recuperarlo.</font></center>";
	echo "</td></tr>";
	echo "<tr><td>";
	echo "<table border=0>";
	echo "<tr bgcolor='f0f0f0'>";
	echo "<td>Nombre de la Tabla</td>";
	echo "<td>Eliminar</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td colspan=2><hr/></td>";
	echo "</tr>";
	
	echo "<tr>";
	echo "<td>";
	echo "<img src='imagenes/warning.png'> Tabla <strong>Clientes</strong> ";
	echo "</td>";
	echo "<td>";
	echo '<input name="permiso[]1" type="radio"  value="'.$_SESSION['USERCORE'].'|clientes">';
	echo "</td>";
	echo "</tr>";
	
	echo "<tr>";
	echo "<td>";
	echo "<img src='imagenes/warning.png'> Tabla <strong>Log_Llamadas</strong> ";
	echo "</td>";
	echo "<td>";
	echo '<input name="permiso[]2" type="radio"  value="'.$_SESSION['USERCORE'].'|log_llamadas">';
	echo "</td>";
	echo "</tr>";
	
	echo "<tr>";
	echo "<td>";
	echo "<img src='imagenes/warning.png'> Tabla <strong>Plan_Clientes</strong> ";
	echo "</td>";
	echo "<td>";
	echo '<input name="permiso[]3" type="radio"  value="'.$_SESSION['USERCORE'].'|plan_clientes">';
	echo "</td>";
	echo "</tr>";
	
	echo "<tr>";
	echo "<td>";
	echo "<img src='imagenes/warning.png'> Tabla <strong>Tipificacion</strong> ";
	echo "</td>";
	echo "<td>";
	echo '<input name="permiso[]4" type="radio"  value="'.$_SESSION['USERCORE'].'|tipificacion">';
	echo "</td>";
	echo "</tr>";
	
	echo "<tr>";
	echo "<td>";
	echo "<img src='imagenes/warning.png'> Tabla <strong>Planes</strong> ";
	echo "</td>";
	echo "<td>";
	echo '<input name="permiso[]5" type="radio"  value="'.$_SESSION['USERCORE'].'|planes">';
	echo "</td>";
	echo "</tr>";
	
	echo "</table>";
	echo "</td></tr>";
	echo "</table>";
	echo "</center>";		
	Pie($boton,$javascript);
	echo "</form>";

?>