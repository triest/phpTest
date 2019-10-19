<?php
    /**
     * Created by PhpStorm.
     * User: triest
     * Date: 19.10.2019
     * Time: 20:06
     */

    if (isset($_POST["code"]) && $_POST["code"] != "" && isset($_POST["part1"]) && $_POST["part1"] != "" && isset($_POST["part2"]) && $_POST["part2"] != "") {
        echo json_encode("Thank you!");
    } else {
        echo json_encode("wrong data");
    }
    return;