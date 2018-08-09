<link href="css/Estilo.css" rel="stylesheet" type="text/css"/>
<script>
function CapturarReporte(url){
	window.location="CapturaReporte.php?url="+url;
}
function Permisos(nombre){
	window.location="PermisosReportes.php?nombre="+nombre;
}
</script>
<?php
	
	include('DibujaVentana.php');
	include('ScreenCatalogo_Seguridad.php');
	include('Conexion_Abrir.php');
	include('DataExtra.php');
	$estatus = PermisosUsuario($_SESSION['USERCORE'],7,$conexion);
	if($estatus==0){
		echo '<br/><div class="error-box round">Error: No Tiene Permisos de Acceso. Contacte el Administrador</div>';
		exit;
	}
	Cabecera("Reportes");
	$boton		= "Imprimir";
	$javascript = "print();";
	
	echo '<center><table border=0 cellpadding="0" cellspacing="0">';	
   #leemos los archivos lay y los mostramos el titulo
   $directorio = opendir("Reportes/"); //ruta actual
	while ($archivo = readdir($directorio)){
		//verificamos si es o no un directorio
		if (is_dir($archivo)){
			 //de ser un directorio no lo mostramos
		}else{
			$nombrearchivo = explode(".", $archivo);
			$extension	   = $nombrearchivo[1];
			$nombre 	   = $nombrearchivo[0];
			#si es un archivo lay entonces vamos a leer su contenido
			if($extension=="lay"){

				$archivoabrir    = file('Reportes/'.$archivo);
				for($i=0; $i < (sizeof($archivoabrir)); $i++) {

					$dibujafila  	= explode("|",$archivoabrir[$i]);
					$titulo		 	= $dibujafila[0];
					$nombrereporte 	= $dibujafila[1];

					if(strtoupper($titulo)==strtoupper("TIT")){
						
						echo '<tr>';								
						echo '<td align="">';
		?>
						<img src="imagenes/MINISELECT.jpg" onclick="Permisos('')" title="Permisos" />
		<?php
						echo '&nbsp;';
		?>
						<img src="imagenes/MINIIMPRIMIR.jpg" onclick="CapturarReporte('<?php echo $nombre; ?>')" title="Ver Reporte"/>
		<?php
						echo '&nbsp;&nbsp;';

						echo '<font size=3>'.($nombrereporte).'</font></td></tr>';
					}

				}

				
			}
		}
	}
	echo '</table></center>';
	
	Pie($boton,$javascript);

?>