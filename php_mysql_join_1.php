<?php
// Sample SELECT using SELECT ... FROM ... JOIN

// database username
$user = 'class';
// database password
$pass = 'password';
// data source = mysql driver, localhost, database = class
$dsn = 'mysql:host=localhost;dbname=class';
// PDO class represents the connection with error reporting
$pdo = new PDO($dsn, $user, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

// SQL, prepare, execute
// NOTE: using "." to concatenate parts of the SQL statement over multiple lines for readability
$sql = 'SELECT u.name, u.address, u.city, p.transaction, p.product_id, p.sale_price '
	 . 'FROM `users` AS u '
	 . 'JOIN `purchases` AS p '
	 . 'ON u.`user_id` = p.`user_id` '
	 . 'WHERE u.`name` = :name;';
$stmt = $pdo->prepare($sql);
$stmt->execute(array('name' => 'Lana Burns'));

echo '<pre>';
while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
	echo '<br />', var_dump($result), PHP_EOL;
}
echo '</pre>';

// closes the database connection
$dbh = NULL;
