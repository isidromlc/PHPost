            {if ($tsPage == 'home' || $tsPage == 'portal') && $tsConfig.news}
            <div id="mensaje-top">
                <ul id="top_news" class="msgtxt">
                    {foreach from=$tsConfig.news key=i item=n}
                    <li id="new_{$i+1}">{$n.not_body}</li>
                    {/foreach}
                </ul>
            </div>
            {/if}