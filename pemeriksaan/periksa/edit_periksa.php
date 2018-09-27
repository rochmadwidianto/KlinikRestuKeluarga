<!-- 
================= doc ====================
 filename     : edit_periksa.php
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
	include_once('../../config/koneksi.php');
	require_once('class.periksa.php');
	require_once('../../config/fungsi_sqltgl.php');
	$periksa = new periksa($pdo);
	if(!empty($_POST['periksa_rekam_medis_id'])){
		$param['periksa_daftar_id']			= $_POST['periksa_daftar_id'];
		$param['periksa_rekam_medis_id']	= $_POST['periksa_rekam_medis_id'];
		$param['status_periksa']			= 'Ya';
		$param['periksa_terapi']			= $_POST['periksa_terapi'];
		$param['periksa_tanggal']			= tgl_sql($_POST['periksa_tanggal']);
		$param['periksa_hasil']				= $_POST['periksa_hasil'];
		$param['periksa_catatan']			= $_POST['periksa_catatan'];
		$param['created_by'] 				= $_SESSION['s_user'];

		$create_periksa 	= $periksa->create($param);
		$update_rekam_medis = $periksa->update_rm($param);
		$update_daftar 		= $periksa->update_daftar($param);

		if($create_periksa && $update_rekam_medis && $update_daftar){
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
		<legend>Tindakan Pemeriksaan</legend>
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
			extract($periksa->getID($id));	
		} 
		?>
		</span>
		<div class="row-fluid">
			<div class="span5">
				<div style="display: none;" class="control-group">
				<label class="control-label" for="periksa_rekam_medis_id" >ID</label>
					<div class="controls">
					<input type="text" id="periksa_rekam_medis_id" name="periksa_rekam_medis_id" value="<?php echo $rekam_medis_id; ?>" readonly="readonly">
					</div>
				</div>
				<div style="display: none;" class="control-group">
				<label class="control-label" for="periksa_daftar_id" >ID</label>
					<div class="controls">
					<input type="text" id="periksa_daftar_id" name="periksa_daftar_id" value="<?php echo $daftar_id; ?>" readonly="readonly">
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="periksa_tanggal">Tanggal</label>
					<div class="controls" >								
						<input type="text" style="font-weight: bold;" id="periksa_tanggal" value="<?php echo tgl_sql1(date('Y-m-d')); ?>" name="periksa_tanggal" class="tanggal span6" data-date-format="dd-mm-yyyy" />
						<i class="icon-calendar bigger-120"></i>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="rekam_medis_nomor" >Nomor RM</label>
					<div class="controls">
					<label class="span12"><b><?php echo $rekam_medis_nomor; ?></b></label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="pasien_id" > Pasien</label>
					<div class="controls">
					<label class="span12"><b><?php echo $pasien_nomor.' - ' .$pasien_nama; ?></b></label>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="periksa_alergi" >Alergi Obat</label>
					<div class="controls">
					<label class="span12"><b><?php echo $rekam_medis_alergi; ?></b></label>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="periksa_keluhan" >Keluhan</label>
					<div class="controls">
					<label class="span12"><b><?php echo $daftar_keluhan; ?></b></label>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="periksa_diagnosa" >Anamnese/Diagnosa</label>
					<div class="controls">
					<label class="span12"><b><?php echo $rekam_medis_diagnosa; ?></b></label>
					</div>
				</div>
			</div>
			<div class="span7">
				<div class="control-group">
				<label class="control-label" for="periksa_terapi" >Terapi</label>
					<div class="controls">
					<textarea class="span12" rows="2" cols="3" id="periksa_terapi" name="periksa_terapi" value="<?php echo $rekam_medis_terapi; ?>" required ><?php echo $rekam_medis_terapi ?></textarea>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="periksa_hasil" >Hasil Pemeriksaan</label>
					<div class="controls">
					<textarea class="span12" rows="2" cols="4" id="periksa_hasil" name="periksa_hasil"></textarea>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="periksa_catatan" >Tindakan Pemeriksaan</label>
					<div class="controls">
					<textarea class="span12" rows="2" cols="4" id="periksa_catatan" name="periksa_catatan"></textarea>
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