                        <div class="frameForm">
                            <ul class="options clearfix">
                                <li><span class="share">Compartir:</span></li>
                                <li>
                                    <ul class="atta">
                                        <li><span class="uiComposer">
                                            <i class="stream {if $tsInfo.uid == $tsUser->uid}status{else}mpub{/if}"></i>
                                            <a href="#" class="a_blue hidden" onclick="muro.stream.load('status', this); return false;" id="stMain">{if $tsInfo.uid == $tsUser->uid}Estado{else}Publicaci&oacute;n{/if}</a>
                                            <span>{if $tsInfo.uid == $tsUser->uid}Estado{else}Publicaci&oacute;n{/if}</span>
                                            <i class="nub"></i>
                                        </span></li>
                                        <li><span class="uiComposer">
                                            <i class="stream mfoto"></i>
                                            <a href="#" class="a_blue" onclick="muro.stream.load('foto', this); return false;">Foto</a>
                                            <span class="hidden">Foto</span>
                                            <i class="nub hidden"></i>
                                        </span></li>
                                        <li><span class="uiComposer">
                                            <i class="stream mlink"></i>
                                            <a href="#" class="a_blue" onclick="muro.stream.load('enlace', this); return false;">Enlace</a>
                                            <span class="hidden">Enlace</span>
                                            <i class="nub hidden"></i>
                                        </span></li>
                                        <li><span class="uiComposer">
                                            <i class="stream mvideo"></i>
                                            <a href="#" class="a_blue" onclick="muro.stream.load('video', this); return false;">Video</a>
                                            <span class="hidden">Video</span>
                                            <i class="nub hidden"></i>
                                        </span></li>
                                        <li class="streamLoader"><img width="16" height="11" alt="" src="http://static.ak.fbcdn.net/rsrc.php/yb/r/GsNJNwuI-UM.gif" class="img"/></li>
                                    </ul>
                                </li>
                            </ul>
                            <div class="attaFrame">
                                <div id="attaContent">
                                    <div id="statusFrame" style="padding:1px 5px; display:block">
                                        <textarea class="status autogrow" id="wall" onfocus="onfocus_input(this)" onblur="onblur_input(this)" title="{if $tsInfo.uid == $tsUser->uid}&iquest;Qu&eacute; est&aacute;s pensando?{else}Escribe algo....{/if}"></textarea>
                                    </div>
                                    <div id="fotoFrame">
                                        <input type="text" class="itext" name="ifoto" value="http://www.phpost.net/images/ejemplo.jpg" title="http://www.phpost.net/images/ejemplo.jpg" onfocus="onfocus_input(this)" onblur="onblur_input(this)"/>
                                        <a href="#" class="btn_g adj" onclick="muro.stream.adjuntar(); return false;">Adjuntar</a>
                                    </div>
                                    <div id="enlaceFrame">
                                        <input type="text" class="itext" name="ienlace" value="http://www.phpost.net/blog/ejemplo.html" title="http://www.phpost.net/blog/ejemplo.html" onfocus="onfocus_input(this)" onblur="onblur_input(this)"/>
                                        <a href="#" class="btn_g adj" onclick="muro.stream.adjuntar(); return false;">Adjuntar</a>
                                    </div>
                                    <div id="videoFrame">
                                        <input type="text" class="itext" name="ivideo" value="http://www.youtube.com/watch?v=f_30BAGNqqA" title="http://www.youtube.com/watch?v=f_30BAGNqqA" onfocus="onfocus_input(this)" onblur="onblur_input(this)"/>
                                        <a href="#" class="btn_g adj" onclick="muro.stream.adjuntar(); return false;">Adjuntar</a>
                                    </div>
                                </div>
                                <div class="attaDesc">
                                    <div class="wrap"><textarea class="status autogrow" id="attaDesc" onfocus="onfocus_input(this)" onblur="onblur_input(this)" title="Haz un comentario sobre esta foto..."></textarea></div>
                                    <input type="button" class="mBtn btnOk shareBtn" value="Compartir" onclick="muro.stream.compartir();" />
                                    <div class="clearBoth"></div>
                                </div>
                            </div>
                            <div class="btnStatus">
                                <input type="button" class="mBtn btnOk shareBtn" value="Compartir" onclick="muro.stream.compartir();" />
                                <div class="clearBoth"></div>
                            </div>
                        </div>