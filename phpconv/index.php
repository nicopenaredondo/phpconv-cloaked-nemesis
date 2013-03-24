<?php
require_once 'Classes/PHPExcel.php';
require_once 'Classes/PHPExcel/IOFactory.php';

$objPHPExcel = new PHPExcel();

//set properties
$objPHPExcel->getProperties()
			    ->setCreator("Ronny Boland")
			    ->setLastModifiedBy("Nico R Penaredondo")
			    ->setTitle("PHP Conversion")
			    ->setSubject("This is a f*cking PHP Conversion")
			    ->setDescription("Made from PHP Excel")
			    ->setCategory("Test test conversion php")
			    ->setKeywords("PHP SHORE24");

$objPHPExcel->getActiveSheet()->setTitle("Test Demo");

$objPHPExcel->setActiveSheetIndex()
			    ->setCellValueByColumnAndRow('0','1','_type')
			    ->setCellValueByColumnAndRow('1','1','_attribute')
			    ->setCellValueByColumnAndRow('2','1','_category')
			    ->setCellValueByColumnAndRow('3','1','tax_class_id')
			    ->setCellValueByColumnAndRow('4','1','status')
			    ->setCellValueByColumnAndRow('5','1','weight')
			    ->setCellValueByColumnAndRow('6','1','sku')
			    ->setCellValueByColumnAndRow('7','1','name')
			    ->setCellValueByColumnAndRow('8','1','price')
			    ->setCellValueByColumnAndRow('9','1','description')
			    ->setCellValueByColumnAndRow('10','1','short_description')
			    ->setCellValueByColumnAndRow('11','1','visibility')
			    ->setCellValueByColumnAndRow('12','1','qty')
			    ->setCellValueByColumnAndRow('13','1','is_in_stock')
			    ->setCellValueByColumnAndRow('14','1','manage_stock');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
$objWriter->save('MyExcel.csv');

