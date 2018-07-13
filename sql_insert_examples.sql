-- inserts 1 row into table "users"
INSERT INTO `users` (`name`, `address`, `city`, `state_province`, `postal_code`, `phone`) 
VALUES ('Abraham Lincoln','413 South 8th Street','Springfield','IL','62701','417-555-1212');

-- inserts 1 row into table "users" with data out of order
INSERT INTO `users` (`name`, `address`, `city`, `state_province`, `postal_code`, `phone`) 
VALUES ('413 South 8th Street','Springfield','IL','62701','417-555-1212','Abraham Lincoln');

-- inserts 3 rows into table "users"
INSERT INTO `class`.`users` (`name`, `address`, `city`, `state_province`, `postal_code`, `phone`, `balance`) 
VALUES 
('Her Majesty The Queen', 'Buckingham Palace', 'Westminster', 'London', 'SW1A 1AA', '44-20-7930-4832', '500000000'), 
('Eric Arthur Blair', '10A Mortimer Place', 'Camden', 'London', 'NW6 5NT', '44-20-7974-4444', '-13.97'),
('Woody Allen', '140 West 57th Street', 'New York', 'NY', '10019', '212-582-9062', '65000000');

-- inserts partial information: balance and phone missing
INSERT INTO `users` (`name`, `address`, `city`, `state_province`, `postal_code`) 
VALUES ('Hunter S. Thompson','2858 Upper River Road','Woody Creek','CO','81656');

-- attempts to insert partial information where NOT NULL columns `state_province` and `postal_code` are omitted
INSERT INTO `users` (`name`, `address`, `city`, ) 
VALUES ('Marie Antoinette','Châteaux de Trianon','Versailles');

-- attempt to insert into child table with invalid product and user IDs
INSERT INTO `class`.`purchases` (`transaction`, `product_id`, `user_id`) 
VALUES ('AAA9999', '00000012', '00000888');

-- insert into the parent table OK
INSERT INTO `users` (`user_id`, `name`, `address`, `city`, `state_province`, `postal_code`) 
VALUES (88, 'Amantine Lucile Aurore Dupin', 'Domaine de George Sand', 'Nohant', 'Nohant-Vic', '36400');

-- retry insert and observe default values
INSERT INTO `class`.`purchases` (`transaction`, `product_id`, `user_id`) 
VALUES ('AAA9999', '00000012', '00000088');
