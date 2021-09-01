<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{$tsTitle}</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css" rel="stylesheet">
	<link rel="shortcut icon" href="{$tsConfig.favicon}" type="image/x-icon" />
	<style>
		:root {
			--nr-dark: #292c31;
			--nr-dark-gray: #303235;
			--nr-darken: #1e2024;
			--nr-info: #03a9f4;
		}
		* {
			padding: 0;
			margin: 0;
			box-sizing: border-box;
		}
		html, body {
			width: 100%;
			height: 100%;
			background: linear-gradient(45deg, #0008, #0004);
			background-size: cover;
			background-position: center;
			background-attachment: fixed;
		}
		body {
			font-family: 'Helvetica', serif;
			color: #fff;
		}
		body > div {
			padding: 2rem;
			width: 60%;
			margin: 0 auto;
			border-radius: 8px;
			box-shadow: 10px 10px 1rem #000, 0 0 5rem #0006, 0 0 10rem #0002;
			background: linear-gradient(65deg, #0009, #0006, transparent);
			backdrop-filter: blur(6px);
		}
		*:-webkit-autofill,
		*:-webkit-autofill:hover, 
		*:-webkit-autofill:focus  {
			-webkit-text-fill-color: var(--bs-light);
			transition: background-color 5000s ease-in-out 0s;
			background-color: #21374666;
		}
		.form-control{
			border: none;
			background-color: var(--nr-dark);
			color: var(--bs-white);
		}
		.form-control::placeholder {
			color: #444;
		}
		.form-control:focus {
			border-color: transparent;
			background:#0e1f2988;
			color:var(--bs-white);
		}
		.form-control:disabled {
			border-color: transparent;
			background:#56565666;
			color:var(--bs-white);
			cursor: no-drop;
		}
		.icon_svg {
		   width: 150px;
		   height: 150px;
		   background-repeat: no-repeat;
		   -webkit-background-size: 150px;
		   background-size: 150px;
		   background-position: center;
		   margin: 20px auto 10px auto;
		   display: block;
		}
		.icon_svg_1 {
		   background-image: url('data:image/svg+xml,<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-emoji-laughing" fill="%236610f2" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path fill-rule="evenodd" d="M12.331 9.5a1 1 0 0 1 0 1A4.998 4.998 0 0 1 8 13a4.998 4.998 0 0 1-4.33-2.5A1 1 0 0 1 4.535 9h6.93a1 1 0 0 1 .866.5z"/><path d="M7 6.5c0 .828-.448 0-1 0s-1 .828-1 0S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 0-1 0s-1 .828-1 0S9.448 5 10 5s1 .672 1 1.5z"/></svg>');
		}
		.icon_svg_2 {
		   background-image: url('data:image/svg+xml,<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-check-fill text-success" fill="%2328a745" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm9.854-2.854a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/></svg>');
		}
		.icon_svg_3 {
		   background-image: url('data:image/svg+xml,<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-shield-lock-fill" fill="%2320c997" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.187 1.025C6.23.749 7.337.5 8 .5c.662 0 1.77.249 2.813.525a61.09 61.09 0 0 1 2.772.815c.528.168.926.623 1.003 1.184.573 4.197-.756 7.307-2.367 9.365a11.191 11.191 0 0 1-2.418 2.3 6.942 6.942 0 0 1-1.007.586c-.27.124-.558.225-.796.225s-.526-.101-.796-.225a6.908 6.908 0 0 1-1.007-.586 11.192 11.192 0 0 1-2.417-2.3C2.167 10.331.839 7.221 1.412 3.024A1.454 1.454 0 0 1 2.415 1.84a61.11 61.11 0 0 1 2.772-.815zm3.328 6.884a1.5 1.5 0 1 0-1.06-.011.5.5 0 0 0-.044.136l-.333 2a.5.5 0 0 0 .493.582h.835a.5.5 0 0 0 .493-.585l-.347-2a.5.5 0 0 0-.037-.122z"/></svg>');
		}
		.icon_svg_4 {
		   background-image: url('data:image/svg+xml,<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-gem" fill="%23dc3545" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3.1.7a.5.5 0 0 1 .4-.2h9a.5.5 0 0 1 .4.2l2.976 3.974c.149.185.156.45.01.644L8.4 15.3a.5.5 0 0 1-.8 0L.1 5.3a.5.5 0 0 1 0-.6l3-4zm11.386 3.785l-1.806-2.41-.776 2.413 2.582-.003zm-3.633.004l.961-2.989H4.186l.963 2.995 5.704-.006zM5.47 5.495l5.062-.005L8 13.366 5.47 5.495zm-1.371-.999l-.78-2.422-1.818 2.425 2.598-.003zM1.499 5.5l2.92-.003 2.193 6.82L1.5 5.5zm7.889 6.817l2.194-6.828 2.929-.003-5.123 6.831z"/></svg>');
		}
		form {
		   padding: 3rem 0;
		   width: 50%;
		   margin: 0 auto;
		}
	</style>
</head>
<body class="d-flex justify-content-center align-items-center flex-column">
	<div>
		<div class="container">
		   <div class="center">
		      <p class="d-block py-2">{$tsAviso.mensaje}</p>
		      {if $tsAviso.but}
		         <input type="button" onclick="location.href='{if $tsAviso.link}{$tsAviso.link}{else}{$tsConfig.url}{/if}'" value="{$tsAviso.but}" class="btn btn-success">
		      {/if}{if $tsAviso.return}
		         <input type="button" onclick="history.go(-{$tsAviso.return})" title="Volver" value="Volver" class="btn btn-success">
		      {/if}
		   </div>
		</div>
	</div>
</body>
</html>