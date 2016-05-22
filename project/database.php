<?php

$onOpenShift = getenv('OPENSHIFT_MYSQL_DB_HOST');

if ($onOpenShift == null || $onOpenShift == "") {
    try {
        $user = "fandomta_client";
        $password = "o8DOv19~h!kh";
        $db = new PDO("mysql:host=localhost;dbname=story", $user, $password);
    } catch (PDOException $ex) {
        echo "Error!: " . $ex->getMessage();
        die();
    }
} else {
    try {
        $dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');
        $dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');
        $user = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
        $password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
        
        $db = new PDO("mysql:host=$dbHost;dbname=story", $user, $password);
    } catch (PDOException $ex) {
        echo "Error!: " . $ex->getMessage();
        die();
    }
}
?>

