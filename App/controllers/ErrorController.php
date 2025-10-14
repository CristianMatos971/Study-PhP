<?php

namespace App\controllers;

class ErrorController
{

    public function __construct() {}

    /**
     * Erro 404 não encontrado
     *
     * @param string $message
     * @return void
     */
    public static function notFound($message = 'Resource not found')
    {
        http_response_code(404);

        loadView('error', ['status' => 404, 'message' => $message]);
    }
    /**
     * Erro 404 não encontrado
     *
     * @param string $message
     * @return void
     */
    public static function unauthorized($message = 'You are not authorized to view this resource')
    {
        http_response_code(403);

        loadView('error', ['status' => 403, 'message' => $message]);
    }
}
