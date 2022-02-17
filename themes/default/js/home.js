/**
 * Actualizar comentarios
*/
function actualizar_comentarios(cat, nov){
   $('#loading').fadeIn(250);
	$.ajax({
		type: 'GET',
		url: global_data.url + '/posts-last-comentarios.php',
		data: ['cat=' + cat, 'nov=' + nov].join('&'),
		beforeSend: () => $('#ult_comm').html('<div class="emptyData">Esperando...</div>'),
		success: h => $('#ult_comm').html(h),
		error: () => {
			$('#ult_comm, #ult_comm > ol:first').slideDown({duration: 1000, easing: 'easeOutBounce'});
         $('#loading').fadeOut(350);
		}
	});
	$('#loading').fadeOut(350);
}
/**
 * Tabs de los tops
*/
function TopsTabs(parent, tab) {
	if($('.box_cuerpo ol.filterBy#filterBy'+tab).css('display') == 'block') return;
	$('#'+parent+' > .box_cuerpo div.filterBy a').removeClass('here');
	$('.box_cuerpo div.filterBy a#'+tab).addClass('here');
	$('#'+parent+' > .box_cuerpo ol').fadeOut();
	$('#'+parent+' > .box_cuerpo ol#filterBy'+tab).fadeIn();
}