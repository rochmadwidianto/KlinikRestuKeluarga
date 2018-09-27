<!-- 
================= doc ====================
 filename     : class.pasien.php
 @package     : pasien
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-10-12
 @Modified    : 2017-10-12
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php

class pasien
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
				"INSERT INTO pasien(
						pasien_nomor,
						pasien_nama,
						pasien_gender,
						pasien_agama,
						pasien_telp,
						pasien_tanggal_lahir,
						pasien_umur,
						pasien_alamat,
						pasien_keterangan,
						created_by) 

				VALUES (:pasien_nomor,
						:pasien_nama,
						:pasien_gender,
						:pasien_agama,
						:pasien_telp,
						:pasien_tanggal_lahir,
						:pasien_umur,
						:pasien_alamat,
						:pasien_keterangan,
						:created_by)");	

			$query -> bindparam(":pasien_nomor",$param['pasien_nomor']);
			$query -> bindparam(":pasien_nama",$param['pasien_nama']);
			$query -> bindparam(":pasien_gender",$param['pasien_gender']);
			$query -> bindparam(":pasien_agama",$param['pasien_agama']);
			$query -> bindparam(":pasien_telp",$param['pasien_telp']);
			$query -> bindparam(":pasien_tanggal_lahir",$param['pasien_tanggal_lahir']);
			$query -> bindparam(":pasien_umur",$param['pasien_umur']);
			$query -> bindparam(":pasien_alamat",$param['pasien_alamat']);
			$query -> bindparam(":pasien_keterangan",$param['pasien_keterangan']);
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
	
	public function generate_number($query)
	{
		$query = $this->db->prepare($query);
		$query->execute();
		$get_numb = $query->fetch(PDO::FETCH_ASSOC);
		return $get_numb;
	}

	public function getID($id)
	{
		$query = $this->db->prepare("SELECT * FROM pasien WHERE pasien_id=:pasien_id");
		$query->execute(array(":pasien_id"=>$id));
		$editRow=$query->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	
	public function update($param = array())
	{
		try
		{
			$query=$this->db->prepare(
					"UPDATE pasien 
					SET 
						pasien_nomor 	= :pasien_nomor,
						pasien_nama		= :pasien_nama,
						pasien_gender	= :pasien_gender,
						pasien_agama	= :pasien_agama,
						pasien_telp		= :pasien_telp,
						pasien_tanggal_lahir	= :pasien_tanggal_lahir,
						pasien_umur 	= :pasien_umur,
						pasien_alamat	= :pasien_alamat,
						pasien_keterangan 	= :pasien_keterangan,
						update_by 		= :update_by 
					WHERE pasien_id = :pasien_id");

			$query -> bindparam(":pasien_nomor",$param['pasien_nomor']);
			$query -> bindparam(":pasien_nama",$param['pasien_nama']);
			$query -> bindparam(":pasien_gender",$param['pasien_gender']);
			$query -> bindparam(":pasien_agama",$param['pasien_agama']);
			$query -> bindparam(":pasien_telp",$param['pasien_telp']);
			$query -> bindparam(":pasien_tanggal_lahir",$param['pasien_tanggal_lahir']);
			$query -> bindparam(":pasien_umur",$param['pasien_umur']);
			$query -> bindparam(":pasien_alamat",$param['pasien_alamat']);
			$query -> bindparam(":pasien_keterangan",$param['pasien_keterangan']);
			$query -> bindparam(":update_by",$param['update_by']);
			$query -> bindparam(":pasien_id",$param['pasien_id']);
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
			$query = $this->db->prepare("DELETE FROM pasien WHERE pasien_id=:pasien_id");
			$query->bindparam(":pasien_id",$id);
			$query->execute();
			echo "
			<div class='row-fluid'>
				<div class='span12'>
					<div class='alert alert-success'>
						<b>SUKSES!</b> Penghapusan data berhasil dilakukan
					</div>
				</div>
			</div>
			<strong><a href='javascript:void(0)' onclick='pasien()'> <i class='icon-backward'></i> Kembali</a></strong>";
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
			<strong><a href='javascript:void(0)' onclick='pasien()'> <i class='icon-backward'></i> Kembali</a></strong>";
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
	                <td><div align="center" width="50px"><?php print($row['pasien_nomor']); ?></div></td>
	                <td><?php print($row['pasien_nama']); ?></td>
	                <td><div align="center"><?php print($row['pasien_gender']); ?></div></td>
	                <td><div align="center"><?php print($row['pasien_agama']); ?></div></td>
	                <td><?php print($row['pasien_telp']); ?></td>
	                <td><div align="center"><?php print($row['pasien_umur']); ?></div></td>
	                <td><?php print($row['pasien_alamat']); ?></td>
	                <td><?php print($row['pasien_keterangan']); ?></td>
	                <td><div align="center">
	                <?php 
	                	if(strtoupper($row['is_used']) == 'YA'){
	                		echo "                
			                <a class='btn btn-mini btn-warning' title='Edit' href='javascript:void(0)' onclick=\"editData('$row[pasien_id]')\" ><i class='icon-trash icon-pencil bigger-130'></i></i> </a>
			                <a class='btn btn-mini btn-secondary' title='Hapus' href='javascript:void(0)' ><i class='icon-trash icon-red bigger-130'></i></i> </a>
			                ";
			            }else{
	                		echo "                
			                <a class='btn btn-mini btn-warning' title='Edit' href='javascript:void(0)' onclick=\"editData('$row[pasien_id]')\" ><i class='icon-trash icon-pencil bigger-130'></i></i> </a>
			                <a class='btn btn-mini btn-danger' title='Hapus' href='javascript:void(0)' onclick=\"deleteData('$row[pasien_id]','$row[pasien_nama]')\" ><i class='icon-trash icon-red bigger-130'></i></i> </a>
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
           		<th colspan="7"><i>-- Data tidak ditemukan --</i></th>
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
	                <td><div align="center" width="50px"><?php print($row['pasien_nomor']); ?></div></td>
	                <td><?php print($row['pasien_nama']); ?></td>
	                <td><div align="center"><?php print($row['pasien_gender']); ?></div></td>
	                <td><div align="center"><?php print($row['pasien_agama']); ?></div></td>
	                <td><?php print($row['pasien_telp']); ?></td>
	                <td><div align="center"><?php print($row['pasien_umur']); ?></div></td>
	                <td><?php print($row['pasien_alamat']); ?></td>
	                <td><?php print($row['pasien_keterangan']); ?></td>
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
