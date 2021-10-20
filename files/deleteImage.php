<?php

    // This page is used to delete an image from the database
    // This page cannot be reached if the actual user isn't connected since it's part of a connected user rights
    // In order to work, the php part uses the GET data to fetch the id of the image to delete
    // This page is supposed to work with an ajax connection

    session_start();
    require_once "config/bootstrap.php";
    $session = Session::getInstance();
    $db = App::getDatabase();
    $picture = new Pictures($session);
    $auth = App::getAuth();

    $auth->restrict();

    $id =  htmlentities($_GET["id"], ENT_QUOTES);

    $picture->deleteImage($db, $id);
?>