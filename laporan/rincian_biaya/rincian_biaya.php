<!-- 
================= doc ====================
 filename     : rincian_biaya.php
 @package     : rincian_biaya
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
		$("#data").load("laporan/rincian_biaya/data_rincian_biaya.php");
		$("#id-breadcrumbs").html("Laporan Rincian Biaya Pemeriksaan");
	});

	function rincian_biaya() {
		$("#data").load("laporan/rincian_biaya/data_rincian_biaya.php");
		$("#id-breadcrumbs").html("rincian_biaya");
	}
	
	function tambahForm(){
		$("#form-nest").css({display:"block"});
		$.ajax({
			type:"GET",
			url:"laporan/rincian_biaya/tambah_rincian_biaya.php",
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
				$("#data").load("laporan/rincian_biaya/data_rincian_biaya.php");
			}
		});
		return false;
	}
	
	function deleteData(id,rincian_biaya){
		var pilih = confirm('Hapus '+rincian_biaya+' dari rincian_biaya ??');
		if(pilih==true){
				$.ajax({
					type:"GET",
					url:'laporan/rincian_biaya/hapus_rincian_biaya.php',
					data:"rincian_biaya_id="+id,
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
			url:'laporan/rincian_biaya/edit_rincian_biaya.php',
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