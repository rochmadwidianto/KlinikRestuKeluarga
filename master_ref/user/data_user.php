<!-- 
================= doc ====================
 filename     : data_user.php
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
require_once '../../config/koneksi.php';
require_once '../user/class.user.php';
?>
<?php if ($_SESSION['s_level'] == 'administrator'){ //|| $_SESSION['s_level'] == 'admin' ) { ?>
<div id="alert"></div>
<div class="row-fluid">
<h3 class="header smaller lighter blue"><b>Daftar User</b></h3>
	<div class="table-header">
		<a href="javascript:void(0)" onclick="tambahForm()" class="btn btn-success" style="margin-left: -12px;" ><i class="icon-plus icon-white"></i> Tambah</a> <?php } ?>
		<a href="javascript:void(0)" target="" onclick="window.open('../klinik_restu_keluarga/master_ref/user/print_user.php','name','width=900,height=600')" class="btn btn-info" style="margin-left: -4px;" ><i class="icon-print icon-white"></i> Print</a>
		<a href="javascript:void(0)" target="" onclick="window.open('../klinik_restu_keluarga/master_ref/user/print_user_pdf.php','name','width=900,height=600')" class="btn btn-warning" style="margin-left: -4px;" ><i class="icon-file"></i> PDF</a>
		<a href="javascript:void(0)" onclick="window.open('../klinik_restu_keluarga/master_ref/user/print_user_xls.php','name','width=900,height=600')" class="btn btn-danger" style="margin-left: -4px;" ><i class="icon-list-alt"></i> Excel</a>
	</div>

<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%">
	<thead>
		<tr>
			<th>No</th>
			<th>Username</th>
			<th>Nama Lengkap</th>
			<th>Email</th>
			<th>No.Telp.</th>
			<th>Level</th>
			<th>Aktif</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$user = new user($pdo);
		if ($_SESSION['s_level'] == 'administrator'){
			$query = "SELECT * FROM users";	
		}else{			
			$query = "SELECT * FROM users WHERE username ='$_SESSION[s_user]'";	
		}		
		$user->view($query);
	?>
	</tbody>
</table>

