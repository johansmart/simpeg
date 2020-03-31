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
});




</script>