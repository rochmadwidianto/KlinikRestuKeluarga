<!-- 
================= doc ====================
 filename     : class.poliklinik.php
 @package     : poliklinik
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-10-13
 @Modified    : 2017-10-13
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php

class poliklinik
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
				"INSERT INTO poliklinik(
						poliklinik_kode,
						poliklinik_nama,
						poliklinik_ruangan,
						poliklinik_penanggung_jawab,
						poliklinik_keterangan,
						created_by) 

				VALUES (:poliklinik_kode,
						:poliklinik_nama,
						:poliklinik_ruangan,
						:poliklinik_penanggung_jawab,
						:poliklinik_keterangan,
						:created_by)");	

			$query -> bindparam(":poliklinik_kode",$param['poliklinik_kode']);
			$query -> bindparam(":poliklinik_nama",$param['poliklinik_nama']);
			$query -> bindparam(":poliklinik_ruangan",$param['poliklinik_ruangan']);
			$query -> bindparam(":poliklinik_penanggung_jawab",$param['poliklinik_penanggung_jawab']);
			$query -> bindparam(":poliklinik_keterangan",$param['poliklinik_keterangan']);
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
		$query = $this->db->prepare("SELECT * FROM poliklinik WHERE poliklinik_id=:poliklinik_id");
		$query->execute(array(":poliklinik_id"=>$id));
		$editRow=$query->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	
	public function update($param = array())
	{
		try
		{
			$query=$this->db->prepare(
					"UPDATE poliklinik 
					SET 
						poliklinik_kode 	= :poliklinik_kode,
						poliklinik_nama		= :poliklinik_nama,
						poliklinik_ruangan	= :poliklinik_ruangan,
						poliklinik_penanggung_jawab	= :poliklinik_penanggung_jawab,
						poliklinik_keterangan 	= :poliklinik_keterangan,
						update_by 		= :update_by 
					WHERE poliklinik_id = :poliklinik_id");

			$query -> bindparam(":poliklinik_kode",$param['poliklinik_kode']);
			$query -> bindparam(":poliklinik_nama",$param['poliklinik_nama']);
			$query -> bindparam(":poliklinik_ruangan",$param['poliklinik_ruangan']);
			$query -> bindparam(":poliklinik_penanggung_jawab",$param['poliklinik_penanggung_jawab']);
			$query -> bindparam(":poliklinik_keterangan",$param['poliklinik_keterangan']);
			$query -> bindparam(":update_by",$param['update_by']);
			$query -> bindparam(":poliklinik_id",$param['poliklinik_id']);
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
			$query = $this->db->prepare("DELETE FROM poliklinik WHERE poliklinik_id=:poliklinik_id");
			$query->bindparam(":poliklinik_id",$id);
			$query->execute();
			echo "
			<div class='row-fluid'>
				<div class='span12'>
					<div class='alert alert-success'>
						<b>SUKSES!</b> Penghapusan data berhasil dilakukan
					</div>
				</div>
			</div>
			<strong><a href='javascript:void(0)' onclick='poliklinik()'> <i class='icon-backward'></i> Kembali</a></strong>";
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
			<strong><a href='javascript:void(0)' onclick='poliklinik()'> <i class='icon-backward'></i> Kembali</a></strong>";
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
	                <td><div align="center" width="50px"><?php print($row['poliklinik_kode']); ?></div></td>
	                <td><?php print($row['poliklinik_nama']); ?></td>
	                <td><div align="center"><?php print($row['poliklinik_ruangan']); ?></div></td>
	                <td><?php print($row['poliklinik_penanggung_jawab']); ?></td>
	                <td><?php print($row['poliklinik_keterangan']); ?></td>
	                <?php if ($_SESSION['s_level'] == 'administrator') { ?>
		                <td><div align="center">
		                <?php 
	                		if(strtoupper($row['is_used']) == 'YA'){
				                echo "                
				                <a class='btn btn-mini btn-warning' title='Edit' href='javascript:void(0)' onclick=\"editData('$row[poliklinik_id]')\" ><i class='icon-trash icon-pencil bigger-130'></i></i> </a>
				                <a class='btn btn-mini btn-secondary' title='Hapus' href='javascript:void(0)'><i class='icon-trash icon-red bigger-130'></i></i> </a>
				                ";
				            }else{
				                echo "                
				                <a class='btn btn-mini btn-warning' title='Edit' href='javascript:void(0)' onclick=\"editData('$row[poliklinik_id]')\" ><i class='icon-trash icon-pencil bigger-130'></i></i> </a>
				                <a class='btn btn-mini btn-danger' title='Hapus' href='javascript:void(0)' onclick=\"deleteData('$row[poliklinik_id]','$row[poliklinik_nama]')\" ><i class='icon-trash icon-red bigger-130'></i></i> </a>
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
	                <td><div align="center" width="50px"><?php print($row['poliklinik_kode']); ?></div></td>
	                <td><?php print($row['poliklinik_nama']); ?></td>
	                <td><div align="center"><?php print($row['poliklinik_ruangan']); ?></div></td>
	                <td><?php print($row['poliklinik_penanggung_jawab']); ?></td>
	                <td><?php print($row['poliklinik_keterangan']); ?></td>
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
