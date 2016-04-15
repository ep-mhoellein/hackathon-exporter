<?php
require('include/init.php');
require('include/functions_orders.php');

// get post
$filter = $_REQUEST;

$csv_columns = array (
		array('API_Method' => 'getNumber', 'CSV_ID' => 'Alias', 'Name' => 'Ordernumber'),
		array('API_Method' => 'getTotalPrice', 'CSV_ID' => 'Price', 'Name' => 'Gesamtpreis', 'API_ObjectAttribute' => 'getAmount'),
		array('API_Method' => 'getCreationDate', 'CSV_ID' => 'CreationDate', 'Name' => 'Erstelldatum', 'API_ObjectAttribute' => 'getTimestamp'),
	);

csv_export(getFilteredOrders($filter),$csv_columns);
?>