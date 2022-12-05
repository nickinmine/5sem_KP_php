<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="../../images/favicon.png">
    <link rel="stylesheet" href="../../css/index.css">
    <title>Страница не найдена</title>
</head>
<body>
<div class="page">
    <?php require "templates/header_index.php" ?>

    <main class="main">
        <div class="main-container">
            <h1>Уф, <?php echo http_response_code() ?>!</h1>
            <p>Кажется, запрашиваемой Вами страницы не существует.</p>
            <img class="img404" src="../../images/kotik.jpg" alt=":("><br><br><br>
        </div>
    </main>

    <footer class="footer">
        <div class="footer-container">
            <span class="footer-span-text1">
                Автор сайта: Зубов Николай Андреевич<br>
                Студент группы ИКБО-10-20<br>
                zubov.n.a@edu.mirea.ru
            </span>
            <span class="footer-span-text2">
                <a href="https://www.mirea.ru/">https://www.mirea.ru/</a><br>
                <address>РТУ МИРЭА. Москва, Проспект Вернадского, 78</address>
            </span>
        </div>
    </footer>
</div>
</body>
</html>