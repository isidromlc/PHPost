<?php
/**
 * @name database.php
 * @author PHPost Team
 * @copyright 2011-2018
 */

$phpos_sql['f_comentarios'] = "CREATE TABLE IF NOT EXISTS `f_comentarios` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `c_foto_id` int(11) NOT NULL,
  `c_user` int(11) NOT NULL,
  `c_date` int(10) NOT NULL,
  `c_body` text NOT NULL,
  `c_ip` varchar(15) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$phpos_sql['w_visitas'] = "CREATE TABLE IF NOT EXISTS `w_visitas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `for` int(11) NOT NULL,
  `type` int(1) NOT NULL,
  `date` int(11) NOT NULL,
  `ip` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

$phpos_sql['f_fotos'] = "
CREATE TABLE IF NOT EXISTS `f_fotos` (
  `foto_id` int(11) NOT NULL AUTO_INCREMENT,
  `f_title` varchar(40) NOT NULL,
  `f_date` int(10) NOT NULL,
  `f_description` text NOT NULL,
  `f_url` varchar(200) NOT NULL,
  `f_user` int(11) NOT NULL,
  `f_closed` int(1) NOT NULL DEFAULT '0',
  `f_visitas` int(1) NOT NULL DEFAULT '0',
  `f_votos_pos` int(3) NOT NULL DEFAULT '0',
  `f_votos_neg` int(3) NOT NULL DEFAULT '0',
  `f_status` int(1) NOT NULL DEFAULT '0',
  `f_last` int(1) NOT NULL DEFAULT '0',
  `f_hits` int(11) NOT NULL DEFAULT '0',
  `f_ip` varchar(15) NOT NULL,
  PRIMARY KEY (`foto_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$phpos_sql['f_votos'] = "
CREATE TABLE IF NOT EXISTS `f_votos` (
  `vid` int(11) NOT NULL AUTO_INCREMENT,
  `v_foto_id` int(11) NOT NULL,
  `v_user` int(11) NOT NULL,
  `v_type` int(1) NOT NULL,
  `v_date` int(11) NOT NULL,
  PRIMARY KEY (`vid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$phpos_sql['p_borradores'] = "
CREATE TABLE IF NOT EXISTS `p_borradores` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `b_user` int(11) NOT NULL,
  `b_date` int(10) NOT NULL,
  `b_title` varchar(60) NOT NULL,
  `b_body` text,
  `b_tags` varchar(128) DEFAULT NULL,
  `b_category` int(4) NOT NULL,
  `b_private` int(1) NOT NULL DEFAULT '0',
  `b_block_comments` int(1) NOT NULL DEFAULT '0',
  `b_sponsored` int(1) NOT NULL DEFAULT '0',
  `b_sticky` int(1) NOT NULL DEFAULT '0',
  `b_smileys` int(1) NOT NULL,
  `b_visitantes` int(1) NOT NULL DEFAULT '0',
  `b_post_id` int(11) NOT NULL DEFAULT '0',
  `b_status` int(1) NOT NULL DEFAULT '1',
  `b_causa` varchar(128) NOT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$phpos_sql['p_categorias'] = "
CREATE TABLE IF NOT EXISTS `p_categorias` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `c_orden` int(11) NOT NULL,
  `c_nombre` varchar(32) NOT NULL,
  `c_seo` varchar(32) NOT NULL,
  `c_img` varchar(32) NOT NULL DEFAULT 'comments.png',
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;";

$phpos_sql['pv_categorias'] = "
INSERT INTO `p_categorias` (`cid`, `c_orden`, `c_nombre`, `c_seo`, `c_img`) VALUES
(1, 1, 'Animaciones', 'animaciones', 'flash.png'),
(2, 2, 'Apuntes y Monografías', 'apuntesymonografias', 'report.png'),
(3, 3, 'Arte', 'arte', 'palette.png'),
(4, 4, 'Autos y Motos', 'autosymotos', 'car.png'),
(5, 5, 'Celulares', 'celulares', 'phone.png'),
(6, 6, 'Ciencia y Educación', 'cienciayeducacion', 'lab.png'),
(7, 7, 'Comics', 'comics', 'comic.png'),
(8, 8, 'Deportes', 'deportes', 'sport.png'),
(9, 9, 'Downloads', 'downloads', 'disk.png'),
(10, 10, 'E-books y Tutoriales', 'ebooksytutoriales', 'ebook.png'),
(11, 11, 'Ecología', 'ecologia', 'nature.png'),
(12, 12, 'Economía y Negocios', 'economiaynegocios', 'economy.png'),
(13, 13, 'Femme', 'femme', 'female.png'),
(14, 14, 'Hazlo tu mismo', 'hazlotumismo', 'escuadra.png'),
(15, 15, 'Humor', 'humor', 'humor.png'),
(16, 16, 'Imágenes', 'imagenes', 'photo.png'),
(17, 17, 'Info', 'info', 'book.png'),
(18, 18, 'Juegos', 'juegos', 'controller.png'),
(19, 19, 'Links', 'links', 'link.png'),
(20, 20, 'Linux', 'linux', 'tux.png'),
(21, 21, 'Mac', 'mac', 'mac.png'),
(22, 22, 'Manga y Anime', 'mangayanime', 'manga.png'),
(23, 23, 'Mascotas', 'mascotas', 'pet.png'),
(24, 24, 'Música', 'musica', 'music.png'),
(25, 25, 'Noticias', 'noticias', 'newspaper.png'),
(26, 26, 'Off Topic', 'offtopic', 'comments.png'),
(27, 27, 'Recetas y Cocina', 'recetasycocina', 'cake.png'),
(28, 28, 'Salud y Bienestar', 'saludybienestar', 'heart.png'),
(29, 29, 'Solidaridad', 'solidaridad', 'salva.png'),
(30, 30, 'Taringa!', 'taringa', 'tscript.png'),
(31, 31, 'Turismo', 'turismo', 'brujula.png'),
(32, 32, 'TV, Peliculas y series', 'tvpeliculasyseries', 'tv.png'),
(33, 33, 'Videos On-line', 'videosonline', 'film.png');";

$phpos_sql['p_comentarios'] = "
CREATE TABLE IF NOT EXISTS `p_comentarios` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `c_post_id` int(11) NOT NULL,
  `c_user` int(11) NOT NULL,
  `c_date` int(10) NOT NULL,
  `c_body` text NOT NULL,
  `c_votos` int(3) NOT NULL DEFAULT '0',
  `c_status` ENUM(  '0',  '1' ) NOT NULL DEFAULT  '0',
  `c_ip` varchar(15) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$phpos_sql['p_favoritos'] = "
CREATE TABLE IF NOT EXISTS `p_favoritos` (
  `fav_id` int(11) NOT NULL AUTO_INCREMENT,
  `fav_user` int(11) NOT NULL,
  `fav_post_id` int(11) NOT NULL,
  `fav_date` int(10) NOT NULL,
  PRIMARY KEY (`fav_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$phpos_sql['p_posts'] = "
CREATE TABLE IF NOT EXISTS `p_posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_user` int(11) NOT NULL,
  `post_category` int(4) NOT NULL,
  `post_title` varchar(60) NOT NULL,
  `post_body` text NOT NULL,
  `post_date` int(10) NOT NULL,
  `post_tags` varchar(128) NOT NULL,
  `post_puntos` int(11) unsigned NOT NULL DEFAULT '0',
  `post_comments` int(11) NOT NULL,
  `post_seguidores` int(11) NOT NULL,
  `post_shared` int(11) NOT NULL,
  `post_favoritos` int(11) NOT NULL,
  `post_cache` int(10) NOT NULL,
  `post_hits` int(11) NOT NULL DEFAULT '0',
  `post_ip` varchar(15) NOT NULL,
  `post_private` int(1) NOT NULL DEFAULT '0',
  `post_block_comments` int(1) NOT NULL DEFAULT '0',
  `post_sponsored` int(1) NOT NULL DEFAULT '0',
  `post_sticky` int(1) NOT NULL DEFAULT '0',
  `post_smileys` int(1) NOT NULL,
  `post_visitantes` int(1) NOT NULL DEFAULT '0',
  `post_status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;";

$phpos_sql['pv_posts'] = "
INSERT INTO `p_posts` (`post_id`, `post_user`, `post_category`, `post_title`, `post_body`, `post_date`, `post_tags`, `post_puntos`, `post_hits`,  `post_private`, `post_block_comments`, `post_sponsored`, `post_sticky`, `post_status`) VALUES
(1, 1, 30, 'Bienvenido a PHPost Risus', '[align=center][size=18]Este es el primer post de los miles que tendrá tu web  ;)  \r\n\r\nGracias por elegir a [url=http://www.phpost.net]PHPost[/url] como tu Link Sharing System.[/size][/align]', 0, 'PHPost, Risus, 1.4.0, Taringa!', 0, 0, 0, 0, 0, 0, 0);";

$phpos_sql['p_votos'] = "
CREATE TABLE IF NOT EXISTS `p_votos` (
  `voto_id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `tuser` int(11) NOT NULL,
  `cant` int(11) NOT NULL,
  `type` int(1) NOT NULL DEFAULT '1',
  `date` int(11) NOT NULL,
  PRIMARY KEY (`voto_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$phpos_sql['u_actividad'] = "
CREATE TABLE IF NOT EXISTS `u_actividad` (
  `ac_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `obj_uno` int(11) NOT NULL,
  `obj_dos` int(11) NOT NULL,
  `ac_type` int(2) NOT NULL,
  `ac_date` int(10) NOT NULL,
  PRIMARY KEY (`ac_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$phpos_sql['u_avisos'] = "
CREATE TABLE IF NOT EXISTS `u_avisos` (
  `av_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `av_subject` varchar(24) NOT NULL,
  `av_body` text NOT NULL,
  `av_date` int(10) NOT NULL,
  `av_read` int(1) NOT NULL DEFAULT '0',
  `av_type` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`av_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$phpos_sql['u_bloqueos'] = "
CREATE TABLE IF NOT EXISTS `u_bloqueos` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `b_user` int(11) NOT NULL,
  `b_auser` int(11) NOT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$phpos_sql['u_follows'] = "
CREATE TABLE IF NOT EXISTS `u_follows` (
  `follow_id` int(11) NOT NULL AUTO_INCREMENT,
  `f_user` int(11) NOT NULL,
  `f_id` int(11) NOT NULL,
  `f_type` int(1) NOT NULL,
  `f_date` int(10) NOT NULL,
  PRIMARY KEY (`follow_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$phpos_sql['u_mensajes'] = "
CREATE TABLE IF NOT EXISTS `u_mensajes` (
  `mp_id` int(11) NOT NULL AUTO_INCREMENT,
  `mp_to` int(11) NOT NULL,
  `mp_from` int(11) NOT NULL,
  `mp_answer` int(1) NOT NULL DEFAULT '0',
  `mp_read_to` int(1) NOT NULL DEFAULT '0',
  `mp_read_from` int(1) NOT NULL DEFAULT '1',
  `mp_read_mon_to` int(1) NOT NULL DEFAULT '0',
  `mp_read_mon_from` int(1) NOT NULL DEFAULT '1',
  `mp_del_to` int(1) NOT NULL DEFAULT '0',
  `mp_del_from` int(1) NOT NULL DEFAULT '0',
  `mp_subject` varchar(50) NOT NULL,
  `mp_preview` varchar(75) NOT NULL,
  `mp_date` int(10) NOT NULL,
  PRIMARY KEY (`mp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$phpos_sql['u_miembros'] = "
CREATE TABLE IF NOT EXISTS `u_miembros` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(16) NOT NULL,
  `user_password` varchar(65) NOT NULL,
  `user_email` varchar(35) NOT NULL,
  `user_rango` int(3) NOT NULL DEFAULT '3',
  `user_puntos` int(6) unsigned NOT NULL DEFAULT '0',
  `user_posts` int(11) NOT NULL,
  `user_twofactor` varchar(18) NOT NULL DEFAULT '',
  `user_comentarios` int(11) NOT NULL,
  `user_seguidores` int(11) NOT NULL,
  `user_cache` int(10) NOT NULL,
  `user_puntosxdar` int(2) unsigned NOT NULL DEFAULT '0',
  `user_bad_hits` int(2) unsigned NOT NULL DEFAULT '0',
  `user_nextpuntos` int(10) NOT NULL DEFAULT '0',
  `user_registro` int(10) NOT NULL DEFAULT '0',
  `user_lastlogin` int(10) NOT NULL DEFAULT '0',
  `user_lastactive` int(10) NOT NULL DEFAULT '0',
  `user_lastpost` int(10) NOT NULL DEFAULT '0',
  `user_last_ip` varchar(15) NOT NULL DEFAULT '0',
  `user_name_changes` int(11) NOT NULL DEFAULT '3',
  `user_activo` int(1) NOT NULL DEFAULT '0',
  `user_baneado` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$phpos_sql['u_nicks'] = "
CREATE TABLE IF NOT EXISTS `u_nicks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `name_1` varchar(15) NOT NULL,
  `name_2` varchar(15) NOT NULL,
  `hash` varchar(32) NOT NULL,
  `time` int(11) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

$phpos_sql['u_monitor'] = "
CREATE TABLE IF NOT EXISTS `u_monitor` (
  `not_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `obj_user` int(11) NOT NULL,
  `obj_uno` int(11) NOT NULL DEFAULT '0',
  `obj_dos` int(11) NOT NULL DEFAULT '0',
  `obj_tres` int(11) NOT NULL DEFAULT '0',
  `not_type` int(2) NOT NULL,
  `not_date` int(10) NOT NULL,
  `not_total` int(2) NOT NULL DEFAULT '1',
  `not_menubar` int(1) NOT NULL DEFAULT '2',
  `not_monitor` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`not_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$phpos_sql['u_muro'] = "
CREATE TABLE IF NOT EXISTS `u_muro` (
  `pub_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_user` int(11) NOT NULL,
  `p_user_pub` int(11) NOT NULL,
  `p_date` int(10) NOT NULL,
  `p_comments` int(4) NOT NULL DEFAULT '0',
  `p_body` text NOT NULL,
  `p_likes` int(4) NOT NULL DEFAULT '0',
  `p_type` int(1) NOT NULL,
  `p_ip` varchar(15) NOT NULL,
  PRIMARY KEY (`pub_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$phpos_sql['u_muro_adjuntos'] = "
CREATE TABLE IF NOT EXISTS `u_muro_adjuntos` (
  `adj_id` int(11) NOT NULL AUTO_INCREMENT,
  `pub_id` int(11) NOT NULL,
  `a_title` varchar(100) NOT NULL,
  `a_url` text NOT NULL,
  `a_img` text NOT NULL,
  `a_desc` text NOT NULL,
  PRIMARY KEY (`adj_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$phpos_sql['u_muro_comentarios'] = "
CREATE TABLE IF NOT EXISTS `u_muro_comentarios` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `pub_id` int(11) NOT NULL,
  `c_user` int(11) NOT NULL,
  `c_date` int(10) NOT NULL,
  `c_body` text NOT NULL,
  `c_likes` int(4) NOT NULL,
  `c_ip` varchar(15) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$phpos_sql['u_muro_likes'] = "
CREATE TABLE IF NOT EXISTS `u_muro_likes` (
  `like_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `obj_id` int(11) NOT NULL,
  `obj_type` int(1) NOT NULL,
  PRIMARY KEY (`like_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$phpos_sql['u_perfil'] = "
CREATE TABLE IF NOT EXISTS `u_perfil` (
  `user_id` int(11) NOT NULL,
  `user_dia` int(2) NOT NULL,
  `user_mes` int(2) NOT NULL,
  `user_ano` int(4) NOT NULL,
  `user_pais` varchar(2) NOT NULL,
  `user_estado` int(2) NOT NULL DEFAULT '1',
  `user_sexo` int(1) NOT NULL DEFAULT '1',
  `user_firma` text NOT NULL,
  `p_nombre` varchar(32) NOT NULL,
  `p_avatar` int(1) NOT NULL DEFAULT '0',
  `p_mensaje` varchar(60) NOT NULL,
  `p_sitio` varchar(60) NOT NULL,
  `p_socials` text NOT NULL DEFAULT 'a:5:{i:0;s:0:\"\";i:1;s:0:\"\";i:2;s:0:\"\";i:3;s:0:\"\";i:4;s:0:\"\";}',
  `p_estado` int(1) NOT NULL DEFAULT '0',
  `p_estudios` int(1) NOT NULL DEFAULT '0',
  `p_profesion` varchar(32) NOT NULL,
  `p_configs` varchar(100) NOT NULL DEFAULT 'a:3:{s:1:\"m\";s:1:\"5\";s:2:\"mf\";i:5;s:3:\"rmp\";s:1:\"5\";}',
  `p_total` varchar(54) NOT NULL DEFAULT 'a:6:{i:0;i:5;i:1;i:0;i:2;i:0;i:3;i:0;i:4;i:0;i:5;i:0;}',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$phpos_sql['u_portal'] = "
CREATE TABLE IF NOT EXISTS `u_portal` (
  `user_id` int(11) NOT NULL,
  `last_posts_visited` text NOT NULL,
  `last_posts_shared` text NOT NULL,
  `last_posts_cats` text NOT NULL,
  `c_monitor` text NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$phpos_sql['u_rangos'] = "
CREATE TABLE IF NOT EXISTS `u_rangos` (
  `rango_id` int(3) NOT NULL AUTO_INCREMENT,
  `r_name` varchar(32) NOT NULL,
  `r_color` varchar(6) NOT NULL DEFAULT '171717',
  `r_image` varchar(32) NOT NULL DEFAULT 'new.png',
  `r_cant` int(5) NOT NULL,
  `r_allows` varchar(1000) NOT NULL,
  `r_type` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rango_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;";

$phpos_sql['uv_rangos'] = "
INSERT INTO `u_rangos` (`rango_id`, `r_name`, `r_color`, `r_image`, `r_cant`, `r_allows`, `r_type`) VALUES
(1, 'Administrador', 'D6030B', 'rosette.png', 0, 'a:4:{s:4:\"suad\";s:2:\"on\";s:4:\"goaf\";s:1:\"5\";s:5:\"gopfp\";s:2:\"20\";s:5:\"gopfd\";s:2:\"50\";}', 0),
(2, 'Moderador', 'ff9900', 'shield.png', 0, 'a:4:{s:4:\"sumo\";s:2:\"on\";s:4:\"goaf\";s:2:\"15\";s:5:\"gopfp\";s:2:\"18\";s:5:\"gopfd\";s:2:\"30\";}', 0),
(3, 'Novato', '171717', 'new.png', 0, 'a:12:{s:4:\"godp\";s:2:\"on\";s:4:\"gopp\";s:2:\"on\";s:5:\"gopcp\";s:2:\"on\";s:5:\"govpp\";s:2:\"on\";s:5:\"govpn\";s:2:\"on\";s:5:\"goepc\";s:2:\"on\";s:5:\"godpc\";s:2:\"on\";s:4:\"gopf\";s:2:\"on\";s:5:\"gopcf\";s:2:\"on\";s:4:\"goaf\";s:2:\"20\";s:5:\"gopfp\";s:1:\"5\";s:5:\"gopfd\";s:1:\"5\";}', 0),
(4, 'New Full User', '0198E7', 'star_bronze_3.png', 50, 'a:12:{s:4:\"godp\";s:2:\"on\";s:4:\"gopp\";s:2:\"on\";s:5:\"gopcp\";s:2:\"on\";s:5:\"govpp\";s:2:\"on\";s:5:\"govpn\";s:2:\"on\";s:5:\"goepc\";s:2:\"on\";s:5:\"godpc\";s:2:\"on\";s:4:\"gopf\";s:2:\"on\";s:5:\"gopcf\";s:2:\"on\";s:4:\"goaf\";s:2:\"20\";s:5:\"gopfp\";s:2:\"10\";s:5:\"gopfd\";s:2:\"10\";}', 1),
(5, 'Full User', '00ccff', 'star_silver_3.png', 70, 'a:12:{s:4:\"godp\";s:2:\"on\";s:4:\"gopp\";s:2:\"on\";s:5:\"gopcp\";s:2:\"on\";s:5:\"govpp\";s:2:\"on\";s:5:\"govpn\";s:2:\"on\";s:5:\"goepc\";s:2:\"on\";s:5:\"godpc\";s:2:\"on\";s:4:\"gopf\";s:2:\"on\";s:5:\"gopcf\";s:2:\"on\";s:4:\"goaf\";s:2:\"20\";s:5:\"gopfp\";s:2:\"12\";s:5:\"gopfd\";s:2:\"20\";}', 1),
(6, 'Great User', '01A021', 'star_gold_3.png', 0, 'a:12:{s:4:\"godp\";s:2:\"on\";s:4:\"gopp\";s:2:\"on\";s:5:\"gopcp\";s:2:\"on\";s:5:\"govpp\";s:2:\"on\";s:5:\"govpn\";s:2:\"on\";s:5:\"goepc\";s:2:\"on\";s:5:\"godpc\";s:2:\"on\";s:4:\"gopf\";s:2:\"on\";s:5:\"gopcf\";s:2:\"on\";s:4:\"goaf\";s:2:\"20\";s:5:\"gopfp\";s:2:\"11\";s:5:\"gopfd\";s:2:\"15\";}', 0),
(7, 'Gold User', 'cc6600', 'asterisk_yellow.png', 120, 'a:12:{s:4:\"godp\";s:2:\"on\";s:4:\"gopp\";s:2:\"on\";s:5:\"gopcp\";s:2:\"on\";s:5:\"govpp\";s:2:\"on\";s:5:\"govpn\";s:2:\"on\";s:5:\"goepc\";s:2:\"on\";s:5:\"godpc\";s:2:\"on\";s:4:\"gopf\";s:2:\"on\";s:5:\"gopcf\";s:2:\"on\";s:4:\"goaf\";s:2:\"20\";s:5:\"gopfp\";s:2:\"12\";s:5:\"gopfd\";s:2:\"25\";}', 1);";

$phpos_sql['u_respuestas'] = "
CREATE TABLE IF NOT EXISTS `u_respuestas` (
  `mr_id` int(11) NOT NULL AUTO_INCREMENT,
  `mp_id` int(11) NOT NULL,
  `mr_from` int(11) NOT NULL,
  `mr_body` text NOT NULL,
  `mr_ip` varchar(15) NOT NULL,
  `mr_date` int(10) NOT NULL,
  PRIMARY KEY (`mr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$phpos_sql['u_sessions'] = "
CREATE TABLE IF NOT EXISTS `u_sessions` (
  `session_id` varchar(32) NOT NULL,
  `session_user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `session_ip` varchar(40) NOT NULL,
  `session_time` int(10) unsigned NOT NULL DEFAULT '0',
  `session_autologin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`session_id`),
  KEY `session_user_id` (`session_user_id`),
  KEY `session_time` (`session_time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$phpos_sql['u_suspension'] = "
CREATE TABLE IF NOT EXISTS `u_suspension` (
  `susp_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `susp_causa` text NOT NULL,
  `susp_date` int(10) NOT NULL,
  `susp_termina` int(10) NOT NULL,
  `susp_mod` int(11) NOT NULL,
  `susp_ip` varchar(15) NOT NULL,
  PRIMARY KEY (`susp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$phpos_sql['w_afiliados'] = "
CREATE TABLE IF NOT EXISTS `w_afiliados` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `a_titulo` varchar(35) NOT NULL,
  `a_url` varchar(40) NOT NULL,
  `a_banner` varchar(100) NOT NULL,
  `a_descripcion` varchar(200) NOT NULL,
  `a_sid` int(11) NOT NULL DEFAULT '0',
  `a_hits_in` int(11) NOT NULL DEFAULT '0',
  `a_hits_out` int(11) NOT NULL DEFAULT '0',
  `a_date` int(10) NOT NULL,
  `a_active` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$phpos_sql['w_configuracion'] = "
CREATE TABLE IF NOT EXISTS `w_configuracion` (
  `tscript_id` int(11) NOT NULL,
  `titulo` varchar(24) NOT NULL,
  `slogan` varchar(32) NOT NULL,
  `url` tinytext NOT NULL,
  `email` varchar(60) NOT NULL,
  `banner` varchar(100) NOT NULL,
  `tema_id` int(11) NOT NULL,
  `ads_300` text NOT NULL,
  `ads_468` text NOT NULL,
  `ads_160` text NOT NULL,
  `ads_728` text NOT NULL,
  `ads_search` varchar(50) NOT NULL,
  `chat_id` varchar(20) NOT NULL,
  `xat_id` varchar(20) NOT NULL,
  `c_last_active` int(2) NOT NULL,
  `c_allow_sess_ip` int(1) NOT NULL,
  `c_count_guests` int(1) NOT NULL,
  `c_reg_active` int(1) NOT NULL,
  `c_reg_activate` int(1) NOT NULL,
  `c_reg_rango` int(5) NOT NULL,
  `c_met_welcome` int(1) NOT NULL,
  `c_message_welcome` varchar(500) NOT NULL,
  `c_fotos_private` int(11) NOT NULL,
  `c_hits_guest` int(1) NOT NULL,
  `c_keep_points` int(1) NOT NULL,
  `c_allow_points` int(11) NOT NULL,
  `c_allow_edad` int(11) NOT NULL,
  `c_max_posts` int(2) NOT NULL,
  `c_max_com` int(3) NOT NULL,
  `c_max_nots` int(3) NOT NULL,
  `c_max_acts` int(3) NOT NULL,
  `c_newr_type` int(11) NOT NULL,
  `c_allow_sump` int(11) NOT NULL,
  `c_allow_firma` int(1) NOT NULL,
  `c_allow_upload` int(1) NOT NULL,
  `c_allow_portal` int(1) NOT NULL,
  `c_allow_live` int(1) NOT NULL,
  `c_see_mod` int(1) NOT NULL,
  `c_stats_cache` int(7) NOT NULL DEFAULT '15',
  `c_desapprove_post` int(1) NOT NULL,
  `offline` int(1) NOT NULL DEFAULT '0',
  `offline_message` varchar(255) NOT NULL,
  `pkey` varchar(55) NOT NULL,
  `skey` varchar(55) NOT NULL,
  `version` varchar(16) NOT NULL,
  `version_code` varchar(16) NOT NULL,
  PRIMARY KEY (`tscript_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$phpos_sql['wv_configuracion'] = "
INSERT INTO `w_configuracion` (`tscript_id`, `titulo`, `slogan`, `url`, `email`, `banner`, `tema_id`, `ads_300`, `ads_468`, `ads_160`, `ads_728`, `ads_search`, `chat_id`, `xat_id`, `c_last_active`, `c_allow_sess_ip`, `c_count_guests`, `c_reg_active`, `c_reg_activate`, `c_reg_rango`, `c_met_welcome`, `c_message_welcome`, `c_fotos_private`, `c_hits_guest`, `c_keep_points`, `c_allow_points`, `c_allow_edad`, `c_max_posts`, `c_max_com`, `c_max_nots`, `c_max_acts`, `c_newr_type`, `c_allow_sump`, `c_allow_firma`, `c_allow_upload`, `c_allow_portal`, `c_allow_live`, `c_see_mod`, `c_stats_cache`, `c_desapprove_post`, `offline`, `offline_message`, `pkey`, `skey`, `version`, `version_code`) VALUES
(1, 'Taringa!', 'Inteligencia Recargada', '', '', 'http://i.imgur.com/2nEr3s.png?1', 1, '<a href=\"http://www.phpost.net/\" target=\"_blank\"><img src=\"/themes/default/images/ad300.gif\"/></a>', '<a href=\"http://www.phpost.net/\" target=\"_blank\"><img src=\"/themes/default/images/ad468.png\"/></a>', '<a href=\"http://www.phpost.net/\" target=\"_blank\"><img src=\"/themes/default/images/ad160.gif\"/></a>', '<a href=\"http://www.phpost.net/\" target=\"_blank\"><img src=\"/themes/default/images/ad728.gif\"/></a>', 'partner-pub-5535725517227860:7900040286', '', 0, 15, 1, 0, 1, 1, 3, 0, 'Hola [usuario], [welcome] a [b][web][/b].', 0, 0, 0, 0, 18, 50, 50, 99, 99, 0, 0, 1, 0, 1, 1, 0, 0, 0, 0, 'Estamos en mantenimiento', '', '', 'Risus 1.3.0.000', 'risus_1_3_0_000');";

$phpos_sql['w_denuncias'] = "
CREATE TABLE IF NOT EXISTS `w_denuncias` (
  `did` int(11) NOT NULL AUTO_INCREMENT,
  `obj_id` int(11) NOT NULL,
  `d_user` int(11) NOT NULL,
  `d_razon` int(2) NOT NULL,
  `d_extra` text NOT NULL,
  `d_total` int(1) NOT NULL DEFAULT '1',
  `d_type` int(1) NOT NULL,
  `d_date` int(10) NOT NULL,
  PRIMARY KEY (`did`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$phpos_sql['w_contacts'] = "
CREATE TABLE IF NOT EXISTS `w_contacts` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`user_id` int(11) NOT NULL,
`user_email` varchar(50) NOT NULL,
`time` int(15) NOT NULL,
`type` int(1) NOT NULL,
`hash` varchar(32) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

$phpos_sql['w_medallas'] = "
CREATE TABLE IF NOT EXISTS `w_medallas` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

$phpos_sql['w_medallas_assign'] = "
CREATE TABLE IF NOT EXISTS `w_medallas_assign` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`medal_id` int(11) NOT NULL,
`medal_for` int(11) NOT NULL,
`medal_date` int(11) NOT NULL,
`medal_ip` varchar(15) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

$phpos_sql['w_historial'] = "
CREATE TABLE IF NOT EXISTS `w_historial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pofid` int(11) NOT NULL,
  `type` int(1) NOT NULL,
  `action` int(1) NOT NULL,
  `mod` int(11) NOT NULL DEFAULT '0',
  `reason` text NOT NULL,
  `date` int(11) NOT NULL,
  `mod_ip` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$phpos_sql['w_noticias'] = "
CREATE TABLE IF NOT EXISTS `w_noticias` (
  `not_id` int(11) NOT NULL AUTO_INCREMENT,
  `not_body` text NOT NULL,
  `not_autor` INT( 11 ) NOT NULL,
  `not_date` int(10) NOT NULL,
  `not_active` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`not_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$phpos_sql['w_blacklist'] = "
CREATE TABLE IF NOT EXISTS `w_blacklist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(1) NOT NULL,
  `value` varchar(50) NOT NULL,
  `reason` varchar(120) NOT NULL,
  `author` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";

$phpos_sql['w_badwords'] = "
CREATE TABLE IF NOT EXISTS `w_badwords` (
  `wid` int(11) NOT NULL AUTO_INCREMENT,
  `word` varchar(250) NOT NULL,
  `swop` varchar(250) NOT NULL,
  `method` int(1) NOT NULL,
  `type` int(1) NOT NULL,
  `author` int(11) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`wid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";

$phpos_sql['w_stats'] = "
CREATE TABLE IF NOT EXISTS `w_stats` (
  `stats_no` int(1) NOT NULL,
  `stats_max_online` int(11) NOT NULL,
  `stats_max_time` int(10) NOT NULL,
  `stats_time` int(10) NOT NULL,
  `stats_time_cache` int(10) NOT NULL,
  `stats_time_foundation` int(11) NOT NULL,
  `stats_time_upgrade` int(11) NOT NULL,
  `stats_miembros` int(11) NOT NULL,
  `stats_posts` int(11) NOT NULL,
  `stats_fotos` int(11) NOT NULL,
  `stats_comments` int(11) NOT NULL,
  `stats_foto_comments` int(11) NOT NULL,
  PRIMARY KEY (`stats_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$phpos_sql['wv_stats'] = "
INSERT INTO `w_stats` (`stats_no`, `stats_max_online`) VALUES (1, 0);";

$phpos_sql['w_temas'] = "
CREATE TABLE IF NOT EXISTS `w_temas` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `t_name` tinytext NOT NULL,
  `t_url` tinytext NOT NULL,
  `t_path` tinytext NOT NULL,
  `t_copy` tinytext NOT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;";

$phpos_sql['wv_temas'] = "
INSERT INTO `w_temas` (`tid`, `t_name`, `t_url`, `t_path`, `t_copy`) VALUES
(1, 'PHPost Default', '/themes/default', 'default', 'Taringa!');";
