<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Modelo para el control de las medallas
 *
 * @name    c.medals.php
 * @author  PHPost Team
 */
class tsMedal {

    /**
     * @name adGetMedals()
     * @access public
     * @uses Cargamos las medallas para la administracion
     * @param
     * @return array
     */
	public function adGetMedals(){
		global $tsCore;
		
		$max = 15; // MEDALLAS A MOSTRAR POR PÁGINA
		$limit = $tsCore->setPageLimit($max, true);
		
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT u.user_id, u.user_name, m.* FROM w_medallas AS m LEFT JOIN u_miembros AS u ON m.m_autor = u.user_id ORDER BY medal_id DESC LIMIT '.$limit);
		$datos['medallas'] = result_array($query);
        
		
		// PAGINAS
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(*) FROM w_medallas WHERE medal_id > \'0\'');
		list ($total) = db_exec('fetch_row', $query);
		
		$datos['pages'] = $tsCore->pageIndex($tsCore->settings['url']."/admin/medals?",$_GET['s'],$total, $max);
		
		return $datos;
	}
	
	/**
     * @name adGetAssign()
     * @access public
     * @uses Cargamos las medallas asignadas
     * @param
     * @return array
     */
	public function adGetAssign(){
		global $tsCore;
		
		$max = 30; // MEDALLAS A MOSTRAR POR PÁGINA
		$limit = $tsCore->setPageLimit($max, true);
        
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT u.user_id, u.user_name, a.*, p.post_id, p.post_title, c.c_nombre, c.c_seo, f.foto_id, f.f_title, w.* FROM w_medallas_assign AS a LEFT JOIN u_miembros AS u ON u.user_id = a.medal_for LEFT JOIN p_posts AS p ON p.post_id = a.medal_for LEFT JOIN p_categorias AS c ON c.cid = p.post_category LEFT JOIN f_fotos AS f ON f.foto_id = a.medal_for LEFT JOIN w_medallas AS w ON w.medal_id = a.medal_id ORDER BY a.medal_date DESC LIMIT '.$limit);
		$datos['asignaciones'] = result_array($query);
        
        
		// PAGINAS
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(*) FROM w_medallas_assign WHERE id > \'0\'');
		list ($total) = db_exec('fetch_row', $query);
		
		$datos['pages'] = $tsCore->pageIndex($tsCore->settings['url']."/admin/medals?act=showassign",$_GET['s'],$total, $max);
		
		return $datos;
	}
	/**
     * @name adGetMedal()
     * @access public
     * @uses Cargamos una medalla para su edición
     * @param
     * @return array
     */
	public function adGetMedal(){
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT * FROM w_medallas WHERE medal_id = \''.(int)$_GET['mid'].'\' LIMIT 1');
		$medal = db_exec('fetch_assoc', $query);
		
        //
		return $medal;
	}
	
	/**
     * @name editMedal()
     * @access public
     * @uses Editamos la medalla
     * @param
     * @return array
     */
	public function editMedal(){
       global $tsCore;
	    // DATOS
		$medalla = array(
			'titulo' => $tsCore->parseBadWords($_POST['med_title']),
			'descripcion' => $tsCore->parseBadWords($_POST['med_desc']),
			'imagen' => $_POST['med_img'],
			'tipo' => $_POST['med_type'],
			'cantidad' => $_POST['med_cant'],
			'cond_user' => $_POST['med_cond_user'],
			'cond_user_rango' => $_POST['med_cond_user_rango'],
			'cond_post' => $_POST['med_cond_post'],
			'cond_foto' => $_POST['med_cond_foto'],
		);
		
		if(empty($medalla['titulo']) || empty($medalla['descripcion'])) return 'Debe introducir t&iacute;tulo y descripci&oacute;n'; // No campos vacíos

		if(is_numeric($medalla['tipo']) && is_numeric($medalla['cond_user']) && is_numeric($medalla['cond_user_rango']) && is_numeric($medalla['cond_post']) && is_numeric($medalla['cond_foto'])){

		//COMPROBAMOS QUE NO EXISTA
		if($medalla['tipo'] == 1){
		if(db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT medal_id FROM `w_medallas` WHERE  `m_type` = \'1\' AND `m_cant` = \''.(int)$medalla['cantidad'].'\' AND  `m_cond_user` = \''.(int)$medalla['cond_user'].'\' AND  `m_cond_user_rango` = \''.(int)$medalla['cond_user_rango'].'\' AND medal_id != \''.(int)$_GET['mid'].'\''))) $continue = false; else $continue = true;
		}elseif($medalla['tipo'] == 2){
		if(db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT medal_id FROM w_medallas WHERE m_type = \'2\' && m_cant = \''.(int)$medalla['cantidad'].'\' && m_cond_post = \''.(int)$medalla['cond_post'].'\' AND medal_id != \''.(int)$_GET['mid'].'\''))) $continue = false; else $continue = true;
		}elseif($medalla['tipo'] == 3){
		if(db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT medal_id FROM w_medallas WHERE m_type = \'3\' && m_cant = \''.(int)$medalla['cantidad'].'\' && m_cond_post = \''.(int)$medalla['cond_foto'].'\' AND medal_id != \''.(int)$_GET['mid'].'\''))) $continue = false; else $continue = true;
		}	
		// ACTUALIZAR
        if($continue == true) {
		if(db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE w_medallas SET m_title = \''.$tsCore->setSecure($medalla['titulo'], true).'\', m_description = \''.$tsCore->setSecure($medalla['descripcion'], true).'\', m_image = \''.$tsCore->setSecure($medalla['imagen'], true).'\', m_cant = \''.(int)$medalla['cantidad'].'\', m_type = \''.(int)$medalla['tipo'].'\', m_cond_user = \''.(int)$medalla['cond_user'].'\', m_cond_user_rango = \''.(int)$medalla['cond_user_rango'].'\', m_cond_post = \''.(int)$medalla['cond_post'].'\', m_cond_foto = \''.(int)$medalla['cond_foto'].'\' WHERE medal_id = \''.(int)$_GET['mid'].'\'')) return true;
		}else return 'Ya existe una medalla con esas caracter&iacute;sticas';
		}else return 'Introduzca valores num&eacute;ricos';
	}
    /**
     * @name adNewMedal()
     * @access public
     * @uses Creamos nueva medalla
     * @param
     * @return void
     */
     public function adNewMedal(){
        global $tsUser, $tsCore;
		
		// DATOS
		$medalla = array(
			'titulo' => $tsCore->parseBadWords($_POST['med_title']),
			'descripcion' => $tsCore->parseBadWords($_POST['med_desc']),
			'imagen' => $_POST['med_img'],
			'tipo' => $_POST['med_type'],
			'cantidad' => $_POST['med_cant'],
			'cond_user' => $_POST['med_cond_user'],
			'cond_user_rango' => $_POST['med_cond_user_rango'],
			'cond_post' => $_POST['med_cond_post'],
			'cond_foto' => $_POST['med_cond_foto'],
		);
		
		if(empty($medalla['titulo']) || empty($medalla['descripcion'])) return 'Debe introducir t&iacute;tulo y descripci&oacute;n'; // No campos vacíos

		if(is_numeric($medalla['tipo']) && is_numeric($medalla['cond_user']) && is_numeric($medalla['cond_user_rango']) && is_numeric($medalla['cond_post']) && is_numeric($medalla['cond_foto'])){

		//COMPROBAMOS QUE NO EXISTA
		if($medalla['tipo'] == 1){
		if(db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT medal_id FROM  `w_medallas` WHERE  `m_type` = \'1\' AND `m_cant` = \''.(int)$medalla['cantidad'].'\' AND  `m_cond_user` = \''.(int)$medalla['cond_user'].'\' AND  `m_cond_user_rango` = \''.(int)$medalla['cond_user_rango'].'\''))) $continue = false; else $continue = true;
		}elseif($medalla['tipo'] == 2){
		if(db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT medal_id FROM w_medallas WHERE m_type = \'2\' && m_cant = \''.(int)$medalla['cantidad'].'\' && m_cond_post = \''.(int)$medalla['cond_post'].'\''))) $continue = false; else $continue = true;
		}elseif($medalla['tipo'] == 3){
		if(db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT medal_id FROM w_medallas WHERE m_type = \'3\' && m_cant = \''.(int)$medalla['cantidad'].'\' && m_cond_post = \''.(int)$medalla['cond_foto'].'\''))) $continue = false; else $continue = true;
		}	
		// INSERTAR
        if($continue == true) {
		if(db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO `w_medallas` (`m_autor`, `m_title`, `m_description`, `m_image`, `m_cant`, `m_type`, `m_cond_user`, `m_cond_user_rango`, `m_cond_post`, `m_cond_foto`, `m_date`) VALUES (\''.$tsUser->uid.'\', \''.$tsCore->setSecure($medalla['titulo'], true).'\', \''.$tsCore->setSecure($medalla['descripcion'], true).'\', \''.$tsCore->setSecure($medalla['imagen'], true).'\', \''.(int)$medalla['cantidad'].'\', \''.(int)$medalla['tipo'].'\', \''.(int)$medalla['cond_user'].'\',  \''.(int)$medalla['cond_user_rango'].'\', \''.(int)$medalla['cond_post'].'\', \''.(int)$medalla['cond_foto'].'\', \''.time().'\')')) return true;
        else return 'No se pudo insertar la medalla';
		}else return 'Ya existe una medalla con esas caracter&iacute;sticas';
		}else return 'Introduzca valores num&eacute;ricos';
	 }
	 
	 /**
     * @name AsignarMedalla()
     * @access public
     * @uses Damos una medalla a un usuario
     * @param
     * @return void
     */
     public function AsignarMedalla(){
        global $tsUser, $tsCore;
		// DATOS
        $medalla = intval($_POST['mid']);
        $usuario = strtolower($_POST['m_usuario']);
		$post = intval($_POST['pid']);
		$foto = intval($_POST['fid']);
		$user_id = $tsUser->getUserID($usuario);
		
		if(!empty($medalla) && !empty($usuario) || !empty($post) || !empty($foto)){
		if($usuario){
		$yeltipo = 'AND m_type = \'1\'';
		}elseif($post){
		$yeltipo = 'AND m_type = \'2\'';
		}elseif($foto){
		$yeltipo = 'AND m_type = \'3\'';
		}
		if(db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT medal_id FROM w_medallas WHERE medal_id = \''.(int)$medalla.'\' '.$yeltipo.' LIMIT 1'))) {
	    $_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
        if(filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) {
		
		if($usuario){
		if(db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT user_id FROM u_miembros WHERE LOWER(user_name) = \''.$tsCore->setSecure($usuario).'\' LIMIT 1'))) {
		if(!db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT id FROM w_medallas_assign WHERE medal_id = \''.(int)$medalla.'\' && medal_for = \''.(int)$user_id.'\' LIMIT 1'))) {
		if(db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO `w_medallas_assign` (`medal_id`, `medal_for`, `medal_date`, `medal_ip`) VALUES (\''.(int)$medalla.'\', \''.(int)$user_id.'\', \''.time().'\', \''.$_SERVER['REMOTE_ADDR'].'\')') or die (show_error('Error al ejecutar la consulta de la l&iacute;nea '.__LINE__.' de '.__FILE__.'.', 'db'))){
		if(db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO u_monitor (user_id, obj_uno, not_type, not_date) VALUES (\''.(int)$user_id.'\', \''.(int)$medalla.'\', \'15\', \''.time().'\')')){
		$continuar = true;
		}else return 'Ocurri&oacute; un error al notificar al usuario';
		}else return 'Ocurri&oacute; un error al asignar la medalla';
		}else return '0: El usuario ya tiene esa medalla';
		}else return '0: El usuario no existe';
		
        }elseif($post){
		if(db_exec('num_rows', $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT post_id, post_user FROM p_posts WHERE post_id = \''.(int)$post.'\' LIMIT 1'))){
		$datosdelpost = db_exec('fetch_assoc', $query);
        
	    if(!db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT id FROM w_medallas_assign WHERE medal_id = \''.(int)$medalla.'\' && medal_for = \''.(int)$post.'\' LIMIT 1'))) {
		if(db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO `w_medallas_assign` (`medal_id`, `medal_for`, `medal_date`, `medal_ip`) VALUES (\''.(int)$medalla.'\', \''.(int)$post.'\', \''.time().'\', \''.$_SERVER['REMOTE_ADDR'].'\')') or die (show_error('Error al ejecutar la consulta de la l&iacute;nea '.__LINE__.' de '.__FILE__.'.', 'db'))){
        if(db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO u_monitor (user_id, obj_uno, obj_dos, not_type, not_date) VALUES (\''.(int)$datosdelpost['post_user'].'\', \''.(int)$medalla.'\', \''.(int)$post.'\', \'16\', \''.time().'\')')){
		$continuar = true;
		}else return 'Ocurri&oacute; un error al notificar al usuario';
		}else return 'Ocurri&oacute; un error al asignar la medalla';
		}else return '0: El post ya tiene esa medalla';
	    }else return '0: El post no existe';
	    
		}elseif($foto){
	    if(db_exec('num_rows', $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT foto_id, f_user FROM f_fotos WHERE foto_id = \''.(int)$foto.'\' LIMIT 1'))) {
		$datosdelafoto = db_exec('fetch_assoc', $query);
        
	    if(!db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT id FROM w_medallas_assign WHERE medal_id = \''.(int)$medalla.'\' && medal_for = \''.(int)$foto.'\' LIMIT 1'))) {
		if(db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO `w_medallas_assign` (`medal_id`, `medal_for`, `medal_date`, `medal_ip`) VALUES (\''.(int)$medalla.'\', \''.(int)$foto.'\', \''.time().'\', \''.$_SERVER['REMOTE_ADDR'].'\')') or die (show_error('Error al ejecutar la consulta de la l&iacute;nea '.__LINE__.' de '.__FILE__.'.', 'db'))){
        if(db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO u_monitor (user_id, obj_uno, obj_dos, not_type, not_date) VALUES (\''.(int)$datosdelafoto['f_user'].'\', \''.(int)$medalla.'\', \''.(int)$foto.'\', \'17\', \''.time().'\')')){
		$continuar = true;
		}else return 'Ocurri&oacute; un error al notificar al usuario';
		}else return 'Ocurri&oacute; un error al asignar la medalla';
		}else return '0: La foto ya tiene esa medalla';
	    }else return '0: La foto no existe';
	    
		}else{ return '0: No queda claro lo que quiere';}
	 
	 }else return '0: Su IP no se pudo validar';
	 }else return '0: La medalla no puede ser asignada porque no existe o no corresponde a este tipo de asignaci&oacute;n.';
	 }else return '0: Falta alg&uacute;n dato importante :R';
	 
	 if($continuar) { if(db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE w_medallas SET m_total = m_total + 1 WHERE medal_id = \''.(int)$medalla.'\'')) return '1: Medalla asignada'; else return 'La medalla se asign&oacute;, pero hubo un problema y el contador no se alter&oacute;'; }else return 'Hubo problemas, chacho';
 }
 
	 /**
     * @name delMedalla()
     * @access public
     * @uses Eliminamos una medalla
     * @param
     * @return chorros
     */
	public function DelMedalla(){
	    
		$medalla = intval($_POST['medal_id']);
        if(db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM w_medallas WHERE medal_id = \''.(int)$medalla.'\'')){
		if(db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM w_medallas_assign WHERE medal_id = \''.(int)$medalla.'\'')){
		return '1: La medalla se ha eliminado, usuario/post/foto ha dejado de tenerla.';
		}else return '0: Hubo un problema al matar al p&aacute;jaro, parece ser que se elimin&oacute; a la madre, pero quedan los hijos y te van a hacer mucho da&ntilde;o...';
		}else return '0: Hubo un problema al eliminar la medalla';
      
	}		

	/**
     * @name delAssign()
     * @access public
     * @uses Eliminamos la medalla asignada a un usuario/post/foto
     * @param
     * @return text
     */
	public function DelAssign(){
	    
		$asignacion = $_POST['aid'];
		$medalla = $_POST['mid'];
	    if(db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT id FROM w_medallas_assign WHERE id = \''.(int)$asignacion.'\' AND medal_id = \''.(int)$medalla.'\' LIMIT 1'))) {
		if(db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM w_medallas_assign WHERE id = \''.(int)$asignacion.'\'')){
		if(db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE w_medallas SET m_total = m_total - 1 WHERE medal_id = \''.(int)$medalla.'\'')){ 
		return '1: Asignaci&oacute;n eliminada';
		}else return '0: Se elimin&oacute; la asignaci&oacute;n, pero no se descont&oacute; de las estad&iiacute;sticas.';
		}else return '0: No se elimin&oacute; la asignaci&oacute;n, pero ahora sabemos que existe.';
        }else return '0: No se ha encontrado esa asignaci&oacute;n';		
    }
}