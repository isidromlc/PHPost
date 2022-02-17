{include file='sections/main_header.tpl'}
				<a name="cielo"></a>
                {if $tsPost.post_status > 0 || $tsAutor.user_activo != 1}
                    <div class="emptyData">Este post se encuentra {if $tsPost.post_status == 2}eliminado{elseif $tsPost.post_status == 1} inactivo por acomulaci&oacute;n de denuncias{elseif $tsPost.post_status == 3} en revisi&oacute;n{elseif $tsPost.post_status == 3} en revisi&oacute;n{elseif $tsAutor.user_activo != 1} oculto porque pertenece a una cuenta desactivada{/if}, t&uacute; puedes verlo porque {if $tsUser->is_admod == 1}eres Administrador{elseif $tsUser->is_admod == 2}eres Moderador{else}tienes permiso{/if}.</div><br />
                {/if}
				<div class="post-wrapper">
                	{include file='modules/m.posts_autor.tpl'}
                    {include file='modules/m.posts_content.tpl'}
                    <div class="floatR" style="width: 766px;">
                    	{include file='modules/m.posts_related.tpl'}
                        {include file='modules/m.posts_banner.tpl'}
                        <div class="clearfix"></div>
                    </div>
                    <a name="comentarios"></a>
                    {include file='modules/m.posts_comments.tpl'}
                    <a name="comentarios-abajo"></a>
                    <br />
                   	{if !$tsUser->is_member}
                    <div class="emptyData clearfix">
                    	Para poder comentar necesitas estar <a href="{$tsConfig.url}/registro/">Registrado.</a> O.. ya tienes usuario? <a onclick="open_login_box('open')" href="#">Logueate!</a>
                    </div>
                    {elseif $tsPost.block > 0}
                    <div class="emptyData clearfix">
                    	&iquest;Te has portado mal? {$tsPost.user_name} te ha bloqueado y no podr&aacute;s comentar sus post.
                    </div>
                    {/if}
                    <div style="text-align:center"><a class="irCielo" href="#cielo"><strong>Ir al cielo</strong></a></div>
                </div>
                <div style="clear:both"></div>
                
{include file='sections/main_footer.tpl'}