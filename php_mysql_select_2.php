<?php
// Sample SELECT using prepared statements

// database username
$user = 'class';
// database password
$pass = 'password';
// data source = mysql driver, localhost, database = class
$dsn = 'mysql:host=localhost;dbname=class';

// use try { // code } catch (PDOException $e) { // code } to trap errors
try {
	// PDO attributes start with PDO::ATTR_*
	// documentation: http://php.net/manual/en/pdo.constants.php
	// This example turns on error reporting
	$pdo = new PDO($dsn, $user, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

	// "outer" SQL statement to get a list of user names and IDs
	$sqlUsers = 'SELECT `user_id`, `name` FROM `users` ORDER BY `name`;';

	// prepared statement
	// NOTE: SUM(`sale_price`) AS s
	$sqlPurchases = 'SELECT `transaction`,`date`,SUM(`sale_price`) AS s '
				  . 'FROM `purchases` WHERE `user_id` = :id GROUP BY `transaction`;';
	$purchStmt = $pdo->prepare($sqlPurchases);
	 
	echo '<h3>User Purchases</h3>', '<hr />', PHP_EOL;
	echo '<table border=2>', PHP_EOL;

	// run query() to get list of user IDs and names
	foreach ($pdo->query($sqlUsers, PDO::FETCH_ASSOC) as $row) {

		// execute the prepared statement using $row data to get user_id
		$purchStmt->execute(array(':id' => $row['user_id']));

		echo '<tr><th>', $row['name'], '</th><td>';
		echo '<table border=1>', PHP_EOL;
		echo '<tr><th>Transaction</th><th>Date</th><th>Amount</th></tr>', PHP_EOL;

		// fetch result
		while($result = $purchStmt->fetch(PDO::FETCH_ASSOC)) {
			echo '<tr>';
			echo '<td>', $result['transaction'], '</td>', PHP_EOL;
			echo '<td>', $result['date'], '</td>', PHP_EOL;
			// Echos SUM(`sale_price`) AS s
			echo '<td align="right">', $result['s'], '</td>', PHP_EOL;
			echo '</tr>';
		}

		echo '</table>', PHP_EOL;
		echo '</td></tr>', PHP_EOL;
	}

	echo '</table>', PHP_EOL;

	// closes the database connection
	$dbh = NULL;

// traps any exceptions which might be thrown
} catch (PDOException $e) {
	echo $e->getMessage();
	echo $e->getTraceAsString();
}


