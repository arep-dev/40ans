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

			statut = $(this).find('input').attr('value');	
			id = $(this).find('input').attr('name');

			// On lance la requête checkin
			checkin(id, statut);
				
	});

	function checkin(id, statut) {

		$.ajax({
			url: 'index.php',
			method: 'POST',
			data: 'statut='+statut+'&id='+id,
			dataType: 'html',

			success: function(result) {
				//console.log('RESULT:'+result);
				var arrival = parseInt($('.arrival').html());
				if(result == 1) {
					$('.arrival').html(arrival + 1)
				}else{
					$('.arrival').html(arrival - 1)
					
				}
				var arrival = parseInt($('.arrival').html());
				var nbInvites = parseInt($('.nbInvites').html());
				$('.expected').html(nbInvites - arrival);
			},

			error: function(a, b, c) {
				console.log(a+ ' '+b+' '+c);
			}
		});
	}

});