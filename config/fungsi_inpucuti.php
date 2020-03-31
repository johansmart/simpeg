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
				
				
				

        });
		
	   $(function(){
              $(".search_keyword").keyup(function()
              {
                  var search_keyword_value = $(this).val();
                  var dataString = 'search_keyword='+ search_keyword_value;
                  if(search_keyword_value!='')
                  {
                      $.ajax({
                          type: "POST",
                          url: "searchnip.php",
                          data: dataString,
                          cache: false,
                          success: function(html)
                          {
                              $("#result").html(html).show();
                          }
                      });
                  }
                  return false;
              });
			  
			 

              $("#result").live("click",function(e){
                  var $clicked = $(e.target);
                  var $nip= $clicked.find('.nip').html();
                  var decoded = $("<span/>").html($nip).text();
                  $('#search_keyword_id').val(decoded);
				  
				  var $nama= $clicked.find('.nama').html();
                  var decoded = $("<span/>").html($nama).text();
                  $('#search_keyword_name').val(decoded);
				  
              });

              $(document).live("click", function(e) {
                  var $clicked = $(e.target);
                  if (! $clicked.hasClass("search_keyword")){
                      $("#result").fadeOut();
                  }
              });

              $('#search_keyword_id').click(function(){
                  $("#result").fadeIn();
              });
          });



        $("#tgl_akhir").change(function(){
            var d =new Date();
            var tgl_awal = $('#tgl_awal').val();//variable tgl awal
            var tgl_akhir = $('#tgl_akhir').val();//variable tgl akhir
            var kosong="" ;


            if (tgl_awal > tgl_akhir){

                window.location.reload();
                alert("Maaf Tanggal akhir tidak boleh lebih kecil dari tanggal awal");

            }

            $.ajax({ //mengambil jumlah libur NASIONAL dari database
                url: 'cek_libur.php',//mengambil query libur dari file cek_libur.php
                data: 'tgl_awal='+tgl_awal+'&tgl_akhir='+tgl_akhir, //untuk POST tgl awal dan tanggal akhir
                cache: false,
                success: function(liburnasional){

                    var firstday = $('#tgl_awal').datepicker('getDate');
                    var backday = $('#tgl_akhir').datepicker('getDate');

                    var libur_sabtu_minggu = 0;
                    for (i = firstday.valueOf(); i <= backday.valueOf(); i+= 86400000) {   //untuk menghitung berapa hari sabtu dan minggu pada tanggal yang telah ditentukan
                        var temp = new Date(i);
                        if (temp.getDay() == 0 || temp.getDay() == 6) {
                            libur_sabtu_minggu++;//untuk jumlah libur sabtu minggu
                        }
                        //untuk hari libur hanya minggu aja
                        // if (temp.getDay() == 0) {
                        //     libur_sabtu_minggu++;
                        // }
                    }

                    var tgl_awal_pisah = tgl_awal.split('-');//untuk memisahkan tanda -
                    var tgl_akhir_pisah = tgl_akhir.split('-');//untuk memisahkan tanda -
                    var objek_tgl = new Date(); //untuk tgl sekarang
                    var tgl_awal_leave = objek_tgl.setFullYear(tgl_awal_pisah[0], tgl_awal_pisah[1], tgl_awal_pisah[2]);
                    var tgl_akhir_leave = objek_tgl.setFullYear(tgl_akhir_pisah[0], tgl_akhir_pisah[1], tgl_akhir_pisah[2]);
                    var hasil = (tgl_akhir_leave - tgl_awal_leave) / (60 * 60 * 24 * 1000 ) + 1 - liburnasional - libur_sabtu_minggu;   
                    var hasil2 = (tgl_akhir_leave - tgl_awal_leave) / (60 * 60 * 24 * 1000 ) + 1;       //PERHITUNGAN
                    var jmlCT=(tgl_akhir_leave - tgl_awal_leave) / (60 * 60 * 24 * 1000 ) + 1 ;//untuk 90 hari pada cuti melahirkan
                    if ($('select[name=id_cuti] option:selected').val() == '4') { //apabila memilih cuti tahunan
                        $('#lama').val(jmlCT);	//HASIL YANG DITAMPILKAN 90 hari tanpa hari libur nasional dan sabtu minggu
                    }else if($('select[name=id_cuti] option:selected').val() == '8'){
                        $('#lama').val(hasil2);    
                    }else {//apabila tidak maka akan menampilkan sesuai perhitungan pada variabel hasil
                        $('#lama').val(hasil); //hasil yang ditampilkan
                    }


                    var kosong="" ;//variabel kosong

                    // if (hasil <=2){ // untuk alert apabila mengajukan cuti dibawah 3 hari

                    //     window.location.reload();
                    //     alert("Maaf Cuti hanya bisa di ajukan minimal 3 hari kerja");

                    // }

                }
            });

            $("#tgl_awal").change(function(){
                var months=['01','02','03','04','05','06','07','08','09','10','11','12'];//kode bulan
                var date =new Date();//tgl sekarang
                var day =date.getDate();//mengambil hari pada hari ini
                var month =date.getMonth();//mengambil bulan pada hari ini
                var yy=date.getYear();//mengambil tahun pada hari ini
                var year =(yy < 1000) ? yy + 1900 : yy; //perhitungan tahun
                var hariini=year+'-'+months[month]+'-0'+day;// untuk menentukan hari ini
                var tgl_awal = $('#tgl_awal').val();//untuk mengambil tanggal awal yang telah di isi
                var kosong="" ;//membuat variable kosong

                if (tgl_awal < hariini) { //bila  tanggal awal tidak boleh lebih kecil dari ini

                    window.location.reload();
                    alert("Maaf tanggal awal tidak boleh lebih kecil dari hari ini");

                }




            });

        });



});


			
</script>