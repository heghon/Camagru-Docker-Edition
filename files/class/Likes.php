<?php

// This class allows to use function concerning the likes for the pictures.

class Likes {

    private $session;

    // Construct of the class, concerning the session variable.

    public function __construct($session) {
        $this->session = $session;
    }

    // This function communicates with the database to put a like from the user using the user id on a picture using the picture id.
    // This function also triggers the like system on a picture, by putting one like from the author of the picture on his own picture if the picture has just been taken.

    public function putLike($db, $pictureID, $userID) {
        $db->query("INSERT INTO likes SET pictureID = ?, userID = ?", [
            $pictureID,
            $userID]);
    }

    // This function communicates with the database to remove a like from the user using the user id on a picture using the picture id.

    public function removeLike($db, $pictureID, $userID) {
        $db->query("DELETE FROM likes WHERE pictureID = ? AND userID = ?", [
            $pictureID,
            $userID]);
    }

    // This function communicates with the database to count the number of likes a picture has using the picture id.

    public function countLikes($db, $pictureID) {
        $nbr = $db->query("SELECT userID FROM likes WHERE pictureID = $pictureID");
        return (count($nbr->fetchAll(PDO::FETCH_COLUMN, 0)));
    }

    // This function checks if, for a given picture id and user id, a user has already liked a picture.

    public function checkLike($db, $pictureID, $userID) {
        $test = $db->fetcher("SELECT id FROM likes WHERE pictureID = ? AND userID = ?", [
            $pictureID,
            $userID]);
        return ($test ? true : false);
    }
}

?>