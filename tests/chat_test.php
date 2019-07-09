<?php

    // Include CoffeeHouse's AutoLoader
    use CoffeeHouse\CoffeeHouse;

    $SourceDirectory = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR;
    include_once ($SourceDirectory . 'CoffeeHouse' . DIRECTORY_SEPARATOR . 'CoffeeHouse.php');

    $CoffeeHouse = new CoffeeHouse('<API KEY>');
    $Session = $CoffeeHouse->createSession('en');
    print($CoffeeHouse->thinkThought($Session->ID, "Hello! How are you?") . "\n");