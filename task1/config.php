<?php
/**
 * Created by PhpStorm.
 * User: triest
 * Date: 19.10.2019
 * Time: 9:51
 */

global $mysqli;

$users_database=array("host"=>"127.0.0.1","login"=>"root","password"=>"");

$mysqli = new mysqli($users_database->host, $this->login, $this->password,
        $this->database);
if ($mysqli->connect_errno) {
   echo  $mysqli->connect_error;
}