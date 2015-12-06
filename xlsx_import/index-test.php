<?php
    // If you need to parse XLS files, include php-excel-reader
    require('excel_reader2.php');

    require('SpreadsheetReader.php');

    $Reader = new SpreadsheetReader('KURSNET_CSV-Export_VuC_20151103.xlsx');
    foreach ($Reader as $Row)
    {
	
//	print_r($Row);
	    echo $parent_caegory_name = trim($Row[0]);
	echo $third_categry_name  = trim($Row[1]);
		die;

	//echo "<pre>";
      //  print_r($Row);
//	echo "</pre>";
    }
	
	echo 'done';
?>