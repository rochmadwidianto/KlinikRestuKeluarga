<!-- 
================= doc ====================
 filename     : edit_petugas.php
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
	include_once('../../config/koneksi.php');
	require_once('class.petugas.php');
	require_once('../../config/fungsi_sqltgl.php');
	$petugas = new petugas($pdo);
	if(!empty($_POST['petugas_id'])){
		$param['petugas_id']			= $_POST['petugas_id'];
		$param['petugas_nomor']			= $_POST['petugas_nomor'];
		$param['petugas_nama'] 			= $_POST['petugas_nama'];
		$param['petugas_gender'] 		= $_POST['petugas_gender'];
		$param['petugas_agama'] 		= $_POST['petugas_agama'];
		$param['petugas_telp'] 			= $_POST['petugas_telp'];
		$param['petugas_jabatan'] 		= $_POST['petugas_jabatan'];
		$param['petugas_alamat']		= $_POST['petugas_alamat'];
		$param['petugas_keterangan'] 	= $_POST['petugas_keterangan'];
		$param['update_by'] 			= $_SESSION['s_user'];

		if($petugas->update($param)){
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
		<legend>Edit Petugas</legend>
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
		if(isset($_GET['petugas_id']))
		{
			$id = $_GET['petugas_id'];
			extract($petugas->getID($id));	
		} 
		?>
		</span>
		<div class="row-fluid">
			<div class="span9">
				<div style="display: none;" class="control-group">
				<label class="control-label" for="petugas_id" >ID</label>
					<div class="controls">
					<input type="text" id="petugas_id" name="petugas_id" value="<?php echo $petugas_id; ?>" readonly="readonly">
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="petugas_nomor" >NIP</label>
					<div class="controls">
					<input type="text" id="petugas_nomor" name="petugas_nomor" autocomplite="off" value="<?php echo $petugas_nomor; ?>" required />&nbsp;*
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="petugas_nama" >Nama</label>
					<div class="controls">
					<input type="text" class="span8" id="petugas_nama" name="petugas_nama" autocomplite="off" value="<?php echo $petugas_nama; ?>" required />&nbsp;*
					</div>
				</div>	
				<div class="control-group">
				<label class="control-label" for="petugas_jabatan" >Jabatan</label>
					<div class="controls">
					<input type="text" class="span8" id="petugas_jabatan" name="petugas_jabatan" autocomplite="off" value="<?php echo $petugas_jabatan; ?>" required />&nbsp;*
					</div>
				</div>	
				<div class="control-group">
					<label class="control-label">Jenis Kelamin</label>
					<div class="controls">
						<label>
							<input name="petugas_gender" type="radio" value="Laki - Laki" <?php echo ($petugas_gender=='Laki - Laki')?'checked':''; ?> />
							<span class="lbl"> Laki - Laki</span>
						</label>
						<label>
							<input name="petugas_gender" type="radio" value="Perempuan" <?php echo ($petugas_gender=='Perempuan')?'checked':''; ?> />
							<span class="lbl"> Perempuan</span>
						</label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Agama</label>
					<div class="controls">
						<select name="petugas_agama" id="petugas_agama" class="chzn-select" required >
							<option <?php echo ($petugas_agama=='Islam')?'selected':''; ?> value="Islam">Islam</option>
							<option <?php echo ($petugas_agama=='Kristen')?'selected':''; ?> value="Kristen">Kristen</option>
							<option <?php echo ($petugas_agama=='Katholik')?'selected':''; ?> value="Katholik">Katholik</option>
							<option <?php echo ($petugas_agama=='Hindu')?'selected':''; ?> value="Hindu">Hindu</option>
							<option <?php echo ($petugas_agama=='Budha')?'selected':''; ?> value="Budha">Budha</option>
						</select>&nbsp;*
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="petugas_telp" >Telp/HP</label>
					<div class="controls">
					<input type="text" id="petugas_telp" name="petugas_telp" class="sapn4" autocomplite="off" value="<?php echo $petugas_telp; ?>"  />
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="petugas_alamat" >Alamat</label>
					<div class="controls">
					<textarea class="span8" cols="3" id="petugas_alamat" name="petugas_alamat" value="<?php echo $petugas_alamat; ?>" ><?php echo $petugas_alamat; ?></textarea>
					</div>
				</div>	
				<div class="control-group">
				<label class="control-label" for="petugas_keterangan" >Keterangan</label>
					<div class="controls">
					<textarea class="span8" cols="4" id="petugas_keterangan" name="petugas_keterangan" value="<?php echo $petugas_keterangan; ?>" ><?php echo $petugas_keterangan; ?></textarea>
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