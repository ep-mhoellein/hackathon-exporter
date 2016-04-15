<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once("epages-rest-php/src/Shop.class.php");
ep6\Logger::setLogLevel(ep6\LogLevel::NONE);
ep6\Logger::setOutput(ep6\LogOutput::SCREEN);

$shop = new ep6\Shop("royals.epages.com", "Hackathon", "I4UqHzGdLa5OMgMv4tZzMb3njoU4QQM6", true);

$productFilter = new ep6\ProductFilter();
$productFilter->setResultsPerPage(100);

$productFilter->addFilter("name", "Deuter", ep6\FilterOperation::NOT_CONTAINS);
$productFilter->addFilter("stocklevel", "5", ep6\FilterOperation::GREATER);
#$productFilter->addFilter("category", "57073CE4-D2AF-84AD-CABE-D5809AB04AA1", ep6\FilterOperation::EQUALS);

$products = $productFilter->getProducts();

# Categories: 57073CE4-D2AF-84AD-CABE-D5809AB04AA1 (Jackets)

foreach ($products as $product) {

	echo "- ". $product->getName() . "<br/>";
}

echo "<h2>" . count($products) . " product(s) found.</h2>";

$orderFilter = new ep6\OrderFilter();
$orderFilter->setResultsPerPage(100);

$orderFilter->addFilter("orderNumber", "100", ep6\FilterOperation::STARTS_WITH);

$orders = $orderFilter->getOrders();

foreach ($orders as $order) {

	echo "- ". $order->getNumber() . "<br/>";
}

echo "<h2>" . count($orders) . " order(s) found.</h2>";

?>