<link href="../css/Estilo.css" rel="stylesheet" type="text/css"/>
<script>
function acepta(){
	permisos.submit();
}
</script>
<form name="permisos" action="../ListarUsuarios.php">
<?php 
 include('../ScreenCatalogo_Seguridad.php');
 include('../Conexion_Abrir.php');
 include('DibujaVentana.php');
 Cabecera("PERMISOS GUARDADOS");
 $boton		= "Aceptar";
 $javascript = "acepta();";
 $total		= $_POST['permiso'];
 foreach ($total as $valor){
	$datos   = explode("|",$valor);
	$usuario = $datos[0];
	$permiso = $datos[1];
	$estatus = $datos[2];
	
	#validamos si existe registrado el permiso
	$checkid = mysql_query("SELECT ESTATUS FROM accesousuarios WHERE ucase(trim(USUARIO))='".$usuario."' AND ucase(trim(PROTECCION))='".$permiso."'");
	$id_exist = mysql_num_rows($checkid);
	if ($id_exist>0){
		#SI YA EXISTE LO ACTUALIZAMOS
		$update = "UPDATE accesousuarios SET ESTATUS='".$estatus."' WHERE ucase(trim(USUARIO))='".$usuario."' AND ucase(trim(PROTECCION))='".$permiso."'";
		mysql_query($update,$conexion);	
		
	}else{	
		#validamos si el permiso se activo entonces guardamos
		if($estatus == 1){	
			$sql = "INSERT INTO accesousuarios(USUARIO,PROTECCION,ESTATUS) VALUES (";
			$sql = $sql."'".$usuario."',";
			$sql = $sql."'".$permiso."',";
			$sql = $sql."'".$estatus."')";
			mysql_query($sql,$conexion);
		}
	}
 }
 echo '<center><table>';
 echo '<tr>';
 echo '<td>';
 echo '<div class="information-box round">Permisos Asignados Correctamente</div>';
 echo '</td>'; 
 echo '</tr>';
 echo '</table></center>';
 Pie($boton,$javascript);
?>
</form>