<!-- 
================= doc ====================
 filename     : data_pemeriksaan.php
 @package     : pemeriksaan
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-10-18
 @Modified    : 2017-10-18
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php
session_start();
include_once('../../config/koneksi.php');
include_once('../../config/fungsi_indotgl.php');
include_once('class.pemeriksaan.php');
?>
<div id="alert"></div>
<div class="row-fluid">
<h3 class="header smaller lighter blue"><b>Laporan Biaya Pemeriksaan</b></h3>
	<div class="table-header">
		<a href="javascript:void(0)" onclick="swapContent('laporan/rekap_pemeriksaan/js_rekap_pemeriksaan')" class="btn btn-success" style="margin-left: -12px;" ><i class="icon-book"></i> Rekap</a>
	 	<a href="javascript:void(0)" target="" onclick="window.open('../klinik_restu_keluarga/laporan/pemeriksaan/print_pemeriksaan.php','name','width=900,height=600')" class="btn btn-info" style="margin-left: -4px;" ><i class="icon-print icon-white"></i> Print</a>
	 	<a href="javascript:void(0)" target="" onclick="window.open('../klinik_restu_keluarga/laporan/pemeriksaan/print_pemeriksaan_pdf.php','name','width=900,height=600')" class="btn btn-warning" style="margin-left: -4px;" ><i class="icon-file"></i> PDF</a>
	 	<a href="javascript:void(0)" onclick="window.open('../klinik_restu_keluarga/laporan/pemeriksaan/print_pemeriksaan_xls.php','name','width=900,height=600')" class="btn btn-danger" style="margin-left: -4px;" ><i class="icon-list-alt"></i> Excel</a>
	</div>

<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%">
	<thead>
		<tr>
			<th rowspan="2" width="25px" align="center">No</th>
			<th rowspan="2" align="center" width="100px">Tanggal</th>
			<th rowspan="2" align="center">No Rekam Medis</th>
			<th colspan="2" align="center">Pasien</th>
			<th rowspan="2" align="center">Poliklinik</th>
			<th rowspan="2" align="center">Dokter</th>
			<th rowspan="2" align="center">Nominal Total</th>
		</tr>
		<tr>
			<th align="center">Kode</th>
			<th align="center">Nama</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$pemeriksaan = new pemeriksaan($pdo);		
		$query = "SELECT * FROM v_daftar_rm WHERE daftar_is_bayar = 'Ya' GROUP BY rekam_medis_id ORDER BY rekam_medis_id DESC";	
		$pemeriksaan->view($query);
	?>
	</tbody>
</table>


