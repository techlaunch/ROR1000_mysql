<?php
// Sample SELECT joining 3 tables -- nicely formatted

// database username
$user = 'class';
// database password
$pass = 'password';
// data source = mysql driver, localhost, database = class
$dsn = 'mysql:host=localhost;dbname=class';
// PDO class with error reporting
$pdo = new PDO($dsn, $user, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

// SQL, prepare, execute
$sql = 'SELECT '
	 . 'u.`name`,'
	 . 'p.`sku`,p.`title`,p.`price`,'
	 . 'r.`transaction`,r.`quantity`,r.`sale_price` '
	 . 'FROM `users` AS u '
	 . 'JOIN `purchases` AS r '
	 . 'ON u.`user_id` = r.`user_id` '
	 . 'JOIN `products` AS p '
	 . 'ON r.`product_id` = p.`product_id` '
	 . 'WHERE u.`name` = :name '
	 . 'ORDER BY r.`transaction`;';

// use try { //code } catch() { // recovery code } when using PDO::ERRMODE_EXCEPTION
try {
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array('name' => 'Lana Burns'));

	$first = TRUE;
	$name = 'Unknown';
	$oldTrans = '';
	while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
		// check to see if $result is OK
		if ($result && is_array($result) && count($result) > 0) {
			// first time
			if ($first) {
				$first = FALSE;
				$name = $result['name'];
				echo '<style>';
				echo 'td { border: 1px solid gray; }';
				echo 'th { border: 1px solid black; }';
				echo 'table { width: 600px; }';
				echo '</style>' . PHP_EOL;
				echo "<h1>$name</h1><hr />\n";
				echo '<table>';
			}
			// deal with transactions
			$trans = $result['transaction'];
			if ($trans != $oldTrans) {
				echo '</table>';
				echo "<br /><h3>Transaction: $trans</h3>\n";
				echo '<table>';
				echo '<tr><th>Product</th><th>SKU</th><th>Price</th><th>Quantity</th><th>Sale Price</th></tr>' . PHP_EOL;
				$oldTrans = $trans;
			}
			echo '<tr>';
			echo '<td align="right">' . $result['title'] . '</td>';
			echo '<td align="right">' . $result['sku'] . '</td>';
			echo '<td align="right">' . $result['price'] . '</td>';
			echo '<td align="right">' . $result['quantity'] . '</td>';
			echo '<td align="right">' . $result['sale_price'] . '</td>';
			echo '</tr>' . PHP_EOL;
		}
	}
// traps any exceptions which might be thrown
} catch (PDOException $e) {
	echo $e->getMessage();
	echo $e->getTraceAsString();
}

// closes the database connection
$dbh = NULL;
	
