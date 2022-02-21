<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Comforter&family=Dancing+Script:wght@600&family=Licorice&display=swap" rel="stylesheet">

<?php 
    session_start();

    if(isset($_GET['genero']))
        $gender = $_GET['genero'];
    else
        $gender = 'main-page';
?>

<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <div style="font-family: 'Licorice', cursive;" class="fs-1 ps-3">Sapato<br>Barato</div>
        </a>

        <div class="px-3 d-flex">
            <div class="mx-3 d-flex d-lg-none flex-row align-center">
                <!-- Carrinho -->
                <?php
                    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 1){                    
                ?>

                    <button type="button" class="btn btn-light fs-4 p-1 me-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> 
                        <i class="bi bi-cart3 px-1"></i> 
                    </button>

                <?php } else { ?>

                    <a href="login.php" class="btn btn-light fs-4 p-1 me-2"> 
                        <i class="bi bi-cart3 px-1"></i>
                    </a>

                <?php } ?>


                <!-- Perfil -->
                <?php
                    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 1){                    
                ?>

                    <a class="btn btn-light fs-4 p-2" href="perfil.php">
                        <i class="bi bi-person-circle w-100"></i> 
                    </a>

                <?php } else { ?>

                    <a class="btn btn-light fs-4 p-2" href="login.php">
                        <i class="bi bi-person-circle w-100"></i> 
                    </a>

                <?php } ?>


                <!-- Botão para Sair -->
                <?php
                    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 1){                    
                ?>

                    <a class="btn btn-danger fs-5 px-2 pt-2 ms-2" href="includes/logout.php">SAIR</a>

                <?php } ?>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header text-light bg-dark">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body text-light bg-dark d-flex flex-column flex-lg-row align-middle">
                <ul class="navbar-nav justify-content-start flex-grow-1 pe-3 fs-4">
                    <li class="nav-item px-2">
                        <a class="nav-link <?php if($gender == 'Todos'){echo 'active';}?> button" href="lista-produtos.php?genero=Todos">Artigos</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link <?php if($gender == 'Homem'){echo 'active';}?> button" href="lista-produtos.php?genero=Homem">Homem</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link <?php if($gender == 'Mulher'){echo 'active';}?> button" href="lista-produtos.php?genero=Mulher">Mulher</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link <?php if($gender == 'Rapaz'){echo 'active';}?> button" href="lista-produtos.php?genero=Rapaz">Rapaz</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link <?php if($gender == 'Rapariga'){echo 'active';}?> button" href="lista-produtos.php?genero=Rapariga">Rapariga</a>
                    </li>
                </ul>

                <div class="mx-3 d-none d-lg-flex flex-row align-center">
                    <!-- Carrinho -->
                    <?php
                        if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 1){                    
                    ?>

                        <button type="button" class="btn btn-light fs-4 p-1 me-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> 
                            <i class="bi bi-cart3 px-1"></i> 
                        </button>

                    <?php } else { ?>

                        <a href="login.php" class="btn btn-light fs-4 p-1 me-2"> 
                            <i class="bi bi-cart3 px-1"></i>
                        </a>

                    <?php } ?>


                    <!-- Perfil -->
                    <?php
                        if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 1){                    
                    ?>

                        <a class="btn btn-light fs-4 p-2" href="perfil.php">
                            <i class="bi bi-person-circle w-100"></i> 
                        </a>

                    <?php } else { ?>

                        <a class="btn btn-light fs-4 p-2" href="login.php">
                            <i class="bi bi-person-circle w-100"></i> 
                        </a>

                    <?php } ?>


                    <!-- Botão para Sair -->
                    <?php
                        if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 1){                    
                    ?>

                        <a class="btn btn-danger fs-5 px-2 pt-2 ms-2" href="includes/logout.php">SAIR</a>
                        
                    <?php } ?>
                    
                </div> 
            </div>
        </div>
    </div>
</nav>

<?php require('includes/janelaCarrinho.php'); ?>