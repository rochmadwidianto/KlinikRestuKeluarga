<!-- 
================= doc ====================
 filename     : tambah_poliklinik.php
 @package     : poliklinik
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
require_once('class.poliklinik.php');
require_once('../../config/fungsi_sqltgl.php');

$poliklinik = new poliklinik($pdo);

if(!empty($_POST['poliklinik_kode'])){
	$param['poliklinik_kode']		= $_POST['poliklinik_kode'];
	$param['poliklinik_nama'] 		= $_POST['poliklinik_nama'];
	$param['poliklinik_ruangan'] 	= $_POST['poliklinik_ruangan'];
	$param['poliklinik_penanggung_jawab'] 		= $_POST['poliklinik_penanggung_jawab'];
	$param['poliklinik_keterangan'] = $_POST['poliklinik_keterangan'];
	$param['created_by'] 			= $_SESSION['s_user'];

	if($poliklinik->create($param)){
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
		<legend>Tambah Poliklinik</legend>
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
				<label class="control-label" for="poliklinik_kode" >Kode</label>
					<div class="controls">
					<input type="text" id="poliklinik_kode" name="poliklinik_kode" autocomplite="off" required autofocus />&nbsp;*
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="poliklinik_nama" >Nama</label>
					<div class="controls">
					<input type="text" class="span8" id="poliklinik_nama" name="poliklinik_nama" autocomplite="off" required autofocus />&nbsp;*
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="poliklinik_ruangan" >Ruangan</label>
					<div class="controls">
					<input type="text" class="span8" id="poliklinik_ruangan" name="poliklinik_ruangan" autocomplite="off"  />
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="poliklinik_penanggung_jawab" >Penanggung Jawab</label>
					<div class="controls">
					<input type="text" class="span8" id="poliklinik_penanggung_jawab" name="poliklinik_penanggung_jawab" autocomplite="off"  />
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="poliklinik_keterangan" >Keterangan</label>
					<div class="controls">
					<textarea class="span8" cols="4" id="poliklinik_keterangan" name="poliklinik_keterangan"></textarea>
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