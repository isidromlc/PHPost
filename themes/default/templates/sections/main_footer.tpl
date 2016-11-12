		<!--end-cuerpo-->
		</div>
        <div id="pie">
        <a href="{$tsConfig.url}/pages/ayuda/">Ayuda</a> -
        <a href="{$tsConfig.url}/pages/chat/">Chat</a> -
        <a href="{$tsConfig.url}/pages/contacto/">Contacto</a> -  
        <a href="{$tsConfig.url}/pages/protocolo/">Protocolo</a>
        <br/>
        <a href="{$tsConfig.url}/pages/terminos-y-condiciones/">T&eacute;rminos y condiciones</a> - 
        <a href="{$tsConfig.url}/pages/privacidad/">Privacidad de datos</a> -
        <a href="{$tsConfig.url}/pages/dmca/">Report Abuse - DMCA</a>
        </div>
        </div>
        <!--END CONTAINER-->
    </div>
    <div class="rbott"></div>
    {* El siguiente contenedor sirve para validar el Copyright *}
    {* El ID del div NO debe ser alterado de lo contrario nuestro validador *}
    {* tomará al sitio como una web sin copyright *}
    <div id="pp_copyright" style="display: block!important; opacity: 1!important;">
        <a href="{$tsConfig.url}"><strong>{$tsConfig.titulo}</strong></a> &copy; {$smarty.now|date_format:"%Y"} - Powered by <a href="http://www.phpost.net/" target="_blank"><strong>PHPost</strong></a>
    </div>
</div>
</body>
</html>