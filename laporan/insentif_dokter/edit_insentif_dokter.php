<!-- 
================= doc ====================
 filename     : edit_insentif_dokter.php
 @package     : insentif_dokter
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-10-18
 @Modified    : 2017-10-18
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php 
	session_start();
	include_once('../../config/koneksi.php');
	require_once('class.insentif_dokter.php');
	require_once('../../config/fungsi_sqltgl.php');
	$insentif_dokter = new insentif_dokter($pdo);
	if(!empty($_POST['insentif_dokter_rekam_medis_id'])){
		$param['insentif_dokter_daftar_id']		= $_POST['insentif_dokter_daftar_id'];
		$param['insentif_dokter_rekam_medis_id']	= $_POST['insentif_dokter_rekam_medis_id'];
		$param['insentif_dokter_pasien_id']		= $_POST['insentif_dokter_pasien_id'];
		$param['status_insentif_dokter']			= 'Ya';
		$param['insentif_dokter_biaya']			= str_replace('.', '', $_POST['insentif_dokter_biaya']);
		$param['insentif_dokter_tanggal']			= tgl_sql($_POST['insentif_dokter_tanggal']);
		$param['created_by'] 			= $_SESSION['s_user'];

		$create_insentif_dokter 		= $insentif_dokter->create($param);
		$update_daftar 		= $insentif_dokter->update_daftar($param);

		if($create_insentif_dokter && $update_daftar){
			$sg   = "ok";
			$msg1 = "Data Berhasil Disimpan";
			$alert='alert-success';
		}else{
			$g = "err";
			$msg2 = "Data Gagal Disimpan";
			$alert='alert-error';
		}
	}
?>

<form id="forms" method="post" onSubmit="return submitForm('<?php echo $_SERVER['PHP_SELF']; ?>')" class="form-horizontal">
	<fieldset>
		<legend>Insentif Dokter</legend>
		<span>
		<?php
		if(isset($sg) and $sg=='ok'){
			echo "
			<div class='alert $alert'>
			<button type='button' class='close' data-dismiss='alert'>&times;</button>
			$msg1
			</div>";
        	?>
        <div class="form-actions">
			<div class="controls">
				<button type="button" id="close" class="btn btn-primary" >Tutup</button>
			</div>
		</div>
		<?php }elseif(isset($sg) and $sg=='err')
		{
			echo "
			<div class='alert $alert'>
			<button type='button' class='close' data-dismiss='alert'>&times;</button>
			$msg2
			</div>"; 
		}
		else
		{
		if(isset($_GET['rekam_medis_id']))
		{
			$id = $_GET['rekam_medis_id'];
			extract($insentif_dokter->getID($id));	
		} 
		?>
		</span>
		<div class="row-fluid">
			<div class="span9">
				<div style="display: none;" class="control-group">
				<label class="control-label" for="insentif_dokter_daftar_id" >ID</label>
					<div class="controls">
					<input type="text" id="insentif_dokter_daftar_id" name="insentif_dokter_daftar_id" value="<?php echo $daftar_id; ?>" readonly="readonly">
					</div>
				</div>
				<div style="display: none;" class="control-group">
				<label class="control-label" for="insentif_dokter_rekam_medis_id" >ID</label>
					<div class="controls">
					<input type="text" id="insentif_dokter_rekam_medis_id" name="insentif_dokter_rekam_medis_id" value="<?php echo $rekam_medis_id; ?>" readonly="readonly">
					</div>
				</div>
				<div style="display: none;" class="control-group">
				<label class="control-label" for="insentif_dokter_pasien_id" >ID</label>
					<div class="controls">
					<input type="text" id="insentif_dokter_pasien_id" name="insentif_dokter_pasien_id" value="<?php echo $pasien_id; ?>" readonly="readonly">
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="insentif_dokter_tanggal">Tanggal</label>
					<div class="controls" >								
						<input type="text" style="font-weight: bold;" id="insentif_dokter_tanggal" value="<?php echo tgl_sql1(date('Y-m-d')); ?>" name="insentif_dokter_tanggal" class="tanggal span4" data-date-format="dd-mm-yyyy" />
						<i class="icon-calendar bigger-120"></i>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="rekam_medis_nomor" >No Rekam Medis</label>
					<div class="controls">
					<label class="span10"><b><?php echo $rekam_medis_nomor; ?></b></label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="pasien_id" > Pasien</label>
					<div class="controls">
					<label class="span10"><b><?php echo $pasien_nomor.' - ' .$pasien_nama; ?></b></label>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="insentif_dokter_diagnosa" >Anamnese/Diagnosa</label>
					<div class="controls">
					<label class="span10"><b><?php echo $rekam_medis_diagnosa; ?></b></label>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="insentif_dokter_terapi" >Terapi</label>
					<div class="controls">
					<label class="span10"><b><?php echo $rekam_medis_terapi; ?></b></label>
					</div>
				</div>
				<br>
				<div class="control-group">
				<label class="control-label" for="insentif_dokter_biaya" style="font-size: 34pt;" ><b>Rp </b></label>
					<div class="controls">
					<textarea class="span10" style="font-weight: bold; font-size: 34pt; padding-top: 20px; padding-bottom: 5px; resize: none;" rows="1" cols="2" id="insentif_dokter_biaya" name="insentif_dokter_biaya" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" required></textarea>
					</div>
				</div>
			</div>							
		</div>
		<div class="form-actions">
			<div class="span5">
			<div style="display: none;" class="control-group">
				<label style="display: none;" class="control">Data Input :<?php echo "$created_by"; echo " - "; echo "$created_at"; ?> </label>
				<label style="display: none;" class="control">Data Update :<?php echo "$update_by"; echo " - "; echo "$update_at"; ?> </label>
			</div>
			</div>
			<div class="span6">
				<div class="controls-group">
				<button type="submit" class="btn btn-success">Simpan</button>
				<button type="button" id="close" class="btn btn-danger" >Batal</button>
				</div>
			</div>
		<?php 
		}
		?>		
	</fieldset>
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

	function tandaPemisahTitik(b){
		var _minus = false;
		if (b < 0) _minus = true;
		b = b.toString();
		b = b.replace(".","");
		b = b.replace("-","");
		c = "";
		panjang = b.length;
		j = 0;
		for (i = panjang; i > 0; i--){
			j = j + 1;
			if (((j % 3) == 1) && (j != 1)){
				c = b.substr(i-1,1) + "." + c;
			} else {
				c = b.substr(i-1,1) + c;
			}
		}

		if (_minus) c = "-" + c ;
		return c;
	}

	function numbersonly(ini, e){
		if (e.keyCode >= 49){
			if(e.keyCode <= 57){
				a = ini.value.toString().replace(".","");
				b = a.replace(/[^\d]/g,"");
				b = (b == "0")?String.fromCharCode(e.keyCode):b + String.fromCharCode(e.keyCode);
				ini.value = tandaPemisahTitik(b);
				return false;
			}
			else if(e.keyCode <= 105){
				if(e.keyCode >= 96){
				//e.keycode = e.keycode - 47;
				a = ini.value.toString().replace(".","");
				b = a.replace(/[^\d]/g,"");
				b = (b == "0")?String.fromCharCode(e.keyCode-48):b + String.fromCharCode(e.keyCode-48);
				ini.value = tandaPemisahTitik(b);
				//alert(e.keycode);
				return false;
				}
				else {return false;}
			}
			else {
				return false; 
			}
		}else if (e.keyCode == 48){
			a = ini.value.replace(".","") + String.fromCharCode(e.keyCode);
			b = a.replace(/[^\d]/g,"");

			if (parseFloat(b) != 0){
				ini.value = tandaPemisahTitik(b);
				return false;
			} else {
				return false;
			}
		}else if (e.keyCode==95){
			a = ini.value.replace(".","") + String.fromCharCode(e.keyCode-48);
			b = a.replace(/[^\d]/g,"");

			if (parseFloat(b) != 0){
				ini.value = tandaPemisahTitik(b);
				return false;
			} else {
				return false;
			}
		}else if (e.keyCode==8 || e.keycode == 46){
			a = ini.value.replace(".","");
			b = a.replace(/[^\d]/g,"");
			b = b.substr(0,b.length -1);

			if (tandaPemisahTitik(b) != ""){
				ini.value = tandaPemisahTitik(b);
			} else {
				ini.value = "";
			}

			return false;
		} else if (e.keyCode==9){
			return true;
		} else if (e.keyCode==17){
			return true;
		} else {
			//alert (e.keyCode);
			return false;
		}
	}
</script>