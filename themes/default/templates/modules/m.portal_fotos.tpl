                    <script type="text/javascript">
                        imagenes.total = {$tsImTotal-1};
                    </script>
					<div class="module">
                    	<div class="box_title">
                            <div class="box_txt fotos">&Uacute;ltimas Fotos</div>
                        </div>
                        <div class="box_cuerpo" style="padding:0;text-align:center;position:relative;height:250px;overflow: hidden;">
                            <ul id="imContent" style="position:absolute;top:-250px;">
                            {foreach from=$tsImages.data item=im key=i}
                            <li id="img_{$i}">
                                <a href="{$tsConfig.url}/fotos/{$im.user_name}/{$im.foto_id}/{$im.f_title|seo}.html" title="{$im.f_caption}">
                                    <img src="{$im.f_url}" style="min-height:250px; max-height:250px; max-width:298px" align="absmiddle"/>
                                </a>
                            </li>
                            {/foreach}
                            </ul>
                        </div>
                    </div>