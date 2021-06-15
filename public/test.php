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

<form enctype="multipart/form-data" action="admin.php" method="post">
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text" id="date">Date:</span>
        </div>
        <input type="date" name="ormDate" class="form-control" aria-describedby="date">
    </div>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text" id="roundNr">Round Nr.</span>
        </div>
        <input type="number" name="ormRoundNr" class="form-control" aria-describedby="roundNr" min="1">
    </div>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text" id="player1">Player 1</span>
        </div>
        <input type="text" name="ormPlayer1" class="form-control" aria-describedby="player1">
    </div>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text" id="player2">Player 2</span>
        </div>
        <input type="text" name="ormPlayer2" class="form-control" aria-describedby="player2">
    </div>
    <div>
        <input type="hidden" name="MAX_FILE_SIZE" value="50000000"/>
        <input type="file" name="ormSymbol1" class="form-control" accept="image/*">
    </div>
    <div>
        <input type="hidden" name="MAX_FILE_SIZE" value="50000000"/>
        <input type="file" name="ormSymbol2" class="form-control" accept="image/*">
    </div>
    <button type="submit" class="btn btn-dark">Create Game Round</button>
</form>

</body>
</html>