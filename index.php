<?	
	include('php/CharSet.php');
	include('php/connection.php');
	include('php/checking.php');
		
		
	
	if (isset($_POST['Enter'])) {
		$login = $_POST['login']; 
		$password=md5($_POST['password']);
		
		$result = mysql_query("SELECT * FROM users WHERE login='$login'",$db);
		$myrow = mysql_fetch_array($result);
		if (!empty($myrow['login'])) {
			if ($password = $myrow['password']){
				include("php/SetCookie.php");
				echo "<script>document.location.href='index.php';</script>";
			}
			else{
				exit ("Проверьте логин или пароль!");
			}
		}
		else{
			exit ("Проверьте логин или пароль!");
		}
	
	
	}
	
	if (isset($_POST['Save'])) { 
		$login = $_POST['login']; 
		$password=md5($_POST['password']);
		$r_password=md5($_POST['r_password']);		
		
		if (empty($login) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
		{
			//exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
			echo "<script>document.location.href='index.php?error=1';</script>";
		}		
		else if ($password != $r_password)
		{
			//exit ("Пароли не совпадают!");
			echo "<script>document.location.href='index.php?error=2';</script>";
		}
		else{
		
		// проверка на существование пользователя с таким же логином
		$result = mysql_query("SELECT login FROM users WHERE login='$login'",$db);
		$myrow = mysql_fetch_array($result);
		if (!empty($myrow['login'])) {
		exit ("Извините, введённый вами логин уже зарегистрирован. Введите другой логин.");
		}
		
		// если такого нет, то сохраняем данные
		$result2 = mysql_query ("INSERT INTO users (login,password) VALUES('$login','$password')");
		include("php/SetCookie.php");
		// Проверяем, есть ли ошибки
		/*
		if ($result2=='TRUE')
		{
		echo "Вы успешно зарегистрированы! Теперь вы можете зайти на сайт. <a href='index.php'>Главная страница</a>";
		}
	 else {
		echo "Ошибка! Вы не зарегистрированы.";
		}
		*/
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html" charset="utf-8" />
		<link href="css/style.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<?
		if($info == 0){
		Echo '
			<main>
				<div id="conteiner">
					
					<form id="login_conteiner" method="POST">
						<h2>Авторизация</h2>
						<span>Логин</span> <br>
						<input type="text" name="login"/><br>
						<span>Пароль</span> <br>
						<input type="password" name="password"/><br>
						<input type="submit" name="Enter" value="Ввойти" class="fl bg_g"/>
						<input type="button" id="open_register" value="Регистрация" class="fr bg_y"/>
						<div class="cr"></div>
					</form>
					
					<form id="register_conteiner" method="POST">
						<h2>Регистрация</h2>	
						<span>Логин</span> <br>
						<input type="text" name="login"/><br>
						<span>Пароль</span> <br>
						<input type="password" name="password" /><br>
						<span>Повторить пароль</span> <br>
						<input type="password" name="r_password"/><br>
						<input type="submit" name="Save" value="Регистрация" class="bg_g"/>
					</form>
				</div>
			</main>
			
			<script>
				document.getElementById("open_register").onclick=function(){			
					document.getElementById("register_conteiner").classList.add("visible_table");
				}
			</script>
			';
			if ($error != 0){
				Echo'
					<center>
						<div id="error_bg" style="position: fixed; top: 0; left: 0; height: 100%; width: 100%; background: rgba(0,0,0,0.5);">
							<div id="error" style="padding: 40px 40px 20px 40px; background: #fff;width: 50%;margin-top: 200px; border-radius: 6px;">
								<span style="font-size: 22px;">'. $error_value .'</span><br>
								<span id="error_close" style="margin-top: 20px;font-size: 18px; color: red;">Закрыть</span>
							</div>
						</div>
					</center>
					<script>
						document.getElementById("error_close").onclick=function(){			
							document.getElementById("error_bg").classList.add("hide");
						}
					</script>
				';
			}
		}
		else if($info == 1) {
			Echo '
				<main>
					<div id="left_content">
						<article id="left_article">
							<div id="user_name" title="'. $_COOKIE[Login] .'">
								'. $_COOKIE[Login] .'
							</div>
							<div class="variants">
								Изучение слов
							</div>
							<div class="variants">
								Изучение неправельных глаголов
							</div>
						</article>
					
					</div>
					<div id="right_content">
						<article id="top_menu">
							<div class="top-menu">
								Создать талицу
							</div>
							<div class="top-menu">
								fdhd
							</div>
							<div class="cr"></div>
						</article>
						<article id="content_info">
						br<br>br<br>br<br>br<br>br<br>br<br>br<br>br<br>br<br>br<br>
						br<br>br<br>br<br>br<br>br<br>br<br>br<br>br<br>br<br>br<br>br<br>br<br>br<br>br<br>br<br>br<br>br<br>br<br>br<br>br<br>
						br<br>br<br>br<br>br<br>br<br>br<br>br<br>br<br>br<br>br<br>
						br<br>br<br>br<br>br<br>br<br>br<br>br<br>br<br>br<br>br<br>
						br<br>br<br>br<br>br<br>br<br>br<br>br<br>br<br>br<br>br<br>
						</article>
					</div>
				</main>
				<script>
					var body = document.body,
					html = document.documentElement;

					var height = Math.max( body.scrollHeight, body.offsetHeight, 
					html.clientHeight, html.scrollHeight, html.offsetHeight );
					
					document.getElementById("content_info").style.height = (height-83)+"px";
				</script>
			';
		}
			
		?>
	</body>
</html>