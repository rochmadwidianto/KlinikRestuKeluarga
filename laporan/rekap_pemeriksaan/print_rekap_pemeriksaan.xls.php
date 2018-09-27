<!-- 
================= doc ====================
 filename     : print_rekap_pemeriksaan_xls.php
 @package     : rekap_pemeriksaan
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-11-10
 @Modified    : 2017-11-10
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php
session_start();
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/ms-excel"); 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=rekap_biaya_pemeriksaan.xls");
require_once('../../config/koneksi.php');
require_once('../../config/fungsi_indotgl.php');
require_once('class.rekap_pemeriksaan.php'); 
?>
<div class="row-fluid">
<h4 align="center">Rekapitulasi Biaya Pemeriksaan</h4>

<table width="100%" border="1" align="Top" cellpadding="5" cellspacing="5" padding-top="0px">
	<thead>
		<tr bgcolor="#DCDCDC" align="center">
			<th rowspan="2" width="25px" align="center">No</th>
			<th rowspan="2" align="center" width="100px">Tanggal</th>
			<th rowspan="2" align="center">No Rekam Medis</th>
			<th colspan="2" align="center">Pasien</th>
			<th rowspan="2" align="center">Poliklinik</th>
			<th rowspan="2" align="center">Dokter</th>
			<th rowspan="2" align="center">Nominal Total</th>
		</tr>
		<tr bgcolor="#DCDCDC" align="center">
			<th align="center">Kode</th>
			<th align="center">Nama</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$biaya_pemeriksaan = new rekap_pemeriksaan($pdo);	
			$biaya_pemeriksaan->getBiayaPemeriksaan($_REQUEST['tanggal_periksa_awal'], $_REQUEST['tanggal_periksa_akhir'], $_REQUEST['pasien_id'], $_REQUEST['rekam_medis_nomor']);
		?>
		<tr style="font-weight: bold;">
			<td colspan="7" align="right">TOTAL BIAYA PEMERIKSAAN (Rp)</td>
			<td align="right">
				<?php
					$biaya_pemeriksaan = new rekap_pemeriksaan($pdo);	
					$sum = $biaya_pemeriksaan->sumBiayaPemeriksaan($_REQUEST['tanggal_periksa_awal'], $_REQUEST['tanggal_periksa_akhir'], $_REQUEST['pasien_id'], $_REQUEST['rekam_medis_nomor']);
					echo number_format($sum['sum_biaya_pemeriksaan'],2,',','.');
				?>
			</td>
		</tr>
	</tbody>
</table>