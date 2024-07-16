<?php
include('classes/DB.php');
include('classes/Extra.php');

if (isset($_POST['createaccount'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];

	if (!DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$username))) {

		if (strlen($username) >= 3 && strlen($username) <= 32) {

			if (preg_match('/[a-zA-Z0-9_]+/', $username)) {

				if (strlen($password) >= 6 && strlen($password) <= 60) {
					if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

						if (!DB::query('SELECT email FROM users WHERE email=:email', array(':email'=>$email))) {

							DB::query('INSERT INTO users VALUES (\'\', :username, :password, :email, 1)', array(':username'=>$username, ':password'=>password_hash($password, PASSWORD_BCRYPT), ':email'=>$email));

							$uid = DB::query('SELECT id FROM users WHERE username = :username', array(':username'=>$username))[0]['id'];
							
							echo "Success!";
							$cstrong = True;
								$token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));								
								$user_id = DB::query('SELECT id FROM users WHERE username=:username', array(':username'=>$username))[0]['id'];
								DB::query('INSERT INTO login_tokens VALUES (\'\', :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));

								setcookie("SNID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
								setcookie("SNID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);

								header('Location: '.'/botsbakersapp/dashboard/home.php');
							echo "Logged In";
						} else {
							echo "Email Already In Use";
						}
					}else {
						echo "Invalid Email";
					}
				} else {
					echo "Your Password Must Have More Than 6 Characters";
				}

			}else {
				echo "Invalid Username";
			}			
		}
	}else {
		echo 'User Already Exists';
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
</head>
<body>
	<h1>SignUp</h1>
	<form method="post" action="./signup.php">
		<input type="text" name="username" placeholder="username">
		<input type="password" name="password" placeholder="password">
		<input type="text" name="email" placeholder="email">
		<input type="submit" name="createaccount">
	</form>
</body>
</html>