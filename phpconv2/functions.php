<?php
require_once 'Classes/PHPExcel.php';
require_once 'Classes/PHPExcel/IOFactory.php';
require_once 'Classes/PHPExcel/Cell.php';
require_once 'Classes/PHPExcel/Worksheet.php';
function upload_file()
{
	
	//Сheck that we have a file
		if((!empty($_FILES["uploaded_file"])) && ($_FILES['uploaded_file']['error'] == 0)) {
		  //Check if the file is JPEG image and it's size is less than 350Kb
		  $filename = basename($_FILES['uploaded_file']['name']);
		  $ext = substr($filename, strrpos($filename, '.') + 1);
		  if (($ext == "csv") && ($_FILES["uploaded_file"]["size"] < 350000)) {
		    //Determine the path to which we want to save this file
		      $newname = dirname(__FILE__).'/upload/'.$filename;
		      //Check if the file with the same name is already exists on the server
		      if (!file_exists($newname)) {
		        //Attempt to move the uploaded file to it's new place
		        if ((move_uploaded_file($_FILES['uploaded_file']['tmp_name'],$newname))) {
		           echo "It's done! The file has been saved as: ".md5(date('s')).'.csv';
		           return $filename;
		        } else {
		           echo "Error: A problem occurred during file upload!";
		           return false;
		        }
		      } else {
		         echo "Error: File ".$_FILES["uploaded_file"]["name"]." already exists";
		         return false;
		      }
		  } else {
		     echo "Error: Only .csv files under 350Kb are accepted for upload";
		     return false;
		  }
		} else {
		 echo "Error: No file uploaded";
		 return false;
		}



}

function readCSV($csvFile){
	$file_handle = fopen($csvFile, 'r');
	while (!feof($file_handle) ) {
		$line_of_text[] = fgetcsv($file_handle, 1024,";");
	}
	fclose($file_handle);
	return $line_of_text;
}


function read_file($name)
{
	if($name === FALSE)
	{
		return '<BR>CAN\'T READ THE FILE';
	}
		//this will filter the content of the source file
		$csv = readCSV($name);
		foreach($csv as $key => $value)
		{
			if(is_array($value))
			{
				if($value[8] == 'ARTIKELGROEP_NL')
				{
					$data[0]['C1'] = '_category';
				}else
				{
					$data[0]['row'][] =  $value[8];

				}

				if($value[12] == 'BESTELNUMMER')
				{
					$data[1]['G1'] = 'sku';
				}else
				{
					$data[1]['row'][] =  $value[12];
				}

				if($value[13] == 'TITEL_NL')
				{
					$data[2]['H1'] = 'name';
				}else
				{
					$data[2]['row'][] =  $value[13];
				}

				if($value[17] == 'PRIJS')
				{
					$data[3]['I1'] = 'price';
				}else
				{
					$data[3]['row'][] =  preg_replace('/,/','.',$value[17]);
				}

				if($value[23] == 'OMSCHRIJVING_NL')
				{
					$data[4]['J1'] = 'description';
				}else
				{
					$data[4]['row'][] =  $value[23];
				}

				if($value[28] == 'VOORRAAD')
				{
					$data[5]['M1'] = 'qty';
				}else
				{
					$data[5]['row'][] =  $value[28];
				}
			}//end of if	
		}//end of foreach
		//after getting all the data from the source file it will passed the data to another function
		//getting the max row
		$max_row = array(
			count($data[0]['row']),
			count($data[1]['row']),
			count($data[2]['row']),
			count($data[3]['row']),
			count($data[4]['row']),
			count($data[5]['row'])
			);

		convert_csv($data,max($max_row) + 1);
		unlink('upload/'.$name);
}

function convert_csv($data,$row)
{
//initializing default values
$objPHPExcel = new PHPExcel();
//use for the rows starting in 2
$count = 2;

//all the datas that have been mapped is being inserted in the array
$mapped_column1 = array('C1' => $data[0]['C1'],'row'  => $data[0]['row']);
$mapped_column2 = array('G1' => $data[1]['G1'],'row' => $data[1]['row']);
$mapped_column3 = array('H1' => $data[2]['H1'],'row' => $data[2]['row']);
$mapped_column4 = array('I1'  => $data[3]['I1'],'row'  => $data[3]['row']);
$mapped_column5 = array('J1' => $data[4]['J1'],'row' => $data[4]['row']);
$mapped_column6 = array('M1'  => $data[5]['M1'],'row'  => $data[5]['row']);

/**
*
*PREPARING ALL THE MAPPED DATA FROM THE SOURCE FILE
*
**/




foreach($mapped_column1 as $key => $value)
{
	//check if C1 is present	
	if(is_array($value))
	{
		$count = 2;
		foreach($value as $key => $data )
			{
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValueByColumnAndRow(2, $count, $data);
				$count++;
			}
	}else
	{
		//setting the column
		$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue($key,$value);
	}

}

foreach($mapped_column2 as $key => $value)
{
	//check if G1 is present	
	if(is_array($value))
	{
		$count = 2;
		foreach($value as $key => $data )
			{
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValueByColumnAndRow(6, $count, $data);
				$count++;
			}
	}else
	{
		//setting the column
		$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue($key,$value);
	}

}

foreach($mapped_column3 as $key => $value)
{
	//check if H1 is present	
	if(is_array($value))
	{
		$count = 2;
		foreach($value as $key => $data )
			{
				$objPHPExcel->setActiveSheetIndex(0)
			    		    		    ->setCellValueByColumnAndRow(7, $count, $data);
				$count++;
			}
	}else
	{
		//setting the column
		$objPHPExcel->setActiveSheetIndex(0)
			    		    ->setCellValue($key,$value);
	}

}

foreach($mapped_column4 as $key => $value)
{
	//check if  I1 is present	ay Ito
	if(is_array($value))
	{
		$count = 2;
		foreach($value as $key => $data )
			{
				$objPHPExcel->setActiveSheetIndex(0)
			    		    		    ->setCellValueByColumnAndRow(8, $count, $data);
				$count++;
			}
	}else
	{
		//setting the column
		$objPHPExcel->setActiveSheetIndex(0)
			    		    ->setCellValue($key,$value);
	}

}

foreach($mapped_column5 as $key => $value)
{
	//check if J1 is present	
	if(is_array($value))
	{
		$count = 2;
		foreach($value as $key => $data )
			{
				$objPHPExcel->setActiveSheetIndex(0)
			    		    		    ->setCellValueByColumnAndRow('9', $count, $data);
				$count++;
			}
	}else
	{
		//setting the column
		$objPHPExcel->setActiveSheetIndex(0)
			    		    ->setCellValue($key,$value);
	}

}

foreach($mapped_column6 as $key => $value)
{
	//check if M1 is present	
	if(is_array($value))
	{
		$count = 2;
		foreach($value as $key => $data )
			{
				$objPHPExcel->setActiveSheetIndex(0)
			    		    		    ->setCellValueByColumnAndRow('12', $count, $data);
				$count++;
			}
	}else
	{
		//setting the column
		$objPHPExcel->setActiveSheetIndex(0)
			    		    ->setCellValue($key,$value);
	}

}





/**
*
*PREPARING ALL THE DEFAULT VALUES
*
**/
$default_val= array(
	'A1' => '_type',
	'B1' => '_attribute',
	'D1' => 'tax_class_id',
	'E1' => 'status',
	'F1' => 'weight',
	'K1' => 'short_description',
	'L1' => 'visibility',
	'N1' => 'is_in_stock',
	'O1' => 'manage_stock'	
	);

foreach($default_val as $key => $value)
{
	if($key === 'A1')
	{
		$objPHPExcel->setActiveSheetIndex(0)
					    ->setCellValue($key,$value);
	}
	$count_row = 2;
	for($num = 1;$num < $row; $num++)
	{
		$objPHPExcel->setActiveSheetIndex(0)
					   ->setCellValue('A'.$count_row,'simple');
		$count_row++;
	}

	if($key === 'B1')
	{
		$objPHPExcel->setActiveSheetIndex(0)
					    ->setCellValue($key,$value);
	}
	$count_row = 2;
	for($num = 1;$num < $row; $num++)
	{
		$objPHPExcel->setActiveSheetIndex(0)
					   ->setCellValue('B'.$count_row,'Default');
		$count_row++;
	}

	if($key === 'D1')
	{
		$objPHPExcel->setActiveSheetIndex(0)
					    ->setCellValue($key,$value);
	}
	$count_row = 2;
	for($num = 1;$num < $row; $num++)
	{
		$objPHPExcel->setActiveSheetIndex(0)
					   ->setCellValue('D'.$count_row,'2');
		$count_row++;
	}

	if($key === 'E1')
	{
		$objPHPExcel->setActiveSheetIndex(0)
					    ->setCellValue($key,$value);
	}
	$count_row = 2;
	for($num = 1;$num < $row; $num++)
	{
		$objPHPExcel->setActiveSheetIndex(0)
					   ->setCellValue('E'.$count_row,'1');
		$count_row++;
	}

	if($key === 'F1')
	{
		$objPHPExcel->setActiveSheetIndex(0)
					    ->setCellValue($key,$value);
	}
	$count_row = 2;
	for($num = 1;$num < $row; $num++)
	{
		$objPHPExcel->setActiveSheetIndex(0)
					   ->setCellValue('F'.$count_row,'0');
		$count_row++;
	}

	if($key === 'K1')
	{
		$objPHPExcel->setActiveSheetIndex(0)
					    ->setCellValue($key,$value);
	}
	$count_row = 2;
	for($num = 1;$num < $row; $num++)
	{
		$objPHPExcel->setActiveSheetIndex(0)
					   ->setCellValue('K'.$count_row,'-');
		$count_row++;
	}

	if($key === 'L1')
	{
		$objPHPExcel->setActiveSheetIndex(0)
					    ->setCellValue($key,$value);
	}
	$count_row = 2;
	for($num = 1;$num < $row; $num++)
	{
		$objPHPExcel->setActiveSheetIndex(0)
					   ->setCellValue('L'.$count_row,'4');
		$count_row++;
	}

	if($key === 'N1')
	{
		$objPHPExcel->setActiveSheetIndex(0)
					    ->setCellValue($key,$value);
	}
	$count_row = 2;
	for($num = 1;$num < $row; $num++)
	{
		$objPHPExcel->setActiveSheetIndex(0)
					   ->setCellValue('N'.$count_row,'1');
		$count_row++;
	}

	if($key === 'O1')
	{
		$objPHPExcel->setActiveSheetIndex(0)
					    ->setCellValue($key,$value);
	}
	$count_row = 2;
	for($num = 1;$num < $row; $num++)
	{
		$objPHPExcel->setActiveSheetIndex(0)
					   ->setCellValue('O'.$count_row,'1');
		$count_row++;
	}

}

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
// If you want to output e.g. a PDF file, simply do:
//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
$objWriter->save(md5(date('s')).'.csv');

}


