<div id="form" class="modal-laporan-rm" tabindex="-1" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<a href="javascript:void(0)" onclick="swapContent('pendaftaran/rekam_medis/rekam_medis')">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				</a>
				<h4 class="blue bigger">Daftar Pasien</h4>
			</div>

			<div class="modal-body">
			<?php
			session_start();
			include_once('../../config/koneksi.php');
			include_once('../../config/fungsi_indotgl.php');
			include_once('class.rekam_medis.php');

			$rekam_medis = new rekam_medis($pdo);
			extract($rekam_medis->getDataPasien());	

			?>
	        <table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%">
				<thead>
					<tr>
						<th><div align="center">No</div></th>
						<th><div align="center">Kode</div></th>
						<th><div align="center">Nama</div></th>
						<th><div align="center">Jenis Kelamin</div></th>
						<th><div align="center">Agama</div></th>
						<th><div align="center">Tanggal Lahir</div></th>
						<th><div align="center">Umur</div></th>
						<th><div align="center">Keluhan</div></th>
						<th><div align="center">Aksi</div></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$rekam_medis = new rekam_medis($pdo);
						$query = "SELECT * FROM daftar JOIN pasien ON pasien_id = daftar_pasien_id WHERE daftar_is_periksa <> 'Ya'";
						$rekam_medis->getListPasien($query);		
					?>
				</tbody>
			</table>
			<div class="modal-footer">
				<a href="javascript:void(0)" onclick="swapContent('laporan/rekam_medis/rekam_medis')" class="btn btn-danger"> Tutup</a>
			</div>
		</div>
	</div>
</div>
</div>