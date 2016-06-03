$(function(){
	var zindex = 3;

	$('.list-container-profil').click(function(){

		 checkVisibility = $(this).find('.check').attr('class');
		 test = checkVisibility.substr( checkVisibility.lastIndexOf(' ') + 1);
	
			if(test == 'actif') {
				$(this).find('.check').removeClass('actif');
				$(this).find('input').attr('value', 0);	
				$(this).attr('style', 'background: #074d97;');
			}else{
				$(this).find('.check').addClass('actif');
				$(this).find('input').attr('value', 1);
				$(this).attr('style', 'background: #0962BF;');
			}

			statut = $(this).find('input').attr('value');	
			id = $(this).find('input').attr('name');

			// On lance la requête checkin
			checkin(id, statut);
				
	});


	$('input').focus(function(){
		$('body').bind('touchmove', function(e){e.preventDefault()});	
	});

	$('input').focusout(function(){
		$('body').unbind('touchmove');
	});

	$('.info-container').click(function(e){
		e.stopPropagation();
		profil = $(this).attr('id');
		infoProfil(profil);
	});


	 $('.chart').easyPieChart({
        lineWidth: '15',
        lineCap: 'butt',
        barColor: '#074d97',
        trackColor: 'rgba(0,0,0,0.2)',
        scaleColor: 'transparent',
		easing: 'easeOutBounce',
		onStep: function(from, to, percent) {
			$(this.el).find('.percent').text(Math.round(percent));
		}
	});


	function checkin(id, statut) {

		$.ajax({
			url: 'index.php',
			method: 'POST',
			data: 'statut='+statut+'&id='+id+'&action=checkin',
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


				$('.chart').data('easyPieChart').update((100*arrival) / nbInvites);
			},

			error: function(a, b, c) {
				console.log(a+ ' '+b+' '+c);
			}
		});
	}

	function infoProfil(profil) {
		console.log(profil);
		$('div[client='+profil+']').css('z-index', zindex).css('display', 'block');
		zindex++;
	}

});