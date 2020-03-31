(function($) {
	
	$(document).ready(function(e) {


		var id_pes = 0;
		var main = "ref/peng.data.php";

	
		$("#data-peng").load(main);

		
	
		$('input:text[name=pencarian]').on('input',function(e){
			var v_cari = $('input:text[name=pencarian]').val();
			
			if(v_cari!="") {
				$.post(main, {cari: v_cari} ,function(data) {
			
					$("#data-peng").html(data).show();
				});
			} else {
		
				$("#data-peng").load(main);
			}
		});

	
		$('.ubah,.tambah').live("click", function(){

			var url = "ref/peng.form.php";
			
			id_pes = this.id;

			if(id_pes != 0) {
				
				$("#myModalLabel").html("Ubah Pengumuman");
			} else {
			
				$("#myModalLabel").html("Tambah Pengumuman");
			}

			$.post(url, {id: id_pes} ,function(data) {
				
				$(".modal-body").html(data).show();
			});
		});

	
		$('.hapus').live("click", function(){
			var url = "ref/peng.input.php";
			
			id_pes = this.id;

			
			var answer = confirm("Apakah anda ingin menghapus data ini?");

			
			if (answer) {
				
				$.post(url, {hapus1: id_pes} ,function() {
				
					$("#data-peng").load(main);
				});
			}
		});

		
		$('.halaman').live("click", function(event){
			
			kd_hal = this.id;

			$.post(main, {halaman: kd_hal} ,function(data) {
			
				$("#data-peng").html(data).show();
			});
		});
		
		
		$("#simpan-peng").bind("click", function(event) {
			var url = "ref/peng.input.php";

			var vid_pes = $('input:text[name=id_pes]').val();
			var vheader= $('input:text[name=header]').val();
			var vbody = $('textarea[name=body]').val();
			var vfooter = $('input:text[name=footer]').val();
			
			
			$.post(url, {id_pes: vid_pes, header: vheader, body: vbody, footer: vfooter, id: id_pes} ,function() {
			
			
				$("#data-peng").load(main);

                alert("Berhasil");

				$('#dialog-peng').modal('hide');

				$("#myModalLabel").html("Tambah Pengumuman");
			});
		});
	});
}) (jQuery);
