<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="../../images/favicon.png">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/table.css">
    <title>Задолженности</title>
</head>
<body>
<div class="page">
    <?php require "templates/header_authorized.php" ?>

    <main class="main">
        <div class="main-container">
            <h1>Задолженности</h1>
            <h2>Список студентов кафедры с задолженностями</h2>

            <table>
                <tr>
                    <th>№</th>
                    <th>Группа</th>
                    <th>Имя</th>
                    <th>Дисциплина</th>
                    <th>Форма</th>
                    <th>Дата</th>
                </tr>
                <?php
                $counter = 1;
                foreach ($data['request']['sql1'] as $row) {
                    echo "<tr>";
                    echo "<th>" . $counter . "</th>";
                    echo "<th>" . $row['group'] . "</th>";
                    echo "<th>" . $row['user_name'] . "</th>";
                    echo "<th>" . $row['discipline_name'] . "</th>";
                    echo "<th>" . $row['attestation_name'] . "</th>";
                    echo "<th>" . $row['exam_date'] . "</th>";
                    echo "</tr>";
                    $counter++;
                }
                ?>
            </table>
        </div>
    </main>



</div>
</body>
</html>