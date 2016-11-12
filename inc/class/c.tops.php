<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Modelo para el control de los tops
 *
 * @name    c.tops.php
 * @author  PHPost Team
 */
class tsTops {

	// INSTANCIA DE LA CLASE
	public static function &getInstance(){
		static $instance;
		
		if( is_null($instance) ){
			$instance = new tsTops();
    	}
		return $instance;
	}
	
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*\
								TOPS Y ESTADISTICAS
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*
		getHomeTopPosts()
		: TOP DE POST semana, histórico
	*/
	function getHomeTopPosts(){
		// AYER
		$data['ayer'] = $this->getHomeTopPostsQuery($this->setTime(2));
		// SEMANA
		$data['semana'] = $this->getHomeTopPostsQuery($this->setTime(3));
		// MES
		$data['mes'] = $this->getHomeTopPostsQuery($this->setTime(4));
		// HISTÓRICO
		$data['historico'] = $this->getHomeTopPostsQuery($this->setTime(5));
		//
		return $data;
	}
	/*
		getHomeTopUsers()
		: TOP DE USUARIOS semana, histórico
	*/
	function getHomeTopUsers(){
        // AYER
		$data['ayer'] = $this->getHomeTopUsersQuery($this->setTime(2));
        // SEMANA
		$data['semana'] = $this->getHomeTopUsersQuery($this->setTime(3));
        // MES
		$data['mes'] = $this->getHomeTopUsersQuery($this->setTime(4));
        // HISTÓRICO
		$data['historico'] = $this->getHomeTopUsersQuery($this->setTime(5));
        //
        return $data;
	}
    /*
        getTopUsers()
    */
    function getTopUsers($fecha, $cat){
        //
        $data = $this->setTime($fecha);
        $category = empty($cat) ? '' : 'AND post_category = '.$cat;
		// PUNTOS
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT SUM(p.post_puntos) AS total, u.user_id, u.user_name FROM p_posts AS p LEFT JOIN u_miembros AS u ON p.post_user = u.user_id WHERE p.post_status = 0  AND p.post_date BETWEEN '.$data['start'].' AND '.$data['end'].' '.$category.' GROUP BY p.post_user ORDER BY total DESC LIMIT 10');
        $array['puntos'] = result_array($query);
        
        // SEGUIDORES
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(f.follow_id) AS total, u.user_id, u.user_name FROM u_follows AS f LEFT JOIN u_miembros AS u ON f.f_id = u.user_id WHERE f.f_type = 1 AND f.f_date BETWEEN '.$data['start'].' AND '.$data['end'].' GROUP BY f.f_id ORDER BY total DESC LIMIT 10');
        $array['seguidores'] = result_array($query);
        
		// MEDALLAS
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(m.medal_for) AS total, u.user_id, u.user_name, wm.medal_id FROM w_medallas_assign AS m LEFT JOIN u_miembros AS u ON m.medal_for = u.user_id LEFT JOIN w_medallas AS wm ON wm.medal_id = m.medal_id WHERE wm.m_type = \'1\' AND m.medal_date BETWEEN '.$data['start'].' AND '.$data['end'].' GROUP BY m.medal_for ORDER BY total DESC LIMIT 10');
        $array['medallas'] = result_array($query);
        
        //
        return $array;
    }
	/*
		getTopPosts()
	*/
	function getTopPosts($fecha, $cat){
		// PUNTOS
		$data['puntos'] = $this->getTopPostsVars($fecha, $cat, 'puntos');
		// SEGUIDORES
		$data['seguidores'] = $this->getTopPostsVars($fecha, $cat, 'seguidores');
		// COMENTARIOS
		$data['comments'] = $this->getTopPostsVars($fecha, $cat, 'comments');
		// FAVORITOS
		$data['favoritos'] = $this->getTopPostsVars($fecha, $cat, 'favoritos');
		//
		//
		return $data;
	}
	/*
		setTopPostsVars($text, $type)
	*/
	function getTopPostsVars($fecha, $cat, $type){
		//
		$data = $this->setTime($fecha);
		if(!empty($cat)) $data['scat'] = 'AND c.cid = '.$cat;
		//
		$data['type'] = 'p.post_'.$type;

		//
		return $this->getTopPostsQuery($data);
	}
	/*
		getTopPostsQuery($data)
	*/
	function getTopPostsQuery($data){
		
		//
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT p.post_id, p.post_category, '.$data['type'].', p.post_puntos, p.post_title, c.c_seo, c.c_img FROM p_posts AS p LEFT JOIN p_categorias AS c ON c.cid = p.post_category  WHERE p.post_status = \'0\' AND p.post_date BETWEEN '.$data['start'].' AND '.$data['end'].' '.$data['scat'].' ORDER BY '.$data['type'].' DESC LIMIT 10');
        $datos = result_array($query);
		
		//
		return $datos;
	}
	/*
		getHomeTopPostsQuery($data)
	*/
	function getHomeTopPostsQuery($date){
		
		//
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT p.post_id, p.post_category, p.post_title, p.post_puntos, c.c_seo FROM p_posts AS p LEFT JOIN p_categorias AS c ON c.cid = p.post_category  WHERE p.post_status = 0 AND p.post_date BETWEEN \''.$date['start'].'\' AND \''.$date['end'].'\' ORDER BY p.post_puntos DESC LIMIT 15');
		$data = result_array($query);
		
		//
		return $data;
	}
    /*
        getHomeTopUsersQuery($date)
    */
    function getHomeTopUsersQuery($date){
		// PUNTOS
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT SUM(p.post_puntos) AS total, u.user_id, u.user_name FROM p_posts AS p LEFT JOIN u_miembros AS u ON p.post_user = u.user_id WHERE p.post_status = 0  AND p.post_date BETWEEN \''.$date['start'].'\' AND \''.$date['end'].'\' GROUP BY p.post_user ORDER BY total DESC LIMIT 10');
        $data = result_array($query);
        
        //
        return $data;
    }
	/*
		getStats() : NADA QUE VER CON LA CLASE PERO BUENO PARA AHORRAR ESPACIO...
		: ESTADISTICAS DE LA WEB
	*/
	function getStats(){
		global $tsCore;
		// OBTENEMOS LAS ESTADISTICAS
        $return = db_exec('fetch_assoc', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT stats_max_online, stats_max_time, stats_time, stats_time_cache, stats_miembros, stats_posts, stats_fotos, stats_comments, stats_foto_comments FROM w_stats WHERE stats_no = \'1\''));
        
        if($return['stats_time_cache'] < time()-($tsCore->settings['c_stats_cache']*60)){
        $q1 = db_exec('fetch_row', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(user_id) AS u FROM u_miembros WHERE user_activo = \'1\' && user_baneado = \'0\''));
		$q2 = db_exec('fetch_row', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(post_id) AS p FROM p_posts WHERE post_status = \'0\''));
        $q3 = db_exec('fetch_row', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(foto_id) AS f FROM f_fotos WHERE f_status = \'0\''));
        $q4 = db_exec('fetch_row', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(cid) AS c FROM p_comentarios WHERE c_status = \'0\''));
        $q5 = db_exec('fetch_row', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(cid) AS fc FROM f_comentarios'));
        
        $return['stats_miembros'] = $q1[0];
        $return['stats_posts'] = $q2[0];
        $return['stats_fotos'] = $q3[0];
        $return['stats_comments'] = $q4[0];
        $return['stats_foto_comments'] = $q5[0];
        $ndat = ', stats_time_cache = \''.time().'\', stats_miembros = \''.$return['stats_miembros'].'\', stats_posts = \''.$return['stats_posts'].'\', stats_fotos = \''.$return['stats_fotos'].'\', stats_comments = \''.$return['stats_comments'].'\', stats_foto_comments = \''.$return['stats_foto_comments'].'\'';
        }
        // PARA SABER SI ESTA ONLINE
		$is_online = (time() - ($tsCore->settings['c_last_active'] * 60));
		// USUARIOS ONLINE - COMPROBAMOS SI CONTAMOS A TODOS LOS USUARIOS O SOLO A REGISTRADOS
		if(empty($tsCore->settings['c_count_guests'])){
		$cueri = db_exec('fetch_row', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(user_id) AS u FROM `u_miembros` WHERE `user_lastactive` > \''.$is_online.'\''));
		}else{
        $cueri = db_exec('fetch_row', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(DISTINCT `session_ip`) AS s FROM `u_sessions` WHERE `session_time` > \''.$is_online.'\''));
		}
        
		$return['stats_online'] = $cueri[0];
        
        if($return['stats_online'] > $return['stats_max_online']) {
            $timen = ', stats_max_online = \''.$return['stats_online'].'\', stats_max_time = \''.time().'\'';
        }
            
        db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE w_stats SET stats_time = \''.time().'\' '.$ndat.' '.$timen);
		//
		return $return;
	}
	/******************************************************************************/
	/*
		setTime($fecha)
	*/
	function setTime($fecha){
		// AHORA
		$tiempo = time();
		$dia = (int) date("d",$tiempo);
		$hora = (int) date("G",$tiempo);
		$min = (int) date("i",$tiempo);
		$seg = (int) date("s",$tiempo);
		//
		$resta = $this->setSegs($hora, 'hor') + $this->setSegs($min, 'min') + $seg;
		// TRANSFORMAR
		switch($fecha){
			// HOY
			case 1: 
				//
				$data['start'] = $tiempo - $resta;
				$data['end'] = $tiempo;
				//
			break;
			// AYER
			case 2: 
				//
				$restaDos = $resta + $this->setSegs(1,'dia') + $this->setSegs(1,'hor');
				$data['start'] = $tiempo - $restaDos;
				$data['end'] = $tiempo - $resta;
				//
			break;
			// SEMANA
			case 3: 
				//
				$restaDos = $resta + $this->setSegs(1,'sem')  + $this->setSegs(1,'hor');
				$data['start'] = $tiempo - $restaDos;
				$data['end'] = $tiempo - $resta;
				//
			break;
			// MES
			case 4: 
				//
				$restaDos = $resta + $this->setSegs(1,'mes')  + $this->setSegs(1,'hor');
				$data['start'] = $tiempo - $restaDos;
				$data['end'] = $tiempo - $resta;
				//
			break;
			// TODO EL TIEMPO
			case 5: 
				//
				$data['start'] = 0;
				$data['end'] = $tiempo;
				//
			break;
		}
		//
		return $data;
	}
	/*
		setSegs($tiempo, $tipo)
	*/
	function setSegs($tiempo, $tipo){
		//
		switch($tipo){
			case 'min' :
				$segundos = $tiempo * 60;
			break;
			case 'hor' :
				$segundos = $tiempo * 3600;
			break;
			case 'dia' :
				$segundos = $tiempo * 86400;
			break;
			case 'sem' :
				$segundos = $tiempo * 604800;
			break;
			case 'mes' :
				$segundos = $tiempo * 2592000;
			break;

		}
		//
		return $segundos;
	}
}