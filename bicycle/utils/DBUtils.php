<?php
namespace Utils;

use \PDO;

class DBUtils
{
    protected $dbh;

    public function __construct() {
        try {
            $db_host = 'localhost';
            $db_port = '8889';
            $db_name = 'students_test';
            $db_user = 'root';
            $user_pw = 'root';

            $this->dbh = new PDO('mysql:host=' . $db_host . ';' . ' dbname=' . $db_name, $db_user, $user_pw);  
            $this->dbh = new PDO("mysql:host={$db_host};port={$db_port};dbname={$db_name}", $db_user, $user_pw);  
            $this->dbh->exec("set names utf8");
        }
        catch (PDOException $err) {  
            echo "Ошибка подключения";
            die();
        }
    }

    public function dbh() {
        return $this->dbh;
    }

    public static function generateFakeData($dbh, $studentid, $groupnumber) {
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
    }
}
