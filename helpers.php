<?php

/**
 * Pegar o path básico
 * 
 * @param string $path
 * @return string
 */
function basePath($path = '')
{
    return __DIR__ . '/' . $path;
}

/**
 * Encurtar a string pra carregar uma view
 * @param string $name
 * @return void
 */
function loadView($name, $data = [])
{
    $viewPath = basePath("App/views/{$name}.view.php");
    if (file_exists($viewPath)) {
        //inspectAndDie($data);
        extract($data);
        require "$viewPath";
    } else {
        echo $viewPath . '</br>';
        echo "The view $name was not found!";
    }
}

/**
 * Encurtar a string pra carregar um partial
 * 
 * @param string $name
 * @return void
 */
function loadPartial($name, $errors = [])
{
    $partialPath = basePath("App/views/partials/{$name}.php");
    if (file_exists($partialPath)) {
        extract($errors);
        require "$partialPath";
    } else {
        echo "The view $name was not found!";
    }
}

/**
 * Inspecionar uma váriavel ou objeto e para a interpretação do código
 * 
 * @param mixed $value
 * @return void
 */
function inspect($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}

/**
 * Inspecionar uma váriavel ou objeto e para a interpretação do código e parar o script
 * 
 * @param mixed $value
 * @return void
 */
function inspectAndDie($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    die;
}

/**
 * Formatar salário com casas decimais e milhares agrupados.
 *
 * @param [number] $salary
 * @return void
 */
function formatSalary($salary)
{
    return '$' . number_format(floatval($salary));
}

/**
 * Limpar inputs que podem estar sujos com caracteres especias html/js
 *
 * @param string $dirty
 * @return void
 */
function sanitize($dirty)
{
    return filter_var($dirty, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}


/**
 * Redirecionar para uma página
 *
 * @param  string $url
 * @return void
 */
function redirect($url)
{
    header('Location: ' . $url);
    exit;
}
