<!-- 
================= doc ====================
 filename     : class.periksa.php
 @package     : periksa
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-10-15
 @Modified    : 2017-10-15
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php

class periksa
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
				"INSERT INTO periksa(
						periksa_rekam_medis_id,
						periksa_tanggal,
						periksa_hasil,
						periksa_catatan,
						created_by) 

				VALUES (:periksa_rekam_medis_id,
						:periksa_tanggal,
						:periksa_hasil,
						:periksa_catatan,
						:created_by)");	

			$query -> bindparam(":periksa_rekam_medis_id",$param['periksa_rekam_medis_id']);
			$query -> bindparam(":periksa_tanggal",$param['periksa_tanggal']);
			$query -> bindparam(":periksa_hasil",$param['periksa_hasil']);
			$query -> bindparam(":periksa_catatan",$param['periksa_catatan']);
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
	
	public function update_rm($param = array())
	{
		try
		{
			$query=$this->db->prepare(
					"UPDATE rekam_medis 
					SET 
						rekam_medis_terapi = :periksa_terapi,
						update_by = :created_by
					WHERE rekam_medis_id = :periksa_rekam_medis_id");

			$query -> bindparam(":periksa_terapi",$param['periksa_terapi']);
			$query -> bindparam(":created_by",$param['created_by']);
			$query -> bindparam(":periksa_rekam_medis_id",$param['periksa_rekam_medis_id']);
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
	
	public function update_daftar($param = array())
	{
		try
		{
			$query=$this->db->prepare(
					"UPDATE daftar 
					SET 
						daftar_is_periksa = :status_periksa,
						update_by = :created_by
					WHERE daftar_id = :periksa_daftar_id");

			$query -> bindparam(":status_periksa",$param['status_periksa']);
			$query -> bindparam(":created_by",$param['created_by']);
			$query -> bindparam(":periksa_daftar_id",$param['periksa_daftar_id']);
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
	
	public function delete($id)
	{
		try{
			$query = $this->db->prepare("DELETE FROM periksa WHERE periksa_id=:periksa_id");
			$query->bindparam(":periksa_id",$id);
			$query->execute();
			echo "
			<div class='row-fluid'>
				<div class='span12'>
					<div class='alert alert-success'>
						<b>SUKSES!</b> Penghapusan data berhasil dilakukan
					</div>
				</div>
			</div>
			<strong><a href='javascript:void(0)' onclick='periksa()'> <i class='icon-backward'></i> Kembali</a></strong>";
			return true;
		}catch(PDOException $e){
			echo "
			<div class='row-fluid'>
				<div class='span12'>
					<div class='alert alert-error'>
						<b>GAGAL!</b> Data tidak bisa dihapus karena sudah digunakan
					</div>
				</div>
			</div>
			<strong><a href='javascript:void(0)' onclick='periksa()'> <i class='icon-backward'></i> Kembali</a></strong>";
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
                <td><div align="center"><?php print(tgl_indo($row['periksa_tanggal'])); ?></div></td>
                <td><?php print($row['daftar_keluhan']); ?></td>
                <td><?php print($row['rekam_medis_diagnosa']); ?></td>
                <td><?php print($row['rekam_medis_terapi']); ?></td>
                <td width="90px"><div align="center">
                	<?php 
                		if(strtoupper($row['daftar_is_periksa']) == 'YA'){
                			echo "<span class='badge badge-pill badge-success'><i class='icon-ok bigger-100'></i></span>
				                ";
                		}else{
                			echo "<a class='btn btn-mini btn-warning' title='Periksa' href='javascript:void(0)' onclick=\"editData('$row[rekam_medis_id]')\" ><i class='icon-ok bigger-130'></i> <b>Periksa</b></a>
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
	                <td><div align="center"><?php print(tgl_indo($row['periksa_tanggal'])); ?></div></td>
	                <td><?php print($row['daftar_keluhan']); ?></td>
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
                	</div></td>
                </tr>
                <?php
                $no++;
			} 
		}
		else
		{
			?>
            <tr>
           		<td colspan="6"><i>-- Data tidak ditemukan --</i></td>
            </tr>
            <?php
		}		
	}
	
}
