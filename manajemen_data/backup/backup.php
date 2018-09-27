<!-- 
================= doc ====================
 filename     : backup.php
 @package     : backup
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-11-13
 @Modified    : 2017-11-13
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<script type="text/javascript">
	$(document).ready(function(){
		$("#data").load("manajemen_data/backup/data_backup.php");
		$("#id-breadcrumbs").html("Backup Database");
	});

	function backup() {
		$("#data").load("manajemen_data/backup/act_backup.php");
		$("#id-breadcrumbs").html("Backup Database");
	}

    function download_backup() {
        $("#data").load("manajemen_data/backup/download_backup.php");
        $("#id-breadcrumbs").html("Backup Database");
    }
</script>

<div id="form-nest" class="row-fluid" style="display:none">
	<div id="form" class="span12 well">
		
	</div>
</div>

<div class="row-fluid">
	<div id="data" class="span12 well">
		<img src='assets/images/ajax-loader.gif' />
	</div>
</div>