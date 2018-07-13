<?php
// Sample DELETE one row

// database username
$user = 'class';
// database password
$pass = 'password';
// data source = mysql driver, localhost, database = class
$dsn = 'mysql:host=localhost;dbname=class';

// transaction and product to delete
$trans2delete = 'XYZ9999';
$prod2delete = 33;

// PDO class represents the connection
$pdo = new PDO($dsn, $user, $pass);

// SQL
$sql = 'DELETE FROM `purchases` WHERE `transaction` = :trans2delete AND `product_id` = :prod2delete;';

// prepare
$stmt = $pdo->prepare($sql);

// execute
$result = $stmt->execute(array('trans2delete' => $trans2delete, 'prod2delete' => $prod2delete));

echo 'RESULT: ', $result, PHP_EOL;

// closes the database connection
$pdo = NULL;
