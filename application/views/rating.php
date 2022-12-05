<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="../../images/favicon.png">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/table.css">
    <title>Оценки</title>
</head>
<body>
<div class="page">
    <?php require "templates/header_authorized.php" ?>

    <main class="main">
        <div class="main-container">
            <h1>Оценки</h1>
            <table>
                <tr>
                    <th>№</th>
                    <th>Дисциплина</th>
                    <th>Кафедра</th>
                    <th>Преподаватель</th>
                    <th>Форма</th>
                    <th>Оценка</th>
                    <th>Дата</th>
                </tr>
                <?php
                $counter = 1;
                foreach ($data['request']['sql1'] as $row) {
                    echo "<tr>";
                    echo "<th>" . $counter . "</th>";
                    echo "<th>" . $row['discipline_name'] . "</th>";
                    echo "<th>" . $row['kaf_name'] . "</th>";
                    echo "<th>" . $row['prepod_name'] . "</th>";
                    echo "<th>" . $row['attestation_name'] . "</th>";
                    echo "<th>" . $row['rating_name'] . "</th>";
                    echo "<th>" . $row['exam_date'] . "</th>";
                    echo "</tr>";
                    $counter++;
                }
                ?>
            </table>
            <h1>Задолженности</h1>
            <?php
            if ($data['request']['sql2']['count'] > 0) {
                echo '<p>Всего задолженностей: ' . $data['request']['sql2']['count'] . '</p>';
                echo '<table>
                    <tr>
                        <th>№</th>
                        <th>Дисциплина</th>
                        <th>Форма</th>
                        <th>Дата</th>
                    </tr>';
                $counter = 1;
                foreach ($data['request']['sql3'] as $row) {
                    echo '<tr>';
                    echo '<th>' . $counter . '</th>';
                    echo '<th>' . $row['discipline_name'] . '</th>';
                    echo '<th>' . $row['attestation_form'] . '</th>';
                    echo '<th>' . $row['exam_date'] . '</th>';
                    echo '</tr>';
                    $counter++;
                }
                echo '</table>';
            }
            else {
                echo '<p>Задолженности отсутствуют :)</p>';
            }
            ?>
        </div>
    </main>



</div>
</body>
</html>