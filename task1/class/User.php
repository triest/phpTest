<?php
/**
 * Created by PhpStorm.
 * User: triest
 * Date: 19.10.2019
 * Time: 9:50
 */


class User
{
    public $id;

    public $name;

    private $password;


    public function save()
    {
        global $mysqli;
        //проверка что такого пользователя нет

        if ($stmt = $mysqli->prepare("INSERT INTO `users`( `name`, `password`) VALUES (?,?)")) {
            $stmt->bind_param('ss', $this->name, $this->password);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            $error = $mysqli->errno . ' ' . $mysqli->error;
            echo $error; // 1054 Unknown column 'foo' in 'field list'
        }
    }

    public static function getByID($id)
    {
        global $mysqli;

        if ($stmt = $mysqli->prepare("select `id`,`name` from `users` where `id`=? limit 1")) {
            $stmt->bind_param('s', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result) {
                if ($result->num_rows > 0) {
                    $user = new User();
                    while ($row = $result->fetch_assoc()) {
                        $user->id = $row["id"];
                        $user->name = $row["name"];
                    }
                    return $user;
                }
            } else {
                return null;
            }

        } else {
            $error = $mysqli->errno . ' ' . $mysqli->error;
            echo $error; // 1054 Unknown column 'foo' in 'field list'
        }
    }

    public static function getAll()
    {
        global $mysqli;

        if ($stmt = $mysqli->prepare("select `id`,`name` from `users`")) {
            $stmt->execute();
            $result = $stmt->get_result();
            $array_users = array();
            if ($result) {
                if ($result->num_rows > 0) {
                    $user = new User();
                    while ($row = $result->fetch_assoc()) {
                        $user->id = $row["id"];
                        $user->name = $row["name"];
                        array_push($array_users, $user);
                    }
                    return $array_users;
                }
            } else {
                return null;
            }

        } else {
            $error = $mysqli->errno . ' ' . $mysqli->error;
            echo $error; // 1054 Unknown column 'foo' in 'field list'
        }
    }

    public function delete()
    {
        global $mysqli;

        if ($stmt = $mysqli->prepare("delete  from `users` where `id`=? limit 1")) {
            $stmt->bind_param('s', $this->id);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            return null;
        }

    }


    public static function getUserByName($name)
    {
        global $mysqli;

        if ($stmt = $mysqli->prepare("select `id`,`name` from `users` where `name`=? limit 1")) {
            $stmt->bind_param('s', $name);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result) {
                if ($result->num_rows > 0) {
                    $user = new User();
                    while ($row = $result->fetch_assoc()) {
                        $user->id = $row["id"];
                        $user->name = $row["name"];
                    }
                    return $user;
                }
            } else {
                return null;
            }

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


    public function login($login, $pass)
    {
        global $mysqli;

        if ($stmt = $mysqli->prepare("select `id`,`name`,`password` from `users` where `name`=? limit 1")) {
            $stmt->bind_param('s', $login);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result) {
                if ($result->num_rows > 0) {
                    $user = new User();
                    while ($row = $result->fetch_assoc()) {
                        $id = $row["id"];
                        $name = $row["name"];
                        $passorr = $row["password"];
                    }

                    if ($login == $name && $pass == $passorr) {
                        $_SESSION['auth_user'] = $login;
                    }
                }
            } else {
                return null;
            }

        } else {
            $error = $mysqli->errno . ' ' . $mysqli->error;
            echo $error; // 1054 Unknown column 'foo' in 'field list'
        }
    }


}