<!-- 
================= doc ====================
 filename     : detail_user.php
 @package     : user
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-11-16
 @Modified    : 2017-11-16
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php 
	session_start();
	include_once('../../config/koneksi.php');
	require_once('class.user.php');
?>

<form name="multiform" id="multiform" class="form-horizontal" method="POST" enctype="multipart/form-data">
		<h3 class="header smaller lighter blue"><b> Detail User</b></h3>
		<span>
		<?php
			$user = new user($pdo);
			if(isset($_SESSION['s_user']))
			{
				$id = $_SESSION['s_user'];
				extract($user->getID($id));	
			}
		?>
		</span>
		<div class="row-fluid">
			<div class="span5">
				<div class="control-group">
					<label class="control-label" for="inputUsername">Username</label>
					<div class="controls">
						<label><b><?php echo $username; ?></b></label>
					</div>
				</div>
				<div style="display: none;" class="control-group">
					<label class="control-label" for="inputPassword" >Password</label>
					<div class="controls">
						<label><b><?php echo $password; ?></b></label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputNamaLengkap" >Nama Lengkap</label>
					<div class="controls">
						<label><b><?php echo $nama_lengkap ?></b></label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputEmail" >Email</label>
					<div class="controls">
						<label><b><?php echo $email ?></b></label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputNoTelp" >No.Telp.</label>
					<div class="controls">
						<label><b><?php echo $no_telp ?></b></label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Level</label>
						<div class="controls">
							<label><b><?php echo $level ?></b></label>
						</div>
				</div>				
				<div class="control-group">
					<label class="control-label">Aktif</label>
					<div class="controls">
						<label>
							<?php if($aktif == 'Y') { ?>
								<input name="status" type="radio" value="status" checked />
								<span class="lbl badge badge-success"> Aktif</span>
							<?php } else {?>
								<input name="status" type="radio" value="status" checked />
								<span class="lbl badge badge-important"> Tidak Aktif</span>
							<?php }?>
						</label>
					</div>
				</div>		
			</div>
			<div class="span5">							
				<div class="control-group">
		            <div class="controls">
			            <div id="image_preview">
			            <?php 
			            	if ($foto_user=="") {
			            		$foto = 'master_ref/user/img_user/profile-icon.png';
			            	}else{
			            		$foto = 'master_ref/user/img_user/'.$foto_user;
			            	} 
			            ?>
			            <img id="previewing" class="img-polaroid" src="<?php  echo $foto; ?>" width="250" height="250"/></div>
			            <span id='loading'></span>
		                <div id="message"></div>
	           		</div>
       			</div>
			</div>
		</div>
		<div class="form-actions">
		<div class="span10"></div>
			<div class="span2">
				<div class="controls-group">
				<button href="javascript:void(0)" onclick="swapContent('home')" type="button" class="btn btn-small btn-danger" ><i class='icon-remove'><b> Kembali</b></i></button>
				</div>
			</div>
		</div>
</form>