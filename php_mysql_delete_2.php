<?php
// Sample DELETE of user + purchases where you know the name of the user
// constraint = ON DELETE RESTRICT

// database username
$user = 'class';
// database password
$pass = 'password';
// data source = mysql driver, localhost, database = class
$dsn = 'mysql:host=localhost;dbname=class';

// user name delete
$name2delete = 'Truman Capote';

// set up the database connection and activate error checking
// note that since the error mode is "warning" a try {} catch() {} block is not used
$pdo = new PDO($dsn, $user, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

// lookup ID from parent table
$sqlLookup = 'SELECT user_id FROM `users` WHERE `name` = :name';
$stmtParent = $pdo->prepare($sqlLookup);
$stmtParent->execute(array('name' => $name2delete));

// should return array(1) { ["user_id"]=> string(8) "00000XXX" }
$lookup = $stmtParent->fetch(PDO::FETCH_ASSOC);

if ($lookup && is_array($lookup) && count($lookup) > 0) {
	
	// SQL to delete purchases
	$sqlPurchases = 'DELETE FROM `purchases` WHERE `user_id` = :userID';
	
	// prepare
	$stmt = $pdo->prepare($sqlPurchases);
	
	// execute
	$delete = $stmt->execute(array('userID' => $lookup['user_id']));

	echo 'PURCHASES DELETE RESULT: ', $delete, PHP_EOL;

	// now you can delete the parent
	$sqlUsers = 'DELETE FROM `users` WHERE `user_id` = :userID';
	
	// prepare
	$stmt = $pdo->prepare($sqlUsers);
	
	// execute
	$delete = $stmt->execute(array('userID' => $lookup['user_id']));
	
	echo '<br />USER DELETE RESULT: ', $delete, PHP_EOL;
}

// closes the database connection
$pdo = NULL;
