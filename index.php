<?php
	session_start();
	include_once("includes/session.php");
	include_once("includes/header.php");
	include_once("includes/connection.php");
	include_once("includes/functions.php");
	
	if(!$_SESSION['usuario']){
		$_SESSION['msg_fail'] = "Página restrita, faça login para continuar !";
		redirect("login.php");
	}
?>
		<div class="content">
			<?php echo message(); ?>
			<div class="tit-content">
				<div>
					<h1>Lista de Clientes</h1>
				</div>
				<div class="top-btn">
					<button class="btn-form verde" onclick="location.href='new_client.php'"><i class="fas fa-plus"></i>&nbsp; Novo Cliente</button>
				</div>
			</div>
			<br><br>
			<table id="tab-todos">
				<thead>
					<tr>
						<th width="150">Cliente</th>
						<th width="300">Endereço</th>
						<th width="100">Último pedido</th>
						<th width="100">Ação</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$list_client = client_list();
						while ($clientes = mysqli_fetch_assoc($list_client)){
							echo "<tr>";
							$cliente_id = $clientes["id_cliente"];
							echo "<td onclick=\"location.href='view_client.php?id_cliente={$cliente_id}';\">";
							echo $clientes["nome_cliente"];
							echo "</td>";
							echo "<td onclick=\"location.href='view_client.php?id_cliente={$cliente_id}';\">";
							echo $clientes["endereco"];
							echo "</td>";
								$order_list = order_list($clientes["id_cliente"]);
								if(mysqli_num_rows($order_list) > 0){
									while($client_order = mysqli_fetch_assoc($order_list)){
											$last_order = date("d/m/Y", strtotime($client_order["data"]));
											echo "<td onclick=\"location.href='view_client.php?id_cliente={$cliente_id}';\">";
											echo $last_order;
											echo "</td>";
									}
								}else{
									echo "<td>Nenhum pedido</>";
								}								
							echo "<td>
									<button title=\"Adicionar Pedido\" class=\"btn-01\" onclick=\"location.href='new_order.php?id_cliente={$cliente_id}';\"><i class=\"fas fa-plus\"></i></i></button>
									&nbsp;
									<button title=\"Editar Cliente\" class=\"btn-01\" onclick=\"location.href='edit_client.php?id_cliente={$cliente_id}';\"><i class=\"far fa-edit\"></i></button>
									&nbsp;
									<a href=\"delete_client.php?id_cliente={$clientes["id_cliente"]}\">
										<button title=\"Excluir Cliente\" class=\"btn-01\" onclick=\"return confirm('********__  ATENÇÃO  __******** \\n Essa ação não pode ser revertida. \\n \\n Tem certeza que quer excluir ?');\">
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