<?php
/**
* define database connection configuration
*/
define('PDF_DIR', $_SERVER['DOCUMENT_ROOT'].'/plugins/customPdf/pdfFiles/');

$dbConfig['host'] = 'mysql5.5force.de';
$dbConfig['database'] = 'db290461_246';
$dbConfig['username'] = 'db290461_246';
$dbConfig['password'] = 'f-p8vPvG7N2f';

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