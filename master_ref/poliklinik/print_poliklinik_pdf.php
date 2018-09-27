<!-- 
================= doc ====================
 filename     : print_poliklinik_pdf.php
 @package     : poliklinik
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-10-13
 @Modified    : 2017-10-13
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php
	session_start();
	include_once('../../config/koneksi.php');
	include_once('class.poliklinik.php');
	// Define relative path from this script to mPDF
	$nama_dokumen='Daftar Poliklinik'; //Beri nama file PDF hasil.
	defined('../../assets/mpdf60/');
	include_once("../../assets/mpdf60/mpdf.php");
	$mpdf=new mPDF('utf-8', 'A4'); // Create new mPDF Document

	//Beginning Buffer to save PHP variables and HTML tags
	ob_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print Document</title>
<link href="../../assets/css/print.css" rel="stylesheet" type="text/css" media="print" />
<link href="../../assets/css/bootstrap.min.css" rel="stylesheet" />
</style>
</head>
<body>
<div style="width:95%;margin:0 auto;">
<div class="row-fluid">
<?php include_once("../../header_print.php") ?>
<h3 class="header smaller lighter blue">Daftar Poliklinik</h3>
</div>
<table width="100%" border="1" align="Top" cellpadding="5" cellspacing="5" padding-top="0px">
	<thead>
		<tr bgcolor="#DCDCDC" align="center">
			<th width="50px" align="center">No</th>
			<th width="200px" align="center">Kode</th>
			<th align="center">Nama</th>
			<th align="center">Ruangan</th>
			<th align="center">Penanggung Jawab</th>
			<th align="center">Keterangan</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$poliklinik = new poliklinik($pdo);		
		$query = "SELECT * FROM poliklinik";		
		$poliklinik->prin($query);
	?>
	</tbody>
</table>
</div>
</body>
</html>
<?php

	$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
	ob_end_clean();
	//Here convert the encode for UTF-8, if you prefer the ISO-8859-1 just change for $mpdf->WriteHTML($html);
	$mpdf->WriteHTML(utf8_encode($html));
	$mpdf->Output($nama_dokumen.".pdf" ,'I');
	exit;
	
?>