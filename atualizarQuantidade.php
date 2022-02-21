<?php 
require('../includes/connection.php');

if(isset($_GET['quantidade']))
    $quantidade = $_GET['quantidade'];

if(isset($_GET['id']))
    $id = $_GET['id'];

$sql = 'UPDATE carrinho SET qtty = :q WHERE id = :p';

$sth = $dbh ->prepare($sql);
$sth->bindParam('p', $id);
$sth->bindParam('q', $quantidade);
$sth->execute();

if($sth && $sth->rowCount() == 1){
    echo 'quantidadeAtualizado';
}

?>