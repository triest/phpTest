<?php
    require_once "class/User.php";

    /**
     * Created by PhpStorm.
     * User: triest
     * Date: 19.10.2019
     * Time: 10:13
     */


    $user = new User();
    $user->name = "test4";
    $user->password = "test4";
    $user->save();

    $user->login("test4", "test4");
    echo "auth_user: " . $_SESSION["auth_user"];
    echo '<br>';
    $user->logout();
    echo "auth_user: " . $_SESSION["auth_user"];