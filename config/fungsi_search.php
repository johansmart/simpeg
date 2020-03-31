<script type="text/javascript">
jQuery(function($) {

    $('#golongan').removeAttr('checked').on('click', function(){
        $('#default-buttons .btn').toggleClass('no-border');
    });
    $('#subbag').removeAttr('checked').on('click', function(){
        $('#default-buttons .btn').toggleClass('no-border');
    });

    $('#statusp').removeAttr('checked').on('click', function(){
        $('#default-buttons .btn').toggleClass('no-border');
    });

    $('#idnama').removeAttr('checked').on('click', function(){
        $('#default-buttons .btn').toggleClass('no-border');
    });

    $('#jbstruk').removeAttr('checked').on('click', function(){
        $('#default-buttons .btn').toggleClass('no-border');
    });

    $('#jbfungsi').removeAttr('checked').on('click', function(){
        $('#default-buttons .btn').toggleClass('no-border');
    });
    $('#idjabatan').removeAttr('checked').on('click', function(){
        $('#default-buttons .btn').toggleClass('no-border');
    });
    $('#idbagian').removeAttr('checked').on('click', function(){
        $('#default-buttons .btn').toggleClass('no-border');
    });
    $('#idkdkpkrn').removeAttr('checked').on('click', function(){
        $('#default-buttons .btn').toggleClass('no-border');
    });
    $('#umur').removeAttr('checked').on('click', function(){
        $('#default-buttons .btn').toggleClass('no-border');
    });
    $('#pndk').removeAttr('checked').on('click', function(){
        $('#default-buttons .btn').toggleClass('no-border');
    });
	$('#idstsk').removeAttr('checked').on('click', function(){
        $('#default-buttons .btn').toggleClass('no-border');
    });
	
	$('#mkerja').removeAttr('checked').on('click', function(){
        $('#default-buttons .btn').toggleClass('no-border');
    });
	
	
    $("#btn_loading").click(function(){
        var vsubmit = $('input[name=submit]').val();
        var vgolongan= $('input[name=golongan]:checked').val();
        var vidnama = $('input[name=idnama]:checked').val();
        var vpndk = $('input[name=pndk]:checked').val();
        var vidkdkpkrn = $('input[name=idkdkpkrn]:checked').val();
        var vumur = $('input[name=umur]:checked').val();
		var vmkerja = $('input[name=mkerja]:checked').val();
        var vidstsk = $('input[name=idstsk]:checked').val();
        var vidbagian = $('input[name=idbagian]:checked').val();
        var vidjabatan = $('input[name=idjabatan]:checked').val();
        var vjbfungsi = $('input[name=jbfungsi]:checked').val();
        var vjbstruk = $('input[name=jbstruk]:checked').val();
        var vsubbag = $('input[name=subbag]:checked').val();
        var vstatusp = $('input[name=statusp]:checked').val();
        var vname = $('input[name=name]').val();
        var vidgol = $('select[name=idgol]').val();
        var vidpndk = $('select[name=idpndk]').val();
        var vumur1 = $('input[name=umur1]').val();
        var vumur2 = $('input[name=umur2]').val();
		var vmkerja1 = $('input[name=mkerja1]').val();
        var vmkerja2 = $('input[name=mkerja2]').val();
        var vnmkdkpkrn= $('input[name=nmkdkpkrn]').val();
        var vid_stsk= $('select[name=id_stsk]').val();
        var vid_bag= $('select[name=id_bag]').val();
        var vid_jab= $('select[name=id_jab]').val();
        var vkd_jbfungsi= $('select[name=kd_jbfungsi]').val();
        var vkd_jbstruk= $('select[name=kd_jbstruk]').val();
        var vkdsubbag= $('select[name=kdsubbag]').val();
        var vkd_statusp= $('select[name=kd_statusp]').val();

        $.post("hasil.php",
                {
                    submit: vsubmit,
                    idnama: vidnama,
                    name: vname,
                    golongan:vgolongan,
                    idkdkpkrn:vidkdkpkrn,
                    idstsk:vidstsk,
                    idbagian:vidbagian,
                    idjabatan:vidjabatan,
                    jbfungsi:vjbfungsi,
                    jbstruk:vjbstruk,
                    subbag:vsubbag,
                    statusp:vstatusp,
                    pndk:vpndk,
                    umur:vumur,
					mkerja:vmkerja,
                    idgol:vidgol,
                    idpndk:vidpndk,
                    umur1:vumur1,
                    umur2:vumur2,
					mkerja1:vmkerja1,
                    mkerja2:vmkerja2,
                    nmkdkpkrn:vnmkdkpkrn,
                    id_stsk:vid_stsk,
                    id_bag:vid_bag,
                    id_jab:vid_jab,
                    kd_jbfungsi:vkd_jbfungsi,
                    kd_jbstruk:vkd_jbstruk,
                    kdsubbag:vkdsubbag,
                    kd_statusp:vkd_statusp
                },
                function (response, status) {
                    $("#hasil").html(response);

                });

    });

});

</script>