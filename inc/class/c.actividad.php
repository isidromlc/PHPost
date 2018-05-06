<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Modelo para el control de la actividad
 *
 * @name    c.actividad.php
 * @author  PHPost Team
 */

/**
 * ACTIVIDAD
 * // POSTS
 * 1 => Creó un nuevo post
 * 2 => Agregó a favoritos el post
 * 3 => Dejó 10 puntos en el post
 * 4 => Recomend&oacute; el post
 * 5 => Comentó el post
 * 6 => Votó positivo/negativo un comentario en el post
 * 7 => Est&aacute; siguiendo el post
 * // FOLLOWS
 * 8 => Está siguiendo a
 * // FOTOS
 * 9 => Subió una nueva foto
 * // MURO
 * 10 => 
 *      0 => Publicó en su muro
 *      1 => Comentó su publicación
 *      2 => Publicó en el muro de
 *      3 => Comentó la publicación de
 * 11 => Le gusta
 *      0 => su publicación
 *      1 => su comentario
 *      2 => la publicación de
 *      3 => el comentario de
*/
class tsActividad {
	private $actividad = array();

    public function __construct(){
        # NO ES NESESARIO HACER ALGO EN EL CONSTRUCTOR
    }
    /**
     * @name makeActividad
     * @access private
     * @params none
     * @return none
     */
    private function makeActividad(){
        # ACTIVIDAD CON FORMATO | ID => array(TEXT, LINK, CSS_CLASS)
        $this->actividad = array(
            // POSTS
            1 => array('text' => 'Cre&oacute; un nuevo post', 'css' => 'post'),
            2 => array('text' => 'Agreg&oacute; a favoritos el post', 'css' => 'star'),
            3 => array('text' => array('Dej&oacute;', 'puntos en el post'), 'css' => 'points'),
            4 => array('text' => 'Recomend&oacute; el post', 'css' => 'share'),
            5 => array('text' => array('Coment&oacute;', 'el post'), 'css' => 'comment_post'),
            6 => array('text' => array('Vot&oacute;', 'un comentario en el post'), 'css' => 'voto_'),
            7 => array('text' => 'Est&aacute; siguiendo el post', 'css' => 'follow_post'),
            // FOLLOWS
            8 => array('text' => 'Est&aacute; siguiendo a', 'css' => 'follow'),
            // FOTOS
            9 => array('text' => 'Subi&oacute; una nueva foto', 'css' => 'photo'),
            // MURO
            10 => array(
                0 => array('text' => 'Public&oacute; en su', 'link' => 'muro', 'css' => 'status'),
                1 => array('text' => 'Coment&oacute; su', 'link' => 'publicaci&oacute;n', 'css' => 'w_comment'),
                2 => array('text' => 'Public&oacute; en el muro de', 'css' => 'wall_post'),
                3 => array('text' => 'Coment&oacute; la publicaci&oacute;n de', 'css' => 'w_comment')
            ),
            11 => array(
                'text' => 'Le gusta',
                'css' => 'w_like',
                0 => array('text' => 'su', 'link' => 'publicaci&oacute;n'),
                1 => array('text' => 'su comentario'),
                2 => array('text' => 'la publicaci&oacute;n de'),
                3 => array('text' => 'el comentario'),
            )
        );
    }
    /**
     * @name setActividad
     * @access public
     * @params none
     * @return void
     */
    public function setActividad($ac_type = NULL, $obj_uno = NULL, $obj_dos = 0){
        # VARIABLES GLOBALES
        global $tsUser, $tsCore;
        # VARIABLES LOCALES{
        $ac_date = time();
        # BUSCAMOS ACTIVIDADES				
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT `ac_id` FROM `u_actividad` WHERE user_id = \''.$tsUser->uid.'\' ORDER BY ac_date DESC');
        $data = result_array($query);
        
        //
        $ntotal = count($data);
        $delid = $data[$ntotal-1]['ac_id']; // ID DE ULTIMA NOTIFICACION
		// ELIMINAR ACTIVIDADES?
		if($ntotal >= $tsCore->settings['c_max_acts']){			
		db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM `u_actividad` WHERE `ac_id` = '.$delid);
		}
        # SE HACE UN CONTEO PROGRESIVO SI HACE ESTA ACCON MAS DE 1 VEZ AL DIA
        if($ac_type == 5) {
            //
            $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT `ac_id`, `ac_date` FROM `u_actividad` WHERE user_id = \''.$tsUser->uid.'\' AND obj_uno = \''.$obj_uno.'\' AND ac_type = \''.$ac_type.'\' LIMIT 1');
            $data = db_exec('fetch_assoc', $query);
            
            //
            $hace = $this->makeFecha($data['ac_date']);
            if($hace == 'today') {                
			if(db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `u_actividad` SET obj_dos = obj_dos + 1 WHERE ac_id = \''.$data['ac_id'].'\' LIMIT 1')) return true;			
            }
        }
        # INSERCION DE DATOS        
		if(db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO `u_actividad` (`user_id`, `obj_uno`, `obj_dos`, `ac_type`, `ac_date`) VALUES ('.$tsUser->uid.', '.$obj_uno.', '.$obj_dos.', '.$ac_type.', '.$ac_date.')')) return true;
        		else return false;
    }
    /**
     * @name getActividad
     * @access public
     * @params int(3)
     * @return array
     */
    public function getActividad($user_id = NULL, $ac_type = 0, $start = 0, $v_type = NULL){
        # CREAR ACTIVIDAD
        $this->makeActividad();
        # VARIABLES LOCALES
        $ac_type = ($ac_type != 0) ? ' AND ac_type = \''.$ac_type.'\'' : '';
        # CONSULTA
		// ESTO ERA PARA ACTIVIDAD ADMIN => $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT a.*, u.* FROM u_actividad AS a LEFT JOIN u_miembros AS u ON a.user_id = u.user_id WHERE ORDER BY a.ac_date DESC LIMIT '.$start.', 25');
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT `ac_id`, `user_id`, `obj_uno`, `obj_dos`, `ac_type`, `ac_date` FROM `u_actividad` WHERE user_id = '.$user_id.' '.$ac_type.' ORDER BY ac_date DESC LIMIT '.$start.', 25');
		$data = result_array($query);
        
        # ARMAR ACTIVIDAD
        $actividad = $this->armActividad($data);
        # RETORNAR ACTIVIDAD
        return $actividad;
    }
    /**
     * @name getActividadFollows
     * @access public
     * @param none
     * @return array
     */
    public function getActividadFollows($start = 0){
        # VARIABLES GLOBALES
        global $tsUser;
        # CREAR ACTIVIDAD
        $this->makeActividad();
        // SOLO MOSTRAREMOS LAS ULTIMAS 100 ACTIVIDADES
        if($start > 90) return array('total' => '-1');
        // SEGUIDORES
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT `f_id` FROM `u_follows` WHERE f_user = '.$tsUser->uid.' AND f_type = 1');
        $follows = result_array($query);
        
        // ORDENAMOS 
        foreach($follows as $key => $val){
            $amigos[] = "'".$val['f_id']."'";
        }
        // ME AGREGO A LA LISTA DE AMIGOS
        $amigos[] = $tsUser->uid;
        // CONVERTIMOS EL ARRAY EN STRING
        $amigos = implode(', ',$amigos);
        // OBTENEMOS LAS ULTIMAS PUBLICACIONES
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT a.*, u.user_name AS usuario FROM u_actividad AS a LEFT JOIN u_miembros AS u ON a.user_id = u.user_id WHERE a.user_id IN('.$amigos.') ORDER BY ac_date DESC LIMIT '.$start.', 25');
        $data = result_array($query);
        
        # ARMAR ACTIVIDAD
        if(empty($data)) return 'No hay actividad o no sigues a ning&uacute;n usuario.';
        $actividad = $this->armActividad($data);
        # RETORNAR ACTIVIDAD
        return $actividad;
    }
    /**
     * @name delActividad
     * @access public
     * @param none
     * @return string
     */
    public function delActividad(){
        # VARIABLES GLOBALES
        global $tsUser;
        # VARIABLES LOCALES
        $ac_id = $_POST['acid'];
        # CONSULTAS		
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT user_id FROM u_actividad WHERE ac_id = \''.intval($ac_id).'\' LIMIT 1');
        $data = db_exec('fetch_assoc', $query);
        
        # COMPROBAMOS
        if($data['user_id'] == $tsUser->uid){			
		if(db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM `u_actividad` WHERE ac_id = \''.intval($ac_id).'\'')) return '1: Actividad borrada';
        }
        //
        return '0: No puedes borrar esta actividad.';
    }
    /**
     * @name armActividad
     * @access private
     * @params array
     * @return array
     */
    private function armActividad($data = NULL){
        # VARIABLES LOCALES
        $actividad = array(
            'total' => count($data),
            'data' => array(
            'today' => array('title' => 'Hoy', 'data' => array()),
            'yesterday' => array('title' => 'Ayer', 'data' => array()),
            'week' => array('title' => 'D&iacute;as Anteriores', 'data' => array()),
            'month' => array('title' => 'Semanas Anteriores', 'data' => array()),
            'old' => array('title' => 'Actividad m&aacute;s antigua', 'data' => array())
            )
        );
        # PARA CADA VALOR CREAR UNA CONSULTA
        foreach($data as $key => $val){
            // CREAR CONSULTA
            $sql = $this->makeConsulta($val);
            // CONSULTAMOS
			$query = db_exec(array(__FILE__, __LINE__), 'query', $sql);
			$dato = db_exec('fetch_assoc', $query);
			
            //
            if(!empty($dato)) {
                // AGREGAMOS AL ARRAY ORIGINAL
    			$dato = array_merge($dato, $val);
                // ARMAMOS LOS TEXTOS
                $oracion = $this->makeOracion($dato);
                // DONDE PONERLO?
                $ac_date = $this->makeFecha($val['ac_date']);
                // PONER
                $actividad['data'][$ac_date]['data'][] = $oracion;
            }
        }
        #RETORNAMOS LOS VALORES
        //return $sql;
        return $actividad;
    }
    /**
     * @name makeConsulta
     * @access private
     * @params array
     * @return string/array
     */
    private function makeConsulta($data = NULL){
        # CON UN SWITCH ESCOGEMOS LA CONSULTA APROPIADA
        switch($data['ac_type']){
            // DEL TIPO 1 al 7 USAMOS LA MISMA CONSULTA
            case 1:
            case 2:
            case 3:
            case 4:
            case 5:
            case 6:
            case 7:
                return 'SELECT p.post_id, p.post_title, c.c_seo FROM p_posts AS p LEFT JOIN p_categorias AS c ON p.post_category = c.cid WHERE p.post_id = \''.(int)$data['obj_uno'].'\' LIMIT 1';
            break;
            // SIGUIENDO A...
            case 8:
                return 'SELECT user_id AS avatar, user_name FROM u_miembros WHERE user_id = \''.(int)$data['obj_uno'].'\' LIMIT 1';
            break;
            // SUBIO UNA FOTO
            case 9:
                return 'SELECT f.foto_id, f.f_title, u.user_name FROM f_fotos AS f LEFT JOIN u_miembros AS u ON f.f_user = u.user_id WHERE f.foto_id = \''.(int)$data['obj_uno'].'\' LIMIT 1'; // Fix: 14/12/2014 - 1.1.000.9
            break;
            // PUBLICACION EN EL MURO & LE GUSTA
            case 10:
            case 11:
                if($data['obj_dos'] == 0 || $data['obj_dos'] == 2) {
                return 'SELECT p.pub_id, u.user_name FROM u_muro AS p LEFT JOIN u_miembros AS u ON p.p_user = u.user_id WHERE p.pub_id = \''.(int)$data['obj_uno'].'\' LIMIT 1';
                } else {
                return 'SELECT c.pub_id, c.c_body, u.user_name FROM u_muro_comentarios AS c LEFT JOIN u_muro AS p ON c.pub_id = p.pub_id LEFT JOIN u_miembros AS u ON p.p_user = u.user_id WHERE cid = \''.(int)$data['obj_uno'].'\' LIMIT 1';
                }
            break;
        }
    }
    /**
     * @name makeOracion
     * @access private
     * @params array
     * @return array
     **/
    private function makeOracion($data = NULL){
        # VARIABLES GLOBALES
        global $tsCore;
        # VARIABLES LOCALES
        $ac_type = $data['ac_type'];
        $site_url =  $tsCore->settings['url'];
        $oracion['id'] = $data['ac_id'];
        $oracion['style'] = $this->actividad[$ac_type]['css'];
        $oracion['date'] = $data['ac_date'];
        $oracion['user'] = $data['usuario'];
        $oracion['uid'] = $data['user_id'];
        # CON UN SWITCH ESCOGEMOS QUE ORACION CONSTRUIR
        switch($ac_type){
            # DEL TIPO 1-2, 4 y 7 USAMOS LA MISMA
            case 1:
            case 2:
            case 4:
            case 7:
                $oracion['text'] = $this->actividad[$ac_type]['text'];
                $oracion['link'] = $site_url.'/posts/'.$data['c_seo'].'/'.$data['post_id'].'/'.$tsCore->setSEO($data['post_title']).'.html';
                $oracion['ltext'] = $data['post_title'];
            break;
            # DEL TIPO 3, 5 y 6 USAMOS EL MISMO
            case 3:
            case 5:
            case 6:
                //
                if($ac_type == 3) $extra_text = $data['obj_dos'];
                elseif($ac_type == 5) $extra_text = ($data['obj_dos'] == 0) ? '' : ($data['obj_dos']+1).' veces';
                else $extra_text = ($data['obj_dos'] == 0) ? 'negativo' : 'positivo';
                //
                $oracion['text'] = $this->actividad[$ac_type]['text'][0]." <b>{$extra_text}</b> ".$this->actividad[$ac_type]['text'][1];
                $oracion['link'] = $site_url.'/posts/'.$data['c_seo'].'/'.$data['post_id'].'/'.$tsCore->setSEO($data['post_title']).'.html';
                $oracion['ltext'] = $data['post_title'];
                // ESTILO
                $oracion['style'] = ($ac_type == 6) ? 'voto_'.$extra_text : $oracion['style'];
            break;
            # ESTA SIGUIENDO A..
            case 8:
                // AVATARES
                $img_uno = '<img src="'.$tsCore->settings['url'].'/files/avatar/'.$data['user_id'].'_16.jpg"/>';
                $img_dos = '<img src="'.$tsCore->settings['url'].'/files/avatar/'.$data['avatar'].'_16.jpg"/>';
                // ORACION
                $oracion['text'] = $img_uno.' '.$this->actividad[$ac_type]['text'].' '.$img_dos;
                $oracion['link'] = $site_url.'/perfil/'.$data['user_name'];
                $oracion['ltext'] = $data['user_name'];
                $oracion['style'] = '';
            break;
            # SUBIO NUEVA FOTO
            case 9:
                $oracion['text'] = $this->actividad[$ac_type]['text'];
                $oracion['link'] = $site_url.'/fotos/'.$data['user_name'].'/'.$data['foto_id'].'/'.$tsCore->setSEO($data['f_title']).'.html';
                $oracion['ltext'] = $data['f_title'];
            break;
            # MURO POSTS
            case 10:
                // SEC TYPE
                $sec_type = $data['obj_dos'];
                $link_text = $this->actividad[$ac_type][$sec_type]['link'];
                //
                $oracion['text'] = $this->actividad[$ac_type][$sec_type]['text'];
                $oracion['link'] = $site_url.'/perfil/'.$data['user_name'].'/'.$data['pub_id'];
                $oracion['ltext'] = empty($link_text) ? $data['user_name'] : $link_text;
                $oracion['style'] = $this->actividad[$ac_type][$sec_type]['css'];
            break;
            # LIKES
            case 11:
                // SEC TYPE
                $sec_type = $data['obj_dos'];
                $link_text = $this->actividad[$ac_type][$sec_type]['link'];
                //
                $oracion['text'] = $this->actividad[$ac_type]['text'].' '.$this->actividad[$ac_type][$sec_type]['text'];
                $oracion['link'] = $site_url.'/perfil/'.$data['user_name'].'?pid='.$data['pub_id'];
                // 
                if($data['obj_dos'] == 0 || $data['obj_dos'] == 2)
                    $oracion['ltext'] = empty($link_text) ? $data['user_name'] : $link_text;
                else {
                    $end_text = (strlen($data['c_body']) > 35) ? '...' : '';
                    $oracion['ltext'] = substr($data['c_body'],0,30).$end_text;
                }
            break;
        }
        //
        return $oracion;
    }
    /**
     * @name makeFecha
     * @access private
     * @params int
     * @return string
     */
    private function makeFecha($time = NULL){
        # VARIABLES LOCALES
        $tiempo = time() - $time; 
        $dias = round($tiempo / 86400);
        //
        if($dias < 1) return 'today';
        elseif($dias < 2) return 'yesterday';
        elseif($dias <= 7) return 'week';
        elseif($dias <= 30) return 'month';
        else return 'old';
        #
    }
}