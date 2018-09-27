<!-- 
================= doc ====================
 filename     : print_daftar_xls.php
 @package     : daftar
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-10-14
 @Modified    : 2017-10-14
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php
session_start();
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/ms-excel"); 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=Data_daftar.xls");
require_once('../../config/koneksi.php');
require_once('../../config/fungsi_indotgl.php');
require_once('class.daftar.php'); 
?>
<div class="row-fluid">
<h3 class="header smaller lighter blue">Daftar Pendaftaran</h3>
</div>
<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%" border="1">
	<thead>
		<tr bgcolor="#DCDCDC" align="center">
			<th rowspan="2" width="25px" align="center">No</th>
			<th colspan="2" align="center">Pasien</th>
			<th rowspan="2" align="center">Tindakan</th>
			<th rowspan="2" align="center" width="70px">Jenis Layanan</th>
			<th rowspan="2" align="center" width="120px">Tanggal</th>
			<th rowspan="2" align="center">Keluhan</th>
			<th colspan="2" align="center">Status</th>
		</tr>
		<tr bgcolor="#DCDCDC">
			<th align="center">Kode</th>
			<th align="center">Nama</th>
			<th align="center">Periksa</th>
			<th align="center">Bayar</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$daftar = new daftar($pdo);		
		$query = "SELECT * FROM v_daftar ORDER BY daftar_id DESC";		
		$daftar->prin($query);
	?>
	</tbody>
</table>