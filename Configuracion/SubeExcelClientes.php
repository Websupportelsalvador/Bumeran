
<?php
	include('DibujaVentana.php');
	include('../ScreenCatalogo_Seguridad.php');
	Cabecera("Subir Excel");
	$boton		= "Aceptar";
	$javascript = "Aceptar();";
	echo '<form name="clientes" method="post" action="../Contenido.php">';
	echo '<center>';
	echo '<table>';
	echo '<tr>';
	echo '<td>';
	$target_path = "../Archivos/";
	$target_path = $target_path .basename( $_FILES['archivo']['name']);
	if(move_uploaded_file($_FILES['archivo']['tmp_name'], $target_path))
	{ 
		echo "El archivo ". basename( $_FILES['archivo']['name']). " ha sido subido";
	} else{
	echo "Ha ocurrido un error, Intente de nuevo!";
	}
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	Pie($boton,$javascript);
	echo '</form>';
	
?>
<script>
	function Aceptar(){
		clientes.submit();
	}
</script>