<h1>Список группы</h1>
<p><?php echo 'Всего студентов в группе: ' . $data['request']['sql1']['count']; ?></p>
<table>
    <tr>
        <th>№</th>
        <th>Группа</th>
        <th>Имя</th>
        <th>Шифр</th>
        <th>Почта</th>
    </tr>
    <?php
    $counter = 1;
    foreach ($data['request']['sql2'] as $row) {
        echo "<tr>";
        echo "<th>" . $counter . "</th>";
        echo "<th>" . $row['group'] . "</th>";
        echo "<th>" . $row['name'] . "</th>";
        echo "<th>" . $row['code'] . "</th>";
        echo "<th>" . $row['email'] . "</th>";
        echo "</tr>";
        $counter++;
    }
    ?>
</table>