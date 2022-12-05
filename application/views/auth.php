<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/auth.css">
    <link rel="icon" type="image/png" href="../../images/favicon.png">
    <title>Авторизация</title>
</head>
<body>
<div class="app-router-container">
    <div class="auth-form">
        <form method="post">
            <p class="form-name">Журнал успеваемости</p>
            <label>Логин</label>
            <label>
                <input type="text" name="login" placeholder="Введите логин" required>
            </label>
            <label>Пароль</label>
            <label>
                <input type="password" name="password" placeholder="Введите пароль" required>
            </label>
            <label><a href="" title="Это исключительно Ваши проблемы)">Забыли пароль?</a></label>
            <label class="message"><?php echo $data["message-auth"]?></label>
            <button type="submit" title="Вход в систему">Войти</button>
        </form>
    </div>
</div>
</body>
</html>