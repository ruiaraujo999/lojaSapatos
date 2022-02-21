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
    <?php 
        if(isset($_GET['id']))
            $id = $_GET['id'];
        else
            $id = '1';

        if(isset($_SESSION['id']))
            $clientId = $_SESSION['id']; 
        else
            $clientId = 0;
    ?>
    
    <?php 
        $_SESSION['registado']      = 0;
        $_SESSION['loggedInError']  = 0;
        $_SESSION['emailRegistado'] = 0;

    ?>

    <?php require_once('includes/connection.php');?>
    <?php require('includes/navbar.php'); ?>

    <?php 
        $sql = '(SELECT * FROM produtos
                WHERE id = :id 
                LIMIT 1)
                UNION ALL
                SELECT * FROM produtos';

        $sth = $dbh->prepare($sql);
        $sth->bindParam('id',$id);
        $sth->execute();
    ?>

    <?php
        $artPr = $sth->fetchObject();
    ?>

    <div class="container">
        <div class="row">
            <!-- Informação básica quando o display < lg -->
            <div class="d-lg-none mt-2">
                <div class="fs-3">
                    <span><?= $artPr->marca?></span>
                    <span><?= $artPr->modelo?></span>
                </div>
                <div class="fs-5"><?= $artPr->genero?></div>
                <div class="fs-6"><?= $artPr->cor?></div>
                <div class="mt-4 fs-5 fw-bold"><?= $artPr->preco?>€</div>
            </div>

            <!-- Imagens do produto -->
            <div class="col-12 col-lg-6 mt-5 mb-2">
                <!-- Imagem principal-->
                <div> 
                    <img class="img-fluid w-100" id="main-img" src="calcado/<?= $artPr->img1g ?>">
                </div>

                <!-- Miniaturas -->
                <div class="d-flex flex-row flex-wrap">
                    <div onclick="clickElement(this)" style="width: 100px;" class="my-3 me-3">
                        <img class="img-fluid w-100" src="calcado/<?= $artPr->img1g ?>">
                    </div>
                    <div onclick="clickElement(this)" style="width: 100px;" class="my-3 me-3">
                        <img class="img-fluid w-100" src="calcado/<?= $artPr->img2g ?>">
                    </div>
                    <div onclick="clickElement(this)" style="width: 100px;" class="my-3 me-3">
                        <img class="img-fluid w-100" src="calcado/<?= $artPr->img3g ?>">
                    </div>
                </div>
            </div>

            <!-- Informação do produto -->
            <div class="col-12 col-lg-6 mt-5 mb-2">
                <!-- Informação geral -->
                <div class="d-none d-lg-block">
                    <div class="fs-3">
                        <span id='main-marca'><?= $artPr->marca ?></span>
                        <span id='main-modelo'><?= $artPr->modelo ?></span>
                    </div>
                    <div id='main-genero' class="fs-5"><?= $artPr->genero ?></div>
                    <div id='main-preco' class="mt-4 fw-bold fs-5"><?= $artPr->preco ?> €</div>
                </div>

                <!-- Cores existentes -->
                <div class="my-2">
                    <div class="fs-5"> Cores: </div>
                    <div class="d-flex mt-3 flex-wrap">
                    
                        <?php 
                            while($p = $sth->fetchObject()){ 
                            if($artPr->marca == $p->marca && $artPr->modelo == $p->modelo && $artPr->genero == $p->genero && $artPr->categoria == $p->categoria){
                        ?>

                        <a href="exibir-produto.php?id=<?= $p->id ?>" div style="width: 100px;" class="me-2 mb-2">
                            <img class="img-fluid w-100" src="calcado/<?= $p->img1m ?>">
                        </a>

                        <?php }} ?>
                        
                    </div>
                </div>

                <!-- Tamanhos existentes -->
                <div id="avisoTamanho">
                    <div class="fs-5 px-2">Selecionar Tamanho:</div>
                    <div class="d-flex flex-wrap my-2 px-2">
                        <?php if($artPr->genero == 'Rapaz' || $artPr->genero == 'Rapariga'){ ?>
                            <div class="p-3 btn btn-outline-secondary border btnTamanho" data-size='26' onclick="clickTamanho(this)">26</div>
                            <div class="p-3 btn btn-outline-secondary border btnTamanho" data-size='27' onclick="clickTamanho(this)">27</div>
                            <div class="p-3 btn btn-outline-secondary border btnTamanho" data-size='28' onclick="clickTamanho(this)">28</div>
                            <div class="p-3 btn btn-outline-secondary border btnTamanho" data-size='29' onclick="clickTamanho(this)">29</div>
                            <div class="p-3 btn btn-outline-secondary border btnTamanho" data-size='30' onclick="clickTamanho(this)">30</div>
                            <div class="p-3 btn btn-outline-secondary border btnTamanho" data-size='31' onclick="clickTamanho(this)">31</div>
                            <div class="p-3 btn btn-outline-secondary border btnTamanho" data-size='32' onclick="clickTamanho(this)">32</div>
                            <div class="p-3 btn btn-outline-secondary border btnTamanho" data-size='33' onclick="clickTamanho(this)">33</div>
                            <div class="p-3 btn btn-outline-secondary border btnTamanho" data-size='34' onclick="clickTamanho(this)">34</div>
                        <?php } else { ?>
                            <div class="p-3 btn btn-outline-secondary border btnTamanho" data-size='35' onclick="clickTamanho(this)">35</div>
                            <div class="p-3 btn btn-outline-secondary border btnTamanho" data-size='36' onclick="clickTamanho(this)">36</div>
                            <div class="p-3 btn btn-outline-secondary border btnTamanho" data-size='37' onclick="clickTamanho(this)">37</div>
                            <div class="p-3 btn btn-outline-secondary border btnTamanho" data-size='38' onclick="clickTamanho(this)">38</div>
                            <div class="p-3 btn btn-outline-secondary border btnTamanho" data-size='39' onclick="clickTamanho(this)">39</div>
                            <div class="p-3 btn btn-outline-secondary border btnTamanho" data-size='40' onclick="clickTamanho(this)">40</div>
                            <div class="p-3 btn btn-outline-secondary border btnTamanho" data-size='41' onclick="clickTamanho(this)">41</div>
                            <div class="p-3 btn btn-outline-secondary border btnTamanho" data-size='42' onclick="clickTamanho(this)">42</div>
                            <div class="p-3 btn btn-outline-secondary border btnTamanho" data-size='43' onclick="clickTamanho(this)">43</div>
                            <div class="p-3 btn btn-outline-secondary border btnTamanho" data-size='44' onclick="clickTamanho(this)">44</div>
                        <?php } ?>
                    </div>
                </div>

                <!-- Texto a descrever o produto ... -->
                <div class="fs-5">Descrição:</div>
                <div class="mt-2 ms-3">
                    <?= $artPr->descricao ?>
                </div>

                <!-- Buttons -->
                <div id="alerta" class="fs-6 text-danger mt-3 ms-3">Esse produto já está no carrinho</div>
                <div class="d-flex flex-column flex-md-row mt-3"> 
                    <?php
                    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 1){
                    ?>

                        <div class="m-2" onclick="adicionarCarrinho()"> 
                            <button id="buttonAdded" class="btn btn-dark">Adicionar ao Carrinho</button>
                        </div>

                    <?php } else { ?>

                        <div class="m-2"> 
                            <a href="login.php" class="btn btn-dark">Adicionar ao Carrinho</a>
                        </div>

                    <?php } ?>

                    <div class="m-2"> 
                        <a class="btn btn-dark" href="carrinho.php">Ver Carrinho</a> 
                    </div>
                </div>
            </div>

            <!-- Produtos relacionados -->
            <div class="mt-5 fs-4">Produtos Semelhantes</div>
            <div class="d-flex my-3 ps-2">
                <div class="overflow-auto text-nowrap p-2"> 
                    <?php 
                        $sql = 'SELECT id, categoria, marca, modelo, genero, preco, img1m, img2m FROM produtos
                                WHERE categoria = :categoria
                                AND genero = :genero
                                AND marca = :marca';

                        $sth = $dbh->prepare($sql);
                        $sth->bindParam('categoria',$artPr->categoria);
                        $sth->bindParam('genero',$artPr->genero);
                        $sth->bindParam('marca',$artPr->marca);
                        $sth->execute();
                    ?>

                    <?php 
                        while($p = $sth->fetchObject()){
                    ?>

                        <div class="d-inline-block text-decoration-none text-dark" style="width: 250px;">
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
    </div>

    <?php require('includes/footer.php'); ?>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/removerArtigos.js"></script>
    
    <script>
        var avisoTamanho            = document.getElementById('avisoTamanho');
        var mainImg                 = document.getElementById('main-img');
        var prodf                   = document.getElementById('alerta');
        var size                    = 0;
        var avisoTamanhoDisparado   = false;
        prodf.style.display         = "none";

        function clickElement(element){
            let img     = element.querySelector('img').src;
            mainImg.src = img;
        }

        function clickTamanho(element){
            if(avisoTamanhoDisparado){
                    avisoTamanho.classList.remove('border', 'border-danger', 'text-danger');
                    avisoTamanhoDisparado = false;
            }
            var btnTamanho = document.querySelectorAll('.btnTamanho');
          
            for(var i = 0; i < btnTamanho.length; i++){
                if(btnTamanho[i].classList.contains('btn-secondary')){
                    btnTamanho[i].classList.remove('btn-secondary');
                    btnTamanho[i].classList.add('btn-outline-secondary');
                } 
            }

            element.classList.add('btn-secondary');
            element.classList.remove('btn-outline-secondary');

            size = element.innerText;
        }

        function adicionarCarrinho(){
            var buttonAdded = document.getElementById('buttonAdded');

            let html = `
            <div class="d-flex bd-highlight mb-3 px-3 artigos" data-pro="<?=$artPr->id?>" data-tam="${size}" data-client="<?=$clientId?>">
              <img class="flex-grow-1 bd-highlight" style="width: 10px;" src="calcado/<?=$artPr->img1m?>">
              <div class="ms-2 fs-6 flex-grow-1 bd-highlight align-self-center ">
                  <span><?=$artPr->marca ?></span>
                  <span><?=$artPr->modelo ?></span>
                  <div><?=$artPr->genero ?></div>
                  <div>Cor: <?=$artPr->cor ?></div> 
                  <div>Tamanho: ${size} </div>
                  <div>Preço: <?=$artPr->preco ?>€</div>
              </div>
              <div onclick="removerCarrinhos(this)" class="bd-highlight " data-pro="<?=$artPr->id?>" data-tam="${size}" data-client="<?=$clientId?>">
                <i class="bi btn bi-x-lg"></i>
              </div>
          </div>`;

            if(size == 0) {
                avisoTamanho.classList.add('border', 'border-danger', 'text-danger');
                avisoTamanhoDisparado = true;
                return 0;
            }
            else {
                var fa = document.querySelectorAll('.artigos');
                var produtoExiste = false;
                for(var i = 0; i < fa.length; i++){
                    if((fa[i].dataset.pro == <?= $artPr->id ?>) && (fa[i].dataset.tam == size) && (fa[i].dataset.client == <?= $clientId ?>)){
                        produtoExiste = true;
                    }
                }

                if(produtoExiste){
                    prodf.style.display = "block";
                }
                else{
                    let xhr = new XMLHttpRequest();

                    xhr.onreadystatechange = function(){
                        if(xhr.readyState == 4 && xhr.status == 200){
                            if(xhr.responseText=='adicionado'){
                                prodf.style.display = "none";
                                buttonAdded.classList.remove('btn-dark');
                                buttonAdded.classList.add('btn-success');

                                setTimeout(function(){
                                    buttonAdded.classList.remove('btn-success');
                                    buttonAdded.classList.add('btn-dark');
                                }, 2000);

                                document.getElementById("prod").innerHTML += html;
                            }
                            else{
                                alert('Erro ao adicionar.');
                            } 
                        }
                    }

                    xhr.open('GET','ajax/inserirCarrinho.php?cliente_id='+<?= $clientId ?>+'&produto_id='+<?= $artPr->id ?>+'&tamanho='+size, true);
                    xhr.send();
                }    
            }
        }
    </script>
</body>
</html>