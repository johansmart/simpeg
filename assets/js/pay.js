(function($) {
	
	$(document).ready(function(e) {


		var idpay = 0;
		var main = "ref/pay.data.php";

	
		$("#data-pay").load(main);

		
	
		$('input:text[name=pencarian]').on('input',function(e){
			var v_cari = $('input:text[name=pencarian]').val();
			
			if(v_cari!="") {
				$.post(main, {cari: v_cari} ,function(data) {
			
					$("#data-pay").html(data).show();
				});
			} else {
		
				$("#data-pay").load(main);
			}
		});

	
		$('.ubah,.tambah').live("click", function(){

			var url = "ref/pay.form.php";
			
			idpay = this.id;

			if(idpay != 0) {
				
				$("#myModalLabel").html("Ubah Data Payroll");
			} else {
			
				$("#myModalLabel").html("Tambah Data Payroll");
			}

			$.post(url, {id: idpay} ,function(data) {
				
				$(".modal-body").html(data).show();
			});
		});

	
		$('.hapus').live("click", function(){
			var url = "ref/pay.input.php";
			
			idpay = this.id;

			
			var answer = confirm("Apakah anda ingin menghapus data ini?");

			
			if (answer) {
				
				$.post(url, {hapus: idpay} ,function() {
				
					$("#data-pay").load(main);
				});
			}
		});

		
		$('.halaman').live("click", function(event){
			
			kd_hal = this.id;

			$.post(main, {halaman: kd_hal} ,function(data) {
			
				$("#data-pay").html(data).show();
			});
		});
		
		
		$("#simpan-pay").bind("click", function(event) {
			var url = "ref/pay.input.php";

		
			var vidpay = $('input:text[name=idpay]').val();
            var vkode = $('input:text[name=kode]').val();
			var vnm_pay= $('input:text[name=nm_pay]').val();
			var vpenambah = $('input:radio:checked[name=penambah]').val();
			var vpengurang = $('input:radio:checked[name=pengurang]').val();
			var vket = $('input:text[name=ket]').val();


			$.post(url, {idpay: vidpay, kode: vkode,nm_pay: vnm_pay, penambah: vpenambah, pengurang: vpengurang, ket: vket, id: idpay} ,function() {
			
			
				$("#data-pay").load(main);
				
				$('#dialog-pay').modal('hide');

				$("#myModalLabel").html("Tambah Data Jabatan");
			});
		});
	});
}) (jQuery);
