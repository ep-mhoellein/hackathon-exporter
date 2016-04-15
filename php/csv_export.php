<?php
require('include/init.php');
require('include/functions.php');

// get post
$filter = $_REQUEST;

$csv_columns = array (
		array('API_Method' => 'getProductNumber', 'CSV_ID' => 'Alias', 'Name' => 'Produkt ID'),
		array('API_Method' => 'getName', 'CSV_ID' => 'Name/DE', 'Name' => 'Produkt Name'),
		array('API_Method' => 'getPrice', 'API_ObjectAttribute' => 'getAmount', 'CSV_ID' => 'Price', 'Name' => 'Price'),
	);

csv_export(getFilteredProducts($filter),$csv_columns);
?>