<!-- 
================= doc ====================
 filename     : tambah_petugas.php
 @package     : petugas
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
require_once('class.petugas.php');
require_once('../../config/fungsi_sqltgl.php');

$petugas = new petugas($pdo);

if(!empty($_POST['petugas_nomor'])){
	$param['petugas_nomor']			= $_POST['petugas_nomor'];
	$param['petugas_nama'] 			= $_POST['petugas_nama'];
	$param['petugas_gender'] 		= $_POST['petugas_gender'];
	$param['petugas_agama'] 		= $_POST['petugas_agama'];
	$param['petugas_telp'] 			= $_POST['petugas_telp'];
	$param['petugas_jabatan'] 		= $_POST['petugas_jabatan'];
	$param['petugas_alamat']		= $_POST['petugas_alamat'];
	$param['petugas_keterangan'] 	= $_POST['petugas_keterangan'];
	$param['created_by'] 			= $_SESSION['s_user'];

	if($petugas->create($param)){
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
		<legend>Tambah Petugas</legend>
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
				<label class="control-label" for="petugas_nomor" >NIP</label>
					<div class="controls">
					<input type="text" id="petugas_nomor" name="petugas_nomor" autocomplite="off" required autofocus />&nbsp;*
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="petugas_nama" >Nama</label>
					<div class="controls">
					<input type="text" class="span8" id="petugas_nama" name="petugas_nama" autocomplite="off" required autofocus />&nbsp;*
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="petugas_jabatan" >Jabatan</label>
					<div class="controls">
					<input type="text" class="span8" id="petugas_jabatan" name="petugas_jabatan" autocomplite="off" required autofocus />&nbsp;*
					</div>
				</div>
				<div class="control-group">
				<label class="control-label">Jenis Kelamin</label>
					<div class="controls">
						<label>
							<input name="petugas_gender" type="radio" value="Laki - Laki" checked />
							<span class="lbl"> Laki - Laki</span>
						</label>
						<label>
							<input name="petugas_gender" type="radio" value="Perempuan" />
							<span class="lbl"> Perempuan</span>
						</label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Agama</label>
					<div class="controls">
						<select name="petugas_agama" id="petugas_agama" class="chzn-select" required >
							<option value="Islam">Islam</option>
							<option value="Kristen">Kristen</option>
							<option value="Katholik">Katholik</option>
							<option value="Hindu">Hindu</option>
							<option value="Budha">Budha</option>
						</select>&nbsp;*
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="petugas_telp" >Telp/HP</label>
					<div class="controls">
					<input type="text" id="petugas_telp" name="petugas_telp" class="span4" autocomplite="off" />
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="petugas_alamat" >Alamat</label>
					<div class="controls">
					<textarea class="span8" cols="4" id="petugas_alamat" name="petugas_alamat"></textarea>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="petugas_keterangan" >Keterangan</label>
					<div class="controls">
					<textarea class="span8" cols="4" id="petugas_keterangan" name="petugas_keterangan"></textarea>
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
		$(".chzn-select").chosen();
	});
	
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