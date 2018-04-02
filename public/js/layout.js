$(".full-height").css({
        "min-height": $(window).height() - $(".footer-copyright").innerHeight() - $(".navbar").innerHeight()
    });
    $(window).on('resize', function() {
        $(".full-height").css({
          "min-height": $(window).height() - $(".footer-copyright").innerHeight() - $(".navbar").innerHeight()
    });
});

$(document).ready(function () {

    $('#servicecategories').change(function(){
        $('#services option').remove();
        var val=$('#servicecategories').val();

        var div=$('#category'+val+' option');

        div.clone(true).appendTo("#services");

    });

    $('#addAnotherRemindMail').click(function(){
      var numbers=[0,"First","Second","Third","Fourth","Fifth","Sixth","Seventh","Eighth","Ninth","Tenth"];
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
                          $('.mailreminderinputs').append("<br>");
                          $('#mailremind1').clone(true).attr("id","mailremind"+add).attr("name","mailreminder"+add).attr("placeholder",numbers[add]+' Reminder' ).appendTo('.mailreminderinputs').val("");
                       }
                  }
           }
      });

      $('#addservicetoclientform').submit(function() {
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

                  var value=$('#numberofreminders').val();
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
                        valid=false;
                      }

                    if (!valid)
                      return false;

          });
});

