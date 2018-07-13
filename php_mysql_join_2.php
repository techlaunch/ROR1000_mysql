<?php
// Sample SELECT using 2 SELECT statements

// database username
$user = 'class';
// database password
$pass = 'password';
// data source = mysql driver, localhost, database = class
$dsn = 'mysql:host=localhost;dbname=class';
// PDO class with error reporting
$pdo = new PDO($dsn, $user, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

// SQL, prepare, execute users table query
$sql1 = 'SELECT u.user_id, u.name, u.address, u.city '
	 . 'FROM `users` AS u '
	 . 'WHERE u.`name` = :name;';
$stmt1 = $pdo->prepare($sql1);
$stmt1->execute(array('name' => 'Lana Burns'));
$result1 = $stmt1->fetch(PDO::FETCH_ASSOC);

// SQL for purchases table, prepare, execute
$sql2 = 'SELECT p.transaction, p.product_id, p.sale_price '
	 . 'FROM `purchases` AS p '
	 . 'WHERE p.`user_id` = :userID;';
$stmt2 = $pdo->prepare($sql2);
$stmt2->execute(array('userID' => $result1['user_id']));
	 
// display results
echo '<pre>';
echo '<br />', var_dump($result1), PHP_EOL;
while($result2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
	echo '<br />', var_dump($result2), PHP_EOL;
}
echo '</pre>';

// closes the database connection
$dbh = NULL;
