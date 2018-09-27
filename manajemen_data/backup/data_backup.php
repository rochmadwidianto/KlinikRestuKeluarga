<!-- 
================= doc ====================
 filename     : data_backup.php
 @package     : backup
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-11-13
 @Modified    : 2017-11-13
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php
session_start();
include_once('../../config/koneksi.php');
?>
<div id="alert"></div>
<div class="row-fluid">
<h3 class="header smaller lighter blue"><b>Backup Data</b></h3>
<div class="alert alert-info">
	<label style="text-align: center;">
		Klik <b>Backup Database</b><br/><br/>
		Lakukan <i>Backup</i> secara berkala untuk menyelamatkan data Anda. Setiap melakukan <i>Backup</i>, data seluruh sistem akan disimpan dalam bentuk file <b>*.sql</b> dan dapat di-<i>download</i> / di-<i>restore</i> ke dalam sistem.
	</label>
</div>
<div align="center">
	<a href="javascript:void(0)" target="" onclick="backup()" class="btn btn-large btn-info" ><i class="icon-hdd icon-white"></i> <b>Backup Database</b></a>
</div>
</div>