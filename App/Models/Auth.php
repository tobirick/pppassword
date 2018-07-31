<?php
/**
 * Created by PhpStorm.
 * User: tobias.rickmann
 * Date: 23.07.2018
 * Time: 10:58
 */

namespace App\Models;

use Core\Model;

class Auth extends Model
{
    protected static $table = 'users';
    protected static $fillable = ['email', 'password', 'password_reset_token', 'password_reset_expiry_date', 'last_login', 'user_role_id', 'user_id'];

    public $email;

    public function checkIfUserExists()
    {
        $user = self::query()->select()->where('email', $this->email)->get();

        if ($user) {
            return $user[0];
        } else {
            return false;
        }
    }

    private function comparePasswords($password, $password_hash)
    {
        if (password_verify($password, $password_hash)) {
            return true;
        }
        return false;
    }

    public function login($password)
    {
        $user = $this->checkIfUserExists();

        if ($user) {
            if ($this->comparePasswords($password, $user->password)) {
                unset($_SESSION['userid']);
                session_regenerate_id(true);
                if (!isset($_SESSION['userid'])) {
                    $_SESSION['userid'] = $user->id;
                    return true;
                }
            }
        }

        return 'Wrong Credentials';
    }

    public function register($password)
    {
        if ($this->checkIfUserExists()) {
            return false;
        }

        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        $id = self::query()->insert([
            'email' => $this->email,
            'password' => $passwordHash,
            'user_role_id' => 1
        ]);

        self::query()->table('user_details')->insert([
            'user_id' => $id
        ]);

        if ($id) {
            return $id;
        } else {
            return 'User already exists';
        }
    }

    public static function logout()
    {
        unset($_SESSION['userid']);

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();
    }
}