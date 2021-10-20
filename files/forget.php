<?php

// This page is used when the user's password has been forgotten
// The php part uses a form and the POST data to fetch the email address the user gave
// If the given email address is indeed in the database, an email is sent to that particular email address with a link to reboot the user's password
// Then, a message is written for the user

session_start();
require_once "config/bootstrap.php";

if(!empty($_POST["email"])) {
    $db = App::getDatabase();
    $auth = App::getAuth();
    $session = Session::getInstance();
    if($auth->rebootPassword($db, htmlentities($_POST["email"], ENT_QUOTES))) {
        $session->setFlash("success", "Un email vous a été envoyé pour votre nouveau mot de passe.");
        App::redirect("login.php");
    }
    else {
        $session->setFlash("danger", "Désolé, aucun compte ne correspond à cette adresse mail.");
        App::redirect("forget.php");
    }
}
?>

<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/content.css" />
    </head>
    <body>
        <?php require_once 'elements/header.php'; ?>
            <div class="content">
                <h1 class="page-title">Mot de passe oublié</h1>
                <div class="form-div">
                    <form action="" method="POST" class="account-form">
                        <div class="form-group">
                            <label for="">adresse email</label>
                            <input type="email" name="email" />
                        </div>

                        <button type="submit">Envoyer</button>

                    </form>
                </div>
            </div>
        <?php require_once 'elements/footer.php'?>
    </body>
</html>