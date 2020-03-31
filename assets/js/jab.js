(function($) {
	
	$(document).ready(function(e) {


		var id_jab = 0;
		var main = "ref/jab.data.php";

	
		$("#data-jab").load(main);

		
	
		$('input:text[name=pencarian]').on('input',function(e){
			var v_cari = $('input:text[name=pencarian]').val();
			
			if(v_cari!="") {
				$.post(main, {cari: v_cari} ,function(data) {
			
					$("#data-jab").html(data).show();
				});
			} else {
		
				$("#data-jab").load(main);
			}
		});

	
		$('.ubah,.tambah').live("click", function(){

			var url = "ref/jab.form.php";
			
			id_jab = this.id;

			if(id_jab != 0) {
				
				$("#myModalLabel").html("Ubah Data Jabatan");
			} else {
			
				$("#myModalLabel").html("Tambah Data Jabatan");
			}

			$.post(url, {id: id_jab} ,function(data) {
				
				$(".modal-body").html(data).show();
			});
		});

	
		$('.hapus').live("click", function(){
			var url = "ref/jab.input.php";
			
			id_jab = this.id;

			
			var answer = confirm("Apakah anda ingin menghapus data ini?");

			
			if (answer) {
				
				$.post(url, {hapus1: id_jab} ,function() {
				
					$("#data-jab").load(main);
				});
			}
		});

		
		$('.halaman').live("click", function(event){
			
			kd_hal = this.id;

			$.post(main, {halaman: kd_hal} ,function(data) {
			
				$("#data-jab").html(data).show();
			});
		});
		
		
		$("#simpan-jab").bind("click", function(event) {
			var url = "ref/jab.input.php";


			var vid_jab = $('input:text[name=id_jab]').val();
			var vn_jab= $('input:text[name=n_jab]').val();
			var vgapok = $('input:text[name=gapok]').val();
			var vtunj_jab = $('input:text[name=tunj_jab]').val();
			var vm_kerja = $('input:text[name=m_kerja]').val();
			var vkode = $('input:text[name=kode]').val();
			

			
			$.post(url, {id_jab: vid_jab, n_jab: vn_jab, gapok: vgapok, tunj_jab: vtunj_jab, m_kerja: vm_kerja, kode: vkode, id: id_jab} ,function() {
			
			
				$("#data-jab").load(main);

                alert("Berhasil");

				$('#dialog-jab').modal('hide');

				$("#myModalLabel").html("Tambah Data Jabatan");
			});
		});
	});
}) (jQuery);
