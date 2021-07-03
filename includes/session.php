<?php
	session_start();

	function message(){
		if(isset($_SESSION["msg_ok"])){
			$message  = "<div class=\"msg_ok\">";
			$message .= $_SESSION["msg_ok"];
			$message .= "</div>";

			$_SESSION["msg_ok"] = NULL;

			return $message;
		}elseif(isset($_SESSION["msg_fail"])){
			$message  = "<div class=\"msg_fail\">";
			$message .= $_SESSION["msg_fail"];
			$message .= "</div>";

			$_SESSION["msg_fail"] = NULL;

			return $message;
		}
	}

	function errors(){
		if(isset($_SESSION[errors])){
			$errors = $_SESSION[errors];

			$_SESSION[errors] = NULL;

			return $errors;
		}
	}
?>