<?php

if (!defined('TS_HEADER')) exit('No se permite el acceso directo al script');

/**
 * Modelo para la adminitración
 *
 * @name    c.admin.php
 * @author  PHPost Team
*/

class tsAdmin {

   # Cantidad de objeto a mostrar
   private $max = 20;

   # Extensiones para imagenes
   private $extension = ["jpg", "png", "gif", "bmp", "svg"];

   # Las opciones para los rangos (saveRango() y newRango())
   private function optionsRange($post) {
      return serialize([
         'suad' => $post['superadmin'],
         'sumo' => $post['supermod'],
         'moacp' => $post['mod-accesopanel'],
         'mocdu' => $post['mod-cancelardenunciasusuarios'],
         'moadf' => $post['mod-aceptardenunciasfotos'],
         'mocdf' => $post['mod-cancelardenunciasfotos'],
         'mocdp' => $post['mod-cancelardenunciasposts'],
         'moadm' => $post['mod-aceptardenunciasmensajes'],
         'mocdm' => $post['mod-cancelardenunciasmensajes'],
         'movub' => $post['mod-verusuariosbaneados'],
         'moub' => $post['mod-usarbuscador'],
         'morp' => $post['mod-reciclajeposts'],
         'morf' => $post['mod-reficlajefotos'],
         'mocp' => $post['mod-contenidoposts'],
         'mocc' => $post['mod-contenidocomentarios'],
         'most' => $post['mod-sticky'],
         'moayca' => $post['mod-abrirycerrarajax'],
         'movcud' => $post['mod-vercuentasdesactivadas'],
         'movcus' => $post['mod-vercuentassuspendidas'],
         'mosu' => $post['mod-suspenderusuarios'],
         'modu' => $post['mod-desbanearusuarios'],
         'moep' => $post['mod-eliminarposts'],
         'moedpo' => $post['mod-editarposts'],
         'moop' => $post['mod-ocultarposts'],
         'mocepc' => $post['mod-comentarpostcerrado'],
         'moedcopo' => $post['mod-editarcomposts'],
         'moaydcp' => $post['mod-desyaprobarcomposts'],
         'moecp' => $post['mod-eliminarcomposts'],
         'moef' => $post['mod-eliminarfotos'],
         'moedfo' => $post['mod-editarfotos'],
         'moecf' => $post['mod-eliminarcomfotos'],
         'moepm' => $post['mod-eliminarpubmuro'],
         'moecm' => $post['mod-eliminarcommuro'],
         'godp' => $post['global-darpuntos'],
         'gopp' => $post['global-publicarposts'],
         'gopcp' => $post['global-publicarcomposts'],
         'govpp' => $post['global-votarposipost'],
         'govpn' => $post['global-votarnegapost'],
         'goepc' => $post['global-editarpropioscomentarios'],
         'godpc' => $post['global-eliminarpropioscomentarios'],
         'gopf' => $post['global-publicarfotos'],
         'gopcf' => $post['global-publicarcomfotos'],
         'gorpap' => $post['global-revisarposts'],
         'govwm' => $post['global-vermantenimiento'],
         'goaf' => $post['global-antiflood'],
         'gopfp' => $post['global-pointsforposts'],
         'gopfd' => $post['global-pointsforday']
      ]);
   }

   /** 
    * Agregamos esta función ya que se repite 2 veces,
    * extraemos las imagenes
   */
   public function getExtraIcons(string $folder = 'cat', int $size = 16) {
      # Accedemos a la carpeta de icons
      $carpeta = opendir( TS_FILES . "images/{$folder}" );
      # Recorremos la carpeta
      while ($archivo = readdir($carpeta)) {
         # Obtenemos la extension
         $ext = substr($archivo, -3);
         # Es una imagen?
         if (in_array($ext, $this->extension)) {
            if ($size != 16) {
               $im_size = substr($archivo, -6, 2);
               if ($size == $im_size) $icons[] = substr($archivo, 0, -7);
            } else $icons[] = $archivo;
         }
      }
      # Retornamos las imagenes
      return $icons;
   }
   /**
    * Obtenemos a todos los administradores
   */
   public function getAdmins() {
      return result_array(db_exec([__FILE__, __LINE__], 'query', 'SELECT `user_id`, `user_name` FROM `u_miembros` WHERE user_rango = 1 ORDER BY user_id'));
   }
   /**
    * Obtenemos fundación y acutalización
   */
   public function getInst() {
      return db_exec('fetch_row', db_exec([__FILE__, __LINE__], 'query', 'SELECT `stats_time_foundation`, `stats_time_upgrade` FROM `w_stats` WHERE stats_no = 1'));
   }
   /**
    * Obtenemos las versiones
   */
   public function getVersions() {
      # Versión de PHP
      $data['php'] = PHP_VERSION;
      # Versión MySQL
      $data['mysql'] = db_exec('fetch_row', db_exec([__FILE__, __LINE__], 'query', 'SELECT VERSION()'));
      # Versión del servidor
      $data['server'] = $_SERVER['SERVER_SOFTWARE'];
      # Versión de la librería GD (para trabajar con imagenes)
      if (extension_loaded("gd") && function_exists("gd_info")) {
         $temp = @gd_info();
         $temp = $temp['GD Version'];
      } else {
         $temp = "GD no instalada. Busque php.ini ;extesion:gd o ;extension:php_gd2.dll y descomentela quitando el ; ";
      }
      # Retornamos las versiones
      return $data;
   }
   /**
    * Guardamos la configuración desde la administración.
    * para más información puedes visitar:
    * @link https://phpost.es/showthread.php?tid=320
    * @link https://www.phpost.net/foro/topic/32479-simplificar-la-funci%C3%B3n-saveconfig/
    * @link https://phpost.es/showthread.php?tid=319 [providers]
   */   
   public function saveConfig() {
      global $tsCore;
      /**
       * Unimos todos los parametros y 
       * quitamos el $_POST["save"] con array_slice()
       * @link https://www.php.net/manual/es/function.array-slice.php
       * con el -1 se quita el $_POST["save"]
      */
      # Consultamos si existe, tenemos que poner el nombre
      if(isset($_POST["providers"])):
         # Lo que va a hacer es reemplazar el parametro por este nuevo
         /**
          * @link https://www.php.net/manual/es/function.json-encode.php
         */
         $_POST["providers"] = json_encode(explode(', ', $_POST["providers"]), JSON_FORCE_OBJECT);
      endif;
      //
      $columnas = $tsCore->getIUP( array_slice($_POST, 0, -1) );
      if (db_exec([__FILE__, __LINE__], "query", "UPDATE w_configuracion SET {$columnas} WHERE tscript_id = 1")) return true;
      else exit( show_error('Error al ejecutar la consulta de la l&iacute;nea '.__LINE__.' de '.__FILE__.'.', 'Base de datos') );
   }
   /**
    * ------------------------------
    * NOTICIAS
    * getNoticias() :: Obtenemos todas las noticias 
    * getNoticia() :: Obtengo la noticia por ID
    * newNoticia() :: Creamos nueva noticia
    * editNoticia() :: Editamos la noticia
    * delNoticia() :: Eliminamos la noticia
    * ------------------------------ 
   */
   public function getNoticias() {
      $data = result_array(db_exec([__FILE__, __LINE__], 'query', 'SELECT u.user_id, u.user_name, n.* FROM w_noticias AS n LEFT JOIN u_miembros AS u ON n.not_autor = u.user_id  WHERE n.not_id > 0 ORDER BY n.not_id DESC'));
      return $data;
   }
   public function getNoticia() {
      global $tsCore;
      # Obtenemos la ID de la noticia
      $not_id = intval($_GET['nid']);
      # Obtenemos la información
      $data = db_exec('fetch_assoc', db_exec([__FILE__, __LINE__], 'query', 'SELECT `not_id`, `not_body`, `not_date`, `not_active` FROM w_noticias WHERE not_id = ' . $not_id . ' LIMIT 1'));
      # Retornamos los datos
      return $data;
   }
   public function newNoticia() {
      global $tsCore, $tsUser;
      # Obtenemos datos enviados por POST
      $body = $tsCore->setSecure($tsCore->parseBadWords(substr($_POST['not_body'], 0, 190)));
      $active = empty($_POST['not_active']) ? 0 : 1;
      if (!empty($body)) {
         if (db_exec([__FILE__, __LINE__], 'query', 'INSERT INTO `w_noticias` (`not_body`, `not_autor`, `not_date`, `not_active`) VALUES (\''.$body.'\', '.$tsUser->uid.', '.time().', '.$active .')')) return true;
      }
      # Retornamos falso si no se creó
      return false;
   }
   public function editNoticia() {
      global $tsCore, $tsUser;
      # Obtenemos la ID de la noticia
      $id = intval($_GET['nid']);
      $body = $tsCore->setSecure($tsCore->parseBadWords(substr($_POST['not_body'], 0, 190)));
      $active = empty($_POST['not_active']) ? 0 : 1;
      if (!empty($body)) {
         if (db_exec([__FILE__, __LINE__], 'query', 'UPDATE `w_noticias` SET `not_autor` = '.$tsUser->uid.', `not_body` = \''.$body.'\', not_active = '.$active.' WHERE not_id = ' . $id)) return true;
      }
   }
   public function delNoticia() {
      # Obtenemos la ID de la noticia
      $not_id = intval($_GET['nid']);
      if(!db_exec('num_rows', db_exec([__FILE__, __LINE__], 'query', 'SELECT `not_id` FROM `w_noticias` WHERE `not_id` = ' .$not_id . ' LIMIT 1'))) return 'El id ingresado no existe.';
      db_exec([__FILE__, __LINE__], 'query', 'DELETE FROM `w_noticias` WHERE `not_id` = ' . $not_id);
   }
   /**
    * ------------------------------
    * TEMAS
    * getTemas() :: Obtenemos todos los temas instalados
    * getTema() :: Obtenemos el tema por ID
    * saveTema() :: Guardamos el tema con nuevos valores
    * changeTema() :: Cambiamos de tema 
    * deleteTema() :: Eliminamos el tema
    * newTema() :: Instalamos nuevo tema
    * ------------------------------ 
   */
   public function getTemas() {
      # Obtenemos la lista de temas
      $data = result_array(db_exec([__FILE__, __LINE__], 'query', 'SELECT * FROM `w_temas` WHERE tid > 0'));
      # Retornamos datos
      return $data;
   }
   public function getTema() {
      # Obtenemos el ID por GET
      $tema_id = intval($_GET['tid']);
      # Obtenemos la información
      $data = db_exec('fetch_assoc', db_exec([__FILE__, __LINE__], 'query', 'SELECT * FROM `w_temas` WHERE tid = '.$tema_id.' LIMIT 1'));
      # Retornamos los datos
      return $data;
   }
   public function saveTema() {
      global $tsCore;
      # Obtenemos el ID por GET
      $tema_id = intval($_GET['tid']);
      # Creamos un arreglo para agregar
      $t = $tsCore->getIUP([
         't_url' => $tsCore->setSecure($_POST['url']), 
         't_path' => $tsCore->setSecure($_POST['path'])
      ]);
      # Actualizamos la tabla w_temas
      return (db_exec([__FILE__, __LINE__], 'query', 'UPDATE `w_temas` SET '.$t.' WHERE tid = ' . $tema_id)) ? true : false;
   }
   public function changeTema() {
      /**
       * Al tener la configuración de Smarty 4, 
       * ya no requiere de ir a caché para eliminar archivos
      */
      # Obtenemos los datos desde la funcion creada
      $tema = intval($_GET["tid"]);
      if($tema > 0) {
         db_exec([__FILE__, __LINE__], "query", "UPDATE w_configuracion SET tema_id = {$tema} WHERE wid = 1");
         return true;
      } else return false;
   }
   public function deleteTema() {
      # Obtenemos el tema que eliminaremos
      $tema = $this->getTema()['tid'];
      if (!empty($tema)) {
         db_exec([__FILE__, __LINE__], 'query', 'DELETE FROM `w_temas` WHERE tid = ' . $tema);
         return true;
      } else return false;
   }
   public function newTema() {
      global $tsCore, $smarty;
      # Obtenemos el nombre de la carpeta a instalar por POST
      $tema_path = $tsCore->setSecure($_POST['path']);
      /**
       * Obtenemos el archivo de instalación del tema
       * esta es lo que se configuró en smarty.config.php
      */
      include $smarty->template_dir["themes"] . $tema_path . "/install.php";
      # Instalando usando directamente el botón de "instalar tema"
      $name = $tsCore->setSecure($tema['nombre']);
      $path = $tsCore->setSecure($tema['path']);
      $url = $tsCore->settings['url'] . '/themes/' . $path;
      $copy = $tsCore->setSecure($tema['copy']);
      //
      if (empty($tema)) return 'Revisa que la carpeta del tema sea correcta.';
      // NUEVO
      if (db_exec([__FILE__, __LINE__], 'query', 'INSERT INTO `w_temas` (`t_name`, `t_url`, `t_path`, `t_copy`) VALUES (\''.$name.'\', \''.$url.'\', \''.$path.'\', \''.$copy.'\')')) return true;
      else return 'Ocurri&oacute; un error durante la instalaci&oacute;n. Consulta el foro ofcial de PHPost.';
   }
   /**
    * ------------------------------
    * PUBLICIDADES
    * saveAds() :: Guardamos las publicidades
    * ------------------------------ 
   */
   public function saveAds() {
      global $tsCore;
      /**
       * Podria ser un riesgo de seguridad no limpiar estas variables? 
       * no lo creo pues cuando definimos el nivel de acceso solo 
       * pueden entrar administradores.
      */
      $publicidades = $tsCore->getIUP([
         'ads_300' => $tsCore->setSecure(html_entity_decode($_POST['ads_300'])),
         'ads_468' => $tsCore->setSecure(html_entity_decode($_POST['ads_468'])),
         'ads_160' => $tsCore->setSecure(html_entity_decode($_POST['ads_160'])),
         'ads_728' => $tsCore->setSecure(html_entity_decode($_POST['ads_728'])),
         'ads_search' => $tsCore->setSecure($_POST['ads_search'])
      ]);
      # Guardamos los datos en la base
      if (db_exec([__FILE__, __LINE__], 'query', 'UPDATE `w_configuracion` SET '.$publicidades.' WHERE tscript_id = 1')) return true;
   }
   /**
    * ------------------------------
    * CATEGORIAS
    * saveOrden() :: Guardamos nuevo orden de las categorías
    * getCat() :: Obtenemos la categoría por ID
    * saveCat() :: Guardamos los nuevos datos de la categoría
    * MoveCat() :: Mover de categoría
    * newCat() :: Creamos una nueva categoría
    * delCat() :: Eliminamos la categoría 
    * ------------------------------ 
   */
   public function saveOrden() {
      global $tsCore;
      # 
      $ordenado = [];
      # Obtenemos lista con el nuevo orden
      $nuevo_orden = 1;
      foreach (explode(',', $_POST["cats"]) as $orden) {
         db_exec([__FILE__, __LINE__], 'query', "UPDATE p_categorias SET c_orden = ".$nuevo_orden." WHERE cid = ".$orden);
         array_push($ordenado, $nuevo_orden);
         $nuevo_orden++;
      }
   }
   public function getCat() {
      global $tsCore;
      # Obtenemos la ID de la categoría
      $cid = intval($_GET['cid']);
      # Obtenemos la información
      $data = db_exec('fetch_assoc', db_exec([__FILE__, __LINE__], 'query', 'SELECT cid, c_orden, c_nombre, c_seo, c_img FROM p_categorias WHERE cid = '.$cid.' LIMIT 1'));
      # Retornamos los daots
      return $data;
   }
   public function saveCat() {
      global $tsCore;
      # Obtenemos la ID de la categoría
      $cid = intval($_GET['cid']);
      //
      $nombre = $tsCore->setSecure($tsCore->parseBadWords($_POST['c_nombre']));
      $categoria = $tsCore->getIUP([
         "nombre" => $nombre,
         "seo" => $tsCore->setSEO($nombre),
         "img" => $tsCore->setSecure($tsCore->parseBadWords($_POST['c_img'])),
      ], 'c_');
      # Guardamos en la tabla
      if (db_exec([__FILE__, __LINE__], 'query', 'UPDATE `p_categorias` SET '.$categoria.' WHERE cid = ' . $cid)) return true;
   }
   public function MoveCat() {
      $new = intval($_POST['newcid']);
      if (db_exec([__FILE__, __LINE__], 'query', 'UPDATE `p_posts` SET post_category = '.$new.' WHERE post_category = ' . intval($_POST['oldcid']))) return true;
   }
   public function newCat() {
      global $tsCore;
      # Valores
      $c_nombre = $tsCore->setSecure($tsCore->parseBadWords($_POST['c_nombre']));
      $c_seo = $tsCore->setSEO($c_nombre);
      $c_img = $tsCore->setSecure($tsCore->parseBadWords($_POST['c_img']));
      # Orden
      $orden = db_exec('fetch_assoc', db_exec([__FILE__, __LINE__], 'query', 'SELECT COUNT(cid) AS total FROM p_categorias'));
      $orden = $orden['total'] + 1;
      # Insertamos los datos
      if (db_exec([__FILE__, __LINE__], 'query', 'INSERT INTO `p_categorias` (`c_orden`, `c_nombre`, `c_seo`, `c_img`) VALUES ('.$orden.', \''.$c_nombre.'\',\''.$c_seo.'\', \''.$c_img.'\')')) return true;
   }
   public function delCat() {
      global $tsCore;
      //
      $cid = intval($_GET['cid']);
      $ncid = intval($_POST['ncid']);
      // MOVER
      if (!empty($ncid) && $ncid > 0) {
         if (db_exec([__FILE__, __LINE__], 'query', 'UPDATE `p_posts` SET post_category = '.$ncid.' WHERE post_category = ' . $cid)) {
            if (db_exec([__FILE__, __LINE__], 'query', 'DELETE FROM `p_categorias` WHERE cid = ' . $cid)) return true;
         // SI LLEGÓ HASTA AQUI HUBO UN ERROR.
         } else return 'Lo sentimos ocurri&oacute; un error, pongase en contacto con PHPost.';
      } else return 'Antes de eliminar una categor&iacute;a debes elegir a donde mover sus subcategor&iacute;as.';
   }
   /**
    * ------------------------------
    * RANGOS
    * getRangos() :: Obtenemos todos los rangos
    * getRango() :: Obtenemos el rango por ID
    * getRangoUsers() :: Obtenemos rangos de usuarios
    * saveRango() :: Guardamos los datos del rango
    * newRango() :: Creamos un nuevo rango
    * delRango() :: Eliminamos el rango
    * SetDefaultRango() :: Rango predeterminado
    * ------------------------------ 
   */
   public function getRangos() {
      global $tsCore;
      // RANGOS SIN PUNTOS
      $query = db_exec([__FILE__, __LINE__], 'query', 'SELECT * FROM u_rangos ORDER BY rango_id, r_cant');
      // ARMAR ARRAY
      while ($row = db_exec('fetch_assoc', $query)) {
         $extra = unserialize($row['r_allows']);
         $data[$row['r_type'] == 0 ? 'regular' : 'post'][$row['rango_id']] = array(
            'id' => $row['rango_id'],
            'name' => $row['r_name'],
            'color' => $row['r_color'],
            'imagen' => $row['r_image'],
            'cant' => $row['r_cant'],
            'max_points' => $extra['gopfp'],
            'user_puntos' => $extra['gopfd'],
            'type' => $row['r_type'],
            'num_members' => 0
         );
      }
      db_exec('free_result', $query);
      // NUMERO DE USUARIOS EN CADA RANGO
      if (!empty($data['post'])) {
         $query = db_exec([__FILE__, __LINE__], 'query', "SELECT user_rango AS ID_GROUP, COUNT(user_id) AS num_members FROM u_miembros WHERE user_rango IN (" . implode(', ', array_keys($data['post'])) . ") GROUP BY user_rango");
         while ($row = db_exec('fetch_assoc', $query)) $data['post'][$row['ID_GROUP']]['num_members'] += $row['num_members'];
         db_exec('free_result', $query);
      }
      // NUMERO DE USUARIOS EN RANGOS REGULARES
      if (!empty($data['regular'])) {
         $query = db_exec([__FILE__, __LINE__], 'query', "SELECT user_rango AS ID_GROUP, COUNT(*) AS num_members FROM u_miembros WHERE user_rango IN (" . implode(', ', array_keys($data['regular'])) . ") GROUP BY user_rango");
         while ($row = db_exec('fetch_assoc', $query)) $data['regular'][$row['ID_GROUP']]['num_members'] += $row['num_members'];
         db_exec('free_result', $query);
      }
      //
      return $data;
   }
   public function getRango() {
      global $tsCore;
      # Obtenemos la ID
      $id = intval($_GET['rid']);
      # Obtenemos datos
      $data = db_exec('fetch_assoc', db_exec([__FILE__, __LINE__], 'query', 'SELECT * FROM u_rangos WHERE rango_id = \'' . $id .'\' LIMIT 1'));
      # Deserializamos
      $data['permisos'] = unserialize($data['r_allows']);
      # Retornamos los datos
      return $data;
   }
   public function getRangoUsers() {
      global $tsCore;
      //
      $rid = intval($_GET['rid']);
      $max = 10; // MAXIMO A MOSTRAR
      // TIPO DE BUSQUEDA
      $type = $_GET['t'];
      $where = 'user_rango = ' . $rid;
      // SELECCIONAMOS
      $limit = $tsCore->setPageLimit($max, true);
      $data['data'] = result_array(db_exec([__FILE__, __LINE__], 'query', 'SELECT u.user_id, u.user_name, u.user_email, u.user_registro, u.user_lastlogin FROM u_miembros AS u WHERE u.' . $where . ' LIMIT ' . $limit));
      # Paginamos
      list($total) = db_exec('fetch_row', db_exec([__FILE__, __LINE__], 'query', 'SELECT COUNT(*) FROM u_miembros WHERE ' . $where));
      $data['pages'] = $tsCore->pageIndex($tsCore->settings['url'] . '/admin/rangos?act=list&rid=' . $rid . '&t=' . $type . '', $_GET['s'], $total, $max);
      # Retornamos
      return $data;
   }
   public function saveRango() {
      global $tsCore;
      //
      $rid = intval($_GET['rid']);
      $r = [
         'r_name' => $tsCore->setSecure($tsCore->parseBadWords($_POST['rName'])),
         'r_color' => $tsCore->setSecure($_POST['rColor']),
         'r_image' => $tsCore->setSecure($_POST['r_img']),
         'r_cant' => intval(empty($_POST['global-cantidadrequerida']) ? 0 : $tsCore->setSecure($_POST['global-cantidadrequerida'])),
         'r_type' => $_POST['global-type'] > 4 ? 0 : $_POST['global-type'],
         'r_allows' => self::optionsRange($_POST)
      ];
      //
      if (empty($r['r_name']))  return 'Debes ingresar el nombre del nuevo rango.';
      if ($_POST['global-pointsforposts'] > $_POST['global-pointsforday']) return 'El rango no puede dar m&aacute;s puntos de los que tiene al d&iacute;a.';
      //
      $columnas = $tsCore->getIUP( $r );
      // 
      return (db_exec([__FILE__, __LINE__], 'query', 'UPDATE `u_rangos` SET '.$columnas.' WHERE rango_id = ' . $rid)) ? true : exit( show_error('Error al ejecutar la consulta de la l&iacute;nea '.__LINE__.' de '.__FILE__.'.', 'db') );
   }
   public function newRango() {
      global $tsCore;
      //
      $r = [
         'r_name' => $tsCore->setSecure($tsCore->parseBadWords($_POST['rName'])),
         'r_color' => $tsCore->setSecure($_POST['rColor']),
         'r_img' => $tsCore->setSecure($_POST['r_img']),
         'r_cant' => intval(empty($_POST['global-cantidadrequerida']) ? 0 : $tsCore->setSecure($_POST['global-cantidadrequerida'])),
         'r_type' => intval($_POST['global-type'] > 4 ? 0 : $_POST['global-type']),
         'r_allows' => $tsCore->setSecure(self::optionsRange($_POST))
      ];
      //
      if (empty($r['r_name'])) return 'Debes ingresar el nombre del nuevo rango.';
      if ($_POST['global-pointsforposts'] > $_POST['global-pointsforday']) return 'El rango no puede dar m&aacute;s puntos de los que tiene al d&iacute;a.';
      //
      if (db_exec([__FILE__, __LINE__], 'query', 'INSERT INTO `u_rangos` (`r_name`, `r_color`, `r_image`, `r_cant`, `r_allows`, `r_type`) VALUES (\'' . $r['r_name'] . '\', \'' . $r['r_color'] . '\', \'' . $r['r_img'] . '\', \'' . $r['r_cant'] . '\', \'' . $r['r_allows'] . '\', \'' . $r['r_type'] . '\')')) return 1;
   }
   public function delRango() {
      global $tsCore;
      //
      $rid = intval($_GET['rid']);
      $nid = intval($_POST['new_rango']);
      //
      if ($rid > 3) {
         if (db_exec([__FILE__, __LINE__], 'query', 'UPDATE u_miembros SET user_rango = '.$nid.' WHERE user_rango = ' . $rid )) {
            if (db_exec([__FILE__, __LINE__], 'query', 'DELETE FROM u_rangos WHERE rango_id = ' . $rid)) return true;
         }
      } else return 'No es posible eliminar este rango';
   }
   public function SetDefaultRango() {
      global $tsCore;
      //
      if($_SERVER['HTTP_REFERER'] == $tsCore->settings['url'].'/admin/rangos?save=true' || $_SERVER['HTTP_REFERER'] == $tsCore->settings['url'].'/admin/rangos') {
         $rid = intval($_GET['rid']);
         //
         $dato = db_exec('fetch_assoc', db_exec([__FILE__, __LINE__], 'query', 'SELECT rango_id, r_type FROM u_rangos WHERE rango_id = ' .$rid.' LIMIT 1'));
         if (!empty($dato['rango_id']) && intval($dato['r_type']) == 0) {
            if (db_exec([__FILE__, __LINE__], 'query', 'UPDATE w_configuracion SET c_reg_rango = '.$rid.' WHERE tscript_id = 1')) return true;
         } else return 'El rango no existe o no es posible utilizarlo';
      } else return 'Petici&oacute;n inv&aacute;lida';
   }
   /**
    * ------------------------------
    * USUARIOS
    * getUsuarios() :: Obtenemos todos los usuarios
    * getUserPrivacidad() :: Obtenemos privacidad del usuario
    * setUserPrivacidad() :: Guardamos privacidad del usuario
    * getUserData() :: Obtenemos datos del usuario
    * setUserData() :: Guardamos datos del usuario
    * deleteContent() :: Eliminamos el contenido del usuario
    * getUserRango() :: Obtenemos el rango del usuario
    * setUserFirma() :: Guardamos nueva firma del usuario
    * setUserInActivo() :: Activar/Desactivar usuario (AJAX)
    * ------------------------------ 
   */
   public function getUsuarios() {
      global $tsCore;
      //
      $max = 20; // MAXIMO A MOSTRAR
      $limit = $tsCore->setPageLimit($max, true);
      //
      $order = ($_GET['o'] === 'e') ? 'activo, u.user_baneado' : ($_GET['o'] === 'c' ? 'email' : ($_GET['o'] == 'i' ? 'last_ip' : ($_GET['o'] == 'u' ? 'lastactive' : 'id')));
      //
      $data['data'] = result_array(db_exec([__FILE__, __LINE__], 'query', 'SELECT u.*, r.*, p.* FROM u_perfil AS p LEFT JOIN u_miembros AS u ON u.user_id = p.user_id LEFT JOIN u_rangos AS r ON r.rango_id = u.user_rango ORDER BY u.user_'.$order.' ' . ($_GET['m'] == 'a' ? 'ASC' : 'DESC') . ' LIMIT ' . $limit));
      # Paginamos
      list($total) = db_exec('fetch_row', db_exec([__FILE__, __LINE__], 'query', 'SELECT COUNT(*) FROM u_miembros WHERE user_id > 0'));
      $data['pages'] = $tsCore->pageIndex($tsCore->settings['url'] . "/admin/users?o=" . $_GET['o'] . "&m=" . $_GET['m'] . "", $_GET['s'], $total, $max);
      # Retornamos
        return $data;
   }
   public function getUserPrivacidad() {
      # Obtenemos la ID del usuario
      $uid = intval($_GET['uid']);
      $data = db_exec('fetch_assoc', db_exec([__FILE__, __LINE__], 'query', 'SELECT p_configs FROM u_perfil WHERE user_id = '.$uid.' LIMIT 1'));
      $data['p_configs'] = unserialize($data['p_configs']);
      //
      return $data;
   }
   public function setUserPrivacidad() {
      global $tsCore;
      # ID del usuario
      $uid = intval($_GET['uid']);
      //
      $muro_firm = ($_POST['muro_firm'] > 4) ? 5 : $_POST['muro_firm'];
      $see_hits = ($_POST['last_hits'] == 1 || $_POST['last_hits'] == 2) ? 0 : $_POST['last_hits'];
      $perfilData['configs'] = serialize([
         'm' => $_POST['muro'],
         'mf' => $muro_firm,
         'rmp' => $_POST['rec_mps'],
         'hits' => $see_hits
      ]);
      //
      $updates = $tsCore->getIUP($perfilData, 'p_');
      if (db_exec([__FILE__, __LINE__], 'query', 'UPDATE u_perfil SET ' . $updates . ' WHERE user_id = ' . $uid)) return true;
   }
   public function getUserData() {
      global $tsCore;
      # ID del usuario
      $user_id = intval($_GET['uid']);
      //
      $data = db_exec('fetch_assoc', db_exec([__FILE__, __LINE__], 'query', 'SELECT u.*, r.*, p.* FROM u_perfil AS p LEFT JOIN u_miembros AS u ON u.user_id = p.user_id LEFT JOIN u_rangos AS r ON r.rango_id = u.user_rango WHERE u.user_id = '.$user_id.' LIMIT 1'));
      $data['p_configs'] = json_decode($data['p_configs'], true);
      # Retornamos
      return $data;
   }
   public function setUserData(int $user_id = 0) {
      global $tsCore;
      # DATA
      $data = db_exec('fetch_assoc',db_exec([__FILE__, __LINE__], 'query', 'SELECT `user_name`, `user_email`, `user_password` FROM u_miembros WHERE user_id = ' . $user_id));
      # LOCALS
      $email = $tsCore->setSecure(empty($_POST['email']) ? $data['user_email'] : $_POST['email']);
      $password = $_POST['pwd'];
      $cpassword = $_POST['cpwd'];
      $user_nick = empty($_POST['nick']) ? $data['user_name'] : $_POST['nick'];
      $user_points = empty($_POST['points']) ? $data['user_puntos'] : $_POST['points'];
      $pointsxdar = empty($_POST['pointsxdar']) ? $data['user_puntos'] : $_POST['pointsxdar'];
      $changenames = empty($_POST['changenicks']) ? $data['user_name_changes'] : $_POST['changenicks'];
      $up["user_email"] = $email;
      #
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return 'Correo electr&oacute;nico incorrecto';
      if ($user_points >= 0) {
         $up["user_puntos"] = intval($user_points);
      } else return 'Los puntos del usuario no se reconocen';
      if ($changenames >= 0) {
         $up["user_name_changes"] = intval($changenames);
      } else return 'Las disponibilidades de cambios de nombre de usuario deben ser num&eacute;ricas.';
      if ($pointsxdar >= 0) {
         $up["user_puntosxdar"] = intval($pointsxdar);
      } else return 'Los puntos para dar no se reconocen';
      if (!empty($password) && !empty($cpassword)) {
         if (strlen($user_nick) < 3) return 'Nick demasiado corto.';
         if (!preg_match('/^([A-Za-z0-9]+)$/', $user_nick)) return 'Nick inv&aacute;lido';
         $up["user_name"] = $tsCore->setSecure($user_nick);
         # Pass
         if (strlen($password) < 6) return 'Contrase&ntilde;a no v&aacute;lida.';
         if ($password != $cpassword) return 'Las contrase&ntilde;as no coinciden';
         $up["user_password"] = $tsCore->setSecure(md5(md5($password) . strtolower($user_nick)));
      }
      # Guardamos los nuevos datos
      $update = $tsCore->getIUP($up);
      if (db_exec([__FILE__, __LINE__], 'query', 'UPDATE `u_miembros` SET '.$update.' WHERE user_id = ' . $user_id)) {
         if ($_POST['sendata']) {
            mail($email, "Nuevos datos de acceso", "Sus datos de acceso a {$tsCore->settings['titulo']} han sido cambiados por un administrador. Los nuevos datos son: usuario: {$user_nick}, contraseña: {$password}. Disculpe las molestias", "From: {$tsCore->settings['titulo']} <no-reply@{$tsCore->settings['domain']}>");
         }
         return true;
      }
   }
   public function deleteContent(int $user_id = 0){
      global $tsUser;
      #
      $pass = md5(md5($_POST['password']) . strtolower($tsUser->nick));
      if(db_exec('num_rows', db_exec([__FILE__, __LINE__], 'query', 'SELECT user_id FROM u_miembros WHERE user_id = \''.$tsUser->uid.'\' && user_password = \''.$pass.'\''))) {
         # Nuevo formato mejorado (entendible)
         $todo = isset($_POST['bocuenta']);
         # Creamos un arreglo que tenga las tablas y columnas con datos
         $arreglo = [
            'boposts' => ['tabla' => 'p_posts', 'columna' => 'post_user'],
            'bofotos' => ['tabla' => 'f_fotos', 'columna' => 'f_user'],
            'boestados' => ['tabla' => 'u_muro', 'columna' => 'p_user_pub'],
            'bocomposts' => ['tabla' => 'p_comentarios', 'columna' => 'c_user'],
            'bocomfotos' => ['tabla' => 'f_comentarios', 'columna' => 'c_user'],
            'bocomestados' => ['tabla' => 'u_muro_comentarios', 'columna' => 'c_user'],
            'bolikes' => ['tabla' => 'u_muro_likes', 'columna' => 'user_id'],
            'boseguidores' => ['tabla' => 'u_follows', 'columna' => 'f_type = 1 && f_id'],
            'bosiguiendo' => ['tabla' => 'u_follows', 'columna' => 'f_type = 1 && f_user'],
            'bofavoritos' => ['tabla' => 'p_favoritos', 'columna' => 'fav_user'],
            'bovotosposts' => ['tabla' => 'p_votos', 'columna' => 'tuser'],
            'bovotosfotos' => ['tabla' => 'f_votos', 'columna' => 'v_user'],
            'boactividad' => ['tabla' => 'u_actividad', 'columna' => 'user_id'],
            'boavisos' => ['tabla' => 'u_avisos', 'columna' => 'user_id'],
            'bobloqueos' => ['tabla' => 'u_bloqueos', 'columna' => 'b_user'],
            'bomensajes' => ['tabla' => ['u_mensajes', 'u_respuestas'], 'columna' => ['mp_from', 'mr_from']],
            'bosesiones' => ['tabla' => 'u_sessions', 'columna' => 'session_user_id'],
            'bovisitas' => ['tabla' => 'w_visitas', 'columna' => 'user']
         ];
         foreach($arreglo as $accion => $tipo) {
            if($_POST[$accion] === 'on') {
               if(is_array($tipo["tabla"]) OR is_array($tipo["columna"])) {
                  foreach ($tipo["tabla"] as $t => $tabla) {
                     db_exec([__FILE__, __LINE__], 'query', "DELETE FROM {$tipo["tabla"][$t]} WHERE {$tipo["columna"][$t]} = {$user_id}");
                  }
               } else {
                  db_exec([__FILE__, __LINE__], 'query', "DELETE FROM {$tipo["tabla"]} WHERE {$tipo["columna"]} = {$user_id}");
               }
            }
         }
         //
         if($todo && $tsUser->uid != $user_id){
            $array = [
               ['tabla' => 'u_miembros', 'columna' => 'user_id'],
               ['tabla' => 'u_perfil', 'columna' => 'user_id'],
               ['tabla' => 'u_portal', 'columna' => 'user_id'],
               ['tabla' => 'w_denuncias', 'columna' => 'd_user'],
               ['tabla' => 'u_bloqueos', 'columna' => 'b_auser'],
               ['tabla' => 'u_mensajes', 'columna' => 'b_auser'],
               ['tabla' => 'w_visitas', 'columna' => 'type = 1 && for']
            ];
            foreach($array as $item) {
               db_exec([__FILE__, __LINE__], 'query', "DELETE FROM {$item["tabla"]} WHERE {$item["columna"]} = {$user_id}");
            }
         }
         #
         $data = db_exec('fetch_row', db_exec([__FILE__, __LINE__], 'query', 'SELECT user_name FROM u_miembros WHERE user_id = '.$user_id));
         $admin = db_exec('fetch_row', db_exec([__FILE__, __LINE__], 'query', 'SELECT user_email FROM u_miembros WHERE user_id = 1'));
         # Insertamos el aviso
         db_exec([__FILE__, __LINE__], 'query', 'INSERT INTO `u_avisos` (`user_id`, `av_subject`, `av_body`, `av_date`, `av_read`, `av_type`) VALUES (\'1\', \'Contenido eliminado\', \'Hola, le informamos que el administrador '.$tsUser->nick.' ('.$tsUser->uid.') ha eliminado '.($todo ? 'la cuenta' : 'varios contenidos').' de '.$data[0].'.\', \''.time().'\', \'0\', \'1\')');
         # Enviamos el email
         mail($admin[0], 'Contenido eliminado', '<html><head><title>Contenido de cierta cuenta han sido eliminados.</title></head><body><p>Hola, le informamos que el administrador '.$tsUser->nick.' ('.$tsUser->uid.') ha eliminado '.($todo ? 'la cuenta' : 'varios contenidos').' de '.$data[0].'</p></body></html>', 'Content-type: text/html; charset=iso-8859-15');
         # Retornamos OK
         return 'OK';
      } else return 'Credenciales incorrectas';
   }
   public function getUserRango(int $user_id = 0) {
      # CONSULTA
      $data['user'] = db_exec('fetch_assoc', db_exec([__FILE__, __LINE__], 'query', 'SELECT u.user_rango, r.rango_id, r.r_name, r.r_color FROM u_miembros AS u LEFT JOIN u_rangos AS r ON u.user_rango = r.rango_id WHERE u.user_id = '.intval($user_id).' LIMIT 1'));
      # RANGOS DISPONIBLES
      $data['rangos'] = self::getAllRangos();
      # Retornamos datos
      return $data;
   }
   public function setUserFirma(int $user_id = 0) {
      global $tsCore;
      if (db_exec([__FILE__, __LINE__], 'query', 'UPDATE `u_perfil` SET user_firma = \'' . $tsCore->setSecure($_POST['firma']) . '\' WHERE user_id = ' . intval($user_id))) return true;
   }
   public function setUserInActivo() {
      global $tsUser;
      # Obtenemos la ID del usuair
      $usuario = intval($_POST['uid']);
      $data = db_exec('fetch_assoc', db_exec([__FILE__, __LINE__], 'query', 'SELECT user_activo FROM u_miembros WHERE user_id = ' . $usuario));
      # Hacemos comprobaciones
      $act = (intval($data['user_activo']) === 1) ? 0 : 1;
      $txt = (intval($data['user_activo']) === 1) ? '2: Cuenta desactivada' : '1: Cuenta activada.';
      //
      return (db_exec([__FILE__, __LINE__], 'query', 'UPDATE u_miembros SET user_activo = '.$act.' WHERE user_id = ' . $usuario)) ? $txt : '0: Ocurri&oacute, un error';
   }
   /**
    * ------------------------------
    * RANGOS
    * getAllRangos() :: Obtenemos todos los rangos
    * setUserRango() :: Cambiamos de rangos a usuarios
    * ------------------------------ 
   */
   public function getAllRangos() {
      # RANGOS DISPONIBLES
      $data = result_array(db_exec([__FILE__, __LINE__], 'query', 'SELECT `rango_id`, `r_name`, `r_color` FROM `u_rangos`'));
      # Retornamos datos
      return $data;
   }
   public function setUserRango(int $user_id = 0) {
      global $tsUser;
      # SOLO EL PRIMER ADMIN PUEDE PONER A OTROS ADMINS
      $new_rango = intval($_POST['new_rango']);
      if ($user_id === $tsUser->uid) return 'No puedes cambiarte el rango a ti mismo';
      elseif ($tsUser->uid !== 1 && $new_rango === 1) return 'Solo el primer Administrador puede crear más administradores principales';
      else {
         if (db_exec([__FILE__, __LINE__], 'query', 'UPDATE u_miembros SET user_rango = '.$new_rango.' WHERE user_id = ' . intval($user_id))) return true;
      }
   }
   /**
    * ------------------------------
    * SESIONES
    * getSessions() :: Obtenemos todas las sesiones
    * delSession() :: Eliminamos la sesion por "session_id"
    * ------------------------------ 
   */
   public function getSessions() {
      global $tsCore;
      # Limite
      $limit = $tsCore->setPageLimit($this->max, true);
      # Datos
      $data['data'] = result_array(db_exec([__FILE__, __LINE__], 'query', 'SELECT u.user_id, u.user_name, s.* FROM u_sessions AS s LEFT JOIN u_miembros AS u ON s.session_user_id = u.user_id ORDER BY s.session_time DESC LIMIT ' . $limit));
      # Paginamos
      list($total) = db_exec('fetch_row', db_exec([__FILE__, __LINE__], 'query', 'SELECT COUNT(*) FROM u_sessions'));
      $data['pages'] = $tsCore->pageIndex($tsCore->settings['url'] . "/admin/sesiones?", $_GET['s'], $total, $this->max);
      # Retornamos datos
      return $data;
   }
   public function delSession() {
      global $tsCore;
      # Obtenemos la session_id
      $session_id = $_POST['session_id'];
      if (db_exec('num_rows', db_exec([__FILE__, __LINE__], 'query', 'SELECT session_id FROM u_sessions WHERE session_id = \'' . $tsCore->setSecure($session_id) . '\' LIMIT 1'))) {
         if (db_exec([__FILE__, __LINE__], 'query', 'DELETE FROM u_sessions WHERE session_id = \'' . $tsCore->setSecure($session_id) . '\'')) return '1: Eliminado';
      } else return '0: No existe esa sesi&oacute;n';
   }
   /**
    * ------------------------------
    * NICKS
    * getChangeNicks() :: Obtenemos todos los nicks / Cambios realizados
    * ChangeNick_o_no() :: Aprobar/Desaprobar cambio
    * ------------------------------ 
   */
   public function getChangeNicks(string $hecho = '') {
      global $tsCore;
      # Cambio realizado
      $hecho = ($hecho === 'realizados') ? ">" : "=";
      # Limite
      $limit = $tsCore->setPageLimit($this->max, true);
      # Datos
      $data['data'] = result_array(db_exec([__FILE__, __LINE__], 'query', 'SELECT u.user_id, u.user_name, n.* FROM u_nicks AS n LEFT JOIN u_miembros AS u ON n.user_id = u.user_id WHERE estado '.$hecho.' 0 ORDER BY n.time DESC LIMIT ' . $limit));
      # Paginacion
      list($total) = db_exec('fetch_row', db_exec([__FILE__, __LINE__], 'query', 'SELECT COUNT(*) FROM u_nicks WHERE estado '.$hecho.' 0'));
      $data['pages'] = $tsCore->pageIndex($tsCore->settings['url'] . "/admin/nicks?", $_GET['s'], $total, $this->max);
      # Retornamos datos
      return $data;
   }
   public function ChangeNick_o_no() {
      global $tsCore, $tsMonitor;
      # ID del nick
      $nick_id = intval($_POST['nid']);
      # Datos
      $datos = db_exec('fetch_assoc', db_exec([__FILE__, __LINE__], 'query', 'SELECT * FROM u_nicks WHERE id = '.$nick_id.' LIMIT 1'));
      # Aprobamos
      if ($_POST['accion'] === 'aprobar') {
         db_exec([__FILE__, __LINE__], 'query', 'UPDATE u_miembros SET user_name = \'' . $datos['name_2'] . '\', user_password = \'' . $datos['hash'] . '\', user_name_changes = user_name_changes - 1 WHERE user_id = \'' . $datos['user_id'] . '\'');
         db_exec([__FILE__, __LINE__], 'query', 'UPDATE u_nicks SET estado = 1 WHERE id = ' . $nick_id);
         # Enviamos un aviso
         $aviso = 'Hola <b>' . $datos['name_1'] . "</b>,\n\n Le informo que desde este momento su nombre de acceso ser&aacute; <b>" . $datos['name_2'] . "</b> . Hasta pronto.";
         $tsMonitor->setAviso($datos['user_id'], 'Cambio realizado', $aviso, 4);
         //ENVIAMOS CORREO
         $subject = $datos['name_1'] . ', su petici&oacute;n de cambio ha sido aceptada';
         $body = 'Hola ' . $datos['name_1'] . ':<br />Le enviamos este email para informarle que su petici&oacute;n de cambio de nick ha sido aceptada.<br>Desde este momento, podr&aacute; acceder en ' . $tsCore->settings['titulo'] .' con el nombre de usuario ' . $datos['name_2'] . '. <br /><hr>El staff de <strong>' . $tsCore->settings['titulo'] . '</strong>';
      # Denegamos
      } elseif ($_POST['accion'] == 'denegar') {
         db_exec([__FILE__, __LINE__], 'query', 'UPDATE u_miembros SET user_name_changes = user_name_changes - 1 WHERE user_id = \'' .
                $datos['user_id'] . '\'');
         db_exec([__FILE__, __LINE__], 'query', 'UPDATE u_nicks SET estado = 2 WHERE id = ' . $nick_id);
         # Enviamos un aviso
         $aviso = 'Hola <b>' . $datos['name_1'] . "</b>,\n\n Lamento informarle que su petici&oacute;n de cambio de nick a <b>" . $datos['name_2'] . "</b> , ha sido denegada.";
         $tsMonitor->setAviso($datos['user_id'], 'Cambio realizado', $aviso, 3);
         //ENVIAMOS CORREO
         $subject = $datos['name_1'] . ', su petici&oacute;n de cambio ha sido denegada';
         $body = 'Hola ' . $datos['name_1'] . ':<br />Le enviamos este email para informarle que su petici&oacute;n de cambio de nick ha sido denegada. <br /><hr>El staff de <strong>' . $tsCore->settings['titulo'] . '</strong>';
      } else return '0: Mijo, ve de paseo';

      // <--
      include TS_CLASS . 'c.emails.php';
      $tsEmail = new tsEmail('confirmar', 'nombre');
      $tsEmail->emailTo = $datos['user_email'];
      $tsEmail->emailSubject = $subject;
      $tsEmail->emailBody = $body;
      $tsEmail->emailHeaders = $tsEmail->setEmailHeaders();
      $tsEmail->sendEmail($from, $to, $subject, $body) or die('0: Hubo un error al enviar el correo.');
      die('1: <div class="box_cuerpo" style="padding: 12px 20px; border-top:1px solid #CCC">Hemos enviado un correo a <b>' . $datos['user_email'] . '</b> con la decisi&oacute;n tomada. Tambi&eacute;n le hemos enviado un aviso al usuario.</div>');
      // -->
   }


    /****************** ADMINISTRACIÓN DE POSTS ******************/

    function GetAdminPosts()
    {
        global $tsCore;
        //
        $max = 18; // MAXIMO A MOSTRAR
        $limit = $tsCore->setPageLimit($max, true);

        if ($_GET['o'] == 'e')
        {
            $order = 'p.post_status';
        } elseif ($_GET['o'] == 'ip')
        {
            $order = 'p.post_ip';
        } else
        {
            $order = 'p.post_id';
        }

        //
        $query = db_exec([__FILE__, __LINE__], 'query', 'SELECT u.user_id, u.user_name, c.c_nombre, c.c_seo, c.c_img, p.* FROM p_posts AS p LEFT JOIN u_miembros AS u ON p.post_user = u.user_id LEFT JOIN p_categorias AS c ON c.cid = p.post_category WHERE p.post_id > \'0\' ORDER BY ' .
            $order . ' ' . ($_GET['m'] == 'a' ? 'ASC' : 'DESC') . ' LIMIT ' . $limit);
        //
        $data['data'] = result_array($query);

        // PAGINAS
        $query = db_exec([__FILE__, __LINE__], 'query', 'SELECT COUNT(*) FROM p_posts WHERE post_id > \'0\'');
        list($total) = db_exec('fetch_row', $query);

        $data['pages'] = $tsCore->pageIndex($tsCore->settings['url'] . "/admin/posts?o=" .
            $_GET['o'] . "&m=" . $_GET['m'] . "", $_GET['s'], $total, $max);
        //
        return $data;
    }


    /****************** ADMINISTRACIÓN DE FOTOS ******************/
    function GetAdminFotos()
    {
        global $tsCore;
        //
        $max = 15; // MAXIMO A MOSTRAR
        $limit = $tsCore->setPageLimit($max, true);
        //
        $query = db_exec([__FILE__, __LINE__], 'query', 'SELECT u.user_id, u.user_name, f.* FROM f_fotos AS f LEFT JOIN u_miembros AS u ON f.f_user = u.user_id WHERE f.foto_id > \'0\' ORDER BY f.foto_id DESC LIMIT ' .
            $limit);
        //
        $data['data'] = result_array($query);

        // PAGINAS
        $query = db_exec([__FILE__, __LINE__], 'query', 'SELECT COUNT(*) FROM f_fotos WHERE foto_id > \'0\'');
        list($total) = db_exec('fetch_row', $query);

        $data['pages'] = $tsCore->pageIndex($tsCore->settings['url'] . "/admin/fotos?",
            $_GET['s'], $total, $max);
        //
        return $data;
    }

    function DelFoto()
    {
        //
        $foto = intval($_POST['foto_id']);
        if (db_exec('num_rows', db_exec([__FILE__, __LINE__], 'query', 'SELECT foto_id FROM `f_fotos` WHERE foto_id = \'' .
            (int)$foto . '\'')))
        {
            if (db_exec([__FILE__, __LINE__], 'query', 'DELETE FROM f_fotos WHERE foto_id = \'' . (int)$foto . '\''))
            {
                return '1: Foto eliminada';
            } else
                return '0: La foto no se pudo eliminar';
        } else
            return '0: La foto no existe';

    }

    function setOpenClosedFoto()
    {
        global $tsUser;

        $query = db_exec([__FILE__, __LINE__], 'query', 'SELECT f_closed FROM f_fotos WHERE foto_id = \'' . (int)$_POST['fid'] .
            '\'');
        $data = db_exec('fetch_assoc', $query);

        // COMPROBAMOS
        if ($data['f_closed'] == 1)
        {
            if (db_exec([__FILE__, __LINE__], 'query', 'UPDATE f_fotos SET f_closed = \'0\' WHERE foto_id = \'' . (int)
                $_POST['fid'] . '\''))
            {
                return '2: Comentarios abiertos';
            } else
                return '0: Ocurri&oacute, un error';
        } elseif ($data['f_closed'] == 0)
        {
            if (db_exec([__FILE__, __LINE__], 'query', 'UPDATE f_fotos SET f_closed = \'1\' WHERE foto_id = \'' . (int)
                $_POST['fid'] . '\''))
            {
                return '1: Comentarios cerrados.';
            } else
                return 'Ocurri&oacute; un error';
        }
    }


    function setShowHideFoto()
    {
        global $tsUser;

        $query = db_exec([__FILE__, __LINE__], 'query', 'SELECT f_status FROM f_fotos WHERE foto_id = \'' . (int)$_POST['fid'] .
            '\'');
        $data = db_exec('fetch_assoc', $query);


        // COMPROBAMOS
        if ($data['f_status'] == 1)
        {
            if (db_exec([__FILE__, __LINE__], 'query', 'UPDATE f_fotos SET f_status = \'0\' WHERE foto_id = \'' . (int)
                $_POST['fid'] . '\''))
            {
                return '2: Foto rehabilitada';
            } else
                return '0: Ocurri&oacute, un error';
        } elseif ($data['f_status'] == 0)
        {
            if (db_exec([__FILE__, __LINE__], 'query', 'UPDATE f_fotos SET f_status = \'1\' WHERE foto_id = \'' . (int)
                $_POST['fid'] . '\''))
            {
                return '1: Foto deshabilitada.';
            } else
                return 'Ocurri&oacute; un error';
        }
    }


    /****************** ADMINISTRACIÓN DE NOTICIAS ******************/

    function setNoticiaInActive()
    {
        global $tsUser;

        $noticia = $_POST['nid'];

        $query = db_exec([__FILE__, __LINE__], 'query', 'SELECT not_active FROM w_noticias WHERE not_id = \'' . (int)
            $noticia . '\'');
        $data = db_exec('fetch_assoc', $query);


        // COMPROBAMOS
        if ($data['not_active'] == 1)
        {
            if (db_exec([__FILE__, __LINE__], 'query', 'UPDATE w_noticias SET not_active = \'0\' WHERE not_id = \'' . (int)
                $noticia . '\''))
            {
                return '2: Noticia desactivada';
            } else
                return '0: Ocurri&oacute, un error';
        } else
        {
            if (db_exec([__FILE__, __LINE__], 'query', 'UPDATE w_noticias SET not_active = \'1\' WHERE not_id = \'' . (int)
                $noticia . '\''))
            {
                return '1: Noticia activada.';
            } else
                return 'Ocurri&oacute; un error';
        }
    }

    /****************** ADMINISTRACIÓN DE LISTA NEGRA ******************/

    function getBlackList()
    {
        global $tsCore;
        //
        $max = 20; // MAXIMO A MOSTRAR
        $limit = $tsCore->setPageLimit($max, true);
        //
        $query = db_exec([__FILE__, __LINE__], 'query', 'SELECT u.user_id, u.user_name, b.* FROM w_blacklist AS b LEFT JOIN u_miembros AS u ON b.author = u.user_id ORDER BY b.date DESC LIMIT ' .
            $limit);
        //
        $data['data'] = result_array($query);

        // PAGINAS
        $query = db_exec([__FILE__, __LINE__], 'query', 'SELECT COUNT(*) FROM w_blacklist');
        list($total) = db_exec('fetch_row', $query);

        $data['pages'] = $tsCore->pageIndex($tsCore->settings['url'] .
            "/admin/blacklist?", $_GET['s'], $total, $max);
        //
        return $data;
    }

    function getBlock()
    {
        return db_exec('fetch_assoc', db_exec([__FILE__, __LINE__], 'query', 'SELECT type, value, reason FROM w_blacklist WHERE id = \'' .
            (int)$_GET['id'] . '\' LIMIT 1'));
    }

    function saveBlock()
    {
        global $tsCore, $tsUser;

        if (empty($_POST['value']) || empty($_POST['type']))
        {
            return 'Debe rellenar todos los campos';
        } else
        {
            if ($_POST['type'] == 1 && $_POST['value'] == $_SERVER['REMOTE_ADDR'])
                return 'No puedes bloquear tu propia IP';
            if (!db_exec('num_rows', db_exec([__FILE__, __LINE__], 'query', 'SELECT id FROM w_blacklist WHERE type = \'' . (int)
                $_POST['type'] . '\' && value = \'' . $tsCore->setSecure($_POST['value']) . '\'')))
            {
                if (db_exec([__FILE__, __LINE__], 'query', 'UPDATE w_blacklist SET type = \'' . (int)$_POST['type'] . '\', value = \'' .
                    $tsCore->setSecure($_POST['value']) . '\', author = \'' . $tsUser->uid . '\' WHERE id = \'' .
                    (int)$_GET['id'] . '\''))
                    return true;
            } else
                return 'Ya existe un bloqueo as&iacute;';
        }
    }

    function newBlock()
    {
        global $tsCore, $tsUser;

        if (empty($_POST['value']) || empty($_POST['type']) || empty($_POST['reason']))
        {
            return 'Rellene todos los campos';
        } else
        {
            if ($_POST['type'] == 1 && $_POST['value'] == $_SERVER['REMOTE_ADDR'])
                return 'No puedes bloquear tu propia IP';
            if (!db_exec('num_rows', db_exec([__FILE__, __LINE__], 'query', 'SELECT id FROM w_blacklist WHERE type = \'' . (int)
                $_POST['type'] . '\' && value = \'' . $tsCore->setSecure($_POST['value']) . '\'')))
            {
                if (db_exec([__FILE__, __LINE__], 'query', 'INSERT INTO w_blacklist (type, value, reason, author, date) VALUES (\'' .
                    (int)$_POST['type'] . '\', \'' . $tsCore->setSecure($_POST['value']) . '\', \'' .
                    $tsCore->setSecure($_POST['reason']) . '\', \'' . $tsUser->uid . '\', \'' . time
                    () . '\')'))
                    return true;
            } else
                return 'Ya existe un bloqueo as&iacute;';
        }
    }

    function deleteBlock()
    {

        if (db_exec([__FILE__, __LINE__], 'query', 'DELETE FROM w_blacklist WHERE id = \'' . (int)$_POST['bid'] . '\''))
            return '1: Bloqueo retirado';
        else
            return '0: Hubo un error al borrar';

    }

    /****************** ADMINISTRACIÓN DE LISTA NEGRA ******************/

    function getBadWords()
    {
        global $tsCore;
        //
        $max = 20; // MAXIMO A MOSTRAR
        $limit = $tsCore->setPageLimit($max, true);
        //
        $query = db_exec([__FILE__, __LINE__], 'query', 'SELECT u.user_id, u.user_name, bw.* FROM w_badwords AS bw LEFT JOIN u_miembros AS u ON bw.author = u.user_id ORDER BY bw.wid DESC LIMIT ' .
            $limit);
        //
        $data['data'] = result_array($query);

        // PAGINAS
        $query = db_exec([__FILE__, __LINE__], 'query', 'SELECT COUNT(*) FROM w_badwords');
        list($total) = db_exec('fetch_row', $query);

        $data['pages'] = $tsCore->pageIndex($tsCore->settings['url'] .
            "/admin/badwords?", $_GET['s'], $total, $max);
        //
        return $data;
    }

    function getBadWord()
    {
        return db_exec('fetch_assoc', db_exec([__FILE__, __LINE__], 'query', 'SELECT * FROM w_badwords WHERE wid = \'' .
            (int)$_GET['id'] . '\' LIMIT 1'));
    }

    function saveBadWord()
    {
        global $tsCore, $tsUser;

        $method = empty($_POST['method']) ? 0 : 1;
        $type = empty($_POST['type']) ? 0 : 1;
        if (empty($_POST['before']) || empty($_POST['after']))
        {
            return 'Rellene todos los campos';
        } else
        {
            if (!db_exec('num_rows', db_exec([__FILE__, __LINE__], 'query', 'SELECT wid FROM w_badwords WHERE LOWER(word) = \'' .
                $tsCore->setSecure(strtolower($_POST['before'])) . '\' && LOWER(swop) = \'' . $tsCore->
                setSecure(strtolower($_POST['after'])) . '\'')))
            {
                if (db_exec([__FILE__, __LINE__], 'query', 'UPDATE `w_badwords` SET method = \'' . $method . '\', type = \'' .
                    (int)$type . '\', word = \'' . $tsCore->setSecure($_POST['before']) . '\', swop = \'' .
                    $tsCore->setSecure($_POST['after']) . '\', author = \'' . $tsUser->uid . '\' WHERE wid = \'' .
                    (int)$_GET['id'] . '\''))
                    return true;
                else
                    return 'Error al guardar';
            } else
                return 'Ya existe un filtro as&iacute;';
        }
    }

    function newBadWord()
    {
        global $tsCore, $tsUser;

        $method = empty($_POST['method']) ? 0 : 1;
        $type = empty($_POST['type']) ? 0 : 1;
        if (empty($_POST['before']) || empty($_POST['after']) || empty($_POST['reason']))
        {
            return 'Rellene todos los campos';
        } else
        {
            if (!db_exec('num_rows', db_exec([__FILE__, __LINE__], 'query', 'SELECT wid FROM w_badwords WHERE LOWER(word) = \'' .
                $tsCore->setSecure(strtolower($_POST['before'])) . '\' && LOWER(swop) = \'' . $tsCore->
                setSecure(strtolower($_POST['after'])) . '\'')))
            {
                if (db_exec([__FILE__, __LINE__], 'query', 'INSERT INTO w_badwords (word, swop, method, type, author, reason, date) VALUES (\'' .
                    $tsCore->setSecure($_POST['before']) . '\', \'' . $tsCore->setSecure($_POST['after']) .
                    '\', \'' . (int)$method . '\', \'' . (int)$type . '\', \'' . $tsUser->uid . '\', \'' .
                    $tsCore->setSecure($_POST['reason']) . '\', \'' . time() . '\')'))
                    return true;
                else
                    return 'Error al agregar';
            } else
                return 'Ya existe un filtro as&iacute;';
        }
    }

    function deleteBadWord()
    {

        if (db_exec([__FILE__, __LINE__], 'query', 'DELETE FROM w_badwords WHERE wid = \'' . (int)$_POST['wid'] . '\''))
            return '1: Filtro retirado';
        else
            return '0: Hubo un error al borrar';

    }

    /****************** ADMINISTRACIÓN DE ESTADÍSTICAS ******************/

    function GetAdminStats()
    {
        $num = db_exec('fetch_assoc', db_exec([__FILE__, __LINE__], 'query', 'SELECT 
        (SELECT count(foto_id) FROM f_fotos WHERE f_status = \'2\') as fotos_eliminadas, 
        (SELECT count(foto_id) FROM f_fotos WHERE f_status = \'1\') as fotos_ocultas, 
        (SELECT count(foto_id) FROM f_fotos WHERE f_status = \'0\') as fotos_visibles, 
        (SELECT count(post_id) FROM p_posts WHERE post_status = \'0\') as posts_visibles, 
        (SELECT count(post_id) FROM p_posts WHERE post_status = \'1\') as posts_ocultos, 
        (SELECT count(post_id) FROM p_posts  WHERE post_status = \'2\') as posts_eliminados, 
        (SELECT count(post_id) FROM p_posts  WHERE post_status = \'3\') as posts_revision, 
        (SELECT count(cid) FROM p_comentarios WHERE c_status = \'0\') as comentarios_posts_visibles, 
        (SELECT count(cid) FROM p_comentarios WHERE c_status = \'1\') as comentarios_posts_ocultos, 
        (SELECT count(user_id) FROM u_miembros WHERE user_activo = \'1\') as usuarios_activos, 
        (SELECT count(user_id) FROM u_miembros WHERE user_activo = \'0\' ) as usuarios_inactivos, 
        (SELECT count(user_id) FROM u_miembros WHERE user_baneado = \'1\' ) as usuarios_baneados, 
        (SELECT count(cid) FROM f_comentarios) as comentarios_fotos_total, 
        (SELECT count(follow_id) FROM u_follows WHERE f_type  = \'1\' ) AS usuarios_follows,
        (SELECT count(follow_id) FROM u_follows WHERE f_type  = \'2\' ) AS posts_follows,
        (SELECT count(follow_id) FROM u_follows WHERE f_type  = \'3\' ) AS posts_compartidos,
        (SELECT count(fav_id) FROM p_favoritos) AS posts_favoritos,  
        (SELECT count(mr_id) FROM u_respuestas) AS usuarios_respuestas,
        (SELECT count(mp_id) FROM u_mensajes) AS mensajes_total, 
        (SELECT count(mp_id) FROM u_mensajes WHERE mp_del_to = \'1\') AS mensajes_de_eliminados,
        (SELECT count(mp_id) FROM u_mensajes WHERE mp_del_from = \'1\') AS mensajes_para_eliminados,
        (SELECT count(bid) FROM p_borradores) AS posts_borradores,
        (SELECT count(bid) FROM u_bloqueos) AS usuarios_bloqueados, 
        (SELECT count(bid) FROM u_bloqueos) AS usuarios_bloqueados,
        (SELECT count(medal_id) FROM w_medallas WHERE m_type = \'1\') AS medallas_usuarios,
        (SELECT count(medal_id) FROM w_medallas WHERE m_type = \'2\') AS medallas_posts,
        (SELECT count(medal_id) FROM w_medallas WHERE m_type = \'3\') AS medallas_fotos,
        (SELECT count(id) FROM w_medallas_assign) AS medallas_asignadas, 
        (SELECT count(aid) FROM w_afiliados WHERE a_active = \'1\') AS afiliados_activos, 
        (SELECT count(aid) FROM w_afiliados WHERE a_active = \'0\') AS afiliados_inactivos,
        (SELECT count(pub_id) FROM u_muro) AS muro_estados, 
        (SELECT count(cid) FROM u_muro_comentarios) AS muro_comentarios
        '));

        $num['usuarios_total'] = $num['usuarios_activos'] + $num['usuarios_inactivos'] +
            $num['usuarios_baneados'];
        $num['seguidos_total'] = $num['posts_follows'] + $num['usuarios_follows'];
        $num['muro_total'] = $num['muro_estados'] + $num['muro_comentarios'];
        $num['afiliados_total'] = $num['afiliados_activos'] + $num['afiliados_inactivos'];
        $num['posts_total'] = $num['posts_visibles'] + $num['posts_ocultos'] + $num['posts_eliminados'];
        $num['comentarios_posts_total'] = $num['comentarios_posts_visibles'] + $num['comentarios_posts_ocultos'];
        $num['medallas_total'] = $num['medallas_usuarios'] + $num['medallas_posts'] + $num['medallas_fotos'];
        $num['fotos_total'] = $num['fotos_visibles'] + $num['fotos_ocultas'] + $num['fotos_eliminadas'];

        return $num;
    }

    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

}