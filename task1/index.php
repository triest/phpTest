<?php
    require_once "class/User.php";


    $user = new User();
    $user->login("test5", "test5");
    echo "auth_user: " . $_SESSION["auth_user"];
    echo '<br>';
    $user->logout();
    echo "auth_user: " . $_SESSION["auth_user"];