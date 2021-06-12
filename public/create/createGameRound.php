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
    <link rel="stylesheet" href="create.css">
</head>
<body>

<form action="../admin.php" method="get" id="form">
    <div id="input">
        <div id="info">
            <?php
            include_once("../functions.php");

            $tournamentSQL = select("SELECT * FROM tournament");
            $participantSQL = select("SELECT * FROM participant");
            $symbolSQL = select("SELECT * FROM symbol");

            echo "<select class='form-select' name='tournament'><option selected disabled>Jahr</option>";
            foreach ($tournamentSQL as $tournament) {
                echo "<option value='{$tournament['pk_tournament_year']}'>{$tournament['pk_tournament_year']}</option>";
            }
            echo "</select>";
            ?>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">#</span>
                </div>
                <input type="number" name="round" class="form-control" placeholder="Round Nr." aria-describedby="basic-addon1"
                       min="1">
            </div>
        </div>
        <div id="game">
            <select class='form-select' name="participant1">
                <option selected disabled>Spieler 1</option>
                <?php
                foreach ($participantSQL as $participant) {
                    echo "<option value='{$participant['pk_participant_id']}'>{$participant['first_name']} {$participant['last_name']}</option>";
                }
                ?>
            </select>
            <select class='form-select' name="symbol1">
                <option selected disabled>Symbol 1</option>
                <?php
                foreach ($symbolSQL as $symbol) {
                    echo "<option value='{$symbol['pk_symbol']}'>{$symbol['pk_symbol']}</option>";
                }
                ?>
            </select>
            <span id="vs">&ndash;</span>
            <select class='form-select' name="symbol2">
                <option selected disabled>Symbol 2</option>
                <?php
                foreach ($symbolSQL as $symbol) {
                    echo "<option value='{$symbol['pk_symbol']}'>{$symbol['pk_symbol']}</option>";
                }
                ?>
            </select>
            <select class='form-select' name="participant2">
                <option selected disabled>Spieler 2</option>
                <?php
                foreach ($participantSQL as $participant) {
                    echo "<option value='{$participant['pk_participant_id']}'>{$participant['first_name']} {$participant['last_name']}</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div id="buttons">
        <button type="submit" class="btn btn-dark">Create Game Round</button>
        <a href="../admin.php">
            <button type="button" class="btn btn-dark">Zurück</button>
        </a>
    </div>
</form>

</body>
</html>