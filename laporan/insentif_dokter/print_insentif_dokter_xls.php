<!-- 
================= doc ====================
 filename     : print_insentif_dokter_xls.php
 @package     : insentif_dokter
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
header("Content-Disposition: attachment; filename=Data_insentif_dokter.xls");
require_once('../../config/koneksi.php');
require_once('../../config/fungsi_indotgl.php');
require_once('class.insentif_dokter.php'); 
?>
<div class="row-fluid">
<h3 class="header smaller lighter blue">Laporan Insentfi Dokter</h3>
</div>
<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%" border="1">
	<thead>
		<tr bgcolor="#DCDCDC" align="center">
			<th rowspan="2" width="25px" align="center">No</th>
			<th colspan="2" align="center">Dokter</th>
			<th rowspan="2" align="center" width="100px">Tanggal Periksa</th>
			<th rowspan="2" align="center">No Rekam Medis</th>
			<th rowspan="2" align="center">Nominal Total</th>
		</tr>
		<tr bgcolor="#DCDCDC" align="center">
			<th align="center">SIP</th>
			<th align="center">Nama</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$insentif_dokter = new insentif_dokter($pdo);		
		$query = "SELECT * FROM v_daftar_rm WHERE UPPER(daftar_is_periksa) = 'YA' AND UPPER(daftar_is_bayar) = 'YA' ORDER BY periksa_tanggal DESC";		
		$insentif_dokter->prin($query);
	?>
	</tbody>
</table>