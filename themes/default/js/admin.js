/*
    PHPost > Admin
    Autor: JNeutron
    ::
    Funciones para el panel de administración
*/

var admin = {
	
		afs : {
	    borrar:function(aid, gew){
          if(!gew){
            mydialog.show();
			
            mydialog.title('Borrar Afiliado');
			
            mydialog.body('&#191;Quiere borrar este afiliado?');
			
            mydialog.buttons(true, true, 'S&iacute;', 'admin.afs.borrar(' + aid + ', 1)', true, false, true, 'No', 'close', true, true);
			
            mydialog.center();
			
        }else{
            
            $('#loading').fadeIn(250);
		
           $.post(global_data.url + '/afiliado-borrar.php', 'afid=' + aid, function(a){
		   
           mydialog.alert((a.charAt(0) == '0' ? 'Opps!' : 'Hecho'), a.substring(3), false);
		   
           mydialog.center();
           
           success:  if(a.charAt(0) == '1') $('#few_' + aid).fadeOut().remove; $('#loading').fadeOut(350);
           
      });
     }
   },


  accion: function(aid){
    $('#loading').fadeIn(250);
    $.ajax({
		type: 'POST',
		url: global_data.url +'/afiliado-setactive.php',
		data: 'aid=' + aid,
		success: function(h){
			switch(h.charAt(0)){
				case '0': //Error
					mydialog.alert('Error', h.substring(3));
					break;
				case '1':
					//
					$('#status_afiliado_' + aid).html('<font color="green">Activo</font>');
				break;
				case '2':
					//
					$('#status_afiliado_' + aid).html('<font color="purple">Inactivo</font>');
				break;
                
			}
            $('#loading').fadeOut(250);
		}
	});
  }, 
},

news : {
 accion: function(nid){
    $('#loading').fadeIn(250);
    $.ajax({
		type: 'POST',
		url: global_data.url +'/admin-noticias-setInActive.php',
		data: 'nid=' + nid,
		success: function(h){
			switch(h.charAt(0)){
				case '0': //Error
					mydialog.alert('Error', h.substring(3));
					break;
				case '1':
					//
					$('#status_noticia_' + nid).html('<font color="green">Activa</font>');
				break;
				case '2':
					//
					$('#status_noticia_' + nid).html('<font color="purple">Inactiva</font>');
				break;
			}
            
            $('#loading').fadeOut(350);
		}
	});
  }, 
},

nicks : {
  accion: function(nid, accion, gew){
    if(!gew){
            mydialog.show();

			mydialog.title((accion == 'aprobar' ? 'Aprobar Cambio' : 'Denegar Cambio'));
			
			mydialog.body((accion == 'aprobar' ? '&#191;Quiere aprobar el cambio?' : '&#191;Quiere denegar el cambio?'));

            mydialog.buttons(true, true, 'S&iacute;', "admin.nicks.accion(" + nid + ",'" + accion + "' ,true)", true, false, true, 'No', 'close', true, false);
            
			mydialog.center();
			
        }else{
            
            $('#loading').fadeIn(250);
		
           $.post(global_data.url + '/admin-nicks-change.php', 'nid=' + nid + '&accion=' + accion, function(a){
		   
           mydialog.alert((a.charAt(0) == '0' ? 'Opps!' : 'Hecho'), a.substring(3), false);
		   
		   mydialog.center();
		   
		   success:  if(a.charAt(0) == '1') $('#nick_' + nid).fadeOut(); $('#loading').fadeOut(350);
					   
      });
     }
  }, 
},

sesiones : {
	    borrar:function(sid, gew){
          if(!gew){
            mydialog.show();
			
            mydialog.title('Cerrar sesi&oacute;n');
			
            mydialog.body('&#191;Quiere cerrar la sesi&oacute;n de este usuario/visitante? Se borrar&aacute; la sesi&oacute;n');
			
            mydialog.buttons(true, true, 'S&iacute;', "admin.sesiones.borrar('" + sid + "', true)", true, false, true, 'No', 'close', true, true);
			
            mydialog.center();
			
        }else{
            
            $('#loading').fadeIn(250);
		
           $.post(global_data.url + '/admin-sesiones-borrar.php', 'sesion_id=' + sid, function(a){
		   
           mydialog.alert((a.charAt(0) == '0' ? 'Opps!' : 'Hecho'), a.substring(3), false);
		   
		   mydialog.center();
		   
		   success:  if(a.charAt(0) == '1') $('#sesion_' + sid).fadeOut(); $('#loading').fadeOut(350);
					   
      });
     }
   },  
},


posts : {
	    borrar:function(pid, gew){
          if(!gew){
            mydialog.show();
			
            mydialog.title('Borrar Post');
			
            mydialog.body('&#191;Quiere borrar este post permanentemente?');
			
            mydialog.buttons(true, true, 'S&iacute;', 'admin.posts.borrar(' + pid + ', 1)', true, false, true, 'No', 'close', true, true);
			
            mydialog.center();
			
        }else{
		  
          $('#loading').fadeIn(250);
        
           $.post(global_data.url + '/posts-admin-borrar.php', 'postid=' + pid, function(a){
		   
           mydialog.alert((a.charAt(0) == '0' ? 'Opps!' : 'Hecho'), a.substring(3), false);
		   
		   mydialog.center();
           
           success:  if(a.charAt(0) == '1') $('#post_' + pid).fadeOut(); $('#loading').fadeOut(350);
					   
      });
     }
   },  
},

blacklist : {
	    borrar:function(id, gew){
          if(!gew){
            mydialog.show();
			
            mydialog.title('Retirar Bloqueo');
			
            mydialog.body('&#191;Quiere retirar este bloqueo?');
			
            mydialog.buttons(true, true, 'S&iacute;', 'admin.blacklist.borrar(' + id + ', true)', true, false, true, 'No', 'close', true, true);
			
            mydialog.center();
			
        }else{
		  
          $('#loading').fadeIn(250);
        
           $.post(global_data.url + '/admin-blacklist-delete.php', 'bid=' + id, function(a){
		   
           mydialog.alert((a.charAt(0) == '0' ? 'Opps!' : 'Hecho'), a.substring(3), false);
		   
		   mydialog.center();
           
           success:  if(a.charAt(0) == '1') $('#block_' + id).fadeOut(); $('#loading').fadeOut(350);
					   
      });
     }
   },  
},

badwords : {
	    borrar:function(wid, gew){
          if(!gew){
            mydialog.show();
			
            mydialog.title('Retirar Filtro');
			
            mydialog.body('&#191;Quiere retirar este filtro?');
			
            mydialog.buttons(true, true, 'S&iacute;', 'admin.badwords.borrar(' + wid + ', true)', true, false, true, 'No', 'close', true, true);
			
            mydialog.center();
			
        }else{
		  
          $('#loading').fadeIn(250);
        
           $.post(global_data.url + '/admin-badwords-delete.php', 'wid=' + wid, function(a){
		   
           mydialog.alert((a.charAt(0) == '0' ? 'Opps!' : 'Hecho'), a.substring(3), false);
		   
		   mydialog.center();
           
           success:  if(a.charAt(0) == '1') $('#wid_' + wid).fadeOut(); $('#loading').fadeOut(350);
					   
      });
     }
   },  
},

fotos : {
	    borrar:function(fid, gew){
          if(!gew){
            mydialog.show();
			
            mydialog.title('Borrar Foto');
			
            mydialog.body('&#191;Quiere borrar esta foto permanentemente?');
			
            mydialog.buttons(true, true, 'S&iacute;', 'admin.fotos.borrar(' + fid + ', 1)', true, false, true, 'No', 'close', true, true);
			
            mydialog.center();
			
        }else{
		
            $('#loading').fadeIn(250);
            
           $.post(global_data.url + '/admin-foto-borrar.php', 'foto_id=' + fid, function(a){
		   
           mydialog.alert((a.charAt(0) == '0' ? 'Opps!' : 'Hecho'), a.substring(3), false);
		   
		   mydialog.center();
		   
		   success:  $('#foto_' + fid).fadeOut(); $('#loading').fadeOut(350);
					   
      });
     }
   },
   setOpenClosed:function(fid){
         
         $('#loading').fadeIn(250);
         
		 $.ajax({
		type: 'POST',
		url: global_data.url +'/admin-foto-setOpenClosed.php',
		data: 'fid=' + fid,
		success: function(h){
			switch(h.charAt(0)){
				case '0': //Error
					mydialog.alert('Error', h.substring(3));
					break;
				case '1':
					//
					$('#comments_foto_' + fid).html('<font color="red">Cerrados</font>');
				break;
				case '2':
					//
					$('#comments_foto_' + fid).html('<font color="green">Abiertos</font>');
				break;
			}
            $('#loading').fadeOut(350);
		}
	});
		 
		 
   },
   setShowHide:function(fid){
         $('#loading').fadeIn(250);
		 $.ajax({
		type: 'POST',
		url: global_data.url +'/admin-foto-setShowHide.php',
		data: 'fid=' + fid,
		success: function(h){
			switch(h.charAt(0)){
				case '0': //Error
					mydialog.alert('Error', h.substring(3));
					break;
				case '1':
					//
					$('#status_foto_' + fid).html('<font color="purple">Oculta</font>');
				break;
				case '2':
					//
					$('#status_foto_' + fid).html('<font color="green">Visible</font>');
				break;
			}
            $('#loading').fadeOut(350);
		}
	});
		 
		 
   },


	
   
},

medallas : {
	    borrar:function(mid, gew){
		
		    mydialog.show();
			
            mydialog.title('Borrar Medalla');
			
          if(!gew){
			
            mydialog.body('&#191;Quiere borrar esta medalla?');
			
            mydialog.buttons(true, true, 'S&iacute;', 'admin.medallas.borrar(' + mid + ', 2)', true, false, true, 'No', 'close', true, true);
				
		  }else if(gew == '2'){
			
            mydialog.body('Si borra la medalla, los usuarios que tengan esta medalla la perder&aacute;n, &#191;seguro que quiere continuar?');
			
            mydialog.buttons(true, true, 'S&iacute;', 'admin.medallas.borrar(' + mid + ', 3)', true, false, true, 'No', 'close', true, true);
						
        }else{
		      
              $('#loading').fadeIn(250);
              
           $.post(global_data.url + '/admin-medalla-borrar.php', 'medal_id=' + mid, function(a){
		   
           mydialog.alert((a.charAt(0) == '0' ? 'Opps!' : 'Hecho'), a.substring(3), false);
		   
		   mydialog.center();
		   
		   success:  $('#medal_id_' + mid).fadeOut(); $('#loading').fadeOut(350);
					   
      });
     }
	 
	 mydialog.center();
   },
   
   borrar_asignacion:function(aid, mid, gew){
          if(!gew){
            mydialog.show();
			
            mydialog.title('Borrar Asignacion');
			
            mydialog.body('&#191;Quiere continuar borrando esta asignaci&oacute;n?');
			
            mydialog.buttons(true, true, 'S&iacute;', 'admin.medallas.borrar_asignacion(' + aid + ',' + mid + ', true)', true, false, true, 'No', 'close', true, true);
			
            mydialog.center();
			
        }else{
		
           $('#loading').fadeIn(250);
            
           $.post(global_data.url + '/admin-medallas-borrar-asignacion.php', 'aid=' + aid + '&mid=' + mid, function(a){
		   
           mydialog.alert((a.charAt(0) == '0' ? 'Opps!' : 'Hecho'), a.substring(3), false);
		   
		   mydialog.center();
		   
		   success:  $('#assign_id_' + aid).fadeOut(); $('#loading').fadeOut(350);
					   
      });
     }
   },
   asignar:function(mid, gew){
		
		    if(!gew){
	 
	var form = '';
        form += '<div style="padding:5px 35px;" id="AFormInputs">'
        form += '<div class="form-line">'
        form += '<label for="m_usuario">Al usuario (nombre):</label>'
        form += '<input name="m_usuario" id="m_usuario"/><br />'
		form += '<label for="m_post">Al post (id):</label>'
        form += '<input name="m_post" id="m_post"/><br />'
 		form += '<label for="m_foto">A la foto (id):</label>'
        form += '<input name="m_foto" id="m_foto"/>'
		form += '</div>'
		form += '</div>'
        //
        mydialog.class_aux = 'registro';
		mydialog.show(true);
		mydialog.title('Asignar medalla');
		mydialog.body(form);
		mydialog.buttons(true, true, 'Asignar', 'admin.medallas.asignar(' + mid + ',true)', true, true, true, 'Cancelar', 'close', true, false);		
		mydialog.center();
	
	 }else{
	 
	var m_usuario = $('#m_usuario').val(); 
	var m_post = $('#m_post').val(); 
	var m_foto = $('#m_foto').val();
    
    $('#loading').fadeIn(250); 
	
	$.post(global_data.url + '/admin-medalla-asignar.php', 'mid=' + mid + '&m_usuario=' + m_usuario + '&pid=' + m_post + '&fid=' + m_foto, function(c){
		   
           mydialog.alert((c.charAt(0) == '0' ? 'Opps!' : 'Hecho'), '<div class="dialog_box">' + c.substring(3) + '</div>', false);
		   
		   success: if(c.charAt(0) != '0') {
				var nmeds = parseInt($('#total_med_assig_' + mid).text());
				$('#total_med_assig_' + mid).text(nmeds + 1);
                $('#loading').fadeOut(350);
				}
		   
           mydialog.center();
		    
		  });
	}
   },


	
   
},

    users: {
		setInActive: function(uid){
        
        $('#loading').fadeIn(250);
		$.ajax({
		type: 'POST',
		url: global_data.url +'/admin-users-InActivo.php',
		data: 'uid=' + uid,
		success: function(h){
			switch(h.charAt(0)){
				case '0': //Error
					mydialog.alert('Error', h.substring(3));
					break;
				case '1':
					//
					$('#status_user_' + uid).html('<font color="green">Activo</font>');
				break;
				case '2':
					//
					$('#status_user_' + uid).html('<font color="purple">Inactivo</font>');
				break;
			}
            $('#loading').fadeOut(350);
		}
	});
	 
        
    },
	
    },
}

/* AFILIADOS */
var ad_afiliado = {
    cache: {},
    detalles: function(aid){
    	$.ajax({
    		type: 'POST',
    		url: global_data.url + '/afiliado-detalles.php',
    		data: 'ref=' + aid,
    		success: function(h){
        		mydialog.show(true);
        		mydialog.title('Detalles del Afiliado');
        		mydialog.body(h);
                mydialog.buttons(true, true, 'Aceptar', 'mydialog.close()', true, true);
                mydialog.center();
                
    		}
    	});   
    }
}