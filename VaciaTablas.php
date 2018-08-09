<script>
function acepta(){
	mysql.submit();
}
</script>
<?php
	date_default_timezone_set('America/Mexico_City');
	include('ScreenCatalogo_Seguridad.php');
	include('Conexion_Abrir.php');
	include('DibujaVentana.php');
	Cabecera("VACIAR TABLAS MYSQL");
	$boton		= "Aceptar";
	$javascript = "acepta();";
	echo '<form name="mysql" method="post" action="AccionesAdmin.php">';
	echo "<center><table border=0>";
	$hoy   = date("Y-m-d H:i:s");
	if(isset($_POST['permiso'])){
		$total   = $_POST['permiso'];
		foreach ($total as $valor){
			$datos   = explode("|",$valor);
			$usuario = $datos[0];
			$tabla	 = $datos[1];			
			echo '<tr><td><img src="imagenes/error.png"/> <strong>'.$tabla.'</strong></td></tr>';
			/*truncamos la tabla*/
			$sqlx = "TRUNCATE TABLE ".$tabla;
			mysql_query($sqlx,$conexion);
			/*GUARDAMOS LOG*/
			$sql  = "INSERT INTO log (USUARIO,TABLA,ACCION,COMANDO,FECHA) values ('".$usuario."','".$tabla."','TRUNCATE','TRUNCATE TABLE ".$tabla.";','".$hoy."')";
			mysql_query($sql,$conexion);
		}
		echo '<tr><td><br/><div class="information-box round">Tablas Vaciados Correctamente</div></td></tr>';
	}else{
		echo '<tr><td><div class="error-box round">Error: Al Menos Debes Seleccionar una Tabla</div></td></tr>';
	}
	echo "</table></center>";		
	Pie($boton,$javascript);
	echo "</form>";
?>