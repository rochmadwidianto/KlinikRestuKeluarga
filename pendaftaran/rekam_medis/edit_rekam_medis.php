<!-- 
================= doc ====================
 filename     : edit_rekam_medis.php
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
	include_once('../../config/koneksi.php');
	require_once('class.rekam_medis.php');
	require_once('../../config/fungsi_sqltgl.php');
	$rekam_medis = new rekam_medis($pdo);
	if(!empty($_POST['rekam_medis_id'])){
		$param['rekam_medis_id']			= $_POST['rekam_medis_id'];
		$param['rekam_medis_tanggal']		= tgl_sql($_POST['rekam_medis_tanggal']);
		$param['rekam_medis_nomor']			= $_POST['rekam_medis_nomor'];
		$param['rekam_medis_daftar_id']		= $_POST['rekam_medis_daftar_id'];
		$param['rekam_medis_alergi']		= $_POST['rekam_medis_alergi'];
		$param['rekam_medis_diagnosa']		= $_POST['rekam_medis_diagnosa'];
		$param['rekam_medis_terapi']		= $_POST['rekam_medis_terapi'];
		$param['update_by'] 			= $_SESSION['s_user'];

		if($rekam_medis->update($param)){
			$sg   = "ok";
			$msg1 = "<b>SUKSES!</b> Perubahan data berhasil dilakukan";
			$alert='alert-success';
		}else{
			$g = "err";
			$msg2 = "<b>GAGAL!</b> Perubahan data gagal dilakukan";
			$alert='alert-error';
		}
	}
?>

<form id="forms" method="post" onSubmit="return submitForm('<?php echo $_SERVER['PHP_SELF']; ?>')" class="form-horizontal">
		<legend>Edit Rekam Medis</legend>
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
        	?>
		<?php }elseif(isset($sg) and $sg=='err')
		{
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
		else
		{
		if(isset($_GET['rekam_medis_id']))
		{
			$id = $_GET['rekam_medis_id'];
			extract($rekam_medis->getID($id));	
		} 
		?>
		</span>
		<div class="row-fluid">
			<div class="span9">
				<div style="display: none;" class="control-group">
				<label class="control-label" for="rekam_medis_id" >ID</label>
					<div class="controls">
					<input type="text" id="rekam_medis_id" name="rekam_medis_id" value="<?php echo $rekam_medis_id; ?>" readonly="readonly">
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="rekam_medis_tanggal">Tanggal</label>
					<div class="controls" >								
						<input type="text" id="rekam_medis_tanggal" value="<?php echo tgl_sql1($rekam_medis_tanggal); ?>" name="rekam_medis_tanggal" class="tanggal span4" data-date-format="dd-mm-yyyy" />
						<i class="icon-calendar bigger-120"></i>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="rekam_medis_nomor" >Nomor RM</label>
					<div class="controls">
					<input type="text" id="rekam_medis_nomor" class="span6" style="font-weight: bold;" name="rekam_medis_nomor" value="<?php echo $rekam_medis_nomor; ?>" readonly autocomplite="off" required />&nbsp;*
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="rekam_medis_daftar_id" > Pasien</label>
					<div class="controls">
					<select name="rekam_medis_daftar_id" id="rekam_medis_daftar_id" class="chzn-select" data-placeholder="Pilih Pasien" required>&nbsp;*
						<option value="<?php echo $rekam_medis_daftar_id; ?>"><?php echo $pasien_nomor.' - ' .$pasien_nama; ?></option>						
						<?php					
							$query = "SELECT * FROM v_daftar";
							$rekam_medis->select_pasien_daftar($query);						
						?>
					</select>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="rekam_medis_alergi" >Alergi Obat</label>
					<div class="controls">
					<textarea class="span10" cols="3" id="rekam_medis_alergi" name="rekam_medis_alergi" value="<?php echo $rekam_medis_alergi; ?>" ><?php echo $rekam_medis_alergi ?></textarea>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="rekam_medis_diagnosa" >Anamnese/Diagnosa</label>
					<div class="controls">
					<textarea class="span10" cols="3" id="rekam_medis_diagnosa" name="rekam_medis_diagnosa" value="<?php echo $rekam_medis_diagnosa; ?>" ><?php echo $rekam_medis_diagnosa ?></textarea>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="rekam_medis_terapi" >Terapi</label>
					<div class="controls">
					<textarea class="span10" cols="3" id="rekam_medis_terapi" name="rekam_medis_terapi" value="<?php echo $rekam_medis_terapi; ?>" ><?php echo $rekam_medis_terapi ?></textarea>
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
		<?php 
		}
		?>		
</form>
<script type="text/javascript">
	
	$(document).ready(function(){
		$("#close").click(function(){
			$("#form-nest").hide("slow");
		});
		$(".chzn-select").chosen();
	});
	
	$('.date-picker').datepicker().next().on(ace.click_event, function(){
		$(this).prev().focus();
	});
	$(".chzn-select").chosen();
	$(".tanggal").datepicker({
			dateFormat: "yyyy-mm-dd",
            changeMonth: true,
            changeYear: true,
			yearRange: '1970:2050',
			autoclose: true,
			todayHighlight: true,
	});
	
	$(document).ready(function(){
		$("#close").click(function(){
			$("#form-nest").hide("slow");
		});
	});	
</script>