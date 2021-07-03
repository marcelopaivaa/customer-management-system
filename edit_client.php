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
					<h1>Editando: <?php echo $clientes["nome_cliente"]; ?></h1>
				</div>
				<div class="top-btn">
					<button class="btn-form verde" onclick="location.href='/'"><i class="fas fa-undo-alt"></i> Voltar</button>
				</div>
			</div>
			<br><br>
			<form action="update_cliente.php?id_cliente=<?php echo $clientes["id_cliente"]; ?>" method="post">
				<p>Nome do cliente:
					<input class="campo-100" type="text" name="nome_cliente" value="<?php echo $clientes["nome_cliente"]; ?>"></p>
					<p>CPF/CNPJ:<br>
					<input class="campo-50" type="tel" name="doc" value="<?php echo $clientes["doc"]; ?>">
				</p><p>Telefone fixo:<br>
					<input class="campo-50" type="tel" name="fixo" value="<?php echo $clientes["fixo"]; ?>">
				</p>
				<p>Cel / Whatsapp: <br>
					<input class="campo-50" type="tel" name="cel" value="<?php echo $clientes["cel"]; ?>">
				</p>
				<p>E-mail: <br>
					<input class="campo-50" type="text" name="email" value="<?php echo $clientes["email"]; ?>">
				</p>
				<p>Endereço:
					<input class="campo-endereco" type="text" name="endereco" value="<?php echo $clientes["endereco"]; ?>">
				</p>
				<p>Observações:
					<textarea name="obs_cliente" cols="60" rows="10"><?php echo $clientes["obs_cliente"]; ?></textarea>
				</p>
				<input type="submit" name="submit" class="btn-form azul" value="Editar">
			</form>
		</div>
	</div>
	<!-- FECHAMENTO DO DIV MAIN -->
<?php
	include_once("includes/footer.php");
?>