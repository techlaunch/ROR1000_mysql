-- REF: https://dev.mysql.com/doc/refman/5.5/en/func-op-summary-ref.html
-- returns all rows from table "users"
SELECT * FROM `users`;
-- returns only name and city from table "users"
SELECT `name`, `city` FROM `users`;
-- returns minimum, maximum, average account balances and a sum
SELECT MIN(`balance`), MAX(`balance`), AVG(`balance`), SUM(`balance`) FROM `users`;
-- returns list of users with a negative account balance
SELECT * FROM `users` WHERE `balance` < 0;
-- returns count of users with a negative account balance
SELECT COUNT(`user_id`) FROM `users` WHERE `balance` < 0;
-- returns list of users whose phone number city code portion starts with "9"
SELECT * FROM `users` WHERE `phone` LIKE '%-9%';
-- returns list of users in Alaska
SELECT * FROM users WHERE `state_province` = 'AK' OR `state_province` = 'Alaska';
-- returns list of users in a state which starts with A whose account balance > 100
SELECT * FROM `users` WHERE `state_province` LIKE 'A%' AND `balance` > 100;
-- returns list of users sorted by account balance lowest to highest
SELECT `name`,`balance` FROM `users` ORDER BY `balance` ASC;
-- returns list of users sorted by account balance highest to lowest
SELECT `name`,`balance` FROM `users` ORDER BY `balance` DESC;
-- returns list sorted by state_province and then city
SELECT `name`,`balance`,`state_province`,`city` FROM `users` ORDER BY `state_province`,`city` ASC;
-- returns the 1st 10 users sorted by name
SELECT `name`,`balance` FROM `users` ORDER BY `name` ASC LIMIT 10;
-- returns the 2nd 10 users sorted by name
SELECT `name`,`balance` FROM `users` ORDER BY `name` ASC LIMIT 10 OFFSET 10;
-- returns a count of users in each state or province
SELECT COUNT(`user_id`), `state_province` FROM `users` GROUP BY `state_province`;
-- returns a list of distinct state_province
SELECT DISTINCT `state_province` FROM `users` ORDER BY `state_province`;
