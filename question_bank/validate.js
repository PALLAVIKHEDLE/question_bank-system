$(document).ready(function(){
	//btn click
	$("#register").click(function(e){
		e.preventDefault();
		var name = $("#name").val();
		var email = $("#email").val();	
		var password=$("#password").val();
		var mobile = $("#mobile").val();
  		var technology = $("input[name='technology[]']:checked").val();
  		var role = $("#role option:selected").val();
		var status=true;
		//name
		if(name=="") {
			$("#name").css('border-color', 'red');
			$("#nameErr").text("Enter Name").css('color','red');
			status=false;
		}else if (!validateName(name)) {
			$("#name").css('border-color', 'red');
			$("#nameErr").text("First letter should be capital").css('color', 'red');
			status=false;
		}else {
			$("#name").css('border-color', '');
			$("#nameErr").text("").css('color', '');
		}
		//mobile
		if(mobile==""||mobile.length<10||mobile.length>10||isNaN(mobile)) {
			$("#mobile").css("border-color","red");
			$("#mobileErr").text("Enter number").css("color","red");
			status=false;
		}else {
 			$("#mobile").css("border-color","");
			$("#mobileErr").text("");
		}
		//email
		if(email=="") {
			$("#email").css('border-color', 'red');
			$("#emailErr").text("Enter Email").css('color','red');
			status=false;
		}else if (!validateEmail(email)) {
			$("#email").css('border-color', 'red');
			$("#emailErr").text("Invalid Email Address").css('color', 'red');
			status=false;
		}else {
			$("#email").css('border-color', '');
			$("#emailErr").text("");
         }

         //technology
         if($(".tech").is(":checked")) {
			$("#techErr").text("");
		}else{
			$("#techErr").text("Select one").css("color","red");
			 status=false;
		}
		//role
		 if(role=="") {
			$("#role").css('border-color', 'red');
			$("#roleErr").text("Please Select One").css('color','red');
			status=false;
		}else {
			$("#role").css('border-color', '');
			$("#roleErr").text("").css('color', '');
		}
		

	//email validation function 
		function validateEmail(email) {
		var emailPattern = /^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/;
		return emailPattern.test(email);
		}
		//name validation function
		function validateName(name) {
			 var namePattern = /^[A-Z\s]{1,}[A-Za-z\s]{0,}$/;
			  return namePattern.test(name);
		}
	
		if(status==true) {

				var formData = $('#insertform').serialize();
				$.ajax({
					type:'POST',
					data: formData,
					url:"register.php", 
					success: function(result){
						alert(result);
					}
				  });
			

        }
//success
	});
	//ready function
});
