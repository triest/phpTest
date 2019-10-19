<?php
require_once "class/User.php";

/**
 * Created by PhpStorm.
 * User: triest
 * Date: 19.10.2019
 * Time: 10:13
 */
User::connect();


$user = new User();
/*
$user->name = "test";
$user->password = "test";
$user->save();
*/


//$user = User::getUserByName("test2");
//var_dump($user);
//$user->deleteUser();

//$array_users = User::getAll();

($user->login("test2","test2"));
echo "auth_user: ".$_SESSION["auth_user"];

