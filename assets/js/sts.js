(function($) {
	
	$(document).ready(function(e) {


		var id = 0;
		var main = "ref/data_status.php";

	
		$("#data-sts").load(main);



	
		$('.hapus').live("click", function(){
			var url = "/kirim.php";
			
			id = this.id;

			
			var answer = confirm("Apakah anda ingin menghapus data ini?");

			
			if (answer) {
				
				$.post(url, {hapus: id} ,function() {
				
					$("#data-sts").load(main);
				});
			}
		});

		
		


    });

}) (jQuery);
