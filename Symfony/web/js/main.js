
$(document).ready(function(){


	bind_buttons_add_panier();

});


function bind_buttons_add_panier () {
	var $btns = $(".btn-ajoute-panier");

	$btns.each( function () {

		var $this = $(this);

		$this.on('click', function(){


			var $input = $(this).parent().parent().find('.input-add-value');
			var quantitee = $input.val();
			var id = $input.attr('id-plat');


			

			console.log (quantitee);
			console.log(id);

			var request = $.ajax({

				url: 'http://pussypatrol.tk/app.php/ajouteArticle/'+id+'/'+quantitee+'',

			});

			request.done(function(){
				location.reload();
			});

			
		});




	});
}