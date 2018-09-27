<!-- 
================= doc ====================
 filename     : navbar-right.php
 @package     : dashboard
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-11-02
 @Modified    : 2017-11-02
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php
?>
<!-- ==================================================================================================== -->
				<ul class="nav nav-list">
					<li>
						<a href="javascript:void(0)" onclick="swapContent('home')">
							<i class="icon-home"></i>
							<span class="menu-text"> <b>Home</b> </span>
						</a>
					</li>

<!-- ==================================================================================================== -->
					<?php if ($_SESSION['s_level'] == 'administrator') { ?>
					<li>
						<a href="#" class="dropdown-toggle">
							<i class="icon-hdd"></i>
							<span class="menu-text"> <b>Manajemen Data</b> </span>
							<b class="arrow icon-angle-down"></b>
						</a>
						<ul class="submenu">
							<li>
								<a href="javascript:void(0)" onclick="swapContent('manajemen_data/backup/backup')">
									<i class="icon-double-angle-right"></i>
									Backup<br/>
									<small>Amankan Data</small>
								</a>
							</li>
							<li style="display: none;">
								<a href="javascript:void(0)" onclick="swapContent('manajemen_data/restore/restore')">
									<i class="icon-double-angle-right"></i>
									Restore<br/>
									<small>Kembalikan Data</small>
								</a>
							</li>
						</ul>
					</li>
					<?php } ?>
<!-- ==================================================================================================== -->
					<?php if ($_SESSION['s_level'] == 'administrator' || $_SESSION['s_level'] == 'petugas') { ?>
					<li>
						<a href="#" class="dropdown-toggle">
							<i class="icon-tasks"></i>
							<span class="menu-text"> <b>Master</b> </span>

							<b class="arrow icon-angle-down"></b>
						</a>
<!-- ==================================================================================================== -->
						<ul class="submenu">
							<li>
								<a href="javascript:void(0)" onclick="swapContent('master_ref/pasien/pasien')">
									<i class="icon-double-angle-right"></i>
									Pasien
								</a>
							</li>
							<li>
								<a href="javascript:void(0)" onclick="swapContent('master_ref/dokter/dokter')">
									<i class="icon-double-angle-right"></i>
									Dokter
								</a>
							</li>
							<li>
								<a href="javascript:void(0)" onclick="swapContent('master_ref/petugas/petugas')">
									<i class="icon-double-angle-right"></i>
									Petugas
								</a>
							</li>
							<li>
								<a href="javascript:void(0)" onclick="swapContent('master_ref/poliklinik/poliklinik')">
									<i class="icon-double-angle-right"></i>
									Poliklinik
								</a>
							</li>
							<li>
								<a href="javascript:void(0)" onclick="swapContent('master_ref/layanan/layanan')">
									<i class="icon-double-angle-right"></i>
									Layanan
								</a>
							</li>
							<li>
								<a href="javascript:void(0)" onclick="swapContent('master_ref/tindakan/tindakan')">
									<i class="icon-double-angle-right"></i>
									Tindakan
								</a>
							</li>
							<?php if ($_SESSION['s_level'] == 'administrator') { ?>
							<li>
								<a href="javascript:void(0)" onclick="swapContent('master_ref/user/user')">
									<i class="icon-double-angle-right"></i>
									User
								</a>
							</li>
							<?php } ?>

<!-- ==================================================================================================== -->					
						</ul>
					</li>
					<?php } ?>
					<?php if ($_SESSION['s_level'] == 'administrator' || $_SESSION['s_level'] == 'petugas') { ?>
					<li>
						<a href="#" class="dropdown-toggle">
							<i class="icon-edit"></i>
							<span class="menu-text"> <b>Pendaftaran</b> </span>
							<b class="arrow icon-angle-down"></b>
						</a>
						<ul class="submenu">
							<li>
								<a href="javascript:void(0)" onclick="swapContent('pendaftaran/daftar/daftar')">
									<i class="icon-double-angle-right"></i>
									Daftar
								</a>
							</li>
							<li>
								<a href="javascript:void(0)" onclick="swapContent('pendaftaran/rekam_medis/rekam_medis')">
									<i class="icon-double-angle-right"></i>
									Rekam Medis
								</a>
							</li>
						</ul>
					</li>
					<?php } ?>

					<?php if ($_SESSION['s_level'] == 'administrator' || $_SESSION['s_level'] == 'dokter') { ?>
					<li>
						<a href="#" class="dropdown-toggle">
							<i class="icon-glass"></i>
							<span class="menu-text"> <b>Pemeriksaan</b> </span>
							<b class="arrow icon-angle-down"></b>
						</a>
						<ul class="submenu">
							<li>
								<a href="javascript:void(0)" onclick="swapContent('pemeriksaan/periksa/periksa')">
									<i class="icon-double-angle-right"></i>
									Periksa
								</a>
							</li>
						</ul>
					</li>
					<?php } ?>

					<?php if ($_SESSION['s_level'] == 'administrator' || $_SESSION['s_level'] == 'petugas') { ?>
					<li>
						<a href="#" class="dropdown-toggle">
							<i class="icon-tag"></i>
							<span class="menu-text"> <b>Pembayaran</b> </span>
							<b class="arrow icon-angle-down"></b>
						</a>
						<ul class="submenu">
							<li>
								<a href="javascript:void(0)" onclick="swapContent('pembayaran/bayar/bayar')">
									<i class="icon-double-angle-right"></i>
									Biaya Periksa
								</a>
							</li>
						</ul>
					</li>
					<?php } ?>
					
					
<!-- ==================================================================================================== -->
					
					<li>
						<a href="#" class="dropdown-toggle">
							<i class="icon-list-alt"></i>
							<span class="menu-text"><b> Laporan </b></span>
							<b class="arrow icon-angle-down"></b>
						</a>

						
<!-- ==================================================================================================== -->
						
						<ul class="submenu">
							<li>
								<a href="javascript:void(0)" onclick="swapContent('laporan/rekam_medis/rekam_medis')">
									<i class="icon-double-angle-right"></i>
									Rekam Medis
								</a>
							</li>

							<?php if ($_SESSION['s_level'] == 'administrator' || $_SESSION['s_level'] == 'petugas') { ?>
							<li>
								<a href="javascript:void(0)" onclick="swapContent('laporan/pemeriksaan/pemeriksaan')">
									<i class="icon-double-angle-right"></i>
									Biaya Pemeriksaan
								</a>
							</li>
							<li>
								<a href="javascript:void(0)" onclick="swapContent('laporan/rincian_biaya/rincian_biaya')">
									<i class="icon-double-angle-right"></i>
									Rincian <br/><small>Biaya Pemeriksaan</small>
								</a>
							</li>

							<li>
								<a href="javascript:void(0)" onclick="swapContent('laporan/insentif_dokter/insentif_dokter')">
									<i class="icon-double-angle-right"></i>
									Insentif Dokter
								</a>
							</li>
							<?php } ?>
						</ul>
					</li>
<!-- ==================================================================================================== -->					
					<li>
						<a href="logout.php">
							<i class="icon-off"></i>
							<span class="menu-text"><b> Logout </b></span>
						</a>
					</li>
				</ul><!--/.nav-list-->
<!-- ==================================================================================================== -->				