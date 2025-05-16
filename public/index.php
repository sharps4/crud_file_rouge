<?php
    require('../config/env.php');
    require('../config/db.php');
    require('../app/autoload.php');

    Router::addRoutes(readJSON('../config/routes.json'));
    Router::run();
?>