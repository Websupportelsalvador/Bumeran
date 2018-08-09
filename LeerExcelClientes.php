<link href="css/Estilo.css" rel="stylesheet" type="text/css"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body style="background-image: url(imagenes/Fondo.jpg);" onload="document.getElementById('loader').style.display='none';">
<div id="loader" style="position:absolute; width:100%; height:100%; background-color:#ffffff; z-index:1005; text-align:center; padding-top:100px; font-size:20px; font-family:Arial; color:#000000;">
Cargando la Página...<br/><br/>
<img height="75" width="75" src="imagenes/loading.gif" />
</div>
<?php
		date_default_timezone_set('America/Mexico_City');
		include('ScreenCatalogo_Seguridad.php');
		include('Conexion_Abrir.php');
		include('DibujaVentana.php');
		include('DataExtra.php');
		$estatus = PermisosUsuario($_SESSION['USERCORE'],5,$conexion);
		if($estatus==0){
			echo '<br/><div class="error-box round">Error: No Tiene Permisos de Acceso. Contacte el Administrador</div>';
			exit;
		}
		Cabecera("PROCESAR EXCEL");
		$boton		= "Aceptar";
		$javascript = "aceptar();";
		set_time_limit(0);
		echo '<form name="clientes" method="post" action="Contenido.php">';
		require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';
		echo "<center><table border=0>";
		$directorio = opendir("Archivos/"); //ruta actual
		while ($archivo = readdir($directorio)){
			//verificamos si es o no un directorio
			if (is_dir($archivo)){
				//de ser un directorio no lo mostramos
			}else{
				
				$GuardaArchivo = GuardaExcel($archivo);
				
				echo "<tr>";
				echo "<td>";
				echo "<strong>".$archivo."</strong> ".$GuardaArchivo;
				echo "</td>";
				echo "</tr>";
				
				
			}
		}
		echo "</table></center>";			
		function GuardaExcel($Archivo){
			global $conexion;
			$nombreArchivo 	= "Archivos/".$Archivo;
			$contenido 		= trim(file_get_contents($nombreArchivo));
			$Mensaje   		= "";
			if (empty($contenido)){
				$Mensaje = "No Existe en el Servidor";
		
			}else{
				require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';
				
				$objPHPExcel = PHPExcel_IOFactory::load($nombreArchivo);
				$objHoja	 = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true,true,true,true);
				foreach ($objHoja as $Contador=>$objCelda) {
		
					$Telefono  = $objCelda['C'];
					$Rut       = $objCelda['D'];
					$Plan	   = $objCelda['E'];
					$Nombre	   = $objCelda['F'];
					$Apellidos = $objCelda['G'];
					$Direccion = $objCelda['H'].' '.$objCelda['I'].' '.$objCelda['K'];
					$Fecha_Plan= $objCelda['N'];
					$FechaHoy  = date("Y-m-d H:i:s");
					$IdPlan    = 0;
					//Guardamos el Plan
					if ($Contador>1){
						//Verificamos si ya existe
						$sqlx   = "SELECT ID FROM clientes WHERE RUT='".strtoupper($Rut)."'";
						$rs     = mysql_query($sqlx,$conexion);
						if(mysql_num_rows($rs)==0){
						
							$sqls 	= "INSERT INTO plan_clientes(NOMBRE_PLAN,FECHA_ACTIVACION,TELEFONO) VALUES ('".$Plan."','".$Fecha_Plan."','".$Telefono."')";
							mysql_query($sqls,$conexion);
							$IdPlan = mysql_insert_id();
							
							$sql 	= "INSERT INTO clientes (NOMBRE,APELLIDOS,RUT,DIRECCION,TELEFONO,FECHA_REGISTRO,ID_PLAN) VALUES ('".$Nombre."','".$Apellidos."','".$Rut."','".$Direccion."',";
							$sql 	= $sql."'".$Telefono."','".$FechaHoy."','".$IdPlan."')";
							mysql_query($sql,$conexion);
						}
					
					}
	
				}				
				$Mensaje = "Procesado Correctamente";
			}
			return $Mensaje;
		}
		Pie($boton,$javascript);
		echo '</form>';
?>
