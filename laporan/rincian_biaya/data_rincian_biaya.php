<!-- 
================= doc ====================
 filename     : data_rincian_biaya.php
 @package     : rincian_biaya
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
include_once('class.rincian_biaya.php');
?>
<div id="alert"></div>
<div class="row-fluid">
<h3 class="header smaller lighter blue"><b>Laporan Rincian Biaya Pemeriksaan</b></h3>
	<div class="table-header">
		<a href="javascript:void(0)" onclick="swapContent('laporan/rekap_rincian_biaya/js_rekap_rincian_biaya')" class="btn btn-success" style="margin-left: -12px;" ><i class="icon-book"></i> Rekap</a>
	 	<a href="javascript:void(0)" target="" onclick="window.open('../klinik_restu_keluarga/laporan/rincian_biaya/print_rincian_biaya.php','name','width=900,height=600')" class="btn btn-info" style="margin-left: -4px;" ><i class="icon-print icon-white"></i> Print</a>
	 	<a href="javascript:void(0)" target="" onclick="window.open('../klinik_restu_keluarga/laporan/rincian_biaya/print_rincian_biaya_pdf.php','name','width=900,height=600')" class="btn btn-warning" style="margin-left: -4px;" ><i class="icon-file"></i> PDF</a>
	 	<a href="javascript:void(0)" onclick="window.open('../klinik_restu_keluarga/laporan/rincian_biaya/print_rincian_biaya_xls.php','name','width=900,height=600')" class="btn btn-danger" style="margin-left: -4px;" ><i class="icon-list-alt"></i> Excel</a>
	</div>

<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%">
	<thead>
		<tr>
			<th rowspan="2" width="25px" align="center">No</th>
			<th rowspan="2" align="center" width="100px">Tanggal</th>
			<th rowspan="2" align="center">No Rekam Medis</th>
			<th colspan="6" align="center">Jenis Biaya</th>
			<th rowspan="2" align="center">Total Biaya (Rp)</th>
		</tr>
		<tr>
			<th align="center">Jasa Dokter</th>
			<th align="center">Obat</th>
			<th align="center">Tindakan</th>
			<th align="center">Laboratorium</th>
			<th align="center">Persalinan</th>
			<th align="center">Lain - Lain</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$rincian_biaya = new rincian_biaya($pdo);		
		$query = "SELECT * FROM v_daftar_rm WHERE daftar_is_bayar = 'Ya' GROUP BY rekam_medis_id ORDER BY rekam_medis_id DESC";	
		$rincian_biaya->view($query);
	?>
	</tbody>
</table>


