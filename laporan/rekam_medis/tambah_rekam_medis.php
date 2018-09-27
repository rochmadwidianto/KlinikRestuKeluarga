<!-- 
================= doc ====================
 filename     : tambah_rekam_medis.php
 @package     : rekam_medis
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-10-14
 @Modified    : 2017-10-14
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php
session_start();
require_once('../../config/koneksi.php');
require_once('class.rekam_medis.php');
require_once('../../config/fungsi_sqltgl.php');

$rekam_medis = new rekam_medis($pdo);

if(!empty($_POST['rekam_medis_daftar_id'])){
	$param['rekam_medis_tanggal']		= tgl_sql($_POST['rekam_medis_tanggal']);
	$param['rekam_medis_nomor']			= $_POST['rekam_medis_nomor'];
	$param['rekam_medis_daftar_id']		= $_POST['rekam_medis_daftar_id'];
	$param['rekam_medis_alergi']		= $_POST['rekam_medis_alergi'];
	$param['rekam_medis_diagnosa']		= $_POST['rekam_medis_diagnosa'];
	$param['rekam_medis_terapi']		= $_POST['rekam_medis_terapi'];
	$param['created_by'] 				= $_SESSION['s_user'];

	if($rekam_medis->create($param)){
		$sg   = "ok";
		$msg1 = "Data telah ditambahkan";
		$alert='alert-success';
	}else{
		$g = "err";
		$msg2 = "Data tidak bisa dimasukan";
		$alert='alert-error';
	}
}
?>

<form id="forms" method="post" onSubmit="return submitForm('<?php echo $_SERVER['PHP_SELF']; ?>')" class="form-horizontal">
	<fieldset>
		<legend>Tambah Rekam Medis</legend>
		<span>
		 <?php
		if(isset($sg) and $sg=='ok'){
			echo "
			<div class='alert $alert'>
			<button type='button' class='close' data-dismiss='alert'>&times;</button>
			$msg1
			</div>";
		}elseif(isset($sg) and $sg=='err'){
			echo "
			<div class='alert $alert'>
			<button type='button' class='close' data-dismiss='alert'>&times;</button>
			$msg2
			</div>";}
		?>
		</span>
		<div class="row-fluid">
			<div class="span9">
				<div class="control-group">
				<label class="control-label" for="rekam_medis_tanggal">Tanggal</label>
					<div class="controls" >								
						<input type="text" id="rekam_medis_tanggal" class="tanggal span4" value="<?php echo date('d-m-Y'); ?>" required name="rekam_medis_tanggal" data-date-format="dd-mm-yyyy" />
						<i class="icon-calendar bigger-120"></i>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="rekam_medis_nomor" >No Rekam Medis</label>
					<div class="controls">
					<input type="text" id="rekam_medis_nomor" class="span4" name="rekam_medis_nomor" autocomplite="off" required autofocus />&nbsp;*
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="rekam_medis_daftar_id" >Pasien</label>
					<div class="controls">
					<select name="rekam_medis_daftar_id" id="rekam_medis_daftar_id" class="span10" data-placeholder="Pilih Pasien" required>
						<option value="">-- Pilih Pasien --</option>	
						<?php					
							$query = "SELECT * FROM v_daftar WHERE daftar_is_periksa = 'Tidak' ";
							$rekam_medis->select_pasien_daftar($query);						
						?>
					</select>&nbsp;*
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="rekam_medis_alergi" >Alergi Obat</label>
					<div class="controls">
					<textarea class="span10" cols="4" id="rekam_medis_alergi" name="rekam_medis_alergi"></textarea>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="rekam_medis_keluhan" >Keluhan</label>
					<div class="controls">
					<textarea class="span10" cols="4" id="rekam_medis_keluhan" name="rekam_medis_keluhan"></textarea>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="rekam_medis_diagnosa" >Anamnese/Diagnosa</label>
					<div class="controls">
					<textarea class="span10" rows="5" cols="4" id="rekam_medis_diagnosa" name="rekam_medis_diagnosa"></textarea>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="rekam_medis_terapi" >Terapi</label>
					<div class="controls">
					<textarea class="span10" rows="5" cols="4" id="rekam_medis_terapi" name="rekam_medis_terapi"></textarea>
					</div>
				</div>
			</div>						
		</div>
		<div class="form-actions">
		<div class="span5"></div>
			<div class="span6">
				<div class="controls-group">
				<button type="submit" class="btn btn-success">Simpan</button>
				<button type="button" id="close" class="btn btn-danger" >Batal</button>
				</div>
			</div>
		</div>
		
	</fieldset>
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