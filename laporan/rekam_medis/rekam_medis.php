<!-- 
================= doc ====================
 filename     : rekam_medis.php
 @package     : rekam_medis
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-10-14
 @Modified    : 2017-10-14
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<script type="text/javascript">
	$(document).ready(function(){
		$("#data").load("laporan/rekam_medis/data_rekam_medis.php");
		$("#id-breadcrumbs").html("Laporan Rekam Medis");
	});

	function rekam_medis() {
		$("#data").load("laporan/rekam_medis/data_rekam_medis.php");
		$("#id-breadcrumbs").html("rekam_medis");
	}

	function getDetail(pasien_id){
		$('#form-nest').css({display:"block"});
		$.ajax({
			type:"GET",
			url:"laporan/rekam_medis/popup_detail.php",
			data:"pasien_id="+pasien_id,
			beforeSend:function(){
				$("#form").html();
			},
			success:function(data){
				$('#form').html(data);
			}
		});
		$('#form').show("slow");
	}
	
	function tambahForm(){
		$("#form-nest").css({display:"block"});
		$.ajax({
			type:"GET",
			url:"laporan/rekam_medis/tambah_rekam_medis.php",
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
				$("#data").load("laporan/rekam_medis/data_rekam_medis.php");
			}
		});
		return false;
	}
	
	function deleteData(id,rekam_medis){
		var pilih = confirm('Hapus '+rekam_medis+' dari rekam_medis ??');
		if(pilih==true){
				$.ajax({
					type:"GET",
					url:'laporan/rekam_medis/hapus_rekam_medis.php',
					data:"rekam_medis_id="+id,
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
			url:'laporan/rekam_medis/edit_rekam_medis.php',
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