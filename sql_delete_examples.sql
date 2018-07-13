-- deletes 1 row from table "users"
DELETE FROM `users` 
WHERE `users`.`user_id` = 86;
-- deletes multiple rows from table "purchases"
DELETE FROM `purchases` 
WHERE `user_id` = 0;
-- attempt to delete from parent table where child rows exist and constraint = restrict
DELETE FROM `users` 
WHERE `users`.`user_id` = 88;
-- either delete child rows or change constraint to cascade on delete
DELETE FROM `purchases` 
WHERE `purchases`.`user_id` = 88;
DELETE FROM `users` 
WHERE `users`.`user_id` = 88;
