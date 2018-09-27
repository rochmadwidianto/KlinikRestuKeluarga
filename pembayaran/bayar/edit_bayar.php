<!-- 
================= doc ====================
 filename     : edit_bayar.php
 @package     : bayar
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
	require_once('class.bayar.php');
	require_once('../../config/fungsi_sqltgl.php');
	$bayar = new bayar($pdo);
	if(!empty($_POST['bayar_rekam_medis_id'])){
		$param['bayar_daftar_id']			= $_POST['bayar_daftar_id'];
		$param['bayar_rekam_medis_id']		= $_POST['bayar_rekam_medis_id'];
		$param['bayar_pasien_id']			= $_POST['bayar_pasien_id'];
		$param['status_bayar']				= 'Ya';
		$param['bayar_jasa_dokter']			= str_replace('.', '', $_POST['bayar_jasa_dokter']);
		$param['bayar_harga_obat']			= str_replace('.', '', $_POST['bayar_harga_obat']);
		$param['bayar_biaya_tindakan']		= str_replace('.', '', $_POST['bayar_biaya_tindakan']);
		$param['bayar_biaya_laborat']		= str_replace('.', '', $_POST['bayar_biaya_laborat']);
		$param['bayar_biaya_persalinan']	= str_replace('.', '', $_POST['bayar_biaya_persalinan']);
		$param['bayar_biaya_lain']			= str_replace('.', '', $_POST['bayar_biaya_lain']);
		$param['bayar_biaya']				= str_replace('.', '', $_POST['bayar_biaya']);
		$param['bayar_tanggal']				= tgl_sql($_POST['bayar_tanggal']);
		$param['created_by'] 				= $_SESSION['s_user'];

		$create_bayar 		= $bayar->create($param);
		$update_daftar 		= $bayar->update_daftar($param);

		if($create_bayar && $update_daftar){
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
		<legend>Pembayaran</legend>
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
			extract($bayar->getID($id));	
		} 
		?>
		</span>
		<div class="row-fluid">
			<div class="span6">
				<div style="display: none;" class="control-group">
				<label class="control-label" for="bayar_daftar_id" >ID</label>
					<div class="controls">
					<input type="text" id="bayar_daftar_id" name="bayar_daftar_id" value="<?php echo $daftar_id; ?>" readonly="readonly">
					</div>
				</div>
				<div style="display: none;" class="control-group">
				<label class="control-label" for="bayar_rekam_medis_id" >ID</label>
					<div class="controls">
					<input type="text" id="bayar_rekam_medis_id" name="bayar_rekam_medis_id" value="<?php echo $rekam_medis_id; ?>" readonly="readonly">
					</div>
				</div>
				<div style="display: none;" class="control-group">
				<label class="control-label" for="bayar_pasien_id" >ID</label>
					<div class="controls">
					<input type="text" id="bayar_pasien_id" name="bayar_pasien_id" value="<?php echo $pasien_id; ?>" readonly="readonly">
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="bayar_tanggal">Tanggal</label>
					<div class="controls" >								
						<input type="text" style="font-weight: bold;" id="bayar_tanggal" value="<?php echo tgl_sql1(date('Y-m-d')); ?>" name="bayar_tanggal" class="tanggal span4" data-date-format="dd-mm-yyyy" />
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
				<label class="control-label" for="bayar_diagnosa" >Anamnese/Diagnosa</label>
					<div class="controls">
					<label class="span10"><b><?php echo $rekam_medis_diagnosa; ?></b></label>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="bayar_terapi" >Terapi</label>
					<div class="controls">
					<label class="span10"><b><?php echo $rekam_medis_terapi; ?></b></label>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="bayar_hasil" >Hasil Pemeriksaan</label>
					<div class="controls">
					<label class="span10"><b><?php echo $periksa_hasil; ?></b></label>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="bayar_catatan" >Tindakan Pemeriksaan</label>
					<div class="controls">
					<label class="span10"><b><?php echo $periksa_catatan; ?></b></label>
					</div>
				</div>
			</div>
			<div class="span6">
				<div class="control-group">
				<label class="control-label" for="bayar_jasa_dokter" style="font-size: 14pt;" ><b>Jasa Dokter </b></label>
					<div class="controls">
					<textarea class="span10" style="text-align: right; font-weight: bold; font-size: 18pt; color: green; padding-top: 15px; padding-bottom: 0px; resize: none;" rows="1" cols="2" id="bayar_jasa_dokter" name="bayar_jasa_dokter" onkeydown="return numbersonly(this, event);" onkeyup="javascript:setJasaDokter(this);"></textarea>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="bayar_harga_obat" style="font-size: 14pt;" ><b>Harga Obat </b></label>
					<div class="controls">
					<textarea class="span10" style="text-align: right; font-weight: bold; font-size: 18pt; color: green; padding-top: 15px; padding-bottom: 0px; resize: none;" rows="1" cols="2" id="bayar_harga_obat" name="bayar_harga_obat" onkeydown="return numbersonly(this, event);" onkeyup="javascript:setHargaObat(this);"></textarea>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="bayar_biaya_tindakan" style="font-size: 14pt;" ><b>Biaya Tindakan </b></label>
					<div class="controls">
					<textarea class="span10"  style="text-align: right; font-weight: bold; font-size: 18pt; color: green; padding-top: 15px; padding-bottom: 0px; resize: none;" rows="1" cols="2" id="bayar_biaya_tindakan" name="bayar_biaya_tindakan" onkeydown="return numbersonly(this, event);" onkeyup="javascript:setTindakan(this);"></textarea>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="bayar_biaya_laborat" style="font-size: 14pt;" ><b>Biaya Laborat </b></label>
					<div class="controls">
					<textarea class="span10"  style="text-align: right; font-weight: bold; font-size: 18pt; color: green; padding-top: 15px; padding-bottom: 0px; resize: none;" rows="1" cols="2" id="bayar_biaya_laborat" name="bayar_biaya_laborat" onkeydown="return numbersonly(this, event);" onkeyup="javascript:setLaborat(this);"></textarea>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="bayar_biaya_persalinan" style="font-size: 14pt;" ><b>Biaya Persalinan </b></label>
					<div class="controls">
					<textarea class="span10"  style="text-align: right; font-weight: bold; font-size: 18pt; color: green; padding-top: 15px; padding-bottom: 0px; resize: none;" rows="1" cols="2" id="bayar_biaya_persalinan" name="bayar_biaya_persalinan" onkeydown="return numbersonly(this, event);" onkeyup="javascript:setPersalinan(this);"></textarea>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="bayar_biaya_lain" style="font-size: 14pt;" ><b>Biaya Lain </b></label>
					<div class="controls">
					<textarea class="span10"  style="text-align: right; font-weight: bold; font-size: 18pt; color: green; padding-top: 15px; padding-bottom: 0px; resize: none;" rows="1" cols="2" id="bayar_biaya_lain" name="bayar_biaya_lain" onkeydown="return numbersonly(this, event);" onkeyup="javascript:setBiayaLain(this);"></textarea>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="bayar_biaya" style="font-size: 34pt;" ><b>Rp </b></label>
					<div class="controls">
					<textarea class="span10" style="background-color: #DCDCDC; text-align: right; font-weight: bold; font-size: 34pt; color: red; padding-top: 20px; padding-bottom: 5px; resize: none;" rows="1" cols="2" id="bayar_biaya" name="bayar_biaya" onkeydown="return numbersonly(this, event);" onkeyup="javascript:formatCurrency(this);" readonly required></textarea>
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

	function setJasaDokter(){
		var jasa_dokter = document.getElementById('bayar_jasa_dokter').value;
		var harga_obat 	= document.getElementById('bayar_harga_obat').value;
		var tindakan 	= document.getElementById('bayar_biaya_tindakan').value;
		var laborat 	= document.getElementById('bayar_biaya_laborat').value;
		var biaya_lain 	= document.getElementById('bayar_biaya_lain').value;

		if(jasa_dokter == ''){
			var unset_jasa_dokter 	= 0;
		}else{
			var unset_jasa_dokter 	= jasa_dokter.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		if(harga_obat == ''){
			var unset_harga_obat 	= 0;
		}else{
			var unset_harga_obat 	= harga_obat.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		if(tindakan == ''){
			var unset_tindakan 		= 0;
		}else{
			var unset_tindakan 		= tindakan.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		if(laborat == ''){
			var unset_laborat 		= 0;
		}else{
			var unset_laborat 		= laborat.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		if(biaya_lain == ''){
			var unset_biaya_lain 	= 0;
		}else{
			var unset_biaya_lain 	= biaya_lain.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		var hitung_total 	= parseInt(unset_jasa_dokter) + parseInt(unset_harga_obat) + parseInt(unset_tindakan) + parseInt(unset_laborat) + parseInt(unset_biaya_lain);

		document.getElementById('bayar_biaya').value = formatCurrency(hitung_total);
	}

	function setHargaObat(){
		var jasa_dokter = document.getElementById('bayar_jasa_dokter').value;
		var harga_obat 	= document.getElementById('bayar_harga_obat').value;
		var tindakan 	= document.getElementById('bayar_biaya_tindakan').value;
		var laborat 	= document.getElementById('bayar_biaya_laborat').value;
		var persalinan 	= document.getElementById('bayar_biaya_persalinan').value;
		var biaya_lain 	= document.getElementById('bayar_biaya_lain').value;

		if(jasa_dokter == ''){
			var unset_jasa_dokter 	= 0;
		}else{
			var unset_jasa_dokter 	= jasa_dokter.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		if(harga_obat == ''){
			var unset_harga_obat 	= 0;
		}else{
			var unset_harga_obat 	= harga_obat.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		if(tindakan == ''){
			var unset_tindakan 		= 0;
		}else{
			var unset_tindakan 		= tindakan.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		if(laborat == ''){
			var unset_laborat 		= 0;
		}else{
			var unset_laborat 		= laborat.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		if(persalinan == ''){
			var unset_persalinan 	= 0;
		}else{
			var unset_persalinan 	= persalinan.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		if(biaya_lain == ''){
			var unset_biaya_lain 	= 0;
		}else{
			var unset_biaya_lain 	= biaya_lain.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		var hitung_total 	= parseInt(unset_jasa_dokter) + parseInt(unset_harga_obat) + parseInt(unset_tindakan) + parseInt(unset_laborat) + parseInt(unset_persalinan) + parseInt(unset_biaya_lain);
		
		document.getElementById('bayar_biaya').value = formatCurrency(hitung_total);
	}

	function setTindakan(){
		var jasa_dokter = document.getElementById('bayar_jasa_dokter').value;
		var harga_obat 	= document.getElementById('bayar_harga_obat').value;
		var tindakan 	= document.getElementById('bayar_biaya_tindakan').value;
		var laborat 	= document.getElementById('bayar_biaya_laborat').value;
		var persalinan 	= document.getElementById('bayar_biaya_persalinan').value;
		var biaya_lain 	= document.getElementById('bayar_biaya_lain').value;

		if(jasa_dokter == ''){
			var unset_jasa_dokter 	= 0;
		}else{
			var unset_jasa_dokter 	= jasa_dokter.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		if(harga_obat == ''){
			var unset_harga_obat 	= 0;
		}else{
			var unset_harga_obat 	= harga_obat.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		if(tindakan == ''){
			var unset_tindakan 		= 0;
		}else{
			var unset_tindakan 		= tindakan.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		if(laborat == ''){
			var unset_laborat 		= 0;
		}else{
			var unset_laborat 		= laborat.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		if(persalinan == ''){
			var unset_persalinan 	= 0;
		}else{
			var unset_persalinan 	= persalinan.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		if(biaya_lain == ''){
			var unset_biaya_lain 	= 0;
		}else{
			var unset_biaya_lain 	= biaya_lain.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		var hitung_total 	= parseInt(unset_jasa_dokter) + parseInt(unset_harga_obat) + parseInt(unset_tindakan) + parseInt(unset_laborat) + parseInt(unset_persalinan) + parseInt(unset_biaya_lain);
		
		document.getElementById('bayar_biaya').value = formatCurrency(hitung_total);
	}

	function setLaborat(){
		var jasa_dokter = document.getElementById('bayar_jasa_dokter').value;
		var harga_obat 	= document.getElementById('bayar_harga_obat').value;
		var tindakan 	= document.getElementById('bayar_biaya_tindakan').value;
		var laborat 	= document.getElementById('bayar_biaya_laborat').value;
		var persalinan 	= document.getElementById('bayar_biaya_persalinan').value;
		var biaya_lain 	= document.getElementById('bayar_biaya_lain').value;

		if(jasa_dokter == ''){
			var unset_jasa_dokter 	= 0;
		}else{
			var unset_jasa_dokter 	= jasa_dokter.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		if(harga_obat == ''){
			var unset_harga_obat 	= 0;
		}else{
			var unset_harga_obat 	= harga_obat.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		if(tindakan == ''){
			var unset_tindakan 		= 0;
		}else{
			var unset_tindakan 		= tindakan.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		if(laborat == ''){
			var unset_laborat 		= 0;
		}else{
			var unset_laborat 		= laborat.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		if(persalinan == ''){
			var unset_persalinan 	= 0;
		}else{
			var unset_persalinan 	= persalinan.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		if(biaya_lain == ''){
			var unset_biaya_lain 	= 0;
		}else{
			var unset_biaya_lain 	= biaya_lain.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		var hitung_total 	= parseInt(unset_jasa_dokter) + parseInt(unset_harga_obat) + parseInt(unset_tindakan) + parseInt(unset_laborat) + parseInt(unset_persalinan) + parseInt(unset_biaya_lain);
		
		document.getElementById('bayar_biaya').value = formatCurrency(hitung_total);
	}

	function setPersalinan(){
		var jasa_dokter = document.getElementById('bayar_jasa_dokter').value;
		var harga_obat 	= document.getElementById('bayar_harga_obat').value;
		var tindakan 	= document.getElementById('bayar_biaya_tindakan').value;
		var laborat 	= document.getElementById('bayar_biaya_laborat').value;
		var persalinan 	= document.getElementById('bayar_biaya_persalinan').value;
		var biaya_lain 	= document.getElementById('bayar_biaya_lain').value;

		if(jasa_dokter == ''){
			var unset_jasa_dokter 	= 0;
		}else{
			var unset_jasa_dokter 	= jasa_dokter.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		if(harga_obat == ''){
			var unset_harga_obat 	= 0;
		}else{
			var unset_harga_obat 	= harga_obat.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		if(tindakan == ''){
			var unset_tindakan 		= 0;
		}else{
			var unset_tindakan 		= tindakan.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		if(laborat == ''){
			var unset_laborat 		= 0;
		}else{
			var unset_laborat 		= laborat.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		if(persalinan == ''){
			var unset_persalinan 	= 0;
		}else{
			var unset_persalinan 	= persalinan.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		if(biaya_lain == ''){
			var unset_biaya_lain 	= 0;
		}else{
			var unset_biaya_lain 	= biaya_lain.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		var hitung_total 	= parseInt(unset_jasa_dokter) + parseInt(unset_harga_obat) + parseInt(unset_tindakan) + parseInt(unset_laborat) + parseInt(unset_persalinan) + parseInt(unset_biaya_lain);
		
		document.getElementById('bayar_biaya').value = formatCurrency(hitung_total);
	}

	function setBiayaLain(){
		var jasa_dokter = document.getElementById('bayar_jasa_dokter').value;
		var harga_obat 	= document.getElementById('bayar_harga_obat').value;
		var tindakan 	= document.getElementById('bayar_biaya_tindakan').value;
		var laborat 	= document.getElementById('bayar_biaya_laborat').value;
		var persalinan 	= document.getElementById('bayar_biaya_persalinan').value;
		var biaya_lain 	= document.getElementById('bayar_biaya_lain').value;

		if(jasa_dokter == ''){
			var unset_jasa_dokter 	= 0;
		}else{
			var unset_jasa_dokter 	= jasa_dokter.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		if(harga_obat == ''){
			var unset_harga_obat 	= 0;
		}else{
			var unset_harga_obat 	= harga_obat.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		if(tindakan == ''){
			var unset_tindakan 		= 0;
		}else{
			var unset_tindakan 		= tindakan.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		if(laborat == ''){
			var unset_laborat 		= 0;
		}else{
			var unset_laborat 		= laborat.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		if(persalinan == ''){
			var unset_persalinan 	= 0;
		}else{
			var unset_persalinan 	= persalinan.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		if(biaya_lain == ''){
			var unset_biaya_lain 	= 0;
		}else{
			var unset_biaya_lain 	= biaya_lain.replace(".","").replace(".","").replace(".","").replace(".","");
		}

		var hitung_total 	= parseInt(unset_jasa_dokter) + parseInt(unset_harga_obat) + parseInt(unset_tindakan) + parseInt(unset_laborat) + parseInt(unset_persalinan) + parseInt(unset_biaya_lain);
		
		document.getElementById('bayar_biaya').value = formatCurrency(hitung_total);
	}

	setJasaDokter();
	setHargaObat();
	setTindakan();
	setLaborat();
	setPersalinan();
	setBiayaLain();

	function formatCurrency(b){
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
				ini.value = formatCurrency(b);
				return false;
			}
			else if(e.keyCode <= 105){
				if(e.keyCode >= 96){
				//e.keycode = e.keycode - 47;
				a = ini.value.toString().replace(".","");
				b = a.replace(/[^\d]/g,"");
				b = (b == "0")?String.fromCharCode(e.keyCode-48):b + String.fromCharCode(e.keyCode-48);
				ini.value = formatCurrency(b);
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
				ini.value = formatCurrency(b);
				return false;
			} else {
				return false;
			}
		}else if (e.keyCode==95){
			a = ini.value.replace(".","") + String.fromCharCode(e.keyCode-48);
			b = a.replace(/[^\d]/g,"");

			if (parseFloat(b) != 0){
				ini.value = formatCurrency(b);
				return false;
			} else {
				return false;
			}
		}else if (e.keyCode==8 || e.keycode == 46){
			a = ini.value.replace(".","");
			b = a.replace(/[^\d]/g,"");
			b = b.substr(0,b.length -1);

			if (formatCurrency(b) != ""){
				ini.value = formatCurrency(b);
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