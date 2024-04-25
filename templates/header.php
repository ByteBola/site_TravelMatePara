<?php
require_once("globals.php");
require_once("db.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");

$message = new Message($BASE_URL);

$flassMessage = $message->getMessage();

if (!empty($flassMessage["msg"])) {
    // Limpar a mensagem
    $message->clearMessage();
}

$userDao = new UserDAO($conn, $BASE_URL);

$userData = $userDao->verifyToken(false);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelMateHelp</title>
    <link rel="short icon" href="<?= $BASE_URL ?>img/mundo.ico">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.css" integrity="sha512-drnvWxqfgcU6sLzAJttJv7LKdjWn0nxWCSbEAtxJ/YYaZMyoNLovG7lPqZRdhgL1gAUfa+V7tbin8y+2llC1cw==" crossorigin="anonymous" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <!-- CSS do projeto -->
    <link rel="stylesheet" href="<?= $BASE_URL ?>css/style.css">
    <script src="<?= $BASE_URL ?>/js/script.js"></script>
</head>

<body>
    <header>
        <nav id="main-navbar" class="navbar navbar-expand-lg">
            <a href="<?= $BASE_URL ?>" class="navbar-brand">
                <img src="<?= $BASE_URL ?>img/logo.png" alt="TravelMateHelp" id="logo">
                <span id="travelmatehelp-title">TravelMateHelp</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <form action="search.php" method="GET" id="search-form" class="form-inline my-2 my-lg-0">
                <input type="text" name="q" id="search" class="form-control mr-sm-2" type="search" placeholder="Buscar Informações..." aria-label="Search">
                <button class="btn my-2 my-sm-0" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="<?= $BASE_URL ?>informacao_clima.php" class="nav-link">
                        <i class="fas fa-cloud"></i> Previsão do tempo
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $BASE_URL ?>help.php" class="nav-link">
                        <i class="fas fa-question-circle"></i> Ajuda com Informações
                    </a>
                </li>
            </u>    
            <ul class="navbar-nav">
                    <?php if ($userData) : ?>
                        <li class="nav-item">
                            <a href="<?= $BASE_URL ?>newreport.php" class="nav-link">
                                <i class="far fa-plus-square"></i> Incluir Relatos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $BASE_URL ?>dashboard.php" class="nav-link">
                                <i class="fas fa-file-alt"></i> Meus Relatos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $BASE_URL ?>orientacoes.php" class="nav-link">
                                <i class="fas fa-lightbulb"></i>
                                Orientações de Publicações
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $BASE_URL ?>editprofile.php" class="nav-link bold">
                                <?= $userData->name ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $BASE_URL ?>logout.php" class="nav-link">Sair</a>
                        </li>
                    <?php else : ?> <!-- Fechamento do primeiro if -->
                        <li class="nav-item">
                            <a href="<?= $BASE_URL ?>auth.php" class="nav-link">Entrar / Cadastrar</a>
                        </li>
                    <?php endif; ?> <!-- Fechamento do else -->
                </ul>
            </div>
        </nav>
    </header>
    <?php if (!empty($flassMessage["msg"])) : ?>
        <div class="msg-container">
            <p class="msg <?= $flassMessage["type"] ?>"><?= $flassMessage["msg"] ?></p>
        </div>
    <?php endif; ?>