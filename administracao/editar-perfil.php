<?php 
require_once("../conexao.php"); 

$nome = $_POST['nome_usu'];
$nif = $_POST['nif_usu'];
$email = $_POST['email_usu'];
$senha = $_POST['senha_usu'];

$antigo = $_POST['antigo_usu'];
$id = $_POST['id_usu'];

if($nome == ""){
	echo 'O nome é Obrigatório!';
	exit();
}

if($email == ""){
	echo 'O email é Obrigatório!';
	exit();
}

if($nif == ""){
	echo 'O NIF é Obrigatório!';
	exit();
}


//VERIFICAR SE O REGISTRO JÁ EXISTE NO BANCO
if($antigo != $nif){
	$query = $pdo->query("SELECT * FROM usuarios where nif = '$nif' ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){
		echo 'O NIF já está Registrado!';
		exit();
	}
}


$res2 = $pdo->prepare("UPDATE usuarios SET nome = :nome, nif = :nif, email = :email, senha = :senha WHERE id = '$id'");	
$res2->bindValue(":nome", $nome);
$res2->bindValue(":nif", $nif);
$res2->bindValue(":email", $email);
$res2->bindValue(":senha", $senha);
$res2->execute();

echo 'Salvo com Sucesso!';

?>