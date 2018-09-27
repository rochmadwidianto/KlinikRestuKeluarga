<!-- 
================= doc ====================
 filename     : data_daftar.php
 @package     : daftar
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
include_once('class.daftar.php');
?>
<div id="alert"></div>
<div class="row-fluid">
<h3 class="header smaller lighter blue"><b>Daftar Pendaftaran</b></h3>
	<div class="table-header">
		<a href="javascript:void(0)" onclick="tambahForm()" class="btn btn-success" style="margin-left: -12px;" ><i class="icon-plus icon-white"></i> Tambah</a>
	 <a href="javascript:void(0)" target="" onclick="window.open('../klinik_restu_keluarga/pendaftaran/daftar/print_daftar.php','name','width=900,height=600')" class="btn btn-info" style="margin-left: -4px;" ><i class="icon-print icon-white"></i> Print</a>
	 <a href="javascript:void(0)" target="" onclick="window.open('../klinik_restu_keluarga/pendaftaran/daftar/print_daftar_pdf.php','name','width=900,height=600')" class="btn btn-warning" style="margin-left: -4px;" ><i class="icon-file"></i> PDF</a>
	 <a href="javascript:void(0)" onclick="window.open('../klinik_restu_keluarga/pendaftaran/daftar/print_daftar_xls.php','name','width=900,height=600')" class="btn btn-danger" style="margin-left: -4px;" ><i class="icon-list-alt"></i> Excel</a>
	</div>

<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%">
	<thead>
		<tr>
			<th rowspan="2" width="25px" align="center">No</th>
			<th rowspan="2" align="center" width="100px">Tanggal</th>
			<th colspan="2" align="center">Pasien</th>
			<th rowspan="2" align="center">Tindakan</th>
			<th rowspan="2" align="center" width="70px">Jenis Layanan</th>
			<th rowspan="2" align="center">Poliklinik</th>
			<th rowspan="2" align="center">Keluhan</th>
			<th colspan="3" align="center">Status</th>
			<th rowspan="2" align="center">Aksi</th>
		</tr>
		<tr>
			<th align="center">Kode</th>
			<th align="center">Nama</th>
			<th align="center">RM</th>
			<th align="center">Periksa</th>
			<th align="center">Bayar</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$daftar = new daftar($pdo);		
		$query = "SELECT * FROM v_daftar GROUP BY daftar_id ORDER BY daftar_id DESC";		
		$daftar->view($query);
	?>
	</tbody>
</table>


