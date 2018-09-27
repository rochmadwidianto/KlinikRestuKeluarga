<!-- 
================= doc ====================
 filename     : class.user.php
 @package     : user
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-11-02
 @Modified    : 2017-11-02
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php

class user
{
	private $db;
	
	function __construct($pdo)
	{
		$this->db = $pdo;
	}
	
	public function create($username,$password,$nama_lengkap,$email,$no_telp,$level,$aktif,$file_name,$created_by)
	{
		try
		{
			$query = $this->db->prepare("INSERT INTO users(username,password,nama_lengkap,email,no_telp,level,aktif,foto_user,created_by) VALUES (:username, :password, :nama_lengkap, :email, :no_telp, :level, :aktif, :foto_user, :created_by)");
			$query -> bindparam(":username",$username);
			$query -> bindparam(":password",$password);
			$query -> bindparam(":nama_lengkap",$nama_lengkap);
			$query -> bindparam(":email",$email);
			$query -> bindparam(":no_telp",$no_telp);
			$query -> bindparam(":level",$level);
			$query -> bindparam(":aktif",$aktif);
			$query -> bindparam(":foto_user",$file_name);
			$query -> bindparam(":created_by",$created_by);
			$query->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo "
		<div class='alert alert-error'>
		<button type='button' class='close' data-dismiss='alert'>&times;</button>
		Username sudah ada silahkan ulangi kembali
		</div>";	
			return false;
		}
	}
	
	public function getID($id)
	{
		$query = $this->db->prepare("SELECT * FROM users WHERE username=:id");
		$query->execute(array(":id"=>$id));
		$editRow=$query->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	
	public function update($username,$password,$nama_lengkap,$email,$no_telp,$level,$aktif,$file_name,$update_by)
	{
		try
		{
			$query=$this->db->prepare("UPDATE users SET password 		= :password, 
		                                               	nama_lengkap 	= :nama_lengkap, 
													   	email 			= :email, 
													   	no_telp 		= :no_telp,
													   	level 			= :level,
													   	aktif 			= :aktif,
													   	foto_user 		= :foto_user,
													   	update_by 		= :update_by
													WHERE username 		= :username ");
			$query -> bindparam(":password",$password);
			$query -> bindparam(":nama_lengkap",$nama_lengkap);
			$query -> bindparam(":email",$email);
			$query -> bindparam(":no_telp",$no_telp);
			$query -> bindparam(":level",$level);
			$query -> bindparam(":aktif",$aktif);
			$query -> bindparam(":foto_user",$file_name);
			$query -> bindparam(":username",$username);
			$query -> bindparam(":update_by",$update_by);
			$query -> execute();
			
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}
	
	public function delete($id)
	{
		// code untuk hapus
		$query = $this->db->prepare("DELETE FROM users WHERE username=:id");
		$query->bindparam(":id",$id);
		$query->execute();
		return true;
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
                <td><div align="center"><?php print($no);?></div></td>
                <td><?php print($row['username']); ?></td>
                <td><?php print($row['nama_lengkap']); ?></td>
                <td><?php print($row['email']); ?></td>
                <td><?php print($row['no_telp']); ?></td>
                <td><?php print($row['level']); ?></td>
                <td><div align="center">
                	<?php 
                		if(strtoupper($row['aktif']) == 'Y'){
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
                <?php echo "
                <a class='btn btn-mini btn-warning' title='Edit' href='javascript:void(0)' onclick=\"editData('$row[username]')\" ><i class='icon-trash icon-pencil bigger-130'></i></i></a>
                <a class='btn btn-mini btn-danger' title='Hapus' href='javascript:void(0)' onclick=\"deleteData('$row[username]')\" ><i class='icon-trash icon-red bigger-130'></i></i></a>
                ";?>
                </div>
                </td>
                </tr>
                <?php
                $no++;
			} ?>
			<script type="text/javascript" charset="utf-8">
				$(document).ready(function() {
					$('#tabeldata').dataTable( {
						"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
						"sPaginationType": "bootstrap",
	                    "sSorting":[[2, "desc"]],
	                    "iDisplayLength": 5,
	                    "aLengthMenu": [5, 10, 25, 50, 100 ],
						"oLanguage":{
							"sProcessing": "Sedang Memproses",
							"sLengthMenu": "Tampilkan _MENU_ entri",
							"sZeroRecords": "Tidak ditemukan data yang sesuai",
							"sInfo": "_START_ sampai _END_ dari _TOTAL_ entri",
							"sInfoEmpty": "0 sampai 0 dari 0 entri",
							"sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
							"sInfoPostFix": "",
							"sSearch": "Cari",
							"sUrl": "",
							
						}
					} );
				} );
			</script> <?php
		}
		else
		{
			?>
            <tr>
           		<td colspan="8"><i>-- Data tidak ditemukan --</i></td>
            </tr>
            <?php
		}		
	}
	
	public function prin($query)
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
                	 <td align="center"><div align="center"><?php print($no); ?></div></td>
	                <td><?php print($row['username']); ?></td>
	                <td><?php print($row['nama_lengkap']); ?></td>
	                <td><?php print($row['email']); ?></td>
	                <td><?php print($row['no_telp']); ?></td>
	                <td><?php print($row['level']); ?></td>
	                <td align="center"><div align="center"><?php print($row['aktif']); ?></div></td>
                </tr>
                <?php
                $no++;
			} ?>
			 <?php
		}
		else
		{
			?>
            <tr>
           		<td colspan="7"><i>-- Data tidak ditemukan --</i></td>
            </tr>
            <?php
		}		
	}
	
}
