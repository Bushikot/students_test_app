<table class="table table-striped">
    <tr>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>Дата рождения</th>
        <th>email</th>
        <th>IP</th>
        <th>Время регистрации</th>
        <th>Средний балл</th>
        <th></th>
    </tr>

    <?php
    foreach ($students_list as $row) {
        echo '<tr>';
        echo '<td>', $row["fname"], '</td>';
        echo '<td>', $row["lname"], '</td>';
        echo '<td>', $row["birthday"], '</td>';
        echo '<td>', $row["email"], '</td>';
        echo '<td>', $row["ipaddr"], '</td>';
        echo '<td>', $row["regtime"], '</td>';
        echo '<td>', $row["gpa"], '</td>';
        echo "<td><a id='student-more' data='{$row['studentid']}'>Подробнее</a></td>";
        echo '</tr>';
    }
    ?>

</table>