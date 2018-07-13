<?php
// Sample UPDATE of purchases where you know the name of the user
// Purpose of script: apply a discount to the purchases of a specific user

// database username
$user = 'class';
// database password
$pass = 'password';
// data source = mysql driver, localhost, database = class
$dsn = 'mysql:host=localhost;dbname=class';

// user name update
$name2update = 'Truman Capote';

// 20% discount = price * 0.8
$discount = .8;

// use try { // code } catch (PDOException $e) { // code } to trap errors
try {
	// set up the database connection and activate error checking
	$pdo = new PDO($dsn, $user, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

	// lookup ID from parent table
	$sqlLookup = 'SELECT user_id FROM `users` WHERE `name` = :name';
	$stmtParent = $pdo->prepare($sqlLookup);
	$stmtParent->execute(array('name' => $name2update));

	// should return array(1) { ["user_id"]=> string(8) "00000XXX" }
	$lookup = $stmtParent->fetch(PDO::FETCH_ASSOC);
	echo '<br />Lookup Result: ', var_dump($lookup);
	
	if ($lookup && is_array($lookup) && count($lookup) > 0) {
		
		// SQL to find sum of purchases before discount
		$sqlSum = 'SELECT SUM(`sale_price`) AS s FROM `purchases` WHERE  `user_id` = :userID';
		$stmtSum = $pdo->prepare($sqlSum);
		$stmtSum->execute(array('userID' => $lookup['user_id']));
		$before = $stmtSum->fetch(PDO::FETCH_ASSOC);
		echo '<br />SUM BEFORE DISCOUNT: ', $before['s'];
		
		// SQL to update purchases and apply discount
		$sqlPurchases = 'UPDATE `purchases` SET `sale_price` = `sale_price` * ' . $discount	. ' '
					  . 'WHERE `user_id` = :userID';
		$stmtDiscount = $pdo->prepare($sqlPurchases);
		$update = $stmtDiscount->execute(array('userID' => $lookup['user_id']));
		echo '<br />UPDATE RESULT: ', $update, PHP_EOL;

		// find sum of purchases after discount
		$stmtSum->execute(array('userID' => $lookup['user_id']));
		$after = $stmtSum->fetch(PDO::FETCH_ASSOC);
		echo '<br />SUM AFTER DISCOUNT: ', $after['s'];

	}
	
	// closes the database connection
	$pdo = NULL;

// traps any exceptions which might be thrown
} catch (PDOException $e) {
	echo $e->getMessage();
	echo $e->getTraceAsString();
}
