<?php

require '../vendor/autoload.php';
require 'db_funcs.php';

use JasonGrimes\Paginator;

$dbh = pdo_connection();

if ($_POST) {
    switch($_POST["func"]) {
        case "register":
            registerStudent();
            break;
        case "get_paged_list":
            getPagedStudentsList();
            break;
        case "get_top_ten":
            getTopTenStudents();
            break;
        case "get_additional_data":
            getAdditionalData();
            break;
    }
}

function registerStudent() {
    if (!empty($_POST["fname"]) &&
        !empty($_POST["lname"]) &&
        !empty($_POST["groupnumber"]) &&
        !empty($_POST["birthday"]) &&
        !empty($_POST["email"])
    ) {
        global $dbh;

        //сюда нужно filter_var
        $stmt = $dbh->prepare("
            INSERT INTO student (fname, lname, birthday, email, ipaddr)
            VALUES (:fname, :lname, :birthday, :email, :ipaddr)
        ");

        $stmt->execute(array(
            ':fname' => $_POST["fname"],
            ':lname' => $_POST["lname"],
            ':birthday' => $_POST["birthday"],
            ':email' => $_POST["email"],
            ':ipaddr' => $_SERVER['REMOTE_ADDR']
        ));

        $last_studentid = $dbh->lastInsertId();

        generateFakeData($dbh, $last_studentid, $_POST["groupnumber"]);

        echo "query_successfully_executed";
    } else {
        echo "error_fields_are_not_set";
    }
}

function getPagedStudentsList() {
    global $dbh;

    $students_count = $dbh->query('SELECT COUNT(*) FROM student')->fetchColumn();

    $totalItems = $students_count;
    $itemsPerPage = 10;
    $currentPage = $_POST['page'];
    $urlPattern = '#(:num)';

    $topBound = $itemsPerPage * $currentPage;
    $bottomBound = $topBound - $itemsPerPage;

    $students_list = $dbh->query("SELECT * FROM student ORDER BY fname, lname LIMIT {$bottomBound}, {$topBound}");

    include 'template.php';

    $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);

    echo $paginator;
}

function getTopTenStudents() {
    global $dbh;
    $students_list = $dbh->query("SELECT * FROM student ORDER BY gpa DESC, fname, lname LIMIT 10");

    include 'template.php';
}

function getAdditionalData() {
    global $dbh;

    $marks = $dbh->prepare("
      SELECT *
      FROM mark
      LEFT JOIN subject ON subject.subjectid = mark.subjectid
      WHERE studentid = :studentid
    ");
    $marks->execute(array(':studentid' => $_POST["studentid"]));

    $studentmove = $dbh->prepare("SELECT termnumber FROM studentmove WHERE iscurrent IS TRUE AND studentid = :studentid LIMIT 1");
    $studentmove->execute(array(':studentid' => $_POST["studentid"]));
    $studentmove = $studentmove->fetch();

    $characteristic = $dbh->prepare("SELECT characteristic FROM characteristic WHERE studentid = :studentid LIMIT 1");
    $characteristic->execute(array(':studentid' => $_POST["studentid"]));
    $characteristic = $characteristic->fetch();

    include 'template2.php';
}

