<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SapatoBarato</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="stylesheet" href="css/scroll-bar.css">
</head>
<body>
    <?php require_once('includes/connection.php');?>
    <?php require('includes/navbar.php'); ?>

    <?php
        if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == 0){
            echo("<script>location.href = 'login.php';</script>");  //Substitui o header, tinha conflito com o html no ficheiro janelaCarrinho.
            die();
        }
    ?>

    <div class="fs-1 bg-success p-5 m-5 text-center text-light">Compra efetuada com sucesso!</div>

    <?php require('includes/footer.php'); ?>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/removerArtigos.js"></script>
    
</body>
</html>