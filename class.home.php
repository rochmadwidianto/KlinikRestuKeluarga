<!-- 
================= doc ====================
 filename     : class.home.php
 @package     : home
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-11-02
 @Modified    : 2017-11-02
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php
	 
	class Home {
	    private $db; //database conection link
	     
	    public function __construct($database) {
	        $this->db = $database;
	    }

	    public function countPendaftaran() {
		    $query = $this->db->prepare("SELECT COUNT(DISTINCT daftar_id) AS total_daftar FROM daftar LIMIT 0, 1");
		    $query->execute();
		    $rows = $query->fetch(PDO::FETCH_ASSOC);
		    return $rows;
		}

	    public function countRekamMedis() {
		    $query = $this->db->prepare("
		    	SELECT 
		    		COUNT(DISTINCT daftar_id) AS total_daftar,
					COUNT(DISTINCT rekam_medis_id) AS total_rekam_medis,
					ROUND(COUNT(DISTINCT rekam_medis_id)/COUNT(DISTINCT daftar_id)*100,0) AS persen_rekam_medis
				FROM daftar
				LEFT JOIN rekam_medis 
					ON rekam_medis_daftar_id = daftar_id 
				LIMIT 0, 1");
		    $query->execute();
		    $rows = $query->fetch(PDO::FETCH_ASSOC);
		    return $rows;
		}

	    public function countPeriksa() {
		    $query = $this->db->prepare("
		    	SELECT COUNT(DISTINCT daftar_id) AS total_daftar,
					COUNT(DISTINCT periksa_id) AS total_periksa,
					ROUND(COUNT(DISTINCT periksa_id)/COUNT(DISTINCT daftar_id)*100,0) AS persen_periksa
				FROM daftar
				LEFT JOIN rekam_medis 
					ON rekam_medis_daftar_id = daftar_id 
				LEFT JOIN periksa
					ON periksa_rekam_medis_id = rekam_medis_id
				LIMIT 0, 1");
		    $query->execute();
		    $rows = $query->fetch(PDO::FETCH_ASSOC);
		    return $rows;
		}

	    public function countBayar() {
		    $query = $this->db->prepare("
		    	SELECT COUNT(DISTINCT daftar_id) AS total_daftar,
					COUNT(DISTINCT bayar_id) AS total_bayar,
					ROUND(COUNT(DISTINCT bayar_id)/COUNT(DISTINCT daftar_id)*100,0) AS persen_bayar
				FROM daftar
				LEFT JOIN rekam_medis 
					ON rekam_medis_daftar_id = daftar_id 
				LEFT JOIN bayar
					ON bayar_rekam_medis_id = rekam_medis_id
				LIMIT 0, 1");
		    $query->execute();
		    $rows = $query->fetch(PDO::FETCH_ASSOC);
		    return $rows;
		}

	
		public function getJadwalDokter()
		{
			$query = $this->db->prepare(
				"SELECT 
					dok.*,
					pol.`poliklinik_kode`,
					pol.`poliklinik_nama`,
					SUBSTRING_INDEX(IFNULL(REPLACE(GROUP_CONCAT(CASE WHEN UPPER(dj.`dokter_jadwal_hari`) = 'SENIN' THEN dj.`dokter_jadwal_start` END, ','), ',', ''), NULL), ':', 2) AS senin_start,
					SUBSTRING_INDEX(IFNULL(REPLACE(GROUP_CONCAT(CASE WHEN UPPER(dj.`dokter_jadwal_hari`) = 'SENIN' THEN dj.`dokter_jadwal_end` END, ','), ',', ''), NULL), ':', 2) AS senin_end,
					SUBSTRING_INDEX(IFNULL(REPLACE(GROUP_CONCAT(CASE WHEN UPPER(dj.`dokter_jadwal_hari`) = 'SELASA' THEN dj.`dokter_jadwal_start` END, ','), ',', ''), NULL), ':', 2) AS selasa_start,
					SUBSTRING_INDEX(IFNULL(REPLACE(GROUP_CONCAT(CASE WHEN UPPER(dj.`dokter_jadwal_hari`) = 'SELASA' THEN dj.`dokter_jadwal_end` END, ','), ',', ''), NULL), ':', 2) AS selasa_end,
					SUBSTRING_INDEX(IFNULL(REPLACE(GROUP_CONCAT(CASE WHEN UPPER(dj.`dokter_jadwal_hari`) = 'RABU' THEN dj.`dokter_jadwal_start` END, ','), ',', ''), NULL), ':', 2) AS rabu_start,
					SUBSTRING_INDEX(IFNULL(REPLACE(GROUP_CONCAT(CASE WHEN UPPER(dj.`dokter_jadwal_hari`) = 'RABU' THEN dj.`dokter_jadwal_end` END, ','), ',', ''), NULL), ':', 2) AS rabu_end,
					SUBSTRING_INDEX(IFNULL(REPLACE(GROUP_CONCAT(CASE WHEN UPPER(dj.`dokter_jadwal_hari`) = 'KAMIS' THEN dj.`dokter_jadwal_start` END, ','), ',', ''), NULL), ':', 2) AS kamis_start,
					SUBSTRING_INDEX(IFNULL(REPLACE(GROUP_CONCAT(CASE WHEN UPPER(dj.`dokter_jadwal_hari`) = 'KAMIS' THEN dj.`dokter_jadwal_end` END, ','), ',', ''), NULL), ':', 2) AS kamis_end,
					SUBSTRING_INDEX(IFNULL(REPLACE(GROUP_CONCAT(CASE WHEN UPPER(dj.`dokter_jadwal_hari`) = 'JUMAT' THEN dj.`dokter_jadwal_start` END, ','), ',', ''), NULL), ':', 2) AS jumat_start,
					SUBSTRING_INDEX(IFNULL(REPLACE(GROUP_CONCAT(CASE WHEN UPPER(dj.`dokter_jadwal_hari`) = 'JUMAT' THEN dj.`dokter_jadwal_end` END, ','), ',', ''), NULL), ':', 2) AS jumat_end,
					SUBSTRING_INDEX(IFNULL(REPLACE(GROUP_CONCAT(CASE WHEN UPPER(dj.`dokter_jadwal_hari`) = 'SABTU' THEN dj.`dokter_jadwal_start` END, ','), ',', ''), NULL), ':', 2) AS sabtu_start,
					SUBSTRING_INDEX(IFNULL(REPLACE(GROUP_CONCAT(CASE WHEN UPPER(dj.`dokter_jadwal_hari`) = 'SABTU' THEN dj.`dokter_jadwal_end` END, ','), ',', ''), NULL), ':', 2) AS sabtu_end,
					SUBSTRING_INDEX(IFNULL(REPLACE(GROUP_CONCAT(CASE WHEN UPPER(dj.`dokter_jadwal_hari`) = 'MINGGU' THEN dj.`dokter_jadwal_start` END, ','), ',', ''), NULL), ':', 2) AS minggu_start,
					SUBSTRING_INDEX(IFNULL(REPLACE(GROUP_CONCAT(CASE WHEN UPPER(dj.`dokter_jadwal_hari`) = 'MINGGU' THEN dj.`dokter_jadwal_end` END, ','), ',', ''), NULL), ':', 2) AS minggu_end
				FROM dokter dok
				LEFT JOIN dokter_jadwal dj
				   ON dj.`dokter_jadwal_dokter_id` = dok.`dokter_id`
				JOIN poliklinik pol
				   ON pol.`poliklinik_id` = dok.`dokter_poliklinik_id`
				GROUP BY dokter_id
				ORDER BY dok.`dokter_nama` ASC");

			$query->execute();
			$no = 1;
			if($query->rowCount()>0)
			{
				while($row=$query->fetch(PDO::FETCH_ASSOC))
				{
					?>
	                <tr>
		                <td><div align="center" width="50px"><?php print($no); ?></div></td>
		                <td><?php print("<b>".strtoupper($row['dokter_nama'])."</b><br/>".$row['dokter_sip']); ?></td>
		                <td><?php print($row['poliklinik_kode'].' - '.$row['poliklinik_nama']); ?></td>
		                <td><div align="center"><?php print($row['senin_start']); ?></div></td>
		                <td><div align="center"><?php print($row['senin_end']); ?></div></td>
		                <td><div align="center"><?php print($row['selasa_start']); ?></div></td>
		                <td><div align="center"><?php print($row['selasa_end']); ?></div></td>
		                <td><div align="center"><?php print($row['rabu_start']); ?></div></td>
		                <td><div align="center"><?php print($row['rabu_end']); ?></div></td>
		                <td><div align="center"><?php print($row['kamis_start']); ?></div></td>
		                <td><div align="center"><?php print($row['kamis_end']); ?></div></td>
		                <td><div align="center"><?php print($row['jumat_start']); ?></div></td>
		                <td><div align="center"><?php print($row['jumat_end']); ?></div></td>
		                <td><div align="center"><?php print($row['sabtu_start']); ?></div></td>
		                <td><div align="center"><?php print($row['sabtu_end']); ?></div></td>
		                <td><div align="center"><?php print($row['minggu_start']); ?></div></td>
		                <td><div align="center"><?php print($row['minggu_end']); ?></div></td>
	                </tr>
	                <?php
	                $no++;
				} ?>
				<script type="text/javascript" charset="utf-8">
					$(document).ready(function() {
						$('#tabeldata').dataTable( {
							"sPaginationType": "bootstrap",
		                    "sSorting":[[2, "desc"]],
		                    "iDisplayLength": 5,
		                    "aLengthMenu": [5, 10, 25, 50, 100 ],
						});
					});
				</script><?php 
			}
			else
			{
				?>
	            <tr>
	           		<th colspan="18"><i>-- Data tidak ditemukan --</i></th>
	            </tr>
	            <?php
			}		
		}
	}
?>