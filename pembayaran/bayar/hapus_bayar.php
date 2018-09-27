<!-- 
================= doc ====================
 filename     : hapus_bayar.php
 @package     : bayar
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
	include_once('class.bayar.php');
	$bayar = new bayar($pdo);
	$id = $_GET['bayar_id'];
	$bayar->delete($id);
?>