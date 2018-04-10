<?php if(isset($_SESSION['err'])AND($_SESSION['err']!='')): ?>
	<p><?php echo $_SESSION['err']; ?></p>
<?php endif; ?>
<form action="login" method="POST">
	<input type="name" name="name" placeholder="логин">
	<input type="password" name="pass" placeholder="пароль">
	<input type="submit" name="login" value="ENTER">
</form>