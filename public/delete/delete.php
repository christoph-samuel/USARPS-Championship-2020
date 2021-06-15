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
    <link rel="stylesheet" href="../main.css">
    <link rel="stylesheet" href="delete.css">
</head>
<body>

<?php
require_once '../../vendor/autoload.php';
require_once __DIR__ . '/../../bootstrap.php';
require_once __DIR__ . '/../functions.php';

use Entity\GameRound;

$tournaments = $entityManager->createQueryBuilder()
    ->select('gameround')
    ->from(GameRound::class, 'gameround')
    ->groupBy('gameround.date')
    ->getQuery();
$tournaments = $tournaments->getArrayResult();

$i = 0;

foreach ($tournaments as $tournament) {
    $changeDate = 'changeDate';
    $year = explode("-", $tournament['date'])[0];

    echo <<<ENDE
<div>
    <div class="header">
        <h1>Championship $year</h1>
        <form action="../admin.php" method="post">
            <button type="submit" class="deleteBasket" name="deleteTournament" value="{$tournament["date"]}"/>
        </form>
ENDE;
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
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
ENDE;

    $game_rounds = $entityManager->createQueryBuilder()
        ->select('gameround')
        ->from(GameRound::class, 'gameround')
        ->where('gameround.date = :date')
        ->setParameter('date', $tournament['date'])
        ->getQuery();
    $game_rounds = $game_rounds->getArrayResult();

    foreach ($game_rounds as $game_round) {
        $symbol1 = base64_encode(stream_get_contents($game_round["symbol1"]));
        $symbol2 = base64_encode(stream_get_contents($game_round["symbol2"]));

        echo <<<ENDE
            <tr>
                <th scope="row">{$game_round['roundNr']}</th>
                <td>{$game_round['player1']}</td>
                <td><img src='data:image/jpeg;base64,$symbol1'></td>
                <td>&ndash;</td>
                <td><img src='data:image/jpeg;base64,$symbol2' class='second'></td>
                <td>{$game_round['player2']}</td>
                <td>
                    <form action="../admin.php" method="post">
                        <button type="submit" class="deleteBasket deleteBasketSmall" name="deleteGameRound" value="{$game_round['roundID']}"/>
                    </form>
                </td>
            </tr>
ENDE;
    }
    echo "</tbody></table></div>";
}
?>
</body>
</html>