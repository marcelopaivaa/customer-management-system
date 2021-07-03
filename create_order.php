<?php
	session_start();
	include_once("includes/connection.php");
	include_once("includes/functions.php");
	include_once("includes/validations.php");

	if (isset($_POST["submit"])) {
		$cliente_id      = $_GET["id_cliente"];
		$data            = mysql_prep($_POST["data"]);
		$valor           = mysql_prep($_POST["valor"]);
		$forma_pagamento = mysql_prep($_POST["forma_pagamento"]);
		$detalhes        = mysql_prep($_POST["detalhes"]);
		$obs_pedido      = mysql_prep($_POST["obs_pedido"]);

		// VALIDAÇÕES
		$required_fields = array("data", "detalhes");
		validate_presences($required_fields);

		// CASO TENHA ERROS
		if(!empty($errors)){
			$_SESSION["errors"] = $errors;
			redirect("new_order.php");
		}

		$query  = "INSERT INTO pedidos (cliente_id, data, detalhes, valor, forma_pagamento, obs_pedido) VALUES ({$cliente_id}, '{$data}', '{$detalhes}', '{$valor}', '{$forma_pagamento}', '{$obs_pedido}')";
		$result = mysqli_query($connection, $query);

		if($result){
			$_SESSION["msg_ok"] = "PERFEITO !<br>Pedido adicionado com sucesso !";
			redirect("view_client.php?id_cliente={$cliente_id}");
		}else{
			$_SESSION["msg_fail"] = "Ops ... :/<br>Ocorreu um erro e o pedido não pôde ser cadastrado: "  . mysqli_error($connection);
			redirect("view_client.php?id_cliente={$cliente_id}");
		}
	}else{
		redirect("view_client.php?id_cliente={$cliente_id}");
	}

	if(isset($connection)){
		mysqli_close($connection);
	}
?>