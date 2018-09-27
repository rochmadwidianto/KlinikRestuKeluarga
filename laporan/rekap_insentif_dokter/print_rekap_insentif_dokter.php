<!-- 
================= doc ====================
 filename     : print_rekap_insentif_dokter.php
 @package     : rekap_insentif_dokter
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-11-09
 @Modified    : 2017-11-09
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Rekapitulasi Insentif Dokter</title>
<link rel="icon" type="image/jpg" href="assets/images/logo_warna.png" />
<link href="../../assets/css/print.css" rel="stylesheet" type="text/css" media="print" />
<link href="../../assets/css/bootstrap.min.css" rel="stylesheet" />
</style>
</head>
<?php
session_start();
include_once('../../config/koneksi.php');
include_once('../../config/fungsi_indotgl.php');
include_once('class.rekap_insentif_dokter.php');
?>
<body>
<div style="width:95%;margin:0 auto;">
<div class="row-fluid">
<?php include_once('../../header_print.php') ?>
<h4 align="center">Rekapitulasi Insentif Dokter</h4>
<label style="font-weight: bold; text-align: center;">Periode : <?php echo getBulan($_REQUEST['bulan_awal']); ?> s.d. <?php echo getBulan($_REQUEST['bulan_akhir']); ?> <?php echo $_REQUEST['tahun']; ?></label>
<?php
	$insentif_dokter = new rekap_insentif_dokter($pdo);	
	extract($insentif_dokter->getDokterById($_REQUEST['dokter_id']));
?>
</div>
<div class="row-fluid">
	<div class="span2">
		<div class="control-group">
			<label class="control-label" for="poliklinik_nama" >Poli</label>
		</div>
		<div class="control-group">
			<label class="control-label" for="dokter_nama" >Nama</label>
		</div>
		<div class="control-group">
			<label class="control-label" for="dokter_sip" >SIP</label>
		</div>
		<div class="control-group">
			<label class="control-label" for="dokter_gender" >Jenis Kelamin</label>
		</div>
	</div>
	<div class="span4">
		<div class="control-group">
			<label><b><?php echo $poliklinik_kode .' - '.$poliklinik_nama; ?></b></label>
		</div>
		<div class="control-group">
			<label><b><?php echo $dokter_nama; ?></b></label>
		</div>
		<div class="control-group">
			<label><b><?php echo $dokter_sip; ?></b></label>
		</div>
		<div class="control-group">
			<label><b><?php echo $dokter_gender; ?></b></label>
		</div>
	</div>
	<div class="span2">
		<div class="control-group">
			<label class="control-label" for="dokter_agama" >Agama</label>
		</div>
		<div class="control-group">
			<label class="control-label" for="dokter_telp" >HP/Telp</label>
		</div>
		<div class="control-group">
			<label class="control-label" for="dokter_tanggal_lahir" >Tanggal Lahir</label>
		</div>
		<div class="control-group">
			<label class="control-label" for="dokter_alamat" >Alamat</label>
		</div>
	</div>
	<div class="span4">
		<div class="control-group">
			<label><b><?php echo $dokter_agama; ?></b></label>
		</div>
		<div class="control-group">
			<label><b><?php echo $dokter_telp; ?></b></label>
		</div>
		<div class="control-group">
			<label><b><?php echo tgl_indo($dokter_tanggal_lahir); ?></b></label>
		</div>
		<div class="control-group">
			<label><b><?php echo $dokter_alamat; ?></b></label>
		</div>
	</div>
</div>
<table width="100%" border="1" align="Top" cellpadding="5" cellspacing="5" padding-top="0px">
	<thead>
		<tr bgcolor="#DCDCDC" align="center">
			<th width="25px" align="center">No</th>
			<th align="center">Tanggal Periksa</th>
			<th align="center">No Rekam Medis</th>
			<th align="center">Nominal Total</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$insentif_dokter = new rekap_insentif_dokter($pdo);	
			$insentif_dokter->getInsentifDokter($_REQUEST['dokter_id'], $_REQUEST['bulan_awal'], $_REQUEST['bulan_akhir'], $_REQUEST['tahun']);
		?>
		<tr style="font-weight: bold;">
			<td colspan="3" align="right">TOTAL INSENTIF (Rp)</td>
			<td align="right">
				<?php
					$insentif_dokter = new rekap_insentif_dokter($pdo);	
					$sum = $insentif_dokter->sumInsentifDokter($_REQUEST['dokter_id'], $_REQUEST['bulan_awal'], $_REQUEST['bulan_akhir'], $_REQUEST['tahun']);
					echo number_format($sum['sum_jasa_dokter'],2,',','.');
				?>
			</td>
		</tr>
	</tbody>
</table>
<p></p>
<p align="right"><button class="btn btn-primary" id="tombol" onclick="window.print()" ><i class="icon-print"></i> Cetak</button></p>
</div>
</body>
</html>