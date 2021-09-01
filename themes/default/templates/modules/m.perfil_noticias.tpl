                    <div id="perfil_news" status="activo">
                    	<div class="title-w clearfix">
                            <h2>&Uacute;ltimas publicaciones de los usuarios a los que sigues</h2>
                        </div>
						<div class="widget clearfix" id="perfil-news">
                            
                            <div id="news-content">
                                {foreach from=$tsMuro.data item=p}
                                <div class="Story" id="pub_{$p.pub_id}">
                                    <a href="{$tsConfig.url}/perfil/{$p.user_name}" class="Story_Pic"><img alt="{$p.user_name}" src="{$tsConfig.url}/files/avatar/{$p.p_user_pub}_50.jpg"/></a>
                                    <div class="Story_Content">
                                        <div class="Story_Head">
                                            {if $p.p_user == $tsUser->uid || $p.p_user_pub == $tsUser->uid}<div class="Story_Hide"><a href="#" onclick="muro.del_pub({$p.pub_id},1); return false;" title="Eliminar la publicaci&oacute;n" class="qtip uiClose"></a></div>{/if}
                                            <div class="Story_Message">
                                                <div class="autor"><a href="{$tsConfig.url}/perfil/{$p.user_name}" class="a_blue">{$p.user_name}</a></div>
                                                <span>{$p.p_body|nl2br}</span>
                                                {if $p.p_type != 1}
                                                <div class="mvm clearfix">
                                                    {if $p.p_type == 2}
                                                    <a href="#" onclick="muro.load_atta('foto', '{$p.a_url}', this); return false" class="uiPhoto"><img src="{$p.a_img}"/></a>
                                                    {elseif $p.p_type == 3}
                                                    <div class="uiLink">
                                                        <div><a href="{$p.a_url}" target="_blank" class="a_blue"><strong>{$p.a_title}</strong></a></div>
                                                        <a href="{$p.a_url}" target="_blank" class="a_blue">{$p.a_url}</a>
                                                    </div>
                                                    {elseif $p.p_type == 4}
                                                    <a href="#" onclick="muro.load_atta('video','{$p.a_url}', this); return false;"class="uiVideoThumb">
                                                        <img src="http://img.youtube.com/vi/{$p.a_url}/1.jpg" width="130" height="97"/>
                                                        <i></i>
                                                    </a>
                                                    <div class="videoDesc">
                                                        <strong><a href="http://www.youtube.com/watch?v={$p.a_url}" target="_blank" class="a_blue">{$p.a_title}</a></strong>
                                                        <div style="margin-top:5px">
                                                        {$p.a_desc}
                                                        </div>
                                                    </div>
                                                    {/if}
                                                </div>
                                                {/if}
                                            </div>
                                        </div>
                                        <div class="Story_Foot">
                                            <div class="Story_Info">
                                                <i class="stream w_{if $p.p_type == 1 && $p.p_user == $p.p_user_pub}0{else}{$p.p_type}{/if}"></i>
                                                <span class="text">{$p.p_date|fecha}</span>
                                                &middot;
                                                <a href="#" onclick="muro.show_comment_box({$p.pub_id}); return false" class="a_blue">Comentar</a>
                                            </div>
                                            <ul id="cb_{$p.pub_id}" class="Story_Comments" {if $p.p_comments == 0}style="display:none"{/if}>
                                                <li class="lifi"><i></i></li>
                                                <li>
                                                   <ul id="cl_{$p.pub_id}" class="commentList">
                                                        {if $p.p_comments > 2}
                                                        <li class="ufiItem">
                                                            <div class="more_comments clearfix">
                                                                <i></i>
                                                                <a href="#" class="a_blue floatL" onclick="muro.more_comments({$p.pub_id}, this); return false">Ver los {$p.p_comments} comentarios</a>
                                                                <img width="16" height="11" src="http://static.ak.fbcdn.net/rsrc.php/yb/r/GsNJNwuI-UM.gif"/>
                                                            </div>
                                                        </li>
                                                        {/if}
                                                        {foreach from=$tsMuro.comments[$p.pub_id] item=c}
                                                        <li class="ufiItem" id="cmt_{$c.cid}">
                                                            <div class="clearfix">
                                                                <a href="{$tsConfig.url}/perfil/{$c.user_name}" class="autorPic"><img alt="{$c.user_name}" src="{$tsConfig.url}/files/avatar/{$c.c_user}_50.jpg" width="32" height="32"/></a>
                                                                {if $p.p_user == $tsUser->uid || $c.c_user == $tsUser->uid}<span class="close"><a href="#" onclick="muro.del_pub({$c.cid}, 2); return false" class="uiClose" title="Eliminar"></a></span>{/if}
                                                                <div class="mensaje">
                                                                    <a href="{$tsConfig.url}/perfil/{$c.user_name}" class="autorName a_blue">{$c.user_name}</a>
                                                                    <span>{$c.c_body|nl2br}</span>
                                                                    <div class="cmInfo">{$c.c_date|fecha}</div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        {/foreach}
                                                   </ul> 
                                                </li>{if $tsUser->is_member}
                                                <li class="ufiItem">
                                                    <div class="newComment">
                                                        <input type="text" title="Escribe un comentario...." name="hack" value="Escribe un comentario..." pid="{$p.pub_id}" />
                                                        <div class="formulario" style="display:none">
                                                            <img src="{$tsConfig.url}/files/avatar/{$tsUser->uid}_50.jpg" width="32" height="32"/>
                                                            <textarea class="comentar" title="Escribe un comentario..." id="cf_{$p.pub_id}" name="add_comment" onfocus="onfocus_input(this)" onblur="onblur_input(this)"></textarea>
                                                            <span class="floatR"><a href="#" onclick="muro.comentar({$p.pub_id}); return false;" class="btn_g">Comentar</a></span>
                                                            <div class="clearBoth"></div>
                                                        </div>
                                                    </div>
                                                </li>{/if}
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="clearBoth"></div>
                                </div>
                                {/foreach}
                            </div>
                            <!-- more -->
                            {if $tsMuro.total >= 10}
                            <div class="more-pubs">
                                <div class="content">
                                <a href="#" onclick="muro.stream.loadMore('news'); return false;" class="a_blue">Publicaciones m&aacute;s antiguas</a>
                                <span><img width="16" height="11" alt="" src="http://static.ak.fbcdn.net/rsrc.php/yb/r/GsNJNwuI-UM.gif"/></span>
                                </div>
                            </div>
                            {elseif $tsMuro.total == 0 && $tsUser->is_member}
                            <div class="emptyData">Este usuario no tiene comentarios, se el primero.</div>
                            {/if}
    		            </div>
                  </div>