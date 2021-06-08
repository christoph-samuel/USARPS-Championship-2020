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
    <label for="year">Tournament Year:</label>
    <input type="text" id="year" name="year">
    <label for="date">Tournament Date:</label>
    <input type="date" id="date" name="date">
    <button type="submit" class="btn btn-dark">Create Tournament</button>
</form>

</body>
</html>