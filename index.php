<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>USARPS - Championship 2020</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<?php
include_once("functions.php");

$host = "localhost";
$db = "usarps_db";
$user = "root";
$passwd = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", "$user", "$passwd");
} catch (PDOException $e) {
    echo 'Verbindung fehlgeschlagen';
}

$sql = $pdo->prepare("SELECT * FROM tournament");
$sql->execute();
$sql = $sql->fetchAll();

foreach ($sql as $tournament) {
    $changeDate = 'changeDate';

    echo <<<ENDE
    <h1>Championship $tournament[0]</h1>
    <h5>{$changeDate($tournament[1])}</h5>

    <table class="table table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th scope="col">Round</th>
                <th scope="col">First Player</th>
                <th scope="col">Symbol</th>
                <th scope="col">vs.</th>
                <th scope="col">Symbol</th>
                <th scope="col">Second Player</th>
            </tr>
        </thead>
        <tbody>
ENDE;

    $sql2 = $pdo->prepare("SELECT * FROM game_round");
    $sql2->execute();
    $sql2 = $sql2->fetchAll();

    foreach ($sql2 as $game_round) {
        echo <<<ENDE
            <tr>
                <th scope="row">$game_round[0]</th>
ENDE;

        $sql3 = $pdo->prepare("SELECT * FROM participant_takes_part_game_round
                                        INNER JOIN participant p on participant_takes_part_game_round.fk_pk_participant_id = p.pk_participant_id
                                        WHERE fk_pk_round_nr = " . $game_round[0]);
        $sql3->execute();
        $sql3 = $sql3->fetchAll();

        $sql4 = $pdo->prepare("SELECT * FROM game_round_selects_symbol
                                        INNER JOIN game_round gr on game_round_selects_symbol.fk_pk_round_nr = gr.pk_round_nr
                                        WHERE fk_pk_round_nr = " . $game_round[0]);
        $sql4->execute();
        $sql4 = $sql4->fetchAll();

        echo "<td>{$sql3[0][3]} {$sql3[0][4]}</td>";
        echo "<td><img src='".getSymbol($sql4[0][1])."'></td>";
        echo "<td>&ndash;</td>";
        echo "<td><img src='".getSymbol($sql4[1][1])."' class='second'></td>";
        echo "<td>{$sql3[1][3]} {$sql3[1][4]}</td>";
    }
    echo "</tbody></table>";
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

?>
</body>
</html>