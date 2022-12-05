<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="../../images/favicon.png">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/table.css">
    <title>Список группы</title>
</head>
<body>
<div class="page">
    <?php require "templates/header_authorized.php" ?>

    <main class="main">
        <div class="main-container">
            <?php
            if ($data['user']['role'] == 1) {
                require "templates/student_group.php";
            }
            if ($data['user']['role'] == 2) {
                require "templates/prepod_group.php";
            }
            ?>
        </div>
    </main>



</div>
</body>
</html>