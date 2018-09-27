<!-- 
================= doc ====================
 filename     : data_petugas.php
 @package     : petugas
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
include_once('../../config/koneksi.php');
include_once('class.petugas.php');
?>
<div id="alert"></div>
<div class="row-fluid">
<h3 class="header smaller lighter blue"><b>Daftar Petugas</b></h3>
	<div class="table-header">
	<?php if ($_SESSION['s_level'] == 'administrator') { ?>
		<a href="javascript:void(0)" onclick="tambahForm()" class="btn btn-success" style="margin-left: -12px;" ><i class="icon-plus icon-white"></i> Tambah</a>
	 	<a href="javascript:void(0)" target="" onclick="window.open('../klinik_restu_keluarga/master_ref/petugas/print_petugas.php','name','width=900,height=600')" class="btn btn-info" style="margin-left: -4px;" ><i class="icon-print icon-white"></i> Print</a>
	 <?php } ?>
	<?php if ($_SESSION['s_level'] != 'administrator') { ?>
	 	<a href="javascript:void(0)" target="" onclick="window.open('../klinik_restu_keluarga/master_ref/petugas/print_petugas.php','name','width=900,height=600')" class="btn btn-info" style="margin-left: -12px;" ><i class="icon-print icon-white"></i> Print</a>
	 <?php } ?>
	 	<a href="javascript:void(0)" target="" onclick="window.open('../klinik_restu_keluarga/master_ref/petugas/print_petugas_pdf.php','name','width=900,height=600')" class="btn btn-warning" style="margin-left: -4px;" ><i class="icon-file"></i> PDF</a>
	 	<a href="javascript:void(0)" onclick="window.open('../klinik_restu_keluarga/master_ref/petugas/print_petugas_xls.php','name','width=900,height=600')" class="btn btn-danger" style="margin-left: -4px;" ><i class="icon-list-alt"></i> Excel</a>
	</div>

<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%">
	<thead>
		<tr>
			<th width="50px" align="center">No</th>
			<th align="center">NIP</th>
			<th align="center">Nama</th>
			<th align="center">Jabatan</th>
			<th align="center">Jenis Kelamin</th>
			<th align="center">Agama</th>
			<th align="center">Telp/HP</th>
			<th align="center">Alamat</th>
			<th align="center">Keterangan</th>
			<?php if ($_SESSION['s_level'] == 'administrator') { ?>
				<th align="center">Aksi</th>
			<?php } ?>
		</tr>
	</thead>
	<tbody>
		<?php
		$petugas = new petugas($pdo);		
		$query = "SELECT * FROM petugas";		
		$petugas->view($query);
	?>
	</tbody>
</table>


