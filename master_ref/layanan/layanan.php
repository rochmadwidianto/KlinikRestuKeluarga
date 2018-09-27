<!-- 
================= doc ====================
 filename     : layanan.php
 @package     : layanan
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-10-13
 @Modified    : 2017-10-13
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<script type="text/javascript">
	$(document).ready(function(){
		$("#data").load("master_ref/layanan/data_layanan.php");
		$("#id-breadcrumbs").html("layanan");
	});

	function layanan() {
		$("#data").load("master_ref/layanan/data_layanan.php");
		$("#id-breadcrumbs").html("layanan");
	}
	
	function tambahForm(){
		$("#form-nest").css({display:"block"});
		$.ajax({
			type:"GET",
			url:"master_ref/layanan/tambah_layanan.php",
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
				$("#data").load("master_ref/layanan/data_layanan.php");
			}
		});
		return false;
	}
	
	function deleteData(id,layanan){
		var pilih = confirm('Hapus '+layanan+' dari daftar ??');
		if(pilih==true){
				$.ajax({
					type:"GET",
					url:'master_ref/layanan/hapus_layanan.php',
					data:"layanan_id="+id,
					beforeSend:function(){
						$("#data").html("<img src='assets/images/ajax-loader.gif' />");
					},
					success:function(data){
						$('#data').html(data);
						$('#alert').load("master_ref/jabatan/alert_error.php");
					},
					error:function(data){
						$('#data').html(data);
						$('#alert').load("master_ref/jabatan/alert_error.php");
					}
				});
		}
	}
	
	function editData(id){
		$.ajax({
			type:"GET",
			url:'master_ref/layanan/edit_layanan.php',
			data:"layanan_id="+id,
			beforeSend:function(){
				$("#form-nest").css({display:"block"});
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