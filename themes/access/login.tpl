{extends "layout_main.tpl"}

{block "main"}
<div class="container w-75 bg-dark rounded overflow-auto shadow">
	<div class="row align-items-stretch bg">
		<div class="col d-none d-lg-flex justify-content-lg-center align-items-lg-center col-md-5 col-lg-5 col-xl-6 rounded-start">
			<i class="bi bi-lightning bi-icons"></i>
		</div>
		<div class="col bg-w50 p-5 rounded-end">
			<h2 class="fw-bold text-center pb-3">Bienvenido</h2>

			<!-- LOGIN -->
			<form autocomplete="OFF" id="form">
				<div class="form-floating mb-4">
					<input type="text" id="usuario" placeholder="Nick" class="form-control shadow" name="nick" required>
					<label for="usuario" class="form-label">Nick</label>
				</div>
				<div class="form-floating mb-4">
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

				<div class="my-3 text-center">
					<span class="d-block ">No tienes cuenta? <a href="{$tsConfig.url}/registro/">Regístrate</a></span>
					<span><a class="small text-decoration-none text-white-50 mx-1" href="javascript:rememberVerification(false, 'pass')">Recuperar contraseña</a></span>
					<span><a class="small text-decoration-none text-white-50 mx-1" href="javascript:rememberVerification(false, 'validation')">¡Activa tu cuenta!</a></span>
				</div>

			</form>

		</div>
	</div>
</div>
{/block}

{block "foot-javascript"}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js?{$smarty.now}"></script>
<script src="{$tsConfig.url}/themes/access/assets/login.js?{$smarty.now}"></script>
{/block}