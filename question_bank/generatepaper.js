$(document).ready(function(){
	$("#QueAns").click(function(e){
		e.preventDefault();

	
		var technology = $("#technology option:selected").val();
		var level = $("#level option:selected").val();
		var question=$("#limit_que").val();
		var type = $("input[name='type[]']:checked").val();
		var objquestion=$("#limit_objque").val();
		var subquestion=$("#limit_subque").val();
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

		//limit Question
         if(question=="") {
			$("#limit_que").css('border-color', 'red');
			$("#limit_queErr").text("Please Enter limit of question").css('color','red');
			status=false;
		}else {
			$("#limit_que").css('border-color', '');
			$("#limit_queErr").text("").css('color', '');
		}
		//limit obj Question
         if(objquestion=="") {
			$("#limit_objque").css('border-color', 'red');
			$("#limit_objqueErr").text("Please Enter limit of objective question").css('color','red');
			status=false;
		}else {
			$("#limit_objque").css('border-color', '');
			$("#limit_objqueErr").text("").css('color', '');
		}
		//limit sub Question
         if(subquestion=="") {
			$("#limit_subque").css('border-color', 'red');
			$("#limit_subqueErr").text("Please Enter limit of subjective question").css('color','red');
			status=false;
		}else {
			$("#limit_subque").css('border-color', '');
			$("#limit_subqueErr").text("").css('color', '');
		}
	
		if(status==true){
			 
		var formData = $('#generate').serialize();
				$.ajax({
					type:'POST',
					data: formData,
					url:'genquepaper.php', 
					success: function(result){
						$('#download').html(result);
					}
				  });
        }

	});
});

