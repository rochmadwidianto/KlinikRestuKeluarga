<!-- 
================= doc ====================
 filename     : page.php
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
$page=$_GET['page'];
$path=$page.".php";
if(file_exists($path)){
include $path;
}else{
echo "
	<div class='alert'>
	<button type='button' class='close' data-dismiss='alert'>&times;</button>
	<h5><strong>Warning !</strong> Page not found .</h5>
	</div>";
}
?>