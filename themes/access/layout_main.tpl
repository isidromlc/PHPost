<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" href="{$tsConfig.images}/favicon.ico" type="image/x-icon" />
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
<!-- Estilos CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css" rel="stylesheet">
{block "style"}{/block}
<link href="{$tsConfig.url}/themes/access/assets/{$tsPage}.css?{$smarty.now}" rel="stylesheet">
<script src="{$tsConfig.js}/jquery.min.js?{$smarty.now}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.all.min.js"></script>
<script src="{$tsConfig.url}/themes/access/assets/modal.js?{$smarty.now}"></script>
<title>{$tsTitle}</title>
<script type="text/javascript">
var global_data={
	img:'{$tsConfig.tema.t_url}/',
	url:'{$tsConfig.url}',
	domain:'{$tsConfig.domain}',
   s_title: '{$tsConfig.titulo}',
   s_slogan: '{$tsConfig.slogan}'
};
</script>
</head>
<body>
	<div id="modalnewrisus"></div>
	{block "main"}{/block}	
	{block "foot-javascript"}{/block}
	{block "footer"}{/block}
</body>
</html>