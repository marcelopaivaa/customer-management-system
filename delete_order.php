<?php
	include_once("includes/session.php");
	include_once("includes/functions.php");

	if(!$_GET["id_pedido"]){
		redirect("/");
	}

	$id_pedido  = $_GET["id_pedido"];
	$id_cliente = $_GET["id_cliente"];

	$query = "DELETE FROM pedidos WHERE id_pedido={$id_pedido} LIMIT 1";
	$result = mysqli_query($connection, $query);

	if($result && mysqli_affected_rows($connection) == 1){
		$_SESSION["msg_ok"] = "PERFEITO !<br>Pedido excluído com sucesso !";
		redirect("view_client.php?id_cliente={$id_cliente}");
	}elseif(mysqli_affected_rows($connection) == 0){
		$_SESSION["msg_ok"] = "ATENÇÃO !<br>Nada foi excluído !";
		redirect("view_client.php?id_cliente={$id_cliente}");
	}else{
		$_SESSION["msg_fail"] = "Ops ... :/<br>Ocorreu um erro e a exclusão não pôde ser efetuada";
		redirect("view_client.php?id_cliente={$id_cliente}");
	}
?>