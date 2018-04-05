
$(document).ready(function () {
  $(".se-pre-con").fadeOut("slow");

  $(".full-height").css({
    "min-height": $(window).height() - $(".footer-copyright").innerHeight() - $(".navbar").innerHeight()
  });
  $(window).on('resize', function() {
    $(".full-height").css({
      "min-height": $(window).height() - $(".footer-copyright").innerHeight() - $(".navbar").innerHeight()
    });
  });

  $('#addAnotherRemindMail').click(function(){
      var value=$('#numberofreminders').val();

        if (value == 10){
          alert("Cannot add more Reminders");
        }
      else {
            var filledReminders=0;
            for (var i = 1; i <= value; i++) {
              if($('#mailremind'+i).val() != "")
                  filledReminders ++;
            }

            if (filledReminders != value){
              $('#errors div').remove();
              $('#errors').prepend('<div class="alert alert-danger">Please fill existing Reminders before adding another one </div>');
              window.scrollTo(0,0);
            }
            else {
                    var duplicate = false;
                    for (var i = 1; i <= value; i++) {
                      if($('#mailremind'+i).val()){
                      for (var j = i+1; j <= value; j++) {
                          
                          if ($('#mailremind'+i).val() == $('#mailremind'+j).val()){
                                duplicate=true;
                                $('#mailremind'+j).val("");
                              }
                        }
                      }
                    }

                    if (duplicate){
                      $('#errors div').remove();
                      $('#errors').prepend('<div class="alert alert-danger"> Please fill existing Reminders with distinct days </div>');
                      window.scrollTo(0,0);
                    }
                    else{

                          var add=parseInt(value)+1;
                          $('#numberofreminders').val(add);
                          $('#mailremind1').clone(true).attr("id","mailremind"+add).attr("name","mailreminder"+add).attr("placeholder",' Reminder' ).appendTo('.mailreminderinputs').val("");
                       }
                  }
           }
      });

    $('#servicecategories').change(function(){
        $('#services option').remove();
        var val=$('#servicecategories').val();

        var div=$('#category'+val+' option');

        div.clone(true).appendTo("#services");

    });

      $('#servicetoclientform').submit(function() {
                  var valid=true;

                  $('#errors div').remove();
                  
                  var value=$('#numberofreminders').val();
                  var noReminders=true;
                  for (var i=1;i<value;i++){
                    if ($('#mailremind'+i).val()){
                      noReminders=false;
                      break;
                    }
                  }

                  if (noReminders == true){
                        $('#errors').prepend('<div class="alert alert-danger"> Please choose at least one mail reminder </div>');
                        valid= false;
                      }

                      //Get payment months to know max days to remind
                      var maxDaysToMail=$("#payment_method").val();
                      maxDaysToMail=30*maxDaysToMail;

                  var value=$('#numberofreminders').val();
                  var duplicate = false;
                    for (var i = 1; i <= value; i++) {
                      if($('#mailremind'+i).val() > maxDaysToMail){
                      valid=false;
                      $('#errors').prepend('<div class="alert alert-danger"> Please choose at e-mail reminders before duration less than payment method </div>');
                    }
                      for (var j = i+1; j <= value; j++) {
                        if($('#mailremind'+i).val()){
                        if ($('#mailremind'+i).val() == $('#mailremind'+j).val()){
                              duplicate=true;
                              $('#mailremind'+j).val("");
                            }
                      }
                    }
                    }

                      if (duplicate){
                        $('#errors').prepend('<div class="alert alert-danger"> Please fill existing Reminders with distinct days </div>');
                        valid=false;
                      }

                    if (!valid)
                      {
                        window.scrollTo(0,0);
                        return false;
                      }

          });
});
