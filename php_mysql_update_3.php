<?php
// Sample UPDATE purchases with random dates to generate fake data

// database username
$user = 'class';
// database password
$pass = 'password';
// data source = mysql driver, localhost, database = class
$dsn = 'mysql:host=localhost;dbname=class';

// use try { // code } catch (PDOException $e) { // code } to trap errors
try {
	// PDO class represents the connection
	$pdo = new PDO($dsn, $user, $pass);

	// lookup ID from parent table
	$sqlLookup = "SELECT * FROM `purchases` WHERE `transaction` > 'V' ORDER BY `transaction`;";
	$stmtLookup = $pdo->prepare($sqlLookup);
	$stmtLookup->execute();
	
	// prepare update statement
	$sql = 'UPDATE `purchases` SET `date`= :date WHERE `transaction` = :transaction;';
	$stmt = $pdo->prepare($sql);

	$trans = '';
	echo '<pre>';
	while($line = $stmtLookup->fetch(PDO::FETCH_ASSOC)) {
		if ($line['transaction'] != $trans) {
			$trans = $line['transaction'];
			// generate new fake date
			$year = rand(1990, date('Y'));
			$month = sprintf('%02d', rand(1,12));
			$day = sprintf('%02d', rand(1,28));
			$hour = sprintf('%02d', rand(0,23));
			$min = sprintf('%02d', rand(1,59));
			$sec = sprintf('%02d', rand(1,59));
			$date = sprintf('%4d-%02d-%02d %02d:%02d:%02d', $year, $month, $day, $hour, $min, $sec);
			// execute
			$result = $stmt->execute(array('date' => $date, 'transaction' => $trans));
			echo 'RESULT: ', $result, ':', $trans, ':', $date, PHP_EOL;
		}		
	}
	echo '</pre>';
	
	// closes the database connection
	$pdo = NULL;

// traps any exceptions which might be thrown
} catch (PDOException $e) {
	echo $e->getMessage();
	echo $e->getTraceAsString();
}
