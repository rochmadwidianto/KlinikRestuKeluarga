<?php
	$file=$_GET['nama_file'];	
    // nama file yang akan didownload
	header("Content-Disposition: attachment; filename=".$file);
    // ukuran file yang akan didownload
	header("Content-length: ".$file);
    // jenis file yang akan didownload
	header("Content-type: ".$file);

	// proses membaca isi file yang akan didownload dari folder
	$fp  = fopen("./file/".$file, 'r');
	$content = fread($fp, filesize('./file/'.$file));
	fclose($fp);
	echo $content;
	exit;
?>
