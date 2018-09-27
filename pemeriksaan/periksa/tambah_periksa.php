<!-- 
================= doc ====================
 filename     : tambah_periksa.php
 @package     : periksa
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-10-15
 @Modified    : 2017-10-15
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php
session_start();
require_once('../../config/koneksi.php');
require_once('class.periksa.php');
require_once('../../config/fungsi_sqltgl.php');

$periksa = new periksa($pdo);

if(!empty($_POST['periksa_daftar_id'])){
	$param['periksa_tanggal']		= tgl_sql($_POST['periksa_tanggal']);
	$param['periksa_nomor']			= $_POST['periksa_nomor'];
	$param['periksa_daftar_id']		= $_POST['periksa_daftar_id'];
	$param['periksa_diagnosa']		= $_POST['periksa_diagnosa'];
	$param['periksa_terapi']		= $_POST['periksa_terapi'];
	$param['created_by'] 				= $_SESSION['s_user'];

	if($periksa->create($param)){
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
		<legend>Tambah Pemeriksaan</legend>
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
				<label class="control-label" for="periksa_tanggal">Tanggal</label>
					<div class="controls" >								
						<input type="text" id="periksa_tanggal" class="tanggal span4" value="<?php echo date('d-m-Y'); ?>" required name="periksa_tanggal" data-date-format="dd-mm-yyyy" />
						<i class="icon-calendar bigger-120"></i>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="periksa_nomor" >Nomor RM</label>
					<div class="controls">
					<input type="text" id="periksa_nomor" class="span4" name="periksa_nomor" autocomplite="off" required autofocus />&nbsp;*
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="periksa_daftar_id" >Pasien</label>
					<div class="controls">
					<select name="periksa_daftar_id" id="periksa_daftar_id" class="span10" data-placeholder="Pilih Pasien" required>
						<option value="">-- Pilih Pasien --</option>	
						<?php					
							$query = "SELECT * FROM v_daftar WHERE daftar_is_periksa = 'Tidak' ";
							$periksa->select_pasien_daftar($query);						
						?>
					</select>&nbsp;*
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="periksa_keluhan" >Keluhan</label>
					<div class="controls">
					<textarea class="span10" cols="4" id="periksa_keluhan" name="periksa_keluhan"></textarea>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="periksa_diagnosa" >Anamnese/Diagnosa</label>
					<div class="controls">
					<textarea class="span10" rows="5" cols="4" id="periksa_diagnosa" name="periksa_diagnosa"></textarea>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="periksa_terapi" >Terapi</label>
					<div class="controls">
					<textarea class="span10" rows="5" cols="4" id="periksa_terapi" name="periksa_terapi"></textarea>
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