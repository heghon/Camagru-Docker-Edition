<?php

    // This page is used to upload a picture and start the like system for that picture to the database
    // Using the FILES data, the picture is taken is uploaded and a like is automatically put by the author on that picture

    session_start();
    require_once "config/bootstrap.php";

    $session = Session::getInstance();
    $auth = App::getAuth();
    $db = App::getDatabase();
    $pictures = new Pictures($session);
    $likes = new Likes($session);

    $imageName = $_FILES["upimage"]["tmp_name"];

    $image_tmp = (file_get_contents($_FILES["upimage"]["tmp_name"]));

    $pictures->uploadPicture($db, $auth->actualUser()->username, $image_tmp);

    $likes->putLike($db, $db->lastInsertedId(), $auth->getUserID($db, $auth->actualUser()->username));
?>