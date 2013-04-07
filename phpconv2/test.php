<?PHP
function readCSV($csvFile){
	$file_handle = fopen($csvFile, 'r');
	while (!feof($file_handle) ) {
		$line_of_text[] = fgetcsv($file_handle, 1024,";");
	}
	fclose($file_handle);
	return $line_of_text;
}


// Set path to CSV file
$csvFile = 'src.csv';

$csv = readCSV($csvFile);
/*echo '<pre>';
print_r($csv);
echo '</pre>';*/
$cols= array();
?>

<?php foreach($csv as $key => $value)
{
	if(is_array($value))
	{
		if($value[8] == 'ARTIKELGROEP_NL')
		{
			$cols[0]['C1'] = '_category';
		}else
		{
			$cols[0]['rows'][] =  $value[8];
		}

		if($value[12] == 'BESTELNUMMER')
		{
			$cols[1]['G1'] = 'sku';
		}else
		{
			$cols[1]['rows'][] =  $value[12];
		}

		if($value[13] == 'TITEL_NL')
		{
			$cols[2]['H1'] = 'name';
		}else
		{
			$cols[2]['rows'][] =  $value[13];
		}

		if($value[17] == 'PRIJS')
		{
			$cols[3]['I1'] = 'price';
		}else
		{
			$cols[3]['rows'][] =  preg_replace('/,/','.',$value[17]);
		}

		if($value[23] == 'OMSCHRIJVING_NL')
		{
			$cols[4]['J1'] = 'description';
		}else
		{
			$cols[4]['rows'][] =  $value[23];
		}

		if($value[28] == 'VOORRAAD')
		{
			$cols[5]['M1'] = 'qty';
		}else
		{
			$cols[5]['rows'][] =  $value[28];
		}
	}	
}
	
?>

