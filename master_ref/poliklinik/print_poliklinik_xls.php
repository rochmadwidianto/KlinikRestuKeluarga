<!-- 
================= doc ====================
 filename     : print_poliklinik_xls.php
 @package     : poliklinik
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-10-13
 @Modified    : 2017-10-13
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php
session_start();
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/ms-excel"); 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=Data_poliklinik.xls");
require_once('../../config/koneksi.php');
require_once('../poliklinik/class.poliklinik.php'); 
?>
<div class="row-fluid">
<h3 class="header smaller lighter blue">Daftar Poliklinik</h3>
</div>
<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%" border="1">
	<thead>
		<tr bgcolor="#DCDCDC" align="center">
			<th width="50px" align="center">No</th>
			<th width="200px" align="center">Kode</th>
			<th align="center">Nama</th>
			<th align="center">Ruangan</th>
			<th align="center">Penanggung Jawab</th>
			<th align="center">Keterangan</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$poliklinik = new poliklinik($pdo);		
		$query = "SELECT * FROM poliklinik";		
		$poliklinik->prin($query);
	?>
	</tbody>
</table>