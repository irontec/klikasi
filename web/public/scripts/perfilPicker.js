/********************************
		Perfil picker
		author : Igor Nieto Garrote
********************************/

var perfilPicker =
{
	init: function()
	{
		$('.perfil-picker').each(function(){
			var $perfiles = $(this).find('span');
			$(this).on('click','span',function(){
				$perfiles.removeClass('selected');
				$(this).addClass('selected');
			});
		});
	}
}

$(document).ready(function(){
	perfilPicker.init();
});