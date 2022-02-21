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
        $_SESSION['emailRegistado'] = 0;
        $_SESSION['loggedInError']  = 0;
        $_SESSION['registado']      = 0;
    ?>

    <?php 
        $sql = 'SELECT * FROM produtos p
                LEFT OUTER JOIN categorias c ON c.idCategoria = p.categoria';
        $sth = $dbh->prepare($sql);
        $sth->execute();
    ?>

    <!-- Button para mostrar filtro -->
    <div class="d-flex justify-content-between align-items-center">
        <div class="ms-5 p-4">
            <h1>Todos os Produtos</h1>
        </div> 
        <div class="me-4">
            <div onclick="toggleFilter()" class="text-decoration-none text-dark fs-5 btn fw-bold border border-dark">Filtro &nbsp;
                <i class="bi bi-funnel-fill"></i> 
            </div>
        </div>
    </div>

    <!--Filtro e produtos -->
    <div id="containerProdutos" class="container">
        <div class="row">
            <!-- Filtro principal -->
            <div id="filtro" style="background-color: rgb(243, 243, 243);" class="col-12 col-md-3 rounded mb-3">
                <div class="row my-2 fs-5 me-2">
                    <div class="col-6 col-md-12 ">
                        <div>Género</div>
                        <div class="d-flex flex-column ms-2">
                            <div onclick="filterSorter()" class="form-check" > 
                                <input class="form-check-input check-genero" type="checkbox" id="Homem">
                                <label for="Homem">Homem</label>
                            </div>
                            <div onclick="filterSorter()" class="form-check"> 
                                <input class="form-check-input check-genero" type="checkbox" id="Mulher"> 
                                <label for="Mulher">Mulher</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-12">
                        <div>Criança</div>
                        <div class="d-flex flex-column ms-2">
                            <div onclick="filterSorter()" class="form-check"> 
                                <input class="form-check-input check-genero" type="checkbox" id="Rapaz">
                                <label for="Rapaz">Rapaz</label>
                            </div>
                            <div onclick="filterSorter()" class="form-check"> 
                                <input class="form-check-input check-genero" type="checkbox" id="Rapariga"> 
                                <label for="Rapariga">Rapariga</label>
                            </div>
                        </div> 
                    </div>

                    <div class="col-6 col-md-12">
                        <div>Tipo</div>
                        <div class="d-flex flex-column ms-2">
                            <div onclick="filterSorter()" class="form-check"> 
                                <input class="form-check-input check-tipo" type="checkbox" id="Sapato">
                                <label for="Sapato">Sapatos</label>
                            </div>
                            <div onclick="filterSorter()" class="form-check"> 
                                <input class="form-check-input check-tipo" type="checkbox" id="Sapatilha"> 
                                <label for="Sapatilha">Sapatilhas</label>
                            </div>
                            <div onclick="filterSorter()" class="form-check"> 
                                <input class="form-check-input check-tipo" type="checkbox" id="Chinelo"> 
                                <label for="Chinelo">Chinelos</label>
                            </div>
                            <div onclick="filterSorter()" class="form-check"> 
                                <input class="form-check-input check-tipo" type="checkbox" id="Bota">
                                <label for="Bota">Botas</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-12">
                        <div>Marca</div>
                        <div class="d-flex flex-column ms-3">
                            <div onclick="filterSorter()" class="form-check"> 
                                <input class="form-check-input check-marca" type="checkbox" id="Nike">
                                <label for="Nike">Nike</label>
                            </div>
                            <div onclick="filterSorter()" class="form-check"> 
                                <input class="form-check-input check-marca" type="checkbox" id="Adidas">
                                <label for="Adidas">Adidas</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lista de produtos -->
            <div id="lista-produtos" class="col-12 col-md-9">
                <div class="p-4 text-center fs-3" id="sem-artigos">Sem Artigos Disponíveis</div>
                <div class="row">
                
                    <?php while($p = $sth->fetchObject()){ ?>

                    <a href="exibir-produto.php?id=<?= $p->id ?>" class="col-12 col-sm-6 col-lg-4 pb-3 text-decoration-none text-dark produto" data-marca="<?= $p->marca ?>" data-genero="<?= $p->genero ?>" data-categoria="<?= $p->Categoria ?>"> 
                        <div>
                            <img onmouseenter="this.src='calcado/<?= $p->img2m ?>'" onmouseleave="this.src='calcado/<?= $p->img1m ?>'" class="img-fluid w-100 rounded" src="calcado/<?= $p->img1m ?>" alt="">
                        </div>
                        <div>
                            <span class="fs-5"> <?= $p->marca?> </span>
                            <span class="fs-5"><?= $p->modelo?></span>
                        </div>
                        <div><?= $p->genero?></div>
                        <div class="fw-bold"><?= $p->preco?>€</div>
                    </a>

                    <?php } ?>

                </div>
            </div>
        </div>
    </div>

    <?php require('includes/footer.php'); ?>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/removerArtigos.js"></script>

    <script>

        //Retira e coloca o filtro e ajusta a posição dos produtos
        var filter           = document.getElementById('filtro');
        filter.style.display = "block";

        function toggleFilter(){
            var products            = document.querySelectorAll('.produto');
            var filter              = document.getElementById('filtro');
            var containerProducts   = document.getElementById('lista-produtos');

            if(isFilterDisplayed(filter)){
                filter.style.display = "none";
                containerProducts.classList.remove('col-md-9');

                for(var i = 0; i < products.length; i++){
                    products[i].classList.remove('col-lg-4');
                    products[i].classList.add('col-lg-3');
                }
            }
            else{
                filter.style.display = "block";
                containerProducts.classList.add('col-md-9');

                for(var i = 0; i < products.length; i++){
                    products[i].classList.remove('col-lg-3');
                    products[i].classList.add('col-lg-4');
                }
            }  
        }

        //Faz a filtragem dos produtos
        function filterSorter(){
            var products            = document.querySelectorAll('.produto');
            var checkBoxesGenero    = document.querySelectorAll('.check-genero');
            var checkBoxesTipo      = document.querySelectorAll('.check-tipo');
            var checkBoxesMarca     = document.querySelectorAll('.check-marca');
            var warning             = document.getElementById('sem-artigos');

            //Coloca todos os artigos com display block
            for(var i = 0; i < products.length; i++){
                products[i].style.display = "block";
            } 

            //Só executa se exisitr algum filtro Genero selecionado;
            if(isChecked(checkBoxesGenero)){
                for(var i = 0; i < checkBoxesGenero.length; i++){
                    if(!checkBoxesGenero[i].checked){
                        for(var j = 0; j < products.length; j++){
                            if(products[j].dataset.genero == checkBoxesGenero[i].id){
                                products[j].style.display = "none";
                            }
                        }
                    }
                }
            }

            if(isChecked(checkBoxesTipo)){
               for(var i = 0; i < checkBoxesTipo.length; i++){
                    if(!checkBoxesTipo[i].checked){
                        for(var j = 0; j < products.length; j++){
                            if(products[j].dataset.categoria == checkBoxesTipo[i].id){
                                products[j].style.display = "none";
                            }
                        }
                    }
                } 
            }

            if(isChecked(checkBoxesMarca)){
               for(var i = 0; i < checkBoxesMarca.length; i++){
                    if(!checkBoxesMarca[i].checked){
                        for(var j = 0; j < products.length; j++){
                            if(products[j].dataset.marca == checkBoxesMarca[i].id){
                                products[j].style.display = "none";
                            }
                        }
                    }
                } 
            }

            warning.style.display = "block";
            for(var i = 0; i < products.length; i++){
                if(products[i].style.display == "block"){
                    warning.style.display = "none";
                }
            }
        }

        //Verifica o genero e aplica o filtro (quando se clica diretamente na navbar)
        function activateGenderNavbar(){
            var checkBoxes  = document.querySelectorAll('.check-genero');
            var url_string  = window.location.href;
            var url         = new URL(url_string);
            var gender      = url.searchParams.get('genero');

            if(gender == 'crianca'){
                checkBoxes.forEach(function(el){
                if(el.id == 'Rapaz' || el.id == 'Rapariga'){
                    el.checked = true;
                }
                else{
                    el.checked = false;
                }
            });
            }
            else{
                checkBoxes.forEach(function(el){
                    if(el.id == gender){
                        el.checked = true;
                    }
                    else{
                        el.checked = false;
                    }
                });
            }
        }

        //Função auxiliar que vai verificar se filtro está checked ou não
        function isChecked(array){
            for(var i = 0; i < array.length; i++){
                if(array[i].checked){
                    return true;
                }
            }
            return false;
        }

        //Função auxiliar que vai verificar se o filtro está on ou off
        function isFilterDisplayed(filter){
            if(filter.style.display == 'block'){
                return true;
            }
            return false;
        }

    //Aplica funções quando a página carrega
    window.onload = activateGenderNavbar();
    window.onload = filterSorter();

    </script>
</body>
</html>