                    <script type="text/javascript">
                        imagenes.total = {$tsImTotal-1};
                        imagenes.move = '-150px';
                    </script>
					<div id="lastFotos" class="wMod clearbeta">
                    	<div class="wMod-h">&Uacute;ltimas Fotos</div>
                        <div class="wMod-data" style="padding:0;text-align:center;position:relative;height:150px;overflow: hidden;">
                            <ul id="imContent" style="position:absolute;top:-150px;">
                            {foreach from=$tsImages.data item=im key=i}
                            <li id="img_{$i}">
                                <a href="{$tsConfig.url}/fotos/{$im.user_name}/{$im.foto_id}/{$im.f_title|seo}.html" title="{$im.f_caption}">
                                    <img src="{$im.f_url}" style="min-height:150px; max-height:150px; max-width:200px" align="absmiddle"/>
                                </a>
                            </li>
                            {/foreach}
                            </ul>
                        </div>
                    </div>