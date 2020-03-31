<script type="text/javascript">
jQuery(function($) {


    $.validator.setDefaults({
        submitHandler: function () {
            register();

        }

    });

    $().ready(function () {
        // validate the comment form when it is submitted
        $("#valid-profil").validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                username: {
                    required: true
                },

                nama: {
                    required: true
                },
                pass1: {
                    required: true,
                    minlength: 5
                },
                pass2: {
                    required: true,
                    minlength: 5,
                    equalTo: "#pass1"
                },

                tgl_lahir: {
                    required: true
                },

                ttl: {
                    required: true
                },
                alamat: {
                    required: true
                },

                jk: {
                    required: true
                },
                aboutme: {
                    required: true
                },
                email: {
                    required: true
                }



            },

            messages: {

                password: {
                    required: "Please specify a password.",
                    minlength: "Please specify a secure password."
                },
                username: "Mohon isi username anda",

                nama: "Mohon isi nama anda",

                tgl_lahir: "Mohon isi Tgl lahir anda",

                jk: "Mohon isi jeni kelamin anda",

                ttl: "Mohon isi tempat lahir anda",

                alamat: "Mohon isi alamat anda",

                jk: "Mohon isi Tentang anda"

            },


            highlight: function (e) {
                $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
            },

            success: function (e) {
                $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
                $(e).remove();
            },

            errorPlacement: function (error, element) {
                if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
                    var controls = element.closest('div[class*="col-"]');
                    if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                    else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
                }
                else error.insertAfter(element.parent());
            }

        });


});






	$('.easy-pie-chart.percentage').each(function(){
		var barColor = $(this).data('color') || '#555';
		var trackColor = '#E2E2E2';
		var size = parseInt($(this).data('size')) || 72;
		$(this).easyPieChart({
			barColor: barColor,
			trackColor: trackColor,
			scaleColor: false,
			lineCap: 'butt',
			lineWidth: parseInt(size/10),
			animate:false,
			size: size
		}).css('color', barColor);
	});

	///////////////////////////////////////////

	//right & left position
	//show the user info on right or left depending on its position

	///////////////////////////////////////////
	$('#user-profile-2')
			.find('input[type=file]').ace_file_input({
				style:'well',
				btn_choose:'Upload Foto',
				btn_change:null,
				no_icon:'ace-icon fa fa-picture-o',
				thumbnail:'large',
				droppable:true,

				allowExt: ['jpg', 'jpeg', 'png', 'gif'],
				allowMime: ['image/jpg', 'image/jpeg', 'image/png', 'image/gif']
			})
			.end().find('button[type=reset]').on(ace.click_event, function(){
				$('#user-profile-2 input[type=file]').ace_file_input('reset_input');
			})
			.end().find('.date-picker').datepicker().next().on(ace.click_event, function(){
				$(this).prev().focus();
			})
	////////////////////
	//change profile
	$('[data-toggle="buttons"] .btn').on('click', function(e){
		var target = $(this).find('input[type=radio]');
		var which = parseInt(target.val());
		$('.user-profile').parent().addClass('hide');
		$('#user-profile-'+which).parent().removeClass('hide');
	});



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
});

});
</script>