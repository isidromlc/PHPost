/* MODERACION */
var mod = {
   posts: {
      view: function(pid) {
         NProgress.start();
         $.ajax({
            type: 'post',
            url: global_data.url + '/moderacion-posts.php?do=view',
            data: 'postid=' + pid,
            success: function(r) {
               mydialog.class_aux = 'preview';
               mydialog.show(true);
               mydialog.title('...');
               mydialog.body(r);
               mydialog.buttons(true, true, 'Cerrar', 'close', true, false);
               mydialog.center();
               NProgress.done();
            }
         });
      },
      ocultar: function(pid) {
         var text = $('#d_razon').val();
         if (text.length < 1) {
            mydialog.alert('Error', 'Introduzca una raz&oacute;n');
            text.focus();
            return;
         } else if (text.length > 50) {
            mydialog.alert('Error', 'La raz&oacute;n debe tener menos de 50 letras.');
            text.focus();
            return;
         } else {
            $.post(global_data.url + '/moderacion-posts.php?do=ocultar', 'razon=' + text + '&pid=' + pid, function(a) {
               mydialog.alert((a.charAt(0) == '0' ? 'Opps!' : 'Hecho'), a.substring(3), true);
               mydialog.center();
            });
         }
      },
      // BORRAR
      borrar: function(pid, redirect, aceptar) {
         if (!aceptar) {
            NProgress.start();
            $.ajax({
               type: 'POST',
               url: global_data.url + '/moderacion-posts.php?do=borrar',
               success: function(h) {
                  mydialog.show();
                  mydialog.title('Borrar Post');
                  mydialog.body(h);
                  mydialog.buttons(true, true, 'Borrar', 'mod.posts.borrar(' + pid + ", '" + redirect + "', 1);", true, false, true, 'Cancelar', 'close', true, true);
                  $('#modalBody').css('padding', '20px 10px 0');
                  mydialog.center();
                  NProgress.done();
                  return;
               }
            });
         } else {
            mydialog.procesando_inicio('Eliminando...', 'Borrar Post');
            var razon = $('#razon').val()
            var razon_desc = $('input[name=razon_desc]').val();

            if ($('#send_b').attr('checked')) {
               var send_b = 'yes';
            }
            NProgress.start();
            $.ajax({
               type: 'POST',
               url: global_data.url + '/moderacion-posts.php?do=borrar',
               data: 'postid=' + pid + '&razon=' + razon + '&razon_desc=' + razon_desc + '&send_b=' + send_b,
               success: function(h) {
                  switch (h.charAt(0)) {
                     case '0': //Error
                        mydialog.alert('Error', h.substring(3));
                        break;
                     case '1':
                        if (redirect == 'true') mod.redirect("/moderacion/posts", 1200);
                        else if (redirect == 'posts') {
                           mydialog.alert('Aviso', h.substring(3));
                           mod.redirect("/posts/", 2000);
                        } else {
                           mydialog.close();
                           $('#report_' + pid).slideUp();
                        }
                        break;
                  }
                  NProgress.done();
               },
               complete: function() {
                  mydialog.procesando_fin();
                  NProgress.done();
               }
            });
         }
      },
   },
   reboot: function(id, type, hdo, redirect) {
      NProgress.start();
      $.ajax({
         type: 'post',
         url: global_data.url + '/moderacion-' + type + '.php?do=' + hdo,
         data: 'id=' + id,
         success: function(h) {
            switch (h.charAt(0)) {
               case '0':
                  mydialog.alert("Error", h.substring(3));
                  break;
               case '1':
                  mydialog.alert("Aviso", '<div class="dialog_box">' + h.substring(3) + '</div>');
                  $('#report_' + id).fadeOut();
                  if (redirect)
                     if (redirect) mod.redirect("/moderacion/" + type, 1200);
                     else $('#report_' + id).slideUp();
                  break;
            }
            NProgress.done();
         }
      });
   },
   redirect: function(url_ref, time) {
      setTimeout(function() {
         document.location.href = global_data.url + url_ref;
      }, time)
   }
}
/* Eliminar Comentario */
function borrar_com(comid, autor, postid, gew) {
   mydialog.close();
   if (!postid) var postid = gget('postid');
   if (!gew) {
      mydialog.show();

      mydialog.title('Borrar Comentarios');

      mydialog.body('&#191;Quiere eliminar este comentario?');

      mydialog.buttons(true, true, 'S&iacute;', 'borrar_com(' + comid + ', ' + autor + ', ' + postid + ', 1)', true, false, true, 'No', 'close', true, true);

      mydialog.center();

   } else {
      NProgress.start();
      $.ajax({
         type: 'POST',
         url: global_data.url + '/comentario-borrar.php',
         data: 'comid=' + comid + '&autor=' + autor + '&postid=' + postid,
         success: function(h) {
            switch (h.charAt(0)) {
               case '0': //Error
                  mydialog.alert('Error', h.substring(3));
                  break;
               case '1':
                  var ncomments = parseInt($('#ncomments').text());
                  $('#ncomments').text(ncomments - 1);
                  //
                  $('#div_cmnt_' + comid).slideUp(1500, 'easeInOutElastic');
                  $('#div_cmnt_' + comid).slideUp('normal', function() {
                     $(this).remove();
                  });
                  NProgress.done();
                  break;
            }
         },
         error: function() {
            mydialog.error_500("borrar_com('" + comid + "')");
            NProgress.done();
         }
      });
   }
}
/* Ocultar Comentario */
function ocultar_com(comid, autor, postid) {
   mydialog.close();
   NProgress.start();
   $.ajax({
      type: 'POST',
      url: global_data.url + '/comentario-ocultar.php',
      data: 'comid=' + comid + '&autor=' + autor + '&post_id=' + postid + gget('postid'),
      success: function(h) {
         switch (h.charAt(0)) {
            case '0': //Error
               mydialog.alert('Error', h.substring(3));
               break;
            case '1':
               $('#comentario_' + comid).css('opacity', 1);
               $('#pp_' + comid).css('opacity', 0.5);
               break;
            case '2':
               $('#comentario_' + comid).css('opacity', 0.5);
               $('#pp_' + comid).css('opacity', 1);
               break;
         }
         NProgress.done();
      },
      error: function() {
         mydialog.error_500("borrar_com('" + comid + "')");
      }
   });
}
/* Borrar Post */
function borrar_post(aceptar) {
   if (!aceptar) {
      mydialog.show();
      mydialog.title('Borrar Post');
      mydialog.body('&iquest;Seguro que deseas borrar este post?');
      mydialog.buttons(true, true, 'SI', 'borrar_post(1)', true, false, true, 'NO', 'close', true, true);
      mydialog.center();
      return;
   } else if (aceptar == 1) {
      mydialog.show();
      mydialog.title('Borrar Post');
      mydialog.body('Te pregunto de nuevo... &iquest;Seguro que deseas borrar este post?');
      mydialog.buttons(true, true, 'SI', 'borrar_post(2)', true, false, true, 'NO', 'close', true, true);
      mydialog.center();
      return;
   }
   mydialog.procesando_inicio('Eliminando...', 'Borrar Post');
   NProgress.start();
   $.ajax({
      type: 'POST',
      url: global_data.url + '/posts-borrar.php',
      data: gget('postid', true),
      success: function(h) {
         switch (h.charAt(0)) {
            case '0': //Error
               mydialog.alert('Error', h.substring(3));
               break;
            case '1':
               mydialog.alert('Post Borrado', h.substring(3), true);
               break;
         }
         NProgress.done();
      },
      error: function() {
         mydialog.error_500("borrar_post(2)");
         NProgress.done();
      },
      complete: function() {
         mydialog.procesando_fin();
         NProgress.done();
      }
   });
}

/* Votar post */
var votar_post_votado = false;

function show_votar_post(force_hide) {
   if (votar_post_votado)
      return;
   if (!force_hide && $('.post-metadata .dar_puntos').css('display') == 'none')
      $('.post-metadata .dar_puntos').show();
   else
      $('.post-metadata .dar_puntos').hide();
}

function votar_post(puntos) {
   if (votar_post_votado)
      return;
   if (puntos == null || isNaN(puntos) != false || puntos < 1) {
      mydialog.alert('Error', 'Debe introducir n&uacute;meros');
      return false;
   }
   votar_post_votado = true;
   NProgress.start();
   $.ajax({
      type: 'POST',
      url: global_data.url + '/posts-votar.php',
      data: 'puntos=' + puntos + gget('postid'),
      success: function(h) {
         show_votar_post(true);
         $('.dar-puntos').slideUp();
         switch (h.charAt(0)) {
            case '0': //Error
               $('.post-metadata .mensajes').addClass('error').html(h.substring(3)).slideDown();
               break;
            case '1': //OK
               $('.post-metadata .mensajes').addClass('ok').html(h.substring(3)).slideDown();
               $('#puntos_post').html(number_format(parseInt($('#puntos_post').html().replace(".", "")) + parseInt(puntos), 0, ',', '.'));
               break;
         }
         NProgress.done();
      },
      error: function() {
         votar_post_votado = false;
         mydialog.error_500("votar_post('" + puntos + "')");
         NProgress.done();
      }
   });
}

/* Agregar post a favoritos */
var add_favoritos_agregado = false;

function add_favoritos() {
   if (add_favoritos_agregado)
      return;
   if (!gget('key')) {
      mydialog.alert('Login', 'Tienes que estar logueado para realizar esta operaci&oacute;n');
      return;
   }
   add_favoritos_agregado = true;
   NProgress.start();
   $.ajax({
      type: 'POST',
      url: global_data.url + '/favoritos-agregar.php',
      data: gget('postid', true),
      success: function(h) {
         switch (h.charAt(0)) {
            case '0': //Error
               $('.post-metadata .mensajes').addClass('error').html(h.substring(3)).slideDown();
               break;
            case '1': //OK
               $('.post-metadata .mensajes').addClass('ok').html(h.substring(3)).slideDown();
               $('.favoritos_post').html(number_format(parseInt($('.favoritos_post').html().replace(".", "")) + 1, 0, ',', '.'));
               break;
         }
         NProgress.done();
      },
      error: function() {
         add_favoritos_agregado = false;
         mydialog.error_500("add_favoritos()");
         $('#loading').fadeOut(250);
      }
   });
}

//Imprimir editores
function print_editor() {
   //Editor de posts comentarios
   if ($('#body_comm').length && !$('.wysibb-texarea').length) {
      var wbbOpt = {
         buttons: "smilebox,|,bold,italic,underline,strike,sup,sub,|,img,video,link"
      }
      $('#body_comm').removeAttr('onblur onfocus class style title').css('height', '80').html('').wysibb(wbbOpt);
   }
}
print_editor();
/* extras */
function emoticones() {
   var winpops = window.open(global_data.url + "/emoticones.php", "", "width=180px,height=500px,scrollbars,resizable");
}
/* COMENTARIOS */
var comentario = {
      /* VARIABLES */
      cache: {},
      cargado: false,
      /* FUNCIONES */
      cargar: function(postid, page, autor) {
         // GIF
         $('#com_gif').show();
         //$.scrollTo('#comentarios-container', 250);
         $('div#comentarios').css('opacity', 0.4)
            // COMPRVAMOS CACHE
         if (typeof comentario.cache['c_' + page] == 'undefined') {
            NProgress.start();
            $.ajax({
               type: 'POST',
               url: global_data.url + '/comentario-ajax.php?page=' + page,
               data: 'postid=' + postid + '&autor=' + autor,
               success: function(h) {
                  // CACHE
                  comentario.cache['c_' + page] = h;
                  // CARGAMOS
                  $('#comentarios').html(h);
                  // PAGINAS
                  comentario.set_pages(postid, page, autor);
                  //
                  NProgress.done();
               }
            });
         } else {
            $('#comentarios').html(comentario.cache['c_' + page]);
            $('.paginadorCom').html(comentario.cache['p_' + page]);
            $('#com_gif').hide();
            $('div#comentarios').css('opacity', 1);
         }
      },
      set_pages: function(postid, page, autor) {
         var total = parseInt($('#ncomments').text());
         //
         NProgress.start();
         $.ajax({
            type: 'POST',
            url: global_data.url + '/comentario-pages.php?page=' + page,
            data: 'postid=' + postid + '&autor=' + autor + '&total=' + total,
            success: function(h) {
               comentario.cache['p_' + page] = h;
               $('.paginadorCom').html(h);
               $('#com_gif').hide();
               $('div#comentarios').css('opacity', 1);
               NProgress.done();
            }
         });
      },
      // NUEVO COMENTARIO
      nuevo: function(mostrar_resp, comentarionum) {
         // EVITAR FLOOD
         $('#btnsComment').attr({
            'disabled': 'disabled'
         });
         //
         var textarea = $('#body_comm');
         var text = textarea.bbcode();
         // VACIO o DEFAULT
         if (text == '' || text == textarea.attr('title')) {
            textarea.focus();
            $('#btnsComment').removeAttr('disabled');
            return;
         } else if (text.length > 1500) {
            alert("Tu comentario no puede ser mayor a 1500 caracteres.");
            textarea.focus();
            $('#btnsComment').removeAttr('disabled');
            return;
         }
         // IMAGEN
         $('.miComentario #gif_cargando').show();
         var auser = $('#auser_post').val();
         NProgress.start();
         $.ajax({
            type: 'POST',
            url: global_data.url + '/comentario-agregar.php',
            data: 'comentario=' + encodeURIComponent(text) + '&postid=' + gget('postid') + '&mostrar_resp=' + mostrar_resp + '&auser=' + auser,
            success: function(h) {
               switch (h.charAt(0)) {
                  case '0': //Error
                     $('.miComentario .error').html(h.substring(3)).show('slow');
                     $('#btnsComment').removeAttr('disabled');
                     break;
                  case '1': //OK
                     $("#nuevos").slideUp(1);
                     $('#preview').remove();
                     /*textarea.attr('title', 'Escribir un comentario...').val('');
                     onblur_input(textarea);*/
                     $('#nuevos').html(h.substring(3)).slideDown('slow', function() {
                        $('#no-comments').hide('slow');
                        $('.miComentario').html('<div class="emptyData">Tu comentario fue agregado correctamente :)</div>');
                     });
                     // SUMAMOS
                     var ncomments = parseInt($('#ncomments').text());
                     $('#ncomments').text(ncomments + 1);
                     //$('#btnsComment').removeAttr('disabled');
                     // POR SI HABIA ERROR
                     //$('.miComentario .error').html('');
                     break;
               }
               NProgress.done();
               //
               $('.miComentario #gif_cargando').hide();
               mydialog.close();
            }
         });
      },
      // VISTA PREVIA DEL COMENTARIO
      preview: function(id, type) {
         var textarea = (type == 'new') ? $('#' + id) : $('#edit-comment-' + id);
         var btn_text = (type == 'new') ? textarea.bbcode() : textarea.val();
         var btn_text = (type == 'new') ? 'Enviar comentario' : 'Guardar';
         var btn_fn = (type == 'new') ? "comentario.nuevo('true')" : 'comentario.editar(' + id + ', \'send\')';

         if (text == '' || text == textarea.attr('title')) {
            textarea.focus();
            return;
         } else if (text.length > 1500) {
            alert("Tu comentario no puede ser mayor a 1500 caracteres.");
            textarea.focus();
            return;
         }
         var auser = $('#auser_post').val();

         $('.miComentario #gif_cargando').show();
         //
         mydialog.class_aux = 'preview';
         mydialog.show(true);
         mydialog.title('...');
         mydialog.body('Cargando vista previa....<br><br><img src="' + global_data.url + '/themes/default/images/loading_bar.gif">');
         mydialog.center();
         //
         NProgress.start();
         $.ajax({
            type: 'POST',
            url: global_data.url + '/comentario-preview.php?type=' + type,
            data: 'comentario=' + encodeURIComponent(text) + '&auser=' + auser,
            success: function(h) {
               switch (h.charAt(0)) {
                  case '0': //Error
                     if (type == 'new') $('.miComentario .error').html(h.substring(3)).show('slow');
                     else {
                        $('#edit-error-' + id).css('color', 'red').html(h.substring(3));
                        mydialog.close();
                     }
                     $('.miComentario #gif_cargando').hide();
                     break;
                  case '1': //OK
                     //
                     mydialog.body(h.substring(3));
                     mydialog.buttons(true, true, btn_text, btn_fn, true, true, true, 'Cancelar', 'close', true, false);
                     mydialog.center();
                     //
                     //$('#preview').html(h.substring(3)).slideDown("slow");
                     $('.miComentario #gif_cargando').hide();
                     $('.miComentario .error').html('');
                     break;
               }
               NProgress.done();
               // DOBLE CENTER XQ SI NO, NO SE CENTRA :S
               mydialog.center();
            }
         });
      },
      // VOTAR COMENTARIO
      votar: function(cid, voto) {
         var voto_tag = $('#votos_total_' + cid)
         var total_votos = parseInt(voto_tag.text());
         total_votos = (isNaN(total_votos)) ? 0 : total_votos;
         // FIX
         voto = (voto == 1) ? 1 : -1;
         //
         NProgress.start();
         $.ajax({
            type: 'POST',
            url: global_data.url + '/comentario-votar.php',
            data: 'voto=' + voto + '&cid=' + cid + '&postid=' + gget('postid'),
            success: function(h) {
               switch (h.charAt(0)) {
                  case '0': //Error
                     mydialog.alert("Error al votar", h.substring(3));
                     break;
                  case '1': //OK
                     total_votos = total_votos + voto;
                     if (total_votos > 0) total_votos = '+' + total_votos; // PONEMOS EL SIGNO + POR ESTETICA :P
                     var klass = (total_votos < 0) ? 'negativo' : 'positivo'; // CLASS
                     // MOSTRAMOS SI NO ES VISIBLE Y AGREGAMOS LA NUEVA CLASS
                     $('#ul_cmt_' + cid + ' > .numbersvotes').show();
                     voto_tag.text(total_votos).removeClass('positivo, negativo').addClass(klass);
                     // ESCONDEMOS LAS MANITAS xd
                     $('#ul_cmt_' + cid).find('.icon-thumb-up, .icon-thumb-down').hide();
                     break;
               }
               NProgress.done();
            }
         });
      },
      // CITAR
      citar: function(id, nick) {
         var textarea = $('#body_comm');
         textarea.focus();
         textarea.val(((textarea.val() != '') ? textarea.val() + '\n' : '') + '[quote=' + nick + ']' + htmlspecialchars_decode($('#citar_comm_' + id).html(), 'ENT_NOQUOTES') + '[/quote]\n');
      },
      // EDITAR
      editar: function(id, step) {
         switch (step) {
            case 'show':
               var bbcode = htmlspecialchars_decode($('#citar_comm_' + id).html(), 'ENT_NOQUOTES');
               var html = '<textarea id="edit-comment-' + id + '" class="textarea-edit autogrow" title="Escribir un comentario..." onfocus="onfocus_input(this)" onblur="onblur_input(this)">' + bbcode + '</textarea><br/><input type="button" class="mBtn btnGreen btnEdit" onclick="comentario.preview(\'' + id + '\', \'edit\')" value="Continuar &raquo;"/> <strong id="edit-error-' + id + '"></strong>';
               $('#comment-body-' + id).html(html);
               $('#edit-comment-' + id).css('max-height', '300px');
               break;
            case 'send':
               var cid = $('#edit-cid-' + id).val()
               var comment = $('#edit-comment-' + id).val();
               NProgress.start();
               $.ajax({
                  type: 'POST',
                  url: global_data.url + '/comentario-editar.php',
                  data: 'comentario=' + encodeURIComponent(comment) + '&cid=' + id,
                  success: function(h) {
                     switch (h.charAt(0)) {
                        case '0': //Error
                           $('#edit-error-' + id).css('color', 'red').html(h.substring(3));
                           break;
                        case '1': //OK
                           $('#comment-body-' + id).html($('#new-com-html').html());
                           var bbcode = htmlspecialchars_decode($('#new-com-bbcode').html(), 'ENT_NOQUOTES');
                           $('#citar_comm_' + id).html(bbcode)
                           break;
                     }
                     NProgress.done();
                     //
                     mydialog.close();
                  }
               });

               break;
         }
      }
   }
   /* BBCode */
function spoiler(obj) {
   $(obj).toggleClass('show').parent().next().slideToggle();
}
/* EMOTICONOS */
function moreEmoticons(margin) {
   var emos = $('#emoticons');
   //
   NProgress.start();
   $.ajax({
      type: 'GET',
      url: global_data.url + '/emoticones.php',
      data: 'ts=false',
      success: function(h) {
         if (margin) $(emos).css({
            marginTop: '1em'
         })
         $(emos).append(h);
         $('#moreemofn').hide();
         NProgress.done();
      }
   });
}