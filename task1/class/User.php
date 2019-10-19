<?php
/**
 * Created by PhpStorm.
 * User: triest
 * Date: 19.10.2019
 * Time: 9:50
 */


class User
{
    public $name;

    public $password;


    public function save()
    {
        global $mysqli;
        var_dump($mysqli);

        if ($stmt = $mysqli->prepare("INSERT INTO `users`( `name`, `password`) VALUES (?,?)")) {
            $stmt->bind_param('ss', $this->name, $this->password);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            $error = $mysqli->errno . ' ' . $mysqli->error;
            echo $error; // 1054 Unknown column 'foo' in 'field list'
        }

    }

    public static function connect()
    {
        global $mysqli;

        $users_database = array("host" => "127.0.0.1", "login" => "root", "password" => "");

        $mysqli = new mysqli("127.0.0.1", "root",
                "", "phptest");
    }

}