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
						:rekam_medis_alergi,
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

	public function getDataPasien()
	{
		$query = $this->db->prepare("SELECT * FROM daftar JOIN pasien ON pasien_id = daftar_pasien_id WHERE daftar_is_periksa <> 'Ya'");
		$query->execute();
		$dataPasien = $query->fetch(PDO::FETCH_ASSOC);
		return $dataPasien;
	}

	public function getPasienNomor($daftar_id)
	{
		$query = $this->db->prepare("SELECT pasien_nomor FROM daftar JOIN pasien ON pasien_id = daftar_pasien_id WHERE daftar_id=:daftar_id");
		$query->execute(array(":daftar_id"=>$daftar_id));
		$pasien_kode=$query->fetch(PDO::FETCH_ASSOC);
		return $pasien_kode;
	}

	public function generateNumber($pasien_kode)
	{
		$query = $this->db->prepare("SELECT CONCAT('RM',DATE_FORMAT(NOW(),'%Y%m%d'),'.', :pasien_kode,'.', LPAD(IFNULL(MAX(SUBSTRING_INDEX(rekam_medis_nomor, '.',-1)+0)+1, 1),3,0)) AS generate_nomor_rm FROM rekam_medis WHERE rekam_medis_tanggal = DATE(NOW())");
		$query->execute(array(":pasien_kode"=>$pasien_kode));
		$getNumb=$query->fetch(PDO::FETCH_ASSOC);
		return $getNumb;
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
	
	public function update_status_rm($daftar_id, $update_by, $status_rm = 'Ya')
	{
		try
		{
			$query=$this->db->prepare(
					"UPDATE daftar 
					SET 
						daftar_is_rm = :daftar_is_rm,
						update_by = :update_by
					WHERE daftar_id = :daftar_id");

			$query -> bindparam(":daftar_is_rm", $status_rm);
			$query -> bindparam(":update_by", $update_by);
			$query -> bindparam(":daftar_id", $daftar_id);
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
			/* Update Status RM */
			$get_rm = $this->getID($id);
			$query = $this->db->prepare("UPDATE daftar SET daftar_is_rm = 'Tidak' WHERE daftar_id=:daftar_id");
			$query->bindparam(":daftar_id",$get_rm['rekam_medis_daftar_id']);
			$query->execute();
			/* END - Update Status RM */

			$query = $this->db->prepare("DELETE FROM rekam_medis WHERE rekam_medis_id=:rekam_medis_id");
			$query->bindparam(":rekam_medis_id",$id);
			$query->execute();
			echo "
			<div class='row-fluid'>
				<div class='span12'>
					<div class='alert alert-success'>
						<b>SUKSES!</b> Penghapusan data berhasil dilakukan
					</div>
				</div>
			</div>
			<strong><a href='javascript:void(0)' onclick='rekam_medis()'> <i class='icon-backward'></i> Kembali</a></strong>";
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
			<strong><a href='javascript:void(0)' onclick='rekam_medis()'> <i class='icon-backward'></i> Kembali</a></strong>";
			return false;
		}
	}

	public function getListPasien($query)
	{
		$query = $this->db->prepare($query);
		$query->execute();
		$no = 1;
		if($query->rowCount()>0)
		{
			while($row=$query->fetch(PDO::FETCH_ASSOC))
			{

				/* Hitung Usia */
				$birthDt = new DateTime($row['pasien_tanggal_lahir']);
				$today 	 = new DateTime('today');

				$year 	= $today->diff($birthDt)->y;
				$month 	= $today->diff($birthDt)->m;
				$day 	= $today->diff($birthDt)->d;
				/* END - Hitung Usia */

				?>
                <tr>
                <td><div align="center"><?php print($no); ?></div></td>
                <td><div align="center"><?php print($row['pasien_nomor']); ?></div></td>
                <td><?php print($row['pasien_nama']); ?></td>
                <td><div align="center"><?php print($row['pasien_gender']); ?></div></td>
                <td><div align="center"><?php print($row['pasien_agama']); ?></div></td>
                <td><div align="center"><?php print(tgl_indo($row['pasien_tanggal_lahir'])); ?></div></td>
                <td><div align="center"><?php print($year.' Tahun '.$month.' Bulan'); ?></div></td>
                <td><?php print($row['daftar_keluhan']); ?></td>
                <td><div align="center">
                	<?php 
                		echo "<a class='btn btn-mini btn-info' title='Pilih' href='javascript:void(0)' onclick=\"selectPasien('$row[pasien_id]','$row[pasien_nomor]','$row[pasien_nama]')\" ><i class='icon-ok icon-ok'></i></i> </a>
				                ";
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
                <td><div align="center"><?php print(tgl_indo($row['rekam_medis_tanggal'])); ?></div></td>
                <td><?php print($row['rekam_medis_alergi']); ?></td>
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
                <td><div align="center">
                	<?php 
                		if(strtoupper($row['daftar_is_periksa']) == 'YA'){
                			echo "";
                		}else{
                			echo "<a class='btn btn-mini btn-warning' title='Edit' href='javascript:void(0)' onclick=\"editData('$row[rekam_medis_id]')\" ><i class='icon-trash icon-pencil bigger-130'></i></i> </a>
				                <a class='btn btn-mini btn-danger' title='Hapus' href='javascript:void(0)' onclick=\"deleteData('$row[rekam_medis_id]','$row[rekam_medis_nomor]')\" ><i class='icon-trash icon-red bigger-130'></i></i> </a>
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
	                <td><div align="center"><?php print(tgl_indo($row['rekam_medis_tanggal'])); ?></div></td>
	                <td><?php print($row['rekam_medis_alergi']); ?></td>
	                <td><?php print($row['rekam_medis_diagnosa']); ?></td>
	                <td><?php print($row['rekam_medis_terapi']); ?></td>
	                <td><div align="center">
	                	<?php 
	                		if(strtoupper($row['daftar_is_periksa']) == 'YA'){
	                			echo "SUDAH";
	                			// echo "<a href='javascript: void(0);' title='Sudah'
			                 //        <img src='assets/images/icons/lamp_green.gif' alt='Sudah'>
			                 //     </a>";
	                		}else{
	                			echo "BELUM";
	                			// echo "<a href='javascript: void(0);' title='Belum'
			                 //        <img src='assets/images/icons/lamp_yellow.gif' alt='Belum'>
			                 //     </a>";
	                		}
	                	?>
	                	</div>
	                </td>
	                <td><div align="center">
	                	<?php 
	                		if(strtoupper($row['daftar_is_bayar']) == 'YA'){
	                			echo "SUDAH";
	                			// echo "<a href='javascript: void(0);' title='Sudah'
			                 //        <img src='assets/images/icons/lamp_green.gif' alt='Sudah'>
			                 //     </a>";
	                		}else{
	                			echo "BELUM";
	                			// echo "<a href='javascript: void(0);' title='Belum'
			                 //        <img src='assets/images/icons/lamp_yellow.gif' alt='Belum'>
			                 //     </a>";
	                		}
	                	?>
	                	</div>
	                </td>
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
