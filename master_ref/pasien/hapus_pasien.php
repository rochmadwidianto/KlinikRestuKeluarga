<!-- 
================= doc ====================
 filename     : hapus_pasien.php
 @package     : pasien
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
	include_once('class.pasien.php');
	$pasien = new pasien($pdo);
	$id = $_GET['pasien_id'];
	$pasien->delete($id);
?>