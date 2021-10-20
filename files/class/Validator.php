<?php

// This class allows to use functions concerning the pictures.

class Validator {

    private $data;
    private $errors = [];

    // Construct of the class, concerning the data variable.

    public function __construct($data) {
        $this->data = $data;
    }

    // This function returns (if set) a specific part of the data class variable using the given field information.

    private function getField($field) {
        if (!isset($this->data[$field])) {
            return null;
        }
        return htmlentities($this->data[$field], ENT_QUOTES);
    }

    // This function returns the errors class variable.

    public function getErrors() {
        return $this->errors;
    }

    // This function returns a true/false statement concerning the emptiness of the errors class variable.

    public function isValid() {
        return empty($this->errors);
    }

    // This function checks if the given username is up to the website standards and is not already taken. 
    // If there's an error, the errors class variable is updated with specific informations about the username.

    public function usernameValidator($db, $table) {
        if(empty($this->getField("username")) || strlen($this->getField("username")) > 255 || strlen($this->getField("username")) < 3 || !preg_match('@[A-Za-z0-9_-]@', $this->getField("username"))) {
            $this->errors["username"] = "Votre nom d'utilisateur n'est pas valide : il doit faire plus que 3 caractères et n'utilisez que des caractères alphanumériques, underscore et tiret."; 
        }
        else if ($db->query("SELECT id FROM $table WHERE username = ?", [$this->getField("username")])->fetch()) {
            $this->errors["username"] = "Ce pseudo est déjà pris."; 
        }
    }

    // This function checks if the given email address is up to the website standards and is not already taken. 
    // If there's an error, the errors class variable is updated with specific informations about the eamil address.

    public function emailValidator($db, $table) {
        if (empty($this->getField("email")) || strlen($this->getField("email")) > 255 || !filter_var($this->getField("email"), FILTER_VALIDATE_EMAIL)) {
            $this->errors["email"] = "Votre email n'est pas valide : vous devez utilisez la bonne synthaxe (exemple : exemple@exemple.fr)";
        }
        else if ($db->query("SELECT id FROM $table WHERE email = ?", [$this->getField("email")])->fetch()) {
            $this->errors["email"] = "Cet email est déjà utilisé.";
        }
    }

    // This function checks if the given password is up to the website standards and is correctly confirmed. 
    // If there's an error, the errors class variable is updated with specific informations about the password.

    public function passwordValidator() {
        $uppercase = preg_match('@[A-Z]@', $this->getField("password"));
        $lowercase = preg_match('@[a-z]@', $this->getField("password"));
        $number = preg_match('@[0-9]@', $this->getField("password"));
        if (!$uppercase || !$lowercase || !$number || strlen($this->data["password"]) > 255 || strlen($this->data["password"]) < 8) {
            $this->errors["password"] = "Votre mot de passe n'est pas valide : il doit contenir 8 caractères minimum et au moins un nombre, une majuscule et une minuscule.";
        }
        else if ($this->data["password"] !== $this->data["password_confirm"]) {
            $this->errors["password"] = "Vous devez confirmer correctement votre mot de passe.";
        }
    }
}