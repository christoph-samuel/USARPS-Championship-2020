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

use Entity\GameRound;

include_once("functions.php");
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../bootstrap.php';

if (isset($_POST['ormDate'], $_POST['ormRoundNr'], $_POST['ormPlayer1'], $_POST['ormPlayer2'],
    $_FILES['ormSymbol1']['tmp_name'], $_FILES['ormSymbol2']['tmp_name'])) {

// Persist the uploaded file
    $entity = new GameRound($_POST['ormDate'], $_POST['ormRoundNr'], $_POST['ormPlayer1'], $_POST['ormPlayer2'],
        file_get_contents($_FILES['ormSymbol1']['tmp_name']), file_get_contents($_FILES['ormSymbol2']['tmp_name']));
    $entityManager->persist($entity);
    $entityManager->flush();
}

if (isset($_POST['deleteTournament'])) {
// Remove the chosen tournament
    $entity = $entityManager->getRepository(GameRound::class)->findBy(array('date' => $_POST['deleteTournament']));
    foreach ($entity as $item) {
        $entityManager->remove($item);
        $entityManager->flush();
    }
}

if (isset($_POST['deleteGameRound'])) {
// Remove the chosen Game Round
    $entity = $entityManager->find(GameRound::class, $_POST['deleteGameRound']);
    $entityManager->remove($entity);
    $entityManager->flush();
}

if (isset($_POST['ormDate']) || isset($_POST['deleteTournament']) || isset($_POST['deleteGameRound'])) {
    // Prevent re-POST if browser is refreshed
    header('Location: ' . $_SERVER['PHP_SELF']);
}
?>
<section>

    <h1>Admin-Page</h1>

    <div id="create">
        <form method="get" action="create/create.php">
            <button type="submit" class="btn btn-primary">Create Game Round</button>
        </form>
    </div>

    <div id="delete">
        <form method="get" action="delete/delete.php">
            <button type="submit" class="btn btn-danger">Delete Something</button>
        </form>
    </div>

    <div id="back">
        <form action="index.php">
            <button type="submit" class="btn btn-dark">Zurück zur Homepage</button>
        </form>
    </div>

</section>

</body>
</html>