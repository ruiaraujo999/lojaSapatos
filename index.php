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
    <link rel="icon" href="favicon.ico">
</head>

<body>
    <?php require_once('includes/connection.php'); ?>
    <?php require('includes/navbar.php'); ?>

    <?php 
        $_SESSION['emailRegistado'] = 0;
        $_SESSION['loggedInError']  = 0;
        $_SESSION['registado']      = 0;
    ?>

    <?php 
        $sql = 'SELECT id, categoria, marca, modelo, genero, preco, img1m, img2m, destaque FROM produtos 
                WHERE destaque = 1';

        $sth = $dbh->prepare($sql);
        $sth->execute();
    ?>

    <!-- Foto Principal -->
    <div class="d-flex justify-content-center mt-3">
        <div class="p-3 mb-5 mt-5 bg-body rounded" style="width: 900px;"> 
             <a href="lista-produtos.php?genero=crianca">
                 <img class="img-fluid w-100" src="calcado/sapatilha-crianca.png">
             </a> 
        </div>
    </div>

    <!-- Artigos em destaque -->
    <div class="mt-5 mb-5">
        <div class="bg-dark text-light p-3 shadow mb-2 text-center fs-2">Artigos em Destaque</div>
        <div class="d-flex justify-content-center p-3">
            <div class="overflow-auto text-nowrap p-2 scrollBar" style="width: 1100px;">
                <?php 
                    while($p = $sth->fetchObject()){
                    if($p->destaque == 1){   
                ?>

                    <a href="exibir-produto.php?id=<?= $p->id ?>" class="d-inline-block text-decoration-none text-dark me-2" style="width: 250px;">
                        <div class="sapatilhas">
                            <img onmouseenter="this.src='calcado/<?= $p->img2m ?>'" onmouseleave="this.src='calcado/<?= $p->img1m ?>'" class="img-fluid w-100" src="calcado/<?= $p->img1m ?>">
                        </div>  
                        <div><?= $p->marca ?> <?= $p->modelo ?></div>
                        <div><?= $p->genero ?></div>
                        <div><?= $p->preco ?>€</div>
                    </a>

                <?php }} ?>

            </div>
        </div>
    </div>

    <?php 
        $sql = 'SELECT id, categoria, marca, modelo, genero, preco, img1m, img2m, novoArtigo FROM produtos 
                WHERE novoArtigo = 1';

        $sth = $dbh->prepare($sql);
        $sth->execute();
    ?>

    <!-- Novos Artigos -->
    <div class="mt-5 mb-5">
        <div class="bg-dark text-light p-3 shadow mb-2 text-center fs-2">Novos Artigos</div>
        <div class="d-flex justify-content-center p-3">
            <div class="overflow-auto text-nowrap p-2 scrollBar" style="width: 1100px;"> 
                <?php 
                    while($p = $sth->fetchObject()){
                ?>

                <a  href="exibir-produto.php?id=<?= $p->id ?>" class="d-inline-block text-decoration-none text-dark me-2" style="width: 250px;">
                    <div class="sapatilhas">
                        <img onmouseenter="this.src='calcado/<?= $p->img2m ?>'" onmouseleave="this.src='calcado/<?= $p->img1m ?>'" class="img-fluid w-100" src="calcado/<?= $p->img1m ?>">
                    </div>
                    <div><?= $p->marca ?> <?= $p->modelo ?></div>
                    <div><?= $p->genero ?></div>
                    <div><?= $p->preco ?>€</div>
                </a>

                <?php } ?>
                
            </div>
        </div>
    </div>

    <?php require('includes/footer.php'); ?>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/removerArtigos.js"></script>
</body>
</html>