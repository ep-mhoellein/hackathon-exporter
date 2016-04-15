<?php

require_once("../epages-rest-php/src/Shop.class.php");
$shop = new ep6\Shop("royals.epages.com", "Hackathon", "I4UqHzGdLa5OMgMv4tZzMb3njoU4QQM6", true);


$allProducts = getProducts();
$filteredProducts = array();
$actions = $_GET;

$methodPrefix = 'get';

foreach ($allProducts as $product) {
	
	#ToDo: add whitelist for allowed methods for security reasons	
	foreach ($actions as $action => $formValue) {
		$method = $methodPrefix . $action;
		if ( method_exists($product, $method) ){
			if($formValue != $product->{$method}()) {
				continue 2;
			}
		}
		else {
			continue 2;
		}

	}
	array_push($filteredProducts, $product);
	echo $product;
}

echo count($filteredProducts) . " products have been found.\n";

function getProducts() {
	
	$productFilter = new ep6\ProductFilter();
	
	$productFilter->setResultsPerPage(100);
	
	#$productFilter->setLocale("de_DE");
	# ToDo: extend function to get results per page if we have more than one page
	
	$products = $productFilter->getProducts();
	
	# ToDo: try to cache products here.....
	
	return $products;	
}
?>
