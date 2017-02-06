$(document).ready(validate.onReady);

var validate = {
    onReady: function() {

        if (jQuery("#submit_btn").attr("disabled") == "disabled") {
            jQuery("#submit_btn").removeAttr("disabled","disabled");
        }

        validate.formValidate();
    },

    formValidate: function() {
        //表单验证与AJAX发送
        $("#contact_form").validate({
            rules: {
              name: "required", 
              email: "required",
              subject: "required",
              message: "required",
            },
            messages: {
              name: "Please Input Your Name",
              email: "Please Input Your Email",
              subject: "Please Input Your Subject",
              message: "Please Input Your Message",
            },
            submitHandler: function(form) {
                //预防多次发送
                $("#submit_btn").attr("disabled","disabled");

                var formData = {
                  action: "event",
                  name: $('#name').val(),
                  email: $('#email').val(),
                  subject: $('#subject').val(),
                  message: $('#message').val(),
                };

                $.ajax({
                    type: "POST",
                    url: "/wp-admin/admin-ajax.php",
                    dataType: "JSON",
                    data: formData,
                    beforeSend: function() {
                      $(".msgSubmit").addClass("alert alert-info").text("Wait a moment,Email Sending...");
                    },
                    success: function(text) {
                      if (text.status == "success"){
                          $(".msgSubmit").text("Email Send Success");
                      } else {
                          $(".msgSubmit").text("Email Send Fail");
                      }             
                    },
                    error: function(jqXHR, textStatus) {
                      var msg = "";
                      switch (jqXHR.status) {
                        case 0:
                          msg = "Not connect. Verify Network";
                        break;

                        case 404:
                          msg = "Requested page not found. ";
                        break;
                        
                        case 500:
                          msg = "Internal Server Error [500].";
                        break;

                        case 504:
                          msg = "504 Time Out";
                        break;

                        default: 
                          msg = "Nothig error";
                        break;
                      }

                      $(".msgSubmit").text(msg);
                    }
                });
            }
        });
    }
};


