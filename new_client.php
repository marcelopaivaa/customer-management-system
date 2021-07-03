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
?>
		<div class="content">
			<?php 
				echo message();
				$errors = errors();
				echo form_errors($errors);	
			?>
			<div class="tit-content">
				<div>
			<h1>Adicionar Novo Cliente</h1>	
				</div>
				<div class="top-btn">
					<button class="btn-form verde" onclick="location.href='/'"><i class="fas fa-undo-alt"></i> Voltar</button>
				</div>
			</div>
			<br><br>
			<form action="create_client.php" method="post">
				<p>
					<input class="campo-75" type="text" name="nome_cliente" placeholder="Nome do cliente">
					<input class="campo-50" type="text" name="doc" placeholder="CPF/CNPJ">
				</p>
				<p>
					<input class="campo-50" type="tel" name="fixo" placeholder="Telefone fixo">
					<input class="campo-50" type="tel" name="cel" placeholder="Cel / Whatsapp">
					<input class="campo-50" type="text" name="email" placeholder="E-mail">
				</p>
				<p><input class="campo-endereco" type="text" name="endereco" placeholder="Endereço"></p>
				<p><textarea name="obs_cliente" placeholder="Escreva alguma observação" id="" cols="60" rows="10"></textarea></p>
				<input type="submit" name="submit" class="azul btn-form" value="Adicionar">
			</form>
		</div>
	</div>
	<!-- FECHAMENTO DO DIV MAIN -->
<?php
	include_once("includes/footer.php");
?>