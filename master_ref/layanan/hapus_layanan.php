<!-- 
================= doc ====================
 filename     : hapus_layanan.php
 @package     : layanan
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-10-13
 @Modified    : 2017-10-13
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php
	include_once('../../config/koneksi.php');
	include_once('class.layanan.php');
	$layanan = new layanan($pdo);
	$id = $_GET['layanan_id'];
	$layanan->delete($id);
?>