<?php
	include('Conexion_Abrir.php');
	
	$sqlx = "SELECT * FROM usuarios WHERE TIPO_USUARIO=2 ORDER BY ID";
	$rsx  = mysql_query($sqlx,$conexion);
	if(mysql_num_rows($rsx)!=0){
		while($rows = mysql_fetch_assoc($rsx)){
			echo "<option value='".$rows['ID']."'>".$rows['NOMBRE'].' '.$rows['APELLIDOS']."</option>";		
		}
	}

?>