(function($) {

    $(document).ready(function(e) {


        var nomor = 0;
        var main = "inbox/inbox.data.php";


        $("#data-inbox").load(main);




        $('input:text[name=pencarian]').on('input',function(e){
            var v_cari = $('input:text[name=pencarian]').val();

            if(v_cari!="") {
                $.post(main, {cari: v_cari} ,function(data) {

                    $("#data-inbox").html(data).show();
                });
            } else {

                $("#data-inbox").load(main);
            }
        });


        $('.pesanbaru,.balas').live("click", function(){

            var url = "inbox/inbox.form.php";

            nomor = this.id;

            if(nomor != 0) {

                $("#myModalLabel").html("Balas Pesan");
            } else {

                $("#myModalLabel").html("Pesan Baru");
            }

            $.post(url, {id: nomor} ,function(data) {

                $(".modal-body").html(data).show();
            });
        });

        $('.halaman').live("click", function(event){

            kd_hal = this.id;

            $.post(main, {halaman: kd_hal} ,function(data) {

                $("#data-inbox").html(data).show();
            });
        });






    });

    $(document).ready(function(e) {


        var nomor = 0;
        var main = "inbox/inbox.sent.php";


        $("#sent-inbox").load(main);

        $('input:text[name=carisent]').on('input',function(e){
            var v_cari = $('input:text[name=carisent]').val();

            if(v_cari!="") {
                $.post(main, {cari: v_cari} ,function(data) {

                    $("#sent-inbox").html(data).show();
                });
            } else {

                $("#sent-inbox").load(main);
            }
        });

    });


    $(document).ready(function(e) {


        var nomor = 0;
        var main = "inbox/inbox.draft.php";


        $("#draft-inbox").load(main);

        $('input:text[name=caridraft]').on('input',function(e){
            var v_cari = $('input:text[name=caridraft]').val();

            if(v_cari!="") {
                $.post(main, {cari: v_cari} ,function(data) {

                    $("#draft-inbox").html(data).show();
                });
            } else {

                $("#draft-inbox").load(main);
            }
        });

    });



}) (jQuery);
