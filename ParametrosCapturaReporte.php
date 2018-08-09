<?php
	$campo	 	= trim($dibujafila[0]);
	$rotulo	 	= trim($dibujafila[1]);
	$filtro  	= trim($dibujafila[2]);
	$tipo	 	= trim($dibujafila[3]);
	$valor   	= trim($dibujafila[4]);
	$obligatorio= trim($dibujafila[5]);
	$includes	= trim($dibujafila[6]);
	$requerido	= "";
	if($obligatorio=="r"){
				$requerido = "<span class='Requerido'>*&nbsp;</span>";
	}
	#para caja de texto
	if(strtoupper($campo)=="CMP" and strtoupper($tipo)=="TEXT"){		
		$dibujatxt  = '<input type="'.$tipo.'" value="'.$valor.'" name="'.$filtro.'"/>';		
		echo '<tr><td>'.$requerido.$rotulo.'</td><td>'.$dibujatxt.'</td></tr>';		
	}
	#para select
	if(strtoupper($campo)=="CMP" and strtoupper($tipo)=="SELECT"){
		echo '<tr><td>'.$requerido.$rotulo.'</td><td>';
		echo '<select name="'.$filtro.'">';
		include('configuracion/'.$includes);
		echo '</select>';
		echo '</td></tr>';
		
	}
	#para date
	if(strtoupper($campo)=="CMP" and strtoupper($tipo)=="DATE"){		
		$dibujatxt  = '<input type="TEXT" class="tcal" value="'.$valor.'" name="'.$filtro.'"/>';		
		echo '<tr><td>'.$requerido.$rotulo.'</td><td>'.$dibujatxt.'</td></tr>';		
	}
?>