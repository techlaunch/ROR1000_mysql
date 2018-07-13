<?php
// Sample UPDATE row
// Note the effect on the rows in the related table purchases

// database username
$user = 'class';
// database password
$pass = 'password';
// data source = mysql driver, localhost, database = class
$dsn = 'mysql:host=localhost;dbname=class';

// user name update
$name2update = 'Truman Capote';

// data to be updated -- first time fails because 152 already exists
// 99 will be tried next, and should work OK because this user_id is not in the table
$data = array('userID' 	=> 153,	
			  'address' => '1633 East Colorado Boulevard',
			  'city'	=> 'Pasadena',
			  'phone'	=> '626-795-0431',
			  'zip'		=>'91106',
			  'name'	=> $name2update);

// use try { // code } catch (PDOException $e) { // code } to trap errors
try {
	// set up the database connection and activate error checking
	$pdo = new PDO($dsn, $user, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

	// SQL
	$sql = 'UPDATE `users` '
		 . 'SET `user_id`= :userID,`address`= :address,`city`= :city,`postal_code`= :zip,`phone` = :phone '
		 . 'WHERE `name` = :name;';
	
	// prepare
	$stmt = $pdo->prepare($sql);
	
	// execute
	$result = $stmt->execute($data);

	echo 'RESULT: ', $result, PHP_EOL;
	
	// closes the database connection
	$pdo = NULL;

// traps any exceptions which might be thrown
} catch (PDOException $e) {
	echo $e->getMessage();
	echo $e->getTraceAsString();
}
