<!-- 
================= doc ====================
 filename     : data_backup.php
 @package     : backup
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-11-14
 @Modified    : 2017-11-14
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php
session_start();
include_once('../../config/koneksi.php');
?>
<div id="alert"></div>
<div class="row-fluid">
<h3 class="header smaller lighter blue"><b>Restore Data</b></h3>
<div class="alert alert-info">
	<label style="text-align: center;">
		Pilih file berekstensi <i>*.sql</i> kemudian klik <b>Restore Database</b> untuk mengembalikan data sesuai dengan data hasil backup.
	</label>
</div>
<div class="alert alert-danger">
	<label style="text-align: center;">
		<b>Peringatan : </b>Pastikan bahwa file <b>*.sql</b> yang anda pilih sudah benar, karena semua data di sistem akan berubah sesuai dengan data yang telah anda pilih.
	</label>
</div>
<div align="center">
	<form enctype="multipart/form-data" id="forms" method="post" onSubmit="return submitForm('<?php echo $_SERVER['PHP_SELF']; ?>')" class="form-horizontal">
		<div class="row-fluid">
			<div class="control-group">
				<div class="controls">
					<input type="text" name="nip" placeholder="Pilih file *.sql" class="form-control" maxlength="12">
					<input type="file" name="datafile" size="30" />
				</div>
			</div>
		</div>
		<div class="form-group">
			<div>
				<button type="submit" name="restore" class="btn btn-danger"><i class="icon-upload"></i><b>Restore Database</b></button>
			</div>
		</div>
	</form>
</div>
<?php
	if(isset($_POST['restore'])){
		$koneksi = mysql_connect("localhost","root","");
		mysql_select_db("absensi_db",$koneksi);
							
		$nama_file 	= $_FILES['datafile']['name'];
		$ukuran 	= $_FILES['datafile']['size'];
				
		if ($nama_file == ""){
			echo "Fatal Error";
		}
		else{
			//definisikan variabel file dan alamat file
			$uploaddir = 'file/';
			$alamatfile = $uploaddir.$nama_file;

			if (move_uploaded_file($_FILES['datafile']['tmp_name'],$alamatfile)){
				$filename = 'file/'.$nama_file.'';									
				$templine = '';
				$lines = file($filename);

				foreach ($lines as $line){
					if (substr($line, 0, 2) == '--' || $line == '')
						continue;
									 
						$templine .= $line;
						if (substr(trim($line), -1, 1) == ';'){
							mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
							$templine = '';
						}
				}
				echo "<center>Restore Database Telah Berhasil, Silahkan dicek !</center>";
			}
			else{
				echo "Restore Database Gagal, kode error = " . $_FILES['location']['error'];
			}	
		}
	}
	else{
		unset($_POST['restore']);
	}
?>
</div>