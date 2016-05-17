<?php

function dbConnect() {
    $dbHost = '';
    $dbPort = '';
    $dbUser = '';
    $dbPassword = '';
    $dbName = 'php';

    $onOpenShift = getenv('OPENSHIFT_MYSQL_DB_HOST');

    if ($onOpenShift == null || $onOpenShift == "") {
        //in our localhost environment
        $dbHost = '127.0.0.1';
        $dbPort = '80';
        $dbUser = 'root';
        $dbPassword = 'unicorn42';
        
        echo ("You are on a local host");
    } else {
        //in our OpenShift environment
        $dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');
        $dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');
        $dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
        $dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
          
    }

    //echo "host:$dbHost:$dbPort dbName:$dbName user:$dbUser" ;

    $db = newPDO("mysql:host=$dbHost:$dbPort;dbname=$dbName", $dbUser, $dbPassword);
    
    return $db;
}

?>