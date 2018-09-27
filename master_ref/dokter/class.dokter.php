<!-- 
================= doc ====================
 filename     : class.dokter.php
 @package     : dokter
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-10-12
 @Modified    : 2017-10-12
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php

class dokter
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
				"INSERT INTO dokter(
						dokter_poliklinik_id,
						dokter_nama,
						dokter_sip,
						dokter_gender,
						dokter_agama,
						dokter_telp,
						dokter_tanggal_lahir,
						dokter_alamat,
						created_by) 

				VALUES (:dokter_poliklinik_id,
						:dokter_nama,
						:dokter_sip,
						:dokter_gender,
						:dokter_agama,
						:dokter_telp,
						:dokter_tanggal_lahir,
						:dokter_alamat,
						:created_by)");	

			$query -> bindparam(":dokter_poliklinik_id",$param['dokter_poliklinik_id']);
			$query -> bindparam(":dokter_nama",$param['dokter_nama']);
			$query -> bindparam(":dokter_sip",$param['dokter_sip']);
			$query -> bindparam(":dokter_gender",$param['dokter_gender']);
			$query -> bindparam(":dokter_agama",$param['dokter_agama']);
			$query -> bindparam(":dokter_telp",$param['dokter_telp']);
			$query -> bindparam(":dokter_tanggal_lahir",$param['dokter_tanggal_lahir']);
			$query -> bindparam(":dokter_alamat",$param['dokter_alamat']);
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
	
	public function create_jadwal($dokter_id, $jadwal = array(), $jam = array())
	{
		try
		{
			$query = $this->db->prepare(
				"INSERT INTO dokter_jadwal(
						dokter_jadwal_dokter_id,
						dokter_jadwal_hari,
						dokter_jadwal_start,
						dokter_jadwal_end) 

				VALUES (:dokter_jadwal_dokter_id,
						:dokter_jadwal_hari,
						:dokter_jadwal_start,
						:dokter_jadwal_end)");	

			foreach($jadwal as $hari){

				if(strtoupper($hari) == 'SENIN'){
					$start_time = $jam['senin_start'];
					$end_time 	= $jam['senin_end'];
				}elseif(strtoupper($hari) == 'SELASA'){
					$start_time = $jam['selasa_start'];
					$end_time 	= $jam['selasa_end'];
				}elseif(strtoupper($hari) == 'RABU'){
					$start_time = $jam['rabu_start'];
					$end_time 	= $jam['rabu_end'];
				}elseif(strtoupper($hari) == 'KAMIS'){
					$start_time = $jam['kamis_start'];
					$end_time 	= $jam['kamis_end'];
				}elseif(strtoupper($hari) == 'JUMAT'){
					$start_time = $jam['jumat_start'];
					$end_time 	= $jam['jumat_end'];
				}elseif(strtoupper($hari) == 'SABTU'){
					$start_time = $jam['sabtu_start'];
					$end_time 	= $jam['sabtu_end'];
				}else{
					$start_time = $jam['minggu_start'];
					$end_time 	= $jam['minggu_end'];
				}

				$query -> bindparam(":dokter_jadwal_dokter_id",$dokter_id);
				$query -> bindparam(":dokter_jadwal_hari",$hari);
				$query -> bindparam(":dokter_jadwal_start",$start_time);
				$query -> bindparam(":dokter_jadwal_end",$end_time);

				$query->execute();
			}

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
		$query = $this->db->prepare("
				SELECT 
					*,
					SUBSTRING_INDEX(IFNULL(REPLACE(GROUP_CONCAT(CASE WHEN UPPER(dj.`dokter_jadwal_hari`) = 'SENIN' THEN dj.`dokter_jadwal_start` END, ','), ',', ''), NULL), ':', 2) AS senin_start,
					SUBSTRING_INDEX(IFNULL(REPLACE(GROUP_CONCAT(CASE WHEN UPPER(dj.`dokter_jadwal_hari`) = 'SENIN' THEN dj.`dokter_jadwal_end` END, ','), ',', ''), NULL), ':', 2) AS senin_end,
					SUBSTRING_INDEX(IFNULL(REPLACE(GROUP_CONCAT(CASE WHEN UPPER(dj.`dokter_jadwal_hari`) = 'SELASA' THEN dj.`dokter_jadwal_start` END, ','), ',', ''), NULL), ':', 2) AS selasa_start,
					SUBSTRING_INDEX(IFNULL(REPLACE(GROUP_CONCAT(CASE WHEN UPPER(dj.`dokter_jadwal_hari`) = 'SELASA' THEN dj.`dokter_jadwal_end` END, ','), ',', ''), NULL), ':', 2) AS selasa_end,
					SUBSTRING_INDEX(IFNULL(REPLACE(GROUP_CONCAT(CASE WHEN UPPER(dj.`dokter_jadwal_hari`) = 'RABU' THEN dj.`dokter_jadwal_start` END, ','), ',', ''), NULL), ':', 2) AS rabu_start,
					SUBSTRING_INDEX(IFNULL(REPLACE(GROUP_CONCAT(CASE WHEN UPPER(dj.`dokter_jadwal_hari`) = 'RABU' THEN dj.`dokter_jadwal_end` END, ','), ',', ''), NULL), ':', 2) AS rabu_end,
					SUBSTRING_INDEX(IFNULL(REPLACE(GROUP_CONCAT(CASE WHEN UPPER(dj.`dokter_jadwal_hari`) = 'KAMIS' THEN dj.`dokter_jadwal_start` END, ','), ',', ''), NULL), ':', 2) AS kamis_start,
					SUBSTRING_INDEX(IFNULL(REPLACE(GROUP_CONCAT(CASE WHEN UPPER(dj.`dokter_jadwal_hari`) = 'KAMIS' THEN dj.`dokter_jadwal_end` END, ','), ',', ''), NULL), ':', 2) AS kamis_end,
					SUBSTRING_INDEX(IFNULL(REPLACE(GROUP_CONCAT(CASE WHEN UPPER(dj.`dokter_jadwal_hari`) = 'JUMAT' THEN dj.`dokter_jadwal_start` END, ','), ',', ''), NULL), ':', 2) AS jumat_start,
					SUBSTRING_INDEX(IFNULL(REPLACE(GROUP_CONCAT(CASE WHEN UPPER(dj.`dokter_jadwal_hari`) = 'JUMAT' THEN dj.`dokter_jadwal_end` END, ','), ',', ''), NULL), ':', 2) AS jumat_end,
					SUBSTRING_INDEX(IFNULL(REPLACE(GROUP_CONCAT(CASE WHEN UPPER(dj.`dokter_jadwal_hari`) = 'SABTU' THEN dj.`dokter_jadwal_start` END, ','), ',', ''), NULL), ':', 2) AS sabtu_start,
					SUBSTRING_INDEX(IFNULL(REPLACE(GROUP_CONCAT(CASE WHEN UPPER(dj.`dokter_jadwal_hari`) = 'SABTU' THEN dj.`dokter_jadwal_end` END, ','), ',', ''), NULL), ':', 2) AS sabtu_end,
					SUBSTRING_INDEX(IFNULL(REPLACE(GROUP_CONCAT(CASE WHEN UPPER(dj.`dokter_jadwal_hari`) = 'MINGGU' THEN dj.`dokter_jadwal_start` END, ','), ',', ''), NULL), ':', 2) AS minggu_start,
					SUBSTRING_INDEX(IFNULL(REPLACE(GROUP_CONCAT(CASE WHEN UPPER(dj.`dokter_jadwal_hari`) = 'MINGGU' THEN dj.`dokter_jadwal_end` END, ','), ',', ''), NULL), ':', 2) AS minggu_end
				FROM dokter dok
				JOIN poliklinik pol
				   ON pol.`poliklinik_id` = dok.`dokter_poliklinik_id`
				LEFT JOIN dokter_jadwal dj
				   ON dj.`dokter_jadwal_dokter_id` = dok.`dokter_id`
				WHERE dok.`dokter_id` = :dokter_id
				ORDER BY dj.`dokter_jadwal_id` ASC");
		$query->execute(array(":dokter_id"=>$id));
		$editRow=$query->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}

	public function getDokterId()
	{
		$query = $this->db->prepare("SELECT MAX(dokter_id) AS dokter_id FROM dokter LIMIT 0, 1");
		$query->execute();
		$dokter_id=$query->fetch(PDO::FETCH_ASSOC);
		return $dokter_id;
	}

	public function select($query){
		$query = $this->db->prepare($query);
		$query->execute();
		while($row=$query->fetch(PDO::FETCH_ASSOC)){
			echo "<option value='$row[dokter_id]'>$row[dokter_nama]</option>";
		}
		
	}

	public function select_poliklinik($query){
		$query = $this->db->prepare($query);
		$query->execute();
		while($row=$query->fetch(PDO::FETCH_ASSOC)){
			echo "<option value='$row[poliklinik_id]'>$row[poliklinik_nama]</option>";
		}
		
	}
	
	public function deleteJadwal($id)
	{
		$query = $this->db->prepare("DELETE FROM dokter_jadwal WHERE dokter_jadwal_dokter_id=:dokter_id");
		$query->bindparam(":dokter_id",$id);
		$query->execute();
		return true;
	}
	
	public function update($param = array())
	{
		try
		{
			$query=$this->db->prepare(
					"UPDATE dokter 
					SET 
						dokter_poliklinik_id 	= :dokter_poliklinik_id,
						dokter_nama		= :dokter_nama,
						dokter_sip		= :dokter_sip,
						dokter_gender	= :dokter_gender,
						dokter_agama	= :dokter_agama,
						dokter_telp		= :dokter_telp,
						dokter_tanggal_lahir	= :dokter_tanggal_lahir,
						dokter_alamat	= :dokter_alamat,
						update_by 		= :update_by 
					WHERE dokter_id = :dokter_id");

			$query -> bindparam(":dokter_poliklinik_id",$param['dokter_poliklinik_id']);
			$query -> bindparam(":dokter_nama",$param['dokter_nama']);
			$query -> bindparam(":dokter_sip",$param['dokter_sip']);
			$query -> bindparam(":dokter_gender",$param['dokter_gender']);
			$query -> bindparam(":dokter_agama",$param['dokter_agama']);
			$query -> bindparam(":dokter_telp",$param['dokter_telp']);
			$query -> bindparam(":dokter_tanggal_lahir",$param['dokter_tanggal_lahir']);
			$query -> bindparam(":dokter_alamat",$param['dokter_alamat']);
			$query -> bindparam(":update_by",$param['update_by']);
			$query -> bindparam(":dokter_id",$param['dokter_id']);
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
			$query = $this->db->prepare("DELETE FROM dokter WHERE dokter_id=:dokter_id");
			$query->bindparam(":dokter_id",$id);
			$query->execute();
			echo "
			<div class='row-fluid'>
				<div class='span12'>
					<div class='alert alert-success'>
						<b>SUKSES!</b> Penghapusan data berhasil dilakukan
					</div>
				</div>
			</div>
			<strong><a href='javascript:void(0)' onclick='dokter()'> <i class='icon-backward'></i> Kembali</a></strong>";
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
			<strong><a href='javascript:void(0)' onclick='dokter()'> <i class='icon-backward'></i> Kembali</a></strong>";
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
	                <td><?php print($row['dokter_nama']); ?></td>
	                <td><div align="center" width="50px"><?php print($row['dokter_sip']); ?></div></td>
	                <td><div align="center"><?php print($row['dokter_gender']); ?></div></td>
	                <td><div align="center"><?php print($row['dokter_agama']); ?></div></td>
	                <td><?php print($row['dokter_telp']); ?></td>
	                <td><?php print($row['dokter_alamat']); ?></td>
	                <td><?php print($row['poliklinik_nama']); ?></td>
					<?php if ($_SESSION['s_level'] == 'administrator') { ?>
		                <td><div align="center">
		                <?php 
		                	if(strtoupper($row['is_used']) == 'YA'){
		                		echo "            
				                <a class='btn btn-mini btn-warning' title='Edit' href='javascript:void(0)' onclick=\"editData('$row[dokter_id]')\" ><i class='icon-trash icon-pencil bigger-130'></i></i> </a>
				                <a class='btn btn-mini btn-secondary' title='Hapus' href='javascript:void(0)'><i class='icon-trash icon-red bigger-130'></i></i> </a>
				                ";
			            	}else{
		                		echo "            
				                <a class='btn btn-mini btn-warning' title='Edit' href='javascript:void(0)' onclick=\"editData('$row[dokter_id]')\" ><i class='icon-trash icon-pencil bigger-130'></i></i> </a>
				                <a class='btn btn-mini btn-danger' title='Hapus' href='javascript:void(0)' onclick=\"deleteData('$row[dokter_id]','$row[dokter_nama]')\" ><i class='icon-trash icon-red bigger-130'></i></i> </a>
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
	                <td><?php print($row['dokter_nama']); ?></td>
	                <td><div align="center" width="50px"><?php print($row['dokter_sip']); ?></div></td>
	                <td><div align="center"><?php print($row['dokter_gender']); ?></div></td>
	                <td><div align="center"><?php print($row['dokter_agama']); ?></div></td>
	                <td><?php print($row['dokter_telp']); ?></td>
	                <td><?php print($row['dokter_alamat']); ?></td>
                	<td><?php print($row['poliklinik_nama']); ?></td>
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
