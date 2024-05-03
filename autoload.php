<?php

$loadedClasses = [];

$config = json_decode(file_get_contents('config.json'));
$path = $config->name;

$properties = get_object_vars($path);

$namespace = array_key_first($properties);
$src = $properties[$namespace];

function loadClass($class)
{
    global $namespace, $src, $loadedClasses;

    if (in_array($class, $loadedClasses)) {
        echo "$class уже загружен в память. Пропускаем.";
        return;
    }

    if (str_starts_with($class, $namespace)) {
        $oldClassName = $class;
        $class = str_replace($namespace, '', $class);
        require $src . '\\' . $class . '.php';
        $loadedClasses[] = $oldClassName;
        echo "$oldClassName загружен <br>";
    }
}

spl_autoload_register('loadClass');