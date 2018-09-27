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

	$get_pasien_nomor 	= $rekam_medis->getPasienNomor($_POST['rekam_medis_daftar_id']);
	$generate_number 	= $rekam_medis->generateNumber($get_pasien_nomor['pasien_nomor']);

	$param['rekam_medis_tanggal']		= tgl_sql($_POST['rekam_medis_tanggal']);
	$param['rekam_medis_nomor']			= $generate_number['generate_nomor_rm'];
	$param['rekam_medis_daftar_id']		= $_POST['rekam_medis_daftar_id'];
	$param['rekam_medis_alergi']		= $_POST['rekam_medis_alergi'];
	$param['rekam_medis_diagnosa']		= $_POST['rekam_medis_diagnosa'];
	$param['rekam_medis_terapi']		= $_POST['rekam_medis_terapi'];
	$param['created_by'] 				= $_SESSION['s_user'];

	$update_status_rm 	= $rekam_medis->update_status_rm($param['rekam_medis_daftar_id'], $param['created_by']);
	$create 			= $rekam_medis->create($param);

	if($create){
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
		<legend>Tambah Rekam Medis</legend>
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
				<label class="control-label" for="rekam_medis_tanggal">Tanggal</label>
					<div class="controls" >								
						<input type="text" id="rekam_medis_tanggal" class="tanggal span4" value="<?php echo date('d-m-Y'); ?>" required name="rekam_medis_tanggal" data-date-format="dd-mm-yyyy" />
						<i class="icon-calendar bigger-120"></i>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="rekam_medis_nomor" >No Rekam Medis</label>
					<div class="controls">
					<label><b><i>-- Auto Number --</i></b></label>
					</div>
				</div>
				<div style="display: none;" class="control-group">
					<label class="control-label" for="rekam_medis_pasien_id" >Pasien</label>
					<div class="controls">
	                	<a href="javascript:void(0)" onclick="popupPasien()" class="btn btn-small btn-info" ><i class="icon-plus icon-white"></i>Pilih Pasien</a>&nbsp;*
	                	<input type="text" id="rekam_medis_pasien_id" class="span4" name="rekam_medis_pasien_id" autocomplite="off" />
	                	<input type="text" id="rekam_medis_pasien_kode" class="span4" name="rekam_medis_pasien_kode" autocomplite="off" />
	                	<input type="text" id="rekam_medis_pasien_nama" class="span4" name="rekam_medis_pasien_nama" autocomplite="off" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="rekam_medis_daftar_id" >Pasien</label>
					<div class="controls">
					<select name="rekam_medis_daftar_id" id="rekam_medis_daftar_id" class="chzn-select" data-placeholder="Pilih Pasien" required>
						<option value="">-- Pilih Pasien --</option>	
						<?php					
							$query = "SELECT * FROM v_daftar WHERE daftar_is_periksa = 'Tidak' AND daftar_id NOT IN (SELECT rekam_medis_daftar_id FROM rekam_medis) ";
							$rekam_medis->select_pasien_daftar($query);						
						?>
					</select>&nbsp;*
					</div>
				</div>
				<div style="display: none;" class="control-group">
				<label class="control-label" for="rekam_medis_keluhan" >Keluhan</label>
					<div class="controls">
					<textarea class="span10" cols="3" id="rekam_medis_keluhan" name="rekam_medis_keluhan"></textarea>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="rekam_medis_alergi" >Alergi Obat</label>
					<div class="controls">
					<textarea class="span10" cols="3" id="rekam_medis_alergi" name="rekam_medis_alergi"></textarea>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="rekam_medis_diagnosa" >Anamnese/Diagnosa</label>
					<div class="controls">
					<textarea class="span10" cols="4" id="rekam_medis_diagnosa" name="rekam_medis_diagnosa"></textarea>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="rekam_medis_terapi" >Terapi</label>
					<div class="controls">
					<textarea class="span10" cols="4" id="rekam_medis_terapi" name="rekam_medis_terapi"></textarea>
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

	function selectPasien(id, kode, nama){
		document.getElementById('pasien_id').value = id;
		document.getElementById('pasien_kode').value = kode;
		document.getElementById('pasien_nama').value = nama;
	}
</script>