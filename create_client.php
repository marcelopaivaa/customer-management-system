<?php
	session_start();
	include_once("includes/connection.php");
	include_once("includes/functions.php");
	include_once("includes/validations.php");
	
	if(!$_SESSION['usuario']){
		$_SESSION['msg_fail'] = "Página restrita, faça login para continuar !";
		redirect("login.php");
	}

	if (isset($_POST["submit"])) {
		$nome_cliente = mysql_prep($_POST["nome_cliente"]);
		$doc          = mysql_prep($_POST["doc"]);
		$fixo         = mysql_prep($_POST["fixo"]);
		$cel          = mysql_prep($_POST["cel"]);
		$email        = mysql_prep($_POST["email"]);
		$endereco     = mysql_prep($_POST["endereco"]);
		$obs_cliente  = mysql_prep($_POST["obs_cliente"]);

		// VALIDAÇÕES
		$required_fields = array("nome_cliente", "endereco");
		validate_presences($required_fields);

		// CASO TENHA ERROS
		if(!empty($errors)){
			$_SESSION["errors"] = $errors;
			redirect("new_client.php");
		}

		$query  = "INSERT INTO clientes (nome_cliente, doc, fixo, cel, email, endereco, obs_cliente) ";
		$query .= "VALUES ('{$nome_cliente}', '{$doc}', '{$fixo}', '{$cel}', '{$email}', '{$endereco}', '{$obs_cliente}')";
		$result = mysqli_query($connection, $query);

		if($result){
			$_SESSION["msg_ok"] = "PERFEITO !<br>Cliente cadastrado com sucesso !";
			redirect("/");
		}else{
			$_SESSION["msg_fail"] = "Ops ... :/<br>Ocorreu um erro e o cliente não pôde ser cadastrado" . mysqli_error($connection);
			redirect("new_client.php");
		}
	}else{
		redirect("new_client.php");
	}

	if(isset($connection)){
		mysqli_close($connection);
	}
?>