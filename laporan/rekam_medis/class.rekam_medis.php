<!-- 
================= doc ====================
 filename     : class.rekam_medis.php
 @package     : rekam_medis
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-10-14
 @Modified    : 2017-10-14
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php

class rekam_medis
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
				"INSERT INTO rekam_medis(
						rekam_medis_tanggal,
						rekam_medis_nomor,
						rekam_medis_daftar_id,
						rekam_medis_alergi,
						rekam_medis_diagnosa,
						rekam_medis_terapi,
						created_by) 

				VALUES (:rekam_medis_tanggal,
						:rekam_medis_nomor,
						:rekam_medis_daftar_id,
						:rekam_medis_diagnosa,
						:rekam_medis_terapi,
						:created_by)");	

			$query -> bindparam(":rekam_medis_tanggal",$param['rekam_medis_tanggal']);
			$query -> bindparam(":rekam_medis_nomor",$param['rekam_medis_nomor']);
			$query -> bindparam(":rekam_medis_daftar_id",$param['rekam_medis_daftar_id']);
			$query -> bindparam(":rekam_medis_alergi",$param['rekam_medis_alergi']);
			$query -> bindparam(":rekam_medis_diagnosa",$param['rekam_medis_diagnosa']);
			$query -> bindparam(":rekam_medis_terapi",$param['rekam_medis_terapi']);
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

	public function select($query){
		$query = $this->db->prepare($query);
		$query->execute();
		while($row=$query->fetch(PDO::FETCH_ASSOC)){
			echo "<option value='$row[rekam_medis_id]'>$row[rekam_medis_nama]</option>";
		}
		
	}

	public function select_pasien_daftar($query){
		$query = $this->db->prepare($query);
		$query->execute();
		while($row=$query->fetch(PDO::FETCH_ASSOC)){
			echo "<option value='$row[daftar_id]'>$row[pasien_nomor] - $row[pasien_nama]</option>";
		}
		
	}
	
	public function update($param = array())
	{
		try
		{
			$query=$this->db->prepare(
					"UPDATE rekam_medis 
					SET 
						rekam_medis_tanggal = :rekam_medis_tanggal,
						rekam_medis_nomor = :rekam_medis_nomor,
						rekam_medis_daftar_id = :rekam_medis_daftar_id,
						rekam_medis_alergi = :rekam_medis_alergi,
						rekam_medis_diagnosa = :rekam_medis_diagnosa,
						rekam_medis_terapi = :rekam_medis_terapi,
						update_by = :update_by
					WHERE rekam_medis_id = :rekam_medis_id");

			$query -> bindparam(":rekam_medis_tanggal",$param['rekam_medis_tanggal']);
			$query -> bindparam(":rekam_medis_nomor",$param['rekam_medis_nomor']);
			$query -> bindparam(":rekam_medis_daftar_id",$param['rekam_medis_daftar_id']);
			$query -> bindparam(":rekam_medis_alergi",$param['rekam_medis_alergi']);
			$query -> bindparam(":rekam_medis_diagnosa",$param['rekam_medis_diagnosa']);
			$query -> bindparam(":rekam_medis_terapi",$param['rekam_medis_terapi']);
			$query -> bindparam(":update_by",$param['update_by']);
			$query -> bindparam(":rekam_medis_id",$param['rekam_medis_id']);
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
			$query = $this->db->prepare("DELETE FROM rekam_medis WHERE rekam_medis_id=:rekam_medis_id");
			$query->bindparam(":rekam_medis_id",$id);
			$query->execute();
			echo "
			<div class='alert alert-success'>
			<button type='button' class='close' data-dismiss='alert'>&times;</button>
			Data Berhasil Di Hapus
			</div>
			<strong><a href='javascript:void(0)' onclick='rekam_medis()'> <i class='icon-backward'></i> Kembali</a></strong>";
			return true;
		}catch(PDOException $e){
			echo "
			<div class='alert alert-error'>
			<button type='button' class='close' data-dismiss='alert'>&times;</button>
			Data Tidak Bisa di Hapus Karena Sudah Di pakai !
			</div>
			<strong><a href='javascript:void(0)' onclick='rekam_medis()'> <i class='icon-backward'></i> Kembali</a></strong>";
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
                <td><div align="center" width="50px"><?php print($row['pasien_nomor']); ?></div></td>
                <td><?php print($row['pasien_nama']); ?></td>
                <td><div align="center"><?php print($row['pasien_gender']); ?></div></td>
                <td><div align="center"><?php print(tgl_indo($row['pasien_tanggal_lahir'])); ?></div></td>
                <td><?php print($row['pasien_telp']); ?></td>
                <td><?php print($row['pasien_alamat']); ?></td>
                <td><div align="center">
                	<?php 
                		echo "<a class='btn btn-mini btn-info' title='Detail' href='javascript:void(0)' onclick=\"getDetail('$row[pasien_id]')\" ><i class='icon-list bigger-130'></i></i> </a>";
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

	public function getPasienById($id)
	{
		$query = $this->db->prepare("SELECT * FROM v_daftar_rm WHERE pasien_id=:pasien_id GROUP BY pasien_id LIMIT 0, 1");
		$query->execute(array(":pasien_id"=>$id));
		$detPasien = $query->fetch(PDO::FETCH_ASSOC);
		return $detPasien;
	}
	
	public function view_detail($query)
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
	                <td width="130px;"><div align="center"><?php print(tgl_indo($row['rekam_medis_tanggal'])); ?></div></td>
	                <td><?php print($row['rekam_medis_diagnosa']); ?></div></td>
	                <td><?php print($row['rekam_medis_terapi']); ?></td>
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
           		<th colspan="3"><i>-- Data tidak ditemukan --</i></th>
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
	                <td width="130px;"><div align="center"><?php print(tgl_indo($row['rekam_medis_tanggal'])); ?></div></td>
	                <td><?php print($row['rekam_medis_diagnosa']); ?></div></td>
	                <td><?php print($row['rekam_medis_terapi']); ?></td>
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
