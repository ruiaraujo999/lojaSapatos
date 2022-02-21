<?php
session_start();

$email = $_POST['loginEmail'];
$password = md5($_POST['loginPassword']);

require('connection.php');

$sql = 'SELECT email, id FROM utilizadores WHERE email LIKE :e AND palavraChave = :p';
$sth = $dbh->prepare($sql);
$sth->bindParam(':e', $email);
$sth->bindParam(':p', $password);
$sth->execute();

$obj = $sth->fetchObject();

if($sth && $sth->rowCount() == 1){
    header('Location:../index.php'); 
    $_SESSION['email'] = $email;
    $_SESSION['loggedIn'] = 1;
    $_SESSION['id'] = $obj->id;
} else{
    $_SESSION['loggedIn'] = 0;
    $_SESSION['loggedInError'] = 1;
    header('Location:../login.php'); 
}

$sth = null;

die(); 

?>