<?php
namespace Controllers;

use Utils, JasonGrimes\Paginator;

class MainController
{
    public function defaultAction() {
        require 'app/Views/MainView.php';
    }

    public function registerStudentAction() {
    	if (($fname = filter_input(INPUT_POST, 'fname')) &&
    	    ($lname = filter_input(INPUT_POST, 'lname')) &&
    	    ($groupnumber = filter_input(INPUT_POST, 'groupnumber')) &&
    	    ($birthday = filter_input(INPUT_POST, 'birthday')) &&
    	    ($email = filter_input(INPUT_POST, 'email'))
    	) {
    		$dbh = new Utils\DBUtils();
    		$dbh = $dbh->dbh();

    	    $stmt = $dbh->prepare("
    	        INSERT INTO student (fname, lname, birthday, email, ipaddr)
    	        VALUES (:fname, :lname, :birthday, :email, :ipaddr)
    	    ");

    	    $stmt->execute(array(
    	        ':fname' => $fname,
    	        ':lname' => $lname,
    	        ':birthday' => $birthday,
    	        ':email' => $email,
    	        ':ipaddr' => $_SERVER['REMOTE_ADDR']
    	    ));

    	    $last_studentid = $dbh->lastInsertId();

    	    Utils\DBUtils::generateFakeData($dbh, $last_studentid, $groupnumber);

    	    echo "query_successfully_executed";
    	} else {
    	    echo "error_fields_are_not_set";
    	}
    }

    public function studentListAction() {
    	$dbh = new Utils\DBUtils();
    	$dbh = $dbh->dbh();

    	$students_count = $dbh->query('SELECT COUNT(*) FROM student')->fetchColumn();

    	$totalItems = $students_count;
    	$itemsPerPage = 10;
    	$currentPage = filter_input(INPUT_POST, 'page');
    	$urlPattern = '#(:num)';

    	$topBound = $itemsPerPage * $currentPage;
    	$bottomBound = $topBound - $itemsPerPage;

    	$students_list = $dbh->query("SELECT * FROM student ORDER BY fname, lname LIMIT {$bottomBound}, {$topBound}");

    	require 'app/Views/studentListView.php';

    	$paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);

    	echo $paginator;
    }

    public function StudentMoreAction() {
    	$dbh = new Utils\DBUtils();
		$dbh = $dbh->dbh();

	    $marks = $dbh->prepare("
	      SELECT *
	      FROM mark
	      LEFT JOIN subject ON subject.subjectid = mark.subjectid
	      WHERE studentid = :studentid
	    ");

	    $studentid = filter_input(INPUT_POST, 'studentid');

	    $marks->execute(array(':studentid' => $studentid));

	    $studentmove = $dbh->prepare("SELECT termnumber FROM studentmove WHERE iscurrent IS TRUE AND studentid = :studentid LIMIT 1");
	    $studentmove->execute(array(':studentid' => $studentid));
	    $studentmove = $studentmove->fetch();

	    $characteristic = $dbh->prepare("SELECT characteristic FROM characteristic WHERE studentid = :studentid LIMIT 1");
	    $characteristic->execute(array(':studentid' => $studentid));
	    $characteristic = $characteristic->fetch();

	    require 'app/Views/StudentMoreView.php';
    }

    public function StudentTopTenAction() {
    	$dbh = new Utils\DBUtils();
		$dbh = $dbh->dbh();

    	$students_list = $dbh->query("SELECT * FROM student ORDER BY gpa DESC, fname, lname LIMIT 10");

	    require 'app/Views/StudentTopTen.php';
    }

}
