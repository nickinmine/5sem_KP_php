<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="../../images/favicon.png">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/table.css">
    <title>Дисциплины</title>
</head>
<body>
<div class="page">
    <?php require "templates/header_authorized.php" ?>

    <main class="main">
        <div class="main-container">
            <h1>Дисциплины</h1>
            <table>
                <tr>
                    <th>№</th>
                    <th>Наименование</th>
                    <th>Кафедра</th>
                    <th>Преподаватель</th>
                    <th>Занятие</th>
                    <!--th>Посещаемость</th-->
                    <th>Часов</th>
                    <th>Аттестация</th>
                </tr>
                <?php
                $counter = 1;
                foreach ($data['request']['sql1'] as $row) {
                    echo "<tr>";
                    echo "<th>" . $counter . "</th>";
                    echo "<th>" . $row['discipline_name'] . "</th>";
                    echo "<th>" . $row['kaf_name'] . "</th>";
                    echo "<th>" . $row['prepod_name'] . "</th>";
                    echo "<th>" . $row['form_name'] . "</th>";
                    /*echo "<th><a href='" . '/attendance?group=' . $data['user']['group'] . '&discipline='
                        . $row['discipline_id'] . '&form=' . $row['form_id'] . '&matcher=' . $row['matcher_id']
                        . "'>Журнал" . "</a</th>";*/
                    echo "<th>" . $row['hours_count'] . "</th>";
                    echo "<th>" . $row['attestation_name'] . "</th>";
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