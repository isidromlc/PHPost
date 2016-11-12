{include file='sections/main_header.tpl'}
        {literal}
        <script type="text/javascript">
        var buscador = {
            // {/literal}
        	tipo: '{if !$tsEngine}web{$tsEngine}{/if}',
            // {literal}
        	select: function(tipo){
        		if(this.tipo==tipo)
        			return;
        
        		//Cambio de action form
        		//$('form[name="buscador"]').attr('action', '?e='+tipo+'');
                $('input[name="e"]').val(tipo);
        
        		//Solo hago los cambios visuales si no envia consulta
        		if(!this.buscadorLite){
        			//Cambio here en <a />
        			$('a#select_' + this.tipo).removeClass('here');
        			$('a#select_' + tipo).addClass('here');
        
        			//Cambio de logo
        			$('img#buscador-logo-'+this.tipo).css('display', 'none');
        			$('img#buscador-logo-'+tipo).css('display', 'inline');
        
        		}
        
        		//Muestro/oculto los input google
        		if(tipo=='google'){ 
                    //Ahora es google {/literal}
        			$('form[name="buscador"]').append('<input type="hidden" name="cx" value="{$tsConfig.ads_search}" /><input type="hidden" name="cof" value="FORID:10" /><input type="hidden" name="ie" value="ISO-8859-1" />');
                    // {literal}
        		}else if(this.tipo=='google'){ //El anterior fue google
        			$('input[name="cx"]').remove();
        			$('input[name="cof"]').remove();
        			$('input[name="ie"]').remove();
        		}
        
        		this.tipo = tipo;
        	}
        }
        </script>
        {/literal}
        {if $tsQuery || $tsAutor}
        <div id="buscadorLite">
        	<ul class="searchTabs">
        		<li class="here"><a href="">Posts</a></li>
        		<div class="clearBoth"></div>
        	</ul>
        	<div class="clearBoth"></div>
        	<div class="searchCont">
        		<form action="" method="GET" name="buscador">
        			<div class="searchFil">
        				<div style="margin-bottom: 5px;">
        					<img{if $tsEngine != 'google'}style="display: none;"{/if} alt="google-search-engine" src="http://www.google.com/images/poweredby_transparent/poweredby_FFFFFF.gif" id="buscador-logo-google"/>
        					<img{if $tsEngine != 'web'}style="display: none;"{/if} alt="web-search-engine" src="{$tsConfig.default}/images/phpostmin.gif" id="buscador-logo-web"/>
        					<img{if $tsEngine != 'tags'} style="display: none;"{/if} alt="tags-search-engine" src="{$tsConfig.default}/images/phpostmin.gif" id="buscador-logo-tags"/>
        					<label style="float: right;" class="searchWith">
                            <a href="javascript:buscador.select('google')" id="select_google"{if $tsEngine == 'google'} class="here"{/if}>Google</a><span class="sep">|</span>
        					<a href="javascript:buscador.select('web')" id="select_web"{if !$tsEngine || $tsEngine == 'web'} class="here"{/if}>{$tsConfig.titulo}</a><span class="sep">|</span>
        					<a href="javascript:buscador.select('tags')" id="select_tags"{if $tsEngine == 'tags'} class="here"{/if}>Tags</a></label>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearBoth"></div>
                        <div class="boxBox">
                            <div class="searchEngine">
                                <input type="text" value="{$tsQuery}" class="searchBar" size="25" name="q"/>
        						<input type="submit" title="Buscar" value="Buscar" class="mBtn btnOk"/>
                                <input type="hidden" name="e" value="{$tsEngine}" />
                                {if $tsEngine == 'google'}
                                <input type="hidden" name="cx" value="{$tsConfig.ads_search}" /><input type="hidden" name="cof" value="FORID:10" /><input type="hidden" name="ie" value="ISO-8859-1" />
                                {/if}
        					</div><!-- End Filter -->
                            <div class="filterSearch">
                                <div class="floatL">
                                    <label>Categoria</label><br/>
        							<select style="width: 150px;" name="cat">
        								<option value="-1">Todas</option>
                                        {foreach from=$tsConfig.categorias item=c}
                                        <option value="{$c.cid}"{if $tsCategory == $c.cid} selected="true"{/if}>{$c.c_nombre}</option>
                                        {/foreach}
        							</select>
        							<span id="filtro_autor">
        								<label>Usuario</label>
        								<input type="text" name="autor" value="{$tsAutor}"/>
        							</span>
        						</div>
                                <div class="clearfix"></div>
                            </div><!-- End SearchFill -->
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div><!-- End SearchFill -->
              </form>
              </div>
        </div>
            {if $tsEngine == 'google'}
        <div id="cse-search-results"></div>
        <script type="text/javascript">
          var googleSearchIframeName = "cse-search-results";
          var googleSearchFormName = "cse-search-box";
          var googleSearchFrameWidth = '940';
          var googleSearchDomain = "www.google.com.mx";
          var googleSearchPath = "/cse";
        </script>
        <script type="text/javascript" src="http://www.google.com/afsonline/show_afs_search.js"></script>
            {else}
        <div id="resultados" style="width:770px" class="floatL">
            <div id="showResult">
                <table class="linksList">
                    <thead>
        				<tr>
        					<th width="30"></th>
        					<th style="text-align: left;">Mostrando <strong>{$tsResults.total}</strong> de <strong>{$tsResults.pages.total}</strong> resultados totales</th>
        				</tr>
        			</thead>
                    <tbody>
                    {foreach from=$tsResults.data item=r}
                    <tr id="div_{$r.post_id}">
                        <td title="{$r.c_nombre}" style="background:url({$tsConfig.tema.t_url}/images/icons/cat/{$r.c_img}) no-repeat center center;">&nbsp;</td>
                        <td style="text-align: left;">
                            <a class="titlePost" href="{$tsConfig.url}/posts/{$r.c_seo}/{$r.post_id}/{$r.post_title|seo}.html">{$r.post_title}</a>
                            <div class="info" style="background-color:#FFF">
                                <img alt="Creado hace" src="{$tsConfig.tema.t_url}/images/icons/clock.png"/> <strong>{$r.post_date|hace:true}</strong> -
                                <img alt="Posts relacionados" src="{$tsConfig.tema.t_url}/images/icons/relacionados.png"/> <a href="{$tsConfig.url}/buscador/?q={$r.post_title}&e={$tsEngine}&cat={$tsCategory}&autor={$tsAutor}">Post Relacionados</a> -
                                <img alt="Creado por" src="{$tsConfig.tema.t_url}/images/icons/autor.png"/> <a href="{$tsConfig.url}/perfil/{$r.user_name}">{$r.user_name}</a> |
                                <img alt="0 puntos" src="{$tsConfig.tema.t_url}/images/icons/puntos.png"/> Puntos <strong>{$r.post_puntos}</strong> -
                                <img alt="0 puntos" src="{$tsConfig.tema.t_url}/images/icons/favoritos.gif"/> <strong>{$r.post_favoritos}</strong> Favoritos -
                                <img alt="0 puntos" src="{$tsConfig.tema.t_url}/images/icons/comentarios.gif"/> <strong>{$r.post_comments}</strong> Comentarios
                            </div>
                        </td>
                    </tr>
                    {/foreach}
                    </tbody>
                </table>
            </div>
            <div class="paginadorCom">
                {if $tsResults.pages.prev != 0}<div style="display: block; margin: 5px 0pt; width: 110px;text-align:left" class="floatL before"><a href="{$tsConfig.url}/buscador/?page={$tsResults.pages.prev}{if $tsQuery}&q={$tsQuery}{/if}{if $tsEngine}&e={$tsEngine}{/if}{if $tsCategory}&cat={$tsCategory}{/if}{if $tsAutor}&autor={$tsAutor}{/if}">&laquo; Anterior</a></div>{/if}
          		{if $tsResults.pages.next != 0}<div style="display: block; margin: 5px 0pt; width: 110px;text-align:right" class="floatR next"><a href="{$tsConfig.url}/buscador/?page={$tsResults.pages.next}{if $tsQuery}&q={$tsQuery}{/if}{if $tsEngine}&e={$tsEngine}{/if}{if $tsCategory}&cat={$tsCategory}{/if}{if $tsAutor}&autor={$tsAutor}{/if}">Siguiente &raquo;</a></div>{/if}
            </div>
        </div>
        <div class="container170 floatR">
            <center>{$tsConfig.ads_160}</center>
        </div>
        <div class="clearBoth"></div>
            {/if}

        {else}
        <div id="buscadorBig">
        	<ul class="searchTabs">
        		<li class="here"><a href="">Posts</a></li>
        		<li class="clearfix"></li>
        	</ul>
        	<div class="clearBoth"></div>
        	<div class="searchCont">
        		<form action="" method="GET" name="buscador" style="padding: 0pt; margin: 0pt;">
        			<div class="searchFil">
        				<div style="margin-bottom: 5px;">
        					<div class="logoMotorSearch">
        						<img style="height: 16px; display: none;" alt="google-search-engine" src="http://www.google.com/images/poweredby_transparent/poweredby_FFFFFF.gif" id="buscador-logo-google"/>
        						<img alt="web-search-engine" src="{$tsConfig.default}/images/phpostmin.gif" id="buscador-logo-web"/>
        						<img style="display: none;" alt="tags-search-engine" src="{$tsConfig.default}/images/phpostmin.gif" id="buscador-logo-tags"/>
        					</div>
        
        					<label class="searchWith">
								<a href="javascript:buscador.select('google')" id="select_google">Google</a><span class="sep">|</span>
        						<a href="javascript:buscador.select('web')" id="select_web" class="here">{$tsConfig.titulo}</a><span class="sep">|</span>
        						<a href="javascript:buscador.select('tags')" id="select_tags">Tags</a>
        					</label>
        					<div class="clearfix"></div>
        				</div>
        				<div class="clearfix"></div>
        			
        				<div class="boxBox">
        					<div class="searchEngine">
        						<input type="text" value="" class="searchBar" size="25" name="q"/>
        						<input type="submit" title="Buscar" value="Buscar" class="mBtn btnOk"/>
                                <input type="hidden" name="e" value="web" />
          					<div class="clearfix"></div>
        					</div>
        					<!-- End Filter -->
        					<div class="filterSearch">
        					  <strong>Filtrar:</strong>
        						<div class="floatL">
        							<label>Categor&iacute;a</label>
        							<select style="width: 200px;" name="cat">
        								<option value="-1">Todas</option>
                                        {foreach from=$tsConfig.categorias item=c}
                                        <option value="{$c.cid}">{$c.c_nombre}</option>
                                        {/foreach}
        							</select>
        							<span id="filtro_autor">
        								<label>Usuario</label>
        								<input type="text" name="autor" value="{$tsAutor}"/>
        							</span>
        						</div>
        						<div class="clearfix"></div>
        					</div>
        					<!-- End SearchFill -->
        					<div class="clearfix"></div>
        					
        				</div>
        			  <div class="clearfix"></div>
        			</div>
        			<!-- End SearchFill -->
        		</form>
        	</div>
        </div>
        {/if}
        <div style="clear:both;"></div>                
{include file='sections/main_footer.tpl'}