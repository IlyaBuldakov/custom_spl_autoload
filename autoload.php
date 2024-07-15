<?php

spl_autoload_register('autoload');

function autoload(string $classname)
{
    $config = json_decode(file_get_contents('config.json'))->autoload;
    if ($config) {
        $explodedName = explode('\\', $classname);
        $parentNamespace = array_shift($explodedName);
        foreach ($config as $key => $value) {
            if ($parentNamespace === $key) {
                require $value . '/' . implode('/', $explodedName) . '.php';
            }
        }
    } else {
        throw new Exception('Автозагрузка PSR-4 не сконфигурирована. Укажите родительскую директорию классов.');
    }
}