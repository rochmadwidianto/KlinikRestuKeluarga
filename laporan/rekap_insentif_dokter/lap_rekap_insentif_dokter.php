
<?php
session_start();
include_once('../../config/koneksi.php');
include_once('../../config/fungsi_indotgl.php');
include_once('class.rekap_insentif_dokter.php');
$rekap_insentif_dokter = new rekap_insentif_dokter($pdo);
?>
<div id="alert"></div>
<div class="row-fluid">
<h3 class="header smaller lighter blue"><b>Rekapitulasi Insentif Dokter</b></h3>
	<div class="table-header">		
	</div>

<form id="forms" method="post" action="laporan/rekap_insentif_dokter/print_action.php" target="_blank" class="form-horizontal">
<div class="span12">
	<div class="control-group">
		<label class="control-label" for="dokter_id" >Dokter</label>
		<div class="controls">
			<select name="dokter_id" id="dokter_id" class="chzn-select span4" data-placeholder="-- Pilih Dokter --" required>
				<option value="">-- Pilih Dokter --</option>						
				<?php					
					$query = "SELECT dokter_id, CONCAT(UPPER(dokter_nama), ' - ',poliklinik_nama) AS dokter_nama FROM dokter JOIN poliklinik ON poliklinik_id = dokter_poliklinik_id";
					$rekap_insentif_dokter->select_dokter($query);						
				?>
			</select>&nbsp;*
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Bulan</label>
		<div class="controls">
			<select name="bulan_awal" id="bulan_awal" required class="chzn-select span2">
				<option value="">-- Pilih Bulan --</option>
				<option value="01">Januari</option>
				<option value="02">Februari</option>
				<option value="03">Maret</option>
				<option value="04">April</option>
				<option value="05">Mei</option>
				<option value="06">Juni</option>						
				<option value="07">Juli</option>
				<option value="08">Agustus</option>
				<option value="09">September</option>
				<option value="10">Oktober</option>
				<option value="11">November</option>
				<option value="12">Desember</option>
			</select> 
			<span> s.d. </span>
			<select name="bulan_akhir" id="bulan_akhir" required class="chzn-select span2" >
				<option value="">-- Pilih Bulan --</option>
				<option value="01">Januari</option>
				<option value="02">Februari</option>
				<option value="03">Maret</option>
				<option value="04">April</option>
				<option value="05">Mei</option>
				<option value="06">Juni</option>						
				<option value="07">Juli</option>
				<option value="08">Agustus</option>
				<option value="09">September</option>
				<option value="10">Oktober</option>
				<option value="11">November</option>
				<option value="12">Desember</option>
			</select>&nbsp;*
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Tahun</label>
		<div class="controls">		
			<select name="tahun" id="tahun" required class="chzn-select span2" >
				<option value="">-- Pilih Tahun --</option>
				<option value="2016">2016</option>
				<option value="2017">2017</option>
				<option value="2018">2018</option>
				<option value="2019">2019</option>
				<option value="2020">2020</option>
				<option value="2021">2021</option>
				<option value="2022">2022</option>
				<option value="2023">2032</option>
				<option value="2024">2024</option>
				<option value="2025">2025</option>
				<option value="2026">2026</option>
				<option value="2027">2027</option>
				<option value="2028">2028</option>
				<option value="2029">2029</option>
				<option value="2030">2030</option>
			</select>&nbsp;*
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
				<button href="javascript:void(0)" onclick="swapContent('laporan/insentif_dokter/insentif_dokter')" type="button" class="btn btn-small btn-danger" ><i class='icon-remove'><b> Batal</b></i></button>
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
