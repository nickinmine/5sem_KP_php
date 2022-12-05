<h1>Список групп</h1>
<p><?php echo 'Всего занятий: ' . $data['request']['sql1']['cnt']; ?></p>
<p>Отсортировать по: <a href="/group/group">Группе</a>, <a href="/group/form">Форме</a>, <a href="/group/discipline">Дисциплине</a></p>
<table>
    <tr>
        <th>№</th>
        <th>Группа</th>
        <th>Форма</th>
        <th>Дисциплина</th>
        <!--th>Посещения</th-->
        <th>Аттестация</th>
    </tr>
    <?php
    $counter = 1;
    foreach ($data['request']['sql2'] as $row) {
        echo "<tr>";
        echo "<th>" . $counter . "</th>";
        echo "<th>" . $row['group_name'] . "</th>";
        echo "<th>" . $row['form_name'] . "</th>";
        echo "<th>" . $row['discipline_name'] . "</th>";
        /*echo "<th><a href='" . '/attendance?group=' . $row['group_id'] . '&discipline=' . $row['discipline_id'] .
            '&form=' . $row['form_id'] . '&matcher=' . $row['matcher_id'] . "'>Журнал" . "</a></th>";*/
        if ($row['form_name'] == 'Лекция' || $row['form_name'] == 'Практика') {
            echo "<th><a href='" . '/progress?group=' . $row['group_id'] . '&discipline=' . $row['discipline_id'] .
                '&matcher=' . $row['matcher_id'] . "'>Ведомость" . "</a></th>";
        } else {
            echo '<th><span style="cursor: help" title="Ведомость аттестации доступна только лектору.">?</span></th>';
        }

        echo "</tr>";
        $counter++;
    }
    ?>
</table>