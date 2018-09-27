<!-- 
================= doc ====================
 filename     : hapus_pemeriksaan.php
 @package     : pemeriksaan
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
	include_once('class.pemeriksaan.php');
	$pemeriksaan = new pemeriksaan($pdo);
	$id = $_GET['pemeriksaan_id'];
	$pemeriksaan->delete($id);
?>