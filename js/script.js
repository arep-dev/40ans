$(function(){

	$('.list-container-profil').click(function(){

		 checkVisibility = $(this).find('.check').attr('class');
		 test = checkVisibility.substr( checkVisibility.lastIndexOf(' ') + 1);
	
		 console.log(test);
			if(test == 'actif') {
				$(this).find('.check').removeClass('actif');
				$(this).find('input').attr('value', 0);
			}else{
				$(this).find('.check').addClass('actif');
				$(this).find('input').attr('value', 1);

			}	


			checkin();
				
	});

	function checkin() {
		$.ajax({
			url: 'index.php',
			method: 'POST',
			data: $('form').serialize(),
			dataType: 'json',

			success: function(result) {
				console.log(result);
			},

			error: function(a, b, c) {
				console.log(a+ ' '+b+' '+c);
			}
		});
	}

});