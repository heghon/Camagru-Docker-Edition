<?php

    // This specific file autoloads every class present in the class folder for all the php files.

    spl_autoload_register("app_autoloader");

    function app_autoloader($class) {
        require "class/$class.php";
    }