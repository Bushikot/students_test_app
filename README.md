# students_test_app

###What is this?
Pre-employment test web-application written on PHP with simple MySQL database.

###Technical Assignment

Develop a simple system: 
* Student add/view page (HTML)
* Works on AJAX, nothing should execute page reloading
* Use jQuery or simply JS
* Data for entering through form: first name, last name, group, birthday, email
* Viewing students list suggests output of the above data, and additionally: IP address of registration, time of registration, subjects list with marks, GPA(one number, two decimal places), term number, characteristic of scientific adviser.
* Always show 10 students with top GPA.

Design necessary tables, considering the conditions:
There will be a lot of students(about 1-2 mln). Writing in these tables will be rival access. Students can often moves from group to group. Assumed frequent filter selections(including combinations): last name, group number, term number, GPA.

Write queries for searching in DB:
* coursemates with GPA from X to Y and where name is %name%
* all students, whos IP has more than one registration, and wherein at least one of them must have characteristic.

HTML page design can be ignored.
No frameworks. Database - MySQL.

###Readme
Setup your database connection in "php/db_scripts.php". Database schema is located in the "db" folder(one with test data, another is scheme only). You also need a [Composer](https://getcomposer.org/) to download libraries. 

Exercise queries inside "db" folder(query1.sql, query2.sql).

###Screenshots
![screenshot](https://github.com/bushikot/students_test_app/raw/master/screenshots/screenshot_1.png)
![screenshot](https://github.com/bushikot/students_test_app/raw/master/screenshots/screenshot_2.png)
