<!-- 
================= doc ====================
 filename     : home.php
 @package     : dashboard
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-11-02
 @Modified    : 2017-11-02
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<script type="text/javascript">
	$(document).ready(function(){
		$("#id-breadcrumbs").html("");
	});
</script>
<?php
    require_once('config/cekSession.php');
    require_once('config/koneksi.php');  
	require_once('class.home.php'); 

	$home = new Home($pdo);
?>
<div class="row-fluid">
	<div class="span12">
		<div class="well well-small">
			<span style="font-size: 13pt;"><marquee>Selamat Datang di <b>Sistem Informasi Manajemen Klinik Restu Keluarga</b></marquee></span>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span3">
		<div class="well" style="background-color: #87B87F; border-color: #87B87F; height: 120px">
			<div class="row-fluid">
				<div class="span3">
					<i class="icon-edit" style="font-size: 75px; color: #DCDCDC"></i>
				</div>
				<div class="span9">
					<p align="right" style="font-size: 12pt"><b> Pendaftaran</b></p>
					<p align="right" style="font-size: 32pt; color: #FFFFFF"><b>
						<?php
							extract($home->countPendaftaran());
							echo $total_daftar;				
						?>	
						</b>
					</p>
				</div>
			</div>
			<div class="well" style="margin: 17px -19px 0px -19px; padding-top: 1px; padding-bottom: 1px">
				<div class="row-fluid">
					<div class="span12" style="margin-top: 10px; margin-bottom: -8px">
						<div class="progress progress-success">
						  <div class="bar" style="width: 100%"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="span3">
		<div class="well" style="background-color: #6FB3E0; border-color: #6FB3E0; height: 120px">
			<div class="row-fluid">
				<div class="span3">
					<i class="icon-check" style="font-size: 75px; color: #DCDCDC"></i>
				</div>
				<div class="span9">
					<p align="right" style="font-size: 12pt"><b> Rekam Medis</b></p>
					<p align="right" style="font-size: 32pt; color: #FFFFFF"><b>
						<?php
							extract($home->countRekamMedis());
							echo $total_rekam_medis;				
						?>	
						</b>
					</p>
				</div>
			</div>
			<div class="well" style="margin: 17px -19px 0px -19px; padding-top: 1px; padding-bottom: 1px">
				<div class="row-fluid">
					<div class="span12" style="margin-top: 10px; margin-bottom: -8px">
						<div class="progress progress-info">
						  	<div class="bar" 
						  		style="width: <?php
									extract($home->countRekamMedis());
									echo $persen_rekam_medis.'%';				
								?>">
									
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="span3">
		<div class="well" style="background-color: #FFB752; border-color: #FFB752; height: 120px">
			<div class="row-fluid">
				<div class="span3">
					<i class="icon-glass" style="font-size: 75px; color: #DCDCDC"></i>
				</div>
				<div class="span9">
					<p align="right" style="font-size: 12pt"><b> Pemeriksaan</b></p>
					<p align="right" style="font-size: 32pt; color: #FFFFFF"><b>
						<?php
							extract($home->countPeriksa());
							echo $total_periksa;				
						?>	
						</b>
					</p>
				</div>
			</div>
			<div class="well" style="margin: 17px -19px 0px -19px; padding-top: 1px; padding-bottom: 1px">
				<div class="row-fluid">
					<div class="span12" style="margin-top: 10px; margin-bottom: -8px">
						<div class="progress progress-warning">
						  	<div class="bar" 
						  		style="width: <?php
									extract($home->countPeriksa());
									echo $persen_periksa.'%';				
								?>">
									
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="span3">
		<div class="well" style="background-color: #B15D47; border-color: #B15D47; height: 120px">
			<div class="row-fluid">
				<div class="span3">
					<i class="icon-tag" style="font-size: 75px; color: #DCDCDC"></i>
				</div>
				<div class="span9">
					<p align="right" style="font-size: 12pt"><b> Selesai</b></p>
					<p align="right" style="font-size: 32pt; color: #FFFFFF"><b>
						<?php
							extract($home->countBayar());
							echo $total_bayar;				
						?>	
						</b>
					</p>
				</div>
			</div>
			<div class="well" style="margin: 17px -19px 0px -19px; padding-top: 1px; padding-bottom: 1px">
				<div class="row-fluid">
					<div class="span12" style="margin-top: 10px; margin-bottom: -8px">
						<div class="progress progress-danger">
						  	<div class="bar" 
						  		style="width: <?php
									extract($home->countBayar());
									echo $persen_bayar.'%';				
								?>">
									
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<hr style="border-color: #1E90FF;">
<div class="row-fluid">
	<div class="span12">
		<div class="well">
			<h4 class="header smaller lighter blue"><i class="icon-calendar">  Jadwal Prakter Dokter</i></h4>
			<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%">
				<thead>
					<tr>
						<th rowspan="2" width="50px" align="center">No</th>
						<th rowspan="2" align="center">Nama</th>
						<th rowspan="2" align="center">Poliklinik</th>
						<th colspan="2" align="center">Senin</th>
						<th colspan="2" align="center">Selasa</th>
						<th colspan="2" align="center">Rabu</th>
						<th colspan="2" align="center">Kamis</th>
						<th colspan="2" align="center">Jumat</th>
						<th colspan="2" align="center">Sabtu</th>
						<th colspan="2" align="center">Minggu</th>
					</tr>
					<tr>
						<th align="center">Mulai</th>
						<th align="center">Selesai</th>
						<th align="center">Mulai</th>
						<th align="center">Selesai</th>
						<th align="center">Mulai</th>
						<th align="center">Selesai</th>
						<th align="center">Mulai</th>
						<th align="center">Selesai</th>
						<th align="center">Mulai</th>
						<th align="center">Selesai</th>
						<th align="center">Mulai</th>
						<th align="center">Selesai</th>
						<th align="center">Mulai</th>
						<th align="center">Selesai</th>
					</tr>
				</thead>
				<tbody>
					<?php	
						$home->getJadwalDokter();
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>