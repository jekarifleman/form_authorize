<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php'; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
    	<td class="left-collum-index">
		
			<h2>Возможности проекта —</h2>
			<p>Вести свои личные списки, например покупки в магазине, цели, задачи и многое другое. Делится списками с друзьями и просматривать списки друзей.</p>
			
		</td>
		<?php if(isset($_GET['login']) && $_GET['login'] == 'true') {
            if (!$_SESSION['is_authorized']) { ?>
                <td class="right-collum-index">

                    <?php if (isset($_POST['login']) && isset($_POST['password'])) { 
                        require_once $_SERVER['DOCUMENT_ROOT'] . '/include/error.php';
                    } ?>
    				
    				<div class="project-folders-menu">
    					<ul class="project-folders-v">
        					<li class="project-folders-v-active"><a href="#">Авторизация</a></li>
        					<li><a href="#">Регистрация</a></li>
        					<li><a href="#">Забыли пароль?</a></li>
    					</ul>
    				    <div class="clearfix"></div>
    				</div>
                    
    				<div class="index-auth">
                        <form action="/?login=true" method="POST">
    						<table width="100%" border="0" cellspacing="0" cellpadding="0">
    							<tr>
    								<td class="iat">
                                        <label for="login_id">Ваш e-mail:</label>
                                        <input id="login_id" size="30" name="login" value="<?=$_POST['login'] ?? ($_COOKIE['login'] ?? ''); ?>">
                                    </td>
    							</tr>
    							<tr>
    								<td class="iat">
                                        <label for="password_id">Ваш пароль:</label>
                                        <input id="password_id" size="30" name="password" type="password" value="<?=isset($_POST['password']) ? $_POST['password'] : '' ?>">
                                    </td>
    							</tr>
    							<tr>
    								<td><input type="submit" value="Войти"></td>
    							</tr>
    						</table>
                        </form>
    				</div>
    			
    			</td>   
            <?php } else {
                if ($isFirstAuthorize) {
                	require_once $_SERVER['DOCUMENT_ROOT'] . '/include/success.php';
                }
            }
	    } ?>
    </tr>
</table>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>