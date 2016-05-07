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

        echo "<p>Name: " . filter_input(INPUT_POST, "name") . "</p>";
        echo "<p>E-mail: <a href='mailto:" . filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL) . "' target='_top'>" . filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL) . "</a></p>";
        if (isset(filter_INPUT(INPUT_POST, "major"))) {
            echo "<p>Major: " . $majors[filter_INPUT(INPUT_POST, "major")] . "</p>";
        }

        if (isset(filter_input(INPUT_POST, "places", FILTER_REQUIRE_ARRAY))) {
            echo "<p>These are the places you have visited:<br>";
            if (is_array(filter_input(INPUT_POST, "places", FILTER_REQUIRE_ARRAY))) {
                foreach (filter_input(INPUT_POST, "places", FILTER_REQUIRE_ARRAY) as $places) {
                    echo "&emsp;" . $places . "<br>";
                }
            } else{
                echo "&emsp;" . filter_input(INPUT_POST, "places", FILTER_REQUIRE_ARRAY) . "<br>";
            }
            echo "</p>";
        }

        if (isset(filter_input(INPUT_POST, "comment"))) {
            echo "<p>Comments:<br>";
            echo filter_input(INPUT_POST, "comment") . "<br>";
            echo "</p>";
        }
        ?>
    </body>
