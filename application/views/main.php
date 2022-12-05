<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="../../images/favicon.png">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/nav_list.css">
    <title>Главная страница</title>
</head>
<body>
<div class="page">
    <?php require "templates/header_authorized.php" ?>

    <main class="main">
        <div class="main-container">
            <div class="nav">
                <h1>Навигация</h1>
                <?php
                    if ($data['user']['role'] == 1) {
                    require "templates/student_nav.php";
                    }
                    if ($data['user']['role'] == 2) {
                    require "templates/prepod_nav.php";
                    }
                    if ($data['user']['role'] == 3) {
                        require "templates/admin_nav.php";
                    }
                ?>
            </div>
        </div>
    </main>

</div>
</body>
</html>
