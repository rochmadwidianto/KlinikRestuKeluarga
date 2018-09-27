<!-- 
================= doc ====================
 filename     : hapus_daftar.php
 @package     : daftar
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
	include_once('class.daftar.php');
	$daftar = new daftar($pdo);
	$id = $_GET['daftar_id'];
	$daftar->delete($id);
?>