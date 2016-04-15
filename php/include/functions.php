<?php

function getFilteredProducts($active_filters) {

	$productFilter = new ep6\ProductFilter();
	$productFilter->setResultsPerPage(100);

	foreach ($active_filters as $options) {

		if (ep6\InputValidator::isEmptyArrayKey($options, "filter") ||
			ep6\InputValidator::isEmptyArrayKey($options, "op") ||
			ep6\InputValidator::isEmptyArrayKey($options, "type")) {

				continue;
		}

		if (ep6\InputValidator::isEmptyArrayKey($options, "value") && $options["op"] != ep6\FilterOperation::UNDEF) {
			continue;
		}

		$productFilter->addFilter($options['filter'], $options['value'], $options['op'], $options['type']);

	}

	$products = $productFilter->getProducts();

	return $products;
}

function csv_export($products,$csv_columns){

	// output headers so that the file is downloaded rather than displayed
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=data.csv');

	// create a file pointer connected to the output stream
	$output = fopen('php://output', 'w');



	$delimiter = ";";
	$enclosure = '"';


	$csv_headline = array();

	foreach($csv_columns AS $csv_column) {
		array_push($csv_headline,$csv_column['Name'].' ['.$csv_column['CSV_ID'].']');
	}

	// output the column headings
	fputcsv($output, $csv_headline, $delimiter, $enclosure);

	foreach($products AS $product){
		$csv_line = array();
		foreach($csv_columns AS $csv_column) {
			$api_method = $csv_column['API_Method'];
			if ( method_exists($product, $api_method) ){
				$api_method_value = $product->{$api_method}();
				if(isset($csv_column['API_ObjectAttribute'])) {
					$api_object_attribute = $csv_column['API_ObjectAttribute'];
					if ( method_exists($api_method_value, $api_object_attribute) ) {
						array_push($csv_line, $api_method_value->{$api_object_attribute}());
					} else {
						array_push($csv_line,'');
					}
				} else {
					array_push($csv_line,$api_method_value);
				}
			} else {
				array_push($csv_line,'');
			}
		}

		fputcsv($output, $csv_line, $delimiter, $enclosure);

	}

	fclose($output);

}

?>