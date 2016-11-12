<?php

/**
 * IMPORTANTE!
 * el 4to parametro de add_query es la consulta a ejecutar para
 * desinstalar la version, es decir, la consulta a ejecutar para deshacer la acción
 * de la del 3re parametro.
 * Como el caso de la fundación, si se necesita usar una función se debe crear
 * un stdClass con el parametro fname con el nombre de la funcion a llamar.
 * Los errores se indican con throw siendo la descripción de la excepcion el
 * mensaje a mostrar al usuario.
 */

$collection = array(); // Coleccion de instalación.
$c_collection = array(); // Coleccion para comprobar si el cambio fue realizado.

//TABLA DE LAS VISITAS
$collection = add_query('Visitas', $collection,
'CREATE TABLE IF NOT EXISTS `w_visitas` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`user` int(11) NOT NULL,
	`for` int(11) NOT NULL,
	`type` int(1) NOT NULL,
	`date` int(11) NOT NULL,
	`ip` varchar(15) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;');
$c_collection = add_check_query('Visitas', $c_collection, array('table', 'w_visitas'));

//TABLA DE LAS CENSURAS
$collection = add_query('Censuras', $collection,
'CREATE TABLE IF NOT EXISTS `w_badwords` (
  `wid` int(11) NOT NULL AUTO_INCREMENT,
  `word` varchar(250) NOT NULL,
  `swop` varchar(250) NOT NULL,
  `method` int(1) NOT NULL,
  `type` int(1) NOT NULL,
  `author` int(11) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`wid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;');
$c_collection = add_check_query('Censuras', $c_collection, array('table', 'w_badwords'));

$collection = add_query('Limpieza de denuncias', $collection,
'DROP TABLE IF EXISTS `p_denuncias`;');
$c_collection = add_check_query('Correos', $c_collection, array('table_not', 'p_denuncias'));


//TABLA DE LOS CORREOS
$collection = add_query('Correos', $collection,
'CREATE TABLE IF NOT EXISTS `w_contacts` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` int(11) NOT NULL,
    `user_email` varchar(50) NOT NULL,
    `time` int(15) NOT NULL,
    `type` int(1) NOT NULL,
    `hash` varchar(32) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;');
$c_collection = add_check_query('Correos', $c_collection, array('table', 'w_contacts'));

//TABLA DE LAS MEDALLAS
$collection = add_query('Medallas', $collection,
'CREATE TABLE IF NOT EXISTS `w_medallas` (
    `medal_id` int(11) NOT NULL AUTO_INCREMENT,
    `m_autor` int(11) NOT NULL,
    `m_title` varchar(25) NOT NULL,
    `m_description` varchar(120) NOT NULL,
    `m_image` varchar(120) NOT NULL,
    `m_cant` int(11) NOT NULL,
    `m_type` int(1) NOT NULL,
    `m_cond_user` int(11) NOT NULL,
    `m_cond_user_rango` int(11) NOT NULL,
    `m_cond_post` int(11) NOT NULL,
    `m_cond_foto` int(11) NOT NULL,
    `m_date` int(11) NOT NULL,
    `m_total` int(11) NOT NULL,
    PRIMARY KEY (`medal_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;');
$c_collection = add_check_query('Medallas', $c_collection, array('table', 'w_medallas'));

//TABLA DE LAS ASIGNACIONES A USUARIOS/FOTOS/POSTS
$collection = add_query('Asignaciones a USUARIOS/FOTOS/POSTS', $collection,
'CREATE TABLE IF NOT EXISTS `w_medallas_assign` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `medal_id` int(11) NOT NULL,
    `medal_for` int(11) NOT NULL,
    `medal_date` int(11) NOT NULL,
    `medal_ip` varchar(15) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;');
$c_collection = add_check_query('Asignaciones a USUARIOS/FOTOS/POSTS', $c_collection, array('table', 'w_medallas_assign'));


$collection = add_query('Nicks Usuarios', $collection,
'CREATE TABLE IF NOT EXISTS `u_nicks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `name_1` varchar(15) NOT NULL,
  `name_2` varchar(15) NOT NULL,
  `hash` varchar(32) NOT NULL,
  `time` int(11) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT \'0\',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;');
$c_collection = add_check_query('Nicks Usuarios', $c_collection, array('table', 'u_nicks'));

$collection = add_query('Tabla de ban\'s', $collection,
'CREATE TABLE IF NOT EXISTS `w_blacklist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(1) NOT NULL,
  `value` varchar(50) NOT NULL,
  `reason` varchar(120) NOT NULL,
  `author` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;');
$c_collection = add_check_query('Tabla de ban\'s', $c_collection, array('table', 'w_blacklist'));


// Modificaciones En el historial de moderación, para tener mejor aspecto en posts y fotos.
$collection = add_query('Historial de Moderación', $collection, 'TRUNCATE TABLE `w_historial`');
$collection = add_query('Historial de Moderación', $collection, 'ALTER TABLE  `w_historial` CHANGE  `post_title`  `pofid` INT( 11 ) NOT NULL');
$collection = add_query('Historial de Moderación', $collection, 'ALTER TABLE  `w_historial` DROP  `post_autor`');
$collection = add_query('Historial de Moderación', $collection, 'ALTER TABLE  `w_historial` CHANGE  `post_mod`  `mod` INT( 11 )');
$collection = add_query('Historial de Moderación', $collection, 'ALTER TABLE  `w_historial` CHANGE  `post_reason`  `reason` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL');
$collection = add_query('Historial de Moderación', $collection, 'ALTER TABLE  `w_historial` ADD  `date` INT( 11 ) NOT NULL');
$collection = add_query('Historial de Moderación', $collection, 'ALTER TABLE  `w_historial` ADD  `type` INT( 1 ) NOT NULL');
$collection = add_query('Historial de Moderación', $collection, 'ALTER TABLE  `w_historial` ADD  `mod_ip` VARCHAR( 15 ) NOT NULL');
$collection = add_query('Historial de Moderación', $collection, 'ALTER TABLE  `w_historial` CHANGE  `post_action` `action` INT(1) NOT NULL');
$c_collection = add_check_query('Historial de Moderación', $c_collection,
    array(
        'fields',
        'w_historial',
        array(
            array('', 'NONE'),
            array('post_title', 'CHANGE', 'pofid'),
            array('post_autor', 'DROP'),
            array('post_mod', 'CHANGE', 'mod'),
            array('post_reason', 'CHANGE', 'reason'),
            array('date', 'ADD'),
            array('type', 'ADD'),
            array('mod_ip', 'ADD'),
            array('post_action', 'CHANGE', 'action'),
        )
    )
);


$collection = add_query('Fotos', $collection, 'ALTER TABLE `f_fotos` ADD `f_visitas` INT(1) NOT NULL DEFAULT \'0\'');
$collection = add_query('Fotos', $collection, 'ALTER TABLE `f_fotos` ADD `f_ip` VARCHAR( 15 ) NOT NULL');
$collection = add_query('Fotos', $collection, 'ALTER TABLE `f_fotos` DROP `f_access`');
$collection = add_query('Fotos', $collection, 'ALTER TABLE `f_fotos` DROP `f_comments`');
$collection = add_query('Fotos', $collection, 'ALTER TABLE `f_fotos` DROP `f_favorites`');

$c_collection = add_check_query('Fotos', $c_collection,
    array(
        'fields',
        'f_fotos',
        array(
            array('f_visitas', 'ADD'),
            array('f_ip', 'ADD'),
            array('f_access', 'DROP'),
            array('f_comments', 'DROP'),
            array('f_favorites', 'DROP'),
        )
    )
);

$collection = add_query('Configuracion', $collection, 'ALTER TABLE `w_configuracion` ADD  `c_stats_cache` INT( 7 ) NOT NULL DEFAULT \'15\'');
$collection = add_query('Configuracion', $collection, 'ALTER TABLE `w_configuracion` ADD  `c_reg_rango` INT( 5 ) NOT NULL');
$collection = add_query('Configuracion', $collection, 'ALTER TABLE `w_configuracion` CHANGE `c_anti_flood` `c_count_guests` INT(1) NOT NULL');
$collection = add_query('Configuracion', $collection, 'ALTER TABLE `w_configuracion` ADD  `c_desapprove_post` INT( 1 ) NOT NULL');
$collection = add_query('Configuracion', $collection, 'ALTER TABLE `w_configuracion` ADD  `c_see_mod` INT( 1 ) NOT NULL');
$collection = add_query('Configuracion', $collection, 'ALTER TABLE `w_configuracion` ADD `xat_id`           INT( 11 ) NOT NULL');
$collection = add_query('Configuracion', $collection, 'ALTER TABLE `w_configuracion` ADD `c_allow_points`    INT( 3 ) NOT NULL');
$collection = add_query('Configuracion', $collection, 'ALTER TABLE `w_configuracion` ADD `c_keep_points`     INT( 1 ) NOT NULL');
$collection = add_query('Configuracion', $collection, 'ALTER TABLE `w_configuracion` ADD `c_hits_guest`      INT( 1 ) NOT NULL');
$collection = add_query('Configuracion', $collection, 'ALTER TABLE `w_configuracion` ADD `c_fotos_private`   INT( 1 ) NOT NULL');
$collection = add_query('Configuracion', $collection, 'ALTER TABLE `w_configuracion` ADD `c_met_welcome`     INT( 1 ) NOT NULL');
$collection = add_query('Configuracion', $collection, 'ALTER TABLE `w_configuracion` ADD `c_message_welcome` VARCHAR( 500 ) NOT NULL');
$c_collection = add_check_query('Configuracion', $c_collection,
    array(
        'fields',
        'w_configuracion',
        array(
            array('c_stats_cache', 'ADD'),
            array('c_reg_rango', 'ADD'),
            array('c_anti_flood', 'CHANGE', 'c_count_guests'),
            array('c_desapprove_post', 'ADD'),
            array('c_see_mod', 'ADD'),
            array('xat_id', 'ADD'),
            array('c_allow_points', 'ADD'),
            array('c_keep_points', 'ADD'),
            array('c_hits_guest', 'ADD'),
            array('c_fotos_private', 'ADD'),
            array('c_met_welcome', 'ADD'),
            array('c_message_welcome', 'ADD'),
        )
    )
);

$collection = add_query('Rangos Usuario', $collection, 'ALTER TABLE `u_rangos` DROP `r_max_points`');
$collection = add_query('Rangos Usuario', $collection, 'ALTER TABLE `u_rangos` DROP `r_min_posts`');
$collection = add_query('Rangos Usuario', $collection, 'ALTER TABLE `u_rangos` CHANGE  `r_min_points`  `r_cant` INT( 5 ) NOT NULL DEFAULT  \'0\'');
$collection = add_query('Rangos Usuario', $collection, 'ALTER TABLE `u_rangos` CHANGE `r_special` `r_type` INT(1) NOT NULL DEFAULT \'0\'');
$c_collection = add_check_query('Rangos Usuario', $c_collection,
    array(
        'fields',
        'u_rangos',
        array(
            array('r_max_points', 'DROP'),
            array('r_min_posts', 'DROP'),
            array('r_min_points', 'CHANGE', 'r_cant'),
            array('r_special', 'CHANGE', 'r_type'),
        )
    )
);

$collection = add_query('Borradores', $collection, 'ALTER TABLE `p_borradores` ADD  `b_visitantes` INT( 1 ) NOT NULL');
$collection = add_query('Borradores', $collection, 'ALTER TABLE `p_borradores` ADD  `b_smileys` INT( 1 ) NOT NULL');
$c_collection = add_check_query('Borradores', $c_collection,
    array(
        'fields',
        'p_borradores',
        array(
            array('b_visitantes', 'ADD'),
            array('b_smileys', 'ADD'),
        )
    )
);


$collection = add_query('Posts', $collection, 'ALTER TABLE `p_posts` ADD `post_visitantes` INT(1) NOT NULL');
$collection = add_query('Posts', $collection, 'ALTER TABLE `p_posts` ADD `post_smileys` INT(1) NOT NULL');
$collection = add_query('Posts', $collection, 'ALTER TABLE `p_posts` ADD `post_cache` INT(10) NOT NULL');
$collection = add_query('Posts', $collection, 'ALTER TABLE `p_posts` ADD `post_ip` VARCHAR( 15 ) NOT NULL');
$collection = add_query('Posts', $collection, 'ALTER TABLE `p_posts` DROP `post_denuncias`');
$c_collection = add_check_query('Posts', $c_collection,
    array(
        'fields',
        'p_posts',
        array(
            array('post_visitantes', 'ADD'),
            array('post_smileys', 'ADD'),
            array('post_cache', 'ADD'),
            array('post_ip', 'ADD'),
            array('post_denuncias', 'DROP'),
        )
    )
);


$collection = add_query('Votos Post', $collection, 'ALTER TABLE `f_votos` ADD `v_type` INT(1) NOT NULL');
$collection = add_query('Votos Post', $collection, 'ALTER TABLE `f_votos` ADD `v_date` INT(11) NOT NULL');
$c_collection = add_check_query('Votos Post', $c_collection,
    array(
        'fields',
        'f_votos',
        array(
            array('v_type', 'ADD'),
            array('v_date', 'ADD'),
        )
    )
);


$collection = add_query('Votos', $collection, 'ALTER TABLE `p_votos` ADD  `cant` INT NOT NULL');
$collection = add_query('Votos', $collection, 'ALTER TABLE `p_votos` ADD  `date` INT NOT NULL');
$c_collection = add_check_query('Votos', $c_collection,
    array(
        'fields',
        'p_votos',
        array(
            array('cant', 'ADD'),
            array('date', 'ADD'),
        )
    )
);

$collection = add_query('Perfil', $collection, "ALTER TABLE `u_perfil` CHANGE `p_configs` `p_configs` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'a:3:{s:1:\"m\";s:1:\"5\";s:2:\"mf\";i:5;s:3:\"rmp\";s:1:\"5\";}'");
$c_collection = add_check_query('Perfil', $c_collection,
    array(
        'fields',
        'u_perfil',
        array(
            array('p_configs', 'CHANGE', 'p_configs'),
        )
    )
);

$collection = add_query('Suspensión', $collection, 'ALTER TABLE `u_suspension` ADD  `susp_ip` VARCHAR(15) NOT NULL');
$c_collection = add_check_query('Suspensión', $c_collection,
    array(
        'fields',
        'u_suspension',
        array(
            array('susp_ip', 'ADD'),
        )
    )
);

$collection = add_query('Noticias', $collection, 'ALTER TABLE `w_noticias` ADD  `not_autor` INT( 11 ) NOT NULL');
$c_collection = add_check_query('Noticias', $c_collection,
    array(
        'fields',
        'w_noticias',
        array(
            array('not_autor', 'ADD'),
        )
    )
);

$collection = add_query('Comentarios Post', $collection, "ALTER TABLE `p_comentarios`       ADD `c_status` ENUM(  '0',  '1' ) NOT NULL DEFAULT  '0'");
$collection = add_query('Comentarios Post', $collection, 'ALTER TABLE `p_comentarios`       ADD `c_ip` VARCHAR( 15 ) NOT NULL');
$c_collection = add_check_query('Comentarios Post', $c_collection,
    array(
        'fields',
        'p_comentarios',
        array(
            array('c_status', 'ADD'),
            array('c_ip', 'ADD'),
        )
    )
);

$collection = add_query('Muro Comentarios', $collection, 'ALTER TABLE `u_muro_comentarios`  ADD `c_ip` VARCHAR( 15 ) NOT NULL');
$c_collection = add_check_query('Muro Comentarios', $c_collection,
    array(
        'fields',
        'u_muro_comentarios',
        array(
            array('c_ip', 'ADD'),
        )
    )
);

$collection = add_query('Muro', $collection, 'ALTER TABLE `u_muro` ADD `p_ip` VARCHAR( 15 ) NOT NULL');
$c_collection = add_check_query('Muro', $c_collection,
    array(
        'fields',
        'u_muro',
        array(
            array('p_ip', 'ADD'),
        )
    )
);

$collection = add_query('Comentarios', $collection, 'ALTER TABLE `f_comentarios` ADD `c_ip` VARCHAR( 15 ) NOT NULL');
$c_collection = add_check_query('Comentarios', $c_collection,
    array(
        'fields',
        'f_comentarios',
        array(
            array('c_ip', 'ADD'),
        )
    )
);

$collection = add_query('Respuestas', $collection, 'ALTER TABLE `u_respuestas` ADD `mr_ip` VARCHAR( 15 ) NOT NULL');
$c_collection = add_check_query('Respuestas', $c_collection,
    array(
        'fields',
        'u_respuestas',
        array(
            array('mr_ip', 'ADD'),
        )
    )
);


$collection = add_query('Estadisticas', $collection, 'ALTER TABLE `w_stats` CHANGE `stats_online` `stats_max_online` INT( 11 ) NOT NULL');
$collection = add_query('Estadisticas', $collection, 'ALTER TABLE `w_stats` ADD `stats_max_time` INT NOT NULL');
$collection = add_query('Estadisticas', $collection, 'ALTER TABLE `w_stats` ADD `stats_time_cache` INT NOT NULL');
$collection = add_query('Estadisticas', $collection, 'ALTER TABLE `w_stats` ADD `stats_time_upgrade` INT NOT NULL');
$collection = add_query('Estadisticas', $collection, 'ALTER TABLE `w_stats` ADD `stats_time_foundation` INT NOT NULL');
$c_collection = add_check_query('Estadisticas', $c_collection,
    array(
        'fields',
        'w_stats',
        array(
            array('stats_online', 'CHANGE', 'stats_max_online'),
            array('stats_max_time', 'ADD'),
            array('stats_time_cache', 'ADD'),
            array('stats_time_upgrade', 'ADD'),
            array('stats_time_foundation', 'ADD'),
        )
    )
);


$collection = add_query('Miembros', $collection, 'ALTER TABLE `u_miembros` ADD `user_name_changes` INT(11) NOT NULL DEFAULT \'3\'');
$collection = add_query('Miembros', $collection, 'ALTER TABLE `u_miembros` ADD `user_cache` INT(10) NOT NULL');
$collection = add_query('Miembros', $collection, 'ALTER TABLE `u_miembros` DROP `user_medallas`');
$collection = add_query('Miembros', $collection, 'ALTER TABLE `u_miembros` DROP `user_siguiendo`');
$collection = add_query('Miembros', $collection, 'ALTER TABLE `u_miembros` DROP `user_fotos`');
$collection = add_query('Miembros', $collection, 'ALTER TABLE `u_miembros` DROP `user_foto_comments`');
$c_collection = add_check_query('Miembros', $c_collection,
    array(
        'fields',
        'u_miembros',
        array(
            array('user_name_changes', 'ADD'),
            array('user_cache', 'ADD'),
            array('user_medallas', 'DROP'),
            array('user_siguiendo', 'DROP'),
            array('user_fotos', 'DROP'),
            array('user_foto_comments', 'DROP')
        )
    )
);

//Agregamos la fecha de la actualizaci&oacute;n

$collection = add_query('Estadisticas Instalación', $collection, 'UPDATE w_stats SET stats_time_upgrade = \''.time().'\' WHERE stats_no = \'1\'');

function update_fundacion_time()
{
    //Obtenemos la fecha del registro del primer usuario para asignarla a la fecha de la fundación de la comunidad.
    $query = @mysql_query('SELECT user_registro FROM u_miembros WHERE user_id = \'1\'');

    if ($query)
    {
        $fundacion = mysql_fetch_assoc($query);
        if ( ! $fundacion)
        {
            throw new Exception('No se pudieron obtener los datos del usuario.', 1);
            return FALSE;
        }
        $rst = @mysql_query('UPDATE w_stats SET stats_time_foundation = \''.$fundacion['user_registro'].'\' WHERE stats_no = \'1\'');

        if ( ! $rst)
        {
            throw new Exception(mysql_errno().': '.mysql_error(), mysql_errno());
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
    else
    {
        throw new Exception(mysql_errno().': '.mysql_error(), mysql_errno());
        return FALSE;
    }
}
$d = new stdClass;
$d->fname = 'update_fundacion_time';
$collection = add_query('Fecha fundación', $collection, $d);
unset($d);

//Actualizamos la versión y tema
$collection = add_query('Versión del script', $collection, 'UPDATE w_configuracion SET version = \'Risus\', version_code = \'risus\', tema_id = \'1\' WHERE tscript_id = \'1\'');

//Vaciamos los temas
$collection = add_query('Vaciar plantillas', $collection, 'DELETE FROM `w_temas` WHERE `tid` != \'1\'');

function check_group_perms()
{
    // Obtenemos el listado de campos.
    $rst = @mysql_query("DESCRIBE u_rangos");

    if ( ! $rst)
    {
        return FALSE;
    }

    $list = array();
    while ($row = mysql_fetch_assoc($rst))
    {
        if ($row['Field'] == 'r_allows')
        {
            return FALSE;
        }
    }
    return TRUE;
}

function update_group_perms()
{
    // Datos a serealizar.
    $data = array();
    $data['gopfp'] = 10;   // Puntos por Post.
    $data['gopfd'] = '';   // Puntos por Día. r_user_points.
    $data['goaf']  = '20'; // Antiflood por defecto.
    $data["godp"]  = "on";
    $data["gopp"]  = "on";
    $data["gopcp"] = "on";
    $data["govpp"] = "on";
    $data["govpn"] = "on";
    $data["goepc"] = "on";
    $data["godpc"] = "on";
    $data["gopf"]  = "on";
    $data["gopcf"] = "on";

    // Obtenemos el listado de campos.
    $rst = @mysql_query("DESCRIBE u_rangos");

    if ( ! $rst)
    {
        return FALSE;
    }

    $list = array();
    while ($row = mysql_fetch_assoc($rst))
    {
        $list[$row['Field']] = $row;
    }

    if ( ! in_array('r_allows', $list))
    {
        if ( ! execute_safe('ALTER TABLE `u_rangos` ADD `r_allows` VARCHAR( 1000 ) NOT NULL', array('No se pudo modificar la tabla para actualizar los permisos', 100)))
        {
            return FALSE;
        }
    }

    $rst = @mysql_query('SELECT rango_id, r_user_points FROM u_rangos');

    if (is_resource($rst))
    {
        mysql_query("BEGIN");

        if ( ! execute_safe('UPDATE u_rangos SET r_allows = \'a:4:{s:4:"suad";s:2:"on";s:4:"goaf";s:1:"5";s:5:"gopfp";s:2:"20";s:5:"gopfd";s:2:"50";}\' WHERE rango_id = 1', array('No se pudo modificar la tabla para actualizar los permisos', 101), TRUE))
        {
            return FALSE;
        }

        if ( ! execute_safe('UPDATE u_rangos SET r_allows = \'a:4:{s:4:"sumo";s:2:"on";s:4:"goaf";s:2:"15";s:5:"gopfp";s:2:"18";s:5:"gopfd";s:2:"30";}\' WHERE rango_id = 2', array('No se pudo modificar la tabla para actualizar los permisos', 102), TRUE))
        {
            return FALSE;
        }

        if ( ! execute_safe('UPDATE u_rangos SET r_type = -1 WHERE r_type = 0', array('No se pudo modificar la tabla para actualizar los permisos', 103), TRUE))
        {
            return FALSE;
        }

        if ( ! execute_safe('UPDATE u_rangos SET r_type = 0 WHERE r_type = 1', array('No se pudo modificar la tabla para actualizar los permisos', 104), TRUE))
        {
            return FALSE;
        }


        if ( ! execute_safe('UPDATE u_rangos SET r_type = 1 WHERE r_type = -1', array('No se pudo modificar la tabla para actualizar los permisos', 105), TRUE))
        {
            return FALSE;
        }

        while($d = mysql_fetch_row($rst))
        {
            if ($d[0] == 1 || $d[0] == 2)
            {
                continue;
            }

            $data['gopfd'] = $d[1];

            if ( ! execute_safe('UPDATE u_rangos SET r_allows = \''.serialize($data).'\' WHERE rango_id = '.$d[0], array('Error actualizando los permisos', 106), TRUE))
            {
                return FALSE;
            }
        }

        if ( ! execute_safe('COMMIT', array('No se pudo completar la tansancción', 107), TRUE))
        {
            return FALSE;
        }
    }
    else
    {
        throw new Exception('No se pudo obtener la lista de usuarios a modificar \''.mysql_error().'\'', 100);
        return FALSE;
    }

    @mysql_query('ALTER TABLE `u_rangos` DROP `r_user_points`');

    return TRUE;
}

$d = new stdClass;
$d->fname = 'update_group_perms';
$collection = add_query('Actualización permisos usuarios', $collection, $d);
$c_collection = add_check_query('Actualización permisos usuarios', $c_collection, array('custom', 'check_group_perms'));
unset($d);

return array($collection, $c_collection);
