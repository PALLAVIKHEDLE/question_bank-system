$(document).ready(function(){
	$("#QueAns").click(function(e){
		e.preventDefault();

	
		var technology = $("#technology option:selected").val();
		var level = $("#level option:selected").val();
		var ques_no=$("#ques").val();
		var question=$("#limit_que").val();
		var type = $("input[name='type[]']:checked").val();
	//	var technology = $("input[name='technology[]']:checked").val();

		var status=true;
		
		//checkbox
		if($("#Objective").is(":checked")||$("#Subjective").is(":checked")){
			$("#typeErr").text("");
		}else{
			$("#typeErr").text("Select one").css("color","red");
			 status=false;
		}
		//technology
         if(technology=="") {
			$("#technology").css('border-color', 'red');
			$("#techErr").text("Please Select One").css('color','red');
			status=false;
		}else {
			$("#technology").css('border-color', '');
			$("#techErr").text("").css('color', '');
		}

		//level
         if(level=="") {
			$("#level").css('border-color', 'red');
			$("#levelErr").text("Please Select One").css('color','red');
			status=false;
		}else {
			$("#level").css('border-color', '');
			$("#levelErr").text("").css('color', '');
		}
		//NO Of Question
         if(ques_no=="") {
			$("#ques").css('border-color', 'red');
			$("#queErr").text("Please Enter Total Number Of question").css('color','red');
			status=false;
		}else {
			$("#ques").css('border-color', '');
			$("#queErr").text("").css('color', '');
		}
		//limit Question
         if(question=="") {
			$("#limit_que").css('border-color', 'red');
			$("#limit_queErr").text("Please Enter limit of question").css('color','red');
			status=false;
		}else {
			$("#limit_que").css('border-color', '');
			$("#limit_queErr").text("").css('color', '');
		}
	
		if(status==true){
			 
		var formData = $('#generate').serialize();
				$.ajax({
					type:'POST',
					data: formData,
					url:'generate_print.php', 
					success: function(result){
						$('#download').html(result);
					}
				  });
        }

	});
});

