<?php
/**
 * Controlador
 *
 * @name    login.php
 * @author  New Risus 2.2
 */

/**********************************\

 * (VARIABLES POR DEFAULT)   *

\*********************************/

$tsPage = "login";

$tsLevel = 1; // NIVEL DE ACCESO A ESTA PAGINA. => VER FAQs

$tsAjax = empty($_GET['ajax']) ? 0 : 1; // LA RESPUESTA SERA AJAX?

$tsContinue = true; // CONTINUAR EL SCRIPT

include "../../header.php";

$tsTitle = "Inicia sesión en {$tsCore->settings['titulo']}"; // TITULO DE LA PAGINA ACTUAL

# En el caso que haya iniciado la sesión
if ($tsUser->is_member) {
   $desde = $tsCore->settings['url'];
   header("Location: " . $desde);
}

// VERIFICAMOS EL NIVEL DE ACCSESO ANTES CONFIGURADO
$tsLevelMsg = $tsCore->setLevel($tsLevel, true);
if ($tsLevelMsg != 1) {
   $tsPage = 'aviso';
   $tsAjax = 0;
   $smarty->assign("tsAviso", $tsLevelMsg);
   //
   $tsContinue = false;
}

if ($tsContinue) {
   include TS_EXTRA . "/datos.php";

   // SOLO MENORES DE 100 AÑOS xD Y MAYORES DE...
   $now_year = date("Y", time());
   $max_year = 100 - $tsCore->settings['c_allow_edad'];
   $end_year = $now_year - $tsCore->settings['c_allow_edad'];
   $smarty->assign("tsMax", $max_year);
   $smarty->assign("tsEndY", $end_year);
   $smarty->assign("tsPaises", $tsPaises);
   $smarty->assign("tsMeces", $tsMeces);
   $smarty->assign("tsFrom", $_GET['from']);
   $smarty->assign("tsType", 'normal');
   $smarty->assign("tsFactor", $_GET['act']);
}

if (empty($tsAjax)) {
   $smarty->assign("tsTitle", $tsTitle);
   include "../../footer.php";
}
