<?php
error_reporting(1);
ini_set('max_execution_time', 1000);
$db_host = "mysql5.5force.de";
// Place the username for the MySQL database here
$db_username = "db290461_246"; 
// Place the password for the MySQL database here
$db_pass = "f-p8vPvG7N2f"; 
// Place the name for the MySQL database here
$db_name = "db290461_246";

$dbc= mysqli_connect($db_host,$db_username,$db_pass,$db_name) or die ("could not connect to mysql"); 

if (isset($_POST['submit'])) {

    $file_name = $_FILES['filename']['name'];
 //   $new_file_name = date('Y-m-d').'-'.$_FILES["filename"]["name"];
	move_uploaded_file($_FILES["filename"]["tmp_name"], $file_name);
	
	require('excel_reader2.php');
    require('SpreadsheetReader.php');
    $Reader = new SpreadsheetReader($file_name);
	
	//Import uploaded file to Database
	//$handle = fopen($_FILES['filename']['name'], "r");
	$i=0;
	//while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	$overwritetableFieldsArray =  array('module_title', 
										'description',
										'contents',
										'requirements',
										'category',
										'information',
										'information_key',
										'school',
										'school_key',
										'graduation',
										'duration_in_hour',
										'duration_details',
										'timeframe',
										'teachingform',
										'classifications',
										'start',
										'end');
	
	foreach ($Reader as $data) {	
		if($i>0){			
		    // To read the value and get module-no for update the fields
			$moduleNo = mysqli_real_escape_string($dbc,$data[0]);
			// to get if module-no is already existed 
			$sqlCheck = "select id from tl_viona_data where module_no='$moduleNo' ";
			$resCheck = mysqli_query($dbc, $sqlCheck);
						
			if(mysqli_num_rows($resCheck) > 0){
				// Need to update the record
				// First need to prepare the fields array for updating	
				$needUpdateFields = array();
				foreach($overwritetableFieldsArray as $k=>$tblFields){
					// to check this should be updateble or not
					$sqlCheckOvr = "select id from tl_viona_data where module_no='$moduleNo' and ".$tblFields."_overwrite='0' ";
					$resCheckOvr = mysqli_query($dbc, $sqlCheckOvr);
					if(mysqli_num_rows($resCheckOvr) > 0){
						$needUpdateFields[$k] = $tblFields;
					}
				    //$sqlUpdate = "update tl_viona_data set ".$tblFields."='".mysqli_real_escape_string($dbc,$data[$k+1])."' 
					//				  where module_no='$moduleNo' and ".$tblFields."_overwrite='0' ";											
					//$resUpdate = mysqli_query($dbc, $sqlUpdate) or die('Error in SQL');						
				}
				//print_r($needUpdateFields);
				if(count($needUpdateFields) > 0){
					
				    $sqlUpdate = "update tl_viona_data set ";
					$n = 0;
					foreach($needUpdateFields as $ky => $updateField){
					   $sqlUpdate .=  $updateField."='".mysqli_real_escape_string($dbc,$data[$ky+1])."'"; 
					   if($n < count($needUpdateFields)-1){
						   $sqlUpdate .= ", ";
					   }
					   $n++;			   											
					}
					$sqlUpdate .= " where module_no='$moduleNo'";
					
					//echo $sqlUpdate;
					$resUpdate = mysqli_query($dbc, $sqlUpdate) or die('Error in SQL');
				}
				
				
				
			} 
			else{			 
				// Need to insert as new record
				$sqlIns = "insert into tl_viona_data set 
						   module_no='".mysqli_real_escape_string($dbc,$data[0])."',
						   module_title='".mysqli_real_escape_string($dbc,$data[1])."',
						   description='".mysqli_real_escape_string($dbc,$data[2])."',
						   contents='".mysqli_real_escape_string($dbc,$data[3])."',
						   requirements='".mysqli_real_escape_string($dbc,$data[4])."',
						   category='".mysqli_real_escape_string($dbc,$data[5])."',
						   information='".mysqli_real_escape_string($dbc,$data[6])."',
						   information_key='".mysqli_real_escape_string($dbc,$data[7])."',
						   school='".mysqli_real_escape_string($dbc,$data[8])."',
						   school_key='".mysqli_real_escape_string($dbc,$data[9])."',
						   graduation='".mysqli_real_escape_string($dbc,$data[10])."',
						   duration_in_hour='".mysqli_real_escape_string($dbc,$data[11])."',
						   duration_details='".mysqli_real_escape_string($dbc,$data[12])."',
						   timeframe='".mysqli_real_escape_string($dbc,$data[13])."',
						   teachingform='".mysqli_real_escape_string($dbc,$data[14])."',
						   classifications='".mysqli_real_escape_string($dbc,$data[15])."',
						   start='".mysqli_real_escape_string($dbc,$data[16])."',
						   end='".mysqli_real_escape_string($dbc,$data[17])."' ";
				$resIns = mysqli_query($dbc, $sqlIns) or die('Error in SQL');	
			}
			
		}
		$i++;
		
	}

//	fclose($handle);
    unlink($file_name);

	echo "Import done";
	
	/**
	* @Author Yuvraj Yadav
	* Create PDF file from database
	**/
	include_once('../customPdf/index.php');
	$pdf = new PDF(); // create pdf object
	$pdf->DeletePDFDir(); // remove old pdf directory
	$pdf->CreatePDFDir(); // create pdf directory
	$pdf->Create_PDF(); // create pdf files from database
	
	/********* end pdf script ************/
	
	die('pdf process complete!!!');
}
else{
	die('Sorry, wrong request');
}


?>