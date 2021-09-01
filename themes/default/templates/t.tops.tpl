{include file='sections/main_header.tpl'}

				{include file='modules/m.top_sidebar.tpl'}
                {if $tsAction == 'posts'}
				{include file='modules/m.top_posts.tpl'}
                {elseif $tsAction == 'usuarios'}
                {include file='modules/m.top_users.tpl'}
                {/if}
                <div style="clear: both;"></div>
                
{include file='sections/main_footer.tpl'}