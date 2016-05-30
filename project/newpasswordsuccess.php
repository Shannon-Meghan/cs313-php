<?php

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Personal Project</title>
        <link rel="stylesheet" href="../style.css">
    </head>
    <body>
        <header>
            <h1 class="title_top">Successful Password Change</h1>
        </header>
        <nav>
            <ul class="nav_ul">
                <li class="nav_li"><a href="index.html">Home</a></li>
                <li class="nav_li"><a href="assignments.html">Assignments</a></li>
                <li class="nav_li"><a href="aboutme.html">About Me</a></li>
                <li class="nav_li" id="proj_color"><a href="personalproject.html">Project</a></li>
            </ul>
        </nav>
        <img src="../spiderweb.jpg" alt="spiderweb" width="800" height="300">
        <h2>Successful Password Chage is under construction.</h2>
        <form action="./phpindex.php" method="post" name="successful_password_change_form">
            <input type='hidden' name='action' value='stepentry'>
            <p>You have successfully change your password! Congratulations!</p>
            <input type='submit' value='Enter Steps'>
        </form>
    </body>
</html>

