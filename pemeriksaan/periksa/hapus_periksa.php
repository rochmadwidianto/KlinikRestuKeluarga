<!-- 
================= doc ====================
 filename     : hapus_periksa.php
 @package     : periksa
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-10-15
 @Modified    : 2017-10-15
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php
	include_once('../../config/koneksi.php');
	include_once('class.periksa.php');
	$periksa = new periksa($pdo);
	$id = $_GET['periksa_id'];
	$periksa->delete($id);
?>