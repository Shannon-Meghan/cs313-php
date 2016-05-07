<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Week 03</title>
    </head>
    <body>
        <?php
        $majors = array(
            "CS" => "Computer Science",
            "WebDev" => "Web Development and Design",
            "CIT" => "Computer Information Technology",
            "CompE" => "Computer Engineering"
        );

        echo "<p>Name: " . $_POST["name"] . "</p>";
        echo "<p>E-mail: <a href='mailto:" . $_POST["email"] . "' target='_top'>" . $_POST["email"] . "</a></p>";
        if (isset($_POST["major"])) {
            echo "<p>Major: " . $majors[$_POST["major"]] . "</p>";
        }

        if (isset($_POST["place"])) {
            echo "<p>These are the places you have visited:<br>";
            if (is_array($_POST["place"])) {
                foreach ($_POST["place"] as $places) {
                    echo "&emsp;" . $places . "<br>";
                }
            } else
                echo "&emsp;" . $_POST["place"] . "<br>";
            echo "</p>";
        }

        if (isset($_POST["comment"])) {
            echo "<p>Comments:<br>";
            echo $_POST["comment"] . "<br>";
            echo "</p>";
        }
        ?>
    </body>
