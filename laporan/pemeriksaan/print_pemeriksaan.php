<!-- 
================= doc ====================
 filename     : print_pemeriksaan.php
 @package     : pemeriksaan
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-10-18
 @Modified    : 2017-10-18
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print Document</title>
<link href="../../assets/css/print.css" rel="stylesheet" type="text/css" media="print" />
<link href="../../assets/css/bootstrap.min.css" rel="stylesheet" />
</style>
</head>
<?php
session_start();
include_once('../../config/koneksi.php');
include_once('../../config/fungsi_indotgl.php');
include_once('class.pemeriksaan.php');
?>
<body>
<div style="width:95%;margin:0 auto;">
<div class="row-fluid">
<?php include_once('../../header_print.php') ?>
<h3 class="header smaller lighter blue">Laporan Biaya Pemeriksaan</h3>
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
		$pemeriksaan = new pemeriksaan($pdo);		
		$query = "SELECT * FROM v_daftar_rm ORDER BY rekam_medis_id DESC";		
		$pemeriksaan->prin($query);
	?>
	</tbody>
</table>
<p></p>
<p align="right"><button class="btn btn-primary" id="tombol" onclick="window.print()" ><i class="icon-print"></i> Cetak</button></p>
</div>
</body>
</html>