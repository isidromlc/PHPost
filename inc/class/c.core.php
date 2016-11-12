<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Funciones globales
 *
 * @name    c.core.php
 * @author  PHPost Team
 */
class tsCore {
    
	var $settings;		// CONFIGURACIONES DEL SITIO
	var $querys = 0;	// CONSULTAS
    
	// INSTANCIA DE LA CLASE
	public static function &getInstance(){
		static $instance;
		
		if( is_null($instance) ){
			$instance = new tsCore();
    	}
		return $instance;
	}

	function tsCore()
    {
		// CARGANDO CONFIGURACIONES
		$this->settings = $this->getSettings();
		$this->settings['domain'] = str_replace('http://','',$this->settings['url']);
		$this->settings['categorias'] = $this->getCategorias();
        $this->settings['default'] = $this->settings['url'].'/themes/default';
		$this->settings['tema'] = $this->getTema();
		$this->settings['images'] = $this->settings['tema']['t_url'].'/images';
        $this->settings['css'] = $this->settings['tema']['t_url'].'/css';
		$this->settings['js'] = $this->settings['tema']['t_url'].'/js';
        //
        if($_GET['do'] == 'portal' || $_GET['do'] == 'posts') $this->settings['news'] = $this->getNews();
		# Mensaje del instalador y pendientes de moderación #
		$this->settings['install'] = $this->existinstall();
		$this->settings['novemods'] = $this->getNovemods();
	}
	
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	
	/*
		getSettings() :: CARGA DESDE LA DB LAS CONFIGURACIONES DEL SITIO
	*/
	function getSettings()
    {
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT * FROM w_configuracion');
		return db_exec('fetch_assoc', $query);
	}
	
	function getNovemods()
    {
        $datos = db_exec('fetch_assoc', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT (SELECT count(post_id) FROM p_posts WHERE post_status = \'3\') as revposts, (SELECT count(cid) FROM p_comentarios WHERE c_status = \'1\' ) as revcomentarios, (SELECT count(DISTINCT obj_id) FROM w_denuncias WHERE d_type = \'1\') as repposts, (SELECT count(DISTINCT obj_id) FROM w_denuncias WHERE d_type = \'2\') as repmps, (SELECT count(DISTINCT obj_id) FROM w_denuncias WHERE d_type = \'3\') as repusers, (SELECT count(DISTINCT obj_id) FROM w_denuncias  WHERE d_type = \'4\') as repfotos, (SELECT count(susp_id) FROM u_suspension) as suspusers, (SELECT count(post_id) FROM p_posts WHERE post_status = \'2\') as pospelera, (SELECT count(foto_id) FROM f_fotos WHERE f_status = \'2\') as fospelera'));
		$datos['total'] = $datos['repposts'] + $datos['repfotos'] + $datos['repmps'] + $datos['repusers'] + $datos['revposts'] + $datos['revcomentarios'];
		return $datos;  
	}
	/*
		getCategorias()
	*/
	function getCategorias()
    {
		// CONSULTA
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT cid, c_orden, c_nombre, c_seo, c_img FROM p_categorias ORDER BY c_orden');
		// GUARDAMOS
		$categorias = result_array($query);
        //
        return $categorias;
	}
	/*
		getTema()
	*/
	function getTema()
    {
		//
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT * FROM w_temas WHERE tid = '.$this->settings['tema_id'].' LIMIT 1');
		//
		$data = db_exec('fetch_assoc', $query);
        $data['t_url'] = $this->settings['url'] . '/themes/' . $data['t_path'];
		//
		return $data;
	}
	/*
        getNews()
    */
    function getNews()
    {
        //
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT not_body FROM w_noticias WHERE not_active = \'1\' ORDER by RAND()');
		while($row = db_exec('fetch_assoc', $query)){
		  $row['not_body'] = $this->parseBBCode($row['not_body'],'news');
          $data[] = $row;
		}
        //
        return $data;
    }
	
	//COMPROBACIONES DE LA EXISTENCIA DEL INSTALADOR O ACTUALIZADOR
	
	function existinstall() 
    {
		$install_dir = TS_ROOT . '/install/';
		$upgrade_dir = TS_ROOT . '/upgrade/';
		if(is_dir($install_dir)) return '<div id="msg_install">Por favor, elimine la carpeta <b>install</b></div>';		
		if(is_dir($upgrade_dir)) return '<div id="msg_install">Por favor, elimine la carpeta <b>upgrade</b></div>';
	}
    
    // FUNCIÓN CONCRETA PARA CENSURAR
	
	function parseBadWords($c, $s = FALSE) 
    {
        $q = result_array(db_exec(array(__FILE__, __LINE__), 'query', 'SELECT word, swop, method, type FROM w_badwords '.($s == true ? '' : ' WHERE type = \'0\'')));
        
        foreach($q AS $badword) 
        {
        $c = str_ireplace((empty($badword['method']) ? $badword['word'] : $badword['word'].' '),($badword['type'] == 1 ? '<img class="qtip" title="'.$badword['word'].'" src="'.$badword['swop'].'" align="absmiddle"/>' : $badword['swop'].' '),$c);
        }
        return $c;
	}        
	
	/*
		setLevel($tsLevel) :: ESTABLECE EL NIVEL DE LA PAGINA | MIEMBROS o VISITANTES
	*/
	function setLevel($tsLevel, $msg = false){
		global $tsUser;
		
		// CUALQUIERA
		if($tsLevel == 0) return true;
		// SOLO VISITANTES
		elseif($tsLevel == 1) {
			if($tsUser->is_member == 0) return true;
			else {
				if($msg) $mensaje = 'Esta pagina solo es vista por los visitantes.';
				else $this->redirect('/');
			}
		}
		// SOLO MIEMBROS
		elseif($tsLevel == 2){
			if($tsUser->is_member == 1) return true;
			else {
				if($msg) $mensaje = 'Para poder ver esta pagina debes iniciar sesi&oacute;n.';
				else $this->redirect('/login/?r='.$this->currentUrl());
			}
		}
		// SOLO MODERADORES
		elseif($tsLevel == 3){
			if($tsUser->is_admod || $tsUser->permisos['moacp']) return true;
			else {
				if($msg) $mensaje = 'Estas en un area restringida solo para moderadores.';
				else $this->redirect('/login/?r='.$this->currentUrl());
			}
		}
		// SOLO ADMIN
		elseif($tsLevel == 4) {
			if($tsUser->is_admod == 1) return true;
			else {
				if($msg) $mensaje = 'Estas intentando algo no permitido.';
				else $this->redirect('/login/?r='.$this->currentUrl());
			}
		}
		//
		return array('titulo' => 'Error', 'mensaje' => $mensaje);
	}

	/*
		redirect($tsDir)
	*/
	function redirectTo($tsDir){
		$tsDir = urldecode($tsDir);
		header("Location: $tsDir");
		exit();
	}
    /*
        getDomain()
    */
    function getDomain(){
        $domain = explode('/',str_replace('http://','',$this->settings['url']));
        if(is_array($domain)) {
        $domain = explode('.',$domain[0]);
        } else $domain = explode('.',$domain);
        //
        $t = count($domain);
        $domain = $domain[$t - 2].'.'.$domain[$t - 1];
        //
        return $domain;
    }
	/*
		currentUrl()
	*/
	function currentUrl(){
		$current_url_domain = $_SERVER['HTTP_HOST'];
		$current_url_path = $_SERVER['REQUEST_URI'];
		$current_url_querystring = $_SERVER['QUERY_STRING'];
		$current_url = "http://".$current_url_domain.$current_url_path;
		$current_url = urlencode($current_url);
		return $current_url;
	}
	/*
		setJSON($tsContent)
	*/
	function setJSON($data, $type = 'encode'){
		require_once(TS_EXTRA . 'JSON.php');	// INCLUIMOS LA CLASE
		$json = new Services_JSON;	// CREAMOS EL SERVICIO
        if($type == 'encode') return $json->encode($data);
        elseif($type == 'decode') return $json->decode($data);            
	}
	/*
		setPagesLimit($tsPages, $start = false)
	*/
	function setPageLimit($tsLimit, $start = false, $tsMax = 0){
		if($start == false)
		$tsStart = empty($_GET['page']) ? 0 : (int) (($_GET['page'] - 1) * $tsLimit);
		else {
    		$tsStart = (int) $_GET['s'];
            $continue = $this->setMaximos($tsLimit, $tsMax);
            if($continue == true) $tsStart = 0;
        }
		//
		return $tsStart.','.$tsLimit;
	}
    /*
        setMaximos()
        :: MAXIMOS EN LAS PAGINAS
    */
    function setMaximos($tsLimit, $tsMax){
        // MAXIMOS || PARA NO EXEDER EL NUMERO DE PAGINAS
        $ban1 = ($_GET['page'] * $tsLimit);
        if($tsMax < $ban1){
            $ban2 = $ban1 - $tsLimit;
            if($tsMax < $ban2) return true;
        } 
        //
        return false;
    }
	/*
		getPages($tsTotal, $tsLimit)
		: PAGINACION
	*/
	function getPages($tsTotal, $tsLimit){
		//
		$tsPages = ceil($tsTotal / $tsLimit);
		// PAGINA
		$tsPage = empty($_GET['page']) ? 1 : $_GET['page'];
		// ARRAY
		$pages['current'] = $tsPage;
		$pages['pages'] = $tsPages;
		$pages['section'] = $tsPages + 1;
		$pages['prev'] = $tsPage - 1;
		$pages['next'] = $tsPage + 1;
        $pages['max'] = $this->setMaximos($tsLimit, $tsTotal);
		// RETORNAMOS HTML
		return $pages;
	}
    /*
        getPagination($total, $per_page)
    */
    function getPagination($total, $per_page = 10){
        // PAGINA ACTUAL
        $page = empty($_GET['page']) ? 1 : (int) $_GET['page'];
        // NUMERO DE PAGINAS
        $num_pages = ceil($total / $per_page);
        // ANTERIOR
        $prev = $page - 1;
        $pages['prev'] = ($page > 0) ? $prev : 0;
        // SIGUIENTE 
        $next = $page + 1;
        $pages['next'] = ($next <= $num_pages) ? $next : 0;
        // LIMITE DB
        $pages['limit'] = (($page - 1) * $per_page).','.$per_page; 
        // TOTAL
        $pages['total'] = $total;
        //
        return $pages;
    }
    /**/
	// Constructs a page list.
	// $pageindex = constructPageIndex($scripturl . '?board=' . $board, $_REQUEST['start'], $num_messages, $maxindex, true);
	function pageIndex($base_url, &$start, $max_value, $num_per_page, $flexible_start = false){
        // QUITAR EL S de la base_url
        $base_url = explode('&s=',$base_url);
        $base_url = $base_url[0];
		// Save whether $start was less than 0 or not.
		$start_invalid = $start < 0;
	
		// Make sure $start is a proper variable - not less than 0.
		if ($start_invalid)
			$start = 0;
		// Not greater than the upper bound.
		elseif ($start >= $max_value)
			$start = max(0, (int) $max_value - (((int) $max_value % (int) $num_per_page) == 0 ? $num_per_page : ((int) $max_value % (int) $num_per_page)));
		// And it has to be a multiple of $num_per_page!
		else
			$start = max(0, (int) $start - ((int) $start % (int) $num_per_page));
	
		$base_link = '<a class="navPages" href="' . ($flexible_start ? $base_url : strtr($base_url, array('%' => '%%')) . '&s=%d') . '">%s</a> ';
	
			// If they didn't enter an odd value, pretend they did.
			$PageContiguous = (int) (5 - (5 % 2)) / 2;
	
			// Show the first page. (>1< ... 6 7 [8] 9 10 ... 15)
			if ($start > $num_per_page * $PageContiguous)
				$pageindex = sprintf($base_link, 0, '1');
			else
				$pageindex = '';
	
			// Show the ... after the first page.  (1 >...< 6 7 [8] 9 10 ... 15)
			if ($start > $num_per_page * ($PageContiguous + 1))
				$pageindex .= '<b> ... </b>';
	
			// Show the pages before the current one. (1 ... >6 7< [8] 9 10 ... 15)
			for ($nCont = $PageContiguous; $nCont >= 1; $nCont--)
				if ($start >= $num_per_page * $nCont)
				{
					$tmpStart = $start - $num_per_page * $nCont;
					$pageindex.= sprintf($base_link, $tmpStart, $tmpStart / $num_per_page + 1);
				}
	
			// Show the current page. (1 ... 6 7 >[8]< 9 10 ... 15)
			if (!$start_invalid)
				$pageindex .= '[<b>' . ($start / $num_per_page + 1) . '</b>] ';
			else
				$pageindex .= sprintf($base_link, $start, $start / $num_per_page + 1);
	
			// Show the pages after the current one... (1 ... 6 7 [8] >9 10< ... 15)
			$tmpMaxPages = (int) (($max_value - 1) / $num_per_page) * $num_per_page;
			for ($nCont = 1; $nCont <= $PageContiguous; $nCont++)
				if ($start + $num_per_page * $nCont <= $tmpMaxPages)
				{
					$tmpStart = $start + $num_per_page * $nCont;
					$pageindex .= sprintf($base_link, $tmpStart, $tmpStart / $num_per_page + 1);
				}
	
			// Show the '...' part near the end. (1 ... 6 7 [8] 9 10 >...< 15)
			if ($start + $num_per_page * ($PageContiguous + 1) < $tmpMaxPages)
				$pageindex .= '<b> ... </b>';
	
			// Show the last number in the list. (1 ... 6 7 [8] 9 10 ... >15<)
			if ($start + $num_per_page * $PageContiguous < $tmpMaxPages)
				$pageindex .= sprintf($base_link, $tmpMaxPages, $tmpMaxPages / $num_per_page + 1);
	
		return $pageindex;
	}
	/*
		setSecure()
	*/
	public function setSecure($var, $xss = FALSE)
    {
        $var = db_exec('real_escape_string', function_exists('magic_quotes_gpc') ? stripslashes($var) : $var);
        /**
        if ($xss)
        {
        $var = htmlspecialchars($var, ENT_NOQUOTES,'UTF-8');
        }*/
     return $var;
    }
	
    /*
        antiFlood()
    */
    public function antiFlood($print = true, $type = 'post', $msg = '')
    {
        global $tsUser;
        //
        $now = time();
        $msg = empty($msg) ? 'No puedes realizar tantas acciones en tan poco tiempo.' : $msg;
        //
        $limit = $tsUser->permisos['goaf'];
        $resta = $now - $_SESSION['flood'][$type];
        if($resta < $limit) {
            $msg = '0: '.$msg.' Int&eacute;ntalo en '.($limit - $resta).' segundos.';
            // TERMINAR O RETORNAR VALOR
            if($print) die($msg);
            else return $msg;
        }
        else {
            // ANTIFLOOD
            if(empty($_SESSION['flood'][$type])) {
                $_SESSION['flood'][$type] = time();
            } else $_SESSION['flood'][$type] = $now;
            // TODO BIEN
            return true;
        }
    }
	
	/*
		setSEO($string, $max) $max : MAXIMA CONVERSION
		: URL AMIGABLES
	*/
	function setSEO($string, $max = false) {
		// ESPAÑOL
		$espanol = array('á','é','í','ó','ú','ñ');
		$ingles = array('a','e','i','o','u','n');
		// MINUS
		$string = str_replace($espanol,$ingles,$string);
		$string = trim($string);
		$string = trim(preg_replace('/[^ A-Za-z0-9_]/', '-', $string));
		$string = preg_replace('/[ \t\n\r]+/', '-', $string);
		$string = str_replace(' ', '-', $string);
		$string = preg_replace('/[ -]+/', '-', $string);
		//
		if($max) {
			$string = str_replace('-','',$string);
			$string = strtolower($string);
		}
		//
		return $string;
	}
	/*
		parseBBCode($bbcode)
	*/
	function parseBBCode($bbcode, $type = 'normal') {
        // Class BBCode
        include_once(TS_EXTRA . 'bbcode.inc.php');
        $parser =& BBCode::getInstance();
        
        // Seleccionar texto
        $parser->setText($bbcode);

        // Seleccionar tipo
        switch ($type) {
            // NORMAL
            case 'normal':
                // BBCodes permitidos
                $parser->setRestriction(array('url', 'code', 'quote', 'font', 'size', 'color', 'img', 'b', 'i', 'u', 's', 'align', 'spoiler', 'swf', 'video', 'goear', 'hr', 'sub', 'sup', 'table', 'td', 'tr', 'ul', 'li', 'ol', 'notice', 'info', 'warning', 'error', 'success'));
                // SMILES
                $parser->parseSmiles();
                // MENCIONES
                $parser->parseMentions();
                break;
            // FIRMA
            case 'firma':
                // BBCodes permitidos
                $parser->setRestriction(array('url', 'font', 'size', 'color', 'img', 'b', 'i', 'u', 's', 'align', 'spoiler'));
                break;
            // NOTICIAS
            case 'news':
                // BBCodes permitidos
                $parser->setRestriction(array('url', 'b', 'i', 'u', 's'));
                // SMILES
                $parser->parseSmiles();
                break;
            // SOLO SMILES (Esta opción se mantiene por compatibilidad con versiones anteriores, pero en su lugar se recomienda utilizar la opción "normal")
            case 'smiles':
                $parser->setRestriction(array('url', 'code', 'quote', 'quotePHPost', 'font', 'size', 'color', 'img', 'b', 'i', 'u', 'align', 'spoiler', 'swf', 'goear', 'hr', 'li'));
                // SMILES
                $parser->parseSmiles();
                // MENCIONES
                $parser->parseMentions();
            break;
        }
        // Retornar resultado HTML
        return $parser->getAsHtml();
    }
    /**
     * @name setMenciones
     * @access public
     * @param string
     * @return string
     * @info PONE LOS LINKS A LOS MENCIONADOS
     * @note Esta función se ha reemplazado por $parser->parseMentions(). Se reomienda exclusivamente para compatibilidad en versiones anteriores.
     */
    public function setMenciones($html){
        # GLOBALES
        global $tsUser;
        # HACK
        $html = $html.' ';
        # BUSCAMOS A USUARIOS
        preg_match_all('/\B@([a-zA-Z0-9_-]{4,16}+)\b/',$html, $users);
        $menciones = $users[1];
        # VEMOS CUALES EXISTEN
        foreach($menciones as $key => $user){
            $uid = $tsUser->getUserID($user);
            if(!empty($uid)) {
                $find = '@'.$user.' ';
                $replace = '@<a href="'.$this->settings['url'].'/perfil/'.$user.'" class="hovercard" uid="'.$uid.'">'.$user.'</a> ';
                $html = str_replace($find, $replace, $html);
            }
        }
        # RETORNAMOS
        return $html;
    }
    /*
        parseSmiles($st)
    */
    public function parseSmiles($bbcode){
        return $this->parseBBCode($bbcode, 'smiles');
    }
	/*
		parseBBCodeFirma($bbcode)
	*/
	function parseBBCodeFirma($bbcode){
	   return $this->parseBBCode($bbcode, 'firma');
	}
	/*
		setHace()
	*/
	function setHace($fecha, $show = false){
		$fecha = $fecha; 
		$ahora = time();
		$tiempo = $ahora-$fecha; 
		if($fecha <= 0){
			return 'Nunca';
		}
		elseif(round($tiempo / 31536000) <= 0){ 
			if(round($tiempo / 2678400) <= 0){ 
				 if(round($tiempo / 86400) <= 0){ 
					 if(round($tiempo / 3600) <= 0){ 
						if(round($tiempo / 60) <= 0){ 
							if($tiempo <= 60){ $hace = 'instantes'; } 
						} else  { 
							$can = round($tiempo / 60); 
							if($can <= 1) {    $word = 'minuto'; } else { $word = 'minutos'; } 
							$hace = $can. " ".$word; 
						} 
					} else { 
						$can = round($tiempo / 3600); 
						if($can <= 1) {    $word = 'hora'; } else {    $word = 'horas'; } 
						$hace = $can. " ".$word; 
					} 
				} else  { 
					$can = round($tiempo / 86400); 
					if($can <= 1) {    $word = 'd&iacute;a'; } else {    $word = 'd&iacute;as'; } 
					$hace = $can. " ".$word;
				} 
			} else  { 
				$can = round($tiempo / 2678400);  
				if($can <= 1) {    $word = 'mes'; } else { $word = 'meses'; } 
				$hace = $can. " ".$word; 
			}
		 }else  {
			$can = round($tiempo / 31536000); 
			if($can <= 1) {    $word = 'a&ntilde;o';} else { $word = 'a&ntilde;os'; } 
			$hace = $can. " ".$word; 
		 }
		 //
		 if($show == true) return 'Hace '.$hace;
		 else return $hace;
	}
	/*
		getUrlContent($tsUrl)
	*/
	function getUrlContent($tsUrl){
	   // USAMOS CURL O FILE
	   if(function_exists('curl_init')){
    		// User agent
    		$useragent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; es-ES; rv:1.9) Gecko/2008052906 Firefox/3.0';
    		//Abrir conexion  
    		$ch = curl_init();  
    		curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
    		curl_setopt($ch,CURLOPT_URL,$tsUrl);
    		curl_setopt ($ch, CURLOPT_TIMEOUT, 60);
    		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    		$result = curl_exec($ch);
    		curl_close($ch); 
        } else {
            $result = @file_get_contents($tsUrl);
        }
		return $result;
	}
	/*
		getUserCountry()
	*/
	function getUserCountry(){
		//
		require('../ext/geoip.inc.php');
		$abir_bd = geoip_open('../ext/GeoIP.dat',GEOIP_STANDARD);
		$country = geoip_country_code_by_addr($abir_bd, $_SERVER['REMOTE_ADDR']);
		geoip_close($abir_bd); 
		//
		return $country;
	}
    /*
        getIP
    */
    function getIP(){
	   if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) $ip = getenv('HTTP_CLIENT_IP');	
	   elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) $ip = getenv('HTTP_X_FORWARDED_FOR');
	   elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) $ip = getenv('REMOTE_ADDR');
	   elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) $ip = $_SERVER['REMOTE_ADDR'];
	   else $ip = 'unknown';
	   return $this->setSecure($ip);
    }
	/*
		Encriptador KOX
		Encriptacion simple by JNeutron :D
		koxEncode($tsData,$kox_1)
	*/
	function koxEncode($tsData,$kox_l = NULL){
		$KOXkey = array(
			'a' => '0','b' => 1,'c' => 2,'d' => 3,'e' => 4,'f' => 5,'g' => 6,'h' => 7,'i' => 8,'j' => 9,
			'k' => 'z','l' => 'y','m' => 'x','n' => 'w','o' => 'v','p' => 'u','q' => 't','r' => 's',
			's' => 'r','t' => 'q','u' => 'p','v' => 'o','w' => 'n','x' => 'm','y' => 'l','z' => 'k',
			'0' => 'j',1 => 'i',2 => 'h',3 => 'g',4 => 'f',5 => 'e',6 => 'd',7 => 'c',8 => 'b',9 => 'a',
			'@' => '{', '.' => '}',
		);
		if(!$kox_l || $kox_l > 9) $kox_l = rand(1,9);
		$kox_n = $KOXkey[$kox_l];
		$kox_s = strlen($tsData);
		for($i=0;$i<$kox_s;$i++){
			$kox_c = $tsData[$i];
			for($j=0;$j<$kox_l;$j++){
				if($KOXkey[$kox_c] != '') $kox_c = $KOXkey[$kox_c];
				else $kox_c = $tsData[$i];
			}
			$kox_key .= $kox_c;
		}
		return $kox_key.$kox_n;
	}
	/*
		By JNeutron
		koxDecode($tsKey)
	*/
	function koxDecode($tsKey){
		$KOXkey = array(
			'0' => 'a',1 => 'b',2 => 'c',3 => 'd',4 => 'e',5 => 'f',6 => 'g',7 => 'h',8 => 'i',9 => 'j',
			'z' => 'k','y' => 'l','x' => 'm','w' => 'n','v' => 'o','u' => 'p','t' => 'q','s' => 'r',
			'r' => 's','q' => 't','p' => 'u','o' => 'v','n' => 'w','m' => 'x','l' => 'y','k' => 'z',
			'j' => '0','i' => 1,'h' => 2,'g' => 3,'f' => 4,'e' => 5,'d' => 6,'c' => 7,'b' => 8,'a' => 9,
			'{' => '@', '}' => '.',
		);
		$kox_s = strlen($tsKey);
		$kox_l = $tsKey[$kox_s-1];
		$kox_n = $KOXkey[$kox_l];
		for($i=0;$i<$kox_s-1;$i++){
			$kox_c = $tsKey[$i];
			for($j=$kox_n;$j>0;$j--){
				if($KOXkey[$kox_c] != '') $kox_c = $KOXkey[$kox_c];
				else $kox_c = $kox_c;
			}
			$kox_txt .= $kox_c;
		}
		return $kox_txt;
	}
	/* 
		getIUP()
	*/
	function getIUP($array, $prefix = ''){
		// NOMBRE DE LOS CAMPOS
		$fields = array_keys($array);
		// VALOR PARA LAS TABLAS
		$valores = array_values($array);
		// NUMERICOS Y CARACTERES
		foreach($valores as $i => $val) {
		  $sets[$i] = $prefix.$fields[$i]." = '".$this->setSecure($val)."'"; // Version: 1.1.500.8
		}
		$values = implode(', ',$sets);
		//
		return $values;
	}
	
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	
	
}