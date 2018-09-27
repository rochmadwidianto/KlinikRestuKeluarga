<!-- 
================= doc ====================
 filename     : hapus_tindakan.php
 @package     : tindakan
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
	include_once('class.tindakan.php');
	$tindakan = new tindakan($pdo);
	$id = $_GET['tindakan_id'];
	$tindakan->delete($id);
?>