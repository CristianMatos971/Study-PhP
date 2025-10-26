<?php

namespace Framework;

class Session
{
    /**
     * Iniciar Sessão
     *
     * @return void
     */
    public static function start()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Atribuir um valor a uma chave da Sessão
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Obter o valor de uma chave da Sessão
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
    }

    /**
     * Verificar se uma chave tem um valor inicializado
     *
     * @param string $key
     * @return boolean
     */
    public static function has($key)
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Esvaziar uma key específica da Sessão
     *
     * @param [type] $key
     * @return void
     */
    public static function clear($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * Destruir a Sessão
     *
     * @return void
     */
    public static function clearAll()
    {
        session_unset();
        session_destroy();
    }
}
