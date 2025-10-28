<?php

namespace Framework\middleware;

use Framework\Session;

class Authorize
{

    /**
     * Checar se o usuário está autenticado
     *
     * @return boolean
     */
    public function isAuthenticated()
    {
        return Session::has('user');
    }


    /**
     * Lidar com as requests do usuário
     * 
     * @param string $role
     * @return bool
     */
    public function handle($role)
    {
        if ($role === 'guest' && $this->isAuthenticated()) {
            return redirect('/');
        } else if ($role === 'auth' && !$this->isAuthenticated()) {
            return redirect('/auth/login');
        }
    }
}
