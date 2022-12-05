<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="../../images/favicon.png">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/table.css">
    <title>Посещения</title>
</head>
<body>
<div class="page">
    <?php require "templates/header_authorized.php" ?>

    <main class="main">
        <div class="main-container">
            <h1>Посещения</h1>
            <!--table>
                <tr>
                    <th>№</th>
                    <th>Дисциплина</th>
                    <th>Кафедра</th>
                    <th>Преподаватель</th>
                    <th>Форма</th>
                    <th>Оценка</th>
                    <th>Дата</th>
                </tr>
                <?/*php
                $mysqli = get_sql_connection();
                $stmt = $mysqli->prepare("
                    SELECT
                        `kaf`.`name` AS kaf_name,
                        `discipline`.`name` AS discipline_name,
                        `user`.`name` AS prepod_name,
                        `attestation`.`form` AS attestation_name,
                        `rating`.`name` AS rating_name,
                        `progress`.`exam_date`
                    FROM `kaf`
                    JOIN `discipline` ON `kaf`.`kaf_id` = `discipline`.`kaf`
                    JOIN `matcher` ON `discipline`.`discipline_id` = `matcher`.`discipline`
                    JOIN `progress` ON `matcher`.`matcher_id` = `progress`.`matcher`
                    JOIN `user` ON `user`.`user_id` = `matcher`.`user_id`
                    JOIN `attestation` ON `discipline`.`attestation` = `attestation`.`attestation_id`
                    JOIN `rating` ON `progress`.`rating` = `rating`.`rating_id`
                    WHERE `progress`.`student_id` = ?
                    ORDER BY `discipline`, `user`.`name`;
                ");
                $stmt->bind_param("i", $_SESSION['user']['id']);
                $stmt->execute();
                $res = $stmt->get_result();
                $counter = 1;
                foreach ($res as $row) {
                    echo "<tr>";
                    echo "<th>" . $counter . "</th>";
                    echo "<th>" . $row['discipline_name'] . "</th>";
                    echo "<th>" . $row['kaf_name'] . "</th>";
                    echo "<th>" . $row['prepod_name'] . "</th>";
                    echo "<th>" . $row['attestation_name'] . "</th>";
                    echo "<th>" . $row['rating_name'] . "</th>";
                    echo "<th>" . $row['exam_date'] . "</th>";

                    *//*$stmt = $mysqli->prepare("
                         SELECT `name` FROM `discipline` WHERE `discipline_id` =
                        (SELECT `discipline` FROM `matcher` WHERE `matcher_id` =
                        (SELECT `matcher` FROM `progress` WHERE `progress_id` = ?))");
                    $stmt->bind_param("i", $row['progress_id']);
                    $stmt->execute();
                    $res1 = $stmt->get_result()->fetch_assoc();
                    echo "<th>" . $res1['name'] . "</th>";

                    $stmt = $mysqli->prepare("SELECT `kaf`.`name`, progress.*
                        FROM `kaf`
                        JOIN `discipline` ON `kaf`.`kaf_id` = `discipline`.`kaf`
                        JOIN `matcher` ON `discipline`.`discipline_id` = `matcher`.`discipline`
                        JOIN `progress` ON `matcher`.`matcher_id` = `progress`.`matcher`
                        WHERE `progress`.`progress_id` = ?");
                    $stmt->bind_param("i", $row['progress_id']);
                    $stmt->execute();
                    $res1 = $stmt->get_result()->fetch_assoc();
                    echo "<th>" . $res1['name'] . "</th>";

                    $stmt = $mysqli->prepare("SELECT `name` FROM `user` WHERE `user_id` = (SELECT `user_id` FROM `matcher` WHERE `matcher_id` = (SELECT `matcher` FROM `progress` WHERE `progress_id` = ?))");
                    $stmt->bind_param("i", $row['progress_id']);
                    $stmt->execute();
                    $res1 = $stmt->get_result()->fetch_assoc();
                    echo "<th>" . $res1['name'] . "</th>";

                    $stmt = $mysqli->prepare("SELECT `form` FROM `attestation` WHERE `attestation_id` = (SELECT `discipline`.`attestation` FROM `discipline` WHERE `discipline_id` = (SELECT `discipline` FROM `matcher` WHERE `matcher_id` = (SELECT `matcher` FROM `progress` WHERE `progress_id` = ?)))");
                    $stmt->bind_param("i", $row['progress_id']);
                    $stmt->execute();
                    $res1 = $stmt->get_result()->fetch_assoc();
                    echo "<th>" . $res1['form'] . "</th>";

                    $stmt = $mysqli->prepare("SELECT `name` FROM `rating` WHERE `rating_id` = (SELECT `rating` FROM  `progress` WHERE `progress_id` = ?)");
                    $stmt->bind_param("i", $row['progress_id']);
                    $stmt->execute();
                    $res1 = $stmt->get_result()->fetch_assoc();
                    echo "<th>" . $res1['name'] . "</th>";

                    echo "<th>" . $row['exam_date'] . "</th>";*//*

                    echo "</tr>";
                    $counter++;
                }
                */?>
            </table-->
        </div>
    </main>

</div>
</body>
</html>