<?php
// Sample INSERT where constraint exists

// database username
$user = 'class';
// database password
$pass = 'password';
// data source = mysql driver, localhost, database = class
$dsn = 'mysql:host=localhost;dbname=class';

try {
	// Default PDO error mode = PDO::ERRMODE_SILENT
	//$pdo = new PDO($dsn, $user, $pass);
	// Now turn on PDO::ERRMODE_EXCEPTION
	$pdo = new PDO($dsn, $user, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	
	// SQL
	$sql = 'INSERT INTO `purchases` (`transaction`, `product_id`, `user_id`) '
		 . 'VALUES (:transaction, :productID, :userID);';	

	// prepare
	$stmt = $pdo->prepare($sql);
	
	// execute using a product id and user id which both do not exist
	$result = $stmt->execute(array('transaction' => 'AAA9999', 'productID' => 99, 'userID' => 99));	

	// display results
	echo '<br />INSERTED: ' . $result . PHP_EOL;
			
	// kill connection`
	$pdo = NULL;

// traps any exceptions which might be thrown
} catch (PDOException $e) {
	echo $e->getMessage();
	echo $e->getTraceAsString();
}
