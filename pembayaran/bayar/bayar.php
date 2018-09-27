<!-- 
================= doc ====================
 filename     : bayar.php
 @package     : bayar
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
		$("#data").load("pembayaran/bayar/data_bayar.php");
		$("#id-breadcrumbs").html("Biaya Periksa");
	});

	function bayar() {
		$("#data").load("pembayaran/bayar/data_bayar.php");
		$("#id-breadcrumbs").html("bayar");
	}

	function printKuitansi(id){
		// $('#form-nest').css({display:"block"});
		$.ajax({
			type:"GET",
			url: window.open('../klinik_restu_keluarga/pembayaran/bayar/print_kuitansi.php?rekam_medis_id='+id,'name','width=900,height=600'),
			data:"rekam_medis_id="+id,
			success:function(data){
				$('#form').html(data);
			}
		});
		// $('#form').show("slow");
	}
	
	function tambahForm(){
		$("#form-nest").css({display:"block"});
		$.ajax({
			type:"GET",
			url:"pembayaran/bayar/tambah_bayar.php",
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
				$("#data").load("pembayaran/bayar/data_bayar.php");
			}
		});
		return false;
	}
	
	function deleteData(id,bayar){
		var pilih = confirm('Hapus '+bayar+' dari bayar ??');
		if(pilih==true){
				$.ajax({
					type:"GET",
					url:'pembayaran/bayar/hapus_bayar.php',
					data:"bayar_id="+id,
					beforeSend:function(){
						$("#data").html("<img src='assets/images/ajax-loader.gif' />");
					},
					success:function(data){
						$('#data').html(data);
						$('#alert').load("pembayaran/jabatan/alert_error.php");
					},
					error:function(data){
						$('#data').html(data);
						$('#alert').load("pembayaran/jabatan/alert_error.php");
					}
				});
		}
	}
	
	function editData(id){
		$.ajax({
			type:"GET",
			url:'pembayaran/bayar/edit_bayar.php',
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