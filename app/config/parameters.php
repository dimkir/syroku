<?php

/* @var $container \Symfony\Component\DependencyInjection\ContainerInterface */
if (($node_home = getenv('NODE_HOME'))) {
    $container->setParameter('node_executable', $node_home . '/bin/node');
}



// -----------------------------------------------------------------------
// Database Url parsing
// -----------------------------------------------------------------------
if (!function_exists('parse_database_url')) {

    function parse_database_url($database_url, $container) {
        $db = parse_url($database_url);
//        print_r($db);  // be careful with this, will print to output pages when opening page in your dev environment (your app_dev.php)

        $container->setParameter('database_driver', 'pdo_mysql');
        $container->setParameter('database_host', $db['host']);

        isset($db['port']) and $container->setParameter('database_port', $db['port']);

        $container->setParameter('database_name', substr($db["path"], 1));
        $container->setParameter('database_user', $db['user']);
        $container->setParameter('database_password', $db['pass']);
    }

}

$DB_ENV_VARS_ORDERED_BY_PRIORITY = ['DATABASE_URL', 'CLEARDB_DATABASE_URL'];

$parsed_db_env_var = false;
$error_message = "Ambiguous database environment variables, aborting."
    ." We already configured db via %s, but detected alternative %s variable."
    ." Please unset redundant environment variable deploy again.";

foreach($DB_ENV_VARS_ORDERED_BY_PRIORITY as $ENV_VAR){

    if ( ($database_url = getenv($ENV_VAR))){
        if ( $parsed_db_env_var )  throw new \Exception(sprintf($error_message, $parsed_db_env_var, $ENV_VAR));
        parse_database_url($database_url, $container);
        $parsed_db_env_var = $ENV_VAR;
    }
}
