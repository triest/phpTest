<?php
    /**
     * Created by PhpStorm.
     * User: triest
     * Date: 20.10.2019
     * Time: 19:32
     */
    include 'config.php';

    global $mysqli;

    $query = file_get_contents('migration.sql');
    $stmt = $mysqli->prepare($query);
    $stmt->execute();

