<?php
	include('ScreenCatalogo_Seguridad.php');
	include('Conexion_Abrir.php');
	include('DibujaVentana.php');
	Cabecera("ASIGNAR PERMISOS");
	$boton		= "salvar";
	$javascript = "";
	$Id	= $_GET['a'];
?>
<style>
.distabla tr:hover {
         background-color: #DFE7F2;
         color: #000000;
}
.distabla tr.resaltar {
         background-color: #DFE7F2;
         color: #000000;
}
.distabla td {
         border: 0px solid #CCCCCC;
}
.distabla th {
         border: 0px solid #CCCCCC;
         background-color: #CCCCCC;
}

</style>
<form name="" method="post" action="Configuracion/GuardarPermisosUsuarios.php" >
<table class="distabla" align="center" border="0" cellspacing="0" cellpadding="0">
<tbody>
<?php 
	
	$permisos = "SELECT * FROM catalogos order by ID";
	$rs		  = mysql_query($permisos,$conexion);
	if(mysql_num_rows($rs)){
		while($row = mysql_fetch_assoc($rs)){
		
			echo '<tr nowrap="" height="15" valign="baseline">';
		    echo '<td nowrap="" height="15" valign="top">';
			$check1="";
			$check11="";
			$permiso = PermisoActivo($Id,$row['ID']);
			
			if($permiso==1){
			 $check1 = 'checked';			 
			}
			if($permiso==0){
			 $check11 = 'checked';
			}
			
			echo '<input '.$check1.' checked name="permiso[]'.$row['ID'].'" type="radio"  value="'.$Id.'|'.$row['ID'].'|1">SI';
			echo '<input '.$check11.' name="permiso[]'.$row['ID'].'" type="radio" value="'.$Id.'|'.$row['ID'].'|0">NO';
			echo '</td>';
			echo '<td nowrap="" valign="top" height="15"> ';
			echo '<img valign="top" src="imagenes/DOWN0.jpg">';
			echo '<img valign="top" src="imagenes/DOWN0.jpg">';
			echo '<img valign="top" src="imagenes/DOWN0.jpg">&nbsp;&nbsp;'.$row['DESCRIPCION'].'</td>';
			echo '<td nowrap="" height="15" align="right">&nbsp;&nbsp;&nbsp;&nbsp;'.$row['ID'].'</td>';
			echo '</tr>';
		
		
		}
	
	}
	
function PermisoActivo($usuario,$proteccion){
	global $conexion;
	$checkbox = "";
	$sql = "SELECT ESTATUS FROM accesousuarios  WHERE USUARIO=".$usuario." AND PROTECCION=".$proteccion." LIMIT 1";
	$rs  = mysql_query($sql,$conexion);
	if(mysql_num_rows($rs)== 0){		
		return 0;
	}else{
		$row = mysql_fetch_assoc($rs);
		$estatus = $row['ESTATUS'];
		return $estatus;
		
	}

}
?>		
</tbody>
</table>
<?php Pie($boton,$javascript); ?>
</form>
