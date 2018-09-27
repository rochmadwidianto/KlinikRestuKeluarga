<!-- 
================= doc ====================
 filename     : data_layanan.php
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
include_once('../../config/koneksi.php');
include_once('class.layanan.php');
?>
<div id="alert"></div>
<div class="row-fluid">
<h3 class="header smaller lighter blue"><b>Daftar Layanan</b></h3>
	<div class="table-header">
	<?php if ($_SESSION['s_level'] == 'administrator') { ?>
		<a href="javascript:void(0)" onclick="tambahForm()" class="btn btn-success" style="margin-left: -12px;" ><i class="icon-plus icon-white"></i> Tambah</a>
	 	<a href="javascript:void(0)" target="" onclick="window.open('../klinik_restu_keluarga/master_ref/layanan/print_layanan.php','name','width=900,height=600')" class="btn btn-info" style="margin-left: -4px;" ><i class="icon-print icon-white"></i> Print</a>
	 <?php } ?>
	<?php if ($_SESSION['s_level'] != 'administrator') { ?>
	 	<a href="javascript:void(0)" target="" onclick="window.open('../klinik_restu_keluarga/master_ref/layanan/print_layanan.php','name','width=900,height=600')" class="btn btn-info" style="margin-left: -12px;" ><i class="icon-print icon-white"></i> Print</a>
	 <?php } ?>
	 	<a href="javascript:void(0)" target="" onclick="window.open('../klinik_restu_keluarga/master_ref/layanan/print_layanan_pdf.php','name','width=900,height=600')" class="btn btn-warning" style="margin-left: -4px;" ><i class="icon-file"></i> PDF</a>
	 	<a href="javascript:void(0)" onclick="window.open('../klinik_restu_keluarga/master_ref/layanan/print_layanan_xls.php','name','width=900,height=600')" class="btn btn-danger" style="margin-left: -4px;" ><i class="icon-list-alt"></i> Excel</a>
	</div>

<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%">
	<thead>
		<tr>
			<th width="50px" align="center">No</th>
			<th width="150px" align="center">Kode</th>
			<th align="center">Nama</th>
			<?php if ($_SESSION['s_level'] == 'administrator') { ?>
				<th width="50px" align="center">Aksi</th>
			<?php } ?>
		</tr>
	</thead>
	<tbody>
		<?php
		$layanan = new layanan($pdo);		
		$query = "SELECT *, IF(d.`daftar_id` IS NOT NULL, 'Ya', 'Tidak') AS is_used FROM layanan LEFT JOIN daftar d ON d.`daftar_layanan_id` = layanan_id GROUP BY layanan_id";		
		$layanan->view($query);
	?>
	</tbody>
</table>


