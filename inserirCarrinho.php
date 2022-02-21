<?php 
require('../includes/connection.php');

if(isset($_GET['cliente_id']))
    $cliente = $_GET['cliente_id'];

if(isset($_GET['produto_id']))
    $produto_id = $_GET['produto_id'];

if(isset($_GET['tamanho']))
    $tamanho = $_GET['tamanho'];

$sql = 'INSERT INTO carrinho (client_id, product_id, size) VALUES (:c, :p, :s)';

$sth = $dbh ->prepare($sql);
$sth->bindParam('c', $cliente);
$sth->bindParam('p', $produto_id);
$sth->bindParam('s', $tamanho);
$sth->execute();

if($sth && $sth->rowCount() == 1){
    echo 'adicionado';
}
else{ 
    echo 'nop';
}    

?>