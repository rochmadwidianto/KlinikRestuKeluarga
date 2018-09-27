<!-- 
================= doc ====================
 filename     : hapus_rincian_biaya.php
 @package     : rincian_biaya
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
	include_once('class.rincian_biaya.php');
	$rincian_biaya = new rincian_biaya($pdo);
	$id = $_GET['rincian_biaya_id'];
	$rincian_biaya->delete($id);
?>