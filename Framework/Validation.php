<?php

namespace Framework;

class Validation
{

    /**
     * Validar o comprimento de uma string
     *
     * @param string $value
     * @param integer $min
     * @param integer $max
     * @return bool
     */
    public static function string($value, $min = 1, $max = INF)
    {
        if (is_string($value)) {
            $string = trim($value);
            $length = strlen($string);
            return $length >= $min && $length <= $max;
        }
        return false;
    }

    /**
     * Validar um email
     *
     * @param string $email
     * @return mixed (bool, string $email)
     */
    public static function email($email)
    {
        $email = trim($email);
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Checar se dois valores são iguais
     *
     * @param [type] $value1
     * @param [type] $value2
     * @return void
     */
    public static function match($value1, $value2)
    {
        $value1 = trim($value1);
        $value2 = trim($value2);
        return $value1 === $value2;
    }
}
