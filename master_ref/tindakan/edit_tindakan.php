<!-- 
================= doc ====================
 filename     : edit_tindakan.php
 @package     : tindakan
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
	include_once('../../config/koneksi.php');
	require_once('class.tindakan.php');
	require_once('../../config/fungsi_sqltgl.php');
	$tindakan = new tindakan($pdo);
	if(!empty($_POST['tindakan_id'])){
		$param['tindakan_id']		= $_POST['tindakan_id'];
		$param['tindakan_kode']		= $_POST['tindakan_kode'];
		$param['tindakan_nama'] 		= $_POST['tindakan_nama'];
		$param['update_by'] 		= $_SESSION['s_user'];

		if($tindakan->update($param)){
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
		<legend>Edit Tindakan</legend>
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
		if(isset($_GET['tindakan_id']))
		{
			$id = $_GET['tindakan_id'];
			extract($tindakan->getID($id));	
		} 
		?>
		</span>
		<div class="row-fluid">
			<div class="span9">
				<div style="display: none;" class="control-group">
				<label class="control-label" for="tindakan_id" >ID</label>
					<div class="controls">
					<input type="text" id="tindakan_id" name="tindakan_id" value="<?php echo $tindakan_id; ?>" readonly="readonly">
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="tindakan_kode" >Kode</label>
					<div class="controls">
					<input type="text" id="tindakan_kode" name="tindakan_kode" autocomplite="off" value="<?php echo $tindakan_kode; ?>" required  />&nbsp;*
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="tindakan_nama" >Nama</label>
					<div class="controls">
					<input type="text" class="span8" id="tindakan_nama" name="tindakan_nama" autocomplite="off" value="<?php echo $tindakan_nama; ?>" required />&nbsp;*
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