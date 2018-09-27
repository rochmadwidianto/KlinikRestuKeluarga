<!-- 
================= doc ====================
 filename     : print_rekap_rincian_biaya_xls.php
 @package     : rekap_rincian_biaya
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
header("Content-Disposition: attachment; filename=rekap_rincian_biaya.xls");
require_once('../../config/koneksi.php');
require_once('../../config/fungsi_indotgl.php');
require_once('class.rekap_rincian_biaya.php'); 
?>
<div class="row-fluid">
<h4 align="center">Rekapitulasi Rincian Biaya Pemeriksaan</h4>

<table width="100%" border="1" align="Top" cellpadding="5" cellspacing="5" padding-top="0px">
	<thead>
		<tr bgcolor="#DCDCDC" align="center">
			<th rowspan="2" width="25px" align="center">No</th>
			<th rowspan="2" align="center" width="100px">Tanggal</th>
			<th rowspan="2" align="center">No Rekam Medis</th>
			<th colspan="6" align="center">Jenis Biaya</th>
			<th rowspan="2" align="center">Total Biaya (Rp)</th>
		</tr>
		<tr bgcolor="#DCDCDC" align="center">
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
			$biaya_rincian_biaya = new rekap_rincian_biaya($pdo);	
			$biaya_rincian_biaya->getRincianBiayaPemeriksaan($_REQUEST['tanggal_periksa_awal'], $_REQUEST['tanggal_periksa_akhir'], $_REQUEST['pasien_id'], $_REQUEST['rekam_medis_nomor']);
		?>
		<tr style="font-weight: bold;">
			<td colspan="3" align="right">TOTAL BIAYA PEMERIKSAAN (Rp)</td>
				<?php
					$biaya_rincian_biaya = new rekap_rincian_biaya($pdo);	
					$sum = $biaya_rincian_biaya->sumRincianBiayaPemeriksaan($_REQUEST['tanggal_periksa_awal'], $_REQUEST['tanggal_periksa_akhir'], $_REQUEST['pasien_id'], $_REQUEST['rekam_medis_nomor']);
				?>
				
			<td align="right">
				<?php echo number_format($sum['sum_biaya_jasa_dokter'],2,',','.'); ?>
			</td>
			<td align="right">
				<?php echo number_format($sum['sum_biaya_obat'],2,',','.'); ?>
			</td>
			<td align="right">
				<?php echo number_format($sum['sum_biaya_tindakan'],2,',','.'); ?>
			</td>
			<td align="right">
				<?php echo number_format($sum['sum_biaya_laborat'],2,',','.'); ?>
			</td>
			<td align="right">
				<?php echo number_format($sum['sum_biaya_persalian'],2,',','.'); ?>
			</td>
			<td align="right">
				<?php echo number_format($sum['sum_biaya_lain'],2,',','.'); ?>
			</td>
			<td align="right">
				<?php echo number_format($sum['sum_biaya_pemeriksaan'],2,',','.'); ?>
			</td>
		</tr>
	</tbody>
</table>