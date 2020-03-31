<script type="text/javascript">
    $(document).ready(function (e) {


        $(function() {
            $('.date-picker').datepicker({
                autoclose: true,
                todayHighlight: true
            })
                //show datepicker when clicking on the icon
                .next().on(ace.click_event, function(){
                    $(this).prev().focus();
                });
				
			

        $("#file").change(function() {
            $("#message").empty(); // To remove the previous error message
            var file = this.files[0];
            var imagefile = file.type;
            var match= ["image/jpeg","image/png","image/jpg"];
            if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
            {
                $('#previewing').attr('src','logo/noname.jpg');
                $("#message").html("<p id='error'>Mohon Pilih File dengan benar</p>"+"<h4>Catatan</h4>"+"<span id='error_message'>Hanya gambar jpeg, jpg dan png yang di ijinkan</span>");
                return false;
            }else{
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }
        });
        });
        function imageIsLoaded(e) {
        $("#file").css("color","#FFFFFF");
        $('#image_preview').css("display", "block");
        $('#previewing').attr('src', e.target.result);
        $('#previewing').attr('width', '250px');
        $('#previewing').attr('height', '230px');
    };
	
var htmlobjek;
$(document).ready(function(){
  
  $("#propinsi").change(function(){
    var propinsi = $("#propinsi").val();
    $.ajax({
        url: "pegawai/ambilkota.php",
        data: "propinsi="+propinsi,
        cache: false,
        success: function(msg){
            
            $("#kota").html(msg);
        }
    });
  });
  $("#kota").change(function(){
    var kota = $("#kota").val();
    $.ajax({
        url: "pegawai/ambilkecamatan.php",
        data: "kota="+kota,
        cache: false,
        success: function(msg){
            $("#kecamatan").html(msg);
        }
    });
  });
  
  
    $("#tgl_habis").change(function(){
     var tglmasuk=$('#tgl_masuk').val();
	 var tglkeluar=$('#tgl_habis').val();
		if (tglmasuk >= tglkeluar){
					alert('Maaf Tanggal keluar tidak boleh lebih kecil dari tanggal masuk');
		} 
	
  });
  
 
			$('#tgl_lahir').change(function ()	{
				var dob =new Date (this.value);
				var today = new Date ();
				var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
				
				
				if ( age < 15 ){
					alert('Maaf Umur tidak boleh dibawah 15 tahun');
				} else{
					$('#umur').val(age);
				};	
				
			});
			

			
			
			
			
			
});


   



});
</script>