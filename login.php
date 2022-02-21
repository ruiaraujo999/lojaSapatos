<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sapato Barato</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="stylesheet" href="css/scroll-bar.css">
</head>

<body>
    <?php require_once('includes/connection.php');?>
    <?php require('includes/navbar.php'); ?>

    <?php 
    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 1){
        echo("<script>location.href = 'index.php';</script>");  //Substitui o header, tinha conflito com o html no ficheiro janelaCarrinho.
        die();
    }
    ?>

    <?php 
        $_SESSION['emailRegistado'] = 0;
    ?>

    <?php
    if(isset($_SESSION['registado']) && $_SESSION['registado'] == 1){
    ?> 

        <div class=" mx-auto text-center mt-3 bg-success py-3 text-light" style="width: 400px;">
            <div class="fs-4 pb-2">Registado com sucesso!</div>
            <div class="fs-6 border-top pt-1">Inicie sessão para comprar os nossos produtos.</div> 
        </div>    

    <?php }  ?>

    <?php
    if(isset($_SESSION['loggedInError']) &&  $_SESSION['loggedInError'] == 1){
    ?> 

        <div class=" mx-auto text-center mt-3 bg-danger py-3 text-light" style="width: 400px;">
            <div class="fs-4 pb-2">Erro ao efetuar login.</div>
            <div class="fs-6 border-top pt-1">Password ou email incorreto. Tente novamente.</div> 
        </div> 

    <?php }  ?>

    <div class="mx-auto my-5 p-5 bg-dark rounded-3" style="width: 400px;">
        <form action="includes/loginAuth.php" method="POST">
            <div class="pb-3 text-light fs-4 fw-bold">Iniciar Sessão</div>
            <div class="form-floating mb-4"> 
                <input class="form-control" type="email" name="loginEmail" placeholder="example@gmail.com" required>
                <label for="login">Introduza o Email</label>
            </div>

            <div class="form-floating mb-4"> 
                <input class="form-control" type="password" name="loginPassword" placeholder="password" required>
                <label for="pass">Password</label>
            </div>

            <div class="d-flex justify-content-center mb-4">
                <button type="submit" class="btn btn-warning fs-5">Entrar</button>
            </div>
        </form>

        <div class="text-center">
           <a class="text-light" href="registo.php">Não é membro? Registe-se agora.</a> 
        </div>
    </div>

    <?php require('includes/footer.php'); ?>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/removerArtigos.js"></script>
</body>
</html>