<?php

    // This page is used to log out the user
    // There is only a logout instruction followed by a redirection in order to refresh the website, then a message to inform the user

    session_start();
    require_once "config/bootstrap.php";
    App::getAuth()->logout();
    Session::getInstance()->setFlash("success", "Vous êtes bien déconnecté.");
    App::redirect("index.php");
?>