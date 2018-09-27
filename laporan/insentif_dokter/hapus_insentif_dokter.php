<!-- 
================= doc ====================
 filename     : hapus_insentif_dokter.php
 @package     : insentif_dokter
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-10-18
 @Modified    : 2017-10-18
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php
	include_once('../../config/koneksi.php');
	include_once('class.insentif_dokter.php');
	$insentif_dokter = new insentif_dokter($pdo);
	$id = $_GET['insentif_dokter_id'];
	$insentif_dokter->delete($id);
?>