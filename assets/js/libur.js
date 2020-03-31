(function($) {

	$(document).ready(function(e) {

		
		var idlibur = 0;
		var main = "ref/libur.data.php";

		
		$("#data-libur").load(main);

		
		
		$('input:text[name=pencarian]').on('input',function(e){
			var v_cari = $('input:text[name=pencarian]').val();
			
			if(v_cari!="") {
				$.post(main, {cari: v_cari} ,function(data) {
				
					$("#data-libur").html(data).show();
				});
			} else {
				
				$("#data-libur").load(main);
			}
		});

		
		$('.ubah3,.tambah3').live("click", function(){

			var url = "ref/libur.form.php";
			
			id_libur = this.id;

			if(id_libur != 0) {
				
				$("#myModalLabel3").html("Ubah Data Libur");
			} else {
		
			}

			$.post(url, {id: id_libur} ,function(data) {
			
				$(".modal-body").html(data).show();
			});
		});

		
		$('.hapus').live("click", function(){
			var url = "ref/libur.input.php";
		
			id_libur = this.id;

			
			var answer = confirm("Apakah anda ingin mengghapus data ini?");

			
			if (answer) {
			
				$.post(url, {hapus: id_libur} ,function() {
					
					$("#data-libur").load(main);
				});
			}
		});

	
		$('.halaman').live("click", function(event){
		
			kd_hal = this.id;

			$.post(main, {halaman: kd_hal} ,function(data) {
			
				$("#data-libur").html(data).show();
			});
		});
		
		
		$("#simpan-libur").bind("click", function(event) {
			var url = "ref/libur.input.php";

			
			var vid_libur = $('input:text[name=id_libur]').val();
			var v_nmlibur= $('input:text[name=nmlibur]').val();
			var vtgllibur = $('input:text[name=tgllibur]').val();

			

			
			$.post(url, {id_libur: vid_libur, nmlibur: v_nmlibur, tgllibur:vtgllibur,
                id: id_libur} ,function() {
			
				
				$("#data-libur").load(main);

			
				$('#dialog-libur').modal('hide');

				
				$("#myModalLabel3").html("Tambah Data libur");
			});
		});
	});
}) (jQuery);
