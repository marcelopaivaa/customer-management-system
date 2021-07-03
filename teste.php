<?php
	$valor = "R$ 1250,00";

	$number = str_replace(',','.',str_replace('.','',$valor));
	echo $number;
	echo "<br>";
	var_dump($number);

	$valor = explode(" ", $number);
	echo "<br>";
	$valor = $valor[1];
	echo $valor;

	
?>