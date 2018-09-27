<script type="text/javascript">
	$(document).ready(function(){
		$("#data").load("laporan/rekap_insentif_dokter/lap_rekap_insentif_dokter.php");
		$("#id-breadcrumbs").html("Rekapitulasi Insentif Dokter");
	});
</script>

<div id="form-nest" class="row-fluid" style="display:none">
	<div id="form" class="span12 well">
		
	</div>
</div>

<div class="row-fluid">
	<div id="data" class="span12 well">
		<img src='assets/images/ajax-loader.gif' />
	</div>
</div>