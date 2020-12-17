<?php 

require_once("conexao.php");
@session_start();

$email = $_POST['email'];
$senha = $_POST['senha'];

$query = $pdo->prepare("SELECT * FROM usuarios where email = :email and senha = :senha");
$query->bindValue(":email", $email);
$query->bindValue(":senha", $senha);
$query->execute();

$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_registo = @count($res);
	if ($total_registo > 0) {
		$_SESSION['id_usuario'] = $res[0]['id'];
		$_SESSION['nome_usuario'] = $res[0]['nome'];
		$_SESSION['nif_usuario'] = $res[0]['nif'];
		$_SESSION['nivel_usuario'] = $res[0]['nivel'];
		
		$nivel = $res[0]['nivel'];

		if ($nivel == 'Administrador') {
			echo "<script language='javascript'> window.location='administracao'</script>";
		}
		if ($nivel == 'Mécanico') {
			echo "<script language='javascript'> window.location='mecanico'</script>";
		}
		if ($nivel == 'Recepcionista') {
			echo "<script language='javascript'> window.location='mecanico'</script>";
		}
	}else{

		echo "<script language='javascript'> window.alert('Dados de acesso incorretos')</script>";

		echo "<script language='javascript'> window.location='index.php'</script>";

	}

?>