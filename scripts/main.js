// This is for the Header Text
$(".title").fitText();
$(".subtitle").fitText(2.4);
$(".butler").bigtext();

// This is for the AJAX forms.
$(document).ready(function(){
	$("#login").submit( function () {    
		// $(this).serialize() # This makes it in GET form. ?n=foo&b=bar
		
		$.post(
			'login.php',
			$(this).serialize()+'&ajaxlogin=true',
			function(data){
				//console.log(data);
				$('.login').html(data['html']);
			},
			'json'
		);

		// returning false allows the form to not redirect to login.php
		return false;   
	});
	$("#beta").submit( function () {    
		// $(this).serialize() # This makes it in GET form. ?n=foo&b=bar
		
		$.post(
			'beta.php',
			$(this).serialize(),
			function(data){
				console.log(data);
				$('.betaWrap').html(data['html']);
			},
			'json'
		);

		// returning false allows the form to not redirect to login.php
		return false;   
	});
});