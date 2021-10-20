<?php

// This class allows to use functions concerning the session.

class Session {

    static $instance;

    // Construct of the object, it starts a session.

    public function __construct(){
        session_start();
    }

    // This function creates a new Session object (if necessary) in order to start a session, and put it in the instance variable.

    static function getInstance() {
        if(self::$instance == null) {
            self::$instance = new Session();
        }
        return self::$instance;
    }

    // This function creates a session flash message using the given informations.

    public function setFlash($key, $message) {
        $_SESSION["flash"][$key] = $message;
    }

    // This function returns a true/false statement about the presence of session flash messages.

    public function hasFlashes() {
        return isset($_SESSION["flash"]);
    }

    // This function returns and delete the session flash message(s).

    public function getFlashes() {
        $flash = $_SESSION["flash"];
        unset($_SESSION["flash"]);
        return $flash;
    }

    // This function create a session variable with the given informations.

    public function write($key, $data) {
        $_SESSION[$key] = $data;
    }
    
    // This function delete a session variable with the given informations.

    public function delete($key) {
        unset($_SESSION[$key]);
    }

    // This function return a session "key" variable using the given key variable.

    public function read($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    // This function delete the session flash variable(s).

    public function resetFlashes() {
        if ($this->hasFlashes()) {
            $_SESSION["flash"] = null;
        }
    }
}