<?php 
session_start();

unset($_SESSION['email']);
unset($_SESSION['loggedIn']);

session_destroy();

$_SESSION = null;

header('Location:../index.php');

die();

?>