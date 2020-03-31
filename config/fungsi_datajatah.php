<script type="text/javascript">

    var oTable1 ;
    $(document).ready(function() {
        oTable1 = $('#sample-table-2').DataTable( {
            "bProcessing": true,
            "bServerSide": true,
            "bJQueryUI": false,
            "responsive": true,
            "sAjaxSource": "absen/serverSidedatajatah.php", // Load Data
            "sServerMethod": "POST",
            "columnDefs": [
                { "orderable": false, "targets": 0, "searchable": false },
                { "orderable": true, "targets": 1, "searchable": true },
                { "orderable": true, "targets": 2, "searchable": true },
                { "orderable": true, "targets": 3, "searchable": true },
                { "orderable": true, "targets": 4, "searchable": true},
                { "orderable": true, "targets": 5, "searchable": true }





            ]
        });

        var tableTools = new $.fn.dataTable.TableTools( oTable1, {
            "sSwfPath": "assets/swf/copy_csv_xls_pdf.swf",
            "aButtons": [
                {
                    "sExtends": "copy",
                    "sToolTip": "Copy to clipboard",
                    "sButtonClass": "btn btn-white btn-primary btn-bold",
                    "sButtonText": "<i class='fa fa-copy bigger-110 pink'></i>",
                    "fnComplete": function() {
                        this.fnInfo( '<h3 class="no-margin-top smaller">Table copied</h3>\
									<p>Copied '+(oTable1.fnSettings().fnRecordsTotal())+' row(s) to the clipboard.</p>',
                            1500
                        );
                    }
                },

                {
                    "sExtends": "csv",
                    "sToolTip": "Export to CSV",
                    "sButtonClass": "btn btn-white btn-primary  btn-bold",
                    "sButtonText": "<i class='fa fa-file-excel-o bigger-110 green'></i>"
                },

                {
                    "sExtends": "pdf",
                    "sToolTip": "Export to PDF",
                    "sButtonClass": "btn btn-white btn-primary  btn-bold",
                    "sButtonText": "<i class='fa fa-file-pdf-o bigger-110 red'></i>"
                },

                {
                    "sExtends": "print",
                    "sToolTip": "Print view",
                    "sButtonClass": "btn btn-white btn-primary  btn-bold",
                    "sButtonText": "<i class='fa fa-print bigger-110 grey'></i>",

                    "sMessage": "<div class='navbar navbar-default'><div class='navbar-header pull-left'><a class='navbar-brand' href='#'><small>Print Preview</small></a></div></div>",

                    "sInfo": "<h3 class='no-margin-top'>Print view</h3>\
									  <p>Please use your browser's print function to\
									  print this table.\
									  <br />Tekan <b>escape</b> untuk kembali.</p>"
                }
            ]
        } );
        $( tableTools.fnContainer() ).insertBefore('#sample-table-2');

        $('#sample-table-2').removeClass( 'display' ).addClass('table table-striped table-bordered');
        $('#sample-table-2 tfoot th').each( function () {

            //Agar kolom Action Tidak Ada Tombol Pencarian
            if( $(this).text() != "Action" ){
                var title = $('#sample-table-2 thead th').eq( $(this).index() ).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" class="form-control" />' );
            }
        } );

        // Untuk Pencarian, di kolom paling bawah
        dTable.columns().every( function () {
            var that = this;

            $( 'input', this.footer() ).on( 'keyup change', function () {
                that
                    .search( this.value )
                    .draw();
            } );
        } );





    } );



</script>