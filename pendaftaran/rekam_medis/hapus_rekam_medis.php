<!-- 
================= doc ====================
 filename     : hapus_rekam_medis.php
 @package     : rekam_medis
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-10-14
 @Modified    : 2017-10-14
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php
	include_once('../../config/koneksi.php');
	include_once('class.rekam_medis.php');
	$rekam_medis = new rekam_medis($pdo);
	$id = $_GET['rekam_medis_id'];
	$rekam_medis->delete($id);
?>