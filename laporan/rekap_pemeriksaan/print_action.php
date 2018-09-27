<!-- 
================= doc ====================
 filename     : print_action.php
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
	include_once('../../config/koneksi.php');
	include_once('../../config/jml_hari.php');
	include_once('../../config/fungsi_indotgl.php');
	include_once('../rekap_pemeriksaan/class.rekap_pemeriksaan.php');

	$rekap_pemeriksaan 		= new rekap_pemeriksaan($pdo);

	// $bulan_awal 	= $_REQUEST['bulan_awal'];
	// $bulan_akhir	= $_REQUEST['bulan_akhir'];
 //    $tahun 			= $_REQUEST['tahun'];

 //    $dokter_id 	= $_REQUEST['dokter_id'];

    $print_type = $_REQUEST['print_type'];

	if ($print_type=='view') {
		include_once('print_rekap_pemeriksaan.php');
	} elseif ($print_type=='pdf') {
		include_once('print_rekap_pemeriksaan.pdf.php');
	} elseif ($print_type=='xls') {
		include_once('print_rekap_pemeriksaan.xls.php');
	}
	
?>