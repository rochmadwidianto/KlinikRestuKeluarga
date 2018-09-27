<!-- 
================= doc ====================
 filename     : tambah_layanan.php
 @package     : layanan
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-10-13
 @Modified    : 2017-10-13
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php
session_start();
require_once('../../config/koneksi.php');
require_once('class.layanan.php');
require_once('../../config/fungsi_sqltgl.php');

$layanan = new layanan($pdo);

if(!empty($_POST['layanan_kode'])){
	$param['layanan_kode']		= $_POST['layanan_kode'];
	$param['layanan_nama'] 		= $_POST['layanan_nama'];
	$param['created_by'] 		= $_SESSION['s_user'];

	if($layanan->create($param)){
		$sg   = "ok";
		$msg1 = "<b>SUKSES!</b> Penambahan data berhasil dilakukan";
		$alert='alert-success';
	}else{
		$g = "err";
		$msg2 = "<b>GAGAL!</b> Penambahan data gagal dilakukan";
		$alert='alert-error';
	}
}
?>

<form id="forms" method="post" onSubmit="return submitForm('<?php echo $_SERVER['PHP_SELF']; ?>')" class="form-horizontal">
		<legend>Tambah Layanan</legend>
		<span>
		 <?php
		if(isset($sg) and $sg=='ok'){
			echo "
			<div class='row-fluid'>
				<div class='span11'>
					<div class='alert $alert'>
						$msg1
					</div>
				</div>
				<div class='span1'>
					<button type='button' id='close' class='btn btn-small btn-danger' ><i class='icon-remove'></i></button>
				</div>
			</div>";
		}elseif(isset($sg) and $sg=='err'){
			echo "
			<div class='row-fluid'>
				<div class='span11'>
					<div class='alert $alert'>
						$msg2
					</div>
				</div>
				<div class='span1'>
					<button type='button' id='close' class='btn btn-small btn-danger' ><i class='icon-remove'></i></button>
				</div>
			</div>";
		}
		?>
		</span>
		<div class="row-fluid">
			<div class="span9">
				<div class="control-group">
				<label class="control-label" for="layanan_kode" >Kode</label>
					<div class="controls">
					<input type="text" id="layanan_kode" name="layanan_kode" autocomplite="off" required autofocus />&nbsp;*
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="layanan_nama" >Nama</label>
					<div class="controls">
					<input type="text" class="span8" id="layanan_nama" name="layanan_nama" autocomplite="off" required autofocus />&nbsp;*
					</div>
				</div>
			</div>						
		</div>
		<div class="form-actions">
		<div class="span9"></div>
			<div class="span3">
				<div class="controls-group">
				<button type="submit" class="btn btn-small btn-success"><i class='icon-ok'><b> Simpan</b></i></button>
				<button type="button" id="close" class="btn btn-small btn-danger" ><i class='icon-remove'><b> Batal</b></i></button>
				</div>
			</div>
		</div>
</form>

<script type="text/javascript">
	$(document).ready(function(){
		$("#close").click(function(){
			$("#form-nest").hide("slow");
		});
	});

	$(".tanggal").datepicker({
		dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true,
		yearRange: '1970:2050',
		autoclose: true,
		todayHighlight: true,
		todaySelected: true,

	});
</script>