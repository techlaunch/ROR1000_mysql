<?php
// Sample DELETE of user + purchases where you know the name of the user
// constraint = ON DELETE CASCADE

// database username
$user = 'class';
// database password
$pass = 'password';
// data source = mysql driver, localhost, database = class
$dsn = 'mysql:host=localhost;dbname=class';

// user name delete
$name2delete = 'Rogelio King';

// note that since the error mode is "warning" a try {} catch() {} block is not used
$pdo = new PDO($dsn, $user, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

// SQL to delete the parent
$sqlUsers = 'DELETE FROM `users` WHERE `name` = :name';

// prepare
$stmt = $pdo->prepare($sqlUsers);

// execute
$delete = $stmt->execute(array('name' => $name2delete));

echo '<br />USER DELETE RESULT: ', $delete, PHP_EOL;

// closes the database connection
$pdo = NULL;
