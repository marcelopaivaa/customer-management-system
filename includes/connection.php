<?php
	// CRIAR A CONEXÃO COM O BANCO DE DADOS
	define("DB_HOST", "global-db");
	define("DB_USER", "ClientesMobel");
	define("DB_PASSWORD", "newlife2020*");
	define("DB_NAME", "ClientesMobel");
	$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	mysqli_set_charset($connection, "utf8");

	//TESTAR CONEXÃO
	if (!$connection) {
		echo "Conexão deu ruim ..." . mysqli_connect_error($connection);
	}
?>