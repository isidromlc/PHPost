<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Modelo para instanciar smarty
 *
 * @name    c.smarty.php
 * @author  PHPost Team
 */

require(TS_ROOT.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'smarty'.DIRECTORY_SEPARATOR.'Smarty.class.php');


class tsSmarty extends Smarty
{
  var $_tpl_hooks;
  
  var $_tpl_hooks_no_multi = TRUE;
  
  
  
  function tsSmarty()
  {
    global $tsCore;
    //
    $this->template_dir = TS_ROOT.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.TS_TEMA.DIRECTORY_SEPARATOR.'templates';
    $this->compile_dir = TS_ROOT.DIRECTORY_SEPARATOR.'cache'; 
    $this->template_cb = array('url' => $tsCore->settings['url'], 'title' => $tsCore->settings['titulo']);
    //
    $this->_tpl_hooks = array();
  }
  
  
  
  public static function &getInstance()
  {
    static $instance;
    
    if( is_null($instance) )
    {
      $instance = new tsSmarty();
    }
    
    return $instance;
  }  
  
  function assign_hook($hook, $include)
  {
    if( !isset($this->_tpl_hooks[$hook]) )
      $this->_tpl_hooks[$hook] = array();
    
    if( $this->_tpl_hooks_no_multi && in_array($include, $this->_tpl_hooks[$hook]) )
      return;
    
    $this->_tpl_hooks[$hook][] = $include;
  }
}