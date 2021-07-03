<?php
	include_once("includes/session.php");
	include_once("includes/functions.php");
	include_once("includes/validations.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/styles.css">
	<title>Login do sistema</title>
</head>
<body class="login-page">
	<?php 
		echo message();
		$errors = errors();
		echo form_errors($errors);	
	?>
	<div class="login-box">
	<h4>Controle de Clientes</h4>
		<img src="images/logo.png" alt="logo Mobel">
		<form action="check_login.php" method="post" class="login-fm">
			<p>
				<input type="text" name="usuario" placeholder="Nome de usuário">
			</p>
			<p>
				<input type="password" name="senha" placeholder="Senha">
			</p>
			<input type="submit" name="submit" value="Entrar">
		</form>
	</div>
</body>
</html>
<?php 
	if(isset($connection)){
		mysqli_close($connection);
	}
?>