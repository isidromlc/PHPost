                    <form action="{$tsConfig.url}/buscador/" class="buscador-h" name="top_search_box" gid="{$tsConfig.ads_search}">
                        	<div class="search-in">
                    	    <a onclick="search_set(this, 'google')">Google</a> - <a class="search_active" onclick="search_set(this, 'web')">Posts</a>
                    	</div>
                        <div style="clear:both">
                            <img src="{$tsConfig.images}/mini_InputSleft_2.gif" class="mini_leftIbuscador"/>
                            <input type="text" id="ibuscadorq" name="q" onkeypress="ibuscador_intro(event)" onfocus="onfocus_input(this)" onblur="onblur_input(this)" value="Buscar" title="Buscar" class="mini_ibuscador onblur_effect">
                    	    <input vspace="2" hspace="10" type="submit" align="top" value="" alt="Buscar" title="Buscar" class="mini_bbuscador"/>
                        </div>
                        <input type="hidden" name="e" value="web" />
                    </form>
                    