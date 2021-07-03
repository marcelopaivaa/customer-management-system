<?php
	require_once("includes/connection.php");

	function redirect($localizacao){
		header("Location: " . $localizacao);
		exit;
	}

	function mysql_prep($string){
		global $connection;

		$prep_string = mysqli_real_escape_string($connection, $string);
		return $prep_string;
	}

	function test_query($result){
			if (!$result) {
				echo "<h1>Consulta ao banco de dados deu ruim ... :/</h1>" .  mysqli_error($connection);
			}
		}

	function client_list(){
		global $connection;

		$query = "SELECT * FROM clientes ORDER BY id_cliente ASC";
		$result = mysqli_query($connection, $query);
		test_query($result);

		return $result;
	}

	function order_list($id_cliente){
		global $connection;

		$query = "SELECT * FROM pedidos WHERE cliente_id = {$id_cliente} ORDER BY data DESC LIMIT 1";
		$result = mysqli_query($connection, $query);
		test_query($result);

		return $result;
	}

	function find_client_by_id($id_cliente){
		global $connection;

		// TRAZER CLIENTE ESPECIFICO
		$query  = "SELECT * ";
		$query .= "FROM clientes ";
		$query .= "WHERE id_cliente = {$id_cliente} ";
		$query .= "LIMIT 1";
		$result = mysqli_query($connection, $query);
		test_query($result);
		if ($result = mysqli_fetch_assoc($result)) {
			return $result;
		}else{
			return NULL;
		}		
	}

	function find_order_by_client($id_cliente){
		global $connection;

		// TRAZER PEDIDOS ESPECÍFICOS DE UM DETERMINADO CLIENTE
		$query  = "SELECT * ";
		$query .= "FROM pedidos ";
		$query .= "WHERE cliente_id = {$id_cliente} ";
		$result = mysqli_query($connection, $query);
		test_query($result);

		return $result;
	}


	function find_order_by_id($id_pedido){
		global $connection;

		// TRAZER PEDIDOS ESPECÍFICOS PO ID
		$query  = "SELECT * ";
		$query .= "FROM pedidos ";
		$query .= "WHERE id_pedido = {$id_pedido} ";
		$query .= "LIMIT 1";
		$result = mysqli_query($connection, $query);
		test_query($result);
		if ($result = mysqli_fetch_assoc($result)) {
			return $result;
		}else{
			return NULL;
		}
	}

	function find_user($usuario){
		global $connection;

		$query = "SELECT * FROM usuario WHERE usuario = '{$usuario}' LIMIT 1 ";
		$usuario = mysqli_query($connection, $query);
		test_query($usuario);
		if ($usuario = mysqli_fetch_assoc($usuario)) {
			return $usuario;
		}else{
			return NULL;
		}
	}

	function logado(){
		return isset($_SESSION["id_usuario"]);
	}

	function login($usuario, $senha){
		$usuario = find_user($usuario);

		if ($usuario) {
			// ENCONTRADO
		}else{
			// NÃO ENCONTRADO
		}
	}
?>