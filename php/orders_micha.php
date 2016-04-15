<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once("../epages-rest-php/src/Shop.class.php");
#$shop = new ep6\Shop("royals.epages.com", "Hackathon", "I4UqHzGdLa5OMgMv4tZzMb3njoU4QQM6", true);
$shop = new ep6\Shop("sandbox.epages.com", "Hackathon03", "wmnD25OzrE0IM6ct6Qge9YMfrsiY3sZX", true);

ep6\Logger::setLogLevel(ep6\LogLevel::NONE);
ep6\Logger::setOutput(ep6\LogOutput::SCREEN);

function get($name, $default = "") {
	if (isset($_REQUEST[$name])) { return $_REQUEST[$name];} else { return $default;}
}

# Returns HTML Code for a select box
function selectbox($name,$options,$selected = ''){
 $t = "<select name=\"$name\">";
 foreach($options AS $key => $option)
 {
	$isSelected = $key == $selected ? " selected=\"selected\"":"";
	if(is_array($option)){
		$t .= '<option value="'.urldecode($key).'"'.$isSelected.'>'.htmlspecialchars($option['name']).'</option>';
	} else {
		$t .= '<option value="'.urldecode($key).'"'.$isSelected.'>'.htmlspecialchars($option)."</option>"; 
	}
 }
 $t .= "</select>";
 return $t;
}					
			
$active_filters = get('active_filters',array());
	
$filters = array(
	'orderNumber' => array('name' => "Bestellnummer", 'type' => 'string'),
	'creationDate' => array('name' => "Erstelldatum", 'type' => 'date'),
	
);


$operations = array(
	'number' => array('<' => 'ist kleiner als','<=' => 'ist kleiner gleich','=' => 'ist gleich','>=' => 'ist größer gleich','>' => 'ist größer als', 'undef' => 'Nicht gesetzt'),
	'string' => array('=' => 'ist', 'contains' => 'beinhaltet', 'notContains' => 'beinhaltet nicht', 'startsWith' => 'beginnt mit', 'endsWith' => 'endet mit','undef' => 'Nicht gesetzt'),
	'date' => array('<' => 'ist kleiner als','<=' => 'ist kleiner gleich','=' => 'ist gleich','>=' => 'ist größer gleich','>' => 'ist größer als', 'undef' => 'Nicht gesetzt'),

	);	

$csv_columns = array (
		array('API_Method' => 'getNumber', 'CSV_ID' => 'Alias', 'Name' => 'Ordernumber'),
		array('API_Method' => 'getTotalPrice', 'CSV_ID' => 'Price', 'Name' => 'Gesamtpreis', 'API_ObjectAttribute' => 'getAmount'),
		array('API_Method' => 'getCreationDate', 'CSV_ID' => 'CreationDate', 'Name' => 'Erstelldatum', 'API_ObjectAttribute' => 'getTimestamp'),
		

	);

if(isset($_REQUEST['Export'])){
	
	csv_export(getFilteredOrders($active_filters,$filters),active_csv_columns($csv_columns,get('csv_columns')));
	exit;
}
			
if(isset($_REQUEST['Count'])){
	
	echo count(getFilteredOrders($active_filters,$filters));
	exit;
}
	
?>

<head>
  <meta charset="utf-8">
  <title>CSV ORDER EXPORT</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script>
  $(function() {
    $( ".xdatepicker" ).datepicker();

     $( ".xdatepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
 

  });
  </script>
</head>


<?php	
	
	
echo '<!-- Das neueste kompilierte und minimierte CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">';
	
echo "<h1>CSV Order Export</h1>";

echo '<form action="?" method="get">';

echo "<h3>Aktive Filter:</h3>";



echo '<table class="table table-striped">';

$new_filter = get('addfilter','');

foreach (get('delete',array()) as $index => $value) {
		array_splice($active_filters,$index,1);
}

if($new_filter != "" AND isset($filters[$new_filter])) {
	switch ($filters[$new_filter]['type']) {
		case 'bool': 
			$active_filters[] = array (
				'alias' => $new_filter,
				'value' => 'true',
				);
			break;
		default:
		$active_filters[] = array (
			'alias' => $new_filter,
			'value' => '',
			'operation' => '<'
		);
	}
}

function radiobuttons($name,$values,$selected) {
	$t = "";
	$delimiter = 0;
	foreach($values AS $key => $value) {
		if($delimiter == 1) { $t .= ' | '; } else { $delimiter = 1; }
		$t .= '<input type="radio" name="'.$name.'" value="'.$key.'"';
		if($selected == $key) { $t .= ' checked="checked"'; }
		$t .= ' id="'.$name.$key.'" /><label for="'.$name.$key.'">'.$value."</label>";
	}	
	return $t;
}

foreach ($active_filters as $counter => $filterOptions) {
		echo "<tr>";
		echo "<td>".$filters[$filterOptions['alias']]['name']."</td>";
		echo "<td>";
		echo '<input type="hidden" name="active_filters['.$counter.'][alias]" value="'.$filterOptions['alias'].'" />';
		if($filters[$filterOptions['alias']]['type'] == 'number' or $filters[$filterOptions['alias']]['type'] == 'string') {
			#$tmp = isset($_REQUEST['filters'][$filterAlias]['operation']) ? $_REQUEST['filters'][$filterAlias]['operation'] : '';

			echo selectbox('active_filters['.$counter.'][operation]',$operations[$filters[$filterOptions['alias']]['type']],$filterOptions['operation']);
			#$tmp = isset($_REQUEST['filters'][$filterAlias]['value']) ? $_REQUEST['filters'][$filterAlias]['value'] : '';
			echo ' <input type="text" name="active_filters['.$counter.'][value]" value="'.$filterOptions['value'].'" />';
		} elseif ( $filters[$filterOptions['alias']]['type'] == 'bool' ) {
			echo radiobuttons('active_filters['.$counter.'][value]',array('true' => 'Ja', 'false' => 'Nein'), isset($filterOptions['value']) ? $filterOptions['value'] : 'true');
		} elseif ( $filters[$filterOptions['alias']]['type'] == 'date' ) {
			echo selectbox('active_filters['.$counter.'][operation]',$operations[$filters[$filterOptions['alias']]['type']],$filterOptions['operation']);
			echo ' <input class="datepicker" type="text" name="active_filters['.$counter.'][value]" value="'.$filterOptions['value'].'" />';
		}
		echo "</td>";
		echo "<td>";
		echo '<input type="submit" name="delete['.$counter.']" value="X" />';
		echo '</td>';
}





echo "</table>";

$optionsForAddFilter = array('-'=>'Bitte auswählen') + $filters;

echo "<br>Filter hinzufügen: ".selectbox('addfilter',$optionsForAddFilter)."<br>";


echo "<br>CSV Spalten: ".selectboxForCSV($csv_columns,get('csv_columns'))."<br><br>";

echo '<input type="submit" name="Save" value="Filtern" />';



echo ' <input type="submit" name="Export" value="Als CSV exportieren" />';
#echo ' <input type="submit" name="Count" value="ReturnOrderCount" />';
echo '</form>';

function getFilteredOrders($active_filters,$filters) {
	
	$orderFilter = new ep6\OrderFilter();
	$orderFilter->setResultsPerPage(100);

	foreach ($active_filters as $options) {
		if((!(isset($options['value']))) or ($options['value'] == "")) { continue; }
		
	switch ($filters[$options['alias']]['type']) {
					case 'number': 
					case 'string':
						$orderFilter->addFilter($options['alias'], $options['value'], $options['operation'],'c');
						break;
					case 'bool':
						$orderFilter->addFilter($options['alias'], $options['value'], '=','bool');
						break;
				}
	}		
	$orders = $orderFilter->getOrders();

	return $orders;
}

$orders = getFilteredOrders($active_filters,$filters);

echo "<hr>";
echo count($orders) . " Bestellung(en) gefunden.\n";
#echo "<br><textarea>";
#print_r($orders);
#echo "</textarea>";

function selectboxForCSV($csv_columns,$default){
	$t = "";
	foreach($csv_columns AS $counter => $csv_column) {
		if($counter > 0) { $t .=' | '; }
		if($default == "" or isset($default[$counter])) { $checked = ' checked="checked"'; } else { $checked=''; }
		$t .= '<input name="csv_columns['.$counter.']" type="checkbox" id="label'.$counter.'" value="1"'.$checked.'/><label for="label'.$counter.'">'.$csv_column['Name']."</label>";
	}
	return $t;
}

function active_csv_columns($csv_columns,$selected_csv_columns) {
	if($selected_csv_columns == "") { return $csv_columns; }
	$active_csv_columns = array();
	foreach($selected_csv_columns AS $counter => $value) {
		if ($value == 1) array_push($active_csv_columns,$csv_columns[$counter]);
	}
	return $active_csv_columns;
}
	

function csv_export($orders,$csv_columns){
	
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

	foreach($orders AS $order){
		$csv_line = array();
		foreach($csv_columns AS $csv_column) {
			$api_method = $csv_column['API_Method'];
			if ( method_exists($order, $api_method) ){
				$api_method_value = $order->{$api_method}();
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
