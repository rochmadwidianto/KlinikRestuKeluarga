<!-- 
================= doc ====================
 filename     : print_rekap_insentif_dokter_xls.php
 @package     : rekap_insentif_dokter
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-11-09
 @Modified    : 2017-11-09
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php
session_start();
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/ms-excel"); 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=rekap_insentif_dokter.xls");
require_once('../../config/koneksi.php');
require_once('../../config/fungsi_indotgl.php');
require_once('class.rekap_insentif_dokter.php'); 
?>
<div class="row-fluid">
<h4 align="center">Rekapitulasi Insentif Dokter</h4>
<table width="100%" style="border: none;" align="Top" cellpadding="5" cellspacing="5" padding-top="0px">
	<tr>
		<td align="center" colspan="4"><b>Periode : <?php echo getBulan($_REQUEST['bulan_awal']); ?> s.d. <?php echo getBulan($_REQUEST['bulan_akhir']); ?> <?php echo $_REQUEST['tahun']; ?></b></td>
	</tr>
</table>
<br/>
<?php
	$insentif_dokter = new rekap_insentif_dokter($pdo);	
	extract($insentif_dokter->getDokterById($_REQUEST['dokter_id']));
?>
</div>
<table width="100%" style="border: none;" align="Top" cellpadding="5" cellspacing="5" padding-top="0px">
	<tr>
		<td><b>Poli</b></td>
		<td><?php echo $poliklinik_nama; ?></td>
		<td><b>Agama</b></td>
		<td><?php echo $dokter_agama; ?></td>
	</tr>
	<tr>
		<td><b>Nama</b></td>
		<td><?php echo $dokter_nama; ?></td>
		<td><b>HP/Telp</b></td>
		<td><?php echo $dokter_telp; ?></td>
	</tr>
	<tr>
		<td><b>SIP</b></td>
		<td><?php echo $dokter_sip; ?></td>
		<td><b>Tanggal Lahir</b></td>
		<td><?php echo tgl_indo($dokter_tanggal_lahir); ?></td>
	</tr>
	<tr>
		<td><b>Jenis Kelamin</b></td>
		<td><?php echo $dokter_gender; ?></td>
		<td><b>Alamat</b></td>
		<td><?php echo $dokter_alamat; ?></td>
	</tr>
</table>
<br/>
<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%" border="1">
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