<?php
//============================================================+
// File name   : example_048.php
// Begin       : 2009-03-20
// Last Update : 2013-05-14
//
// Description : Example 048 for TCPDF class
//               HTML tables and table headers
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: HTML tables and table headers
 * @author Nicola Asuni
 * @since 2009-03-20
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

$custom_layout = array(378, 250);
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, $custom_layout, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 048');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
//$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(10, 10, 10);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
//$pdf->SetFont('courier',  10);

// add a page
$pdf->AddPage();

//$pdf->Write(0, 'Example of HTML tables', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);

// -----------------------------------------------------------------------------

// Table with rowspans and THEAD
$tbl = <<<EOD
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
					  <div style="color:#27276f; margin:0px; font-size:35px; font-weight: normal;">Geprüfte/-r Betriebswirt/-in (IHK)</div>
				   </td>
				</tr>
				<tr>
				   <td colspan="2" style="font-size:13px; font-weight: 100; line-height:22px;color:#27276f" >
				     <div style="margin-left:-10px; margin-top:0px;">Betriebswirte sind gut ausgebildete Generalisten in vielfältigen Tätigkeits- und Verantwortungsbereichen in Wirtschaft und Verwaltung. Die Ausbildung erfolgt nach dem bundesweit einheitlichen Rahmen-lehrplan und endet mit einer Prüfung vor der Industrie- und Handelskammer.</div>
					  
					  <span>Es handelt sich um den höchsten beruflichen Abschluss außerhalb der Hochschule und bietet insbes. Fachwirt-Absolventen beste Karrieremöglichkeiten, weil sie auf oberster Führungsebene einsetzbar sind.</span>
				  
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
							   <div style="font-weight:bold; margin-bottom:5px; font-size:13px; color:red;">4. Januar 2016 - 10. Juni 2016</div>
							   
							   <span style="margin:0px; font-size:13px; font-weight: 500;"> montags-freitags <strong> 8:00 bis 16:00 Uhr </strong> </span>
							</td>
							<td style="font-size:13px;" width="34%" valign="top">
							   <div style="margin-left:-10px; font-weight: 500;">(23 Wochen – 990 U‘Std.)
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
							   <div style="font-weight:bold; margin-left:-10px; padding:0px;">Bildungsinsel Gießen</div>
							  
							   <span style="margin:0px; padding:0px;"> Wingertshecke 6, 35392 Gießen,  0641 58099392 </span>
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
								<div style="margin-left:-10px;">
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
					  <table cellspacing="0" cellpadding="0" style="width:100%;border-collapse:collapse;">
						 <tr height="10">
							<td colspan="2" width="22%" valign="top">
							   <div style="font-size:16;margin-left:-10px; color:#27276f; padding:0px; font-weight:500">Kursinhalte</div>
							</td>
							<td width="78%" style="font-size:13px; font-weight:500;" valign="middle">
							  <div style="margin-left:-10px;">
							  <span style="font-size:14px; margin:0;font-weight:500;">1. Wirtschaftliches Handeln und betriebliche Leistungsprozesse</span>
							  
							   <ul>
								  <li>
									 Marketing-Management
								  </li>
								  <li>
									 Bilanz- und Steuerpolitik des Unternehmens
								  </li>
								  <li>
									 Finanzwirtschaftliche Steuerung des Unternehmens
								  </li>
								  <li>
									 Rechtliche Rahmenbedingungen der Unternehmensführung
								  </li>
								  <li>
									 Europäische und internationale Wirtschaftsbeziehungen
								  </li>
							   </ul>
							   <span style="font-size:14px; margin:0;font-weight:500;">2. Führung und Management im Unternehmen</span>
							   <ul>
								  <li>
									 Unternehmensführung
								  </li>
								  <li>
									 Unternehmensorganisation und Projektmanagement
								  </li>
								  <li>
									 Personalmanagement
								  </li>
							   </ul>
							   <span style="font-size:14px; margin:0; font-weight:500;">3. Projektarbeit und projektarbeitsbezogenes Fachgespräch</span>
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
							    <div style="margin-left:-10px;"> Sie lernen gemeinsam mit Anderen unter Einsatz moderner Unterrichtsmethoden. Dazu gehören der Live-Unterricht in einem Klassenraum der <strong style="color:blue;">Virtuellen Online Akademie VIONA®</strong> genauso wie Projektarbeit, die Erstellung und Präsentation eigener Arbeitsergebnisse, das Studium von Fachliteratur etc. Während der gesamten Weiterbildung steht Ihnen ein moderner PC-Arbeitsplatz zur Verfügung. Sie werden von hochqualifizierten Fachleuten unterrichtet und betreut, die über umfassende theoretische Kenntnisse und fachpraktische Erfahrungen verfügen. </div>
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
							  <div style="margin-left:-10px;"> Lehrgangsgebühren siehe Anmeldeformular </div>
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
							<td width="22%" valign="top">
							   <div style="font-size:16px;margin-left:-10px; color:#27276f; padding:0px; font-weight:500">Anmeldung</div>
							</td>
							<td width="34%" style="font-size:14px; font-weight:500;" valign="top">
							   <div style="margin-left:-10px;"> bis 10 Tage vor Beginn bei der </div>
							</td>
							<td width="44%" valign="top">
							<br>
							<div style="margin-left:-10px;">
							   <strong style="color:red; margin:0px; font-size:16px; color:#27276f; font-weight:bold;">Bildungsinsel GmbH</strong>
							   <strong style="color:blue;font-size:14px; margin:0px;">Friedenstr. 26 35578 Wetzlar . 06441 679099-0 (Fax -11)</strong>
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
					  <table cellspacing="0" cellpadding="0" style="width:100%;">
						 <tr height="10">
							<td colspan="2" width="22%" valign="top">
							   <div style="font-size:16px;margin-left:-10px; padding:0px; color:#27276f; font-weight:500">Prüfungen</div>
							</td>
							<td width="78%" style="font-size:14px; color:red;" valign="middle">
							   <div style="margin-left:-10px;"> Die <strong>IHK-Prüfung</strong> findet <strong>Mitte Juni 2016</strong> statt.</div>
							</td>
						 </tr>
					  </table>
				   </td>
				</tr>
				
			 </table>
		  </td>
		  <!-- end content -->
	
	   </tr>
	</table>
EOD;

$pdf->writeHTML($tbl, true, false, true	, false, '');	

// -----------------------------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_048.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+