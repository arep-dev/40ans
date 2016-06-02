$(function(){

	$('.list-container-profil').click(function(){

		 checkVisibility = $(this).find('.check').attr('class');
		 test = checkVisibility.substr( checkVisibility.lastIndexOf(' ') + 1);
	
			if(test == 'actif') {
				$(this).find('.check').removeClass('actif');
				$(this).find('input').attr('value', 0);
			}else{
				$(this).find('.check').addClass('actif');
				$(this).find('input').attr('value', 1);

			}	

			// On lance la requête checkin
			checkin();
				
	});

	function checkin() {
		$.ajax({
			url: 'index.php',
			method: 'POST',
			data: $('form').serialize(),
			dataType: 'json',

			success: function(result) {
				var count = 0;
				$.each(result, function(i, item) {
					count += parseInt(result[i]);
				});
				var nbInvites = parseInt($('.nbInvites').html());
				$('.arrival').html(count);
				$('.expected').html(nbInvites - count);
			},

			error: function(a, b, c) {
				console.log(a+ ' '+b+' '+c);
			}
		});
	}

});