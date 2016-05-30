<?php

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Sign Up Success</title>
        <link rel="stylesheet" href="../style.css">
    </head>
    <body>
        <header>
            <h1 class="title_top">Sign Up Success Page</h1>
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
        <form action ='./phpindex.php' method='post' id='signupsuccess'>
            <input type='hidden' name='action' value='stepentry' />
            <p>You have successfully signed up!</p>
            <p>Your username is: <?php echo $_SESSION['email']; ?></p>
            <p>Your password is: <?php echo $_SESSION['password']; ?></p>
            <input type='submit' value='Start playing!' />
        </form>
    </body>
</html>