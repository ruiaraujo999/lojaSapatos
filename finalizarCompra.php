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
 
        if(isset($_SESSION['id']))
            $clientId = $_SESSION['id']; 

        $sql = 'SELECT endereco, codigoPostal, localidade, cidade FROM utilizadores WHERE id = :i';

        $sth = $dbh->prepare($sql);
        $sth->bindParam('i', $clientId);
        $sth->execute();

        $dados = $sth->fetchObject(); 
    ?>
    
    <div class="container">
        <div class="fs-1 my-4 ">Informações</div>
        <div class="ms-3">
            <div class="fs-2 mb-4">Local de Entrega</div>
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
        
        <div class="ms-3">
            <?php
            $sql = 'SELECT * FROM produtos p 
            INNER JOIN carrinho c ON p.id = c.product_id 
            WHERE client_id = :c AND deleted = 0';

            $sth = $dbh ->prepare($sql);
            $sth->bindParam('c', $clientId);
            $sth->execute();
            ?>  

            <?php 
                if($sth->rowCount() > 0){ 
            ?>
                <div class="fs-2 my-4">Produtos</div>
                <div class="row">
                    <?php
                        $precoTotal = 0;
                        while($p = $sth->fetchObject()){            
                        $precoTotal += $p->preco * $p->qtty;
                    ?>
                        <div class="productRemove col-6 col-md-3 col-lg-2 my-2 "data-id="<?= $p->product_id ?>" data-tam="<?= $p->size ?>" data-cli="<?= $clientId ?>">
                            <!-- Imagem do produto-->
                            <img class="img-fluid w-100" src="calcado/<?= $p->img1m ?>">

                            <!-- Marca e modelo -->
                            <div>
                                <?= $p->marca ?>
                                <?= $p->modelo ?>
                            </div>
                            <div>
                                <span> Cor: <?= $p->cor ?></span> 
                            </div>
                            <div>
                               <span>Tamanho: <?= $p->size ?>  </span> 
                            </div>
                                <span>Quantidade: <?= $p->qtty ?> uni.</span> 
                            <div>
                                <span>Preço: <?= $p->preco ?>€</span> 
                            </div>
                            <div>
                                <span>Total: <?= $p->preco * $p->qtty ?>€</span> 
                            </div>    
                        </div>

                    <?php } ?>
                  
                    <div class="fw-bold my-5"> 
                        <div class="fs-4 d-flex justify-content-between border-bottom border-dark">
                            <span class="fs-4">Total</span>
                            <span class="fs-4"><?= $precoTotal ?>€</span> 
                        </div>
                        <div class="fs-4 d-flex justify-content-between border-bottom border-dark">
                            <span>IVA</span>
                            <span><?= $precoTotal * 0.23 ?>€</span> 
                        </div>
                        <div class="d-flex justify-content-between ">
                            <span class="fs-4">Total a pagar</span>
                            <span class="fs-3"><?= $precoTotal + $precoTotal * 0.23 ?>€</span>
                        </div>    
                    </div>
      
                    <div class="my-4">
                        <a class="btn btn-dark fs-4" onclick="comprado()">Comprar</a> 
                    </div>
                </div>   

            <?php } ?>

        </div>      
    </div>

    <?php require('includes/footer.php'); ?>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/removerArtigos.js"></script>
    
    <script>

        function comprado(){
            var prods = document.querySelectorAll('.productRemove');

            for (var i = 0; i < prods.length; i++) {
                var cliente     = prods[i].dataset.cli;
                var produto_id  = prods[i].dataset.id;
                var tamanho     = prods[i].dataset.tam;

                let xhr = new XMLHttpRequest();

                xhr.onreadystatechange = function(){
                    if(xhr.readyState == 4 && xhr.status == 200){
                        if(xhr.responseText == 'compraRegistada'){
                            removerCarrinho();
                        }
                    }
                }
 
                xhr.open('GET','ajax/marcarComprado.php?cliente_id='+cliente+'&produto_id='+produto_id+'&tamanho='+tamanho,true);
                xhr.send();
            }
        }

        function removerCarrinho(){
            var prods = document.querySelectorAll('.productRemove');

            for (var i = 0; i < prods.length; i++){
                removerBD(prods[i].dataset.cli, prods[i].dataset.id, prods[i].dataset.tam); 
            }

            window.location.href = "compraEfetuada.php";
        }

    </script>
</body>
</html>