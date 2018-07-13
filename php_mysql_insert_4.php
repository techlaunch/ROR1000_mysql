<?php
// Sample INSERT where constraint exists

// database username
$user = 'class';
// database password
$pass = 'password';
// data source = mysql driver, localhost, database = class
$dsn = 'mysql:host=localhost;dbname=class';

// data to be inserted
$data = array('name' 	=> 'Truman Capote',
			  'address' => '1487 Hollywood Blvd',
			  'city'	=> 'Los Angeles',
			  'state' 	=> 'CA',
			  'zip'		=> '90044',
			  'phone'	=> '213-555-6666',
			  'balance' => 223344.55);
$transID = 'XYZ9999';
$purchases = array(array('productID' => 11, 'quantity' => 10, 'salePrice' => 100),
				   array('productID' => 22, 'quantity' => 10, 'salePrice' => 200),
				   array('productID' => 33, 'quantity' => 10, 'salePrice' => 300),
				   array('productID' => 44, 'quantity' => 10, 'salePrice' => 400));

try {
	// set up the database connection and activate error checking
	$pdo = new PDO($dsn, $user, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	
	// Insert into parent table first
	$sqlParent = 'INSERT INTO `users`(`name`, `address`, `city`, `state_province`, `postal_code`, `phone`, `balance`) '
		 . 'VALUES (:name, :address, :city, :state, :zip, :phone, :balance)';
	$stmtParent = $pdo->prepare($sqlParent);
	$resultParent = $stmtParent->execute($data);

	// get last insert id
	$userID = $pdo->lastInsertId();
	
	// Now you can insert into the child table
	$sqlChild = 'INSERT INTO `purchases` (`transaction`, `product_id`, `user_id`, `quantity`, `sale_price`) '
			  . 'VALUES (:transaction, :productID, :userID, :quantity, :salePrice);';	
	$stmtChild  = $pdo->prepare($sqlChild);
	
	// execute using a product id and user id which both do not exist
	$output = 'TRANSACTION: ' . $transID;
	$output .= '<br />USER: ' . $data['name'] . "($userID)";
	foreach ($purchases as $item) {
		$result = $stmtChild->execute(array('transaction'	=> $transID, 
											'productID'   	=> $item['productID'], 
											'userID' 		=> $userID,
											'quantity' 		=> $item['quantity'],
											'salePrice' 	=> $item['salePrice']));	
		$output .= sprintf("<br />INSERTED: %s | PURCHASE: %s\n", $result, implode(' - ', $item));
	}
			
	// kill connection`
	$pdo = NULL;

// traps any exceptions which might be thrown
} catch (PDOException $e) {
	echo $e->getMessage();
	echo $e->getTraceAsString();
}

// display results
echo '<pre>', $output, '</pre>', PHP_EOL;
