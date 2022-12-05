<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="../../images/favicon.png">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/nav_list.css">
    <link rel="stylesheet" href="../../css/user.css">
    <title>Страница администрирования</title>
</head>
<body>
<div class="page">
    <?php require "templates/header_authorized.php" ?>

    <main class="main">
        <div class="main-container">
            <h1>Страница администрирования</h1>

            <div class="forms-collection">
                <div class="forms-element">
                    <form action="/admin/setmatcher" method="post">
                        <h3 class="form-name">Назначение преподавателя и группы</h3>
                        <label>Группа</label><br>
                        <label>
                            <select name="group" required>
                                <option selected></option>
                                <?php
                                foreach ($data['request']['sql1'] as $row) {
                                    echo "<option value='" . $row['group_id'] . "'>" . $row['group'] . "</option>";
                                }

                                ?>
                            </select>
                        </label><br>
                        <label>Дисциплина</label><br>
                        <label>
                            <select name="discipline" required>
                                <option selected></option>
                                <?php
                                foreach ($data['request']['sql2'] as $row) {
                                    echo "<option value='" . $row['discipline_id'] . "'>" . $row['name'] . "</option>";
                                }

                                ?>
                            </select>
                        </label><br>
                        <label>Форма</label><br>
                        <label>
                            <select name="classform" required>
                                <option selected></option>
                                <?php
                                foreach ($data['request']['sql3'] as $row) {
                                    echo "<option value='" . $row['form_id'] . "'>" . $row['name'] . "</option>";
                                }

                                ?>
                            </select>
                        </label><br>
                        <label>Часов</label><br>
                        <label>
                            <input type="number"
                                   name="hours"
                                   max="256"
                                   min="0"
                                   size="2"
                                   required>
                        </label>
                        <label>Преподаватель</label><br>
                        <label>
                            <select name="prepod" required>
                                <option selected></option>
                                <?php
                                foreach ($data['request']['sql4'] as $row) {
                                    echo "<option value='" . $row['user_id'] . "'>" . $row['name'] . "</option>";
                                }

                                ?>
                            </select>
                        </label><br>
                        <button type="submit" title="Назначить занятие">Назначить</button>
                    </form>
                </div>
            </div>

            <div class="forms-collection">
                <div class="forms-element">
                    <form action="/admin/deleteuser" method="post">
                        <h3 class="form-name">Редактирование пользователя (удаление студента)</h3>
                        <label>Идентификатор пользователя</label><br>
                        <label>
                            <select name="user_id" required>
                                <option selected></option>
                                <?php
                                foreach ($data['request']['sql5'] as $row) {
                                    echo "<option value='" . $row['user_id'] . "'>" . $row['user_id'] . " - " . $row['name'] . "</option>";
                                }
                                ?>
                            </select>
                        </label><br>
                        <button type="submit" title="Удалить пользователя">Удалить</button>
                    </form>
                </div>
            </div>

        </div>
    </main>

</div>
</body>
</html>
