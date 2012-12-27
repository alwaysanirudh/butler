// Last edited: 12/10/12, 10:19pm EST by Taylor Coffelt

/* SUMMARY:
	This file is for the Javascript side of Butler and the web
	speech input.
*/

$('.butler').focus();
if(document.createElement('input').webkitSpeech == undefined) {
  //no speech support
}

$('#butler').keyup(function(e){
	if (e.keyCode==13) {
		e.preventDefault();
		send_to_server($('.butler').val());
		$('.butler').val('');
	};
})
$('#butler').bind("webkitspeechchange", function(){
	send_to_server($('#butler').val());
	$('.butler').val('');
});

function send_to_server(string) {
	$('.loading').addClass('show');
	$.post(
		'butler.php',
		'p='+encodeURI(string),
		function(data){
			//console.log(data);
			addACard(data);
		},
		'json'
	);
}

function addACard(data){
	$('.loading').removeClass('show');
	//console.log('I think you\'re talking about "'+data[0]+'"');
	html = '<div class="card fadeInLeft animated">\
				<div class="cardTitle">I think...</div>\
				<div class="cardContent">I think you said "'+data[0]+'".<br>\
				with a certainty of '+data[1]+'. (Higher is better)</div>\
			</div>\
	';
	$('.cardWrap').prepend(html);

	try{
		$($('.cardWrap .card')[3]).remove();
	}
	catch (e){

	}
}