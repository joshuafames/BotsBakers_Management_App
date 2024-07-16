<?php 

include('classes/DB.php');


	if (isset($_POST['login'])) {
							
		$username = $_POST['username'];
		$password = $_POST['password'];

		if (DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$username))) {

			if (password_verify($password, DB::query('SELECT password FROM users WHERE username=:username', array(':username'=>$username)) [0]['password'])) {

				echo "Logged In";
				$cstrong = True;
				$token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));								
				$user_id = DB::query('SELECT id FROM users WHERE username=:username', array(':username'=>$username))[0]['id'];
				DB::query('INSERT INTO login_tokens VALUES (\'\', :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));

				setcookie("SNID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
				setcookie("SNID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
				header('Location: home.php');

			}else {
				echo "Incorrect Password";
			}

		}else {
			echo "User Not Registered";
		}

	}else if (isset($_POST['login-sm'])) {
		$usernameSM = $_POST['username-sm'];
		$passwordSM = $_POST['password-sm'];

		if (DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$usernameSM))) {

			if (password_verify($passwordSM, DB::query('SELECT password FROM users WHERE username=:username', array(':username'=>$usernameSM)) [0]['password'])) {

				echo "Logged In";
				$cstrongSM = True;
				$tokenSM = bin2hex(openssl_random_pseudo_bytes(64, $cstrongSM));								
				$user_idSM = DB::query('SELECT id FROM users WHERE username=:username', array(':username'=>$usernameSM))[0]['id'];
				DB::query('INSERT INTO login_tokens VALUES (\'\', :token, :user_id)', array(':token'=>sha1($tokenSM), ':user_id'=>$user_idSM));

				setcookie("SNID", $tokenSM, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
				setcookie("SNID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
				header('Location: indexfeed.php');

			}else {
				echo "Incorrect Password";
			}

		}else {
			echo "User Not Registered";
		}

	}


?>
<html>
<body>
	<form method="post" action="./login.php">
		<input type="text" name="username" placeholder="Username">
		<input type="password" name="password" placeholder="Password">
		<button type="submit" name="login">Login</button>
	</form>
</body>
</html>