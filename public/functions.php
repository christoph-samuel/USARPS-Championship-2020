<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../bootstrap.php';

function changeDate($date): string
{
    $date = explode("-", $date);
    return "$date[2].$date[1].$date[0]";
}

function getSymbol($symbol)
{
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