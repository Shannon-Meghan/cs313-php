<?php
// connect to the database

$onOpenShift = getenv('OPENSHIFT_MYSQL_DB_HOST');

if ($onOpenShift == null || $onOpenShift == "") {
    try {
        $user = "fandomta_client";
        $password = "o8DOv19~h!kh";
        $db = new PDO("mysql:host=localhost;dbname=scriptures", $user, $password);
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
        
        $db = new PDO("mysql:host=$dbHost;dbname=scriptures", $user, $password);
    } catch (PDOException $ex) {
        echo "Error!: " . $ex->getMessage();
        die();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>5.5 Team Readiness Activity - Scriptures</title>
    </head>
    <body>


        <h1 align="center">Scripture Resources</h1>

        <?php
        foreach ($db->query('SELECT book, chapter, verse, content FROM scriptures') as $row) {
            echo "<b>" . $row['book'];
            echo ' ' . $row['chapter'];
            echo ':' . $row['verse'];
            echo '</b>  - "' . $row['content'];
            echo '"<br><br>';
        }
        ?>
    </body>
</html>