function actualizar_comentarios(cat, nov) {
   NProgress.start();
   $('#ult_comm, #ult_comm > ol').slideUp(150);
   $.ajax({
      type: 'GET',
      url: global_data.url + '/posts-last-comentarios.php',
      cache: false,
      data: 'cat=' + cat + '&nov=' + nov,
      success: function(h) {
         $('#ult_comm').html(h);
         $('#ult_comm > ol').hide();
         $('#ult_comm, #ult_comm > ol:first').slideDown(1500);
         NProgress.done();
      },
      error: function() {
         $('#ult_comm, #ult_comm > ol:first').slideDown(1000);
         NProgress.done();
      }
   });
}
function TopsTabs(parent, tab) {
	if($('.box_cuerpo ol.filterBy#filterBy'+tab).css('display') == 'block') return;
	$('#'+parent+' > .box_cuerpo div.filterBy a').removeClass('here');
	$('.box_cuerpo div.filterBy a#'+tab).addClass('here');
	$('#'+parent+' > .box_cuerpo ol').fadeOut();
	$('#'+parent+' > .box_cuerpo ol#filterBy'+tab).fadeIn();
}
