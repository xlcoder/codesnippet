jQuery(document).ready(function ($) {
  //刷新页面取消表单发送限制
  $(".contact-btn").removeAttr("disabled","disabled");

  //表单验证与AJAX发送
  $("#event-form").validate({
    rules: {
      username: "required", 
      contact: "required",
      person: "required",
      date: "required",
      destination: "required"
    },
    messages: {
      username: "请输入你的姓名",
      contact: "请输入你的联系电话或邮件",
      person: "请输入你的出行人数",
      date: "请输入你的出行日期",
      destination: "请输入你的目的地"
    },
    submitHandler: function(form) {
        //预防多次发送
        $(".contact-btn").attr("disabled","disabled");

        var formData = {
          action: "event_form",
          name: $('#username').val(),
          contact: $('#contact').val(),
          person: $('#person').val(),
          date: $('#date').val(),
          destination: $('#destination').val(),
        };

        $.ajax({
            type: "POST",
            url: "/wp-admin/admin-ajax.php",
            dataType: "JSON",
            data: formData,
            beforeSend: function() {
              $(".msgSubmit").text("请稍候,邮件正在发送中...");
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
                  msg = "Time Out";
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

});
