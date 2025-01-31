<?php

    class Auth {
        public static function SetLoginCookie($userID): void {
            $cstrong = true;
            $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
            $hashedToken = hash('sha256', $token);
        
            // Insert the new token into the database
            DB::query(
                'INSERT INTO login_tokens (token, user_id) VALUES (?, ?)',
                [$hashedToken, $userID]
            );
        
            // Set cookies securely
            $cookieParams = [
                'expires' => time() + 60 * 60 * 24 * 7, 
                'path' => '/', 
                'httponly' => true, 
                'secure' => true, 
                'samesite' => 'Strict'
            ];
            setcookie("SNID", $token, $cookieParams);
            setcookie("SNID_", '1', ['expires' => time() + 60 * 60 * 24 * 3, 'path' => '/', 'httponly' => true, 'secure' => true, 'samesite' => 'Strict']);
        }
        
        public static function login($username, $password) {
            // Check if the account exists
            if(!self::isLoggedIn()){
                $user = DB::query(
                    'SELECT id, password FROM users WHERE username = ?',
                    [$username]
                );
            
                if ($user) {
                    $userID = $user[0]['id'];
                    $hashedPassword = $user[0]['password'];
            
                    // Verify the password
                    if (password_verify($password, $hashedPassword)) {
                        self::SetLoginCookie($userID);
                        return array(200, 'Logged In Successfully');
                    } else {
                        return array(400, 'Incorrect Password');
                    }
                } else {
                    return array(400, 'An account with the username does not exist');
                }
            }else{
                return array(400, 'Already Logged in');
            }
            
        }
        
        public static function logout(): void {
            if (isset($_COOKIE['SNID'])) {
                $token = hash('sha256', $_COOKIE['SNID']);
        
                // Delete the token from the database
                DB::query('DELETE FROM login_tokens WHERE token = ?', [$token]);
        
                // Clear cookies
                setcookie("SNID", "", time() - 3600, '/', NULL, NULL, TRUE);
                setcookie("SNID_", "", time() - 3600, '/', NULL, NULL, TRUE);
            }
        }
        
        public static function signin($username, $names, $password) {
            $output = (object) [
                "code" => 400,
                "message" => "null"
            ];
        
            $isUsernameUsed = DB::query(
                'SELECT username FROM users WHERE username=?',
                [$username]
            );
        
            if (!$isUsernameUsed) {
                if (strlen($username) >= 3 && strlen($username) <= 32) {
                    if (preg_match('/[a-zA-Z0-9_]+/', $username)) {
                        if (strlen($password) >= 6 && strlen($password) <= 60) {
                            $isNamesUsed = DB::query(
                                'SELECT names FROM users WHERE names=?',
                                [$names]
                            );
        
                            if (!$isNamesUsed) {
                                DB::query(
                                    'INSERT INTO users (username, password, names) VALUES (?, ?, ?)',
                                    [$username, password_hash($password, PASSWORD_BCRYPT), $names]
                                );
        
                                // Automatically log in after signing up
                                self::login($username, $password);
                                $output->code = 200;
                                $output->message = "Signed In Successfully!";
                            } else {
                                $output->message = 'Account with same names already exists';
                            }
                        } else {
                            $output->message = 'Your Password Must Have More Than 6 Characters';
                        }
                    } else {
                        $output->message = 'Invalid Username';
                    }
                } else {
                    $output->message = 'Invalid Username';
                }
            } else {
                $output->message = 'User Already Exists';
            }
        
            return $output;
        }
        

        public static function getUserID():int {

            if(self::isLoggedIn()){
                $userID = DB::query(
                    'SELECT user_id FROM login_tokens WHERE token=?',
                    [sha1($_COOKIE['SNID'])]
                )[0]['user_id'];

                return $userID;
            }else {
                return -1;
            }
            
        }
    
        public static function isLoggedIn(){
            if(!isset($_COOKIE['SNID'])){
                return false;
            }

            $hashedToken = hash('sha256', $_COOKIE['SNID']);

            $userID = -1;
            $is_valid_token = DB::query(
                'SELECT user_id FROM login_tokens WHERE token=?',
                [$hashedToken]
            );
            if($is_valid_token){
                $userID = $is_valid_token[0]['user_id'];
            }
            else{
                // TOKEN DOES NOT EXISTS IN THE DATABASE
                setcookie("SNID", "", time() - 3600, '/', NULL, NULL, TRUE);
                setcookie("SNID_", "", time() - 3600, '/', NULL, NULL, TRUE);
                return false;
            }

            if ($userID){
                if (!isset($_COOKIE['SNID_'])) {
                    self::SetLoginCookie($userID);
                }		
                return true;
            }
        }
    
        public static function accountExists($username):bool {
            if (DB::query(
                'SELECT username FROM users WHERE username=?',
                [$username]
            )){
                return true;
            }
            return false;
        }
    }

?>