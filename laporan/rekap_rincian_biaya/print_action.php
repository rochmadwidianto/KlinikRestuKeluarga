<!-- 
================= doc ====================
 filename     : print_action.php
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
	include_once('../../config/koneksi.php');
	include_once('../../config/jml_hari.php');
	include_once('../../config/fungsi_indotgl.php');
	include_once('../rekap_rincian_biaya/class.rekap_rincian_biaya.php');

	$rekap_rincian_biaya 		= new rekap_rincian_biaya($pdo);

	// $bulan_awal 	= $_REQUEST['bulan_awal'];
	// $bulan_akhir	= $_REQUEST['bulan_akhir'];
 //    $tahun 			= $_REQUEST['tahun'];

 //    $dokter_id 	= $_REQUEST['dokter_id'];

    $print_type = $_REQUEST['print_type'];

	if ($print_type=='view') {
		include_once('print_rekap_rincian_biaya.php');
	} elseif ($print_type=='pdf') {
		include_once('print_rekap_rincian_biaya.pdf.php');
	} elseif ($print_type=='xls') {
		include_once('print_rekap_rincian_biaya.xls.php');
	}
	
?>