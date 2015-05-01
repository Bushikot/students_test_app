SELECT studentid
FROM student
WHERE 
	ipaddr IN 
	(
		SELECT ipaddr
		FROM student
		GROUP BY ipaddr
		HAVING count(*) > 1
	) 
	AND ipaddr IN 
	(
		SELECT ipaddr
		FROM student
		LEFT JOIN characteristic ON characteristic.studentid = student.studentid
		WHERE characteristic IS NOT NULL
	)