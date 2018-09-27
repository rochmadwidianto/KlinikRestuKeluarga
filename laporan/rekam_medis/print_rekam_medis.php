<!-- 
================= doc ====================
 filename     : print_rekam_medis.php
 @package     : rekam_medis
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-10-14
 @Modified    : 2017-10-14
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cetak Rekam Medis</title>
<link rel="icon" type="image/jpg" href="../../assets/images/logo_warna.png" />
<link href="../../assets/css/print.css" rel="stylesheet" type="text/css" media="print" />
<link href="../../assets/css/bootstrap.min.css" rel="stylesheet" />
</style>
</head>
<?php
	session_start();
	include_once('../../config/koneksi.php');
	include_once('../../config/fungsi_indotgl.php');
	include_once('class.rekam_medis.php');

	$id   = $_GET['pasien_id'];
	$rekam_medis = new rekam_medis($pdo);
	extract($rekam_medis->getPasienById($id));	

	/* Get Umur */
	$birthDt = new DateTime($pasien_tanggal_lahir);
	$today 	 = new DateTime('today');

	$year 	= $today->diff($birthDt)->y;
	$month 	= $today->diff($birthDt)->m;
	$day 	= $today->diff($birthDt)->d;
	/* END - Get Umur */
?>
<body>
<div style="width:95%;margin:0 auto;">
<div class="row-fluid">
	<?php include_once('../../header_print.php') ?>

<p align="right"><button class="btn btn-primary" id="tombol" onclick="window.print()" ><i class="icon-print"></i> Cetak</button></p>
	<h3 class="header smaller lighter blue" align="center"><b>RIWAYAT REKAM MEDIS</b></h3>
</div>
<div class="row-fluid">
	<div class="span2">
		<div class="control-group">
			<label class="control-label" for="pasien_nomor" >Nomor</label>
		</div>
		<div class="control-group">
			<label class="control-label" for="pasien_nama" >Nama</label>
		</div>
		<div class="control-group">
			<label class="control-label" for="pasien_agama" >Agama</label>
		</div>
		<div class="control-group">
			<label class="control-label" for="pasien_gender" >Jenis Kelamin</label>
		</div>
	</div>
	<div class="span4">
		<div class="control-group">
			<label><b><?php echo $pasien_nomor; ?></b></label>
		</div>
		<div class="control-group">
			<label><b><?php echo $pasien_nama; ?></b></label>
		</div>
		<div class="control-group">
			<label><b><?php echo $pasien_agama; ?></b></label>
		</div>
		<div class="control-group">
			<label><b><?php echo $pasien_gender; ?></b></label>
		</div>
	</div>
	<div class="span2">
		<div class="control-group">
			<label class="control-label" for="pasien_umur" >Umur</label>
		</div>
		<div class="control-group">
			<label class="control-label" for="pasien_tanggal_lahir" >Tanggal Lahir</label>
		</div>
		<div class="control-group">
			<label class="control-label" for="pasien_telp" >Telp/HP</label>
		</div>
		<div class="control-group">
			<label class="control-label" for="pasien_alamat" >Alamat</label>
		</div>
	</div>
	<div class="span4">
		<div class="control-group">
			<label><b><?php echo $year.' Tahun '.$month.' Bulan '.$day.' Hari '; ?></b></label>
		</div>
		<div class="control-group">
			<label><b><?php echo tgl_indo($pasien_tanggal_lahir); ?></b></label>
		</div>
		<div class="control-group">
			<label><b><?php echo $pasien_telp; ?></b></label>
		</div>
		<div class="control-group">
			<label><b><?php echo $pasien_alamat; ?></b></label>
		</div>
	</div>
</div>
	<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%">
		<thead>
			<tr bgcolor="#DCDCDC">
				<th><div align="center">Tanggal</div></th>
				<th><div align="center">Anamnesa</div></th>
				<th><div align="center">Therapy</div></th>	
			</tr>
		</thead>
		<tbody>
			<?php
				$id   = $_GET['pasien_id'];
				$rekam_medis = new rekam_medis($pdo);
				$query = "SELECT * FROM v_daftar_rm WHERE pasien_id = '$id' GROUP BY rekam_medis_id ORDER BY rekam_medis_id DESC";
				$rekam_medis->view_detail($query);		
			?>
		</tbody>
	</table>
</div>
</body>
</html>