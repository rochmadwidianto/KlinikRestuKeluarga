<!-- 
================= doc ====================
 filename     : print_kuitansi.php
 @package     : bayar
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-10-23
 @Modified    : 2017-10-23
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print Document</title>
<link href="../../assets/css/print.css" rel="stylesheet" type="text/css" media="print" />
<link href="../../assets/css/bootstrap.min.css" rel="stylesheet" />
</style>
</head>
<?php
session_start();
include_once('../../config/koneksi.php');
include_once('../../config/fungsi_indotgl.php');
include_once('class.bayar.php');

	$bayar = new bayar($pdo);
		if(isset($_GET['rekam_medis_id']))
		{
			$id = $_GET['rekam_medis_id'];
			extract($bayar->getID($id));	
		} 
?>
<body style="font-family: Courier New; font-size: 9pt;">
<div style="width:60%;margin:0 auto;">
<div class="row-fluid">
<label><b>KLINIK PRATAMA "RESTU KELUARGA"</b></label>
<label style="float: right"><b><?php echo date('d-M-Y'); ?></b></label>
<label><b>Gombang, Cawas, Klaten</b></label>
<h4 align="center" style="font-weight: bold;">KUITANSI</h4>
<div class="span2">
	<div class="control-group">
		<label class="control-label" for="pasien_nomor" >No</label>
	</div>
	<div class="control-group">
		<label class="control-label" for="pasien_nama" >Nama</label>
	</div>
	<div class="control-group">
		<label class="control-label" for="rekam_medis_nomor" >No RM</label>
	</div>
</div>
<div class="span3">
	<div class="control-group" style="margin-left: -40px">
		<label><?php echo $pasien_nomor; ?></label>
	</div>
	<div class="control-group" style="margin-left: -40px">
		<label><?php echo $pasien_nama; ?></label>
	</div>
	<div class="control-group" style="margin-left: -40px">
		<label><?php echo $rekam_medis_nomor; ?></label>
	</div>
</div>
<div class="span2">
	<div class="control-group">
		<label class="control-label" for="poliklinik_nama" >Poli</label>
	</div>
	<div class="control-group">
		<label class="control-label" for="dokter_nama" >Dokter</label>
	</div>
	<div class="control-group">
		<label class="control-label" for="pasien_alamat" >Petugas</label>
	</div>
</div>
<div class="span3">
	<div class="control-group">
		<label><?php echo $poliklinik_nama; ?></label>
	</div>
	<div class="control-group">
		<label><?php echo $dokter_nama; ?></label>
	</div>
	<div class="control-group">
		<label><?php echo $_SESSION['s_nama']; ?></label>
	</div>
</div>
</div>
<hr width="100%">
<table class="table table-condensed" width="100%" align="Top">
	<thead>
		<tr align="center">
			<th width="40%" align="center">JENIS TRANSAKSI</th>
			<th align="center">QTY</th>
			<th align="center">TOTAL (Rp)</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Jasa Dokter</td>
			<td>1.00</td>
			<td align="right"><?php echo number_format($bayar_jasa_dokter,2,',','.'); ?></td>
		</tr>
		<tr>
			<td>Obat</td>
			<td>1.00</td>
			<td align="right"><?php echo number_format($bayar_harga_obat,2,',','.'); ?></td>
		</tr>
		<tr>
			<td>Biaya Tindakan</td>
			<td>1.00</td>
			<td align="right"><?php echo number_format($bayar_biaya_tindakan,2,',','.'); ?></td>
		</tr>
		<tr>
			<td>Biaya Laboratorium</td>
			<td>1.00</td>
			<td align="right"><?php echo number_format($bayar_biaya_laborat,2,',','.'); ?></td>
		</tr>
		<tr>
			<td>Biaya Persalinan</td>
			<td>1.00</td>
			<td align="right"><?php echo number_format($bayar_biaya_persalinan,2,',','.'); ?></td>
		</tr>
		<tr>
			<td>Biaya Lain - Lain</td>
			<td>1.00</td>
			<td align="right"><?php echo number_format($bayar_biaya_lain,2,',','.'); ?></td>
		</tr>
		<tr style="font-weight: bold;">
			<td colspan="2" align="right">TOTAL BIAYA (Rp)</td>
			<td align="right"><?php echo number_format($bayar_biaya,2,',','.'); ?></td>
		</tr>
	</tbody>
</table>
<p></p>
<p align="right"><button class="btn btn-primary" id="tombol" onclick="window.print()" ><i class="icon-print"></i> Cetak</button></p>
</div>
</body>
</html>