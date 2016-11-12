<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Modelo para el control del portal/mi
 *
 * @name    c.portal.php
 * @author  PHPost Team
 */
class tsPortal{

	// INSTANCIA DE LA CLASE
	public static function &getInstance(){
		static $instance;
		
		if( is_null($instance) ){
			$instance = new tsPortal();
    	}
		return $instance;
	}
	
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*\
								PUBLICAR POSTS
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    /** getNews()
     * @access public
     * @param 
     * @return array
     */
     public function getNews(){
        // MURO
        include(TS_CLASS."c.muro.php");
        $tsMuro =& tsMuro::getInstance();
        return $tsMuro->getNews(0);
     }
    /** setPostsConfig()
     * @access public
     * @param 
     * @return string
     */
     public function savePostsConfig(){
        global $tsUser, $tsCore;
        //
        $cat_ids = substr($_POST['cids'],0,-1); // PARA QUITAR LA ULTIMA COMA xD
        $cat_ids = explode(',', $cat_ids);
        $cat_ids = serialize($cat_ids);
        //

        if(db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `u_portal` SET `last_posts_cats` = \''.$tsCore->setSecure($cat_ids).'\' WHERE `user_id` = \''.$tsUser->uid.'\'')) return '1: Tus cambios fueron aplicados.';
        else return '0: Int&eacute;ntalo mas tarde.';
     }
     /** composeCategories()
     * @access public
     * @param array
     * @return array
     */
     public function composeCategories(){
        global $tsCore, $tsUser;
        //
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT `last_posts_cats` FROM `u_portal` WHERE `user_id` = \''.$tsUser->uid.'\'');
        $data = db_exec('fetch_assoc', $query);
        
        //
        $data = unserialize($data['last_posts_cats']);
        foreach($tsCore->settings['categorias'] as $key => $cat){
            if(in_array($cat['cid'], $data)) $cat['check'] = 1;
            else $cat['check'] = 0;
            $categories[] = $cat;
        }
        //
        return $categories;
     }
     /** getMyPosts()
     * @access public
     * @param
     * @return array
     */
     public function getMyPosts(){
        global $tsCore, $tsUser;
        //
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT `last_posts_cats` FROM `u_portal` WHERE `user_id` = \''.$tsUser->uid.'\'');
        $data = db_exec('fetch_assoc', $query);
        
        //
        $cat_ids = unserialize($data['last_posts_cats']);
        if(is_array($cat_ids)){
            $cat_ids = implode(',',$cat_ids);
            $where = "p.post_category IN ({$cat_ids})";
            //
            $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(p.post_id) AS total FROM p_posts AS p WHERE p.post_status = \'0\' AND '.$where.'');
            $total = db_exec('fetch_assoc', $query);
            
            //
            if($total['total'] > 0)
                $pages = $tsCore->getPagination($total['total'], 20);
            else return false;
            //
            $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT p.post_id, p.post_category, p.post_title, p.post_date, p.post_puntos, p.post_private, u.user_name, c.c_nombre, c.c_seo, c.c_img FROM p_posts AS p LEFT JOIN u_miembros AS u ON p.post_user = u.user_id LEFT JOIN p_categorias AS c ON c.cid = p.post_category WHERE p.post_status = \'0\' AND '.$where.' ORDER BY p.post_id DESC LIMIT '.$pages['limit'].'');
            $posts['data'] = result_array($query);
            
            //
            $posts['pages'] = $pages;
            //
            return $posts;
        } else return false;
     }
    /** getLastPosts()
     * @access public
     * @param string
     * @return array
     */
	function getLastPosts($type = 'visited'){
		global $tsUser;
        //
       $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT `last_posts_'.$type.'` FROM `u_portal` WHERE `user_id` = \''.$tsUser->uid.'\' LIMIT 1');
        $dato = db_exec('fetch_assoc', $query);
        
        $visited = unserialize($dato['last_posts_'.$type]);
        krsort($visited);
		// LO HAGO ASI PARA ORDENAR SIN NECESITAR OTRA VARIABLE
        foreach($visited as $key => $id){
            $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT p.post_id, p.post_user, p.post_category, p.post_title, p.post_date, p.post_puntos, p.post_private, u.user_name, c.c_nombre, c.c_seo, c.c_img FROM p_posts AS p LEFT JOIN u_miembros AS u ON p.post_user = u.user_id LEFT JOIN p_categorias AS c ON c.cid = p.post_category WHERE p.post_status = 0 AND p.post_id = '.$id.' LIMIT 1');
            $data[] = db_exec('fetch_assoc', $query);
            
        }
		//
		return $data;
	}
     /** getFavorites()
     * @access public
     * @param
     * @return array
     */
     public function getFavorites(){
        global $tsCore, $tsUser;
        //
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(fav_id) AS total FROM `p_favoritos` WHERE `fav_user` = \''.$tsUser->uid.'\'');
        $total = db_exec('fetch_assoc', $query);
        
        if($total['total'] > 0)
            $pages = $tsCore->getPagination($total['total'], 20);
        else return false;
        //
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT f.fav_id, f.fav_date, p.post_id, p.post_title, p.post_date, p.post_puntos, p.post_category, p.post_private, COUNT(p_c.c_post_id) as post_comments,  c.c_nombre, c.c_seo, c.c_img FROM p_favoritos AS f LEFT JOIN p_posts AS p ON p.post_id = f.fav_post_id LEFT JOIN p_categorias AS c ON c.cid = p.post_category LEFT JOIN p_comentarios AS p_c ON p.post_id = p_c.c_post_id && p_c.c_status = \'0\' WHERE f.fav_user = \''.$tsUser->uid.'\' && p.post_status = \'0\' GROUP BY c_post_id ORDER BY f.fav_date DESC LIMIT '.$pages['limit']);
		$data['data'] = result_array($query);
		
        //
        $data['pages'] = $pages;
        //
        return $data;
     }
     /** getFotos()
     * @access public
     * @param
     * @return array
     */
     public function getFotos(){
        // FOTOS
    	include(TS_CLASS."c.fotos.php");
    	$tsFotos =& tsFotos::getInstance();
        return $tsFotos->getLastFotos();
     }
     /** getStats()
     * @access public
     * @param
     * @return array
     */
     public function getStats(){
    	// CLASE TOPS
    	include(TS_CLASS."c.tops.php");
    	$tsTops =& tsTops::getInstance();
        return $tsTops->getStats();
     }
}