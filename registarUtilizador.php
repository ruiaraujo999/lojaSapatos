<?php 
session_start();

require('../includes/connection.php');

$email 			= $_POST['email'];
$nome 			= $_POST['nome'];
$numero 		= $_POST['numero'];
$sobrenome 		= $_POST['sobrenome'];
$endereco 		= $_POST['endereco'];
$codigoPostal 	= $_POST['codigoPostal'];
$localidade 	= $_POST['localidade'];
$cidade 		= $_POST['cidade'];
$palavraChave 	= md5($_POST['palavraChave']);

$sql ='SELECT email FROM utilizadores WHERE email = :e';
$sth = $dbh ->prepare($sql);
$sth->bindParam('e', $email);
$sth->execute();

if($sth && $sth->rowCount() == 1){
    $_SESSION['emailRegistado'] = 1;
    header('Location:../registo.php');    
}
else{
    $sql = 'INSERT INTO utilizadores (email, nome, sobrenome, numero, endereco, codigoPostal, localidade, cidade, palavraChave) VALUES
    (:email, :nome, :sobrenome, :numero, :endereco, :codigoPostal, :localidade, :cidade, :palavraChave);';

    $sth = $dbh ->prepare($sql);
    $sth->bindParam('email', $email);
    $sth->bindParam('nome', $nome);
    $sth->bindParam('sobrenome', $sobrenome);
    $sth->bindParam('numero', $numero);
    $sth->bindParam('endereco', $endereco);
    $sth->bindParam('codigoPostal', $codigoPostal);
    $sth->bindParam('localidade', $localidade);
    $sth->bindParam('cidade', $cidade);
    $sth->bindParam('palavraChave', $palavraChave);
    $sth->execute();

    if($sth && $sth->rowCount() == 1){
        $_SESSION['registado'] = 1;
        $_SESSION['emailRegistado'] = 0;
        header('Location:../login.php');
    }else{
        $_SESSION['emailRegistado'] = 0;
        header('Location:../registo.php');
    }    
}

$sth = null;

die();

?>

