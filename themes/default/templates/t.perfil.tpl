{include file='sections/main_header.tpl'}
                <script type="text/javascript" src="{$tsConfig.default}/js/perfil.js"></script>
				{include file='modules/m.perfil_headinfo.tpl'}
                <div class="perfil-main clearfix {$tsGeneral.stats.user_rango.1}">
                	<div class="perfil-content general">
                        <div id="info" pid="{$tsInfo.uid}"></div>
                        <div id="perfil_content">
                        {if $tsPrivacidad.m.v == false}
                        <div id="perfil_wall" status="activo" class="widget">
                            <div class="emptyData">{$tsPrivacidad.m.m}</div>
                            <script type="text/javascript">
                                perfil.load_tab('info', $('#informacion'));
                            </script>
                        </div>
                        {elseif $tsType == 'story'}
                        {include file='modules/m.perfil_story.tpl'}
                        {elseif $tsType == 'news'}
                        {include file='modules/m.perfil_noticias.tpl'}
                        {else}
	                	{include file='modules/m.perfil_muro.tpl'}
                        {/if}
                        </div>
                        <div style="width:100%;text-align:center;display:none" id="perfil_load"><img src="{$tsConfig.images}/fb-loading.gif" /></div>
                    </div>
                    <div class="perfil-sidebar">
                        {include file='modules/m.perfil_sidebar.tpl'}
                    </div>
                </div>
                
{include file='sections/main_footer.tpl'}