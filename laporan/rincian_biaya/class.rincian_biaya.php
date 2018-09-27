<!-- 
================= doc ====================
 filename     : class.rincian_biaya.php
 @package     : rincian_biaya
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-10-18
 @Modified    : 2017-10-18
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php

class rincian_biaya
{
	private $db;
	
	function __construct($pdo)
	{
		$this->db = $pdo;
	}
	
	public function create($param = array())
	{
		try
		{
			$query = $this->db->prepare(
				"INSERT INTO rincian_biaya(
						rincian_biaya_rekam_medis_id,
						rincian_biaya_tanggal,
						rincian_biaya_biaya,
						created_by) 

				VALUES (:rincian_biaya_rekam_medis_id,
						:rincian_biaya_tanggal,
						:rincian_biaya_biaya,
						:created_by)");	

			$query -> bindparam(":rincian_biaya_rekam_medis_id",$param['rincian_biaya_rekam_medis_id']);
			$query -> bindparam(":rincian_biaya_tanggal",$param['rincian_biaya_tanggal']);
			$query -> bindparam(":rincian_biaya_biaya",$param['rincian_biaya_biaya']);
			$query -> bindparam(":created_by",$param['created_by']);
			$query->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo "
				<div class='alert alert-danger'>
					<button type='button' class='close' data-dismiss='alert'>&times;</button>
					<strong>Terjadi kesalahan !</strong> Data Gagal di Simpan
				</div>";	
			return false;
		}
	}

	public function getID($id)
	{
		$query = $this->db->prepare("SELECT * FROM v_daftar_rm WHERE rekam_medis_id=:rekam_medis_id");
		$query->execute(array(":rekam_medis_id"=>$id));
		$editRow=$query->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	
	public function update_daftar($param = array())
	{
		try
		{
			$query=$this->db->prepare(
					"UPDATE daftar 
					SET 
						daftar_is_rincian_biaya = :status_rincian_biaya,
						update_by = :created_by
					WHERE daftar_id = :rincian_biaya_daftar_id");

			$query -> bindparam(":status_rincian_biaya",$param['status_rincian_biaya']);
			$query -> bindparam(":created_by",$param['created_by']);
			$query -> bindparam(":rincian_biaya_daftar_id",$param['rincian_biaya_daftar_id']);
			$query -> execute();			
			return true;	
		}
		catch(PDOException $e)
		{
			echo  "
				<div class='alert alert-danger'>
					<button type='button' class='close' data-dismiss='alert'>&times;</button>
					<strong>Terjadi kesalahan!</strong> Data Gagal di Update
				</div>";	
			return false;
		}
	}

	public function view($query)
	{
		$query = $this->db->prepare($query);
		$query->execute();
		$no = 1;
		if($query->rowCount()>0)
		{
			while($row=$query->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
	                <td><div align="center"><?php print($no); ?></div></td>
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
           		<th colspan="11"><i>-- Data tidak ditemukan --</i></th>
            </tr>
            <?php
		}		
	}
	
	public function Prin($query)
	{
		$query = $this->db->prepare($query);
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
           		<td colspan="10"><i>-- Data tidak ditemukan --</i></td>
            </tr>
            <?php
		}		
	}
	
}
