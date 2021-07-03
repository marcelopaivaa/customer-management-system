<?php
	session_start();
	include_once("includes/connection.php");
	include_once("includes/functions.php");
	include_once("includes/validations.php");

	if(empty($_POST["usuario"]) || empty($_POST["senha"])){
		redirect("login.php");
	}

	$usuario = mysqli_real_escape_string($connection, $_POST["usuario"]);
	$senha = mysqli_real_escape_string($connection, $_POST["senha"]);

	$query = "SELECT * FROM usuario WHERE usuario='{$usuario}' AND senha=md5('{$senha}')";
	$result = mysqli_query($connection, $query);
	test_query($result);

	$row = mysqli_num_rows($result);

	if($row == 1){
		$_SESSION['usuario'] = $usuario;
		redirect("/");
	}else{
		$_SESSION['msg_fail'] = "Usuário ou senha não encontrado !";
		redirect("login.php");
	}


	
?>