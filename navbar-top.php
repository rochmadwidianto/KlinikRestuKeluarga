<!-- 
================= doc ====================
 filename     : navbar-top.php
 @package     : dashboard
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-11-02
 @Modified    : 2017-11-02
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

		<div class="navbar">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a style="margin-left: 15px" class="navbar-brand" href="javascript:void(0)" onclick="swapContent('home')">
				    	<img src="assets/images/logo_text_nav.png" width="125px" class="d-inline-block align-top" alt="Klinik Restu Keluarga">
				  	</a>
					
					<ul style="display: none;" class="nav ace-nav pull-right">
						<li class="light-grey">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<?php $foto = 'master_ref/user/img_user/'.$_SESSION['foto_user']; ?>
								<img class="nav-user-photo" src="<?php  echo $foto;?>" />
								<span class="user-info">
									<small>Selamat Datang,</small>
									<?php echo $_SESSION['s_nama']?>
								</span>

								<i class="icon-caret-down"></i>
							</a>

							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
								<li>								
									<a  href="javascript:void(0)" onclick="swapContent('user/user')" > 
										<i class="icon-user"></i>
										Profile
									</a>
								</li>
							
								<li class="divider"></li>

								<li>
									<a href="logout.php">
										<i class="icon-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul><!--/.ace-nav-->
				</div><!--/.container-fluid-->
			</div><!--/.navbar-inner-->
		</div>