<!-- 
================= doc ====================
 filename     : koneksi.php
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
	$DB_host = "localhost"; // SERVER
	$DB_user = "root"; // USER DATA BASE SERVER
	$DB_pass = "localhost"; // PASWORD SERVER
	$DB_name = "klinik_restu_keluarga"; // NAMA DATA BASE

	// KONEKSI PDO MYSQL
	try
	{
		$pdo= new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
	{
		echo  "
				<div class='alert alert-danger'>
					<button type='button' class='close' data-dismiss='alert'>&times;</button>
					<strong>Terjadi kesalahan !</strong> Koneksi Ke Database Terputus, Hubungi Administrator
				</div>";
	}
		
?>
