<!-- 
================= doc ====================
 filename     : print_tindakan_xls.php
 @package     : tindakan
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
header("Content-Disposition: attachment; filename=Data_tindakan.xls");
require_once('../../config/koneksi.php');
require_once('../tindakan/class.tindakan.php'); 
?>
<div class="row-fluid">
<h3 class="header smaller lighter blue">Daftar Tindakan</h3>
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
		$tindakan = new tindakan($pdo);		
		$query = "SELECT * FROM tindakan";		
		$tindakan->prin($query);
	?>
	</tbody>
</table>