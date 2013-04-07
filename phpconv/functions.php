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

function read_file($name)
{
	if($name === FALSE)
	{
		return '<BR>CAN\'T READ THE FILE';
	}

$objPHPExcel = PHPExcel_IOFactory::load($name);

	foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) 
	{
		$highest_col   = $worksheet->getHighestColumn();//get all the highest column
		$highest_row = $worksheet->getHighestRow();//get all the highest row
		$count_col     = PHPExcel_Cell::columnIndexFromString($highest_col);//convert it to index integer

		//for loop for getting the column
		/*for($col = 0;$col < $count_col - 1;$col++)
		{*/

			//getting the column
			$cell 	         = $worksheet->getCellByColumnAndRow(2,1);
			//get the column name
		 	$val  	     	  = $cell->getValue();

		 	//filter the content
		 	 if($val == '_category')
		 	{
		 		/*$data[0] = array('column'=>$val);	*/
		 		//getting all the rows for specific columns 
		 		for($row = 2; $row <=$highest_row;$row++)
				{
					//get the value of specified cols and rows
					$cell 	         = $worksheet->getCellByColumnAndRow(2,$row);
					$row_val  	  = $cell->getValue();
					//inserting all the rows inside an array
					$data[0]['C1'] = $val;
					$data[0]['row'][] = $row_val;
				}
			}

			//getting the column
			$cell 	         = $worksheet->getCellByColumnAndRow(6,1);
			//get the column name
		 	$val  	     	  = $cell->getValue();

		 	//filter the content
		 	 if($val == 'sku')
		 	{
		 		/*$data[1] = array('column'=>$val);	*/
		 		//getting all the rows for specific columns 
		 		for($row = 2; $row <=$highest_row;$row++)
				{
					//get the value of specified cols and rows
					$cell 	         = $worksheet->getCellByColumnAndRow(6,$row);
					$row_val  	  = $cell->getValue();
					//inserting all the rows inside an array
					$data[1]['G1'] = $val;
					$data[1]['row'][] = $row_val;
				}
			}

			//getting the column
			$cell 	         = $worksheet->getCellByColumnAndRow(7,1);
			//get the column name
		 	$val  	     	  = $cell->getValue();

		 	//filter the content
		 	 if($val == 'name')
		 	{
		 		/*$data[2] = array('column'=>$val);*/	
		 		//getting all the rows for specific columns 
		 		for($row = 2; $row <=$highest_row;$row++)
				{
					//get the value of specified cols and rows
					$cell 	         = $worksheet->getCellByColumnAndRow(7,$row);
					$row_val  	  = $cell->getValue();
					//inserting all the rows inside an array
					$data[2]['H1'] = $val;
					$data[2]['row'][] = $row_val;
				}
			}

			//getting the column
			$cell 	         = $worksheet->getCellByColumnAndRow(8,1);
			//get the column name
		 	$val  	     	  = $cell->getValue();

		 	//filter the content
		 	 if($val == 'price')
		 	{
		 		/*$data[3] = array('column'=>$val);	*/
		 		//getting all the rows for specific columns 
		 		for($row = 2; $row <=$highest_row;$row++)
				{
					//get the value of specified cols and rows
					$cell 	         = $worksheet->getCellByColumnAndRow(8,$row);
					$row_val  	  = $cell->getValue();
					//inserting all the rows inside an array
					$data[3]['I1'] = $val;
					$data[3]['row'][] = $row_val;
				}
			}

			//getting the column
			$cell 	         = $worksheet->getCellByColumnAndRow(9,1);
			//get the column name
		 	$val  	     	  = $cell->getValue();

		 	//filter the content
		 	 if($val == 'description')
		 	{
		 		/*$data[4] = array('column'=>$val);	*/
		 		//getting all the rows for specific columns 
		 		for($row = 2; $row <=$highest_row;$row++)
				{
					//get the value of specified cols and rows
					$cell 	         = $worksheet->getCellByColumnAndRow(9,$row);
					$row_val  	  = $cell->getValue();
					//inserting all the rows inside an array
					$data[4]['J1'] = $val;
					$data[4]['row'][] = $row_val;
				}
			}

			//getting the column
			$cell 	         = $worksheet->getCellByColumnAndRow(12,1);
			//get the column name
		 	$val  	     	  = $cell->getValue();

		 	//filter the content
		 	 if($val == 'qty')
		 	{
		 		/*$data[5] = array('column'=>$val);	*/
		 		//getting all the rows for specific columns 
		 		for($row = 2; $row <=$highest_row;$row++)
				{
					//get the value of specified cols and rows
					$cell 	         = $worksheet->getCellByColumnAndRow(12,$row);
					$row_val  	  = $cell->getValue();
					//inserting all the rows inside an array
					$data[5]['M1'] = $val;
					$data[5]['row'][] = $row_val;
				}
			}
		convert_csv($data,$highest_row);
		unlink('upload/'.$name);
	}
}

function convert_csv($data,$row)
{
//initializing default values
$objPHPExcel = new PHPExcel();
$count = 2;
$mapped_column1 = array('C1' => $data[0]['C1'],'row'  => $data[0]['row']);
$mapped_column2 = array('G1' => $data[1]['G1'],'row' => $data[1]['row']);
$mapped_column3 = array('H1' => $data[2]['H1'],'row' => $data[2]['row']);
$mapped_column4 = array('I1'  => $data[3]['I1'],'row'  => $data[3]['row']);
$mapped_column5 = array('J1' => $data[4]['J1'],'row' => $data[4]['row']);
$mapped_column6 = array('M1'  => $data[5]['M1'],'row'  => $data[5]['row']);


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






$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
// If you want to output e.g. a PDF file, simply do:
//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
$objWriter->save(md5(date('s')).'.csv');

}


