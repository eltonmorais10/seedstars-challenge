$("#checkbox").click(function(){
	if($(this).is(":checked")){
		$("#add-user").removeAttr("disabled");
	} else {
		$("#add-user").attr("disabled", "disabled");
	}
});

$("#add-user").click(function(e){
	// hide error message and retrive needed values
	$("#error-message").fadeOut();
	var email = $("#email").val();
	var username = $("#username").val();

	// if any value is missing its input will be highlighted
	if (email === "" || username === "") {
		if (email === "") {
			$("#email").addClass("missing-val");
		} else {
			$("#email").removeClass("missing-val");
		}

		if (username === "") {
			$("#username").addClass("missing-val");
		} else {
			$("#username").removeClass("missing-val");
		}
	// if all the input are filled than test the email value
	} else {
		$("#email").removeClass("missing-val");
		$("#username").removeClass("missing-val");

		// test the email to the regex 
		var re = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
		// if email invalid show error message if not than make the call
		if(!re.test($("#email").val())){
			// restore the message error bg-color, write the message and show it
			$("#error-message").css("background-color", "#ff0033").text("Error! Email invalid.").fadeIn("slow");
		} else {
			var url = "/home/addrecord/" + email + "/" + username;
			$.ajax({
				url: url,
				dataType: 'json',
				method: 'POST',
				success: function(data) {
					// in case the sql insert was completed successfully than sow success message
					// if not than show error message
					if (data['status'] === 'success') {
						$("#error-message").css("background-color", "#66cd00").text("User added with success!").fadeIn("slow");
						$("#email").val("");
						$("#username").val("");
						$("#checkbox").click();
					} else {
						//restore the error message bg-color and show it
						$("#error-message").css("background-color", "#ff0033").text("Error! " + data['message']).fadeIn("slow");
					}
				}
			});
		}	
	}
});