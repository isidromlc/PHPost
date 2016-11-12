<?php

/**
 * @name /upgrade/index.php
 * @author PHPost Team
 * @copyright 2012
 */
error_reporting(0);
//

session_start();

include("functions.php");

$step = htmlspecialchars(intval($_GET['step']));
if(!$step)  header('Location: index.php?step=1');

list($coll, $c_coll) = include("collection.php");

switch($step)
{
    case 1: // Password base de datos.
        // Permisos
        $chmod = substr(sprintf('%o', fileperms('../config.inc.php')), -3);
        if($chmod != 666)
        {
            $message = 'Por favor cambia los permisos CHMOD del archivo <strong>config.inc.php</strong> a 666';
        }
        // Verificamos connección
        if ($_POST['connect'])
        {
            // Tratamos de conectar
            $db['hostname'] = $_POST['dbhost'];
            $db['username'] = $_POST['dbuser'];
            $db['password'] = $_POST['dbpass'];
            $db['database'] = $_POST['dbname'];
            
            // CONECTAMOS
            $rst = do_connect($db);

		    if ($rst == 1)
		    {
		        // Guardamos en una variable de session para continuar el proceso.
		        $_SESSION['db'] = $db;
                // Actualizamos config.inc.php
                $config = file_get_contents('../config.inc.php');
                $config = str_replace(array('dbhost', 'dbuser', 'dbpass', 'dbname'), array($db['hostname'], $db['username'], $db['password'], $db['database']), $config);
                file_put_contents('../config.inc.php',$config);
                // Segundo páso
                header("Location: index.php?step=2");
		    }
		    else
		    {
		        $message = 'Tus datos de conexi&oacute;n son incorrectos.';
		    }

        }
        break;
    case 2: // Modo de instalación
        check_connection();

        if (isset($_POST['modo']))
        {
            $modo = $_POST['modo'];
            if ($modo == 'selectivo')
            {
                header("Location: index.php?step=4");
            }
            elseif ($modo == 'reinstalar')
            {
                header("Location: index.php?step=3");
            }
            else
            {
                $message = 'Modo incorrecto.';
            }
        }
        break;
    case 3: // Limpieza.
        check_connection();

        $rst_coll = procesar_limpieza_collection($coll);

        break;
    case 4: // Seleccion de actualización.
        check_connection();

        break;
    case 5: // Aplicación cambios BD.
        check_connection();

        // Verificamos el POST.
        if ( ! isset($_POST['update']) || ! is_array($_POST['update']))
        {
            header('Location: index.php?step=4&error=1');
        }
        $rst = procesar_collection($coll, $_POST['update'], $c_coll);

        break;
    case 6: // Resumen instalación.
        check_connection();
        unset($_SESSION['passwd']);
        session_destroy();

        break;
    default:
        header("Location: index.php?step=1");

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="CubeBox" />
	<title>Actualizaci&oacute;n de PHPost Alfa 1.x a Finalis Risus</title>
    <link href="estilo.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="container">
        <div id="header">
            <h1 class="s32 left"><a href="http://www.phpost.net" target="_blank"><img src="./logo.png" /></a></h1>
            <h3 class="s12 right">Programa de actualizaci&oacute;n de contenidos</h3>
        </div>
        <div id="content">
            <div class="col_left">
                <h3 class="s16" style="margin-bottom: 5px;;">Pasos</h3>
                <ul class="menu">
                    <li id="mstep_1"<?php if($_GET['step'] > 0) echo ' class="ok"';?>>#1 | Conexi&oacute;n</li>
                    <li id="mstep_1"<?php if($_GET['step'] > 1) echo ' class="ok"';?>>#2 | Modo actualizaci&oacute;n</li>
                    <li id="mstep_1"<?php if($_GET['step'] > 2) echo ' class="ok"';?>>#3 | Preparaci&oacute;n</li>
                    <li id="mstep_1"<?php if($_GET['step'] > 3) echo ' class="ok"';?>>#4 | Selecci&oacute;n</li>
                    <li id="mstep_1"<?php if($_GET['step'] > 4) echo ' class="ok"';?>>#5 | Actualizaci&oacute;n</li>
                    <li id="mstep_1"<?php if($_GET['step'] > 5) echo ' class="ok"';?>>#6 | Resumen</li>
                </ul>
            </div>
            <div class="col_right">
                <div id="step_<?=$step;?>" class="step">
                    <h3 class="step_num" style="margin-bottom: 5px;;">Paso #<?php echo $step; ?></h3>
                    <?php if($step == 1) { ?>
                    <form action="index.php?step=1" method="post" id="form">
                    <fieldset>
                        <legend>Conexi&oacute;n</legend>
                        <p>Ingresa los datos de acceso a la base de datos en d&oacute;nde actualmente tienes instalado PHPost.</p>
                        <?php if($message) echo '<div class="error">'.$message.'</div>';?>
                        <dl>
                            <dt><label for="f1">Servidor:</label><br /><span>D&oacute;nde est&aacute; la base de datos, ej: <strong>localhost</strong></span></dt>
                            <dd><input type="text" autocomplete="off" id="f1" name="dbhost" value="<?php echo $dbhost;?>" /></span></dd>
                        </dl>
                        <dl>
                            <dt><label for="f2">Usuario:</label><br /><span>El usuario de tu base de datos.</span></dt>
                            <dd><input type="text" autocomplete="off" id="f2" name="dbuser" value="<?php echo $dbuser;?>" /></span></dd>
                        </dl>
                        <dl>
                            <dt><label for="f3">Contrase&ntilde;a:</label><br /><span>Para acceder a la base de datos.</span></dt>
                            <dd><input type="password" autocomplete="off" id="f3" name="dbpass" value="<?php echo $dbpass;?>" /></span></dd>
                        </dl>
                        <dl>
                            <dt><label for="f4">Base de datos</label><br /><span>Nombre de la base de datos para tu web.</span></dt>
                            <dd><input type="text" autocomplete="off" id="f4" name="dbname" value="<?php echo $dbname;?>" /></span></dd>
                        </dl>
                        <p><input type="submit" name="connect" class="gbqfb" value="Conectar &raquo;"/></p>
                    </fieldset>
                    </form>
                    <?php } elseif($step == 2) { ?>
                    <form action="index.php?step=2" method="post" id="form">
                    <fieldset>
                        <legend>Modo de actualizaci&oacute;n</legend>
                        <?php if($message) echo '<div class="error">'.$message.'</div>';?>
                        <dl>
                            <dt class="cf"><label for="selectivo">Selectiva:</label><br /><span>Seleccionar las tablas a modificar</span></dt>
                            <dd class="cf"><input type="radio" name="modo" value="selectivo" id="selectivo" checked="checked" /></dd>
                            <dt class="cf"><label for="reinstalar">Reinstalar:</label><br /><span>Deshacer los cambios de la actualizaci&oacute;n e ir al modo selectivo</span></dt>
                            <dd class="cf"><input type="radio" name="modo" value="reinstalar" id="reinstalar" /></dd>
                        </dl>
                        <p><input type="submit" name="start" class="gbqfb" value="Empezar &raquo;"/></p>
                    </fieldset>
                    </form>
                    <?php } elseif($step == 3) {?>
                    <h2 class="s16">Resultado limpieza para reinstalación</h2>
                    <form action="index.php?step=4" method="post" id="form">
                    <p>Leyenda:</p>
                    <p>SKIP implica que no se pudo realizar la limpieza.</p>
                    <p>OK que fue satisfactorio.</p>
                    <p>ERROR implica que se produjo un error al intentar la limpieza.</p>
                    <fieldset>
                        <legend>Resultado de la limpieza de la reinstalación:</legend>
                        <dl>
                            <?php echo resultado_limpieza_html($coll, $rst_coll); ?>
                        </dl>
                        <p><input type="submit" name="select" class="gbqfb" value="Continuar &raquo;"/></p>
                    </fieldset>
                    </form>
                    <?php } elseif($step == 4) {?>
                    <h2 class="s16">Selecciones procedimiento de instalación</h2>
                    <form action="index.php?step=5" method="post" id="form">
                    <?php if (isset($_GET['error'])): ?>
                    <div class="error">No ha seleccionado correctamente los campos.</div>
                    <?php endif; ?>
                    <fieldset>
                        <legend>Tablas a actualizar:</legend>
                        <dl>
                            <?php echo generate_collection($coll); ?>
                        </dl>
                        <p><input type="submit" name="select" class="gbqfb" value="Realizar &raquo;"/></p>
                    </fieldset>
                    </form>
                    <?php } elseif($step == 5) {?>
                    <h2 class="s16">Selecciones procedimiento de instalación</h2>
                    <form action="index.php?step=6" method="post" id="form">
                    <fieldset>
                        <legend>Resultado de la actualización:</legend>
                        <dl>
                            <?php echo resultado_html($coll, $rst); ?>
                        </dl>
                        <p><input type="submit" name="select" class="gbqfb" value="Continuar &raquo;"/></p>
                    </fieldset>
                    </form>
                    <?php } elseif($step == 6) {?>
                    <h2 class="s16">Bienvenido a PHPost Alfa Finalis Risus</h2>
                    <!-- ESTADISTICAS -->
                    <div class="error">Ingrese a su FTP y borre la carpeta <strong><?php echo basename(getcwd()); ?></strong> antes de usar el script.</div>
                    <fieldset style="color: #555;">
                        La actualizaci&oacute;n ha sido exitosa y ahora puede volver a usar su comunidad. Gracias por usar <strong>PHPost</strong> como su sistema de compartimiento de enlaces. No deje de <a href="http://www.phpost.net/" target="_blank"><u>visitarnos</u></a> y estar pendiente de futuras actualizaciones. Recuerde reportar cualquier bug que encuentre para as&iacute; poder solucionarlos.<br /><br />
                    </fieldset>
                    <center>
                        <input type="hidden" name="key" value="<?php echo $key; ?>" />
                        <a href="http://<?=$_SERVER['SERVER_NAME']?>" class="gbqfb"style="font-size: 12pt; font-weight: bold; text-decoration:none;" >Finalizar</a>
                    </center>
                    <?php }?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div id="footer">
            <p><a href="http://www.phpost.net/" target="_blank">PHPost</a> es un producto m&aacute;s de <a href="http://www.cubebox.mx" target="_blank">CubeBox</a></p>
        </div>
    </div>
</body>
</html>
