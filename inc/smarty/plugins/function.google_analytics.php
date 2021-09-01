<?php
/**
 * @author Bits4me(phpost)
 * @return string
 */
function smarty_function_google_analytics($params, &$smarty){
	if ($params['code'] == '' | $params['code'] == 'UA-xxxxxx-x') {
		return false;
	}
   $return = "
<script async src='https://www.googletagmanager.com/gtag/js?id=".$params['code']."'></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', \"".$params['code']."\");
</script>";
   
   echo $return;
}
 
?>