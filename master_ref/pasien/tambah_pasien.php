<!-- 
================= doc ====================
 filename     : tambah_pasien.php
 @package     : pasien
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-10-12
 @Modified    : 2017-10-12
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php
session_start();
require_once('../../config/koneksi.php');
require_once('class.pasien.php');
require_once('../../config/fungsi_sqltgl.php');

$pasien = new pasien($pdo);

/* Generate Number Pasien */
$query = "SELECT MAX(pasien_nomor) AS pasien_nomor FROM pasien LIMIT 0, 1";
extract($pasien->generate_number($query));

if($pasien_nomor == ''){
	$pasien_nomor = '000001';
}else{
	$lenght 	= strlen(intval($pasien_nomor));
	switch($lenght){
		case 1: $pasien_nomor = '00000'.($pasien_nomor+1); break;
		case 2: $pasien_nomor = '0000'.($pasien_nomor+1); break;
		case 3: $pasien_nomor = '000'.($pasien_nomor+1); break;
		case 4: $pasien_nomor = '00'.($pasien_nomor+1); break;
		case 5: $pasien_nomor = '0'.($pasien_nomor+1); break;
		case 6: $pasien_nomor = ($pasien_nomor+1); break;
	}
}

/* END - Generate Number Pasien */

if(!empty($_POST['pasien_nomor'])){
	$param['pasien_nomor']			= $_POST['pasien_nomor'];
	$param['pasien_nama'] 			= $_POST['pasien_nama'];
	$param['pasien_gender'] 		= $_POST['pasien_gender'];
	$param['pasien_agama'] 			= $_POST['pasien_agama'];
	$param['pasien_telp'] 			= $_POST['pasien_telp'];
	$param['pasien_tanggal_lahir'] 	= tgl_sql($_POST['pasien_tanggal_lahir']);
	$param['pasien_umur'] 			= $_POST['pasien_umur'];
	$param['pasien_alamat']			= $_POST['pasien_alamat'];
	$param['pasien_keterangan'] 	= $_POST['pasien_keterangan'];
	$param['created_by'] 			= $_SESSION['s_user'];

	if($pasien->create($param)){
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
		<legend>Tambah Pasien</legend>
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
				<label class="control-label" for="pasien_nomor" >Nomor</label>
					<div class="controls">
					<input type="text" id="pasien_nomor" name="pasien_nomor" value="<?php echo $pasien_nomor; ?>" style="font-weight: bold" autocomplite="off" required readonly />
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="pasien_nama" >Nama</label>
					<div class="controls">
					<input type="text" class="span8" id="pasien_nama" name="pasien_nama" autocomplite="off" required autofocus />&nbsp;*
					</div>
				</div>
				<div class="control-group">
				<label class="control-label">Jenis Kelamin</label>
					<div class="controls">
						<label>
							<input name="pasien_gender" type="radio" value="Laki - Laki" checked />
							<span class="lbl"> Laki - Laki</span>
						</label>
						<label>
							<input name="pasien_gender" type="radio" value="Perempuan" />
							<span class="lbl"> Perempuan</span>
						</label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Agama</label>
					<div class="controls">
						<select name="pasien_agama" id="pasien_agama" class="chzn-select" required >
							<option value="Islam">Islam</option>
							<option value="Kristen">Kristen</option>
							<option value="Katholik">Katholik</option>
							<option value="Hindu">Hindu</option>
							<option value="Budha">Budha</option>
						</select>&nbsp;*
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="pasien_telp" >Telp/HP</label>
					<div class="controls">
					<input type="text" id="pasien_telp" name="pasien_telp" class="span4" autocomplite="off" />
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="pasien_umur" >Umur</label>
					<div class="controls">
					<input type="text" id="pasien_umur" name="pasien_umur" class="span4" autocomplite="off" />
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="pasien_tanggal_lahir">Tanggal Lahir</label>
					<div class="controls" >								
						<input type="text" id="pasien_tanggal_lahir" class="tanggal span4" value="<?php echo date('d-m-Y'); ?>" name="pasien_tanggal_lahir" data-date-format="dd-mm-yyyy" />
						<i class="icon-calendar bigger-120"></i>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="pasien_alamat" >Alamat</label>
					<div class="controls">
					<textarea class="span8" cols="4" id="pasien_alamat" name="pasien_alamat"></textarea>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="pasien_keterangan" >Keterangan</label>
					<div class="controls">
					<textarea class="span8" cols="4" id="pasien_keterangan" name="pasien_keterangan"></textarea>
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