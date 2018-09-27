<!-- 
================= doc ====================
 filename     : multi-form-submit-edit.php
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
session_start();
#echo "FILES =".json_encode($_FILES)."<br><br>";
#echo "POST =".json_encode($_POST)."<br>";
include_once('../../config/koneksi.php');
include_once('class.user.php');
$user = new user($pdo);
if(!empty($_POST['username'])){
	$username		= $_POST['username'];
	if ($_POST['password'] == ""){
		$password	= $_POST['password1'];
	}else{
		$password 	= md5($_POST['password']);
	}
	$nama_lengkap	= $_POST['nama_lengkap'];
	$email 			= $_POST['email'];
	$no_telp		= $_POST['no_telp'];
	$level 			= $_POST['level'];
	$aktif 			= $_POST['aktif'];
	$update_by 		= $_SESSION['s_user'];
	if ($_FILES['file']['name'] == ""){
		$file_name 	= $_POST['file1'];
	}else{
		$file_name  = basename($_FILES['file']['name']);
	}
    $size_file      = $_FILES['file']['size'];
    $type_file      = $_FILES['file']['type'];
    $uploaddir 		= '../user/img_user/';
    $alamatfile 	= $uploaddir . $file_name;
    move_uploaded_file($_FILES['file']['tmp_name'], $alamatfile);

	if($user->update($username,$password,$nama_lengkap,$email,$no_telp,$level,$aktif,$file_name,$update_by)){
		$sg   = "ok";
		$msg1 = "<b>SUKSES!</b> Perubahan data berhasil dilakukan";
		$alert='alert-success';
	}else{
		$g = "err";
		$msg2 = "<b>GAGAL!</b> Perubahan data gagal dilakukan";
		$alert='alert-error';
	}
	if(isset($sg) and $sg=='ok'){
		echo "
		<div id='alert' class='alert $alert'>
		<button type='button' class='close' data-dismiss='alert'>&times;</button>
		$msg1
		</div>";
	}elseif(isset($sg) and $sg=='err'){
		echo "
		<div id='alert' class='alert $alert'>
		<button type='button' class='close' data-dismiss='alert'>&times;</button>
		$msg2
		</div>";}
}

?>