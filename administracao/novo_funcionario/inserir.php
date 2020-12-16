<?php 
require_once("../../conexao.php");

$nome_funcionario = $_POST['nome-func'];
$bilhete = $_POST['bilhete-func'];
$nif = $_POST['nif-func'];
$nss = $_POST['nss-func']; 
$cargo = $_POST['cargo-func'];
$movel = $_POST['movel-func'];
$email = $_POST['email-func'];
$morada = $_POST['morada-func'];
$num_funcionario = $_POST['num-func'];



$antigo = $_POST['antigo'];
$antigo2 = $_POST['antigo2'];
$antigo3 = $_POST['antigo3'];
$id = $_POST['txtid2'];

$length = 10;
$str = '1234567890ABCDE';

$teste = substr(str_shuffle($str), 0, $length);

//criar número de colaborador
$letras = '';
$numeros = '';
foreach (range('A', 'Z') as $char) {
	$letras .= $char;
}
for($i = 0; $i < 10; $i++){
	$numeros .= $i;
}
$colaborador_id = substr(str_shuffle($letras), 0, 3).substr(str_shuffle($numeros), 0, 9);

if ($num_funcionario != "") {
	$col_id = $num_funcionario;	
}else{
	$col_id = $colaborador_id;
} 

if($nome_funcionario == ""){
	echo 'O Nome é Obrigatório!';
	exit();
}

if($email == ""){
	echo 'O E-mail é Obrigatório!';
	exit();
}

if($nif == ""){
	echo 'O NIF é Obrigatório!';
	exit();
}

if($nss == ""){
	echo 'O NSS é Obrigatório!';
	exit();
}
//VERIFICAR REGISTOS EXISTENTES NO BANCO DE DADOS
if ($antigo != $nif) {
	$query = $pdo->query("SELECT * FROM funcionarios where nif = '$nif'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);

	$total_registo = @count($res);
	if ($total_registo > 0) {
		echo 'Este NIF já está registado';
		exit();
	}
}

//VERIFICAR REGISTOS EXISTENTES NO BANCO DE DADOS
if ($antigo2 != $bilhete) {
	$query = $pdo->query("SELECT * FROM funcionarios where bilhete = '$bilhete'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);

	$total_registo = @count($res);
	if ($total_registo > 0) {
		echo 'Este B.I já está registado';
		exit();
	}
}

//VERIFICAR REGISTOS EXISTENTES NO BANCO DE DADOS
if ($antigo3 != $nss) {
	$query = $pdo->query("SELECT * FROM funcionarios where nss = '$nss'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);

	$total_registo = @count($res);
	if ($total_registo > 0) {
		echo 'Este NSS já está registado';
		exit();
	}
}


if ($id == "") {
	$res = $pdo->prepare("INSERT INTO funcionarios SET num_funcionario = :num_funcionario, nome_funcionario = :nome_funcionario, bilhete = :bilhete, nif = :nif, nss = :nss, cargo = :cargo, morada = :morada, movel = :movel, email = :email ");

	$res2 = $pdo->prepare("INSERT INTO usuarios SET nome = :nome, nif = :nif, email = :email, senha = :senha, nivel = :nivel");
	$res2->bindValue(":senha", $col_id);
	$res2->bindValue(":nivel", $cargo);
}else{
	$res = $pdo->prepare("UPDATE funcionarios SET num_funcionario = :num_funcionario, nome_funcionario = :nome_funcionario, bilhete = :bilhete, nif = :nif, nss = :nss, cargo = :cargo, morada = :morada, movel = :movel, email = :email WHERE id = $id ");

	$res2 = $pdo->prepare("UPDATE usuarios SET nome = :nome, nif = :nif, email = :email WHERE nif = $antigo");
}

$res->bindValue(":num_funcionario", $col_id);
$res->bindValue(":nome_funcionario", $nome_funcionario);
$res->bindValue(":bilhete", $bilhete);
$res->bindValue(":nif", $nif);
$res->bindValue(":nss", $nss);
$res->bindValue(":cargo", $cargo);
$res->bindValue(":morada", $morada);
$res->bindValue(":movel", $movel);
$res->bindValue(":email", $email);

$res2->bindValue(":nome", $nome_funcionario);
$res2->bindValue(":nif", $nif);
$res2->bindValue(":email", $email);


$res->execute();
$res2->execute();


echo 'Rigisto efectuado com Sucesso';

?>