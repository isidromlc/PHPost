{include file='sections/main_header.tpl'}
				<script type="text/javascript" src="{$tsConfig.default}/js/perfil.js"></script>
                <script type="text/javascript" src="{$tsConfig.default}/js/portal.js"></script>
                <div id="left_box">
                    {include file='modules/m.portal_userbox.tpl'}
                    <br class="spacer"/>
                    {include file='modules/m.global_ads_160.tpl'}
                </div>
                <div id="center_box">
                    <div id="portal">
                        <div class="tabs_menu box_title">
                            <ul id="tabs_menu">
                                <li class="selected"><a onclick="portal.load_tab('news', this); return false" class="news">Noticias</a></li>
                                <li><a onclick="portal.load_tab('activity', this); return false;" class="activity">Actividad</a></li>
                                <li><a onclick="portal.load_tab('posts', this); return false;" class="posts">Posts</a></li>
                                <li><a onclick="portal.load_tab('favs', this); return false;" class="favs">Favoritos</a></li>
                            </ul>
                            <div class="clearBoth"></div>
                        </div>
                        <div id="portal_content">
                            {include file='modules/m.portal_noticias.tpl'}
                            {include file='modules/m.portal_activity.tpl'}
                            {include file='modules/m.portal_posts.tpl'}
                            {include file='modules/m.portal_posts_favoritos.tpl'}
                        </div>
                    </div>
                </div>
                <div id="right_box">
                    <br />
                    {include file='modules/m.home_stats.tpl'}
                    {include file='modules/m.portal_posts_visitados.tpl'}
                    {include file='modules/m.portal_fotos.tpl'}
                    {include file='modules/m.portal_afiliados.tpl'}
                    <!--Poner aqui mas modulos-->
                </div>
                <div style="clear:both"></div>

{include file='sections/main_footer.tpl'}