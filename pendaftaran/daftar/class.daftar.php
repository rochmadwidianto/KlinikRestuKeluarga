<!-- 
================= doc ====================
 filename     : class.daftar.php
 @package     : daftar
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-10-14
 @Modified    : 2017-10-14
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php

class daftar
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
				"INSERT INTO daftar(
						daftar_tanggal,
						daftar_tindakan_id,
						daftar_layanan_id,
						daftar_poliklinik_id,
						daftar_pasien_id,
						daftar_keluhan,
						created_by) 

				VALUES (:daftar_tanggal,
						:daftar_tindakan_id,
						:daftar_layanan_id,
						:daftar_poliklinik_id,
						:daftar_pasien_id,
						:daftar_keluhan,
						:created_by)");	

			$query -> bindparam(":daftar_tanggal",$param['daftar_tanggal']);
			$query -> bindparam(":daftar_tindakan_id",$param['daftar_tindakan_id']);
			$query -> bindparam(":daftar_layanan_id",$param['daftar_layanan_id']);
			$query -> bindparam(":daftar_poliklinik_id",$param['daftar_poliklinik_id']);
			$query -> bindparam(":daftar_pasien_id",$param['daftar_pasien_id']);
			$query -> bindparam(":daftar_keluhan",$param['daftar_keluhan']);
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
		$query = $this->db->prepare("SELECT * FROM v_daftar WHERE daftar_id=:daftar_id");
		$query->execute(array(":daftar_id"=>$id));
		$editRow=$query->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}

	public function select($query){
		$query = $this->db->prepare($query);
		$query->execute();
		while($row=$query->fetch(PDO::FETCH_ASSOC)){
			echo "<option value='$row[daftar_id]'>$row[daftar_nama]</option>";
		}
		
	}

	public function select_layanan($query){
		$query = $this->db->prepare($query);
		$query->execute();
		while($row=$query->fetch(PDO::FETCH_ASSOC)){
			echo "<option value='$row[layanan_id]'>$row[layanan_nama]</option>";
		}
		
	}

	public function select_tindakan($query){
		$query = $this->db->prepare($query);
		$query->execute();
		while($row=$query->fetch(PDO::FETCH_ASSOC)){
			echo "<option value='$row[tindakan_id]'>$row[tindakan_nama]</option>";
		}
		
	}

	public function select_pasien($query){
		$query = $this->db->prepare($query);
		$query->execute();
		while($row=$query->fetch(PDO::FETCH_ASSOC)){
			echo "<option value='$row[pasien_id]'>$row[pasien_nomor] - $row[pasien_nama]</option>";
		}
		
	}

	public function select_poliklinik($query){
		$query = $this->db->prepare($query);
		$query->execute();
		while($row=$query->fetch(PDO::FETCH_ASSOC)){
			echo "<option value='$row[poliklinik_id]'>$row[poliklinik_nama]</option>";
		}
		
	}
	
	public function update($param = array())
	{
		try
		{
			$query=$this->db->prepare(
					"UPDATE daftar 
					SET 
						daftar_tanggal = :daftar_tanggal,
						daftar_tindakan_id = :daftar_tindakan_id,
						daftar_layanan_id = :daftar_layanan_id,
						daftar_poliklinik_id = :daftar_poliklinik_id,
						daftar_pasien_id = :daftar_pasien_id,
						daftar_keluhan = :daftar_keluhan,
						update_by = :update_by
					WHERE daftar_id = :daftar_id");

			$query -> bindparam(":daftar_tanggal",$param['daftar_tanggal']);
			$query -> bindparam(":daftar_tindakan_id",$param['daftar_tindakan_id']);
			$query -> bindparam(":daftar_layanan_id",$param['daftar_layanan_id']);
			$query -> bindparam(":daftar_poliklinik_id",$param['daftar_poliklinik_id']);
			$query -> bindparam(":daftar_pasien_id",$param['daftar_pasien_id']);
			$query -> bindparam(":daftar_keluhan",$param['daftar_keluhan']);
			$query -> bindparam(":update_by",$param['update_by']);
			$query -> bindparam(":daftar_id",$param['daftar_id']);
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
			$query = $this->db->prepare("DELETE FROM daftar WHERE daftar_id=:daftar_id");
			$query->bindparam(":daftar_id",$id);
			$query->execute();
			echo "
			<div class='row-fluid'>
				<div class='span12'>
					<div class='alert alert-success'>
						<b>SUKSES!</b> Penghapusan data berhasil dilakukan
					</div>
				</div>
			</div>
			<strong><a href='javascript:void(0)' onclick='daftar()'> <i class='icon-backward'></i> Kembali</a></strong>";
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
			<strong><a href='javascript:void(0)' onclick='daftar()'> <i class='icon-backward'></i> Kembali</a></strong>";
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
                <td><div align="center"><?php print(tgl_indo($row['daftar_tanggal'])); ?></div></td>
                <td><div align="center" width="50px"><?php print($row['pasien_nomor']); ?></div></td>
                <td><?php print($row['pasien_nama']); ?></td>
                <td><div align="center" width="50px"><?php print($row['tindakan_nama']); ?></div></td>
                <td><div align="center"><?php print($row['layanan_nama']); ?></div></td>
                <td><?php print($row['poliklinik_nama']); ?></td>
                <td><?php print($row['daftar_keluhan']); ?></td>
                <td><div align="center">
                	<?php 
                		if(strtoupper($row['daftar_is_rm']) == 'YA'){
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
                		if(strtoupper($row['daftar_is_rm']) == 'YA'){
                			echo "";
                		}else{
                			echo "<a class='btn btn-mini btn-warning' title='Edit' href='javascript:void(0)' onclick=\"editData('$row[daftar_id]')\" ><i class='icon-trash icon-pencil bigger-130'></i></i> </a>
				                <a class='btn btn-mini btn-danger' title='Hapus' href='javascript:void(0)' onclick=\"deleteData('$row[daftar_id]','$row[pasien_nomor] - $row[pasien_nama]')\" ><i class='icon-trash icon-red bigger-130'></i></i> </a>
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
           		<th colspan="12"><i>-- Data tidak ditemukan --</i></th>
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
	                <td><div align="center" width="50px"><?php print($row['tindakan_nama']); ?></div></td>
	                <td><div align="center"><?php print($row['layanan_nama']); ?></div></td>
	                <td><div align="center"><?php print(tgl_indo($row['daftar_tanggal'])); ?></div></td>
	                <td><?php print($row['daftar_keluhan']); ?></td>
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
