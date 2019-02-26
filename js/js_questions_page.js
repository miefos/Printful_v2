// <!-- 

// Here are javascript functions for questions page

//  -->
$(document).ready(function() {
	var qn = 0; // Represents question number
	var valueSelected = '';

	(function() {
		$('body').append("<div id='questionDiv'></div>");
	})();

	// Get the first question
	$.ajax({type: "POST", 
        url: "getQuestions.php", 
        dataType:"text", 
        data: {qn: qn}, 
        success:function(response){ 
                $("#questionDiv").html(response);
                qn++;
                valueSelected = '';
        }, 
	     error: function(xhr, textStatus, errorThrown) { 
	            alert('Error!  Status = ' + xhr.status); 
	            valueSelected = '';
     }});

	// Get every next question when button 'next question' is clicked AND
	// insert answer of current into Database
	$('body').on('click', '#btn-next', function() {
		if(valueSelected != ''){
		$.ajax({type: "POST", 
	        url: "getQuestions.php", 
	        dataType:"text", 
	        data: {qn: qn,
	        	 selected: $("button[activew='true']").attr('val')
	     	}, 
	        success:function(response){ 
	                $("#questionDiv").html(response);
	                qn++;
	                valueSelected = '';
	        }, 
		     error: function(xhr, textStatus, errorThrown) { 
		            alert('Error!  Status = ' + xhr.status); 
		            valueSelected = '';
		    }});}
		});

		// Redirects to results.php when completed
		$('body').on('click', '#btn-finish', function() {
			$.ajax({type: "POST", 
		        url: "getQuestions.php", 
		        dataType:"text", 
		        data: {qn: qn,
		        	 selected: $("button[activew='true']").attr('val')}, 
		        success:function(response){ 
		        	window.location.href = 'results.php';
		        }, 
			     error: function(xhr, textStatus, errorThrown) { 
			            alert('Error!  Status = ' + xhr.status); 
			            valueSelected = '';
			    }});
		});


	 	var before = '';
		$('body'). on('click', "button[id^='ans']", function() {
		$(this).attr('activew', 'true');
		$(this).css('background-color', '#0053ba');
		if($(this) != before){
			if (before == '') {
				before = $(this);
			} else {
				before.css('background-color', '');
				before.attr('activew', '');
				before = $(this);
			}
			valueSelected = $(this).attr('val');	
		} else {
			before.css('background-color', '');
			before.attr('activew', '');
			before = '';
			valueSelected = '';
		}
		
	});
}); 
