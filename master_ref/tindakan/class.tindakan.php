<!-- 
================= doc ====================
 filename     : class.tindakan.php
 @package     : tindakan
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-10-13
 @Modified    : 2017-10-13
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php

class tindakan
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
				"INSERT INTO tindakan(
						tindakan_kode,
						tindakan_nama,
						created_by) 

				VALUES (:tindakan_kode,
						:tindakan_nama,
						:created_by)");	

			$query -> bindparam(":tindakan_kode",$param['tindakan_kode']);
			$query -> bindparam(":tindakan_nama",$param['tindakan_nama']);
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
		$query = $this->db->prepare("SELECT * FROM tindakan WHERE tindakan_id=:tindakan_id");
		$query->execute(array(":tindakan_id"=>$id));
		$editRow=$query->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	
	public function update($param = array())
	{
		try
		{
			$query=$this->db->prepare(
					"UPDATE tindakan 
					SET 
						tindakan_kode 	= :tindakan_kode,
						tindakan_nama		= :tindakan_nama,
						update_by 		= :update_by 
					WHERE tindakan_id = :tindakan_id");

			$query -> bindparam(":tindakan_kode",$param['tindakan_kode']);
			$query -> bindparam(":tindakan_nama",$param['tindakan_nama']);
			$query -> bindparam(":update_by",$param['update_by']);
			$query -> bindparam(":tindakan_id",$param['tindakan_id']);
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
			$query = $this->db->prepare("DELETE FROM tindakan WHERE tindakan_id=:tindakan_id");
			$query->bindparam(":tindakan_id",$id);
			$query->execute();
			echo "
			<div class='row-fluid'>
				<div class='span12'>
					<div class='alert alert-success'>
						<b>SUKSES!</b> Penghapusan data berhasil dilakukan
					</div>
				</div>
			</div>
			<strong><a href='javascript:void(0)' onclick='tindakan()'> <i class='icon-backward'></i> Kembali</a></strong>";
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
			<strong><a href='javascript:void(0)' onclick='tindakan()'> <i class='icon-backward'></i> Kembali</a></strong>";
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
	                <td><div align="center" width="50px"><?php print($row['tindakan_kode']); ?></div></td>
	                <td><?php print($row['tindakan_nama']); ?></td>
	                <?php if ($_SESSION['s_level'] == 'administrator') { ?>
		                <td><div align="center">
		                <?php
	                		if(strtoupper($row['is_used']) == 'YA'){
				                echo "                
				                <a class='btn btn-mini btn-warning' title='Edit' href='javascript:void(0)' onclick=\"editData('$row[tindakan_id]')\" ><i class='icon-trash icon-pencil bigger-130'></i></i> </a>
				                <a class='btn btn-mini btn-secondary' title='Hapus' href='javascript:void(0)'><i class='icon-trash icon-red bigger-130'></i></i> </a>
				                ";
				            }else{
				                echo "                
				                <a class='btn btn-mini btn-warning' title='Edit' href='javascript:void(0)' onclick=\"editData('$row[tindakan_id]')\" ><i class='icon-trash icon-pencil bigger-130'></i></i> </a>
				                <a class='btn btn-mini btn-danger' title='Hapus' href='javascript:void(0)' onclick=\"deleteData('$row[tindakan_id]','$row[tindakan_nama]')\" ><i class='icon-trash icon-red bigger-130'></i></i> </a>
				                ";
				            }
				        ?>
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
	                <td><div align="center" width="50px"><?php print($row['tindakan_kode']); ?></div></td>
	                <td><?php print($row['tindakan_nama']); ?></td>
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
