<?php
// Sample INSERT of one row

// database username
$user = 'class';
// database password
$pass = 'password';
// data source = mysql driver, localhost, database = class
$dsn = 'mysql:host=localhost;dbname=class';

// data to be inserted
$data = array('name' 	=> 'Desi Arnaz',
			  'address' => '780 North Gower Street',
			  'city'	=> 'Los Angeles',
			  'state' 	=> 'CA',
			  'zip'		=> '90038',
			  'phone'	=> '213-222-4444',
			  'balance' => 556677.88);

// use try { // code } catch (PDOException $e) { // code } to trap errors
try {
	// PDO class represents the connection
	$pdo = new PDO($dsn, $user, $pass);

	// SQL
	$sql = 'INSERT INTO `users`(`name`, `address`, `city`, `state_province`, `postal_code`, `phone`, `balance`) '
		 . 'VALUES (:name, :address, :city, :state, :zip, :phone, :balance)';
	
	// prepare
	$stmt = $pdo->prepare($sql);
	
	// execute
	$result = $stmt->execute($data);

	echo 'RESULT: ', $result;
	
	// closes the database connection
	$pdo = NULL;

// traps any exceptions which might be thrown
} catch (PDOException $e) {
	echo $e->getMessage();
	echo $e->getTraceAsString();
}
