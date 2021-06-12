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
    <link rel="stylesheet" href="index.css">
</head>
<body>

<?php
require_once 'vendor/autoload.php';
include_once("functions.php");

$sql = select("SELECT * FROM tournament");
$i = 0;

foreach ($sql as $tournament) {
    $changeDate = 'changeDate';

    echo <<<ENDE
<div>
    <div class="header">
        <h1>Championship {$tournament['pk_tournament_year']}</h1>
ENDE;
    if ($i === 0) {
        echo <<<ENDE
        <form method="get" action="admin.php">
            <button type="submit" class="btn btn-dark">Admin-Bereich</button>
        </form>
ENDE;
        $i++;
    }
    echo <<<ENDE
    </div>
    <h5>{$changeDate($tournament['date'])}</h5>

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

    $sql2 = select("SELECT * FROM game_round WHERE fk_pk_tournament_year = {$tournament['pk_tournament_year']}");

    foreach ($sql2 as $game_round) {
        echo <<<ENDE
            <tr>
                <th scope="row">{$game_round['round_nr']}</th>
ENDE;

        $sql3 = select("SELECT * FROM participant_takes_part_game_round INNER JOIN participant p on participant_takes_part_game_round.fk_pk_participant_id = p.pk_participant_id WHERE fk_pk_round_id = " . $game_round['pk_round_id']);

        $sql4 = select("SELECT * FROM game_round_selects_symbol
                                        INNER JOIN game_round gr on game_round_selects_symbol.fk_pk_round_id = gr.pk_round_id
                                        WHERE fk_pk_round_id = " . $game_round['pk_round_id']);

        if (isset($sql3, $sql4) && $sql3 != null && $sql4 != null) {
            echo "<td>{$sql3[0]['first_name']} {$sql3[0]['last_name']}</td>";
            echo "<td><img src='" . getSymbol($sql4[0]['fk_pk_symbol']) . "'></td>";
            echo "<td>&ndash;</td>";
            echo "<td><img src='" . getSymbol($sql4[1]['fk_pk_symbol']) . "' class='second'></td>";
            echo "<td>{$sql3[1]['first_name']} {$sql3[1]['last_name']}</td>";
        }
    }
    echo "</tbody></table></div>";
}
?>
</body>
</html>