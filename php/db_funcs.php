<?php

function pdo_connection() {
    $user = "root";
    $pass = "root";
    $dbh = new PDO('mysql:host=localhost;port=8889;dbname=students_test', $user, $pass);
    $dbh->exec("set names utf8");

    return $dbh;
};

function generateFakeData($dbh, $studentid, $groupnumber) {
    $stmt = $dbh->prepare("
        INSERT INTO characteristic (studentid, characteristic)
        VALUES (:studentid, :characteristic)
    ");

    $stmt->execute(array(
        ':studentid' => $studentid,
        ':characteristic' => md5(str_shuffle("qwertyuiopasdfghjklzxcvbnm"))
    ));

    $stmt = $dbh->prepare("
        INSERT INTO studentmove (studentid, termnumber, groupnumber)
        VALUES (:studentid, :termnumber, :groupnumber)
    ");

    $stmt->execute(array(
        ':studentid' => $studentid,
        ':termnumber' => rand(1,12),
        ':groupnumber' => $groupnumber
    ));

    $subjects = $dbh->query('SELECT * FROM subject');
    foreach ($subjects as $row) {
        $stmt = $dbh->prepare("
            INSERT INTO mark (studentid, subjectid, mark)
            VALUES (:studentid, :subjectid, :mark)
        ");

        $stmt->execute(array(
            ':studentid' => $studentid,
            ':subjectid' =>  $row["subjectid"],
            ':mark' =>  rand(0,100)
        ));
    }
};