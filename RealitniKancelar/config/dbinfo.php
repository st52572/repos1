<?php

class DbInfo {
    public static function getinfo()
    {
        require_once 'pdo.php';
        $type = "mysql";
        $servername = "127.0.0.1";
        $user = "root";
        $pass = "";
        $database = "realitnikancelar";
        $db = get_pdo($type, $servername, $user, $pass, $database);
        return $db;
        }
}
