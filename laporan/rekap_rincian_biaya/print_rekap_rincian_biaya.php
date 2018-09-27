<!-- 
================= doc ====================
 filename     : print_rekap_rincian_biaya.php
 @package     : rekap_rincian_biaya
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-11-10
 @Modified    : 2017-11-10
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Rekapitulasi Biaya Pemeriksaan</title>
<link rel="icon" type="image/jpg" href="assets/images/logo_warna.png" />
<link href="../../assets/css/print.css" rel="stylesheet" type="text/css" media="print" />
<link href="../../assets/css/bootstrap.min.css" rel="stylesheet" />
</style>
</head>
<?php
session_start();
include_once('../../config/koneksi.php');
include_once('../../config/fungsi_indotgl.php');
include_once('class.rekap_rincian_biaya.php');
?>
<body>
<div style="width:95%;margin:0 auto;">
<div class="row-fluid">
<?php include_once('../../header_print.php') ?>
<h4 align="center">Rekapitulasi Rincian Biaya Pemeriksaan</h4>
</div>
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
<p></p>
<p align="right"><button class="btn btn-primary" id="tombol" onclick="window.print()" ><i class="icon-print"></i> Cetak</button></p>
</div>
</body>
</html>