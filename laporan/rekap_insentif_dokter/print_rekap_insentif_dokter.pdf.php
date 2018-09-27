<!-- 
================= doc ====================
 filename     : print_rekap_insentif_dokter_pdf.php
 @package     : rekap_insentif_dokter
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-11-09
 @Modified    : 2017-11-09
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php
	session_start();
	include_once('../../config/koneksi.php');
	include_once('../../config/fungsi_indotgl.php');
	include_once('class.rekap_insentif_dokter.php');
	// Define relative path from this script to mPDF
	$nama_dokumen='rekap_insentif_dokter'; //Beri nama file PDF hasil.
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
<div style="width:100%;margin:0 auto;">
<div class="row-fluid">
<?php include_once("../../header_print.php") ?>
<h4 align="center">Rekapitulasi Insentif Dokter</h4>
<table width="100%" style="border: none;" align="Top" cellpadding="5" cellspacing="5" padding-top="0px">
	<tr>
		<td align="center"><b>Periode : <?php echo getBulan($_REQUEST['bulan_awal']); ?> s.d. <?php echo getBulan($_REQUEST['bulan_akhir']); ?> <?php echo $_REQUEST['tahun']; ?></b></td>
	</tr>
</table>
<br/>
<?php
	$insentif_dokter = new rekap_insentif_dokter($pdo);	
	extract($insentif_dokter->getDokterById($_REQUEST['dokter_id']));
?>
</div>
<table width="100%" style="border: none;" align="Top" cellpadding="5" cellspacing="5" padding-top="0px">
	<tr>
		<td><b>Poli</b></td>
		<td><?php echo $poliklinik_nama; ?></td>
		<td><b>Agama</b></td>
		<td><?php echo $dokter_agama; ?></td>
	</tr>
	<tr>
		<td><b>Nama</b></td>
		<td><?php echo $dokter_nama; ?></td>
		<td><b>HP/Telp</b></td>
		<td><?php echo $dokter_telp; ?></td>
	</tr>
	<tr>
		<td><b>SIP</b></td>
		<td><?php echo $dokter_sip; ?></td>
		<td><b>Tanggal Lahir</b></td>
		<td><?php echo tgl_indo($dokter_tanggal_lahir); ?></td>
	</tr>
	<tr>
		<td><b>Jenis Kelamin</b></td>
		<td><?php echo $dokter_gender; ?></td>
		<td><b>Alamat</b></td>
		<td><?php echo $dokter_alamat; ?></td>
	</tr>
</table>
<br/>
<table width="100%" border="1" align="Top" cellpadding="5" cellspacing="5" padding-top="0px">
	<thead>
		<tr bgcolor="#DCDCDC" align="center">
			<th width="25px" align="center">No</th>
			<th align="center">Tanggal Periksa</th>
			<th align="center">No Rekam Medis</th>
			<th align="center">Nominal Total</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$insentif_dokter = new rekap_insentif_dokter($pdo);	
			$insentif_dokter->getInsentifDokter($_REQUEST['dokter_id'], $_REQUEST['bulan_awal'], $_REQUEST['bulan_akhir'], $_REQUEST['tahun']);
		?>
		<tr style="font-weight: bold;">
			<td colspan="3" align="right">TOTAL INSENTIF (Rp)</td>
			<td align="right">
				<?php
					$insentif_dokter = new rekap_insentif_dokter($pdo);	
					$sum = $insentif_dokter->sumInsentifDokter($_REQUEST['dokter_id'], $_REQUEST['bulan_awal'], $_REQUEST['bulan_akhir'], $_REQUEST['tahun']);
					echo number_format($sum['sum_jasa_dokter'],2,',','.');
				?>
			</td>
		</tr>
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