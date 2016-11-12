					<div id="search_box" class="new-search posts">
                    	<div class="bar-options">
                        	<ul class="clearfix">
								<li class="web-tab"><a>Google</a></li>
                       			<li class="posts-tab selected"><a>Posts</a></li>
                            </ul>
                        </div>
                        <div class="search-body clearfix">
                            <form action="{$tsConfig.url}/buscador/" name="search" gid="{$tsConfig.ads_search}">
                                <div class="input-search-left"></div>
                                <input type="text" autocomplete="off" value="Buscar" name="q" class="input-search-middle"/>
                                <input type="hidden" name="e" value="web" />
                                <div class="input-search-right"></div>
                                <a class="btn-search-home" href="javascript:$('form[name=search]').submit()"></a>
                                <label id="search-home-cat-filter" class="more-cats">
                                Categor&iacute;a: <select name="cat">
                                <option value="0">Todas</option>
                                {foreach from=$tsConfig.categorias item=c}
                                    <option value="{$c.cid}" {if $tsCategoria == '$c.c_seo'}selected="selected"{/if}>{$c.c_nombre}</option>
                                {/foreach}
                                </select>
                     			</label>
                            </form>
                        </div>
                        <a class="options" id="sh_options" onclick="$('#search-home-cat-filter').show(); return false">Opciones</a>
                    </div>
                    <div class="clearBoth"></div>