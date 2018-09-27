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
<h3 class="header smaller lighter blue"><b>Daftar Rekam Medis</b></h3>
	<div class="table-header">
		<a href="javascript:void(0)" onclick="tambahForm()" class="btn btn-success" style="margin-left: -12px;" ><i class="icon-plus icon-white"></i> Tambah</a>
	 	<a href="javascript:void(0)" target="" onclick="window.open('../klinik_restu_keluarga/pendaftaran/rekam_medis/print_rekam_medis.php','name','width=900,height=600')" class="btn btn-info" style="margin-left: -4px;" ><i class="icon-print icon-white"></i> Print</a>
	 	<a href="javascript:void(0)" target="" onclick="window.open('../klinik_restu_keluarga/pendaftaran/rekam_medis/print_rekam_medis_pdf.php','name','width=900,height=600')" class="btn btn-warning" style="margin-left: -4px;" ><i class="icon-file"></i> PDF</a>
	 	<a href="javascript:void(0)" onclick="window.open('../klinik_restu_keluarga/pendaftaran/rekam_medis/print_rekam_medis_xls.php','name','width=900,height=600')" class="btn btn-danger" style="margin-left: -4px;" ><i class="icon-list-alt"></i> Excel</a>
	</div>

<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%">
	<thead>
		<tr>
			<th rowspan="2" width="25px" align="center">No</th>
			<th rowspan="2" align="center">Nomor RM</th>
			<th colspan="2" align="center">Pasien</th>
			<th rowspan="2" align="center" width="100px">Tanggal</th>
			<th rowspan="2" align="center">Alergi Obat</th>
			<th rowspan="2" align="center">Anamnese/Diagnosa</th>
			<th rowspan="2" align="center">Terapi</th>
			<th colspan="2" align="center">Status</th>
			<th rowspan="2" align="center">Aksi</th>
		</tr>
		<tr>
			<th align="center">Kode</th>
			<th align="center">Nama</th>
			<th align="center">Periksa</th>
			<th align="center">Bayar</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$rekam_medis = new rekam_medis($pdo);		
		$query = "SELECT * FROM v_daftar_rm GROUP BY rekam_medis_id ORDER BY rekam_medis_id DESC";	
		$rekam_medis->view($query);
	?>
	</tbody>
</table>


