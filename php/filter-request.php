<?php
require('include/init.php');
require('include/functions.php');

// get post
$filter = $_REQUEST;

// delete wrong get/post parameters



// get products

// count

$allProducts = getFilteredProducts($filter);
echo "<h1>" . count($allProducts) . " product(s) found</h1>";

foreach ($allProducts as $product) {
	echo "<small>" . $product->getName() . " (" . $product->getID() . ")</small><br/>";
}
?>