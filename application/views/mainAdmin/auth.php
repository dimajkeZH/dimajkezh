<link rel="stylesheet" href="/application/views/mainAdmin/css/style.css">
<div class="login_wrapper">
		<div class="login">
			<div class="login_logo">
				<img src="/application/views/mainAdmin/img/logo.png" alt="">
				<div class="logo_text">
					<p>PerfectCMS <span>0.0.4</span> </p>
				</div>
			</div>
			<div class="login_forma">
				<?php if(isset($_SESSION['err'])AND($_SESSION['err']!='')): ?>
				<p><?php echo $_SESSION['err']; ?></p><br>
				<?php else: ?>
				<br><br>
				<?php endif; ?>
				<form action="/admin/login" method="POST">
					<div class="login_forma_group">
						<p>Пользователь</p>
						<input type="text" placeholder="login" name="name">
					</div>
					<div class="login_forma_group">
						<p>Пароль</p>
						<input type="password" placeholder="password" name="pass">
					</div>
					<div class="login_forma_group checkbox">
						<label >
							<input type="checkbox" name="remember">
							Запомнить меня
						</label>

					</div>
					<div class="login_forma_confirm">
						<button>Войти</button>
					</div>
					<!--
					<div class="login_forma_forgot">
						<a href="#">Зыбыли пароль?</a>
					</div>
					-->
				</form>
			</div>
		</div>
	</div>