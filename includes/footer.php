	<div class="footer">
		<p>Toldos Mobel - <?php echo date('Y'); ?> </p>
	</div>	
	<!-- ESTILIZAÇÃO DA TABELA -->
	<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script>
		$(document).ready( function () {
			$('#tab-todos').DataTable({
				"language": {
                "lengthMenu": "Exibindo _MENU_ registros por página<br><br>",
                "info": "Mostrando página <strong style='font-size:10pt;'>_PAGE_</strong> de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(filtrado de _MAX_ registros no total)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo <i class='fas fa-arrow-circle-right'></i>",
                    "sPrevious": "<i class='fas fa-arrow-circle-left'></i> Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            }
			});
		} );
	</script>
</body>
</html>
<?php 
    if (isset($connection)) {
        mysqli_close($connection);
    }
?>