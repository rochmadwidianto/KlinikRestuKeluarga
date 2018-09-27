<!-- 
================= doc ====================
 filename     : hapus_dokter.php
 @package     : dokter
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-10-12
 @Modified    : 2017-10-12
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php
	include_once('../../config/koneksi.php');
	include_once('class.dokter.php');
	$dokter = new dokter($pdo);
	$id = $_GET['dokter_id'];
	$dokter->delete($id);
?>