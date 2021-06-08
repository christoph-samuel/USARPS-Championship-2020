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
    <!--    <link rel="stylesheet" href="main.css">-->
</head>
<body>

<form action="admin.php" method="get">
    <?php
    include_once("functions.php");

    $sql = select("SELECT * FROM tournament");

    echo "<select name='tournament'>";
    foreach ($sql as $tournament) {
        echo "<option value='{$tournament['pk_tournament_year']}'>{$tournament['pk_tournament_year']}</option>";
    }
    echo "</select>";
    ?>
    <label for="round">Game Round:</label>
    <input type="number" id="round" name="round">
    <select name="participant1">
        <?php
        $sql = select("SELECT * FROM participant");

        foreach ($sql as $participant) {
            echo "<option value='{$participant['pk_participant_id']}'>{$participant['first_name']} {$participant['last_name']}</option>";
        }
        ?>
    </select>
    <select name="symbol1">
        <?php
        $sql = select("SELECT * FROM symbol");

        foreach ($sql as $symbol) {
            echo "<option value='{$symbol['pk_symbol']}'>{$symbol['pk_symbol']}</option>";
        }
        ?>
    </select>
    <select name="symbol2">
        <?php
        $sql = select("SELECT * FROM symbol");

        foreach ($sql as $symbol) {
            echo "<option value='{$symbol['pk_symbol']}'>{$symbol['pk_symbol']}</option>";
        }
        ?>
    </select>
    <select name="participant2">
        <?php
        $sql = select("SELECT * FROM participant");

        foreach ($sql as $participant) {
            echo "<option value='{$participant['pk_participant_id']}'>{$participant['first_name']} {$participant['last_name']}</option>";
        }
        ?>
    </select>
    <button type="submit" class="btn btn-dark">Create Game Round</button>
</form>

</body>
</html>