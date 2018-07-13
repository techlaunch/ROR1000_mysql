-- join users and purchases table
SELECT * FROM `users` 
JOIN `purchases`
ON `users`.`user_id` = `purchases`.`user_id`;
-- only specify certain columns
SELECT 
`users`.`name`,
`purchases`.`transaction`,
`purchases`.`quantity`,
`purchases`.`sale_price`
FROM `users` 
JOIN `purchases`
ON `users`.`user_id` = `purchases`.`user_id`;
-- join users and purchases table with WHERE clause
SELECT 
`users`.`name`,
`purchases`.`transaction`,
`purchases`.`date`,
`purchases`.`quantity`,
`purchases`.`sale_price`
FROM `users` 
JOIN `purchases`
ON `users`.`user_id` = `purchases`.`user_id` 
WHERE `users`.`user_id` = 66;
-- produces a message user_id ambiguous
SELECT 
`users`.`name`,
`purchases`.`transaction`,
`purchases`.`date`,
`purchases`.`quantity`,
`purchases`.`sale_price`
FROM `users` 
JOIN `purchases`
ON `users`.`user_id` = `purchases`.`user_id` 
WHERE `user_id` = 66;
-- join 3 tables
SELECT 
`users`.`name`,
`products`.`sku`, 
`products`.`title`, 
`products`.`price`,
`purchases`.`transaction`,
`purchases`.`quantity`,
`purchases`.`sale_price`
FROM `users` 
JOIN `purchases`
ON `users`.`user_id` = `purchases`.`user_id`
JOIN `products`
ON `purchases`.`product_id` = `products`.`product_id`
WHERE `users`.`user_id` = 66;
-- using "AS" to give aliases
SELECT 
u.`name`,p.`sku`,p.`title`,p.`price`,
r.`transaction`,r.`quantity`,r.`sale_price`
FROM `users` AS u
JOIN `purchases` AS r
ON u.`user_id` = r.`user_id`
JOIN `products` AS p
ON r.`product_id` = p.`product_id`
WHERE u.`user_id` = 66;
-- use JOIN with SUM() and GROUP BY
SELECT u.`name`, r.`transaction`, r.`date`, SUM(r.`sale_price`)
FROM `users` AS u
JOIN `purchases` AS r
ON u.`user_id` = r.`user_id`
JOIN `products` AS p
ON r.`product_id` = p.`product_id`
WHERE u.`user_id` = 66
GROUP BY r.`transaction`;
