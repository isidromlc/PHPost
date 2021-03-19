<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{$tsTitle}</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css" rel="stylesheet">
	<link rel="shortcut icon" href="{$tsConfig.favicon}" type="image/x-icon" />
<script type="text/javascript">
var global_data={
	img:'{$tsConfig.tema.t_url}/',
	url:'{$tsConfig.url}',
	domain:'{$tsConfig.domain}',
   s_title: '{$tsConfig.titulo}',
   s_slogan: '{$tsConfig.slogan}'
};
</script>
	<script src="{$tsConfig.default}/js/jquery.min.js"></script>
	
	<script src="{$tsConfig.url}/views/access/assets/login.js?{$smarty.now}"></script>
	<style>
		* {
			padding: 0;
			margin: 0;
			box-sizing: border-box;
		}
		html, body {
			width: 100%;
			height: 100%;
			background: linear-gradient(45deg, #0008, #0004), url('{if $tsUrl}{$tsUrl}{else}{$tsConfig.assets}{/if}{if $tsUrl}/assets{/if}/images/portfolio-7.jpg');
			background-size: cover;
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
		body > div {
			padding: 2rem;
			width: 60%;
			margin: 0 auto;
			font-size: 2rem;
			border-radius: 8px;
			box-shadow: 10px 10px 1rem #000, 0 0 5rem #0006, 0 0 10rem #0002;
			text-shadow: 10px 10px 1rem #000, 0 0 5rem #0006, 0 0 10rem #0002;
			background: linear-gradient(65deg, #0009, #0006, transparent);
			backdrop-filter: blur(1px);
		}
		*:-webkit-autofill,
		*:-webkit-autofill:hover, 
		*:-webkit-autofill:focus  {
			-webkit-text-fill-color: var(--bs-light);
			transition: background-color 5000s ease-in-out 0s;
			background-color: #213746;
		}
		.form-control {
			border: none;
			background:#132a3688;
			color:var(--bs-white);
		}
		.form-control::placeholder {
			color: #444;
		}
		.form-control:focus {
			border-color: transparent;
			background:#0e1f2988;
			color:var(--bs-white);
		}
		.backLogin {
			position: absolute;
			width: 50%;
			margin: 0 auto;
			font-size: 16px;
			background-color: var(--bs-dark);
		}
	</style>
</head>
<body>
	<div>
		<p class="text-center m-0 pt-4">{$tsConfig.offline_message}</p>
		<div class="text-center mt-2 pb-4"><a href="javascript:open_login_box()" class="btn btn-sm btn-primary">Iniciar sesión</a></div>
	</div>

{if !$tsUser->is_member}
<script>
/* Box login */
function open_login_box(action) {
   $('.backLogin').fadeIn('fast');
}

function close_login_box() {
   $('.backLogin').slideUp('fast');
}
</script>
<div class="backLogin" style="display:none;">
   <div class="login_box bg-dark-xa shadow rounded overflow-hidden position-relative">
      <div class="lader position-relative d-flex justify-content-center align-items-center saludo-{$tsLader}">
         <h3>{$tsMessage}</h3>
         <div class="position-absolute mx-auto bottom-5 right-3 left-0 w-25" style="display:none;" id="loading">
            <div class="loading loading-lg success"></div>
         </div>
      </div>
      <div class="offset-content">
         <a href="javascript:close_login_box()" data-close><i feather="x-circle"></i></a>
         <div class="login_cuerpo">
            <div id="login_error" class="alert alert-danger position-absolute" style="display: none;"></div>
            <form autocomplete="OFF" id="form">
               <div class="form-floating mb-3">
						<input type="text" id="usuario" placeholder="Nick" class="form-control shadow" name="nick" required>
						<label for="usuario" class="form-label">Nick</label>
               </div>
               <div class="form-floating mb-3">
		   			<input type="password" id="contraseña" class="form-control shadow" placeholder="Contraseña" name="pass" required>
						<label for="password" class="form-label">Contraseña</label>
               </div>
					<div class="mb-4 form-check">
						<input type="checkbox" name="rem" id="recordarme" class="form-check-input" required>
						<label for="recordarme" class="form-check-label">Mantener iniciado</label>
					</div>
               <div class="d-grid">
						<button type="submit" onclick="login.iniciar(); return false" id="antes" class="btn btn-primary">Iniciar sesión</button>
					</div>
            </form>
         </div>
         <div class="my-3 text-center">
				<span><a class="small text-decoration-none text-white-50 mx-1" href="javascript:rememberVerification(false, 'pass')">Recuperar contraseña</a></span>
			</div>
      </div>
   </div>
</div>
{/if}
</body>
</html>