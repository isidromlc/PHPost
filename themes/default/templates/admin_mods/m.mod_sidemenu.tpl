                                    <script type="text/javascript">
										var action_menu = '{$tsAction}';
										//{literal} <-- no borrar
										$(function(){
											if(action_menu != '') $('#a_' + action_menu).addClass('active');
											else $('#a_main').addClass('active');
										});
                                        // {/literal}
									</script>
                                    <h4>Principal</h4>
                                    <ul class="cat-list">
                                        <li id="a_main"><span class="cat-title"><a href="{$tsConfig.url}/moderacion/">Centro de Moderaci&oacute;n</a></span></li>
                                    </ul>
                                    <h4>Denuncias</h4>
                                    <ul class="cat-list">
                                        <li id="a_posts"><span class="cat-title"><a onclick="$('#a_posts').addClass('active');" href="{$tsConfig.url}/moderacion/posts">Post <span class="cadGe cadGe_{if $tsConfig.novemods.repposts > 15}red{elseif $tsConfig.novemods.repposts > 5}purple{else}green{/if}">{$tsConfig.novemods.repposts}</span></a></span></li>
                                        <li id="a_fotos"><span class="cat-title"><a onclick="$('#a_fotos').addClass('active');" href="{$tsConfig.url}/moderacion/fotos">Fotos <span class="cadGe cadGe_{if $tsConfig.novemods.repfotos > 15}red{elseif $tsConfig.novemods.repfotos > 5}purple{else}green{/if}">{$tsConfig.novemods.repfotos}</span></a></span></li>
										<li id="a_mps"><span class="cat-title"><a onclick="$('#a_mps').addClass('active');" href="{$tsConfig.url}/moderacion/mps">Mensajes  <span class="cadGe cadGe_{if $tsConfig.novemods.repmps > 15}red{elseif $tsConfig.novemods.repmps > 5}purple{else}green{/if}">{$tsConfig.novemods.repmps}</span></a></span></li>
                                        <li id="a_users"><span class="cat-title"><a onclick="$('#a_users').addClass('active');" href="{$tsConfig.url}/moderacion/users">Usuarios <span class="cadGe cadGe_{if $tsConfig.novemods.repusers > 15}red{elseif $tsConfig.novemods.repusers > 5}purple{else}green{/if}">{$tsConfig.novemods.repusers}</span></a></span></li>
                                        </ul>
									{if $tsUser->is_admod || $tsUser->permisos.movub || $tsUser->permisos.moub}
									<h4>Gesti&oacute;n</h4>
                                    <ul class="cat-list">
										{if $tsUser->is_admod || $tsUser->permisos.movub}<li id="a_banusers"><span class="cat-title"><a onclick="$('#a_banusers').addClass('active');" href="{$tsConfig.url}/moderacion/banusers">Usuarios suspendidos <span class="cadGe cadGe_{if $tsConfig.novemods.supusers > 15}red{elseif $tsConfig.novemods.suspusers > 5}purple{else}green{/if}">{$tsConfig.novemods.suspusers}</span></a></span></li>{/if}
                                        {if $tsUser->is_admod || $tsUser->permisos.moub}<li id="a_buscador"><span class="cat-title"><a onclick="$('#a_buscador').addClass('active');" href="{$tsConfig.url}/moderacion/buscador">Buscador de Contenido</a></span></li>{/if}
									</ul>
									{/if}
									{if $tsUser->is_admod || $tsUser->permisos.morp || $tsUser->permisos.morf}
									<h4>Papelera de Reciclaje</h4>
                                    <ul class="cat-list">
                                        {if $tsUser->is_admod || $tsUser->permisos.morp}<li id="a_pospelera"><span class="cat-title"><a onclick="$('#a_pospelera').addClass('active');" href="{$tsConfig.url}/moderacion/pospelera">Post eliminados <span class="cadGe cadGe_{if $tsConfig.novemods.pospelera > 15}red{elseif $tsConfig.novemods.pospelera > 5}purple{else}green{/if}">{$tsConfig.novemods.pospelera}</span></a></span></li>{/if}
                                        {if $tsUser->is_admod || $tsUser->permisos.morf}<li id="a_fopelera"><span class="cat-title"><a onclick="$('#a_fopelera').addClass('active');" href="{$tsConfig.url}/moderacion/fopelera">Fotos eliminadas <span class="cadGe cadGe_{if $tsConfig.novemods.fospelera > 15}red{elseif $tsConfig.novemods.fospelera > 5}purple{else}green{/if}">{$tsConfig.novemods.fospelera}</span></a></span></li>{/if}
									</ul>
									{/if}
									{if $tsUser->is_admod || $tsUser->permisos.mocp || $tsUser->permisos.mocc}
									<h4>Contenido desaprobado</h4>
                                    <ul class="cat-list">
                                        {if $tsUser->is_admod || $tsUser->permisos.mocp}<li id="a_revposts"><span class="cat-title"><a onclick="$('#a_revposts').addClass('active');" href="{$tsConfig.url}/moderacion/revposts">Posts <span class="cadGe cadGe_{if $tsConfig.novemods.revposts > 15}red{elseif $tsConfig.novemods.revposts > 5}purple{else}green{/if}">{$tsConfig.novemods.revposts}</span></a></span></li>{/if}
                                        {if $tsUser->is_admod || $tsUser->permisos.mocc}<li id="a_comentarios"><span class="cat-title"><a onclick="$('#a_comentarios').addClass('active');" href="{$tsConfig.url}/moderacion/comentarios">Comentarios <span class="cadGe cadGe_{if $tsConfig.novemods.revcomentarios > 15}red{elseif $tsConfig.novemods.revcomentarios > 5}purple{else}green{/if}">{$tsConfig.novemods.revcomentarios}</span></a></span></li>{/if}
									</ul>
									{/if}