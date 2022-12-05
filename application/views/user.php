<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="../../images/favicon.png">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/user.css">
    <title>Профиль</title>
</head>
<body>
<div class="page">
    <?php require "templates/header_authorized.php" ?>

    <main class="main">
        <div class="main-container">
            <h1>Профиль</h1>
            <?php
            if ($data['user']['role'] == 1) {
                require "templates/student_profile.php";
            }
            if ($data['user']['role'] == 2) {
                require "templates/prepod_profile.php";
            }
            if ($data['user']['role'] == 3) {
                require "templates/admin_profile.php";
            }
            ?>
            <div class="basic-info">
                <h2>Изменить данные</h2>
                <div class="forms-collection">
                    <div class="forms-element">
                        <form action="/user/login" method="post">
                            <h3 class="form-name">Смена логина</h3>
                            <label>Логин</label>
                            <label>
                                <input type="text"
                                       name="login"
                                       value="<?php echo $data['user']['login']; ?>"
                                       placeholder="<?php echo $data['user']['login']; ?>"
                                       required>
                            </label>
                            <label class="message"><?php echo $data["message-change-login"]; ?></label>
                            <button type="submit" title="Сменить логин">Сменить</button>
                        </form>
                    </div>
                    <div class="forms-element">
                        <form action="/user/password" method="post">
                            <h3 class="form-name">Смена пароля</h3>
                            <label>Пароль</label>
                            <label>
                                <input type="password"
                                       name="old-password"
                                       required
                                       placeholder="Введите старый пароль">
                            </label>
                            <label>
                                <input type="password"
                                       name="new-password1"
                                       placeholder="Введите новый пароль">
                            </label>
                            <label>
                                <input type="password"
                                       name="new-password2"
                                       placeholder="Повторите новый пароль">
                            </label>
                            <label class="message"><?php echo $data["message-change-password"]?></label>
                            <button type="submit" title="Сменить пароль">Сменить</button>
                        </form>
                    </div>
                    <div class="forms-element">
                        <form action="/user/email" method="post">
                            <h3 class="form-name">Смена почты</h3>
                            <label>Почта</label>
                            <label>
                                <input type="email"
                                       name="email"
                                       value="<?php echo $data['user']['email']; ?>"
                                       placeholder="<?php echo $data['user']['email']; ?>"
                                       required>
                            </label>
                            <label class="message"><?php echo $data["message-change-email"]?></label>
                            <button type="submit" title="Сменить почту">Сменить</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </main>

</div>
</body>
</html>
