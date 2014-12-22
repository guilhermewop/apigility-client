<?php
return [
    // routes
    'router'          => include 'module.config.routes.php',
    // services
    'service_manager' => include 'module.config.services.php',
    // controllers
    'controllers'     => include 'module.config.controllers.php',
    // view manager
    'view_manager'    => include 'module.config.viewmanager.php',
    // view helpers
    'view_helpers'    => include 'module.config.viewhelper.php',
    // apigility server
    'api-server'       => include 'module.config.api-server.php',
];
