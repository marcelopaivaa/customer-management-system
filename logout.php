<?php
	session_start();
	include_once("includes/session.php");
	include_once("includes/functions.php");
	unset($_SESSION['usuario']);
	$_SESSION['msg_ok'] = "Você saiu com segurança !";
	redirect("login.php");
?>