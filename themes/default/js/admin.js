/**
 * @param object | recibimos un objecto como parámetro
*/
function admin_send_post(objeto) {
	// URL -> DATA -> RESPONSE -> CALLBACK
	var xhr = $.post(`${global_data.url}/${objeto.pagina}.php`, objeto.parametros, response => response)
	if(typeof objeto.done !== 'undefined') xhr.done(() => objeto.done)
	return xhr
}
function modal_rapido(modal) {
   mydialog.show();
   mydialog.title(modal.titulo);
   mydialog.body(modal.contenido);
   mydialog.buttons(true, true, 'S&iacute;', modal.accion, true, false, true, 'No', 'close', true, true);
   mydialog.center();
}
/** 
 * Nueva organización
*/
var admin = {
	// Noticias
	news: {
		accion: async nid => {
			$('#loading').fadeIn(250);
			var rsp = await admin_send_post({
				pagina: 'admin-noticias-setInActive', 
				parametros: 'nid=' + nid
			})
			if(rsp.charAt(0) === '0') mydialog.alert('Error', rsp.substring(3))
			var change = (rsp.charAt(0) === '1') ? ['green', 'Activa'] : ['purple', 'Inactiva'];
			$('#status_noticia_' + nid).html('<font color="'+change[0]+'">'+change[1]+'</font>');
			$('#loading').fadeOut(350)
	  	}, 
	},
	// Medallas
	medallas: {
	   borrar: async (mid, gew) => {
	   	mydialog.show();
	   	mydialog.title('Borrar Medalla');
	   	if(!gew) {
	   		mydialog.body('&#191;Quiere borrar esta medalla?');
	   		mydialog.buttons(true, true, 'S&iacute;', 'admin.medallas.borrar(' + mid + ', 2)', true, false, true, 'No', 'close', true, true);
	   	} else if(gew == '2') {
	   		mydialog.body('Si borra la medalla, los usuarios que tengan esta medalla la perder&aacute;n, &#191;seguro que quiere continuar?');
	   		mydialog.buttons(true, true, 'S&iacute;', 'admin.medallas.borrar(' + mid + ', 3)', true, false, true, 'No', 'close', true, true);
	   	} else {
	   		$('#loading').fadeIn(250);
				var a = await admin_send_post({
					pagina: 'admin-medalla-borrar', 
					parametros: 'medal_id=' + mid,
					done: $('#medal_id_' + mid).fadeOut()
				})
				mydialog.alert((a.charAt(0) == '0' ? 'Opps!' : 'Hecho'), a.substring(3), false);
				mydialog.center();
		  		$('#loading').fadeOut(350);
		  	}
		  	mydialog.center();
		},
		borrar_asignacion: async (aid, mid, gew) => {
         if(!gew) {
         	mydialog.show();
         	mydialog.title('Borrar Asignacion');
         	mydialog.body('&#191;Quiere continuar borrando esta asignaci&oacute;n?');
         	mydialog.buttons(true, true, 'S&iacute;', 'admin.medallas.borrar_asignacion(' + aid + ',' + mid + ', true)', true, false, true, 'No', 'close', true, true);
         	mydialog.center();
         } else {
         	$('#loading').fadeIn(250);
				var a = await admin_send_post({
					pagina: 'admin-medallas-borrar-asignacion', 
					parametros: ['aid=' + aid, 'mid=' + mid].join('&'),
					done: $('#assign_id_' + aid).fadeOut()
				})
				mydialog.alert((a.charAt(0) == '0' ? 'Opps!' : 'Hecho'), a.substring(3), false);
           	mydialog.center();
           
           $('#loading').fadeOut(350);
			}
		},
   	asignar: async (mid, gew) => {
   		if(!gew){
   			campos = [['usuario', 'Al usuario (nombre)'],['post', 'Al post (id)'],['foto', 'A la foto (id)']]
   			agregar = new Array();
   			campos.forEach( campo => agregar.push(`<div class="form-line"><label for="m_${campo[0]}">${campo[1]}</label><input name="m_${campo[0]}" id="m_${campo[0]}"/></div>`))
        		//
				mydialog.show(true);
				mydialog.title('Asignar medalla');
				mydialog.body('<div id="AFormInputs">'+agregar.join('<br>')+'</div>');
				mydialog.buttons(true, true, 'Asignar', 'admin.medallas.asignar(' + mid + ',true)', true, true, true, 'Cancelar', 'close', true, false);		
				mydialog.center();
			} else {
			   $('#loading').fadeIn(250); 
				var c = await admin_send_post({
					pagina: 'admin-medalla-asignar', 
					parametros: [
						'mid=' + mid, 
						'm_usuario=' + $('#m_usuario').val(), 
						'pid=' + $('#m_post').val(), 
						'fid=' + $('#m_foto').val()
					].join('&')
				})
				mydialog.alert((c.charAt(0) == '0' ? 'Opps!' : 'Hecho'), '<div class="dialog_box">' + c.substring(3) + '</div>', false);
				if(c.charAt(0) != '0') {
					$('#total_med_assig_' + mid).text(parseInt($('#total_med_assig_' + mid).text()) + 1);
            	$('#loading').fadeOut(350);
				}
				mydialog.center();
			}
   	}
   },
	// Afiliados
	afs: {
	   borrar: async (aid, gew) => {
         if(!gew) {
         	modal_rapido({
         		titulo: 'Borrar Afiliado',
         		contenido: '&#191;Quiere borrar este afiliado?',
         		accion: 'admin.afs.borrar(' + aid + ', 1)'
         	})
         } else {
         	$('#loading').fadeIn(250);
         	var a = await admin_send_post({
         		pagina: 'afiliado-borrar',
         		parametros: 'afid=' + aid
         	})
         	mydialog.alert((a.charAt(0) == '0' ? 'Opps!' : 'Hecho'), a.substring(3), false);
         	if(a.charAt(0) == '1') $('#few_' + aid).fadeOut().remove()
         	mydialog.center();
         	$('#loading').fadeOut(350);
         }
      },
      accion: async aid => {
    		$('#loading').fadeIn(250);
    		var h = await admin_send_post({
    			pagina: 'afiliado-setactive',
    			parametros: 'aid=' + aid
    		})
    		if(h.charAt(0) === '0') mydialog.alert('Error', h.substring(3))
			var change = (h.charAt(0) === '1') ? ['green', 'Activo'] : ['purple', 'Inactivo'];
    		$('#status_afiliado_' + aid).html('<font color="'+change[0]+'">'+change[1]+'</font>');
    		$('#loading').fadeOut(250);
  		}
	},
	// Bloqueos
	blacklist: {
	   borrar: async (id, gew) => {
         if(!gew) {
         	modal_rapido({
         		titulo: 'Retirar Bloqueo',
         		contenido: '&#191;Quiere retirar este bloqueo?',
         		accion: 'admin.blacklist.borrar(' + id + ', true)'
         	})
         } else {
         	$('#loading').fadeIn(250);
         	var a = await admin_send_post({
         		pagina: 'admin-blacklist-delete',
         		parametros: 'bid=' + id
         	})
         	mydialog.alert((a.charAt(0) == '0' ? 'Opps!' : 'Hecho'), a.substring(3), false);
         	mydialog.center();
         	if(a.charAt(0) === '1') $('#block_' + id).fadeOut(); 
         	$('#loading').fadeOut(350);
         }
      } 
   },
   // Censuras 
   badwords: {
	   borrar: async (wid, gew) => {
	   	if(!gew) {
         	modal_rapido({
         		titulo: 'Retirar Filtro',
         		contenido: '&#191;Quiere retirar este filtro?',
         		accion: 'admin.badwords.borrar(' + wid + ', true)'
         	})
	   	} else {
	   		$('#loading').fadeIn(250);
        		var a = await admin_send_post({
        			pagina: 'admin-badwords-delete',
        			parametros: 'wid=' + wid
        		})
        		mydialog.alert((a.charAt(0) == '0' ? 'Opps!' : 'Hecho'), a.substring(3), false);
        		mydialog.center();
        		if(a.charAt(0) === '1') $('#wid_' + wid).fadeOut(); 
        		$('#loading').fadeOut(350);
        	}
      }
   },
   // Posts
   posts: {
	   borrar: async (pid, gew) => {
         if(!gew){
         	modal_rapido({
         		titulo: 'Borrar Post',
         		contenido: '&#191;Quiere borrar este post permanentemente?',
         		accion: 'admin.posts.borrar(' + pid + ', 1)'
         	})
        	} else {
        		$('#loading').fadeIn(250);
        		var a = await admin_send_post({
        			pagina: 'posts-admin-borrar',
        			parametros: 'postid=' + pid
        		})
          	mydialog.alert((a.charAt(0) == '0' ? 'Opps!' : 'Hecho'), a.substring(3), false);
			   mydialog.center();
			   if(a.charAt(0) == '1') $('#post_' + pid).fadeOut(); 
			   $('#loading').fadeOut(350);
			}
		}
	},
	// Fotos
	fotos : {
	   borrar: async (fid, gew) => {
         if(!gew) {
         	modal_rapido({
         		titulo: 'Borrar Foto',
         		contenido: '&#191;Quiere borrar esta foto permanentemente?',
         		accion: 'admin.fotos.borrar(' + fid + ', 1)'
         	})
         } else {
         	$('#loading').fadeIn(250);
        		var a = await admin_send_post({
        			pagina: 'admin-foto-borrar',
        			parametros: 'foto_id=' + fid
        		})
          	mydialog.alert((a.charAt(0) == '0' ? 'Opps!' : 'Hecho'), a.substring(3), false);
			   mydialog.center();
			   if(a.charAt(0) == '1') $('#foto_' + fid).fadeOut(); 
			   $('#loading').fadeOut(350);
			}
		},
		setOpenClosed: async fid => {
			$('#loading').fadeIn(250);
         var h = await admin_send_post({
         	pagina: 'admin-foto-setOpenClosed', 
         	parametros: 'fid=' + fid
         })
			if(h.charAt(0) === '0') mydialog.alert('Error', h.substring(3))
			var change = (h.charAt(0) === '1') ? ['red', 'Cerrados'] : ['green', 'Abiertos'];
			$('#comments_foto_' + fid).html('<font color="'+change[0]+'">'+change[1]+'</font>');
			$('#loading').fadeOut(350);
		},
   	setShowHide:async fid => {
         $('#loading').fadeIn(250);
         var h = await admin_send_post({
         	pagina: 'admin-foto-setShowHide', 
         	parametros: 'fid=' + fid
         })
			if(h.charAt(0) === '0') mydialog.alert('Error', h.substring(3))
			var change = (h.charAt(0) === '1') ? ['purple', 'Oculta'] : ['green', 'Visible'];
			$('#status_foto_' + fid).html('<font color="'+change[0]+'">'+change[1]+'</font>');
			$('#loading').fadeOut(350);
		}
	},
   // Usuarios
   users: {
      setInActive: async uid => {
         $('#loading').fadeIn(250);
         var h = await admin_send_post({
            pagina: 'admin-users-InActivo',
            parametros: 'uid=' + uid
         })
         if(h.charAt(0) === '0') mydialog.alert('Error', h.substring(3)); 
         var change = (h.charAt(0) === '1') ? ['green', 'Activo'] : ['purple', 'Inactivo'];
         $('#status_user_' + fid).html('<font color="'+change[0]+'">'+change[1]+'</font>');
      }
   },
	// Sesiones
   sesiones: {
      borrar: async (sid, gew) => {
         if(!gew){
            modal_rapido({
               titulo: 'Cerrar sesi&oacute;n',
               contenido: '&#191;Quiere cerrar la sesi&oacute;n de este usuario/visitante? Se borrar&aacute; la sesi&oacute;n',
               accion: "admin.sesiones.borrar('" + sid + "', true)"
            })
         } else {
            $('#loading').fadeIn(250);
            var a = await admin_send_post({
               pagina: 'admin-sesiones-borrar',
               parametros: 'session_id=' + sid
            })
            mydialog.alert((a.charAt(0) == '0' ? 'Opps!' : 'Hecho'), a.substring(3), false);
            mydialog.center();
            if(a.charAt(0) == '1') $('#sesion_' + sid).fadeOut(); 
            $('#loading').fadeOut(350);
         }
      }
   },
	// Nicks
   nicks: {
      accion: async (nid, accion, gew) =>{
         if(!gew){
            modal_rapido({
               titulo: (accion == 'aprobar') ? 'Aprobar Cambio' : 'Denegar Cambio',
               contenido: (accion == 'aprobar') ? '&#191;Quiere aprobar el cambio?' : '&#191;Quiere denegar el cambio?',
               accion: "admin.nicks.accion(" + nid + ",'" + accion + "' ,true)"
            })
         } else {
            $('#loading').fadeIn(250);
            var a = await admin_send_post({
               pagina: 'admin-nicks-change',
               parametros: 'nid=' + nid + '&accion=' + accion
            })
            mydialog.alert((a.charAt(0) == '0' ? 'Opps!' : 'Hecho'), a.substring(3), false);
            mydialog.center();
            if(a.charAt(0) == '1') $('#nick_' + nid).fadeOut(); 
            $('#loading').fadeOut(350);
         }
      }
   }
}

/* AFILIADOS */
var ad_afiliado = {
   cache: {},
   detalles: async aid => {
      modal_rapido({
         titulo: 'Detalles del afiliado',
         contenido: await admin_send_post({
            pagina:'afiliado-detalles',
            parametros:'ref=' + aid
         }),
         texto: 'Aceptar',
         accion: 'mydialog.close()'
      })
   }
}