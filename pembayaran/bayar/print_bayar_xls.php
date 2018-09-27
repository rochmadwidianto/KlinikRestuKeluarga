<!-- 
================= doc ====================
 filename     : print_bayar_xls.php
 @package     : bayar
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
header("Content-Disposition: attachment; filename=Data_bayar.xls");
require_once('../../config/koneksi.php');
require_once('../../config/fungsi_indotgl.php');
require_once('class.bayar.php'); 
?>
<div class="row-fluid">
<h3 class="header smaller lighter blue">Daftar Pembayaran</h3>
</div>
<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%" border="1">
	<thead>
		<tr bgcolor="#DCDCDC" align="center">
			<th rowspan="2" width="25px" align="center">No</th>
			<th rowspan="2" align="center">No Rekam Medis</th>
			<th colspan="2" align="center">Pasien</th>
			<th rowspan="2" align="center" width="100px">Tanggal</th>
			<th rowspan="2" align="center">Anamnese/Diagnosa</th>
			<th rowspan="2" align="center">Terapi</th>
			<th colspan="2" align="center">Status</th>
			<th rowspan="2" align="center">Total Biaya</th>
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
		$bayar = new bayar($pdo);		
		$query = "SELECT * FROM v_daftar_rm ORDER BY rekam_medis_id DESC";		
		$bayar->prin($query);
	?>
	</tbody>
</table>