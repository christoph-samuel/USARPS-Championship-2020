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
    <link rel="stylesheet" href="create.css">
</head>
<body>

<form action="admin.php" method="get" id="form">
    <div id="input">
        <div id="info">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="date">Tournament Date</span>
                </div>
                <input type="date" name="date" class="form-control" aria-describedby="date">
            </div>
        </div>
    </div>
    <div id="buttons">
        <button type="submit" class="btn btn-dark">Create Tournament</button>
        <a href="admin.php">
            <button type="button" class="btn btn-dark">Zurück</button>
        </a>
    </div>
</form>

</body>
</html>