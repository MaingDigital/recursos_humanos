<?php

@session_start();
if(@$_SESSION['nivel_usuario'] == null || @$_SESSION['nivel_usuario'] != 'Administrador'){
	echo "<script language='javascript'> window.location='../index.php' </script>";
}

$pag = "novo_funcionario";
require_once("../conexao.php");

if (@$_GET['funcao'] == 'editar') {
	$titulo = "Editar Registro";
	$id2 = $_GET['id'];

	$query = $pdo->query("SELECT * FROM funcionarios where id = '$id2' ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);

	$nome2 = $res[0]['nome_funcionario'];
	$bilhete2 = $res[0]['bilhete'];
	$nif2 = $res[0]['nif'];
	$nss2 = $res[0]['nss'];
	$cargo2 = $res[0]['cargo'];
	$morada2 = $res[0]['morada'];
	$movel2 = $res[0]['movel'];
	$email2 = $res[0]['email'];
	$func2 = $res[0]['num_funcionario'];


} else {
	$titulo = "Registro de Dados";

}


?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-6 float-left" style="margin-left: -15px; margin-top: 20px;">
				<h5><?php echo $titulo ?></h5>
			</div>
			<div class="col-md-6 float-right" style="display: flex; justify-content: flex-end; margin-right: -15px;">
				<h5 class="mt-4"><?php echo @$func2 ?></h5>
			</div>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-12 mb-2">
		<!-- 	<form id="form" method="POST"> 

				<div class="form-group">
					<label >Nome</label>
					<input value="<?php echo @$nome2 ?>" type="text" class="form-control" id="nome-func" name="nome-func" placeholder="Nome">
				</div>
				<div class="row">
					<div class="form-group col-md-6">
						<label >Bilhete</label>
						<input value="<?php echo @$bilhete2 ?>" type="text" class="form-control" id="bilhete-func" name="bilhete-func" placeholder="B.I">
					</div>
					<div class="form-group col-md-6">
						<label >Contribuinte</label>
						<input value="<?php echo @$nif2 ?>" type="text" class="form-control" id="nif" name="nif-func" placeholder="Nif">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-6">
						<label >NSS</label>
						<input value="<?php echo @$nss2 ?>" type="text" class="form-control" id="nss-func" name="nss-func" placeholder="NSS">
					</div>
					<div class="form-group col-md-6">
						<label >Cargo</label>
						<input value="<?php echo @$cargo2 ?>" type="text" class="form-control" id="cargo-func" name="cargo-func" placeholder="Cargo">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-6">
						<label >Movel</label>
						<input value="<?php echo @$movel2 ?>" type="text" class="form-control" id="movel-func" name="movel-func" placeholder="Movel">
					</div>
					<div class="form-group col-md-6">
						<label >Email</label>
						<input value="<?php echo @$email2 ?>" type="text" class="form-control" id="email-func" name="email-func" placeholder="Email">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-12">
						<label >Morada</label>
						<input value="<?php echo @$morada2 ?>" type="text" class="form-control" id="morada-func" name="morada-func" placeholder="Morada">
					</div>
					<div class="form-group">
						<input value="<?php echo @$func2 ?>" type="hidden" class="form-control" id="num-func" name="num-func" placeholder="Funcionário ID">
					</div>
				</div>

				<small>
					<div id="mensagem">

					</div>
				</small> 

				<input value="<?php echo @$_GET['id'] ?>" type="hidden" name="txtid2" id="txtid2">

				<input value="<?php echo @$nif2 ?>" type="hidden" name="antigo" id="antigo">
				<input value="<?php echo @$bilhete2 ?>" type="hidden" name="antigo2" id="antigo2">
				<input value="<?php echo @$nss2 ?>" type="hidden" name="antigo3" id="antigo3">

				<a href="index.php?pag=funcionarios" type="button" id="btn-fechar" class="btn btn-danger btn-icon"><i class="fa fa-times"></i>Sair</a>
				<button type="submit" name="btn-salvar" id="btn-salvar" class="btn btn-success btn-icon"><i class="fa fa-floppy-o "></i>Salvar</button>

			</form>  -->

			<form id="form" method="POST">
				<ul class="nav nav-tabs nav-justified mb-4" id="myTab2" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="home-tab1" data-toggle="tab" href="#dados_pessoais" role="tab" aria-controls="dados_pessoais" aria-selected="true">Dados Pessoais</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="profile-tab1" data-toggle="tab" href="#identidade_banco" role="tab" aria-controls="identidade_banco" aria-selected="false">Identificação & Banco</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="contact-tab1" data-toggle="tab" href="#empresarial" role="tab" aria-controls="empresarial" aria-selected="false">Para Uso da Empresa</a>
					</li>
				</ul>
				<div class="tab-content" id="myTabContent1 mt-4">
					<div class="tab-pane show active" id="dados_pessoais" role="tabpanel" aria-labelledby="home-tab1">
						<div class="form-group mt-2 mb-4">
							<label for="inputAddress" class="col-form-label">Nome Completo</label>
							<input value="<?php echo @$nome2 ?>" type="text" class="form-control" id="nome-func" name="nome-func" placeholder="Nome Completo">
						</div>
						<div class="form-row mt-4">
							<div class="form-group col-md-4">
								<label for="inputEmail4" class="col-form-label">Local de Nascimento</label>
								<input value="<?php echo @$local_nascimento2 ?>" type="text" class="form-control" id="local_nascimento" name="local_nascimento" placeholder="Local de Nascimento">
							</div>
							<div class="form-group col-md-4">
								<label for="inputPassword4" class="col-form-label">Data de Nascimento</label>
								<input value="<?php echo @$data_nascimento2 ?>" type="date" class="form-control" id="data_nascimento" name="data_nascimento" placeholder="morada">
							</div>
							<div class="form-group col-md-4">
								<label for="inputState" class="col-form-label">Sexo</label>
								<select class="form-control" id="sexo" name="sexo">
									<option>Selecionar</option>
									<option>Masculino</option>
									<option>Feminino</option>
								</select>
							</div>
						</div>
						<div class="form-row mt-4">
							<div class="form-group col-md-4">
								<label for="inputCity" class="col-form-label">Morada</label>
								<input value="<?php echo @$morada2 ?>" type="text" class="form-control" placeholder="Avenida" id="morada-func" name="morada-func">
							</div>
							<div class="form-group col-md-4">
								<label for="inputState" class="col-form-label">Cidade</label>
								<select id="cidade" name="cidade" class="form-control">
									<option>Selecionar</option>
									<option>Luanda</option>
									<option>Cabinda</option>
								</select>
							</div>
							<div class="form-group col-md-4">
								<label for="inputState" class="col-form-label">Estado Civil</label>
								<select id="estado_civil" name="estado_civil" class="form-control">
									<option>Selecionar</option>
									<option>Luanda</option>
									<option>Cabinda</option>
								</select>
							</div>
						</div>
						<div class="form-row mt-4">
							<div class="form-group col-md-4">
								<label for="inputCity" class="col-form-label">Telefone</label>
								<input value="<?php echo @$telefone2 ?>" type="text" class="form-control" placeholder="Telefone" id="telefone" name="telefone">
							</div>
							<div class="form-group col-md-4">
								<label for="inputCity" class="col-form-label">Telemóvel</label>
								<input value="<?php echo @$movel2 ?>" type="text" class="form-control" placeholder="Telemóvel" id="movel-func">
							</div>
							<div class="form-group col-md-4">
								<label for="inputCity" class="col-form-label">E-mail</label>
								<input value="<?php echo @$email2 ?>" type="email" class="form-control" placeholder="E-mail" id="email2" name="email2">
							</div>
						</div>

					</div>
					<div class="tab-pane" id="identidade_banco" role="tabpanel" aria-labelledby="profile-tab1">
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="inputEmail4" class="col-form-label">Nº de Bilhete</label>
								<input value="<?php echo @$bilhete2 ?>" type="text" class="form-control" id="bilhete-func" name="bilhete-func" placeholder="Nº de Bilhete">
							</div>
							<div class="form-group col-md-4">
								<label for="inputPassword4" class="col-form-label">Data de Validade</label>
								<input value="<?php echo @$data_validade2 ?>" type="date" class="form-control" id="data_validade" name="data_validade" placeholder="Data de Validade">
							</div>
							<div class="form-group col-md-4">
								<label for="inputPassword4" class="col-form-label">Nº Contribuinte</label>
								<input value="<?php echo @$nif2 ?>" type="date" class="form-control" id="nif" name="nif-func" placeholder="NIF">
							</div>
						</div>
						<div class="form-row mb-3 mt-4">
							<div class="form-group col-md-4">
								<label for="inputCity" class="col-form-label">Nº S. Social</label>
								<input value="<?php echo @$nss2 ?>" type="text" class="form-control" placeholder="INSS" id="nss-func">
							</div>
							<div class="form-group col-md-4">
								<label for="inputCity" class="col-form-label">Grau de Ensino</label>
								<input type="text" class="form-control" placeholder="Ex: Superior" id="inputCity">
							</div>
							<div class="form-group col-md-4">
								<label for="inputCity" class="col-form-label">Entidade Formadora</label>
								<input type="text" class="form-control" placeholder="Entidade" id="inputCity">
							</div>
						</div>
						<br>
						<span>Dados Bancarios</span>
						<hr style="height: 2px;">
						<div class="form-row mt-4 mb-4">
							<div class="form-group col-md-4">
								<label for="inputCity" class="col-form-label">Nome do Banco</label>
								<input type="text" class="form-control" placeholder="Banco" id="inputCity">
							</div>							
							<div class="form-group col-md-4">
								<label for="inputCity" class="col-form-label">Nº de Conta</label>
								<input type="text" class="form-control" placeholder="0000-0000-0000-000" id="inputCity">
							</div>
							<div class="form-group col-md-4">
								<label for="inputCity" class="col-form-label">IBAN</label>
								<input type="email" class="form-control" placeholder="AO06-0000-0000-0000-000" id="inputCity">
							</div>
						</div>
					</div>
					<div class="tab-pane" id="empresarial" role="tabpanel" aria-labelledby="empresarial-tab1">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="tipo_contrato" class="col-form-label">Tipo de Contrato</label>
								<select id="tipo_contrato" class="form-control">
									<option>Selecionar</option>
									<option>Masculino</option>
									<option>Feminino</option>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label for="data_admissao" class="col-form-label">Data de Admissão</label>
								<input type="date" class="form-control" id="data_admissao" placeholder="morada">
							</div>
						</div>
						<div class="form-row mt-4">
							<div class="form-group col-md-6">
								<label for="departamento" class="col-form-label">Departamento</label>
								<select id="departamento" class="form-control">
									<option>Selecionar</option>
									<option>Luanda</option>
									<option>Cabinda</option>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label for="cargo" class="col-form-label">Cargo</label>
								<select id="cargo" class="form-control">
									<option>Selecionar</option>
									<option>Luanda</option>
									<option>Cabinda</option>
								</select>
							</div>
						</div>
						<div class="form-row mt-4" style="margin-bottom: 31px">
							<div class="form-group col-md-6">
								<label for="salario" class="col-form-label">Salário Base</label>
								<input type="text" class="form-control" placeholder="Base" id="salario">
							</div>
							<div class="form-group col-md-6">
								<label for="turno" class="col-form-label">Turno</label>
								<input type="text" class="form-control" placeholder="Turno" id="turno">
							</div>
						</div>
						<br><br><br>
					</div>
				</div>

				<input value="<?php echo @$_GET['id'] ?>" type="hidden" name="txtid2" id="txtid2">

				<input value="<?php echo @$nif2 ?>" type="hidden" name="antigo" id="antigo">
				<input value="<?php echo @$bilhete2 ?>" type="hidden" name="antigo2" id="antigo2">
				<input value="<?php echo @$nss2 ?>" type="hidden" name="antigo3" id="antigo3">

				<button type="submit" name="btn-salvar" id="btn-salvar" class="btn btn-success btn-icon mb-4 mt-4"><i class="fa fa-floppy-o "></i>Salvar</button>

				<a href="index.php?pag=funcionarios" type="button" id="btn-fechar" class="btn btn-danger btn-icon mb-4 mt-4"><i class="fa fa-times"></i>Sair</a>
				
			</form>
		</div>
	</div>
</div>




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
                    window.location = "index.php?pag=funcionarios";

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

