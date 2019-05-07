 SELECT DATEDIFF(MAX(date), MIN(date)) AS 'uptime' FROM member_history;
#or SELECT DATEDIFF(MAX(date_last_film), MIN(date_last_film)) AS 'uptime' FROM member;
