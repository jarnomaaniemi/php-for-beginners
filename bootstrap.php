<?php

use Core\App;
use Core\Container;
use Core\Database;

$container = new Container();

// Insert Database (object) into container
$container->bind('Core\Database', function () {
    $config = require base_path('config.php');
    // Database configs: host, port, database, username etc.
    return new Database($config['database']);
});

App::setContainer($container);