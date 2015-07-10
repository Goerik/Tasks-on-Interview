SELECT 
	b.title, q.authors FROM book b
INNER JOIN 
	(SELECT book_id, COUNT(1) as authors FROM authorship
	GROUP BY book_id
	HAVING count(1) >= 3) q
ON 
	(b.id = q.book_id)

