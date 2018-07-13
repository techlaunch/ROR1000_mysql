<?php
// Sample INSERT of multiple rows from CSV file

// database username
$user = 'class';
// database password
$pass = 'password';
// data source = mysql driver, localhost, database = class
$dsn = 'mysql:host=localhost;dbname=class';
// open the file
$fh = fopen('names_15.csv', 'r');

try {
	// PDO class represents the connection
	$pdo = new PDO($dsn, $user, $pass);
	// SQL
	$sql = 'INSERT INTO `users`(`name`, `address`, `city`, `state_province`, `postal_code`, `phone`) ';
	// Note the use of "?" as placeholders.  
	// This is needed because the data is in the form of a numeric array
	$sql .= 'VALUES (?, ?, ?, ?, ?, ?)';	
	// prepare
	$stmt = $pdo->prepare($sql);
	
	// loop until eof
	$output = '';
	while(!feof($fh)) {
		// pull row of data from spreadsheet
		$names = fgetcsv($fh);

		// check results to see if valid for insert
		if (isset($names) && is_array($names) && count($names) == 6) {
			// execute
			$result = $stmt->execute($names);	
			// accumulate results
			$output .= '<br />INSERTED: ' . $result . ':' . vsprintf('%20s | %20s | %20s | %6s | %5d | %s', $names) . PHP_EOL;
		} else {
			$output .= '<br />FAILED  : ' . var_export($result, TRUE);
		}
	}
	
	// kill connection`
	$pdo = NULL;

// traps any exceptions which might be thrown
} catch (PDOException $e) {
	echo $e->getMessage();
	echo $e->getTraceAsString();
}

// close file
fclose($fh);

// display results
echo '<pre>' . $output . '</pre>';
