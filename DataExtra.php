<?php
	function ObtieneNombreCliente($id,$campo,$conexion){
		$ValorRetorna = "";
		$sql = "SELECT ".$campo." FROM clientes WHERE ID=".$id;
		$rs  = mysql_query($sql,$conexion);
		if(mysql_num_rows($rs)!=0){
			$row = mysql_fetch_array($rs);
			$ValorRetorna = $row[0];
		}
		return $ValorRetorna;
	}
	function ObtienePlan($id,$conexion){
		$ValorRetorna = "";
		$sql = "SELECT NOMBRE_PLAN FROM plan_clientes WHERE ID=".$id;
		$rs  = mysql_query($sql,$conexion);
		if(mysql_num_rows($rs)!=0){
			$row = mysql_fetch_array($rs);
			$ValorRetorna = $row[0];
		}
		return $ValorRetorna;
	}
	function ObtieneTipificacion($id,$conexion){
		$ValorRetorna = "";
		$sql = "SELECT DESCRIPCION FROM tipificacion WHERE ID=".$id;
		$rs  = mysql_query($sql,$conexion);
		if(mysql_num_rows($rs)!=0){
			$row = mysql_fetch_array($rs);
			$ValorRetorna = $row[0];
		}
		return $ValorRetorna;	
	}
	function PermisosUsuario($usuario,$proteccion,$conexion){
		
		$sqlvau = "select ESTATUS from accesousuarios where USUARIO=".$usuario." and PROTECCION=".$proteccion." limit 1";		
		$resvau = mysql_query($sqlvau, $conexion);
		if (mysql_num_rows($resvau) == 0) {
			return 0;
		}else{
			$rowvau  = mysql_fetch_assoc($resvau);
			$permiso = $rowvau["ESTATUS"];
			return $permiso;
		}	
	}
	function ObtieneNombreEjecutivo($id,$campo,$conexion){
		$ValorRetorna = "";
		$sql = "SELECT ".$campo." FROM usuarios WHERE ID=".$id;
		$rs  = mysql_query($sql,$conexion);
		if(mysql_num_rows($rs)!=0){
			$row = mysql_fetch_array($rs);
			$ValorRetorna = $row[0];
		}
		return $ValorRetorna;
	}
?>