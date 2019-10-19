<?php
    /**
     * Created by PhpStorm.
     * User: triest
     * Date: 19.10.2019
     * Time: 9:51
     */

    global $mysqli;

    $users_database = array("host" => "127.0.0.1", "login" => "root", "password" => "");

    $mysqli = new mysqli("127.0.0.1", "root",
            "", "phptest");
