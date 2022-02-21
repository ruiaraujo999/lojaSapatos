<?php 
require('../includes/connection.php');

if(isset($_GET['tamanho']))
    $tamanho = $_GET['tamanho'];

if(isset($_GET['id']))
    $id = $_GET['id'];

$sql = 'UPDATE carrinho SET size = :t WHERE id = :p';

$sth = $dbh ->prepare($sql);
$sth->bindParam('p', $id);
$sth->bindParam('t', $tamanho);
$sth->execute();

if($sth && $sth->rowCount() == 1){
    echo 'tamanhoAtualizado';
}

?>