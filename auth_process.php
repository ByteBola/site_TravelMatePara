<?php
require_once("globals.php");
require_once("db.php");
require_once("models/User.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");

$message = new Message($BASE_URL);

$userDao = new UserDao($conn,$BASE_URL);

// Resgata o tipo de formulario
$type = filter_input(INPUT_POST, "type");

// Verificação do tipo de formulário
if ($type === "register") {

    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

    // Verificação de dados mínimos
    if ($name && $lastname && $email && $password) {
        // Verificar se as senhas batem
        if ($password == $confirmpassword) {
            // Verificar se o email já está cadastrado no sistema
            if($userDao->findByEmail($email)===false){
                echo "nenhum usuário foi encontrado!";
            }else{
                // Enviar uma msg de erro , usuário já existe 
                $message->setMessage("Usuário já cadastrado , tente outro email","erro", "back");
            }
        } else {
            // Enviar uma mensagem de erro , de dados faltantes
            $message->setMessage("As senhas não são iguais", "error", "back");
        }
    } else {
        // Enviar uma mensagem de erro , de dados faltantes
        $message->setMessage("Por favor , preencha todos os campos", "error", "back");
    }
} else if ($type === "login") {
}
