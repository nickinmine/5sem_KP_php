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
            <table>
                <tr>
                    <th>№</th>
                    <th>Имя</th>
                    <?php
                    $date = array();
                    $comment = array();
                    $column = 0;
                    foreach ($data['request']['sql1'] as $row) {
                        $column++;
                        echo "<th>" . $row['date'] . "<br>" . $row['comment'] . "</th>";
                        $date[$column] = $row['date'];
                        $comment[$column] = $row['comment'];
                    }
                    ?>
                </tr>
                <?php
                $counter = 1;
                foreach ($data['request']['sql2'] as $row) {
                    echo "<tr>";
                    echo "<th>" . $counter . "</th>";
                    echo "<th>" . $row['name'] . "</th>";
                    $attendance = array();
                    $counter2 = 1;

                    if ($column != 0) {
                        foreach ($data['request']['sql3'] as $row2) {
                            if ($row2['student_id'] == $row['user_id'] && $row2['date']) {
                                echo "<th>".$row2['date'].$row2['comment']."</th>";
                            } else {
                                echo "<th></th>";
                            }
                        }
                    }
                    /*foreach ($data['request']['sql3'] as $row2) {
                        if ($row['user_id'] == $row2['student_id']) {
                            $attendance[$counter2]['date'] = $row2['date'];
                            $attendance[$counter2]['comment'] = $row2['comment'];
                            $counter2++;
                        }
                    }
                    for ($i = 1; $i <= $column; $i++) {
                    //foreach ($attendance[$counter2] as $row2) {
                        if ($attendance[$i]['date'] == $date[$i] && $attendance[$i]['comment'] == $comment[$i]) {
                            echo "<th>X</th>";
                        }
                        else
                            echo "<th></th>";
                    }
                    echo "</tr>";*/
                    $counter++;
                }
                ?>
            </table>
        </div>
    </main>



</div>
</body>
</html>