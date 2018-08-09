<?php
	function Cabecera($titulo){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<meta content="IE=edge,requiresActiveX=true" http-equiv="X-UA-Compatible" />
<link rel="shortcut icon" href="imagenes/logo.ico" />
<link href="css/Estilo.css" rel="stylesheet" type="text/css"/>	
<title>SISTEMA</title>
</head>
<body style="background-image: url(imagenes/Fondo.jpg);">
<center>
<!-- tabla login --->
<table width='450' border='0' class='ventanas' cellspacing='0' cellpadding='0'>
<tr>
	<td colspan='3' class='tabla_ventanas' height='10' colspan='3' align='center'><?php echo strtoupper($titulo); ?></td>
</tr>
<tr><td colspan=3><br/></td></tr>
<tr>
<td colspan='3'>

<?php 

	}
	function Pie($boton,$javascript){
?>
</td>
</tr>
<tr>
<td colspan=3 align='center'><img src='imagenes/HRline200.png' width='250'></td>
</tr>
<tr>
<td height='50' colspan=3 align='center'><button class="clean-gray" onclick="<?php echo $javascript; ?>"> <?php echo strtoupper($boton); ?> </button></td>
</tr>
</table>
</center>
</body>
</html>
<?php
	}
	?>
