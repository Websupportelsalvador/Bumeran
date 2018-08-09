<link rel="stylesheet" type="text/css" href="calendario/tcal.css" />
<script type="text/javascript" src="calendario/tcal.js"></script>

<?php
	echo '<script src="js/jquery.min.js"></script>';
	$url	= $_GET['url'];	
?>
<script>
	function ValidaReporte(form){
		vacio = "";
<?php
	$archivoconfiguracion = "Reportes/".$url.".lay";
	$archivo1              = file($archivoconfiguracion);
	#dibujamos la cabecera del formulario
	for($i=1;$i<(sizeof($archivo1)); $i++){
		$campovalidar   = explode("|",$archivo1[$i]);
		$campo          = trim($campovalidar[0]);
		$nombre			= trim($campovalidar[2]);
		$rotulo			= trim($campovalidar[1]);
		$requerido      = trim($campovalidar[5]);
		
		if(strtoupper($campo)=="CMP" and strtoupper($requerido)=="R"){
			 echo "if(form." ;
			 echo $nombre;
			 echo ".value == vacio )";
			 echo "{";
			 echo "alert('Campo Obligatorio de Captura: ".ucfirst($rotulo)."');";
			 echo "form." ;
			 echo $nombre;
			 echo ".focus();";
			 echo "return false;";
			 echo "}";
		}
		
		
	}
 ?> 

		
	}
	
</script>
<?php
		include('DibujaVentana.php');
		include('ScreenCatalogo_Seguridad.php');
		Cabecera("Reportes");
		$boton		= "Reportar";
		$javascript = "ValidaReporte(form);";
	
		echo '<form name="reporte" method="post" action="Reportes/'.$url.'.php">';
		echo '<br/><center>';
		echo '<table class="bordered" cellpadding="0" cellspacing="0" border=0 >';
		echo '<tbody>';		
		$archivoconfiguracion = "Reportes/".$url.".lay";
		$archivo1              = file($archivoconfiguracion);
		for($i=1; $i < (sizeof($archivo1)); $i++) {
			$dibujafila  = explode("|",$archivo1[$i]);
			include('ParametrosCapturaReporte.php');
		}		
		echo '<tr>';
		echo '<td>Generar Salida MS-Excel</td>';
		echo '<td>';
		echo '<select name="EXCEL">';
		include('OpcionesSiNo.php');
		echo '</select>';
		echo '</td>';
		echo '</tr>';
	
		echo '</tbody>';
		echo '</table>';
		Pie($boton,$javascript);
		echo '</form>';
?>