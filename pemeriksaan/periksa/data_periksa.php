<!-- 
================= doc ====================
 filename     : data_periksa.php
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
include_once('../../config/koneksi.php');
include_once('../../config/fungsi_indotgl.php');
include_once('class.periksa.php');
?>
<div id="alert"></div>
<div class="row-fluid">
<h3 class="header smaller lighter blue"><b>Daftar Pemeriksaan</b></h3>
	<div class="table-header">
		<a style="display: none;" href="javascript:void(0)" onclick="tambahForm()" class="btn btn-success" style="margin-left: -12px;" ><i class="icon-plus icon-white"></i> Tambah</a>
	 <a href="javascript:void(0)" target="" onclick="window.open('../klinik_restu_keluarga/pemeriksaan/periksa/print_periksa.php','name','width=900,height=600')" class="btn btn-info" style="margin-left: -12px;" ><i class="icon-print icon-white"></i> Print</a>
	 <a href="javascript:void(0)" target="" onclick="window.open('../klinik_restu_keluarga/pemeriksaan/periksa/print_periksa_pdf.php','name','width=900,height=600')" class="btn btn-warning" style="margin-left: -4px;" ><i class="icon-file"></i> PDF</a>
	 <a href="javascript:void(0)" onclick="window.open('../klinik_restu_keluarga/pemeriksaan/periksa/print_periksa_xls.php','name','width=900,height=600')" class="btn btn-danger" style="margin-left: -4px;" ><i class="icon-list-alt"></i> Excel</a>
	</div>

<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%">
	<thead>
		<tr>
			<th rowspan="2" width="25px" align="center">No</th>
			<th rowspan="2" align="center">No Rekam Medis</th>
			<th colspan="2" align="center">Pasien</th>
			<th rowspan="2" align="center" width="100px">Tanggal</th>
			<th rowspan="2" align="center">Keluhan</th>
			<th rowspan="2" align="center">Anamnese/Diagnosa</th>
			<th rowspan="2" align="center">Terapi</th>
			<th rowspan="2" align="center">Aksi</th>
		</tr>
		<tr>
			<th align="center">Kode</th>
			<th align="center">Nama</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$periksa = new periksa($pdo);		
		$query = "SELECT * FROM v_daftar_rm GROUP BY rekam_medis_id ORDER BY rekam_medis_id DESC";	
		$periksa->view($query);
	?>
	</tbody>
</table>


