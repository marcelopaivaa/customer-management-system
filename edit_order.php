<?php
	session_start();
	include_once("includes/session.php");
	include_once("includes/functions.php");
	include_once("includes/header.php");
	include_once("includes/validations.php");
	
	if(!$_SESSION['usuario']){
		$_SESSION['msg_fail'] = "Página restrita, faça login para continuar !";
		redirect("login.php");
	}

	if(!$_GET["id_cliente"] or !$_GET["id_pedido"]){
		redirect("view_client.php");
	}
	// RECUPERANDO O ARRAY DO CLIENTE E DOS PEDIDOS
	$id_pedido = $_GET["id_pedido"];
	$clientes = find_client_by_id($_GET["id_cliente"]);
	$order = find_order_by_id($id_pedido);
?>
		<div class="content">
			<div class="tit-content">
				<div>
					<h1>Editar pedido de: <?php echo $clientes["nome_cliente"]; ?></h1>	
				</div>
				<div class="top-btn">
					<button class="btn-form verde" onclick="location.href='view_client.php?id_cliente=<?php echo $clientes
				["id_cliente"]; ?>'"><i class="fas fa-undo-alt"></i> Voltar ao cliente</button>
				</div>
			</div>		
			<br><br>
			<form action="update_order.php" method="post">
				<input type="hidden" name="id_cliente" value="<?php echo $_GET["id_cliente"] ?>">
				<input type="hidden" name="id_pedido" value="<?php echo $_GET["id_pedido"] ?>">
				<p>Data do Pedido: <br>
					<input class="campo-50" type="date" name="data" value="<?php echo $order["data"]; ?>" required>
				</p>
				<p>Valor do Pedido: <br>
					<input class="campo-50" type="tel" name="valor" value="<?php echo $order["valor"]; ?>">
				</p>
				<p>Forma de Pagamento: <br>
					<input class="campo-100" type="tel" name="forma_pagamento" value="<?php echo $order["forma_pagamento"]; ?>">
				</p>
				<p>Número do Pedido: <br>
					<input class="campo-endereco" type="text" name="detalhes" value="<?php echo $order["detalhes"]; ?>" required>
				</p>
				<p>Detalhes do Pedido: <br>
					<textarea name="obs_pedido" id="" cols="60" rows="10"><?php echo $order["obs_pedido"]; ?></textarea>
				</p>
				<input type="submit" name="submit" class="azul btn-form" value="Editar">
			</form>
		</div>
	</div>
	<!-- FECHAMENTO DO DIV MAIN -->
<?php
	include_once("includes/footer.php");
?>