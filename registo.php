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
        $_SESSION['loggedInError']  = 0;
        $_SESSION['registado']      = 0;
    ?>
        
        <div class=" m-5 p-5 bg-dark rounded-3">
        <form name="registoForm" action="ajax/registarUtilizador.php" method="POST">
            <div class="pb-4 text-light fs-4 fw-bold text-center">Registo</div>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <!-- Informações pessoais -->
                        <div class="form-floating mb-3"> 
                            <input class="form-control" type="text" name="nome" placeholder="Nome" maxlength="16" pattern="[a-zA-ZÀ-ÿ]{2,16}" required>
                            <label for="primeironome">Nome</label>
                        </div>
                        <div class="form-floating mb-3"> 
                            <input class="form-control" type="text" name="sobrenome" placeholder="Sobrenome" maxlength="16" pattern="[a-zA-ZÀ-ÿ]{2,16}" required>
                            <label for="registo">Sobrenome</label>
                        </div>
                        <div class="form-floating mb-3"> 
                            <input class="form-control" type="text" name="numero" placeholder="912345678" pattern="[9][1|2|3|6][0-9]{7}" required>
                            <label for="registo">Número</label>
                        </div>
                        
                        <?php
                        if(isset($_SESSION['emailRegistado']) && $_SESSION['emailRegistado'] == 1){
                        ?> 

                            <div class="form-floating mb-3 text-danger border border-danger fw-bold"> 
                                <input class="form-control" id="email" type="email" name="email" placeholder="exemplo@gmail.com" required>
                                <label for="registo">Email já registado.</label>
                            </div>    

                        <?php }else{ ?>

                            <div class="form-floating mb-3"> 
                                <input class="form-control" id="email" type="email" name="email" placeholder="exemplo@gmail.com" required>
                                <label for="registo">Introduza o Email</label>
                            </div>

                        <?php } ?>       

                    </div>

                    <!-- Informação de localização-->
                    <div class="col-12 col-lg-6">
                        <div class="form-floating mb-3"> 
                            <input class="form-control" type="text" name="endereco" placeholder="rua de ali" pattern="[a-zA-ZÀ-ÿ ]{2,50}" required>
                            <label for="registo">Endereço</label>
                        </div>
                        <div class="form-floating mb-3"> 
                            <input class="form-control" type="text" name="localidade" placeholder="freguesia" pattern="[a-zA-ZÀ-ÿ ]{2,50}" required>
                            <label for="registo">Localidade</label>
                        </div>
                        <div class="form-floating mb-3"> 
                            <input class="form-control" type="text" name="codigoPostal" placeholder="rua de ali" pattern="\(?(\d{4})\)?[-]?(\d{3})" required>
                            <label for="registo">Código Postal</label>
                        </div>
                        <div class="form-floating mb-3"> 
                            <input class="form-control" type="text" name="cidade" placeholder="Coimbra" pattern="[a-zA-ZÀ-ÿ ]{2,50}" required>
                            <label for="registo">Cidade</label>
                        </div>
                    </div>

                    <!-- Password de acesso-->
                    <div class="col-12 col-lg-6">
                        <div class="form-floating mb-3"> 
                            <input class="form-control" type="password" name="palavraChave" placeholder="password" minlength="4" required>
                            <label for="pass">Password</label>
                        </div>
                    </div>
                    
                    <!-- Button para registar-->
                    <div class="d-flex justify-content-center mt-4 mb-3">
                        <button class="btn fs-5 btn-warning">Registar</button>
                    </div>

                    <div class="text-center">
                        <a class="text-light" href="login.php">Já é membro? Entre agora. </a> 
                    </div>
                </div>
            </div>
        </form>
    </div>

 
    <?php require('includes/footer.php'); ?>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/removerArtigos.js"></script>

    <script>
        function doesExist(){
            var email       = document.getElementById('email');
            var emailEnviar = email.value;

            let xhr = new XMLHttpRequest();
            
            xhr.onreadystatechange = function(){
                if(xhr.readyState == 4 && xhr.status == 200){
                    if(xhr.responseText == 'registar'){
                        document.forms['registoForm'].submit();
                    }  
                }
            }

            xhr.open('GET', 'ajax/verificarEmail.php?email='+emailEnviar);
            xhr.send();
        }

    </script>
</body>
</html>