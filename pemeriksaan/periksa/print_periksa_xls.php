<!-- 
================= doc ====================
 filename     : print_periksa_xls.php
 @package     : periksa
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-10-15
 @Modified    : 2017-10-15
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php
session_start();
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/ms-excel"); 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=Data_periksa.xls");
require_once('../../config/koneksi.php');
require_once('../../config/fungsi_indotgl.php');
require_once('class.periksa.php'); 
?>
<div class="row-fluid">
<h3 class="header smaller lighter blue">Daftar Pemerikssaan</h3>
</div>
<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%" border="1">
	<thead>
		<tr bgcolor="#DCDCDC" align="center">
			<th rowspan="2" width="25px" align="center">No</th>
			<th rowspan="2" align="center">No Rekam Medis</th>
			<th colspan="2" align="center">Pasien</th>
			<th rowspan="2" align="center" width="100px">Tanggal</th>
			<th rowspan="2" align="center">Keluhan</th>
			<th rowspan="2" align="center">Anamnese/Diagnosa</th>
			<th rowspan="2" align="center">Terapi</th>
			<th rowspan="2" align="center" width="60px">Status Periksa</th>
		</tr>
		<tr bgcolor="#DCDCDC">
			<th align="center">Kode</th>
			<th align="center">Nama</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$periksa = new periksa($pdo);		
		$query = "SELECT * FROM v_daftar_rm ORDER BY rekam_medis_id DESC";		
		$periksa->prin($query);
	?>
	</tbody>
</table>