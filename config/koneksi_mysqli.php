<!-- 
================= doc ====================
 filename     : koneksi_mysqli.php
 @package     : config
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-11-02
 @Modified    : 2017-11-02
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php
	$host 	= 'localhost';
	$user 	= 'root';
	$pass 	= '';
	$db 	= 'klinik_restu_keluarga';
	$link 	=  mysqli_connect($host,$user,$pass,$db);
?>