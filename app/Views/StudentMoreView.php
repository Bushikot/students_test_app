<label>Семестр:</label>
<?php
    echo $studentmove["termnumber"];
?>

<br>
<label>Характеристика:</label>
<p>
    <?php
    echo $characteristic["characteristic"];
    ?>
</p>

<table class="table table-bordered">
    <tr>
        <th>Дисциплина</th>
        <th>Оценка</th>
    </tr>

    <?php
    foreach ($marks as $row) {
        echo '<tr>';
        echo '<td>', $row["subject"], '</td>';
        echo '<td>', $row["mark"], '</td>';
        echo '</tr>';
    }
    ?>

</table>