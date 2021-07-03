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

	$id_cliente = $_GET["id_cliente"];
	if(!$id_cliente){
		redirect("/");
	}
	// RECUPERANDO O ARRAY DO CLIENTE
	$clientes = find_client_by_id($id_cliente);
?>
		<div class="content">
			<?php echo message(); ?>
			<div class="tit-content">
				<div>
					<h1>Dados de: <?php echo $clientes["nome_cliente"]; ?></h1>
				</div>
				<div class="top-btn">
					<button class="btn-form verde" onclick="location.href='/'"><i class="fas fa-undo-alt"></i> Voltar ao início</button>
				</div>
			</div>
			<br><br>
			<table id="tab-view">
				<tr>
					<th width="150">Nome:</th>
					<td><?php echo $clientes["nome_cliente"]; ?></td>
				</tr>
				<tr>
					<th>CPF/CNPJ:</th>
					<td><?php echo $clientes["doc"]; ?></td>
				</tr>
				<tr>
					<th>Telefone Fixo:</th>
					<td><?php echo $clientes["fixo"]; ?></td>
				</tr>
				<tr>
					<th>Cel / Whatsapp:</th>
					<td><?php echo $clientes["cel"]; ?></td>
				</tr>
				<tr>
					<th>E-mail:</th>
					<td><?php echo $clientes["email"]; ?></td>
				</tr>
				<tr>
					<th>Endereço:</th>
					<td><?php echo $clientes["endereco"]; ?></td>
				</tr>
				<tr>
					<th>Observações:</th>
					<td><?php echo $clientes["obs_cliente"]; ?></td>
				</tr>
			</table>
			<br><br><br><br>
			<hr color="#FA5858">
			<hr color="#FA5858">
			<br><br><br><br>
			<div class="tit-content">
				<div>			
			<h1>Pedidos de: <?php echo $clientes["nome_cliente"]; ?></h1>
				</div>
				<div class="top-btn">
					<button class="btn-form verde" onclick="location.href='new_order.php?id_cliente=<?php echo $id_cliente; ?>'"><i class="fas fa-plus"></i>&nbsp; Adicionar Pedido</button>
				</div>
			</div>
			<br><br>
			<table id="tab-todos">
				<thead>
					<tr>
						<th width="120">Data</th>
						<th width="200">Nº do Pedido</th>
						<th width="140">Valor</th>
						<th width="450">Detalhes</th>
						<th width="150">Forma de Pagto</th>
						<th width="100">Ação</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$order_list = find_order_by_client($clientes["id_cliente"]);
						while($orders = mysqli_fetch_assoc($order_list)){
							echo "<tr>";
								echo "<td>";
									echo date("d/m/Y", strtotime($orders["data"]));
								echo "</td>";
								echo "<td>";
									echo $orders["detalhes"];
								echo "</td>";
								echo "<td>";
									echo $orders["valor"];
								echo "</td>";
								echo "<td>";
									echo $orders["obs_pedido"];
								echo "</td>";
								echo "<td>";
									echo $orders["forma_pagamento"];
								echo "</td>";
								echo "<td>
									<button title=\"Editar\" class=\"btn-01\" onclick=\"location.href='edit_order.php?id_cliente={$clientes["id_cliente"]}&id_pedido={$orders["id_pedido"]}';\"><i class=\"fas fa-edit\"></i></button>
									&nbsp;
									<a href=\"delete_order.php?id_pedido={$orders["id_pedido"]}&id_cliente={$id_cliente}\">
										<button title=\"Excluir\" class=\"btn-01\" onclick=\"return confirm('***** ATENÇÃO ***** \\n Essa ação não pode ser revertida. \\n \\n Tem certeza que quer excluir ?');\">
											<i class=\"far fa-trash-alt\"></i>
										</button>
									</a>
								</td>";
							echo "</tr>";
						}
					?>
				</tbody>
			</table>
		</div>
	</div><!-- FECHAMENTO DO DIV MAIN -->
<?php
	include_once("includes/footer.php");
?>