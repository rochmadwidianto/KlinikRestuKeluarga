<?php

class rekap_insentif_dokter
{
	private $db;
	
	function __construct($pdo)
	{
		$this->db = $pdo;
	}

	public function select_dokter($query){
		$query = $this->db->prepare($query);
		$query->execute();
		while($row=$query->fetch(PDO::FETCH_ASSOC)){
			echo "<option value='$row[dokter_id]'>$row[dokter_nama]</option>";
		}
		
	}

	public function getDokterById($dokter_id)
	{
		$query = $this->db->prepare("SELECT * FROM dokter JOIN poliklinik ON poliklinik_id = dokter_poliklinik_id WHERE dokter_id = :dokter_id LIMIT 0, 1");
		$query->execute(array(":dokter_id"=>$dokter_id));
		$dokter = $query->fetch(PDO::FETCH_ASSOC);
		return $dokter;
	}
	
	public function sumInsentifDokter($dokter_id, $bulan_awal, $bulan_akhir, $tahun)
	{
		$query = $this->db->prepare("
			SELECT SUM(bayar_jasa_dokter) AS sum_jasa_dokter
			FROM v_daftar_rm 
			WHERE dokter_id = :dokter_id
				AND (MONTH(periksa_tanggal) BETWEEN :bulan_awal AND :bulan_akhir) 
				AND YEAR(periksa_tanggal) = :tahun
				AND UPPER(daftar_is_periksa) = 'YA'
				AND UPPER(daftar_is_bayar) = 'YA'
			LIMIT 0, 1");

			$query -> bindparam(":dokter_id",$dokter_id);
			$query -> bindparam(":bulan_awal",$bulan_awal);
			$query -> bindparam(":bulan_akhir",$bulan_akhir);
			$query -> bindparam(":tahun",$tahun);

		$query->execute();
		$sum_insentif = $query->fetch(PDO::FETCH_ASSOC);
		return $sum_insentif;	
	}
	
	public function getInsentifDokter($dokter_id, $bulan_awal, $bulan_akhir, $tahun)
	{
		$query = $this->db->prepare("
			SELECT * 
			FROM v_daftar_rm 
			WHERE dokter_id = :dokter_id
				AND (MONTH(periksa_tanggal) BETWEEN :bulan_awal AND :bulan_akhir) 
				AND YEAR(periksa_tanggal) = :tahun
				AND UPPER(daftar_is_periksa) = 'YA'
				AND UPPER(daftar_is_bayar) = 'YA'
			ORDER BY periksa_tanggal DESC");

			$query -> bindparam(":dokter_id",$dokter_id);
			$query -> bindparam(":bulan_awal",$bulan_awal);
			$query -> bindparam(":bulan_akhir",$bulan_akhir);
			$query -> bindparam(":tahun",$tahun);

		$query->execute();
		$no = 1;
		if($query->rowCount()>0)
		{
			while($row=$query->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
		            <td align="center" width="50px"><?php print($no); ?></td>
	                <td align="center"><?php print(tgl_indo($row['periksa_tanggal'])); ?></td>
	                <td align="center"><?php print($row['rekam_medis_nomor']); ?></td>
	                <td align="right"><?php print(number_format($row['bayar_jasa_dokter'],2,',','.')); ?></td>
                </tr>
                <?php
                $no++;
			} 
		}
		else
		{
			?>
            <tr>
           		<td colspan="10"><i>-- Data tidak ditemukan --</i></td>
            </tr>
            <?php
		}		
	}
}
