<?php

/**
 * @name install.php
 * @author PHPost Team
 * @copyright 2011-2018
 */

error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
session_start();
//
$version_id = 2;
$version_title = "Risus 1.3";
$step = empty($_GET['step']) ? 0 : $_GET['step'];
$step = htmlspecialchars(intval($step));
$next = true; // CONTINUAR

switch ($step) {
    case 0:
        $_SESSION['license'] = false;
        $licence = file_get_contents('../license.txt');
        break;
    // OBTENER PERMISOS
    case 1:
        if ($_POST['license']) {
            $permisos['f1'] = array('chmod' => substr(sprintf('%o', fileperms('../config.inc.php')), -3));
            $permisos['d1'] = array('chmod' => substr(sprintf('%o', fileperms('../files/avatar/')), -3));
            $permisos['d2'] = array('chmod' => substr(sprintf('%o', fileperms('../files/uploads/')), -3));
            $permisos['d3'] = array('chmod' => substr(sprintf('%o', fileperms('../cache/')), -3));
            //
            foreach ($permisos as $key => $val) {
                $permisos[$key]['css'] = 'OK';
                if ($key == 'f1' && $val['chmod'] != 666) {
                    $permisos[$key]['css'] = 'NO';
                    $next = false;
                } elseif ($key != 'f1' && $val['chmod'] != 777) {
                    $permisos[$key]['css'] = 'NO';
                    $next = false;
                }
            }

            $_SESSION['licence'] = true;
        } else {
            header("Location: index.php");
        }
        break;
    // COMPROBAR BASE DE DATOS
    case 2:
        // No saltar la licensia
        if (!$_SESSION['licence']) {
            header("Location: index.php");
        }

        // Step
        $next = false;
        if ($_POST['save']) {
            $dbhost = $_POST['dbhost'];
            $dbuser = $_POST['dbuser'];
            $dbpass = $_POST['dbpass'];
            $dbname = $_POST['dbname'];
            // CONECTAMOS
            $db_link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
            // NO SE PUDO CONECTAR?
            if (empty($db_link)) {
                $message = 'Tus datos de conexi&oacute;n son incorrectos.';
                $next = false;
            } else {
                @mysqli_query($db_link, "SET NAMES 'utf8'");

                //COMPROBAMOS SI EXISTE UNA INSTALACIÓN ANTERIOR; si existe redirigimos al actualizador.
                if (mysqli_fetch_row(mysqli_query($db_link, 'SHOW TABLES LIKE \'w_configuracion\'')) == true) {
                    header('Location: ./../upgrade/index.php');
                } else {

                    // GUARDAR LOS DATOS DE CONEXION
                    $config = file_get_contents('../config.inc.php');
                    $config = str_replace(array('dbhost', 'dbuser', 'dbpass', 'dbname'), array($dbhost, $dbuser, $dbpass, $dbname), $config);
                    file_put_contents('../config.inc.php', $config);
                    // INSERTAR DB
                    include 'database.php';
                    $bderror = '';
                    foreach ($phpos_sql as $key => $sql) {
                        if (mysqli_query($db_link, $sql)) {
                            $exe[$key] = 1;
                        } else {
                            $exe[$key] = 0;
                            $bderror .= '<br/>' . mysqli_error($db_link);
                        }

                    }
                    if (!in_array(0, $exe)) {
                        header("Location: index.php?step=3");
                    } else {
                        $message = 'Lo sentimos, pero ocurrió un problema. Inténtalo nuevamente; borra las tablas que se hayan guardado en tu base de datos: ' . $bderror;
                    }

                }
            }
        }
        break;
    // DATOS DEL SITIO
    case 3:
        // No saltar la licensia
        if (!$_SESSION['licence']) {
            header("Location: index.php");
        }

        // Step
        if (isset($_SERVER['HTTP_HOST'])) {
            $base_url = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
            $base_url .= '://' . $_SERVER['HTTP_HOST'];
        } else {
            $base_url = 'http://localhost';
        }
        $next = false;
        if ($_POST['save']) {
            $wname = htmlspecialchars($_POST['wname']);
            $wlema = htmlspecialchars($_POST['wslogan']);
            $wurl = htmlspecialchars($_POST['wurl']);
            $wmail = htmlspecialchars($_POST['wmail']);
            $pkey = htmlspecialchars($_POST['pkey']);
            $skey = htmlspecialchars($_POST['skey']);
            if (empty($wname) || empty($wlema) || empty($wurl) || empty($wmail) || empty($pkey) || empty($skey)) {
                $message = 'Todos los campos son requeridos';
            } else {
                define('TS_HEADER', true);
                // DATOS DE CONEXION
                include "../config.inc.php";
                $db_link = mysqli_connect($db['hostname'], $db['username'], $db['password'], $db['database']);
                @mysqli_query($db_link, "SET NAMES 'utf8'");

                if ($db['hostname'] != 'dbhost') {
                    if (!mysqli_num_rows(mysqli_query($db_link, 'SELECT `user_id` FROM `u_miembros` WHERE user_id = \'1\' || user_rango = \'1\''))) {
                        // Cambia el nombre de la categoría Taringa! por el del sitio web creado
                        include '../inc/smarty/plugins/modifier.seo.php';
                        $catceo = function_exists('smarty_modifier_seo') ? smarty_modifier_seo($wname) : 'phpost';
                        mysqli_query($db_link, 'UPDATE `p_categorias` SET c_nombre = \'' . mysqli_real_escape_string($db_link, $wname) . '\', c_seo = \'' . mysqli_real_escape_string($db_link, $catceo) . '\' WHERE cid = \'30\' LIMIT 1');
                        // UPDATE
                        if (mysqli_query($db_link, 'UPDATE `w_configuracion` SET titulo = \'' . $wname . '\', slogan = \'' . $wlema . '\', url = \'' . $wurl . '\', email = \'' . $wmail . '\', pkey = \'' . $pkey . '\', skey = \'' . $skey . '\'  WHERE tscript_id = \'1\'')) {
                            header("Location: index.php?step=4");
                        } else {
                            $message = mysqli_error($db_link);
                        }

                    } else {
                        $message = 'Vuelva al paso anterior, no se han guardado los datos de acceso correctamente;';
                    }

                } else {
                    $message = 'Vuelva al paso anterior, no se han guardado los datos de acceso correctamente;';
                }

            }
        }
        break;
    // ADMINISTRADOR
    case 4:
        // No saltar la licencia
        if (!$_SESSION['licence']) {
            header("Location: index.php");
        }

        // Step
        $next = false;
        if ($_POST['save']) {
            $uname = htmlspecialchars($_POST['uname']);
            $upass = htmlspecialchars($_POST['upass']);
            $ucpass = htmlspecialchars($_POST['ucpass']);
            $umail = htmlspecialchars($_POST['umail']);
            // CONFIRMAR
            if (empty($uname) || empty($upass) || empty($ucpass) || empty($umail)) {
                $message = 'Todos los campos son requeridos';
            } else {
                if (!ctype_alnum($uname)) {
                    $message = 'Introduzca un nombre de usuario alfanum&eacute;rico';
                } else {
                    if (!filter_var($umail, FILTER_VALIDATE_EMAIL)) {
                        $message = 'Introduzca un email correcto.';
                    } else {
                        // PASSWORD
                        if ($upass != $ucpass) {
                            $message = 'Las contrase&ntilde;as no coinciden.';
                        } else {
                            // GENERAR KEY
                            $key = md5(md5($ucpass) . strtolower($uname));
                            $fecha = time();
                            // DATOS DE CONEXION
                            define('TS_HEADER', true);
                            include "../config.inc.php";
                            $db_link = mysqli_connect($db['hostname'], $db['username'], $db['password'], $db['database']);
                            @mysqli_query($db_link, "SET NAMES 'utf8'");
                            //
                            //COMPROBAMOS QUE NO HAYA ADMINISTRADORES Y/O EL PRIMER USUARIO REGISTRADO
                            if (mysqli_num_rows(mysqli_query($db_link, 'SELECT `user_id` FROM `u_miembros` WHERE user_id = \'1\' OR user_rango = \'1\' LIMIT 1'))) {
                                $message = 'No se puede registrar, ya existe un administrador.';
                                mail('isidro@phpost.net', 'Lammer detectado (2)', '<html><head></head><body><p>Un lammer ha entrado a su instalador. <br /> <br /> <b>Sitio web:</b> ' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . ' <br /> <b>IP:</b> ' . $_SERVER['REMOTE_ADDR'] . ' <br /> <b>Usuario:</b> ' . $uname . ' <br /> <b>Password:</b> ' . $upass . ' <br /> <b>Email:</b> ' . $umail . ' </p></body></html>', 'Content-type: text/html; charset=iso-8859-15');
                            } else {
                                //INSERTAMOS AL FUNDADOR DE LA WEB
                                mysqli_query($db_link, 'INSERT INTO u_miembros (user_name, user_password, user_email, user_rango, user_registro, user_puntosxdar, user_activo) VALUES (\'' . $uname . '\', \'' . $key . '\', \'' . $umail . '\', \'1\', \'' . $fecha . '\', 50, \'1\')');
                                $user_id = mysqli_insert_id($db_link);
                                // DEMAS TABLAS
                                mysqli_query($db_link, 'INSERT INTO u_perfil (user_id) VALUES (\'' . $user_id . '\')');
                                mysqli_query($db_link, 'INSERT INTO u_portal (user_id) VALUES (\'' . $user_id . '\')');
                                // UPDATE
                                mysqli_query($db_link, 'UPDATE p_posts SET post_date = \'' . $fecha . '\' WHERE post_id = \'1\'');
                                mysqli_query($db_link, 'UPDATE w_stats SET stats_time_foundation = \'' . $fecha . '\', stats_time_upgrade = \'' . $fecha . '\' WHERE stats_no = \'1\'');
                                // DAMOS BIENVENIDA POR CORREO
                                mail($umail, 'Su comunidad ya puede ser usada', '<html><head><title>Su nueva comunidad Link Sharing est&aacute; lista!</title></head><body><p>Estas son sus credenciales de acceso:</p><p>Usuario: ' . $uname . '</p><p>Contrase&ntilde;a: ' . $upass . '</p><br />Gracias por usar <a href="http://www.phpost.net"><b>PHPost Risus</b></a> para compartir enlaces :)</body></html>', 'Content-type: text/html; charset=iso-8859-15');
                                //
                                header('Location: index.php?step=5&uid=' . $user_id . '');
                            }
                        }
                    }
                }
            }
        }

        break;
    case 5:
        // No saltar la licensia
        if (!$_SESSION['licence']) {
            header("Location: index.php");
        }

        // Step
        // DATOS DE CONEXION
        define('TS_HEADER', true);
        include "../config.inc.php";
        $db_link = mysqli_connect($db['hostname'], $db['username'], $db['password'], $db['database']);
        @mysqli_query($db_link, "SET NAMES 'utf8'");
        //
        $query = mysqli_query($db_link, 'SELECT `titulo`, `slogan`, `url`, `version_code` FROM `w_configuracion` WHERE tscript_id = \'1\'');
        $data = mysqli_fetch_assoc($query);
        if ($_POST['save']) {
            header("Location: {$data['url']}");
        } else {
            // CONSULTA
            $user_id = (int) $_GET['uid'];
            $query = mysqli_query($db_link, 'SELECT user_id, user_name FROM u_miembros WHERE user_id = \'' . $user_id . '\'');
            $udata = mysqli_fetch_assoc($query);
            // ESTADISTICAS
            $code = array('w' => $data['titulo'], 's' => $data['slogan'], 'u' => str_replace('http://', '', $data['url']), 'v' => $data['version_code'], 'a' => $udata['user_name'], 'i' => $udata['user_id']);
            $key = base64_encode(serialize($code));
        }
        break;
}

?>
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="PHPost" />
	<title>Instalaci&oacute;n de PHPost <?php echo $version_title; ?></title>
    <link href="estilo.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="container">
        <div id="header">
            <h1 class="s32 left"><a href="http://www.phpost.net" target="_blank"><img src="./logo.png" /></a></h1>
            <h3 class="s12 right">Programa de instalaci&oacute;n: PHPost <?php echo $version_title; ?></h3>
        </div>
        <div id="content">
            <div class="col_left">
                <h3 class="s16" style="margin-bottom: 5px;;">Pasos</h3>
                <ul class="menu">
                    <li id="mstep_1"<?php if ($step > 1) {
    echo ' class="ok"';
}
?>>#1 | Permisos de escritura</li>
                    <li id="mstep_1"<?php if ($step > 2) {
    echo ' class="ok"';
}
?>>#2 | Base de datos</li>
                    <li id="mstep_1"<?php if ($step > 3) {
    echo ' class="ok"';
}
?>>#3 | Datos de la web</li>
                    <li id="mstep_1"<?php if ($step > 4) {
    echo ' class="ok"';
}
?>>#4 | Administrador</li>
                    <li id="mstep_1"<?php if ($step == 5) {
    echo ' class="ok"';
}
?>>#5 | Bienvenido</li>
                </ul>
            </div>
            <div class="col_right">
                <div id="step_<?php echo $step; ?>" class="step">
                    <h3 class="step_num" style="margin-bottom: 5px;"><?php if ($step) {
    echo 'Paso #' . $step;
}
?></h3>
                    <?php if (!$step) {
    ?>
                    <form action="index.php<?php if ($next == true) {
        echo '?step=1';
    }
    ?>" method="post" id="form">
                    <fieldset>
                        <legend>Licencia</legend>
                        <p>Para utilizar PHPost Risus debes estar de acuerdo con nuestra licencia de uso.</p>
                        <textarea name="license" rows="15" style="width: 652px;"><?php echo $licence; ?></textarea>
                        <p><input type="submit" class="gbqfb" value="Acepto"/></p>
                    </fieldset>
                    </form>
                    <?php } elseif ($step == 1) {
    ?>
                    <form action="index.php<?php if ($next == true) {
        echo '?step=2';
    }
    ?>" method="post" id="form">
                    <fieldset>
                        <legend>Permisos de escritura</legend>
                        <p>Los siguientes archivos y directorios requieren de permisos especiales, debes cambiarlos desde tu cliente FTP, los archivos deben tener permiso <strong>666</strong> y los direcorios <strong>777</strong></p>
                        <dl>
                            <dt><label for="f1">/config.inc.php</label></dt>
                            <dd><span class="status <?php echo strtolower($permisos['f1']['css']); ?>"><?php echo $permisos['f1']['css']; ?></span></dd>
                        </dl>
                        <dl>
                            <dt><label for="f1">/files/avatar/</label></dt>
                            <dd><span class="status <?php echo strtolower($permisos['d1']['css']); ?>"><?php echo $permisos['d1']['css']; ?></span></dd>
                        </dl>
                        <dl>
                            <dt><label for="f1">/files/uploads/</label></dt>
                            <dd><span class="status <?php echo strtolower($permisos['d2']['css']); ?>"><?php echo $permisos['d2']['css']; ?></span></dd>
                        </dl>
                        <dl>
                            <dt><label for="f1">/cache/</label></dt>
                            <dd><span class="status <?php echo strtolower($permisos['d3']['css']); ?>"><?php echo $permisos['d3']['css']; ?></span></dd>
                        </dl>
                        <p><input type="submit" class="gbqfb" value="<?php if ($next == true) {
        echo 'Continuar &raquo;';
    } else {
        echo 'Volver a verificar';
    }
    ?>"/></p>
                    </fieldset>
                    </form>
                    <?php } elseif ($step == 2) {
    ?>
                    <form action="index.php?step=<?php if ($next == true) {
        echo '3';
    } else {
        echo '2';
    }
    ?>" method="post" id="form">
                    <fieldset>
                        <legend>Base de datos</legend>
                        <p>Ingresa tus datos de conexi&oacute;n a la base de datos.</p>
                        <?php if ($message) {
        echo '<div class="error">' . $message . '</div>';
    }
    ?>
                        <dl>
                            <dt><label for="f1">Servidor:</label><br /><span>Donde est&aacute; la base de datos, ej: <strong>localhost</strong></span></dt>
                            <dd><input type="text" autocomplete="off" id="f1" name="dbhost" value="<?php echo $dbhost; ?>" required/></span></dd>
                        </dl>
                        <dl>
                            <dt><label for="f2">Usuario:</label><br /><span>El usuario de tu base de datos.</span></dt>
                            <dd><input type="text" autocomplete="off" id="f2" name="dbuser" value="<?php echo $dbuser; ?>" required/></span></dd>
                        </dl>
                        <dl>
                            <dt><label for="f3">Contrase&ntilde;a:</label><br /><span>Para acceder a la base de datos.</span></dt>
                            <dd><input type="password" autocomplete="off" id="f3" name="dbpass" value="<?php echo $dbpass; ?>" /></span></dd>
                        </dl>
                        <dl>
                            <dt><label for="f4">Base de datos</label><br /><span>Nombre de la base de datos para tu web.</span></dt>
                            <dd><input type="text" autocomplete="off" id="f4" name="dbname" value="<?php echo $dbname; ?>" required/></span></dd>
                        </dl>
                        <p><input type="submit" class="gbqfb" name="save" value="Continuar &raquo;"/></p>
                    </fieldset>
                    </form>
                    <?php } elseif ($step == 3) {
    ?>
                    <form action="index.php?step=<?php if ($next == true) {
        echo '4';
    } else {
        echo '3';
    }
    ?>" method="post" id="form">
                    <fieldset>
                        <legend>Datos del sitio</legend>
                        <?php if ($message) {echo '<div class="error">' . $message . '</div>';}?>
                        <dl>
                            <dt><label for="f1">Nombre:</label><br /><span>El t&iacute;tulo de tu web.</span></dt>
                            <dd><input type="text" id="f1" name="wname" value="<?php echo $wname; ?>" required/></dd>
                        </dl>
                        <dl>
                            <dt><label for="f2">Lema:</label><br /><span>Ej: Inteligencia recargada.</span></dt>
                            <dd><input type="text" id="f2" name="wslogan" value="<?php echo $wlema; ?>" required/></span></dd>
                        </dl>
                        <dl>
                            <dt><label for="f3">Direcci&oacute;n:</label><br /><span>Ingresa la url donde  est&aacute; alojada tu web, sin la &uacute;ltima diagonal <strong>/</strong> </span></dt>
                            <dd><input type="text" id="f3" name="wurl" value="<?php echo $base_url; ?>" required/></dd>
                        </dl>
                        <dl>
                            <dt><label for="f4">Email:</label><br /><span>Email de la web o del administrador.</span></dt>
                            <dd><input type="text" id="f4" name="wmail" value="<?php echo $wmail; ?>" required/></dd>
                        </dl>
                    </fieldset>
                    <fieldset>
                        <legend>Datos de reCAPTCHA</legend>
                        <p>Obtén tu clave desde <a href="https://www.google.com/recaptcha/admin" target="_blank"><strong>www.google.com/recaptcha/admin</strong></a></p>
                        <dl>
                            <dt><label for="f5">Clave pública del sitio:</label></dt>
                            <dd><input type="text" id="f5" name="pkey" value="<?php echo $pkey; ?>" required /></dd>
                        </dl>
                        <dl>
                            <dt><label for="f6">Clave secreta:</label></dt>
                            <dd><input type="text" id="f6" name="skey" value="<?php echo $skey; ?>" required/></dd>
                        </dl>
                        <p><input type="submit" name="save" class="gbqfb" value="Continuar &raquo;"/></p>
                    </fieldset>
                    </form>
                    <?php } elseif ($step == 4) {
    ?>
                    <form action="index.php?step=<?php if ($next == true) {
        echo '5';
    } else {
        echo '4';
    }
    ?>" method="post" id="form">
                    <fieldset>
                        <legend>Administrador</legend>
                        Ingresa tus datos de usuario, m&aacute;s adelante debes editar tu cuenta para ingresar datos como, fecha de nacimiento, lugar de residencia, etc.
                        <?php if ($message) {
        echo '<div class="error">' . $message . '</div>';
    }
    ?>
                        <dl>
                            <dt><label for="f1">Nombre de usuario:</label></dt>
                            <dd><input type="text" id="f1" name="uname" autocomplete="off" value="<?php echo $uname; ?>" required/></span></dd>
                        </dl>
                        <dl>
                            <dt><label for="f2">Contrase&ntilde;a:</label></dt>
                            <dd><input type="password" id="f2" name="upass" autocomplete="off" value="<?php echo $upass; ?>" required/></span></dd>
                        </dl>
                        <dl>
                            <dt><label for="f3">Confirmar contrase&ntilde;a:</label><br /><span>Ingresa tu contrase&ntilde;a nuevamente.</span></dt>
                            <dd><input type="password" id="f3" name="ucpass" autocomplete="off" value="<?php echo $ucpass; ?>" required/></span></dd>
                        </dl>
                        <dl>
                            <dt><label for="f4">Email:</label><br /><span>Ingresa tu direcci&oacute;n de email.</span></dt>
                            <dd><input type="text" id="f4" name="umail" autocomplete="off" value="<?php echo $umail; ?>" required/></span></dd>
                        </dl>
                        <p><input type="submit" name="save" class="gbqfb" value="Continuar &raquo;"/></p>
                    </fieldset>
                    </form>
                    <?php } elseif ($step == 5) {?>
                    <h2 class="s16">Bienvenido a PHPost Risus</h2>
                    <!-- ESTADISTICAS -->
                    <form action="http://download.phpost.net/feed/install.php" method="post" id="form">
                    <div class="error">Ingresa a tu FTP y borra la carpeta <strong><?php echo basename(getcwd()); ?></strong> antes de usar el script.</div>
                    <fieldset style="color: #555;">
                        Gracias por instalar <strong>PHPost Risus</strong>, ya est&aacute; lista tu nueva comunidad <strong>Link Sharing System</strong>. S&oacute;lo inicia sesi&oacute;n con tus datos y comienza a disfrutar. Ahora no dejes de <a href="http://www.phpost.net/" target="_blank"><u>visitarnos</u></a> para estar pendiente de futuras actualizaciones. Recuerda reportar cualquier bug que encuentres, de esta manera todos ganamos.<br /><br />
                    </fieldset>
                    <center>
                        <input type="hidden" name="key" value="<?php echo $key; ?>" />
                        <input type="submit" value="Finalizar" class="gbqfb" style="font-size: 12pt; font-weight: bold;" />
                    </center>
                    </form>
                    <?php }?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div id="footer">
            <p>Powered by <a href="http://www.phpost.net" target="_blank">PHPost</a></p>
        </div>
    </div>
</body>
</html>
