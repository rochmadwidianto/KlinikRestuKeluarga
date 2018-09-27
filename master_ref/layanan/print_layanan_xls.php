<!-- 
================= doc ====================
 filename     : print_layanan_xls.php
 @package     : layanan
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
header("Content-Disposition: attachment; filename=Data_layanan.xls");
require_once('../../config/koneksi.php');
require_once('../layanan/class.layanan.php'); 
?>
<div class="row-fluid">
<h3 class="header smaller lighter blue">Daftar Layanan</h3>
</div>
<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%" border="1">
	<thead>
		<tr bgcolor="#DCDCDC" align="center">
			<th width="50px" align="center">No</th>
			<th width="150px" align="center">Kode</th>
			<th align="center">Nama</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$layanan = new layanan($pdo);		
		$query = "SELECT * FROM layanan";		
		$layanan->prin($query);
	?>
	</tbody>
</table>