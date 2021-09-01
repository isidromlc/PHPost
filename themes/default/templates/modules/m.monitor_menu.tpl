                <div class="menu-tabs clearfix">
                    <ul>
                        <li{if $tsAction == 'seguidores'} class="selected"{/if}><a href="{$tsConfig.url}/monitor/seguidores">Seguidores</a></li>
                        <li{if $tsAction == 'siguiendo'} class="selected"{/if}><a href="{$tsConfig.url}/monitor/siguiendo">Siguiendo</a></li>
                        <li{if $tsAction == 'posts'} class="selected"{/if}><a href="{$tsConfig.url}/monitor/posts">Posts</a></li>
                    </ul>
                </div>