<!-- 
================= doc ====================
 filename     : data_pasien.php
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
include_once('../../config/koneksi.php');
include_once('class.pasien.php');
?>
<div id="alert"></div>
<div class="row-fluid">
<h3 class="header smaller lighter blue"><b>Daftar Pasien</b></h3>
	<div class="table-header">
		<a href="javascript:void(0)" onclick="tambahForm()" class="btn btn-success" style="margin-left: -12px;" ><i class="icon-plus icon-white"></i>Tambah</a>
	 <a href="javascript:void(0)" target="" onclick="window.open('../klinik_restu_keluarga/master_ref/pasien/print_pasien.php','name','width=900,height=600')" class="btn btn-info" style="margin-left: -4px;" ><i class="icon-print icon-white"></i> Print</a>
	 <a href="javascript:void(0)" target="" onclick="window.open('../klinik_restu_keluarga/master_ref/pasien/print_pasien_pdf.php','name','width=900,height=600')" class="btn btn-warning" style="margin-left: -4px;" ><i class="icon-file"></i> PDF</a>
	 <a href="javascript:void(0)" onclick="window.open('../klinik_restu_keluarga/master_ref/pasien/print_pasien_xls.php','name','width=900,height=600')" class="btn btn-danger" style="margin-left: -4px;" ><i class="icon-list-alt"></i> Excel</a>
	</div>

<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%">
	<thead>
		<tr>
			<th width="50px" align="center">No</th>
			<th width="50px" align="center">Nomor</th>
			<th align="center">Nama</th>
			<th align="center">Jenis Kelamin</th>
			<th align="center">Agama</th>
			<th align="center">Telp/HP</th>
			<th align="center">Usia</th>
			<th align="center">Alamat</th>
			<th align="center">Keterangan</th>
			<th align="center">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$pasien = new pasien($pdo);		
		$query = "SELECT p.*, IF(d.`daftar_id` IS NOT NULL, 'Ya', 'Tidak') AS is_used FROM pasien p LEFT JOIN daftar d ON d.`daftar_pasien_id` = p.`pasien_id`";		
		$pasien->view($query);
	?>
	</tbody>
</table>


