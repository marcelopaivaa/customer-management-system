<?php
	include_once("includes/session.php");
	include_once("includes/functions.php");

	if(!$_GET["id_cliente"]){
		redirect("/");
	}

	$client_orders = find_order_by_client($_GET["id_cliente"]);
	if(mysqli_num_rows($client_orders) > 0){
		$_SESSION["msg_fail"] = "ATENÇÃO !<br>Clientes com pedidos não podem ser excluídos, é preciso excluir os pedidos primeiro.";
		redirect("/");
	}

	$id_cliente   = $_GET["id_cliente"];
	
	$query = "DELETE FROM clientes WHERE id_cliente={$id_cliente} LIMIT 1";
	$result = mysqli_query($connection, $query);

	if($result && mysqli_affected_rows($connection) == 1){
		$_SESSION["msg_ok"] = "PERFEITO !<br>Cliente excluído com sucesso !";
		redirect("/");
	}elseif(mysqli_affected_rows($connection) == 0){
		$_SESSION["msg_ok"] = "ATENÇÃO !<br>Nada foi excluído !";
		redirect("/");
	}else{
		$_SESSION["msg_fail"] = "Ops ... :/<br>Ocorreu um erro e a exclusão não pôde ser efetuada";
		redirect("/");
	}
?>