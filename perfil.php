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

    <?php 
        if(isset($_SESSION['id']))
            $clientId = $_SESSION['id']; 

        $sql = 'SELECT * FROM utilizadores WHERE id = :i';

        $sth = $dbh->prepare($sql);
        $sth->bindParam('i', $clientId);
        $sth->execute();

        $dados = $sth->fetchObject(); 
    ?>

    <div class="m-5">
        <h1>Perfil</h1>
    </div>
    <div class="container mb-5">
        <div class="row">
             <div class="col-12 col-md-6 mb-4">
                <div class="fs-2 mb-4">Dados Pessoais</div> 
                <div class="mb-2">
                    <span class="fs-4"><?= $dados->nome ?></span>
                    <span class="fs-4"><?= $dados->sobrenome ?></span>
                </div>
                <div class="mb-2">
                    <span class="fs-4 fw-bold">Email:</span> 
                    <span class="fs-5"><?= $dados->email ?></span>
                </div>
                <div class="mb-2">
                    <span class="fs-4 fw-bold">Número de Telemóvel: </span>
                    <span class="fs-5"><?= $dados->numero ?></span>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-4">
                <div class="fs-2 mb-4">Localização para entregas</div>
                <div class="mb-2">
                    <span class="fs-4 fw-bold">Morada:</span>  
                    <span class="fs-5"><?= $dados->endereco ?></span>
                </div>
                <div class="mb-2">
                    <span class="fs-4 fw-bold">Código-Postal:</span>
                    <span class="fs-5"><?= $dados->codigoPostal ?></span>
                </div>
                <div class="mb-2"> 
                    <span class="fs-4 fw-bold">Localidade:</span> 
                    <span class="fs-5"><?= $dados->localidade ?></span>
                </div>
                <div class="mb-2">
                    <span class="fs-4 fw-bold">Cidade:</span>  
                    <span class="fs-5"><?= $dados->cidade ?></span>
                </div>
            </div>
        </div>

        <!-- Produtos relacionados -->
        <div class="fs-2 m-4" id="textProd">Produtos comprados</div>
            <div class="d-flex my-3 ps-2">
                <div class="overflow-auto text-nowrap p-2"> 
                    <?php 
                        $sql = 'SELECT product_id, categoria, marca, modelo, genero, preco, img1m, img2m FROM produtos p 
                                INNER JOIN carrinho c ON p.id = c.product_id 
                                WHERE client_id = :c AND comprado = 1';

                        $sth = $dbh->prepare($sql);
                        $sth->bindParam('c', $clientId);
                        $sth->execute();
                    ?>

                    <?php 
                        while($p = $sth->fetchObject()){
                    ?>

                        <div class="d-inline-block text-decoration-none text-dark produtoComprado" style="width: 250px;">
                            <a class="sapatilhas" href="exibir-produto.php?id=<?= $p->id ?>">
                                <img onmouseenter="this.src='calcado/<?= $p->img2m ?>'" onmouseleave="this.src='calcado/<?= $p->img1m ?>'" class="img-fluid w-100" src="calcado/<?= $p->img1m ?>">
                            </a>
                            <div><?= $p->marca?> <?= $p->modelo?></div>
                            <div><?= $p->genero?></div>
                            <div><?= $p->preco?>€</div>
                        </div>

                    <?php } ?>

                </div>
            </div>
    </div>

    <?php require('includes/footer.php'); ?>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/removerArtigos.js"></script>

    <script>
        var textProd    = document.getElementById('textProd');
        var produtosC   = document.querySelectorAll('.produtoComprado');

        if(produtosC.length == 0){
            textProd.style.display = 'none';
        }

    </script>
</body>
</html>