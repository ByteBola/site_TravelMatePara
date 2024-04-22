<?php

    require_once("templates/header.php");

    if($userDAO){
        $user->destroyToken();
        
    }