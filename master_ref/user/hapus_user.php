<!-- 
================= doc ====================
 filename     : hapus_user.php
 @package     : user
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-11-02
 @Modified    : 2017-11-02
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php
	include_once '../../config/koneksi.php';
	include_once 'class.user.php';
	$user = new user($pdo);
	$id = $_GET['username'];
	$user->delete($id);
	header('location:data_user.php');
	
?>