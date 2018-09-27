<div id="form" class="modal-laporan-rm" tabindex="-1" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<a href="javascript:void(0)" onclick="swapContent('laporan/rekam_medis/rekam_medis')">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				</a>
				<h4 class="blue bigger">Detail Rekam Medis</h4>
			</div>

			<div class="modal-body">
			<?php
			session_start();
			include_once('../../config/koneksi.php');
			include_once('../../config/fungsi_indotgl.php');
			include_once('class.rekam_medis.php');

			$id   = $_GET['pasien_id'];
			$rekam_medis = new rekam_medis($pdo);
			extract($rekam_medis->getPasienById($id));	

			//tanggal lahir
			$birthDt = new DateTime($pasien_tanggal_lahir);
			$today 	 = new DateTime('today');

			$year 	= $today->diff($birthDt)->y;
			$month 	= $today->diff($birthDt)->m;
			$day 	= $today->diff($birthDt)->d;

			?>
			<div class="row-fluid">
				<div class="span2">
					<div class="control-group">
						<label class="control-label" for="pasien_nomor" >Nomor</label>
					</div>
					<div class="control-group">
						<label class="control-label" for="pasien_nama" >Nama</label>
					</div>
					<div class="control-group">
						<label class="control-label" for="pasien_agama" >Agama</label>
					</div>
					<div class="control-group">
						<label class="control-label" for="pasien_gender" >Jenis Kelamin</label>
					</div>
				</div>
				<div class="span4">
					<div class="control-group">
						<label><b><?php echo $pasien_nomor; ?></b></label>
					</div>
					<div class="control-group">
						<label><b><?php echo $pasien_nama; ?></b></label>
					</div>
					<div class="control-group">
						<label><b><?php echo $pasien_agama; ?></b></label>
					</div>
					<div class="control-group">
						<label><b><?php echo $pasien_gender; ?></b></label>
					</div>
				</div>
				<div class="span2">
					<div class="control-group">
					<label class="control-label" for="pasien_umur" >Umur</label>
					</div>
					<div class="control-group">
					<label class="control-label" for="pasien_tanggal_lahir" >Tanggal Lahir</label>
					</div>
					<div class="control-group">
					<label class="control-label" for="pasien_telp" >Telp/HP</label>
					</div>
					<div class="control-group">
					<label class="control-label" for="pasien_alamat" >Alamat</label>
					</div>
				</div>
				<div class="span4">
					<div class="control-group">
						<label><b><?php echo $year.' Tahun '.$month.' Bulan '.$day.' Hari '; ?></b></label>
					</div>
					<div class="control-group">
						<label><b><?php echo tgl_indo($pasien_tanggal_lahir); ?></b></label>
					</div>
					<div class="control-group">
						<label><b><?php echo $pasien_telp; ?></b></label>
					</div>
					<div class="control-group">
						<label><b><?php echo $pasien_alamat; ?></b></label>
					</div>
				</div>
			</div>
	        <table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%">
				<thead>
					<tr>
						<th><div align="center">Tanggal</div></th>
						<th><div align="center">Anamnesa</div></th>
						<th><div align="center">Therapy</div></th>	
					</tr>
				</thead>
				<tbody>
					<?php
						$id   = $_GET['pasien_id'];
						$rekam_medis = new rekam_medis($pdo);
						$query = "SELECT * FROM v_daftar_rm WHERE pasien_id = '$id' GROUP BY rekam_medis_id ORDER BY rekam_medis_id DESC";
						$rekam_medis->view_detail($query);		
					?>
				</tbody>
			</table>
			<div class="modal-footer">
				<?php echo "
				<a href='javascript:void(0)' onclick=\"window.open('../klinik_restu_keluarga/laporan/rekam_medis/print_rekam_medis.php?pasien_id=$id')\"  class='btn btn-small btn-primary'><i class='icon-print icon-white'></i><b> Cetak</b></a>
				"; ?>
				<a href="javascript:void(0)" onclick="swapContent('laporan/rekam_medis/rekam_medis')" class="btn btn-small btn-danger"><i class='icon-remove'><b>  Tutup</b></i></a>
			</div>
		</div>
	</div>
</div>