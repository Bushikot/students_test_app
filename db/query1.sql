SELECT * 
FROM student 
LEFT JOIN studentmove ON studentmove.studentid = student.studentid AND iscurrent IS TRUE
WHERE 
	(termnumber) IN 
	(
    	SELECT termnumber FROM studentmove GROUP BY termnumber HAVING count(*) > 1
	) 
	AND fname = "Максим"
	AND gpa BETWEEN 0 AND 100