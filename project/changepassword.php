<?php
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Change Password Page</title>
        <link rel="stylesheet" href="../style.css">
    </head>
    <body>
        <header>
            <h1 class="title_top">Change Password Page</h1>
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
        <?php echo $error ?>
        <form action='./phpindex.php' method='post' name='changepassword_form'>
            <input type='hidden' name='action' value='changepassword' />
            <h2>Forgot your password? Reset it:</h2>
            <table>
                <tr>
                    <td>New password:</td>
                    <td><input type='password' name='new_password'></td>
                    <td><input type='submit' value='Enter'></td>
                </tr>
            </table>
        </form>
    </body>
</html>

