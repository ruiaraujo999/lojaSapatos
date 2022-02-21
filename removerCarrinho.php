<?php 
require('../includes/connection.php');

if(isset($_GET['cliente_id']))
    $cliente = $_GET['cliente_id'];

if(isset($_GET['produto_id']))
    $produto_id = $_GET['produto_id'];

if(isset($_GET['tamanho']))
    $tamanho = $_GET['tamanho'];

$sql = 'UPDATE carrinho SET deleted = 1 WHERE product_id = :p AND size = :s AND client_id = :c';

$sth = $dbh ->prepare($sql);
$sth->bindParam('c', $cliente);
$sth->bindParam('p', $produto_id);
$sth->bindParam('s', $tamanho);
$sth->execute();

?>