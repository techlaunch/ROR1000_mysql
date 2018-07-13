-- updates 1 row from table "users"
UPDATE `users` 
SET `balance` = `balance` + 45.72 
WHERE `users`.`user_id` = 80;
-- updates multiple columns
UPDATE `users` 
SET `address` = '123 Main Street', `city` = 'New York',`phone` = '212-305-8888' 
WHERE `users`.`user_id` =00000080;
-- updates multiple rows: corrects rows to state code where state_province is spelled out as "Alaska"
UPDATE `users` 
SET `state_province` = 'AK' 
WHERE `state_province` = 'Alaska';
-- updates ALL rows: increases balance by 1%
UPDATE `users` 
SET `balance` = `balance` * 1.01;
-- update of primary key fails if the value already exists
UPDATE `users` 
SET `user_id` = '88' 
WHERE `users`.`user_id` = 80;
-- update of primary key is OK if value does not already exist
-- notice the effect of constraint cascade on update -- look at purchases table
SELECT * FROM `purchases` WHERE `user_id` = 80;
UPDATE `users` 
SET `user_id` = '99' 
WHERE `users`.`user_id` = 80;
SELECT * FROM `purchases` WHERE `user_id` = 80; -- comes back empty
SELECT * FROM `purchases` WHERE `user_id` = 99; -- comes back w/ 1 row
