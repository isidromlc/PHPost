				               {literal}
                                <style>
                                    #emoticons span{
                                        float:left;
                                    }
                                </style>
                                {/literal}
								<div style="float:{if $tsPage == 'posts'}right{else}left{/if}" id="emoticons">
									<a smile=":)" href="#"><img src="{$tsConfig.default}/images/smiles/001.png"/></a>
                                    <a smile=":D" href="#"><img src="{$tsConfig.default}/images/smiles/002.png"/></a>
									<a smile=";)" href="#"><img src="{$tsConfig.default}/images/smiles/003.gif"/></a>
                                    <a smile=":O" href="#"><img src="{$tsConfig.default}/images/smiles/004.png"/></a>
                                    <a smile="(H)" href="#"><img src="{$tsConfig.default}/images/smiles/006.png"/></a>
                                    <a smile=":P" href="#"><img src="{$tsConfig.default}/images/smiles/104.png"/></a>
                                    <a smile="8o|" href="#"><img src="{$tsConfig.default}/images/smiles/049.png"/></a>
                                    <a smile=":S" href="#"><img src="{$tsConfig.default}/images/smiles/009.png"/></a>
                                    <a smile=":$" href="#"><img src="{$tsConfig.default}/images/smiles/008.png"/></a>
                                    <a smile=":(" href="#"><img src="{$tsConfig.default}/images/smiles/010.png"/></a>
                                    <a smile=":'(" href="#"><img src="{$tsConfig.default}/images/smiles/011.gif"/></a>
                                    <a smile=":|" href="#"><img src="{$tsConfig.default}/images/smiles/012.png"/></a>
                                    <a smile="(6)" href="#"><img src="{$tsConfig.default}/images/smiles/013.png"/></a>
                                    <a smile="8-|" href="#"><img src="{$tsConfig.default}/images/smiles/050.png"/></a>
                                    <a smile=":-/" href="#"><img src="{$tsConfig.default}/images/smiles/083.png"/></a>
									<a smile="^o)" href="#"><img src="{$tsConfig.default}/images/smiles/051.png"/></span></a>
								</div>
                                {if $tsPage != 'posts'}<a href="#" onclick="moreEmoticons(); return false;" class="floatR" id="moreemofn">M&aacute;s emoticones</a>{/if}
                                <div class="clearBoth">&nbsp;</div>