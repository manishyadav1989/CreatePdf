<?php

//error_reporting(E_ALL);
//ini_set('display_errors', '1');
ini_set('max_execution_time', 10000);
ini_set('memory_limit', '512M');


/**
 * Creates an example PDF TEST document using TCPDF
 * @author Yuvraj Yadav
 */
 
// include TCPDF class
require_once(PDF_PATH.'lib/tcpdf_include.php');

class PdfGenerator extends PDO{

	private $pdf;
	// define class constructor
	public function __construct( $dbConfig ){
		try{
			parent::__construct("mysql:host=".$dbConfig->host.";dbname=".$dbConfig->database, $dbConfig->username, $dbConfig->password);
			$this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		}
		catch(PDOException $e) {  
			echo 'ERROR: ' . $e->getMessage();
		}  
	}
	
	// remove directory
	public function RemovePdfDirectory( $dirname ){
		array_map('unlink', glob($dirname."*.*")); // map unlink method
		rmdir($dirname); // remove directory
	}
	
	// create new direcotry directory
	public function CreatePdfDirectory( $path, $dirname ){
		$oldDir = getcwd(); // get current working directory
		chdir($path); // change current working directory
		mkdir($dirname); // create new directory
		chmod($path.$dirname, 0777); // change directory permission
		chdir($oldDir); // change current working directory with old directory
	}
	
	// create pdf file
	public function CreatePdf(){
		
		// select required fields from table
		$query = $this->prepare('SELECT module_no, module_title, description, contents, duration_details FROM tl_viona_data order by id asc');
		$query->execute();
		
		// get result form pdo query
		while($result = $query->fetch(PDO::FETCH_OBJ) ){
				
			$pdfarray = array();
			
			// module no
			$pdfarray['pdfName'] = $result->module_no;
			
			// module title
			$pdfarray['title'] = $result->module_title;
			
			// description
			$pdfarray['description'] = '<div style="margin-left:10px; margin-top:10px;">
										'.$result->description.'
										</div>';
			
			$pdfarray['lehrgangsdauer'] = '<div style="font-weight:bold; margin-bottom:5px; font-size:13px; color:red;">4. Januar 2016 - 10. Juni 2016</div>
						 <span style="margin:0px; font-size:13px; font-weight: 500;"> montags-freitags <strong> 8:00 bis 16:00 Uhr </strong> </span>';

			$pdfarray['lehrgangsort'] = '<div style="font-weight:bold; margin-left:-10px; padding:0px;">Bildungsinsel Gießen</div>
						<span style="margin:0px; padding:0px;"> Wingertshecke 6, 35392 Gießen,  0641 58099392 </span>';	
			
			// duration details
			$pdfarray['duration'] = '('.$result->duration_details.')';
				
			// requirements
			$pdfarray['zugangs'] = '<div style="margin-left:-10px;">
							  Kaufleute oder Praktiker mit Berufserfahrung, die gehobene und leitende Tätig-keiten in Wirtschaft und Verwaltung anstreben. Zur Prüfung zuzulassen ist, wer:
						   <br />
							  1. eine mit Erfolg abgelegte IHK-Aufstiegsfortbildungsprüfung zum Fachwirt oder Fach-kaufmann oder eine vergleichbare kfm. Fortbildungsprüfung nach dem BBiG oder
						  <br />
							  2. eine mit Erfolg abgelegte staatliche oder staatlich anerkannte Prüfung an einer auf eine Berufsausbildung aufbauenden kaufm. Fachschule und eine anschließende mindestens 3-jährige Berufspraxis nachweist.
						
						   
						   <br />
							  Die berufliche Praxis muss in Tätigkeiten abgeleistet sein, die der beruflichen Fortbil-dung zum/zur Betriebswirt/-in dienlich sind.
						   <br />
							  Zur Prüfung kann auch zugelassen werden, wer durch Vorlage von Zeugnissen oder auf andere Weise glaubhaft macht, dass er Kenntnisse, Fertigkeiten und Fähigkeiten (berufliche Handlungsfähigkeit) erworben hat.
						   <br />
							  Die Teilnahme setzt einen Bildungsgutschein eines Kostenträgers voraus.
						   </div>';
			// contents
			$pdfarray['kursinhalte'] = $result->contents;
			
			$pdfarray['unterrichts'] = 'ie lernen gemeinsam mit Anderen unter Einsatz moderner Unterrichtsmethoden. Dazu gehören der Live-Unterricht in einem Klassenraum der <strong style="color:blue;">Virtuellen Online Akademie VIONA®</strong> genauso wie Projektarbeit, die Erstellung und Präsentation eigener Arbeitsergebnisse, das Studium von Fachliteratur etc. Während der gesamten Weiterbildung steht Ihnen ein moderner PC-Arbeitsplatz zur Verfügung. Sie werden von hochqualifizierten Fachleuten unterrichtet und betreut, die über umfassende theoretische Kenntnisse und fachpraktische Erfahrungen verfügen.';
			
			$pdfarray['kosten'] = 'Lehrgangsgebühren siehe Anmeldeformular';

			$pdfarray['anmeldung'] = 'bis 10 Tage vor Beginn bei der';
			
			$pdfarray['anmeldungFaxHead'] = 'Bildungsinsel GmbH';
			$pdfarray['anmeldungFaxDetails'] = 'Friedenstr. 26 35578 Wetzlar . 06441 679099-0 (Fax -11)';
			
			$pdfarray['prufungen'] = 'Die <strong>IHK-Prüfung</strong> findet <strong>Mitte Juni 2016</strong> statt.';

			$pdfObj = (object) $pdfarray;
			
			$this->PDFCreate( $pdfObj );		
		}
			
	}
	
	// create pdf function
	private function PDFCreate( $pdfData ){
		
		$custom_layout = array(378, 250);
		// create new PDF document 
		//define('PDF_CREATOR', rand(11111,99999).'TCPDF ');
		//define('PDF_UNIT', rand(11111,99999).'mmPDF');
		
		$this->pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, $custom_layout, true, 'UTF-8', false);
		//echo '<br /> == ', PDF_CREATOR,' , ', PDF_UNIT, ' <br />';
		// set document information
		$this->pdf->SetCreator(PDF_CREATOR);
		$this->pdf->SetAuthor(rand(111111,999999));
		$this->pdf->SetTitle(rand(11111,99999).'__title');
		$this->pdf->SetSubject(rand(11111,99999).'__subject');
		$this->pdf->SetKeywords('TCPDF, PDF, example, test, guide');

		$this->pdf->SetPrintHeader(false);
		$this->pdf->SetPrintFooter(false);

		// set header and footer fonts
		//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		//$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$this->pdf->SetMargins(10, 10, 10);

		// set auto page breaks
		$this->pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$this->pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		
		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$this->pdf->setLanguageArray($l);
		}
		
		// add a page
		$this->pdf->AddPage();
		$this->pdf->SetFont('helvetica',  '', 8);
		// -----------------------------------------------------------------------------

// Table with rowspans and THEAD
$tbl = '
	 <style>
		 div {
			margin-left:10px;
		}
		p, table, td, td table {
			margin:0px;
			padding:0px;
			vartical-align:top;
		}
	 </style>
	 
	 <table cellspacing="0" cellpadding="0" border="0" style="Verdana;" width="100%; border-collapse:collapse;" >
	   
	   <tr>
		  <!-- main content -->
		  <td width="100%" valign="top">
			 <table cellspacing="0" cellpadding="0" border="0" width="100%" style="border-collapse:collapse;">
				<tr>
				   <td valign="middle" height="60" align="left">
					  <div style="margin:0px -10px; font-size:18px; font-weight: normal; text-align:left;">Virtuelle Online-Akademie:</div>
					  <span style="margin:0px 0px; font-size:18px; font-weight: normal;">Vollzeit-Weiterbildung</span>
				   </td>
				   <td>
					  Logo Vollzeit-Weiterbildung
				   </td>
				</tr>
				
				<!-- show underline -->
				<tr>
				   <td colspan="2" valign="middle"><hr style="border:1px solid #f30;" /></td>
				</tr>
				
				<!-- show mean heading -->
				<tr >
				   <td colspan="2" valign="middle">
					  <div style="color:#27276f; margin:0px; font-size:35px; font-weight: normal;">'.$pdfData->title.'</div>
				   </td>
				</tr>
				<tr>
				   <td colspan="2" style="font-size:13px; font-weight: 100; line-height:22px;color:#27276f" >
						'.$pdfData->description.'
				   </td>
				</tr>
				<tr>
				   <td colspan="2" valign="middle">&nbsp;</td>
				</tr>
				<tr>
				   <td colspan="2">
					  <table cellspacing="0" cellpadding="0" style="width:100%;border-collapse:collapse;">
						 <tr height="100">
							<td width="22%" valign="top">
							   <div style="font-size:16px; color:#27276f; margin-left:-10px; padding:0px; font-weight:500">Lehrgangsdauer</div>
							</td>
							<td width="44%" valign="top">
								<br />'.$pdfData->lehrgangsdauer.'
							</td>
							<td style="font-size:13px;" width="34%" valign="top">
							   <div style="margin-left:-10px; font-weight: 500;">'.$pdfData->duration.'
							   </div>
							</td>
						 </tr>
					  </table>
				   </td>
				</tr>
				<tr>
				   <td colspan="2" valign="middle">&nbsp;</td>
				</tr>
				<tr>
				   <td colspan="2" valign="middle">
					  <table cellspacing="0" cellpadding="0" style="width:100%;border-collapse:collapse;">
						 <tr height="10">
							<td width="22%">
							   <div style="font-size:16px;margin-left:-10px; color:#27276f; padding:0px; font-weight:500;">Lehrgangsort</div>
							</td>
							<td width="78%" style="font-size:13px; color:red;" valign="middle">
							   '.$pdfData->lehrgangsort.'
							</td>
						 </tr>
					  </table>
				   </td>
				</tr>
				<tr>
				   <td colspan="2" valign="middle">&nbsp;</td>
				</tr>
				<tr>
				   <td colspan="2" valign="middle">
					  <table cellspacing="0" cellpadding="0" style="width:100%;border-collapse:collapse;">
						 <tr height="10" >
							<td colspan="2" width="22%" valign="top">
							   <div style="font-size:16px;margin-left:-10px; color:#27276f; padding:0px; font-weight:500">Zugangs- voraussetzungen</div>
							</td>
							<td style="font-size:13px; font-weight:500; line-height:20px; text-align:left;"  width="78%" valign="middle" >
								<br/>
								'.$pdfData->zugangs.'
							</td>
						 </tr>
					  </table>
				   </td>
				</tr>
				<tr>
				   <td colspan="2" valign="middle">&nbsp;</td>
				</tr>
				<tr>
				   <td colspan="2" style="font-size:16px;" valign="middle">
					  <table cellspacing="0" cellpadding="0" style="width:100%;border-collapse:collapse;">
						 <tr height="10">
							<td colspan="2" width="22%" valign="top">
							   <div style="font-size:16;margin-left:-10px; color:#27276f; padding:0px; font-weight:500">Kursinhalte</div>
							</td>
							<td width="78%" style="font-size:13px; font-weight:500;" valign="middle">
							   <div style="margin-left:-10px;">
									'.$pdfData->kursinhalte.'
							   </div>
							</td>
						 </tr>
					  </table>
				   </td>
				</tr>
				<tr>
				   <td colspan="2" valign="middle">&nbsp;</td>
				</tr>
				<tr>
				   <td colspan="2" style="font-size:16px;" valign="middle">
					  <table cellspacing="0" cellpadding="0" style="width:100%; border-collapse:collapse;">
						 <tr height="10">
							<td colspan="2" width="22%" valign="top">
							   <div style="font-size:16px;margin-left:-10px; color:#27276f; padding:0px; font-weight:500">Unterrichts- methodik</div>
							</td>
							<td width="78%" style="font-size:13px; font-weight:500" valign="middle">
							    <div style="margin-left:-10px;"> '.$pdfData->unterrichts.'</div>
							</td>
						 </tr>
					  </table>
				   </td>
				</tr>
				<tr>
				   <td colspan="2" valign="middle">&nbsp;</td>
				</tr>
				<tr>
				   <td colspan="2" style="font-size:16px;" valign="middle">
					  <table cellspacing="0" cellpadding="0" style="width:100%; border-collapse:collapse;">
						 <tr>
							<td colspan="2" width="22%" valign="middle">
							   <div style="font-size:16px;margin-left:-10px; color:#27276f; padding:0px; font-weight:500">Kosten</div>
							</td>
							<td width="78%" style="font-size:13px; font-weight:500;" valign="middle">
							  <div style="margin-left:-10px;">'.$pdfData->kosten.'</div>
							</td>
						 </tr>
					  </table>
				   </td>
				</tr>
				
				<tr>
				   <td colspan="2" style="font-size:16px;" valign="middle">
					  <table cellspacing="0" cellpadding="0" style="width:100%; border-collapse:collapse;">
						 <tr height="10">
							<td width="22%" valign="top">
							   <div style="font-size:16px;margin-left:-10px; color:#27276f; padding:0px; font-weight:500">Anmeldung</div>
							</td>
							<td width="34%" style="font-size:14px; font-weight:500;" valign="top">
							   <div style="margin-left:-10px;">'.$pdfData->anmeldung.' </div>
							</td>
							<td width="44%" valign="top">
							<br>
							<div style="margin-left:-10px;">
							   <strong style="color:red; margin:0px; font-size:16px; color:#27276f; font-weight:bold;">'.$pdfData->anmeldungFaxHead.'</strong>
							   <strong style="color:blue;font-size:14px; margin:0px;">'.$pdfData->anmeldungFaxDetails.'</strong>
							</div>
							</td>
						 </tr>
					  </table>
				   </td>
				</tr>
				
				<tr>
				   <td colspan="2" style="font-size:16px;" valign="middle">
					  <table cellspacing="0" cellpadding="0" style="width:100%;">
						 <tr height="10">
							<td colspan="2" width="22%" valign="top">
							   <div style="font-size:16px;margin-left:-10px; padding:0px; color:#27276f; font-weight:500">Prüfungen</div>
							</td>
							<td width="78%" style="font-size:14px; color:red;" valign="middle">
							   <div style="margin-left:-10px;"> '.$pdfData->prufungen.'</div>
							</td>
						 </tr>
					  </table>
				   </td>
				</tr>
				
			 </table>
		  </td>
		  <!-- end content -->
	
	   </tr>
	</table>';

		$tbl = mb_convert_encoding($tbl, "HTML-ENTITIES", "UTF-8");
		//$tbl = utf8_decode ( $tbl );
		ob_start();
		
		$this->pdf->writeHTML($tbl, true, false, true	, false, '');	
		// -----------------------------------------------------------------------------
		
		//$$pdf->lastPage();
		
		//Close and output PDF document
		$this->pdf->Output( PDF_DIR . $pdfData->pdfName . '.pdf', 'F');	// I used for show pdf file on browser. F used for save file into directory
		
		$this->pdf = null;
		
		ob_end_clean();
	}
}

