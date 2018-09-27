<!-- 
================= doc ====================
 filename     : js_rekap_pemeriksaan.php
 @package     : rekap_pemeriksaan
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-11-10
 @Modified    : 2017-11-10
 @copyright   : Copyright (c) 2017
================= doc ====================
-->
<script type="text/javascript">
	$(document).ready(function(){
		$("#data").load("laporan/rekap_pemeriksaan/lap_rekap_pemeriksaan.php");
		$("#id-breadcrumbs").html("Rekapitulasi Biaya Pemeriksaan");
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