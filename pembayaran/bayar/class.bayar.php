<!-- 
================= doc ====================
 filename     : class.bayar.php
 @package     : bayar
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-10-18
 @Modified    : 2017-10-18
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php

class bayar
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
				"INSERT INTO bayar(
						bayar_rekam_medis_id,
						bayar_tanggal,
						bayar_jasa_dokter,
						bayar_harga_obat,
						bayar_biaya_tindakan,
						bayar_biaya_laborat,
						bayar_biaya_persalinan,
						bayar_biaya_lain,
						bayar_biaya,
						created_by) 

				VALUES (:bayar_rekam_medis_id,
						:bayar_tanggal,
						:bayar_jasa_dokter,
						:bayar_harga_obat,
						:bayar_biaya_tindakan,
						:bayar_biaya_laborat,
						:bayar_biaya_persalinan,
						:bayar_biaya_lain,
						:bayar_biaya,
						:created_by)");	

			$query -> bindparam(":bayar_rekam_medis_id",$param['bayar_rekam_medis_id']);
			$query -> bindparam(":bayar_tanggal",$param['bayar_tanggal']);
			$query -> bindparam(":bayar_jasa_dokter",$param['bayar_jasa_dokter']);
			$query -> bindparam(":bayar_harga_obat",$param['bayar_harga_obat']);
			$query -> bindparam(":bayar_biaya_tindakan",$param['bayar_biaya_tindakan']);
			$query -> bindparam(":bayar_biaya_laborat",$param['bayar_biaya_laborat']);
			$query -> bindparam(":bayar_biaya_persalinan",$param['bayar_biaya_persalinan']);
			$query -> bindparam(":bayar_biaya_lain",$param['bayar_biaya_lain']);
			$query -> bindparam(":bayar_biaya",$param['bayar_biaya']);
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
						daftar_is_bayar = :status_bayar,
						update_by = :created_by
					WHERE daftar_id = :bayar_daftar_id");

			$query -> bindparam(":status_bayar",$param['status_bayar']);
			$query -> bindparam(":created_by",$param['created_by']);
			$query -> bindparam(":bayar_daftar_id",$param['bayar_daftar_id']);
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
                <td><div align="center"><?php print($row['rekam_medis_nomor']); ?></div></td>
                <td><div align="center" width="50px"><?php print($row['pasien_nomor']); ?></div></td>
                <td><?php print($row['pasien_nama']); ?></td>
                <td><div align="center"><?php print(tgl_indo($row['bayar_tanggal'])); ?></div></td>
                <td><?php print($row['rekam_medis_diagnosa']); ?></td>
                <td><?php print($row['rekam_medis_terapi']); ?></td>
                <td><div align="center">
                	<?php 
                		if(strtoupper($row['daftar_is_periksa']) == 'YA'){
                			echo "<span class='badge badge-pill badge-success'><i class='icon-ok bigger-100'></i></span>
				                ";
                		}else{
                			echo "<span class='badge badge-pill badge-important'><i class='icon-remove bigger-100'></i></span>
				                ";
                		}
                	?>
                	</div>
                </td>
                <td><div align="center">
                	<?php 
                		if(strtoupper($row['daftar_is_bayar']) == 'YA'){
                			echo "<span class='badge badge-pill badge-success'><i class='icon-ok bigger-100'></i></span>
				                ";
                		}else{
                			echo "<span class='badge badge-pill badge-important'><i class='icon-remove bigger-100'></i></span>
				                ";
                		}
                	?>
                	</div>
                </td>
                <td><div align="right"><?php print(number_format($row['bayar_biaya'],2,',','.')); ?></div></td>
                <td width="90px"><div align="center">
                	<?php 
                		if(strtoupper($row['daftar_is_periksa']) == 'YA'){
	                		if(strtoupper($row['daftar_is_bayar']) == 'YA'){
	                			echo "<a class='btn btn-mini btn-info' title='Bayar' href='javascript:void(0)' onclick=\"printKuitansi('$row[rekam_medis_id]')\" ><i class='icon-print bigger-130'></i> <b></b></a>";
	                		}else{
	                			echo "<a class='btn btn-mini btn-warning' title='Bayar' href='javascript:void(0)' onclick=\"editData('$row[rekam_medis_id]')\" ><i class='icon-ok bigger-130'></i> <b>Bayar</b></a>
					                ";
	                		}
	                	}else{
	                		echo "<a class='btn btn-mini btn-secondary' title='Bayar' href='javascript:void(0)' ><i class='icon-ok bigger-130'></i> <b>Bayar</b></a>
					                ";
					    }
                	?>
                </div>
                </td>
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
	                <td><div align="center"><?php print($row['rekam_medis_nomor']); ?></div></td>
	                <td><div align="center" width="50px"><?php print($row['pasien_nomor']); ?></div></td>
	                <td><?php print($row['pasien_nama']); ?></td>
	                <td><div align="center"><?php print(tgl_indo($row['bayar_tanggal'])); ?></div></td>
	                <td><?php print($row['rekam_medis_diagnosa']); ?></td>
	                <td><?php print($row['rekam_medis_terapi']); ?></td>
	                <td><div align="center">
	                	<?php 
	                		if(strtoupper($row['daftar_is_periksa']) == 'YA'){
	                			echo "SUDAH";
	                		}else{
	                			echo "BELUM";
	                		}
	                	?>
	                	</div>
	                </td>
	                <td><div align="center">
	                	<?php 
	                		if(strtoupper($row['daftar_is_bayar']) == 'YA'){
	                			echo "SUDAH";
	                		}else{
	                			echo "BELUM";
	                		}
	                	?>
	                	</div>
	                </td>
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
