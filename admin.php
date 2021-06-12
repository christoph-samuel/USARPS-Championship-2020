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
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<?php
include_once("functions.php");

if (isset($_GET['date']) && $_GET['date'] != "") {
    $year = explode("-", $_GET['date'])[0];

    insertTournament($year, $_GET['date']);
}

if (isset($_GET['tournament'], $_GET['round'], $_GET['participant1'], $_GET['symbol1'], $_GET['symbol2'], $_GET['participant2']) &&
    $_GET['tournament'] != "" && $_GET['round'] != "" && $_GET['participant1'] != "" &&
    $_GET['symbol1'] != "" && $_GET['symbol2'] != "" && $_GET['participant2'] != "") {

    insertGameRound($_GET['round'], $_GET['tournament'], $_GET['participant1'], $_GET['participant2'], $_GET['symbol1'], $_GET['symbol2']);
}

if (isset($_GET['participantFirst_name'], $_GET['participantLast_name']) && $_GET['participantFirst_name'] != "" && $_GET['participantLast_name'] != "") {
    insertParticipant($_GET['participantFirst_name'], $_GET['participantLast_name']);
}
?>
<section>

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

</section>

</body>
</html>