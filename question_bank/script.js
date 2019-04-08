jQuery(function(){
  jQuery("#myform").on("submit", function(e){
    e.preventDefault();
      var email = jQuery("#email").val();
      var password = jQuery("#password").val();

      var emailPattern = /^[a-z0-9]+@[a-zA-Z]\.[a-zA-Z]{2,3}+$/;[\[\]?*+|{}\\()@.\n\r]
      var passwordPattern = /^[a-zA-Z0-9]+$/;
      var status = true;
      // for email
      if(email == "")
      {

        jQuery("#email").css("border", "1px solid red");
        jQuery("#emailErr").text("Please Enter Email-Id").css("color", "red");
        status = false;
      }
      else if(!emailPattern.test(email))
      {
        jQuery("#email").css("border", "1px solid red");
        jQuery("#emailErr").text("Enter valid Email-Id").css("color", "red");
        status = false;
      }
      else 
      {
        jQuery("#email").css("border", "");
        jQuery("#emailErr").text("").css("color", "");
      }

      // for password
      if(password == "")
      {
        jQuery("#password").css("border", "1px solid red");
        jQuery("#passwordErr").text("Please Enter Password").css("color", "red");
        status = false;
      }
      else if(!passwordPattern.test(password))
      {
        alert(password);
        jQuery("#password").css("border", "1px solid red");
        jQuery("#passwordErr").text("Enter valid password").css("color", "red");
        status = false;
      }
      else
      {
        jQuery("#password").css("border", "");
        jQuery("#passwordErr").text("").css("color", "");
      }

      if(status==true)
      {
        jQuery.ajax({
        type : "post",
        url : " ",
        data : jQuery(this).serialize(),
        success:function(response)
        {
          // alert(response);
        }
        });
      }
    })
});
