{if $tsDo == 'search' && $tsPosts}
<div class="emptyData" style="padding:5px; margin:5px 0">Parece que existen posts similares al que quieres agregar, te recomendamos leerlos antes para evitar un repost.</div>
| {foreach from=$tsPosts item=p}
&bull; <a href="{$tsConfig.url}/posts/{$p.c_seo}/{$p.post_id}/{$p.post_title|seo}.html" target="_blank"><b>{$p.post_title}</b></a> &bull; | 
{/foreach}
{else}
{$tsTags}
{/if}