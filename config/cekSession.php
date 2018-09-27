<!-- 
================= doc ====================
 filename     : cekSession.php
 @package     : config
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-11-02
 @Modified    : 2017-11-02
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php
	session_start();
	if($_SESSION['s_nama']=='' && $_SESSION['s_pass']=='' && 
        $_SESSION['s_level']=='' && $_SESSION['s_user']=='') {
		header("location:login.php");
	}
?>
