<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cheese Cake Shop </title>
    <?php
    $cssFile = "../static/css/style.css";
    echo "<link rel='stylesheet' href='" . $cssFile . "'>";
    ?>
    <?php
    $cssFile = "../static/css/nav.css";
    echo "<link rel='stylesheet' href='" . $cssFile . "'>";
    ?>

</head>

<body>
    <div id="main">
        <?php include("header.php"); ?>
    </div>
</body>
<footer>
    <?php include("footer.php"); ?>
</footer>

</html>