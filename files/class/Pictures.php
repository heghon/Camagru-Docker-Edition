<?php

// This class allows to use functions concerning the pictures.

class Pictures {

    private $session;

    // Construct of the class, concerning the session variable.

    public function __construct($session) {
        $this->session = $session;
    }

    // This function communicates with the database to uplaod a picture with the given informations.

    public function uploadPicture($db, $username, $picture) {
        $date = date('Y-m-d');
        $name = $username . strval(time());
        $db->query("INSERT INTO pictures SET name = ?, mime = ?, picture = ?, author = ?, date = ?", [
            $name,
            "image/png",
            $picture, 
            $username,
            $date]);
    }

    // This function communicates with the database to return a picture using the picture id.

    public function getPic($db, $id) {
        $pic = $db->fetcher("SELECT picture FROM pictures WHERE id = ?", [
            $id
        ]);
        return $pic;
    }

    // This function communicates with the database to return an array of picture ids using the user name.

    public function getUserPicsID($db, $username) {
        $ids = $db->query("SELECT id FROM pictures WHERE author = ?", [
            $username
        ]);
        return ($ids->fetchAll(PDO::FETCH_COLUMN, 0));
    }

    // This function communicates with the database to return an array of all the picture ids.

    public function getPicsIDs($db) {
        $ids = $db->query("SELECT id FROM pictures");
        return ($ids->fetchAll(PDO::FETCH_COLUMN, 0));
    }

    // This function communicates with the database to delete a picture using the picture id.

    public function deleteImage($db, $id) {
        $db->query("DELETE FROM pictures WHERE pictures . id = ?", [
            $id
        ]);
    }

    // This function communicates with the database to return the user name of the picture's author using the picture id.

    public function getAuthor($db, $id) {
        $auth = $db->query("SELECT author FROM pictures WHERE id = ?", [
            $id
        ]);
        return ($auth->fetch(PDO::FETCH_COLUMN, 0));
    }
}

?>