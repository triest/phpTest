<?php
    /**
     * Created by PhpStorm.
     * User: triest
     * Date: 19.10.2019
     * Time: 20:06
     */
    //валидация данных
    if (isset($_POST["code"]) && $_POST["code"] != "" && isset($_POST["part1"]) && $_POST["part1"] != "" && isset($_POST["part2"]) && $_POST["part2"] != "") {
        return  readfile('test.html');
    } else {
        echo json_encode("wrong data");
    }
