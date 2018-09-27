<?php
	include_once('../../config/koneksi.php');
	include_once('../../config/jml_hari.php');
	include_once('../../config/fungsi_indotgl.php');
	include_once('../rekap_insentif_dokter/class.rekap_insentif_dokter.php');

	$rekap_insentif_dokter 		= new rekap_insentif_dokter($pdo);

	// $bulan_awal 	= $_REQUEST['bulan_awal'];
	// $bulan_akhir	= $_REQUEST['bulan_akhir'];
 //    $tahun 			= $_REQUEST['tahun'];

 //    $dokter_id 	= $_REQUEST['dokter_id'];

    $print_type = $_REQUEST['print_type'];

	if ($print_type=='view') {
		include_once('print_rekap_insentif_dokter.php');
	} elseif ($print_type=='pdf') {
		include_once('print_rekap_insentif_dokter.pdf.php');
	} elseif ($print_type=='xls') {
		include_once('print_rekap_insentif_dokter.xls.php');
	}
	
?>