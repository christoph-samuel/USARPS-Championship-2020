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
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<?php
include_once("functions.php");

if (isset($_GET['year'], $_GET['date']) && $_GET['year'] != "" && $_GET['date'] != "") {
    $queryBuilder = getConn()->createQueryBuilder();

    $queryBuilder
        ->insert('tournament')
        ->values(array(
                'pk_tournament_year' => '?',
                'date' => '?')
        )
        ->setParameter(0, $_GET['year'])
        ->setParameter(1, $_GET['date']);
    $queryBuilder->executeQuery();
}

if (isset($_GET['tournament'], $_GET['round'], $_GET['participant1'], $_GET['symbol1'], $_GET['symbol2'], $_GET['participant2']) &&
    $_GET['tournament'] != "" && $_GET['round'] != "" && $_GET['participant1'] != "" &&
    $_GET['symbol1'] != "" && $_GET['symbol2'] != "" && $_GET['participant2'] != "") {

    // Insert new Round Nr in "game_round"
    $queryBuilder = getConn()->createQueryBuilder();
    $queryBuilder
        ->insert('game_round')
        ->values(array(
            'round_nr' => '?',
            'fk_pk_tournament_year' => '?'
        ))
        ->setParameter(0, $_GET['round'])
        ->setParameter(1, $_GET['tournament']);
    $queryBuilder->executeQuery();

    // Get New Round ID (Auto Increment in database)
    $sql = select("SELECT * FROM game_round");
    $id = $sql[sizeof($sql) - 1]['pk_round_id'];

    // Insert first Participant of Game Round
    $queryBuilder = getConn()->createQueryBuilder();
    $queryBuilder
        ->insert('participant_takes_part_game_round')
        ->values(array(
            'fk_pk_round_id' => '?',
            'fk_pk_participant_id' => '?'
        ))
        ->setParameter(0, $id)
        ->setParameter(1, $_GET['participant1']);
    $queryBuilder->executeQuery();

    // Insert second Participant of Game Round
    $queryBuilder = getConn()->createQueryBuilder();
    $queryBuilder
        ->insert('participant_takes_part_game_round')
        ->values(array(
            'fk_pk_round_id' => '?',
            'fk_pk_participant_id' => '?'
        ))
        ->setParameter(0, $id)
        ->setParameter(1, $_GET['participant2']);
    $queryBuilder->executeQuery();

    // Insert first Symbol of Game Round
    $queryBuilder = getConn()->createQueryBuilder();
    $queryBuilder
        ->insert('game_round_selects_symbol')
        ->values(array(
            'fk_pk_round_id' => '?',
            'fk_pk_symbol' => '?'
        ))
        ->setParameter(0, $id)
        ->setParameter(1, $_GET['symbol1']);
    $queryBuilder->executeQuery();

    // Insert second Symbol of Game Round
    $queryBuilder = getConn()->createQueryBuilder();
    $queryBuilder
        ->insert('game_round_selects_symbol')
        ->values(array(
            'fk_pk_round_id' => '?',
            'fk_pk_symbol' => '?'
        ))
        ->setParameter(0, $id)
        ->setParameter(1, $_GET['symbol2']);
    $queryBuilder->executeQuery();
}

if (isset($_GET['participantFirst_name'], $_GET['participantLast_name']) && $_GET['participantFirst_name'] != "" && $_GET['participantLast_name'] != "") {
    $queryBuilder = getConn()->createQueryBuilder();

    $queryBuilder
        ->insert('participant')
        ->values(array('first_name' => '?',
                'last_name' =>'?')
        )
        ->setParameter(0, $_GET['participantFirst_name'])
        ->setParameter(1, $_GET['participantLast_name']);
    $queryBuilder->executeQuery();
}
?>

<h1>Admin-Page</h1>

<div id="create">
    <form method="get" action="createChampionship.php">
        <button type="submit" class="btn btn-primary">Create Championship</button>
    </form>

    <form method="get" action="createGameRound.php">
        <button type="submit" class="btn btn-primary">Create Game Round</button>
    </form>

    <form method="get" action="createParticipant.php">
        <button type="submit" class="btn btn-primary">Create Participant</button>
    </form>
</div>

<div id="back">
    <form method="get" action="index.php">
        <button type="submit" class="btn btn-dark">Zurück zur Homepage</button>
    </form>
</div>

</body>
</html>