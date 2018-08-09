<?php
	$Usuario		= "root";
	$Password		= "";
	$Servidor		= "localhost";
	$BaseDeDatos	= "sistema3";

	$conexion = mysql_connect($Servidor,$Usuario,$Password);
	mysql_select_db($BaseDeDatos,$conexion);
?>