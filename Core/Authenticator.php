<?php

namespace Core;

class Authenticator
{
    public function attempt($email, $password)
    {
        // match credentials
        $user = App::resolve(Database::class)->query('select * from users where email = :email', [
            'email' => $email
        ])->find();

        // user found, we don't know if password match
        if ($user) {
            if (password_verify($password, $user['password'])) {
                // Correct password, login and create user to session
                $this->login([
                    'id' => $user['id'],
                    'email' => $email
                ]);

                return true;
            }
        }

        return false;
    }

    /**
     * Create user variable into $_SESSION 
     * @param array $user User information e.g. id, email.
     */
    public function login($user)
    {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'email' => $user['email']
        ];

        session_regenerate_id(true);
    }

    /**
     * Empty $_SESSION, destroy session data and browser cookie
     */
    public function logout()
    {
        $_SESSION = [];
        session_destroy();

        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
}
