<?php

// This class allows to use function concerning the comments.

class Comments {

    private $session;

    // Construct of the class, concerning the session variable.

    public function __construct($session) {
        $this->session = $session;
    }

    // This function will upload the given comment in the database according to the given informations concerning the author.

    public function uploadComment($db, $pictureID, $pictureAuthorName, $email , $authorCommentAccord , $commentAuthorName, $comment) {
        $date = date('Y-m-d');
        $db->query("INSERT INTO comments SET pictureID = ?, author = ?, comment = ?, date = ?", [
            $pictureID,
            $commentAuthorName,
            $comment, 
            $date]);
        if ($authorCommentAccord) {
            mail($email, "Am'Stram'Gram - Vous avez un nouveau commentaire", "Bonjour $pictureAuthorName, quelqu'un vous a envoyé un commentaire sous l'une de vos photos.\r\nN'hésitez pas à nous rendre visite pour lui répondre ou prendre d'autre photos - \r\nhttp://localhost/index.php", "From: Am'Stram'Gram");
        }
    }

    // This function returns an array with all the ids of the comments in the database.

    public function getCommentsIDs($db) {
        $ids = $db->query("SELECT id FROM comments");
        return ($ids->fetchAll(PDO::FETCH_COLUMN, 0));
    }

    // This function erases a comment from the database found with the given comment id.

    public function deleteComment($db, $id) {
        $db->query("DELETE FROM comments WHERE comments . id = ?", [
            $id
        ]);
    }

    // This function returns the user name of the author of a comment from the database found with the given comment id.

    public function getAuthor($db, $id) {
        $auth = $db->query("SELECT author FROM comments WHERE id = ?", [
            $id
        ]);
        return ($auth->fetch(PDO::FETCH_COLUMN, 0));
    }

    // This function returns the comment from the database found with the given comment id.

    public function getComment($db, $id) {
        $com = $db->query("SELECT comment FROM comments WHERE id = ?", [
            $id
        ]);
        return ($com->fetch(PDO::FETCH_COLUMN, 0));
    }

    // This function returns the picture id (linked to the comment id) from the database found with the given comment id.

    public function getPictureID($db, $id) {
        $picID = $db->query("SELECT pictureID FROM comments WHERE id = ?", [
            $id
        ]);
        return ($picID->fetch(PDO::FETCH_COLUMN, 0));
    }
}

?>