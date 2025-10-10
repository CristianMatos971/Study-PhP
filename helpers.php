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
function loadView($name)
{
    $viewPath = basePath("views/{$name}.view.php");
    if (file_exists($viewPath)) {
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
function loadPartial($name)
{
    $partialPath = basePath("views/partials/{$name}.php");
    if (file_exists($partialPath)) {
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
function inspectAndDie($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    die;
}
