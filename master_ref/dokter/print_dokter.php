<!-- 
================= doc ====================
 filename     : print_dokter.php
 @package     : dokter
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-10-12
 @Modified    : 2017-10-12
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
include_once('class.dokter.php');
?>
<body>
<div style="width:95%;margin:0 auto;">
<div class="row-fluid">
<?php include_once('../../header_print.php') ?>
<h3 class="header smaller lighter blue">Daftar Dokter</h3>
</div>
<table width="100%" border="1" align="Top" cellpadding="5" cellspacing="5" padding-top="0px">
	<thead>
		<tr bgcolor="#DCDCDC" align="center">
			<th width="50px" align="center">No</th>
			<th align="center">Nama</th>
			<th align="center">SIP</th>
			<th align="center">Jenis Kelamin</th>
			<th align="center">Agama</th>
			<th align="center">Telp/HP</th>
			<th align="center">Alamat</th>
			<th align="center">Poliklinik</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$dokter = new dokter($pdo);		
		$query = "SELECT * FROM v_dok_poli";		
		$dokter->prin($query);
	?>
	</tbody>
</table>
<p></p>
<p align="right"><button class="btn btn-primary" id="tombol" onclick="window.print()" ><i class="icon-print"></i> Cetak</button></p>
</div>
</body>
</html>