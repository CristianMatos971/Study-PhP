<?php

namespace Framework;

use Framework\Session;

class Authorization
{
    /**
     * Checar se o usuário é dono do recurso a ser alterado
     *
     * @param int $resourceId
     * @return boolean
     */
    public static function isOwner($resourceId)
    {
        $sessionUser = Session::get('user');

        if (!$sessionUser === null && isset($sessionUser['id'])) {
            $sessionUserId = (int) $sessionUser['id'];
            return $sessionUserId === $resourceId;
        }
        return false;
    }
}
