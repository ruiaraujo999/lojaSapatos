<?php
if(isset($_SESSION['id']))
    $clientId = $_SESSION['id']; 

$sql = 'SELECT * , p.id AS "idProduto" FROM produtos p 
        INNER JOIN carrinho c ON p.id = c.product_id 
        WHERE client_id = :c AND deleted = 0';

$sth = $dbh->prepare($sql);
$sth->bindParam('c', $clientId);
$sth->execute();

?>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Artigos no Carrinho</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="prod" class="modal-body">

                <?php while($obj = $sth->fetchObject()) { ?>

                <div class="d-flex bd-highlight mb-3 px-3 artigos" data-pro="<?= $obj->idProduto ?>" data-tam="<?=$obj->size?>" data-client="<?=$clientId?>" >
                    <img class="flex-grow-1 bd-highlight" style="width: 10px;" src="calcado/<?=$obj->img1m?>" alt="">
                    <div class="ms-2 fs-6 flex-grow-1 bd-highlight align-self-center ">
                        <span><?= $obj->marca ?></span>
                        <span><?= $obj->modelo ?></span>
                        <div><?= $obj->genero ?></div>
                        <div>Cor: <?= $obj->cor ?></div> 
                        <div>Tamanho: <?= $obj->size ?></div>
                        <div>Preço: <?= $obj->preco ?>€</div>
                    </div>
                    <div onclick="removerCarrinhos(this)" class="bd-highlight" data-pro="<?= $obj->idProduto ?>" data-tam="<?= $obj->size ?>" data-client="<?= $clientId ?>">
                        <i class="bi btn bi-x-lg"></i>
                    </div>
                </div>
            
                <?php } ?>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary">
                    <a href="carrinho.php" class="text-light text-decoration-none">Ver Carrinho</a>
                </button>
            </div>
        </div>
    </div>
</div>

