<!-- 
================= doc ====================
 filename     : user.php
 @package     : user
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-11-02
 @Modified    : 2017-11-02
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<script type="text/javascript">
	$(document).ready(function(){
		$("#data").load("master_ref/user/data_user.php");
		$("#id-breadcrumbs").html("User");
	});
	
	function tambahForm(){
		$("#form-nest").css({display:"block"});
		$.ajax({
			type:"GET",
			url:"master_ref/user/tambah_user.php",
			data:null,
			beforeSend:function(){
				$("#form").html("<img src='assets/images/ajax-loader.gif' />");
			},
			success:function(data){
				$('#form').html(data);
			}
		});
		$('#form').show("slow");
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
				$("#data").load("master_ref/user/data_user.php");
			}
		});
		return false;
	}
	function deleteData(username){
		var pilih = confirm('Hapus '+username+' dari daftar ??');
		if(pilih==true){
				$.ajax({
					type:"GET",
					url:'master_ref/user/hapus_user.php',
					data:"username="+username,
					beforeSend:function(){
						$("#data").html("<img src='assets/images/ajax-loader.gif' />");
					},
					success:function(data){
						$('#data').html(data);
						$("#alert").html("<div id='alert' class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button>Data berhasil di hapus</div>");
					},
					error:function(data){
						$("#alert").html("<div id='alert' class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button>Data gagal di hapus</div>");
					}
				});
		}
	}
	
	function editData(username){
		$("#form-nest").css({display:"block"});
		$.ajax({
			type:"GET",
			url:'master_ref/user/edit_user.php',
			data:"username="+username,
			beforeSend:function(){
				$("#form").html("<img src='assets/images/ajax-loader.gif' />");
			},
			success:function(data){
				$('#form').html(data);
			}
		});
		$('#form').fadeIn(3000);
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