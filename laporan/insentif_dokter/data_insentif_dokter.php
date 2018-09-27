<!-- 
================= doc ====================
 filename     : data_insentif_dokter.php
 @package     : insentif_dokter
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
include_once('class.insentif_dokter.php');
?>
<div id="alert"></div>
<div class="row-fluid">
<h3 class="header smaller lighter blue"><b>Laporan Insentif Dokter</b></h3>
	<div class="table-header">
		<a href="javascript:void(0)" onclick="swapContent('laporan/rekap_insentif_dokter/js_rekap_insentif_dokter')" class="btn btn-success" style="margin-left: -12px;" ><i class="icon-book"></i> Rekap</a>
	 	<a href="javascript:void(0)" target="" onclick="window.open('../klinik_restu_keluarga/laporan/insentif_dokter/print_insentif_dokter.php','name','width=900,height=600')" class="btn btn-info" style="margin-left: -4px;" ><i class="icon-print icon-white"></i> Print</a>
	 	<a href="javascript:void(0)" target="" onclick="window.open('../klinik_restu_keluarga/laporan/insentif_dokter/print_insentif_dokter_pdf.php','name','width=900,height=600')" class="btn btn-warning" style="margin-left: -4px;" ><i class="icon-file"></i> PDF</a>
	 	<a href="javascript:void(0)" onclick="window.open('../klinik_restu_keluarga/laporan/insentif_dokter/print_insentif_dokter_xls.php','name','width=900,height=600')" class="btn btn-danger" style="margin-left: -4px;" ><i class="icon-list-alt"></i> Excel</a>
	</div>

<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%">
	<thead>
		<tr>
			<th rowspan="2" width="25px" align="center">No</th>
			<th colspan="2" align="center">Dokter</th>
			<th rowspan="2" align="center" width="100px">Tanggal Periksa</th>
			<th rowspan="2" align="center">No Rekam Medis</th>
			<th rowspan="2" align="center">Nominal Total</th>
		</tr>
		<tr>
			<th align="center">SIP</th>
			<th align="center">Nama</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$insentif_dokter = new insentif_dokter($pdo);		
		$query = "SELECT * FROM v_daftar_rm WHERE UPPER(daftar_is_periksa) = 'YA' AND UPPER(daftar_is_bayar) = 'YA' GROUP BY rekam_medis_id ORDER BY periksa_tanggal DESC";	
		$insentif_dokter->view($query);
	?>
	</tbody>
</table>


