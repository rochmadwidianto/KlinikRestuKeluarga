<!-- 
================= doc ====================
 filename     : act_backup.php
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
	<?php
		error_reporting(0);
		$file=date("Ymd").'_backup_database_'.time().'.sql';
		backup_tables("localhost","root","","klinik_restu_keluarga",$file);
	?>
	<div class="alert alert-info" align="center">
		<b style="font-size: 16pt;">SUKSES! </b><br/>Backup Database Berhasil Dilakukan.<br/><br/>
		<div class="alert alert-danger">
			<b>Perhatian : </b>Download file <b>*.sql</b> hasil backup dan simpan pada <i>device</i> lain (bukan dikomputer ini). Hal ini diperlukan untuk antisipasi kasus kehilangan data akibat beberapa trouble yang mungkin dapat terjadi, seperti : Trouble pada sistem, trouble pada komputer, dll.
		</div>
	</div>
	<div align="center">
		<?php echo "
			<a href='javascript:void(0)' onclick=\"window.open('../klinik_restu_keluarga/manajemen_data/backup/download_backup.php?nama_file=$file')\"  class='btn btn-large btn-warning'><i class='icon-download-alt icon-white'></i><b> Download Hasil Backup</b></a>
				"; ?>
	</div>
	<?php
	/*
	untuk memanggil nama fungsi :: jika anda ingin membackup semua tabel yang ada didalam database, biarkan tanda BINTANG (*) pada variabel $tables = '*'
	jika hanya tabel-table tertentu, masukan nama table dipisahkan dengan tanda KOMA (,) 
	*/
	
	function backup_tables($host,$user,$pass,$name,$nama_file,$tables ='*')	{
		$link = mysql_connect($host,$user,$pass);
		mysql_select_db($name,$link);
							
		if($tables == '*'){
			$tables = array();
			$result = mysql_query('SHOW TABLES');
			while($row = mysql_fetch_row($result)){
				$tables[] = $row[0];
			}
		}
		else{
			// jika hanya table-table tertentu
			$tables = is_array($tables) ? $tables : explode(',',$tables);
		}
							
		foreach($tables as $table){
			$result = mysql_query('SELECT * FROM '.$table);
			$num_fields = mysql_num_fields($result);
																
			$return.= 'DROP TABLE '.$table.';';//menyisipkan query drop table untuk nanti hapus table yang lama
			$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
			$return.= "\n\n".$row2[1].";\n\n";
								
			for ($i = 0; $i < $num_fields; $i++) {
				while($row = mysql_fetch_row($result)){
					// menyisipkan query Insert. untuk nanti memasukan data yang lama ketable yang baru dibuat
					$return.= 'INSERT INTO '.$table.' VALUES(';
					for($j=0; $j<$num_fields; $j++) {
						// akan menelusuri setiap baris query didalam
						$row[$j] = addslashes($row[$j]);
						$row[$j] = ereg_replace("\n","\\n",$row[$j]);
						if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
							if ($j<($num_fields-1)) { $return.= ','; }
					}
						$return.= ");\n";
				}
			}
			
			$return.="\n\n\n";
		}							
			// simpan file di folder
			$nama_file;
							
			$handle = fopen('file/'.$nama_file,'w+');
			fwrite($handle,$return);
			fclose($handle);
	}
	?>
</div>