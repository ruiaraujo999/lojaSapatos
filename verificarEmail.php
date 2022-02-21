<?php 
require('../includes/connection.php');

$email = $_GET['email'];

$sql = 'SELECT email FROM utilizadores WHERE email = :email';
$sth = $dbh ->prepare($sql);
$sth->bindParam('email', $email);
$sth->execute();

if( $sth->rowCount()==0){
    echo'registar';
}else{
    echo 'erro';
}

?>
