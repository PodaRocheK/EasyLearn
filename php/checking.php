<?
	$info = 999;
	if(!isset($_COOKIE['Login']) or !isset($_COOKIE['Password'])){
		$info = 0;
		include("php/DeleteCookie.php");
	}
	else{
		$login = $_COOKIE['Login']; 
		$password=md5($_COOKIE['Password']);
		
		$result = mysql_query("SELECT * FROM users WHERE login='$login'",$db);
		$myrow = mysql_fetch_array($result);
		if (!empty($myrow['login'])) {
			if ($password = $myrow['password']){
				$info = 1;
			}
			else{
				include("php/DeleteCookie.php");
				echo "<script>document.location.href='index.php';</script>";
			}
		}
		else{
			include("php/DeleteCookie.php");
			echo "<script>document.location.href='index.php';</script>";
		}
	}
	
	$error = $_GET['error'];
	
	switch($error) {
		case 1: 
		$error_value = 'Вы ввели не всю информацию, вернитесь назад и заполните все поля!'; 
		break;
		case 2: 
		$error_value = 'Пароли не совпадают!'; 
		break;
	}

?>