<!-- 
================= doc ====================
 filename     : login.php
 @package     : dashboard
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-11-02
 @Modified    : 2017-11-02
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Klinik Restu Keluarga | Login</title>
		<link rel="icon" type="image/jpg" href="assets/images/logo_warna.png" />
		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!--basic styles-->

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!--page specific plugin styles-->
		<link rel="stylesheet" href="assets/css/chosen.css" />
		<!--fonts-->

		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

		<!--ace styles-->

		<link rel="stylesheet" href="assets/css/ace.min.css" />
		<link rel="stylesheet" href="assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!--inline styles related to this page-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style type="text/css">
		.login-layout {
		    background: #8fe341;
		    background-image: url("assets/images/background.jpg");

		}
	</style>
	</head>

	<body class="login-layout">
		<div class="main-container container-fluid">
			<div class="main-content">
				<div class="row-fluid">
					<div class="span12">
						<div class="login-container">
							<div class="row-fluid">
								<div style="display: none;" class="center">
									<h1>
										<!--<i class="icon-leaf green"></i>
										<span class="red">S</span>-->
										<span class="white">Klinik Pratama <br>Restu Keluarga</span>
									</h1>
									<h4 class="white">Gombang - Cawas - Klaten</h4>
								</div>
							</div>

							<div class="row-fluid" style="margin-top: 30%">
								<div class="position-relative">
									<div id="login-box" class="login-box visible widget-box no-border">
										<div class="widget-body">
											<div class="widget-main">
												 <div align="center"><img src="assets/images/logo_text_2.png"/></div>
												<h5 class="header blue lighter bigger" align="center">
													Masukkan Username dan Password
												</h5>
												<form action="actlogin.php" method="post">
												 <?php
												 	include_once('config/koneksi.php');
      												if(isset($_GET['err1'])){
       													echo "
        													<div class='alert alert-danger'>
            													<button type='button' class='close' data-dismiss='alert'>&times;</button>
            													<strong>Terjadi kesalahan,</strong> Username atau Password Anda Salah
        													</div>";
      												}elseif(isset($_GET['err2'])){
        												echo "
        													<div class='alert alert-warning'>
              													<button type='button' class='close' data-dismiss='alert'>&times;</button>
              													<strong>Terjadi kesalahan,</strong> Username atau Password Tidak Boleh Kosong
        													</div>";
      												}
      											?>
													<fieldset>
														<div class="form-group">
														<label class="block clearfix">
															<span class="block input-icon input-icon-right">
																<input id="username" name="username" type="text" class="span12" placeholder="Username" required autocomplete="off" autofocus />
																<i class="icon-user"></i>
															</span>
														</label>
														</div>

														<div class="form-group">
														<label class="block clearfix">
															<span class="block input-icon input-icon-right">
																<input id="password" name="password" type="password" class="span12" placeholder="Password" required autocomplete="off" />
																<i class="icon-lock"></i>
															</span>
														</label>
														</div>
														
														<div class="form-group">														
															<label class="inline">
																<input type="checkbox" />
																<span style="display: none;" class="lbl"> Remember Me</span>
															</label>

															<button class="width-35 pull-right btn btn-small btn-primary" name="login">
																<i class="icon-key"></i>
																Login
															</button>
														</div>

														
													</fieldset>
												</form>

												
											</div><!--/widget-main-->

											<div class="widget-main">
												<div>
													 <span class="lbl">&copy;  Klinik Restu Keluarga - <?php echo date("Y");?> All Right Reserved </a></span>
												</div>
											</div>
										</div><!--/widget-body-->
									</div><!--/login-box-->
								</div><!--/position-relative-->
							</div>
						</div>
					</div><!--/.span-->
				</div><!--/.row-fluid-->
			</div>
		</div><!--/.main-container-->
	
		<!--basic scripts-->

		<!--[if !IE]>-->

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

		<!--<![endif]-->

		<!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

		<!--[if !IE]>-->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!--<![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/jquery.2.1.1.min.js"></script>
		<script src="assets/js/jquery.validate.min.js"></script>
		<!--page specific plugin scripts-->

		<!--ace scripts-->

		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->

		<script type="text/javascript">
			function show_box(id) {
			 $('.widget-box.visible').removeClass('visible');
			 $('#'+id).addClass('visible');
			}
	</script>
	</body>
</html>
