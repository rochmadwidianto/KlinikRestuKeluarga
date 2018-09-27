<!-- 
================= doc ====================
 filename     : hapus_poliklinik.php
 @package     : poliklinik
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
	include_once('class.poliklinik.php');
	$poliklinik = new poliklinik($pdo);
	$id = $_GET['poliklinik_id'];
	$poliklinik->delete($id);
?>