<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="../../images/favicon.png">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/table.css">
    <title>Аттестация</title>
</head>
<body>
<div class="page">
    <?php require "templates/header_authorized.php" ?>

    <main class="main">
        <div class="main-container">
            <h1><?php echo $data['request']['sql1']['group'] ?></h1>
            <h2><?php echo $data['request']['sql1']['name'] . ", " . $data['request']['sql1']['form'] ?></h2>

            <table>
                <tr>
                    <th>№</th>
                    <th>Имя</th>
                    <th>Назначить оценку</th>
                    <th>Оценка</th>
                    <th>Дата</th>
                </tr>
                <?php
                $counter = 1;
                foreach ($data['request']['sql2'] as $row) {
                    echo "<tr>";
                    echo "<th>" . $counter . "</th>";
                    echo "<th>" . $row['name'] . "</th>";
                    echo "<th><form action='' method='post'>";
                    echo "<input type='hidden' name='user_id' value='" . $row['user_id'] . "'>";
                    echo '<label><select name="rating"';
                    if ($data['request']['sql3']['success'][$counter] == 1) {
                        echo 'disabled';
                    }
                    echo '><option selected></option>';
                    foreach ($data['request']['rating'] as $rating) {
                        echo "<option value='" . $rating['rating_id'];
                        if ($data['request']['sql3']['rating'][$counter] == $rating['rating_id']) {
                            echo "' selected>";
                        } else {
                            echo "'>";
                        }
                        echo $rating['name'] . "</option>";
                    }
                    echo '</select></label> ';
                    echo '<button type="submit"';
                    if ($data['request']['sql3']['success'][$counter] == 1) {
                        echo 'disabled';
                    }
                    echo '>Подтвердить</button></form></th>';
                    echo "<th>" . $data['request']['sql3']['result'][$counter] . "</th>";
                    echo "<th>" . $data['request']['sql3']['date'][$counter] . "</th>";
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