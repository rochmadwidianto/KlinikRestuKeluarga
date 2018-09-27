<!-- 
================= doc ====================
 filename     : edit_daftar.php
 @package     : daftar
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
	require_once('class.daftar.php');
	require_once('../../config/fungsi_sqltgl.php');
	$daftar = new daftar($pdo);
	if(!empty($_POST['daftar_id'])){
		$param['daftar_id']				= $_POST['daftar_id'];
		$param['daftar_tanggal']		= tgl_sql($_POST['daftar_tanggal']);
		$param['daftar_tindakan_id']	= $_POST['daftar_tindakan_id'];
		$param['daftar_layanan_id']		= $_POST['daftar_layanan_id'];
		$param['daftar_poliklinik_id']	= $_POST['daftar_poliklinik_id'];
		$param['daftar_pasien_id']		= $_POST['daftar_pasien_id'];
		$param['daftar_keluhan']		= $_POST['daftar_keluhan'];
		$param['update_by'] 			= $_SESSION['s_user'];

		if($daftar->update($param)){
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
		<legend>Edit Pendaftaran</legend>
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
		if(isset($_GET['daftar_id']))
		{
			$id = $_GET['daftar_id'];
			extract($daftar->getID($id));	
		} 
		?>
		</span>
		<div class="row-fluid">
			<div class="span9">
				<div style="display: none;" class="control-group">
				<label class="control-label" for="daftar_id" >ID</label>
					<div class="controls">
					<input type="text" id="daftar_id" name="daftar_id" value="<?php echo $daftar_id; ?>" readonly="readonly">
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="daftar_tanggal">Tanggal</label>
					<div class="controls" >								
						<input type="text" id="daftar_tanggal" value="<?php echo tgl_sql1($daftar_tanggal); ?>" name="daftar_tanggal" class="tanggal span4" data-date-format="dd-mm-yyyy" />
						<i class="icon-calendar bigger-120"></i>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="daftar_tindakan_id" > Tindakan</label>
					<div class="controls">
					<select name="daftar_tindakan_id" id="daftar_tindakan_id" class="chzn-select" data-placeholder="Pilih Tindakan" required>
						<option value="<?php echo $daftar_tindakan_id; ?>"><?php echo $tindakan_nama; ?></option>						
						<?php					
							$query = "SELECT * FROM tindakan ";
							$daftar->select_tindakan($query);						
						?>
					</select>&nbsp;*
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="daftar_layanan_id" > Janis Layanan</label>
					<div class="controls">
					<select name="daftar_layanan_id" id="daftar_layanan_id" class="chzn-select" data-placeholder="Pilih Jenis Layanan" required>
						<option value="<?php echo $daftar_layanan_id; ?>"><?php echo $layanan_nama; ?></option>						
						<?php					
							$query = "SELECT * FROM layanan ";
							$daftar->select_layanan($query);						
						?>
					</select>&nbsp;*
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="daftar_poliklinik_id" > Poliklinik</label>
					<div class="controls">
					<select name="daftar_poliklinik_id" id="daftar_poliklinik_id" class="chzn-select" data-placeholder="Pilih Poliklinik" required>
						<option value="<?php echo $daftar_poliklinik_id; ?>"><?php echo $poliklinik_nama; ?></option>						
						<?php					
							$query = "SELECT * FROM poliklinik ";
							$daftar->select_poliklinik($query);						
						?>
					</select>&nbsp;*
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="daftar_pasien_id" > Pasien</label>
					<div class="controls">
					<select name="daftar_pasien_id" id="daftar_pasien_id" class="chzn-select" data-placeholder="Pilih Pasien" required>
						<option value="<?php echo $daftar_pasien_id; ?>"><?php echo $pasien_nomor.' - ' .$pasien_nama; ?></option>						
						<?php					
							$query = "SELECT * FROM pasien ";
							$daftar->select_pasien($query);						
						?>
					</select>&nbsp;*
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="daftar_keluhan" >Keluhan</label>
					<div class="controls">
					<textarea class="span10" cols="3" id="daftar_keluhan" name="daftar_keluhan" value="<?php echo $daftar_keluhan; ?>" ><?php echo $daftar_keluhan; ?></textarea>
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