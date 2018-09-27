<!-- 
================= doc ====================
 filename     : hapus_petugas.php
 @package     : petugas
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
	include_once('class.petugas.php');
	$petugas = new petugas($pdo);
	$id = $_GET['petugas_id'];
	$petugas->delete($id);
?>