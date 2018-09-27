<!-- 
================= doc ====================
 filename     : print_rekap_pemeriksaan.php
 @package     : rekap_pemeriksaan
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-11-10
 @Modified    : 2017-11-10
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Rekapitulasi Biaya Pemeriksaan</title>
<link rel="icon" type="image/jpg" href="assets/images/logo_warna.png" />
<link href="../../assets/css/print.css" rel="stylesheet" type="text/css" media="print" />
<link href="../../assets/css/bootstrap.min.css" rel="stylesheet" />
</style>
</head>
<?php
session_start();
include_once('../../config/koneksi.php');
include_once('../../config/fungsi_indotgl.php');
include_once('class.rekap_pemeriksaan.php');
?>
<body>
<div style="width:95%;margin:0 auto;">
<div class="row-fluid">
<?php include_once('../../header_print.php') ?>
<h4 align="center">Rekapitulasi Biaya Pemeriksaan</h4>
</div>
<table width="100%" border="1" align="Top" cellpadding="5" cellspacing="5" padding-top="0px">
	<thead>
		<tr bgcolor="#DCDCDC" align="center">
			<th rowspan="2" width="25px" align="center">No</th>
			<th rowspan="2" align="center" width="100px">Tanggal</th>
			<th rowspan="2" align="center">No Rekam Medis</th>
			<th colspan="2" align="center">Pasien</th>
			<th rowspan="2" align="center">Poliklinik</th>
			<th rowspan="2" align="center">Dokter</th>
			<th rowspan="2" align="center">Nominal Total</th>
		</tr>
		<tr bgcolor="#DCDCDC" align="center">
			<th align="center">Kode</th>
			<th align="center">Nama</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$biaya_pemeriksaan = new rekap_pemeriksaan($pdo);	
			$biaya_pemeriksaan->getBiayaPemeriksaan($_REQUEST['tanggal_periksa_awal'], $_REQUEST['tanggal_periksa_akhir'], $_REQUEST['pasien_id'], $_REQUEST['rekam_medis_nomor']);
		?>
		<tr style="font-weight: bold;">
			<td colspan="7" align="right">TOTAL BIAYA PEMERIKSAAN (Rp)</td>
			<td align="right">
				<?php
					$biaya_pemeriksaan = new rekap_pemeriksaan($pdo);	
					$sum = $biaya_pemeriksaan->sumBiayaPemeriksaan($_REQUEST['tanggal_periksa_awal'], $_REQUEST['tanggal_periksa_akhir'], $_REQUEST['pasien_id'], $_REQUEST['rekam_medis_nomor']);
					echo number_format($sum['sum_biaya_pemeriksaan'],2,',','.');
				?>
			</td>
		</tr>
	</tbody>
</table>
<p></p>
<p align="right"><button class="btn btn-primary" id="tombol" onclick="window.print()" ><i class="icon-print"></i> Cetak</button></p>
</div>
</body>
</html>