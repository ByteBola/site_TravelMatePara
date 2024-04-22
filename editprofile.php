
<?php
    require_once("templates/header.php");
    require_once("dao/UserDAO.php");

    $userDAO = new UserDAO($conn,$BASE_URL);

    $userData = $userDao->veryfytoken();
?>
<div id="main-container" class="container-fluid">
    <h1>Edição de Perfil</h1>
</div>

<?php
    require_once("templates/footer.php")
?>

