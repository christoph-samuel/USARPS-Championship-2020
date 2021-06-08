<?php
require_once 'vendor/autoload.php';

function changeDate($date) :String {
    $date = explode("-", $date);
    return "$date[2].$date[1].$date[0]";
}

function getConn() {
    $connectionParams = array(
        "dbname" => "usarps_db",
        "user" => "root",
        "password" => "",
        "host" => "localhost",
        "driver" => "pdo_mysql",
    );
    return \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
}

function select($stmt) {
    $sql = getConn()->prepare($stmt);
    $sql = $sql->executeQuery();

    try {
        return $sql->fetchAllAssociative();
    }catch (Exception $ex) {
        return $ex;
    }
}

function getSymbol($symbol) {
    switch ($symbol) {
        case "Schere":
            return "images/scissors.png";
        case "Stein":
            return "images/rock.png";
        case "Papier":
            return "images/paper.png";
        default:
            echo "Symbol unknown!";
            return "";
    }
}