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
        if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == 0){
            echo("<script>location.href = 'login.php';</script>");  //Substitui o header, tinha conflito com o html no ficheiro janelaCarrinho.
            die();
        }

        if(isset($_SESSION['id']))
            $clientId = $_SESSION['id'];

        $sql = 'SELECT * FROM produtos p 
        INNER JOIN carrinho c ON p.id = c.product_id 
        WHERE client_id = :c AND deleted = 0';

        $sth = $dbh ->prepare($sql);
        $sth->bindParam('c', $clientId);
        $sth->execute();
    ?>

    <div class="ms-3 p-3 mt-1">
        <h1>Carrinho</h1>
    </div>

    <div class="container">
        <div class="row">
            <!-- Descrição dos produtos adicionados ao carrinho -->
            <div class="vazio">O seu carrinho está vazio.</div>
            <div class="col-12 col-lg-9">

                <?php
                while($p = $sth->fetchObject()){
                ?>

                <div class="produto row border border-dark my-3 artigo" data-pro="<?= $p->product_id ?>" data-tam="<?= $p->size ?>" data-client="<?= $clientId ?>">
                    <!-- Imagem do produto-->
                    <a href="exibir-produto.php?id=<?= $p->product_id ?>" class="col-12 col-md-2 my-2">
                        <img class="img-fluid w-100" src="calcado/<?= $p->img1m ?>">
                    </a>

                    <!-- Marca e modelo -->
                    <a href="exibir-produto.php?id=<?= $p->product_id ?>" class="col-6 col-md-2 align-self-center mb-2 text-decoration-none text-dark">
                        <div class="fs-4"><?= $p->marca ?></div> 
                        <div class="fs-4"><?= $p->modelo ?></div> 
                    </a>

                    <!-- Cor -->
                    <div class="col-6 col-md-2 align-self-center mb-2">
                            <div class="fs-5">Cor</div>
                            <div><?= $p->cor ?></div>
                    </div>

                    <!-- Tamanho -->
                    <div class="col-6 col-md-2 align-self-center mb-2" id="">
                        <div class="me-1 fs-5 tamLabel" data-idcompra="<?= $p->id ?>">Tamanho</div> 
                        <select onchange="atualizarTamanhos(this)" class="form-select form-select-sm tamanho" data-idcompra="<?= $p->id ?>">
                            <?php if($p->genero == 'Rapaz' || $p->genero == 'Rapariga'){ ?>
                                <option value="26"<?php if($p->size == '26'){echo 'selected';}?>>26</option>
                                <option value="27"<?php if($p->size == '27'){echo 'selected';}?>>27</option>
                                <option value="28"<?php if($p->size == '28'){echo 'selected';}?>>28</option>
                                <option value="29"<?php if($p->size == '29'){echo 'selected';}?>>29</option>
                                <option value="30"<?php if($p->size == '30'){echo 'selected';}?>>30</option>
                                <option value="31"<?php if($p->size == '31'){echo 'selected';}?>>31</option>
                                <option value="32"<?php if($p->size == '32'){echo 'selected';}?>>32</option>
                                <option value="33"<?php if($p->size == '33'){echo 'selected';}?>>33</option>
                                <option value="34"<?php if($p->size == '34'){echo 'selected';}?>>34</option>
                            <?php } else { ?>
                                <option value="35"<?php if($p->size == '35'){echo 'selected';}?>>35</option>
                                <option value="36"<?php if($p->size == '36'){echo 'selected';}?>>36</option>
                                <option value="37"<?php if($p->size == '37'){echo 'selected';}?>>37</option>
                                <option value="38"<?php if($p->size == '38'){echo 'selected';}?>>38</option>
                                <option value="39"<?php if($p->size == '39'){echo 'selected';}?>>39</option>
                                <option value="40"<?php if($p->size == '40'){echo 'selected';}?>>40</option>
                                <option value="41"<?php if($p->size == '41'){echo 'selected';}?>>41</option>
                                <option value="42"<?php if($p->size == '42'){echo 'selected';}?>>42</option>
                                <option value="43"<?php if($p->size == '43'){echo 'selected';}?>>43</option>
                                <option value="44"<?php if($p->size == '44'){echo 'selected';}?>>44</option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- Quantidade -->
                    <div class="col-6 col-md-2 align-self-center mb-2">
                        <div class="me-1 fs-5 quaLabel" data-idcompra="<?= $p->id ?>">Quantidade</div>
                        <select onchange="atualizarQtty(this)" class="form-select form-select-sm quantidade" data-idcompra="<?= $p->id ?>">
                            <option value="1" <?php if($p->qtty == '1'){echo 'selected';}?>>1</option>
                            <option value="2" <?php if($p->qtty == '2'){echo 'selected';}?>>2</option>
                            <option value="3" <?php if($p->qtty == '3'){echo 'selected';}?>>3</option>
                            <option value="4" <?php if($p->qtty == '4'){echo 'selected';}?>>4</option>
                            <option value="5" <?php if($p->qtty == '5'){echo 'selected';}?>>5</option>
                        </select>
                    </div>

                    <!-- Preço -->
                    <div class="col-12 col-md-2 align-self-center mb-2 d-flex">
                            <div class="col-7">
                                <div class="fs-5">Preço</div>
                                <div class="fw-bold fs-5 preco" data-id="<?=$p->product_id?>" data-preco="<?=$p->preco?>"><?= $p->preco ?>€</div>
                            </div>

                            <div onclick="removerProdutos(this)" class="col-5 fs-3 text-end" data-pro="<?= $p->product_id ?>" data-tam="<?= $p->size ?>" data-client="<?= $clientId ?>"> <i class="bi btn bi-x-lg fs-3"></i></div>
                    </div>
                </div>

                <?php } ?>

            </div>

            <div class="col-12 col-lg-3 mb-5 mt-2">
                <h1>Sumário</h1>
                <div class="d-flex justify-content-between mb-1">
                    <div>Subtotal</div>
                    <div id="subTotal">€</div>
                </div>
                <div class="d-flex justify-content-between mb-1">
                    <div>Custo de envio</div>
                    <div>0€</div> 
                </div>
                <div class="d-flex justify-content-between border-top border-dark mb-1">
                    <div>Total</div>
                    <div id="total">0€</div> 
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <a class="btn btn-dark" <?php if($sth->rowCount() > 0) { ?> href="finalizarCompra.php" <?php } ?>>Finalizar Compra</a>
                </div> 
            </div>
        </div>
    </div>

    <?php require('includes/footer.php'); ?>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/removerArtigos.js"></script>

    <script>
        function semArtigos(){
            var produtos    = document.querySelectorAll('.artigo');
            var semProdutos = document.querySelector('.vazio');

            if(produtos.length > 0){
                semProdutos.style.display = 'none';
            } else{
                semProdutos.style.display = 'block';
            }
        }

        function calcularPreco(){
            var quantidade  = document.querySelectorAll('.quantidade');
            var subTotal    = document.getElementById('subTotal');
            var preco       = document.querySelectorAll('.preco');
            var total       = document.getElementById('total');
            var precoTotal  = 0;
            var novoPreco;

            for(var i = 0; i < quantidade.length; i++){
                novoPreco = preco[i].dataset.preco * quantidade[i].value;
                precoTotal += novoPreco;
                preco[i].innerHTML = novoPreco + '€';
            }

            subTotal.innerHTML = precoTotal + '€';
            total.innerHTML = (precoTotal) + '€';
        }

        function atualizarQtty(element){
            var quantidade  = document.querySelectorAll('.quantidade');
            var quaLabel    = document.querySelectorAll('.quaLabel');
            var idC         = element.dataset.idcompra;
            var qtty;

            for(var i = 0; i < quantidade.length; i++){
                if(quantidade[i].dataset.idcompra == idC){
                    qtty = quantidade[i].value;
                }
            }
            
            let xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function(){ 
                if(xhr.readyState == 4 && xhr.status == 200){
                    if(xhr.responseText == 'quantidadeAtualizado'){
                        for(var i = 0; i < quaLabel.length; i++){
                            if(quaLabel[i].dataset.idcompra == idC){
                                var l = quaLabel[i];                       
                                l.classList.add('text-success', 'fw-bold');
                                setTimeout(function(){
                                    l.classList.remove('text-success', 'fw-bold');
                                }, 2000);
                            }
                        }
                    }
                    else{
                        alert('Erro ao adicionar.');
                    }
                }
            }

            xhr.open('GET','ajax/atualizarQuantidade.php?quantidade='+qtty+'&id='+idC, true);
            xhr.send(); 

            calcularPreco();  
        }

        function atualizarTamanhos(element){
            var tamanho     = document.querySelectorAll('.tamanho');
            var tamLabel    = document.querySelectorAll('.tamLabel');
            var idC         = element.dataset.idcompra;
            var value;

            for(var i = 0; i < tamanho.length; i++){
                if(tamanho[i].dataset.idcompra == idC){
                    value = tamanho[i].options[tamanho[i].selectedIndex].value;
                }
            }

            let xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function(){ 
                if(xhr.readyState == 4 && xhr.status == 200){
                    if(xhr.responseText == 'tamanhoAtualizado'){
                        for(var i = 0; i < tamLabel.length; i++){
                            if(tamLabel[i].dataset.idcompra == idC){
                                var l = tamLabel[i];                          
                                l.classList.add('text-success', 'fw-bold');
                                setTimeout(function(){
                                    l.classList.remove('text-success', 'fw-bold');
                                }, 2000);     
                            }
                        }                        
                    }
                    else{
                        alert('Erro ao adicionar.');
                    } 
                }
            }

            xhr.open('GET','ajax/atualizarTamanho.php?tamanho='+value+'&id='+idC,true);
            xhr.send();            
        }

        function removerProdutos(element){
            var removerProduto = document.querySelectorAll('.artigo');

            for(var i = 0; i < removerProduto.length; i++){
                if ((removerProduto[i].dataset.pro      == element.dataset.pro) &&
                    (removerProduto[i].dataset.client   == element.dataset.client) &&
                    (removerProduto[i].dataset.tam      == element.dataset.tam)){
                        removerProduto[i].remove(); 
                }   
            }

            removerCarrinhos(element);
        }

        window.onload = semArtigos();
        window.onload = calcularPreco();

    </script>
</body>
</html>