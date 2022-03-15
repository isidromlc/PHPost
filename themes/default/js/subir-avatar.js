const next = $(".avatar-next");
const sizeImg = 120;

function cambiarFile(){
   const input = $('#file-avatar')[0];
   if(input.files && input.files[0]) {
   	let name_file = decodeURIComponent(input.files[0].name);
      document.querySelector(".drop-message").innerHTML = name_file;
      next.removeClass('btn-disabled')
   }   
}
$("#url-avatar").on('keyup', () => {
   if($("#url-avatar").val().length > 5) next.removeClass('btn-disabled')
})
$("#change > li, #change > li span").on('click', event => {
	const block = $("#change")
	block.attr('class', '')
	var tipo = event.target.textContent
	if(tipo === 'Local') {
		block.html(`<div id="drop-region">
         <input type="file" name="local" id="file-avatar" onchange="return cambiarFile();" class="browse"/>
         <div class="drop-message">
            Arrastra y suelta la imagen o haz clic para subir
         </div>
      </div>`)
	} else {
		block.html(`<div style="margin: 0 auto 10px auto;">
         <input type="text" name="url" autocomplete="off" id="url-avatar" placeholder="Url de la imagen" class="browse form-control"/>
      </div>`)
	}
})

var avatar = {
	uid: false,
	key: false,
   ext: false,
	informacion: '',
	current: false,
	success: false,
	subir: async () => {
		$(".avatar-loading").show().css('display', 'flex');
		inputs = [].slice.call(document.querySelectorAll(".browse"))
		inputs.forEach(input => {
			const datoUrl = new FormData();
			datoUrl.append('url', (input.name == 'url') ? input.value : input.files[0])
			
			if(!empty(input.value)) {
				fetch(global_data.url + '/upload-avatar.php', {
					method: 'POST',
					body: datoUrl
				})
				.then(response => response.json())
				.then(blobData => {
				   avatar.subida_exitosa(blobData)
				});
			}
		})
	},
	subida_exitosa: rsp => {
		if (rsp.error == 'success') avatar.success = true;
		else if (rsp.msg) {
         avatar.key = rsp.key;
         avatar.ext = rsp.ext;
         avatar.cortar(rsp.msg);
		} else cuenta.enviar_alerta(rsp.error, 0);
		$(".avatar-loading").hide();
	},
	cortar: img => {
		img = img + '?t=' + new Date();
		mydialog.show(true);
		mydialog.title("Cortar avatar");
		mydialog.body(`<img class="avatar-cortar" src="${img}" />`);
		mydialog.buttons(true, true, 'Cortar', "avatar.guardar()", true, false, true, 'Cancelar', 'close', true, true);
		/*mydialog.buttons([
			{mostrar: true, texto: 'Cortar', accion: `avatar.guardar()`, activo: true}, 
			{mostrar: true, texto: 'Cancelar', accion: 'cerrar', activo: true}
		]);*/
		mydialog.center();
		$("#avatar-img, #avatar-menu").attr("src", img).on('load', () => {
			var croppr = new Croppr('.avatar-cortar', {
			   aspectRatio: 1, // Mantemos el tamanio cuadrado 1:1
    			maxSize: { 
    				width: sizeImg, // Tamano por defecto
    				height: sizeImg // Tamano por defecto
    			}, 
    			// Enviamos las coordenadas para cortar la imagen
    			// Tiene la funcion onCropEnd ya que es como va a quedar
    			onCropEnd: data => avatar.informacion = data,
			});
		});
	},
	recargar: () => $("#avatar-img").attr("src", avatar.current + '?r' + new Date()),
	guardar: () => {
		if (empty(avatar.informacion)) 
			cuenta.enviar_alerta('Debes seleccionar una parte de la foto', 0);
		else {
			const coordenadas = new FormData();
			coordenadas.append('key', avatar.key)
			coordenadas.append('ext', avatar.ext)
			coordenadas.append('x', avatar.informacion.x)
			coordenadas.append('y', avatar.informacion.y)
			coordenadas.append('w', avatar.informacion.width)
			coordenadas.append('h', avatar.informacion.height)
			fetch(global_data.url + '/upload-crop.php', {
				method: 'POST',
				body: coordenadas
			})
			.then(response => response.json()) 
			.then(blobData => {
			   if(blobData.error == "success") {
			   	mydialog.body("Tu avatar se ha creado correctamente, ahora espera que recargue la p&aacute;gina");
			   	setTimeout(() => location.reload(), 1200);
			   	mydialog.buttons(false)
			   }
			});
		}
	}
}