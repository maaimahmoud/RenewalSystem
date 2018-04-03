
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
              alert("Please fill existing Reminders before adding another one");
            }
            else {
                    var duplicate = false;
                    for (var i = 1; i <= value; i++) {
                      for (var j = i+1; j <= value; j++) {
                        if ($('#mailremind'+i).val() == $('#mailremind'+j).val()){
                              duplicate=true;
                              $('#mailremind'+j).val("");
                            }
                      }
                    }

                    if (duplicate){
                      alert("Please fill existing Reminders with distinct days");
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
                  if ( $("#services").val() == 0){
                        alert("Please choose service to add");
                        valid= false;
                      }
                  if ( $("#payment_method").val() == 0){
                        alert("Please choose the payment method");
                        valid= false;
                      }

                  if ( $("#mailremind1").val() == ""){
                        alert("Please choose at least one mail reminder");
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
                      alert("Please choose at e-mail reminders before duration less than payment method");
                    }
                      for (var j = i+1; j <= value; j++) {
                        if ($('#mailremind'+i).val() == $('#mailremind'+j).val()){
                              duplicate=true;
                              $('#mailremind'+j).val("");
                            }
                      }
                    }

                      if (duplicate){
                        alert("Please fill existing Reminders with distinct days");
                        valid=false;
                      }

                    if (!valid)
                      return false;

          });
});
