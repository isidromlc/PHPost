/*
    PERFIL
*/
var perfil = {
    cache: {},
    load_tab:function(type, obj){
        // CSS
        $('#tabs_menu > li').removeClass('selected');
        $(obj).parent().addClass('selected');
        //
        $('#perfil_content > div').fadeOut();
        $('#perfil_load').fadeIn();
        // CARGAMOS
        perfil.cargar(type);
    },
    // CARGAR CONTENIDO
    cargar: function(type){
        //
        var status = $('#perfil_' + type).attr('status');
        if(status == 'activo') {
            // LOADER/ STATUS
            $('#perfil_load').hide();
            $('#perfil_' + type).fadeIn();
            return true;   
        }
        //
        $('#loading').slideDown(250); 
        $.ajax({
        	type: 'POST',
        	url: global_data.url + '/perfil-' + type + '.php',
        	data: 'pid=' + $('#info').attr('pid'),
        	success: function(h){
        		switch(h.charAt(0)){
        			case '0': //Error
                        mydialog.alert('Error', h.substring(3));
        				break;
        			case '1': //OK
                        if(typeof perfil.cache[type] == 'undefined'){
                            $('#perfil_content').append(h.substring(3));
                            $('#perfil_' + type).fadeIn();
                            perfil.cache[type] = true;
                        }
        				break;
        		}
                // LOADER/ STATUS
                $('#perfil_load').hide();
                $('#loading').slideUp(350); 
        	}
        });
    },
    // CARGAR PAGINAS DE LOS SEGUIDORES!
    follows:function(type, page){
        $.ajax({
        	type: 'POST',
        	url: global_data.url + '/perfil-' + type + '.php?hide=true&page=' + page,
        	data: 'pid=' + $('#info').attr('pid'),
        	success: function(h){
                $('#perfil_' + type).html(h.substring(3));
        	}
        });
    }
}
/** ACTIVIDAD **/
var actividad = {
    total: 25,
    show: 25,
    cargar: function(id, ac_do, ac_type){
        // ELIMINAR
        $('#last-activity-view-more').remove();
        if(ac_do == 'filtrar') actividad.total = 0;
        // ENVIAMOS
        $.ajax({
        	type: 'POST',
        	url: global_data.url + '/perfil-actividad.php',
        	data: 'pid=' + $('#info').attr('pid') + '&ac_type=' + ac_type + '&do=' + ac_do + '&start=' + actividad.total,
        	success: function(h){
        		switch(h.charAt(0)){
        			case '0': //Error
                        mydialog.alert('Error', h.substring(3));
        				break;
        			case '1': //OK
                            if(ac_do == 'more')
                                $('#last-activity-container').append(h.substring(3));
                            else 
                                $('#last-activity-container').html(h.substring(3));
                            // TOTALES
                            var total_pubs = $('#total_acts').attr('val');
                            actividad.total = actividad.total + parseInt(total_pubs);
                            $('#total_acts').remove();
        				break;
        		}
        	}
        });
    },
    borrar: function(id, obj){
        // ENVIAMOS
        $.ajax({
        	type: 'POST',
        	url: global_data.url + '/perfil-actividad.php',
        	data: 'pid=' + $('#info').attr('pid') + '&acid=' + id + '&do=borrar',
        	success: function(h){
        		switch(h.charAt(0)){
        			case '0': //Error
                        mydialog.alert('Error', h.substring(3));
        				break;
        			case '1': //OK
                        $(obj).parent().parent().parent().remove();
        				break;
        		}
        	}
        });
    }
}
/** MURO **/
var muro = {
    maxWidth: 463, // WIDTH PARA LAS FOTOS Y VIDEOS
    stream: {
        total: 0, // TOTAL DE PUBLICACIONES CARGADAS
        show: 10, // CUANTOS SE MUESTRAN POR CADA CARGA
        type: 'status', // TIPO D PUBLICACION ACTUAL
        status: 0, // PARA EVITAR CLICKS INESESARIOS
        adjunto: '', // SE HA CARGADO UN ARCHIVO ADJUNTO?
        // CARGAR EL TIPO DE PUBLICACION :
        load: function(aid, obj){
            // ACTUAL
            muro.stream.type = aid;
            //
            var atxt = (muro.stream.type == 'foto') ? 'a' : 'e';
            atxt = 'Haz un comentario sobre est' + atxt + ' ' + muro.stream.type + '...';
            //
            if(aid != 'status') {
                $('.btnStatus').hide();
                $('.attaDesc').show();
                //
                $('#attaDesc').attr('title', atxt).val(atxt);
            } else {
                $('.btnStatus').show();
                $('.attaDesc').hide();
                $('.frameForm').css('border-bottom', '1px solid #E9E9E9');
            }
            //
            $('span.uiComposer .nub, span.uiComposer span').hide();
            $('span.uiComposer a').show();
            $(obj).hide().parent().find('span, i').show();
            // 
            $('#attaContent > div').hide();
            $('#' + aid + 'Frame').show(); 
            // 
            return false;
        },
        // ADJUNTAR ARCHIVO EXTERNO : FOTO, ENLACE, VIDEO DE YOUTBE
        adjuntar: function(){
            // SI ESTA OCUPADO NO HACEMOS NADA
            if(muro.stream.status == 1) return false;
            else muro.stream.status = 1;
            // LOADER
            muro.stream.loader(true);
            // FUNCION
            var inpt = $('input[name=i' + muro.stream.type + ']');
            inpt.attr('disabled', 'true');
            var valid = muro.stream.validar(inpt);
            if(valid == true){
                // ADJUNTAMOS...
                muro.stream.ajaxCheck(inpt.val(), inpt);
            } else {
                mydialog.alert('Error al publicar', valid);
                // LOADER / DISABLED / STATUS
                muro.stream.loader(false);
                inpt.attr('disabled', '');
                muro.stream.status = 0;
            }
        },
        // VERIFICAR ARCHIVO
        ajaxCheck: function(url, inpt){
            $('#loading').fadeIn(250); 
            $.ajax({
            	type: 'POST',
            	url: global_data.url + '/muro-stream.php?do=check&type=' + muro.stream.type,
            	data: 'url=' + encodeURIComponent(url),
            	success: function(h){
            		switch(h.charAt(0)){
            			case '0': //Error
                            mydialog.alert('Error al publicar', h.substring(3));
                            inpt.attr('disabled', '');
            				break;
            			case '1': //OK
                            muro.stream.adjunto = inpt.val();
                            $('#' + muro.stream.type + 'Frame').html(h.substring(3));
            				break;
            		}
                    $('#loading').fadeOut(350); 
            	},
                complete: function (){
                    // LOADER/ STATUS
                    muro.stream.loader(false);
                    muro.stream.status = 0;
                    $('#loading').fadeOut(350); 
                }
            });
        },
        // VALIDAR LAS URL DE LOS ARCHIVOS ADJUNTOS
        validar: function(inpt){
            var val = inpt.val();
            var regex = /^(ht|f)tps?:\/\/\w+([\.\-\w]+)?\.([a-z]{2,3}|info|mobi|aero|asia|name)(:\d{2,5})?(\/)?((\/).+)?$/i;
            //
            if(val == '' || val == inpt.attr('title') || regex.test(val) == false) return 'Debes ingresar una direcci&oacute;n URL v&aacute;lida.';
            else {
                switch(muro.stream.type){
                    case 'foto':
                        inpt.val(val.replace(' ', ''));
                        var ext = inpt.val().substr(-3);
                        if(ext != 'gif' && ext != 'png' && ext != 'jpg') return 'S&oacute;lo se permiten im&aacute;genes .gif, .png y .jpg';
                    break;
                    case 'video':
                        var video_id = val.split('watch?v=');
                        // NO ES VALIDO : DE MOMENTO
                        if(!video_id[1]) return 'Al parecer la url del video no es v&aacute;lida. Recuerda que solo puedes compartir videos de YouTube.';
                    break;
                }
                //
                return true;
            }
        },
        // COMPARTIR
        compartir: function(){
            // SI ESTA OCUPADO NO HACEMOS NADA
            if(muro.stream.status == 1) return false;
            else muro.stream.status = 1;
            // LOADER
            muro.stream.loader(true);
            // 
            var error_length = 'Las publicaciones de estado y/o comentarios deben ser inferiores a 420 caracteres. Ya has ingresado ';
            // ARCHIVOS ADJUNTOS
            if(muro.stream.type != 'status'){
                if(muro.stream.adjunto != ''){
                    var val = $('#attaDesc').val();
                    // VALIDAR
                    if(val.length > 420) {
                        mydialog.alert('Error al publicar', error_length + val.length + ' caracteres.');
                        // LOADER/ STATUS
                        muro.stream.loader(false);
                        muro.stream.status = 0;
                    }
                    // ENVIAMOS PUBLICACION
                    else {
                        val = (val == $('#attaDesc').attr('title')) ? '' : val;
                        muro.stream.ajaxPost(val);
                    }
                    
                } else {
                    mydialog.alert('Error al publicar', 'Ingresa la <b>URL</b> en el campo de texto y a continuaci&oacute;n da clic en <b>Adjuntar</b>.');
                    // LOADER/ STATUS
                    muro.stream.loader(false);
                    muro.stream.status = 0;
                }
            // PUBLICACION SIMPLE
            } else if(muro.stream.type == 'status'){
                var status = $('#wall');
                var val = status.val();
                var error = false;
                // VALIDAR
                if(val == '' || val == status.attr('title')) {
                    status.blur(); 
                    error = true;
                    // LOADER/ STATUS
                    muro.stream.loader(false);
                    muro.stream.status = 0; 
                    return false;
                }
                else if(val.length > 420) error = error_length + val.length + ' caracteres.';
                // ENVIAR PUBLICACION
                if(error == false){
                    muro.stream.ajaxPost(val);
                } else {
                    mydialog.alert('Error al publicar', error);
                    // LOADER/ STATUS
                    muro.stream.loader(false);
                    muro.stream.status = 0;
                }
            }
        },
        // POSTEAR EN EL MURO
        ajaxPost: function(data){
            $('#loading').slideDown(250); 
            $.ajax({
            	type: 'POST',
            	url: global_data.url + '/muro-stream.php?do=post&type=' + muro.stream.type,
            	data: 'adj=' + muro.stream.adjunto +'&data=' + encodeURIComponent(data) + '&pid=' + $('#info').attr('pid'),
            	success: function(h){
            		switch(h.charAt(0)){
            			case '0': //Error
                            mydialog.alert('Error al publicar', h.substring(3));
            				break;
            			case '1': //OK
                            // ESCONDEMOS SI ES EL PRIMER COMENTARIO
                            if($('#wall-content .emptyData')) $('#wall-content .emptyData').hide();
                            //
							$('#wall-content, #news-content').prepend($(h.substring(3)).fadeIn('slow'));
                            $('#wall').val('').focus();
                            muro.stream.load('status',$('#stMain'));
            				break;
            		}
                    $('#loading').slideUp(350); 
            	},
                complete: function (){
                    // LOADER/ STATUS
                    muro.stream.loader(false);
                    muro.stream.status = 0;
                    $('#loading').fadeOut(350); 
                }
            });
        },
        loadMore: function(type){
            // SI ESTA OCUPADO NO HACEMOS NADA
            if(muro.stream.status == 1) return false;
            else muro.stream.status = 1;
            // LOADER
            $('.more-pubs a').hide();
            $('.more-pubs span').css('display','block');
            // CARGAMOS
            $('#loading').fadeIn(250); 
            $.ajax({
            	type: 'POST',
            	url: global_data.url + '/muro-stream.php?do=more&type=' + type,
            	data: 'pid=' + $('#info').attr('pid') + '&start=' + muro.stream.total,
            	success: function(h){
            		switch(h.charAt(0)){
            			case '0': //Error
                            mydialog.alert('Error al cargar', h.substring(3));
            				break;
            			case '1': //OK
                            // CARGAMOS AL DOM
                            $('#' + type + '-content').append(h.substring(3));
                            // VALIDAMOS
                            var total_pubs = $('#total_pubs').attr('val');
                            total_pubs = parseInt(total_pubs);
                            // 
                            var msg = (type == 'news' && total_pubs < 0) ? 'Solo puedes ver las &uacute;ltimas 100 publicaciones.' : 'No hay m&aacute;s mensajes para mostrar.'; 
                            if(total_pubs == 0 || total_pubs < muro.stream.show) $('.more-pubs').html(msg).css('padding','10px');
                            else muro.stream.total = muro.stream.total + parseInt(total_pubs);
                            // REMOVER
                            $('#total_pubs').remove();
            				break;
            		}
                    $('#loading').fadeOut(250); 
            	},
                complete: function (){
                    $('.more-pubs a').show();
                    $('.more-pubs span').hide();
                    muro.stream.status = 0;
                    $('#loading').fadeOut(450); 
                }
            });
        },
        // LOADER
        loader: function(active){
            if(active == true) $('.streamLoader').show();
            else if(active == false) $('.streamLoader').hide();
        }
    },
    // LIKE
    like_this: function(id, type, obj){
        muro.stream.status = 1;
        // MANDAMOS
        $('#loading').slideDown(250); 
        $.ajax({
        	type: 'POST',
        	url: global_data.url + '/muro-likes.php',
            dataType: 'json',
        	data: 'id=' + id + '&type=' + type,
        	success: function(h){
        	   if(h['status'] == 'ok'){
        	       // I LIKE / NO
        	       $(obj).text(h['link']);
                   //
        	       if(type == 'pub'){
        	           $('#lk_' + id).html(h['text']);
                       if(h['text'] != '') {
                           $('#lk_' + id).parent().parent().show();
                           $('#cb_' + id).show();
                       } else 
                           $('#lk_' + id).parent().parent().hide();
        	       } else {
        	           $('#lk_cm_'+id).text(h['text']);
                       //
        	           if(h['text'] == '') 
                            $('#lk_cm_'+id).parent().hide();
                        else 
                            $('#lk_cm_'+id).parent().show();
                            
        	       }
        	   } else {
        	       mydialog.alert('Error:', h['text'].substring(3));
        	   }
               $('#loading').slideUp(350); 
        	},
            complete: function (){
                // STATUS
                muro.stream.status = 0;
            }
        });
    },
    show_likes: function(id, type){
        muro.stream.status = 1;
        // MANDAMOS
        $('#loading').fadeIn(250); 
        $.ajax({
        	type: 'POST',
        	url: global_data.url + '/muro-likes.php?do=show',
            dataType: 'json',
        	data: 'id=' + id + '&type=' + type,
        	success: function(h){
        		switch(h.status){
        			case 0: //Error
                        mydialog.alert('Error', h['data']);
        				break;
        			case 1: //OK
                        var html = '<ul id="show_likes">';
                        for(var i = 0; i < h.data.length; i++){
                            html += '<li>'
                            html += '<a href="' + global_data.url + '/perfil/' + h.data[i].user_name + '"><img src="' + global_data.url + '/files/avatar/' + h.data[i].user_id + '_50.jpg" /></a>'
                            html += '<div class="name"><a href="' + global_data.url + '/perfil/' + h.data[i].user_name + '">' + h.data[i].user_name + '</a></div>' 
                            html += '</li>'; 
                        }
                        html += '</ul>';
                        // MOSTRAMOS
                		mydialog.show(true);
                		mydialog.title('Personas a las que les gusta');
                		mydialog.body(html);
                        mydialog.buttons(true, true, 'Cerrar', 'close', true, true);
                        mydialog.center();
        				break;
        		}
                $('#loading').fadeOut(350); 
        	},
            complete: function (){
                // STATUS
                muro.stream.status = 0;
            }
        });
   
    },
    show_comment_box: function(id){
        $('#cb_' + id).slideDown()  
    },
    comentar: function(id){
        var val = $('#cf_' + id).val();
        muro.stream.status = 1;
        if(val == '' || val == $('#cf_' + id).attr('title')) {
            $('#cf_' + id).focus(); 
            // LOADER/ STATUS
            muro.stream.loader(false);
            muro.stream.status = 0; 
            return false;
        }
        //
        $('#loading').fadeIn(250); 
        $.ajax({
        	type: 'POST',
        	url: global_data.url + '/muro-stream.php?do=repost',
        	data: 'data=' + encodeURIComponent(val) + '&pid=' + id,
        	success: function(h){
        		switch(h.charAt(0)){
        			case '0': //Error
                        mydialog.alert('Error:', h.substring(3));
        				break;
        			case '1': //OK
						$('#cl_' + id).append($(h.substring(3)).fadeIn('slow'));
                        $('#cf_' + id).val('');
        				break;
        		}
                $('#loading').fadeOut(250); 
        	},
            complete: function (){
                // STATUS
                muro.stream.status = 0;
                $('#loading').fadeOut(350); 
            }
        });
    },
    //
    more_comments: function(id, obj){
        // LOADER / STATUS
        muro.stream.status = 1;
        $(obj).parent().find('img').show();
        //
        $('#loading').fadeIn(250); 
        $.ajax({
        	type: 'POST',
        	url: global_data.url + '/muro-stream.php?do=more_comments',
        	data: 'pid=' + id,
        	success: function(h){
        		switch(h.charAt(0)){
        			case '0': //Error
                        mydialog.alert('Error:', h.substring(3));
        				break;
        			case '1': //OK
                        $('#cl_' + id).html(h.substring(3));
        				break;
        		}
                $('#loading').fadeOut(350); 
        	},
            complete: function (){
                // STATUS
                muro.stream.status = 0;
                $('#loading').fadeOut(550); 
            }
        });
    },
    // MOSTRAR VIDEO DEL MURO
    load_atta: function(type, ID, obj){
        switch(type){
            case 'foto':
                var content = '<center><img src="' + ID + '" style="max-width:' + this.maxWidth + 'px; max-height: 380px" /><center>'; //bzox
            break;
            case 'video':
                var content = '<embed width="' + this.maxWidth + '" height="285" flashvars="width=' + this.maxWidth + '&amp;height=285" wmode="opaque" salign="tl" allowscriptaccess="never" allowfullscreen="false" scale="scale" quality="high" bgcolor="#FFFFFF" src="http://www.youtube.com/v/' + ID +'&amp;autoplay=1" type="application/x-shockwave-flash">';
            break;
        }
        // CARGAMOS
        $(obj).parent().html(content);
    },
    // ELIMINAR PUBLICACION / COMENTARIO
    del_pub: function(id, type){
        var txt_type = (type == 1) ? 'publicaci&oacute;n' : 'comentario';
        var txt_aux = (type == 1) ? 'esta ' : 'este ';
        //
        mydialog.mask_close = false;
        mydialog.show(true);
		mydialog.title('Eliminar ' + txt_type);
		mydialog.body('¿Seguro que quieres eliminar ' + txt_aux + txt_type);
		mydialog.buttons(true, true, 'Eliminar ' + txt_type, 'muro.eliminar(' + id + ', ' + type + ')', true, true, true, 'Cancelar', 'close', true, false);
		mydialog.center();
    },
    // ELIMINAR PUBLICACION / COMENTARIO
    eliminar: function(id, type){
        // LOADER / STATUS
        muro.stream.status = 1;
        var snd_type = (type == 1) ? 'pub' : 'cmt';
        //
        $('#loading').slideDown(250); 
        $.ajax({
        	type: 'POST',
        	url: global_data.url + '/muro-stream.php?do=delete',
        	data: 'id=' + id + '&type=' + snd_type,
        	success: function(h){
        		switch(h.charAt(0)){
        			case '0': //Error
                        mydialog.alert('Error:', h.substring(3));
        				break;
        			case '1': //OK
                        mydialog.close();
                        $('#' + snd_type + '_' + id).hide().remove();
        				break;
        		}
                $('#loading').slideUp(450); 
        	},
            complete: function (){
                // STATUS
                muro.stream.status = 0;
                $('#loading').slideUp(350); 
            }
        });
    }
    //
}
/** READY **/
$(function(){
    // POR ESTETICA...
    setTimeout("$('#wall, #attaDesc').blur().css('height', '14px')",0);
    setTimeout("$('#attaContent input').blur().css('height', '14px')",0);
    // WALL
    $('#wall').focus(function(){
        $('.btnStatus').show();
        $('.frameForm').css('border-bottom', '1px solid #E9E9E9');
    });
    // ENVIAR PUBLICACION
    $('textarea[name=add_wall_comment]').on("keypress",function(k){
        if(k.which == 13){
            var pub_id = $(this).attr('pid');
            muro.comentar(pub_id);
            return false;
        }
    });
    // ADJUNTAR
    $('.adj').click(function(){
        var aid = $(this).attr('aid');
    })
    // RESPUESTAS
    $('.comentar').css('max-height', '200px').css('height','14px');
    //
    $('input[name=hack]').on("focus",function(){
        $(this).hide();
        $(this).parent().find('div.formulario').show();
        var pub_id = $(this).attr('pid');
        //
        $('#cf_' + pub_id).focus()
    }) 
});