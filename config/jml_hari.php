<!-- 
================= doc ====================
 filename     : jml_hari.php
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
	function jmlhari($bulan1,$tahun){
		$jmlhari= cal_days_in_month(CAL_GREGORIAN, $bulan1, $tahun);
		return $jmlhari;
	}	
?>