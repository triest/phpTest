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


$user = User::getUserById(3);
$user->deleteUser();

$array_users = User::getAll();

var_dump($array_users);