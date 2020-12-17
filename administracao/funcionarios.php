<?php
 
@session_start();
if(!isset($_SESSION['nome_usuario']) || $_SESSION['cargo_usuario'] != 'Administrador'){
    header("location:../index.php");
}

$pagina = 'funcionarios';
require_once("../conexao.php");

?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 mt-4">
			<div class="col-md-6 float-left" style="margin-left: -15px;">
				<a type="button" class="btn-primary btn" href="index.php?pag=<?php echo $pag ?>&funcao=novo">Adicionar Novo</a>
			</div>
			<div class="col-md-6 float-right" style="display: flex; justify-content: flex-end; margin-right: -15px;">
					<b>LISTAGEM DE FUNCIONÁRIOS</b>
			</div>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-12 mb-2">
			<table id="datatable" class="table table-sm dt-responsive nowrap">
				<thead>
					<tr>
						<th>ID Interno</th>
						<th>Nome</th>
						<th>Móvel</th>
						<th>E-mail</th>
						<th>Cargo</th>
						<th>Ações</th>
					</tr>
				</thead>

				<tbody>
					<?php 

					$query = $pdo->query("SELECT * FROM funcionarios order by id asc ");
					$res = $query->fetchAll(PDO::FETCH_ASSOC);

					for ($i=0; $i < count($res); $i++) { 
						foreach ($res[$i] as $key => $value) {
						}
						$id = $res[$i]['id'];
						$num_funcionario = $res[$i]['num_funcionario'];
						$nome = $res[$i]['nome_funcionario'];
						$movel = $res[$i]['movel'];
						$email = $res[$i]['email'];
						$cargo = $res[$i]['cargo'];


						?>


						<tr>
							<td><?php echo $num_funcionario ?></td>
							<td><?php echo $nome ?></td>
							<td><?php echo $movel ?></td>
							<td><?php echo $email ?></td>
							<td><?php echo $cargo ?></td>


							<td>
								<a type="button" href="index.php?pag=novo_funcionario&funcao=editar&id=<?php echo $id ?>" class='btn btn-primary mr-1 btn-sm' title='Editar Dados'><i class='fa fa-edit'></i></a>
								<a type="button" href="index.php?pag=<?php echo $pag ?>&funcao=excluir&id=<?php echo $id ?>" class='btn btn-danger mr-1 btn-sm' title='Excluir Registro'><i class='fa fa-trash'></i></a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="modal" id="modal-deletar" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Excluir Registro</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<p>Deseja realmente Excluir este Registro?</p>

				<div align="center" id="mensagem_excluir" class="">

				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancelar-excluir">Cancelar</button>
				<form method="post">

					<input type="hidden" id="id"  name="id" value="<?php echo @$_GET['id'] ?>" required>

					<button type="button" id="btn-deletar" name="btn-deletar" class="btn btn-danger">Excluir</button>
				</form>
			</div>
		</div>
	</div>
</div>





<?php 

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "novo") {
	echo "<script language='javascript'> window.location='index.php?pag=novo_funcionario'</script>";
}
/*
if (@$_GET["funcao"] != null && @$_GET["funcao"] == "editar") {
	echo "<script>$('#modalDados').modal('show');</script>";
}
*/
if (@$_GET["funcao"] != null && @$_GET["funcao"] == "excluir") {
	echo "<script>$('#modal-deletar').modal('show');</script>";
}

?>




<!--AJAX PARA INSERÇÃO E EDIÇÃO DOS DADOS COM IMAGEM -->
<script type="text/javascript">
	$("#form").submit(function () {
		var pag = "<?=$pag?>";
		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: pag + "/inserir.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {

				$('#mensagem').removeClass()

				if (mensagem.trim() == "Rigisto efectuado com Sucesso") {

                    //$('#nome').val('');
                    //$('#cpf').val('');
                    $('#btn-fechar').click();
                    window.location = "index.php?pag="+pag;

                } else {

                	$('#mensagem').addClass('text-danger')
                }

                $('#mensagem').text(mensagem)

            },

            cache: false,
            contentType: false,
            processData: false,
            xhr: function () {  // Custom XMLHttpRequest
            	var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                	myXhr.upload.addEventListener('progress', function () {
                		/* faz alguma coisa durante o progresso do upload */
                	}, false);
                }
                return myXhr;
            }
        });
	});
</script>





<!--AJAX PARA EXCLUSÃO DOS DADOS -->
<script type="text/javascript">
	$(document).ready(function () {
		var pag = "<?=$pag?>";
		$('#btn-deletar').click(function (event) {
			event.preventDefault();

			$.ajax({
				url: pag + "/excluir.php",
				method: "post",
				data: $('form').serialize(),
				dataType: "text",
				success: function (mensagem) {

					if (mensagem.trim() === 'Excluído com Sucesso!') {


						$('#btn-cancelar-excluir').click();
						window.location = "index.php?pag=" + pag;
					}

					$('#mensagem_excluir').text(mensagem)



				},

			})
		})
	})
</script>



<!--SCRIPT PARA CARREGAR IMAGEM -->
<script type="text/javascript">

	function carregarImg() {

		var target = document.getElementById('target');
		var file = document.querySelector("input[type=file]").files[0];
		var reader = new FileReader();

		reader.onloadend = function () {
			target.src = reader.result;
		};

		if (file) {
			reader.readAsDataURL(file);


		} else {
			target.src = "";
		}
	}

</script>





<script type="text/javascript">
	$(document).ready(function () {
		$('#dataTable').dataTable({
			"ordering": false
		})

	});
</script>



