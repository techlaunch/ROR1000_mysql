<?php
// Sample SELECT joining 3 tables

// database username
$user = 'class';
// database password
$pass = 'password';
// data source = mysql driver, localhost, database = class
$dsn = 'mysql:host=localhost;dbname=class';
// PDO class with error reporting
$pdo = new PDO($dsn, $user, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

// SQL, prepare, execute
$sql = 'SELECT u.`name`,p.`sku`,p.`title`,p.`price`,r.`transaction`,r.`quantity`,r.`sale_price` '
	 . 'FROM `users` AS u '
	 . 'JOIN `purchases` AS r '
	 . 'ON u.`user_id` = r.`user_id` '
	 . 'JOIN `products` AS p '
	 . 'ON r.`product_id` = p.`product_id` '
	 . 'WHERE u.`name` = :name '
	 . 'ORDER BY r.`transaction`;';
$stmt = $pdo->prepare($sql);
$stmt->execute(array('name' => 'Lana Burns'));

echo '<pre>';
while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
	echo '<br />', var_dump($result), PHP_EOL;
}
echo '</pre>';

// closes the database connection
$dbh = NULL;
	
