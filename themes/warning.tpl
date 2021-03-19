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
		<h1>Advertencia:</h1>
		<p>Solo el administrador puede utilizar el "intalador" o el "acutalizador"</p>
		<p class="center">
			<form method="POST">
				<input type="text" name="llave" placeholder="Ingresa tu llave">
				<button type="submit">Comprobar</button>
			</form>
		</p>
	</div>
</body>
</html>