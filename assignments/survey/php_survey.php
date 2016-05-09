<!DOCTYPE html>
<html>
    <head>
        <title>PHP Survey</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <h1 class="title_top">PHP Survey</h1>
        </header>
        <nav>
            <ul class="nav_ul">
                <li class="nav_li"><a href="index.php">Home</a></li>
                <li class="nav_li"><a href="/classes_view/cit261.html">CIT 261</a></li>
                <li class="nav_li"><a href="/classes_view/cs313.html">CS 313</a></li>
            </ul>
        </nav>
        <br>
        <?php
        $lifetime = 60 * 60 * 24 * 365;
        session_set_cookie_params($lifetime, '/');
        session_start();

        if (!isset($_SESSION['survey_check'])) {
            $_SESSION['survey_check'] = array();
        }
        ?>

        <?php if ($_SESSION['survey_check']['answer'] !== 'yes') { ?>
        <form method="post" action="cs313_assignments/php_survey_results.php">
            <input type="hidden" name="action" value="send_results">
            <p>On a scale of 1 - 10, how much do you enjoy using meghanshannon.com?</p>
            <div class="survey_radio">
                <input type="radio" name="scale_one" value=1>1<br>
                <input type="radio" name="scale_one" value=2>2<br>
                <input type="radio" name="scale_one" value=3>3<br>
                <input type="radio" name="scale_one" value=4>4<br>
                <input type="radio" name="scale_one" value=5>5<br>
                <input type="radio" name="scale_one" value=6>6<br>
                <input type="radio" name="scale_one" value=7>7<br>
                <input type="radio" name="scale_one" value=8>8<br>
                <input type="radio" name="scale_one" value=9>9<br>
                <input type="radio" name="scale_one" value=10>10<br>
            </div>
            <p>On a scale of 1-10, how would you rate your frustration in using meghanshannon.com?</p>
            <div class="survey_radio">
                <input type="radio" name="scale_two" value=1>1<br>
                <input type="radio" name="scale_two" value=2>2<br>
                <input type="radio" name="scale_two" value=3>3<br>
                <input type="radio" name="scale_two" value=4>4<br>
                <input type="radio" name="scale_two" value=5>5<br>
                <input type="radio" name="scale_two" value=6>6<br>
                <input type="radio" name="scale_two" value=7>7<br>
                <input type="radio" name="scale_two" value=8>8<br>
                <input type="radio" name="scale_two" value=9>9<br>
                <input type="radio" name="scale_two" value=10>10<br>
            </div>
            <p>How often do you visit meghanshannon.com?</p>
            <div class="survey_radio">
                <input type="radio" name="amt_visit" value="daily">Daily<br>
                <input type="radio" name="amt_visit" value="weekly">Weekly<br>
                <input type="radio" name="amt_visit" value="monthly">Monthly<br>
                <input type="radio" name="amt_visit" value="yearly">Yearly<br>
            </div>
            <p>How did you first hear about meghanshannon.com?</p>
            <div class="survey_radio">
                <input type="radio" name="first_hear" value="soc_med">Social Media<br>
                <input type="radio" name="first_hear" value="google">Google<br>
                <input type="radio" name="first_hear" value="friend">Friend<br>
                <input type="radio" name="first_hear" value="work">Work<br>
                <input type="radio" name="first_hear" value="other">Other<br>
            </div>
            <p>If you chose "other", please record how you heard of meghanshannon.com.</p>
            <textarea name="other_method" rows="1" cols="60"></textarea><br>

            <p>Please record any suggestions you have for making meghanshannon.com better.</p>
            <textarea name="suggestion" rows="10" cols="60"></textarea><br>
            <input type="submit" value="Submit">
        </form>
        <a href="./survey/php_survey_results.php/">Check out the results thus far.</a>
        <?php
        } else {
            require("./survey/php_survey_results.php/");
        }
        ?>

    </body>
</html>
