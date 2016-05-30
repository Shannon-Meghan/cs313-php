<?php

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Steps Entry Page</title>
        <link rel="stylesheet" href="../style.css">
    </head>
    <body>
        <header>
            <h1 class="title_top">Steps Entry Page</h1>
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
        <form action='./phpindex.php' method='post' id='startover_form'>
            <input type='hidden' name='action' value='startover' />
            <table>
                <tr>
                    <td>Start over?</td>
                    <td><input type='submit' value='Enter' /></td>
                </tr>
            </table>
        </form>
    </body>
</html>
