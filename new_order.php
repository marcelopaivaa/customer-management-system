<?php
	session_start();
	include_once("includes/session.php");
	include_once("includes/header.php");
	include_once("includes/connection.php");
	include_once("includes/functions.php");
	include_once("includes/validations.php");
	
	if(!$_SESSION['usuario']){
		$_SESSION['msg_fail'] = "Página restrita, faça login para continuar !";
		redirect("login.php");
	}

	if(!$_GET["id_cliente"]){
		redirect("/");
	}
	// RECUPERANDO O ARRAY DO CLIENTE
	$clientes = find_client_by_id($_GET["id_cliente"]);
?>
		<div class="content">
			<?php 
				echo message();
				$errors = errors();
				echo form_errors($errors);	
			?>
			<div class="tit-content">
				<div>
					<h1>Novo pedido para: <?php echo $clientes["nome_cliente"]; ?></h1>	
				</div>
				<div class="top-btn">
					<button class="btn-form verde" onclick="location.href='view_client.php?id_cliente=<?php echo $clientes
				["id_cliente"]; ?>'"><i class="fas fa-undo-alt"></i> Voltar ao cliente</button>
				</div>
			</div>			
			<br><br>
			<form action="create_order.php?id_cliente=<?php echo $clientes["id_cliente"]; ?>" method="post">
				<p>
					<input class="campo-50" type="date" name="data" placeholder="Data do pedido" required>
					<input class="campo-50" type="tel" name="valor" placeholder="Valor do pedido">
				</p>
				<p>
					<input class="campo-100" type="tel" name="forma_pagamento" placeholder="Forma de pagamento">
				</p>
				<p><input class="campo-endereco" type="text" name="detalhes" placeholder="Número do Pedido" required></p>
				<p><textarea name="obs_pedido" placeholder="Detalhes do pedido: Tipo de toldo ou serviço, etc ..." id="" cols="60" rows="10"></textarea></p>
				<input type="submit" name="submit" class="azul btn-form" value="Adicionar">
			</form>
		</div>
	</div>
	<!-- FECHAMENTO DO DIV MAIN -->
<?php
	include_once("includes/footer.php");
?>