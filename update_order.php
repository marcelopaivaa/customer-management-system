<?php
	include_once("includes/session.php");
	include_once("includes/functions.php");
	include_once("includes/validations.php");

	// PROCESSAMENTO DO FORM
	if (isset($_POST["submit"])){
		// VALIDAÇÕES
		$required_fields = array("data", "detalhes");
		validate_presences($required_fields);

		// RECUPERA O ID QUE VEIO COM O GET E DEFINICAO DE VARIAVEIS DO FORM
		$id_cliente      = $_POST["id_cliente"];
		$id_pedido       = $_POST["id_pedido"];
		$data            = mysql_prep($_POST["data"]);
		$valor           = mysql_prep($_POST["valor"]);
		$forma_pagamento = mysql_prep($_POST["forma_pagamento"]);
		$detalhes        = mysql_prep($_POST["detalhes"]);
		$obs_pedido      = mysql_prep($_POST["obs_pedido"]);

		// CASO NÃO TENHA ERROS
		if(empty($errors)){
			$query  = "UPDATE pedidos SET cliente_id={$id_cliente}, data='{$data}', detalhes='{$detalhes}', valor='{$valor}', forma_pagamento='{$forma_pagamento}', obs_pedido='{$obs_pedido}' WHERE id_pedido={$id_pedido} LIMIT 1";
			$result = mysqli_query($connection, $query);

			if($result && mysqli_affected_rows($connection) == 1){
				$_SESSION["msg_ok"] = "PERFEITO !<br>Pedido atualizado com sucesso !";
				redirect("view_client.php?id_cliente={$id_cliente}");
			}elseif(mysqli_affected_rows($connection) == 0){
				$_SESSION["msg_ok"] = "ATENÇÃO !<br>Nenhum registro foi editado !";
				redirect("view_client.php?id_cliente={$id_cliente}");
			}else{
				$_SESSION["msg_fail"] = "Ops ... :/<br>Ocorreu um erro e a edição deste pedido não pôde ser efetuada: " . mysqli_error($connection);
				redirect("view_client.php?id_cliente={$id_cliente}");
			}
		} 
	}
?>