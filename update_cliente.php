<?php
	include_once("includes/session.php");
	include_once("includes/functions.php");
	include_once("includes/validations.php");

	// PROCESSAMENTO DO FORM
	if (isset($_POST["submit"])) {
		// VALIDAÇÕES
		$required_fields = array("nome_cliente", "endereco");
		validate_presences($required_fields);

		// RECUPERA O ID QUE VEIO COM O GET E DEFINICAO DE VARIAVEIS DO FORM
		$id_cliente   = $_GET["id_cliente"];
		$nome_cliente = mysql_prep($_POST["nome_cliente"]);
		$doc          = mysql_prep($_POST["doc"]);
		$fixo         = mysql_prep($_POST["fixo"]);
		$cel          = mysql_prep($_POST["cel"]);
		$email        = mysql_prep($_POST["email"]);
		$endereco     = mysql_prep($_POST["endereco"]);
		$obs_cliente  = mysql_prep($_POST["obs_cliente"]);

		// CASO NÃO TENHA ERROS
		if(empty($errors)){
			$query  = "UPDATE clientes SET nome_cliente='{$nome_cliente}', doc='{$doc}', fixo='{$fixo}', cel='{$cel}', email='{$email}', endereco='{$endereco}', obs_cliente='{$obs_cliente}' WHERE id_cliente={$id_cliente} LIMIT 1";
			$result = mysqli_query($connection, $query);

			if($result && mysqli_affected_rows($connection) == 1){
				$_SESSION["msg_ok"] = "PERFEITO !<br>Cliente atualizado com sucesso !";
				redirect("/");
			}elseif(mysqli_affected_rows($connection) == 0){
				$_SESSION["msg_ok"] = "ATENÇÃO !<br>Nenhum registro foi editado !";
				redirect("/");
			}else{
				$_SESSION["msg_fail"] = "Ops ... :/<br>Ocorreu um erro e a edição deste cliente não pôde ser efetuada";
				redirect("/");
			}
		} 
	}
?>