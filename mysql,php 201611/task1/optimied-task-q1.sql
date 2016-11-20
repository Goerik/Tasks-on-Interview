DROP TABLE IF EXISTS `posts_with_categories`;

-- Create temporay table for storing post_id with search categories
CREATE TEMPORARY TABLE `posts_with_categories` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX temporaty_index (`id`)
) ENGINE=Memory DEFAULT CHARSET=utf8;


-- Insert  categories id
INSERT INTO posts_with_categories  (id)
SELECT 1 as id
UNION ALL
SELECT 2 as id
UNION ALL
SELECT 3 as id;


-- main query


SELECT  posts.id, posts.text, likes.id as like_id
FROM posts
LEFT JOIN likes 
	ON (
			likes.users_id = 1 AND
            posts.id = likes.posts_id
		)
INNER JOIN 
(
SELECT DISTINCT posts_id 
		FROM post_categories
        INNER JOIN posts_with_categories
        ON (posts_with_categories.id) = post_categories.categories_id
) as p ON (p.posts_id = posts.id)

ORDER BY posts.id desc
LIMIT 10
OFFSET 0;
