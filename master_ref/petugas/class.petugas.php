<!-- 
================= doc ====================
 filename     : class.petugas.php
 @package     : petugas
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-10-13
 @Modified    : 2017-10-13
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php

class petugas
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
				"INSERT INTO petugas(
						petugas_nomor,
						petugas_nama,
						petugas_gender,
						petugas_agama,
						petugas_telp,
						petugas_jabatan,
						petugas_alamat,
						petugas_keterangan,
						created_by) 

				VALUES (:petugas_nomor,
						:petugas_nama,
						:petugas_gender,
						:petugas_agama,
						:petugas_telp,
						:petugas_jabatan,
						:petugas_alamat,
						:petugas_keterangan,
						:created_by)");	

			$query -> bindparam(":petugas_nomor",$param['petugas_nomor']);
			$query -> bindparam(":petugas_nama",$param['petugas_nama']);
			$query -> bindparam(":petugas_gender",$param['petugas_gender']);
			$query -> bindparam(":petugas_agama",$param['petugas_agama']);
			$query -> bindparam(":petugas_telp",$param['petugas_telp']);
			$query -> bindparam(":petugas_jabatan",$param['petugas_jabatan']);
			$query -> bindparam(":petugas_alamat",$param['petugas_alamat']);
			$query -> bindparam(":petugas_keterangan",$param['petugas_keterangan']);
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
		$query = $this->db->prepare("SELECT * FROM petugas WHERE petugas_id=:petugas_id");
		$query->execute(array(":petugas_id"=>$id));
		$editRow=$query->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	
	public function update($param = array())
	{
		try
		{
			$query=$this->db->prepare(
					"UPDATE petugas 
					SET 
						petugas_nomor 	= :petugas_nomor,
						petugas_nama		= :petugas_nama,
						petugas_gender	= :petugas_gender,
						petugas_agama	= :petugas_agama,
						petugas_telp		= :petugas_telp,
						petugas_jabatan 	= :petugas_jabatan,
						petugas_alamat	= :petugas_alamat,
						petugas_keterangan 	= :petugas_keterangan,
						update_by 		= :update_by 
					WHERE petugas_id = :petugas_id");

			$query -> bindparam(":petugas_nomor",$param['petugas_nomor']);
			$query -> bindparam(":petugas_nama",$param['petugas_nama']);
			$query -> bindparam(":petugas_gender",$param['petugas_gender']);
			$query -> bindparam(":petugas_agama",$param['petugas_agama']);
			$query -> bindparam(":petugas_telp",$param['petugas_telp']);
			$query -> bindparam(":petugas_jabatan",$param['petugas_jabatan']);
			$query -> bindparam(":petugas_alamat",$param['petugas_alamat']);
			$query -> bindparam(":petugas_keterangan",$param['petugas_keterangan']);
			$query -> bindparam(":update_by",$param['update_by']);
			$query -> bindparam(":petugas_id",$param['petugas_id']);
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
			$query = $this->db->prepare("DELETE FROM petugas WHERE petugas_id=:petugas_id");
			$query->bindparam(":petugas_id",$id);
			$query->execute();
			echo "
			<div class='row-fluid'>
				<div class='span12'>
					<div class='alert alert-success'>
						<b>SUKSES!</b> Penghapusan data berhasil dilakukan
					</div>
				</div>
			</div>
			<strong><a href='javascript:void(0)' onclick='petugas()'> <i class='icon-backward'></i> Kembali</a></strong>";
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
			<strong><a href='javascript:void(0)' onclick='petugas()'> <i class='icon-backward'></i> Kembali</a></strong>";
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
                <td><div align="center" width="50px"><?php print($no); ?></div></td>
                <td><div align="center" width="50px"><?php print($row['petugas_nomor']); ?></div></td>
                <td><?php print($row['petugas_nama']); ?></td>
                <td><?php print($row['petugas_jabatan']); ?></td>
                <td><div align="center"><?php print($row['petugas_gender']); ?></div></td>
                <td><div align="center"><?php print($row['petugas_agama']); ?></div></td>
                <td><?php print($row['petugas_telp']); ?></td>
                <td><?php print($row['petugas_alamat']); ?></td>
                <td><?php print($row['petugas_keterangan']); ?></td>
				<?php if ($_SESSION['s_level'] == 'administrator') { ?>
	                <td><div align="center">
	                <?php echo "                
	                <a class='btn btn-mini btn-warning' title='Edit' href='javascript:void(0)' onclick=\"editData('$row[petugas_id]')\" ><i class='icon-trash icon-pencil bigger-130'></i></i> </a>
	                <a class='btn btn-mini btn-danger' title='Hapus' href='javascript:void(0)' onclick=\"deleteData('$row[petugas_id]','$row[petugas_nama]')\" ><i class='icon-trash icon-red bigger-130'></i></i> </a>
	                ";?>
	                </div>
	                </td>
	            <?php } ?>
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
           		<th colspan="10" align="center"><i>-- Data tidak ditemukan --</i></th>
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
	                <td><div align="center" width="50px"><?php print($row['petugas_nomor']); ?></div></td>
	                <td><?php print($row['petugas_nama']); ?></td>
                	<td><?php print($row['petugas_jabatan']); ?></td>
	                <td><div align="center"><?php print($row['petugas_gender']); ?></div></td>
	                <td><div align="center"><?php print($row['petugas_agama']); ?></div></td>
	                <td><?php print($row['petugas_telp']); ?></td>
	                <td><?php print($row['petugas_alamat']); ?></td>
	                <td><?php print($row['petugas_keterangan']); ?></td>
                </tr>
                <?php
                $no++;
			} 
		}
		else
		{
			?>
            <tr>
           		<th colspan="10" align="center"><i>-- Data tidak ditemukan --</i></th>
            </tr>
            <?php
		}		
	}
	
}
