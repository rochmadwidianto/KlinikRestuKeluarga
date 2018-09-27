<!-- 
================= doc ====================
 filename     : edit_dokter.php
 @package     : dokter
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
	include_once('../../config/koneksi.php');
	require_once('class.dokter.php');
	require_once('../../config/fungsi_sqltgl.php');
	$dokter = new dokter($pdo);
	if(!empty($_POST['dokter_id'])){
		$param['dokter_id']				= $_POST['dokter_id'];
		$param['dokter_poliklinik_id']			= $_POST['dokter_poliklinik_id'];
		$param['dokter_nama'] 			= $_POST['dokter_nama'];
		$param['dokter_sip']			= $_POST['dokter_sip'];
		$param['dokter_gender'] 		= $_POST['dokter_gender'];
		$param['dokter_agama'] 			= $_POST['dokter_agama'];
		$param['dokter_telp'] 			= $_POST['dokter_telp'];
		$param['dokter_tanggal_lahir'] 	= tgl_sql($_POST['dokter_tanggal_lahir']);
		$param['dokter_alamat']			= $_POST['dokter_alamat'];

		$param['cbx_jadwal']			= $_POST['cbx_jadwal'];

		$param['jadwal']['senin_start']			= $_POST['senin_start'];
		$param['jadwal']['senin_end']			= $_POST['senin_end'];
		$param['jadwal']['selasa_start']		= $_POST['selasa_start'];
		$param['jadwal']['selasa_end']			= $_POST['selasa_end'];
		$param['jadwal']['rabu_start']			= $_POST['rabu_start'];
		$param['jadwal']['rabu_end']			= $_POST['rabu_end'];
		$param['jadwal']['kamis_start']			= $_POST['kamis_start'];
		$param['jadwal']['kamis_end']			= $_POST['kamis_end'];
		$param['jadwal']['jumat_start']			= $_POST['jumat_start'];
		$param['jadwal']['jumat_end']			= $_POST['jumat_end'];
		$param['jadwal']['sabtu_start']			= $_POST['sabtu_start'];
		$param['jadwal']['sabtu_end']			= $_POST['sabtu_end'];
		$param['jadwal']['minggu_start']		= $_POST['minggu_start'];
		$param['jadwal']['minggu_end']			= $_POST['minggu_end'];

		$param['update_by'] 			= $_SESSION['s_user'];

		$delete_jadwal 	= $dokter->deleteJadwal($param['dokter_id']);
		$update 		= $dokter->update($param);
		$create_jadwal	= $dokter->create_jadwal($param['dokter_id'], $param['cbx_jadwal'], $param['jadwal']);

		if($delete_jadwal && $update && $create_jadwal){
			$sg   = "ok";
			$msg1 = "<b>SUKSES!</b> Perubahan data berhasil dilakukan";
			$alert='alert-success';
		}else{
			$g = "err";
			$msg2 = "<b>GAGAL!</b> Perubahan data berhasil dilakukan";
			$alert='alert-error';
		}
	}
?>

<form id="forms" method="post" onSubmit="return submitForm('<?php echo $_SERVER['PHP_SELF']; ?>')" class="form-horizontal">
		<legend>Edit Dokter</legend>
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
		if(isset($_GET['dokter_id']))
		{
			$id = $_GET['dokter_id'];
			extract($dokter->getID($id));	

			if($senin_start != '') $check_senin = "checked= checked"; else $check_senin = "";
			if($selasa_start != '') $check_selasa = "checked= checked"; else $check_selasa = "";
			if($rabu_start != '') $check_rabu = "checked= checked"; else $check_rabu = "";
			if($kamis_start != '') $check_kamis = "checked= checked"; else $check_kamis = "";
			if($jumat_start != '') $check_jumat = "checked= checked"; else $check_jumat = "";
			if($sabtu_start != '') $check_sabtu = "checked= checked"; else $check_sabtu = "";
			if($minggu_start != '') $check_minggu = "checked= checked"; else $check_minggu = "";
		} 
		?>
		</span>
		<div class="row-fluid">
			<div class="span7">
				<div style="display: none;" class="control-group">
				<label class="control-label" for="dokter_id" >ID</label>
					<div class="controls">
					<input type="text" id="dokter_id" name="dokter_id" value="<?php echo $dokter_id; ?>" readonly="readonly">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="dokter_poliklinik_id" > Poliklinik</label>
					<div class="controls">
					<select name="dokter_poliklinik_id" id="dokter_poliklinik_id" class="chzn-select" data-placeholder="Pilih Poliklinik" required>&nbsp;*
						<option value="<?php echo $dokter_poliklinik_id; ?>"><?php echo $poliklinik_nama; ?></option>						
						<?php					
							$query = "SELECT * FROM poliklinik ";
							$dokter->select_poliklinik($query);						
						?>
					</select>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="dokter_nama" >Nama</label>
					<div class="controls">
					<input type="text" class="span8" id="dokter_nama" name="dokter_nama" autocomplite="off" value="<?php echo $dokter_nama; ?>" required />&nbsp;*
					</div>
				</div>	
				<div class="control-group">
				<label class="control-label" for="dokter_sip" >SIP</label>
					<div class="controls">
					<input type="text" class="span8" id="dokter_sip" name="dokter_sip" autocomplite="off" value="<?php echo $dokter_sip; ?>" />
					</div>
				</div>	
				<div class="control-group">
					<label class="control-label">Jenis Kelamin</label>
					<div class="controls">
						<label>
							<input name="dokter_gender" type="radio" value="Laki - Laki" <?php echo ($dokter_gender=='Laki - Laki')?'checked':''; ?> />
							<span class="lbl"> Laki - Laki</span>
						</label>
						<label>
							<input name="dokter_gender" type="radio" value="Perempuan" <?php echo ($dokter_gender=='Perempuan')?'checked':''; ?> />
							<span class="lbl"> Perempuan</span>
						</label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Agama</label>
					<div class="controls">
						<select name="dokter_agama" id="dokter_agama" class="chzn-select" required >
							<option <?php echo ($dokter_agama=='Islam')?'selected':''; ?> value="Islam">Islam</option>
							<option <?php echo ($dokter_agama=='Kristen')?'selected':''; ?> value="Kristen">Kristen</option>
							<option <?php echo ($dokter_agama=='Katholik')?'selected':''; ?> value="Katholik">Katholik</option>
							<option <?php echo ($dokter_agama=='Hindu')?'selected':''; ?> value="Hindu">Hindu</option>
							<option <?php echo ($dokter_agama=='Budha')?'selected':''; ?> value="Budha">Budha</option>
						</select>&nbsp;*
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="dokter_telp" >Telp/HP</label>
					<div class="controls">
					<input type="text" id="dokter_telp" name="dokter_telp" class="span4" autocomplite="off" value="<?php echo $dokter_telp; ?>"  />
					</div>
				</div>	
				<div class="control-group">
				<label class="control-label" for="dokter_tanggal_lahir">Tanggal Lahir</label>
					<div class="controls" >								
						<input type="text" id="dokter_tanggal_lahir" value="<?php echo tgl_sql1($dokter_tanggal_lahir); ?>" name="dokter_tanggal_lahir" class="tanggal span4" data-date-format="dd-mm-yyyy" />
						<i class="icon-calendar bigger-120"></i>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="dokter_alamat" >Alamat</label>
					<div class="controls">
					<textarea class="span8" cols="3" id="dokter_alamat" name="dokter_alamat" value="<?php echo $dokter_alamat; ?>" ><?php echo $dokter_alamat; ?></textarea>
					</div>
				</div>
			</div>
			<div class="span5">
				<h4 class="icon-calendar"> Jadwal Praktek</h4>
				<div class="alert alert-info">
				<label class="checkbox">
					<input type="checkbox" value="Senin" id="cbx_senin" <?php echo $check_senin; ?> name="cbx_jadwal[]" onclick="cbxSenin()" />
					<span class="lbl span4" id="lbl_senin"> Senin</span>
					<span style="font-weight: bold;" id="lbl_senin_jam">Jam</span>
					<input type="text" id="senin_start" class="span3" name="senin_start" value="<?php echo $senin_start; ?>"  />
					<span id="lbl_senin_sd">s.d.</span>
					<input type="text" id="senin_end" class="span3" name="senin_end" value="<?php echo $senin_end; ?>" />
				</label>
				<label class="checkbox">
					<input type="checkbox" value="Selasa" id="cbx_selasa" <?php echo $check_selasa; ?> name="cbx_jadwal[]" onclick="cbxSelasa()" />
					<span class="lbl span4" id="lbl_selasa"> Selasa</span>
					<span style="font-weight: bold;" id="lbl_selasa_jam">Jam</span>
					<input type="text" id="selasa_start" class="span3" name="selasa_start" value="<?php echo $selasa_start; ?>" />
					<span id="lbl_selasa_sd">s.d.</span>
					<input type="text" id="selasa_end" class="span3" name="selasa_end" value="<?php echo $selasa_end; ?>" />
				</label>
				<label class="checkbox">
					<input type="checkbox" value="Rabu" id="cbx_rabu" <?php echo $check_rabu; ?> name="cbx_jadwal[]" onclick="cbxRabu()" />
					<span class="lbl span4" id="lbl_rabu"> Rabu</span>
					<span style="font-weight: bold;" id="lbl_rabu_jam">Jam</span>
					<input type="text" id="rabu_start" class="span3" name="rabu_start" value="<?php echo $rabu_start; ?>"  />
					<span id="lbl_rabu_sd">s.d.</span>
					<input type="text" id="rabu_end" class="span3" name="rabu_end" value="<?php echo $rabu_end; ?>" />
				</label>
				<label class="checkbox">
					<input type="checkbox" value="Kamis" id="cbx_kamis" <?php echo $check_kamis; ?> name="cbx_jadwal[]" onclick="cbxKamis()" />
					<span class="lbl span4" id="lbl_kamis"> Kamis</span>
					<span style="font-weight: bold;" id="lbl_kamis_jam">Jam</span>
					<input type="text" id="kamis_start" class="span3" name="kamis_start" value="<?php echo $kamis_start; ?>"  />
					<span id="lbl_kamis_sd">s.d.</span>
					<input type="text" id="kamis_end" class="span3" name="kamis_end" value="<?php echo $kamis_end; ?>" />
				</label>
				<label class="checkbox">
					<input type="checkbox" value="Jumat" id="cbx_jumat" <?php echo $check_jumat; ?> name="cbx_jadwal[]" onclick="cbxJumat()" />
					<span class="lbl span4" id="lbl_jumat"> Jumat</span>
					<span style="font-weight: bold;" id="lbl_jumat_jam">Jam</span>
					<input type="text" id="jumat_start" class="span3" name="jumat_start" value="<?php echo $jumat_start; ?>"  />
					<span id="lbl_jumat_sd">s.d.</span>
					<input type="text" id="jumat_end" class="span3" name="jumat_end" value="<?php echo $jumat_end; ?>" />
				</label>
				<label class="checkbox">
					<input type="checkbox" value="Sabtu" id="cbx_sabtu" <?php echo $check_sabtu; ?> name="cbx_jadwal[]" onclick="cbxSabtu()" />
					<span class="lbl span4" id="lbl_sabtu"> Sabtu</span>
					<span style="font-weight: bold;" id="lbl_sabtu_jam">Jam</span>
					<input type="text" id="sabtu_start" class="span3" name="sabtu_start" value="<?php echo $sabtu_start; ?>"  />
					<span id="lbl_sabtu_sd">s.d.</span>
					<input type="text" id="sabtu_end" class="span3" name="sabtu_end" value="<?php echo $sabtu_end; ?>" />
				</label>
				<label class="checkbox">
					<input type="checkbox" value="Minggu" id="cbx_minggu" <?php echo $check_minggu; ?> name="cbx_jadwal[]" onclick="cbxMinggu()" />
					<span class="lbl span4" id="lbl_minggu"> Minggu</span>
					<span style="font-weight: bold;" id="lbl_minggu_jam">Jam</span>
					<input type="text" id="minggu_start" class="span3" name="minggu_start" value="<?php echo $minggu_start; ?>"  />
					<span id="lbl_minggu_sd">s.d.</span>
					<input type="text" id="minggu_end" class="span3" name="minggu_end" value="<?php echo $minggu_end; ?>"  />
				</label>
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

	cbxSenin();
	cbxSelasa();
	cbxRabu();
	cbxKamis();
	cbxJumat();
	cbxSabtu();
	cbxMinggu();

	function cbxSenin(){
		if ($('#cbx_senin').is(":checked")){
			document.getElementById('senin_start').disabled = false;
			document.getElementById('senin_end').disabled 	= false;
			// document.getElementById('senin_start').value 	= '';
			// document.getElementById('senin_end').value 		= '';
			document.getElementById('lbl_senin').style 		= 'font-weight: bold; color: #FF1493';
			document.getElementById('lbl_senin_jam').style 	= 'font-weight: bold; color: #FF1493';
			document.getElementById('lbl_senin_sd').style 	= 'font-weight: bold; color: #FF1493';
		}else{
			document.getElementById('senin_start').disabled = true;
			document.getElementById('senin_end').disabled 	= true;
			document.getElementById('senin_start').value 	= '';
			document.getElementById('senin_end').value 		= '';
			document.getElementById('lbl_senin').style 		= '';
			document.getElementById('lbl_senin_jam').style 	= 'font-weight: bold;';
			document.getElementById('lbl_senin_sd').style 	= '';
		}
	}

	function cbxSelasa(){
		if ($('#cbx_selasa').is(":checked")){
			document.getElementById('selasa_start').disabled 	= false;
			document.getElementById('selasa_end').disabled 		= false;
			// document.getElementById('selasa_start').value 		= '';
			// document.getElementById('selasa_end').value 		= '';
			document.getElementById('lbl_selasa').style 		= 'font-weight: bold; color: #FF1493';
			document.getElementById('lbl_selasa_jam').style 	= 'font-weight: bold; color: #FF1493';
			document.getElementById('lbl_selasa_sd').style 	= 'font-weight: bold; color: #FF1493';
		}else{
			document.getElementById('selasa_start').disabled 	= true;
			document.getElementById('selasa_end').disabled 		= true;
			document.getElementById('selasa_start').value 		= '';
			document.getElementById('selasa_end').value 		= '';
			document.getElementById('lbl_selasa').style 		= '';
			document.getElementById('lbl_selasa_jam').style 	= 'font-weight: bold;';
			document.getElementById('lbl_selasa_sd').style 	= '';
		}
	}

	function cbxRabu(){
		if ($('#cbx_rabu').is(":checked")){
			document.getElementById('rabu_start').disabled 	= false;
			document.getElementById('rabu_end').disabled 	= false;
			// document.getElementById('rabu_start').value 	= '';
			// document.getElementById('rabu_end').value 		= '';
			document.getElementById('lbl_rabu').style 		= 'font-weight: bold; color: #FF1493';
			document.getElementById('lbl_rabu_jam').style 	= 'font-weight: bold; color: #FF1493';
			document.getElementById('lbl_rabu_sd').style 	= 'font-weight: bold; color: #FF1493';
		}else{
			document.getElementById('rabu_start').disabled 	= true;
			document.getElementById('rabu_end').disabled 	= true;
			document.getElementById('rabu_start').value 	= '';
			document.getElementById('rabu_end').value 		= '';
			document.getElementById('lbl_rabu').style 		= '';
			document.getElementById('lbl_rabu_jam').style 	= 'font-weight: bold;';
			document.getElementById('lbl_rabu_sd').style 	= '';
		}
	}

	function cbxKamis(){
		if ($('#cbx_kamis').is(":checked")){
			document.getElementById('kamis_start').disabled = false;
			document.getElementById('kamis_end').disabled 	= false;
			// document.getElementById('kamis_start').value 	= '';
			// document.getElementById('kamis_end').value 		= '';
			document.getElementById('lbl_kamis').style 		= 'font-weight: bold; color: #FF1493';
			document.getElementById('lbl_kamis_jam').style 	= 'font-weight: bold; color: #FF1493';
			document.getElementById('lbl_kamis_sd').style 	= 'font-weight: bold; color: #FF1493';
		}else{
			document.getElementById('kamis_start').disabled = true;
			document.getElementById('kamis_end').disabled 	= true;
			document.getElementById('kamis_start').value 	= '';
			document.getElementById('kamis_end').value 		= '';
			document.getElementById('lbl_kamis').style 		= '';
			document.getElementById('lbl_kamis_jam').style 	= 'font-weight: bold;';
			document.getElementById('lbl_kamis_sd').style 	= '';
		}
	}

	function cbxJumat(){
		if ($('#cbx_jumat').is(":checked")){
			document.getElementById('jumat_start').disabled = false;
			document.getElementById('jumat_end').disabled 	= false;
			// document.getElementById('jumat_start').value 	= '';
			// document.getElementById('jumat_end').value 		= '';
			document.getElementById('lbl_jumat').style 		= 'font-weight: bold; color: #FF1493';
			document.getElementById('lbl_jumat_jam').style 	= 'font-weight: bold; color: #FF1493';
			document.getElementById('lbl_jumat_sd').style 	= 'font-weight: bold; color: #FF1493';
		}else{
			document.getElementById('jumat_start').disabled = true;
			document.getElementById('jumat_end').disabled 	= true;
			document.getElementById('jumat_start').value 	= '';
			document.getElementById('jumat_end').value 		= '';
			document.getElementById('lbl_jumat').style 		= '';
			document.getElementById('lbl_jumat_jam').style 	= 'font-weight: bold;';
			document.getElementById('lbl_jumat_sd').style 	= '';
		}
	}

	function cbxSabtu(){
		if ($('#cbx_sabtu').is(":checked")){
			document.getElementById('sabtu_start').disabled = false;
			document.getElementById('sabtu_end').disabled 	= false;
			// document.getElementById('sabtu_start').value 	= '';
			// document.getElementById('sabtu_end').value 		= '';
			document.getElementById('lbl_sabtu').style 		= 'font-weight: bold; color: #FF1493';
			document.getElementById('lbl_sabtu_jam').style 	= 'font-weight: bold; color: #FF1493';
			document.getElementById('lbl_sabtu_sd').style 	= 'font-weight: bold; color: #FF1493';
		}else{
			document.getElementById('sabtu_start').disabled = true;
			document.getElementById('sabtu_end').disabled 	= true;
			document.getElementById('sabtu_start').value 	= '';
			document.getElementById('sabtu_end').value 		= '';
			document.getElementById('lbl_sabtu').style 		= '';
			document.getElementById('lbl_sabtu_jam').style 	= 'font-weight: bold;';
			document.getElementById('lbl_sabtu_sd').style 	= '';
		}
	}

	function cbxMinggu(){
		if ($('#cbx_minggu').is(":checked")){
			document.getElementById('minggu_start').disabled 	= false;
			document.getElementById('minggu_end').disabled 		= false;
			// document.getElementById('minggu_start').value 		= '';
			// document.getElementById('minggu_end').value 		= '';
			document.getElementById('lbl_minggu').style 		= 'font-weight: bold; color: #FF1493';
			document.getElementById('lbl_minggu_jam').style 	= 'font-weight: bold; color: #FF1493';
			document.getElementById('lbl_minggu_sd').style 	= 'font-weight: bold; color: #FF1493';
		}else{
			document.getElementById('minggu_start').disabled 	= true;
			document.getElementById('minggu_end').disabled 		= true;
			document.getElementById('minggu_start').value 		= '';
			document.getElementById('minggu_end').value 		= '';
			document.getElementById('lbl_minggu').style 		= '';
			document.getElementById('lbl_minggu_jam').style 	= 'font-weight: bold;';
			document.getElementById('lbl_minggu_sd').style 	= '';
		}
	}

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