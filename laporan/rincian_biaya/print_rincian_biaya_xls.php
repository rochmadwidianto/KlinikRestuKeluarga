<!-- 
================= doc ====================
 filename     : print_rincian_biaya_xls.php
 @package     : rincian_biaya
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-10-18
 @Modified    : 2017-10-18
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php
session_start();
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/ms-excel"); 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=Data_rincian_biaya.xls");
require_once('../../config/koneksi.php');
require_once('../../config/fungsi_indotgl.php');
require_once('class.rincian_biaya.php'); 
?>
<div class="row-fluid">
<h3 class="header smaller lighter blue">Laporan Rincian Biaya Pemeriksaan</h3>
</div>
<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%" border="1">
	<thead>
		<tr bgcolor="#DCDCDC" align="center">
			<th rowspan="2" width="25px" align="center">No</th>
			<th rowspan="2" align="center" width="100px">Tanggal</th>
			<th rowspan="2" align="center">No Rekam Medis</th>
			<th colspan="6" align="center">Jenis Biaya</th>
			<th rowspan="2" align="center">Total Biaya (Rp)</th>
		</tr>
		<tr bgcolor="#DCDCDC" align="center">
			<th align="center">Jasa Dokter</th>
			<th align="center">Obat</th>
			<th align="center">Tindakan</th>
			<th align="center">Laboratorium</th>
			<th align="center">Persalinan</th>
			<th align="center">Lain - Lain</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$rincian_biaya = new rincian_biaya($pdo);		
		$query = "SELECT * FROM v_daftar_rm ORDER BY rekam_medis_id DESC";		
		$rincian_biaya->prin($query);
	?>
	</tbody>
</table>