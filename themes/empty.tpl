<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Página inexistente.</title>
	<link rel="shortcut icon" href="{$tsConfig.favicon}" type="image/x-icon" />
	<style>
		* {
			padding: 0;
			margin: 0;
			box-sizing: border-box;
		}
		html, body {
			width: 100%;
			height: 100%;
			background: linear-gradient(45deg, #0008, #0004);
			background-size: contain;
			background-position: center;
			background-attachment: fixed;
		}
		body {
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
			font-family: 'Helvetica', serif;
			color: #fff;
		}
		body div {
			padding: 2rem;
			width: 60%;
			margin: 0 auto;
			font-size: 2rem;
			border-radius: 8px;
			box-shadow: 10px 10px 1rem #000, 0 0 5rem #0006, 0 0 10rem #0002;
			background: linear-gradient(65deg, #0009, #0006, transparent);
			backdrop-filter: blur(6px);
		}
		h1 {
			font-size: 30px;
		}
		p {
			font-size: 16px;
			line-height: 2em;
		}
		.center {
			display: block;
			text-align: center;
			font-size: 12px;
			padding: 20px 0;
		}
	</style>
</head>
<body>
	<div>
		<h1>Lo sentimos</h1>
		<p>Plantilla: <b>{$tsPage}.tpl</b></p>
		<p>No se pudo encontrar la plantilla en su theme.</p>
		<p class="center">Contacte al administrador</p>
	</div>
</body>
</html>