<?php
/**
* define database connection configuration
*/
define('PDF_DIR', $_SERVER['DOCUMENT_ROOT'].'/pathtosavepdf/');

$dbConfig['host'] = 'localhost';
$dbConfig['database'] = 'mydb';
$dbConfig['username'] = 'username';
$dbConfig['password'] = 'password';

// convert array to object
$dbConfig = (object) $dbConfig;

// include pdf file
include_once('tcpdfClass.php');

// create pdf class with database configuration
$obj = new PdfGenerator( $dbConfig );

// call pdf function
$obj->CreatePdf();

echo "PDF Created!";

?>