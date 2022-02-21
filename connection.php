<?php
$user = 'web';
$pass = 'web';

try {
    $dbh = new PDO('mysql:host=localhost;dbname=grupo-4', $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));   //Ativa os acentos na conexão
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>