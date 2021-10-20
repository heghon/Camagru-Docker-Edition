<?php

    // This page is used to confirm if the user's account is validated and its informations are in the database 
    // This page can be reached by everyone but there's an automatic redirection, and without the proper token, nothing will happen 
    // With the proper token, the user's account will be confirmed in the database and a message is displayed to give the information

    session_start();
    require_once "config/bootstrap.php";

    $db = App::getDatabase();

    if (App::getAuth()->confirm($db, htmlentities($_GET["id"], ENT_QUOTES), htmlentities($_GET["token"], ENT_QUOTES), Session::getInstance())) {
        Session::getInstance()->setFlash("success", "Votre compte a bien été validé.");
        App::redirect("account.php");
    } 
    
    else {
        Session::getInstance()->setFlash("danger", "Attention, cette clé n'est plus valide.");
        App::redirect("login.php");
    }
?>