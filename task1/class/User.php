<?php
    /**
     * Created by PhpStorm.
     * User: triest
     * Date: 19.10.2019
     * Time: 9:50
     */
    include '../config.php';

    class User
    {
        /**
         * @var
         */
        public $id;

        /**
         * @var
         */
        public $name;

        /**
         * @var
         */
        public $password;


        /**
         * @return bool|int
         * сохраняет пользователя в баз дынных
         */
        public function save()
        {
            $user = $this->getUserByName($this->name);
            if ($user != null) {
                return false;
            }

            global $mysqli;

            //проверка что такого пользователя нет
            $this->password = md5($this->password);

            if ($stmt = $mysqli->prepare("INSERT INTO `users`( `name`, `password`) VALUES (?,?)")) {
                $stmt->bind_param('ss', $this->name, $this->password);
                $stmt->execute();
                return $stmt->insert_id;
            } else {
                $error = $mysqli->errno . ' ' . $mysqli->error;
                echo $error; // 1054 Unknown column 'foo' in 'field list'
            }
            return true;
        }

        /**
         * @param $id
         * @return null|User
         * в
         */
        public static function getByID($id)
        {
            global $mysqli;

            if ($stmt = $mysqli->prepare("select `id`,`name` from `users` where `id`=? limit 1")) {
                $stmt->bind_param('s', $id);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result && $result->num_rows > 0) {
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
        }

        /**
         * возвращает массив всех пользователей
         * @return array|null
         */
        public static function getAll()
        {
            global $mysqli;

            if ($stmt = $mysqli->prepare("select `id`,`name` from `users`")) {
                $stmt->execute();
                $result = $stmt->get_result();
                $array_users = array(); //мссив с извлеченными пользователями
                if ($result && $result->num_rows > 0) {

                    $user = new User();
                    while ($row = $result->fetch_assoc()) {
                        $user->id = $row["id"];
                        $user->name = $row["name"];
                        array_push($array_users, $user); //
                    }
                    return $array_users;
                }
            } else {
                return null;
            }
        }

        /**
         *удаление пользователя
         * @return null
         */
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

        //удаление пользователя

        /**
         * @param $name
         * @return null|User
         */
        public function getUserByName($name)
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
                echo $error;
            }
        }


        /**
         * @param $login
         * @param $pass, вход на сайт
         * @return int
         */
        public function login($login, $pass)
        {
            $user = $this->getUserByName($login);
            if ($user == null) {
                return 404;
            }

            $pass = md5($pass);
            if ($login == $user->name && $pass == $user->password) {
                if (session_status() == 0) {
                    session_start();
                }
                $_SESSION['auth_user'] = $login;
                return 200;
            }
        }

        /**
         * выход
         */
        public function logout()
        {
            $_SESSION['auth_user'] = null;
        }


    }