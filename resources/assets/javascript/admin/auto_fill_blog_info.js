(function(){

    console.log('autofill listener launched');

    var buttonActivator = function(){
		
		var twitterFieldContent = $('input[name="author_twitter"]').val();
		var urlFieldContent = $('input[name="url"]').val();

		if ((twitterFieldContent.length > 0) && (urlFieldContent.length > 0)) {
			$('#autofill').removeAttr('disabled');
		}else{
			$('#autofill').attr('disabled','disabled');
		}
    };

	$('input[name="author_twitter"]').on('input', function(){
		buttonActivator();
	});
	
	$('input[name="url"]').on('input', function(){
		buttonActivator();
	});

	// when submitted
	$('#autofill').on('click', function(e){
		e.preventDefault();
		console.log('clicked');

		var formdata = $('form').serialize();
		var target_url = $('#autofill').closest('form').attr('action');
		
		$.ajax({
			type: 'POST',
			url: target_url,
			data: formdata,
			success: function(data){
				console.log('success!');
				
				// fill the info in form
				$('input[name="rss_feed"]').val(data.rss);
				$('input[name="name"]').val(data.title);
				$('input[name="description"]').val(data.description);

				// todo 
				// data.image
			}
		});

	});

})();