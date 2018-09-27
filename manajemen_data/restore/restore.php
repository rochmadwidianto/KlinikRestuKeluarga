<!-- 
================= doc ====================
 filename     : restore.php
 @package     : restore
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-11-14
 @Modified    : 2017-11-14
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<script type="text/javascript">
	$(document).ready(function(){
		$("#data").load("manajemen_data/restore/data_restore.php");
		$("#id-breadcrumbs").html("Restore Database");
	});

	function restore() {
		$("#data").load("manajemen_data/restore/act_restore.php");
		$("#id-breadcrumbs").html("Restore Database");
	}

    function download_backup() {
        $("#data").load("manajemen_data/restore/download_backup.php");
        $("#id-breadcrumbs").html("Restore Database");
    }
	
	function submitForm(url){
		var thisPost = $("#forms").serialize();
		$.ajax({
			type:"POST",
			url:url,
			data:thisPost,
			beforeSend:function(){
				$("#form").html("<img src='assets/images/ajax-loader.gif' />");
				$("#data").html("<img src='assets/images/ajax-loader.gif' />");
			},
			success:function(data){
				$('#form').html(data);
				$("#data").load("manajemen_data/restore/data_restore.php");
			}
		});
		return false;
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