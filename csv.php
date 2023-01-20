<?php

// Create an array of elements
$list = array(
	['Name', 'age', 'Gender'],
	['Bob', 20, 'Male'],
	['John', 25, 'Male'],
	['Jessica', 30, 'Female']
);

// Open a file in write mode ('w')
$fp = fopen('persons.csv', 'w');

// Loop through file pointer and a line
foreach ($list as $fields) {
	fputcsv($fp, $fields);
}

fclose($fp);
?>
