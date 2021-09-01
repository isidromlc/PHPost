                <style>
                /*{literal}*/
                .fotos-detail li{
                    width:303px;
                }
                .fotos-detail .notification-info {
                    width:188px;
                }
                .paginadorCom{
                    width:100%!important;
                }
                /*{/literal}*/
                </style>
                <div id="album" style="width: 100%;">
                	<div class="title-w clearfix">
                        <h2>{if $tsFUser.0 == $tsUser->uid}Mis fotos{else}Fotos de {$tsFUser.1}{/if}</h2>
                    </div>
                    <ul class="fotos-detail listado-content">
                        {foreach from=$tsFotos.data item=f}
                    	<li>
                        	<div class="avatar-box" style="z-index: 99;">
                            	<a href="{$tsConfig.url}/fotos/{$f.user_name}/{$f.foto_id}/{$f.f_title|seo}.html">
                            		<img height="100" width="100" src="{$f.f_url}"/>
                                </a>
                            </div>
                            <div class="notification-info">
                            	<span>
                                    <a href="{$tsConfig.url}/fotos/{$f.user_name}/{$f.foto_id}/{$f.f_title|seo}.html">{$f.f_title}</a><br /> 
                            		<span title="{$f.f_date|date_format:"%d.%m.%y a las %H:%M hs."}" class="time"><strong>{$f.f_date|date_format:"%d.%m.%Y"}</strong> - Por <a href="{$tsConfig.url}/perfil/{$f.user_name}">{$f.user_name}</a></span><hr />
                                    <span class="time">{$f.f_description|truncate:100}</span>
                                </span>
                            </div>
                        </li>
                        {/foreach}
                    </ul>
                </div>
                <div class="paginadorCom">
                    {if $tsFotos.pages.prev}<div style="display:block;margin: 5px 0; width: 110px;text-align:left" class="floatL before"><a href="{$tsConfig.url}/fotos/{$tsFUser.1}/{$tsFotos.pages.prev}">&laquo; Anterior</a></div>{/if}
                    {if $tsFotos.pages.next}<div style="display:block;margin: 5px 0; width: 110px;text-align:right" class="floatR next"><a href="{$tsConfig.url}/fotos/{$tsFUser.1}/{$tsFotos.pages.next}">Siguiente &raquo;</a></div>{/if}
                </div>