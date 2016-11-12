                        <div class="sidebar-add-post">
                        <div id="upload">
                        </div>
                        <div id="upload_form">
                        <script type="text/javascript" src="{$tsConfig.default}/js/jquery.form.js"></script>
                        {literal}
                        <script type="text/javascript">
                        $(function(){
                            $('#up_form').ajaxForm({
                                    resetForm: true,
                                    dataType: 'json',
                                    beforeSubmit: function(a,f,o) {
                                        //o.dataType = $('#uploadResponseType')[0].value;
                                        $('#results').html('<center><img src="' + global_data.img + '/images/loading_bar.gif"/></center>');
                                    },
                                    success: function(data) {
                                        var res = $('#results');
                                        var imgs = $('#imagenes');
                                        var resp = data.length;
                                        //
                                        if(resp > 0){
                                            res.html(''); // RESET
                                            for(var i = 0; i < resp; i++ ){
                                                // STATUS
                                                var li = '<span class="status_' + data[i][0] + '>';
                                                if(data[i][0] == 1) li += '#' + (i + 1) + ' Subido con &eacute;xito.';
                                                else if(data[i][1] != 'No Found')li += data[i][1];
                                                li += '</span>';
                                                //
                                                res.append(li);
                                                // AGREGAMOS LAS CORRECTAS
                                                if(data[i][0] == 1){
                                                    var ext = data[i][2];
                                                    var img = data[i][1];
                                                    //img = img.replace(ext,'th.' + ext);
                                                    // HTML
                                                    var plink = '<a href="#post" onclick="upload.agregar(';
                                                    plink += "'" + data[i][1] + "'";
                                                    plink += '); return false;"';
                                                    //
                                                    var html = '<div class="item">';
                                                    html += plink + '><img src="' + img + '"/></a>';
                                                    html += plink + ' class="txt">Agregar al post</a>';
                                                    html += '</div>';
                                                    imgs.append(html);
                                                }
                                            }
                                        } else {
                                            res.html('No se seleccionaron archivos.');
                                        }
                                    }
                                });
 
                        });
                        </script>
                        {/literal}
                        <form id="up_form" method="post" action="{$tsConfig.url}/upload-images.php" enctype="multipart/form-data">
                            <div class="clearfix">
                            <p class="floatL">
                                    <span class="stitle">Subir im&aacute;genes.</span>
                            </p>
                            </div>
                            <div class="clearfix">
                            <p>Puedes subir im&aacute;genes para tu post desde aqu&iacute;, solo selecciona las que quieras desde tu PC, y podr&aacute;s agregarlas f&aacute;cilmente. El proceso puede tardar unos minutos.</p>
                            <hr />
                            <div class="clearfix">
                                <div id="fileinputs" class="inputs floatL">
                                    #1 <input type="file" name="img1" />
                                    #2 <input type="file" name="img2" />
                                    #3 <input type="file" name="img3" />
                                    #4 <input type="file" name="img4" />
                                    #5 <input type="file" name="img5" />
                                    <input type="submit" class="mBtn btnYellow" value="Subir Im&aacute;genes" />
                                </div>
                                <div id="imagenes" class="floatL"></div>
                            </div>
                            <hr />
                            <div id="results"></div>
                            </div>
                            </form>
                        </div>
                        <div id="protocolo">
                            <div class="clearfix">
                            	<p class="floatL">
                                    <span class="stitle">Consejos: Para hacer un buen post es importante que tengas en cuenta algunos puntos.</span>
                                </p>
                                <a class="consejos-view-more-button">Ver m&aacute;s...</a>
                            </div>
                            <div style="display: none;" class="consejos-view-more clearfix">
                				<p style="margin-top: 5px;">Esto ayuda a mantener una mejor calidad de contenido y evitar que sea eliminado por los moderadores.</p>
                				<div class="clearfix">
                		
                					<div class="floatL clearfix">
                						<strong>El Titulo</strong>
                						<ul>
                							<li class="correct">Que sea descriptivo</li>
                							<li class="">TODO EN MAYUSCULA</li>
                							<li class="">!!!!!!!Exagerados!!!!!!</li>
                							<li class="">PARCIALMENTE en may&uacute;sculas!</li>
                						</ul>
                					</div>
                					<div class="floatL clearfix">
                						<strong class="floatL">Contenido</strong>
                						<br/>
                						<ul style="margin-right: 10px;" class="floatL">
                							<li class="">Informaci&oacute;n personal o de un tercero</li>
                							<li class="">Fotos de personas menores de edad</li>
                							<li class="">Muertos, sangre, v&oacute;mitos, etc.</li>
                							<li class="">Con contenido racista y/o peyorativo</li>
                						</ul>
                						<ul class="floatL">
                							<li class="">Poca calidad (una imagen, texto pobre)</li>
                							<li class="">Chistes escritos, adivinanzas, trivias</li>
                							<li class="">Haciendo preguntas o cr&iacute;ticas</li>
                							<li class="">Insultos o malos modos</li>
                						</ul>
                						<ul class="floatL">
                							<li class="">Con intenci&oacute;n de armar pol&eacute;mica</li>
                							<li class="">Apolog&iacute;a de delito</li>
                							<li class="">Software spyware, malware, virus o troyanos</li>
                						</ul>
                						</div>
                				</div>
                			</div>
                        </div>
					</div>