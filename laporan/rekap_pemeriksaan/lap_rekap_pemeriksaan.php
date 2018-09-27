
<!-- 
================= doc ====================
 filename     : lap_rekap_pemeriksaan.php
 @package     : rekap_pemeriksaan
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-11-10
 @Modified    : 2017-11-10
 @copyright   : Copyright (c) 2017
================= doc ====================
-->
<?php
session_start();
include_once('../../config/koneksi.php');
include_once('../../config/fungsi_indotgl.php');
include_once('class.rekap_pemeriksaan.php');
$rekap_pemeriksaan = new rekap_pemeriksaan($pdo);
?>
<div id="alert"></div>
<div class="row-fluid">
<h3 class="header smaller lighter blue"><b>Rekapitulasi Biaya Pemeriksaan</b></h3>
	<div class="table-header">		
	</div>

<form id="forms" method="post" action="laporan/rekap_pemeriksaan/print_action.php" target="_blank" class="form-horizontal">
<div class="span12">
	<div class="control-group">
		<label class="control-label">Tanggal Pemeriksaan</label>
		<div class="controls">
				<input type="text" id="tanggal_periksa_awal" class="tanggal span3" value="<?php echo date('d-m-Y'); ?>" name="tanggal_periksa_awal" data-date-format="dd-mm-yyyy" />
				<i class="icon-calendar bigger-120"></i>
			<span>  s.d. </span>
				<input type="text" id="tanggal_periksa_akhir" class="tanggal span3" value="<?php echo date('d-m-Y'); ?>" name="tanggal_periksa_akhir" data-date-format="dd-mm-yyyy" />
				<i class="icon-calendar bigger-120"></i>&nbsp;*
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="pasien_id" >Pasien</label>
		<div class="controls">
			<select name="pasien_id" id="pasien_id" class="chzn-select span4" data-placeholder="-- Pilih Pasien --">
				<option value="">-- Pilih Pasien --</option>						
				<?php					
					$query = "SELECT pasien_id, CONCAT(pasien_nomor, ' - ', pasien_nama) AS pasien_nama FROM daftar JOIN pasien ON pasien_id = daftar_pasien_id WHERE UPPER(daftar_is_periksa) = 'YA' AND UPPER(daftar_is_bayar) = 'YA' GROUP BY pasien_id ORDER BY pasien_nomor ASC ";
					$rekap_pemeriksaan->select_pasien($query);						
				?>
			</select>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="rekam_medis_nomor" >No Rekam Medis</label>
		<div class="controls">
			<select name="rekam_medis_nomor" id="rekam_medis_nomor" class="chzn-select span2" data-placeholder="-- Pilih No Rekam Medis --">
				<option value="">-- Pilih No Rekam Medis --</option>						
				<?php					
					$query = "SELECT rekam_medis_id, rekam_medis_nomor FROM rekam_medis JOIN daftar ON daftar_id = rekam_medis_daftar_id WHERE UPPER(daftar_is_periksa) = 'YA' AND UPPER(daftar_is_bayar) = 'YA' GROUP BY rekam_medis_id ORDER BY rekam_medis_nomor ASC ";
					$rekap_pemeriksaan->select_rm_nomor($query);						
				?>
			</select>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Aksi</label>
		<div class="controls">
			<label class="span2" style="margin-right: -44px;">
				<input name="print_type" type="radio" value="view" checked />
				<span class="lbl badge badge-info"> Tampilkan</span>
			</label>
			<label class="span1">
				<input name="print_type" type="radio" value="pdf" />
				<span class="lbl badge badge-warning"> PDF</span>
			</label>
			<label class="span1">
				<input name="print_type" type="radio" value="xls" />
				<span class="lbl badge badge-important"> Excel</span>
			</label>
		</div>
	</div>
	<br/>
	<div class="controls-group">
		<div class="controls">
			<button type="submit" class="btn btn-small btn-success"><i class='icon-book'><b> Rekap</b></i></button>
			<button href="javascript:void(0)" onclick="swapContent('laporan/pemeriksaan/pemeriksaan')" type="button" class="btn btn-small btn-danger" ><i class='icon-remove'><b> Batal</b></i></button>
		</div>
	</div>
	<hr>
	<div class="control-group">
		<div class="span12">
			<div class="alert alert-info">
	      		<button type="button" class="close" data-dismiss="alert">&times;</button>
	      		<p style="margin-bottom: -8px; color: #FF1493;"><b>PETUNJUK!</b></p><br/>
	      		<i class="icon-hand-right" style="color: #FF1493; padding-right: 2px;"></i> Tanda <b>*</b> wajib diisi.<br/>
	      		<i class="icon-hand-right" style="color: #FF1493; padding-right: 2px;"></i> Isikan <i>keyword</i> pencarian untuk menampilkan data yang diinginkan.
	    	</div>
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
		$(".chzn-select").chosen();
		$(".tanggal").datepicker({
				dateFormat: "yyyy-mm-dd",
	            changeMonth: true,
	            changeYear: true,
				yearRange: '1970:2050',
				autoclose: true,
				todayHighlight: true,
		});
	});
</script>
