<!-- 
================= doc ====================
 filename     : pemeriksaan.php
 @package     : pemeriksaan
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-10-18
 @Modified    : 2017-10-18
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<script type="text/javascript">
	$(document).ready(function(){
		$("#data").load("laporan/pemeriksaan/data_pemeriksaan.php");
		$("#id-breadcrumbs").html("Laporan Biaya Pemeriksaan");
	});

	function pemeriksaan() {
		$("#data").load("laporan/pemeriksaan/data_pemeriksaan.php");
		$("#id-breadcrumbs").html("pemeriksaan");
	}
	
	function tambahForm(){
		$("#form-nest").css({display:"block"});
		$.ajax({
			type:"GET",
			url:"laporan/pemeriksaan/tambah_pemeriksaan.php",
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
				$("#data").load("laporan/pemeriksaan/data_pemeriksaan.php");
			}
		});
		return false;
	}
	
	function deleteData(id,pemeriksaan){
		var pilih = confirm('Hapus '+pemeriksaan+' dari pemeriksaan ??');
		if(pilih==true){
				$.ajax({
					type:"GET",
					url:'laporan/pemeriksaan/hapus_pemeriksaan.php',
					data:"pemeriksaan_id="+id,
					beforeSend:function(){
						$("#data").html("<img src='assets/images/ajax-loader.gif' />");
					},
					success:function(data){
						$('#data').html(data);
						$('#alert').load("laporan/jabatan/alert_error.php");
					},
					error:function(data){
						$('#data').html(data);
						$('#alert').load("laporan/jabatan/alert_error.php");
					}
				});
		}
	}
	
	function editData(id){
		$.ajax({
			type:"GET",
			url:'laporan/pemeriksaan/edit_pemeriksaan.php',
			data:"rekam_medis_id="+id,
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