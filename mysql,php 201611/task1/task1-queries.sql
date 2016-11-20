-- Query all posts
SELECT * 
FROM mydb.posts
ORDER BY id desc
LIMIT 10
OFFSET 0;

-- Query Posts by Category Filter
SELECT * 
FROM mydb.posts 
WHERE 
id in 
	(
		SELECT posts_id 
		FROM mydb.post_categories
		WHERE categories_id IN (1, 2, 3)
	)
ORDER BY id desc
LIMIT 10
OFFSET 0;

-- Query Posts by Category Filter with user Likes
SELECT  posts.id, posts.text, likes.id as like_id
FROM posts
LEFT JOIN likes 
	ON (
			posts.id = likes.posts_id AND
            likes.users_id = 1
				
		)
WHERE 
posts.id in 
	(
		SELECT posts_id 
		FROM post_categories
		WHERE categories_id IN (1,2,3)
	)

ORDER BY posts.id desc
LIMIT 10
OFFSET 0;

-- Query all users who likes post with posts_id = 2
SELECT *
FROM users
WHERE users.id IN 
(SELECT users_id
FROM likes
WHERE likes.posts_id = 2)
LIMIT 10
OFFSET 0;


-- Update queries 

-- Create user
INSERT INTO `users`
( `name`)
VALUES
("User name");


-- create post
START TRANSACTION;

INSERT INTO `posts`
(`text`,
`users_id`)
VALUES
("Post text",
1);

INSERT INTO `post_categories`
(`categories_id`,
`posts_id`)
VALUES
(1,
LAST_INSERT_ID());


COMMIT;







