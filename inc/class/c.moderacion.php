<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Modelo para el control de las funciones de la moderación
 *
 * @name    c.moderacion.php
 * @author  PHPost Team
 */
class tsMod {

    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    // ADMINISTRAR \\
    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    /*
    getMods()
    */
    function getMods()
    {
        
        //
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT `user_id`, `user_name` FROM `u_miembros` WHERE `user_rango` = \'2\' ORDER BY `user_id`');
        //
        $data = result_array($query);
        //
        return $data;
    }
    /*
    getDenuncias()
    */
    function getDenuncias($type = 'posts')
    {
        // TIPO DE DENUNCIAS
        switch ($type)
        {
            case 'posts':
                $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT r.*, SUM(d_total) AS total, p.post_id, p.post_title, p.post_status, c.c_nombre, c.c_seo, c.c_img FROM w_denuncias AS r LEFT JOIN p_posts AS p ON r.obj_id = p.post_id LEFT JOIN p_categorias AS c ON p.post_category = c.cid WHERE d_type = 1 AND p.post_status < 2 GROUP BY r.obj_id ORDER BY total DESC, r.d_date DESC');
                $data = result_array($query);
                
                break;
            case 'fotos':
                $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT r.*, SUM(d_total) AS total, f.foto_id, f.f_title, f.f_status, u.user_id, u.user_name FROM w_denuncias AS r LEFT JOIN f_fotos AS f ON r.obj_id = f.foto_id LEFT JOIN u_miembros AS u ON f.f_user = u.user_id  WHERE d_type = \'4\' && f.f_status < 2 GROUP BY r.obj_id ORDER BY total DESC, r.d_date DESC');
                $data = result_array($query);
                
                break;
            case 'users':
                $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT r.*, SUM(d_total) AS total, u.user_name FROM w_denuncias AS r LEFT JOIN u_miembros AS u ON r.obj_id = u.user_id WHERE d_type = 3 AND u.user_baneado = 0 GROUP BY r.obj_id ORDER BY total, r.d_date DESC');
                $data = result_array($query);
                
                break;
            case 'mps':
                $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT r.*, m.mp_id, m.mp_to, m.mp_from, m.mp_subject, m.mp_preview, m.mp_date FROM w_denuncias AS r LEFT JOIN u_mensajes AS m ON r.obj_id = m.mp_id WHERE d_type = 2 GROUP BY r.obj_id ORDER BY r.d_date DESC');
                $data = result_array($query);
                
                break;
        }
        //
        return $data;
    }

    /*
    getDenuncia()
    */
    function getDenuncia($type = 'posts')
    {
        global $tsCore;
        // VARIABLES
        $obj = htmlspecialchars(intval($_GET['obj']));
        // TIPO DE DENUNCIA
        switch ($type)
        {
            case 'posts':
                $d_type = 1;
                $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT p.post_id, p.post_title, p.post_status, c.c_nombre, c.c_seo, c.c_img, u.user_name FROM p_posts AS p LEFT JOIN p_categorias AS c ON p.post_category = c.cid LEFT JOIN u_miembros AS u ON p.post_user = u.user_id WHERE p.post_id = ' .
                    $obj . ' LIMIT 1');
                break;
            case 'fotos':
                $d_type = 4;
                $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT f.foto_id, f.f_title, f.f_status, u.user_name FROM f_fotos AS f LEFT JOIN u_miembros AS u ON f.f_user = u.user_id WHERE f.foto_id = ' .
                    $obj . ' LIMIT 1');
                break;
            case 'users':
                $d_type = 3;
                $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT user_id, user_name FROM u_miembros WHERE user_id = ' .
                    $obj . ' LIMIT 1');
                break;
            case 'mps':
                $d_type = 2;
                // AQUÍ LA CONSULTA	PARA MOSTRAR LOS DENUNCIANTES Y OTROS DATOS (?
                $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT user_id, user_name FROM u_miembros WHERE user_id = ' .
                    $obj . ' LIMIT 1');

        }
        // CARGAMOS AL ARRAY...
        $data['data'] = db_exec('fetch_assoc', $query);
        
        // DENUNCIAS
        $query = db_exec(array(__FILE__, __LINE__), 'query', "SELECT d.*, u.user_id, u.user_name FROM w_denuncias AS d LEFT JOIN u_miembros AS u ON d.d_user = u.user_id WHERE d.obj_id = {$obj} AND d.d_type = {$d_type}");
        $data['denun'] = result_array($query);
        
        //
        return $data;
    }

    function getContenido()
    {
        global $tsCore, $tsUser;
        //
        $texto = $tsCore->setSecure($_GET['texto']);
        $tipo = intval($_GET['t']);
        $metodo = intval($_GET['m']);
        if (empty($texto) || empty($texto))
            $tsCore->redirectTo($tsCore->settings['url'] . '/moderacion/buscador');

        if ($metodo == 1)
            $met = 'LIKE \'%' . $texto . '%\'';
        else
            $met = ' = \'' . $texto . '\'';
        //
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT m.pub_id, m.p_user, m.p_user_pub, m.p_ip, m.p_date, m.p_body, u.user_id, u.user_name FROM u_muro AS m LEFT JOIN u_miembros AS u ON m.p_user_pub = u.user_id WHERE ' .
            ($tipo == 1 ? 'm.p_ip' : 'm.p_body') . '  ' . $met);
        $data['muro'] = result_array($query);
        $data['m_total'] = count($data['muro']);
        
        //
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT user_id, user_name, user_last_ip, user_lastlogin, user_lastactive FROM u_miembros WHERE ' .
            ($tipo == 1 ? 'user_last_ip' : 'user_name') . ' ' . $met .
            ' ORDER BY user_lastactive DESC');
        $data['usuarios'] = result_array($query);
        $data['u_total'] = count($data['usuarios']);
        
        //
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT p.post_id, p.post_user, p.post_title, p.post_date, p.post_ip, u.user_name, c.c_nombre, c.c_seo, c.c_img FROM p_posts AS p LEFT JOIN u_miembros AS u ON p.post_user = u.user_id LEFT JOIN p_categorias AS c ON c.cid = p.post_category WHERE ' .
            ($tipo == 1 ? 'p.post_ip ' . $met . '' : 'p.post_title ' . $met .
            ' OR p.post_body ' . $met));
        $data['posts'] = result_array($query);
        $data['p_total'] = count($data['posts']);
        
        //
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT f.foto_id, f.f_title, f.f_user, f.f_date, f.f_ip, u.user_name FROM f_fotos AS f LEFT JOIN u_miembros AS u ON f.f_user = u.user_id WHERE ' .
            ($tipo == 1 ? 'f.f_ip ' . $met . '' : 'f.f_title ' . $met .
            ' OR f.f_description ' . $met));
        $data['fotos'] = result_array($query);
        $data['f_total'] = count($data['fotos']);
        
        //
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT u.user_id, u.user_name, c.* FROM p_comentarios AS c LEFT JOIN u_miembros AS u ON u.user_id = c.c_user WHERE ' .
            ($tipo == 1 ? 'c.c_ip ' . $met . '' : 'c.c_user ' . $met . ' OR c.c_body ' . $met));
        $data['p_comentarios'] = result_array($query);
        
        $data['c_p_total'] = count($data['p_comentarios']);
        //
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT u.user_id, u.user_name, f.* , c.* FROM f_comentarios AS c LEFT JOIN u_miembros AS u ON u.user_id = c.c_user LEFT JOIN f_fotos AS f ON f.foto_id = c.c_foto_id WHERE ' .
            ($tipo == 1 ? 'c.c_ip ' . $met . '' : 'c.c_user ' . $met . ' OR c.c_body ' . $met));
        $data['f_comentarios'] = result_array($query);
        
        $data['c_f_total'] = count($data['f_comentarios']);
        //
        $data['contenido'] = $texto;
        $data['metodo'] = $metodo;
        $data['tipo'] = $tipo;
        //
        return $data;
    }

    /*
    getPreview()
    */
    function getPreview($pid)
    {
        global $tsCore;
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT `post_title`, `post_body` FROM `p_posts` WHERE `post_id` = \'' .
            $pid . '\' LIMIT 1');
        $data = db_exec('fetch_assoc', $query);
        
        //
        return array('titulo' => $data['post_title'], 'cuerpo' => $tsCore->parseBBCode($data['post_body']));
    }
    /**
     * @name rebootPost()
     * @access public
     * @param int
     * @return string
     */
    public function rebootPost($pid)
    {
        global $tsUser;
        if ($tsUser->is_admod || $tsUser->permisos['mocdp'])
        {
            // PRIMERO COMPROBAMOS SI ESTÁ OCULTO
            $datos = db_exec('fetch_assoc', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT post_id, post_status FROM p_posts WHERE post_id = \'' .
                (int)$pid . '\' LIMIT 1'));
            if ($datos['post_status'] == 3)
            {
                if (!db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM `w_historial` WHERE `pofid` = \'' . (int) $pid . '\' && `type` = \'1\' && `action` = \'3\''))
                    return '0: No se pudo restaurar el post.';
            } else
            {
                //BORRAMOS LA DENUNCIAS
                if (!db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM `w_denuncias` WHERE `obj_id` = \'' . (int) $pid . '\' AND `d_type` = \'1\''))
                    return '0: No se pudo restaurar el post.';
            }
            // REGRESAMOS EL POST
            if (db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `p_posts` SET `post_status` = \'0\' WHERE `post_id` = \'' .
                $pid . '\''))
            {
                db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `w_stats` SET `stats_posts` = stats_posts + \'1\' WHERE `stats_no` = \'1\'');
                return '1: El post ha sido restaurado.';
            } else
                return '0: No se pudo restaurar el post.';
        } else
            return '0: No sigas haciendo el rid&iacute;culo';
    }

    public function OcultarPost($pid, $razon)
    {
        global $tsUser;
        if ($tsUser->is_admod || $tsUser->permisos['moop'])
        {
            if (!db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT post_id FROM p_posts WHERE post_id = \'' .
                (int)$pid . '\' && post_status = \'3\'')))
            {
                if (db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE p_posts SET post_status = \'3\' WHERE post_id = \'' . (int)
                    $pid . '\''))
                {
                    if (db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO `w_historial` (`pofid`, `action`, `type`, `mod`, `reason`, `date`, `mod_ip`) VALUES (\'' .
                        (int)$pid . '\', \'3\', \'1\', \'' . $tsUser->uid . '\', \'' . $razon . '\', \'' .
                        time() . '\', \'' . $_SERVER['REMOTE_ADDR'] . '\')'))
                    {
                        db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `w_stats` SET `stats_posts` = stats_posts - \'1\' WHERE `stats_no` = \'1\'');
                        return '1: El post ha sido ocultado.';
                    } else
                        return '0: No se pudo registrar la acci&oacute;n.';
                } else
                    return '0: No se pudo ocultar el post.';
            } else
                return '0: El post... ya est&aacute; oculto.';
        } else
            return '0: No contin&ueacute;s por aqu&iacute;.';
    }

    function rebootMps($mid)
    {
        global $tsUser;
        if ($tsUser->is_admod || $tsUser->permisos['mocdm'])
        {
            $rows = db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT obj_id FROM w_denuncias WHERE obj_id = \'' .
                (int)$mid . '\' AND `d_type` = \'2\''));
            if ($rows && $tsUser->is_admod)
            {
                $canview = true;
            }
            //BORRAMOS LA DENUNCIA
            if (db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM `w_denuncias` WHERE `obj_id` = \'' . (int)$mid . '\' AND `d_type` = \'2\''))
            {
                db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `u_mensajes` SET mp_del_to = \'0\', mp_del_from = \'0\' WHERE `mp_id` = \'' .
                    (int)$mid . '\'');
                return '1: Denuncia eliminada';
            } else
                return '0: No se pudo eliminar la denuncia';
        } else
            return '0: No contin&uacute;e por aqu&iacute;.';
    }

    function rebootFoto($fid)
    {
        global $tsUser;
        if ($tsUser->is_admod || $tsUser->permisos['mocdf'])
        {

            $rows = db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT obj_id FROM w_denuncias WHERE obj_id = \'' .
                (int)$mid . '\' AND `d_type` = \'4\''));
            if ($rows && $tsUser->is_admod)
            {
                $canview = true;
            }
            //BORRAMOS LA DENUNCIA
            if (db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM `w_denuncias` WHERE `obj_id` = \'' . (int)$fid . '\' AND `d_type` = \'4\''))
            {
                db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `f_fotos` SET f_status= \'0\' WHERE `foto_id` = \'' . (int)
                    $fid . '\'');
                return '1: Denuncia eliminada';
            } else
                return '0: No se pudo eliminar la denuncia';
        } else
            return '0: No contin&uacute;e por aqu&iacute;.';
    }
    /**
     * @name deletePost($pid)
     * @access public
     * @param int
     * @return string
     */
    public function deletePost($pid)
    {
        global $tsCore, $tsMonitor, $tsUser;

        if ($tsUser->is_admod || $tsUser->permisos['moep'])
        {

            // RAZON
            //wtf jneutron, acostumbrate a filtrar las variables
            $razon = $tsCore->setSecure($_POST['razon']);
            $razon_desc = $tsCore->setSecure($_POST['razon_desc']);
            $razon_db = ($razon != 13) ? $razon : $razon_desc;
            //
            if (db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `p_posts` SET `post_status` = \'2\' WHERE `post_id` = \'' .
                $pid . '\''))
            {
                // ELIMINAR DENUNCIAS
                db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM `w_denuncias` WHERE `obj_id` = \'' . $pid . '\' AND `d_type` = \'1\'');
                // ENVIAR AVISO
                $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT p.post_user, p.post_title, p.post_body, p.post_tags, p.post_category, u.user_name, u.user_email FROM p_posts AS p LEFT JOIN u_miembros AS u ON p.post_user = u.user_id WHERE p.post_id = \'' .
                    (int)$pid . '\' LIMIT 1');
                $data = db_exec('fetch_assoc', $query);
                
                // RAZON
                if (is_numeric($razon_db))
                {
                    include (TS_EXTRA . 'datos.php');
                    $razon_db = $tsDenuncias['posts'][$razon_db];
                }
                
                db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `w_stats` SET `stats_posts` = stats_posts - \'1\' WHERE `stats_no` = \'1\'');

                //AGREGAMOS A BORRADORES si se ha marcado la casilla
                if ($_POST['send_b'] == 'yes')
                    db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO `p_borradores` (b_user, b_date, b_title, b_body, b_tags, b_category, b_status, b_causa) VALUES (\'' .
                        $data['post_user'] . '\', \'' . time() . '\', \'' . $data['post_title'] . '\', \'' .
                        $data['post_body'] . '\', \'' . $data['post_tags'] . '\', \'' . $data['post_category'] .
                        '\', \'1\', \'' . $razon_db . '\')');

                // AVISO
                $aviso = 'Hola <b>' . $data['user_name'] . "</b>\n\n Lamento contarte que tu post titulado <b>" .
                    $data['post_title'] . "</b> ha sido eliminado.\n\n Causa: <b>" . $razon_db .
                    "</b>\n\n Te recomendamos leer el <a href=\"" . $tsCore->settings['url'] .
                    "/pages/protocolo/\">Protocolo</a> para evitar futuras sanciones.\n\n Muchas gracias por entender!";
                $status = $tsMonitor->setAviso($data['post_user'], 'Post eliminado', $aviso, 1);
                //
                //mail($data['user_email'], 'Post eliminado', $aviso);
                $status = $this->setHistory('borrar', 'post', $pid);
                if ($status == true)
                    return '1: El post ha sido eliminado.';
            }
            //
            return '0: El post NO pudo ser eliminado.';
        } else
            return '0: No deber&iacute;as continuar con esto.';
    }

    public function deleteMps($mid)
    {
        global $tsCore, $tsMonitor, $tsUser;

        if ($tsUser->is_admod || $tsUser->permisos['moadm'])
        {
            // ENVIAR AVISO
            if ($query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT m.mp_from, m.mp_subject, u.user_name FROM u_mensajes AS m LEFT JOIN u_miembros AS u ON m.mp_from = u.user_id WHERE m.mp_id = \'' .
                (int)$mid . '\' LIMIT 1'))
            {
                $data = db_exec('fetch_assoc', $query);
                
                // AVISO
                $aviso = 'Hola <b>' . $data['user_name'] . "</b>\n\n Le informo de que el mensaje privado <b>" .
                    $data['mp_subject'] . "</b> ha sido eliminado.\n\n Te recomendamos leer el <a href=\"" .
                    $tsCore->settings['url'] . "/pages/protocolo/\">Protocolo</a> para evitar futuras sanciones.\n\n Muchas gracias por entender!";
                $status = $tsMonitor->setAviso($data['mp_from'], 'Mensaje eliminado', $aviso, 1);
                // ELIMINAR DENUNCIAS
                db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM `w_denuncias` WHERE `obj_id` = \'' . (int)$mid . '\' AND `d_type` = \'2\'');
                //LOS MPS SE ELIMINARAN DE LA LISTA DE MPS DEL USUARIO, PERO NO SE BORRARÁN.
                db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `u_mensajes` SET mp_del_to = \'1\', mp_del_from = \'1\' WHERE `mp_id` = \'' .
                    (int)$mid . '\'');
                // ELIMINAR MPS (Si quiere elimninarlos en vez de ocultarlos, descomente las dos siguientes líneas y comente la anterior "UPDATE")
                //db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM `u_respuestas` WHERE `mp_id` = \''.$mid.'\'');
                //db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM `u_mensajes`   WHERE `mp_id` = \''.$mid.'\'');
                //

                return '1: El mensaje ha sido eliminado.';
            }
            return '0: El mensaje NO pudo ser eliminado.';
        } else
            return '0: No deber&iacute;as continuar con esto.';
    }

    public function deleteFoto($fid)
    {
        global $tsCore, $tsMonitor, $tsUser;

        if ($tsUser->is_admod || $tsUser->permisos['moadf'] || $tsUser->permisos['moef'])
        {

            // RAZON
            $razon = $tsCore->setSecure($_POST['razon']);
            $razon_desc = $tsCore->setSecure($_POST['razon_desc']);
            $razon_db = ($razon != 8) ? $razon : $razon_desc;
            //
            if (db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `f_fotos` SET `f_status` = \'2\' WHERE `foto_id` = \'' .
                $fid . '\''))
            {
                db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `w_stats` SET `stats_fotos` = stats_fotos - \'1\' WHERE `stats_no` = \'1\'');
                if ($data['f_user'] != $tsUser->uid)
                {
                    // ENVIAR AVISO
                    $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT f.f_user, f.f_title, u.user_name FROM f_fotos AS f LEFT JOIN u_miembros AS u ON f.f_user = u.user_id WHERE f.foto_id = \'' .
                        (int)$fid . '\' LIMIT 1');
                    $data = db_exec('fetch_assoc', $query);
                    
                    // RAZON
                    if (is_numeric($razon_db))
                    {
                        include (TS_EXTRA . 'datos.php');
                        $razon_db = $tsDenuncias['fotos'][$razon_db];
                    }
                    // AVISO
                    $aviso = 'Hola <b>' . $data['user_name'] . "</b>\n\n Lamento contarte que tu foto titulada <b>" .
                        $data['f_title'] . "</b> ha sido eliminada.\n\n Causa: <b>" . $razon_db . "</b>\n\n Te recomendamos leer el <a href=\"" .
                        $tsCore->settings['url'] . "/pages/protocolo/\">Protocolo</a> para evitar futuras sanciones.\n\n Muchas gracias por entender!";
                    $status = $tsMonitor->setAviso($data['f_user'], 'Foto eliminada', $aviso, 1);
                    //
                }
                // ELIMINAR DENUNCIAS
                db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM `w_denuncias` WHERE `obj_id` = \'' . $fid . '\' AND `d_type` = \'4\'');
                $this->setHistory('borrar', 'foto', $fid);
                return '1: La foto ha sido eliminada.';
            }
            //
            return '0: La foto NO pudo ser eliminada.';

        } else
            return '0: No deber&iacute;as continuar con esto.';


    }
    /**
     * @name setSticky
     * @access public
     * @param $post_id
     * @return string
     * @info Pone sticky un post
     */
    public function setSticky($post_id)
    {
        global $tsUser;
        //
        if ($tsUser->is_admod || $tsUser->permisos['most'])
        {
            //
            $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT `post_sticky` FROM `p_posts` WHERE `post_id` = \'' .
               (int) $post_id . '\' LIMIT 1');
            $data = db_exec('fetch_assoc', $query);
            
            // COMPROBAMOS

            if ($data['post_sticky'] == 1)
            {
                db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `p_posts` SET `post_sticky` = \'0\' WHERE `post_id` = \'' .
                   (int) $post_id . '\'');
                return '1: El post fue quitado de la home.';
            } else
            {
                db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `p_posts` SET `post_sticky` = \'1\' WHERE `post_id` = \'' .
                    (int) $post_id . '\'');
                return '1: El post fue puesto como fijo en la web.';
            }
        } else
            return '0: Creo que no deber&iacute;as continuar con esto';
    }
    /**
     * @name setOpenClosed
     * @access public
     * @param $post_id
     * @return string
     * @info Abre o Cierra un post.
     */
    public function setOpenClosed($post_id)
    {
        global $tsUser;
        //
        if ($tsUser->is_admod || $tsUser->permisos['moayca'])
        {
            //
            $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT `post_block_comments` FROM `p_posts` WHERE `post_id` = \'' .
                (int) $post_id . '\' LIMIT 1');
            $data = db_exec('fetch_assoc', $query);
            
            // COMPROBAMOS

            if ($data['post_block_comments'] == 1)
            {
                if (db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `p_posts` SET `post_block_comments` = \'0\' WHERE `post_id` = \'' .
                    (int) $post_id . '\''))
                    return '1: El post fue abierto.';
                else
                    return '0: Hubo un error al abrir el post';
            } else
            {
                if (db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `p_posts` SET `post_block_comments` = \'1\' WHERE `post_id` = \'' .
                    (int) $post_id . '\''))
                    return '1: El post fue cerrado.';
                else
                    return '0: Hubo un error al cerrar el post';
            }
        } else
            return '0: Creo que no deber&iacute;as hacer esto';
    }
    /**
     * @name getSuspendidos
     * @access public
     * @param
     * @return array
     * @info OBTIENE LOS USUARIOS SUSPENDIDOS
     */
    public function getSuspendidos()
    {
        global $tsCore, $tsUser;
        #

        if ($tsUser->is_admod || $tsUser->permisos['movub'])
        { // Para más seguridad, no se cargarán datos si no tiene permisos.

            $max = 20; // MAXIMO A MOSTRAR
            $limit = $tsCore->setPageLimit($max, true);

            //FILTROS
            if ($_GET['o'] == 'inicio')
                $order = 's.susp_date';
            elseif ($_GET['o'] == 'fin')
                $order = 's.susp_termina';
            elseif ($_GET['o'] == 'mod')
                $order = 's.susp_mod';
            else
                $order = 's.susp_id';

            if ($_GET['m'] == 'a')
                $met = 'ASC';
            else
                $met = 'DESC';

            $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT s.*, u.user_name FROM u_suspension AS s LEFT JOIN u_miembros AS u ON s.user_id = u.user_id WHERE 1 ORDER BY ' .
                $order . ' ' . $met . ' LIMIT ' . $limit);
            $data['bans'] = result_array($query);
            
            // PAGINAS
            $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(*) FROM u_suspension WHERE user_id > \'0\'');
            list($total) = db_exec('fetch_row', $query);
            
            $data['pages'] = $tsCore->pageIndex($tsCore->settings['url'] .
                "/moderacion/banusers?o=" . $_GET['o'] . "&m=" . $_GET['m'] . "", $_GET['s'], $total,
                $max);
            //
        }
        //
        return $data;

    }
    /**
     * @name banUser
     * @access public
     * @param int
     * @return string
     * @info PARA SUSPENDER A UN USUARIO
     */
    public function banUser($user_id)
    {
        # GLOBALES
        global $tsUser, $tsCore;
        # LOCALES
        $b_time = $tsCore->setSecure($_POST['b_time']);
        $b_cant = empty($_POST['b_cant']) ? 1 : $_POST['b_cant'];
        $b_causa = $tsCore->setSecure($_POST['b_causa']);
        $b_times = array(
            0,
            1,
            3600,
            86400); // HORA, DIA
        # NO INTENTO BANEARME?
        if ($user_id == $tsUser->uid)
            return '0: Si quieres abandonar la web, m&aacute;ndale un mp al admin';
        # NO ES HORARIO VÁLIDO?
        if ($b_cant < 1 || !is_numeric($b_cant))
            return '0: Debe introducir en n&uacute;meros una cantidad superior a 60 minutos (1)';
        # COMPROBAMOS RANGOS
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT `user_rango`, `user_baneado` FROM `u_miembros` WHERE `user_id` = \'' .
            (int)$user_id . '\' LIMIT 1');
        $data = db_exec('fetch_assoc', $query);
        
        if ($data['user_baneado'] == 0)
        {
            # Y SI QUIERO SUSPENDER A UN ADMIN o MOD?
            if (($tsUser->is_admod < $data['user_rango'] && $tsUser->is_admod > 0) || ($tsUser->
                permisos['mosu'] && $data['user_rango'] >= 2))
            {
                // TIEMPO
                $ahora = time();
                $termina = ($b_cant * $b_times[$b_time]);
                $termina = ($b_time >= 2) ? ($ahora + $termina) : $termina;

                $_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] :
                    $_SERVER['REMOTE_ADDR'];
                if (!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP))
                {
                    die('0: Su ip no se pudo validar.');
                }

                // ACTUALIZAMOS
                db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `u_miembros` SET `user_baneado` = \'1\' WHERE `user_id` = \'' .
                    (int)$user_id . '\'');
                if (db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO `u_suspension` (`user_id`, `susp_causa`, `susp_date`, `susp_termina`, `susp_mod`, `susp_ip`) VALUES (\'' .
                    (int)$user_id . '\', \'' . $b_causa . '\', \'' . (int)
                    $ahora . '\',  \'' . (int)$termina . '\', \'' . $tsUser->uid . '\', \'' .
                    $tsCore->setSecure($_SERVER['REMOTE_ADDR']) . '\')'))
                {
                    // ELIMINAR DENUNCIAS
                    db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM `w_denuncias` WHERE `obj_id` = \'' . (int)$user_id . '\' AND `d_type` = \'3\'');
                    // RESTAR USUARIO EN ESTADÍSTICAS
                    db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `w_stats` SET `stats_miembros` = stats_miembros - \'1\' WHERE `stats_no` = \'1\'');
                    // RETORNAR
                    if ($b_time < 2)
                    {
                        $rdate = ($b_time == 0) ? 'Indefinidamente' : 'Permanentemente';
                    } else
                        $rdate = '</b>hasta el <b>' . date("d/m/Y H:i:s", $termina);
                    //
                    return '1: Usuario suspendido <b>' . $rdate . '</b>';
                }
                return '0: El usuario no pudo ser suspendido';
            } else
                return '0: No puedes suspender a usuarios de tu mismo rango o superior al tuyo.';
        } else
            return '0: Este usuario ya fue suspendido';
    }


    /**
     * @name rebootUser
     * @access public
     * @param int
     * @return string
     * @info ELIMINA LAS DENUNCIAS DEL USUARIO O LE QUITA UNA SUSPENSION
     */
    public function rebootUser($user_id, $type = 'unban')
    {
        # GLOBALES
        global $tsUser;

        if ($tsUser->is_admod || $tsUser->permisos['modu'])
        {
            # PRIMERO BORRAMOS LA DENUNCIAS
            db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM `w_denuncias` WHERE `obj_id` = \'' . (int)$user_id . '\' AND `d_type` = \'3\'');
            // HAY QUE QUITAR LA SUSPENSION?
            if ($type == 'unban')
            {
                $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT `susp_mod` FROM `u_suspension` WHERE `user_id` = \'' .
                    (int)$user_id . '\'');
                $data = db_exec('fetch_assoc', $query);
                
                //
                if (empty($data))
                    return '0: El usuario no est&aacute; suspendido.';
                //
                if ($tsUser->is_admod == 1 || $data['susp_mod'] == $tsUser->uid)
                {
                    db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM `u_suspension` WHERE `user_id` = \'' . (int)$user_id .
                        '\'');
                    db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `u_miembros` SET `user_baneado` = \'0\' WHERE `user_id` = \'' .
                        (int)$user_id . '\'');
                    db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `w_stats` SET `stats_miembros` = stats_miembros + \'1\' WHERE `stats_no` = \'1\'');
                    return '1: El usuario fue reactivado y ahora podr&aacute; seguir activo en la web.';
                } else
                    return '0: S&oacute;lo puedes quitar la suspensi&oacute;n a los usuarios que t&uacute; suspendiste.';
            }
            //
            return '1: Las denuncias fueron eliminadas.';

        } else
            return '0: Creo que no deber&iacute;as hacer esto';
    }
    /**
     * @name deletePost
     * @access public
     * @param int
     * @return string
     */
    public function setHistory($action, $type, $data)
    {
        global $tsUser, $tsMonitor, $tsCore;
        //
        if ($type == 'post')
        {
            switch ($action)
            {
                case 'borrar':
                    // RAZON
                    $razon = $tsCore->setSecure($_POST['razon']);
                    $razon_desc = $tsCore->setSecure($_POST['razon_desc']);
                    $razon_db = ($razon != 13) ? $razon : $razon_desc;
                    // DATOS
                    $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT `post_id`, `post_body`, `post_title`, `post_user`, `post_category` FROM `p_posts` WHERE `post_id` = \'' .(int)$data . '\' LIMIT 1');
                    $post = db_exec('fetch_assoc', $query);
                    
                    // INSERTAR
                    if ($post['post_user'] != $tsUser->uid)
                        db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO w_historial (`pofid`, `action`, `type`, `mod`, `reason`, `date`, `mod_ip`) VALUES (\'' .
                            (int)$post['post_id'] . '\', \'2\', \'1\', \'' . $tsUser->uid . '\', \'' .
                            $razon_db . '\', \'' . time() . '\', \'' .
                            $_SERVER['REMOTE_ADDR'] . '\')');
                    return true;
                    break;
                    // EDITAR
                case 'editar':
                    $aviso = 'Hola <b>' . $tsUser->getUserName($data['autor']) . "</b>\n\n Te informo que tu post <b>" .
                        $data['title'] . "</b> ha sido editado por <a href=\"#\" class=\"hovercard\" uid=\"" .
                        $tsUser->uid . "\">" . $tsUser->nick . "</a>\n\n Causa: <b>" . $data['razon'] .
                        "</b>\n\n \n\n Te recomendamos leer el <a href=\"" . $tsCore->settings['url'] .
                        "/pages/protocolo/\">protocolo</a> para evitar futuras sanciones.\n\n Muchas gracias por entender!";
                    $tsMonitor->setAviso($data['autor'], 'Post editado', $aviso, 2);
                    $_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] :$_SERVER['REMOTE_ADDR'];
                    if (!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP))
                    {
                        die('Su ip no se pudo validar.');
                    }
                    db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO `w_historial` (`pofid`, `action`, `type`, `mod`, `reason`, `date`, `mod_ip`) VALUES (\'' .
                        (int)$data['post_id'] . '\', \'1\', \'1\', \'' . $tsUser->uid . '\', \'' . $data['razon'] .
                        '\', \'' . time() . '\', \'' . $_SERVER['REMOTE_ADDR'] . '\')');
                    return 1;
                    break;
            }

        } elseif ($type == 'foto')
        {
            // DATOS
            $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT `foto_id`, `f_description`, `f_title`, `f_user` FROM `f_fotos` WHERE `foto_id` = \'' .
                (int)$data . '\' LIMIT 1');
            $foto = db_exec('fetch_assoc', $query);
            
            switch ($action)
            {
                case 'borrar':
                    // RAZON
                    $razon = $tsCore->setSecure($_POST['razon']);
                    $razon_desc = $tsCore->setSecure($_POST['razon_desc']);
                    $razon_db = ($razon != 8) ? $razon : $razon_desc;
                    // INSERTAR
                    db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO w_historial (`pofid`, `action`, `type`, `mod`, `reason`, `date`, `mod_ip`) VALUES (\'' .
                        (int)$foto['foto_id'] . '\', \'2\', \'2\', \'' . $tsUser->uid . '\', \'' .
                        $tsCore->setSecure($razon_db) . '\', \'' . time() . '\', \'' .
                        $tsCore->setSecure($_SERVER['REMOTE_ADDR']) . '\')');
                    return true;
                    break;
            }
        }
    }

    public function getPospelera()
    {
        global $tsUser, $tsCore;
        //
        $max = 20; // MAXIMO A MOSTRAR
        $limit = $tsCore->setPageLimit($max, true);

        // PAGINAS
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(*) FROM p_posts AS p LEFT JOIN u_miembros AS u ON u.user_id = p.post_user LEFT JOIN w_historial AS h ON h.pofid = p.post_id LEFT JOIN p_categorias AS c ON c.cid = p.post_category  WHERE h.type = \'1\' AND h.action = \'2\'');
        list($total) = db_exec('fetch_row', $query);
        
        $data['pages'] = $tsCore->pageIndex($tsCore->settings['url'] .
            "/moderacion/pospelera?", $_GET['s'], $total, $max);
        //

        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT u.user_id, u.user_name, h.*, p.post_id, p.post_title, c.c_seo, c.c_nombre FROM p_posts AS p LEFT JOIN u_miembros AS u ON u.user_id = p.post_user LEFT JOIN w_historial AS h ON h.pofid = p.post_id LEFT JOIN p_categorias AS c ON c.cid = p.post_category  WHERE h.type = \'1\' AND h.action = \'2\' AND p.post_status = \'2\' LIMIT ' .
            $limit);
        // DENUNCIAS
        include ("../ext/datos.php");
        //
        while ($row = db_exec('fetch_assoc', $query))
        {
            $row['mod_name'] = $tsUser->getUserName($row['mod']);
            $row['reason'] = (is_numeric($row['reason'])) ? $tsDenuncias['posts'][$row['reason']] :
                $tsCore->setSecure($row['reason']);
            //
            $data['datos'][] = $row;
        }
        //
        return $data;
    }

    public function getFopelera()
    {
        global $tsUser, $tsCore;
        //
        $max = 20; // MAXIMO A MOSTRAR
        $limit = $tsCore->setPageLimit($max, true);

        // PAGINAS
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(*) FROM f_fotos AS f LEFT JOIN u_miembros AS u ON u.user_id = f.f_user LEFT JOIN w_historial AS h ON h.pofid = f.foto_id WHERE h.type = \'2\' AND h.action = \'2\' AND f.f_status = \'2\'');

        list($total) = db_exec('fetch_row', $query);
        
        $data['pages'] = $tsCore->pageIndex($tsCore->settings['url'] .
            "/moderacion/fopelera?", $_GET['s'], $total, $max);
        //

        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT u.user_id, u.user_name, h.*, f.foto_id, f.f_title, f.f_user FROM f_fotos AS f LEFT JOIN u_miembros AS u ON u.user_id = f.f_user LEFT JOIN w_historial AS h ON h.pofid = f.foto_id WHERE h.type = \'2\' AND h.action = \'2\' AND f.f_status = \'2\' LIMIT ' .
            $limit);
        // DENUNCIAS
        include ("../ext/datos.php");
        //
        while ($row = db_exec('fetch_assoc', $query))
        {
            $row['mod_name'] = $tsUser->getUserName($row['mod']);
            $row['reason'] = (is_numeric($row['reason'])) ? $tsDenuncias['fotos'][$row['reason']] :
                $tsCore->setSecure($row['reason']);
            //
            $data['datos'][] = $row;
        }
        //
        return $data;
    }

    public function getComentariosD()
    {
        global $tsUser, $tsCore;
        //
        $max = 20; // MAXIMO A MOSTRAR
        $limit = $tsCore->setPageLimit($max, true);

        // PAGINAS
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(*) FROM p_comentarios AS c LEFT JOIN u_miembros AS u ON u.user_id = c.c_user WHERE c.c_status = \'1\'');

        list($total) = db_exec('fetch_row', $query);
        
        $data['pages'] = $tsCore->pageIndex($tsCore->settings['url'] .
            "/moderacion/comentarios?", $_GET['s'], $total, $max);
        //

        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT u.user_id, u.user_name, c.cid, c.c_user, c.c_post_id, c.c_date, c.c_body, c.c_ip, p.post_id, p.post_title, cat.c_seo, cat.c_nombre FROM p_comentarios AS c LEFT JOIN p_posts AS p ON c.c_post_id = p.post_id LEFT JOIN p_categorias AS cat ON cat.cid = p.post_category  LEFT JOIN u_miembros AS u ON u.user_id = c.c_user WHERE c.c_status = \'1\' ORDER BY c.c_date DESC LIMIT ' .
            $limit);
        $data['datos'] = result_array($query);
        

        //
        return $data;
    }

    public function getPostsD()
    {
        global $tsUser, $tsCore;
        //
        $max = 20; // MAXIMO A MOSTRAR
        $limit = $tsCore->setPageLimit($max, true);

        // PAGINAS
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(*) FROM p_posts AS p LEFT JOIN u_miembros AS u ON u.user_id = p.post_user WHERE p.post_status = \'3\'');

        list($total) = db_exec('fetch_row', $query);
        
        $data['pages'] = $tsCore->pageIndex($tsCore->settings['url'] .
            "/moderacion/revposts?", $_GET['s'], $total, $max);
        //
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT u.user_id, u.user_name, h.*, p.post_id, p.post_title, c.c_seo, c.c_nombre FROM p_posts AS p LEFT JOIN w_historial AS h ON h.pofid = p.post_id LEFT JOIN p_categorias AS c ON c.cid = p.post_category LEFT JOIN u_miembros AS u ON u.user_id = h.mod  WHERE h.type = \'1\' AND h.action = \'3\' AND p.post_status = \'3\' LIMIT ' .
            $limit);
        $data['datos'] = result_array($query);
        
        //
        return $data;
    }

    /**
     * @name getHistory()
     * @access public
     * @param
     * @return array
     */
    public function getHistory($type)
    {
        global $tsUser, $tsCore;
        //
        if ($type == 1)
            $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT u.user_id, u.user_name, h.*, p.post_id, p.post_title FROM p_posts AS p LEFT JOIN u_miembros AS u ON u.user_id = p.post_user LEFT JOIN w_historial AS h ON h.pofid = p.post_id WHERE h.type = \'1\' ORDER BY h.id DESC LIMIT 20');
        else
            $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT u.user_id, u.user_name, h.*, f.foto_id, f.f_title, f.f_user FROM f_fotos AS f LEFT JOIN u_miembros AS u ON u.user_id = f.f_user LEFT JOIN w_historial AS h ON h.pofid = f.foto_id WHERE h.type = \'2\' ORDER BY h.id DESC LIMIT 20');
        // DENUNCIAS
        include ("../ext/datos.php");
        //
        while ($row = db_exec('fetch_assoc', $query))
        {
            $row['mod_name'] = $tsUser->getUserName($row['mod']);
            $row['reason'] = (is_numeric($row['reason'])) ? $tsDenuncias['posts'][$row['reason']] :
                $tsCore->setSecure($row['reason']);
            //
            $data[] = $row;
        }
        //
        return $data;
    }
}