<!-- 
================= doc ====================
 filename     : data_rekam_medis.php
 @package     : rekam_medis
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
include_once('../../config/koneksi.php');
include_once('../../config/fungsi_indotgl.php');
include_once('class.rekam_medis.php');
?>

<div id="alert"></div>
<div class="row-fluid">
<h3 class="header smaller lighter blue"><b>Laporan Rekam Medis</b></h3>
<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%">
	<thead>
		<tr>
			<th rowspan="2" width="25px" align="center">No</th>
			<th colspan="2" align="center">Pasien</th>
			<th rowspan="2" align="center">Jenis Kelamin</th>
			<th rowspan="2" align="center">Tanggal Lahir</th>
			<th rowspan="2" align="center">Telp/HP</th>
			<th rowspan="2" align="center">Alamat</th>
			<th rowspan="2" align="center">Aksi</th>
		</tr>
		<tr>
			<th align="center">Kode</th>
			<th align="center">Nama</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$rekam_medis = new rekam_medis($pdo);		
		$query = "SELECT * FROM v_daftar_rm GROUP BY pasien_id ORDER BY pasien_nomor ASC";	
		$rekam_medis->view($query);
	?>
	</tbody>
</table>


