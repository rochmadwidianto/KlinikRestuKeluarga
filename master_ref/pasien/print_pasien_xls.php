<!-- 
================= doc ====================
 filename     : print_pasien_xls.php
 @package     : pasien
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-10-12
 @Modified    : 2017-10-12
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php
session_start();
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/ms-excel"); 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=Data_pasien.xls");
require_once('../../config/koneksi.php');
require_once('../pasien/class.pasien.php'); 
?>
<div class="row-fluid">
<h3 class="header smaller lighter blue">Daftar Pasien</h3>
</div>
<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%" border="1">
	<thead>
		<tr bgcolor="#DCDCDC" align="center">
			<th width="50px" align="center">No</th>
			<th width="50px" align="center">Nomor</th>
			<th align="center">Nama</th>
			<th align="center">Jenis Kelamin</th>
			<th align="center">Agama</th>
			<th align="center">Telp/HP</th>
			<th align="center">Usia</th>
			<th align="center">Alamat</th>
			<th align="center">Keterangan</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$pasien = new pasien($pdo);		
		$query = "SELECT * FROM pasien";		
		$pasien->prin($query);
	?>
	</tbody>
</table>