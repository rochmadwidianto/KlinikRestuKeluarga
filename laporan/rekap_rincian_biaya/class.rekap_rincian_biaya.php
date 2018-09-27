<!-- 
================= doc ====================
 filename     : class.rekap_rincian_biaya.php
 @package     : rekap_rincian_biaya
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-11-10
 @Modified    : 2017-11-10
 @copyright   : Copyright (c) 2017
================= doc ====================
-->
<?php

class rekap_rincian_biaya
{
	private $db;
	
	function __construct($pdo)
	{
		$this->db = $pdo;
	}

	public function select_rm_nomor($query){
		$query = $this->db->prepare($query);
		$query->execute();
		while($row=$query->fetch(PDO::FETCH_ASSOC)){
			echo "<option value='$row[rekam_medis_id]'>$row[rekam_medis_nomor]</option>";
		}
		
	}

	public function select_pasien($query){
		$query = $this->db->prepare($query);
		$query->execute();
		while($row=$query->fetch(PDO::FETCH_ASSOC)){
			echo "<option value='$row[pasien_id]'>$row[pasien_nama]</option>";
		}
		
	}
	
	public function sumRincianBiayaPemeriksaan($tanggal_awal, $tanggal_akhir, $pasien_id, $rekam_medis_id)
	{	

		$tanggal_awal 	= date('Y-m-d', strtotime($tanggal_awal));
		$tanggal_akhir 	= date('Y-m-d', strtotime($tanggal_akhir));

		if($pasien_id == ''){
			$pasien_id_idx = 1;
		}else{
			$pasien_id_idx = 0;
		}

		if($rekam_medis_id == ''){
			$rekam_medis_id_idx = 1;
		}else{
			$rekam_medis_id_idx = 0;
		}

		$query = $this->db->prepare("
			SELECT 
				IFNULL(SUM(bayar_jasa_dokter),0) AS sum_biaya_jasa_dokter,
				IFNULL(SUM(bayar_harga_obat),0) AS sum_biaya_obat,
				IFNULL(SUM(bayar_biaya_tindakan),0) AS sum_biaya_tindakan,
				IFNULL(SUM(bayar_biaya_laborat),0) AS sum_biaya_laborat,
				IFNULL(SUM(bayar_biaya_persalinan),0) AS sum_biaya_persalian,
				IFNULL(SUM(bayar_biaya_lain),0) AS sum_biaya_lain,
				IFNULL(SUM(bayar_biaya),0) AS sum_biaya_pemeriksaan
			FROM v_daftar_rm 
			WHERE (periksa_tanggal BETWEEN :tanggal_awal AND :tanggal_akhir) 
				AND (pasien_id = :pasien_id OR 1 = :pasien_id_idx)
				AND (rekam_medis_id = :rekam_medis_id OR 1 = :rekam_medis_id_idx)
				AND UPPER(daftar_is_periksa) = 'YA'
				AND UPPER(daftar_is_bayar) = 'YA'
			LIMIT 0, 1");

			$query -> bindparam(":tanggal_awal",$tanggal_awal);
			$query -> bindparam(":tanggal_akhir",$tanggal_akhir);
			$query -> bindparam(":pasien_id",$pasien_id);
			$query -> bindparam(":pasien_id_idx",$pasien_id_idx);
			$query -> bindparam(":rekam_medis_id",$rekam_medis_id);
			$query -> bindparam(":rekam_medis_id_idx",$rekam_medis_id_idx);

		$query->execute();
		$sum_biaya = $query->fetch(PDO::FETCH_ASSOC);
		return $sum_biaya;	
	}
	
	public function getRincianBiayaPemeriksaan($tanggal_awal, $tanggal_akhir, $pasien_id, $rekam_medis_id)
	{	
		$tanggal_awal 	= date('Y-m-d', strtotime($tanggal_awal));
		$tanggal_akhir 	= date('Y-m-d', strtotime($tanggal_akhir));

		if($pasien_id == ''){
			$pasien_id_idx = 1;
		}else{
			$pasien_id_idx = 0;
		}

		if($rekam_medis_id == ''){
			$rekam_medis_id_idx = 1;
		}else{
			$rekam_medis_id_idx = 0;
		}

		$query = $this->db->prepare("
			SELECT * 
			FROM v_daftar_rm 
			WHERE (periksa_tanggal BETWEEN :tanggal_awal AND :tanggal_akhir) 
				AND (pasien_id = :pasien_id OR 1 = :pasien_id_idx)
				AND (rekam_medis_id = :rekam_medis_id OR 1 = :rekam_medis_id_idx)
				AND UPPER(daftar_is_periksa) = 'YA'
				AND UPPER(daftar_is_bayar) = 'YA'
			ORDER BY periksa_tanggal DESC");

			$query -> bindparam(":tanggal_awal",$tanggal_awal);
			$query -> bindparam(":tanggal_akhir",$tanggal_akhir);
			$query -> bindparam(":pasien_id",$pasien_id);
			$query -> bindparam(":pasien_id_idx",$pasien_id_idx);
			$query -> bindparam(":rekam_medis_id",$rekam_medis_id);
			$query -> bindparam(":rekam_medis_id_idx",$rekam_medis_id_idx);

		$query->execute();
		$no = 1;
		if($query->rowCount()>0)
		{
			while($row=$query->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
	                <td><div align="center" width="50px"><?php print($no); ?></div></td>
	                <td><div align="center"><?php print(tgl_indo($row['periksa_tanggal'])); ?></div></td>
                	<td><div align="center"><?php print($row['rekam_medis_nomor']); ?></div></td>
	                <td><div align="right"><?php print(number_format($row['bayar_jasa_dokter'],2,',','.')); ?></div></td>
	                <td><div align="right"><?php print(number_format($row['bayar_harga_obat'],2,',','.')); ?></div></td>
	                <td><div align="right"><?php print(number_format($row['bayar_biaya_tindakan'],2,',','.')); ?></div></td>
	                <td><div align="right"><?php print(number_format($row['bayar_biaya_laborat'],2,',','.')); ?></div></td>
	                <td><div align="right"><?php print(number_format($row['bayar_biaya_persalinan'],2,',','.')); ?></div></td>
	                <td><div align="right"><?php print(number_format($row['bayar_biaya_lain'],2,',','.')); ?></div></td>
	                <td><div align="right"><?php print(number_format($row['bayar_biaya'],2,',','.')); ?></div></td>
                </tr>
                <?php
                $no++;
			} 
		}
		else
		{
			?>
            <tr>
           		<td colspan="10" align="center"><i>-- Data tidak ditemukan --</i></td>
            </tr>
            <?php
		}		
	}
}
