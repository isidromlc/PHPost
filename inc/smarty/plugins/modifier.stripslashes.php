<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty stripslashes modifier plugin
 *
 * Type:     modifier<br>
 * Name:     stripslashes<br>
 * Purpose:  Replace all repeated spaces, newlines, tabs
 *           with a single space or supplied replacement string.<br>
 * Example:  {$var|stripslashes} {$var|stripslashes:"&nbsp;"}
 * Date:     September 25th, 2002
 * @link http://smarty.php.net/manual/en/language.modifier.stripslashes.php
 *          stripslashes (Smarty online manual)
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @version  1.0
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_stripslashes($text)
{
    return stripslashes($text);
}

/* vim: set expandtab: */

?>
